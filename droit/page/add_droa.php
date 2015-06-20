<?php

//   *
//   * @desc	:	script de mise à jour des informations d'un profil d'utilisateur
//   * @param 	:	ajax - entier - égale 1 si ce script a été appellé depuis AJX, 0 sinon
//   * @param 	:	$_POST ou $_GET contient le code du profil à mettre à jour
//   * @author 	:	Patrick Mveng
//   * @copyright :	(c) 2009 interface SA
//   * @package	:	Utilisateur  
  
    $data = ($_POST) ? $_POST : $_GET;
    //récupérer les paramètres postés
	$data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
		$data[$lkey] = $lvalue;
	}
	
	//obtenir le code du profil à modifier
	$codedroa = (isset($data["codedroit_create"])) ? (! is_null($data["codedroit_create"])) ? $data["codedroit_create"] : null : null;
	$libdroa = (isset($data["libdroit_create"])) ? (! is_null($data["libdroit_create"])) ? $data["libdroit_create"] : "" : "";
	$niveau_accesdroa = (isset($data["niveau_accesdroit_create"])) ? (! is_null($data["niveau_accesdroit_create"])) ? $data["niveau_accesdroit_create"] : "" : "";
	//obtenir le contenu de la variable ajax, qui permet de savoir si ce script a été appellé ou non depuis AJAX
	$lajax = (isset($data["ajax"])) ? (! is_null($data["ajax"])) ? $data["ajax"] : 0 : 0;
	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
  
   $chemin = dirname(__FILE__);
   $chemin = str_replace("\droit\page","",$chemin);
   require_once($chemin.'\classe\application.class.php');	
   $siteweb = new Application();
   
   global $siteweb;
   
	ini_set('include_path', $siteweb->get_document_root().'/includes/pear');	//charger les packages de PEAR::MDB2
   
   //charger la spécification de la classe Profil
   require_once($siteweb->get_document_root()."/droit/classe/droa.class.php");
   //créer un objet Profil
   $ldroit = new droit();
   
   //charger les traductions de ce module
   require_once($siteweb->get_document_root()."\droit\lang\droa.".$lang.".php");
   
   $result = $ldroit->insertion();
    
   //lancer la création
   if ($result)
   {    
   		$lalert = 	"<dl id=\"system-message\">
						<dd class=\"message\">
							<ul>
								<li>". $translate["droit_create_success"] ."</li>
							</ul>
						</dd>
						</dl>
					";	
   }
   else
   {
   	$lalert = 	"<dl id=\"system-message\">
						<dd class=\"error\">
							<ul>
								<li>". $translate["droit_create_failure"] ."</li>
							</ul>
						</dd>
						</dl>
					";	
   }
   //si appel depuis AJAX
   if (intval($lajax) == 1)
   {//afficher une alerte
   	die($lalert);
   }
   
?>

