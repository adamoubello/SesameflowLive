	
<?php

class Table
{
   public $exception;
   public $db;
   public $typebd = "mysql";	//oci8 pr oracle,mssql pr sqlserver, mysql pr mysql, pg pr postgresql, mysqli pr mysqli
    
   public  $pwdbd;
   public  $hotebd;
   public  $userbd;
   public  $nombd;
   public  $uniteduree;
   public  $listlimit;
   public  $notifmail;
  
   
   function __construct()
   {

   	global $siteweb;
   	$this->exception = ""; 
	  
			if ( $siteweb->get_configuration($this->doc_root.DS."administration".DS."config.txt"))
			{
				//affecter les pramètres de $siteweb dans l'instnce en cours
				$this->hotebd = $siteweb->hotebd; 
				  $this->userbd = $siteweb->userbd;
				  $this->pwdbd = $siteweb->pwdbd;
				  $this->nombd = $siteweb->nombd;
				  $this->typebd = $siteweb->typebd;
			}
			else 
			{
	      	      $this->hotebd = "localhost"; 
				  $this->userbd = "root";
				  $this->pwdbd = "";
				  $this->nombd = "bdsesameflow";
				  $this->typebd = "mysql";
			}	 
   }
   
   public function has_exception(){return (trim($this->exception) != "");}
   public function get_exception(){return (trim($this->exception));}
   
   public function init()
   {
   	  global $siteweb;
   		$this->exception = ""; 
	  
	  //Le mode par défaut est le mode 0777, ce qui correspond au maximum de droits possible.
			$lfilename =  $siteweb->get_document_root().DS."administration".DS."config.txt";
			
			if ( $siteweb->get_configuration($lfilename))
			{
				//affecter les pramètres de $siteweb dans l'instnce en cours
				$this->hotebd = $siteweb->hotebd; 
				  $this->userbd = $siteweb->userbd;
				  $this->pwdbd = $siteweb->pwdbd;
				  $this->nombd = $siteweb->nombd;
				  $this->typebd = $siteweb->typebd;
			}
			else 
			{
	      	      $this->hotebd = "localhost"; 
				  $this->userbd = "root";
				  $this->pwdbd = "";
				  $this->nombd = "bdd_workflow";
				  $this->typebd = "mysql";
			}	 
   }
   
   
   public function connect_db()
	{
		
		$retvalue = false;
		
		require_once ("MDB2.php");
		$dsn = $this->typebd."://".$this->userbd.":".$this->pwdbd."@".$this->hotebd."/".$this->nombd;
		$options = array(
	    'debug'       => 2,
	    'portability' => MDB2_PORTABILITY_ALL,
		'persistent'  => True,		
		);
		
		$this->db = MDB2::connect($dsn,$options);
		
		if (MDB2::isError($this->db)) {
			$retvalue = false;
		    die ($this->db->getMessage()."(".$this->db->userinfo.")");
		}else{
		$retvalue = true;
		$this->db->setFetchMode(MDB2_FETCHMODE_ASSOC);
		$this->db->loadmodule("Date");
		$this->db->loadmodule("Extended");
		
		}
		//print_r($this->db);

		return $retvalue;
	}
	
	
	
	/**
	 * fonction de formatage d'un format depuis la base de données vers le format jj/mm/aaaa
	 *
	 * @param string - $pdate - date au format de la base de données
	 * @param string -  $typebd - type de SGBD = mysql par défaut
	 * 		= mssql pour SQL SERVER
	 * 		= oci8 pour Oracle 8
	 * 		= pgsql pour Postgresql
	 */
	public function format_database2date($pdate , $typebd = "mysql")
	{
		$lretval = "";
		
		switch (trim($typebd))
		{
			case "mssql" : $lretval = $pdate;   break;
			case "oci8" : $lretval = $pdate;   break;
			case "mssql" : $lretval = $pdate;   break;
			case "mysql" : $lretval = substr($pdate , 8 , 2)."/".substr($pdate , 5 , 2)
						."/".substr($pdate , 0 , 4);   break;
			default: $lretval = $pdate;   break;
				
		}
		
		return $lretval;
	}
	
	/**
	 * fonction de formatage d'une format au format jj/mm/aaaa vers le format attendu par le SGBD
	 *
	 * @param string - $pdate - date au format jj/mm/aaaa
	 * @param string -  $typebd - type de SGBD = mysql par défaut .la date retournée est au format anglophone AAAA-MM-JJ.
	 * 		= mssql pour SQL SERVER
	 * 		= oci8 pour Oracle 8
	 * 		= pgsql pour Postgresql
	 */
	public function format_date2database($pdate , $typebd = "mysql")
	{
		$lretval = "";
		
		switch (trim($typebd))
		{
			case "mssql" : $lretval = $pdate;   break;
			case "oci8" : $lretval = $pdate;   break;
			case "mssql" : $lretval = $pdate;   break;	
			case "mysql" : 
			$lretval = substr($pdate , 6 , 4);
			$lretval .= "-".substr($pdate , 3 , 2);
			$lretval .= "-".substr($pdate , 0 , 2);  
			//$lretval au format anglophone AAAA-MM-JJ.
			 break; 
			default: $lretval = $pdate;   break;
				
		}
		return $lretval;
	}
	
	
	 function _isDateVal($val)
	{
		if (strpos($val,"/"))
		{
			return "TO_DATE('$val','DD/MM/YYYY')";
		}
		else if (strpos($val,"-"))
		{
			return "TO_DATE('$val','YYYY-MM-DD')";
		}
		return "'$val'";
	}
		

	 function redraw_sql($sql,$Values , $Types = null)
	{
		for ($i = 0; $i < count($Values); $i++)
		{
			$Pos = strpos($sql,"?");
			$Tmp = substr($sql,0,$Pos);
			$Tmp2 = substr($sql, ($Pos + 1));
			if ($Types)
			{
				if (is_array($Types))
				{
					$ltype = $Types[$i];
					switch (trim(strtolower($ltype)))
					{
						case "text" : $lval = "'" . $Values[$i] . "'"; break;
						case "integer" : $lval = intval($Values[$i]) ; break;
						case "float" : $lval = floatval($Values[$i]) ; break;
						default: $lval = "'" . $Values[$i] . "'"; break;	
					}
					$sql = $Tmp . $lval . $Tmp2;
				}
				else $sql = $Tmp . $this->_isDateVal($Values[$i]) . $Tmp2;
			}
			else $sql = $Tmp . $this->_isDateVal($Values[$i]) . $Tmp2;
		}
		return $sql;
	}
	
	//fonction qui fabrique la balise ouvrante <select>
	public	function select_ouvrante_tag($attributes)
	{
		$lretval =  "<select";
		
		foreach ($attributes as $attr_id =>  $value)
		{
			$lretval .= " ".$attr_id." = \"{$value}\"";
		}
		
		$lretval .= ">\n";
		
		return $lretval;
	}


	function select_multiple_tag($attributes)
	{
		$lretval =  "<select multiple";
		
		foreach ($attributes as $attr_id =>  $value)
		{
		$lretval .= " ".$attr_id." = \"{$value}\"";
		}
		
		$lretval .= ">\n";
		
		return $lretval;
	}
	
	
	public function connection_database()
	{
		$this->exception = "";
		
		require_once ("MDB2.php");
		$dsn = $this->typebd."://".$this->userbd.":".$this->pwdbd."@".$this->hotebd."/".$this->nombd;
		
		$options = array(
	    'debug'       => 2,
	    'portability' => MDB2_PORTABILITY_ALL,
		'persistent'  => True,		
		);
		
		$this->db = MDB2::connect($dsn,$options);

		if (MDB2::isError($this->db)) {
		    $this->exception =  ($this->db->getMessage()."(".$this->db->userinfo.")");
		    return false;
		}
		
		$this->db->setFetchMode(MDB2_FETCHMODE_ASSOC);
		$this->db->loadmodule("Date");
		$this->db->loadmodule("Extended");
		
		return true;
	}
	/**
	* @author 			Xaverie télédzina <onana_carine@yahoo.fr>
			 * @desc			Script pour le traitement des valeurs à poster dans config.
			 * @param 			
			 * @creationdate	03 août 2009
			 * @updates
			 * */

	/**
	 * fonction de création d'une base de données et des objets dans cette abse de données
	 *
	 * @param string - $pnombd - nom de la base de donées
	 * @param string - $pfichier - nom du fichier qui contient le script de création des objets de la base de données
	 * @return unknown
	 */
	public function creation_database($pnombd, $pfichier)
	{
		global $translate;
		
		$retvalue = false;
		$this->exception = "";
		
		if (! file_exists($pfichier))
			{
			$this->exception = "";
			$retvalue = false;
		}
		
		
		require_once 'MDB2.php';
		$dsn = $this->typebd."://".$this->userbd.":".$this->pwdbd."@".$this->hotebd;
		$mdb2 =& MDB2::factory($dsn);
		if (PEAR::isError($mdb2)) {
			$this->exception = $mdb2->getMessage();
			die($this->exception);
		    $retvalue = false;
		}
		else{
		// loading the Manager module
		$mdb2->loadModule('Manager');
		// PHP5
		$mdb2->createDatabase($this->nombd);
		
		// set the new database to work with it
		$mdb2->setDatabase($this->nombd);
		
		//définit le codage ucs2 pour le eupport des caractères accentués
		switch(trim(strtolower($this->typebd)))
		{
			case "mysql" : 
				$mdb2->exec(" alter database `".trim($this->nombd)."` default character set ucs2 collate ucs2_general_ci ");
				  
			break;
		}
		
		// drop a table
		$listetable = array("champ" , "circuit" , "circuit_tache","config","departement","document","donnee","etiquette",
		"groupe","mail_account","mail_config","mail_log","mail_mail","numerique","participe","processus","profil",
		"utilisateur","tache","module","module_config","workflow","droit" );
		foreach ($listetable as $lnom_table) 
		{
		   $mdb2->dropTable($lnom_table);
		}
		
		//liberer la mémoire
		unset($lnom_table);

			//définition de la table champ
		$definition = array (
		    'numchamp' => array (
		        'type' => 'integer',
		        'unsigned' => 1,
		        'notnull' => true,
		    ),
		    'nomchamp' => array (
		        'type' => 'text',
		        'length' => 20
		    ),
		    'typechamp' => array (
		        'type' => 'text',
		        'length' => 15,
		        'notnull' => false,
		    )
		    ,
		    'numdoc' => array (
		    	'type' => 'integer',
		        'unsigned' => 1,
		        'notnull' => true,
		    )
			,
		    'valeurdonnee' => array (
		        'type' => 'text',
		        'length' => 255,
		        'notnull' => false,
		        'default' => ''
		    )

		);

		$mdb2->createTable('champ', $definition);

		//définition de la table circuit
		$definition = array (
		     'codecircuit' => array (
		        'type' => 'integer',
		        'unsigned' => 1,
		        'notnull' => 1,
		    ),
		    'libcircuit' => array (
		        'type' => 'text',
		        'length' => 60,
		        'notnull' => 0,
		    )
		    ,
		    
		    'dureecircuit' => array (
		        'type' => 'integer',
		        'unsigned' => 1,
		        'notnull' =>1,
		    ),
		    'numprocessus' => array (
		        'type' => 'integer',
		        'unsigned' => false,
		        'notnull' => 1,
		    ),
		    'archivecircuit' => array (
		        'type' => 'integer',
		        'unsigned' => 1,
		        'notnull' => 1,
		        'default' => 0
		    )
		);

		$mdb2->createTable('circuit', $definition);

		
		//définition de la table circuit_tache
		$definition = array (
		     'numtache' => array (
		        'type' => 'integer',
		        'unsigned' => false,
		        'notnull' => true,
		    ),
		     'codecircuit' => array (
		        'type' => 'integer',
		        'unsigned' => 1,
		        'notnull' => true,
		    ),
		    'codeprofil' => array (
		        'type' => 'integer',
		        'unsigned' => false,
		        'notnull' => false,
		        'default' => null
		    ),
		    'codeuser' => array (
		        'type' => 'integer',
		        'unsigned' => false,
		        'notnull' => false,
		        'default' => null
		    ),
		    'numtacheprec' => array (
		        'type' => 'integer',
		        'unsigned' => false,
		        'notnull' => false,
		        'default' => null
		    ),
		     'numtachesuiv' => array (
		        'type' => 'integer',
		        'unsigned' => 1,
		        'notnull' => false,
		        'default' => null
		    )

		);

		$mdb2->createTable('circuit_tache', $definition);

		
		//définition de la table config
		$definition = array (
		   'typebd' => array (
		        'type' => 'text',
		        'length' => 10,
		        'notnull' => 1,
		        'default' => 'mysql'
		    ),
		   'hotebd' => array (
		        'type' => 'text',
		        'length' => 30,
		        'notnull' => 1,
		    ),
		    'userbd' => array (
		        'type' => 'text',
		        'length' => 15,
		        'notnull' => 1,
		    ),
		    'pwdbd' => array (
		        'type' => 'text',
		        'length' => 15,
		        'notnull' => 0,
		        'default' => null
		    ),
		    'nombd' => array (
		        'type' => 'text',
		        'length' => 20,
		        'notnull' => 1,
		   ),
		    'uniteduree_process' => array (
		        'type' => 'integer',
		        'notnull' => 1,
		        'default' => 1
		    ),
		    'uniteduree_circuit'  => array (
		        'type' => 'integer',
		        'notnull' => 1,
		        'default' => 0
		    ),
		    'uniteduree_tache' => array (
		        'type' => 'integer',
		        'notnull' => 1,
		        'default' => 0
		    ),
		    'listlimit'  => array (
		        'type' => 'integer',
		        'notnull' => 1,
		        'default' => 10
		    ),
		    'notifmail' => array (
		        'type' => 'integer',
		        'notnull' => 1,
		        'default' => 0
		    ),
		     'hotesite' => array (
		        'type' => 'text',
		        'length' => 30,
		        'notnull' => 1,
		   ),
		    'portsite' => array (
		        'type' => 'integer',
		        'notnull' => 1,
		        'default' => 80
		    ),
		     'logosite' => array (
		        'type' => 'text',
		        'length' => 255,
		        'notnull' => 0,
		        'default' => 80
		    )
		);

		$mdb2->createTable('config', $definition);
		
		
		//définition de la table departement
		$definition = array (
		     'codedep' => array (
		        'type' => 'integer',
		        'notnull' => 1,
		    ),
		     'libdep' => array (
		        'type' => 'text',
		        'length' => 40,
		        'notnull' => 1,
		    )
		    );

		$mdb2->createTable('departement', $definition);

		
		//définition de la table document
		$definition = array (
		    'numdoc' => array (
		        'type' => 'integer',
		        'notnull' => 1,
		    ),
		    'titredoc' => array (
		        'type' => 'text',
		        'length' => 40,
		         'notnull' => 1,
		        
		    ),
		    'datecreation' => array (
		        'type' => 'date',
		         'notnull' => 1,
		        
		    ),
		    'heurecreation' => array (
		        'type' => 'text',
		        'length' => 8,
		         'notnull' => 1,
		        
		    ),
		    'codeuser' => array (
		        'type' => 'integer',
		        'notnull' => 1,
		    ),
		     'numtache' => array (
		        'type' => 'integer',
		        'unsigned' => false,
		        'notnull' => 1,
		    ),
		    'archive' => array (
		        'type' => 'integer',
		        'notnull' => 1,
		        'default' => 0
		    ),
		    'typedoc' => array (
		        'type' => 'text',
		        'length' => 20,
		        'notnull' => 1,
		    ),
		);

		$mdb2->createTable('document', $definition);
		
		
		//définition de la table donnee
		$definition = array (
		     'numchamp' => array (
		        'type' => 'integer',
		        'unsigned' => 1,
		        'notnull' => 1,
		    ),
		    'datemodif' => array (
		        'type' => 'date',
		         'notnull' => 1,
		        
		    ),
		    'heuremodif' => array (
		        'type' => 'text',
		        'length' => 10,
		         'notnull' => 1,
		        
		    ),
		    'valeurdonnee' => array (
		        'type' => 'text',
		        'length' => 255,
		        'notnull' => 0,
		        'default' => null
		    )

		);

		$mdb2->createTable('donnee', $definition);

		
		//définition de la table droit
		$definition = array (
		     'codeaction' => array (
		        'type' => 'text',
		        'length' => 30,
		         'notnull' => 1,
		        
		    ),
		     'codegroup' => array (
		        'type' => 'integer',
		        'unsigned' => 1,
		        'notnull' => 1,
		    )
		    
		);

		$mdb2->createTable('droit', $definition);
		
		//définition de la table etiquette
		$definition = array (
		   'tag' => array (
		        'type' => 'text',
		        'length' => 20,
		        'length' => 20
		    ),
		    'freq' => array (
		        'type' => 'float',
		        'unsigned' => 1,
		        'notnull' => 1,
				'default' => 0 
		    )
		    ,
		    'numdoc' => array (
		    	'type' => 'integer',
		        'unsigned' => 1,
		        'notnull' => 1,
		    )
		);

		$mdb2->createTable('etiquette', $definition);

		
		//définition de la table groupe
		$definition = array (
		    'codegroup' => array (
		        'type' => 'integer',
		        'unsigned' => 1,
		        'notnull' => 1,
		    ),
		    
		    'libgroup' => array (
		        'type' => 'text',
		        'length' => 100,
		        'notnull' => 1,
		    ),
		    'supprimgroup' => array (
		        'type' => 'integer',
		        'unsigned' => 1,
		        'notnull' => 1,
		        'default' => 0 
		    )
		);

		$mdb2->createTable('groupe', $definition);
		
		
		//définition de la table mail_account
		$definition = array (
		'email' => array (
		        'type' => 'text',
		        'length' => 25,
		        'notnull' => 1,
		 	)
		    
		);

		$mdb2->createTable('mail_account', $definition);

		
		//définition de la table mail_config
		$definition = array (
		 'mail_server'  => array (
		        'type' => 'integer',
		        'notnull' => 1,
		       
		    ),
		   'sender_email' => array (
		        'type' => 'text',
		        'length' => 100,
		        'notnull' => 0,
		        'default' => null
		    ),
		   'sender_name' => array (
		        'type' => 'text',
		        'length' => 100,
		        'notnull' => 0,
		        'default' => null
		    ),
		    'sendmail_path' => array (
		        'type' => 'text',
		        'length' => 255,
		        'notnull' => 0,
		        'default' => null
		    ),
		     'smtp_auth' => array (
		        'type' => 'integer',
		        'notnull' => 1,
		       
		    ),
		   
		    'smtp_user' => array (
		        'type' => 'text',
		        'length' => 60,
		        'notnull' => 0,
		        'default' => null
		    ),
		    'smtp_pwd' => array (
		        'type' => 'text',
		        'length' => 15,
		        'notnull' => 0,
		        'default' => null
		   ),
		   
		    
		     'smtp_host' => array (
		        'type' => 'text',
		        'length' => 100,
		        'notnull' => 1,
		   )
		);

		$mdb2->createTable('mail_config', $definition);
		//définition de la table mail_log
		$definition = array (
		     'log_id' => array (
		        'type' => 'integer',
		        'unsigned' => 1,
		        'notnull' => 1,
		    ),
		    'log_date' => array (
		        'type' => 'date',
		        'notnull' => 1,
		        
		    ),
		    'log_heure' => array (
		        'type' => 'text',
		        'length' => 10,
		        'notnull' => 1,
		        
		    ),
		    'log_status' => array (
		        'type' => 'text',
		        'length' => 10,
		        'notnull' => 1,
		        
		    ),
		    'log_email' => array (
		        'type' => 'text',
		        'length' => 60,
		        'notnull' => 1,
		        
		    )

		);

		$mdb2->createTable('mail_log', $definition);

		
		//définition de la table mail_mail
		$definition = array (
		 'code_mail'  => array (
		        'type' => 'integer',
		        'notnull' => 1,
		       
		    ),
		   'sujet_mail' => array (
		        'type' => 'text',
		        'length' => 255,
		        'notnull' => 1,
		    ),
		   'body_mail' => array (
		        'type' => 'text',
		        'notnull' => 0,
		        'default' => null
		    ),
		    'format_mail' => array (
		         'type' => 'integer',
		        'notnull' => 1,
		       
		    ),
		     'archive_mail' => array (
		        'type' => 'integer',
		        'notnull' => 1,
		       
		    ),
		   
		    'statut_mail' => array (
		        'type' => 'integer',
		        'notnull' => 1,
		        'default' => 0
		    ),
		     'auteur_mail' => array (
		        'type' => 'integer',
		        'notnull' => 1,
		    ),
		    'date_mail' => array (
		        'type' => 'date',
		        'notnull' => 1
		        )
		       
		);

		$mdb2->createTable('mail_mail', $definition);
		
		
		
		//définition de la table module
		$definition = array (
		     'codemod' => array (
		        'type' => 'text',
		        'length' => 10,
		        'notnull' => 1,
		        
		    ),
		     'etatmod' => array (
		        'type' => 'integer',
		        'unsigned' => 1,
		        'notnull' => 1,
		        'default' => 1
		    ),
		    'libmod' => array (
		        'type' => 'text',
		        'length' => 60,
		        'notnull' => 0,
		        'default' => null
		        
		    )
		    
		);

		$mdb2->createTable(' module', $definition);

		
		//définition de la table module_config
		$definition = array (
		'numchamp' => array (
		        'type' => 'integer',
		        'unsigned' => 1,
		        'notnull' => 1,
		       
		    ),
		     'nomchamp' => array (
		        'type' => 'text',
		        'length' => 20,
		        'notnull' => 1,
		        
		    ),
		     
		    'typechamp' => array (
		        'type' => 'text',
		        'length' => 15,
		        'notnull' => 1,
		        
		        
		    ),
		     'codemod' => array (
		        'type' => 'text',
		        'length' => 10,
		        'notnull' => 1,
		        
		    ),
		     
		    'valeurdonnee' => array (
		        'type' => 'text',
		        'length' => 255,
		        'notnull' => 0,
		        'default' => null
		        
		    )
		    
		);

		$mdb2->createTable(' module_config', $definition);

		
		
		//définition de la table numerique
		$definition = array (
		'numdoc' => array (
		        'type' => 'integer',
		        'unsigned' => 1,
		        'notnull' => 1,
		       
		    ),
		     'libfich' => array (
		        'type' => 'text',
		        'length' => 255,
		        'notnull' => 1,
		        
		    ),
		     
		    'dateimport' => array (
		        'type' => 'date',
		        'notnull' => 1,
		        
		        
		    ),
		     'heureimport' => array (
		        'type' => 'text',
		        'length' => 8,
		        'notnull' => 1,
		        
		    ),
		     
		    'archive' => array (
		        'type' => 'integer',
		        'unsigned' => 1,
		        'notnull' => 1,
		        'default' => 0
		       
		    ),
		    'numform' => array (
		        'type' => 'integer',
		        'unsigned' => 1,
		        'notnull' => 1,
		       
		    )
		    
		);

		$mdb2->createTable(' numerique', $definition);

		
		//définition de la table processus
		$definition = array (
		    'numprocessus' => array (
		        'type' => 'integer',
		        'unsigned' => false,
		        'notnull' => 1,
		    ),
		    
		    'libprocessus' => array (
		        'type' => 'text',
		        'length' => 40,
		        'notnull' => 1,
		    ),
		    'dureeprocessus' => array (
		        'type' => 'integer',
		        'unsigned' => 1,
		        'notnull' => 0,
		        'default' => null
		    ),
		    'etatprocessus' => array (
		        'type' => 'integer',
		        'unsigned' => 1,
		        'notnull' => 1,
		        'default' => 0
		    ),
		    'supprimeprocessus' => array (
		        'type' => 'integer',
		        'unsigned' => 1,
		        'notnull' => 1,
		        'default' => 0 
		    )
		);

		$mdb2->createTable('processus', $definition);
		
		//définition de la table profil
		$definition = array (
		     'codeprofil' => array (
		        'type' => 'integer',
		        'notnull' => 1,
		        
		    ),
		      'libprofil' => array (
		        'type' => 'text',
		        'length' => 40,
		        'notnull' => 1,
		    )
		    
		);

		$mdb2->createTable(' profil', $definition);
		
		
		//définition de la table tache
		$definition = array (
		'numtache' => array (
		        'type' => 'integer',
		        'unsigned' => false,
		        'notnull' => 1,
		    ),
		    
		    'libtache' => array (
		        'type' => 'text',
		        'length' => 100,
		         'notnull' => 1,
		        
		    ),
		   'dureetache' => array (
		        'type' => 'integer',
		        'unsigned' => 1,
		        'notnull' => 0,
		        'default' => null
		    ),
		    
		    'numprocessus' => array (
		        'type' => 'integer',
		        'unsigned' => false,
		        'notnull' => 1,
		    ),
		    'typedoc' => array (
		        'type' => 'text',
		        'length' => 30,
		        'notnull' => 0,
		        'default' => null
		    ),
		);

		$mdb2->createTable('tache', $definition);
		//définition de la table utilisateur
		$definition = array (
		'codeuser' => array (
		        'type' => 'integer',
		        'notnull' => 1,
		       
		    ),
		     'nomuser' => array (
		        'type' => 'text',
		        'length' => 30,
		        'notnull' => 1,
		        
		    ),
		     
		    'prenomuser' => array (
		        'type' => 'text',
		        'length' => 30,
		        'notnull' => 0,
		        'default' => null	        
		    ),
		     'emailuser' => array (
		        'type' => 'text',
		        'length' => 30,
		        'notnull' => 0,
		        'default' => null
		        
		    ),
		     'loginuser' => array (
		        'type' => 'text',
		        'length' => 20,
		        'notnull' => 1,
		        
		    ),
		     'passworduser' => array (
		        'type' => 'text',
		        'length' => 35,
		        'notnull' => 1,
		        
		    ),'numteluser' => array (
		        'type' => 'text',
		        'length' => 20,
		        'notnull' => 0,
		        'default' => null	        
		    ),
		    'numburuser'=>array (
		        'type' => 'text',
		        'length' => 20,
		        'notnull' => 0,
		        'default' => null	        
		    ),
		    'numfaxuser' => array (
		        'type' => 'text',
		        'length' => 20,
		        'notnull' => 0,
		        'default' => null
		        
		    ),
		     'datenaissanceuser' => array (
		        'type' => 'date',
		        'notnull' => 0,
		        'default' => null	        
		    ),
		     'typeuser' => array (
		        'type' => 'text',
		        'length' => 20,
		        'notnull' => 0,
		        'default' => null
		        
		    ),
		    'codegroup' => array (
		        'type' => 'integer',
		        'length' => 11,
		        'unsigned' => 1,
		        'notnull' => 1,
		       
		    ),
		    'villeuser' => array (
		        'type' => 'text',
		        'length' => 30,
		        'notnull' => 0,
		        'default' => null	        
		    ),
		     'paysuser' => array (
		        'type' => 'text',
		        'length' => 30,
		        'notnull' => 0,
		        'default' => null
		        
		    ),     
		    'codedep' => array (
		        'type' => 'integer',
		        'unsigned' => 1,
		        'notnull' => 0,
		        'default' => null
		     ),
		     
		    'codeprofil' => array (
		        'type' => 'integer',
		        'unsigned' => 1,
		        'notnull' => 0,
		        'default'=> null
		       
		    ), 
		    'connected' => array (
		        'type' => 'integer',
		        'unsigned' => 1,
		        'notnull' => 1,
		        'default'=> 0
		       
		    )     
		     
		);

		$mdb2->createTable(' utilisateur', $definition);
//définition de la table workflow
		$definition = array (
		'numworkflow' => array (
		        'type' => 'integer',
		        'unsigned' => 1,
		        'notnull' => 1,
		       
		    ),
		 	'datedebutwf' => array (
		        'type' => 'date',
		        'notnull' => 1,
		        
		        
		    ),
		    'heuredebutwf' => array (
		        'type' => 'text',
		        'length' => 10,
		        'notnull' => 1,
		        
		        
		    ),
		   
		    'dureewf' => array (
		        'type' => 'integer',
		        'unsigned' => 1,
		        'notnull' => 1,
		      
		    ),
		    'avancementwf' => array (
		        'type' => 'float',
		        'unsigned' => 1,
		        'notnull' => 1,
				'default' => 0 
		    ),
		     'codecircuit' => array (
		        'type' => 'integer',
		        'unsigned' => 1,
		        'notnull' => 1,
		      
		    ),
		    'numtache' => array (
		        'type' => 'integer',
		        'unsigned' => false,
		        'notnull' => 1,
		      
		    ),
		    'numdoc' => array (
		        'type' => 'integer',
		        'unsigned' => 1,
		        'notnull' => 1,
		      
		    ),
		     'archivewf' => array (
		        'type' => 'integer',
		        'unsigned' => 1,
		        'notnull' => 1,
		        'default' => 0 
		      
		    )
		    
		);

		$mdb2->createTable(' workflow', $definition);
		
		//ajouter un tuple dans la table des processus
		$mdb2->exec("insert into processus (numprocessus, libprocessus, dureeprocessus, etatprocessus, supprimeprocessus) values (-1, 'système', null, 0, 0)");
		
		//ajouter les tâches systèmes
		$mdb2->exec("insert into tache (numtache, libtache, dureetache, numprocessus, typedoc) values (-8, 'supprimer', 0, -1, 'workflow_update_valid')");
		$mdb2->exec("insert into tache (numtache, libtache, dureetache, numprocessus, typedoc) values (-7, 'archiver', 0, -1, 'workflow_update_valid')");
		$mdb2->exec("insert into tache (numtache, libtache, dureetache, numprocessus, typedoc) values (-6, 'rejeter', 0, -1, 'workflow_update_valid')");
		$mdb2->exec("insert into tache (numtache, libtache, dureetache, numprocessus, typedoc) values (-5, 'valider', 0, -1, 'workflow_update_valid')");
		$mdb2->exec("insert into tache (numtache, libtache, dureetache, numprocessus, typedoc) values (-4, 'réceptionner', 0, -1, 'workflow_update_valid')");
		$mdb2->exec("insert into tache (numtache, libtache, dureetache, numprocessus, typedoc) values (-3, 'modifier', 0, -1, 'workflow_update_valid')");
		$mdb2->exec("insert into tache (numtache, libtache, dureetache, numprocessus, typedoc) values (-2, 'envoyer', 0, -1, 'workflow_update_valid')");
		$mdb2->exec("insert into tache (numtache, libtache, dureetache, numprocessus, typedoc) values (-1, 'enregistrer', 0, -1, 'workflow_create')");
		
		//enregistrer les modules intégrés du workflow
		/*$mdb2->exec(" insert into module (codemod, etatmod, libmod) values ('ged', 1, 'permet de stocker et administrer une base de documents')");
		$mdb2->exec(" insert into module (codemod, etatmod, libmod) values ('mail', 1, 'Gestion des mails'");
		$mdb2->exec(" insert into module (codemod, etatmod, libmod) values ('paie', 0, 'SESAME PAIE')");
		$mdb2->exec(" insert into module (codemod, etatmod, libmod) values ('rh', 0, 'SESAME RH')");
		*/
		
		//ajouter par défaut tous les droits dans la table droit
		
		//afecter par défaut tous les droits à l'admin par défaut
		
		$mdb2->exec("insert into droit (codeaction, codegroup) values 
('circuit_search', 1),
('circuit_view', 1),
('cir_create1', 1),
('circuit_create_valid', 1),
('circuit_update_valid', 1),
('circuit_delete_valid', 1),
('dep_search', 1),
('dep_view', 1),
('dep_create', 1),
('dep_create_valid', 1),
('dep_update_valid', 1),
('dep_delete_valid', 1),
('doc_search', 1),
('doc_view', 1),
('doc_create', 1),
('doc_create_valid', 1),
('doc_update_valid', 1),
('doc_delete_valid', 1),
('droa_update_valid', 1),
('groupe_search', 1),
('groupe_view', 1),
('mail_search', 1),
('mail_view', 1),
('mail_create', 1),
('mail_create_valid', 1),
('mail_update_valid', 1),
('mail_delete_valid', 1),
('mail_archive', 1),
('mail_param', 1),
('mail_param_save', 1),
('mail_historic', 1),
('mail_send_valid', 1),
('mail_log', 1),
('processus_search', 1),
('processus_view', 1),
('processus_create', 1),
('processus_create_valid', 1),
('processus_update_valid', 1),
('processus_delete_valid', 1),
('profi_search', 1),
('profi_view', 1),
('profi_create', 1),
('profi_create_valid', 1),
('profi_update_valid', 1),
('profi_delete_valid', 1),
('tache_search', 1),
('tache_view', 1),
('tache_create', 1),
('tache_create_valid', 1),
('tache_update_valid', 1),
('tache_delete_valid', 1),
('user_search', 1),
('user_view', 1),
('user_create', 1),
('user_create_valid', 1),
('user_update_valid', 1),
('user_delete_valid', 1),
('workflow_search', 1),
('workflow_view', 1),
('workflow_create', 1),
('workflow_create_valid', 1),
('workflow_update_valid', 1),
('workflow_delete_valid', 1)");

		
			$retvalue = true ;

		
		}
		return $retvalue ;
		
	}
}

		/*
		require_once("application.class.php");
		
	// Disconnect
	//$mdb2->disconnect();
			$retvalue = true ;

		
		}
		return $retvalue ;
		
	}
}
/*
require_once("application.class.php");

$siteweb = new Application();
ini_set('include_path', $siteweb->get_document_root().DS.'includes'.DS."pear");	//charger les packages de PEAR::MDB2

 $l = new Table();
 $l->typebd = "mysql";
 $l->hotebd = "localhost";
 $l->userbd = "root";
 $l->nombd = "";
 $l->connection_database();
 $l->creation_database("aze","");

*/
?>
