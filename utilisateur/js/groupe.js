// JavaScript Document

/**
  @desc 	:	script exécuté lorsque le user valide la création d'un groupe
  Ce script appelle ajax.
*/
function on_groupe_create_valid(pscript_php)
{
	var form = document.getElementById('form_groupe_create');
	form = eval(form);
	
	//ce formulaire existe -t-il ?
	if (form)
	{//oui on peut poursuivre l'exécution du script
	    if (document.getElementById('libgroup').value == "")
		{
			document.getElementById('system-message').style.display = 'block';
			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_libgroup"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			return false;
		}
		
		form.submit();
		return true;
		
	}
}

/*
script de validation de la modification d'un groupe
*/
function on_groupe_update_valid(pscript_php)
{
	var form = document.getElementById('form_groupe_view');
	form = eval(form);
	
	//ce formulaire existe -t-il ?
	if (form)
	{//oui on peut poursuivre l'exécution du script
		if (form.libgroup.value == "")
		{
			document.getElementById('system-message').style.display = 'block';
			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_libgroup"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			return false;
		}
		
		//fabriquer les données à poster
		var data = "";
		data = 'codegroup=' + form.codegroup.value;
		data = data + "&ajax=1";	//notifier que l'appel de pscript vient d'ajax
		data = data + "&libgroup=" + form.libgroup.value;
		data = data + "&login=" + form.login.value;
		data = data + "&lang=" + form.lang.value;
		data = data + "&do=groupe_update_valid";

		//exécuter AJAX	
		ldiv = document.getElementById('system-message');
		ldiv = eval(ldiv);
		if (ldiv)
		{
			document.getElementById('system-message').innerHTML = 'Modification en cours ...';
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
	}
}

/*
script de validation suppression d'un groupe
*/
function on_groupe_delete_valid()
{
	var form = document.getElementById('form_groupe_view');
	form = eval(form);
	
	//ce formulaire existe -t-il ?
	if (form)
	{//oui on peut poursuivre l'exécution du script
	    if (confirm('Voulez-vous vraiment supprimer ce groupe ?'))
		{
			form.elements["do"].value = "groupe_delete_valid"; 
			form.submit();
			return true;
		}
		return false;
	}
}

/**
  @desc 	:	script exécuté lorsque le user valide la recherche d'un groupe
*/
function on_groupe_search_valid()
{
	var form = document.getElementById('form_groupe_search');
	form = eval(form);
	
	//ce formulaire existe -t-il ?
	if (form)
	{//oui on peut poursuivre l'exécution du script
	    if ( (document.getElementById('sel_option_libgroup').value == "") && (document.getElementById('libgroup').value != "") )
		{
			document.getElementById('system-message').style.display = 'block';
			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_sel_option_libgroup"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			document.getElementById('sel_option_libgroup').focus();
			return false;
		}
		
		form.submit();
		return true;
		
	}
}
