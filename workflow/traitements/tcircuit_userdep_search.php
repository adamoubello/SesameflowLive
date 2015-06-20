<?php
//récupérer les paramètres de recherche posté
		/**
	 * **script appelé par ajax
	 */
	//lancer la recherche des abonnés suivant les paramètres de GET
	$chemin = dirname(__FILE__); 
	/*$chemin = str_replace("\circuit\traitements","",$chemin);
	print_r($chemin);
	die();
    require_once($chemin.'\classe\application.class.php');	
	global $listeuser;
   $siteweb = new Application();
   
   global $siteweb;
   $siteweb->get_document_root().*/
	require_once("utilisateur\\traitements\\tuser_search.php");
	
	//foreach ($listeuser as $lvaleur) { 
 echo "<option value=".$lvaleur["codeuser"]."> ".$lvaleur["nomuser"]." </option>\n";  
// }  
?>