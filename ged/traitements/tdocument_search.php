<?php
/**
 * @version			1.0
 * @package			GED
 * @subpackage		Document
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			William<william.nkingne@laposte.net>
 * @desc			script de prétraitement pour l'affichage de la page de recherche des documents
 * @creationdate	mercredi 17 juin 2009
 * @updates
 *      # mardi 28 juillet 2009
            - Modification de la récupération des valeurs dans le select multiple ($sel_option_etat)
 */	

	$data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
		$data[$lkey] = $lvalue;
	}

	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
	$login= (isset($data["login"])) ? (! is_null($data["login"])) ? $data["login"] : null : null;

	$sel_option_titredoc=$data["sel_option_titredoc"];
	$titre=$data['titre'];
	$tagdoc=$data["tagdoc"];	
	$dat_deb_creation = $data["dat_deb_creation"];
	$dat_fin_creation = $data["dat_fin_creation"];
	$dat_deb_modif = $data["dat_deb_modif"];
	$dat_fin_modif = $data["dat_fin_modif"];
	
	$sel_option_auteurdoc=$data['sel_option_auteurdoc'];
	$auteurdoc=$data['codeuser'];
	$contenu=$data["contenu"];

    $sel_option_etat = array ();
    if (is_array($data['sel_option_etat']))
    {
	    foreach ($data['sel_option_etat'] as $value){
	      $sel_option_etat[] = $value;
	    }                
    }

	//Chargements
	require_once($siteweb->get_document_root().DS."classe".DS."application.class.php");
	require_once($siteweb->get_document_root().DS."ged".DS."classe".DS."formulaire.class.php");
	require_once($siteweb->get_document_root().DS."includes".DS."pear".DS."Structures".DS."DataGrid".DS."Renderer".DS."HTMLTable.php");   
	require_once ($siteweb->get_document_root().DS."includes".DS."pear".DS."Structures".DS."DataGrid.php");
	
	//Chargement des packages de PEAR::MDB2	
	ini_set('include_path', $siteweb->get_document_root().'\includes\pear');	

	$doc = new Document();	//instancier un objet qui représente soit un formulaire, soit un document numérique
				  
	foreach ($data as $lindex => $lvaleur ) {
		$doc->$lindex = $lvaleur;		
	}

	if (trim(strtolower($login)) != "admin")
	{
		require_once($siteweb->get_document_root().DS."utilisateur". DS."classe".DS."utilisateur.class.php");
		  $luser = new Utilisateur();
		  $luser->loginuser = $login;
		  if (! $luser->charger()) die($luser->get_exception());
		  
		  $doc->codeuser = $luser->codeuser;
			unset($luser);
	}
	$listedoc = $doc->rechercher();
	
	if ($doc->has_exception()) die($doc->exception);
	global $listedoc;
				  
	echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url()."/ged/js/ged.js"."\"></script>\n";
	require_once($siteweb->get_document_root().DS."ged".DS."traitements".DS."tdocument_result_search.php");
			  
?>