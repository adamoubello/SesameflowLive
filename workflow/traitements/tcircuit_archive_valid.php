<?php
/**
 * @version			1.0
 * @package			Workflow
 * @subpackage		Circuit
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits r�serv�s
 * @license			INTERFACE SA
 * @author 			patrick mveng <patrick.mveng@interfacesa.local>
 * @desc			Script pour l'archivage d'un circuit.
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
	$action = (isset($data["action"])) ? (! is_null($data["action"])) ? $data["action"] : "accueil" : "accueil";
	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
   $chemin = dirname(__FILE__);
    //die($chemin);
	$chemin = str_replace("\workflow\\traitements","",$chemin);
   //$passwd = $data["passwd"];
	require_once($chemin.'\classe\application.class.php');	
	
   $siteweb = new Application();
   
   //obtenir le s�parateur de dossier pour la OS en cours
   if (! defined("DS")) define( 'DS', DIRECTORY_SEPARATOR );
   //chargement des sp�cifications de la classe processus
   require_once($siteweb->get_document_root().DS."workflow".DS."classe".DS."circuit.class.php");
   
   //instancier un objet circuit
   $lcircuit = new circuit();
   //cr�er automatiquement attibuts sur l'objet
   foreach ($data as $lattribut => $lvaleur) 
   {
   		$lcircuit->$lattribut = $lvaleur;	
   }
   
    //chargement de PEAR
  ini_set('include_path', $siteweb->get_document_root().'\includes\pear');	//charger les packages de PEAR::MDB2	

   //supprimer physiquement le circuit
   if ($lcircuit->archiver())
   {
   		$state = "circuit_archive_valid_success";
   }
   else die($lcircuit->exception);
   
   //lib�rere la m�moire
   unset($lcircuit);
?>