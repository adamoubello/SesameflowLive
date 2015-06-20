//Document javascript
/**
 * @version		1.0
 * @package		installation
 * @subpackage	installation
 * @copyright (C) 2009 INTERFACE SA. Tous droits réservés
 * @license		INTERFACE SA
 * @author 		Xaverie Télédzina<onana_carine@yahoo.fr>
 * @desc		Script d'installation de l'application
 * @creationdate 
 * @updates 
 *	
  */


function on_etape3_valid (pscript_php)
{ 
	//alert('bobo');
	var form =document.getElementById('form_instal3');
	form = eval(form);//ce formulaire existe-t-il?
	
	
	if (form)
	{//oui on peut poursuivre l'exécution
		if (document.getElementById('typebd').value == "")
		{

			document.getElementById('system-message').style.display = 'block';
			//document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_libconfi"];
			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_typebd"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			document.getElementById('typebd').focus();
			return false;
		}
		else if (document.getElementById('hotebd').value == "")
		{

			document.getElementById('system-message').style.display = 'block';
			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_hotebd"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			document.getElementById('hotebd').focus();
			return false;
		}

		else if (document.getElementById('userbd').value == "")
		{
			document.getElementById('system-message').style.display = 'block';
			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_userbd"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			document.getElementById('userbd').focus();
			return false;
		}

		else if (document.getElementById('nombd').value == "")
		{
			document.getElementById('system-message').style.display = 'block';
			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_nombd"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			document.getElementById('nombd').focus();
			return false;
		}
		else if (document.getElementById('hotesite').value == "")
		{
			document.getElementById('system-message').style.display = 'block';
			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_hotesite"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			document.getElementById('hotesite').focus();
			return false;
		}
		else if (document.getElementById('portsite').value == "")
		{
			document.getElementById('system-message').style.display = 'block';
			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_portsite"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			document.getElementById('portsite').focus();
			return false;
		}
		else if (document.getElementById('portsite').value != "")
		{
			if (! isFinite(document.getElementById('portsite').value))
			{
				document.getElementById('system-message').style.display = 'block';
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["portsite_must_be_integer"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				document.getElementById('portsite').focus();
				return false;
			}
			else if (parseInt(document.getElementById('portsite').value) < 0)
			{
				document.getElementById('system-message').style.display = 'block';
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["portsite_must_be_positive"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				document.getElementById('portsite').focus();
				return false;
			}
		}
				//document.getElementById('etape').value=4;
			
			form.submit();
			
			return false;
		
		/*//fabriquer les données à poster
		var data = "";
		data = 'typebd=' + document.getElementById('typebd').value;
		data = data + "&ajax=1";	//notifier que l'appel de pscript vient d'ajax
		data = data + "&hotebd=" + document.getElementById('hotebd').value;
		data = data + "&userbd=" +  document.getElementById('userbd').value;
		data = data + "&pwdbd=" +  document.getElementById('pwdbd').value;
		data = data + "&nombd=" +  document.getElementById('nombd') .value;
		data = data + "&hotesite=" +  document.getElementById('hotesite').value;
		data = data + "&portsite=" +  document.getElementById('portsite').value;
		//data = data + "&login=" +  document.getElementById('login').value;
		data = data + "&lang=" +  document.getElementById('lang').value;
		data = data + "&etape=";
		

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
				}.,
		 		onFailure : function(resp) 
		 		{  alert('gfdf');
		 			alert("Oops, there's been an error with Ajax.");
		   			ldiv.style.display = 'none';
		 		},
		 		parameters : data
			}
		);*/
		
	}
}


	function on_etape6_valid(){
	var form = document.getElementById('form_instal6');
	form = eval (form);
	
	if (form)
	{
		if (document.getElementById('passworduser').value == "")
			{
	
				document.getElementById('system-message').style.display = 'block';
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_password"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				document.getElementById('passworduser').focus();
				return false;
			}
			else if (document.getElementById('passwordv').value == "")
			{
	
				document.getElementById('system-message').style.display = 'block';
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_passwordv"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				document.getElementById('passwordv').focus();
				return false;
			}else if (document.getElementById('passworduser').value!=document.getElementById('passwordv').value)
			{
				document.getElementById('system-message').style.display = 'block';
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_meme_password"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				form.reset();
				document.getElementById('passworduser').focus();
				return false;
			}
				form.submit();
				
				return false;
		}
			
	}
function Confirm_Ok_Cancel()
{
	 var respConfirmation= confirm(Translate["confirm_quit"]);
	 if (respConfirmation== true)
	 {
	 	window.location='/' ;
	 }
}