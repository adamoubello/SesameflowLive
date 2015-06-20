<?php
/**
 * @version			1.0
 * @package			GED
 * @subpackage		Traitements
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello Adamou<moustaphbi@yahoo.fr>
 * @desc			Script de traitement du rejet d'un document.
 * @creationdate	mercredi 30 juin 2010
 * @updates
 */	
	global $siteweb, $numdoc;
	//print_r($_POST);die("Kaloudji");	
	$data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
	$data[$lkey] = $lvalue;
	}
	
	$login = (isset($data["login"])) ? (! is_null($data["login"])) ? $data["login"] : "" : "";
	$do = (isset($data["do"])) ? (! is_null($data["do"])) ? $data["do"] : "accueil" : "accueil";
	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
	$numtache = (isset($data["numtache"])) ? (! is_null($data["numtache"])) ? $data["numtache"] : null : null;
	$liste_elements = (isset($data["liste_elements"])) ? (! is_null($data["liste_elements"])) ? $data["liste_elements"] : "" : "";
	$typedoc = (isset($data["typedoc"])) ? (! is_null($data["typedoc"])) ? $data["typedoc"] : "" : "";
	//$numdoc = $data["numdoc"];
	$document= (isset($data["document"])) ? (! is_null($data["document"])) ? $data["document"] : null : null;
   	$ajax = (isset($data["ajax"])) ? (! is_null($data["ajax"])) ? $data["ajax"] : 0 : 0;
	$codeuser = (isset($data["codeuser"])) ? (! is_null($data["codeuser"])) ? $data["codeuser"] : "" : "";
	   	
	$numworkflow = (isset($data["numworkflow"])) ? (! is_null($data["numworkflow"])) ? $data["numworkflow"] : null : null;
	$numdoc = (isset($data["numdoc"])) ? (! is_null($data["numdoc"])) ? $data["numdoc"] : null : null;
	$heuredebutwf = (isset($data["heuredebutwf"])) ? (! is_null($data["heuredebutwf"])) ? $data["heuredebutwf"] : null : null;
	$dureewf = (isset($data["dureewf"])) ? (! is_null($data["dureewf"])) ? $data["dureewf"] : null : null;
	$archivewf = (isset($data["archivewf"])) ? (! is_null($data["archivewf"])) ? $data["archivewf"] : null : null;
	
    //obtenir le séparateur de dossier pour le OS en cours
	if (! defined("DS")) define("DS" , DIRECTORY_SEPARATOR);
     
    $chemin = dirname(__FILE__);
	$chemin = str_replace(DS."ged".DS."traitements","",$chemin);
	require_once($chemin.DS."classe".DS."application.class.php");
    $siteweb = new Application();
    ini_set('include_path', $siteweb->get_document_root().'\includes\pear');//charger les packages de PEAR::MDB2	
    
    //chargement des spécifications de la classe document
    require_once($siteweb->get_document_root().DS."ged".DS."classe".DS."document.class.php");
    $doc = new Document();
    
    //chargement des spécifications de la classe workflow   
    require_once($siteweb->get_document_root().DS."workflow".DS."classe".DS."workflow.class.php");
    $workfl = new workflow();
    $workfl->numdoc = $numdoc; 
    //if ( ! $workfl->rechercher_workflowcourant())  die($workfl->get_exception());
    $listeworkflowcourant = $workfl->rechercher_workflowcourant();  
    if (is_null($listeworkflowcourant))  die($workfl->get_exception());
  
    //$workfl->numtache = $numtache;
    $workfl->numworkflow = $listeworkflowcourant[0]["numworkflow"];
    //if ( ! $workfl->modifier_tachecourante())  die($workfl->get_exception());
    $listecircuittache = $workfl->rechercher_circuit_tache(); 
    
    //chargement des spécifications de la classe workflow
    require_once($siteweb->get_document_root().DS."workflow".DS."classe".DS."circuit.class.php");
    //instancier un objet circuit
    $lcircuit = new circuit();    
    $lcircuit->codecircuit = $listecircuittache[0][codecircuit];
    //$lcircuit->numtacheprec = $listecircuittache[0][numtache];
    if ( ! $lcircuit->rechercher_tacheinitiale() )  die($lcircuit->get_exception());
    $listecircuitroute=$lcircuit->rechercher_tacheinitiale();
    
    //chargement des spécifications de la classe workflow
    require_once($siteweb->get_document_root().DS."ged".DS."classe".DS."document.class.php");
    $doc = new Document();
    $doc->numdoc = $numdoc ;
    $doc->codeusercours = $data[codeuser];//print_r($data[codeuser]);die("shiiiiilo");
    $doc->numtache = $listecircuitroute[0][numtache];
    if ( ! $doc->modifier_route_doc())  die($doc->get_exception());
    
    //libérer la mémoire
    unset($workfl);
    unset($doc);
    unset($lcircuit);
    unset($listetachecourante);
    unset($listecircuittache);
    unset($listecircuitroute);
   
?>