<?php
/**
 * @version			1.0
 * @package			Workflow
 * @subpackage		Workflow
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			patrick mveng <patrick.mveng@interfacesa.local>
 * @desc			Script pour l'enregistrement d'une nouvelle instance de workflow.
 * 
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
    
    //obtenir le séparateur de dossier pour la OS en cours
	if (! defined("DS")) 	define("DS" , DIRECTORY_SEPARATOR);

    $chemin = dirname(__FILE__);
	$chemin = str_replace(DS."workflow".DS."traitements","",$chemin);
	require_once($chemin.DS."classe".DS."application.class.php");
    $siteweb = new Application();
   	require_once($siteweb->get_document_root().DS."ged".DS."traitements".DS."tdocument_create_valid.php");   

	$_POST["numdoc"] = $numdoc;
	require_once($siteweb->get_document_root().DS."ged".DS."lang".DS."ged.{$lang}.php");   
	//fabriquer le pdf
	require_once($siteweb->get_document_root().DS."ged".DS."traitements".DS."tdoc_generer_pdf.php");   

	//mettre à jour l'état du workflow en cours
    //chargement des spécifications de la classe workflow
    require_once($siteweb->get_document_root().DS."workflow".DS."classe".DS."workflow.class.php");
    $lworkflow = new workflow();
    $lworkflow->numworkflow = $numworkflow;
	//il faut mettre à jour le workflow
	$lworkflow->numtache = $numtachesuiv;//en fait $numtachesuiv est le numéro de la tâche qui a provoqué l'appel de tworkflow_create_valid.php		
    $lworkflow->numdoc = $numdoc;	//$numdoc vient de la création de document
	if ( ! $lworkflow->modifier_tache())  die($lworkflow->get_exception());
   
	//A t-on atteint une tâche terminale?On a atteint une tache terminale si $numtachesuiv n'a pas de tâche suivante.
	//si tache terminale, on va archivé le workflow
	
	//obtenir le codecircuit
	if (! $lworkflow->charger()) die($lworkflow->get_exception());
	
	//RECHERCHER  la liste des tâches suivantes à la tâche en cours
	require_once($siteweb->get_document_root().DS."workflow".DS."classe".DS."tache.class.php");
	$ltache = new tache();//print_r($numdoc);die("");
	$ltache->numtache = $numtachesuiv;
	$ltache->codecircuit = $lworkflow->codecircuit;
	$listetache = $ltache->rechercher();
	if ($ltache->has_exception()) die($ltache->get_exception());
	
	$est_terminale = true;
	//vérifier si toutes les tâches suivantes sont nulles
	$i = 0;
	while ( ($est_terminale) && ($i < count($listetache)))
	{
		$est_terminale = (trim($listetache[$i]["numtachesuiv"]) == "");	
		//$numtachesuiv = intval($listetache[$i]["numtachesuiv"]);
		$i++;
	}
	
	//si la tache est terminale
	if ($est_terminale)
	{
		//archiver le workflow
		$lworkflow->archiver();
	}
	
	//libérer la mémoire
	unset($lworkflow);
	unset($listetache);
	unset($ltache);
	
	$state = "insert_valid_success";
   
?>