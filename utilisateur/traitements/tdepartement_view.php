<?php
/**
 * @version			1.0
 * @package			Utilisateur
 * @subpackage		Département
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello Adamou<moustaphbi@yahoo.fr> 
 * @desc			script pour l'affichage de la page de consultation d'un département
 * @creationdate	15 Juillet 2009
 */
	
	        $data = $_POST;
			foreach ($_GET as $lkey => $lvalue)
			{
			$data[$lkey] = $lvalue;
			}

		$codedep = $data["codedep"];
		$libdep = $data["libdep"];
				
		  //Chargements	
		  require_once($siteweb->get_document_root()."\classe\application.class.php");
		  require_once($siteweb->get_document_root()."\utilisateur\classe\departement.class.php");
		  require_once($siteweb->get_document_root()."/includes/pear/Structures/DataGrid/Renderer/HTMLTable.php");   
		  require_once ($siteweb->get_document_root()."/includes/pear/Structures/DataGrid.php");
		  //require_once ("HTML/Table.php");
		  
		  ini_set('include_path', $siteweb->get_document_root().'\includes\pear');	//charger les packages de PEAR::MDB2	
		  
		  $dep = new departement ();
		  
			foreach ($data as $lindex => $lvaleur )
			{
			$dep->$lindex = $lvaleur;
			}
			 
		  if (!$dep->charger()) die($dep->exception);	
		  $dep->codedep = $codedep;
		  
			//obtenir la liste des utilisateurs du département  en cours
			require_once($siteweb->get_document_root().DS."utilisateur".DS."classe".DS."utilisateur.class.php");				  
			$luser = new utilisateur();
			$luser->codedep = $dep->codedep;
			$luser->connected = null;
			$listeuser = $luser->rechercher();
			if ($luser->has_exception()) die($luser->exception);
			require_once($siteweb->get_document_root().DS."utilisateur".DS."traitements".DS."tuser_result_search.php");				
		  
				  
		  global  $dep;
				  	  
     ?> 