<?php
/**
 * @version			1.0
 * @package			Utilisateur
 * @subpackage		Profil
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello Adamou <moustaphbi@yahoo.fr> 
 * @desc			script de prétraitements pour la fiche de création d'un profil  					
 * @creationdate	20 Juillet 2009
 */
   
    $data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
	$data[$lkey] = $lvalue;
	}
   
   //obtenir le séparateur de dossier pour la OS en cours
   if (! defined("DS")) define( 'DS', DIRECTORY_SEPARATOR );
  
   $lang = $data["lang"];
   if (trim($lang=="")) { $lang="fr";}
   $chemin = dirname(__FILE__);
   $chemin = str_replace("\utilisateur\\traitements","",$chemin);
   require_once($chemin.'\classe\application.class.php');	
   $siteweb = new Application();
   
   global $siteweb;
   
   require_once($siteweb->get_document_root()."\utilisateur\classe\profi.class.php");
   require_once($siteweb->get_document_root()."/includes/pear/Structures/DataGrid/Renderer/HTMLTable.php");   
   require_once ($siteweb->get_document_root()."/includes/pear/Structures/DataGrid.php");
   	  
   ini_set('include_path', $siteweb->get_document_root().'\includes\pear');	//charger les packages de PEAR::MDB2	
	  
   $lprofil = new profil();
   $lprofil->codeprofil = $lprofil->generer_numero();
   $incr_code_profil=$lprofil->codeprofil;
   $codeprofil = $incr_code_profil;
   
   global $lprofil;
      
?>