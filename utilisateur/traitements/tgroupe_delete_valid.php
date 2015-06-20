
<?php

/**
 * @version			1.0
 * @package			Utilisateur
 * @subpackage		Groupe
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello Adamou <moustaphbi@yahoo.fr>
 * @desc			Script pour la suppression physique d'un groupe d'utilisateurs.
 * @creationdate	20 Juillet 2009
 */
   
	$data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
	$data[$lkey] = $lvalue;
	}
   
	$ajax = (isset($data["ajax"])) ? (! is_null($data["ajax"])) ? $data["ajax"] : 0 : 0;
	$login = (isset($data["login"])) ? (! is_null($data["login"])) ? $data["login"] : "" : "";
	$action = (isset($data["action"])) ? (! is_null($data["action"])) ? $data["action"] : "accueil" : "accueil";
	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
    $chemin = dirname(__FILE__);
	$chemin = str_replace("\utilisateur\\traitements","",$chemin);
  
 	//obtenir le séparateur de dossier pour la OS en cours
   if (! defined("DS")) define( 'DS', DIRECTORY_SEPARATOR );
	
	require_once($chemin.DS.'classe'.DS.'application.class.php');	
	$siteweb = new Application();
   
  
   //chargement des spécifications de la classe profil
   require_once($siteweb->get_document_root().DS."utilisateur".DS."classe".DS."groupe.class.php");
   
   //instancier un objet groupe
   $lgroupe = new groupe();
   
   //créer automatiquement les attributs sur l'objet 
   foreach ($data as $lattribut => $lvaleur) 
   {
   	$lgroupe->$lattribut = $lvaleur;	
   }
   
   //chargement de PEAR
   ini_set('include_path', $siteweb->get_document_root().'\includes\pear');	//charger les packages de PEAR::MDB2	

   //supprimer le groupe
   if ($lgroupe->supprimer())
   {
   	$state = "delete_valid_success";
   }
   else die($lgroupe->exception);
   
?>
