<?php
/*
 * @version			1.0
 * @package			Workflow
 * @subpackage		Workflow
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello Adamou <moustaphbi@yahoo.fr>
 * @desc			Script de prétraitements pour l'affichage des tâches en cours pour l'utilisateur
 * @param  			do - code de la page web à afficher dans la partie centrale du gabarit
 * @param 			string - lang - langue de l'utilisateur
 * @param 			string - login - login de l'utilisateur
 *               	paramètre de sortie
 * @creationdate	31 Juillet 2009
**/	
 
		$data = $_POST;
		foreach ($_GET as $lkey => $lvalue)
		{
		$data[$lkey] = $lvalue;
		}
   
	    if (! defined("DS"))  define("DS" , DIRECTORY_SEPARATOR);
		$login = (isset($data["login"])) ? (! is_null($data["login"])) ? $data["login"] : "" : "";
		$do = (isset($data["do"])) ? (! is_null($data["do"])) ? $data["do"] : "accueil" : "accueil";
		$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
		$dureetache = (isset($data["dureetache"])) ? (! is_null($data["dureetache"])) ? $data["dureetache"] : null : null ;
	    $typedoc = (isset($data["typedoc"])) ? (! is_null($data["typedoc"])) ? $data["typedoc"] : null : null ;
	    $numdoc = (isset($data["numdoc"])) ? (! is_null($data["numdoc"])) ? $data["numdoc"] : null : null ;
	    
	    $libworkflow = $data["libworkflow"];
	    $sel_option_libworkflow = $data["sel_option_libworkflow"];
	    $sel_option_dureeworkflow = $data["sel_option_dureeworkflow"];
	    $sel_option_datedebutworkflow = $data["dat_deb_creation"];
	    $sel_option_datefinworkflow = $data["dat_fin_creation"];
	    $sel_option_etat = $data["sel_option_etat[]"];
	    $dureeworkflow = $data["dureeworkflow"];
	    $dat_deb_creation = $data["dat_deb_creation"];
	    $dat_fin_creation = $data["dat_fin_creation"];	
	
        //Chargements	
	    require_once($siteweb->get_document_root().DS."classe".DS."application.class.php");
	    ini_set('include_path', $siteweb->get_document_root().DS.'includes'.DS.'pear');//charger les packages de PEAR::MDB2	
	    require_once($siteweb->get_document_root().DS."includes".DS."pear".DS."Structures".DS."DataGrid".DS."Renderer".DS."HTMLTable.php");   
	    require_once($siteweb->get_document_root().DS."includes".DS."pear".DS."Structures".DS."DataGrid.php");
	    require_once($siteweb->get_document_root().DS."utilisateur".DS."classe".DS."utilisateur.class.php");
	    require_once($siteweb->get_document_root().DS."workflow".DS."classe".DS."workflow.class.php");
	    require_once($siteweb->get_document_root().DS."ged".DS."classe".DS."document.class.php");
       
	    $listeusercourant=array(); 
	    $listemestaches=array();
	    $listemestaches_final=array();
	    $listenominitiateur=array();
	    $listemestachesnegatif_final=array();
	    $listemestaches_definitif=array();
	    $listemestachesnegatif=array();

	    $luser = new utilisateur ();
	    $luser->loginuser = $login;
	    $listeuser = $luser->rechercher();
	    if ($luser->has_exception())  die($luser->exception);	
	   	 
        $doc = new Document();
        //$doc->numdoc = $numdoc;print_r($numdoc);die("");
        $doc->codeusercours = $listeuser[0]["codeuser"];
        //if ( ! $doc->rechercher_usercourant())   echo($translate["any_workflow_found"]);
        $listeusercourant = $doc->rechercher_usercourant();
        //if (is_null($listeusercourant))  echo($translate["any_workflow_found"]);
       
        $lworkflow = new workflow ();	   
        for ($i=0;$i<count($listeusercourant);$i++)
	    {
		 $lworkflow->numdoc = $listeusercourant[$i]["numdoc"];
		 $listemestaches[$i] = $lworkflow->rechercher_mestaches();
		 $luser->codeuser = $listeusercourant[$i]["codeuser"];
		 $listemestaches_final = array_merge($listemestaches_final ,$listemestaches[$i]);
		 		 
		 //$listenominitiateur[$i] = $luser->rechercher_initiateur();
         //$listemestaches[$i] = array_merge($listemestaches[$i],$listenominitiateur[$i]);
		 //array_push($liste,$liste);
	    }
	    
	    $listeusernegatif=$doc->rechercher_usernegatif();
	    for ($i=0;$i<count($listeusernegatif);$i++)
	    {
		 $negatif = $listeusernegatif[$i]["codeusercours"];
		 $luser->codeprofil = abs($negatif);//print_r($luser->codeprofil);die("");
		    $listeuserprofil = $luser->rechercher_userduprofil();
		    for ($j=0;$j<count($listeuserprofil);$j++) 
		    {
		      	if ($listeuser[0]["codeuser"] == $listeuserprofil[$j]["codeuser"])
		      	{   
		      		$lworkflow->numdoc = $listeusernegatif[$i]["numdoc"];
		            $listemestachesnegatif[$i] = $lworkflow->rechercher_mestaches();
		      	 	$listemestachesnegatif_final = array_merge($listemestachesnegatif_final ,$listemestachesnegatif[$i]);
		      	}
		    }
		}
	    
	    //$listemestaches_final = array_merge($listemestaches_final ,$listemestachesnegatif_final);
		 
	    //print_r($listemestaches_final);die("");
	    unset($listemestaches);
	    $listemestaches = $listemestaches_final;
	    global $listemestaches;
	    //global $listenominitiateur;
	    require_once($siteweb->get_document_root().DS."workflow".DS."traitements".DS."tmestaches_result_search.php");		  
	   			    
	    //libérer la mémoire
	    unset($ldoc);
	    unset($lconfig);	   
   	    unset($listetache);
	    unset($listeuser);
	    unset($luser);
	    unset($ltache);
	  
	 ?> 
							 