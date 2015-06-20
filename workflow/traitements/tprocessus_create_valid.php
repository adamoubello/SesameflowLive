<?php
/**
 * @version			1.0
 * @package			Workflow
 * @subpackage		Processus
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			patrick mveng <patrick.mveng@interfacesa.local>
 * @desc			Script pour l'enregistrement d'un nouveau processus. Ce script peut être appellé depuis ajax
 * 
 * @creationdate	26 juin 2009
 * @updates
 * 	# vendredi 26 juin 2009 by patrick mveng<patrick.mveng@interfacesa.com>
 * 		- génératio automatique du nouveau numéro de processus
 * 		- intégration des valeurs de $_POST et $_GET. Si un paramètre se trouve dans les deux tableaux, c'est celui dans $_GET qui est considéré
 * 		- harmonisation de la variable $chemin à la ligne 32 et 34
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
    //die($chemin);
	$chemin = str_replace("\workflow\\traitements","",$chemin);
   //$passwd = $data["passwd"];
	require_once($chemin.'\classe\application.class.php');	
	
   $siteweb = new Application();
   
   //obtenir le séparateur de dossier pour la OS en cours
   if (! defined("DS")) define( 'DS', DIRECTORY_SEPARATOR );
   //chargement des spécifications de la classe processus
   require_once($siteweb->get_document_root().DS."workflow".DS."classe".DS."processus.class.php");
   
   //instancier un objet processus
   $lprocessus = new processus();
   //créer automatiquement attibuts sur l'objet
   foreach ($data as $lattribut => $lvaleur) 
   {
   		$lprocessus->$lattribut = $lvaleur;	
   }
   
    //chargement de PEAR
  ini_set('include_path', $siteweb->get_document_root().'\includes\pear');	//charger les packages de PEAR::MDB2	

   //enregistrer le processus
   if ($lprocessus->insertion())
   {
   		$state = "processus_create_valid_success";
   		$lurl = $siteweb->get_url()."/gabarit/page.gabarit.php?";
   		$lparam_url = "lang={$lang}&action=processus_search&login={$login}&state=processus_create_valid_success";//&lang={$lang}";
   		$_POST["action"] = "processus_search";
   		$_POST["state"] = "processus_create_valid_success";
   }
   else die($lprocessus->exception);
   
?>