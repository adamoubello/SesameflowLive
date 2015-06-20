<?php

require_once('MDB2/Schema/Validate.php');

/**
 
 * Cette classe est une extension de la classe parente MDB2_Schema_Validate du package MDB2_Schema. Tout comme la classe parente, cette classe permet de valider les informations d'un data_def avant de l'écrire dans le fichier XML. La classe parente comportait un bug qu'il a fallu corriger, en l'occurence, un problème de gestion des caractères spéciaux.
 * En effet, l'un des tests de validation porte sur la longueur d'une éventuelle valeur par défaut. Lorsqu'une valeur par défaut existe, le validateur compte le nombre de caractères. Si ce nombre de caractères est plus grand que la taille du champ, une erreur est logiquement déclenchée. Or, le validateur calcule la longueur de la valeur par défaut à partir de la chaine encodée. Par conséquent, lorsque la chaine contient des caractères spéciaux comme un "&", encodé en "&amp;", la longueur vaut 4 et non 1. Il faut donc décoder le caractère auparavant.
 * @copyright Yob S.A
 * @author Rémi FRESKO
 * @package gestionBDD
 */
class MDB2_Schema_Validate_redef extends MDB2_Schema_Validate
{
	/**
	 * Cette fonction valide ou non un champ en fonction de sa définition et de sa valeur.
	 *
	 * @param array $field_def le data_definition du champ
	 * @param var $field_value la valeur du champ
	 * @param string $field_name le nom du champ
	 * @return mixed true en cas de succès et MDB2_SCHEMA_ERROR_VALIDATE en cas d'erreur
	 */
	function validateDataFieldValue($field_def, &$field_value, $field_name)
	{
		if($field_value != '')
		{
		    switch ($field_def['type'])
		    {
		        case 'text':
		        case 'clob':
		        	//le validateur original ne gère pas les entités html préalablement converties !
		            if (!empty($field_def['length']) && strlen(html_entity_decode($field_value)) > $field_def['length'])
		            {	
		                return $this->raiseError(MDB2_SCHEMA_ERROR_VALIDATE, '"'.$field_value.'" is larger than "'.$field_def['length'].'"');
		            }
		            break;
		        case 'blob':
		            $field_value = pack('H*', $field_value);
		            if (!empty($field_def['length']) && strlen(html_entity_decode($field_value)) > $field_def['length'])
		            {
		                return $this->raiseError(MDB2_SCHEMA_ERROR_VALIDATE, '"'.$field_value.'" is larger than "'.$field_def['type'].'"');
		            }
		            break;
		        case 'integer':
		            if ($field_value != ((int)$field_value))
		            {
		                return $this->raiseError(MDB2_SCHEMA_ERROR_VALIDATE, '"'.$field_value.'" is not of type "'.$field_def['type'].'"');
		            }
		            $field_value = (int)$field_value;
		            if (!empty($field_def['unsigned']) && $field_def['unsigned'] && $field_value < 0)
		            {
		                return $this->raiseError(MDB2_SCHEMA_ERROR_VALIDATE, '"'.$field_value.'" signed instead of unsigned');
		            }
		            break;
		        case 'boolean':
		            if (!$this->isBoolean($field_value))
		            {
		                return $this->raiseError(MDB2_SCHEMA_ERROR_VALIDATE, '"'.$field_value.'" is not of type "'.$field_def['type'].'"');
		            }
		            break;
		        case 'date':
		            if (!preg_match('/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})/', $field_value) && $field_value !== 'CURRENT_DATE')
		            {
		                return $this->raiseError(MDB2_SCHEMA_ERROR_VALIDATE, '"'.$field_value.'" is not of type "'.$field_def['type'].'"');
		            }
		            break;
		        case 'timestamp':
		            if (!preg_match('/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{2}):([0-9]{2}):([0-9]{2})/', $field_value) && $field_value !== 'CURRENT_TIMESTAMP') 
		            {
		                return $this->raiseError(MDB2_SCHEMA_ERROR_VALIDATE,'"'.$field_value.'" is not of type "'.$field_def['type'].'"');
		            }
		            break;
		        case 'time':
		            if (!preg_match("/([0-9]{2}):([0-9]{2}):([0-9]{2})/", $field_value) && $field_value !== 'CURRENT_TIME') 
		            {
		                return $this->raiseError(MDB2_SCHEMA_ERROR_VALIDATE,
		                    '"'.$field_value.'" is not of type "'.$field_def['type'].'"');
		            }
		            break;
		        case 'float':
		        case 'double':
		            if ($field_value != (double)$field_value)
		            {
		                return $this->raiseError(MDB2_SCHEMA_ERROR_VALIDATE,
		                    '"'.$field_value.'" is not of type "'.$field_def['type'].'"');
		            }
		            $field_value = (double)$field_value;
		            break;
		        }
		}
		return true;
	}
	

    /**
     * Réécriture de la méthode mère, avec quelques tests de validation en moins.
     * Checks whether the definition of a parsed table is valid. Modify table
     * definition when necessary.
     * @param array  multi dimensional array that contains the
     *                 tables of current database.
     * @param array  multi dimensional array that contains the
     *                 structure and optional data of the table.
     * @param string  name of the parsed table
     *
     * @return bool|errorobject
     *
     * @access public
     */
    function validateTable($tables, &$table, $table_name)
    {


        /* Have we got a name? */


        if (!$table_name) {


            return $this->raiseError(MDB2_SCHEMA_ERROR_VALIDATE,


                'a table has to have a name');


        }


 


        /* Table name duplicated? */


        if (is_array($tables) && isset($tables[$table_name])) {


            return $this->raiseError(MDB2_SCHEMA_ERROR_VALIDATE,


                'table "'.$table_name.'" already exists');


        }


 


        /* Table name reserved? */


        if (is_array($this->fail_on_invalid_names)) {


            $name = strtoupper($table_name);


            foreach ($this->fail_on_invalid_names as $rdbms) {


                if (in_array($name, $GLOBALS['_MDB2_Schema_Reserved'][$rdbms])) {


                    return $this->raiseError(MDB2_SCHEMA_ERROR_VALIDATE,


                        'table name "'.$table_name.'" is a reserved word in: '.$rdbms);


                }


            }


        }


 


        /* Was */


        if (empty($table['was'])) {


            $table['was'] = $table_name;


        }


 


        /* Have we got fields? */


        if (empty($table['fields']) || !is_array($table['fields']))
        {
            /*return $this->raiseError(MDB2_SCHEMA_ERROR_VALIDATE,


                'tables need one or more fields');*/
        }


 


        /* Autoincrement */


      /* $autoinc = $primary = false;


        foreach ($table['fields'] as $field_name => $field) {


            if (!empty($field['autoincrement'])) 
            {
            	var_dump($field['autoincrement']);
                if ($primary) {


                    return $this->raiseError(MDB2_SCHEMA_ERROR_VALIDATE,


                        'there was already an autoincrement field in "'.$table_name.'" before "'.$field_name.'"');


                }
                $autoinc = $primary = true;
            }
        }*/

        /*
         * Checking Indexes
         * this have to be done here as we can't
         * guarantee that all table fields were already
         * defined in the moment we are parssing indexes
         */
        if (!empty($table['indexes']) && is_array($table['indexes'])) 
        {
            foreach ($table['indexes'] as $name => $index) 
            {
                $skip_index = false;
                if (!empty($index['primary'])) 
                {
                    /*
                     * Lets see if we should skip this index since there is
                     * already an auto increment on this field this implying
                     * a primary key index.
                     */
                    if ($autoinc && count($index['fields']) == '1') 
                    {
                        $skip_index = true;
                    } 
                    elseif ($primary) 
                    {
                        return $this->raiseError(MDB2_SCHEMA_ERROR_VALIDATE, 'there was already an primary index or autoincrement field in "'.$table_name.'" before "'.$name.'"');
                    }
                    else
                    {
                        $primary = true;
                    }
                }
                if (!$skip_index && is_array($index['fields'])) 
                {
                    foreach ($index['fields'] as $field_name => $field) 
                    {
                        if (!isset($table['fields'][$field_name])) 
                        {
                            return $this->raiseError(MDB2_SCHEMA_ERROR_VALIDATE, 'index field "'.$field_name.'" does not exist');
                        }
                        if (!empty($index['primary']) && !$table['fields'][$field_name]['notnull']) 
                        {
                            return $this->raiseError(MDB2_SCHEMA_ERROR_VALIDATE, 'all primary key fields must be defined notnull in "'.$table_name.'"');
                        }
                    }
                } 
                else 
                {
                    unset($table['indexes'][$name]);
                }
            }
        }
        return true;
    }
}

?>