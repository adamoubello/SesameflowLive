<?php

/**
 * @version			1.0
 * @package			Workflow
 * @subpackage		Tache
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello
 * @desc			Spécification d'une tâche du système de workflow
 * @creationdate	????
 * @updates
 * 	# samedi 20 juin 2009 (Patrick Mveng)
 * 		- suppression de la fonction init()
 */

 $siteweb = new Application();
 require_once($siteweb->get_document_root().'\classe\table.class.php');

class tache extends Table
{		
	/**
	 * numéro d'une tache. Générer automatiquement par l'application
	 * @access 		:	public
	 * @var integer
	 */
	public  $numtache;	
	
	/**
	 * libellé d'une tache.
	 * @access 		:	public
	 * @var string
	 */
	public  $libtache;	
	
	/**
	 * durée d'une tache. 
	 * @access 		:	public
	 * @var integer
	 */
	public  $dureetache;	
	
	/**
	 * code du circuit dans lequel la tache intervient.
	 * @access 		:	public
	 * @var integer
	 */
	public  $codecircuit;	
	
	/**
	 * code du profil de l'acteur ayant le droit d'effectuer la tache.
	 * @access 		:	public
	 * @var integer	- si pas de profil pour la tache en cours, on met NULL dans la base de données
	 * 
	 */
	public  $codeprofil;	
	
	/**
	 * code de l'utilisateur ayant le droit d'effectuer la tache.
	 * @access 		:	public
	 * @var integer	- si pas d'utiisateur pour la tache en cours, on met NULL dans la base de données
	 * 
	 */
	public  $codeuser;	

	
	/**
	 * numéro de la tache précédent la tâche en cours.
	 * @access 		:	public
	 * @var integer
	 */
	public  $numtacheprec;	
	
	/**
	 * numéro du processus auquel la tache appartient.
	 * @access 		:	public
	 * @var integer
	 */
	public  $numprocessus;	
	
	/**
	 * numéro de la tache suivante la tâche en cours.
	 * @access 		:	public
	 * @var integer
	 */
	
	/**
	 * etat d'activation du processus auquel appartient une tâche
	 * @access 		:	public
	 * @var integer = 1, si processus activé , 0 si désactivé
	 */
	public $etatprocessus;
	
	/**
	 * définit si une tache est initiale ou non
	 * @access 		:	public
	 * @var boolean = true, si initiale , false sinon
	 */
	public $est_initiale;

	
	public  $numtachesuiv;	
	
	/**
	 * définit si une tache est terminale ou non
	 * @access 		:	public
	 * @var boolean = true, si terminale , false sinon
	 */
	public $est_terminale;
	
	/**
	 * définit les paramètres de l'url pour lancer une tache
	 * @access 		:	public
	 * @var string
	 */
	public $typedoc;
	
	public $archivewf;
	
	
	function __construct()
	{
		parent::init();
		$this->codecircuit = null;
		$this->etatprocessus = null;
		$this->est_initiale = null;
		$this->est_terminale = null;
		$this->archivewf = null;
	}
	
	/**
	 * *accesseurs
	 */
	
	/**
	 * Enter description here...
	 *
	 * @return unknown
	 */
	public function est_initiale(){return $this->est_initiale;}
	public function est_terminale(){return $this->est_terminale;}
	
	
	/**
	 * modificateurs
	 */
	public function set_terminale($petat = null){$this->est_terminale = $petat;}
	public function set_initiale($petat = null){$this->est_initiale = $petat;}
	
	/**
	 * fonction de génération d'un nouveau numéro de tâche
 	 * @access 		:	public
	 * @author 		:	patrick mveng<patrick.mveng@interfacesa.local>
	 * @param 		:	boolean - $psysteme - définit si la tache est système ou non
	 * 					Une tache système est une tache prédéfinie et réutilisable dans plusieurs procsssus. Leur numtache est < -1
	 * @return -1 si erreur, sinon un nouveau numéro entier
	 */
	public function generer_numero($psysteme = false)
	{	
		$this->exception = "";
		$retvalue = -1;
		$lparam_type = array();
		$lparam_data = array();
		
		if ($psysteme == true)  $func = "min";
		else $func = "max";
		$req = " select {$func}(numtache) as code_max from tache ";		
		
		$this->connect_db();
		if (! $this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{			
				if ($result->valid())  //vérifie s'il ya au moins une ligne dans le résultat
				{
					$obj2 = $result->FetchRow();
					if ($psysteme == true)  $retvalue = $obj2["code_max"] - 1;
					else 
					{
						//les numéros des tâches non système doivent toujours être strictement positif
						if (intval($obj2["code_max"]) < 0) $obj2["code_max"] = 0;
						$retvalue = $obj2["code_max"] + 1;	
					}
				}
				else 
				{
					$retvalue = -1;
				}
			}
			else 
			{
				$this->exception = "tache::generer_numero() - ".$result->getDebugInfo() . ' in ' . $req;
				$retvalue = -1;
			}
		}
		else 
		{
			$this->exception = "tache::generer_numero() - ".$lprepare->getDebugInfo() . ' in ' . $req;
			$retvalue = -1;
		}
		$this->db->disconnect();
		
		unset($lprepare);
		unset($result);
		unset($lparam_data);
		unset($lparam_type);
		unset($lsql);
		unset($Found);
		unset($lCode);
		unset($i);
		unset($max);
		
		return $retvalue;	
		
	}
	
	/**
	 * fonction qui retourne une liste déroulante des taches
	 * @author 	:	patrick mveng<patrick.mveng@interfacesa.local>
	 * @param array $pattributes	- attributs de la balise select
	 * @param string $pdefault - valeur de l'option à afficher par défaut
	 * @param string -  $pchoisissez - message
	 * @return string - code HTML de la liste déroulante
	 */
	function liste_deroulante($pattributes , $pdefault = null , $pchoisissez = null)
	{
		global $translate;
		
		$this->exception = "";
		
		$list = $this->select_ouvrante_tag($pattributes);
		$list .= "<option value=\"\">$pchoisissez</option>\n";
		if (! is_null($this->listetache))
		{
			foreach($this->listetache as $obj)
			{
				if (trim($obj["libtache"]) != "")
				{
					$list .= "<option value=\"".$obj['numtache']."\"";
					if ((trim(strval($pdefault)) == trim(strval($obj['numtache'])) ))
					{
						$list .= " selected";
					}
					$list .= ">".$obj["libtache"]."</option>\n";
				}
			}
		}
		$list .= "</select>\n";
		
		//libérer la mémoire
		unset($obj);
		
		return $list;
	}
	

/**
 * fonction de modification d'une tâche dans la BD
 * @author 	:	patrick mveng<patrick.mveng@interfacesa.local>
 * @return true si modification ok, false sinon
 */
	 public function modifier()
	 {
	      $bool=false; 
		  $this->exception = "";
					  
		  //initialisation du tableau de paramètres formels et effectifs pour la requête
		  $lparam_type = array();
		  $lparam_data = array();
		  
		 $lparam_type[] = "text"; 
		 $lparam_type[] = "integer"; 
		 $lparam_type[] = "integer"; 
		 $lparam_type[] = "text"; 
  	     $lparam_type[] = "integer"; 
  	        
		 $sql = 'update tache set libtache =  ? , dureetache = ? , numprocessus = ? , typedoc = ? where numtache = ? ';
		       
			   $this->connect_db();
			   if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
				{
					
					$lparam_data[] = htmlentities(trim($this->libtache));
					$lparam_data[] = ($this->dureetache);
					$lparam_data[] = ($this->numprocessus);
					$lparam_data[] = trim($this->typedoc);
					$lparam_data[] = intval($this->numtache);
					
					//die($this->redraw_sql($sql  , $lparam_data , $lparam_type));
					
					if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
					{
						$bool=true;
					}
					else 
					{
						    $this->exception = "tache::modifier() - ".$result->getDebugInfo() . ' in ' . $sql;
						    $bool = false;
					}
				}
				else 
				{
					$this->exception = "tache::modifier() - ".$lprepare->getDebugInfo() . ' in ' . $sql;
					$bool = false;
				}
			   
		$this->db->disconnect();
		return $bool;
	}


	/**
	 * fonction de recherche des taches dans la base de données suivant certains critères. les critères de recheche sont passés dans 
	 * les attributs de la classe en cours
	 *
	 * @param 	string $this->codecircuit - avec ce critère, on retourne toutes les tâches appartenat à un circuit. Avec ce critère, on
	 * 			vide l'ancienne requete $req et on créé une nouvelle requete qui fait à partir de la table circuit_tache , des inner join sur tache, processus , circuit 
	 * 			et des outer join sur profil , utilisateur, tache as tachprec , tache as tachsuiv
	 * 			boolean - est_initiale - critère qui permet de retourner les tâches initiales d'un circuit. 
	 * 			Une tâche initiale lorsque sa tache précédente dans un circuit est NULL
	 * 			Une tâche est terminale lorsque sa tâche suivante dans un circuit est NULL
	 * @return Array si exécution aec succès, false sinon. Dans ce dernier cas, $this->exception contient le message d'erreur
	 * 
	 */
 public function rechercher()
 {
 	  $retvalue = array();
	  $lselect = " select t.numtache,t.libtache,t.dureetache, t.numprocessus , t.typedoc
	  , P.libprocessus ";
	  $lfrom = "
	  from tache t
	  inner join processus P on t.numprocessus = P.numprocessus "; 
	  $lwhere= " where not t.numtache is null ";
	  $land = "";
	 
	  //initialisation du tableau de paramètres formels et effectifs pour la requête
	  $lparam_type = array();
	  $lparam_data = array();
	  
	  if (trim($this->est_initiale) != "")
	  {
		$lselect = "select P.numprocessus , P.libprocessus , circ.codecircuit , circ.libcircuit	, t.numtache , t.libtache , t.typedoc ";
        
		$lfrom = " from processus P
	  	left outer join circuit circ on P.numprocessus = circ.numprocessus
		inner join circuit_tache ct on circ.codecircuit = ct.codecircuit
		inner join tache t on ct.numtache = t.numtache ";
	  	
	  	$lwhere  = " where (not t.numtache is null) ";
	  	$land .= " and ct.numtacheprec is null ";
	  	
	  }
	  
  	  if (trim($this->codecircuit) != "")
	  {
	  	$lselect = " select ct.numtache, t.libtache, ct.codecircuit ,  t.dureetache , circ.libcircuit
	  	,ct.codeprofil"
	  	.", prof.libprofil , user.nomuser , user.prenomuser "
	  	.", ct.codeuser 
	  	, ct.numtacheprec , tachprec.libtache as libtacheprec
	  	, ct.numtachesuiv , tachsuiv.libtache as libtachesuiv
	  	, t.numprocessus , P.libprocessus 
	  	 ";
	  	
	  	$lfrom = "
	  from circuit_tache ct
	  inner join tache t on ct.numtache = t.numtache
	  inner join processus P on t.numprocessus = P.numprocessus
	  inner join circuit circ on  ct.codecircuit = circ.codecircuit
	  left outer join profil prof on (ct.codeprofil = prof.codeprofil)
	  left outer join utilisateur user on ( ct.codeuser = user.codeuser)
	  left outer join tache tachprec on ct.numtacheprec = tachprec.numtache
	  left outer join tache tachsuiv on ct.numtachesuiv = tachsuiv.numtache "; 

	  	$lwhere = " where ct.codecircuit = ? " ;
	  	$land = "" ;
	  	$lparam_type[] = "integer";
	  	$lparam_data[] = intval($this->codecircuit);
	  	
	  }
	  
	  if (trim($this->loginuser) != "")
	  {
	  	$lfrom .= " inner join utilisateur u on ( ct.codeuser = u.codeuser or ct.codeprofil = u.codeprofil  or ct.codeuser = -2   or ct.codeprofil = -2 ) ";
	  	$land .= " and u.loginuser = ? " ;
	  	$lparam_type[] = "text";
	  	$lparam_data[] = trim($this->loginuser);
	  }
	  
  	  if ( (trim($this->mestaches) != "") && ($this->mestaches == true))	//obtenir la liste des mes tâches
	  {
	  	$lselect = " select ct.numtache, t.libtache, ct.codecircuit ,  t.dureetache , circ.libcircuit
	  	,ct.codeprofil, prof.libprofil
	  	, ct.codeuser , user.nomuser , user.prenomuser
	  	, ct.numtacheprec , tachprec.libtache as libtacheprec
	  	, ct.numtachesuiv , tachsuiv.libtache as libtachesuiv
	  	, t.numprocessus , P.libprocessus 
	  	, w.datedebutwf , w.heuredebutwf , w.numdoc , w.numworkflow
	  	, doc.titredoc , doc.typedoc ";
	  	
	  	$lfrom = "
	  from circuit_tache ct
	  inner join tache t on ct.numtache = t.numtache
	  inner join processus P on t.numprocessus = P.numprocessus
	  inner join circuit circ on  ct.codecircuit = circ.codecircuit
	  left outer join profil prof on ct.codeprofil = prof.codeprofil
	  left outer join utilisateur user on ct.codeuser = user.codeuser
	  left outer join tache tachprec on ct.numtacheprec = tachprec.numtache
	  left outer join tache tachsuiv on ct.numtachesuiv = tachsuiv.numtache
	  inner join workflow w on ct.codecircuit = w.codecircuit and ct.numtache = w.numtache ";
	  
	  if (trim($this->archivewf) != "")
	  {
	  	$lfrom .= " and w.archivewf = ". intval($this->archivewf);
	  }	
		  
		$lfrom .= " left outer join document doc on w.numdoc = doc.numdoc "; 

	  	$lwhere = " where ct.codeuser = ? or ct.codeprofil = ? " ;
	  	$land = "  " ;
	  	$lparam_type[] = "integer";
	  	$lparam_type[] = "integer";
	  	$lparam_data[] = intval($this->codeuser);
	  	$lparam_data[] = intval($this->codeprofil);
	  	
	  }
	  
	  if (trim($this->numtache) != "")
	  {
	  	$land .= " and t.numtache = ? ";
	  	$lparam_data[] = intval($this->numtache);
	  	$lparam_type[] = "integer"; 
	  	
	  }
	  
	  
	  if (trim($this->numtacheprec) != "")
	  {
	  	$land .= " and ct.numtacheprec = ? ";
	  	$lparam_data[] = intval($this->numtacheprec);
	  	$lparam_type[] = "integer"; 
	  	
	  }
	  
	  if ( (trim($this->predefinie) != "") && ($this->predefinie) == true)	//obtenir la liste des tâches prédéfinies
	  {
	  $land .= " and t.numtache < 0 ";
	  }
	  
  	  

	  
	  if (trim($this->libtache) != "")
	  {
	  	switch(intval($this->sel_option_libtache))
		{   
			case 0:	//cas "commencant par "
				$land .= " and libtache like '" . $this->libtache . "%'";
				break;
			case 1:	//cas "contient "
				$land .= " and libtache like '%" . $this->libtache . "%'";
				break;				
			case 3:	//cas "finissant par "
			  	$land .= " and libtache like '%" . $this->libtache . "'";
				break;
			case 4:	//cas "est égal à"
				$land .= " and libtache = '" . $this->libtache . "'";			
				break;
		}
	  }
	  
	  if (trim($this->dureetache) != "")
	  {
	  	switch(intval($this->sel_option_dureetache))
		{
			case 0:	//cas "est égal à"
				  	$land .= " and t.dureetache = " . intval($this->dureetache) ;
				break;
			case 1:	//cas "supérieure ou égale à "
				  	$land .= " and t.dureetache >= " . intval($this->dureetache) ;
				break;				
			case 2:	//cas "inférieure ou égale à "
			  	$land .= " and t.dureetache <= " . intval($this->dureetache) ;
				break;
		}
	  }
	  
  	  if (trim($this->numprocessus) != "")
	  {
	  	$land .= " and t.numprocessus = ? ";
	  	$lparam_type[] = "integer";
	  	$lparam_data[] = intval($this->numprocessus);
	  }
	  
	  if (trim($this->etatprocessus) != "")
	  {
	  	$land .= " and P.etatprocessus = ? ";
	  	$lparam_type[] = "integer";
	  	$lparam_data[] = intval($this->etatprocessus);
	  }  

	  $req = $lselect . $lfrom;
	  $req .= $lwhere . $land ;
	  //die($this->redraw_sql($req , $lparam_data , $lparam_type));
	  $this->connect_db();
	  
	  if (! $this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				if ($result->valid())  //vérifie s'il ya au moins une ligne dans le résultat
				{
					$retvalue =  $result->FetchAll();
				}
				else 
				{
					$retvalue = null; 
				}
			}
			else 
			{
				$this->exception = "tache::rechercher() - ".$result->getDebugInfo() . ' in ' . $req;
				$retvalue = null;
			}
		}
		else 
		{
			$this->exception = "tache::rechercher() - ".$lprepare->getDebugInfo() . ' in ' . $req;
			$retvalue = null;
		}
		$this->db->disconnect();
		return $retvalue;			
 }

 /**
  * fonction qui ajoute une tâche dans la BD
  *
  * @return unknown
  */
 public function ajouter()
 {
      $bool=false; 
 	  $this->exception = "";
	  
	  //initialisation du tableau de paramètres formels et effectifs pour la requête
	  $lparam_type = array();
	  $lparam_data = array();

		 $sql = 'insert into tache values( ? , ?, ? , ? , ?)';
		 $lparam_type[] = "integer"; 
		 $lparam_type[] = "text"; 
		 $lparam_type[] = "integer"; 
		 $lparam_type[] = "integer"; 
		 $lparam_type[] = "text"; 
		 
		       $this->connect_db();
			   if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
				{
					
					$lparam_data[] = intval($this->numtache);
					$lparam_data[] = trim($this->libtache);
					$lparam_data[] =  (trim($this->dureetache) == "") ? "NULL" : $this->dureetache;
					$lparam_data[] = (trim($this->numprocessus) == "") ? "NULL" : intval($this->numprocessus);
					$lparam_data[] = trim($this->typedoc);
					
			       //die($this->redraw_sql($sql , $lparam_data , $lparam_type));
					
					if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
					{
							$bool = true;
					}
					else 
					{
						    $this->exception = "tache::ajouter() - ".$result->getDebugInfo() . ' in ' . $sql;
						    $bool=false;
					}
				}
				else 
				{
					$this->exception = "tache::ajouter() - ".$lprepare->getDebugInfo() . ' in ' . $sql;
					$bool=false;
				}
			   	
		$this->db->disconnect();
		return $bool;
}

public function charger()
 {
 	  $retvalue = array();
 	  $lparam_data = array();
 	  $lparam_type = array();
	  
	  $req = "select numtache,libtache,dureetache,t.numprocessus , t.typedoc
	  , p.libprocessus
	  from tache t
	  inner join processus p on t.numprocessus = p.numprocessus ";
	  $lwhere = " where (not numtache is null ) ";
	  $land = "";
	  
	  //$land .= " and numtache = '" . $this->numtache . "'";
	  if (trim($this->numtache) != "")
	  {
	  	$land .= " and numtache = ? ";
	  	$lparam_type[] = "integer";
	  	$lparam_data[] = $this->numtache;	
	  }		
	  	 		
	   $req .= $lwhere . $land ;
	  //die($this->redraw_sql($req , $lparam_data , $lparam_type ));
	   $this->connect_db();
	   if (! $this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				$lrow = $result->FetchRow();
				
				//Transformer les noms de colonnes en champ de l'objet processus en cours
				foreach ($lrow as $lchamp => $lvaleur)
				{
					$this->$lchamp = $lvaleur;
				}
				/*$this->libtache = html_entity_decode($this->libtache);
				die($this->libtache);*/
				$retvalue =  true;	//chargement effectué avec succès
				
				//libérer la mémoire
				unset($lchamp);
				unset($lvaleur);
			}
			else 
			{
				$this->exception = "tache::charger() - ".$result->getDebugInfo() . ' in ' . $req;
				$retvalue = false;
			}
		}
		else 
		{
			$this->exception = "tache::charger() - ".$lprepare->getDebugInfo() . ' in ' . $req; 
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

function sel_option_search($pattributes , $pdefault = null , $pchoisissez = null)
	{
		global $translate;
		$this->exception = "";
		
		$larr_option_search = array();
		$larr_option_search[] = array("code" => 0 , "value" => $translate['prefixed_by']);
		$larr_option_search[] = array("code" => 1 , "value" => $translate['contient']);
		$larr_option_search[] = array("code" => 3 , "value" => $translate['postfixed_by']);
		$larr_option_search[] = array("code" => 4 , "value" => $translate['equals_to']);
				
		$list = $this->select_ouvrante_tag($pattributes);
		$list .= "<option value=\"\">$pchoisissez</option>\n";
		foreach($larr_option_search as $obj)
		{
			$list .= "<option value=\"".$obj['code']."\"";
			if ((trim(strval($pdefault)) == trim(strval($obj['code'])) ))
			{
				$list .= " selected";
			}
			$list .= ">".$obj[value]."</option>\n";
		}
		$list .= "</select>\n";
		
		//libérer la mémoire
		unset($larr_option_search);
		unset($obj);
		
		return $list;
		
	}	
	
	function sel_option_search_entier($pattributes , $pdefault = null , $pchoisissez = null)
	{
		global $translate;
		$this->exception = "";
		
		$larr_option_search = array();
		$larr_option_search[] = array("code" => 0 , "value" => "=");
		$larr_option_search[] = array("code" => 1 , "value" => "<=");
		$larr_option_search[] = array("code" => 2 , "value" => ">=");

		$list = $this->select_ouvrante_tag($pattributes);
		$list .= "<option value=\"\">$pchoisissez</option>\n";
		foreach($larr_option_search as $obj)
		{
			$list .= "<option value=\"".$obj['code']."\"";
			if ((trim(strval($pdefault)) == trim(strval($obj['code'])) ))
			{
				$list .= " selected";
			}
			$list .= ">".$obj[value]."</option>\n";
		}
		$list .= "</select>\n";
		
		//libérer la mémoire
		unset($larr_option_search);
		unset($obj);
		
		return $list;
		
	}	
/*	
	function sel_option_search_processus($pattributes , $pdefault = null , $pchoisissez = null)
	{
		global $translate;
		$this->exception = "";
		
		$larr_option_search = array();
		$larr_option_search[] = array("code" => 0 , "value" => $translate['prefixed_by']);
		$larr_option_search[] = array("code" => 1 , "value" => $translate['contient']);
		$larr_option_search[] = array("code" => 2 , "value" => $translate['postfixed_by']);
		$larr_option_search[] = array("code" => 3 , "value" => $translate['equals_to']);
				
		$list = $this->select_ouvrante_tag($pattributes);
		$list .= "<option value=\"\">$pchoisissez</option>\n";
		foreach($larr_option_search as $obj)
		{
			$list .= "<option value=\"".$obj['code']."\"";
			if ((trim(strval($pdefault)) == trim(strval($obj['code'])) ))
			{
				$list .= " selected";
			}
			$list .= ">".$obj[value]."</option>\n";
		}
		$list .= "</select>\n";
		
		//libérer la mémoire
		unset($larr_option_search);
		unset($obj);
		
		return $list;
	}
*/

	public function supprimer()
	 {
	      $bool=false; 
		  $this->exception = "";
					  
		  //initialisation du tableau de paramètres formels et effectifs pour la requête
		  $lparam_type = array();
		  $lparam_data = array();
		  
		 $lparam_type[] = "integer"; 
  		 $sql = 'delete from tache where numtache = ? ';
		       
		   $this->connect_db();
		   if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
			{
				$lparam_data[] = intval($this->numtache);

				if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
				{
					$bool=true;
				}
				else 
				{
					$this->exception = "tache::supprimer() - ".$result->getDebugInfo() . ' in ' . $sql;
					$bool = false;
				}
			}
			else 
			{
				$this->exception = "tache::supprimer() - ".$lprepare->getDebugInfo() . ' in ' . $sql;
				$bool = false;
			}
			   
		$this->db->disconnect();
		return $bool;
	}
	
public function rechercher_libelletachecourante()
 {   
      $retvalue = array();      
      $this->exception = "";
	  
	  $lselect = " select libtache ";
	  $lfrom = " from tache ";
	  $lwhere = " where (not numtache is null) ";
	  $land = " and numtache = ? ";
	  	  
	  //initialisation du tableau de paramètres formels et effectifs pour la requête
	  $lparam_type = array();
	  $lparam_data = array();
	  
	  $lparam_type[]="integer";	  
	  $lparam_data[]=intval($this->numtache);	  
	  
	  $req = $lselect . $lfrom . $lwhere . $land ;
	  
	  //die($this->redraw_sql($req , $lparam_data , $lparam_type));	  
	  $this->connect_db();
	   if (! $this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				if ($result->valid())  //vérifie s'il ya au moins une ligne dans le résultat
				{
					$retvalue =  $result->FetchAll();	
				}
				else 
				{
					$retvalue = null;
				}
			}
			else 
			{
				$this->exception = "workflow::rechercher_libelletachecourante() - ".$result->getDebugInfo() . ' in ' . $req;
				$retvalue = null;
			}
		}
		else 
		{
			$this->exception = "workflow::rechercher_libelletachecourante() - ".$lprepare->getDebugInfo() . ' in ' . $req;
			$retvalue = null;
		}
	  	$this->db->disconnect();
		return $retvalue;				
 }

	
	
}

?>