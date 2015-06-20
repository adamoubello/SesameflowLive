<?php

/**
 * @version			1.0
 * @package			GED
 * @subpackage		Formulaire
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			patrick mveng<patrick.mveng@interfacesa.local>  
 * @desc			Script de prétraitements pour l'affichage d'un formulaire de création
 * @creationdate	samedi 04 juillet 2009
 * @updates
 */

   	$data = $_POST;	
   	foreach ($_GET as $lkey => $lvalue)
	{
	$data[$lkey] = $lvalue;
	}
 
 	$login = (isset($data["login"])) ? (! is_null($data["login"])) ? $data["login"] : "" : "";
 	$typedoc = (isset($data["typedoc"])) ? (! is_null($data["typedoc"])) ? $data["typedoc"] : null : null;
	$do = (isset($data["do"])) ? (! is_null($data["do"])) ? $data["do"] : "accueil" : "accueil";
	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
	$numtache = (isset($data["numtache"])) ? (! is_null($data["numtache"])) ? $data["numtache"] : null : null;
	$numtachesuiv = (isset($data["numtachesuiv"])) ? (! is_null($data["numtachesuiv"])) ? $data["numtachesuiv"] : null : null;
	$numworkflow = (isset($data["numworkflow"])) ? (! is_null($data["numworkflow"])) ? $data["numworkflow"] : null : null;
	$numdoc = (isset($data["numdoc"])) ? (! is_null($data["numdoc"])) ? $data["numdoc"] : null : null;
	$codedep=$data['txt_loginuser'];
 	  
    if (! defined("DS")) 	define("DS" , DIRECTORY_SEPARATOR);

    $chemin = dirname(__FILE__);  
	$chemin = str_replace(DS."ged".DS."traitements","",$chemin);
	require_once($chemin.DS.'classe'.DS.'application.class.php');
	require_once($siteweb->get_document_root().DS."utilisateur".DS."classe".DS."departement.class.php");
	require_once($siteweb->get_document_root()."/includes/pear/Structures/DataGrid/Renderer/HTMLTable.php");   
    require_once ($siteweb->get_document_root()."/includes/pear/Structures/DataGrid.php");	
	$siteweb = new Application();    
  
  	$dep = new departement();
    $dep->listedep = $dep->rechercher();
    $attributes=array("name"=>"sel_dep","id"=>"sel_dep"
    ,"onchange"=>"javascript: on_circuit_change_dep('".$siteweb->get_url()."/utilisateur/traitements/tuser_search.php"."');");
    $select_departement = $dep->liste_deroulante($attributes , null , ucfirst($translate["departement"]));
  	//obtenir le nom et prénom du login en cours.
  	require_once($chemin.DS.'utilisateur'.DS."classe".DS.'utilisateur.class.php');	
  	$luser = new utilisateur();
  	$luser->loginuser = $login;
  	if (! $luser->charger()) die($luser->exception);
  	
  	$link_auteur = "<a href=\"#\" onclick=\"window.location='".$siteweb->get_url()."/gabarit/page.gabarit.php?do=user_view&lang={$lang}';\" >".ucfirst($luser->nomuser)." ".ucfirst($luser->prenomuser)."</a>";
  
    switch (trim($typedoc))
    {
  	   case "dde_credit" :
  		   break;
  	   case "dde_conge" :
  		   break;
       case "dde_achat" :
    	   echo "<script  type='text/javascript'>on_dde_achat_valid();</script>";
  		   break;
    }
  
    global $siteweb , $luser, $select_departement;
    
?>