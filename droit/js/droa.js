// JavaScript Document

function verification_recherche() 
{
				  
			 	if (document.getElementById('nom').value == "" )
				{
				  		alert("Veuillez saisir le libellé du droit d'accès recherché");
				  		document.getElementById('libdroa').focus();
				  		return false;
				}	
								
				formusearch1 = document.adminForm;
				formusearch1.submit();  					  	 				
				return true;
  }

function afficher_div_droa_search() 
 {
	 
 var ldiv = document.getElementById("div_droa_search");
 var lchkbox = document.getElementById("checkbox_droa_search");
 
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
  
 
function supprimer() { 

alert('Test!');


}

function soumet() {
	alert('la go antou');
		var form = document.form_create_droit;
		//var r = new RegExp("[\<|\>|\"|\'|\%|\;|\(|\)|\&]", "i");

		// do field validation
		if (trim(form.codedroit_create.value) == "") {
			alert( "Vous devez fournir un code." );
			document.getElementById('codedroit_create').focus();
			return false;
		} else if (form.libdroit_create.value == "") {
			alert( "Vous devez fournir un libellé." );
			document.getElementById('libdroit_create').focus();
			return false;	
		} else if (form.niveau_accesdroit_create.value == "") {
			alert( "Vous devez fournir un niveau d''accès." );
			document.getElementById('niveau_accesdroit_create').focus();
			return false;	
		} 			
			return true;				        
	}

function on_valid_modifier_droit(pscript_php)
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

function on_valid_creer_droit(pscript_php)
{   alert('nirvana!');
    var form = document.form_create_droit;
	form = eval(form);
	//ce formulaire existe -t-il ?
	if (form)
	{//oui on peut poursuivre l'exécution du script
		
		//fabriquer les données à poster
		var data = "";
		data = 'codedroa=' + form.codedroit_create.value;
		data = data + "&ajax=1";	//notifier que l'appel de pscript vient d'ajax
		data = data + "&libdroa=" + form.libdroit_create.value;
        data = data + "&niveau_accesdroa=" + form.niveau_accesdroit_create.value;
        
	 
		//exécuter AJAX	
		sendData('div_status', data , pscript_php , 'POST');
	}
}















