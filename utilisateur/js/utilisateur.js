// JavaScript Document

function verification_recherche() 
{

			  	//<!--if (!(formsearch.submit()))
				//{ alert ("Saisies incorrectes"); }-->
					  
			 	if (document.getElementById('nom').value == "" )
				{
				  		alert("Veuillez saisir le nom de l'utilisateur recherché");
				  		document.getElementById('nom').focus();
				  		return false;
				}	
								
				//formsearch1 = document.getElementById('form-search');
//				formsearch1.submit();  					  	 				
//				return true;
								
				formusearch1 = document.adminForm;
				formusearch1.submit();  					  	 				
				return true;
  }
  

function afficher_div_user_search() 
 {
	 
 var ldiv = document.getElementById("div_user_search");
 var lchkbox = document.getElementById("checkbox_user_search");
 
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
  


/*
script de validation suppression d'un utilisateur
*/
function on_user_delete_valid()
{
	var form = document.getElementById('form_user_view');
	form = eval(form);
	
	//ce formulaire existe -t-il ?
	if (form)
	{//oui on peut poursuivre l'exécution du script
	
		if (confirm(Translate["confirm_delete_user"]))
		{
			form.elements["do"].value = "user_delete_valid"; 
			form.submit();
			return true;
		}
		
		return false;
	}
} 


function afficheId(baliseId)
{
  if (document.getElementById && document.getElementById(baliseId) != null)
    {
    document.getElementById(baliseId).style.visibility='visible';
    document.getElementById(baliseId).style.display='block';
    return;
	}
	//cacheId('accueil');
}

  
function cacheId(baliseId)
{
  if (document.getElementById && document.getElementById(baliseId) != null)
    {
    document.getElementById(baliseId).style.visibility='hidden';
    document.getElementById(baliseId).style.display='none';
	return;
	
    }
	//afficheId('accueil');
}

  
function afficheetcache(id1,id2)
{
  if ((document.getElementById && document.getElementById(id1) != null) && (document.getElementById && document.getElementById(id2) != null))
    {
    document.getElementById(id1).style.visibility='visible';
    document.getElementById(id1).style.display='block';
	document.getElementById(id2).style.visibility='hidden';
    document.getElementById(id2).style.display='none';
	//return;
    }
	//cacheId('accueil');
}
 

function soumet() {
	
		var form = document.form_create_user;
		var r = new RegExp("[\<|\>|\"|\'|\%|\;|\(|\)|\&]", "i");

		// do field validation
		if (trim(form.code.value) == "") {
			alert( "Vous devez fournir un code." );
			document.getElementById('code').focus();
			return false;
		} else if (form.name.value == "") {
			alert( "Vous devez fournir un nom." );
			document.getElementById('name').focus();
			return false;	
		} else if (form.surname.value == "") {
			alert( "Vous devez fournir un prnom." );
			document.getElementById('surname').focus();
			return false;	
		} else if (trim(form.email.value) == "") {
			alert( "Vous devez fournir une adresse email." );
			document.getElementById('email').focus();
			return false;
		} else if (form.login.value == "") {
			alert( "Vous devez fournir un login valide." );
			document.getElementById('login').focus();
			return false;
		} else if (r.exec(form.login.value) || form.login.value.length < 4) {
			alert( "Votre login contient des caractres non-valides ou est trop court." );
			document.getElementById('login').focus();
			return false;
		} else if (form.password.value == "") {
			alert( "Vous devez fournir un mot de passe valide." );
			document.getElementById('password').focus();
			return false;
		} else if (r.exec(form.password.value) || form.password.value.length < 6) {
			alert( "Votre mot de passe contient des caractres non-valides ou est trop court." );
			document.getElementById('password').focus();
			return false;
		} else if (((trim(form.password.value) != "") || (trim(form.password2.value) != "")) && (form.password.value != form.password2.value)){
			alert( "Les mots de passe entrs ne sont pas identiques." );
			document.getElementById('password').focus();
			return false;
        } else if (form.block.value == "") {
			alert( "Prcisez si vous tes chef ou pas." );
			document.getElementById('block').focus();
			return false;
		} else if (trim(form.ville.value) == "") {
			alert( "Vous devez fournir une ville." );
			document.getElementById('ville').focus();
			return false;
		} else if (form.pays.value == "") {
			alert( "Vous devez fournir un pays." );
			document.getElementById('pays').focus();
			return false;	
		} else if (form.telpor.value == "") {
			alert( "Vous devez fournir un numro de tlphone portable." );
			document.getElementById('telpor').focus();
			return false;	
		} else if (trim(form.telbur.value) == "") {
			alert( "Vous devez fournir un numro de tlphone de bureau." );
			document.getElementById('telbur').focus();
			return false;
		} else if (form.fax.value == "") {
			alert( "Vous devez fournir un numro de fax." );
			document.getElementById('fax').focus();
			return false;
		} else if (form.datenaiss.value == "") {
			alert( "Vous devez fournir une date de naissance." );
			document.getElementById('datenaiss').focus();
			return false;
		} else if (form.categorie.value == "") {
			alert( "Vous devez fournir une catgorie." );
			document.getElementById('categorie').focus();
			return false;
		} else if (form.type.value == "") {
			alert( "Vous devez fournir un type." );
			document.getElementById('type').focus();
			return false;
		} 	
					
			//login1 = document.getElementById('form_create_user');
			//login1.submit(); 
			
			return true;
						        
	}

	
/*
script de validation de la modification d'un utilisateur
*/
function on_user_update_valid(pscript_php)
{
	var form = document.getElementById('form_view_user');
	form = eval(form);
	
	//ce formulaire existe -t-il ?
	if (form)
	{//oui on peut poursuivre l'exécution du script
	
		if (form.nomuser.value == "")
		{
			document.getElementById('system-message').style.display = 'block';
			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_nomuser"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			form.nomuser.focus();
			return false;
		}
		else if (form.loginuser.value == "")
		{
				document.getElementById('system-message').style.display = 'block';
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_loginuser"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				form.loginuser.focus();
				return false;
		}
		else if (form.passworduser.value == "")
		{
			document.getElementById('system-message').style.display = 'block';
			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_passworduser"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			form.passworduser.focus();
			return false;
		}
		else if (form.password2.value == "")
		{
			document.getElementById('system-message').style.display = 'block';

			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_passworduser2"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			form.password2.focus();
			return false;
		}
		else if (form.passworduser.value != form.password2.value)
		{
			document.getElementById('system-message').style.display = 'block';

			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_match_user_passwords"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			form.password2.focus();
			return false;
		}		
		else if (form.codegroup.value == "")
		{
			document.getElementById('system-message').style.display = 'block';

			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_select_group"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			form.codegroup.focus();
			return false;
		}
		

		//fabriquer les données à poster
		var data = "";
		data = 'nomuser=' + (form.nomuser.value);
		data = data + "&ajax=1";	//notifier que l'appel de pscript vient d'ajax
		data = data + "&codeuser=" + (form.codeuser.value);
		data = data + "&prenomuser=" + (form.prenomuser.value);
		data = data + "&emailuser=" + (form.emailuser.value);
		data = data + "&loginuser=" + (form.loginuser.value);
		data = data + "&passworduser=" + (form.passworduser.value);
		data = data + "&numteluser=" + (form.numteluser.value);
		data = data + "&numburuser=" + (form.numburuser.value);
		data = data + "&numfaxuser=" + (form.numfaxuser.value);
		data = data + "&datenaissanceuser=" + (form.datenaissanceuser.value);
		data = data + "&codegroup=" + (form.codegroup.value);
		data = data + "&villeuser=" + (form.villeuser.value);
		//data = data + "&paysuser=" + form.paysuser.value;
		data = data + "&codedep=" + (form.codedep.value);
		data = data + "&codeprofil=" + (form.codeprofil.value);
		data = data + "&login=" + (form.login.value);
		data = data + "&lang=" + (form.lang.value);
		data = data + "&do=user_update_valid";

		//exécuter AJAX	
		ldiv = document.getElementById('system-message');
		ldiv = eval(ldiv);
		if (ldiv)
		{
			pdoc_url = '';
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
					ldiv.style.display = 'block';
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
script de validation création utilisateur
*/
function on_user_create_valid()
{
	var form = document.getElementById('form_create_user');
	form = eval(form);
	
	//ce formulaire existe -t-il ?
	if (form)
	{//oui on peut poursuivre l'exécution du script
	
		if (form.nomuser.value == "")
		{
			document.getElementById('system-message').style.display = 'block';

			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_nomuser"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			form.nomuser.focus();
			return false;
		}
		else if (form.loginuser.value == "")
		{
				document.getElementById('system-message').style.display = 'block';
	
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_loginuser"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				form.loginuser.focus();
				return false;
		}
		else if (form.passworduser.value == "")
		{
			document.getElementById('system-message').style.display = 'block';

			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_passworduser"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			form.passworduser.focus();
			return false;
		}
		else if (form.password2.value == "")
		{
			document.getElementById('system-message').style.display = 'block';

			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_passworduser2"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			form.password2.focus();
			return false;
		}
		else if (form.passworduser.value != form.password2.value)
		{
			document.getElementById('system-message').style.display = 'block';

			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_match_user_passwords"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			form.password2.focus();
			return false;
		}
		else if (form.codegroup.value == "")
		{
			document.getElementById('system-message').style.display = 'block';

			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_select_group"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			form.codegroup.focus();
			return false;
		}

		form.submit();
		return true;
	}
}


function on_user_delete_valid()
{
	var form = document.getElementById('form_view_user');
	form = eval(form);
	
	//ce formulaire existe -t-il ?
	if (form)
	{//oui on peut poursuivre l'exécution du script
	
		if (confirm(Translate["confirm_delete_user"]))
		{
			form.elements["do"].value = "user_delete_valid"; 
			form.submit();
			return true;
		}
		
		return false;
	}
}










