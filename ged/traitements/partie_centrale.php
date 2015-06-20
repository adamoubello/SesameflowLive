<?php
/**
 * @version			1.0
 * @package			GED
 * @subpackage		traitements
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			William<william.nkingne@laposte.net>
 * @desc			Controlleur du module GED. Suivant la valeur du paramètre page, ce contrôlleur part
 * 					aiguiller le système vers la page web ou le traitement spécifique
 * @creationdate	lundi 15 juin 2009
 * @updates
 * 	# samedi 20 juin 2009 (Patrick Mveng)
 * 		- Substitution de formulaire_search par doc_search dans le page gabarit. Voici les codes de pages dans le module GED 
			a.	doc_search
			b.	doc_view
			c.	doc_delete
			d.	doc_create
			e.	doc_update
			Chacun de ces codes de page sera accompagné du paramètre typedoc qui définit le type de document associé à doc_view,
			doc_delete, doc_create, doc_update.

	#lundi 29 juin 2009
		- ajout du case doc_download_valid pour le téléchargement d'un document
	#mercredi 1 juillet 2009 (William Aurélien Nkingné)
		- ajout des cases doc_update_valid et doc_delate_valid	
	#samedi 25 juillet 2009
		- intégration du controle d'accès à une fonctionnalité		
 */
	global $siteweb ,$numdoc ,$codecircuit ;		

	$data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
	$data[$lkey] = $lvalue;
	}

	$do = $data["do"];
	$lang = $data["lang"];
	$login = $data["login"];
	$typedoc = $data["typedoc"];
	$numworkflow = (isset($data["numworkflow"])) ? (! is_null($data["numworkflow"])) ? $data["numworkflow"] : null : null ;
	$numdoc = (isset($data["numdoc"])) ? (! is_null($data["numdoc"])) ? $data["numdoc"] : null : null;
	$codecircuit = (isset($data["codecircuit"])) ? (! is_null($data["codecircuit"])) ? $data["codecircuit"] : null : null;
			
	/*$login = (isset($data["login"])) ? (! is_null($data["login"])) ? $data["login"] : "" : "";
 	$typedoc = (isset($data["typedoc"])) ? (! is_null($data["typedoc"])) ? $data["typedoc"] : null : null;
	$do = (isset($data["do"])) ? (! is_null($data["do"])) ? $data["do"] : "accueil" : "accueil";
	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
	$numtache = (isset($data["numtache"])) ? (! is_null($data["numtache"])) ? $data["numtache"] : null : null;
	$numdoc = (isset($data["numdoc"])) ? (! is_null($data["numdoc"])) ? $data["numdoc"] : null : null;
	$nomchamp = (isset($data["nomchamp"])) ? (! is_null($data["nomchamp"])) ? $data["numtache"] : null : null;
	$numtachesuiv = (isset($data["numtachesuiv"])) ? (! is_null($data["numtachesuiv"])) ? $data["numtachesuiv"] : null : null;
	$numworkflow = (isset($data["numworkflow"])) ? (! is_null($data["numworkflow"])) ? $data["numworkflow"] : null : null;
	$liste_elements = (isset($data["liste_elements"])) ? (! is_null($data["liste_elements"])) ? $data["liste_elements"] : "" : "";
	$codedep=$data['txt_loginuser'];
	$document= (isset($data["document"])) ? (! is_null($data["document"])) ? $data["document"] : null : null;*/
				
   //obtenir le séparateur de dossier pour la OS en cours
   if (! defined("DS")) define( 'DS', DIRECTORY_SEPARATOR );

   $chemin = dirname(__FILE__);
   $chemin = str_replace(DS."ged".DS."traitements","",$chemin);
   require_once($chemin.DS.'classe'.DS.'application.class.php');	
   $siteweb = new Application();
   
   require_once($siteweb->get_document_root().DS."ged".DS."lang".DS."ged.{$lang}.php");

	//controle des permissions de l'utilisateur en cours
	//si pas de controle, il y aura redirection vers la page précédente.
	$siteweb->control_permission($login , $lang , $do , $ajax , $state);
	
//die($do);
switch (trim($do))
{
	case "doc_search":
		require_once($siteweb->get_document_root().DS."ged".DS."traitements".DS."tdocument_search.php");
		require_once($siteweb->get_document_root().DS."ged".DS."traitements".DS."tdocument_result_search.php");
		require_once($siteweb->get_document_root().DS."ged".DS."traitements".DS."tdoc_add_file_valid.php");
		/*echo $siteweb->redirection($siteweb->get_url()."/gabarit/page.gabarit.php",
		array( "lang" => $lang ,  "do" => "doc_search" , "login" => $login , "state" => $state) , true);*/			
		require_once($siteweb->get_document_root().DS."ged".DS."page".DS."doc_search.php");		
		break;
			
	case "doc_download_valid":
		require_once($siteweb->get_document_root().DS."ged".DS."traitements".DS."tdocument_download_valid.php");
		die();
		break;
		
	case "doc_add_file_valid":
		require_once($siteweb->get_document_root().DS."ged".DS."traitements".DS."tdoc_add_file_valid.php");
		//obtenir juste les paramètres	do=user_search&login=admin&lang=en
		$lparam_url = $_SERVER["HTTP_REFERER"];
		//extraire les paires de paramètres
		$larr_param = explode("?",trim($lparam_url));
		$lparam_url = $larr_param[1];

		$larr_param = explode("&",trim($lparam_url));
	
		//fabriquer un tableau associatif
		$larr_param2 = array();
		foreach ($larr_param as $lpaire) 
		{
		 $larr_element = explode("=" , $lpaire);
		 $larr_param2[$larr_element[0]] = trim($larr_element[1]);
		}
		
		switch(trim(strtolower($larr_param2["do"])))
		{
			case "workflow_update" :
				$larr_param2["state"] = $state;
				echo $siteweb->redirection($siteweb->get_url()."/gabarit/page.gabarit.php", 	$larr_param2 , true);		
				break;
			case "doc_view" :
				$larr_param2["state"] = $state;
				echo $siteweb->redirection($siteweb->get_url()."/gabarit/page.gabarit.php", $larr_param2 , true );
				break;
			default:
				echo $siteweb->redirection($siteweb->get_url()."/gabarit/page.gabarit.php",
		        array( "lang" => $lang ,  "do" => "doc_view" , "login" => $login , "state" => $state , "numdoc" => $numdoc , "typedoc" => $typedoc) , true);		
				break;	
		}		
		break;
				
	case "doc_view":
		require_once($siteweb->get_document_root().DS."ged".DS."traitements".DS."tdoc_view.php")		;
		switch (trim($typedoc))
		{
			case "numeric" :
				require_once($siteweb->get_document_root().DS."ged".DS."page".DS."numerique_view.php");
				break;
			default :
				require_once($siteweb->get_document_root().DS."ged".DS."page".DS."formulaire_view.php");
				break;
		}
		break;
		
	case "doc_update_valid" :		
		require_once($siteweb->get_document_root().DS."ged".DS."traitements".DS."tdoc_update_valid.php");
		require_once($siteweb->get_document_root().DS."ged".DS."traitements".DS."tdoc_generer_pdf.php");
		require_once($siteweb->get_document_root().DS."workflow".DS."traitements".DS."tworkflow_update_doc_valid.php");
		if (intval($ajax) == 1) { die($lretval); }
		echo $siteweb->redirection($siteweb->get_url()."/gabarit/page.gabarit.php",
		array( "lang" => $lang ,  "do" => "doc_search" , "login" => $login) , true);
		die();
		break;
			
	case "doc_delete_valid" :  
		require_once($siteweb->get_document_root().DS."ged".DS."traitements".DS."tdoc_delete_valid.php");
		echo $siteweb->redirection($siteweb->get_url()."/gabarit/page.gabarit.php",
		array( "lang" => $lang ,  "do" => "doc_search" , "login" => $login , "state" => $state) , true);		
		break;
		
	case "doc_create" :
		require_once($siteweb->get_document_root().DS."ged".DS."traitements".DS."tdoc_create.php");
		switch (trim($typedoc))
		{
			case "dde_credit" :
				require_once($siteweb->get_document_root().DS."ged".DS."page".DS."dde_credit.php");
				break;
			case "dde_achat" :
				require_once($siteweb->get_document_root().DS."ged".DS."page".DS."dde_achat.php");
				break;
			case "dde_conge" :
				require_once($siteweb->get_document_root().DS."ged".DS."page".DS."dde_conge.php");
				break;
		}
		break;
		
	case "doc_create_valid" :		
		require_once($siteweb->get_document_root().DS."ged".DS."traitements".DS."tdocument_create_valid.php");
		require_once($siteweb->get_document_root().DS."workflow".DS."traitements".DS."tworkflow_create.php");
		require_once($siteweb->get_document_root().DS."workflow".DS."traitements".DS."tworkflow_create_valid.php");
		require_once($siteweb->get_document_root().DS."ged".DS."traitements".DS."tdoc_generer_pdf.php");
		echo $siteweb->redirection($siteweb->get_url()."/gabarit/page.gabarit.php",
		array( "lang" => $lang ,  "do" => "accueil_user" , "login" => $login) , true);
		break;
		
	case "doc_archive_valid":		
		require_once($siteweb->get_document_root().DS."ged".DS."traitements".DS."tdoc_archive_valid.php");
		echo $siteweb->redirection($siteweb->get_url()."/gabarit/page.gabarit.php",
		array( "lang" => $lang ,  "do" => "doc_search" , "login" => $login) , true);		
		break;
	
	case "doc_reject_valid" :		
		require_once($siteweb->get_document_root().DS."ged".DS."traitements".DS."tdoc_reject_valid.php");
		echo $siteweb->redirection($siteweb->get_url()."/gabarit/page.gabarit.php",
		array( "lang" => $lang ,  "do" => "accueil_user" , "login" => $login) , true);
		//echo $siteweb->get_url()."/gabarit/page.gabarit.php?lang={$lang}&do=accueil_user&login={$login}";
		break;    
	
	}
?>