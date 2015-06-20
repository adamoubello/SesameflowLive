<?php
// +----------------------------------------------------------------------+
// | PHP versions 4 and 5                                                 |
// +----------------------------------------------------------------------+
// | Copyright (c) 1998-2006 Manuel Lemos, Tomas V.V.Cox,                 |
// | Stig. S. Bakken, Lukas Smith                                         |
// | All rights reserved.                                                 |
// +----------------------------------------------------------------------+
// | MDB2 is a merge of PEAR DB and Metabases that provides a unified DB  |
// | API as well as database abstraction for PHP applications.            |
// | This LICENSE is in the BSD license style.                            |
// |                                                                      |
// | Redistribution and use in source and binary forms, with or without   |
// | modification, are permitted provided that the following conditions   |
// | are met:                                                             |
// |                                                                      |
// | Redistributions of source code must retain the above copyright       |
// | notice, this list of conditions and the following disclaimer.        |
// |                                                                      |
// | Redistributions in binary form must reproduce the above copyright    |
// | notice, this list of conditions and the following disclaimer in the  |
// | documentation and/or other materials provided with the distribution. |
// |                                                                      |
// | Neither the name of Manuel Lemos, Tomas V.V.Cox, Stig. S. Bakken,    |
// | Lukas Smith nor the names of his contributors may be used to endorse |
// | or promote products derived from this software without specific prior|
// | written permission.                                                  |
// |                                                                      |
// | THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS  |
// | "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT    |
// | LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS    |
// | FOR A PARTICULAR PURPOSE ARE DISCLAIMED.  IN NO EVENT SHALL THE      |
// | REGENTS OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,          |
// | INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, |
// | BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS|
// |  OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED  |
// | AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT          |
// | LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY|
// | WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE          |
// | POSSIBILITY OF SUCH DAMAGE.                                          |
// +----------------------------------------------------------------------+
// | Author: Lukas Smith <smith@pooteeweet.org>                           |
// +----------------------------------------------------------------------+

require_once 'MDB2/Driver/Manager/oci8.php';

/**
 * MDB2 oci8 driver for the management modules
 * Cette classe étend la classe MDB2_Driver_Manager_oci8 pour lui apporter une gestion des clés étrangères et d'autres fonctionnalités.
 * @package MDB2
 * @author Rémi FRESKO
 * @copyright Yob S.A 
 */
class MDB2_Driver_extension_Manager_oci8 extends MDB2_Driver_Manager_oci8
{
	/**
	 * Crée une contrainte (clé primaire, etrangère, not null, etc)	 *
	 * @param string $table nom de la table
	 * @param string $name nom de la contrainte
	 * @param array $definition data_definition de la contrainte
	 * @param boolean $disabled mettre à vraie si la contrainte doit être crée mais désactivée.
	 * @return MDB2_ok si tout s'est bien déroulé. MDB2_error en cas d'erreur.
	 */
 	function createConstraint($table, $name, $definition, $disabled = false)
    {   
    	/**
    	 * En cas de clé etrangère, on construira la requête normallement mais on ne l'executera pas à cause d'éventuelles erreurs de référence (table non existante, etc). 
    	 * On la renverra plutot. Il suffira donc, dans un premier temps de construire toutes les tables. Puis, on exécute toutes les contraintes de clés etrangères récupérées.
    	 * On évitera ainsi les erreurs.
    	 */
    	/**début code original classe mère**/ 	
    	$db =& $this->getDBInstance();
        if (PEAR::isError($db)) {
            return $db;
        }
        $table = $db->quoteIdentifier($table, true);
        $name = $db->quoteIdentifier($db->getIndexName($name), true);
        $query = "ALTER TABLE $table ADD CONSTRAINT $name";
        if (!empty($definition['primary'])) {
            $query.= ' PRIMARY KEY';
        } elseif (!empty($definition['unique'])) {
            $query.= ' UNIQUE';
        }
        /**fin code originale classe mère**/
        
        /**début code modifié**/
        elseif (!empty($definition['foreign']))
        {
        	$query.= ' FOREIGN KEY';
        }
        
        /**début code original classe mère**/
        $fields = array();
        foreach (array_keys($definition['fields']) as $field) {
            $fields[] = $db->quoteIdentifier($field, true);
        }
        $query .= ' ('. implode(', ', $fields) . ')';
         /**fin code original classe mère**/
        
        /**début code modifié**/
        if(!empty($definition['foreign']))
        {        	
        	$query.= ' REFERENCES '.$definition['foreign']['on']['table']; 
        	
        	$separateur = '(';
        	foreach ($definition['foreign']['on']['fields'] AS $nomChamp=>$contenu)
        	{
        		$query.= $separateur.$nomChamp;
        		$separateur = ', ';	
        	}
        	$query .= ')';
        	
        	
        	if(!empty($definition['foreign']['delete']))
        	{        	
        		//set null et cascade sont les deux seuls supportés par Oracle	
        		if(strcasecmp($definition['foreign']['delete'], "null"))
        		{
        			$query.= " ON DELETE SET NULL";
        		}
        		elseif(strcasecmp($definition['foreign']['delete'], "cascade"))
        		{
        			$query.= " ON DELETE CASCADE";
        		}        		
        	}        	
        	
        	$fp = fopen($GLOBALS['DOCUMENT_ROOT'].'/oracle_foreign_keys.txt', 'a+');
        	fputs($fp, $query.$suffixe_contrainte.";\n");
        	
        	return;
        	
        	//pas de support du "ON UPDATE", Oracle ne sait pas le gérer
        }
        /**fin code modifié**/
        
        /**début code original classe mère**/
        return $db->exec($query.$suffixe_contrainte);
        /**fin code original classe mère**/
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
     * Liste les contraintes d'une table
     *
     * @param string $table le nom de la table
     * @return array un tableau contenant les noms des contraintes
     */
	function listTableConstraints($table)
	{
		/**code original de la class mère**/
		$db =& $this->getDBInstance();
        if (PEAR::isError($db)) {
            return $db;
        }
        $table = $db->quote($table, 'text');
        /**fin code original classe mère**/
        
        /* Requête de la classe mère :
         * $query = 'SELECT index_name name FROM user_constraints';
         * $query.= ' WHERE table_name='.$table.' OR table_name='.strtoupper($table);
         * 
         * Cette requête ne prends pas en compte les clés etrangères ou tout autre contrainte si elle n'est pas indexée. 
         * En effet, les contraintes non indexées ont un un "index_name" à null et ne sont donc pas retenues.
         * Il serait donc plus judicieux de prendre la colonne "constraint_name".
         *
         * Oracle a également une colonne 'constraint_type' indiquant le type de contrainte : 
         * P pour une primary key, R pour une clé etrangère et C pour des contraintes de type CHECK. 
         * Tous les types içi : http://www.psoug.org/reference/constraints.html ->
         * C	Check on a table	O	Read Only on a view	P	Primary Key	R	Referential AKA Foreign Key	U	Unique Key	V	Check Option on a view
         */       
        /**début du code modifié**/ 
        $query = 'SELECT DISTINCT constraint_name name FROM user_constraints';
        $query.= ' WHERE table_name='.$table.' OR table_name='.strtoupper($table);
        $query.= ' AND constraint_type <> \'C\' AND STATUS = \'ENABLED\'';
        /**fin du code modifié**/
        
        /**début code original class mère**/
        $constraints = $db->queryCol($query);
        if (PEAR::isError($constraints)) {
            return $constraints;
        }

        $result = array();
        foreach ($constraints as $constraint) {
            $constraint = $this->_fixIndexName($constraint);
            if (!empty($constraint)) {
                $result[$constraint] = true;
            }
        }

        if ($db->options['portability'] & MDB2_PORTABILITY_FIX_CASE
            && $db->options['field_case'] == CASE_LOWER
        ) {
            $result = array_change_key_case($result, $db->options['field_case']);
        }
        return array_keys($result);
        /**fin code original classe mère**/
	}
	
	/** Crée les clés entrangères préalablement récupérées*/
	function activerContraintesDesactivees($lesRequetes)
	{
		$db =& $this->getDBInstance();
        if (PEAR::isError($db)) 
        {
            return $db;
        }

        $compteur = $count($lesRequetes);
        for($i=0; $i<$compteur; $i++)
        {
        	$temp = $db->exec($lesRequetes[$i]);
        	if(PEAR::isError($temp))
        	{
        		return $temp;
        	}
        }
        return MDB2_OK;
	}
		
	function desactiverVerificationFK()
	{
		
	}
	
	function activerVerificationFK()
	{
		
	}
}
?>