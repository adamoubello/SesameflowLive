<?php
/**
 * @version			1.0
 * @package			Utilisateur
 * @subpackage		Département
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello Adamou <moustaphbi@yahoo.fr> 
 * @desc			script de prétraitements pour la fiche de création d'une département 					
 * @creationdate	15 Juillet 2009
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
   
      require_once($siteweb->get_document_root()."\utilisateur\classe\departement.class.php");
	  require_once($siteweb->get_document_root()."/includes/pear/Structures/DataGrid/Renderer/HTMLTable.php");   
	  require_once ($siteweb->get_document_root()."/includes/pear/Structures/DataGrid.php");
	  //require_once ("HTML/Table.php");
	  
	  ini_set('include_path', $siteweb->get_document_root().'\includes\pear');	//charger les packages de PEAR::MDB2	
	  
   $dep = new departement();
   $dep->codedep = $dep->generer_numero();
   $incr_code_dep=$dep->codedep;
   $codedep = $incr_code_dep;
  
   global $dep;
   	   
?>