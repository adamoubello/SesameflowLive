<?php

require_once 'MDB2/Driver/Manager/mysql.php';

/**
 * MDB2 mysql driver for the management modules
 * Cette classe étend la classe MDB2_Driver_Manager_mysql pour lui apporter une gestion des clés étrangères et d'autres fonctionnalités. Les modifications apportées ne sont compatibles qu'avec MySQL 5.0 et supérieur. En effet, ce n'est qu'à partir de cette version que MySQL intègre une métabase à part entière (information_schema) qui est utilisée pour gérer correctement les clés etrangères.
 * @package MDB2
 * @author Rémi FRESKO
 * @copyright Yob S.A 
 */
class MDB2_Driver_extension_Manager_mysql extends MDB2_Driver_Manager_mysql
{
	 	
 	function createConstraint($table, $name, $definition)
    {
        $db =& $this->getDBInstance();
        if (PEAR::isError($db))
        {
            return $db;
        }

        $type = '';
        $name = $db->quoteIdentifier($db->getIndexName($name), true);
        if (!empty($definition['primary'])) 
        {
            $type = 'PRIMARY';
            $name = 'KEY';
        } elseif (!empty($definition['unique'])) 
        {
            $type = 'UNIQUE';
        }
        elseif (!empty($definition['foreign']))
        {
        	$type = 'FOREIGN';
        	$name = 'KEY';
        }             

        $table = $db->quoteIdentifier($table, true);
        $query = "ALTER TABLE $table ADD $type $name";
        $fields = array();
        foreach (array_keys($definition['fields']) as $field) 
        {
            $fields[] = $db->quoteIdentifier($field, true);
        }
        $query .= ' ('. implode(', ', $fields) . ')';
        
        if(!empty($definition['foreign']))
        {
        	/*Syntaxe fk en MySQL :
	        REFERENCES tbl_name (index_col_name, ...)
	    		[ON DELETE {RESTRICT | CASCADE | SET NULL | NO ACTION}]
	    		[ON UPDATE {RESTRICT | CASCADE | SET NULL | NO ACTION}]*/
        	$query .= ' REFERENCES '.$definition['foreign']['on']['table']."(";
        	$sep = '';
        	foreach ($definition['foreign']['on']['fields'] AS $nomChamp=>$structure)
        	{
        		$query = $query.$sep.$nomChamp;
        		$sep = ', ';
        	}
        	$query .= ")";        	
        	if(!empty($definition['foreign']['on']['delete']))
        	{
        		$query .= " ON DELETE ".$definition['foreign']['on']['delete'];
        	}
        	if(!empty($definition['foreign']['on']['update']))
        	{
        		$query .= " ON UPDATE ".$definition['foreign']['on']['update'];
        	}        	
        }
        
        
        if (!empty($definition['foreign']))
        {
        	//return $query.$suffixe_contrainte;
        	
        	$fp = fopen($GLOBALS['DOCUMENT_ROOT'].'/test_install_foreign_keys.txt', 'a+');
        	fputs($fp, $query.$suffixe_contrainte.";\n");
        	fclose($fp);
        	
        	return;
        }
        
        
        
        
        return $db->exec($query);
    }
    
    
    /**
     * Fonction qui permet de supprimer une contrainte sur une table.
     *
     * @param string $table nom de la table concernée
     * @param string $name nom de la contrainte
     * @param boolean $primary vrai si la contrainte à supprimer est une clé primaire.
     * @return mixed MDB2_error en cas d'erreur ou le nombre de contraintes affectées en cas de succès.
     */   
    function dropConstraint($table, $name, $primary = false)
    {
        $db =& $this->getDBInstance();
        if (PEAR::isError($db)) 
        {
            return $db;
        }

        echo "<b>$name</b>";
        
        $table = $db->quoteIdentifier($table, true);
        if ($primary || strtolower($name) == 'primary') 
        {
            $query = "ALTER TABLE $table DROP PRIMARY KEY";
        } 
        else 
        {
            $name = $db->quoteIdentifier($db->getIndexName($name), true);
            $query = "ALTER TABLE $table DROP INDEX $name";
        }
        return $db->exec($query);
    }
    
    /*
    ["rzrezrez"]=>  array(2) 
	    		{ 
	    			["foreign"]=>  array(3) 
	    			{ 
	    				["on"]=>  array(2) 
	    				{ 
	    					["table"]=>  string(4) "titi" 
	    					["fields"]=>  array(1) 
	    					{ [0]=>  string(4) "tutu" }
	    				}
	    				["update"]=>  string(7) "cascade" 
	    				["delete"]=>  string(8) "restrict" 
	    			} 
	    			["fields"]=>  array(1) 
	    			{ 
	    				["nom"]=>  array(0) { } 
	    			} 
	    		} 
	 */
	  /**
     * list all constraints in a table
     *
     * @param string    $table      name of table that should be used in method
     * @return mixed data array on success, a MDB2 error on failure
     * @access public
     */
    function listTableConstraints($table)
    {    	
        $db =& $this->getDBInstance();
        if (PEAR::isError($db))
        {
            return $db;
        }

        $key_name = 'Key_name';
        $non_unique = 'Non_unique';
        if ($db->options['portability'] & MDB2_PORTABILITY_FIX_CASE)
        {
            if ($db->options['field_case'] == CASE_LOWER) 
            {
                $key_name = strtolower($key_name);
                $non_unique = strtolower($non_unique);
            } else 
            {
                $key_name = strtoupper($key_name);
                $non_unique = strtoupper($non_unique);
            }
        }

        $table = $db->quoteIdentifier($table, true);
        
        /**requete modifiée : celle-çi permet d'obtenir les informations sur les clés etrangères et est donc préférable !*/
        $query = "SELECT * 
				FROM information_schema.TABLE_CONSTRAINTS 
				WHERE CONSTRAINT_SCHEMA = '$db->database_name'
					AND TABLE_NAME = '$table'";
        /* Produit un résultat de la forme :
        [0] => array(6)
		    * [constraint_catalog] => array(0)
		      NULL
		    * [constraint_schema] => array(1)
		      string(6) "selvaa"
		    * [constraint_name] => array(1)
		      string(7) "PRIMARY"
		    * [table_schema] => array(1)
		      string(6) "selvaa"
		    * [table_name] => array(1)
		      string(10) "c_bookmark"
		    * [constraint_type] => array(1)
		      string(11) "PRIMARY KEY" 
		      
		      MySQL ne gère pas les check, on, ne s'en occupera donc pas...		      
		      Travailler à partir d'une requete de selection sur la base information_schema est plus propre que les commande SHOW, mais n'est compatible qu'à partir des version MySQL 5.02 et supérieures
        */        
        
        /**ancienne requete**/
        //$query = "SHOW INDEX FROM $table";
        
        $indexes = $db->queryAll($query, null, MDB2_FETCHMODE_ASSOC);
        if (PEAR::isError($indexes)) 
        {
            return $indexes;
        }

        /*require_once($GLOBALS["DOCUMENT_ROOT"].'/theme/mambo/out/gestionBDD/function.debug.php');
        var_dump_ameliore($indexes);*/
        $result = array();
        
        //ancien code
        /*foreach ($indexes as $index_data) 
        {	
            if (!$index_data[$non_unique]) 
            {
                if ($index_data[$key_name] !== 'PRIMARY') 
                {
                    $index = $this->_fixIndexName($index_data[$key_name]);
                } else 
                {
                    $index = 'PRIMARY';
                }
                if (!empty($index)) 
                {
                    $result[$index] = true;
                }
            }
        }*/
        
        //nouveau code
        foreach ($indexes as $index_data) 
        {
        	//detliv à tester
        	//test si non index
        	//si oui, ajout nom contrainte
        	//si non, on ne fait rien
        	
            if ($index_data["constraint_type"] !== 'PRIMARY KEY') 
            {                	
                $index = $this->_fixIndexName($index_data["constraint_name"]);
            } else 
            {
                $index = 'PRIMARY';
            }                
            
            if (!empty($index)) 
            {
                $result[$index] = true;
            }            
        }
        
        if ($db->options['portability'] & MDB2_PORTABILITY_FIX_CASE) 
        {
            $result = array_change_key_case($result, $db->options['field_case']);
        }
        return array_keys($result);
    }
	
	function desactiverVerificationFK()
	{
		
	}
	
	function activerVerificationFK()
	{
		
	}
	
	
	/**
	 * Crée une table. Le type est défini à InnoDB
	 *
	 * @param string $name nom de la table à créer
	 * @param array $fields definition de la table à créer
	 * @param array $options options de la table
	 * @return mixed MDB2_Ok en cas de succès, MDB2_error sinon.
	 */
	function createTable($name, $fields, $options = array())
	{
		if (PEAR::isError($db))
        {
            return $db;
        }
		$options['type'] = 'INNODB';
		return  parent::createTable($name, $fields, $options);		
	}
}
?>