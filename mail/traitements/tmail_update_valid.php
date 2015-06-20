<?PHP 
/**
*----------------------------------------------------------------------+
* Site web                                                |
*----------------------------------------------------------------------+
*	@author 	:	Patrick Mveng
* 	@copyright 	:	INTERFACE S.A. 2009  
* 	@version 	:	1.0		
* 	@desc		:	Fiche de traitement pour la mise à jour d'une newsletter
* 	@created	:	jeudi 18 juin 2009								   |
*---------------------------------------------------------------------+
*/

	
	$data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
		$data[$lkey] = $lvalue;
	}

	$do = (isset($data["do"])) ? (! is_null($data["do"])) ? $data["do"] : "accueil" : "accueil";
	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
	$login = (isset($data["login"])) ? (! is_null($data["login"])) ? $data["login"] : null : null;
	$sujet_mail = (isset($data["sujet_mail"])) ? (! is_null($data["sujet_mail"])) ? $data["sujet_mail"] : "" : "";
	$code_mail = (isset($data["code_mail"])) ? (! is_null($data["code_mail"])) ? $data["code_mail"] : null : null;
	$body_mail = (isset($data["body_mail"])) ? (! is_null($data["body_mail"])) ? $data["body_mail"] : "" : "";
	$date_mail = (isset($data["date_mail"])) ? (! is_null($data["date_mail"])) ? $data["date_mail"] : null : null;
	$sel_lang_mail = (isset($data["sel_lang_mail"])) ? (! is_null($data["sel_lang_mail"])) ? $data["sel_lang_mail"] : "fr" : "fr";
	$format_mail = (isset($data["chkbox_format_mail"])) ? (! is_null($data["chkbox_format_mail"])) ? $data["chkbox_format_mail"] : 2 : 2;
	$ajax = (isset($data["ajax"])) ? (! is_null($data["ajax"])) ? $data["ajax"] : 0 : 0;
	
	//$body_mail = str_replace("<br mce_bogus=\"1\">" , "" , $body_mail);	//supprimer <br mce_bogus="1">
	
	if (! defined("DS")) define("DS" , DIRECTORY_SEPARATOR);
		
	ini_set('include_path', $siteweb->get_document_root().DS.'includes'.DS.'pear');	//charger les packages de PEAR::MDB2	
	
		//inclusion du script de la classe Mail
	require_once($siteweb->get_document_root().DS."mail".DS."classe".DS."mail.class.php");					
	//fichier de traduction
	require_once($siteweb->get_document_root().DS."lang".DS."application.".$lang.".php");							
	
	$lmail = new CMail();
	
	$lmail->code_mail = $code_mail;
	$lmail->sujet_mail = trim($sujet_mail);
	
	// ! ! !  ! PHP a remplacé tous les doubles quotes " par \"
	//$lmail->body_mail = $body_mail;
	$lmail->body_mail = str_replace('\"','"',$body_mail);
	$lmail->date_mail = $date_mail;
	$lmail->format_mail = $format_mail;
	
		//lancer la modification du mail
		if (! $lmail->modifier())
		{
			$lretval = "
			<dt class=\"message\">Message</dt>

			<dd class=\"message message error\">
				<ul>
					<li>".$lmail->exception."</li>
				</ul>
			</dd>";
			$state="update_valid_error";
		}
		else {		
			$state="update_valid_success";
			$lretval = "
			<dt class=\"message\">Message</dt>

			<dd class=\"message message fade\">
				<ul>
					<li>".$translate["update_valid_success"]."</li>
				</ul>
			</dd>";
		}
		
		//libérer la mémoire
		unset($lmail);
		
	if (intval($ajax) == 1)
	{
		die($lretval);		
	}
	
	?>