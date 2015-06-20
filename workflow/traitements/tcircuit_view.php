<?php
/**
 * @version			1.0
 * @package			Workflow
 * @subpackage		Circuit
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello<@yahoo.fr> 
 * @desc			script pour l'affichage de la page de consultation d'une tâche
 * @creationdate	????
 */
	
	       $data = $_POST;
			foreach ($_GET as $lkey => $lvalue)
			{
				$data[$lkey] = $lvalue;
			}


		$codecircuit = $data["codecircuit"];
		$libcircuit = $data["libcircuit"];
		$dureecircuit = $data["dureecircuit"];
		$numprocessus = $data["numprocessus"];
						
		$sel_option_libcircuit = $data["sel_option_libcircuit"];
				
		  //Chargements	
		  require_once($siteweb->get_document_root().DS."classe".DS."application.class.php");
		  require_once($siteweb->get_document_root().DS."workflow".DS."classe".DS."circuit.class.php");
		  ini_set('include_path', $siteweb->get_document_root().DS."includes".DS."pear");	//charger les packages de PEAR::MDB2	
		  require_once($siteweb->get_document_root().DS."includes".DS."pear".DS."Structures".DS."DataGrid".DS."Renderer".DS."HTMLTable.php");   
		  require_once ($siteweb->get_document_root().DS."includes".DS."pear".DS."Structures".DS."DataGrid.php");
		  //require_once ("HTML/Table.php");
		  
		  $lcircuit = new circuit ();
		  
			foreach ($data as $lindex => $lvaleur )
			{
				$lcircuit->$lindex = $lvaleur;
			}
			 
		  //$lcircuit->charger_processus();
		  if (! $lcircuit->charger()) die($lcircuit->exception);	
			
		   //chargement des spécifications de la classe processus
		   require_once($siteweb->get_document_root().DS."workflow".DS."classe".DS."processus.class.php");
		   //instancier un objet processus
		   $lprocessus = new processus();
		   //obtenir la liste des processus du système
		   $lprocessus->etatprocessus  = 1;	//n'afficher que les processus activés
		   $lprocessus->listeprocessus = $lprocessus->rechercher();
		   $select_processus = $lprocessus->liste_deroulante(array("id" => "numprocessus" , "name" => "numprocessus") 
		   , $lcircuit->numprocessus , ucfirst($translate["choisissez"]));
		   
		   //chargement des spécifications de la classe tache
		   require_once($siteweb->get_document_root().DS."workflow".DS."classe".DS."tache.class.php");
		   //instancier un objet tache
		   $ltache = new tache();
		   //obtenir la liste des tache du circuit en cours
		   $ltache->codecircuit = $lcircuit->codecircuit;
		   $listetache = $ltache->rechercher();
		   
		   /*
		   //ordonner les tâches par ordre chronologique
		   //rechercher d'abord la tâche initiale
		   $lfound = false;
		   $i = 0;
		   $lnbr_tache_initiale = 0;
		   while ((! $lfound)) 
		   {
		   			$lnumtacheprec = $listetache[$i]["numtacheprec"];
		   			//on a trouvé la tache initiale si on est tombé sur une tâche où la tache précédente est nulle
		   			$lfound = (trim($lnumtacheprec) == "");
		   			
		   			if (! $lfound) $i++;
		   			else 
		   			{
		   				$lnbr_tache_initiale++;
		   			}
		   }*/
		   
		   $ltache2 = new tache();
		   //obtenir la liste des tache du processus en cours
		   $ltache->numprocessus = $lcircuit->numprocessus;
		   $ltache2->listetache = $ltache2->rechercher();
		   if ($ltache2->has_exception()) die($ltache2->get_exception());
		   
	         $attributes=array("name"=>"sel_tache","id"=>"sel_tache");
		    $select_tache = $ltache2->liste_deroulante($attributes , null , ucfirst($translate["aucune_tache"]));
     
     		 //liste déroulante pour la colonne tâche précédente
      		$select_tache_prec = str_replace("sel_tache" , "sel_tache_prec" , $select_tache);

      		//libérer la mémoire
      		unset($listetache2);
      		unset($ltache2);
		   
		   //afficher la liste des départements
		   require_once($siteweb->get_document_root().DS."utilisateur".DS."classe".DS."departement.class.php");
         $dep = new departement();
	      $dep->listedep = $dep->rechercher();
	      if ($dep->has_exception()) die($dep->get_exception());
	      $attributes=array("name"=>"sel_dep","id"=>"sel_dep"
	      ,"onchange"=>"javascript: on_circuit_change_dep('".$siteweb->get_url()."/utilisateur/traitements/tuser_search.php"."' , 'form_circuit_view' , 'circuit_view');");
	      $select_departement = $dep->liste_deroulante($attributes , null , ucfirst($translate["choisissez"]));
	      
	   		$luser = new Utilisateur();
	      $attributes=array("name"=>"sel_acteur","id"=>"sel_acteur");
	      //sélectionner le utilisateur du premier département
	      
	  		$luser->listeuser = $luser->rechercher();
	  		$larr_nimporte_qui = array_keys($luser->listeuser);
	  		$larr_nimporte_qui["codeuser"] = -2;
	  		$larr_nimporte_qui["nomuser"] = strtoupper($translate["tout_acteur"]);
	  		
	  		array_push($luser->listeuser , $larr_nimporte_qui);
	  		$luser->listeuser  = array_reverse($luser->listeuser);
	  		 
	  		//print_r($luser->listeuser); die();
	      $select_user = $luser->liste_deroulante($attributes , null , ucfirst($translate["choisissez"]));
		  
		  require_once($siteweb->get_document_root().DS."utilisateur".DS."classe".DS."profi.class.php");
			$lprofil = new profil();
	 		$lprofil->listeprofil = $lprofil->rechercher();

	 		if (is_array($lprofil->listeprofil))
      			$larr_toute_fonction = array_keys($lprofil->listeprofil);
      		else $lprofil->listeprofil = array();
	  		$larr_toute_fonction["codeprofil"] = -2;
	  		$larr_toute_fonction["libprofil"] = strtoupper($translate["toute_fonction"]);
	  		
	  		array_push($lprofil->listeprofil , $larr_toute_fonction);
	  		$lprofil->listeprofil  = array_reverse($lprofil->listeprofil);

	 		
	 		
	      $attributes=array("name"=>"sel_profil","id"=>"sel_profil");
	      $select_profil = $lprofil->liste_deroulante($attributes , null , ucfirst($translate["choisissez"]));
		   
		  global  $select_departement , $select_profil , $select_user; 
	      
		   //fabrication de la grille
		   require_once($siteweb->get_document_root().DS."workflow".DS."traitements".DS."ttache_result_search.php");		   
		   
		   //charger l'unité de durée des circuits
		   //chargement des spécifications de la classe processus
		   require_once($siteweb->get_document_root().DS."administration".DS."classe".DS."config.class.php");
		   //instancier un objet configuration
		   $lconfig = new Config();
		   //charger la configuration unite_durée
		   $unite_duree =  $lconfig->charger();
		   switch (intval($lconfig->uniteduree_circuit))
		   {
		   		case 1 :
		   			$unite_duree = $translate["heure"]."(s)";
		   			break;
		   		case 2 :
		   			$unite_duree = $translate["jour"]."(s)";
		   			break;
		   		case 3 :
		   			$unite_duree = $translate["mois"]."(s)";
		   			break;
				default:
					$unite_duree = $translate["jour"]."(s)";
					break;
		   }
		   
		   //l'utilisateur en cours peut avoir envie , à partiri d'ici, de modifier l'unité de durée d'un circuit
			   //lui offrir un accès direct à  la page de configuration
			   //seuls les membres du groupe "superadmin" peuvent accéder à la page de configuration
				
		   if (intval($_SESSION["is_superadmin"]) == 1)
				{
					$unite_duree = $siteweb->a_tag($unite_duree , $siteweb->get_url()."/gabarit/page.gabarit.php" , null , array("do" => "config_view" , "lang" => $lang , "login" =>  $login , "codecircuit" => $codecircuit ) , ucfirst($translate["info_bulle_config_unite_duree"]));
				} 
		   
		   //libérer la mémoire
		   unset($lprocessus);
		   unset($lconfig);
		   
		   global  $lcircuit;
		   
     ?> 