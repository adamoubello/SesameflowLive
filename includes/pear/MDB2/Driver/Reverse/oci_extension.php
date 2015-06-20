<?php
// +----------------------------------------------------------------------+
// | PHP versions 4 and 5                                                 |
// +----------------------------------------------------------------------+
// | Copyright (c) 1998-2006 Manuel Lemos, Tomas V.V.Cox,                 |
// | Stig. S. Bakken, Lukas Smith, Frank M. Kromann                       |
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
//
// $Id: oci8.php,v 1.49 2006/11/03 12:52:20 lsmith Exp $
//

require_once 'MDB2/Driver/Reverse/oci8.php';

/**
 * Classe héritée de MDB2_Driver_Reverse_oci8, qui permet de faire de l'ingénierie inversée sur une base Oracle.
 *
 * @package MDB2 
 * @author  Rémi FRESKO
 * @copyright Yob S.A
 */
class MDB2_Driver_extension_Reverse_oci8 extends MDB2_Driver_Reverse_oci8
{
	
	/**
	 * Permet de retrouver la définition d'une contrainte.
	 * @param $string $table le nom de la table
	 * @param $string $index_name le nom de la contrainte.
	 * @return un tableau contenant la définition de la contrainte
	 */
   function getTableConstraintDefinition($table, $index_name)
    {
        $db =& $this->getDBInstance();
        if (PEAR::isError($db)) {
            return $db;
        }

        if (strtolower($index_name) != 'primary') {
            $index_name = $db->getIndexName($index_name);
        }

        /*Code d'origine :
        $query = 'SELECT all.constraint_type, cols.column_name';
        $query.= ' FROM all_constraints AS all, all_cons_columns AS cols';
        $query.= ' WHERE (all.table_name='.$db->quote($table, 'text').' OR all.table_name='.$db->quote(strtoupper($table), 'text').')';
        $query.= ' AND (all.index_name='.$db->quote($index_name, 'text').' OR all.index_name='.$db->quote(strtoupper($index_name), 'text').')';
        $query.= ' AND all.constraint_name = cols.constraint_name';*/
        
        $query = 'SELECT DISTINCT alls.constraint_type, cols.column_name, alls.delete_rule, alls.r_constraint_name';
        $query.= ' FROM all_constraints alls, all_cons_columns cols';
        $query.= ' WHERE (alls.table_name='.$db->quote($table, 'text').' OR alls.table_name='.$db->quote(strtoupper($table), 'text').')';
        
        /**debut code modif**/        
        $query.= ' AND (alls.constraint_name='.$db->quote($index_name, 'text').' OR alls.constraint_name='.$db->quote(strtoupper($index_name), 'text').')';        
        /**fin code modif**/
        
        $query.= ' AND alls.constraint_type <> \'C\''; //temporaire
        $query.= ' AND alls.constraint_name = cols.constraint_name';
        $query.= ' AND alls.owner = '.$db->quote(strtoupper($db->dsn['username']), 'text');
        $result = $db->query($query);
        if (PEAR::isError($result)) {
            return $result;
        }
        $definition = array();        
        while (is_array($row = $result->fetchRow(MDB2_FETCHMODE_ASSOC))) {
            $rowTemp = array_change_key_case($row, CASE_LOWER);            
            $column_name = $row['column_name'];
            if ($db->options['portability'] & MDB2_PORTABILITY_FIX_CASE) {
                if ($db->options['field_case'] == CASE_LOWER) {
                    $column_name = strtolower($column_name);
                } else {
                    $column_name = strtoupper($column_name);
                }
            }
            $definition['fields'][$column_name] = array();
        }
        
        $result->free();
        
        if (empty($definition['fields'])) {
            return $db->raiseError(MDB2_ERROR_NOT_FOUND, null, null,
                'it was not specified an existing table constraint', __FUNCTION__);
        }
        
        if ($rowTemp['constraint_type'] === 'P') {
            $definition['primary'] = true;
        } elseif ($rowTemp['constraint_type'] === 'U') {
            $definition['unique'] = true;
        }
        
        /**code modif**/
        elseif ($rowTemp['constraint_type'] === 'R')
        {
        	$definition['foreign'] = array("on"=>array());
        	$definition['foreign']['on'] = $this->getTableConstraintDefinitionSansTable($rowTemp['r_constraint_name']);        	
        	
        	if(strcmp($rowTemp['delete_rule'], 'SET NULL') == 0)
        	{
        		$definition['foreign']['delete'] = 'null';
        	}
        	elseif (strcmp($rowTemp['delete_rule'], 'CASCADE') == 0)
        	{
        		$definition['foreign']['delete'] = 'cascade';
        	}
        }
        /**fin code modif**/
        
        /*require_once($GLOBALS["DOCUMENT_ROOT"].'/theme/mambo/out/gestionBDD/function.debug.php');
        var_dump_ameliore($definition);*/
        
        return $definition;
    }
    
    /**
     * Permet de retrouver la définition d'une contrainte à partir de son nom uniquement.
     *
     * @param string $index_name le nom de la contrainte
     * @return un tableau contenant la définition de la contrainte
     */
    function getTableConstraintDefinitionSansTable($index_name)
    {
        $db =& $this->getDBInstance();
        if (PEAR::isError($db)) {
            return $db;
        }

        if (strtolower($index_name) != 'primary') {
            $index_name = $db->getIndexName($index_name);
        }
        
        $query = 'SELECT DISTINCT cols.column_name, alls.r_constraint_name, alls.table_name';
        $query.= ' FROM all_constraints alls, all_cons_columns cols';
        $query.= ' WHERE (alls.constraint_name='.$db->quote($index_name, 'text').' OR alls.constraint_name='.$db->quote(strtoupper($index_name), 'text').')';        
        
        $query.= ' AND alls.constraint_name = cols.constraint_name';
        $query.= ' AND alls.owner = '.$db->quote(strtoupper($db->dsn['username']), 'text');
        $result = $db->query($query);
        
        if (PEAR::isError($result)) {
            return $result;
        }
        $definition = array();
        $definition['fields'] = array();
        while (is_array($row = $result->fetchRow(MDB2_FETCHMODE_ASSOC))) {
            $row = array_change_key_case($row, CASE_LOWER);
            $column_name = $row['column_name'];
            if ($db->options['portability'] & MDB2_PORTABILITY_FIX_CASE) {
                if ($db->options['field_case'] == CASE_LOWER) {
                    $column_name = strtolower($column_name);
                } else {
                    $column_name = strtoupper($column_name);
                }
            }            
            array_push($definition['fields'], $column_name);            
            $definition['table'] = $row['table_name'];
        }
        $result->free();
        if (empty($definition['fields'])) {
            return $db->raiseError(MDB2_ERROR_NOT_FOUND, null, null,
                'it was not specified an existing table constraint', __FUNCTION__);
        }
        return $definition;
    }
}
?>