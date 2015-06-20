<?php
/**
 * @version			1.0
 * @package			Utilisateur
 * @subpackage		D�partement
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits r�serv�s
 * @license			INTERFACE SA
 * @author 			Bello Adamou<moustaphbi@yahoo.fr>
 * @desc			Script pour l'enregistrement d'une nouveau d�partement.
 * @creationdate	15 Juillet 2009
 */
   
	$data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
	$data[$lkey] = $lvalue;
	}
   
	$ajax = (isset($data["ajax"])) ? (! is_null($data["ajax"])) ? $data["ajax"] : 0 : 1;
	$login = (isset($data["login"])) ? (! is_null($data["login"])) ? $data["login"] : "" : "";
	$do = (isset($data["do"])) ? (! is_null($data["do"])) ? $data["do"] : "accueil" : "accueil";
	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
    $chemin = dirname(__FILE__);
	$chemin = str_replace("\utilisateur\\traitements","",$chemin);
	require_once($chemin.'\classe\application.class.php');	
	
   $siteweb = new Application();
   //chargement de PEAR
   ini_set('include_path', $siteweb->get_document_root().DS.'includes'.DS.'pear');	//charger les packages de PEAR::MDB2	
   
   //obtenir le s�parateur de dossier pour la OS en cours
   if (! defined("DS")) define( 'DS', DIRECTORY_SEPARATOR );
   //chargement des sp�cifications de la classe d�partement
   require_once($siteweb->get_document_root().DS."utilisateur".DS."classe".DS."departement.class.php");
   
   //instancier un objet departement
   $dep = new departement();
   //cr�er automatiquement attibuts sur l'objet
   foreach ($data as $lattribut => $lvaleur) 
   {
   $dep->$lattribut = $lvaleur;	
   }
   
   //enregistrer le	d�partement
   if ($dep->ajouter())
   {
   	$state = "departement_create_valid_success";
   }
   else die($dep->exception);
   
?>