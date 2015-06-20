<?php
/**
 * @version			1.0
 * @package			Mail
 * @subpackage		Mail
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @created		:	29 mars 2009 by patrick mveng
 * @author 			Patrick Mveng
 * @desc		:	script de traitement pour la fiche de paramétrage du serveur de mail
 * 					
 * @creationdate	
 * @updates
 */
   
   $data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
		$data[$lkey] = $lvalue;
	}
   
   //obtenir le séparateur de dossier pour la OS en cours
   if (! defined("DS")) define( 'DS', DIRECTORY_SEPARATOR );
  
	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
	$login= (isset($data["login"])) ? (! is_null($data["login"])) ? $data["login"] : null : null;
	$do = (isset($data["do"])) ? (! is_null($data["do"])) ? $data["do"] : "accueil" : "accueil";
	
   $chemin = dirname(__FILE__);
	$chemin = str_replace(DS."mail".DS."traitements","",$chemin);
	require_once($chemin.DS.'classe'.DS.'application.class.php');	
   $siteweb = new Application();
   
   global $siteweb;

  	  ini_set('include_path', $siteweb->get_document_root().DS.'includes'.DS.'pear');	//charger les packages de PEAR::MDB2	
  	   
      require_once($siteweb->get_document_root().DS."mail".DS."classe".DS."mail.class.php");

	$lmail = new CMail();
	
	/**
	 * 1 = Fonction mail PHP
	 * 2 = Sendmail
	 * 3 = Serveur SMTP
	 */
	
	$mail_server = 3;	//par Serveur SMTP par défaut
	$sender_email = "";
	$sender_name = "";
	$sendmail_path = "";
	$smtp_auth = 0;
	$smtp_user = "";
	$smtp_pwd = "";
	$smtp_host = "";
	
	if ($lmail->existe_parametres())
	{
		$lmail->charger_parametres();	//charger les paramètres de gestion de la newsletter
		
		$mail_server  = intval($lmail->mail_server);
		$sender_email = trim($lmail->sender_email);
		$sender_name = trim($lmail->sender_name);
		$sendmail_path = $lmail->sendmail_path;
		$smtp_auth = $lmail->smtp_auth;
		$smtp_user = $lmail->smtp_user;
		$smtp_pwd = $lmail->smtp_pwd;
		$smtp_host = $lmail->smtp_host;
		
	}
	
	global $lmail;
	
?>