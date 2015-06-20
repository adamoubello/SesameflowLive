// JavaScript Document
/**
 * @version		1.0
 * @package		GED
 * @subpackage	js
 * @copyright (C) 2009 INTERFACE SA. Tous droits réservés
 * @license		INTERFACE SA
 * @author 		William<william.nkingne@laposte.net>
 * @desc		Script de gestion des contrôles client javascript
 * @creationdate mardi 16 juin 2009
 * @updates 
 *			# mercredi 1 juillet 2009
 *		- ajout de la fonction on_doc_update_valid qui teste de la validité d'une mise à jour de formulaire
 *		- ajout de la fonction on_doc_delete_valid qui teste de la validité d'une mise à jour de formulaire	
 *			# mardi 14 juillet 2009
 ²		- ajout des fonctions ajout_ligne et suppression_ligne qui permettent l'ajout et la suppession d'une ligne dans le
 *		formulaire de demande d'achat
**/


function on_dde_achat_valid()
{
	var form = document.getElementById('form_dde_achat');
	form = eval(form);
	
	//ce formulaire existe -t-il ?
	if (form)
	{
	
		if (form.designation.value == "")
		{
			document.getElementById('system-message').style.display = 'block';

			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["saisir_designation"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			form.designation.focus();
			return false;
		}
		else if (form.objet.value != "")
		{
			document.getElementById('system-message').style.display = 'block';

			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["saisir_objet"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			form.objet.focus();
			return false;
		}
		else if ((form.date_deb.value == "") || (form.date_fin.value == ""))
		{
			document.getElementById('system-message').style.display = 'block';
			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["saisir_date"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			form.date_deb.focus();
			return false;
		}
		else if (form.observation.value == 0)
		{
			document.getElementById('system-message').style.display = 'block';
			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["saisir_observation"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			form.observation.focus();
			return false;
		}

		
		form.submit();
		return true;
	}
	return false;
}


function ajout_ligne(pdoc_url)
{

	var form = document.getElementById('form_doc_view');
	form = eval(form);
	
	//ce formulaire existe-t-il ?
	if (form)	{
		if (form.designation.value == ""){
			document.getElementById('system-message').style.display = 'block';

			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["saisir_designation"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			form.designation.focus();
			return false;
		}
		else if (form.objet.value == "") {
			document.getElementById('system-message').style.display = 'block';

			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["saisir_objet"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			form.objet.focus();
			return false;
		}
		else if ((form.date_deb.value == "") || (form.date_fin.value == "")) {
			document.getElementById('system-message').style.display = 'block';

			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["saisir_date"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			form.date_deb.focus();
			return false;
		}
		else if (trim(form.observation.value) == "") {
				document.getElementById('system-message').style.display = 'block';
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["saisir_observation"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				form.observation.focus();
				return false;
		}
		else {
			document.getElementById('system-message').style.display = 'none';
			
			var tableligne = document.getElementById('table_achat');
			
			AddRow(-1 , pdoc_url);
			form.nbr_achat.value = form.nbr_achat.value + 1;
		}
	}
}


function AddRow(pindex , pdoc_url) {
	
	    var newRow = document.getElementById('table_achat').insertRow(pindex);
		var nbreligne = document.getElementById('table_achat').rows.length;
		nbreligne = nbreligne - 1;	//ne pas compter la ligne THEAD
		newRow.id = "ligne" + nbreligne;
		
		var form = document.getElementById('form_doc_view');
		form = eval(form);
		var form_id = "'form_doc_view'";
		var table_id = "'table_achat'";
		var remove_id = "'remove" + nbreligne + "'";
		var ligne_id = "'ligne" + nbreligne + "'";

	    var newCell = newRow.insertCell(0);
	    newCell.innerHTML = '';
	    newCell0 = newRow.insertCell(0);
		newCell1 = newRow.insertCell(1);
		newCell2 = newRow.insertCell(2);
		newCell3 = newRow.insertCell(3);
		newCell4 = newRow.insertCell(4);
		newCell5 = newRow.insertCell(5);
		
		//document.getElementById('designation').value = document.getElementById("c1").value;		
		//newCell0.innerHTML = '<textarea disabled size="40" value="' + form.designation.value + '" ></textarea><input id="achat' + nbreligne + '" name="achat' + nbreligne + '" type="hidden" value="' + form.designation.value + '" />';		
		//newCell1.innerHTML = '<textarea disabled size="40" value="' + form.objet.value + '" ></textarea><input id="objet' + nbreligne + '" name="objet' + nbreligne + '" type="hidden" value="' + form.objet.value + '" />';
		
		newCell0.innerHTML = '<input type="text" disabled size="40" value="' + form.designation.value + '" /><input id="designation' + nbreligne + '" name="designation' + nbreligne + '" type="hidden" value="' + form.designation.value + '" />';
		newCell1.innerHTML = '<input type="text" disabled size="40" value="' + form.objet.value + '" /><input id="objet' + nbreligne + '" name="objet' + nbreligne + '" type="hidden" value="' + form.objet.value + '" />';
		newCell2.innerHTML = '<input type="text" disabled size="20" value="' + form.date_deb.value + '" /><input id="date_deb' + nbreligne + '" name="date_deb' + nbreligne + '" type="hidden" value="' + form.date_deb.value + '" />';
		newCell3.innerHTML = '<input type="text" disabled size="20" value="' + form.date_fin.value + '" /><input id="date_fin' + nbreligne + '" name="date_fin' + nbreligne + '" type="hidden" value="' + form.date_fin.value + '" />';
		newCell4.innerHTML = '<input type="text" disabled size="40" value="' + form.observation.value + '" /><input id="observation' + nbreligne + '" name="observation' + nbreligne + '" type="hidden" value="' + form.observation.value + '" />';

		//newCell4.innerHTML = '<textarea disabled size="40" value="' + form.observation.value + '" ></textarea><input id="observ' + nbreligne + '" name="observ' + nbreligne + '" type="hidden" value="' + form.observation.value + '" />';
		
		newCell5.innerHTML = '<a href="#" onclick="javascript:on_remove_achat(' + form_id + ' , ' + table_id + ' , ' +  ligne_id + ');" title="' + Translate["supprimer"] +  '" ><img src="' + pdoc_url + '/images/edit_remove.gif" /></a><input type="hidden"  id="position' + nbreligne + '"  name="position' + nbreligne + '"   value="' + nbreligne + '"   />'
		 + '&nbsp;<a href="#" onclick="javascript:down(' + nbreligne + ' , ' + ( nbreligne + 1) + ');" title="' + Translate["descendre"] +  '" ><img src="' + pdoc_url + '/images/down.gif" /></a>'
		+ '&nbsp;<a href="#" onclick="javascript:up(' + ligne_id + ');" title="' + Translate["monter"] + '" ><img src="' + pdoc_url + '/images/up.gif" /></a>';		
		
		form.getElementById('designation').value="";
		form.getElementById('objet').value='';
		form.getElementById('date_deb').value='';
		form.getElementById('date_fin').value='';
		form.getElementById('observation').value='';
}


function on_dde_remove(pform, ptable_id , pidligne) {
  var form = eval(document.getElementById(pform));
  var form_name = form.name;
  var lines_count = 0;
  var ltable = document.getElementById(ptable_id);
  ltable = eval(ltable);

  if(ltable) {
  	//obtenir le nombre de lignes du tableau
  	lines_count = ltable.rows.length ;
  }
  var i = 0;
  var lref_fourn;
  var j = -1;
  var k = -1;
  var check;
  var larr_row = new Array();

  // Fin vérification "lignes sélectionnés"

  {
  		lligne = eval( document.getElementById(pidligne));
        if (lligne) {
			j = eval(lligne.rowIndex);
			if (j){
			  // = check.parentNode.parentNode.rowIndex;
              ltable.deleteRow(j);
			  form.nbr_tache.value = form.nbr_tache.value - 1;
			}
		}
  }
}


function suppression_ligne(pform, ptable_id , pidligne)
{

	var form = eval(document.getElementById(pform));
		var form_name = form.name;
		var lines_count = 0;
		var ltable = document.getElementById(ptable_id);
		ltable = eval(ltable);

		if(ltable)
		{
			//obtenir le nombre de lignes du tableau
			lines_count = ltable.rows.length ;
		}
		var i = 0;
		var lref_fourn;
		var j = -1;
		var k = -1;
		var check;
		var larr_row = new Array();

		// Fin vérification "lignes sélectionnés"

		{
				lligne = eval( document.getElementById(pidligne));

				if (lligne)
				{
					alert(lligne.rowIndex);
					j = eval(lligne.rowIndex);
					if (j)
					{// = check.parentNode.parentNode.rowIndex;
						ltable.deleteRow(j);
						form.nbr_tache.value = form.nbr_tache.value - 1;
					}
				}
		}
}


function on_doc_delete_valid()
{
	var form = document.getElementById('form_doc_view');
	form = eval(form);
	//ce formulaire existe -t-il ?
	if (form)
	{//oui on peut poursuivre l'exécution du script
		if (confirm(Translate["confirm_delete_doc"]))
		{
			form.elements["do"].value = "doc_delete_valid";
			form.submit();
			return true;
		}		
		return false;
	}
}



function on_doc_update_valid(pscript_php)
{	 	
    var typedoc = document.getElementById('typedoc').value;    
    var form = document.getElementById('form_doc_view');
    form = eval(form);//ce formulaire existe -t-il ?
	
    switch (typedoc){
      case "dde_credit":
             if (form){//oui on peut poursuivre l'exécution du script
        	 if (form.date_credit.value == ""){
        		  document.getElementById('system-message').style.display = 'block';
        		  document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_date_credit"];
        		  document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
        		  form.date_credit.focus();
        			return false;
        	 }if (form.montant.value == ""){
        		  document.getElementById('system-message').style.display = 'block';
        		  document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_credit"];
        		  document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
        		  form.montant.focus();
        		  return false;
        	 }else if (isNaN(form.montant.value)){
                  document.getElementById('system-message').style.display = 'block';
        		  document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_credit"];
        		  document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
        		  form.montant.focus();
        		  return false;
        	 }else if (form.retenue.value == ""){
                  document.getElementById('system-message').style.display = 'block';
        		  document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_retenue"];
        		  document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
        		  form.retenue.focus();
        		  return false;
             }else if (! isFinite(form.retenue.value)){
        	   	  document.getElementById('system-message').style.display = 'block';
        		  document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_retenue"];
        		  document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
        		  form.retenue.focus();
        		  return false;
        	 }else if (form.nbr_annuite.value == ""){
        		  document.getElementById('system-message').style.display = 'block';
        		  document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_nbr_annuite"];
        		  document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
        		  form.nbr_annuite.focus();
        		  return false;
        	 }else if (parseInt(form.nbr_annuite.value) < 0)	{
        		  document.getElementById('system-message').style.display = 'block';
        		  document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_nbr_annuite"];
        		  document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
        		  form.nbr_annuite.focus();
        		  return false;
        	 }else if (form.annuite.value == ""){
        		  document.getElementById('system-message').style.display = 'block';
        		  document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_annuite"];
        		  document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
        		  form.annuite.focus();
        		  return false;
        	 }
            }
           
			form_elements_to_string ('form_doc_view');

        		//fabriquer les données à poster
        		var data = "";
                data = 'numdoc=' + form.numdoc.value;
        		data = data + "&ajax=1";
        		data = data + "&retenue=" + form.retenue.value;
        		data = data + "&numtache=" + form.numtache.value;
        		data = data + "&montant=" + form.montant.value;
        		//data = data + "&date_dde=" + form.date_dde.value;
        		data = data + "&date_credit=" + form.date_credit.value;
                data = data + "&nbr_annuite=" + form.nbr_annuite.value;
                //data = data + "&codeuser=" + form.codeuser.value;
        		data = data + "&lang=" + form.lang.value;
        		data = data + "&login=" + form.login.value;
        		data = data + "&annuite=" + form.annuite.value;
        		data = data + "&typedoc=" + form.typedoc.value;
        		//data = data + "&titredoc=" + form.titredoc.value;
                data = data + "&do=doc_update_valid";
      break;
      case "dde_conge":
            if (form){//oui on peut poursuivre l'exécution du script 
        	 if (form.date_deb_conge.value == ""){
        			document.getElementById('system-message').style.display = 'block';
        			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_deb_conge"];
        			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
        			form.date_deb_conge.focus();
        			return false;
        	 }
        	 if (form.date_fin_conge.value == ""){
        			document.getElementById('system-message').style.display = 'block';
        			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_fin_conge"];
        			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
        			form.date_fin_conge.focus();
        			return false;
        	 }
             if (form.motif.value == ""){
                  	document.getElementById('system-message').style.display = 'block';
        		  	document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_motif"];
        		  	document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
        		  	form.motif.focus();
        		  	return false;
        	 }
            }
        		//fabriquer les données à poster
        		var data = "";
                data = 'numdoc=' + form.numdoc.value;
        		data = data + "&ajax=1";
        		data = data + "&date_deb_conge=" + form.date_deb_conge.value;
        		data = data + "&date_fin_conge=" + form.date_fin_conge.value;
        		data = data + "&motif=" + form.motif.value;
        		data = data + "&precision=" + form.precision.value;
                //data = data + "&codeuser=" + form.codeuser.value;
        		data = data + "&lang=" + form.lang.value;
        		data = data + "&login=" + form.login.value;
        		data = data + "&typedoc=" + form.typedoc.value;
        		data = data + "&titredoc=" + form.titredoc.value;
        		//data = data + "&codeuser=" + form.codeuser.value;
                data = data + "&do=doc_update_valid";
      break;
      case "dde_achat":
            if (form){//oui on peut poursuivre l'exécution du script

        	 if (form.date_deb_conge.value == ""){
        			document.getElementById('system-message').style.display = 'block';
        			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_deb_conge"];
        			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
        			form.date_deb_conge.focus();
        			return false;
        	 }
        	 if (form.date_fin_conge.value == ""){
        			document.getElementById('system-message').style.display = 'block';
        			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_fin_conge"];
        			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
        			form.date_fin_conge.focus();
        			return false;
        	 }
             if (form.motif.value == ""){
                  	document.getElementById('system-message').style.display = 'block';
        		  	document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_motif"];
        		  	document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
        		  	form.motif.focus();
        		  	return false;
        	 }
            }
        		//fabriquer les données à poster
        		var data = "";
                data = 'numdoc=' + form.numdoc.value;
        		data = data + "&ajax=1";
        		data = data + "&date_deb_conge=" + form.date_deb_conge.value;
        		data = data + "&date_fin_conge=" + form.date_fin_conge.value;
        		data = data + "&motif=" + form.motif.value;
        		data = data + "&precision=" + form.precision.value;
                //data = data + "&codeuser=" + form.codeuser.value;
        		data = data + "&lang=" + form.lang.value;
        		data = data + "&login=" + form.login.value;
        		data = data + "&typedoc=" + form.typedoc.value;
        		data = data + "&titredoc=" + form.titredoc.value;
        		//data = data + "&codeuser=" + form.codeuser.value;
                data = data + "&do=doc_update_valid";
      break;
    }
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


function on_doc_archiver_valid()
{
	var form = document.getElementById('form_doc_view');
	form = eval(form);
	
	//ce formulaire existe -t-il?
	if (form)
	{//oui on peut poursuivre l'exécution du script	
		if (confirm(Translate["confirm_archive_doc"]))
		{
			form.elements["do"].value = "doc_archive_valid";
			form.submit();
			return true;
		}		
		return false;
	}
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


//Fonction de validation des champs du formulaire côté client
/**
  @param	integer - pnumtachesuiv - numéro de la tache suivante choisie par l'utilisateur
*/
function soumet(pscript_php , pdoc_url , pnumtachesuiv) {

	var typedoc = document.getElementById('typedoc').value;
	var form = document.getElementById('form_doc_view');
	form = eval(form);

	switch (typedoc){
		case "dde_credit":
			if (trim(document.getElementById('retenue').value) == "") {
				document.getElementById('system-message').style.display = 'block';
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_retenue"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				document.getElementById('retenue').focus();
				return false;
			}
			else if (trim(form.montant.value) == "") {
				document.getElementById('system-message').style.display = 'block';
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_credit"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				form.montant.focus();
				return false;
			}
			else if (trim(form.date_credit.value) == "") {
				document.getElementById('system-message').style.display = 'block';
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_date_credit"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				form.date_credit.focus();
				return false;
			}
			else if (trim(form.nbr_annuite.value) == "") {
				document.getElementById('system-message').style.display = 'block';
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_nbr_annuite"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				form.nbr_annuite.focus();
				return false;
			}
			else if (trim(form.annuite.value) == "") {
				document.getElementById('system-message').style.display = 'block';
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_annuite"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				form.annuite.focus();
				return false;
			}
		    form_elements_to_string ('form_doc_view');
		    break;

		case "dde_conge":
			if (trim(document.getElementById('motif').value) == "") {
				document.getElementById('system-message').style.display = 'block';
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_motif"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				document.getElementById('motif').focus();
				return false;
			}
			else if (trim(document.getElementById('dat_deb_conge').value) == "") {
				document.getElementById('system-message').style.display = 'block';
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_deb_conge"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				document.getElementById('dat_deb_conge').focus();
				return false;
			}
			else if (trim(document.getElementById('dat_fin_conge').value) == "") {
				document.getElementById('system-message').style.display = 'block';
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_fin_conge"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				document.getElementById('dat_fin_conge').focus();
				return false;
			}
			form_elements_to_string ('form_doc_view');
			break;

		case "dde_achat":
			if (trim(form.designation.value) == "") {
				document.getElementById('system-message').style.display = 'block';
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["saisir_designation"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				form.designation.focus();
				return false;
			}
			else if (trim(form.objet.value) == "") {
				document.getElementById('system-message').style.display = 'block';
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["saisir_objet"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				form.objet.focus();
				return false;
			}			
			else if ((form.date_deb.value == "") || (form.date_fin.value == ""))
			{
				document.getElementById('system-message').style.display = 'block';
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["saisir_date"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				form.date_deb.focus();
				return false;
			}
			else if (trim(form.observation.value) == "") {
				document.getElementById('system-message').style.display = 'block';
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["saisir_observation"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				form.observation.focus();
				return false;
			}
			else if (form.nbr_achat.value == 0)	{
				document.getElementById('system-message').style.display = 'block';
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["entrer_article"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				return false;
			}
			form_elements_to_string ('form_doc_view');
			break;

		case "gest_stock":
			var form = document.getElementById('form_gest_stock');
			form = eval(form);

			// debut ajout maurice
			if (trim(form.designation.value) == "") {
				document.getElementById('system-message').style.display = 'block';
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_retenue"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				return false;
			}
		    else if (trim(form.presentation.value) == "") {
				document.getElementById('system-message').style.display = 'block';
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_retenue"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				return false;
			}
			 else if (trim(form.quantite.value) == "") {
				document.getElementById('system-message').style.display = 'block';
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_retenue"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				return false;
			}
			else if (trim(form.stock_dispo.value) == "") {
				document.getElementById('system-message').style.display = 'block';
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_retenue"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				return false;
			}
			else if (trim(form.observation.value) == "") {
				document.getElementById('system-message').style.display = 'block';
				document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_retenue"];
				document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
				return false;
			}
			//fin ajout maurice
			form_elements_to_string ('form_gest_stock');
			break;
	}
	
	form.submit();
	//poster la tache suivante, qui est en fait l'action que le user a effectué avant qu'on appelle la focntion soumet()
	document.getElementById('numtachesuiv').value = pnumtachesuiv;
	return true;
}


function envoi_de_donne(pscript_php)
{
	var form = document.form_dde_credit;
	form = eval(form);
	//ce formulaire existe -t-il ?
	if (form) {//oui on peut poursuivre l'exécution du script

		//fabriquer les données à poster
		var data = "";
		data = 'login=' + form.login.value ;
		data = data + "&ajax=1";	//notifier que l'appel de pscript vient d'ajax
		data = data + "&retenue=" + form.retenue.value;
		data = data + "&montant=" + form.montant.value;
		data = data + "&date_credit=" + form.date_credit.value;
		data = data + "&chemin_acces=" + form.chemin_acces.value;
        data = data + "&nbr_annuite=" + form.nbr_annuite.value;
        data = data + "&liste_element=" + form.liste_elements.value;
		data = data + "&page=" + form.page.value;
		data = data + "&lang=" + form.lang.value;
		data = data + "&login=" + form.login.value;
		data = data + "&annuite=" + form.annuite.value;
		//exécuter AJAX
		sendData('div_status', data , pscript_php , 'POST');
	}
	form.reset();
}


/**
	fonction qui fabrique une chaine de caractères contenant les infos groupés par éléments d'un formulaire
	cette fonction est utilisable par toutes les pages de création de formulaire
	param	:	pform_id : id du formulaire	
*/
function form_elements_to_string (pform_id){ 
	
	var liste_elements="";
	var i;
    var typedoc = document.getElementById('typedoc').value;
        
    switch (typedoc) {    	
      case "dde_credit":        
      case "dde_conge":
      	var lform=document.getElementById('form_doc_view');
    	lform = eval(lform);
    	break; 
      case "dde_achat":      	
      	break;        
	  case "gest_stock":
        var lform=document.getElementById('form_gest_stock');
    	lform = eval(lform);
    	break;	
    }
	    var lelement;
	    var moi = lform.liste_elements;
	    	  
    	if (lform) {
    		//alert("loup");
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
    		lform.liste_elements.value=liste_elements;    		
    	}   	    	
        return true;
}


function on_doc_add_file(pscript_php , pdoc_url)
{
	var form = document.form_upload_doc;
	form = eval(form);
	
	if (form)
	{  			
			//fabriquer les données à poster
			data = "";
			data = 'chemin_acces=' + form.chemin_acces.value;
			data = data + "&ajax=1";	//notifier que l'appel de pscript vient d'ajax
			data = data + "&login=" + form.login.value;
			data = data + "&lang=" + form.lang.value;
			data = data + "&do=doc_add_file_valid";
			data = data + "&numdoc=" + form.numdoc.value;
			data = data + "&typedoc=" + form.typedoc.value;
						
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


function on_remove_achat(pform, ptable_id , pidligne)
{	
	    var form = eval(document.getElementById(pform));
		var form_name = form.name;
		var lines_count = 0;
		var ltable = document.getElementById(ptable_id);
		ltable = eval(ltable);
		
		if(ltable)
		{
			//obtenir le nombre de lignes du tableau
			lines_count = ltable.rows.length ; 
		}
		var i = 0;
		var lref_fourn;
		var j = -1;
		var k = -1;
		var check;
		var larr_row = new Array();		
		//Fin vérification "lignes sélectionnées" 
		{
				lligne = eval( document.getElementById(pidligne));
				if (lligne)
				{
					j = eval(lligne.rowIndex);
					if (j)
					{// = check.parentNode.parentNode.rowIndex;
						ltable.deleteRow(j);
						form.nbr_achat.value = form.nbr_achat.value - 1;
					}
				}
		}
}


function down(SlotId, nPosition) 
{
	strDestinationId = "ligne"+SlotId;
	objDestinationTable = document.getElementById(strDestinationId);		
	nLastPos = getLastPosition(objDestinationTable);
			
	if (nPosition < nLastPos) {
		swapPosition (SlotId, nPosition+1, nPosition);
	}
}


function up(pidligne) {
	alert(pidligne);
	
	var i = 0;
	var lfound = false;
	var ltable = document.getElementById('table_taches');
	var nbreligne = document.getElementById('table_taches').rows.length;
				
	lligne = eval( document.getElementById(pidligne));				
	if (lligne)	{
		j = eval(lligne.rowIndex);
					
	    //var newRow = document.getElementById('table_taches').insertRow(j);
	    AddRow(j , 'http://localhost');
	    return true;
	    
	    lligne = eval( document.getElementById(pidligne));
	    j = eval(lligne.rowIndex);

	    if (j) {
	    	ltable.deleteRow(j);
		}
	}
}




function on_doc_update_reject(pscript_php)
{	 	
    var typedoc = document.getElementById('typedoc').value;    
    var form = document.getElementById('form_doc_view');

    form = eval(form);        //ce formulaire existe -t-il ?
if (form) {		
    switch (typedoc){
      case "dde_credit":
                       
		    	form_elements_to_string ('form_doc_view');
		    	
        		//fabriquer les données à poster
        		var data = "";
                data = 'numdoc=' + form.numdoc.value;
        		data = data + "&ajax=1";
        		data = data + "&retenue=" + form.retenue.value;
        		data = data + "&numtache=" + form.numtache.value;
        		data = data + "&montant=" + form.montant.value;
        		//data = data + "&date_dde=" + form.date_dde.value;
        		data = data + "&date_credit=" + form.date_credit.value;
                data = data + "&nbr_annuite=" + form.nbr_annuite.value;
                //data = data + "&codeuser=" + form.codeuser.value;
        		data = data + "&lang=" + form.lang.value;
        		data = data + "&login=" + form.login.value;
        		data = data + "&annuite=" + form.annuite.value;
        		data = data + "&typedoc=" + form.typedoc.value;
        		//data = data + "&titredoc=" + form.titredoc.value;
                data = data + "&do=doc_update_reject";
                //alert('kiko'); 
      break;
      case "dde_conge":
            
        		//fabriquer les données à poster
        		var data = "";
                data = 'numdoc=' + form.numdoc.value;
        		data = data + "&ajax=1";
        		data = data + "&date_deb_conge=" + form.date_deb_conge.value;
        		data = data + "&date_fin_conge=" + form.date_fin_conge.value;
        		data = data + "&motif=" + form.motif.value;
        		data = data + "&precision=" + form.precision.value;
                //data = data + "&codeuser=" + form.codeuser.value;
        		data = data + "&lang=" + form.lang.value;
        		data = data + "&login=" + form.login.value;
        		data = data + "&typedoc=" + form.typedoc.value;
        		data = data + "&titredoc=" + form.titredoc.value;
        		//data = data + "&codeuser=" + form.codeuser.value;
                data = data + "&do=doc_update_reject";                               
      break;
      case "dde_achat":
            
        		//fabriquer les données à poster
        		var data = "";
                data = 'numdoc=' + form.numdoc.value;
        		data = data + "&ajax=1";
        		data = data + "&date_deb_conge=" + form.date_deb_conge.value;
        		data = data + "&date_fin_conge=" + form.date_fin_conge.value;
        		data = data + "&motif=" + form.motif.value;
        		data = data + "&precision=" + form.precision.value;
                //data = data + "&codeuser=" + form.codeuser.value;
        		data = data + "&lang=" + form.lang.value;
        		data = data + "&login=" + form.login.value;
        		data = data + "&typedoc=" + form.typedoc.value;
        		data = data + "&titredoc=" + form.titredoc.value;
        		//data = data + "&codeuser=" + form.codeuser.value;
                data = data + "&do=doc_update_reject";
      break;
    }
    
    form.submit();
    return true;
} 
    return false;
}


function on_doc_reject_valid(pscript_php)
{	 
    var typedoc = document.getElementById('typedoc').value;    
    var form = document.getElementById('form_doc_view');

    form = eval(form);        //ce formulaire existe -t-il ?
  switch (typedoc){
      case "dde_credit":
            //if (form){               //oui on peut poursuivre l'exécution du script

        	 /*if (form.date_credit.value == ""){
        			document.getElementById('system-message').style.display = 'block';
        			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_date_credit"];
        			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
        			form.date_credit.focus();
        			return false;
        	 }
        	 if (form.montant.value == ""){
        			document.getElementById('system-message').style.display = 'block';
        			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_credit"];
        			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
        			form.montant.focus();
        			return false;
        	 }
             else if (isNaN(form.montant.value)){
                  	document.getElementById('system-message').style.display = 'block';
        		  	document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_credit"];
        		  	document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
        		  	form.montant.focus();
        		  	return false;
        	 }
             else if (form.retenue.value == ""){
                  document.getElementById('system-message').style.display = 'block';
        		  document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_retenue"];
        		  document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
        		  form.retenue.focus();
        		  return false;
             }
        	 else if (! isFinite(form.retenue.value)){
        	   	  document.getElementById('system-message').style.display = 'block';
        		  document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_retenue"];
        		  document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
        		  form.retenue.focus();
        		  return false;
        	 }
        	 else if (form.nbr_annuite.value == ""){
        			document.getElementById('system-message').style.display = 'block';
        			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_nbr_annuite"];
        			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
        			form.nbr_annuite.focus();
        			return false;
        	 }
        	 else if (parseInt(form.nbr_annuite.value) < 0)	{
        			document.getElementById('system-message').style.display = 'block';
        			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_nbr_annuite"];
        			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
        			form.nbr_annuite.focus();
        			return false;
        	 }
        	 else if (form.annuite.value == ""){
        			document.getElementById('system-message').style.display = 'block';
        			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_annuite"];
        			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
        			form.annuite.focus();
        			return false;
        	 }
            }*/
    	  
			form_elements_to_string ('form_doc_view');
        		
			    //fabriquer les données à poster
        		var data = "";
                data = 'numdoc=' + form.numdoc.value;
        		data = data + "&ajax=1";
        		data = data + "&retenue=" + form.retenue.value;
        		data = data + "&numtache=" + form.numtache.value;
        		data = data + "&montant=" + form.montant.value;
        		//data = data + "&date_dde=" + form.date_dde.value;
        		data = data + "&date_credit=" + form.date_credit.value;
                data = data + "&nbr_annuite=" + form.nbr_annuite.value;
                data = data + "&codeuser=" + form.codeuser.value;
        		data = data + "&lang=" + form.lang.value;
        		data = data + "&login=" + form.login.value;
        		data = data + "&annuite=" + form.annuite.value;
        		data = data + "&typedoc=" + form.typedoc.value;
        		//data = data + "&titredoc=" + form.titredoc.value;
                data = data + "&do=doc_reject_valid";
      break;
      
      case "dde_conge":
            if (form){               //oui on peut poursuivre l'exécution du script
 
        	 if (form.date_deb_conge.value == ""){
        			document.getElementById('system-message').style.display = 'block';

        			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_deb_conge"];
        			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
        			form.date_deb_conge.focus();
        			return false;
        	 }
        	 if (form.date_fin_conge.value == ""){
        			document.getElementById('system-message').style.display = 'block';

        			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_fin_conge"];
        			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
        			form.date_fin_conge.focus();
        			return false;
        	 }
             if (form.motif.value == ""){
                  	document.getElementById('system-message').style.display = 'block';

        		  	document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_motif"];
        		  	document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
        		  	form.motif.focus();
        		  	return false;
        	 }
            }

        		//fabriquer les données à poster
        		var data = "";
                data = 'numdoc=' + form.numdoc.value;
        		data = data + "&ajax=1";
        		data = data + "&date_deb_conge=" + form.date_deb_conge.value;
        		data = data + "&date_fin_conge=" + form.date_fin_conge.value;
        		data = data + "&motif=" + form.motif.value;
        		data = data + "&precision=" + form.precision.value;
                //data = data + "&codeuser=" + form.codeuser.value;
        		data = data + "&lang=" + form.lang.value;
        		data = data + "&login=" + form.login.value;
        		data = data + "&typedoc=" + form.typedoc.value;
        		data = data + "&titredoc=" + form.titredoc.value;
        		//data = data + "&codeuser=" + form.codeuser.value;
                data = data + "&do=doc_reject_valid";
                               
      break;
      case "dde_achat":
            if (form){               //oui on peut poursuivre l'exécution du script

        	 if (form.date_deb_conge.value == ""){
        			document.getElementById('system-message').style.display = 'block';

        			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_deb_conge"];
        			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
        			form.date_deb_conge.focus();
        			return false;
        	 }
        	 if (form.date_fin_conge.value == ""){
        			document.getElementById('system-message').style.display = 'block';

        			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_fin_conge"];
        			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
        			form.date_fin_conge.focus();
        			return false;
        	 }
             if (form.motif.value == ""){
                  	document.getElementById('system-message').style.display = 'block';

        		  	document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_motif"];
        		  	document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
        		  	form.motif.focus();
        		  	return false;
        	 }
            }

        		//fabriquer les données à poster
        		var data = "";
                data = 'numdoc=' + form.numdoc.value;
        		data = data + "&ajax=1";
        		data = data + "&date_deb_conge=" + form.date_deb_conge.value;
        		data = data + "&date_fin_conge=" + form.date_fin_conge.value;
        		data = data + "&motif=" + form.motif.value;
        		data = data + "&precision=" + form.precision.value;
                //data = data + "&codeuser=" + form.codeuser.value;
        		data = data + "&lang=" + form.lang.value;
        		data = data + "&login=" + form.login.value;
        		data = data + "&typedoc=" + form.typedoc.value;
        		data = data + "&titredoc=" + form.titredoc.value;
        		//data = data + "&codeuser=" + form.codeuser.value;
                data = data + "&do=doc_reject_valid";
      break;
    }
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

