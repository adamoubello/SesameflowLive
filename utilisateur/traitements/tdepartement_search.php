<?php
/**
 * @version			1.0
 * @package			Utilisateur
 * @subpackage		Département
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello Adamou <moustaphbi@yahoo.fr>
 * @desc			Script de prétraitements pour la fiche de recherche de département
 * @param  			do - code de la page web à afficher dans la partie centrale du gabarit
 * @param 			string - lang - langue de l'utilisateur
 * @param 			string - login - login de l'utilisateur
 * 					paramètre de sortie
 * @creationdate	15 Juillet 2009
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

		$libdep = $data["libdep"];
		$sel_option_libdep = $data["sel_option_libdep"];
		
	  //Chargements	
	  require_once($siteweb->get_document_root().DS."classe".DS."application.class.php");
	  require_once($siteweb->get_document_root().DS."utilisateur".DS."classe".DS."departement.class.php");
	  ini_set('include_path', $siteweb->get_document_root().DS.'includes'.DS.'pear');	//charger les packages de PEAR::MDB2	
	  
	  require_once($siteweb->get_document_root().DS."includes".DS."pear".DS."Structures".DS."DataGrid".DS."Renderer".DS."HTMLTable.php");   
	  require_once ($siteweb->get_document_root().DS."includes".DS."pear".DS."Structures".DS."DataGrid.php");
	  
	    $dep = new departement ();
	  
		foreach ($data as $lindex => $lvaleur )
		{
		$dep->$lindex = $lvaleur;
		}
	  
	  $listedep = $dep->rechercher();
	  if ($dep->has_exception()) 
	  die($dep->exception);	
		   
	  echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url()."/utilisateur/js/departement.js"."\"></script>\n";
	  
	  //fabriquer la grille de departements
		require_once($siteweb->get_document_root().DS."utilisateur".DS."traitements".DS."tdepartement_result_search.php");	  	  
		global $listedep;
	 ?> 
							 
								 