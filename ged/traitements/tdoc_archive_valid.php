<?php
$data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
		$data[$lkey] = $lvalue;
	}

	$ajax = (isset($data["ajax"])) ? (! is_null($data["ajax"])) ? $data["ajax"] : 0 : 1;
	$login = (isset($data["login"])) ? (! is_null($data["login"])) ? $data["login"] : "" : "";
	$action = (isset($data["action"])) ? (! is_null($data["action"])) ? $data["action"] : "accueil" : "accueil";
	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
	$typedoc = $data["typedoc"];
    $numdoc=$data["numdoc"];

	$chemin = dirname(__FILE__);
	$chemin = str_replace("\ged\\traitements","",$chemin);
	require_once($chemin.'\classe\application.class.php');		
   	$siteweb = new Application();
   
   	//obtenir le séparateur de dossier pour la OS en cours
   	if (! defined("DS")) define( 'DS', DIRECTORY_SEPARATOR );

	switch ($typedoc) {
		case "numeric":
			//chargement des spécifications de la classe numerique
			require_once($siteweb->get_document_root().DS."ged".DS."classe".DS."numerique.class.php");

			//instancier un objet numerique
			$lnumeric = new Numerique();
			//créer automatiquement les attributs sur l'objet
			foreach ($data as $lattribut => $lvaleur) 
			{
				$lnumeric->$lattribut = $lvaleur;	
			}
		   
			//chargement de PEAR
			ini_set('include_path', $siteweb->get_document_root().'\includes\pear');	//charger les packages de PEAR::MDB2	
		
			//supprimer logiquement (archivage) le document numérique
			if ($lnumeric->archiver())
			{
				$state = "doc_archive_valid_success";
			}
			else die($lnumeric->exception);
		   
			//libérer la mémoire
			unset($lnumeric);
		break;
        default:
			//chargement des spécifications de la classe formulaire
			require_once($siteweb->get_document_root().DS."ged".DS."classe".DS."formulaire.class.php");

			//instancier un objet formulaire
			$ldoc = new Formulaire();
			//créer automatiquement les attributs sur l'objet
			foreach ($data as $lattribut => $lvaleur)
			{
				$ldoc->$lattribut = $lvaleur;
			}

			//chargement de PEAR
			ini_set('include_path', $siteweb->get_document_root().'\includes\pear');	//charger les packages de PEAR::MDB2

			//supprimer logiquement (archivage) le formulaire
			if ($ldoc->archiver())
			{
				$state = "doc_archive_valid_success";
			}
			else die($ldoc->exception);

			//libérer la mémoire
			unset($ldoc);
		break;
	}   	
?>