<?php
require_once('MDB2/Schema/Writer.php');

/**
 * Cette classe est une extension de la classe MDB2_Schema_Writer du package MDB2_Schema. Ce "writer" permet de passer d'un data_definition à un fichier XML valide. Outre la gestion des éléments non supportés par la calsse mère (clés etrangères notamment), il permet de générer des fichiers XML volumineux. En effet, la classe parente récupère entièrement le data_definition en mémoire, construits la structure du fichier XML et l'écrit dans un fichier qu'une fois cette opération terminée. Or, le data_definition d'une grosse base atteind rapidement la limite mémoire de PHP. Cette classe résoud donc ce problème en générant ce fichier au fur et à mesure : on crée le fichier XML, puis on insére les tables au fur et à mesure, en les supprimant de la mémoire une fois enregistrée.
 * @package gestionBDD
 * @author Rémi FRESKO
 * @copyright Yob S.A
 */
class MDB2_Schema_Writer_redef extends MDB2_Schema_Writer
{	
	/**
	 * Encode les caractères spéciaux de la chaine $string pour qu'ils soient valide XML.
	 * A la diffèrence de la fonction parente, cette fonction va supprimer le premier et le dernier caractère de la chaine si ce sont des caractères spéciaux.
	 * @param string $string la chaine à encoder
	 * @return string la chaine encodée, valide XML
	 */
	function _escapeSpecialChars($string)
    {    	
		//return $string;
    	if (!is_string($string))
        {
            $string = strval($string);
        }
        
        $count = strlen($string);
        
        $premierChar = $string{0};
        //if(strlen(htmlentities($premierChar, ENT_QUOTES)) != 1)  Modifié le 11.04.2007. Philippe KENGNE
    	if(strlen($premierChar, ENT_QUOTES) != 1)
    	{
    		$string = substr($string, 1, $count);
    		$count--;
    	}
    	
    	$dernierChar = $string{$count-1};
    	//if(strlen(htmlentities($dernierChar, ENT_QUOTES)) != 1)  Modifié le 11.04.2007. Philippe KENGNE
    	if(strlen($dernierChar, ENT_QUOTES) != 1)
    	{
    		$string = substr($string, 0, $count-1);
    		$count--;
    	}
        
        $escaped = '';

        for ($char = 0; $char < $count; $char++)
        {
            switch ($string[$char])
            {
            	case '&':
                	$escaped.= '&amp;';
                break;
            	case '>':
                	$escaped.= '&gt;';
                break;
            	case '<':
                	$escaped.= '&lt;';
                break;
            	case '"':
                	$escaped.= '&quot;';
                break;
            	case '\'':
                	$escaped.= '&apos;';
                break;
            	default:
                	$code = ord($string[$char]);	
                	if ($code < 32 || $code > 127)
                	{
                		if($code > 0)
                		{
                    		$escaped.= "&#$code;";
                		}
                	}
                	else
                	{
	                    $escaped.= $string[$char];
                	}
                break;
            }
        }
        return $escaped;
        
        /*
        if (!is_string($string)) {
            $string = strval($string);
        }

        $escaped = '';
        for ($char = 0, $count = strlen($string); $char < $count; $char++) 
        {
            switch ($string[$char]) 
            {
	            case '&':
	                $escaped.= '&amp;';
	                break;
	            case '>':
	                $escaped.= '&gt;';
	                break;
	            case '<':
	                $escaped.= '&lt;';
	                break;
	            case '"':
	                $escaped.= '&quot;';
	                break;
	            case '\'':
	                $escaped.= '&apos;';
	                break;
	            default:
	                $code = ord($string[$char]);
	                if ($code < 32 || $code > 127) 
	                {
	                    $escaped.= "&#$code;";
	                } else 
	                {
	                    $escaped.= $string[$char];
	                }
	                break;
            }
        }
        return $escaped;*/
    }
    
    
    /**
     * Tiens le même rôle que la méthode parente :
     * Dump a previously parsed database structure in the Metabase schema
     * XML based format suitable for the Metabase parser. This function
     * may optionally dump the database definition with initialization
     * commands that specify the data that is currently present in the tables.
     * 
     * Avec quelques modifications, pour prendre en compte les clés etrangères et les check
     * @param array associative array that takes pairs of tag
     *              names and values that define dump options.
     *                 array (
     *                     'output_mode'    =>    String
     *                         'file' :   dump into a file
     *                         default:   dump using a function
     *                     'output'        =>    String
     *                         depending on the 'Output_Mode'
     *                                  name of the file
     *                                  name of the function
     *                     'end_of_line'        =>    String
     *                         end of line delimiter that should be used
     *                         default: "\n"
     *                 );
     * @param integer determines what data to dump
     *                      MDB2_SCHEMA_DUMP_ALL       : the entire db
     *                      MDB2_SCHEMA_DUMP_STRUCTURE : only the structure of the db
     *                      MDB2_SCHEMA_DUMP_CONTENT   : only the content of the db
     * @return mixed MDB2_OK on success, or a error object
     * @access public
     */
    function dumpDatabase($database_definition, $arguments, $dump = MDB2_SCHEMA_DUMP_ALL)
    {	
    	/*
    	["indexes"]=>  array(2) 
    	{ 
    		//exemple de pk
    		["agence_id_etab_pk"]=>  array(2) 
    		{ 
    			["primary"]=>  bool(true) 
    			["fields"]=>  array(1) 
    			{ 
    				["id_etab"]=>  array(0) { } 
    			} 
    		} 
    		
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
        if (!empty($arguments['output'])) {
            if (!empty($arguments['output_mode']) && $arguments['output_mode'] == 'file') {
                $fp = fopen($arguments['output'], 'w');
                if ($fp === false) {
                    return $this->raiseError(MDB2_SCHEMA_ERROR_WRITER, null, null,
                        'it was not possible to open output file');
                }

                $output = false;
            } elseif (is_callable($arguments['output'])) {
                $output = $arguments['output'];
            } else {
                return $this->raiseError(MDB2_SCHEMA_ERROR_WRITER, null, null,
                    'no valid output function specified');
            }
        } else {
            return $this->raiseError(MDB2_SCHEMA_ERROR_WRITER, null, null,
                'no output method specified');
        }

        $eol = isset($arguments['end_of_line']) ? $arguments['end_of_line'] : "\n";

        $sequences = array();
        if (!empty($database_definition['sequences'])
            && is_array($database_definition['sequences'])
        ) {
            foreach ($database_definition['sequences'] as $sequence_name => $sequence) {
                $table = !empty($sequence['on']) ? $sequence['on']['table'] :'';
                $sequences[$table][] = $sequence_name;
            }
        }

        $buffer = '<?xml version="1.0" encoding="ISO-8859-1" ?>'.$eol;
        $buffer.= "<database>$eol$eol <name>".$database_definition['name']."</name>";
        $buffer.= "$eol <create>".$this->_dumpBoolean($database_definition['create'])."</create>";
        $buffer.= "$eol <overwrite>".$this->_dumpBoolean($database_definition['overwrite'])."</overwrite>$eol";

        if ($output) {
            call_user_func($output, $buffer);
        } else {
            fwrite($fp, $buffer);
        }

        if (!empty($database_definition['tables']) && is_array($database_definition['tables'])) {
            foreach ($database_definition['tables'] as $table_name => $table) {
                $buffer = "$eol <table>$eol$eol  <name>$table_name</name>$eol";
                if ($dump == MDB2_SCHEMA_DUMP_ALL || $dump == MDB2_SCHEMA_DUMP_STRUCTURE) {
                    $buffer.= "$eol  <declaration>$eol";
                    if (!empty($table['fields']) && is_array($table['fields'])) {
                        foreach ($table['fields'] as $field_name => $field) {
                            if (empty($field['type'])) {
                                return $this->raiseError(MDB2_SCHEMA_ERROR_VALIDATE, null, null,
                                    'it was not specified the type of the field "'.
                                    $field_name.'" of the table "'.$table_name);
                            }
                            if (!empty($this->valid_types) && !array_key_exists($field['type'], $this->valid_types)) {
                                return $this->raiseError(MDB2_SCHEMA_ERROR_UNSUPPORTED, null, null,
                                    'type "'.$field['type'].'" is not yet supported');
                            }
                            $buffer.= "$eol   <field>$eol    <name>$field_name</name>$eol    <type>";
                            $buffer.= $field['type']."</type>$eol";
                            if (!empty($field['unsigned'])) {
                                $buffer.= "    <unsigned>".$this->_dumpBoolean($field['unsigned'])."</unsigned>$eol";
                            }
                            if (!empty($field['length'])) {
                                $buffer.= '    <length>'.$field['length']."</length>$eol";
                            }
                            if (!empty($field['notnull'])) {
                                $buffer.= "    <notnull>".$this->_dumpBoolean($field['notnull'])."</notnull>$eol";
                            } else {
                                $buffer.= "    <notnull>false</notnull>$eol";
                            }
                            if (!empty($field['fixed']) && $field['type'] === 'text') {
                                $buffer.= "    <fixed>".$this->_dumpBoolean($field['fixed'])."</fixed>$eol";
                            }
                            if (array_key_exists('default', $field)
                                && $field['type'] !== 'clob' && $field['type'] !== 'blob'
                            ) {
                            	
                                $buffer.= '    <default>'.$this->_escapeSpecialChars($field['default'])."</default>$eol";                                
                            }
                            if (!empty($field['autoincrement'])) {
                                $buffer.= "    <autoincrement>" . $field['autoincrement'] ."</autoincrement>$eol";
                            }
                            $buffer.= "   </field>$eol";
                        }
                    }

                    if (!empty($table['indexes']) && is_array($table['indexes'])) {
                        foreach ($table['indexes'] as $index_name => $index) {
                            $buffer.= "$eol   <index>$eol    <name>$index_name</name>$eol";
                            if (!empty($index['unique'])) {
                                $buffer.= "    <unique>".$this->_dumpBoolean($index['unique'])."</unique>$eol";
                            }

                            if (!empty($index['primary'])) {
                                $buffer.= "    <primary>".$this->_dumpBoolean($index['primary'])."</primary>$eol";
                            }
                            
                            if (!empty($index['foreign']))
                            {
                            	$buffer.= "		<foreign>$eol";
                            	$buffer.= "			<on>$eol";
                            	$buffer.= "				<table>".$index['foreign']["on"]["table"]."</table>$eol";
                            	$compteurTemp = count($index['foreign']["on"]["fields"]);
                            	for($i=0; $i<$compteurTemp; $i++)
                            	{
                            		$buffer.= "				<field>".$index['foreign']["on"]["fields"][$i]."</field>$eol";                            		
                            	}
                            	$buffer.= "			</on>$eol";
                            	if(!empty($index['foreign']["update"]))
                            	{
                            		$buffer.= "			<update>".($index['foreign']["update"])."</update>$eol";
                            	}
                            	if(!empty($index['foreign']["delete"]))
                            	{
                            		$buffer.= "			<delete>".($index['foreign']["delete"])."</delete>$eol";
                            	}								
								$buffer.= "		</foreign>$eol";
                            }                            

                            foreach ($index['fields'] as $field_name => $field) {
                                $buffer.= "    <field>$eol     <name>$field_name</name>$eol";
                                if (!empty($field) && is_array($field)) {
                                    $buffer.= '     <sorting>'.$field['sorting']."</sorting>$eol";
                                }
                                $buffer.= "    </field>$eol";
                            }
                            $buffer.= "   </index>$eol";
                        }
                    }
                    $buffer.= "$eol  </declaration>$eol";
                }

                if ($output) {
                    call_user_func($output, $buffer);
                } else {
                    fwrite($fp, $buffer);
                }

                $buffer = '';
                if ($dump == MDB2_SCHEMA_DUMP_ALL || $dump == MDB2_SCHEMA_DUMP_CONTENT) {
                    if (!empty($table['initialization']) && is_array($table['initialization'])) {
                        $buffer = "$eol  <initialization>$eol";
                        foreach ($table['initialization'] as $instruction) {
                            switch ($instruction['type']) {
                            case 'insert':
                                $buffer.= "$eol   <insert>$eol";
                                foreach ($instruction['data']['field'] as $field) {
                                    $field_name = $field['name'];
                                    $buffer.= "$eol    <field>$eol     <name>$field_name</name>$eol";
                                    $buffer.= $this->writeExpression($field['group'], 5, $arguments);
                                    $buffer.= "    </field>$eol";
                                }
                                $buffer.= "$eol   </insert>$eol";
                                break;
                            case 'update':
                                $buffer.= "$eol   <update>$eol";
                                foreach ($instruction['data']['field'] as $field) {
                                    $field_name = $field['name'];
                                    $buffer.= "$eol    <field>$eol     <name>$field_name</name>$eol";
                                    $buffer.= $this->writeExpression($field['group'], 5, $arguments);
                                    $buffer.= "    </field>$eol";
                                }

                                if (!empty($instruction['data']['where'])
                                    && is_array($instruction['data']['where'])
                                ) {
                                    $buffer.= "    <where>$eol";
                                    $buffer.= $this->writeExpression($instruction['data']['where'], 5, $arguments);
                                    $buffer.= "    </where>$eol";
                                }

                                $buffer.= "$eol   </update>$eol";
                                break;
                            case 'delete':
                                $buffer.= "$eol   <delete>$eol$eol";
                                if (!empty($instruction['data']['where'])
                                    && is_array($instruction['data']['where'])
                                ) {
                                    $buffer.= "    <where>$eol";
                                    $buffer.= $this->writeExpression($instruction['data']['where'], 5, $arguments);
                                    $buffer.= "    </where>$eol";
                                }
                                $buffer.= "$eol   </delete>$eol";
                                break;
                            }
                        }
                        $buffer.= "$eol  </initialization>$eol";
                    }
                }
                $buffer.= "$eol </table>$eol";
                if ($output) {
                    call_user_func($output, $buffer);
                } else {
                    fwrite($fp, $buffer);
                }

                if (isset($sequences[$table_name])) {
                    foreach ($sequences[$table_name] as $sequence) {
                        $result = $this->dumpSequence(
                            $database_definition['sequences'][$sequence],
                            $sequence, $eol, $dump
                        );
                        if (PEAR::isError($result)) {
                            return $result;
                        }

                        if ($output) {
                            call_user_func($output, $result);
                        } else {
                            fwrite($fp, $result);
                        }
                    }
                }
            }
        }

        if (isset($sequences[''])) {
            foreach ($sequences[''] as $sequence) {
                $result = $this->dumpSequence(
                    $database_definition['sequences'][$sequence],
                    $sequence, $eol, $dump
                );
                if (PEAR::isError($result)) {
                    return $result;
                }

                if ($output) {
                    call_user_func($output, $result);
                } else {
                    fwrite($fp, $result);
                }
            }
        }

        $buffer = "$eol</database>$eol";
        if ($output) {
            call_user_func($output, $buffer);
        } else {
            fwrite($fp, $buffer);
            fclose($fp);
        }

        return MDB2_OK;
    }
    
    /**
     * Permet de passer d'un data_def à un fichier XML, mais de manière progressive : on écrit au fur et à mesure dans le fichier XML, puis on vide la mémoire.
     * @param array $database_definition la database_definition à écrire
     * @param ressource $fp
     * @return MDB2_Ok en cas de succès. MDB2_Error sinon
     */
    function dumpDatabaseEntete($database_definition, $fp)
    {
    	/*
    	["indexes"]=>  array(2) 
    	{ 
    		//exemple de pk
    		["agence_id_etab_pk"]=>  array(2) 
    		{ 
    			["primary"]=>  bool(true) 
    			["fields"]=>  array(1) 
    			{ 
    				["id_etab"]=>  array(0) { } 
    			} 
    		} 
    		
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
    	
    	
    	if ($fp === false) 
    	{
            return $this->raiseError(MDB2_SCHEMA_ERROR_WRITER, null, null,
                'it was not possible to open output file');
        }

        $eol = isset($arguments['end_of_line']) ? $arguments['end_of_line'] : "\n";

        /*$sequences = array();
        if (!empty($database_definition['sequences'])
            && is_array($database_definition['sequences'])
        ) {
            foreach ($database_definition['sequences'] as $sequence_name => $sequence) {
                $table = !empty($sequence['on']) ? $sequence['on']['table'] :'';
                $sequences[$table][] = $sequence_name;
            }
        }*/

        $buffer = '<?xml version="1.0" encoding="ISO-8859-1" ?>'.$eol;
        $buffer.= "<database>$eol$eol <name>".$database_definition['name']."</name>";
        $buffer.= "$eol <create>".$this->_dumpBoolean($database_definition['create'])."</create>";
        $buffer.= "$eol <overwrite>".$this->_dumpBoolean($database_definition['overwrite'])."</overwrite>$eol";

        
        fwrite($fp, $buffer);
        
		return MDB2_OK;       
    }
    
    /**
     * Finalise le fichier XML correspondant à $fp
     * @param ressource $fp
     * @return mixed MDB2_Ok en cas de succès. MDB2_error sinon.
     */
    function dumpDatabaseFin($fp)
    {
    	if ($fp === false) 
    	{
            return $this->raiseError(MDB2_SCHEMA_ERROR_WRITER, null, null,
                'it was not possible to open output file');
        }

        $eol = isset($arguments['end_of_line']) ? $arguments['end_of_line'] : "\n";
        
    	$buffer = "$eol</database>$eol";
        
        fwrite($fp, $buffer);
        fclose($fp);
        return MDB2_OK;
    }
    
    /**
     * Le contenu d'une table peut parfois être trop volumineux et entraine ainsi un dépassement de la 
     * mémoire allouée à PHP. La solution consiste donc à écrire au fur et à mesure le contenu dans le fichier destination.
     * @param array $table le data_definition d'une seule table.
     * @param ressource $fp le flux correspondant au fichier XML
     * @param constant $dump la méthode de récupération MDB2_SCHEMA_DUMP_ALL pour tout, MDB2_SCHEMA_DUMP_STRUCTURE pour la structure seulement et MDB2_SCHEMA_DUMP_CONTENT pour le contenu seulement
     * @param string $table_name le nom de la table correspondatne au data_definition passé en paramètre
     */
    function dumpDatabasePartiel($table, $fp, $dump = MDB2_SCHEMA_DUMP_ALL, $table_name)
    {
    	/*
    	["indexes"]=>  array(2) 
    	{ 
    		//exemple de pk
    		["agence_id_etab_pk"]=>  array(2) 
    		{ 
    			["primary"]=>  bool(true) 
    			["fields"]=>  array(1) 
    			{ 
    				["id_etab"]=>  array(0) { } 
    			} 
    		} 
    		
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

	    if ($fp === false) {
	        return $this->raiseError(MDB2_SCHEMA_ERROR_WRITER, null, null,
	            'it was not possible to open output file');
	    }         

        $eol = isset($arguments['end_of_line']) ? $arguments['end_of_line'] : "\n";

        /*$sequences = array();
        if (!empty($database_definition['sequences'])
            && is_array($database_definition['sequences'])
        ) {
            foreach ($database_definition['sequences'] as $sequence_name => $sequence) {
                $table = !empty($sequence['on']) ? $sequence['on']['table'] :'';
                $sequences[$table][] = $sequence_name;
            }
        }*/

        if (!empty($table) && is_array($table)) 
        {  
            $buffer = "$eol <table>$eol$eol  <name>$table_name</name>$eol";
            if ($dump == MDB2_SCHEMA_DUMP_ALL || $dump == MDB2_SCHEMA_DUMP_STRUCTURE) 
            {
                $buffer.= "$eol  <declaration>$eol";
                if (!empty($table['fields']) && is_array($table['fields'])) 
                {
                    foreach ($table['fields'] as $field_name => $field) 
                    {
                        if (empty($field['type'])) 
                        {
                            return $this->raiseError(MDB2_SCHEMA_ERROR_VALIDATE, null, null,
                                'it was not specified the type of the field "'.
                                $field_name.'" of the table "'.$table_name);
                        }
                        if (!empty($this->valid_types) && !array_key_exists($field['type'], $this->valid_types)) 
                        {
                            return $this->raiseError(MDB2_SCHEMA_ERROR_UNSUPPORTED, null, null,
                                'type "'.$field['type'].'" is not yet supported');
                        }
                        $buffer.= "$eol   <field>$eol    <name>$field_name</name>$eol    <type>";
                        $buffer.= $field['type']."</type>$eol";
                        if (!empty($field['unsigned'])) 
                        {
                            $buffer.= "    <unsigned>".$this->_dumpBoolean($field['unsigned'])."</unsigned>$eol";
                        }
                        if (!empty($field['length'])) 
                        {
                            $buffer.= '    <length>'.$field['length']."</length>$eol";
                        }
                        if (!empty($field['notnull'])) 
                        {
                            $buffer.= "    <notnull>".$this->_dumpBoolean($field['notnull'])."</notnull>$eol";
                        } 
                        else 
                        {
                            $buffer.= "    <notnull>false</notnull>$eol";
                        }
                        if (!empty($field['fixed']) && $field['type'] === 'text') 
                        {
                            $buffer.= "    <fixed>".$this->_dumpBoolean($field['fixed'])."</fixed>$eol";
                        }
                        if (array_key_exists('default', $field)&& $field['type'] !== 'clob' && $field['type'] !== 'blob') 
                        {                            	
                            $buffer.= '    <default>'.$this->_escapeSpecialChars($field['default'])."</default>$eol";                                
                        }
                        if (!empty($field['autoincrement'])) 
                        {
                            $buffer.= "    <autoincrement>" . $field['autoincrement'] ."</autoincrement>$eol";
                        }
                        $buffer.= "   </field>$eol";
                    }
                }

                if (!empty($table['indexes']) && is_array($table['indexes'])) 
                {
                    foreach ($table['indexes'] as $index_name => $index) 
                    {
                        $buffer.= "$eol   <index>$eol    <name>$index_name</name>$eol";
                        if (!empty($index['unique'])) 
                        {
                            $buffer.= "    <unique>".$this->_dumpBoolean($index['unique'])."</unique>$eol";
                        }

                        if (!empty($index['primary'])) 
                        {
                            $buffer.= "    <primary>".$this->_dumpBoolean($index['primary'])."</primary>$eol";
                        }
                        
                        if (!empty($index['foreign']))
                        {
                        	$buffer.= "		<foreign>$eol";
                        	$buffer.= "			<on>$eol";
                        	$buffer.= "				<table>".$index['foreign']["on"]["table"]."</table>$eol";
                        	$compteurTemp = count($index['foreign']["on"]["fields"]);
                        	for($i=0; $i<$compteurTemp; $i++)
                        	{
                        		$buffer.= "				<field>".$index['foreign']["on"]["fields"][$i]."</field>$eol";                            		
                        	}
                        	$buffer.= "			</on>$eol";
                        	if(!empty($index['foreign']["update"]))
                        	{
                        		$buffer.= "			<update>".($index['foreign']["update"])."</update>$eol";
                        	}
                        	if(!empty($index['foreign']["delete"]))
                        	{
                        		$buffer.= "			<delete>".($index['foreign']["delete"])."</delete>$eol";
                        	}								
							$buffer.= "		</foreign>$eol";
                        }                            

                        foreach ($index['fields'] as $field_name => $field) 
                        {
                            $buffer.= "    <field>$eol     <name>$field_name</name>$eol";
                            if (!empty($field) && is_array($field)) 
                            {
                                $buffer.= '     <sorting>'.$field['sorting']."</sorting>$eol";
                            }
                            $buffer.= "    </field>$eol";
                        }
                        $buffer.= "   </index>$eol";
                    }
                }
                $buffer.= "$eol  </declaration>$eol";
            }

           	fwrite($fp, $buffer);

            $buffer = '';
            if ($dump == MDB2_SCHEMA_DUMP_ALL || $dump == MDB2_SCHEMA_DUMP_CONTENT) {
                if (!empty($table['initialization']) && is_array($table['initialization'])) 
                {
                    $buffer = "$eol  <initialization>$eol";
                    foreach ($table['initialization'] as $instruction) 
                    {
                        switch ($instruction['type']) 
                        {
                        case 'insert':
                            $buffer.= "$eol   <insert>$eol";
                            foreach ($instruction['data']['field'] as $field) {
                                $field_name = $field['name'];
                                $buffer.= "$eol    <field>$eol     <name>$field_name</name>$eol";
                                $buffer.= $this->writeExpression($field['group'], 5, $arguments);
                                $buffer.= "    </field>$eol";
                            }
                            $buffer.= "$eol   </insert>$eol";
                            break;
                        case 'update':
                            $buffer.= "$eol   <update>$eol";
                            foreach ($instruction['data']['field'] as $field) {
                                $field_name = $field['name'];
                                $buffer.= "$eol    <field>$eol     <name>$field_name</name>$eol";
                                $buffer.= $this->writeExpression($field['group'], 5, $arguments);
                                $buffer.= "    </field>$eol";
                            }

                            if (!empty($instruction['data']['where'])
                                && is_array($instruction['data']['where'])
                            ) {
                                $buffer.= "    <where>$eol";
                                $buffer.= $this->writeExpression($instruction['data']['where'], 5, $arguments);
                                $buffer.= "    </where>$eol";
                            }

                            $buffer.= "$eol   </update>$eol";
                            break;
                        case 'delete':
                            $buffer.= "$eol   <delete>$eol$eol";
                            if (!empty($instruction['data']['where'])
                                && is_array($instruction['data']['where'])
                            ) {
                                $buffer.= "    <where>$eol";
                                $buffer.= $this->writeExpression($instruction['data']['where'], 5, $arguments);
                                $buffer.= "    </where>$eol";
                            }
                            $buffer.= "$eol   </delete>$eol";
                            break;
                        }
                    }
                    $buffer.= "$eol  </initialization>$eol";
                }
            }
            $buffer.= "$eol </table>$eol";
            if ($output) {
                call_user_func($output, $buffer);
            } else {
                fwrite($fp, $buffer);
            }

            if (isset($sequences[$table_name])) {
                foreach ($sequences[$table_name] as $sequence) {
                    $result = $this->dumpSequence(
                        $database_definition['sequences'][$sequence],
                        $sequence, $eol, $dump
                    );
                    if (PEAR::isError($result)) {
                        return $result;
                    }

                    if ($output) {
                        call_user_func($output, $result);
                    } else {
                        fwrite($fp, $result);
                    }
                }
            }            
        }

        /*if (isset($sequences[''])) {
            foreach ($sequences[''] as $sequence) {
                $result = $this->dumpSequence(
                    $database_definition['sequences'][$sequence],
                    $sequence, $eol, $dump
                );
                if (PEAR::isError($result)) {
                    return $result;
                }

                if ($output) {
                    call_user_func($output, $result);
                } else {
                    fwrite($fp, $result);
                }
            }
        }*/
        return MDB2_OK;
    }
}




?>