
<?php

/**
 * @version			1.0
 * @package			Utilisateur
 * @subpackage		utilisateur
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits r�serv�s
 * @license			INTERFACE SA
 * @author 			bello
 * @desc			Script pour la suppression physique d'un utilisateur.
 * @creationdate	08 juillet 2009
 * @updates
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
	require_once($chemin.'\classe\application.class.php');	
	
    $siteweb = new Application();
   
   //obtenir le s�parateur de dossier pour la OS en cours
   if (! defined("DS")) define( 'DS', DIRECTORY_SEPARATOR );
   
   //chargement des sp�cifications de la classe utilisateur
   require_once($siteweb->get_document_root().DS."utilisateur".DS."classe".DS."utilisateur.class.php");
   
   //instancier un objet utilisateur
   $user = new Utilisateur();
   
   //cr�er automatiquement attibuts sur l'objet
   foreach ($data as $lattribut => $lvaleur) 
   {
   	$user->$lattribut = $lvaleur;	
   }
   
   //chargement de PEAR
   ini_set('include_path', $siteweb->get_document_root().'\includes\pear');	//charger les packages de PEAR::MDB2	

   //enregistrer l'utilisateur
   if ($user->supprimer())
   {
   $state = "utilisateur_delete_valid_success";//die ('whats?');
   }
   else die($user->exception);
   
?>
