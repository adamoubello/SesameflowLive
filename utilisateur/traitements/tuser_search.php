<?php

/**
 * @version			1.0
 * @package			Utilisateur
 * @subpackage		Utilisateur
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello Adamou<moustaphbi@yahoo.fr> 
 * @desc			script de prétraitements pour la page de recherche des utilisateurs				
 * @creationdate	????
 * @updates
 */
	
	$data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
	$data[$lkey] = $lvalue;
	}

	$nomuser = $data["nomuser"];
	$prenomuser = $data["prenomuser"];
	$loginuser = $data["loginuser"];
	$sel_option_nomuser = $data["sel_option_nomuser"];
	$sel_option_prenomuser = $data["sel_option_prenomuser"];
	$sel_option_loginuser = $data["sel_option_loginuser"];
	$sel_option_typeuser = $data["sel_option_typeuser"];
	$sel_option_typeuser = $data["sel_option_typeuser"];
	
	//obtenir éventuellement le code de la page ayant lancé la requete AJAX
	$dofrom = (isset($data["dofrom"])) ? (! is_null($data["dofrom"])) ? $data["dofrom"] : null : null;
	$ajax = (isset($data["ajax"])) ? (! is_null($data["ajax"])) ? $data["ajax"] : 0 : 0;	//par défaut pas d'appel depuis ajax
	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";	//par défaut Francais
	
    //obtenir le séparateur de dossier pour la OS en cours
    if (! defined("DS")) define( 'DS', DIRECTORY_SEPARATOR );
   
    $chemin = dirname(__FILE__);
	$chemin = str_replace(DS."utilisateur".DS."traitements","",$chemin);
	require_once($chemin.DS.'classe'.DS.'application.class.php');	
	$siteweb = new Application();
	ini_set('include_path', $siteweb->get_document_root().DS."includes".DS."pear");	//charger les packages de PEAR::MDB2	
   
	//Chargements	
	require_once($siteweb->get_document_root().DS."classe".DS."application.class.php");
	require_once($siteweb->get_document_root().DS."utilisateur".DS."classe".DS."utilisateur.class.php");
	require_once($siteweb->get_document_root().DS."includes".DS."pear".DS."Structures".DS."DataGrid".DS."Renderer".DS."HTMLTable.php");require_once ($siteweb->get_document_root().DS."includes".DS."pear".DS."Structures".DS."DataGrid.php");
  
   $user = new Utilisateur ();
   foreach ($data as $lindex => $lvaleur )
	{
	$user->$lindex = $lvaleur;
	}
	 
  $listeuser = $user->rechercher();	 //print_r($listeuser); die($user->codedep);
  $user->listeuser = $listeuser;
  global $listeuser , $siteweb;

  //si appel depuis ajax,
  if (intval($ajax) == 1)
  {	
	  if (trim($dofrom) != "")
	  {
	  	switch (trim($dofrom))
	  	{
	  		case "cir_create":
	  		case "circuit_view":
  				require_once ($siteweb->get_document_root().DS."lang".DS."application.{$lang}.php");	  			
	  			$lretval = ucfirst($translate["acteur"])." "
	  			.$user->liste_deroulante(array("name"=>"sel_acteur" , "id"=>"sel_acteur") , null , ucfirst($translate["choisissez"]));
	  			/*$lretval = "<option value=\"\">".ucfirst($translate["choisissez"])."</option>\n";
	  			//fabriquer les options de la liste déroulante
	  			if (trim($listeuser) != "")
				{
					foreach($listeuser as $obj)
					{
						if (trim($obj["codeuser"]) != "")
						{
							$list .= "<option value=\"".$obj['codeuser']."\"";
							if ((trim(strval($pdefault)) == trim(strval($obj['nomuser'])) ))
							{
								$list .= " selected";
							}
							$list .= ">".$obj["nomuser"]."</option>\n";
						}
					}
				}*/
	  			break;
	  	}
	  	die($lretval);
	  }
  }
  else 
  {
   	//avoir la grille d'utilisateurs
	require_once($siteweb->get_document_root().DS."utilisateur".DS."traitements".DS."tuser_result_search.php");

  }
  
	 ?> 