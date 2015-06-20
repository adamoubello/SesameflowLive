<?PHP 
/**
*----------------------------------------------------------------------+
* Site web                                                |
*----------------------------------------------------------------------+
*	@author 	:	Patrick Mveng
* 	@copyright 	:	INTERFACE S.A. 2009  
* 	@version 	:	1.0		
* 	@desc		:	Fiche de traitement pour la création des paramètres de la gestion des mails
* 	@created	:	lundi 10 juin 2009								   |
*---------------------------------------------------------------------+
*/

	global  $ginterface, $lang;
	
	$vars = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
		$vars[$lkey] = $lvalue;
	}
	
	if(! defined("DS")) define("DS", DIRECTORY_SEPARATOR);

	$baseDir2 = dirname(__FILE__);
	$baseDir2 = str_replace(DS."mail".DS."traitements","",$baseDir2);
	$lracine = $baseDir2. DS;
	unset($baseDir2);
		
	require_once($lracine."classe".DS."application.class.php");
	$siteweb = new Application();

	
	/**
	 * 1 = Fonction mail PHP
	 * 2 = Sendmail
	 * 3 = Serveur SMTP
	 */
	$mail_server = (isset($vars["sel_mail_server"])) ? (! is_null($vars["sel_mail_server"])) ? $vars["sel_mail_server"] : 3 : 3;
	$sender_email = (isset($vars["sender_email"])) ? (! is_null($vars["sender_email"])) ? $vars["sender_email"] : "" : "";
	$sender_name = (isset($vars["sender_name"])) ? (! is_null($vars["sender_name"])) ? $vars["sender_name"] : "" : "";
	$sendmail_path = (isset($vars["sendmail_path"])) ? (! is_null($vars["sendmail_path"])) ? $vars["sendmail_path"] : null : null;
	$smtp_auth = (isset($vars["smtp_auth"])) ? (! is_null($vars["smtp_auth"])) ? $vars["smtp_auth"] : 0 : 0;
	$smtp_user = (isset($vars["smtp_user"])) ? (! is_null($vars["smtp_user"])) ? $vars["smtp_user"] : "" : "";
	$smtp_pwd = (isset($vars["smtp_pwd"])) ? (! is_null($vars["smtp_pwd"])) ? $vars["smtp_pwd"] : "" : "";
	$smtp_host = (isset($vars["smtp_host"])) ? (! is_null($vars["smtp_host"])) ? $vars["smtp_host"] : "" : "";
		
	 ini_set('include_path', $siteweb->get_document_root().DS.'includes'.DS.'pear');	//charger les packages de PEAR::MDB2	
  	   
      require_once($siteweb->get_document_root().DS."mail".DS."classe".DS."mail.class.php");
	
	$lmail = new CMail();
	//print_r($vars); die();
	$lmail->mail_server = intval($mail_server);
	$lmail->sender_email = trim($sender_email);
	$lmail->sender_name = trim($sender_name);
	$lmail->sendmail_path = $sendmail_path;
	$lmail->smtp_auth = $smtp_auth;
	$lmail->smtp_user = $smtp_user;
	$lmail->smtp_pwd = $smtp_pwd;
	$lmail->smtp_host = $smtp_host;
	
	if (! $lmail->existe_parametres())
	{
		//lancer l'enregistrement des paramètres
		if (! $lmail->enregistrer_parametres())
		{
			die($lmail->get_exception());
		}
		else {	
			$data = ""
			."&state="."mail_create_param_valid_success"
			;
			$lstate = "mail_create_param_valid_success";
			$lretval = 	"<dl id=\"system-message\">
						<dd class=\"message\">
							<ul>
								<li>"."Param&egrave;tres mail enregistr&eacute;s avec succ&egrave;s !"."</li>
							</ul>
						</dd>
						</dl>
					";
		}
	}
	else 
	{
		//lancer la mise à jour des paramètres
		if (! $lmail->modifier_parametres())
		{
			die($lmail->get_exception());
		}
		else {		
			$data = ""
			."&state="."mail_update_param_valid_success"
			;
			$lstate = "mail_update_param_valid_success";
			$lretval = 	"<dl id=\"system-message\">
						<dd class=\"message\">
							<ul>
								<li>"."Param&egrave;tres mail mis &agrave; jour avec succ&egrave;s !"."</li>
							</ul>
						</dd>
						</dl>
					";		
		}
	}
		unset($lmail);
		unset($lracine);	
		//die("Paramètres Newsletter mis à jour avec succès !");	
		//envoyer le résultat de Ajax sur l'écran
		die ($lretval);
		
	?>