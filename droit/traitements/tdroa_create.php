<?php
   
   $data = ($_POST) ? $_POST : $_GET;
   $lang = $data["lang"];
   if (trim($lang=="")) 
   { $lang="fr";}
   $chemin = dirname(__FILE__);
   
	$chemin = str_replace("\droit\\traitements","",$chemin);
	require_once($chemin.'\classe\application.class.php');	
	
   $siteweb = new Application();
   
   global $siteweb;
   
?>