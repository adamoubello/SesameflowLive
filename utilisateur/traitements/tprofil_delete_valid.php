
<?php

/**
 * @version			1.0
 * @package			Utilisateur
 * @subpackage		Profil
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello Adamou <moustaphbi@yahoo.fr>
 * @desc			Script pour la suppression physique d'un profil.
 * @creationdate	20 Juillet 2009
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
   //chargement des spécifications de la classe profil
   require_once($siteweb->get_document_root().DS."utilisateur".DS."classe".DS."profi.class.php");
   
   //instancier un objet profil
   $lprofil = new profil();
   
   //créer automatiquement les attributs sur l'objet 
   foreach ($data as $lattribut => $lvaleur) 
   {
   $lprofil->$lattribut = $lvaleur;	
   }
   
   //chargement de PEAR
   ini_set('include_path', $siteweb->get_document_root().'\includes\pear');	//charger les packages de PEAR::MDB2	

   //enregistrer la profil
   if ($lprofil->supprimer())
   {
   $state = "delete_valid_success";
   }
   else die($lprofil->exception);
   
?>
