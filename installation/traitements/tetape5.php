<?php	
/**
			 * @version			1.0
			 * @package			installation
			 * @subpackage		traitements
			 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
			 * @license			INTERFACE SA
			 * @author 			Xaverie télédzina <onana_carine@yahoo.fr>
			 * @desc			Script pour le traitement des valeurs à poster dans config.
			 * @param 			
			 * @creationdate	02 Septembre 2009
			 * @updates
			 */
			 
			$data = $_POST;
			foreach ($_GET as $lkey => $lvalue)
			{
				$data[$lkey] = $lvalue;
			}
			
			$ajax = (isset($data["ajax"])) ? (! is_null($data["ajax"])) ? $data["ajax"] : 0 : 0;
			//$login = (isset($data["login"])) ? (! is_null($data["login"])) ? $data["login"] : "" : "";
			$etape = (isset($data["etape"])) ? (! is_null($data["etape"])) ? $data["etape"] : "accueil" : "accueil";
			$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
			
			//obtenir le séparateur de dossier pour la OS en cours
			if (! defined("DS")) define( 'DS', DIRECTORY_SEPARATOR );
			
			$chemin = dirname(__FILE__);
			$chemin = str_replace(DS."installation".DS."traitements","",$chemin);
			require_once($chemin.DS.'classe'.DS.'application.class.php');
			
			$siteweb = new Application();
		
			
			//obtenir le séparateur de dossier pour la OS en cours
			if (! defined("DS")) define( 'DS', DIRECTORY_SEPARATOR );
			//chargement des spécifications de la classe config
			require_once($siteweb->get_document_root().DS."administration".DS."classe".DS."config.class.php");
			
			//instancier un objet groupe est remplacé par calui de la config
			$lconfig = new Config();
			
			//créer automatiquement attibuts sur l'objet
			foreach ($data as $lattribut => $lvaleur)
			{
				$lconfig->$lattribut = $lvaleur;
			}
			
			require_once($siteweb->get_document_root().DS.'lang'.DS.'application.'.$lang.'.php');
		
			foreach ($lconfig as $lattribut => $lvaleur) {
				$lcontenu .= "{$lattribut}={$lvaleur}"."\n";
			}
			
			
			
			//enregistrer la configuration dans un fichier texte
			/*if ($lconfig->set_configurationi($lcontenu) == true) $lretval = "<font style=\"color:green\"><b> OK</b> </font>";
			else $lretval = "<font style=\"color:red\"><b> ERREUR</b> </font>";
			*/
			
//chargement des spécifications de la classe TABLE
			//require_once($siteweb->get_document_root().DS."administration".DS."classe".DS."table.class.php");
			$siteweb->get_configuration($siteweb->get_document_root().DS."administration".DS."config.txt");
			
			$ltable=new Table();
			ini_set('include_path', $siteweb->get_document_root().'\includes\pear'); //charger les packages de PEAR::MDB2
			$ltable->typebd=$data["typebd"];
			$ltable->hotesite=$data["hotesite"];
			$ltable->portsite=$data["portsite"];
			$ltable->userbd=$data["userbd"];
			$ltable->pwdbd=$data["pwdbd"];
			$ltable->nombd=$data["nombd"];
			$ltable->hotebd=$data["hotebd"];
			$ltable->connection_database();//print_r($siteweb);
			$getape_suivante = 0;
			
			if ($ltable->creation_database($ltable->nombd,$siteweb->get_document_root().DS."administration".DS."sesameflow.sql") == true)
			{
				$lretval_creation_database = "<font style=\"color:green\"><b> OK</b> </font>";
				$getape_suivante = 1;
				
				require_once($siteweb->get_document_root().DS."administration".DS."classe".DS."config.class.php");
				//enregistrer cette configuration dans la table config
				$lconfig=new Config();
				ini_set('include_path', $siteweb->get_document_root().'\includes\pear'); //charger les packages de PEAR::MDB2
				$lconfig->typebd=$data["typebd"];
				$lconfig->hotesite=$data["hotesite"];
				$lconfig->portsite=$data["portsite"];
				$lconfig->userbd=$data["userbd"];
				$lconfig->pwdbd=$data["pwdbd"];
				$lconfig->nombd=$data["nombd"];
				$lconfig->hotebd=$data["hotebd"];
				$lconfig->listlimit=5;
				$lconfig->uniteduree_process=1;
				$lconfig->uniteduree_circuit=1;
				$lconfig->uniteduree_tache=1;
				$lconfig->notifmail=0;
				$lconfig->ajouter();//print_r($siteweb);
				
				
				require_once($siteweb->get_document_root().DS."administration".DS."classe".DS."module.class.php");
				//enregistrer les modules intégrés du workflow
				$lmodule=new Module();
				
				ini_set('include_path', $siteweb->get_document_root().'\includes\pear'); //charger les packages de PEAR::MDB2

				$lmodule->codemod = "ged";
				$lmodule->etatmod = 1;
				$lmodule->libmod=  'permet de stocker et administrer une base de documents' ;
				$lmodule->ajouter();
				unset($lmodule);
				
				$lmodule=new Module();
				$lmodule->codemod = "mail";
				$lmodule->etatmod = 1;
				$lmodule->libmod=  'Gestion des mails' ;
				$lmodule->ajouter();
				unset($lmodule);
				
				$lmodule=new Module();
				$lmodule->codemod = "paie";
				$lmodule->etatmod = 0;
				$lmodule->libmod=  'SESAME PAIE' ;
				$lmodule->ajouter();
				unset($lmodule);
				
				$lmodule=new Module();
				$lmodule->codemod = "rh";
				$lmodule->etatmod = 0;
				$lmodule->libmod=  'SESAME RH' ;
				$lmodule->ajouter();
				unset($lmodule);
				
			}
			else 
			{
				$lretval_creation_database = "<font style=\"color:red\"><b>".$ltable->get_exception()."</b> </font>";
				$getape_suivante = 0;
			}
			
			
			
			
			/*global $getape_suivante;
			
			die($getape_suivante);
			*/
			if (intval($ajax) == 1)
			{
				die($lretval_creation_database);
			}
			
			
			/*if($ltable->creation_database($lconfig->nombd, $siteweb->get_document_root().DS."administration".DS."sesameflow.sql")) $letval_creation_database="<font style=\"color:green\"><b> OK</b> </font>";
			else $letval_creation_database = "<font style=\"color:red\"><b>	ERROR/</b> </font>";*/
		/*$ltable->get_exception()*/
			
			 ?>