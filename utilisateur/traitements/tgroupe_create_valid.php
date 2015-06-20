<?php

/**
 * @version			1.0
 * @package			Utilisateur
 * @subpackage		Groupe
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello Adamou
 * @desc			Script pour l'enregistrement d'un nouveau groupe. Ce script peut être appellé depuis ajax
 * @creationdate	26 juin 2009
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
    $chemin = str_replace("\utilisateur\\traitements","",$chemin);
    require_once($chemin.'\classe\application.class.php');	
    $siteweb = new Application();
   
   //obtenir le séparateur de dossier pour la OS en cours
   if (! defined("DS")) define( 'DS', DIRECTORY_SEPARATOR );
   //chargement des spécifications de la classe groupe
   require_once($siteweb->get_document_root().DS."utilisateur".DS."classe".DS."groupe.class.php");
   
   //instancier un objet groupe
   $lgroupe = new groupe();
   //créer automatiquement attibuts sur l'objet
   foreach ($data as $lattribut => $lvaleur) 
   {
   $lgroupe->$lattribut = $lvaleur;	
   }
   
   //chargement de PEAR
   ini_set('include_path', $siteweb->get_document_root().'\includes\pear');	//charger les packages de PEAR::MDB2	

   //enregistrer le groupe
   if ($lgroupe->insertion())
   {
   		$state = "groupe_create_valid_success";
   		$lurl = $siteweb->get_url()."/gabarit/page.gabarit.php?";
   		$lparam_url = "lang={$lang}&action=groupe_search&login={$login}&state=groupe_create_valid_success";//&lang={$lang}";
   		$_POST["action"] = "groupe_search";
   		$_POST["state"] = "groupe_create_valid_success";
   }
   else die($lgroupe->exception);
   
?>