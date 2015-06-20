<?php

/**
 * @version			1.0
 * @package			Workflow
 * @subpackage		Workflow
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			patrick mveng<patrick.mveng@interfacesa.com>
 * @desc			Script de traitements pour l'exportation d'information
 * @param  			do - code du type d'information à exporter
 * @param  			export - type de fichier d'exportation. xls => Fichier Excel 2007, xml => Fichier XML , csv => Fichier CSV
 * @param  			$_SESSION["export"] - datagrid sérialisé
 * @creationdate	19 aout 2009
 * @updates
 */	
	 $data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
	$data[$lkey] = $lvalue;
	}
   
	$login = (isset($data["login"])) ? (! is_null($data["login"])) ? $data["login"] : "" : "";
	$do = (isset($data["do"])) ? (! is_null($data["do"])) ? $data["do"] : "accueil" : "accueil";
	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
	$export = (isset($data["export"])) ? (! is_null($data["export"])) ? $data["export"] : "xls" : "xls";
	
	if (! defined("DS"))  define("DS" , DIRECTORY_SEPARATOR);

	  //Chargements	
	  require_once($siteweb->get_document_root().DS."classe".DS."application.class.php");
	  
		require_once($siteweb->doc_root.DS."ged".DS."classe".DS."document.class.php");
		$gdoc = new Document();	  
	  
	  $siteweb = new Application();
	  
	  /** Include path **/
		set_include_path(get_include_path() . PATH_SEPARATOR . $siteweb->get_document_root().DS."includes".DS."pear"  );
		
		$luploaddir = ($siteweb->doc_root.DS.'ged'.DS."document");
			
		//on commence par verifier que le dossier d'upload existe
	      if (! file_exists($luploaddir)) 
	      {
	      	if (!is_dir($luploaddir))
			{
				@mkdir($luploaddir, 0777);
			}
	      }
	      
	      if (!is_writable($luploaddir))
			{
				@chmod($luploaddir, 0777);
			}
			
		unset($luploaddir);	
	
	  switch (trim(strtolower($do)))
	  {
		case "tache_export":  
			$ldata_grid = $_SESSION["export"];
			$ldata_grid = unserialize($ldata_grid);
		break;
		case "circuit_export":  
			$ldata_grid = $_SESSION["export"];
		break;

	  }
	  
	  $siteweb->renderExportSelection($ldata_grid, $export, "exportation");			
	  exit();
	  
	 ?> 
							 
								 