<?php
/**
 * @version			1.0
 * @package			Workflow
 * @subpackage		Circuit
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello<@yahoo.fr> 
 * @desc			script de prétraitements pour l'affichage de l'étape de création d'un circuit
 * 					Si $codecircuit est déjà défini, on charge les autres infos
 * @creationdate	????
 * @rule	lors de la création d'un circuit, seuls les processus actifs sont affichés dans la liste déroulante
 */
   
   $data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
		$data[$lkey] = $lvalue;
	}
   
   //obtenir le séparateur de dossier pour la OS en cours
   if (! defined("DS")) define( 'DS', DIRECTORY_SEPARATOR );
   
	  
	   $codecircuit = $data["codecircuit"];
	   $libcircuit = $data["libcircuit"];
	   $numprocessus = $data["numprocessus"];
	   
	   $unite_duree_circuit = "jour(s)";
	  
	   $lang = $data["lang"];
	   if (trim($lang=="")) 
	   { $lang="fr";}
	   $chemin = dirname(__FILE__);
	   $chemin = str_replace("\workflow\\traitements","",$chemin);
	   require_once($chemin.'\classe\application.class.php');	
	   $siteweb = new Application();
	   
	   global $siteweb , $unite_duree_circuit;

         
	   //chargement des spécifications de la classe processus
	   require_once($siteweb->get_document_root().DS."workflow".DS."classe".DS."processus.class.php");
	  //chargement des spécifications de la classe circuit
	   require_once($siteweb->get_document_root().DS."workflow".DS."classe".DS."circuit.class.php");

	  require_once($siteweb->get_document_root().DS."utilisateur".DS."classe".DS."utilisateur.class.php");
	  require_once($siteweb->get_document_root().DS."workflow".DS."classe".DS."".DS."tache.class.php");
	  require_once($siteweb->get_document_root().DS."utilisateur".DS."classe".DS."profi.class.php");
      require_once($siteweb->get_document_root().DS."utilisateur".DS."classe".DS."departement.class.php");
         
   

	  require_once($siteweb->get_document_root()."/includes/pear/Structures/DataGrid/Renderer/HTMLTable.php");   
	  require_once ($siteweb->get_document_root()."/includes/pear/Structures/DataGrid.php");
	  //require_once ("HTML/Table.php");
	  
	  ini_set('include_path', $siteweb->get_document_root().'\includes\pear');	//charger les packages de PEAR::MDB2	
	  
   $cir = new circuit();
   
   //instancier un objet processus
   $lprocessus = new processus();
   //obtenir la liste des processus du système
   $lprocessus->etatprocessus  = 1;	//n'afficher que les processus activés
   $lprocessus->listeprocessus = $lprocessus->rechercher();
   $select_processus = $lprocessus->liste_deroulante(array("id" => "numprocessus" , "name" => "numprocessus") , $numprocessus , ucfirst($translate["choisissez"]));

   //libérer la mémoire
   unset($lprocessus);
   

      $dep = new departement();
      $dep->listedep = $dep->rechercher();
      $attributes=array("name"=>"sel_dep","id"=>"sel_dep"
      ,"onchange"=>"javascript: on_circuit_change_dep('".$siteweb->get_url()."/utilisateur/traitements/tuser_search.php"."' , 'form_create_circuit' , 'cir_create');");
      $select_departement = $dep->liste_deroulante($attributes , null , ucfirst($translate["choisissez"]));
	  //require_once($siteweb->get_document_root().DS."departement".DS."traitements".DS."tdepartement_search.php");
	  
   		//require_once($siteweb->get_document_root().'\utilisateur\\traitements\\tuser_search.php');
   		$luser = new Utilisateur();
      $attributes=array("name"=>"sel_acteur","id"=>"sel_acteur");
      //sélectionner le utilisateur du premier département
      
  		$luser->listeuser = $luser->rechercher();
  		
      	if (is_array($luser->listeuser))
  			$larr_nimporte_qui = array_keys($luser->listeuser);
  		else $luser->listeuser = array();
  		
	  	$larr_nimporte_qui["codeuser"] = -2;
	  	$larr_nimporte_qui["nomuser"] = strtoupper($translate["tout_acteur"]);
	  	array_push($luser->listeuser , $larr_nimporte_qui);
	  	$luser->listeuser  = array_reverse($luser->listeuser);
	  			
      $select_user = $luser->liste_deroulante($attributes , null , ucfirst($translate["choisissez"]));
	  //require_once($siteweb->get_document_root().DS."departement".DS."traitements".DS."tdepartement_search.php");
	  
		$lprofil = new profil();
 		$lprofil->listeprofil = $lprofil->rechercher();
      $attributes=array("name"=>"sel_profil","id"=>"sel_profil");
      
      if (is_array($lprofil->listeprofil))
      		$larr_toute_fonction = array_keys($lprofil->listeprofil);
      else $lprofil->listeprofil = array();
      
 		$larr_toute_fonction["codeprofil"] = -2;
  		$larr_toute_fonction["libprofil"] = strtoupper($translate["toute_fonction"]);
  		array_push($lprofil->listeprofil , $larr_toute_fonction);
  		$lprofil->listeprofil  = array_reverse($lprofil->listeprofil);
      
      $select_profil = $lprofil->liste_deroulante($attributes , null , ucfirst($translate["choisissez"]));

      
 		$ltache = new tache();
      $attributes=array("name"=>"sel_tache","id"=>"sel_tache");
      $ltache->numprocessus = $cir->get_numero_processus();
  		$ltache->listetache = $ltache->rechercher();
  		
      $select_tache = $ltache->liste_deroulante($attributes , null , ucfirst($translate["aucune_tache"]));
     
      //liste déroulante pour la colonne tâche précédente
      $select_tache_prec = str_replace("sel_tache" , "sel_tache_prec" , $select_tache);
         
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
				$unite_duree = $siteweb->a_tag($unite_duree , $siteweb->get_url()."/gabarit/page.gabarit.php" , null , array("do" => "config_view" , "lang" => $lang , "login" =>  $login ) , ucfirst($translate["info_bulle_config_unite_duree"]));
			} 
		   
   
	global $cir , $select_processus , $lconfig;
   
?>