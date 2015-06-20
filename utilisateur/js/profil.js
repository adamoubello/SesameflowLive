// JavaScript Document

function afficher_div_profil_search() 
 {
	 
 var ldiv = document.getElementById("div_profil_search");
 var lchkbox = document.getElementById("checkbox_profil_search");
 
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
	    
		var form = document.form_create_profil;
		//var r = new RegExp("[\<|\>|\"|\'|\%|\;|\(|\)|\&]", "i");

		// do field validation
		if (trim(form.codeprofil.value) == "") {
			alert( "Vous devez fournir un code." );
			document.getElementById('codeprofil').focus();
			return false;
		} else if (form.libprofil.value == "") {
			alert( "Vous devez fournir un libelle." );
			document.getElementById('libprofil').focus();
			return false;	
		} 	
			return true;
	}


function on_valid_modifier_profil(pscript_php)
{
	var form = document.form_profil_view;
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

function on_valid_creer_profil(pscript_php)
{   
	var form = document.form_create_profil;
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
		sendData('div_status', data , pscript_php , 'POST');
	}
}

/**
  @desc 	:	script exécuté lorsque le user valide la création d'une profil
*/
function on_profil_create_valid()
{
	var form = document.getElementById('form_create_profil');
	form = eval(form);
	
	//ce formulaire existe -t-il ?
	if (form)
	{//oui on peut poursuivre l'exécution du script
	
		if (document.getElementById('libprofil').value == "")
		{
			document.getElementById('system-message').style.display = 'block';
			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_libprofil"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			return false;
		}

		form.submit();
		return true;
	}
	return false;
}


/*
script de validation modification profil
*/
function on_profil_update_valid(pscript_php , pdoc_url)
{
	var form = document.getElementById('form_profil_view');
	form = eval(form);
	
	//ce formulaire existe -t-il ?
	if (form)
	{//oui on peut poursuivre l'exécution du script
		if (form.libprofil.value == "")
		{
			document.getElementById('system-message').style.display = 'block';
			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_libprofil"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			return false;
		}

		/*form.submit();
		return true;*/
		//fabriquer les données à poster
		var data = "";
		data = 'codeprofil=' + escape(form.codeprofil.value);
		data = data + "&ajax=1";	//notifier que l'appel de pscript vient d'ajax
		data = data + "&libprofil=" + form.libprofil.value;
		data = data + "&login=" + escape(form.login.value);
		data = data + "&lang=" + escape(form.lang.value);
		data = data + "&do=profil_update_valid";

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
	}
}


/*
script de validation suppression d'un profil
*/
function on_profil_delete_valid()
{
	var form = document.getElementById('form_profil_view');
	form = eval(form);
	
	//ce formulaire existe -t-il ?
	if (form)
	{//oui on peut poursuivre l'exécution du script
	
		if (confirm(Translate["confirm_delete_profil"]))
		{
			form.elements["do"].value = "profil_delete_valid"; 
			form.submit();
			return true;
		}
		return false;
	}
}