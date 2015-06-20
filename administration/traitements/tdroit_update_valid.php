<?php
/**
 * @version			1.0
 * @package			Administrateur
 * @subpackage		Droit
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Patrick Mveng 
 * @desc			Script pour l'affectation des permissions à un groupe
 * @param 			$arr_action	:	tableau de code action envoyé par le formulaire
 * @creationdate	24 juillet 2009
 * @updates
 */
   
	$data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
	$data[$lkey] = $lvalue;
	}
   
	$codegroup = (isset($data["codegroup"])) ? (! is_null($data["codegroup"])) ? $data["codegroup"] : "" : "";
	$login = (isset($data["login"])) ? (! is_null($data["login"])) ? $data["login"] : "" : "";
	$do = (isset($data["do"])) ? (! is_null($data["do"])) ? $data["do"] : "accueil" : "accueil";
	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
	$arr_action = (isset($data["arr_action"])) ? (! is_null($data["arr_action"])) ? $data["arr_action"] : null : null;
	
   //obtenir le séparateur de dossier pour la OS en cours
   if (! defined("DS")) define( 'DS', DIRECTORY_SEPARATOR );
	
    $chemin = dirname(__FILE__);
    $chemin = str_replace(DS."administration".DS."traitements","",$chemin);
	require_once($chemin.DS.'classe'.DS.'application.class.php');	
   $siteweb = new Application();
   
   //chargement des spécifications de la classe droit d'accès
   require_once($siteweb->get_document_root().DS."administration".DS."classe".DS."droa.class.php");
   
   //instancier un objet droit
   $lpermission = new droit();
   
   //créer automatiquement attibuts sur l'objet
   foreach ($data as $lattribut => $lvaleur) 
   {
   		$lpermission->$lattribut = $lvaleur;	
   }
   
    //chargement de PEAR
  ini_set('include_path', $siteweb->get_document_root().'\includes\pear');	//charger les packages de PEAR::MDB2	

  //supprimer toutes les permissions du groupe en cours
  	if ($lpermission->supprimer())
  	{
  		if (is_array($arr_action))
  		{	
	  		foreach ($arr_action as $lcodeaction)
	  		{
		  		//ajouter les permissions du groupe en cours
		  		$lpermission->codeaction = $lcodeaction;
		  		$lpermission->codegroup = $codegroup;
		  		$lpermission->ajouter();
	  		}
  		}
  	}
  	else die($lpermission->exception);
  	
  	unset($lpermission);
   
?>