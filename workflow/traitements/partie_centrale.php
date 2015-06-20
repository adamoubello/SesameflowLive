<?php
/**
 * @version			1.0
 * @package			Workflow
 * @subpackage		Circuit
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello Adamou <moustaphbi@yahoo.fr> 
 * @desc			Controlleur du module Workflow.Suivant la valeur du paramètre page, ce contrôlleur va aiguiller le système * * *vers la page web ou le traitement spécifique
 * @creationdate	????
 * @updates
 * 	# samedi 27 juin 2009 by patrick mveng<patrick.mveng@interfacesa.local>
 * 		- ajout du case processus_create_valid pour la création d'un processus dans la bd
 * 	# samedi 27 juin 2009 by patrick mveng<patrick.mveng@interfacesa.local>
 * 		- intégration du controle d'accès à une fonctionnalité
 */

	session_start();
	$login = $_SESSION["login"];
	$_GET["login"] = $login;

  	$data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
	$data[$lkey] = $lvalue;
	}
	
  	$libprocessus = $data["libprocessus"];  
 	$login = (isset($data["login"])) ? (! is_null($data["login"])) ? $data["login"] : "" : "";
	$do = (isset($data["do"])) ? (! is_null($data["do"])) ? $data["do"] : "accueil" : "accueil";
	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
	$numtache = (isset($data["numtache"])) ? (! is_null($data["numtache"])) ? $data["numtache"] : null : null ;
	$typedoc = (isset($data["typedoc"])) ? (! is_null($data["typedoc"])) ? $data["typedoc"] : null : null ;
    $numdoc = (isset($data["numdoc"])) ? (! is_null($data["numdoc"])) ? $data["numdoc"] : null : null ;
    $codecircuit = (isset($data["codecircuit"])) ? (! is_null($data["codecircuit"])) ? $data["codecircuit"] : null : null ;
     
    //obtenir le séparateur de dossier pour le OS en cours
    if (! defined("DS")) define( 'DS', DIRECTORY_SEPARATOR );
    $chemin = dirname(__FILE__);
	$chemin = str_replace(DS."workflow".DS."traitements","",$chemin);
	require_once($chemin.DS.'classe'.DS.'application.class.php');	
	$siteweb = new Application();
    
    //si on est dans un workflow, gestion des permissions suivant la définition du circuit
	if ( in_array(trim(strtolower($do)) , array("workflow_create_valid","workflow_update_valid")))
	{   
		//les tâches autorisés par le login en cours
		/*require_once($siteweb->get_document_root().DS.'workflow'.DS.'classe'.DS.'tache.class.php');
		$ltache = new tache();
		$ltache->loginuser = trim($plogin);
		$ltache->codecircuit = intval($pcodecircuit);
		$listetache = $ltache->rechercher();
		if ($ltache->has_exception()) die($ltache->get_exception());
		
		//recherche $pnumtache dans la liste des tâches
		$lfound = false;
		$i = 0;
		while ( (! $lfound) && ($i < count($listetache)) )
		{
			$lfound = ( intval($pnumtache) == intval($listetache["numtache"]) );
		}
    	$lhas_right = $lfound;
		if (! $lhas_right) echo $siteweb->redirection($siteweb->get_url()."/gabarit/page.gabarit.php",
			array( "lang" => $lang ,  "do" => "accueil_user" , "login" => $login , $state = "no_right") , true);
		die();
		unset($ltache);
		unset($listetache);
		unset($lfound);*/
	}
	//côntrole des permissions de l'utilisateur en cours
	//si pas de côntrole, il y aura redirection vers la page précédente.
	else {
		$siteweb->control_permission($login , $lang , $do , $ajax , $state);
	}

  switch (trim($do))
  {
    case "processus_search":
	    require_once($siteweb->get_document_root()."\workflow".DS."traitements".DS."tprocessus_search.php");	
	    require_once($siteweb->get_document_root()."\workflow\page\processus_search.php");
	    break;
	    
    case "processus_create" :
	    require_once($siteweb->get_document_root()."\workflow\page\processus_create.php");
	    require_once($siteweb->get_document_root()."\workflow".DS."traitements".DS."tprocessus_create.php");
	    break;
	    
    case "processus_create_valid" :
	    require_once($siteweb->get_document_root().DS."workflow".DS."traitements".DS."tprocessus_create_valid.php");
	    //require_once($siteweb->get_document_root().DS."gabarit".DS."page.gabarit.php");
	    //redirection vers la fiche de recherche des processus
	    echo $siteweb->redirection($siteweb->get_url()."/gabarit/page.gabarit.php",
	    array( "lang" => $lang ,  "do" => "processus_search" , "login" => $login) , true);
	    die();
	    /*@ob_end_clean();
	      @ini_set('zlib.output_compression', '0');
	      header ("location :".$lurl.$lparam_url);*/
	    break;
	    
	case "processus_update_valid" : 
		require_once($siteweb->get_document_root().DS."workflow".DS."traitements".DS."tprocessus_update_valid.php");
		//redirection vers la fiche de consultation des processus
		echo $siteweb->redirection($siteweb->get_url()."/gabarit/page.gabarit.php",
		array( "lang" => $lang ,  "do" => "processus_view" , "login" => $login) , true);
		die();
		break; 
		 	  
    case "processus_delete_valid" :
		require_once($siteweb->get_document_root().DS."workflow".DS."traitements".DS."tprocessus_delete_valid.php");
		//redirection vers la fiche de recherche des processus
		echo $siteweb->redirection($siteweb->get_url()."/gabarit/page.gabarit.php",
		array( "lang" => $lang ,  "do" => "processus_search" , "login" => $login , "state" => $state) , true);
		die();
		
	case "processus_admin_view" :
	    require_once($siteweb->get_document_root()."\workflow\page\processus_admin_view.php");
	    break;  
	    
	case "processus_view_user" :
	    require_once($siteweb->get_document_root()."\workflow\page\processus_view_user.php");
	    break; 
	     
	case "processus_view":
	    require_once($siteweb->get_document_root()."\workflow".DS."traitements".DS."tprocessus_view.php");	
	    require_once($siteweb->get_document_root()."\workflow\page\processus_view.php");
	    break;
	    
	case "processus_update":
	    require_once($siteweb->get_document_root()."\workflow".DS."traitements".DS."tprocessus_update.php");	
	    require_once($siteweb->get_document_root()."\workflow\page\processus_update.php");
	    break;	
	    
	case "tache_search":
		require_once($siteweb->get_document_root()."\workflow".DS."traitements".DS."ttache_search.php");	
		require_once($siteweb->get_document_root()."\workflow\page".DS."tache_search.php");
	    break;
	  
	case "tache_export":
	case "circuit_export":
	case "processus_export":
		require_once($siteweb->get_document_root().DS."workflow".DS."traitements".DS."texport_valid.php");	
	    break;
	    
    case "tache_create" :
    	require_once($siteweb->get_document_root().DS."workflow".DS."traitements".DS."ttache_create.php");
	    require_once($siteweb->get_document_root()."\workflow\page".DS."tache_create.php");
	    break;
	    
    case "tache_create_valid" : 
		require_once($siteweb->get_document_root().DS."workflow".DS."traitements".DS."ttache_create_valid.php");
		echo $siteweb->redirection($siteweb->get_url()."/gabarit/page.gabarit.php",
		array( "lang" => $lang ,  "do" => "tache_search" , "login" => $login) , true);
		die();
	    break;	
	    
    case "tache_delete_valid" :
		require_once($siteweb->get_document_root().DS."workflow".DS."traitements".DS."ttache_delete_valid.php");
		//redirection vers la fiche de recherche des tâches
		echo $siteweb->redirection($siteweb->get_url()."/gabarit/page.gabarit.php",
		array( "lang" => $lang ,  "do" => "tache_search" , "login" => $login , "state" => $state) , true);
		die();
		break;
			    
	case "tache_admin_view" :
	    require_once($siteweb->get_document_root()."\workflow\page".DS."tache_admin_view.php");
	    break;  
	    
	case "tache_view_user" :
	    require_once($siteweb->get_document_root()."\workflow\page".DS."tache_view_user.php");
	    break; 
	     
	case "tache_view":
	    require_once($siteweb->get_document_root()."\workflow".DS."traitements".DS."ttache_view.php");	
	    require_once($siteweb->get_document_root()."\workflow\page".DS."tache_view.php");
	    break;
	    
	case "tache_update":
	    require_once($siteweb->get_document_root()."\workflow".DS."traitements".DS."ttache_update.php");	
	    require_once($siteweb->get_document_root()."\workflow\page".DS."tache_update.php");
	    break;
	    
	case "tache_update_valid" :
		require_once($siteweb->get_document_root().DS."workflow".DS."traitements".DS."ttache_update_valid.php");
		//redirection vers la fiche de consultation des processus
		echo $siteweb->redirection($siteweb->get_url()."/gabarit/page.gabarit.php",
		array( "lang" => $lang ,  "do" => "tache_view" , "login" => $login) , true);
		die();
		break;
	  	  		
	case "workflow_search":
	    require_once($siteweb->get_document_root()."\workflow".DS."traitements".DS."tworkflow_search.php");	
	    require_once($siteweb->get_document_root()."\workflow\page\workflow_search.php");
	    break;
        /*case "workflow_create" :
	    require_once($siteweb->get_document_root()."\workflow\page\workflow_create.php");
	    require_once($siteweb->get_document_root()."\workflow".DS."traitements".DS."tworkflow_create.php");
	    break;*/
	    
	case "workflow_admin_view" :
	    require_once($siteweb->get_document_root()."\workflow\page\workflow_admin_view.php");
	    break;  
	    
	case "workflow_view_user" :
	    require_once($siteweb->get_document_root()."\workflow\page\workflow_view_user.php");
	    break; 
	     
	case "workflow_view":
	    require_once($siteweb->get_document_root()."\workflow".DS."traitements".DS."tworkflow_view.php");	
	    require_once($siteweb->get_document_root()."\workflow\page\workflow_view.php");
	    break;
	    
	case "workflow_update":
		require_once($siteweb->get_document_root().DS."workflow".DS."traitements".DS."tworkflow_update.php");	
		require_once($siteweb->get_document_root().DS."ged".DS."lang".DS."ged.{$lang}.php");	
		switch (trim($typedoc))
		{
			case "numeric" :
				require_once($siteweb->get_document_root().DS."ged".DS."page".DS."numerique_view.php");
				break;
			default :
			    require_once($siteweb->get_document_root().DS."ged".DS."page".DS."formulaire_view.php");
				break;	
		}
	  break;		  	
	  
    case "circuit_search":
		  require_once($siteweb->get_document_root().DS."workflow".DS."traitements".DS."tcircuit_search.php");	
		  require_once($siteweb->get_document_root().DS."workflow".DS."traitements".DS."tcircuit_result_search.php");	
		  require_once($siteweb->get_document_root().DS."workflow".DS."page".DS."circuit_search.php");
	      break;
	      
    case "cir_create1" :
    case "circuit_create" :
    	require_once($siteweb->get_document_root().DS."workflow".DS."traitements".DS."tcircuit_create1.php");
		require_once($siteweb->get_document_root().DS."workflow".DS."page".DS."circuit_create1.php");
	    break;
	    
	case "cir_create2" :
		require_once($siteweb->get_document_root().DS."workflow".DS."traitements".DS."tcircuit_create2.php");
		require_once($siteweb->get_document_root().DS."workflow\page".DS."circuit_create2.php");
	    break;
	
	case "circuit_view":
	    require_once($siteweb->get_document_root().DS."workflow".DS."traitements".DS."tcircuit_view.php");	
	    require_once($siteweb->get_document_root().DS."workflow".DS."page".DS."circuit_view.php");
	    break;
	    
    case "circuit_delete_valid" :
		require_once($siteweb->get_document_root().DS."workflow".DS."traitements".DS."tcircuit_delete_valid.php");
		//redirection vers la fiche de recherche des circuit
		echo $siteweb->redirection($siteweb->get_url()."/gabarit/page.gabarit.php",
		array( "lang" => $lang ,  "do" => "circuit_search" , "login" => $login ,  "state" => $state) , true);
		die();
		
    case "circuit_archive_valid" :
		require_once($siteweb->get_document_root().DS."workflow".DS."traitements".DS."tcircuit_archive_valid.php");
		//redirection vers la fiche de recherche des circuit
		echo $siteweb->redirection($siteweb->get_url()."/gabarit/page.gabarit.php",
		array( "lang" => $lang ,  "do" => "circuit_search" , "login" => $login) , true);
		die();
		
	case "circuit_update_valid" :
		require_once($siteweb->get_document_root().DS."workflow".DS."traitements".DS."tcircuit_update_valid.php");
		//redirection vers la fiche de consultation des processus
		echo $siteweb->redirection($siteweb->get_url()."/gabarit/page.gabarit.php",
		array( "lang" => $lang ,  "do" => "circuit_view" , "login" => $login , "state" => $state , "codecircuit" => $codecircuit) , true);
		die();
		break;
		  	  
	case "circuit_create_valid" :
		require_once($siteweb->get_document_root().DS."workflow".DS."traitements".DS."tcircuit_create_valid.php");
		//redirection vers la fiche de recherche des circuits
		echo $siteweb->redirection($siteweb->get_url()."/gabarit/page.gabarit.php",
		array( "lang" => $lang ,  "do" => "circuit_search" , "login" => $login , "state" => $state ) , true);
		die();
		break;  	  
	
	case "circuit_create2_valid" :
		require_once($siteweb->get_document_root().DS."workflow".DS."traitements".DS."tcircuit_create1_valid.php");
		//redirection vers la fiche de consultation des processus
		echo $siteweb->redirection($siteweb->get_url()."/gabarit/page.gabarit.php",
		array( "lang" => $lang ,  "do" => "circuit_view" , "login" => $login) , true);
		die();
		break;  

	case "workflow_create" :
		//require_once($siteweb->get_document_root().DS."workflow".DS."traitements".DS."tworkflow_create.php");
		//require_once($siteweb->get_document_root().DS."workflow".DS."page".DS."workflow_create.php");
		//charger la nouveau formulaire
		require_once($siteweb->get_document_root().DS."ged".DS."traitements".DS."tdoc_create.php");
        switch (trim($typedoc))
		{
			case "dde_credit" :
				require_once($siteweb->get_document_root().DS."ged".DS."page".DS."dde_credit.php");
				break;
			case "dde_achat" :
				require_once($siteweb->get_document_root().DS."ged".DS."page".DS."dde_achat.php");
				break;
			case "dde_conge" :
				require_once($siteweb->get_document_root().DS."ged".DS."page".DS."dde_conge.php");
				break;
		}
		break;	
		
	case "workflow_create_valid" :
		require_once($siteweb->get_document_root().DS."workflow".DS."traitements".DS."tworkflow_create_valid.php");
		echo $siteweb->redirection($siteweb->get_url()."/gabarit/page.gabarit.php",
		array( "lang" => $lang ,  "do" => "accueil_user" , "state" => $state) , true);
		break;	
			
	case "accueil_user":
		require_once($siteweb->get_document_root().DS."workflow".DS."traitements".DS."tworkflow_user.php");	
	    require_once($siteweb->get_document_root().DS."workflow".DS."page".DS."workflow_user.php");
	    break;
	  
	case "workflow_update_valid" :
		require_once($siteweb->get_document_root().DS."workflow".DS."traitements".DS."tworkflow_update_valid.php");
		echo $siteweb->redirection($siteweb->get_url()."/gabarit/page.gabarit.php",
		array( "lang" => $lang ,  "do" => "accueil_user" , "state" => $state) , true);
		break;		

	case "workflow_delete_valid" :
		require_once($siteweb->get_document_root().DS."workflow".DS."traitements".DS."tworkflow_delete_valid.php");
		//redirection vers la fiche de recherche des workflow
		echo $siteweb->redirection($siteweb->get_url()."/gabarit/page.gabarit.php",
		array( "lang" => $lang ,  "do" => "workflow_search" , "login" => $login, "state" => $state) , true);
		die();
		break;	
				
  }

?>