<?php
/**
 * @desc		script d'authentification  à la base de données
 * @version		1.0
 * @package		Administration
 * @copyright (C) 2009 INTERFACE SA. Tous droits réservés
 * @license		INTERFACE SA
 * @author 		Bello Adamou <moustaphbi@yahoo.fr>
 * @updates
 * 	# samedi 20 juin 2009 (Patrick Mveng)
 * 		- suppression de la fonction init()
 * 		- postage de la langue et le login de l'utilisateur à la page gabarit
 */

    $data = $_POST;

	foreach ($_GET as $lkey => $lvalue)
	{
	$data[$lkey] = $lvalue;
	}

	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
	$ajax= (isset($data["ajax"])) ? (! is_null($data["ajax"])) ? $data["ajax"] : 0 : 0;
	
      if (! defined("DS")) define("DS" , DIRECTORY_SEPARATOR);

	$chemin = dirname(__FILE__);
	$chemin = str_replace(DS."installation".DS."traitements","",$chemin);
	require_once($chemin.DS.'classe'.DS.'application.class.php'); 
	$siteweb = new Application();
	
	require_once($siteweb->get_document_root().'\utilisateur\classe\groupe.class.php');
    $lgroupe = new groupe();
    
   	//définir les paramètres de connexion à la nouvelle base de données
	//ces paramètres sont les données issus de l'étape 3
	$lgroupe->typebd=$data["typebd"];
	$lgroupe->userbd=$data["userbd"];
	$lgroupe->pwdbd=$data["pwdbd"];
	$lgroupe->nombd=$data["nombd"];
	$lgroupe->hotebd=$data["hotebd"];
	 
    $lgroupe->codegroup=1;
    $lgroupe->libgroup="superadmin";
    $lgroupe->supprimgroup=0;
    
    ini_set('include_path', $siteweb->get_document_root().'\includes\pear');//charger les packages de PEAR::MDB2
	//enregistrer le groupe
   if (! $lgroupe->insertion()) die($lgroupe->exception);
	
	require_once($siteweb->get_document_root().DS.'utilisateur'.DS.'classe'.DS.'utilisateur.class.php');
    $user = new Utilisateur();
    
    //créer automatiquement attibuts sur l'objet
	foreach ($data as $lattribut => $lvaleur)
	{
		$user->$lattribut = $lvaleur;
	}
	
	//définir les paramètres de connexion à la nouvelle base de données
	//ces paramètres sont les données issus de l'étape 3
	$user->typebd=$data["typebd"]; 
	$user->userbd=$data["userbd"];
	$user->pwdbd=$data["pwdbd"];
	$user->nombd=$data["nombd"];
	$user->hotebd=$data["hotebd"];
	
    $user->passworduser = md5(trim($user->passworduser));
    $user->loginuser = "admin";
    $user->codeuser = 1;
    $user->codegroup = 1;
    $user->nomuser = "admin";
    $user->connected = 0;
    
	if (! $user->ajouter()) die($user->get_exception());

?>
