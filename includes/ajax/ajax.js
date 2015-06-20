function sendData(espace, data, page, method)
{
	if(document.all) { //Internet Explorer
		var XhrObj = new ActiveXObject("Microsoft.XMLHTTP") ;
	} else { //Mozilla
		var XhrObj = new XMLHttpRequest();
	}
	//définition de l'endroit d'affichage:
	var param = data.split('=');
	var content = document.getElementById(espace);
	//si on envoie par la méthode GET:
	if(method == "GET") {
		if(data == 'null') {
			//ouverture du fichier sélectionné:
			XhrObj.open("GET", page);
		} else {
			//Ouverture du fichier testGet.php en methode GET
			XhrObj.open("GET", page+"?"+data, "async");
		}
	}
	else if(method == "POST") {
		//Ouverture du fichier testPost.php en methode POST
		XhrObj.open("POST", page);
	}
	//Ok pour la page cible
	XhrObj.onreadystatechange = function() {
		if (XhrObj.readyState < 2) {
			content.innerHTML = '.';
		}
		if (XhrObj.readyState == 4) {
			if (XhrObj.status == 200) {
				content.innerHTML = XhrObj.responseText ;
			}
			else {
				content.innerHTML = XhrObj.status ;
			}
		}
		else { 
			content.innerHTML = '<img src="../images/loading.gif" width="16" height="16">'; 
		}
	}
	if(method == "GET") {
		XhrObj.send(null);
	}
	else if(method == "POST") {
		XhrObj.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		XhrObj.send(data);
	}
}
/**
 * Permet de récupérer les données d'un fichier via les XmlHttpRequest:
 */
function getFile(page) {
	sendData('null', page, 'GET')
}