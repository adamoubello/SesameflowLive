	<?php
/**
 * @version			1.0
 * @package			Workflow
 * @subpackage		Circuit
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			patrick mveng <patrick.mveng@interfacesa.local>
 * @desc			Script pour l'enregistrement d'un circuit à l'étape 1.
 * 
 * @creationdate	samedi 26 juin 2009
 * @updates
 */
   
	$data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
		$data[$lkey] = $lvalue;
	}
   
	$codecircuit = (isset($data["codecircuit"])) ? (! is_null($data["codecircuit"])) ? $data["codecircuit"] : "" : "";
	$login = (isset($data["login"])) ? (! is_null($data["login"])) ? $data["login"] : "" : "";
	$action = (isset($data["action"])) ? (! is_null($data["action"])) ? $data["action"] : "accueil" : "accueil";
	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
	$nbr_tache = (isset($data["nbr_tache"])) ? (! is_null($data["nbr_tache"])) ? $data["nbr_tache"] : 0 : 0;
	
	
	/*
	   		$data = Array ( "lang" => "fr" ,
	   		"login" => "admin" 
	   		,"do" => "circuit_create_valid"
	   		,"nbr_tache" => 2
	   		, "libcircuit" => "Demande de congé"
	   		,"dureecircuit" => 7 
	   		, "numprocessus" => 1
	   		, "sel_dep" => ""
	   		,"sel_tache_prec" => 5
	   		, "sel_acteur" => 1
	   		, "sel_profil" => ""
	   		, "sel_tache" => -1
	   		, "sel_tache_prec1" => ""
	   		, "sel_acteur1" => "acteur:1"
	   		, "sel_tache1" => 5 
	   		, "position1" => 1
	   		, "sel_tache_prec2" => 5
	   		, "sel_acteur2" => "acteur:1"
	   		, "sel_tache2" => -1
	   		, "position2" => 2 );
	   		
	   		$nbr_tache = (isset($data["nbr_tache"])) ? (! is_null($data["nbr_tache"])) ? $data["nbr_tache"] : 0 : 0;
	   		$j = 1;
	   		$i = 0;
	   		while ($i < intval($nbr_tache))
	   		//for($i = 0; $i < $nbr_tache; $i++)
	   		{

	   			//ordonner les taches suivant leur position
	   			$lposition = $data["position{$j}"];
	   			if (trim($lposition) != "")
	   			{
	   				$larr_tache[$lposition] = array("sel_tache_prec" => $data["sel_tache_prec{$j}"]
	   					, "sel_acteur" => $data["sel_acteur{$j}"]
	   					, "sel_profil" => $data["sel_profil{$j}"]
	   					, "sel_tache" => $data["sel_tache{$j}"]
	   				);
	   				
	   				$i++;
	   			}
	   			
	   			$j++;
	   		}
	   		
	   		//ajouter les taches du circuit dans la bd
	   		foreach ($larr_tache as $linfo_tache) 
	   		{
   				$gtache = new tache();
   				$gtache->numtache = $linfo_tache["sel_tache"];
   				if (trim($linfo_tache["sel_tache_prec"]) == "")
   					$gtache->numtacheprec = null;
   				else $gtache->numtacheprec = intval($linfo_tache["sel_tache_prec"]);
   				
   				$gtache->codecircuit = $lcircuit->codecircuit;
   				$lacteur  =  $linfo_tache["sel_acteur"];	// acteur:codeuser/profil:codeprofil 
   				global $gtache;
   				if (! $lcircuit->ajouter_tache())
   					die($lcircuit->exception);
	   		}
	
	*/
	$chemin = dirname(__FILE__);
    //die($chemin);
	$chemin = str_replace(DS."workflow".DS."traitements","",$chemin);
   //$passwd = $data["passwd"];
	require_once($chemin.DS.'classe'.DS.'application.class.php');	
	
   $siteweb = new Application();
   
   //obtenir le séparateur de dossier pour la OS en cours
   if (! defined("DS")) define( 'DS', DIRECTORY_SEPARATOR );
   //chargement des spécifications de la classe processus
   require_once($siteweb->get_document_root().DS."workflow".DS."classe".DS."circuit.class.php");
	//chargement des spécifications de la classe tache
   require_once($siteweb->get_document_root().DS."workflow".DS."classe".DS."tache.class.php");
      
   //instancier un objet circuit
   $lcircuit = new circuit();
   //créer automatiquement attibuts sur l'objet
   foreach ($data as $lattribut => $lvaleur) 
   {
   		$lcircuit->$lattribut = $lvaleur;	
   }

   //chargement de PEAR
  	ini_set('include_path', $siteweb->get_document_root().'\includes\pear');	//charger les packages de PEAR::MDB2	
  
  		foreach ($data as $lchamp => $lvaleur) {
  			$lcircuit->$lchamp = $lvaleur;
  		}
  		//$lcircuit->codecircuit = intval($codecircuit);
  		$lcircuit->codecircuit = $lcircuit->generer_numero();
	   //ajouter le circuit
	   if ($lcircuit->ajouter())
	   {
	   		$state = "circuit_create_valid_success";
	   		
	   		//ajouter les taches du circuits
	   		$j = 1;	//index de lignes dans le tableau
	   		/**
	   		 * s'il y a n tache, cela ne signifie pas que la dernière tache à le numéro n
	   		 */
	   		$larr_tache = array();
	   		$i = 0;
	   		
	   		/*Array ( [lang] => fr [login] => admin [do] => circuit_create_valid [nbr_tache] => 2
	   		[libcircuit] => Demande de congé [dureecircuit] => 7 [numprocessus] => 1 [sel_dep] => [sel_tache_prec] => 5 
	   		[sel_acteur] => 1 [sel_profil] => [sel_tache] => -1 [sel_tache_prec1] => [sel_acteur1] => acteur:1 
	   		[sel_tache1] => 5 [position1] => 1 [sel_tache_prec2] => 5 [sel_acteur2] => acteur:1 [sel_tache2] => -1 [position2] => 2 ) */
	   		
	   		//print_r($data); die();
	   		
	   		while ($i < intval($nbr_tache))
	   		//for($i = 0; $i < $nbr_tache; $i++)
	   		{

	   			//ordonner les taches suivant leur position
	   			$lposition = $data["position{$j}"];
	   			if (trim($lposition) != "")
	   			{
	   				$larr_tache[$lposition] = array("sel_tache_prec" => $data["sel_tache_prec{$j}"]
	   					, "sel_acteur" => $data["sel_acteur{$j}"]
	   					, "sel_profil" => $data["sel_profil{$j}"]
	   					, "sel_tache" => $data["sel_tache{$j}"]
	   				);
	   				
	   				$i++;
	   			}
	   			
	   			$j++;
	   			
	   		}
	   		
	   		//affecter les tâches suivantes
	   		foreach ($larr_tache as $lposition => $linfo_tache) 
	   		{
	   			$lnumtache = $linfo_tache["sel_tache"];
	   			//affecter les tâches suivantes
		   		foreach ($larr_tache as $linfo_tache2) 
		   		{
		   			if (trim($linfo_tache2["sel_tache_prec"]) != "")
		   			{
		   				if (intval($linfo_tache2["sel_tache_prec"]) == intval($lnumtache) )
		   					$larr_tache[$lposition]["sel_tache_suiv"] = $linfo_tache2["sel_tache"];
		   			}
		   		}	
	   		}

	   		//ajouter les taches du circuit dans la bd
	   		foreach ($larr_tache as $linfo_tache) 
	   		{
   				$gtache = new tache();
   				
   				$gtache->numtache = $linfo_tache["sel_tache"];
   				
   				//si pas de tache précédente, on va envoyer NULL dans la base de données
   				if (trim($linfo_tache["sel_tache_prec"]) == "")
   					$gtache->numtacheprec = null;
   				else $gtache->numtacheprec = intval($linfo_tache["sel_tache_prec"]);
   				
   				//si pas de tache suivante, on va envoyer NULL dans la base de données
   				if (trim($linfo_tache["sel_tache_suiv"]) == "")
   					$gtache->numtachesuiv = null;
   				else $gtache->numtachesuiv = intval($linfo_tache["sel_tache_suiv"]);
   				
   				$gtache->codeuser = -1;
   				$gtache->codeprofil = -1;
   				
   				$larr_acteur = explode(":", trim($linfo_tache["sel_acteur"]));
   				if (trim(strtolower($larr_acteur[0])) == "profil" ) $gtache->codeprofil = $larr_acteur[1];
   				else $gtache->codeuser = $larr_acteur[1];
   				
   				$gtache->codecircuit = $lcircuit->codecircuit;
   				global $gtache;
   				if (! $lcircuit->ajouter_tache())
   					die($lcircuit->exception);
	   		}
	   		
	   		$state = "insert_valid_success";	    
	   		
	   }
	   else die($lcircuit->exception);
	   
?>