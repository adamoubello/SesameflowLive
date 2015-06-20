<?php
/**
 * @version			1.0
 * @package			Mail
 * @subpackage		Mail
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @created		:	29 mars 2009 by patrick mveng
 * @author 			Patrick Mveng
 * @desc		:	fichier qui effectue la suppression physique d'un mail
 * 					
 * @creationdate	
 * @updates
 */

	global  $siteweb, $lang;
	
	$data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
		$data[$lkey] = $lvalue;
	}

	$do = (isset($data["do"])) ? (! is_null($data["do"])) ? $data["do"] : "accueil" : "accueil";
	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
	$login = (isset($data["login"])) ? (! is_null($data["login"])) ? $data["login"] : null : null;
	$code_mail = (isset($data["code_mail"])) ? (! is_null($data["code_mail"])) ? $data["code_mail"] : null : null;	
	
	if (! defined("DS")) define("DS" , DIRECTORY_SEPARATOR);
		
	ini_set('include_path', $siteweb->get_document_root().DS.'includes'.DS.'pear');	//charger les packages de PEAR::MDB2	
	
		//inclusion du script de la classe Mail
	require_once($siteweb->get_document_root().DS."mail".DS."classe".DS."mail.class.php");					
			
	$lmail = new CMail();
	
	$cid = (isset($data["cid"])) ? (! is_null($data["cid"])) ? $data["cid"] : null : null;

	$lmail->list_code_mail = $cid;
	if ($lmail->supprimer()) $state = "delete_valid_success";
	else die($lmail->get_exception());
		//libérer la mémoire
		unset($lmail);
	
?>