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
			 * @creationdate	03 août 2009
			 * @updates
			 */
			
			$data = $_POST;
			foreach ($_GET as $lkey => $lvalue)
			{
				$data[$lkey] = $lvalue;
			}
			
			//partie copiéé dans tgroupe_update_valid.php et modifiée
			
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
			if ($lconfig->set_configurationi($lcontenu) == true) $lretval = "<font style=\"color:green\"><b> OK</b> </font>";
			else $lretval = "<font style=\"color:red\"><b> ERREUR</b> </font>";
			
			
//chargement des spécifications de la classe TABLE
			//require_once($siteweb->get_document_root().DS."administration".DS."classe".DS."table.class.php");
			$ltable=new Table();
			
			$ltable->typebd=$lconfig-> typebd;
			$ltable->hotebd=$lconfig-> hotebd;
			$ltable->nombd="";//$lconfig-> nombd;
			$ltable->userbd= $lconfig-> userbd;
			$ltable->pwdbd= $lconfig-> pwdbd;
			
			$getape_suivante = 0;
			
			//chargement de PEAR			
			ini_set('include_path', $siteweb->get_document_root().'\includes\pear'); //charger les packages de PEAR::MDB2
			
			if ($ltable->connection_database() == true)
			{
				$lretval_connection_database = "<font style=\"color:green\"><b> OK</b> </font>";
				$getape_suivante = 1;
			}
			else 
			{
				$lretval_connection_database = "<font style=\"color:red\"><b>".$ltable->get_exception()."</b> </font>";
				$getape_suivante = 0;
			}
			
	
			//chargement des spécifications de la classe Config
			$lconfig_connect_server	=	new Config();
			$lconfig_connect_server	->hotesite	=	$lconfig->hotesite;
			$lconfig_connect_server	->portsite	=	$lconfig->portsite;
			
			
		if ($lconfig_connect_server->connect_server() == true)
		{
			$lretval_connect_server = "<font style=\"color:green\"><b> OK</b> </font>";
			$getape_suivante = 1;
		}
			else 
			{
				$lretval_connect_server = "<font style=\"color:red\"><b>".$lconfig_connect_server->get_exception()."</b> </font>";
				$getape_suivante = 0;
			}
			
			/*global $getape_suivante;
			
			die($getape_suivante);
			*/
			if (intval($ajax) == 1)
			{
				die($lretval);
			}
			

			?>