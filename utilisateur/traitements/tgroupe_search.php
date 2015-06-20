	<?php
	
	$data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
	$data[$lkey] = $lvalue;
	}
   
	$login = (isset($data["login"])) ? (! is_null($data["login"])) ? $data["login"] : "" : "";
	$do = (isset($data["do"])) ? (! is_null($data["do"])) ? $data["do"] : "accueil" : "accueil";
	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";

		$libgroup = $data["libgroup"];
		$sel_option_libgroup = $data["sel_option_libgroup"];
		
	  if (! defined("DS")) define("DS" , DIRECTORY_SEPARATOR);
	  //Chargements	
	  require_once($siteweb->get_document_root()."\classe\application.class.php");
	  require_once($siteweb->get_document_root()."\utilisateur\classe\groupe.class.php");
  	  ini_set('include_path', $siteweb->get_document_root().DS.'includes'.DS.'pear');	//charger les packages de PEAR::MDB2	

	  require_once($siteweb->get_document_root().DS."includes".DS."pear".DS."Structures".DS."DataGrid".DS."Renderer".DS."HTMLTable.php");   
	  require_once ($siteweb->get_document_root().DS."includes".DS."pear".DS."Structures".DS."DataGrid.php");
	  
	  $lgroupe = new groupe ();
	  
		foreach ($data as $lindex => $lvaleur )
		{
		$lgroupe->$lindex = $lvaleur;
		}

	  $listegroupe = $lgroupe->rechercher();	
	  global $listegroupe;
	  
 	   	//avoir la grille de groupes d'utilisateurs
	require_once($siteweb->get_document_root().DS."utilisateur".DS."traitements".DS."tgroupe_result_search.php");

	  echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url()."/utilisateur/js/groupe.js"."\"></script>\n";
				  
	?> 