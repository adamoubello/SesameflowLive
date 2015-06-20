<?php

/**
 * @version			1.0
 * @package			Workflow
 * @subpackage		Tache
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			bello
 * @desc			Script de prétraitements pour la fiche de recherche de tâches
 * @param  			do - code de la page web à afficher dans la partie centrale du gabarit
 * 
 * @param 			string - lang - langue de l'utilisateur
 * @param 			string - login - login de l'utilisateur
 * 					paramètre de sortie
 * @creationdate	???
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


		$libcircuit = $data["libcircuit"];
		$dureecircuit = $data["dureecircuit"];
		$sel_option_libcircuit = $data["sel_option_libcircuit"];
		$sel_option_dureecircuit = $data["sel_option_dureecircuit"];
		

	  //Chargements	
	  require_once($siteweb->get_document_root()."\classe\application.class.php");
	  require_once($siteweb->get_document_root()."\workflow\classe\\circuit.class.php");
	  require_once($siteweb->get_document_root()."/includes/pear/Structures/DataGrid/Renderer/HTMLTable.php");   
	  require_once ($siteweb->get_document_root()."/includes/pear/Structures/DataGrid.php");
	  //require_once ("HTML/Table.php");
	  
	  ini_set('include_path', $siteweb->get_document_root().'\includes\pear');	//charger les packages de PEAR::MDB2	
	  
	  $lcircuit = new circuit ();
	  
		foreach ($data as $lindex => $lvaleur )
		{
			$lcircuit->$lindex = $lvaleur;
		}
		 
	  $listecircuit = $lcircuit->rechercher();	
	  
	   //chargement des spécifications de la classe processus
	   require_once($siteweb->get_document_root().DS."workflow".DS."classe".DS."processus.class.php");
	   
	   //instancier un objet processus
	   $lprocessus = new processus();
	   //obtenir la liste des processus du système
	   $lprocessus->etatprocessus  = 1;	//n'afficher que les processus activés
	   $lprocessus->listeprocessus = $lprocessus->rechercher();
	   $select_processus = $lprocessus->liste_deroulante(array("id" => "numprocessus" , "name" => "numprocessus") , null , ucfirst($translate["choisissez"]));
	
	   
	   //libérer la mémoire
	   unset($lprocessus);
   
	  global $listecircuit , $select_processus;
	  echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url()."/workflow/js/circuit.js"."\"></script>\n";
	  				
?> 
				 
					 