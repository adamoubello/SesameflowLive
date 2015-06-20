<?php
  
    $data = ($_POST) ? $_POST : $_GET;
    //récupérer les paramètres postés
	$data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
	 $data[$lkey] = $lvalue;
	}
	
	//obtenir le code du profil à modifier
	$numerotache = (isset($data["numerotache"])) ? (! is_null($data["numerotache"])) ? $data["numerotache"] : null : null;
	$libelletache = (isset($data["libelletache"])) ? (! is_null($data["libelletache"])) ? $data["libelletache"] : "" : "";
	$dureetache = (isset($data["dureetache"])) ? (! is_null($data["dureetache"])) ? $data["dureetache"] : "" : "";
	$codecircuit = 0;
	$codeprofil = 0;
	$numtacheprecedante = 0;
	$numtachesuivante = 0;
	
	//obtenir le contenu de la variable ajax, qui permet de savoir si ce script a été appellé ou non depuis AJAX
	$lajax = (isset($data["ajax"])) ? (! is_null($data["ajax"])) ? $data["ajax"] : 0 : 0;
	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
  
   $chemin = dirname(__FILE__);
   $chemin = str_replace("\workflow\page","",$chemin);
   require_once($chemin.'\classe\application.class.php');	
   $siteweb = new Application();
   
   global $siteweb;
   
   ini_set('include_path', $siteweb->get_document_root().'/includes/pear');	//charger les packages de PEAR::MDB2
   
   //charger la spécification de la classe Profil
   require_once($siteweb->get_document_root()."/workflow/classe/tache.class.php");
   //créer un objet Profil
   $tac = new tache();
   //charger les traductions de ce module
   require_once($siteweb->get_document_root()."\workflow\lang\\tache.".$lang.".php");
   
   $result = $tac->insertion();
    
   //lancer la création
   if ($result)
   {    
   		$lalert = 	"<dl id=\"system-message\">
						<dd class=\"message\">
							<ul>
								<li>". $translate["tache_create_success"] ."</li>
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
								<li>". $translate["tache_create_failure"] ."</li>
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

