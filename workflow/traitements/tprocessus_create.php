<?php

/**
 * @version			1.0
 * @package			Workflow
 * @subpackage		Processus
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			bello <mouttaphbi@yahoo.fr>
 * @desc			Script de prétraitements pour le formulaire de création d'un processus
 * 
 * @creationdate	????
 * @updates
 * 	# vendredi 26 juin 2009 by patrick mveng<patrick.mveng@interfacesa.com>
 * 		- génératio automatique du nouveau numéro de processus
 * 		- intégration des valeurs de $_POST et $_GET. Si un paramètre se trouve dans les deux tableaux, c'est celui dans $_GET qui est considéré
 * 		- harmonisation de la variable $chemin à la ligne 32 et 34
 */
   
	$data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
		$vars[$lkey] = $lvalue;
	}
   
  
   $lang = $data["lang"];
   if (trim($lang=="")) 
   { $lang="fr";}
   $chemin = dirname(__FILE__);
    //die($chemin);
	$chemin = str_replace("\workflow\\traitements","",$chemin);
   //$passwd = $data["passwd"];
	require_once($chemin.'\classe\application.class.php');	
	
   $siteweb = new Application();
   
   //obtenir le séparateur de dossier pour la OS en cours
   define( 'DS', DIRECTORY_SEPARATOR );
   //chargement des spécifications de la classe processus
   require_once($siteweb->get_document_root().DS."workflow".DS."classe".DS."processus.class.php");
   
   //instancier un objet processus
   $lprocessus = new processus();
   //générer un nouveau numéro de processus
   $lprocessus->numprocessus =  $lprocessus->generer_numero();
   
   global $siteweb , $lprocessus;
   
   
   //charger l'unité de durée des processuss
   //chargement des spécifications de la classe processus
   require_once($siteweb->get_document_root().DS."administration".DS."classe".DS."config.class.php");
   //instancier un objet configuration
   $lconfig = new Config();
   //charger la configuration unite_durée
   $unite_duree =  $lconfig->charger();
   switch (intval($lconfig->uniteduree_process))
   {
   		case 1 :
   			$unite_duree = $translate["heure"]."(s)";
   			break;
   		case 2 :
   			$unite_duree = $translate["jour"]."(s)";
   			break;
   		case 3 :
   			$unite_duree = $translate["mois"]."(s)";
   			break;
		default:
			$unite_duree = $translate["jour"]."(s)";
			break;
   }
   
?>