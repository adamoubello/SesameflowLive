<?php
/**
 * @version			1.0
 * @package			GED
 * @subpackage		Doctumen
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits r�serv�s
 * @license			INTERFACE SA
 * @author 			patrick mveng <patrick.mveng@interfacesa.local>
 * @desc			Script pour l'enregistrement d'un nouveau document.
 * 				A chaque tache en cours peut correspondre plusieurs taches suivantes. $numtachesuiv contient la t�che suivante
 * effectivement s�lectionn�e par l'utilisateur
 * 
 * @creationdate	04 juillet 2009
 * @updates			samedi 18 juillet 2009 William Nkingn�<william.nkingne@laposte.net>
 * 				- adaptation code aux cas "dde_conge" et "dde_achat"
 * 				- �criture de $larr_champ_valide pour les cas "dde_conge" et "dde_achat"
 */

	$data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
	$data[$lkey] = $lvalue;
	}

	$login = (isset($data["login"])) ? (! is_null($data["login"])) ? $data["login"] : "" : "";
	$do = (isset($data["do"])) ? (! is_null($data["do"])) ? $data["do"] : "accueil" : "accueil";
	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
	$numtache = (isset($data["numtache"])) ? (! is_null($data["numtache"])) ? $data["numtache"] : null : null;
	$numtachesuiv = (isset($data["numtachesuiv"])) ? (! is_null($data["numtachesuiv"])) ? $data["numtachesuiv"] : null : null;
	$numworkflow = (isset($data["numworkflow"])) ? (! is_null($data["numworkflow"])) ? $data["numworkflow"] : null : null;
	$liste_elements = (isset($data["liste_elements"])) ? (! is_null($data["liste_elements"])) ? $data["liste_elements"] : "" : "";
	$typedoc = (isset($data["typedoc"])) ? (! is_null($data["typedoc"])) ? $data["typedoc"] : "" : "";
    $numdoc = (isset($data["numdoc"])) ? (! is_null($data["numdoc"])) ? $data["numdoc"] : "" : "";
    
    //obtenir le s�parateur de dossier pour la OS en cours
	if (! defined("DS")) define("DS" , DIRECTORY_SEPARATOR);

    $chemin = dirname(__FILE__);
	$chemin = str_replace(DS."ged".DS."traitements","",$chemin);
	require_once($chemin.DS."classe".DS."application.class.php");
    $siteweb = new Application();

   //chargement des sp�cifications de la classe formulaire
   require_once($siteweb->get_document_root().DS."ged".DS."classe".DS."formulaire.class.php");
   //chargement des sp�cifications de la classe etiquette
   require_once($siteweb->get_document_root().DS."ged".DS."classe".DS."etiquette.class.php");
   //chargement des sp�cifications de la classe champ
   require_once($siteweb->get_document_root().DS."ged".DS."classe".DS."champ.class.php");
   //chargement des sp�cifications de la classe donnee
   require_once($siteweb->get_document_root().DS."ged".DS."classe".DS."donnee.class.php");
   //chargement des sp�cifications de la classe numerique
   require_once($siteweb->get_document_root().DS."ged".DS."classe".DS."numerique.class.php");

   //instancier un objet formulaire
   $lformulaire = new Formulaire();
   //Cr�er automatiquement les attributs sur l'objet
   foreach ($data as $lattribut => $lvaleur)
   {
   $lformulaire->$lattribut = $lvaleur;
   }
   $larr_infos_elements = explode(";" , $liste_elements);

    //chargement de PEAR
   ini_set('include_path', $siteweb->get_document_root().DS.'includes'.DS."pear");	//charger les packages de PEAR::MDB2
   //g�n�rer un nouveau id pour ce formulaire
   $numdoc = $lformulaire->generer_numero();	// ! ! ! ! $numdoc est utilis� dans dans la suite d'un script qui require_once tdoocumet_create_valid.php
   $lformulaire->setNumdoc($numdoc);
   //enregistrer le formulaire
   if ($lformulaire->create())
   {
   		$state = "form_create_valid_success";
		$ltag = new Etiquette();
		$ltag->set_numero_document($lformulaire->numdoc);
		$numdoc=$lformulaire->numdoc;
	    //Cr�er les mots-cl�s de ce formulaire
	    $ltags = $siteweb->split_words($lformulaire->titredoc);

	   /*$ttable=array();	   
       for ($i = 0; $i < count($ltags); $i++){
         $ttable[]=$ltag->addTag($ltags[$i]);
         echo ($ttable[$i]);  //$ltag->set_tag($ttable[$i]);
       }*/

	   //Comment enregistrer tous les tags cr��s pour un document?

       $ltag->set_frequence(1);
	   $ltag->ajouter();

	   //ajouter dynamiquement les �l�ments du formulaire comme champ dans la BD
	   //explode la liste des �l�ments
	   // format  : name1/type1;....;namen/typen

	   /**
	    * *une page web formulaire contient de nombreux �l�ments qui ne sont pas des champs d'un formulaire
	    * pour chaque type de document formulaire, on d�finit la liste des champs valides
	    * Et seuls ces champs seront enregistr�es dans la BD
	    */

	   switch(trim($typedoc))
	   {
	   		case "dde_credit" :
	   			$larr_champ_valide = array("retenue" , "montant", "date_credit" , "chemin_acces" , "ret_annuite" , "nbr_annuite" , "annuite");
	   			break;
	   		case "dde_conge" :
	   			$larr_champ_valide = array("codedep" , "num_dde", "motif" , "precision" , "dat_deb_conge" , "dat_fin_conge" , "chemin_acces");
	   			break;
	   		case "dde_achat" :
				$larr_champ_valide = array("departement" , "designation", "objet" , "date_deb" , "date_fin" , "observation");
	   			break;
	   }

       //liste des num�ros des champs g�n�r�s
	   $larr_numchamp = array();
	   foreach ($larr_infos_elements as $linfos_element)
	   {
	   		//explode les infos d'un �l�ments
	   		//format nom/type
	   		$larr_infos = explode("/" , $linfos_element);
	   		if (in_array(strtolower(trim($larr_infos[0])), $larr_champ_valide))
	   		{
		   		//d�finition de l'objet champ et ajout dans la BD
		   		$lchamp = new champ();
		   		$lchamp->numchamp = $lchamp->generer_numero();
		   		$lchamp->nomchamp = $larr_infos[0];
		   		$lchamp->typechamp = $larr_infos[1];
		   		$lchamp->numdoc = $lformulaire->numdoc;
		   		$lchamp->valeurdonnee = trim(strval($data[$larr_infos[0]])); //die($data[$larr_infos[0]]);
		   		if (! $lchamp->create()) die($lchamp->exception);
		   		$larr_numchamp[strtolower(trim($larr_infos[0]))] = $lchamp->numchamp;
		   		//lib�rer la m�moire
		   		unset($lchamp);
	   		}
	   }

	   unset($larr_infos_elements);
	   unset($linfos_element);
	   unset($larr_infos);

	   //ajouter les donn�es des champs
	   foreach ($larr_champ_valide as $lnom_champ)
	   {
		   $ldonnee = new Donnee();
		   $ldonnee->numchamp = $larr_numchamp[strtolower(trim($lnom_champ))];
		   $ldonnee->datemodif = date("d/m/Y");
		   $ldonnee->heuremodif = date("H:m:s");
		   $ldonnee->valeurdonnee = trim(strval($data[$lnom_champ]));
		   if ( ! $ldonnee->create()) die($ldonnee->exception);

		   unset($ldonnee);
	   }
   }
   else die($lformulaire->exception);

	/**$lnumeric=new Numerique();
	$lnumeric->set_upload_max_filesize($siteweb->get_max_filesize());
   if ($lnumeric->importer($siteweb->get_document_root().DS."ged".DS."document", "chemin_acces")) {
     		     
	     $lnumeric->numdoc=$lformulaire->numdoc;
	     $lnumeric->setLibfich($lnumeric->get_chemin_acces());
	     $lnumeric->setDateImportation();
	     $lnumeric->setHeureImportation();
	     $lnumeric->setNumform($lnumeric->generer_numero());
	     
	     //enregistrement des donn�es de la pi�ce jointe dans la BD
	     $lnumeric->create();
	}
	else die($lnumeric->state)    ;*/
	
	//mettre � jour l'�tat du workflow en cours
   //chargement des sp�cifications de la classe workflow
  /* require_once($siteweb->get_document_root().DS."workflow".DS."classe".DS."workflow.class.php");
   $lworkflow = new workflow();
   $lworkflow->numworkflow = $numworkflow;
   $lworkflow->numtache = $numtachesuiv;
	if ( ! $lworkflow->modifier_tache()) die($lworkflow->get_exception());
	
	//lib�rer la m�moire
	unset($lworkflow);*/
	
	$state = "tache_valid_success";
	$_POST["numdoc"] = $lformulaire->numdoc;
    global $numdoc; 
?>