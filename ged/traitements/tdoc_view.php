<?php
/**
 * @version			1.0
 * @package			GED
 * @subpackage		traitements
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			William Nkingné <william.nkingne@laposte.net>
 * @desc			Script de traitement de l'affichage des données d'un document.
 * 
 * @creationdate	mardi 30 juin 2009
 * @updates
 */

	    $data = $_POST;
		foreach ($_GET as $lkey => $lvalue)
		{
			$data[$lkey] = $lvalue;
		}
		
		$numdoc = $data["numdoc"];
		$codeuser = $data["codeuser"];
		$titredoc=$data["titredoc"];
		$datecreation=$data["date_dde"];
		$date_deb_credit=$data["date_credit"];
		$auteur=$data["auteur"];
		$numtache=$data["numtache"];
		$montant=$data["montant"];
		$nbr_annuite=$data["nbr_annuite"];
		$annuite=$data["annuite"];
		$typedoc = $data["typedoc"];
		
	    $numworkflow = (isset($data["numworkflow"])) ? (! is_null($data["numworkflow"])) ? $data["numworkflow"] : null : null;		

		if (! defined("DS")) define("DS" , DIRECTORY_SEPARATOR);

		//Chargements
		require_once($siteweb->get_document_root().DS."classe".DS."application.class.php");
		require_once($siteweb->get_document_root().DS."includes".DS."pear".DS."Structures".DS."DataGrid".DS."Renderer".DS."HTMLTable.php");
		require_once ($siteweb->get_document_root().DS."includes".DS."pear".DS."Structures".DS."DataGrid.php");


		ini_set('include_path', $siteweb->get_document_root().DS.'includes'.DS.'pear');	//charger les packages de PEAR::MDB2

		switch (trim(strtolower($typedoc)))
		{
			case "numeric" :  
				require_once($siteweb->get_document_root().DS."ged".DS."classe".DS."document.class.php");
				require_once($siteweb->get_document_root().DS."ged".DS."classe".DS."numerique.class.php");
				$document = new Numerique();
				$document->setNumdoc($numdoc);
				$document->setTypedoc($typedoc);
				$document->charger();

				break;
			default:
				require_once($siteweb->get_document_root().DS."ged".DS."classe".DS."document.class.php");

				$document = new Document();

				foreach ( $data as $lindex => $lvaleur ) {
					$document->$lindex = $lvaleur;
				}

				$document->charger();

				//obtenir la liste des données de champs du documents en cours
		 		//chargement des spécifications de la classe donnee
		   		require_once($siteweb->get_document_root().DS."ged".DS."classe".DS."donnee.class.php");

		   		$ldonnee = new donnee();
		   		$ldonnee->numdoc = $numdoc;
		   		$listedonnee = $ldonnee->rechercher();
		   		if (trim($ldonnee->exception) != "") die($ldonnee->exception);

		   		//
		   		$lchamp = array();
		   		if (is_array($listedonnee))
		   		{
			   		foreach ($listedonnee as $lrow)
			   		{
			   			$lchamp[$lrow["nomchamp"]] = $lrow["valeurdonnee"];
			   		}
		   		}
				global $document , $lchamp;					  
				
				//libérer la mémoire
				unset($ldonnee);
				unset($listedonnee);
				
				break;
		}
		
		//fabriquer l'hyperlien qui permet d'aller consulter plus d'infos sur l'auteur du document
		$link_auteur = "<a href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?do=user_view&lang={$lang}&login={$login}&codeuser=".$document->codeuser."\">".$document->nomuser." ".$document->prenomuser."</a>";
		//obtenir l'url pour l'accès au fichier physiquement stocké
		 $url_file_name = $siteweb->get_url()."/ged/document/".$document->libfich;
		//obtenir la liste des mots clés du documents en cours
		require_once($siteweb->get_document_root().DS."ged".DS."classe".DS."etiquette.class.php");
		$ltag = new Etiquette();
		$ltag->numdoc = $numdoc;
		$listetag = $ltag->rechercher();
		if ($ltag->has_exception()) die($ltag->exception);
		global $listetag , $link_auteur;
		require_once($siteweb->get_document_root().DS."ged".DS."traitements".DS."ttag_result_search.php");
		
		switch (trim(strtolower($typedoc)))
		{
			case "numeric" :
				break;
			default:

				//obtenir la liste des pièces jointes du documents en cours
				require_once($siteweb->get_document_root().DS."ged".DS."classe".DS."numerique.class.php");
				$lpiece_jointe = new Document();
				$lpiece_jointe->numform = $numdoc;
				$lpiece_jointe->typedoc = "numeric";
				$listedoc = $lpiece_jointe->rechercher();
				if ($lpiece_jointe->has_exception()) die($lpiece_jointe->exception);
				global $listedoc;
				require_once($siteweb->get_document_root().DS."ged".DS."traitements".DS."tdocument_result_search.php");
				break;
		}
		
?>