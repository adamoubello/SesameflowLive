// JavaScript Document

function afficher_div_dep_search() 
 {
	 
 var ldiv = document.getElementById("div_dep_search");
 var lchkbox = document.getElementById("checkbox_dep_search");
 
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
	@name		:	traitement javascript � effectuer lorsque l'utilisateur valide les donn�es modifi�es
	@date		:	14 juillet 2009
	@param		:	pscript - chemin d'acc�s au script php � ex�cuter par ajax
	@description	:	cette fonction fait un appel � ajax
	Le r�sultat sera envoy� dans le div ayant l'id div_status
	Apr�s l'ex�cution du scipt php, on reverra dans ce div, le r�sultat de la tentative de mise � jour
*/

function soumet() {
	    
		var form = document.form_create_departement;
		//var r = new RegExp("[\<|\>|\"|\'|\%|\;|\(|\)|\&]", "i");

		// do field validation
		if (trim(form.codedep.value) == "") {
			alert( "Vous devez fournir un numero." );
			document.getElementById('codedep').focus();
			return false;
		} else if (form.libdep.value == "") {
			alert( "Vous devez fournir un libelle." );
			document.getElementById('libdep').focus();
			return false;	
		} 	
			return true;
	}

function on_valid_creer_dep(pscript_php)
{   
	var form = document.form_create_departement;
	form = eval(form);
	//ce formulaire existe -t-il ?
	if (form)
	{//oui on peut poursuivre l'ex�cution du script
		
		//fabriquer les donn�es � poster
		var data = "";
		data = 'codedep=' + form.codedep.value;
		data = data + "&ajax=1";	//notifier que l'appel de pscript vient d'ajax
		data = data + "&libdep=" + form.libdep.value;
        
		//ex�cuter AJAX	
		sendData('div_status', data , pscript_php , 'POST');
	}
}

/**
  @desc 	:	script ex�cut� lorsque le user valide la cr�ation d'une t�che
*/
function on_dep_create_valid()
{
	var form = document.getElementById('form_create_departement');
	form = eval(form);
	
	//ce formulaire existe -t-il ?
	if (form)
	{//oui on peut poursuivre l'ex�cution du script
	
		if (document.getElementById('libdep').value == "")
		{
			document.getElementById('system-message').style.display = 'block';
			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_libdep"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			return false;
		}

		form.submit();
		return true;
	}
	return false;
}


/*
script de modification d'un d�partement
*/
function on_dep_update_valid(pscript_php , pdoc_url)
{
	var form = document.getElementById('form_departement_view');
	form = eval(form);
	
	//ce formulaire existe -t-il ?
	if (form)
	{//oui on peut poursuivre l'ex�cution du script
		if (form.libdep.value == "")
		{
			document.getElementById('system-message').style.display = 'block';
			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_libdep"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			return false;
		}

		//fabriquer les donn�es � poster
		var data = "";
		data = 'codedep=' + escape(form.codedep.value);
		data = data + "&ajax=1";	//notifier que l'appel de pscript vient d'ajax
		data = data + "&libdep=" + escape(form.libdep.value);
		data = data + "&login=" + escape(form.login.value);
		data = data + "&lang=" + escape(form.lang.value);
		data = data + "&do=dep_update_valid";

		//ex�cuter AJAX	
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
script de suppression d'un d�partement
*/
function on_dep_delete_valid()
{
	var form = document.getElementById('form_departement_view');
	form = eval(form);
	
	//ce formulaire existe -t-il ?
	if (form)
	{//oui on peut poursuivre l'ex�cution du script
	
		if (confirm(Translate["confirm_delete_departement"]))
		{
			form.elements["do"].value = "dep_delete_valid"; 
			form.submit();
			return true;
		}
		return false;
	}
}