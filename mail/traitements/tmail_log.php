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
	}
	
	if (! defined("DS")) define("DS" , DIRECTORY_SEPARATOR);

	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
	$login= (isset($data["login"])) ? (! is_null($data["login"])) ? $data["login"] : null : null;
	$do = (isset($data["do"])) ? (! is_null($data["do"])) ? $data["do"] : "accueil" : "accueil";
	
    $chemin = dirname(__FILE__);
	$chemin = str_replace(DS."mail".DS."traitements","",$chemin);
	require_once($chemin.DS.'classe'.DS.'application.class.php');	
    $siteweb = new Application();
	
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
    //print_r($data);
	$lmail->auteur_mail = $luser->codeuser;
	$listemail = $lmail->historique();
	if ($lmail->has_exception()) die($lmail->exception);
	
	global $listemail;
	
	require_once($siteweb->get_document_root().DS."mail".DS."traitements".DS."tmail_log_result_search.php") ;
	
	
	//die($luser);
	unset($luser);
			  
?>