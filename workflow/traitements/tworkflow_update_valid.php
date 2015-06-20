<?php
/**
 * @version			1.0
 * @package			Workflow
 * @subpackage		Workflow
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			patrick mveng <patrick.mveng@interfacesa.local>
 * @desc			Script pour l'exécution d'une tache du workflow
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
    $numdoc = (isset($data["numdoc"])) ? (! is_null($data["numdoc"])) ? $data["numdoc"] : null : null;
	$heuredebutwf = (isset($data["heuredebutwf"])) ? (! is_null($data["heuredebutwf"])) ? $data["heuredebutwf"] : null : null;
	$dureewf = (isset($data["dureewf"])) ? (! is_null($data["dureewf"])) ? $data["dureewf"] : null : null;
	$archivewf = (isset($data["archivewf"])) ? (! is_null($data["archivewf"])) ? $data["archivewf"] : null : null;
	
    //obtenir le séparateur de dossier pour le OS en cours
	if (! defined("DS")) define("DS" , DIRECTORY_SEPARATOR);

    $chemin = dirname(__FILE__);
	$chemin = str_replace(DS."workflow".DS."traitements","",$chemin);
	require_once($chemin.DS."classe".DS."application.class.php");
    $siteweb = new Application();
    ini_set('include_path', $siteweb->get_document_root().'\includes\pear');	//charger les packages de PEAR::MDB2	
     
    //chargement des spécifications de la classe workflow   
    require_once($siteweb->get_document_root().DS."workflow".DS."classe".DS."workflow.class.php");
    $workfl = new workflow();
    $workfl->numworkflow = $numworkflow;   
	$workfl->heuredebutwf = $heuredebutwf;   
	$workfl->dureewf = $dureewf;   
	$workfl->archivewf = $archivewf;   
	
    //obtenir le codecircuit
   	//if (! $workfl->charger()) die($workfl->get_exception());
   
   //Enregistrer la modification sur le workflow
   if ($workfl->modifier())
   {   //print_r($data);die("");
   	    $lretval = "
			<dt class=\"message\">Message</dt>

			<dd class=\"message message fade\">
				<ul>
					<li>".$translate["update_valid_success"]."</li>
				</ul>
			</dd>";
   }
   else
   {
   		$lretval = "
			<dt class=\"message\">Message</dt>

			<dd class=\"message message error\">
				<ul>
					<li>".$workfl->exception."</li>
				</ul>
			</dd>";
   }
   die($lretval);
	
  /* switch (intval($numtachesuiv))
   {
		case -3 :	// Modifier
			require_once($siteweb->get_document_root().DS."ged".DS."traitements".DS."tdoc_update_valid.php");  
			//fabriquer le pdf
			require_once($siteweb->get_document_root().DS."ged".DS."traitements".DS."tdoc_generer_pdf.php");   
 			$state = "update_valid_success";
		break;
		case -8 :	// Supprimer
			require_once($siteweb->get_document_root().DS."ged".DS."traitements".DS."tdoc_delete_valid.php");   	
			$state = "delete_valid_success";
		break;
   }

	//mettre à jour l'état du workflow en cours
	//il faut mettre à jour le workflow
	$workfl->numtache = $numtachesuiv;//en fait $numtachesuiv est le numéro de la tâche qui a provoqué l'appel de tworkflow_create_valid.php		
    $workfl->numdoc = $numdoc;	//$numdoc vient de la création de document
	if ( ! $workfl->modifier_tache()) die($workfl->get_exception());
   
	//a t-on atteint une tâche terminale. On a atteint une tache terminale si $numtachesuiv n'a pas de tâche suivante.
	//si tache terminale, on va archivé le workflow
	
	//RECHERCHER  la liste des tâches suivantes à la tâche en cours
	require_once($siteweb->get_document_root().DS."workflow".DS."classe".DS."tache.class.php");
	$ltache = new tache();
	$ltache->numtache = $numtachesuiv;
	$ltache->codecircuit = $workfl->codecircuit;
	$listetache = $ltache->rechercher();
	if ($ltache->has_exception()) die($ltache->get_exception());

	$est_terminale = true;
	//vérifier si toutes les tâches suivantes sont nulles
	$i = 0;
	while ( ($est_terminale) && ($i < count($listetache)))
	{
		$est_terminale = (trim($listetache[$i]["numtachesuiv"]) == "");	
		$i++;
	}
	
	//si la tache est terminale
	if ($est_terminale)
	{
		//archiver le workflow
		$workfl->archiver();
	}*/

   //libérer la mémoire
   unset($workfl);
   unset($listetache);
   unset($ltache);
   
?>