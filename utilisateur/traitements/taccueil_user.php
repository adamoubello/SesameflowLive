<?php

/**
 * @version			1.0
 * @package			Utilisateur
 * @subpackage		Accueil utilisateur
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello Adamou <moustaphbi@yahoo.fr>
 * @desc			Script de prétraitements pour l'affichage des tâches en cours pour l'utilisateur
 * @param  			do - code de la page web à afficher dans la partie centrale du gabarit
 * @param 			string - lang - langue de l'utilisateur
 * @param 			string - login - login de l'utilisateur
 *               	paramètre de sortie
 * @creationdate	31 Juillet 2009
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
	
		$libaccueil_user = $data["libaccueil_user"];
		$dureeaccueil_user = $data["dureeaccueil_user"];
		$sel_option_libaccueil_user = $data["sel_option_libaccueil_user"];
		$sel_option_dureeaccueil_user = $data["sel_option_dureeaccueil_user"];
		
	  //Chargements	
	  require_once($siteweb->get_document_root().DS."classe".DS."application.class.php");
	  require_once($siteweb->get_document_root().DS."utilisateur".DS."classe".DS."utilisateur.class.php");
	  ini_set('include_path', $siteweb->get_document_root().DS.'includes'.DS.'pear');	//charger les packages de PEAR::MDB2	
	  require_once($siteweb->get_document_root().DS."includes".DS."pear".DS."Structures".DS."DataGrid".DS."Renderer".DS."HTMLTable.php");   
	  require_once ($siteweb->get_document_root().DS."includes".DS."pear".DS."Structures".DS."DataGrid.php");
	  
	    $luser = new utilisateur ();
	  
		foreach ($data as $lindex => $lvaleur )
		{
		$luser->$lindex = $lvaleur;
		}
	  
		$listeaccueil_user = $luser->rechercher_tache_user();
		if ($luser->has_exception()) die($luser->exception);	
	  
	   //chargement des spécifications de la classe processus
	   require_once($siteweb->get_document_root().DS."workflow".DS."classe".DS."processus.class.php");
	   
	   //instancier un objet processus
	   $lprocessus = new processus();
	   //obtenir la liste des processus du système
	   $lprocessus->etatprocessus  = 1;	//n'afficher que les processus activés
	   $lprocessus->listeprocessus = $lprocessus->rechercher();
	   if ($lprocessus->has_exception())  die($lprocessus->exception);
	   	   
	   echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url()."/utilisateur/js/utilisateur.js"."\"></script>\n";
	  
	   //fabriquer la grille de taches
	   require_once($siteweb->get_document_root().DS."utilisateur".DS."traitements".DS."taccueil_result_search.php");	  	  
	   global $listeaccueil_user;
		
	 ?> 
							 