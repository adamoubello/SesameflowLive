<?php

/**
 * @version			1.0
 * @package			Utilisateur
 * @subpackage		Profil
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello Adamou <moustaphbi@yahoo.fr> 
 * @desc			script de traitements pour le résultat d'une recherche de profil  					
 * @desc			Script de prétraitements pour la fiche de recherche de profils
 * @param  			do - code de la page web à afficher dans la partie centrale du gabarit
 * @param 			string - lang - langue de l'utilisateur
 * @param 			string - login - login de l'utilisateur
 * 					paramètre de sortie
 * @creationdate	20 Juillet 2009
 */	
	
	$data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
	$data[$lkey] = $lvalue;
	}
   
	$login = (isset($data["login"])) ? (! is_null($data["login"])) ? $data["login"] : "" : "";
	$do = (isset($data["do"])) ? (! is_null($data["do"])) ? $data["do"] : "accueil" : "accueil";
	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
	
	if (! defined("DS"))  define("DS" , DIRECTORY_SEPARATOR);

		$libprofil = $data["libprofil"];
		$sel_option_libprofil = $data["sel_option_libprofil"];
		
	  //Chargements	
	  require_once($siteweb->get_document_root().DS."classe".DS."application.class.php");
	  require_once($siteweb->get_document_root().DS."utilisateur".DS."classe".DS."profi.class.php");
	  ini_set('include_path', $siteweb->get_document_root().DS.'includes'.DS.'pear');	//charger les packages de PEAR::MDB2	
	  require_once($siteweb->get_document_root().DS."includes".DS."pear".DS."Structures".DS."DataGrid".DS."Renderer".DS."HTMLTable.php");   
	  require_once ($siteweb->get_document_root().DS."includes".DS."pear".DS."Structures".DS."DataGrid.php");
	  
	    $lprofil = new profil ();
	  
		foreach ($data as $lindex => $lvaleur )
		{
		$lprofil->$lindex = $lvaleur;
		}
	  
	  $listeprofil = $lprofil->rechercher();
	  if ($lprofil->has_exception())  die($lprofil->exception);	
	  
	   
	   echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url()."/utilisateur/js/profil.js"."\"></script>\n";
	  
	  //fabriquer la grille de profils
		require_once($siteweb->get_document_root().DS."utilisateur".DS."traitements".DS."tprofil_result_search.php");	  	  
		global $listeprofil;
	 ?> 
							 
								 