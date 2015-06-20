<?php
/**
 * @version			1.0
 * @package			GED
 * @subpackage		Document
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			William<william.nkingne@laposte.net>
 * @desc			Script pour l'enregistrement des données d'un formulaire de demande de crédit
 * @creationdate	mardi 16 juin 2009
 * @updates	
 * 			# vendredi 26 juin 2009
 * 		- début ecriture du code d'enregistrement d'une pièce jointe à un formulaire
 *  
 * @todo	# Voir comment déterminer un tag et l'ajouter à un document
 * 			# Résoudre le passage automatique d'un fichier de langue à l'autre
 * 			# Enregistrer les données de la pièce jointe dans la BD
 */
	 	
   	$data = $_POST;
   	if (! defined("DS")) define("DS" , DIRECTORY_SEPARATOR);
   	
   	foreach ($_GET as $lkey => $lvalue)
	{
		$data[$lkey] = $lvalue;
	}
    
    		$chemin = dirname(__FILE__);
			$chemin = str_replace("\page","",$chemin);
			//require_once($chemin.'\lang\ged.'.$lang.'php');
				   
		   	$do=$data["page"];
		   	$lang=$data["lang"];
		   	$login=$data["login"];
		   	$codeuser=$data["codeuser"];
            $retenue=$data["retenue"];
		   	$montant=$data["montant"];
		   	$date_dde=$data["date_dde"];
		   	$date_credit=$data["date_credit"];
		   	$nbr_annuite=$data["nbr_annuite"];
		   	$annuite=$data["annuite"];
		   	$liste_element=explode($data["liste_element"],";");
		   	$champ_fichier=$data["chemin_acces"];
		
			//obtenir le contenu de la variable ajax, qui permet de savoir si ce script a été appellé ou non depuis AJAX
			$lajax = (isset($data["ajax"])) ? (! is_null($data["ajax"])) ? $data["ajax"] : 0 : 0;
			$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
  
   			$chemin = dirname(__FILE__);
		   	$chemin = str_replace("\ged\page","",$chemin);   
		   	require_once($chemin.'\classe\application.class.php');	
   			$siteweb = new Application();
   
   			global $siteweb;
   
			ini_set('include_path', $siteweb->get_document_root().'/includes/pear');	//charger les packages de PEAR::MDB2
   
		   //charger la spécification de la classe Profil
		   require_once($siteweb->get_document_root().'\ged\classe\formulaire.class.php');
		   require_once($siteweb->get_document_root().'\ged\classe\numerique.class.php');
		   		   
		   switch (trim($do)){
    	
	    	case "dde_credit":
			   	$form = new Formulaire();
			   
			   	$form->setNumdoc(3);
			  	$form->setTitredoc("Demande de crédit");
			   	$form->setTagdoc('Fait avec ajax JS');	
			   	$form->setDatecreation();
			   	$form->setHeurecreation();
			   	$form->setCodeuser($codeuser);
			   	$form->setNumtache(1);		   
			   	
			   	if (trim($champ_fichier)!=""){ //Vérifie que le champ de pièce jointe n'est pas vide
			   		$i=1;
			   		$filename=array_pop(explode(DS,$champ_fichier));
			   		$extension=strrchr($filename,'.');
			   		$extension=substr($extension,1);
			   		
			   		$fichier=new Numerique();
			   		
			   		$fichier->setNumfich(1);
			   		$fichier->setLibfich("Fichier ".$i);$i++;
			   		$fichier->setExtension($extension);
			   		$fichier->setAuteurfich($codeuser);
			   		$fichier->setTagdoc("test");
			   		$fichier->setDateImportation();
			   		$fichier->setHeureImportation();
			   		$fichier->setNumdoc($form->numdoc);
			   		$fichier->setChemin_acces($siteweb->get_document_root()."/upload");
			   		
			   		$fichier->importer($siteweb->get_document_root().DS."document","chemin_acces");
			   		
			  	}  	
			  	$form->create();
			  	
			  	//Boucler sur tous les champs du formulaire
			  	$chp=new champ();
			  	$donnee=new donnees();
			  	$j=1;
			  	foreach ($liste_element as $info_element){
			  		$info=explode($info_element,"/");
			  		$chp->setNumchamp($j);		
			  		$chp->setTypechamp($info[1]);
			  		$chp->setNumdoc($form->numdoc);
			  		$chp->create(); 
			  		
			  		$donnee->setNumdonnees($j);
			  		$donnee->setValeurdonnees($info[0]);
			  		$donnee->setTypedonnees($fichier->extdoc);
			  		$donnee->create();
			  		$j++;
			  	}
			  	break;
			  	
	    	case "doc_view":
	    		$numdoc=$data["numdoc"];
	    		$titredoc=$data["titredoc"];
	    		$numtache=$data["numtache"];
	    		
	    		$form=new Formulaire();
	    		$form->setNumdoc($numdoc);
	    		$form->setTitredoc($titredoc);
			   	$form->setTagdoc($form->addTag("Mon"));	
			   	$form->setDatecreation();
			   	$form->setHeurecreation();
			   	$form->setCodeuser($codeuser);
			   	$form->setNumtache($numtache);
			   	
			   	$form->modify();
			   	
			   	if (trim($champ_fichier)!=""){ //Vérifie que le champ de pièce jointe n'est pas vide
			   		$i=1;
			   		$filename=array_pop(explode(DS,$champ_fichier));
			   		$extension=strrchr($filename,'.');
			   		$extension=substr($extension,1);
			   		
			   		$fichier=new Numerique();
			   		
			   		$fichier->setNumfich(1);
			   		$fichier->setLibfich("Fichier ".$i);$i++;
			   		$fichier->setExtension($extension);
			   		$fichier->setAuteurfich($codeuser);
			   		$fichier->setTagdoc("test");
			   		$fichier->setDateImportation();
			   		$fichier->setHeureImportation();
			   		$fichier->setNumdoc($form->numdoc);
			   		$fichier->setChemin_acces($siteweb->get_document_root()."/upload");
			   		
			   		$fichier->importer($siteweb->get_document_root().DS."document","chemin_acces");
			   		
			  	}  	
			  	$result=$form->create();
			  	
				if ($result) {
					$lalert = 	"<dl id=\"system-message\"><dd class=\"message\"><ul><li>". $translate["utilisateur_create_success"] ."</li></ul></dd></dl>";	
		   		}
		   		else {
		   			$lalert = 	"<dl id=\"system-message\"><dd class=\"error\"><ul><li>". $translate["utilisateur_create_failure"] ."</li></ul></dd></dl>";	
		   		}
				//si appel depuis AJAX
				if (intval($lajax) == 1){
					//afficher une alerte
				   	die($lalert);
				}
			  	
			  	/*//Boucler sur tous les champs du formulaire
			  	$chp=new champ();
			  	$donnee=new donnees();
			  	$j=1;
			  	foreach ($liste_element as $info_element){
			  		$info=explode($info_element,"/");
			  		$chp->setNumchamp($j);		
			  		$chp->setTypechamp($info[1]);
			  		$chp->setNumdoc($form->numdoc);
			  		$chp->create(); 
			  		
			  		$donnee->setNumdonnees($j);
			  		$donnee->setValeurdonnees($info[0]);
			  		$donnee->setTypedonnees($fichier->extdoc);
			  		$donnee->create();
			  		$j++;
			  	}*/
	    		break;
    }
?>