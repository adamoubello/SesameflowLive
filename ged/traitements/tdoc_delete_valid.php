<?php
/**
 * @version			1.0
 * @package			GED
 * @subpackage		Document
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			William Nkingné<william.nkingne@laposte.net>
 * @desc			script de prétraitement pour la suppression efefctive d'un document formulaire ou d'une pièce jointe de la base de données
 * 					Ce script est une boite noire réutilisable pour affiche une grille de documents.
 * Si typedoc = dde_credit, dde_achat, dde_conge, etc. on va supprimer dans la table document
 * Si typedoc = numeric,  on va supprimer dans la table numerique
 * 
 * @param 			$translate - tableau de traductions dans la langue en cours
 * @param 			$do	- code de la page web en cours. Suivant la page web, le nombre de colonnes de la grille varie
 * @param 			$typedoc -  type du document pièce jointe : dde_credit , dde_conge, dde_achat, etc.
 * 
 * @link 			Grille de pièce jointe
 * 					Bouton Supprimer dans le menu central
 * @creationdate	samedi 20 juin 2009
 * @updates
 * 	# mercredi 22 juillet 2009 by patrick mveng<patrick.mveng@interfacesa.local>
 * 		- remplacement de case "form" par case "dde_credit", case "dde_conge" , etc.
 */

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
   	$chemin = dirname(__FILE__);

    
	$chemin = str_replace("\ged\\traitements","",$chemin);

	require_once($chemin.'\classe\application.class.php');	
	
   	$siteweb = new Application();
   
   //obtenir le séparateur de dossier pour la OS en cours
   if (! defined("DS")) define( 'DS', DIRECTORY_SEPARATOR );
   
   require_once($siteweb->get_document_root().DS."ged".DS."classe".DS."document.class.php");
   switch ($typedoc){
   		case "dde_credit":
   		case "dde_conge":
   		case "dde_achat":
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
		
		   //suppression physique du formulaire dans la BD
		   if ($ldoc->delete())
		   {
				$state = "doc_delete_valid_success";
		   }
		   else die($ldoc->exception);
		   
		   //libération de la mémoire
		   unset ($ldoc);
		   	break;
   		case "numeric":
			//chargement des spécifications de la classe numerique
   			require_once($siteweb->get_document_root().DS."ged".DS."classe".DS."numerique.class.php");
			$lnumeric = new Numerique();
			foreach ($data as $lattribut => $lvaleur)
		   	{
				$lnumeric->$lattribut = $lvaleur;
		   	}
            $numdoc = $data['numdoc']; //die($numdoc);
            $libfich = $lnumeric->getLibfich($numdoc);//die($libfich);
		  	ini_set('include_path', $siteweb->get_document_root().'\includes\pear');	//charger les packages de PEAR::MDB2
            //die($libfich);
			if ($lnumeric->delete()) {
              if($libfich != "." AND $libfich != ".." AND !is_dir($libfich))
                {
                  $chemin_fichier = $siteweb->get_document_root().DS."ged".DS."document".DS.$libfich;
    		      //die ($chemin_fichier);
                }
		      $state = "delete_valid_success";
		    }
		   else die($lnumeric->exception);
		   unset ($lnumeric);
			break;
  }
?>