<?PHP 
/**
 * @version			1.0
 * @package			Mail
 * @subpackage		Mail
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @created		:	29 mars 2009 by patrick mveng
 * @author 			Patrick Mveng
 * @desc		:	script de traitement pour la fiche de création d'un mail dans la base de données
 * 					
 * @creationdate	
 * @updates
 */

	global  $siteweb, $lang;
	
	$vars = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
		$vars[$lkey] = $lvalue;
	}

	$do = (isset($vars["do"])) ? (! is_null($vars["do"])) ? $vars["do"] : "accueil" : "accueil";
	$lang = (isset($vars["lang"])) ? (! is_null($vars["lang"])) ? $vars["lang"] : "fr" : "fr";
	$login = (isset($vars["login"])) ? (! is_null($vars["login"])) ? $vars["login"] : null : null;
	$sujet_mail = (isset($vars["sujet_mail"])) ? (! is_null($vars["sujet_mail"])) ? $vars["sujet_mail"] : "" : "";
	$body_mail = (isset($vars["body_mail"])) ? (! is_null($vars["body_mail"])) ? $vars["body_mail"] : "" : "";
	$date_mail = (isset($vars["date_mail"])) ? (! is_null($vars["date_mail"])) ? $vars["date_mail"] : null : null;
	$sel_lang_mail = (isset($vars["sel_lang_mail"])) ? (! is_null($vars["sel_lang_mail"])) ? $vars["sel_lang_mail"] : "fr" : "fr";
	$format_mail = (isset($vars["chkbox_format_mail"])) ? (! is_null($vars["chkbox_format_mail"])) ? $vars["chkbox_format_mail"] : 2 : 2;
	
	if (! defined("DS")) define("DS" , DIRECTORY_SEPARATOR);
		
	ini_set('include_path', $siteweb->get_document_root().DS.'includes'.DS.'pear');	//charger les packages de PEAR::MDB2	
	
	//obtenir le codeuser associé au login
	//inclusion du script de la classe Utilisateur
	require_once($siteweb->get_document_root().DS."utilisateur".DS."classe".DS."utilisateur.class.php");					
			
	$luser = new Utilisateur();
	$luser->loginuser = $login;
	$luser->sel_option_loginuser = 4;
	$listeuser = $luser->rechercher();
	
		//inclusion du script de la classe Mail
	require_once($siteweb->get_document_root().DS."mail".DS."classe".DS."mail.class.php");					
			
	$lmail = new CMail();
	
	$code_mail  = $lmail->generer_numero();
	$lmail->code_mail = $code_mail;
	$lmail->sujet_mail = trim($sujet_mail);
	// ! ! !  ! PHP a remplacé tous les doubles quotes " par \"
	$lmail->body_mail = str_replace('\"','"',$body_mail);	
	//$lmail->body_mail = trim($body_mail);
	$lmail->date_mail = $date_mail;
	$lmail->auteur_mail = $listeuser[0]["codeuser"];
	$lmail->format_mail = $format_mail;
	$lmail->date_mail = date("d/m/Y");
	
		//lancer l'ajout ds bd
		if (! $lmail->ajouter())
			die($lmail->get_exception());
		else 		
			$state = "insert_valid_success";
		
		unset($lmail);
		unset($luser);
		
	?>