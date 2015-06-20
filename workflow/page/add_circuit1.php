<?php

//*
//   * @desc		:	script de mise à jour des informations d'un profil d'utilisateur
//   * @param 	:	ajax - entier - égale 1 si ce script a été appellé depuis AJAX, 0 sinon
//   * @param 	:	$_POST ou $_GET contient le code du profil à mettre à jour
//   * @author 	:	Bello
//   * @copyright :	(c) 2009 interface SA
//   * @package 	:	Utilisateur
//   
  
    $data = ($_POST) ? $_POST : $_GET;
    //récupérer les paramètres postés
	$data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
	$data[$lkey] = $lvalue;
	}
	
	//obtenir le code du circuit à modifier
	$codecircuit = (isset($data["codecircuit"])) ? (! is_null($data["codecircuit"])) ? $data["codecircuit"] : null : null;
	$libcircuit = (isset($data["libcircuit"])) ? (! is_null($data["libcircuit"])) ? $data["libcircuit"] : "" : "";
	$dureecircuit = (isset($data["dureecircuit"])) ? (! is_null($data["dureecircuit"])) ? $data["dureecircuit"] : "" : "";
	//obtenir le contenu de la variable ajax, qui permet de savoir si ce script a été appellé ou non depuis AJAX
	$lajax = (isset($data["ajax"])) ? (! is_null($data["ajax"])) ? $data["ajax"] : 0 : 0;
	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
  
   $chemin = dirname(__FILE__);
   $chemin = str_replace("\circuit\page","",$chemin);
   require_once($chemin.'\classe\application.class.php');	
   $siteweb = new Application();
   
   global $siteweb;
   
	ini_set('include_path', $siteweb->get_document_root().'/includes/pear');	//charger les packages de PEAR::MDB2
   
   //charger la spécification de la classe circuit
   require_once($siteweb->get_document_root()."/circuit/classe/circuit.class.php");
   //créer un objet circuit
   $lcircuit = new circuit();
   
   //charger les traductions de ce module
   require_once($siteweb->get_document_root()."\circuit\lang\circuit.".$lang.".php");
   
   $result = $lcircuit->insertion();
    
   //lancer la création
   if ($result)
   {    
   		$lalert = 	"<dl id=\"system-message\">
						<dd class=\"message\">
							<ul>
								<li>". $translate["circuit_create_success"] ."</li>
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
								<li>". $translate["circuit_create_failure"] ."</li>
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

