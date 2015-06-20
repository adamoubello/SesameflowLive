<?php
/**
 * @version			1.0
 * @package			MAIL
 * @subpackage		MAIL
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Raoul<ngambiaraoul@yahoo.fr>
 * @desc			script de prétraitement pour l'affichage de la page de recherche des mails
 * @creationdate	vendredi 24 juillet 2009
 * @updates
 * # Mardi 28 juillet 2009
 *      - ajout de la fonction rechercher(), permettant de faire la recherche sur tous les mails existants
 *      
 */	

	$data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
		$data[$lkey] = $lvalue;
		if (trim($lkey) == "sel_option_etat") $data[$lkey] = array($lvalue);
	}
	
	if (! defined("DS")) define("DS" , DIRECTORY_SEPARATOR);

	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
	$login= (isset($data["login"])) ? (! is_null($data["login"])) ? $data["login"] : null : null;
	$do = (isset($data["do"])) ? (! is_null($data["do"])) ? $data["do"] : "accueil" : "accueil";
	
	$sujet_mail = (isset($data["sujet_mail"])) ? (! is_null($data["sujet_mail"])) ? $data["sujet_mail"] : "" : "";
	$body_mail = (isset($data["body_mail"])) ? (! is_null($data["body_mail"])) ? $data["body_mail"] : "" : "";
	$auteur_mail = (isset($data["auteur_mail"])) ? (! is_null($data["auteur_mail"])) ? $data["auteur_mail"] : "" : "";
	
	$sel_option_etat = (isset($data["sel_option_etat"])) ? (! is_null($data["sel_option_etat"])) ? $data["sel_option_etat"] : null : null;
    
    $chemin = dirname(__FILE__);
	$chemin = str_replace(DS."mail".DS."traitements","",$chemin);
	require_once($chemin.DS.'classe'.DS.'application.class.php');	
    $siteweb = new Application();
	
	$sel_option_sujet_mail=$data["sel_option_sujet_mail"];
	$sel_option_body_mail=$data["sel_option_body_mail"];
	//$sel_option_auteur_mail=$data["sel_option_auteur_mail"];

	$dat_deb_creation = $data["dat_deb_creation"];
	$dat_fin_creation = $data["dat_fin_creation"];
	
	//$sel_option_auteur_mail=$data['sel_option_auteur_mail'];

	//Chargements
	  require_once($siteweb->get_document_root().DS."classe".DS."application.class.php");
	  require_once($siteweb->get_document_root().DS."mail".DS."classe".DS."mail.class.php");
	  require_once($siteweb->get_document_root().DS."utilisateur".DS."classe".DS."utilisateur.class.php");
	  ini_set('include_path', $siteweb->get_document_root().DS.'includes'.DS.'pear');	//charger les packages de PEAR::MDB2	
	  
	  require_once($siteweb->get_document_root().DS."includes".DS."pear".DS."Structures".DS."DataGrid".DS."Renderer".DS."HTMLTable.php");   
	  require_once ($siteweb->get_document_root().DS."includes".DS."pear".DS."Structures".DS."DataGrid.php");
	
	  $luser = new Utilisateur();
	  $luser->loginuser = $login;
	  $luser->charger();
	  
	$lmail = new CMail();	//instancier un objet qui représente un mail
				  
	foreach ($data as $lindex => $lvaleur ) {
		$lmail->$lindex = $lvaleur;		
	}
    
	//print_r($data); die();
	
	$lmail->auteur_mail = $luser->codeuser;
	$lmail->sel_option_body_mail=1;
	$listemail = $lmail->rechercher();
	if ($lmail->has_exception()) die($lmail->exception);
	global $listemail;
	
	require_once($siteweb->get_document_root().DS."mail".DS."traitements".DS."tmail_result_search.php");
	
	//
	unset($luser);
			  
?>