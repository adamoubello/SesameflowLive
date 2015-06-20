<?php

require_once('MDB2/Schema/Parser.php');
require_once('MDB2_Schema_Validate_redef.php');

/** 
 * Cette classe étends la classe MDB2_Schema_Parser du package MDB2_Schema. Tout comme la classe mère, sont rôle est de lire un fichier XML pour récuperer le data_definition. Là encore, les modifications sont minimes, mais indispensables pour la gestion des clés etrnagères ou des fonctionnalités supplémentaires apportées.
 * @package gestionBDD
 * @author Rémi FRESKO
 * @copyright Yob S.A
 */
class MDB2_Schema_Parser_redef extends MDB2_Schema_Parser
{
	
	function __construct($variables, $fail_on_invalid_names = true, $structure = false, $valid_types = array(), $force_defaults = true)
	{
        parent::__construct($variables, $fail_on_invalid_names, $structure, $valid_types, $force_defaults);
        //on a redéfini le validateur, il faut donc l'indiquer dans le constructeur
        //$this->val =& new MDB2_Schema_Validate_redef($fail_on_invalid_names, $valid_types, $force_defaults);
    }

    function MDB2_Schema_Parser_redef($variables, $fail_on_invalid_names = true, $structure = false, $valid_types = array(), $force_defaults = true)
    {
	    $this->__construct($variables, $fail_on_invalid_names, $structure, $valid_types, $force_defaults);
    }
    
	function cdataHandler($xp, $data)
	{
	        if ($this->var_mode == true) {
	            if (!isset($this->variables[$data])) {
	                $this->raiseError('variable "'.$data.'" not found', null, $xp);
	                return;
	            }
	            $data = $this->variables[$data];
	        }
	        
	        /*echo "<b>";
	        var_dump($this->element);
	        echo "----" ;
	        var_dump($data);
	        echo "</b><br/>";*/
	
	        switch ($this->element) {
	        /* Initialization */
	
	        /* Insert and Update */
	        case 'database-table-initialization-insert-field-name':
	        case 'database-table-initialization-update-field-name':
	            $this->setData($this->init['data']['field'], 'name', $data);
	            break;
	        case 'database-table-initialization-insert-field-value':
	        case 'database-table-initialization-update-field-value':        	       	
	            $this->setData($this->init['data']['field'], 'group', array('type' => 'value', 'data' => $data));
	            break;
	        case 'database-table-initialization-insert-field-function-name':
	        case 'database-table-initialization-update-field-function-name':
	            $this->init_function['name'] = $data;
	            break;
	        case 'database-table-initialization-insert-field-function-value':
	        case 'database-table-initialization-update-field-function-value':
	            $this->init_function['arguments'][] = array('type' => 'value', 'data' => $data);
	            break;
	        case 'database-table-initialization-insert-field-function-column':
	        case 'database-table-initialization-update-field-function-column':
	            $this->init_function['arguments'][] = array('type' => 'column', 'data' => $data);
	            break;
	
	        /* Update */
	        case 'database-table-initialization-update-field-column':
	            $this->setData($this->init['data']['field'], 'group', array('type' => 'column', 'data' => $data));
	            break;
	
	        /* All */
	        case 'database-table-initialization-insert-field-expression-operator':
	        case 'database-table-initialization-update-field-expression-operator':
	        case 'database-table-initialization-update-where-expression-operator':
	        case 'database-table-initialization-delete-where-expression-operator':
	            $this->init_expression['operator'] = $data;
	            break;
	        case 'database-table-initialization-insert-field-expression-value':
	        case 'database-table-initialization-update-field-expression-value':
	        case 'database-table-initialization-update-where-expression-value':
	        case 'database-table-initialization-delete-where-expression-value':
	            $this->init_expression['operants'][] = array('type' => 'value', 'data' => $data);
	            break;
	        case 'database-table-initialization-insert-field-expression-column':
	        case 'database-table-initialization-update-field-expression-column':
	        case 'database-table-initialization-update-where-expression-column':
	        case 'database-table-initialization-delete-where-expression-column':
	            $this->init_expression['operants'][] = array('type' => 'column', 'data' => $data);
	            break;
	
	        case 'database-table-initialization-insert-field-function-function':
	        case 'database-table-initialization-insert-field-function-expression':
	        case 'database-table-initialization-insert-field-expression-expression':
	        case 'database-table-initialization-update-field-function-function':
	        case 'database-table-initialization-update-field-function-expression':
	        case 'database-table-initialization-update-field-expression-expression':
	        case 'database-table-initialization-update-where-expression-expression':
	        case 'database-table-initialization-delete-where-expression-expression':
	            /* Recursion to be implemented yet */
	            break;
	
	        /* One level simulation of expression-function recursion */
	        case 'database-table-initialization-insert-field-expression-function-name':
	        case 'database-table-initialization-update-field-expression-function-name':
	        case 'database-table-initialization-update-where-expression-function-name':
	        case 'database-table-initialization-delete-where-expression-function-name':
	            $this->init_function['name'] = $data;
	            break;
	        case 'database-table-initialization-insert-field-expression-function-value':
	        case 'database-table-initialization-update-field-expression-function-value':
	        case 'database-table-initialization-update-where-expression-function-value':
	        case 'database-table-initialization-delete-where-expression-function-value':
	            $this->init_function['arguments'][] = array('type' => 'value', 'data' => $data);
	            break;
	        case 'database-table-initialization-insert-field-expression-function-column':
	        case 'database-table-initialization-update-field-expression-function-column':
	        case 'database-table-initialization-update-where-expression-function-column':
	        case 'database-table-initialization-delete-where-expression-function-column':
	            $this->init_function['arguments'][] = array('type' => 'column', 'data' => $data);
	            break;
	
	        /* One level simulation of function-expression recursion */
	        case 'database-table-initialization-insert-field-function-expression-operator':
	        case 'database-table-initialization-update-field-function-expression-operator':
	            $this->init_expression['operator'] = $data;
	            break;
	        case 'database-table-initialization-insert-field-function-expression-value':
	        case 'database-table-initialization-update-field-function-expression-value':
	            $this->init_expression['operants'][] = array('type' => 'value', 'data' => $data);
	            break;
	        case 'database-table-initialization-insert-field-function-expression-column':
	        case 'database-table-initialization-update-field-function-expression-column':
	            $this->init_expression['operants'][] = array('type' => 'column', 'data' => $data);
	            break;
	
	        /* Database */
	        case 'database-name':
	            if (isset($this->database_definition['name'])) {
	                $this->database_definition['name'].= $data;
	            } else {
	                $this->database_definition['name'] = $data;
	            }
	            break;
	        case 'database-create':
	            if (isset($this->database_definition['create'])) {
	                $this->database_definition['create'].= $data;
	            } else {
	                $this->database_definition['create'] = $data;
	            }
	            break;
	        case 'database-overwrite':
	            if (isset($this->database_definition['overwrite'])) {
	                $this->database_definition['overwrite'].= $data;
	            } else {
	                $this->database_definition['overwrite'] = $data;
	            }
	            break;
	        case 'database-table-name':
	            if (isset($this->table_name)) {
	                $this->table_name.= $data;
	            } else {
	                $this->table_name = $data;
	            }
	            break;
	        case 'database-table-was':
	            if (isset($this->table['was'])) {
	                $this->table['was'].= $data;
	            } else {
	                $this->table['was'] = $data;
	            }
	            break;
	          
	        
	
	        /* Field declaration */
	        case 'database-table-declaration-field-name':
	            if (isset($this->field_name)) {
	                $this->field_name.= $data;
	            } else {
	                $this->field_name = $data;
	            }
	            break;
	        case 'database-table-declaration-field-type':
	            if (isset($this->field['type'])) {
	                $this->field['type'].= $data;
	            } else {
	                $this->field['type'] = $data;
	            }
	            break;
	        case 'database-table-declaration-field-was':
	            if (isset($this->field['was'])) {
	                $this->field['was'].= $data;
	            } else {
	                $this->field['was'] = $data;
	            }
	            break;
	        case 'database-table-declaration-field-notnull':
	            if (isset($this->field['notnull'])) {
	                $this->field['notnull'].= $data;
	            } else {
	                $this->field['notnull'] = $data;
	            }
	            break;
	        case 'database-table-declaration-field-fixed':
	            if (isset($this->field['fixed'])) {
	                $this->field['fixed'].= $data;
	            } else {
	                $this->field['fixed'] = $data;
	            }
	            break;
	        case 'database-table-declaration-field-unsigned':
	            if (isset($this->field['unsigned'])) {
	                $this->field['unsigned'].= $data;
	            } else {
	                $this->field['unsigned'] = $data;
	            }
	            break;
	        case 'database-table-declaration-field-autoincrement':
	            if (isset($this->field['autoincrement'])) {
	                $this->field['autoincrement'].= $data;
	            } else {
	                $this->field['autoincrement'] = $data;
	            }
	            break;
	        case 'database-table-declaration-field-default':
	            if (isset($this->field['default'])) {           	
	                $this->field['default'].= $data;
	            } else {	            	
	                $this->field['default'] = $data;
	            }
	            break;
	        case 'database-table-declaration-field-length':
	            if (isset($this->field['length'])) {
	                $this->field['length'].= $data;
	            } else {
	                $this->field['length'] = $data;
	            }
	            break;
	
	        /* Index declaration */
	        case 'database-table-declaration-index-name':
	            if (isset($this->index_name)) {
	                $this->index_name.= $data;
	            } else {
	                $this->index_name = $data;
	            }
	            break;
	        case 'database-table-declaration-index-primary':
	            if (isset($this->index['primary'])) {
	                $this->index['primary'].= $data;
	            } else {
	                $this->index['primary'] = $data;
	            }
	            break;
	        case 'database-table-declaration-index-unique':
	            if (isset($this->index['unique'])) {
	                $this->index['unique'].= $data;
	            } else {
	                $this->index['unique'] = $data;
	            }
	            break;
		
			/**modif pour ultr@log**/
			//clé etrangère				
			case 'database-table-declaration-index-foreign-on-table':
				if (isset($this->index['foreign']['on']["table"]))
				{
					$this->index['foreign']['on']['table'].= $data;
				}
				else
				{
					$this->index['foreign']['on']['table'] = $data;
				}		
				break;
				
			case 'database-table-declaration-index-foreign-on-field':
				if (isset($this->index['foreign']['on']["fields"]))
				{
					$this->index['foreign']['on']['fields'][$data] = array();					
				}
				else
				{
					$this->index['foreign']['on']['fields'][$data] = array();
				}		
				break;
				
			case 'database-table-declaration-index-foreign-update':
				if (isset($this->index['foreign']["update"]))
				{
					$this->index['foreign']['update'].= $data;
				}
				else
				{
					$this->index['foreign']['update'] = $data;
				}		
				break;
				
			case 'database-table-declaration-index-foreign-delete':
				if (isset($this->index['foreign']["delete"]))
				{
					$this->index['foreign']['delete'].= $data;
				}
				else
				{
					$this->index['foreign']['delete'] = $data;
				}		
				break;		
				
	    	/*
	    		//exemple de fk
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
	    	} 
	    	*/
	    	
	    	
	    	
	    	
			/**fin modif pour ultr@log**/
			
			case 'database-table-declaration-index-was':
	            if (isset($this->index['was'])) {
	                $this->index['was'].= $data;
	            } else {
	                $this->index['was'] = $data;
	            }
	            break;
	        case 'database-table-declaration-index-field-name':
	            if (isset($this->field_name)) {
	                $this->field_name.= $data;
	            } else {
	                $this->field_name = $data;
	            }
	            break;
	        case 'database-table-declaration-index-field-sorting':
	            if (isset($this->field['sorting'])) {
	                $this->field['sorting'].= $data;
	            } else {
	                $this->field['sorting'] = $data;
	            }
	            break;
	        /* Add by Leoncx */
	        case 'database-table-declaration-index-field-length':
	            if (isset($this->field['length'])) {
	                $this->field['length'].= $data;
	            } else {
	                $this->field['length'] = $data;
	            }
	            break;
	
	        /* Sequence declaration */
	        case 'database-sequence-name':
	            if (isset($this->sequence_name)) {
	                $this->sequence_name.= $data;
	            } else {
	                $this->sequence_name = $data;
	            }
	            break;
	        case 'database-sequence-was':
	            if (isset($this->sequence['was'])) {
	                $this->sequence['was'].= $data;
	            } else {
	                $this->sequence['was'] = $data;
	            }
	            break;
	        case 'database-sequence-start':
	            if (isset($this->sequence['start'])) {
	                $this->sequence['start'].= $data;
	            } else {
	                $this->sequence['start'] = $data;
	            }
	            break;
	        case 'database-sequence-on-table':
	            if (isset($this->sequence['on']['table'])) {
	                $this->sequence['on']['table'].= $data;
	            } else {
	                $this->sequence['on']['table'] = $data;
	            }
	            break;
	        case 'database-sequence-on-field':
	            if (isset($this->sequence['on']['field'])) {
	                $this->sequence['on']['field'].= $data;
	            } else {
	                $this->sequence['on']['field'] = $data;
	            }
	            break;
	        }
	    }
	    
    function endHandler($xp, $element)
    {
        if (strtolower($element) == 'variable') {
            $this->var_mode = false;
            return;
        }
        		
        switch ($this->element) {
        /* Initialization */

        /* Insert and Delete */
        case 'database-table-initialization-insert-field':
        case 'database-table-initialization-update-field':
            /* field are now accepting functions and expressions
            we can't determine the return type of them
            $result = $this->val->validateInsertField($this);
            if (PEAR::isError($result)) {
                $this->raiseError($result->getUserinfo(), 0, $xp, $result->getCode());
            }
            */
            break;
        case 'database-table-initialization-insert-field-function':
        case 'database-table-initialization-update-field-function':
            $this->setData($this->init['data']['field'], 'group', array('type' => 'function', 'data' => $this->init_function));
            break;
        case 'database-table-initialization-insert-field-expression':
        case 'database-table-initialization-update-field-expression':
            $this->setData($this->init['data']['field'], 'group', array('type' => 'expression', 'data' => $this->init_expression));
            break;
        
        /* Delete and Update */
        case 'database-table-initialization-update-where-expression':
        case 'database-table-initialization-delete-where-expression':
            $this->init['data']['where']['type'] = 'expression';
            $this->init['data']['where']['data'] = $this->init_expression;
            break;

        /* All */
        case 'database-table-initialization-insert':
        case 'database-table-initialization-delete':
        case 'database-table-initialization-update':
            $this->table['initialization'][] = $this->init;
            break;

        /* One level simulation of expression-function recursion */
        case 'database-table-initialization-insert-field-expression-function':
        case 'database-table-initialization-update-field-expression-function':
        case 'database-table-initialization-update-where-expression-function':
        case 'database-table-initialization-delete-where-expression-function':
            $this->init_expression['operants'][] = array('type' => 'function', 'data' => $this->init_function);
            break;

        /* One level simulation of function-expression recursion */
        case 'database-table-initialization-insert-field-function-expression':
        case 'database-table-initialization-update-field-function-expression':
        case 'database-table-initialization-update-where-function-expression':
        case 'database-table-initialization-delete-where-function-expression':
            $this->init_function['arguments'][] = array('type' => 'expression', 'data' => $this->init_expression);
            break;

        /* Table definition */
        case 'database-table':
            $result = $this->val->validateTable($this->database_definition['tables'], $this->table, $this->table_name);
            if (PEAR::isError($result)) {
                $this->raiseError($result->getUserinfo(), 0, $xp, $result->getCode());
            } else {
                $this->database_definition['tables'][$this->table_name] = $this->table;
                
            }
            break;
        case 'database-table-name':
            if (isset($this->structure_tables[$this->table_name])) {
                $this->table = $this->structure_tables[$this->table_name];
            }
            break;

        /* Field declaration */
        case 'database-table-declaration-field':
            $result = $this->val->validateField($this->table['fields'], $this->field, $this->field_name);
            if (PEAR::isError($result)) {
                $this->raiseError($result->getUserinfo(), 0, $xp, $result->getCode());
            } else {
                $this->table['fields'][$this->field_name] = $this->field;
            }
            break;

        /* Index declaration */
        case 'database-table-declaration-index':
            $result = $this->val->validateIndex($this->table['indexes'], $this->index, $this->index_name);
            if (PEAR::isError($result)) {
                $this->raiseError($result->getUserinfo(), 0, $xp, $result->getCode());
            } else {
                $this->table['indexes'][$this->index_name] = $this->index;
            }
            break;
        case 'database-table-declaration-index-field':
            $result = $this->val->validateIndexField($this->index['fields'], $this->field, $this->field_name);
            if (PEAR::isError($result)) {
                $this->raiseError($result->getUserinfo(), 0, $xp, $result->getCode());
            } else {
                $this->index['fields'][$this->field_name] = $this->field;
            }
            break;            

        /* Sequence declaration */
        case 'database-sequence':
            $result = $this->val->validateSequence($this->database_definition['sequences'], $this->sequence, $this->sequence_name);
            if (PEAR::isError($result)) {
                $this->raiseError($result->getUserinfo(), 0, $xp, $result->getCode());
            } else {
                $this->database_definition['sequences'][$this->sequence_name] = $this->sequence;
            }
            break;

        /* End of File */
        case 'database':
            $result = $this->val->validateDatabase($this->database_definition);
            if (PEAR::isError($result)) {
                $this->raiseError($result->getUserinfo(), 0, $xp, $result->getCode());
            }
            break;
        }
        unset($this->elements[--$this->count]);
        $this->element = implode('-', $this->elements);
    }
}

?>