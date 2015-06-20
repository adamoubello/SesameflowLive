	<?php
	
	 $data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
		$data[$lkey] = $lvalue;
	}
   
	$dureeprocessus = (isset($data["dureeprocessus"])) ? (! is_null($data["dureeprocessus"])) ? $data["dureeprocessus"] : "" : "";
	$etatprocessus = (isset($data["etatprocessus"])) ? (! is_null($data["etatprocessus"])) ? $data["etatprocessus"] : "" : "";
	$login = (isset($data["login"])) ? (! is_null($data["login"])) ? $data["login"] : "" : "";
	$do = (isset($data["do"])) ? (! is_null($data["do"])) ? $data["do"] : "accueil" : "accueil";
	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";

		$libprocessus = $data["libprocessus"];
		$sel_option_libprocessus = $data["sel_option_libprocessus"];
		$sel_option_dureeprocessus = $data["sel_option_dureeprocessus"];
		$sel_option_etatprocessus = $data["sel_option_etatprocessus"];
		
		if (! defined("DS")) define("DS" , DIRECTORY_SEPARATOR);
	  //Chargements	
	  require_once($siteweb->get_document_root()."\classe\application.class.php");
	  require_once($siteweb->get_document_root()."\workflow\classe\processus.class.php");
  	  ini_set('include_path', $siteweb->get_document_root().DS.'includes'.DS.'pear');	//charger les packages de PEAR::MDB2	

	  require_once($siteweb->get_document_root().DS."includes".DS."pear".DS."Structures".DS."DataGrid".DS."Renderer".DS."HTMLTable.php");   
	  require_once ($siteweb->get_document_root().DS."includes".DS."pear".DS."Structures".DS."DataGrid.php");
	  
	  $process = new processus ();
	  
		foreach ($data as $lindex => $lvaleur )
		{
			$process->$lindex = $lvaleur;
		}

	  $listeprocessus = $process->rechercher();	
	  if ($process->has_exception()) die($process->exception);
	  
		//charger l'unité de durée des processus
	   //chargement des spécifications de la classe configuration
	   require_once($siteweb->get_document_root().DS."administration".DS."classe".DS."config.class.php");
	   //instancier un objet configuration
	   $lconfig = new Config();
	   //charger la configuration unite_durée
	   $lconfig->charger();
	   switch (intval($lconfig->uniteduree_processus))
	   {
	   		case 1 :
	   			$unite_duree_processus = $translate["heure"]."(s)";
	   			break;
	   		case 2 :
	   			$unite_duree_processus = $translate["jour"]."(s)";
	   			break;
	   		case 3 :
	   			$unite_duree_processus = $translate["mois"]."(s)";
	   			break;
			default:
				$unite_duree_processus = $translate["jour"]."(s)";
				break;
	   }
	  
	  
	require_once($siteweb->get_document_root().DS."workflow".DS."traitements".DS."tprocessus_result_search.php");				
	  
	  global $listeprocessus , $unite_duree_processus;
	  
	  unset($lconfig);
	  
	  //! ! ! !  ne pas unset($process)
				  
	?> 