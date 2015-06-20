<?

require_once 'MDB2.php';
require_once('MDB2/Schema.php');

/** 
 * Classe qui étends MDB2_Schema du package MDB2_Schema. Les modifications sont minimes mais permettent la gestion des clés etrangères au niveau de l'import/export XML. La classe mère, MDB2_Schema est la classe pivot du package du même nom. Ainsi, c'est cette classe qui appelle
 * @package gestionBDD
 * @author Rémi FRESKO
 * @copyright Yob S.A
 */
class MDB2_Schema_extension extends MDB2_Schema
{
 	function &factory(&$db, $options = array())
    {
        $obj =& new MDB2_Schema_extension();
        $err = $obj->connect($db, $options);
        if (PEAR::isError($err))
        {
            return $err;
        }
        return $obj;
    }
	
	
 /** Execute the necessary actions to implement the requested changes
     in the indexes inside a database structure.
     * @param string name of the table
     * @param array associative array that contains the definition of the changes
     *               that are meant to be applied to the database structure.
     * @return bool|MDB2_ErrorMDB2_OK or error object
     * @access public */
    function alterDatabaseIndexes($table_name, $changes)
    {
        $alterations = 0;
        if (empty($changes)) 
        {
            return $alterations;
        }
        if (!empty($changes['remove']) && is_array($changes['remove']))
        {
            foreach ($changes['remove'] as $index_name => $index) 
            {
                if (!empty($index['primary']) || !empty($index['unique']) || !empty($index['foreign'])) 
                {
                    $result = $this->db->manager->dropConstraint($table_name, $index_name, !empty($index['primary']));
                } else {
                    $result = $this->db->manager->dropIndex($table_name, $index_name);
                }

                if (PEAR::isError($result))
                {
                    return $result;
                }
                $alterations++;
            }
        }
        if (!empty($changes['change']) && is_array($changes['change']))
        {
            foreach ($changes['change'] as $index_name => $index)
            {
                if (!empty($index['primary']) || !empty($index['unique']) || !empty($index['foreign']))
                {
                    $result = $this->db->manager->dropConstraint($table_name, $index_name, !empty($index['primary']));
                    if (PEAR::isError($result))
                    {
                        return $result;
                    }
                    $result = $this->db->manager->createConstraint($table_name, $index_name, $index);
                } 
                else
                {
                    $result = $this->db->manager->dropIndex($table_name, $index_name);
                    if (PEAR::isError($result))
                    {
                        return $result;
                    }
                    $result = $this->db->manager->createIndex($table_name, $index_name, $index);
                }
                if (PEAR::isError($result)) 
                {
                    return $result;
                }
                $alterations++;
            }
        }

        if (!empty($changes['add']) && is_array($changes['add'])) 
        {
            foreach ($changes['add'] as $index_name => $index) 
            {
                if (!empty($index['primary']) || !empty($index['unique']) || !empty($index['foreign']))
                {
                    $result = $this->db->manager->createConstraint($table_name, $index_name, $index);
                } 
                else
                {
                    $result = $this->db->manager->createIndex($table_name, $index_name, $index);
                }
                if (PEAR::isError($result))
                {
                    return $result;
                }
                $alterations++;
            }
        }
        return $alterations;
    }

/*     * Create indexes on a table
     *
     * @param string  name of the table
     * @param array   indexes to be created
     * @param bool  if the table/index should be overwritten if it already exists
     * @return bool|MDB2_ErrorMDB2_OK or error object
     * @access public
     */
    function createTableIndexes($table_name, $indexes, $overwrite = false)
    {
        if (!$this->db->supports('indexes'))
        {
            $this->db->debug('Indexes are not supported', __FUNCTION__);
            return MDB2_OK;
        }

        $supports_primary_key = $this->db->supports('primary_key');
        foreach ($indexes as $index_name => $index)
        {
            $errorcodes = array(MDB2_ERROR_UNSUPPORTED, MDB2_ERROR_NOT_CAPABLE);
            $this->db->expectError($errorcodes);
            if (!empty($index['primary']) || !empty($index['unique']) || !empty($index['foreign']))
            {
                $indexes = $this->db->manager->listTableConstraints($table_name);
            } 
            else 
            {
                $indexes = $this->db->manager->listTableIndexes($table_name);
            }
            
            $this->db->popExpect();
            if (PEAR::isError($indexes)) 
            {
                if (!MDB2::isError($indexes, $errorcodes)) 
                {
                    return $indexes;
                }
            } 
            elseif (is_array($indexes) && in_array($index_name, $indexes)) 
            {
            	if (!$overwrite)
            	{
                    $this->db->debug('Index already exists: '.$index_name, __FUNCTION__);
                    return MDB2_OK;
                }

				//modif
                if (!empty($index['primary']) || !empty($index['unique']) || !empty($index['foreign'])) 
                {
                    $result = $this->db->manager->dropConstraint($table_name, $index_name);
                } 
                else
                {
                	$result = $this->db->manager->dropIndex($table_name, $index_name);
                }
                
                if (PEAR::isError($result))
                {
                    return $result;
                }
                $this->db->debug('Overwritting index: '.$index_name, __FUNCTION__);
            }

            // check if primary is being used and if it's supported
            if (!empty($index['primary']) && !$supports_primary_key) 
            {
            	/**
                 * Primary not supported so we fallback to UNIQUE
                 * and making the field NOT NULL
                 */
                unset($index['primary']);
                $index['unique'] = true;
                $changes = array();
                foreach ($index['fields'] as $field => $empty) 
                {
                    $field_info = $this->db->reverse->getTableFieldDefinition($table_name, $field);
                    if (PEAR::isError($field_info)) 
                    {
                        return $field_info;
                    }
                    if (!$field_info[0]['notnull']) 
                    {
                        $changes['change'][$field] = $field_info[0];
                        $changes['change'][$field]['notnull'] = true;
                    }
                }
                if (!empty($changes)) 
                {
                    $this->db->manager->alterTable($table_name, $changes, false);
                }
            }
            
            //dans le cas de clés primaires, etangéres ou de contraintes unique, on ne crée en réalité par d'index, mais une contrainte.
            if (!empty($index['primary']) || !empty($index['unique']) || !empty($index['foreign']))
            {
                $result = $this->db->manager->createConstraint($table_name, $index_name, $index);
            } 
            else 
            {
                $result = $this->db->manager->createIndex($table_name, $index_name, $index);
            }

            if (PEAR::isError($result)) 
            {
                return $result;
            }
        }
        return MDB2_OK;
    }
}

?>