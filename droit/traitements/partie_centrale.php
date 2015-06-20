<?php

  $data = ($_POST) ? $_POST : $_GET;
 
  $page = $data["page"];

  switch (trim($page))
  {
    case "droa_search":
	require_once($siteweb->get_document_root()."\droit\\traitements\\tdroa_search.php");	
	require_once($siteweb->get_document_root()."\droit\page\droa_search.php");
		  break;
    case "droa_create" :
	require_once($siteweb->get_document_root()."\droit\page\droa_create.php");
    require_once($siteweb->get_document_root()."\droit\page\add_droa.php");
	  break;
	  
	case "search_droa" :
	require_once($siteweb->get_document_root()."\droit\page\Tdroa_search.php");
	  break;    
	case "droa_view":
	require_once($siteweb->get_document_root()."\droit\\traitements\\tdroa_view.php");	
	require_once($siteweb->get_document_root()."\droit\page\droa_view.php");
	  break;
			  
  }

?>