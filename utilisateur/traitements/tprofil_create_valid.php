<?php

/**
 * @version			1.0
 * @package			Utilisateur
 * @subpackage		Profil
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			patrick mveng<patrick.mveng@interfacesa.local>
 * @desc			Script pour l'enregistrement d'un nouveau profil. Ce script peut être appellé depuis ajax
 * @creationdate	08 juillet 2009
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
    $chemin = str_replace(DS."utilisateur".DS."traitements","",$chemin);
    require_once($chemin.DS.'classe'.DS.'application.class.php');	
    $siteweb = new Application();
   
   //obtenir le séparateur de dossier pour la OS en cours
   if (! defined("DS")) define( 'DS', DIRECTORY_SEPARATOR );
   //chargement des spécifications de la classe profil
   require_once($siteweb->get_document_root().DS."utilisateur".DS."classe".DS."profi.class.php");
   
   //instancier un objet profil
   $lprofil = new profil();
   //créer automatiquement attibuts sur l'objet
   foreach ($data as $lattribut => $lvaleur) 
   {
   $lprofil->$lattribut = $lvaleur;	
   }
   
   //chargement de PEAR
   ini_set('include_path', $siteweb->get_document_root().DS.'includes'.DS.'pear');	//charger les packages de PEAR::MDB2	

   //enregistrer le profil
   if ($lprofil->ajouter())
   {
   		$state = "profil_create_valid_success";
   }
   else die($lprofil->exception);
   
?>
