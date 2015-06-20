<?php
/**
 * @version			1.0
 * @package			Workflow
 * @subpackage		Tache
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits r�serv�s
 * @license			INTERFACE SA
 * @author 			Bello<@yahoo.fr> 
 * @desc			script pour l'affichage de la page de consultation d'une t�che
 * @creationdate	????
 */
	
	        $data = $_POST;
			foreach ($_GET as $lkey => $lvalue)
			{
			$data[$lkey] = $lvalue;
			}

		$numtache = $data["numtache"];
		$libtache = $data["libtache"];
		$dureetache = $data["dureetache"];
		$sel_option_libtache = $data["sel_option_libtache"];
				
		  //Chargements	
		  require_once($siteweb->get_document_root()."\classe\application.class.php");
		  require_once($siteweb->get_document_root()."\workflow\classe\\tache.class.php");
		  require_once($siteweb->get_document_root()."/includes/pear/Structures/DataGrid/Renderer/HTMLTable.php");   
		  require_once ($siteweb->get_document_root()."/includes/pear/Structures/DataGrid.php");
		  //require_once ("HTML/Table.php");
		  
		  ini_set('include_path', $siteweb->get_document_root().'\includes\pear');	//charger les packages de PEAR::MDB2	
		  
		  $tac = new tache ();
		  
			foreach ($data as $lindex => $lvaleur )
			{
				$tac->$lindex = $lvaleur;
			}
			 
		  if (! $tac->charger()) die($tac->exception);	
			//print_r($tac); die();	  
		   //chargement des sp�cifications de la classe processus
		   require_once($siteweb->get_document_root().DS."workflow".DS."classe".DS."processus.class.php");
		   
		   //instancier un objet processus
		   $lprocessus = new processus();
		   //obtenir la liste des processus du syst�me
		   $lprocessus->etatprocessus  = 1;	//n'afficher que les processus activ�s
		   $lprocessus->listeprocessus  =  $lprocessus->rechercher();
		   $select_processus = $lprocessus->liste_deroulante(array("id" => "numprocessus" , "name" => "numprocessus") , $tac->numprocessus , ucfirst($translate["choisissez"]));
		   
		   ///avoir la liste d�roulante des types de documents
		   //chargement des sp�cifications de la classe document
		   require_once($siteweb->get_document_root().DS."ged".DS."classe".DS."document.class.php");
		   //instancier un objet document
		   $ldoc = new Document();
		   $select_typedoc = $ldoc->sel_typedoc(array("name" => "typedoc" , "id" => "typedoc" ) , $tac->typedoc , null);
		
		   //charger l'unit� de dur�e des taches
		   //chargement des sp�cifications de la classe processus
		   require_once($siteweb->get_document_root().DS."administration".DS."classe".DS."config.class.php");
		   //instancier un objet configuration
		   $lconfig = new Config();
		   //charger la configuration unite_dur�e
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
		   
		   //l'utilisateur en cours peut avoir envie , � partiri d'ici, de modifier l'unit� de dur�e d'une t�che
			   //lui offrir un acc�s direct �  la page de configuration
			   //seuls les membres du groupe "superadmin" peuvent acc�der � la page de configuration
				
		   if (intval($_SESSION["is_superadmin"]) == 1)
			{
				$unite_duree = $siteweb->a_tag($unite_duree , $siteweb->get_url()."/gabarit/page.gabarit.php" , null , array("do" => "config_view" , "lang" => $lang , "login" =>  $login , "numtache" => $numtache ) , ucfirst($translate["info_bulle_config_unite_duree"]));
			} 
				
		   
		   //lib�rer la m�moire
		   unset($lprocessus);
		   unset($ldoc);
		   unset($lconfig);

		   global  $tac;
				  	  
     ?> 