<?php
/**
 * @version			1.0
 * @package			Administration
 * @subpackage		Droit
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			patrick mveng<patrick.mveng@interfacesa.local>  
 * @desc			Controlleur général du module Administration
 * @creationdate	06 juillet 2009
 * @updates

 */

   	$data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
		$data[$lkey] = $lvalue;
	}
 
  	$codegroup = (isset($data["codegroup"])) ? (! is_null($data["codegroup"])) ? $data["codegroup"] : "" : "";
	$login = (isset($data["login"])) ? (! is_null($data["login"])) ? $data["login"] : "" : "";
	$do = (isset($data["do"])) ? (! is_null($data["do"])) ? $data["do"] : "accueil" : "accueil";
	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";


     //obtenir le séparateur de dossier pour la OS en cours
   if (! defined("DS")) define( 'DS', DIRECTORY_SEPARATOR );
	
    $chemin = dirname(__FILE__);
    $chemin = str_replace(DS."administration".DS."traitements","",$chemin);
	require_once($chemin.DS.'classe'.DS.'application.class.php');	
    $siteweb = new Application();


   	//controle des permissions de l'utilisateur en cours
	//si pas de controle, il y aura redirection vers la page précédente.
	//$siteweb->control_permission($login , $lang , $do , $ajax , $state);

   
  switch (trim($do))
  {
	case "droit_update_valid" ://définie dans sesameflow/utilisateur/page/groupe_view.php 
		require_once($siteweb->get_document_root().DS."administration".DS."traitements".DS."tdroit_update_valid.php");
		//redirection vers la fiche de consultation d'un groupe
		echo $siteweb->redirection($siteweb->get_url()."/gabarit/page.gabarit.php",
		array( "lang" => $lang ,  "do" => "groupe_view" , "login" => $login , "codegroup" => $codegroup) , true);
		break; 
		 	  
  	case "config_view" ://définie dans sesameflow/traitement/menu_droite.php
		require_once($siteweb->get_document_root().DS."administration".DS."traitements".DS."tconfig_view.php");
		require_once($siteweb->get_document_root().DS."administration".DS."page".DS."config_view.php");
		break;
	case "config_update_valid" ://définie dans sesameflow/administration/page/config_view.php  
		require_once($siteweb->get_document_root().DS."administration".DS."traitements".DS."tconfig_update_valid.php");
		break;
		
	case "paie_param" : 
		require_once($siteweb->get_document_root().DS."administration".DS."traitements".DS."tpaie_param.php");
		require_once($siteweb->get_document_root().DS."administration".DS."page".DS."paie_param.php");
		break;
	case "paie_param_update" ://appelée dans sesaameflow/paie_param.php
		require_once($siteweb->get_document_root().DS."administration".DS."traitements".DS."tmodule_update_valid.php");
		break;
		
	case "rh_param" :
		require_once($siteweb->get_document_root().DS."administration".DS."traitements".DS."trh_param.php");
		require_once($siteweb->get_document_root().DS."administration".DS."page".DS."rh_param.php");
		break;
	case "rh_param_update" :
		require_once($siteweb->get_document_root().DS."administration".DS."traitements".DS."tmodule_update_valid.php");
		break;
  }

?>