<?php
/**
 * @version			1.0
 * @package			Workflow
 * @subpackage		Tache
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello<@yahoo.fr> 
 * @desc			script de prétraitements pour la fiche de création d'une âche
 * 					
 * @creationdate	????
 * @updates
 */
   
   $data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
		$data[$lkey] = $lvalue;
	}
   
   //obtenir le séparateur de dossier pour la OS en cours
   if (! defined("DS")) define( 'DS', DIRECTORY_SEPARATOR );
  
   $numprocessus = $data["numprocessus"];
   $libprocessus = $data["libprocessus"];
  
   $lang = $data["lang"];
   if (trim($lang=="")) 
   { $lang="fr";}
   $chemin = dirname(__FILE__);
    //die($chemin);
	$chemin = str_replace("\workflow\\traitements","",$chemin);
   //$passwd = $data["passwd"];
	require_once($chemin.'\classe\application.class.php');	
	
   $siteweb = new Application();
   
   global $siteweb;
   
      require_once($siteweb->get_document_root()."\workflow\classe\\tache.class.php");
	  require_once($siteweb->get_document_root()."/includes/pear/Structures/DataGrid/Renderer/HTMLTable.php");   
	  require_once ($siteweb->get_document_root()."/includes/pear/Structures/DataGrid.php");
	  //require_once ("HTML/Table.php");
	  
	  ini_set('include_path', $siteweb->get_document_root().'\includes\pear');	//charger les packages de PEAR::MDB2	
	  
   $tac = new tache();
   $tac->numtache = $tac->generer_numero();
   $incr_code_tache=$tac->numtache;
   $numtache = $incr_code_tache;
   
   //chargement des spécifications de la classe processus
   require_once($siteweb->get_document_root().DS."workflow".DS."classe".DS."processus.class.php");
   
   //instancier un objet processus
   $lprocessus = new processus();
   //obtenir la liste des processus du système
   $lprocessus->etatprocessus  = 1;	//n'afficher que les processus activés
   $lprocessus->listeprocessus = $lprocessus->rechercher();
   $select_processus = $lprocessus->liste_deroulante(array("id" => "numprocessus" , "name" => "numprocessus") , $numprocessus , ucfirst($translate["choisissez"]));
   
   ///avoir la liste déroulante des types de documents
   //chargement des spécifications de la classe document
   require_once($siteweb->get_document_root().DS."ged".DS."classe".DS."document.class.php");
   //instancier un objet document
   $ldoc = new Document();
   $select_typedoc = $ldoc->sel_typedoc(array("name" => "typedoc" , "id" => "typedoc" ) , null , null);
   
   //charger l'unité de durée des taches
   //chargement des spécifications de la classe processus
   require_once($siteweb->get_document_root().DS."administration".DS."classe".DS."config.class.php");
   //instancier un objet configuration
   $lconfig = new Config();
   //charger la configuration unite_durée
   $unite_duree =  $lconfig->charger();
   switch (intval($lconfig->uniteduree_tache))
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
   
   //l'utilisateur en cours peut avoir envie , à partiri d'ici, de modifier l'unité de durée d'une tâche
			   //lui offrir un accès direct à  la page de configuration
			   //seuls les membres du groupe "superadmin" peuvent accéder à la page de configuration
				
		   if (intval($_SESSION["is_superadmin"]) == 1)
			{
				$unite_duree = $siteweb->a_tag($unite_duree , $siteweb->get_url()."/gabarit/page.gabarit.php" , null , array("do" => "config_view" , "lang" => $lang , "login" =>  $login ) , ucfirst($translate["info_bulle_config_unite_duree"]));
			} 
   
   //libérer la mémoire
   unset($lconfig);
   unset($lprocessus);
   
   global $tac , $select_processus,$lprocessus;
?>