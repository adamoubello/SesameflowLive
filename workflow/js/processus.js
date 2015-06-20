// JavaScript Document

/**
  @desc 	:	script exécuté lorsque le user valide la création d'un processus
  		Ce script appelle ajax.
*/

function on_processus_create_valid(pscript_php)
{
	var form = document.getElementById('form_processus_create');
	form = eval(form);
	
	//ce formulaire existe -t-il ?
	if (form)
	{//oui on peut poursuivre l'exécution du script
	
		if (document.getElementById('libprocessus').value == "")
		{
			document.getElementById('system-message').style.display = 'block';
			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_libprocessus"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			
			return false;
		}
		/*else if (document.getElementById('dureeprocessus').value == "")
		{
			document.getElementById('system-message').style.display = 'block';
			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_dureeprocessus"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			
			return false;
		}
			else if (form.dureeprocessus.value != "")
		    {
				if (! isFinite(form.dureeprocessus.value))
				{
					document.getElementById('system-message').style.display = 'block';
					document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["duree_must_be_integer"];
					document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
					
					return false;
				}
				else if (parseInt(form.dureeprocessus.value) < 0)
				{
					document.getElementById('system-message').style.display = 'block';
					document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["duree_must_be_positive"];
					document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
					
					return false;
				}
		}*/

		form.submit();
		return true;
		
		/*//fabriquer les données à poster
		var data = "";
		data = 'numprocessus=' + form.numprocessus.value;
		data = data + "&ajax=1";	//notifier que l'appel de pscript vient d'ajax
		data = data + "&libprocessus=" + form.libprocessus.value;
		data = data + "&dureeprocessus=" + form.dureeprocessus.value;
		data = data + "&login=" + form.login.value;
		data = data + "&lang=" + form.lang.value;

		//exécuter AJAX	
		ldiv = document.getElementById('loading');
		ldiv = eval(ldiv);
		if (ldiv)
		{
			document.getElementById('msgloading').innerHTML = 'Enregistrement en cours ...';
			ldiv.style.display = 'block';
		}
						
		new Ajax.Request
		(
			pscript_php,
			{
				onSuccess : function(resp) 
				{
					document.getElementById('div_status').innerHTML = resp.responseText;
					document.getElementById('loading').style.display = 'none';
				},
		 		onFailure : function(resp) 
		 		{
		   			alert("Oops, there's been an error with Ajax.");
		 		},
		 		parameters : data
			}
		);*/

	}
}

/*
script de validation modification
*/
function on_processus_update_valid(pscript_php)
{
	var form = document.getElementById('form_processus_view');
	form = eval(form);
	
	//ce formulaire existe -t-il ?
	if (form)
	{//oui on peut poursuivre l'exécution du script
	
		if (form.libprocessus.value == "")
		{
			document.getElementById('system-message').style.display = 'block';
			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_libprocessus"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			
			return false;
		}
		/*else if (form.dureeprocessus.value == "")
		{
			document.getElementById('system-message').style.display = 'block';
			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_dureeprocessus"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			
			return false;
		}
		else if (document.getElementById('dureeprocessus').value != "")
		{
			if (! isFinite(document.getElementById('dureeprocessus').value))
			{
				document.getElementById('system-message').style.display = 'block';
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["duree_must_be_integer"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				
				return false;
			}
			else if (parseInt(document.getElementById('dureeprocessus').value) < 0)
			{
				document.getElementById('system-message').style.display = 'block';
	
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["duree_must_be_positive"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				
				document.getElementById('dureeprocessus').focus();
				return false;
			}
		}*/

		/*form.submit();
		return true;*/
		//fabriquer les données à poster
		var data = "";
		data = 'numprocessus=' + document.getElementById('numprocessus').value;
		data = data + "&ajax=1";	//notifier que l'appel de pscript vient d'ajax
		//data = data + "&libprocessus=" + escape(form.libprocessus.value);
		data = data + "&libprocessus=" + document.getElementById('libprocessus').value;
		//data = data + "&dureeprocessus=" + document.getElementById('dureeprocessus').value;
		//data = data + "&etatprocessus=" + form.etatprocessus.value;
		if (document.getElementById('block0').checked) data = data + "&etatprocessus=" + document.getElementById('block0').value;
		else data = data + "&etatprocessus=" + document.getElementById('block1').value;	
		data = data + "&login=" + document.getElementById('login').value;
		data = data + "&lang=" + document.getElementById('lang').value;
		data = data + "&do=processus_update_valid";

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
script de validation suppression d'un processus
*/
function on_processus_delete_valid()
{
	var form = document.getElementById('form_processus_view');
	form = eval(form);
	
	//ce formulaire existe -t-il ?
	if (form)
	{//oui on peut poursuivre l'exécution du script
	
		if (confirm(Translate["confirm_delete_processus"]))
		{
			form.elements["do"].value = "processus_delete_valid"; 
			form.submit();
			return true;

		}
		
		return false;
	}
}


function refresh(url)
{
     location.href=url;
}
