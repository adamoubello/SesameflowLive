<?php
/**
 * @version			1.0
 * @package			GED
 * @subpackage		Document
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			patrick mveng <patrick.mveng@interfacesa.local>
 * @desc			Script pour le téléchargement d'un document
 * 
 * @creationdate	29 juin 2009
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
	$numdoc = (isset($data["numdoc"])) ? (! is_null($data["numdoc"])) ? $data["numdoc"] : "" : "";
	$typedoc = (isset($data["typedoc"])) ? (! is_null($data["typedoc"])) ? $data["typedoc"] : null : null;
  
	 //obtenir le séparateur de dossier pour la OS en cours
   if (! defined("DS")) define( 'DS', DIRECTORY_SEPARATOR );

   $chemin = dirname(__FILE__);
    //die($chemin);
	$chemin = str_replace(DS."ged".DS."traitements","",$chemin);
   //$passwd = $data["passwd"];
	require_once($chemin.DS.'classe'.DS.'application.class.php');	
   $siteweb = new Application();
   
	//Chargement des packages de PEAR::MDB2	
	ini_set('include_path', $siteweb->get_document_root().DS.'includes'.DS.'pear');	
   
   
   
   //charger les infos du document en cours suivant le type de document
   switch (trim(strtolower($typedoc)))
   {
   	case "numeric" : 
   		//chargement des spécifications de la classe Numerique
   		require_once($siteweb->get_document_root().DS."ged".DS."classe".DS."numerique.class.php");
   	
   		//instancier un objet numérique
   		$ldocument = new Numerique();
   		break;
   	default:
	   //chargement des spécifications de la classe Formulaire
   		require_once($siteweb->get_document_root().DS."ged".DS."classe".DS."formulaire.class.php");
   		
   		//instancier un objet formulaire
   		$ldocument = new Formulaire();
      	break;	
   }
   
   $ldocument->setNumdoc($numdoc);
   $ldocument->charger();
   
   $lfilename = $siteweb->get_document_root().DS."ged".DS."document".DS.$ldocument->get_chemin_acces();
   
   
   if (file_exists($lfilename))
   {
   		$f = fopen($lfilename , "r");
   		if ($f)
   		{
   			$lcontenu = fread($f,filesize($lfilename));
   			$ldocument->telechargerFichier($lcontenu , $ldocument->get_chemin_acces());
   		}
   }
   else $state =  "file_no_exist";
   
?>
