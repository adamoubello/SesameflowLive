<?php
/**
 * @version			1.0
 * @package			Utilisateur
 * @subpackage		Utilisateur
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello<@yahoo.fr> 
 * @desc			script de prétraitements pour le formulaire de création d'un utilisateur
 * 					
 * @creationdate	????
 * @updates
 */
   
	$data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
		$data[$lkey] = $lvalue;
	}
   
   //obtenir le séparateur de dossier pour la OS en cours
   if (! defined("DS")) define( 'DS', DIRECTORY_SEPARATOR );
  
	  
	   $lang = $data["lang"];
	   $codegroup = $data["codegroup"];
	   $codeprofil = $data["codeprofil"];
	   $codedep = $data["codedep"];
	   
	   
	   if (trim($lang=="")) 
	   { $lang="fr";}
	   $chemin = dirname(__FILE__);
		$chemin = str_replace("".DS."utilisateur".DS."traitements","",$chemin);
	   require_once($chemin.DS."classe".DS."application.class.php");	
		
	   $siteweb = new Application();


   		ini_set('include_path', $siteweb->get_document_root().DS.'includes'.DS.'pear');	//charger les packages de PEAR::MDB2
		require_once($siteweb->get_document_root().DS."utilisateur".DS."classe".DS."utilisateur.class.php");
	
	   $user = new utilisateur ();
	   $user->codeuser = $user->generer_numero();

	   	//avoir la liste des profil du système
		require_once($siteweb->get_document_root().DS."utilisateur".DS."classe".DS."profi.class.php");
	    $lprofil= new profil ();
	   	$lprofil->listeprofil = $lprofil->rechercher();
		$select_profil = $lprofil->liste_deroulante(array("id" => "codeprofil" , "name" => "codeprofil") , $codeprofil , ucfirst($translate["choisissez"]));	   	
   	
		//avoir la liste des groupes du système
		require_once($siteweb->get_document_root().DS."utilisateur".DS."classe".DS."groupe.class.php");
	   $lgroupe= new groupe ();
	   $lgroupe->listegroupe = $lgroupe->rechercher();
	   if ($lgroupe->has_exception())
	    die($lgroupe->exception);
		$select_groupe = $lgroupe->liste_deroulante(array("id" => "codegroup" , "name" => "codegroup") , $codegroup , ucfirst($translate["choisissez"]));	   	
   	
		//avoir la liste des départements du système 
		require_once($siteweb->get_document_root().DS."utilisateur".DS."classe".DS."departement.class.php"); 
	   $ldep = new departement(); 
	   	$ldep->listedep = $ldep->rechercher();
	   	if ($ldep->has_exception()) die($ldep->exception);
		$select_departement = $ldep->liste_deroulante(array("id" => "codedep" , "name" => "codedep") , $codedep , ucfirst($translate["choisissez"]));	   	
   	
		global $siteweb , $user;
   		   
   		   //libérer la mémoire
   		   unset($lprofil);
   		   unset($lgroupe);
   		   unset($ldep);
?>