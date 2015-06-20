<?php
/**
 * @version			1.0
 * @package			GED
 * @subpackage		Document
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			William<william.nkingne@laposte.net>
 * @desc			Script de traitement de la création d'un formulaire
 * @creationdate	mercredi 17 juin 2009
 * @updates
 * @todo
 */   
   $data = ($_POST) ? $_POST : $_GET;
  
   $lang = $data["lang"];
   if (trim($lang=="")){
   	$lang="fr";
   }
   
   $chemin = dirname(__FILE__);
   $chemin = str_replace("\ged\\traitements","",$chemin);
   
   require_once($chemin.'\classe\application.class.php');	
	
   $siteweb = new Application();
   
   global $siteweb;
   
?>