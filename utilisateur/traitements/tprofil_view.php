<?php
/**
 * @version			1.0
 * @package			Utilisateur
 * @subpackage		Profil
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello Adamou <moustaphbi@yahoo.fr> 
 * @desc			script pour l'affichage de la page de consultation d'un profil
 * @creationdate	20 Juillet 2009
 */
	
	        $data = $_POST;
			foreach ($_GET as $lkey => $lvalue)
			{
			$data[$lkey] = $lvalue;
			}

			$codeprofil = $data["codeprofil"];
			$libprofil = $data["libprofil"];
			$sel_option_libprofil = $data["sel_option_libprofil"];
					
		  //Chargements	
		  require_once($siteweb->get_document_root()."\classe\application.class.php");
		  require_once($siteweb->get_document_root()."\utilisateur\classe\profi.class.php");
		  require_once($siteweb->get_document_root()."/includes/pear/Structures/DataGrid/Renderer/HTMLTable.php");   
		  require_once ($siteweb->get_document_root()."/includes/pear/Structures/DataGrid.php");
		  		  
		  ini_set('include_path', $siteweb->get_document_root().'\includes\pear');	//charger les packages de PEAR::MDB2	
		  
		  $lprofil = new profil ();
		  
			foreach ($data as $lindex => $lvaleur )
			{
			$lprofil->$lindex = $lvaleur;
			}
			 
		  if (! $lprofil->charger()) die($lprofil->exception);	
		  $lprofil->codeprofil = $codeprofil;
		  
  			//obtenir la liste des utilisateurs du profil  en cours
			require_once($siteweb->get_document_root().DS."utilisateur".DS."classe".DS."utilisateur.class.php");				  
			$luser = new utilisateur();
			$luser->codeprofil = $lprofil->codeprofil;
			$luser->connected = null;
			$listeuser = $luser->rechercher();
			if ($luser->has_exception()) die($luser->exception);
			require_once($siteweb->get_document_root().DS."utilisateur".DS."traitements".DS."tuser_result_search.php");				
			
		   global  $lprofil;
				  	  
     ?> 