// JavaScript Document


function on_workflow_doc_delete_valid(pscript_php , pdoc_url)
{
	var form = document.getElementById('form_doc_view');
	form = eval(form);

	//ce formulaire existe -t-il ?
	if (form)
	{//oui on peut poursuivre l'exécution du script
		if (confirm(Translate["confirm_delete_doc"]))
		{
			form.elements["do"].value = "workflow_update_valid";
			form.action = pscript_php;
			form.submit();
			return true;
		}		
		return false;
	}
}



function on_workflow_doc_update_valid(pscript_php , pdoc_url , pnumtacheeffectuee) 
{
    var typedoc = document.getElementById('typedoc').value;    
    var form = document.getElementById('form_doc_view');

    form = eval(form);        //ce formulaire existe-t-il ?

    switch (typedoc){
      case "dde_credit":
            if (form)
            {//oui on peut poursuivre l'exécution du script

        	 if (form.date_credit.value == ""){
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
            }            
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

        		/*//fabriquer les données à poster
        		var data = "";
                data = 'numdoc=' + form.numdoc.value;
        		data = data + "&ajax=1";
        		data = data + "&date_deb_conge=" + form.date_deb_conge.value;
        		data = data + "&date_fin_conge=" + form.date_fin_conge.value;
        		data = data + "&motif=" + form.motif.value;
        		data = data + "&precision=" + form.precision.value;
                data = data + "&codeuser=" + form.codeuser.value;
        		data = data + "&lang=" + form.lang.value;
        		data = data + "&login=" + form.login.value;
        		data = data + "&typedoc=" + form.typedoc.value;
        		data = data + "&titredoc=" + form.titredoc.value;
        		data = data + "&codeuser=" + form.codeuser.value;
                data = data + "&do=doc_update_valid";*/
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

/*        		//fabriquer les données à poster
        		var data = "";
                data = 'numdoc=' + form.numdoc.value;
        		data = data + "&ajax=1";
        		data = data + "&date_deb_conge=" + form.date_deb_conge.value;
        		data = data + "&date_fin_conge=" + form.date_fin_conge.value;
        		data = data + "&motif=" + form.motif.value;
        		data = data + "&precision=" + form.precision.value;
                data = data + "&codeuser=" + form.codeuser.value;
        		data = data + "&lang=" + form.lang.value;
        		data = data + "&login=" + form.login.value;
        		data = data + "&typedoc=" + form.typedoc.value;
        		data = data + "&titredoc=" + form.titredoc.value;
        		data = data + "&codeuser=" + form.codeuser.value;
                data = data + "&do=doc_update_valid";
*/      break;
    }
        
	//poster la tache suivante, qui est en fait l'action que le user a effectué avant qu'on appelle la focntion soumet()
	document.getElementById('numtachesuiv').value = pnumtacheeffectuee;
	form.action = pscript_php;
	var ldo = document.getElementById('do');
	ldo = eval(ldo);
	ldo.value = "workflow_update_valid";

	form.submit();	
	return true;

		/*//exécuter AJAX
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
		);*/
}



/*
script de validation de la modification d'un workflow
*/
function on_workflow_update_valid(pscript_php)
{
	var form = document.getElementById('form_workflow_view');
	form = eval(form);
	
	//Ce formulaire existe-t-il?
	if (form)
	{//oui on peut poursuivre l'exécution du script
	    if (form.heuredebutwf.value == "")
		{   
			document.getElementById('system-message').style.display = 'block';
			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_heuredebutwf"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			form.heuredebutwf.focus();
			return false;
		}
		else if (form.dureewf.value == "")
		{
			document.getElementById('system-message').style.display = 'block';
			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_dureewf"];
			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
			form.dureewf.focus();
			return false;
		}
						
		//fabriquer les données à poster
		var data = "";
		data = 'heuredebutwf=' + (document.getElementById('heuredebutwf').value);
		data = data + "&ajax=1";	//notifier que l'appel de pscript vient d'ajax
		data = data + "&numworkflow=" + (document.getElementById('numworkflow').value);
		data = data + "&datedebutwf=" + (document.getElementById('datedebutwf').value);
		data = data + "&dureewf=" + (document.getElementById('dureewf').value);
		if (document.getElementById('block0').checked) data = data + "&archivewf=" + document.getElementById('block0').value;
		else data = data + "&archivewf=" + document.getElementById('block1').value;	
		data = data + "&login=" + (document.getElementById('login').value);
		data = data + "&lang=" + (document.getElementById('lang').value);
		data = data + "&numtache=" + (document.getElementById('numtache').value);
		data = data + "&numdoc=" + (document.getElementById('numdoc').value);
		data = data + "&do=workflow_update_valid";
        
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


/**
Création d'un workflow
*/
function on_workflow_create_valid() 
{
    var typedoc = document.getElementById('typedoc').value;    
    var form = document.getElementById('form_doc_view');

    form = eval(form);//ce formulaire existe-t-il ?

    switch (typedoc){
      case "dde_credit":
            if (form)
            {//oui on peut poursuivre l'exécution du script

        	 if (form.date_credit.value == ""){
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
            }            
      break;
      
      case "dde_conge":
            if (form){ //oui on peut poursuivre l'exécution du script

        	 if (form.motif.value == ""){
        			document.getElementById('system-message').style.display = 'block';alert('Le vin est le lait des vieillards!');
        			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_deb_conge"];
        			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
        			document.getElementById('date_deb_conge').focus();
        			return false;
        	 }
        	 if (form.date_fin_conge.value == ""){
        			document.getElementById('system-message').style.display = 'block';
        			document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_fin_conge"];
        			document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
        			document.getElementById('date_fin_conge').focus();
        			return false;
        	 }
             if (form.motif.value == ""){
                  	document.getElementById('system-message').style.display = 'block';
        		  	document.getElementById('system-message').innerHTML = '<dt class="error">Erreur</dt><dd class="error message fade"><ul><li>' + Translate["pleaz_saisir_motif"];
        		  	document.getElementById('system-message').innerHTML = document.getElementById('system-message').innerHTML + "</li></ul></dd>";
        		  	document.getElementById('motif').focus();
        		  	return false;
        	 }
            }        		
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
      break;
    }
     
	//poster la tache suivante, qui est en fait l'action que le user a effectué avant qu'on appelle la focntion soumet()
	//document.getElementById('numtachesuiv').value = pnumtacheeffectuee;
	//form.action = pscript_php;
	//var ldo = document.getElementById('do');
	//ldo = eval(ldo);
	//ldo.value = "workflow_update_valid";

	form.submit();	
	return true;
}



function on_workflow_delete_valid()
{
	var form = document.getElementById('form_workflow_view');
	form = eval(form);
	
	//ce formulaire existe -t-il ?
	if (form)
	{//oui on peut poursuivre l'exécution du script	
		if (confirm(Translate["confirm_delete_workflow"]))
		{   //alert("casse toi!!!");
			form.elements["do"].value = "workflow_delete_valid"; 
			form.submit();
			return true;
		}		
		return false;
	}
}
