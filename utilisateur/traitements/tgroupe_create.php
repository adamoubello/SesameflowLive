<?php

/**
 * @version			1.0
 * @package			Utilisateur
 * @subpackage		Groupe
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello Adamou <moustaphbi@yahoo.fr>
 * @desc			Script qui traite le formulaire de création d'un groupe
 * @creationdate	????
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
   $chemin = str_replace(DS."utilisateur".DS."traitements","",$chemin);
   require_once($chemin.DS.'classe'.DS.'application.class.php');	
	
   $siteweb = new Application();
   
   //obtenir le séparateur de dossier pour la OS en cours
   define( 'DS', DIRECTORY_SEPARATOR );
   //chargement des spécifications de la classe processus
   require_once($siteweb->get_document_root().DS."utilisateur".DS."classe".DS."groupe.class.php");
   
   //instancier un objet groupe
   $lgroupe = new groupe();
   //générer un nouveau numéro de processus
   $lgroupe->codegroup =  $lgroupe->generer_numero();
   
   global $siteweb , $lgroupe;
   
?>