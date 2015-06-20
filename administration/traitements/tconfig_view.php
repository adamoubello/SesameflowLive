<?php
/**
 * @version			1.0
 * @package			Administration
 * @subpackage		Configuration
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			patrick mveng<@yahoo.fr> 
 * @desc			script pour l'affichage de la page de configuration de l'application
 * @creationdate	lundi 27 juillet 2009
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
	
	$uniteduree_process = (isset($data["uniteduree_process"])) ? (! is_null($data["uniteduree_process"])) ? $data["uniteduree_process"] : 0 : 0;
	$uniteduree_tache = (isset($data["uniteduree_tache"])) ? (! is_null($data["uniteduree_tache"])) ? $data["uniteduree_tache"] : 0 : 0;
	$uniteduree_circuit = (isset($data["uniteduree_circuit"])) ? (! is_null($data["uniteduree_circuit"])) ? $data["uniteduree_circuit"] : 0 : 0;
	
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
	require_once($siteweb->get_document_root().DS.'administration'.DS.'classe'.DS.'config.class.php');		  
   $lconfig = new config();
   
   if (! $lconfig->charger()) die($lconfig->get_exception());
   
   //par défaut écoute sur le port 80
   $lconfig->portsite = (trim($lconfig->portsite) != "") ? $lconfig->portsite : 80;
		  
		$select_longueur_grille = $siteweb->select_longueur_grille(array("name" => "listlimit" , "id" => "listlimit" ) , $lconfig->listlimit);
		
		$select_unite_process = $siteweb->select_unite_duree(array("name" => "uniteduree_process" , "id" => "uniteduree_process" ) , $lconfig->uniteduree_process);
		$select_unite_tache = $siteweb->select_unite_duree(array("name" => "uniteduree_tache" , "id" => "uniteduree_tache" ) ,$lconfig->uniteduree_tache);
		$select_unite_circuit = $siteweb->select_unite_duree(array("name" => "uniteduree_circuit" , "id" => "uniteduree_circuit" ) , $lconfig->uniteduree_circuit);
		
	//fabriquer la grille des modules
	//obtenir la liste des modules
	require_once($siteweb->get_document_root().DS.'administration'.DS.'classe'.DS.'module.class.php');		  
	$lmodule = new Module();
	$lmodule->list_codemod = array("ged","mail","medicare");	//notifier qu'on veut recherche les modules suivant uniquement
	$listemodule = $lmodule->rechercher();
	if ($lmodule->has_exception()) die($lmodule->get_exception());
	require_once($siteweb->get_document_root().DS."administration".DS."traitements".DS."tmodule_result_search.php");				
	
	//libérer la mémoire
	unset($lmodule);
	
	//fabriquer la grille des modules interfacables
	//tableau des descriptifs des interfaces

	$listeinterface = array();
	$listeinterface[] = 	array("codemod" => "paie" , "module" => "PAIE", "description" => "Sesame Paie" , "etat" => 1 , "config" => "" );
	$listeinterface[] = 	array("codemod" => "rh" , "module" => "Ressources Humaines", "description" => "Sesame RH" , "etat" => 1 , "config" => "" );
	require_once($siteweb->get_document_root().DS."administration".DS."traitements".DS."tinterface_result_search.php");						
		
     ?> 