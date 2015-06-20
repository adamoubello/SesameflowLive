<?php

   $data = ($_POST) ? $_POST : $_GET;
  
   $username = $data["username"];
   $passwd = $data["passwd"];
	
   $chemin = dirname(__FILE__);
	
   require_once($chemin.'\..\..\classe\application.class.php');	
	
   $siteweb = new Application();
   
	
   require_once($siteweb->get_document_root().'\utilisateur\classe\utilisateur.class.php');
   $user = new Utilisateur();
   
   $result = $user->suppression();
   if ($result==true) 
   {
     echo 'Modification reussie';
   } 
   else
   {
     echo 'Echec modification';
   }
 
?>

