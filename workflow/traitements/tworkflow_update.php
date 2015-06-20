<?php
/**
 * @version			1.0
 * @package			Workflow
 * @subpackage		Workflow
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			patrengick mv 
 * @desc			script de prétraitements pour la fiche de modification d'une instance de workflow
 * 					
 * @creationdate	????
 * @updates
 */
   
   $data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
		$data[$lkey] = $lvalue;
	}
   
   //obtenir le séparateur de dossier pour la OS en cours
   if (! defined("DS")) define( 'DS', DIRECTORY_SEPARATOR );
  
 	$login = (isset($data["login"])) ? (! is_null($data["login"])) ? $data["login"] : "" : "";
	$do = (isset($data["do"])) ? (! is_null($data["do"])) ? $data["do"] : "accueil" : "accueil";
	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
	$numtache = (isset($data["numtache"])) ? (! is_null($data["numtache"])) ? $data["numtache"] : null : null ;
	$numdoc = (isset($data["numdoc"])) ? (! is_null($data["numdoc"])) ? $data["numdoc"] : null : null ;
	$typedoc = (isset($data["typedoc"])) ? (! is_null($data["typedoc"])) ? $data["typedoc"] : null : null ;
	$numworkflow = (isset($data["numworkflow"])) ? (! is_null($data["numworkflow"])) ? $data["numworkflow"] : null : null ;
   
  
    $chemin = dirname(__FILE__);
	$chemin = str_replace(DS."workflow".DS."traitements","",$chemin);
	require_once($chemin.DS.'classe'.DS.'application.class.php');	
	
    $siteweb = new Application();   
    global $siteweb;
   
	ini_set('include_path', $siteweb->get_document_root().DS.'includes'.DS.'pear');	//charger les packages de PEAR::MDB2	
  
	require_once($siteweb->get_document_root().DS."workflow".DS."classe".DS."workflow.class.php");
	$lworkflow = new Workflow();
	
	$lworkflow->numworkflow = $numworkflow;
	
	//charger ce workflow de la base de données
	if (! $lworkflow->charger())  die($lworkflow->get_exception());
	
	//charger le formulaire
	require_once($siteweb->get_document_root().DS."ged".DS."traitements".DS."tdoc_view.php");
	
?>