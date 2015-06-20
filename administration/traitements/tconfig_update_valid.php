			<?php
			/**
			 * @version			1.0
			 * @package			Administrateur
			 * @subpackage		Configuration
			 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
			 * @license			INTERFACE SA
			 * @author 			Xaverie télédzina <onana_carine@yahoo.fr>
			 * @desc			Script pour les modifications de la page de configuration de l'application.
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
			$login = (isset($data["login"])) ? (! is_null($data["login"])) ? $data["login"] : "" : "";
			$do = (isset($data["do"])) ? (! is_null($data["do"])) ? $data["do"] : "accueil" : "accueil";
			$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
			
			//obtenir le séparateur de dossier pour la OS en cours
			if (! defined("DS")) define( 'DS', DIRECTORY_SEPARATOR );
			
			$chemin = dirname(__FILE__);
			$chemin = str_replace(DS."administration".DS."traitements","",$chemin);
			require_once($chemin.DS.'classe'.DS.'application.class.php');

			$siteweb = new Application();
		
			
			//obtenir le séparateur de dossier pour la OS en cours
			if (! defined("DS")) define( 'DS', DIRECTORY_SEPARATOR );
			//chargement des spécifications de la classe processus
			require_once($siteweb->get_document_root().DS."administration".DS."classe".DS."config.class.php");
			
			//instancier un objet groupe est remplacé par calui de la config
			$lconfig = new Config();
			
			//créer automatiquement attibuts sur l'objet
			foreach ($data as $lattribut => $lvaleur)
			{
				$lconfig->$lattribut = $lvaleur;
			}
			//chargement de PEAR
			ini_set('include_path', $siteweb->get_document_root().'\includes\pear'); //charger les packages de PEAR::MDB2
			require_once($siteweb->get_document_root().DS.'lang'.DS.'application.'.$lang.'.php');
			if ($lconfig->existe())
			{
				$lconfig->modifier();
				$lretval = "
						<dt class=\"message\">Message</dt>
			
						<dd class=\"message message fade\">
							<ul>
								<li>".$translate["update_valid_success"]."</li>
							</ul>
						</dd>";
			
			
			}
			else  if (! $lconfig->ajouter()) die ($lconfig->get_exception());
			else {
				$lretval = "
						<dt class=\"message\">Message</dt>
			
						<dd class=\"message message fade\">
							<ul>
								<li>".$translate["insert_valid_success"]."</li>
							</ul>
						</dd>";
			
			}
			
			
			//section sesameflow
			$lconfig = new Config();
			$lconfig->charger();
			
			$lcontenu  = "[sesameflow]"."\n" ;
			$lcontenu .= "typebd=".$lconfig->typebd."\n";
			$lcontenu .= "hotebd=".$lconfig->hotebd."\n";
			$lcontenu .= "userbd=".$lconfig->userbd."\n";
			$lcontenu .= "pwdbd=".$lconfig->pwdbd."\n";
			$lcontenu .= "nombd=".$lconfig->nombd."\n";
			$lcontenu .= "hotesite=".$lconfig->hotesite."\n";
			$lcontenu .= "portsite=".$lconfig->portsite."\n";
			$lcontenu .= "listlimit=".$lconfig->listlimit."\n";
			$lcontenu .= "uniteduree_process=".$lconfig->uniteduree_process."\n";
			$lcontenu .= "uniteduree_circuit=".$lconfig->uniteduree_circuit."\n";
			$lcontenu .= "uniteduree_tache=".$lconfig->uniteduree_tache."\n";
			$lcontenu .= "notifmail=".$lconfig->notifmail."\n";
			
			$lcontenu  .= "\n" ;
			
			//charger tous les modules
			//chargement des spécifications de la classe module
			require_once($siteweb->get_document_root().DS."administration".DS."classe".DS."module.class.php");
			
			//instancier un objet module
			$lmodule = new Module();
			$listemodule = $lmodule->rechercher();
			
			//parcourrir les module
			/*if (is_array($listemodule))
			{
				foreach ($listemodule as $larr_module) 
				{
					
					foreach ($larr_module as $key => $lprop_module) 
					{
						
						if (trim(strtolower($key)) == "codemod")
						{
							
							$lsection = $lprop_module;
							
							//charger les autres paramètres de ce module
							$lmodule->codemod = $lsection;
							$lmodule->parametre = true;
							$liste_module_config = $lmodule->rechercher();
							
							$lparagraphe = "\n";
							$lparagraphe = "[".$lsection."]"."\n";
							
							//print_r($liste_module_config); die();
							
							foreach ($liste_module_config as $larr_prop) 
							{
								foreach ($larr_prop as $prop => $lvaleur_prop) 
								{
									
									switch (trim(strtolower($prop)))
									{
										case "codemod": 
										case "libmod": 
											break;
										case "etatmod" :
											$lparagraphe .= "active=".intval($lvaleur_prop)."\n";
											break;
										case "nomchamp" :
											$lparagraphe .= "{$lvaleur_prop}=".$larr_prop["valeurdonnee"]."\n";
											break;	
										default:
											//$lparagraphe .= "{$prop}={$lvaleur_prop}"."\n";
											break;			
											
									}
								
								}
								
								//print_r($lprop_module); die($key);	
							}
						
							$lcontenu .= $lparagraphe;
						}
								
					}
					
				}
			}*/
			
			//enregistrer la configuration dans un fichier texte
			$lconfig->set_configuration($lcontenu);
			
			//print_r($_FILES); die();			
			//a-t-on le droit d'écriture dans le disque dur ?
			/*if (!is_writable($siteweb->get_document_root().DS."administration"))
			{
				//non, se donner les droits d'écriture
				@chmod($siteweb->get_document_root().DS."administration", 0777);
			}
			
			
			//Le mode par défaut est le mode 0777, ce qui correspond au maximum de droits possible.
			$lfilename = $siteweb->get_document_root().DS."administration".DS."config.txt";
			//supprimer ce fichier s'il existe déjà
			if (file_exists($lfilename))
			unlink($siteweb->get_document_root().DS."administration".DS."config.txt");			
			
			//l'ouvrir en mode création
			// mode x+ : Crée et ouvre le fichier en lecture et écriture ;
			$lfile =fopen($siteweb->get_document_root().DS."administration".DS."config.txt",'x+');
			if ($lfile)
			{
			
				//fabriquer le buffer
				$lcontenu = "typebd=".$lconfig->typebd."\n";
				$lcontenu .= "hotebd=".$lconfig->hotebd."\n";
				$lcontenu .= "hotesite=".$lconfig->hotesite."\n";
				$lcontenu .= "portsite=".$lconfig->portsite."\n";
				$lcontenu .= "userbd=".$lconfig->userbd."\n";
				$lcontenu .= "nombd=".$lconfig->nombd."\n";
				$lcontenu .= "pwdbd=".$lconfig->pwdbd."\n";
				$lcontenu .= "uniteduree=".$lconfig->uniteduree."\n";
				$lcontenu .= "listlimit=".$lconfig->listlimit."\n";
				$lcontenu .= "notifmail=".$lconfig->notifmail."\n";
				$lcontenu .= "pwdbdpaie=".$lconfig->pwdbpaie."\n";
				$lcontenu .= "typebdpaie=".$lconfig->typebdpaie."\n";
				$lcontenu .= "hotebdpaie=".$lconfig->hotebdpaie."\n";
				$lcontenu .= "userbdpaie=".$lconfig->userbdpaie."\n";
				$lcontenu .= "nombdpaie=".$lconfig->nombdpaie;
			
				fwrite($lfile,$lcontenu,strlen($lcontenu));
				fclose($lfile);
			}*/
			
			
			
			//importer le fichier logo, si définie
			if (trim($_FILES["logo"]) != "")
			{
				require_once($siteweb->get_document_root().DS."ged".DS."classe".DS."numerique.class.php");
				$logo = new Numerique();
				
				if (! $logo->importer($siteweb->get_document_root().DS."administration" , "logosite")) die($logo->get_exception());
				unset($logo);
			}
				
						
			if (intval($ajax) == 1)
			{
				die($lretval);
			}
	?>