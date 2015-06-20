 <?php
/**
 * @version			1.0
 * @package			Administration
 * @subpackage		Configuration
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			xaverie Télédzina <onana-carine@yahoo.fr>
 * @desc			script pour l'affichage de la page interfaçage avec SESAME RH
 *  * @creationdate	lundi 17 Août 2009
 */
	
	       
	$data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
		$data[$lkey] = $lvalue;
	}
   
	$ajax = (isset($data["ajax"])) ? (! is_null($data["ajax"])) ? $data["ajax"] : 0 : 1;
	$login = (isset($data["login"])) ? (! is_null($data["login"])) ? $data["login"] : "" : "";
	$action = (isset($data["action"])) ? (! is_null($data["action"])) ? $data["action"] : "accueil" : "accueil";
	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
    $chemin = dirname(__FILE__);
    
	//obtenir le séparateur de dossier pour la OS en cours
   if (! defined("DS")) define( 'DS', DIRECTORY_SEPARATOR );
	
    $chemin = dirname(__FILE__);
    $chemin = str_replace(DS."administration".DS."traitements","",$chemin);
	require_once($chemin.DS.'classe'.DS.'application.class.php');	
   	
   $siteweb = new Application();
		  
	  ini_set('include_path', $siteweb->get_document_root().'\includes\pear');	//charger les packages de PEAR::MDB2	
	  require_once($siteweb->get_document_root().DS."includes".DS."pear".DS."Structures".DS."DataGrid".DS."Renderer".DS."HTMLTable.php");   
	  require_once ($siteweb->get_document_root().DS."includes".DS."pear".DS."Structures".DS."DataGrid.php");
		  
		  
	//charger les paramètres s'il existent
	require_once($siteweb->get_document_root().DS.'administration'.DS.'classe'.DS.'module.class.php');		  
 
	//fabriquer la grille des modules
	//obtenir la liste des modules
	$lmodule = new Module();
	$lmodule->codemod = "rh";	//notifier qu'on veut recherche les modules uniquement
	//if (! $lmodule->charger()) ;die($lmodule->get_exception())
	if ($lmodule->has_exception()) die($lmodule->get_exception());
					
	
	//libérer la mémoire
	unset($lmodule);
	
	//fabriquer la grille des modules interfacables
	//tableau des descriptifs des interfaces

	$listeinterface = array();
	$listeinterface[] = 	array("codemod" => "paie" , "module" => "PAIE", "description" => "Sesame Paie" , "etat" => 1 , "config" => "" );
	$listeinterface[] = 	array("codemod" => "rh" , "module" => "Ressources Humaines", "description" => "Sesame RH" , "etat" => 1 , "config" => "" );
	require_once($siteweb->get_document_root().DS."administration".DS."traitements".DS."tinterface_result_search.php");						
    
	
     ?> 