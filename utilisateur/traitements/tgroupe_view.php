	<?php
/**
 * @version			1.0
 * @package			Utilisateur
 * @subpackage		Groupe
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			patrick mveng <patrick.mveng@interfacesa.local>
 * @desc			Script de prétraitement pour la fiche d'un groupe d'utilisateurs
 * 
 * @creationdate	26 juin 2009
 * @updates
 * 	# vendredi le 24 juillet 2009 by patrick mveng<patrick.mveng@interfacesa.local>
 * 		- fabrication de la grille de permission du groupe en cours
 */
	
	   $data = $_POST;
		foreach ($_GET as $lkey => $lvalue)
		{
		$data[$lkey] = $lvalue;
		}

		$codegroup = $data["codegroup"];
		$libgroup = $data["libgroup"];
		$sel_option_libgroup = $data["sel_option_libgroup"];
		
				  //Chargements	
				  require_once($siteweb->get_document_root().DS."classe".DS."application.class.php");
				  require_once($siteweb->get_document_root().DS."utilisateur".DS."classe".DS."groupe.class.php");
				  require_once($siteweb->get_document_root().DS."includes".DS."pear".DS."Structures".DS."DataGrid".DS."Renderer".DS."HTMLTable.php");   
				  require_once ($siteweb->get_document_root().DS."includes".DS."pear".DS."Structures".DS."DataGrid.php");
				  
				  ini_set('include_path', $siteweb->get_document_root().'\includes\pear');	//charger les packages de PEAR::MDB2	
				  
				  $lgroupe = new groupe ();
				  
					foreach ( $data as $lindex => $lvaleur )
					{
					$lgroupe->$lindex = $lvaleur;
					}
					 
				  $lgroupe->charger();
				  
	  			//obtenir la liste des utilisateurs du groupe  en cours
				require_once($siteweb->get_document_root().DS."utilisateur".DS."classe".DS."utilisateur.class.php");				  
				$luser = new utilisateur();
				$luser->codegroup = $lgroupe->codegroup;
				$listeuser = $luser->rechercher();
				if ($luser->has_exception()) die($luser->exception);
				require_once($siteweb->get_document_root().DS."utilisateur".DS."traitements".DS."tuser_result_search.php");				
				
	  			//obtenir la liste des permissions du groupe  en cours
				require_once($siteweb->get_document_root().DS."administration".DS."classe".DS."droa.class.php");				  
				$lpermission = new droit();
				$luser->codegroup = $lpermission->codegroup;
				$listedroit = $lpermission->rechercher();
				if ($lpermission->has_exception()) die($lpermission->exception);
				//charger les traductions pour le module de gestion des permissions
				require_once($siteweb->get_document_root().DS."administration".DS."lang".DS."admin.{$lang}.php");				
				//fabriquer la grille de permission
				require_once($siteweb->get_document_root().DS."administration".DS."traitements".DS."tdroit_result_search.php");				
				//libérer la mémoire
				unset($lpermission);
								  	
				global $lgroupe;
				 
     ?> 