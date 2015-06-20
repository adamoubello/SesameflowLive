<?PHP 
/**
*----------------------------------------------------------------------+
* Site web                                                |
*----------------------------------------------------------------------+
*	@author 	:	Patrick Mveng
* 	@copyright 	:	INTERFACE S.A. 2009  
* 	@version 	:	1.0		
* 	@desc		:	Fiche de traitement pour l'envoi d'une newsletter par email
* 	@created	:	mardi 02 juin 2009								   |
* 	@updates	:	
*   #mardi 23 juin 2009					
* 		- implémentation de l'envoi par la fonction mail de PHP			   |
*---------------------------------------------------------------------+
*/

	global  $siteweb, $lang;

	$vars = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
		$vars[$lkey] = $lvalue;
	}
	//print_r($vars); die("sdqs");

	$do = (isset($vars["do"])) ? (! is_null($vars["do"])) ? $vars["do"] : "index" : "index";
	$lang = (isset($vars["lang"])) ? (! is_null($vars["lang"])) ? $vars["lang"] : "en" : "en";
	$sujet_mail = (isset($vars["sujet_mail"])) ? (! is_null($vars["sujet_mail"])) ? $vars["sujet_mail"] : "" : "";
	$body_mail = (isset($vars["body_mail"])) ? (! is_null($vars["body_mail"])) ? $vars["body_mail"] : "" : "";
	$date_mail = (isset($vars["date_mail"])) ? (! is_null($vars["date_mail"])) ? $vars["date_mail"] : null : null;
	$sel_lang_mail = (isset($vars["sel_lang_mail"])) ? (! is_null($vars["sel_lang_mail"])) ? $vars["sel_lang_mail"] : "fr" : "fr";
	$format_mail = (isset($vars["format_mail"])) ? (! is_null($vars["format_mail"])) ? $vars["format_mail"] : 1 : 1;
	$code_mail = (isset($vars["code_mail"])) ? (! is_null($vars["code_mail"])) ? $vars["code_mail"] : null : null;
	$cid = (isset($vars["cid"])) ? (! is_null($vars["cid"])) ? $vars["cid"] : null : null;
	$ajax = (isset($vars["ajax"])) ? (! is_null($vars["ajax"])) ? $vars["ajax"] : 0 : 0;
	
	if (! defined("DS")) define("DS" , DIRECTORY_SEPARATOR);

	if ($ajax == 1)
	{   //die($do);
		
		//si l'appel de ce script vient d'ajax
		$cid = array();
		$cid = explode("/" , $vars["liste_mail"]); //la   liste des destinataire se trouve dans le paramètre nommé liste_mail et non cid
		$i = 0;
		for ($i = 0; $i < count($cid); $i++)
		{
			$linfo = $cid[$i];
			$cid[$i] = explode( ";" , $linfo );
		}
	}
	
	function str_ireplace_php4($search, $replace, $subject) 
	{
	  if (is_array($search)) {
	   foreach ($search as $word) {
	   $words[] = "/".$word."/i";
	   }
	  }
	  else {
	   $words = "/".$search."/i";
	  }
	  return preg_replace($words, $replace, $subject);
	}
	
	$baseDir2 = dirname(__FILE__);
	$baseDir2 = str_replace(DS."mail".DS."traitements","",$baseDir2);
	$lracine = $baseDir2. DS;
	unset($baseDir2);
		
	require_once($lracine."classe".DS."application.class.php");							
	$siteweb = new Application();
	
	ini_set('include_path', $siteweb->get_document_root().DS.'includes'.DS.'pear');	//charger les packages de PEAR::MDB2	
	//inclusion du script de la classe Mail
	require_once($siteweb->get_document_root().DS."mail".DS."classe".DS."mail.class.php");					
			
	if ( trim($code_mail) != "")
	{
		//charger les infos de ce mail
		$lmail = new CMail();
		
		$lmail->code_mail = $code_mail;
		$lmail->charger();
		
		$sujet_mail = $lmail->sujet_mail;
		$date_mail = $lmail->date_mail;
		$sujet_mail = $lmail->sujet_mail;
		$format_mail = $lmail->format_mail;
		$chkbox_format_mail = $format_mail;
		$sel_lang_mail = $lmail->lang_mail;
		
		// ! ! !  ! PHP a remplacé tous les doubles quotes " par \"
		$lmail->body_mail = str_replace('\"','"',$lmail->body_mail);
		$lmail->body_mail = str_replace('\\','',$lmail->body_mail);
		$lmail->body_mail = str_replace("''","'",$lmail->body_mail);

		$body_mail = $lmail->body_mail;
		
	}

	//charger les paramètres pour le serveur mail
	$lparam_mail = new CMail();
	
	$lparam_mail->charger_parametres();	//charger les paramètres de gestion de la newsletter
		
	ini_set('include_path', $siteweb->get_document_root().DS."includes".DS.'phpmailer');	//charger les packages de PHPMAILER	
	include_once $siteweb->get_document_root().DS."includes".DS."phpmailer".DS."class.phpmailer.php";	
		
	$mail = new PHPmailer();

	/**
	 * 1 = Fonction mail PHP
	 * 2 = Sendmail
	 * 3 = Serveur SMTP
	 */
	switch (intval($lparam_mail->mail_server))
	{
		case 1 : 
			$mail->IsMail();
			break;
		case 2 : 
			$mail->IsSendmail();
			$mail->Sendmail = $lparam_mail->sendmail_path; //définir le chemin d'accès à l'exécutable de sendmail
			break;
		case 3 : 
			$mail->IsSMTP();
			break;			
		default:	
			$mail->IsSMTP();
			break;
	}
	
	if (intval($format_mail) == 1) $mail->IsHTML(true);
	
	$mail->Host= trim($lparam_mail->smtp_host);
	$mail->From= trim($lparam_mail->sender_email);
	$mail->FromName= trim($lparam_mail->sender_name);
	
	//définir l'adresse de retour en cas d'échec. $adress représente le destinataire, 
	$mail->AddReplyTo($mail->From);	//no reply
	
	$mail->Subject=($sujet_mail);
	
	if (intval($lparam_mail->smtp_auth) == 1)	//Authentification requise
	{
		$mail->SMTPAuth  = true;
		$mail->Username = trim($lparam_mail->smtp_user);
		$mail->Password= trim($lparam_mail->smtp_pwd);

	}
	else $mail->SMTPAuth  = false;
	
	//subsitution des éléménts personnalisés
	$body_mail = $lmail->body_mail; 
	
	
	//définir la liste des tags de personnalisation
	$larr_tag = array("nom" => "{NOM}"
	,  "prenom" => "{PRENOM}"
	,  "email" => "{EMAIL}"
	);
	//vérifier l'existence de tags de personnalisation
	$lexiste_tag = false;
	$i = 0;
	
	//récriture de stripos pour PHP4
	function stripos2($haystack, $needle){
    return strpos($haystack, stristr( $haystack, $needle ));
	}
	
	//on arrête la recherche dès qu'on trouve au moins une existence
	foreach ($larr_tag as $ltag => $lvalue)
	{
		//$ltag = $larr_tag[$i][""];
		$lexiste_tag = stripos2( $body_mail , $lvalue);
		if ($lexiste_tag === false);
		else {
			$lexiste_tag = true;
			break;
		}
	}
	
	//s'il n'existe aucun tag de personnalisation, on fait des envois groupés par blocks
	if (! $lexiste_tag)
	{
		
		$laddress = trim($cid[0][0]);
		$lnom = trim($cid[0][1]);
		$lprenom = trim($cid[0][2]);
		
		$mail->AddAddress( trim($laddress , $lprenom . " " . $lnom) );
		
		$body_mail = $lbody_mail->body_mail;
		
		if (count($cid) > 1)
		{
			for ($i = 1; $i < count($cid); $i++)
			{
				$laddress = trim($cid[$i][0]);
				$lnom = trim($cid[$i][1]);
				$lprenom = trim($cid[$i][2]);
				
				if (trim($laddress) != "") $mail->AddBCC($laddress , $lprenom . " " . $lnom);
			}
		}
		
		/*if (intval($format_newslett) == 1)
		{
			$msg_newslett = "<html><head><title>Newsletter</title></head><body>" . htmlspecialchars(stripslashes($msg_newslett)) 
			. 	"</body></html>";
		}*/

		$mail->Body = $body_mail;
		
		$mail->SetLanguage("fr", $siteweb->get_document_root().DS."includes".DS."phpmailer".DS."language".DS);
		
			//journaliser cet envoi
			ini_set('include_path', $siteweb->get_document_root().DS.'includes'.DS.'pear');	//charger les packages de PEAR::MDB2	
			//par défaut les mails ne sont pas envoyés
			
			foreach ($cid as $larr_infos) {

				$llog = new CMail();
				//puis on va faire un update de ceux qui ont été effectivement envoyé
				$llog_date = date("d/m/Y");
				$llog_heure = date("H:m:s");
				$llog_id = $llog->get_next_log_id();
				
				$llog->log_id = $llog_id;
				$llog->code_mail = $lmail->code_mail;
				$llog->log_date = $llog_date;
				$llog->log_heure = $llog_heure;
				$llog->log_status = 0;	// 1 = Send , 0 = Not Send
				$llog->log_email = trim($larr_infos[0]);	
				$llog->log_nom = trim($larr_infos[1]);	
				$llog->log_prenom = trim($larr_infos[2]);	
				
				if (!$llog->log()) die($llog->get_exception());

				unset($llog);	  
			}
		
		if(!$mail->Send())
		{ //Teste le return code de la fonction
			$state = $mail->ErrorKey;
			switch(trim($mail->ErrorKey))
			{
				case "from_failed" : $lerror = "L'adresse From suivante a &eacute;chou&eacute; : ".$mail->From; break;
				case "recipients_failed" : $lerror = 'SMTP Erreur: Les destinataires suivants sont en erreur : '.$mail->ErrorInfo; break;
				case "data_not_accepted" : $lerror = "SMTP Erreur: Data non acceptée."; break;
				case "provide_address" : $lerror = 'Vous devez fournir au moins une adresse de destinataire.'; break;
				default : $lerror = $mail->language[$state]; break;
			}
			$lretval = 	"<dl id=\"system-message\">
							<dd class=\"error\">
								<ul>
									<li>". $lerror ."</li>
								</ul>
							</dd>
							</dl>
						";
		}
		else{
			$state	= "mail_send_success";
			$lretval = 	"<dl id=\"system-message\">
							<dd class=\"message\">
								<ul>
									<li>"."mail envoy&eacute; avec succ&egrave;s !"."</li>
								</ul>
							</dd>
							</dl>
						";
			
			//journaliser cet envoi
			ini_set('include_path', $siteweb->get_document_root().DS.'includes'.DS.'pear');	//charger les packages de PEAR::MDB2	
			
			$llog_date = date("d/m/Y");
			$llog_heure = date("H:m:s");
			$llog_id = $lmail->get_next_log_id();
			
			$llog = new CMail();

			$llog->log_id = $llog_id;
			$llog->code_mail = $lmail->code_mail;
			$llog->log_date  = $llog_date;
			$llog->log_heure  = $llog_heure;
			$llog->log_status = 1;	// 1 = Send , 0 = Not Send
			
			if (! $llog->modifier_status()) die($llog->exception);

			unset($llog);	  
				
			/*foreach ($cid as $larr_infos) {
				
			}*/
			
			unset($llog_id);
			unset($llog_date);
		}
		$mail->SmtpClose();
		unset($mail);
		
		
		//if ($ajax == 1)	//si l'appel de ce script vient d'ajax
		{
			die($lretval);
		}		
		
	}
	else 
	{
		
		//par défaut les mails ne sont pas envoyés
		//puis on va faire un update de ceux qui ont été effectivement envoyé
		ini_set('include_path', $siteweb->get_document_root().DS.'includes'.DS.'pear');	//charger les packages de PEAR::MDB2	
		
		$llog_id = $lmail->get_next_log_id();
		$ltotal_envoi = count($cid);
		$ltotal_send = 0;
		$ltotal_unsend = 0;
		
		for ($i = 0; $i < $ltotal_envoi; $i++)
		{
			
			$llog_date = date("d/m/Y H:m:s");
			
			$mail->ClearAddresses();
			$mail->ClearBCCs();
			$mail->ClearCCs();
			
			$body_mail = $lmail->body_mail;
			
			$laddress = trim($cid[$i][0]);
			$lnom = trim($cid[$i][1]);
			$lprenom = trim($cid[$i][2]);
						
			if (trim($laddress) != "") 
			{
	
				//personnaliser le message
				foreach ($larr_tag as $lkey => $ltag)
				{
					switch ($lkey)
					{
						case "email" :
							$body_mail = str_ireplace_php4($ltag , $laddress , $body_mail );		
							break;
						case "nom" :
							$body_mail = str_ireplace_php4($ltag ,$lnom , $body_mail );		
							break;
						case "prenom" :
							$body_mail = str_ireplace_php4($ltag , $lprenom , $body_mail);		
							break;		
					}
					
				}
				
				$mail->AddAddress(trim($laddress));
								
				$mail->Body = $body_mail;
						
				$mail->SetLanguage("fr", $siteweb->get_document_root().$siteweb->get_package_root()."/php/phpmailer/language/");
				
				//journaliser cet envoi
				
				
				$llog = new CMail();
				
				$llog->log_id = $llog_id;
				$llog->code_mail = $lmail->code_mail;
				$llog->log_date = $llog_date;
				$llog->log_status = 0;	// 1 = Send , 0 = Not Send
				$llog->log_email = trim($laddress);	
				$llog->log_nom = trim($lnom);	
				$llog->log_prenom = trim($lprenom);	
				
				$llog->log();

				unset($llog);	
				
				if (! $lmail->archiver()) die($lmail->exception);
					
				if(!$mail->Send())
				{ //Teste le return code de la fonction
					$state = $mail->ErrorKey;
					switch(trim($mail->ErrorKey))
					{
						case "from_failed" : $lerror = "L'adresse From suivante a &eacute;chou&eacute; : ".$mail->From; break;
						case "recipients_failed" : $lerror = 'SMTP Erreur: Les destinataires suivants sont en erreur : '.$mail->ErrorInfo; break;
						case "data_not_accepted" : $lerror = "SMTP Erreur: Data non acceptée."; break;
						case "provide_address" : $lerror = 'Vous devez fournir au moins une adresse de destinataire.'; break;
						default : $lerror = $mail->language[$state]; break;
					}
					$lretval = 	"<dl id=\"system-message\">
									<dd class=\"error\">
										<ul>
											<li>". $lerror ."</li>
										</ul>
									</dd>
									</dl>
								";	
					
					$ltotal_unsend++;
				}
				else{
					$state	= "mail_send_success";
					$lretval = 	"<dl id=\"system-message\">
									<dd class=\"message\">
										<ul>
											<li>"."Mail envoy&eacute;e avec succ&egrave;s !"."</li>
										</ul>
									</dd>
									</dl>
								";		  
					
					$ltotal_send++;
					
					//journaliser cet envoi
					ini_set('include_path', $siteweb->get_document_root().DS.'includes'.DS.'pear');	//charger les packages de PEAR::MDB2	
					
					$llog = new CMail();
					$llog->log_id = $llog_id;
					$llog->code_mail = $lmail->code_mail;
					$llog->log_date = $llog_date;
					$llog->log_status = 1;	// 1 = Send , 0 = Not Send
					
					if (! $llog->modifier_status()) die($llog->exception);
		
					unset($llog);	  
					
					//archiver le mail
					if (! $lmail->archiver()) die($lmail->exception);
					
				}
				
				$mail->SmtpClose();
				
			}
		}//for i
		
		$lretval = 	"<dl id=\"system-message\">
									<dd class=\"message\">
										<ul>
											<li>Total &agrave; envoyer : {$ltotal_envoi} avce {$ltotal_send} envoy&eacute;s et {$ltotal_unsend} non envoy&eacute;s !"."</li>
											<li>". $lerror ."</li>
										</ul>
									</dd>
									</dl>
								";		  
		
		//if ($ajax == 1)	//si l'appel de ce script vient d'ajax
		{
			die($lretval);
			
		}		
		
		
	}//else
	
	//libérer la mémoire
	unset($ltag);
	unset($mail);				
	
	
	?>