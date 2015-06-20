	<?php
	
	              $data = ($_POST) ? $_POST : $_GET;

				  //Chargements	
				  require_once($siteweb->get_document_root()."\classe\application.class.php");
				  require_once($siteweb->get_document_root()."\utilisateur\classe\utilisateur.class.php");
				  require_once($siteweb->get_document_root()."/includes/pear/Structures/DataGrid/Renderer/HTMLTable.php");   
				  require_once ($siteweb->get_document_root()."/includes/pear/Structures/DataGrid.php");
				  //require_once ("HTML/Table.php");
				  
				  ini_set('include_path', $siteweb->get_document_root().'\includes\pear');	//charger les packages de PEAR::MDB2	
				  
				  $user = new utilisateur ();
				  
					foreach ($data as $lindex => $lvaleur )
					{
					$user->$lindex = $lvaleur;
					}
					 
				  $listeuser = $user->suppression();	
				  
				  global $listeuser;
				  
	?> 