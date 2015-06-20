<?php
/**
 * @version			1.0
 * @package			Workflow
 * @subpackage		Circuit
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			patrick mveng <patrick.mveng@interfacesa.local>
 * @desc			Script pour la modification d'un circuit.Ce script peut être appelé depuis ajax * 
 * @creationdate	27 juin 2009
 * @updates
 */
   
	$data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
		$data[$lkey] = $lvalue;
	}
   
	$ajax = (isset($data["ajax"])) ? (! is_null($data["ajax"])) ? $data["ajax"] : 0 : 0;
	$login = (isset($data["login"])) ? (! is_null($data["login"])) ? $data["login"] : "" : "";
	$do = (isset($data["do"])) ? (! is_null($data["do"])) ? $data["do"] : "accueil_user" : "accueil_user";
	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
	$codecircuit = (isset($data["codecircuit"])) ? (! is_null($data["codecircuit"])) ? $data["codecircuit"] : null : null;
	$nbr_tache = (isset($data["nbr_tache"])) ? (! is_null($data["nbr_tache"])) ? $data["nbr_tache"] : 0 : 0;	
	
    $chemin = dirname(__FILE__);
    //die($chemin);
	$chemin = str_replace("\workflow\\traitements","",$chemin);
    //$passwd = $data["passwd"];
	require_once($chemin.'\classe\application.class.php');	
    $siteweb = new Application();
   
   //obtenir le séparateur de dossier pour la OS en cours
   if (! defined("DS")) define( 'DS', DIRECTORY_SEPARATOR );
   //chargement des spécifications de la classe processus
   require_once($siteweb->get_document_root().DS."workflow".DS."classe".DS."circuit.class.php");
   require_once($siteweb->get_document_root().DS."workflow".DS."classe".DS."tache.class.php");
   
   //instancier un objet processus
   $lcircuit = new circuit();
   //créer automatiquement attibuts sur l'objet
   foreach ($data as $lattribut => $lvaleur) 
   {
   		$lcircuit->$lattribut = $lvaleur;	
   }
   
   //chargement de PEAR
   ini_set('include_path', $siteweb->get_document_root().'\includes\pear');	//charger les packages de PEAR::MDB2	
   require_once($siteweb->get_document_root().DS.'lang'.DS.'application.'.$lang.'.php');	

   //enregistrer le circuit
   if ($lcircuit->modifier())
   {	
   		//supprimer toutes les taches dans ce circuit
   		if (! $lcircuit->supprimer_tache()) die($lcircuit->get_exception());
   		
   		$larr_tache = array();
	   	$i = 0;
	   	//ajouter les taches du circuits
		$j = 1;
			
	   	while ($i < intval($nbr_tache))
   		{
   			//Ordonner les taches suivant leur position
   			$lposition = $data["sel_tache{$j}"];
   			if (trim($lposition) != "")
   			{
   				$larr_tache[] = array("sel_tache_prec" => $data["sel_tache_prec{$j}"]
   					, "sel_acteur" => $data["sel_acteur{$j}"]
   					, "sel_tache" => $data["sel_tache{$j}"]
   					, "sel_tache_suiv" => ""	/*par défaut, pas de tache suivante */
   				);
   				
   				$i++;
   			}
   			
   			$j++;
   			
   		}	
   		
	   		/*Array ( [lang] => fr [login] => admin [do] => circuit_create_valid [nbr_tache] => 2
	   		[libcircuit] => Demande de congé [dureecircuit] => 7 [numprocessus] => 1 [sel_dep] => [sel_tache_prec] => 5 
	   		[sel_acteur] => 1 [sel_profil] => [sel_tache] => -1 [sel_tache_prec1] => [sel_acteur1] => acteur:1 
	   		[sel_tache1] => 5 [position1] => 1 [sel_tache_prec2] => 5 [sel_acteur2] => acteur:1 [sel_tache2] => -1 [position2] => 2 ) */
	   		
	   		//Affecter les tâches suivantes
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
	   		
	   		/*print_r($larr_tache);
	   		  die();*/
	   		
	   		//Ajouter les tâches du circuit dans la bd
	   		foreach ($larr_tache as $linfo_tache) 
	   		{
	   			$gtache = new tache();
   				$gtache->numtache = $linfo_tache["sel_tache"];
   				
   				//si pas de tache précédente, on va envoyer NULL dans la base de données
   				if (trim($linfo_tache["sel_tache_prec"]) == "")  $gtache->numtacheprec = null;
   				else $gtache->numtacheprec = intval($linfo_tache["sel_tache_prec"]);
   				
   				//si pas de tache suivante, on va envoyer NULL dans la base de données
   				if (trim($linfo_tache["sel_tache_suiv"]) == "")  $gtache->numtachesuiv = null;
   				else $gtache->numtachesuiv = intval($linfo_tache["sel_tache_suiv"]);
   				
   				$gtache->codeuser = -1;
   				$gtache->codeprofil = -1;
   				
   				$larr_acteur = explode(":", trim($linfo_tache["sel_acteur"]));
   				if (trim(strtolower($larr_acteur[0])) == "profil" )  $gtache->codeprofil = $larr_acteur[1];
   				else $gtache->codeuser = $larr_acteur[1];
   				
   				/*//si pas de profil , on va envoyer -1 dans la BD
   				$lacteur = trim($linfo_tache["sel_acteur"]);
   				
   				if (stripos("acteur" , $lacteur) === false );
   				else //if (stripos("acteur" , $lacteur) != -1 )
   				{
   					//oter "acteur:"
   					$lacteur = str_replace("acteur" , "" , $lacteur);
   					$lacteur = str_replace(":" , "" , $lacteur);
   					$lcodeuser = intval($lacteur);   					
   					$lcodeprofil = -1;
   				}
   				
   				if (stripos("profil" , $lacteur) === false );
   				else //if (stripos("profil" , $lacteur) != -1 )
   				{
   					//oter "profil:"
   					$lacteur = str_replace("profil" , "" , $lacteur);
   					$lacteur = str_replace(":" , "" , $lacteur);
   					$lcodeprofil = intval($lacteur);   					
   					$lcodeuser = -1;
   				}
   				
   				$gtache->codeprofil = $lcodeprofil;
   				$gtache->codeuser = $lcodeuser;
*/   				
   				
   				$gtache->codecircuit = $lcircuit->codecircuit;
   				global $gtache;
   				
   				if (! $lcircuit->ajouter_tache())  die($lcircuit->exception);
	   		}

	   	$state = "update_valid_success";	    
   	
   		$lretval = "
			<dt class=\"message\">Message</dt>

			<dd class=\"message message fade\">
				<ul>
					<li>".$translate["update_valid_success"]."</li>
				</ul>
			</dd>";
   }
   else
   {
   		$lretval = "
			<dt class=\"message\">Message</dt>

			<dd class=\"message message error\">
				<ul>
					<li>".$lcircuit->exception."</li>
				</ul>
			</dd>";
   		
   		$state = $lcircuit->exception;	    
   }
   
   if (intval($ajax) == 1) die($lretval);
   
?>
