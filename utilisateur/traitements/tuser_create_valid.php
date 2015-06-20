<?php
/**
 * @version			1.0
 * @package			Utilisatuur
 * @subpackage		Utilisatuur
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello
 * @desc			Script pour l'enregistrement d'une nouvel utilisateur.
 * 
 * @creationdate	?????
 * @updates
 * 	# lundi 20 juillet 2009 by patrick mveng<patrick.mveng@interfacesa.local>
 * 		- cryptage du mot de passe avec md5 
 * 		- définition à 35 caractères de la taille du champ passworduser dans la bd, car 
 * le résultat de md5 est de taille 32
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
	$chemin = str_replace("\utilisateur\\traitements","",$chemin);
   //$passwd = $data["passwd"];
	require_once($chemin.'\classe\application.class.php');	
	
   $siteweb = new Application();
   //obtenir le séparateur de dossier pour la OS en cours
   if (! defined("DS")) define( 'DS', DIRECTORY_SEPARATOR );
   //chargement des spécifications de la classe utilisateur
   require_once($siteweb->get_document_root().DS."utilisateur".DS."classe".DS."utilisateur.class.php");
   
   //instancier un objet user
   $luser = new Utilisateur();
   //créer automatiquement attibuts sur l'objet
   foreach ($data as $lattribut => $lvaleur) 
   {
   		$luser->$lattribut = $lvaleur;	
   }
   
   //crypter le mot de passe avant de l'entegistrer dans la base donées
   $luser->passworduser = md5(trim($luser->passworduser));
   
    //chargement de PEAR
  ini_set('include_path', $siteweb->get_document_root().'\includes\pear');	//charger les packages de PEAR::MDB2	
   //enregistrer la	 tâche
   if ($luser->ajouter())
   {
   		$state = "user_create_valid_success";
   }
   else die($luser->exception);
   
?>