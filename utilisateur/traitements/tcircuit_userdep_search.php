<?php

    //r�cup�rer les param�tres de recherche post�
		/**
	 * **script appel� par ajax
	 */
	//lancer la recherche des abonn�s suivant les param�tres de GET
	$data = ($_POST) ? $_POST : $_GET;
	$chemin=urldecode($data["docroot"]);
		print_r($data); die();

	/*$chemin = dirname(__FILE__);
	$chemin = str_replace("\circuit\traitements","",$chemin);*/
	print_r($chemin);
	die();
    require_once($chemin.'\classe\application.class.php');	
	global $listeuser;
    $siteweb = new Application();
    
    global $siteweb;
   
	require_once($siteweb->get_document_root()."\utilisateur\\traitements\\tuser_search.php");
	
	//foreach ($listeuser as $lvaleur) { 
    echo "<option value=".$lvaleur["codeuser"]."> ".$lvaleur["nomuser"]." </option>\n";  
    // }  

?>