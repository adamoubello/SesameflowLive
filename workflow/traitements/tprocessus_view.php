	<?php
	
	   $data = $_POST;
		foreach ($_GET as $lkey => $lvalue)
		{
			$data[$lkey] = $lvalue;
		}

		if (! defined("DS")) define("DS" , DIRECTORY_SEPARATOR);

		$numprocessus = $data["numprocessus"];
		$libprocessus = $data["libprocessus"];
		$dureeprocessus = $data["dureeprocessus"];
		$etatprocessus = $data["etatprocessus"];
				
		$sel_option_libprocessus = $data["sel_option_libprocessus"];
		
				  //Chargements	
				  require_once($siteweb->get_document_root()."\classe\application.class.php");
				  require_once($siteweb->get_document_root().DS."workflow".DS."classe".DS."processus.class.php");
				  require_once($siteweb->get_document_root()."/includes/pear/Structures/DataGrid/Renderer/HTMLTable.php");   
				  require_once ($siteweb->get_document_root()."/includes/pear/Structures/DataGrid.php");
				  
				  ini_set('include_path', $siteweb->get_document_root().'\includes\pear');	//charger les packages de PEAR::MDB2	
				  
				  $process = new processus ();
				  
					foreach ( $data as $lindex => $lvaleur )
					{
						$process->$lindex = $lvaleur;
					}
					 
				  $process->charger();	
				  if ($process->has_exception()) die($process->exception);
				
				  //obtenir la liste des taches du processus  en cours
				require_once($siteweb->get_document_root().DS."workflow".DS."classe".DS."tache.class.php");				  
				$ltache = new tache();
				$ltache->numprocessus = $process->numprocessus;
				$listetache = $ltache->rechercher();
				require_once($siteweb->get_document_root().DS."workflow".DS."traitements".DS."ttache_result_search.php");				
				
				  //obtenir la liste des circuits du processus  en cours
				require_once($siteweb->get_document_root().DS."workflow".DS."classe".DS."circuit.class.php");				  
				$lcircuit = new circuit();
				$lcircuit->numprocessus = $process->numprocessus;
				$listecircuit = $lcircuit->rechercher();
				require_once($siteweb->get_document_root().DS."workflow".DS."traitements".DS."tcircuit_result_search.php");				
				
				  
			   //charger l'unit� de dur�e des processus
			   //chargement des sp�cifications de la classe processus
			   require_once($siteweb->get_document_root().DS."administration".DS."classe".DS."config.class.php");
			   //instancier un objet configuration
			   $lconfig = new Config();
			   //charger la configuration unite_dur�e
			   $unite_duree =  $lconfig->charger();
			   switch (intval($lconfig->uniteduree_process))
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
			   
			   
			   //l'utilisateur en cours peut avoir envie , � partiri d'ici, de modifier l'unit� de dur�e d'un processus
			   //lui offrir un acc�s direct �  la page de configuration
			   //seuls les membres du groupe "superadmin" peuvent acc�der � la page de configuration
				
				//obtenir juste les param�tres	do=user_search&login=admin&lang=en
				/*$lparam_url = $_SERVER["QUERY_STRING"];
				//extraire les paires de param�tres
				$larr_param = explode("&",trim($lparam_url));

				//fabriquer un tableau associatif
				$larr_param2 = array();
				foreach ($larr_param as $lpaire) 
				{
						$larr_element = explode("=" , $lpaire);
						$larr_param2[$larr_element[0]] = trim($larr_element[1]);
				}
				$unite_duree = $siteweb->a_tag($unite_duree , $siteweb->get_url()."/gabarit/page.gabarit.php" , null , $lparam_url2  , "Cliquez ici pour modifier l'unit� de la dur�e");
				*/
				
				if (intval($_SESSION["is_superadmin"]) == 1)
				{
					$unite_duree = $siteweb->a_tag($unite_duree , $siteweb->get_url()."/gabarit/page.gabarit.php" , null , array("do" => "config_view" , "lang" => $lang , "login" =>  $login , "numprocessus" => $numprocessus ) , ucfirst($translate["info_bulle_config_unite_duree"]));
				} 
			   
				  global $process;
				  
				  //lib�rer la m�moire
				 unset($ltache); 
				 unset($lcircuit); 
				 unset($listetache); 
				 unset($listecircuit); 
				 unset($lconfig); 
				  
				 
     ?> 