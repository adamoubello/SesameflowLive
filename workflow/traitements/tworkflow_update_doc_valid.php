<?php
/**
 * @version			1.0
 * @package			Workflow
 * @subpackage		Workflow
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello Adamou <moustaphbi@yahoo.fr>
 * @desc			Script pour de routage de documents sur le circuit d'un workflow donné
 */
		
	$data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
	$data[$lkey] = $lvalue;
	}
     
	$login = (isset($data["login"])) ? (! is_null($data["login"])) ? $data["login"] : "" : "";
	$do = (isset($data["do"])) ? (! is_null($data["do"])) ? $data["do"] : "accueil" : "accueil";
	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
	$numtache = (isset($data["numtache"])) ? (! is_null($data["numtache"])) ? $data["numtache"] : null : null;
	$numtachesuiv = (isset($data["numtachesuiv"])) ? (! is_null($data["numtachesuiv"])) ? $data["numtachesuiv"] : null : null;
	$numworkflow = (isset($data["numworkflow"])) ? (! is_null($data["numworkflow"])) ? $data["numworkflow"] : null : null;
	$liste_elements = (isset($data["liste_elements"])) ? (! is_null($data["liste_elements"])) ? $data["liste_elements"] : "" : "";
	$typedoc = (isset($data["typedoc"])) ? (! is_null($data["typedoc"])) ? $data["typedoc"] : "" : "";
    $numdoc = (isset($data["numdoc"])) ? (! is_null($data["numdoc"])) ? $data["numdoc"] : null : null;
	$heuredebutwf = (isset($data["heuredebutwf"])) ? (! is_null($data["heuredebutwf"])) ? $data["heuredebutwf"] : null : null;
	$dureewf = (isset($data["dureewf"])) ? (! is_null($data["dureewf"])) ? $data["dureewf"] : null : null;
	$archivewf = (isset($data["archivewf"])) ? (! is_null($data["archivewf"])) ? $data["archivewf"] : null : null;
	$négatif=false;
	
    //obtenir le séparateur de dossier pour le OS en cours
	if (! defined("DS")) define("DS" , DIRECTORY_SEPARATOR);
     
    $chemin = dirname(__FILE__);
	$chemin = str_replace(DS."workflow".DS."traitements","",$chemin);
	require_once($chemin.DS."classe".DS."application.class.php");
    $siteweb = new Application();
    ini_set('include_path', $siteweb->get_document_root().'\includes\pear');//charger les packages de PEAR::MDB2	
    require_once($siteweb->get_document_root().DS."utilisateur".DS."classe".DS."utilisateur.class.php");
	$luser = new utilisateur ();
	     
    //chargement des spécifications de la classe document
    require_once($siteweb->get_document_root().DS."ged".DS."classe".DS."document.class.php");
    $doc = new Document();
    $doc->numdoc = $numdoc;
    if ( ! $doc->rechercher_tachecourante())  die($doc->get_exception());
    $listetachecourante = $doc->rechercher_tachecourante();
        
    //chargement des spécifications de la classe workflow   
    require_once($siteweb->get_document_root().DS."workflow".DS."classe".DS."workflow.class.php");
    $workfl = new workflow();
    $workfl->numdoc = $numdoc; 
    if ( ! $workfl->rechercher_workflowcourant())  die($workfl->get_exception());
    $listeworkflowcourant = $workfl->rechercher_workflowcourant();  
    //$workfl->numtache = $numtache;
    //$workfl->numworkflow = $listeworkflowcourant[0]["numworkflow"];
    //if ( ! $workfl->modifier_tachecourante())  die($workfl->get_exception());
    $listecircuittache = $workfl->rechercher_circuit_tache(); 
    
    //chargement des spécifications de la classe workflow
    require_once($siteweb->get_document_root().DS."workflow".DS."classe".DS."circuit.class.php");
	//chargement des spécifications de la classe workflow
    require_once($siteweb->get_document_root().DS."ged".DS."classe".DS."document.class.php");
    $doc = new Document();
        
    //instancier un objet circuit
    $lcircuit = new circuit();    
    $lcircuit->codecircuit = $listecircuittache[0][codecircuit];
    $lcircuit->numtacheprec = $listecircuittache[0][numtache];
    //if ( ! $lcircuit->rechercher_route())  die($lcircuit->get_exception());
    $listecircuitroute=$lcircuit->rechercher_route();
    
    if (is_null($listecircuitroute)) 
    {
       //Si on est en tâche terminale,on archive le workflow
       $workfl->numworkflow = $listeworkflowcourant[0]["numworkflow"];
       if ( ! $workfl->archiver())  die($workfl->get_exception());
    
       //Si on est en tâche terminale,on archive le document    
       $doc->numdoc = $numdoc ;
       if ( ! $doc->archiver())  die($doc->get_exception());      
    }
    else  
    {  	
       $doc->numdoc = $numdoc ;
       $doc->codeusercours = $listecircuitroute[0][codeuser];
       $doc->numtache = $listecircuitroute[0][numtache];
       if ( ! $doc->modifier_route_doc())  die($doc->get_exception());
       
       $workfl->numtache = $listecircuitroute[0][numtache];
       $workfl->numworkflow = $listeworkflowcourant[0]["numworkflow"];
       if ( ! $workfl->modifier_tachecourante())  die($workfl->get_exception());
    }
       
    //libérer la mémoire
    unset($workfl);
    unset($doc);
    unset($lcircuit);
    unset($listetachecourante);
    unset($listecircuittache);
    unset($listecircuitroute);
           
?>