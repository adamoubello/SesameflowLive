	<?php
	    
        $data = $_POST;
		foreach ($_GET as $lkey => $lvalue)
		{
		 $data[$lkey] = $lvalue;
		}

		if (! defined("DS")) define("DS" , DIRECTORY_SEPARATOR);

		//$numprocessus = $data["numworkflow"];
		$datedebutwf = $data["datedebutwf"];
		$heuredebutwf = $data["heuredebutwf"];
		$archivewf = $data["archivewf"];
		$numdoc = $data["numdoc"];
		$numtache = $data["numtache"];
		$numworkflow = $data["numworkflow"];
		$dureewf = $data["dureewf"];
		
				  //Chargements	
				  require_once($siteweb->get_document_root()."\classe\application.class.php");
				  require_once($siteweb->get_document_root().DS."workflow".DS."classe".DS."workflow.class.php");
				  require_once($siteweb->get_document_root()."/includes/pear/Structures/DataGrid/Renderer/HTMLTable.php");   
				  require_once ($siteweb->get_document_root()."/includes/pear/Structures/DataGrid.php");
				  //require_once($siteweb->get_document_root().DS."workflow".DS."classe".DS."circuit_tache.class.php");
				  
				  ini_set('include_path', $siteweb->get_document_root().'\includes\pear');	//charger les packages de PEAR::MDB2	
				  
				  $workfl = new workflow ();
				  //$cir_tache = new Circuit_tache ();
				 
				  foreach ( $data as $lindex => $lvaleur )
				  {
				   $workfl->$lindex = $lvaleur;
				  }
					 
				  $workfl->charger();
				  if ($workfl->has_exception()) die($workfl->exception);
				
				//obtenir la liste des documents du workflow  en cours
				require_once($siteweb->get_document_root().DS."ged".DS."classe".DS."document.class.php");				  
				$doc = new Document();
				$doc->numdoc = $workfl->numdoc;
				$listedoc = $doc->rechercher();
				require_once($siteweb->get_document_root().DS."ged".DS."traitements".DS."tdocument_result_search.php");				
								
				//obtenir la liste des acteurs du workflow en cours
				require_once($siteweb->get_document_root().DS."utilisateur".DS."classe".DS."utilisateur.class.php");				  				$user = new utilisateur();
				$listeworkflow=$workfl->rechercher();//print_r($workfl->rechercher());print_r(($workfl->numworkflow)-1);
				//$user->codeuser = $workfl->codeuser;
				$user->codeuser = $listeworkflow[($workfl->numworkflow)-1][codeuser];//print_r($listeworkflow[0][codeuser]);
				$listeuser = $user->rechercher();//print_r($user->codeuser);
								
				//$listeuser[($user->codeuser)-1] = $listeworkflow[($workfl->numworkflow)-1][codeuser];
				//$listeuser = $listeuser[($user->codeuser)-1];//print_r($listeuser[($user->codeuser)-1]);
				//print_r($listeuser);
				require_once($siteweb->get_document_root().DS."utilisateur".DS."traitements".DS."tuser_result_search.php");				
				
				//obtenir la liste des taches du workflow  en cours
				require_once($siteweb->get_document_root().DS."workflow".DS."classe".DS."tache.class.php");				  
				$ltache = new tache();
				$ltache->numtache = $workfl->numtache;//print_r($workfl->numtache);
				$listetache = $ltache->rechercher();//print_r($listetache);
				require_once($siteweb->get_document_root().DS."workflow".DS."traitements".DS."ttache_result_search.php");				
				  
			    //charger l'unité de durée des workflow
			    //chargement des spécifications de configuration
			    require_once($siteweb->get_document_root().DS."administration".DS."classe".DS."config.class.php");
			    //instancier un objet configuration
			    $lconfig = new Config();
			    //charger la configuration unite_durée
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
				
			    global $workfl, $siteweb , $user , $document;
				  
			   //libérer la mémoire
			   unset($ltache); 
			   unset($doc); 
			   unset($listetache); 
			   unset($listeuser);
			   unset($listeworkflow);
			   unset($listedoc); 
			   unset($lconfig); 
				  
     ?> 