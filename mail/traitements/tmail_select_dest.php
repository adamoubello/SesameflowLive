<?php
/**
 * @version			1.0
 * @package			Mail
 * @subpackage		Mail
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @created		:	29 mars 2009 by patrick mveng
 * @author 			Patrick Mveng
 * @desc		:	script de traitement pour la fiche de recherche des destinataires d'un mail
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
	$ajax = (isset($data["ajax"])) ? (! is_null($data["ajax"])) ? $data["ajax"] : 0 : 0;
	
	$nomuser    = (isset($data["nomuser"])) ? (! is_null($data["nomuser"])) ? $data["nomuser"] : null : null;
	$prenomuser    = (isset($data["prenomuser"])) ? (! is_null($data["prenomuser"])) ? $data["prenomuser"] : null : null;
	$emailuser  = (isset($data["emailuser"])) ? (! is_null($data["emailuser"])) ? $data["emailuser"] : null : null;
	
	$code_mail  = (isset($data["code_mail"])) ? (! is_null($data["code_mail"])) ? $data["code_mail"] : null : null;
	$sujet_mail = (isset($data["sujet_mail"])) ? (! is_null($data["sujet_mail"])) ? $data["sujet_mail"] : "" : "";
	$body_mail  = (isset($data["body_mail"])) ? (! is_null($data["body_mail"])) ? $data["body_mail"] : "" : "";
	$date_mail  = (isset($data["date_mail"])) ? (! is_null($data["date_mail"])) ? $data["date_mail"] : date("d/m/Y H:m:s") : date("d/m/Y H:m:s");
	$sel_lang_mail = (isset($data["sel_lang_mail"])) ? (! is_null($data["sel_lang_mail"])) ? $data["sel_lang_mail"] : "fr" : "fr";
	$format_mail = (isset($data["format_mail"])) ? (! is_null($data["format_mail"])) ? $data["format_mail"] : 1 : 1;
	$state = (isset($data["state"])) ? (! is_null($data["state"])) ? $data["state"] : null : null;
	$chkbox_format_mail = $format_mail;
  
    $chemin = dirname(__FILE__);
	$chemin = str_replace(DS."mail".DS."traitements","",$chemin);
	require_once($chemin.DS.'classe'.DS.'application.class.php');	
    $siteweb = new Application();
    global $siteweb;

	$cid = (isset($data["cid"])) ? (! is_null($data["cid"])) ? $data["cid"] : null : null;
    $sel_option_nomuser = (isset($data["sel_option_nomuser"])) ? (! is_null($data["sel_option_nomuser"])) ? $data["sel_option_nomuser"] : 1 : 1;
	$sel_option_prenomuser = (isset($data["sel_option_prenomuser"])) ? (! is_null($data["sel_option_prenomuser"])) ? $data["sel_option_prenomuser"] : 1 : 2;
	$sel_option_emailuser = (isset($data["sel_option_emailuser"])) ? (! is_null($data["sel_option_emailuser"])) ? $data["sel_option_emailuser"] : 1 : 1;
	
 	if (is_array($cid)) $code_mail = $cid[0];	//pour l'envoi de mail, on considère seulement la première cochée
	//require_once($siteweb->get_document_root().DS."mail".DS."traitements".DS."tmail_create_valid.php");

	//charger les infos de cette newsletter
	require_once($siteweb->get_document_root().DS.'lang'.DS.'application.'.$lang.'.php');	
		
	ini_set('include_path', $siteweb->get_document_root().DS.'includes'.DS.'pear');	//charger les packages de PEAR::MDB2	
	
	require_once($siteweb->get_document_root().DS."includes".DS."pear".DS."Structures".DS."DataGrid".DS."Renderer".DS."HTMLTable.php");   
	require_once ($siteweb->get_document_root()."".DS."includes".DS."pear".DS."Structures".DS."DataGrid.php");
	//inclusion du script de la classe Mail
	require_once($siteweb->get_document_root().DS."mail".DS."classe".DS."mail.class.php");					
			
    	$lmail = new CMail();
		
		$lmail->code_mail = $code_mail;
		$lmail->charger();
		
		$sujet_mail = $lmail->sujet_mail;
		$date_mail = $lmail->date_mail;
		$body_mail = $lmail->body_mail;
		$format_mail = $lmail->format_mail;
		$chkbox_format_mail = $format_mail;
		$lang_mail = $lmail->lang_mail;
	
		//obtenir la liste des utilisateurs
		require_once($siteweb->get_document_root().DS."utilisateur".DS."classe".DS."utilisateur.class.php");				  
		$luser = new utilisateur();
		
		foreach ($data as $lchamp => $lvalue) 
		{
		$luser->$lchamp = 	$lvalue;
		}
		$luser->connected = null;
		$listeuser = $luser->rechercher();
		if ($luser->has_exception()) die($luser->exception);
		require_once($siteweb->get_document_root().DS."utilisateur".DS."traitements".DS."tuser_result_search.php");		

		if (intval($ajax) == 1)
		{
			$lretval =
			"
				<fieldset class=\"adminform\">
					<legend>" . ucfirst($translate["destinataire"]) . "</legend>
					<form name=\"frm_abonne\" id=\"frm_abonne\" action=\"". $siteweb->get_url()."/utilisateur/traitements/partie_centrale.php" . "\" method=\"POST\" >
						<input type=\"hidden\" name=\"boxchecked\" id=\"boxchecked\" value=\"0\" />
						<input type=\"hidden\" name=\"nbr_abonne\" id=\"nbr_abonne\" value=\"" . count($listeuser) . "\" />
						<input type=\"hidden\" id=\"code_mail\" name=\"code_mail\" value=\"". $code_mail . "\"  />
						<input type=\"hidden\" id=\"do\" name=\"do\" value=\"mail_send_valid\"  />
						<input type=\"hidden\" id=\"lang\" name=\"lang\" value=\"{$lang}\"  />
						<input type=\"hidden\" id=\"login\" name=\"login\" value=\"{$login}\"  />"
						.$result_recherche_user
					."</form>
				</fieldset>
			";
			
			die($lretval);
		}

?>