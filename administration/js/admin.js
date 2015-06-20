//Document javascript
/**
 * @version		1.0
 * @package		ADMINISTRATION
 * @subpackage	ADMINISTRATION
 * @copyright (C) 2009 INTERFACE SA. Tous droits réservés
 * @license		INTERFACE SA
 * @author 		Xaverie Télédzina<onana_carine@yahoo.fr>
 * @desc		Script de fonctionnalités du module administration
 * @creationdate mardi 16 juin 2009
 * @updates 
 *	 le modifié 6 août 2009, pwdbd n'est pas un paramètre obligatoirement présent
  */

//Xaverie voir groupe.js


function on_config_update_valid (pscript_php)
{
	
	var form =document.getElementById('form_config_view');
	form = eval(form);//ce formulaire existe-t-il?
	var lchkbox_paie = document.getElementById('chkbox_paie');
	lchkbox_paie = eval(lchkbox_paie); 	
	
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
		
		//fabriquer les données à poster
		var data = "";
		data = 'typebd=' + document.getElementById('typebd').value;
		data = data + "&ajax=1";	//notifier que l'appel de pscript vient d'ajax
		data = data + "&hotebd=" + document.getElementById('hotebd').value;
		data = data + "&userbd=" +  document.getElementById('userbd').value;
		data = data + "&pwdbd=" +  document.getElementById('pwdbd').value;
		data = data + "&nombd=" +  document.getElementById('nombd') .value;
		data = data + "&uniteduree_process=" +  document.getElementById('uniteduree_process').value;
		data = data + "&uniteduree_circuit=" +  document.getElementById('uniteduree_circuit').value;
		data = data + "&uniteduree_tache=" +  document.getElementById('uniteduree_tache').value;
		data = data + "&listlimit=" +  document.getElementById( 'listlimit').value;
		data = data + "&notifmail=" +  document.getElementById('notifmail').value;
		data = data + "&hotesite=" +  document.getElementById('hotesite').value;
		data = data + "&portsite=" +  document.getElementById('portsite').value;
		data = data + "&login=" +  document.getElementById('login').value;
		data = data + "&logosite=" +  document.getElementById('logosite').value;
		data = data + "&lang=" +  document.getElementById('lang').value;
		data = data + "&do=config_update_valid";
		

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


//Document javascript
/**
 * @version		1.0
 * @package		ADMINISTRATION
 * @subpackage	ADMINISTRATION
 * @copyright (C) 2009 INTERFACE SA. Tous droits réservés
 * @license		INTERFACE SA
 * @author 		Xaverie Télédzina<onana_carine@yahoo.fr>
 * @desc		Script de fonctionnalités du module administration
 * @creationdate Lundi 17 Août 2009
 * @updates 
 *	 
  */

//Xaverie voir groupe.js

function on_paie_param_valid (pscript_php)
{
	
	var form =document.getElementById('form_module');
	form = eval(form);//ce formulaire existe-t-il?
	
	if (form)
	{//oui on peut poursuivre l'exécution
		if (document.getElementById('typebd').value == "")
			{

				document.getElementById('system-message').style.display = 'block';
				//document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_libconfi"];
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_typebdpaie"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				document.getElementById('typebd').focus();
				return false;
			}
			else if (document.getElementById('hotebd').value == "")
			{

				document.getElementById('system-message').style.display = 'block';
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_hotebdpaie"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				document.getElementById('hotebd').focus();
				return false;
			}

			else if (document.getElementById('userbd').value == "")
			{
				document.getElementById('system-message').style.display = 'block';
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_userbdpaie"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				document.getElementById('userbd').focus();
				return false;
			}

			else if (document.getElementById('nombd').value == "")
			{
				document.getElementById('system-message').style.display = 'block';
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_nombdpaie"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				document.getElementById('nombd').focus();
				return false;
			}
		}
		
		form_elements_to_string2();
			
		//fabriquer les données à poster
		var data = "";
		data = 'typebd=' + document.getElementById('typebd').value;
		data = data + "&ajax=1";	//notifier que l'appel de pscript vient d'ajax
		data = data + "&hotebd=" +  document.getElementById('hotebd').value;
		data = data + "&userbd=" +  document.getElementById('userbd').value;
		data = data + "&pwdbd=" +  document.getElementById('pwdbd').value;
		data = data + "&nombd=" +  document.getElementById('nombd').value;
		data = data + "&codemod=" + document.getElementById('codemod').value;		
		data = data + "&login=" +  document.getElementById('login').value;
		data = data + "&lang=" +  document.getElementById('lang').value;
		data = data + "&liste_elements=" +  document.getElementById('liste_elements').value;
		data = data + "&do=paie_param_update";
		

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
	
	
function on_rh_param_valid (pscript_php)
{
	var form =document.getElementById('form_module');
	form = eval(form);//ce formulaire existe-t-il?
	
	if (form)
	{//oui on peut poursuivre l'exécution
		if (document.getElementById('typebd').value == "")
			{

				document.getElementById('system-message').style.display = 'block';
				//document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_libconfi"];
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_typebdrh"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				document.getElementById('typebd').focus();
				return false;
			}
			else if (document.getElementById('hotebd').value == "")
			{

				document.getElementById('system-message').style.display = 'block';
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_hotebdrh"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				document.getElementById('hotebd').focus();
				return false;
			}

			else if (document.getElementById('userbd').value == "")
			{
				document.getElementById('system-message').style.display = 'block';
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_userbdrh"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				document.getElementById('userbd').focus();
				return false;
			}

			else if (document.getElementById('nombd').value == "")
			{
				document.getElementById('system-message').style.display = 'block';
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_nombdrh"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				document.getElementById('nombd').focus();
				return false;
			}
		}
		
		form_elements_to_string2 ();
			
		//fabriquer les données à poster
		var data = "";
		data = 'typebd=' + document.getElementById('typebd').value;
		data = data + "&ajax=1";	//notifier que l'appel de pscript vient d'ajax
		data = data + "&hotebd=" + document.getElementById('hotebd').value;
		data = data + "&userbd=" + document.getElementById('userbd').value;
		data = data + "&pwdbd=" + document.getElementById('pwdbd').value;
		data = data + "&nombd=" + document.getElementById('nombd').value;		
		data = data + "&login=" + document.getElementById('login').value;
		data = data + "&lang=" + document.getElementById('lang').value;
		data = data + "&codemod=" + document.getElementById('codemod').value;
		data = data + "&liste_elements=" + document.getElementById('liste_elements').value;
		data = data + "&do=rh_param_update";
		

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


function set_permission_action(paction , petat)
{
	paction = document.getElementById(paction);
	paction = eval(paction);
	if (paction)
	{
		paction.checked = petat;
	}
}

/**
 fonction qui coche toutes les fontionnalités d'un module
*/

//mettre les modules en miniscule sinon ça ne marche pas,vérifié par Xaverie le 10 Août 2009

function set_all_permission(pmodule , petat)
{
	
	var laction  = null;
	switch(pmodule)
	{
		case "circuit" :
			set_permission_action("circuit_search" , petat);
			set_permission_action("circuit_view" , petat);
			set_permission_action("cir_create1" , petat);
			set_permission_action("circuit_create_valid" , petat);
			set_permission_action("circuit_update_valid" , petat);			
			set_permission_action("circuit_delete" , petat);
			set_permission_action("circuit_delete_valid" , petat);
			
			  
		break;
		case "groupe" :
			set_permission_action("groupe_search" , petat);
			set_permission_action("groupe_view" , petat);
			set_permission_action("groupe_create" , petat);
			set_permission_action("groupe_create_valid" , petat);
			set_permission_action("groupe_update_valid" , petat);			
			set_permission_action("groupe_delete_valid" , petat);
			 
			  
		break;
		case "processus" :
			set_permission_action("processus_search" , petat);
			set_permission_action("processus_view" , petat);
			set_permission_action("processus_create" , petat);
			set_permission_action("processus_create_valid" , petat);
			set_permission_action("processus_update_valid" , petat);
			set_permission_action("processus_delete_valid" , petat);
			 
			  
		break;
		
		case "document" :
			set_permission_action("doc_search" , petat);
			set_permission_action("doc_view" , petat);
			set_permission_action("doc_create" , petat);
			set_permission_action("doc_create_valid" , petat);
			set_permission_action("doc_update_valid" , petat);
			set_permission_action("doc_delete_valid" , petat);
			 
			  
			
			break;
		case "droit" :
		case "permission" :
			/*set_permission_action("droa_search" , petat);
			set_permission_action("droa_view" , petat);
			set_permission_action("droa_create" , petat);*/
			set_permission_action("droa_update_valid" , petat);

			break;
		case "departement" :
			set_permission_action("dep_search" , petat);
			set_permission_action("dep_view" , petat);
			set_permission_action("dep_create" , petat);
			set_permission_action("dep_create_valid" , petat);
			set_permission_action("dep_update_valid" , petat);
			set_permission_action("dep_delete_valid" , petat);			
			  
			  
			
		break;
		case "service" :
			set_permission_action("dep_search" , petat);
			set_permission_action("dep_view" , petat);
			set_permission_action("dep_create" , petat);
			set_permission_action("dep_create_valid" , petat);
			set_permission_action("dep_update_valid" , petat);
			set_permission_action("dep_delete_valid" , petat);			
			  
			  
		break;
		
		case "mail" :
			set_permission_action("mail_search" , petat);
			set_permission_action("mail_view" , petat);
			set_permission_action("mail_create" , petat);
			set_permission_action("mail_create_valid" , petat);
			set_permission_action("mail_update_valid" , petat);
			set_permission_action("mail_delete_valid" , petat);
			set_permission_action("mail_archive" , petat);
			set_permission_action("mail_param" , petat);
			set_permission_action("mail_historic" , petat);
			set_permission_action("mail_param_save" , petat);
			set_permission_action("mail_send_valid" , petat);
			set_permission_action("mail_log" , petat);
			  
			  
		break;
		
		case "profil" :
		case "fonction" :
			set_permission_action("profi_search" , petat);
			set_permission_action("profi_view" , petat);
			set_permission_action("profi_create" , petat);
			set_permission_action("profi_create_valid" , petat);
			set_permission_action("profi_update_valid" , petat);
			set_permission_action("profi_delete_valid" , petat);
			  
		break;
		
		case "tache" :
			set_permission_action("tache_search" , petat);
			set_permission_action("tache_view" , petat);
			set_permission_action("tache_create" , petat);
			set_permission_action("tache_create_valid" , petat);
			set_permission_action("tache_update_valid" , petat);
			set_permission_action("tache_delete_valid" , petat);
			  
			  
		break;
		case "utilisateur" :
			set_permission_action("user_search" , petat);
			set_permission_action("user_view" , petat);
			set_permission_action("user_create" , petat);
			set_permission_action("user_create_valid" , petat);
			set_permission_action("user_update_valid" , petat);
			set_permission_action("user_delete_valid" , petat);
			  
			  
		break;
		case "workflow" :
			set_permission_action("workflow_search" , petat);
			set_permission_action("workflow_view" , petat);
			set_permission_action("workflow_create" , petat);
			set_permission_action("workflow_create_valid" , petat);
			set_permission_action("workflow_update_valid" , petat);
			set_permission_action("workflow_delete_valid" , petat);
			  
			  
		break;
	}
	
	 if (petat == true) document.getElementById(pmodule).focus();
	else document.getElementById("any_" + pmodule).focus();
}

//fonction qui active ou désactive l'interfaçage avec la paye
function on_interfacage_paie()
{
	var lchkbox_paie = document.getElementById('chkbox_paie');
	lchkbox_paie = eval(lchkbox_paie);
	if (lchkbox_paie)
	{
		if(! lchkbox_paie.checked)
		{
			document.getElementById('typebd').disabled =true;
			document.getElementById('hotebd').disabled = true;
			document.getElementById('userbd').disabled = true;
			document.getElementById('pwdbd').disabled = true;
			document.getElementById('nombd').disabled = true;
			
		}
		else
		{
			document.getElementById('typebd').disabled = false;
			document.getElementById('hotebd').disabled = false;
			document.getElementById('userbd').disabled = false;
			document.getElementById('pwdbd').disabled = false;
			document.getElementById('nombd').disabled = false;
		}
	}
}


/*
 fonction appelée pour la désactivation/activation d'un module
 param	-	string - pcodemod  - code d'un module
 param	-	string	-	pscript_php	- chemin absolu vers le script php à exécuter par ajax
 param	-	string	-	pdoc_url	-	url absolu du site wb
 param	-	integer	-	pindex	-	index de la ligne module dans la grille de module
 	Cet index permet de retrouver le code d'activation/dsactivation
*/
function on_onoff_module (pcodemod , pscript_php , pdoc_url, pthis , pindex)
{
	var form =document.getElementById('form_config_view');
	form = eval(form);//ce formulaire existe-t-il?
	
	//if (form)
	{
		//fabriquer les données à poster
		var data = "";
		data = 'codemod=' + pcodemod;
		data = data + "&ajax=1";	//notifier que l'appel de pscript vient d'ajax
		
		//obtenir l'état en cours à envoyer
		var letatmod = document.getElementById('etatmod'+ parseInt(pindex));
		letatmod = eval(letatmod);
		var letatvalue = 0;
		if (letatmod) 
		{
			letatvalue = letatmod.value;
		}
		
		data = data + "&etatmod=" + letatvalue;	//notifier que etat = 0 si désactivation, 1 si activation
		data = data + "&login=" + document.getElementById('login').value;
		data = data + "&lang=" + document.getElementById('lang').value;
		data = data + "&do=module_activer_valid";
		

		//exécuter AJAX	
		ldiv = document.getElementById('system-message');
		ldiv = eval(ldiv);
		if (ldiv)
		{
			document.getElementById('system-message').innerHTML = '<img src="' + pdoc_url + '/images/loading_moz.gif" />&nbsp;&nbsp;' + Translate["desactivation_en_cours"];
			ldiv.style.display = 'block';
		}
						
		new Ajax.Request
		(
			pscript_php,
			{
				onSuccess : function(resp) 
				{
					document.getElementById('system-message').innerHTML = resp.responseText;
					
					var letatmod2 = document.getElementById('etatmod'+ parseInt(pindex));
					letatmod2 = eval(letatmod2);
					if (letatmod2)
					{
						if (parseInt(letatmod2.value) == 1)
						{
							letatmod2.value = 0;
							pthis = eval(pthis);
							if (pthis)
							{
								pthis.value = Translate["desactiver"];
							}
							
						}
						else 
						{
							letatmod2.value = 1;
							pthis = eval(pthis);
							if (pthis)
							{
								pthis.value = Translate["activer"];
							}
						}
					}
					
					//afficher ou rendre invisible le panel corespondant au module
					var lpanel;
					lpanel = document.getElementById("panel_" + pcodemod);
					lpanel = eval(lpanel);
					if (lpanel)
					{
						if (parseInt(letatmod2.value) == 0) lpanel.style.display = 'block'; 
						else  lpanel.style.display = 'none';
					}
					
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


function form_elements_to_string2 ()
{
	var liste_elements="";
	var i;
   
	    var lelement;
	    	var lform=document.getElementById('form_module');
    	lform = eval(lform);  
    	if (lform) {
    		for (i=0; i < lform.elements.length; i++){
    			lelement=lform.elements[i];
    			lelement=eval(lelement);

    			if(lelement)
    			{
    				if (lelement.name)
    				{
    					if (liste_elements=="")
    					{
    						liste_elements=lelement.name + "/" + lelement.type;
    					}
    					else
    					{
    						liste_elements=liste_elements + ";" + (lelement.name + "/" + lelement.type);
    					}
    				}
    			}
    		}
    		document.getElementById('liste_elements').value=liste_elements;
    	}   	    	
        return true;
}

function on_test_connexion_database (pscript_php , pdoc_url)
{
	var form =document.getElementById('form_config_view');
	form = eval(form);//ce formulaire existe-t-il?
	
	//if (form)
	{
		//fabriquer les données à poster
		var data = "";
		data = 'typebd=' + document.getElementById('typebd').value;
		data = data + '&hotebd=' + document.getElementById('hotebd').value;
		data = data +  '&userbd=' + document.getElementById('userbd').value;
		data = data +  '&pwdbd=' + document.getElementById('pwdbd').value;
		data = data +  '&nombd=' + document.getElementById('nombd').value;
		data = data +  '&lang=' + document.getElementById('lang').value;
		data = data + "&ajax=1";	//notifier que l'appel de pscript vient d'ajax
		data = data + "&codemod=sesameflow";	//notifier que l'appel de pscript vient de la configuration de sesameflow
		
		//exécuter AJAX	
		ldiv = document.getElementById('system-message');
		ldiv = eval(ldiv);
		if (ldiv)
		{
			document.getElementById('system-message').innerHTML = '<img src="' + pdoc_url + '/images/loading_moz.gif" />&nbsp;&nbsp;' + Translate["test_connect_database_en_cours"];
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
