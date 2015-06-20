<?php
/**
 * @version			1.0
 * @package			Workflow
 * @subpackage		Workflow
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits r�serv�s
 * @license			INTERFACE SA
 * @author 			Bello Adamou<moustaphbi@yahoo.fr> 
 * @desc			script de pr�traitements pour la fiche de cr�ation d'une instance de workflow
 * 					
 * @creationdate	????
 * @updates
 */
   
    $data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
	$data[$lkey] = $lvalue;
	}
   
    //obtenir le s�parateur de dossier pour le OS en cours
    if (! defined("DS")) define( 'DS', DIRECTORY_SEPARATOR );
  
 	$login = (isset($data["login"])) ? (! is_null($data["login"])) ? $data["login"] : "" : "";
	$do = (isset($data["do"])) ? (! is_null($data["do"])) ? $data["do"] : "accueil" : "accueil";
	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
	$numtache = (isset($data["numtache"])) ? (! is_null($data["numtache"])) ? $data["numtache"] : null : null ;
	$numdoc = (isset($data["numdoc"])) ? (! is_null($data["numdoc"])) ? $data["numdoc"] : null : null ;
	$typedoc = (isset($data["typedoc"])) ? (! is_null($data["typedoc"])) ? $data["typedoc"] : null : null ;
  
    $chemin = dirname(__FILE__);
	$chemin = str_replace(DS."workflow".DS."traitements","",$chemin);
	require_once($chemin.DS.'classe'.DS.'application.class.php');	
    $siteweb = new Application();
    global $siteweb;
	ini_set('include_path', $siteweb->get_document_root().DS.'includes'.DS.'pear');	//charger les packages de PEAR::MDB2	
  
	//�tape de cr�ation d'un document dans le workflow
	//v�rifier si l'utilisateur en cours a le droit d'ex�cuter la t�che
	require_once($siteweb->get_document_root().DS."utilisateur".DS."classe".DS."utilisateur.class.php");
	require_once($siteweb->get_document_root().DS."workflow".DS."classe".DS."workflow.class.php");
	//chargement des sp�cifications de la classe formulaire
    require_once($siteweb->get_document_root().DS."ged".DS."classe".DS."formulaire.class.php");

	$lworkflow = new Workflow();
	//$lworkflow->control_permission($numtache , $login);
	
	//cr�er une instance de workflow
	$lworkflow->numtache = $numtache;
	$lworkflow->numdoc = $numdoc;
	$lworkflow->typedoc = $typedoc;
	$lworkflow->login = $login;
	$lworkflow->datedebutwf = date("d/m/Y");
	$lworkflow->heuredebutwf = date("h:m:s");
	$lworkflow->dureewf = 0;	//temps d�j� pass� dans ce workflow
	$lworkflow->avancementwf = 0.00;
	$lworkflow->codecircuit = $codecircuit;
	//print_r($lworkflow->numdoc);die("Mama ����! l�fammsooooo l�famso!");
	//g�n�rer un nouveau num�ro
	$lworkflow->numworkflow = $lworkflow->generer_numero();
	//ajouter ce workflow dans la base de donn�es
	if (! $lworkflow->ajouter()) die($lworkflow->get_exception());
	
	//ajouter ce nouveau num�ro de workflow dans les param�tres � poster
	$_POST["numworkflow"] = $lworkflow->numworkflow;

?>