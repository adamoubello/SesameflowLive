<?php
/**
 * @version			1.0
 * @package			Administration
 * @subpackage		configuration
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Xaverie Télédzina <onana_carine@yahoo.fr>
 * @desc			Spécification des droits pour l'accès au fonctinnalités de l'application
 * @creationdate	03 août 2009
 * @updates

 */

 require_once($siteweb->get_document_root().'\classe\application.class.php');
 $siteweb = new Application();
 require_once($siteweb->get_document_root().'\classe\table.class.php');
 
  
class Config extends Table
{
	 
 
   public $typebd;
   public $hotebd;
   public $hotesite;
   public $portsite;
   public $userbd;
   public $pwdbd;
   public $nombd;
   public $uniteduree_process;
   public $uniteduree_circuit;
   public $uniteduree_tache;
   public $listlimit;
   public $notifmail;
   public $creeruser;
   public $creerbd;
   
   public function Config()
   {
   		$this->init();
   }
   
/**
 * fonction de modification d'un département dans la BD
 * @author 	:	Bello Adamou <moustaphbi@yahoo.fr>
 * @return true si modification ok, false sinon
 */
	 public  function modifier()
	 {
	      $bool=false; 
		  $this->exception = "";
					  
		  //initialisation du tableau de paramètres formels et effectifs pour la requête
		  $lparam_type = array();
		  $lparam_data = array();
		  
		 $sql = 'update config set typebd=?, hotebd=?, userbd=?, pwdbd=?, nombd=?
		 ,uniteduree_process = ?
		 ,uniteduree_circuit = ?
		 ,uniteduree_tache = ?
		 , listlimit = ?
		 , notifmail = ?
		 , hotesite = ?
		 , portsite = ?
		 ';
		  $lparam_type[] = "text"; 
		  $lparam_type[] = "text"; 
		  $lparam_type[] = "text"; 
		  $lparam_type[] = "text";
		  $lparam_type[] = "text";
		  $lparam_type[] = "integer";
		  $lparam_type[] = "integer";
		  $lparam_type[] = "integer";
		  $lparam_type[] = "integer";
		  $lparam_type[] = "integer";
		  $lparam_type[] = "text"; 
		  $lparam_type[] = "integer";

		  $this->connect_db();
			   if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
				{
					
					$lparam_data[] = trim($this->typebd);
					$lparam_data[] = trim($this->hotebd);
					$lparam_data[] = trim($this->userbd);
					$lparam_data[] = trim($this->pwdbd);
					$lparam_data[] = trim($this->nombd);
					$lparam_data[] = intval($this->uniteduree_process);
					$lparam_data[] = intval($this->uniteduree_circuit);
					$lparam_data[] = intval($this->uniteduree_tache);
					$lparam_data[] = intval($this->listlimit);
					$lparam_data[] = intval($this->notifmail);
					$lparam_data[] = trim($this->hotesite);
					$lparam_data[] = (trim($this->portsite) != "") ? intval($this->portsite) : 80;
					
					if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
					{
						$bool=true;
					}
					else 
					{
						    $this->exception = "config::modifier() - ".$result-> getDebugInfo() . ' in ' . $sql;
						    $bool = false;
					}
				}
				else 
				{
					$this->exception = "config::modifier() - ".$lprepare-> getDebugInfo() . ' in ' . $sql;
					$bool = false;
				}
			   
		$this->db->disconnect();
		return $bool;
	}


/**
 * fonction qui active/désactive un module
 * @return true si modification ok, false sinon
 */
	 public  function modifier_module()
	 {
	      $bool=false; 
		  $this->exception = "";
					  
		  //initialisation du tableau de paramètres formels et effectifs pour la requête
		  $lparam_type = array();
		  $lparam_data = array();
		  
		 $sql = ' update module set etatmod = ? where codemod = ? ';
		  $lparam_type[] = "integer"; 
		  $lparam_type[] = "text"; 
		       
			   $this->connect_db();
			   if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
				{
					
					$lparam_data[] = intval($this->etatmod);
					$lparam_data[] = trim($this->codemod);
					
					
					if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
					{
						$bool=true;
					}
					else 
					{
						$this->exception = "config::modifier_module() - ".$result-> getDebugInfo() . ' in ' . $sql;
						$bool = false;
					}
				}
				else 
				{
					$this->exception = "config::modifier_module() - ".$lprepare-> getDebugInfo() . ' in ' . $sql;
					$bool = false;
				}
			   
		$this->db->disconnect();
		return $bool;
	}
	
	
 public function ajouter()
 {
		  $bool=false; 
		  $this->exception = "";
		  //initialisation du tableau de paramètres formels et effectifs pour la requête
		  $lparam_type = array();
		  $lparam_data = array();

		  $sql = 'insert into config (typebd , hotebd , userbd, pwdbd , nombd 
	  , uniteduree_process 
	  , uniteduree_circuit 
	  , uniteduree_tache 
	  , listlimit
	  , notifmail
	  , hotesite
	  , portsite
	  , logosite
	  ) values( ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? )';
		  
		  $lparam_type[] = "text"; 
		  $lparam_type[] = "text"; 
		  $lparam_type[] = "text"; 
		  $lparam_type[] = "text";
		  $lparam_type[] = "text";
		  $lparam_type[] = "integer";
		  $lparam_type[] = "integer";
		  $lparam_type[] = "integer";
		  $lparam_type[] = "integer";
		  $lparam_type[] = "integer";
		  $lparam_type[] = "text";
		  $lparam_type[] = "integer";
		  $lparam_type[] = "text";
		  
		  $this->connect_db();
		  
			   if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
				{
					$lparam_data[] = trim($this->typebd);
					$lparam_data[] = trim($this->hotebd);
					$lparam_data[] = trim($this->userbd);
					$lparam_data[] = trim($this->pwdbd);
					$lparam_data[] = trim($this->nombd);
					$lparam_data[] = intval($this->uniteduree_process);
					$lparam_data[] = intval($this->uniteduree_circuit);
					$lparam_data[] = intval($this->uniteduree_tache);
					$lparam_data[] = intval($this->listlimit);
					$lparam_data[] = intval($this->notifmail);
					$lparam_data[] = (trim($this->hotesite) != "") ?  trim($this->hotesite) : "localhost";
					$lparam_data[] = (trim($this->portsite) != "") ? intval($this->portsite) : 80;
					$lparam_data[] = (trim($this->logosite) != "") ? trim($this->logosite) : "";

					//die($this->redraw_sql($sql , $lparam_data , $lparam_type));
					
					if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
					{
							$bool = true;
					}
					else 
					{					
						    $this->exception = "config::ajouter() - ".$result-> getDebugInfo() . ' in ' . $sql;
						    $bool=false;
					}
				}
				else 
				{
					$this->exception = "config::ajouter() - ".$lprepare-> getDebugInfo() . ' in ' . $sql;
					$bool=false;
				}
			   	
		$this->db->disconnect();
		return $bool;
}


/**
 * fonction qui charge la configuration depuis la base de données
 *
 * @return true si chargement avec succès, false sinon
 */
	public function charger()
 {
 	  $retvalue = array();
 	  $lparam_data = array();
 	  $lparam_type = array();
	  
	  $req = "select typebd , hotebd , userbd, pwdbd , nombd 
	  , uniteduree_process 
	  , uniteduree_circuit 
	  , uniteduree_tache 
	  , listlimit
	  , notifmail
	  , hotesite
	  , portsite
	  , logosite
	  from config ";
	  $lwhere = "";
	  $land = "";
	  
	   $req .= $lwhere . $land ;
	  //die($this->redraw_sql($req , $lparam_data , $lparam_type ));
	   $this->connect_db();
	   if (! $this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				$lrow = $result->FetchRow();
				
				//Transformer les noms de colonnes en champ de l'objet config en cours
				if (is_array($lrow))
				{
					foreach ($lrow as $lchamp => $lvaleur)
					{
						$this->$lchamp = $lvaleur;
					}
				}
				$retvalue =  true;	//chargement effectué avec succès
				
				//libérer la mémoire
				unset($lchamp);
				unset($lvaleur);
			}
			else 
			{
				$this->exception = "config::charger() - ".$result-> getDebugInfo() . ' in ' . $req;
				$retvalue = false;
			}
		}
		else 
		{
			$this->exception = "config::charger() - ".$lprepare-> getDebugInfo() . ' in ' . $req; 
			$retvalue = false;
		}
	  
		//libérer la mémoire
		unset($lparam_data);
		unset($lparam_type);
		unset($req);
		unset($result);
		
		$this->db->disconnect();
		return $retvalue;
				
 }
 
	public function existe($ptypebd = null)
	{
		$ltypebd = (is_null($ptypebd)) ? $this->typebd : $ptypebd;
			
		$this->exception = "";
		$retvalue = false;
		
		$req = " select * from config  ";
		$lparam_type = array();
		$lparam_data = array();
		
		$this->connect_db();
		//die($this->redraw_sql($req , $lparam_data , $lparam_type));
		if (! $this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				if ($result->valid())  //vérifie s'il ya au moins une ligne dans le résultat
				{
				    if ($obj = $result->FetchRow()) $retvalue = true; 
				}
				else 
				{
					$retvalue = false;
				}
			}
			else 
			{
				$this->exception = "config::existe() - ".$result-> getDebugInfo() . ' in ' . $req;
				$retvalue = false;
			}
		}
		else 
		{
			$this->exception = "config::existe() - ".$lprepare-> getDebugInfo() . ' in ' . $req;
			$retvalue = false;
		}
		$this->db->disconnect();
		
		unset($lprepare);
		unset($result);
		unset($lparam_data);
		unset($lparam_type);
		unset($req);
		unset($ltypebd);
		
		return $retvalue;			
	}
	
 public function get_unite_duree()
 {
 	  $retvalue = array();
	  
	  //initialisation du tableau de paramètres formels
	  $lparam_type = array();
	  //initialisation du tableau de paramètres effectifs pour la requête
	  $lparam_data = array();
	  
	 /* $req = "Select codedroa,libdroa,niveau_accesdroa from droit ";
	  $lwhere = " where not codedroa is null ";
	  */
	  $req = "select uniteduree from config  ";
	  $lwhere = "" ;
	  $land = "";
	  
	 		
	  $req .= $lwhere . $land ;
	  
	  $this->connect_db();
	   if (! $this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				$lrow = $result->FetchRow();
				$this->uniteduree = $lrow["uniteduree"];
				
				$retvalue =  true;	//chargement effectué avec succès
				
				//libérer la mémoire
				unset($lchamp);
				unset($lvaleur);
			}
			
	  
		//libérer la mémoire
		unset($lparam_data);
		unset($lparam_type);
		unset($req);
		unset($result);
		
		$this->db->disconnect();
		return $retvalue;
				
 	  }
 }
 
public function rechercher()
 {
 	  $retvalue = array();
	  
	  //initialisation du tableau de paramètres formels
	  $lparam_type = array();
	  //initialisation du tableau de paramètres effectifs pour la requête
	  $lparam_data = array();

	  $lselect = "";
	  $lfrom = "";
	  $lwhere = "" ;
	  $land = "";
	  
	  if ((trim($this->module) != "") && ($this->module == true))
	  {	//recherche des modules uniquement
	  	$lselect = " select codemod, libmod, etatmod ";
	  	$lfrom = " from module ";
	  }
	 		
	  $req = $lselect. $lfrom . $lwhere . $land ;
	  
	  $this->connect_db();
	   if (! $this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				if ($result->valid())  //vérifie s'il ya au moins une ligne dans le résultat
				{
					$retvalue =  $result->FetchAll();
				}
			}
			else 
			{
				$this->exception = "Config::rechercher() - ".$result-> getDebugInfo() . ' in ' . $req;
				$retvalue = null;
			}
		}
		else 
		{
			$this->exception = "Config::rechercher() - ".$lprepare-> getDebugInfo() . ' in ' . $req;
			$retvalue = null;
		}
		
			
	  
		//libérer la mémoire
		unset($lparam_data);
		unset($lparam_type);
		unset($req);
		unset($result);
		
		$this->db->disconnect();
		return $retvalue;
				
 	  }
 	  
	/**
	 * enregistre la configuration dans un fichier texte
	 *
	 */
	function set_configuration($pcontenu = null)
	{
		global $siteweb;
		
		$lretval=false;
		//enregistrer la configuration dans un fichier texte
			//a-t-on le droit d'écriture dans le disque dur ?
			if (!is_writable($siteweb->get_document_root().DS."administration"))
			{
				//non, se donner les droits d'écriture
				@chmod($siteweb->get_document_root().DS."administration", 0777);
			}
			
			
			//Le mode par défaut est le mode 0777, ce qui correspond au maximum de droits possible.
			$lfilename = $siteweb->get_document_root().DS."administration".DS."config.txt";
			//supprimer ce fichier s'il existe déjà
			if (file_exists($lfilename))
			unlink($siteweb->get_document_root().DS."administration".DS."config.txt");			
			
			//l'ouvrir en mode création
			// mode x+ : Crée et ouvre le fichier en lecture et écriture ;
			$lfile =fopen($siteweb->get_document_root().DS."administration".DS."config.txt",'x+');
			if ($lfile)
			{
				$lcontenu = $pcontenu;
				
				fwrite($lfile,$lcontenu,strlen($lcontenu));
				fclose($lfile);
				
				$lretval=true;
			}
			
			return $lretval;
	}
	/**
	 * fonction qui créer un fichier de configuration texte
	 *
	 * @param string - $pcontenu - contenu du fichier de configuration
	 * @return true si création vec succès, false sinon
	 */
	function set_configurationi($pcontenu = null)
	{
		global $siteweb;
		$lretval=false;
		//enregistrer la configuration dans un fichier texte
			//a-t-on le droit d'écriture dans le disque dur ?
			if (!is_writable($siteweb->get_document_root().DS."administration"))
			{
				//non, se donner les droits d'écriture
				@chmod($siteweb->get_document_root().DS."administration", 0777);
			}
			
			
			//Le mode par défaut est le mode 0777, ce qui correspond au maximum de droits possible.
			$lfilename = $siteweb->get_document_root().DS."administration".DS."config.txt";
			//supprimer ce fichier s'il existe déjà
			if (file_exists($lfilename)){
			unlink($lfilename);
			}		
			
			//l'ouvrir en mode création
			// mode x+ : Crée et ouvre le fichier en lecture et écriture ;
			$lfile =fopen($siteweb->get_document_root().DS."administration".DS."config.txt",'x+');
			
			if ($lfile)
			{
				if (trim($pcontenu) != "")
				{
					//fabriquer le buffer
					
					$lcontenu  = "[sesameflow]"."\n" ;
					$lcontenu .= "typebd=".$this->typebd."\n";
					$lcontenu .= "hotebd=".$this->hotebd."\n";
					$lcontenu .= "userbd=".$this->userbd."\n";
					$lcontenu .= "pwdbd=".$this->pwdbd."\n";
					$lcontenu .= "nombd=".$this->nombd."\n";
					$lcontenu .= "hotesite=".$this->hotesite."\n";
					$lcontenu .= "portsite=".$this->portsite."\n";
					$lcontenu .= "listlimit=5"."\n";
					$lcontenu .= "uniteduree_process=0"."\n";
					$lcontenu .= "uniteduree_circuit=0"."\n";
					$lcontenu .= "uniteduree_tache=0"."\n";
					$lcontenu .= "notifmail=0"."\n";
					
					$lcontenu  .= "\n" ;
					
					$lcontenu  .= "[ged]"."\n" ;
					$lcontenu  .= "active=1"."\n" ;
					
					$lcontenu  .= "\n" ;
					
					$lcontenu  .= "[mail]"."\n" ;
					$lcontenu  .= "active=1"."\n" ;
					
					
				}
				else $lcontenu = $pcontenu;
				
				fwrite($lfile,$lcontenu,strlen($lcontenu));
				fclose($lfile);
				$lretval=true;
			}
			
			return $lretval;
	}
	
	 public function connect_server()
	{
		$lretval = false;
		
		$f = @fsockopen($this->hotesite ,    # the host of the server
                                     $this->portsite,    # the port to use
                                     $errno	,
                                     $errstr,
                                     $timeout = 1
                               );   
		if ($f) 
		{	
			$lretval = true;
		}
		else {
			echo "ERREUR :"."$errno". "-" . "$errstr<br />\n";			
			$lretval = false;
		}
		
		return $lretval;
	}
	 	  
 }
 
 
?>

