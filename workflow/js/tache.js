// JavaScript Document

function afficher_div_tache_search() 
 {
	 
 var ldiv = document.getElementById("div_tache_search");
 var lchkbox = document.getElementById("checkbox_tache_search");
 
 ldiv = eval(ldiv);
 
 if (ldiv)
 {
	lchkbox= eval(lchkbox); 
    if (lchkbox)
	{
	if (lchkbox.checked == true)
	{ 
	ldiv.style.display="block";
	}
	else 
	{  
	ldiv.style.display="none"  ;
	}
	}
  }
	  
  }
  
  /***
	@name		:	traitement javascript à effectuer lorsque l'utilisateur valide les données modifiées
	@date		:	14 juin 2009
	@param		:	pscript - chemin d'accès au script php à exécuter par ajax
	@description	:	cette fonction fait un appel à ajax
	Le résultat sera envoyé dans le div ayant l'id div_status
	Après l'exécution du scipt php, on reverra dans ce div, le résultat de la tentative de mise à jour
*/

function soumet() {
	    
		var form = document.form_create_tache;
		//var r = new RegExp("[\<|\>|\"|\'|\%|\;|\(|\)|\&]", "i");

		// do field validation
		if (trim(form.numerotache.value) == "") {
			alert( "Vous devez fournir un numero." );
			document.getElementById('numerotache').focus();
			return false;
		} else if (form.libelletache.value == "") {
			alert( "Vous devez fournir un libelle." );
			document.getElementById('libelletache').focus();
			return false;	
		} else if (document.getElementById('dureetache').value == "") {
			alert( "Vous devez fournir un duree." );
			document.getElementById('dureetache').focus();
			return false;	
		} 	
			return true;
	}

function on_valid_modifier_tache(pscript_php)
{
	var form = document.form_tache_view;
	form = eval(form);
	//ce formulaire existe -t-il ?
	if (form)
	{//oui on peut poursuivre l'exécution du script
		
		//fabriquer les données à poster
		var data = "";
		data = 'codeprofil=' + form.codeprofil.value;
		data = data + "&ajax=1";	//notifier que l'appel de pscript vient d'ajax
		data = data + "&libprofil=" + form.libprofil.value;

		//exécuter AJAX	
		sendData('div_status', data , pscript_php , 'GET');
	}
}

function on_valid_creer_tache(pscript_php)
{   
	var form = document.form_create_tache;
	form = eval(form);
	//ce formulaire existe -t-il ?
	if (form)
	{//oui on peut poursuivre l'exécution du script
		
		//fabriquer les données à poster
		var data = "";
		data = 'numerotache=' + form.numerotache.value;
		data = data + "&ajax=1";	//notifier que l'appel de pscript vient d'ajax
		data = data + "&libelletache=" + form.libelletache.value;
        data = data + "&dureetache=" + document.getElementById('dureetache').value;
 		
		//exécuter AJAX	
		sendData('div_status', data , pscript_php , 'POST');
	}
}

/**
  @desc 	:	script exécuté lorsque le user valide la création d'une tâche
*/
function on_tache_create_valid()
{
	var form = document.getElementById('form_create_tache');
	form = eval(form);
	
	//ce formulaire existe -t-il ?
	if (form)
	{//oui on peut poursuivre l'exécution du script
	
		if (document.getElementById('libtache').value == "")
		{
			document.getElementById('system-message').style.display = 'block';
			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_libtache"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			document.getElementById('libtache').focus();
			return false;
		}
		/*else if (document.getElementById('dureetache').value == "")
		{
			document.getElementById('system-message').style.display = 'block';
			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_dureetache"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			return false;
		}*/
		else if (document.getElementById('dureetache').value != "")
		{
			if (! isFinite(document.getElementById('dureetache').value))
			{
				document.getElementById('system-message').style.display = 'block';
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["duree_must_be_integer"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				document.getElementById('dureetache').focus();
				return false;
			}
			else if (parseInt(document.getElementById('dureetache').value) < 0)
			{
				document.getElementById('system-message').style.display = 'block';
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["duree_must_be_positive"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				document.getElementById('dureetache').focus();
				return false;
			}
		}
		else if (document.getElementById('numprocessus').value == "")
		{
			document.getElementById('system-message').style.display = 'block';

			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_select_processus"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			document.getElementById('numprocessus').focus();
			return false;
		}
		
		form.submit();
		return true;
	}
	return false;
}


/*
script de validation modification tâche
*/
function on_tache_update_valid(pscript_php)
{
	var form = document.getElementById('form_tache_view');
	form = eval(form);
	
	//ce formulaire existe -t-il ?
	if (form)
	{//oui on peut poursuivre l'exécution du script
		if (form.libtache.value == "")
		{
			document.getElementById('system-message').style.display = 'block';
			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_libtache"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			return false;
		}
		/*else if (document.getElementById('dureetache').value == "")
		{
			document.getElementById('system-message').style.display = 'block';
			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_dureetache"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			return false;
		}*/
		else if (document.getElementById('dureetache').value != "")
		{
			if (! isFinite(document.getElementById('dureetache').value))
			{
				document.getElementById('system-message').style.display = 'block';
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["duree_must_be_integer"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				document.getElementById('dureetache').focus();
				return false;
			}
			else if (parseInt(document.getElementById('dureetache').value) < 0)
			{
				document.getElementById('system-message').style.display = 'block';
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["duree_must_be_positive"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				document.getElementById('dureetache').focus();
				return false;
			}
		}
		else if (document.getElementById('numprocessus').value == "")
		{
			document.getElementById('system-message').style.display = 'block';
			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_select_processus"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			document.getElementById('numprocessus').focus();
			return false;
		}

		/*form.submit();
		return true;*/
		//fabriquer les données à poster
		var data = "";
		data = 'numtache=' + document.getElementById('numtache').value;
		data = data + "&ajax=1";	//notifier que l'appel de pscript vient d'ajax
		data = data + "&libtache=" + (document.getElementById('libtache').value);
		data = data + "&dureetache=" + document.getElementById('dureetache').value;
		data = data + "&numprocessus=" + document.getElementById('numprocessus').value;
		data = data + "&typedoc=" + document.getElementById('typedoc').value;
		/*lparamurl = form.paramurl.value;
		lparamurl = lparamurl.replace("&","%26");
		lparamurl = lparamurl.replace("=","%3D");
		data = data + "&paramurl=" + lparamurl; */
		data = data + "&login=" + document.getElementById('login').value;
		data = data + "&lang=" + document.getElementById('lang').value;
		data = data + "&do=tache_update_valid";

		//exécuter AJAX	
		ldiv = document.getElementById('system-message');
		ldiv = eval(ldiv);
		if (ldiv)
		{
			document.getElementById('system-message').innerHTML = Translate["modif_en_cours"];
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
script de validation suppression d'une tâche
*/
function on_tache_delete_valid()
{
	var form = document.getElementById('form_tache_view');
	form = eval(form);
	
	//ce formulaire existe -t-il ?
	if (form)
	{//oui on peut poursuivre l'exécution du script
	
		if (confirm(Translate["confirm_delete_tache"]))
		{
			form.elements["do"].value = "tache_delete_valid"; 
			form.submit();
			return true;

		}
		
		return false;
	}
}