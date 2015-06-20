<?php
/**
 * @version			1.0
 * @package			Utilisateur
 * @subpackage		Utilisateur
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello Adamou <moustaphbi@yahoo.fr> 
 * @desc			Controlleur du module Utilisateur. Suivant la valeur du paramètre do, ce contrôlleur pour aiguiller le système 
 * 					vers la page web ou le traitement spécifique
 * @creationdate	20 Juillet 2009
 * @updates
 * 	# mardi 30 juin 2009 by patrick mveng<patrick.mvenng@interfacesa.local>
 * 		- remplacement du paramètre $page par $do
 * 		- intégration de la constante DS
 *  # samedi 25 juillet 2009 by patrick mveng<patrick.mvenng@interfacesa.local>
 * 		- intégration du controle d'accès à une fonctionnalité
 
 */
	session_start();
	$login = $_SESSION["login"];
	$_GET["login"] = $login;

  	$data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
		$data[$lkey] = $lvalue;
	}
	
 	$ajax = (isset($data["ajax"])) ? (! is_null($data["ajax"])) ? $data["ajax"] : 0 : 0;
	$login = (isset($data["login"])) ? (! is_null($data["login"])) ? $data["login"] : "" : "";
	$do = (isset($data["do"])) ? (! is_null($data["do"])) ? $data["do"] : "accueil" : "accueil";
	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";

   //obtenir le séparateur de dossier pour la OS en cours
   if (! defined("DS")) define( 'DS', DIRECTORY_SEPARATOR );
   
    $chemin = dirname(__FILE__);
	$chemin = str_replace(DS."utilisateur".DS."traitements","",$chemin);
	require_once($chemin.DS.'classe'.DS.'application.class.php');	
    $siteweb = new Application();
    
	//controle des permissions de l'utilisateur en cours
	//si pas de controle, il y aura redirection vers la page précédente.
	$siteweb->control_permission($login , $lang , $do , $ajax , $state);
	
  switch (trim($do))

  {
    case "user_search":
	 	echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url()."/utilisateur/js/utilisateur.js"."\"></script>\n";    	
		require_once($siteweb->get_document_root().DS."utilisateur".DS."traitements".DS."tuser_search.php");	
		require_once($siteweb->get_document_root().DS."utilisateur".DS."page".DS."user_search.php");
		break;
    case "user_create" :
		require_once($siteweb->get_document_root().DS."utilisateur".DS."traitements".DS."tuser_create.php");
		require_once($siteweb->get_document_root().DS."utilisateur".DS."page".DS."user_create.php");
		  break;
    case "user_create_valid" :
		require_once($siteweb->get_document_root().DS."utilisateur".DS."traitements".DS."tuser_create_valid.php");
		echo $siteweb->redirection($siteweb->get_url()."/gabarit/page.gabarit.php",
		array( "lang" => $lang ,  "do" => "user_search" , "login" => $login) , true);
		die();
	  break;	
	case "user_update_valid" :
		require_once($siteweb->get_document_root().DS."utilisateur".DS."traitements".DS."tuser_update_valid.php");
		//redirection vers la fiche de consultation des utilisateurs
		echo $siteweb->redirection($siteweb->get_url()."/gabarit/page.gabarit.php",
		array( "lang" => $lang ,  "do" => "user_view" , "login" => $login) , true);
		die();
		break;  
	case "user_delete_valid" :
		require_once($siteweb->get_document_root().DS."utilisateur".DS."traitements".DS."tuser_delete_valid.php");
		//redirection vers la fiche de recherche des utilisateurs
		echo $siteweb->redirection($siteweb->get_url()."/gabarit/page.gabarit.php",
		array( "lang" => $lang ,  "do" => "user_search" , "login" => $login, "state" => $state) , true);
		die();
		break;	
	case "user_view":
	require_once($siteweb->get_document_root().DS."utilisateur".DS."traitements".DS."tuser_view.php");	
	require_once($siteweb->get_document_root().DS."utilisateur".DS."page".DS."user_view.php");
	  break;
	case "user_update":
	require_once($siteweb->get_document_root().DS."utilisateur".DS."traitements".DS."tuser_update.php");	
	require_once($siteweb->get_document_root().DS."utilisateur".DS."page".DS."user_update.php");
	  break;
	case "user_delete":
	require_once($siteweb->get_document_root().DS."utilisateur".DS."traitements".DS."tuser_delete.php");	
	  break;	    		  
	  	  	  
    case "dep_search":
	echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url()."/utilisateur/js/departement.js"."\"></script>\n";    
	require_once($siteweb->get_document_root()."\utilisateur".DS."traitements".DS."tdepartement_search.php");		
	require_once($siteweb->get_document_root()."\utilisateur".DS."page".DS."departement_search.php");
	  break;
    case "dep_create" :
	echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url()."/utilisateur/js/departement.js"."\"></script>\n";
    require_once($siteweb->get_document_root().DS."utilisateur".DS."traitements".DS."tdepartement_create.php");
	require_once($siteweb->get_document_root().DS."utilisateur".DS."page".DS."departement_create.php");
	  break;
    case "dep_create_valid" : 
		require_once($siteweb->get_document_root().DS."utilisateur".DS."traitements".DS."tdepartement_create_valid.php");
		echo $siteweb->redirection($siteweb->get_url()."/gabarit/page.gabarit.php",
		array( "lang" => $lang ,  "do" => "dep_search" , "login" => $login) , true);
		die();
	  break;	
    case "dep_delete_valid" :
		require_once($siteweb->get_document_root().DS."utilisateur".DS."traitements".DS."tdepartement_delete_valid.php");
		//redirection vers la fiche de recherche des tâches
		echo $siteweb->redirection($siteweb->get_url()."/gabarit/page.gabarit.php",
		array( "lang" => $lang ,  "do" => "dep_search" , "login" => $login, "state" => $state) , true);
		die();	    
	case "dep_admin_view" :
	require_once($siteweb->get_document_root()."\utilisateur\page".DS."dep_admin_view.php");
	  break;  
	case "dep_view_user" :
	require_once($siteweb->get_document_root()."\utilisateur\page".DS."dep_view_user.php");
	  break;  
	case "dep_view":
	require_once($siteweb->get_document_root()."\utilisateur".DS."traitements".DS."tdepartement_view.php");	
	require_once($siteweb->get_document_root()."\utilisateur\page".DS."departement_view.php");
	  break;
	case "dep_update":
	require_once($siteweb->get_document_root()."\utilisateur".DS."traitements".DS."tdep_update.php");	
	require_once($siteweb->get_document_root()."\utilisateur\page".DS."dep_update.php");
	  break;
	case "dep_update_valid" :
		require_once($siteweb->get_document_root().DS."utilisateur".DS."traitements".DS."tdepartement_update_valid.php");
		//redirection vers la fiche de consultation des processus
		echo $siteweb->redirection($siteweb->get_url()."/gabarit/page.gabarit.php",
		array( "lang" => $lang ,  "do" => "dep_view" , "login" => $login) , true);
		die();
		break;  	  
		
	case "workflow_view_user" :
	require_once($siteweb->get_document_root().DS."utilisateur".DS."page".DS."workflow_view_user.php");
	  break;  
	  
    case "groupe_search":
	require_once($siteweb->get_document_root().DS."utilisateur".DS."traitements".DS."tgroupe_search.php");	
	require_once($siteweb->get_document_root().DS."utilisateur".DS."page".DS."groupe_search.php");
		  break;
	case "groupe_create":
	require_once($siteweb->get_document_root().DS."utilisateur".DS."traitements".DS."tgroupe_create.php");	
	require_once($siteweb->get_document_root().DS."utilisateur".DS."page".DS."groupe_create.php");
		  break;	  
   	case "groupe_view":
	require_once($siteweb->get_document_root().DS."utilisateur".DS."traitements".DS."tgroupe_view.php");	
	require_once($siteweb->get_document_root().DS."utilisateur".DS."page".DS."groupe_view.php");
	  break;
	case "groupe_create_valid" :
		require_once($siteweb->get_document_root().DS."utilisateur".DS."traitements".DS."tgroupe_create_valid.php");
		//redirection vers la fiche de recherche des groupes
		echo $siteweb->redirection($siteweb->get_url()."/gabarit/page.gabarit.php",
		array( "lang" => $lang ,  "do" => "groupe_search" , "login" => $login) , true);
		die();
	   /*@ob_end_clean();
	     @ini_set('zlib.output_compression', '0');
		 header ("location : ".$lurl.$lparam_url);*/
	  break;
	case "groupe_update_valid" :
		require_once($siteweb->get_document_root().DS."utilisateur".DS."traitements".DS."tgroupe_update_valid.php");
		//redirection vers la fiche de consultation des groupe
		echo $siteweb->redirection($siteweb->get_url()."/gabarit/page.gabarit.php",
		array( "lang" => $lang ,  "do" => "groupe_view" , "login" => $login) , true);
		die();
		break;  	  
    case "groupe_delete_valid" :
		require_once($siteweb->get_document_root().DS."utilisateur".DS."traitements".DS."tgroupe_delete_valid.php");
		//redirection vers la fiche de recherche des groupe
		echo $siteweb->redirection($siteweb->get_url()."/gabarit/page.gabarit.php",
		array( "lang" => $lang ,  "do" => "groupe_search" , "login" => $login , "state" => $state) , true);
		die();
		break;
	case "profi_view" :
	require_once($siteweb->get_document_root().DS."utilisateur".DS."traitements".DS."tprofil_view.php");
	require_once($siteweb->get_document_root().DS."utilisateur".DS."page".DS."profil_view.php");
	  break;    
    case "profi_search":
	require_once($siteweb->get_document_root().DS."utilisateur".DS."traitements".DS."tprofil_search.php");
	require_once($siteweb->get_document_root().DS."utilisateur".DS."page".DS."profil_search.php");
		  break;
    case "profi_create" :
	require_once($siteweb->get_document_root().DS."utilisateur".DS."traitements".DS."tprofi_create.php");
	require_once($siteweb->get_document_root().DS."utilisateur".DS."page".DS."profil_create.php");
	  break;
	case "profil_create_valid" :
		require_once($siteweb->get_document_root().DS."utilisateur".DS."traitements".DS."tprofil_create_valid.php");
		//redirection vers la fiche de recherche des profils d'utilisateurs
		echo $siteweb->redirection($siteweb->get_url()."/gabarit/page.gabarit.php",
		array( "lang" => $lang ,  "do" => "profi_search" , "login" => $login) , true);
		die();
	case "profil_update_valid" :
		require_once($siteweb->get_document_root().DS."utilisateur".DS."traitements".DS."tprofil_update_valid.php");
		//redirection vers la fiche de consultation des profils
		echo $siteweb->redirection($siteweb->get_url()."/gabarit/page.gabarit.php",
		array( "lang" => $lang ,  "do" => "profi_view" , "login" => $login) , true);
		die();
		break;  	  
    case "profil_delete_valid" :
		require_once($siteweb->get_document_root().DS."utilisateur".DS."traitements".DS."tprofil_delete_valid.php");
		//redirection vers la fiche de recherche des profils
		echo $siteweb->redirection($siteweb->get_url()."/gabarit/page.gabarit.php",
		array( "lang" => $lang ,  "do" => "profi_search" , "login" => $login , "state" => $state) , true);
		die();
		break;
  }

?>