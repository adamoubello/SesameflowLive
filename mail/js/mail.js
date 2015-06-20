/**
* Coche ou décoche toutes les offres du DataGrid
*/
function check_uncheck_all_mail(pstate)
{
	var lnbr_mail = eval(document.adminForm.nbr_mail);
	if (lnbr_mail)
	{
		lnbr_mail = lnbr_mail.value;
	}
	
	var i = 0;
	var lchk_mail = null;
	while (i < lnbr_mail)
	{
		lchk_mail = eval (document.getElementById('cb'+i));
		if (lchk_mail)
		{
			lchk_mail.checked = pstate;
		
		}	
		i = i+1;
	}
	
	if (pstate == true) document.adminForm.boxchecked.value = lnbr_mail;
	else  document.adminForm.boxchecked.value = 0;
			
	return true;		
}


function check_uncheck_all_abonne(pstate)
{
	var lnbr_abonne = eval(document.frm_abonne.nbr_abonne);
	if (lnbr_abonne)
	{
		lnbr_abonne = lnbr_abonne.value;
	}
	
	var i = 0;
	var lchk_abonne = null;
	while (i < lnbr_abonne)
	{
		lchk_abonne = eval (document.getElementById('cb'+i));
		if (lchk_abonne)
		{
			lchk_abonne.checked = pstate;
			
		}	
		i = i+1;
	}
	
	if (pstate == true) document.frm_abonne.boxchecked.value = lnbr_abonne;
	else  document.frm_abonne.boxchecked.value = 0;
	
	return true;		
}

function isChecked(isitchecked){
	if (isitchecked == true){
		document.adminForm.boxchecked.value++;
	}
	else {
		document.adminForm.boxchecked.value--;
	}
}



function on_check_abonne(isitchecked , pid_form)
{
	var lform = document.getElementById(pid_form);
	lform = eval(lform);
	
	if (lform)
	{
		if (isitchecked == true){
			document.getElementById('boxchecked').value = document.getElementById('boxchecked').value + 1;
		}
		else {
			document.getElementById('boxchecked').value = document.getElementById('boxchecked').value - 1;
		}
	}
}


function on_valid_abonne_creation(pscript_php)
{
	var form = document.frm_create_abonne;
	form = eval(form);
	
	if (form)
	{

		if (document.getElementById('txt_email_abonne').value == "")
		{
			alert("Veullez saisir l'adresse électronique de l'abonné");
			form.txt_email_abonne.focus();
			return false;
		}
		
		form.submit();
		
		return true;
		
		/*ldiv = document.getElementById('loading');
		ldiv = eval(ldiv);
		if (ldiv)
		{
			ldiv.style.display = 'block';
		}
		
		//fabriquer les données à poster
		data = "";
		data = 'txt_email_abonne=' + form.txt_email_abonne.value;
		data = data + "&txt_nom_abonne=" + form.txt_nom_abonne.value;
		data = data + "&txt_prenom_abonne=" + form.txt_prenom_abonne.value;
		data = data + "&ajax=1" ;
		
		new Ajax.Request
		(
			pscript_php,
			{
				onSuccess : function(resp) 
				{
					document.getElementById('loading').innerHTML = resp.responseText;
					//document.getElementById('loading').style.display = 'none';
				},
		 		onFailure : function(resp) 
		 		{
		   			alert("Oops, there's been an error with Ajax.");
		 		},
		 		parameters : data
			}
		);
				
		return false;*/
	}
	
	return false;
}

function on_valid_abonne_delete()
{
	var form = document.frm_abonne;
	form = eval(form);
	
	if (form)
	{
		if (form.boxchecked.value==0) 
		{
				alert('Veuillez sélectionner au moins un abonné !');
				return false;
		}
		else
		{
			if (confirm('Voulez-vous vraiment supprimer cet(ces) abonné(s) ?') == true)
			{
				form.task.value = "abonne_delete_valid"; 
				form.submit();
				return true;
			}
			return false;

		}
	}
}

function on_mail_create_valid()
{
	var form = document.getElementById('frm_create_mail');
	form = eval(form);
	
	if (form)
	{  
			if (document.getElementById('sujet_mail').value == "")
			{
				
				alert( Translate["pleaz_saisir_sujet"]);
				document.getElementById('sujet_mail').focus();
				return false;
			}
			
			/*else if (form.body_mail.value == "")
			{	
				alert(Translate["pleaz_saisir_body"]);
				form.body_mail.focus();
				return false;
			}*/
					
		form.submit();
		return true;

	}
		
}


function on_mail_create_valid_doc(pdoc_url , pidform,pfrom)
{
	var form = document.getElementById(pidform);	
	//var fromid= document.getElementById('id')
	
	form = eval(form);
	
	if (form)
	{
			if (document.getElementById('sujet_mail').value == "")
			{
				alert( Translate["pleaz_saisir_sujet"]);
				document.getElementById('sujet_mail').focus();
				return false;
			} 
			/*else if (document.getElementById('body_mail').value == "")
			{
				alert(Translate["pleaz_saisir_body"]);
				document.getElementById('body_mail').focus();
				return false;
			}*/
		
		form.elements["do"].value = "doc_update_reject_valid";	
		
		//alert(form.elements["do"].value);
		form.action = pdoc_url + "/gabarit/page.gabarit.php?do=doc_update_reject_valid&login=" + document.getElementById('login').value + "&lang=" + document.getElementById('lang').value; 
	
		document.getElementById('from').value = pfrom ;	
		
		form.submit();
		return true;

	}	
}


function on_mail_select_dest(pdoc_url , pidform,pfrom)
{
	var form = document.getElementById(pidform);	
	//var fromid= document.getElementById('id')
	
	form = eval(form);
	
	if (form)
	{
			if (document.getElementById('sujet_mail').value == "")
			{
				alert( Translate["pleaz_saisir_sujet"]);
				document.getElementById('sujet_mail').focus();
				return false;
			} 
			/*else if (document.getElementById('body_mail').value == "")
			{
				alert(Translate["pleaz_saisir_body"]);
				document.getElementById('body_mail').focus();
				return false;
			}*/
		
		form.elements["do"].value = "mail_select_dest";	
		
		//alert(form.elements["do"].value);
		form.action = pdoc_url + "/gabarit/page.gabarit.php?do=mail_select_dest&login=" + document.getElementById('login').value + "&lang=" + document.getElementById('lang').value; 
	
		document.getElementById('from').value = pfrom ;	
		
		form.submit();
		return true;

	}
		
}

function on_valid_mail_create_param(pscript_php)
{
	
	var form = document.frm_create_param_mail;
	var must_smtp_auth = 0;
	form = eval(form);
	
	if (form)
	{
		
		
		//Quelle case est coché ?
		lsmtp_auth = document.getElementById('smtpauth0');
		lsmtp_auth = eval(lsmtp_auth);
		if (lsmtp_auth)
		{
			if (lsmtp_auth.checked == true) must_smtp_auth = 0;
			
		}
		lsmtp_auth = document.getElementById('smtpauth1');
		lsmtp_auth = eval(lsmtp_auth);
		if (lsmtp_auth)
		{
			if (lsmtp_auth.checked == true) must_smtp_auth = 1;
		}

		
		if (form.sel_mail_server.value == 2)	//SENDMAIL
		{
			if (form.sendmail_path.value == "")
			{
				alert("Veuillez saisir le chemin d'accès à Sendmail !");
				form.sendmail_path.focus();
				return false;
			}
		}
		else if (form.sel_mail_server.value == 3)	//SMTP
		{
			if (form.smtp_host.value == "")
			{
				alert("Veuillez saisir l'hôte SMTP !");
				form.smtp_host.focus();
				return false;
			}
			else if (must_smtp_auth == 1)	//Identification SMTP requise
			{
				//l'utilisateur SMTP est obligatoire
				if (form.smtp_user.value == "")	
				{
					alert("Veuillez saisir l'utilisateur SMTP !");
					form.smtp_user.focus();
					return false;
				}
				/*
				//le mot de passe est obligatoire, mais il peut aussi être vide
				else if (form.smtp_pwd.value == "")
				{
					alert("Veuillez saisir le mot de passe SMTP !");
					form.smtp_pwd.focus();
					return false;
				}*/				
			}
		}
		
		
		//fabriquer les données à poster
		data = "";
		data = 'mail_server=' + form.sel_mail_server.value;
		data = data + "&sender_email=" + form.sender_email.value;
		data = data + "&sender_name=" + form.sender_name.value;
		data = data + "&sendmail_path=" + form.sendmail_path.value;
		//data = data + "&smtp_auth=" + form.smtp_auth.value;
		
		if (must_smtp_auth == 0) data = data + "&smtp_auth=0";
		else if (must_smtp_auth == 1) data = data + "&smtp_auth=1";
		
		data = data + "&smtp_user=" + form.smtp_user.value;
		data = data + "&smtp_pwd=" + form.smtp_pwd.value;
		data = data + "&smtp_host=" + form.smtp_host.value;
		
		sendData('div_status', data , pscript_php , 'GET');
		
		return false;
	}
	
	return false;	
	
	/*var form = document.frm_create_param_nenwsletter;
	form = eval(form);
	
	if (form)
	{
		form.submit();
		return true;

	}*/
		
}


function on_mail_send_valid(pscript_php , pdoc_url)
{
	var form = document.getElementById('frm_abonne');
	form = eval(form);
	
	if (form)
	{
		if (document.getElementById('boxchecked').value==0) 
		{
				alert(Translate["pleaz_select_at_least_one_receiver"]);
				return false;
		}
		else
		{
			if (confirm(Translate["confirm_send_mail"]) == true)
			{
				//obtenir la liste des emails cochés
				var lnbr_abonne = eval(form.nbr_abonne);
				if (lnbr_abonne)
				{
					lnbr_abonne = lnbr_abonne.value;
				}
				
				var i = 0;
				var lchk_abonne = null;
				var lliste_mail = "";
				while (i < lnbr_abonne)
				{
					lchk_abonne = eval (document.getElementById('cb'+i));
					if (lchk_abonne)
					{
						if (lchk_abonne.checked)
						{
							if (lliste_mail == "") lliste_mail = lchk_abonne.value;
							else lliste_mail = lliste_mail + "/" + lchk_abonne.value;
						}
						
					}	
					i = i+1;
				}
				
				//fabriquer les données à poster
				data = "";
				data = 'code_mail=' + escape(document.getElementById('code_mail').value);
				data = data + "&ajax=1";
				data = data + "&liste_mail=" + lliste_mail;
				
				ldiv = document.getElementById('system-message');
				ldiv = eval(ldiv);
				if (ldiv)
				{
					document.getElementById('system-message').innerHTML = '<img src="' + pdoc_url + '/images/loading_moz.gif" />&nbsp;&nbsp;' + Translate["envoi_en_cours"];
					ldiv.style.display = 'block';
				}
						//pscript_php = "http://localhost/sesameflow/mail/traitements/tmail_send_valid.php";
				new Ajax.Request
				(   
					pscript_php,
					{   //alert(pscript_php);
						
						onSuccess : function(resp) 
						{
							document.getElementById('system-message').innerHTML = resp.responseText;
						},
				 		onFailure : function(resp) 
				 		{
				   			alert("Oops, there's been an error with Ajax.");
				 		},
				 		parameters : data
				 		
					}
				);
				
				return false ;
				
				
			}
			return false ;

		}
		
	}
	
	return false;
}


function on_valid_mail_delete2()
{
	var form = document.adminForm;
	form = eval(form);
	
	if (form)
	{
		if (form.boxchecked.value==0) 
		{
				alert('Veuillez sélectionner au moins un mail !');
				return false;
		}
		else
		{
			if (confirm('Voulez-vous vraiment supprimer ce(ces) mail(s) ?') == true)
			{
				form.task.value = "mail_delete"; 
				form.submit();
				return true;
			}
			return false;

		}
	}
}


function on_mail_delete_valid(pscript_php , pdoc_url)
{
	var form = document.getElementById('form_mail_view');
	form = eval(form);
	
	if (form)
	{
			if (confirm(Translate["confirm_delete_mail"]) == true)
			{

				form.elements["do"].value = "mail_delete_valid";
				form.submit();
				return true;
			}
			return false;
	}
}




/**
 * fonction exécuter lors de la validation de la mise à jour d'une newsletter
*/
/*function on_valid_newsletter_update(pscript_php)
{
	var form = document.frm_view_newsletter;
	form = eval(form);
	
	if (form)
	{
		if (confirm('Voulez-vous vraiment modifier cette newsletter ?') == true)
		{
			//fabriquer les données à poster
			data = "";
			data = 'cod_newslett=' + form.cod_newslett.value;
			data = data + "&ajax=1";
			
			//afficher un message d'attente avant l'envoi des mails
			ldiv_status = document.getElementById('div_status');
			ldiv_status = eval(ldiv_status);
			if (ldiv_status)
			{
				ldiv_status.innerHTML = "Newsletter en cours de modification";
			}
							
			sendData('div_status', data , pscript_php , 'GET');
			
			return false;
			
			
		}
		return false;

	}
	
	return false;
}
*/

function on_valid_recherche_abonne(pscript_php , pdoc_url)
{
	var form = document.getElementById('frm_search_dest');
	form = eval(form);
	
	if (form)
	{

		ldiv = document.getElementById('system-message');
		ldiv = eval(ldiv);
		if (ldiv)
		{
			document.getElementById('system-message').innerHTML = '<img src="' + pdoc_url + '/images/loading_moz.gif" />&nbsp;&nbsp;' + Translate["chargement_en_cours"];
			ldiv.style.display = 'block';
		}
		
		//fabriquer les données à poster
		data = "";
		data = 'sel_option_nomuser=' + document.getElementById('sel_option_nomuser').value;
		data = data + "&nomuser=" + document.getElementById('nomuser').value; 
		data = data + "&sel_option_prenomuser=" + document.getElementById('sel_option_prenomuser').value;
		data = data + "&prenomuser=" + document.getElementById('prenomuser').value; 
		data = data + "&sel_option_emailuser=" + document.getElementById('sel_option_emailuser').value;
		data = data + "&emailuser=" + document.getElementById('emailuser').value;
		data = data + "&code_mail=" + document.getElementById('code_mail').value;
		data = data + "&ajax=1";
		data = data + "&do=mail_select_dest";
		
		new Ajax.Request
		(
			pscript_php,
			{
				onSuccess : function(resp) 
				{
					document.getElementById('div_result_select_dest').innerHTML = resp.responseText;
					document.getElementById('system-message').style.display = 'none';
				},
		 		onFailure : function(resp) 
		 		{
		   			alert("Oops, there's been an error with Ajax.");
		 		},
		 		parameters : data
			}
		);
				
		return false;
	}
	
	return false;
}


function on_valid_recherche_abonne2(pscript_php)
{
	var form = document.frm_search_abonne;
	form = eval(form);
	
	if (form)
	{

		ldiv = document.getElementById('loading');
		ldiv = eval(ldiv);
		if (ldiv)
		{
				//alert('dsfsd');
			ldiv.style.display = 'block';
		}
		//ldiv.innerHTML = '<center><img align="middle" height="50%" width="50px" src="<?php echo $ginterface->get_url().DS."images".DS."loading.gif"; ?>" /><p>Chargement en cours...</p></center>';
		
		//fabriquer les données à poster
		data = "";
		data = 'sel_option_nom=' + form.sel_option_nom.value;
		data = data + "&txt_nom=" + form.txt_nom.value;
		data = data + "&sel_option_prenom=" + form.sel_option_prenom.value;
		data = data + "&txt_prenom=" + form.txt_prenom.value;
		data = data + "&sel_option_email=" + form.sel_option_email.value;
		data = data + "&txt_email=" + form.txt_email.value;
		data = data + "&txt_date_deb_inscript=" + form.txt_date_deb_inscript.value;
		data = data + "&txt_date_fin_inscript=" + form.txt_date_fin_inscript.value;
		data = data + "&code_mail=" + form.code_mail.value;
		
		sendData('div_result_abonne', data , pscript_php , 'GET');
		
		if (ldiv)
		{
				//alert('dsfsd');
			//ldiv.style.display = 'none';
		}
		
		return false;
	}
	
	return false;
}



function on_mail_update_valid(pscript_php , pdoc_url)
{
	var form = document.getElementById('form_mail_view');
	form = eval(form);
	
	if (form)
	{  
			if (document.getElementById('sujet_mail').value == "")
			{
				
				alert( Translate["pleaz_saisir_sujet"]);
				document.getElementById('sujet_mail').focus();
				return false;
			}
			
			/*else if (document.getElementById('body_mail').value == "")
			{	
				alert(Translate["pleaz_saisir_body"]);
				document.getElementById('body_mail').focus();
				return false;
			}*/
			
			//fabriquer les données à poster
			data = "";
			data = 'sujet_mail=' + escape(document.getElementById('sujet_mail').value);
			data = data + "&body_mail=" + escape(document.getElementById('body_mail').value);
			data = data + "&ajax=1";	//notifier que l'appel de pscript vient d'ajax
			data = data + "&login=" + form.login.value;
			data = data + "&lang=" + form.lang.value;
			data = data + "&do=mail_update_valid";
			data = data + "&code_mail=" + form.code_mail.value;
			
			var lchkbox_format = document.getElementById('chkbox_format_mail');
			lchkbox_format = eval(lchkbox_format) ;
			if (lchkbox_format) lchkbox_format_value = "1";
			else lchkbox_format_value = "0";
			
			data = data + "&chkbox_format_mail=" + lchkbox_format_value;
			
			//window.location = pscript_php + "?" + data;
			
			//exécuter AJAX	
			ldiv = document.getElementById('system-message');
			ldiv = eval(ldiv);
			if (ldiv)
			{
				document.getElementById('system-message').innerHTML = '<img src="' + pdoc_url + '/images/loading_moz.gif" />&nbsp;&nbsp;' + Translate["modif_en_cours"];
				ldiv.style.display = 'block';
			}
							
			new Ajax.Request
			(
				pscript_php,
				{
					onSuccess : function(resp) 
					{
						document.getElementById('system-message').innerHTML = resp.responseText;
						//ldiv.style.display = 'none';
					},
			 		onFailure : function(resp) 
			 		{
			   			alert("Oops, there's been an error with Ajax.");
			   			ldiv.style.display = 'none';
			 		},
			 		parameters : data
				}
			);
					
			return false;
	}
	
	return false;
		
}

function on_mail_param_valid (pscript_php , pdoc_url) {
	//recupère l'ID de l'élément dont le nom est form_mail_view
	
	var lform = document.getElementById('frm_create_param_nenwsletter');
		
	lform = eval(lform);//vérifie l'existence de form
	
	if (lform) 
	{
		
		//Quelle case est coché ?
		lsmtp_auth = document.getElementById('smtpauth0');
		lsmtp_auth = eval(lsmtp_auth);
		if (lsmtp_auth)
		{
			if (lsmtp_auth.checked == true) must_smtp_auth = 0;
			
		}
		lsmtp_auth = document.getElementById('smtpauth1');
		lsmtp_auth = eval(lsmtp_auth);
		if (lsmtp_auth)
		{
			if (lsmtp_auth.checked == true) must_smtp_auth = 1;
		}
		
		if (document.getElementById('sender_email').value == "")
		{	
			document.getElementById('system-message').style.display = 'block';				
			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_sender_email"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			document.getElementById('sender_email').focus();
			return false;
		}
		
		if (parseInt(document.getElementById('sel_mail_server').value) == 2)	//SENDMAIL
		{
			if (document.getElementById('sendmail_path').value == "")
			{
				document.getElementById('system-message').style.display = 'block';				
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_sendmail_path"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";

				document.getElementById('sendmail_path').focus();
				return false;
			}
		}
		else if (parseInt(document.getElementById('sel_mail_server').value) == 3)	//SMTP
		{
			if (document.getElementById('smtp_host').value == "")
			{	
				document.getElementById('system-message').style.display = 'block';				
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_smtp_host"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				document.getElementById('smtp_host').focus();
				return false;
			}	
			else if (must_smtp_auth == 1)	//Identification SMTP requise
			{
				//l'utilisateur SMTP est obligatoire
				if (document.getElementById('smtp_user').value == "")
				{	
					document.getElementById('system-message').style.display = 'block';				
					document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_smtp_user"];
					document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
					document.getElementById('smtp_user').focus();
					return false;
				}
			}
		}
		
			/*
			
			else if (lform.sender_name.value == "")
			{	
				document.getElementById('system-message').style.display = 'block';				
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_sender_name"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				lform.sender_name.focus();
				return false;
			}

			else if (lform.sendmail_path.value == "")
			{	
				document.getElementById('system-message').style.display = 'block';				
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_sendmail_path"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				lform.sendmail_path.focus();
				return false;
			}
			else if (lform.smtp_user.value == "")
			{	
				document.getElementById('system-message').style.display = 'block';				
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_smtp_user"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				lform.smtp_user.focus();
				return false;
			}
			else if (lform.smtp_pwd.value == "")
			{	
				document.getElementById('system-message').style.display = 'block';				
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_smtp_pwd"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				lform.smtp_pwd.focus();
				return false;
			}
			else if (lform.smtp_host.value == "")
			{	
				document.getElementById('system-message').style.display = 'block';				
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_smtp_host"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				lform.smtp_host.focus();
				return false;
			}*/					
			
			
			//fabriquer les données à poster
			data = "";
			data = 'sender_email=' + document.getElementById('sender_email').value; 
			data = data + "&sender_name=" + document.getElementById('sender_name').value;
			data = data + "&ajax=1";	//notifier que l'appel de pscript vient d'ajax
			data = data + "&login=" + document.getElementById('login').value;
			data = data + "&sendmail_path=" + document.getElementById('sendmail_path').value;
			data = data + "&smtp_pwd=" + document.getElementById('smtp_pwd').value;
			data = data + "&smtp_host=" + document.getElementById('smtp_host').value;
			data = data + "&lang=" + document.getElementById('lang').value;
			data = data + "&smtp_user=" + document.getElementById('smtp_user').value;
			
			if (must_smtp_auth == 0) data = data + "&smtp_auth=0";
			else if (must_smtp_auth == 1) data = data + "&smtp_auth=1";
			
			data = data + "&sel_mail_server=" + document.getElementById('sel_mail_server').value;
			data = data + "&do=mail_param_valid";
			//exécuter AJAX	
			ldiv = document.getElementById('system-message');
			ldiv = eval(ldiv);
			if (ldiv)
			{
				document.getElementById('system-message').innerHTML = '<img src="' + pdoc_url + '/images/loading_moz.gif" />&nbsp;&nbsp;' + Translate["modif_en_cours"];
				ldiv.style.display = 'block';
			}
			
							
			new Ajax.Request
			(
				pscript_php,
				{
					onSuccess : function(resp) 
					{
						document.getElementById('system-message').innerHTML = resp.responseText;
						//ldiv.style.display = 'none';
					},
			 		onFailure : function(resp) 
			 		{
			   			alert("Oops, there's been an error with Ajax.");
			   			ldiv.style.display = 'none';
			 		},
			 		parameters : data
				}
			);
					
			return false;
	}
	
	return false;
		
}

