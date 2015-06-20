<?php
/**
 * @version			1.0
 * @package			Workflow
 * @subpackage		Tache
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			patrick mveng <patrick.mveng@interfacesa.local>
 * @desc			Script pour l'enregistrement d'une nouvelle tache.
 * 
 * @creationdate	26 juin 2009
 * @updates
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
	$chemin = str_replace("\workflow\\traitements","",$chemin);
	require_once($chemin.'\classe\application.class.php');	
	
   $siteweb = new Application();
   //chargement de PEAR
   ini_set('include_path', $siteweb->get_document_root().DS.'includes'.DS.'pear');	//charger les packages de PEAR::MDB2	
   
   //obtenir le séparateur de dossier pour la OS en cours
   if (! defined("DS")) define( 'DS', DIRECTORY_SEPARATOR );
   //chargement des spécifications de la classe tache
   require_once($siteweb->get_document_root().DS."workflow".DS."classe".DS."tache.class.php");
   
   //instancier un objet tache
   $ltache = new tache();
   //créer automatiquement attibuts sur l'objet
   foreach ($data as $lattribut => $lvaleur) 
   {
   $ltache->$lattribut = $lvaleur;	
   }
   
   //si la tache est système, le numéro doit êtr inférieure à 0
   if (intval($ltache->systeme) == 1)
   {
   	$ltache->numtache = $ltache->generer_numero(true);
   }
   
   //enregistrer la	 tâche
   if ($ltache->ajouter())
   {
   	$state = "tache_create_valid_success";
   }
   else die($ltache->exception);
   
?>