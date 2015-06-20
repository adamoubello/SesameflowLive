<?php
  /**
   * @desc		:	script de mise à jour des informations d'un profil d'utilisateur
   * @param 	:	ajax - entier - égale 1 si ce script a été appellé depuis AJX, 0 sinon
   * @param 	:	$_POST ou $_GET contient le code du profil à mettre à jour
   * @author 	:	Patrick Mveng
   * @copyright :	(c) 2009 interface SA
   * @package 	:	Utilisateur
   */
  
    $data = ($_POST) ? $_POST : $_GET;
    //récupérer les paramètres postés
	$data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
		$data[$lkey] = $lvalue;
	}
	
	//obtenir le code du profil à modifier
	$codeprofil = (isset($data["codeprofil"])) ? (! is_null($data["codeprofil"])) ? $data["codeprofil"] : null : null;
	$libprofil = (isset($data["libprofil"])) ? (! is_null($data["libprofil"])) ? $data["libprofil"] : "" : "";
	//obtenir le contenu de la variable ajax, qui permet de savoir si ce script a été appellé ou non depuis AJAX
	$lajax = (isset($data["ajax"])) ? (! is_null($data["ajax"])) ? $data["ajax"] : 0 : 0;
	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
  
   $chemin = dirname(__FILE__);
   $chemin = str_replace("\profil\\traitements","",$chemin);
   require_once($chemin.'\classe\application.class.php');	
   $siteweb = new Application();
   
   global $siteweb;
   
   ini_set('include_path', $siteweb->get_document_root().'/includes/pear');	//charger les packages de PEAR::MDB2
   
   //charger la spécification de la classe Profil
   require_once($siteweb->get_document_root()."/profil/classe/profi.class.php");
   //créer un objet Profil
   $lprofil = new profil();
   
   //charger les traductions de ce module
   require_once($siteweb->get_document_root()."\profil\lang\profil.".$lang.".php");
   
   //affecter le code du profil
   $lprofil->codeprofil = $codeprofil;
   //affecter le libellé du profil
   $lprofil->libprofil = $libprofil;
   
   //lancer la modification
   if ($lprofil->modifier())
   {
   		$lalert = 	"<dl id=\"system-message\">
						<dd class=\"message\">
							<ul>
								<li>". $translate["profil_update_success"] ."</li>
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
								<li>". $translate["profil_update_failure"] ."</li>
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