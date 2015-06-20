<?php

require_once 'MDB2/Driver/Reverse/mysql.php';
/**
 * Cette classe est une extension de la classe MDB2_Driver_Reverse_mysql qui permet de faire de l'ingénierie inversée sur une base MySQL.
 * @copyright Yob S.A
 * @author Rémi FRESKO
 * @package MDB2 
 *
 */


class MDB2_Driver_extension_Reverse_mysql extends MDB2_Driver_Reverse_mysql
{
		  	
    /**
     * Get the stucture of a constraint into an array
     *
     * @param string    $table      name of table that should be used in method
     * @param string    $index_name name of index that should be used in method
     * @return mixed data array on success, a MDB2 error on failure
     * @access public
     */
    function getTableConstraintDefinition($table, $index_name)
    {
        $db =& $this->getDBInstance();
        if (PEAR::isError($db))
        {
            return $db;
        }

        if (strtolower($index_name) != 'primary')
        {
            $index_name = $db->getIndexName($index_name);
        }        
        $table = $db->quoteIdentifier($table, true);
        
        //récupération du type de contrainte pour construire le tableau résultat.
        $query = "SELECT CONSTRAINT_TYPE 
				FROM information_schema.TABLE_CONSTRAINTS 
				WHERE CONSTRAINT_SCHEMA = '$db->database_name'
					AND TABLE_NAME = '$table' 
					AND CONSTRAINT_NAME = '$index_name'";
                
        $result = $db->query($query);
        if (PEAR::isError($result)) 
        {
            return $result;
        }
        $row = $result->fetchRow(MDB2_FETCHMODE_ASSOC);        
        $row = array_change_key_case($row, CASE_LOWER);
        
        
        $definition = array("fields"=>array());
        if ($row['constraint_type'] == 'PRIMARY KEY') 
        {
            $definition['primary'] = true;
            $def = "SELECT COLUMN_NAME, ORDINAL_POSITION
        			FROM information_schema.KEY_COLUMN_USAGE
        			WHERE CONSTRAINT_SCHEMA = '$db->database_name'
	        			AND TABLE_NAME = '$table'
    	    			AND CONSTRAINT_NAME = '$index_name'
    	    		ORDER BY ORDINAL_POSITION ASC";
            $def_contraintes = $db->query($def);            
            while(is_array($temp = $def_contraintes->fetchRow(MDB2_FETCHMODE_ASSOC)))
            {
            	$temp = array_change_key_case($temp, CASE_LOWER);
            	$definition["fields"][$temp["column_name"]] = array();
            }
        } 
        elseif ($row['constraint_type'] == 'FOREIGN KEY')
        {
            $definition['foreign'] = array("on"=>array("fields"=>array(), "table"=>array()));
            $def = "SELECT COLUMN_NAME, ORDINAL_POSITION, REFERENCED_TABLE_SCHEMA, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME
        			FROM information_schema.KEY_COLUMN_USAGE
        			WHERE CONSTRAINT_SCHEMA = '$db->database_name'
	        			AND TABLE_NAME = '$table'
    	    			AND CONSTRAINT_NAME = '$index_name'
    	    		ORDER BY ORDINAL_POSITION ASC";
            $def_contraintes = $db->query($def);
            while(is_array($temp = $def_contraintes->fetchRow(MDB2_FETCHMODE_ASSOC)))
            {
            	$temp = array_change_key_case($temp, CASE_LOWER);
            	$definition["fields"][$temp["column_name"]] = array();
            	$definition['foreign']["on"]["table"] = $temp["referenced_table_name"];
            	array_push($definition['foreign']['on']['fields'], $temp["referenced_column_name"]);            	
            }
        }
        else 
        {
        	$definition['unique'] = true;
        	$def = "SELECT COLUMN_NAME, POSITION_IN_UNIQUE_CONSTRAINT
        			FROM information_schema.KEY_COLUMN_USAGE
        			WHERE CONSTRAINT_SCHEMA = '$db->database_name'
	        			AND TABLE_NAME = '$table'
    	    			AND CONSTRAINT_NAME = '$index_name'
    	    		ORDER BY POSITION_IN_UNIQUE_CONSTRAINT ASC";
        	$def_contraintes = $db->query($def);
        	while(is_array($temp = $def_contraintes->fetchRow(MDB2_FETCHMODE_ASSOC)))
            {
            	$temp = array_change_key_case($temp, CASE_LOWER);
            	$definition["fields"][$temp["column_name"]] = array();
            }
        }
        
        
        
        	/*
        	    * [fields] => array(2)
			          o [dv] => array(0)
			          o [sv] => array(0)
			    * [foreign] => array(1)
			          o [on] => array(2)
			                + [fields] => array(2)
			                      # [0] => array(1)
			                        string(2) "dv"
			                      # [1] => array(1)
			                        string(2) "sv"
			                + [table] => array(1)
			                  string(2) "SV"
			

			                  
			    * [fields] => array(3)
			          o [dv] => array(0)
			          o [id_budgach] => array(0)
			          o [sv] => array(0)
			    * [primary] => array(1)
			      bool(true) 
      */
        	
          
            
            //on va maintenant rechercher la définition de la contrainte (champs concernés, etc)
            
            
            
            
           /* $definition['fields'][$column_name] = array();
            if (!empty($row['collation'])) 
            {
                $definition['fields'][$column_name]['sorting'] = ($row['collation'] == 'A'
                    ? 'ascending' : 'descending');
            }*/
           
        
        $result->free();
        if (empty($definition['fields'])) 
        {
            return $db->raiseError(MDB2_ERROR_NOT_FOUND, null, null,
                'it was not specified an existing table constraint', __FUNCTION__);
        }
        return $definition;
    }
    
    
    /*function getTableConstraintDefinitionSansTable($index_name)
    {
      
    }*/
	
	
	
	
}
?>