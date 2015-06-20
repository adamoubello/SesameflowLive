<?php

/**
 * @version			1.0
 * @package			Workflow
 * @subpackage		Tache
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits r�serv�s
 * @license			INTERFACE SA
 * @author 			bello
 * @desc			Script de pr�traitements pour la fiche de recherche de t�ches
 * @param  			do - code de la page web � afficher dans la partie centrale du gabarit
 * 
 * @param 			string - lang - langue de l'utilisateur
 * @param 			string - login - login de l'utilisateur
 * 					param�tre de sortie
 * @creationdate	26 juin 2009
 * @updates
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

		$libtache = $data["libtache"];
		$dureetache = $data["dureetache"];
		$sel_option_libtache = $data["sel_option_libtache"];
		$sel_option_dureetache = $data["sel_option_dureetache"];
	
	  //Chargements	
	  require_once($siteweb->get_document_root().DS."classe".DS."application.class.php");
	  require_once($siteweb->get_document_root().DS."workflow".DS."classe".DS."tache.class.php");
	  ini_set('include_path', $siteweb->get_document_root().DS.'includes'.DS.'pear');	//charger les packages de PEAR::MDB2	
	  
	  require_once($siteweb->get_document_root().DS."includes".DS."pear".DS."Structures".DS."DataGrid".DS."Renderer".DS."HTMLTable.php");   
	  require_once ($siteweb->get_document_root().DS."includes".DS."pear".DS."Structures".DS."DataGrid.php");
	  
	    $tac = new tache ();
	  
		foreach ($data as $lindex => $lvaleur )
		{
		$tac->$lindex = $lvaleur;
		}
	  
	  $listetache = $tac->rechercher();
	  if ($tac->has_exception()) 
	  die($tac->exception);	
	  
	   //chargement des sp�cifications de la classe processus
	   require_once($siteweb->get_document_root().DS."workflow".DS."classe".DS."processus.class.php");
	   
	   //instancier un objet processus
	   $lprocessus = new processus();
	   //obtenir la liste des processus du syst�me
	   $lprocessus->etatprocessus  = 1;	//n'afficher que les processus activ�s
	   $lprocessus->listeprocessus = $lprocessus->rechercher();
	   if ($lprocessus->has_exception()) die($lprocessus->exception);
	   
	   $select_processus = $lprocessus->liste_deroulante(array("id" => "numprocessus" , "name" => "numprocessus") 
	   , null , ucfirst($translate["choisissez"]));
	   //lib�rer la m�moire
	   unset($lprocessus);
	   
	   echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url()."/workflow/js/tache.js"."\"></script>\n";
	   
	  //fabriquer la grille de taches
		require_once($siteweb->get_document_root().DS."workflow".DS."traitements".DS."ttache_result_search.php");	  	  
		global $listetache , $select_processus;
	 ?> 
							 
								 