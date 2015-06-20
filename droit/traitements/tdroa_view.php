	<?php
	
	    $data = ($_POST) ? $_POST : $_GET;

		$codedroa = $data["codedroa"];
		$libdroa = $data["libdroa"];
		$niveau_accesdroa = $data["niveau_accesdroa"];
						
		$sel_option_libdroa = $data["sel_option_libdroa"];
		
	
				  //Chargements	
				  require_once($siteweb->get_document_root()."\classe\application.class.php");
				  require_once($siteweb->get_document_root()."\droit\classe\droa.class.php");
				  require_once($siteweb->get_document_root()."/includes/pear/Structures/DataGrid/Renderer/HTMLTable.php");   
				  require_once ($siteweb->get_document_root()."/includes/pear/Structures/DataGrid.php");
				  //require_once ("HTML/Table.php");
				  
				  ini_set('include_path', $siteweb->get_document_root().'\includes\pear');	//charger les packages de PEAR::MDB2	
				  
				  $droa = new droit ();
				  
					foreach ($data as $lindex => $lvaleur )
					{
						$droa->$lindex = $lvaleur;
						
					}
					 
				  $droa->charger();	
				  
				  global $droa;
				  
     ?> 
	 