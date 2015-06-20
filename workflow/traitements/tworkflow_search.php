	<?php
	
	$data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
	$data[$lkey] = $lvalue;
	}
   
	$login = (isset($data["login"])) ? (! is_null($data["login"])) ? $data["login"] : "" : "";
	$do = (isset($data["do"])) ? (! is_null($data["do"])) ? $data["do"] : "accueil" : "accueil";
	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
	$dureetache = (isset($data["dureetache"])) ? (! is_null($data["dureetache"])) ? $data["dureetache"] : null : null ;
	$typedoc = (isset($data["typedoc"])) ? (! is_null($data["typedoc"])) ? $data["typedoc"] : null : null ;
	
	if (! defined("DS"))  define("DS" , DIRECTORY_SEPARATOR);

	$libworkflow = $data["libworkflow"];
	$sel_option_libworkflow = $data["sel_option_libworkflow"];
	$sel_option_dureeworkflow = $data["sel_option_dureeworkflow"];
	$sel_option_datedebutworkflow = $data["dat_deb_creation"];
	$sel_option_datefinworkflow = $data["dat_fin_creation"];
	$sel_option_etat = $data["sel_option_etat[]"];
	$dureeworkflow = $data["dureeworkflow"];
	$dat_deb_creation = $data["dat_deb_creation"];
	$dat_fin_creation = $data["dat_fin_creation"];	
	
	
      //Chargements	
	  require_once($siteweb->get_document_root().DS."classe".DS."application.class.php");
	  require_once($siteweb->get_document_root().DS."workflow".DS."classe".DS."workflow.class.php");
	  ini_set('include_path', $siteweb->get_document_root().DS.'includes'.DS.'pear');	//charger les packages de PEAR::MDB2	
	  
	  require_once($siteweb->get_document_root().DS."includes".DS."pear".DS."Structures".DS."DataGrid".DS."Renderer".DS."HTMLTable.php");   
	  require_once ($siteweb->get_document_root().DS."includes".DS."pear".DS."Structures".DS."DataGrid.php");
	  
		  
		    $lworkflow = new workflow ();
		  
			foreach ($data as $lindex => $lvaleur )
			{
				$lworkflow->$lindex = $lvaleur;
			}
			 
		  $listeworkflow = $lworkflow->rechercher();
		  if ($lworkflow->has_exception()) die($lworkflow->get_exception());	
		  
		  global $listeworkflow;
		  
	      require_once($siteweb->get_document_root().DS."workflow".DS."traitements".DS."tworkflow_result_search.php");		  
		  
	?> 