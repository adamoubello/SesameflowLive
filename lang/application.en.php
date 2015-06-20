<?php

/**
 * @version		1.0
 * @package		Administration
 * @subpackage	I18N (Gestion de l'internationnalisation)
 * @copyright (C) 2009 INTERFACE SA. Tous droits réservés
 * @license		INTERFACE SA
 * @author 		patrick mveng<patrick.mveng@interfacesa.local>
 * @updates
 */
 
 global $translate;  
 
 if (is_null($translate)) $translate = array();
 
	$translate["nomuser"]	=  htmlspecialchars("first name");
	$translate["prenomuser"]	=  htmlspecialchars("second name");
	$translate["emailuser"]	=  htmlspecialchars("email");
	$translate["loginuser"]	=  htmlspecialchars("login");
	$translate["passworduser"]	=  htmlspecialchars("password");
	$translate["passworduser1"]	=  htmlspecialchars("confirm password");
	$translate["numteluser"]	=  htmlspecialchars("mobile phone");
	$translate["numburuser"]	=  htmlspecialchars("téléphone fixe bureau");
	$translate["numfaxuser"]	=  htmlspecialchars("fax");
	$translate["datenaissanceuser"]	=  htmlspecialchars("date of birth");
    $translate["typeuser"]	=  htmlspecialchars("type");
	$translate["seltypeuser"]	=  htmlspecialchars("sélect un type");
	$translate["categorieuser"]	=  htmlspecialchars("category");
	$translate["selcategorieuser"]	=  htmlspecialchars("sélectionnez un catégorie");
	$translate["villeuser"]	=  htmlspecialchars("city");
	$translate["paysuser"]	=  htmlspecialchars("town");
 

	$translate["acteur"]	=  htmlspecialchars("acteur");
	$translate["any_droit_found"]	=  htmlspecialchars("No permission exists ");
	$translate["any_log_found"]     =  htmlspecialchars(" Historique is empty !");
	$translate["any_groupe_found"]	=  htmlspecialchars("No group exists ");
	$translate["any_tache_found"]	=  htmlspecialchars("No task exists");
	$translate["any_processus_found"]	=  htmlspecialchars("No process found ");
	$translate["any_circuit_found"]	=  htmlspecialchars("Aucun circuit n'existe ");
	$translate["any_user_found"]	=  htmlspecialchars("Any user exists");
	$translate["any_dep_found"]	=  htmlspecialchars("No service found");
	$translate["any_doc_found"]	=  htmlspecialchars("No document found ");
	$translate["any_mail_found"]	=  htmlspecialchars("There is no mail found for you");
	$translate["any_profil_found"]	=  htmlspecialchars("No profile found");
	$translate["any_workflow_found"]	=  htmlspecialchars("No workflow found");
	$translate["aucun"]	=  htmlspecialchars("any");
	$translate["aucun_fichier_uploaded"] = htmlspecialchars("No file uploaded");	
	$translate["aucune"]	=  htmlspecialchars("any");
	$translate["annuler"]	=  htmlspecialchars("cancel");
	$translate["archive"] = htmlspecialchars("Archivé");
	$translate["archives"] = htmlspecialchars("Archive");
	$translate["archiver"] = htmlspecialchars("archiver");
	$translate["Archive"] = htmlspecialchars("Archived");
	$translate["auteur"] = htmlspecialchars("author");
	$translate["accueil"]	=  htmlspecialchars("homepage");	
	$translate["aide"] = htmlspecialchars("help");
	$translate["administration"] = htmlspecialchars("setting");
	$translate["active"]	=  htmlspecialchars("activate");
	$translate["au"] =  htmlspecialchars ("to");
	$translate['a'] =  htmlspecialchars ("to");
	$translate["activation_valid_success"]	=  htmlspecialchars("Activation succeeded");		
		
	$translate["bienvenue"]	=  htmlspecialchars("Welcome");
	 
	$translate["champs_obligatoires"]	=  htmlspecialchars("Mandatory fields");	
	$translate["choisissez"]	=  htmlspecialchars("choose");
	$translate["connexion_valid_success"] = ("Connection succeeded");
	$translate["contient"]	=  htmlspecialchars("contient");
	$translate["configuration"]	=  htmlspecialchars("setup");
	$translate["consultation"]	=  htmlspecialchars("edit");
	$translate["code"]	=  htmlspecialchars("code");
	$translate["circulation"] = htmlspecialchars("circulation");
	$translate["circuit"] = htmlspecialchars("circuit");
	$translate["creer"]	=  htmlspecialchars("crate");	
	$translate["creer_processus"] = htmlspecialchars("Process creation");
	$translate["creer_tache"] = htmlspecialchars("Task creation");
	$translate["creer_circuit"] = htmlspecialchars("Création d'un circuit");
	$translate["creer_workflow"] = htmlspecialchars("Création d'un workflow");	
	$translate["creer_dep"] = htmlspecialchars("Création d'un département");
	$translate["csv"] = htmlspecialchars("csv");	
	$translate["csv_file"] = htmlspecialchars("CSV File");	
			
	$translate["date_creation"] = htmlspecialchars("Creation Date");
	$translate["dde_credit"] = htmlspecialchars("Demande de crédit");
	$translate["dde_conge"] = htmlspecialchars("Demande de congé");
	$translate["deconnexion"] = htmlspecialchars("sign out");
	$translate["delete_valid_success"] = htmlspecialchars("Deleted succeeded !");	
	$translate["desactivation_valid_success"]	=  htmlspecialchars("desactivation succeeded");		
    $translate["detail"]	=  htmlspecialchars("detail");	
	$translate["document"] = htmlspecialchars("document");
	$translate["departement"] = htmlspecialchars("department");	
	$translate["droit_acces"] = htmlspecialchars("right");		
	$translate["droit"] = htmlspecialchars("droit");	
	$translate["demande_credit"] = htmlspecialchars("demande de crédit");
	$translate["duree"]	=  htmlspecialchars("durée");
	$translate["desactive"]	=  htmlspecialchars("deactivated");
	//$translate['du'] = htmlspecialchars("from");
		
	$translate["equals_to"]	=  htmlspecialchars("equals to");
	$translate["enregistrer"]	=  htmlspecialchars("save");
	$translate["etape"]	=  htmlspecialchars("étape");
	$translate["etat"]	=  htmlspecialchars("state");
	$translate["error_move_file"]	=  htmlspecialchars("Error move file");
	$translate["exporter"]	=  htmlspecialchars("exporter");
	$translate["exportation"]	=  htmlspecialchars("exportation");
	$translate["excel_file"] = htmlspecialchars("Excel File");	

	
	$translate["fermer"]	=  htmlspecialchars("close");
	$translate["file_wasnt_uploaded"]	=  htmlspecialchars("File was not uploaded");
	$translate['Filtre_Recherche']      =  htmlspecialchars("Search Filter");	
	
	$translate["gestion_electronic_doc"] = htmlspecialchars("Document management");
	
	$translate["heure_creation"] = htmlspecialchars("Heure création");	
	$translate["historique"]	=  htmlspecialchars("log");
	
	$translate["info_bulle_gestion_profil"]	=  htmlspecialchars("Afficher ou rechercher les informations sur les profils d'utilisateurs");		
	$translate["info_bulle_workflow"]	=  htmlspecialchars("Afficher ou rechercher les informations sur les instances de workflow");		
	$translate["info_bulle_processus"]	=  htmlspecialchars("Afficher ou rechercher les informations sur les processus");		
	$translate["info_bulle_processus"]	=  htmlspecialchars("Afficher ou rechercher les informations sur les tâches");		
	$translate["info_bulle_circuit"]	=  htmlspecialchars("Modèles de circulation");		
	$translate["info_bulle_tache"]	=  htmlspecialchars("Afficher ou rechercher les informations sur les tâches");		
	$translate["info_bulle_document"]	=  htmlspecialchars("Afficher ou rechercher les informations sur les documents");		
	$translate["info_bulle_departement"]	=  htmlspecialchars("Afficher ou rechercher les informations sur les départements");		
	$translate["info_bulle_utilisateur"]	=  htmlspecialchars("Afficher ou rechercher les informations sur les utilisateurs");		
	$translate["info_bulle_droit"]	=  htmlspecialchars("Contrôle des droits d'accès d'utilisateurs");	
	$translate["insertion_valid_success"] = ("Insertion succeeded !");	
	$translate["insertion_valid_errror"] = ("Insertion failed !");
	$translate["interfacage"] =  htmlspecialchars("interface");
	

	$translate["func_mail_php"]	=  htmlspecialchars("PHP mail Function ");
	$translate["fonction"] = htmlspecialchars("occupation");	
	
	$translate["groupe"]	=  htmlspecialchars("group");
			
	$translate["heure"]	=  htmlspecialchars("hour");		
	
	$translate["jour"]	=  htmlspecialchars("day");		
	$translate["Joined"] = htmlspecialchars("Importé");
	
	$translate["libelle"]	=  htmlspecialchars("label");
	$translate["lib_reglages_email"]=  htmlspecialchars("Mail settings");
	$translate["logicieldistribue"] = htmlspecialchars("sésameflow est un logiciel distribué par la société");
	
	$translate["mail"]	=  htmlspecialchars("mail");
	$translate["mail_log"]	=  htmlspecialchars("Log");
	$translate["mes_taches"]	=  htmlspecialchars("My Tasks");	
	$translate["modification_profil"]	=  htmlspecialchars("Modification d'un profil");
	$translate["modification_processus"]	=  htmlspecialchars("modification d'un processus");
	$translate["modification_tache"]	=  htmlspecialchars("modification d'une tâche");
	$translate["modification_user"]	=  htmlspecialchars("modification d'un utilisateur");
	$translate["modification_circuit"]	=  htmlspecialchars("modification d'un circuit");
	$translate["modification_droit"]	=  htmlspecialchars("modification d'un droit");
	$translate["modification_workflow"]	=  htmlspecialchars("modification d'un workflow");
	$translate["modifier"]	=  htmlspecialchars("update");
	$translate["module"]	=  htmlspecialchars("module");
	$translate["mois"]	=  htmlspecialchars("month");
	
	$translate["nouveau"] = htmlspecialchars("new");
	$translate["nouvelle"] = htmlspecialchars("new");
	$translate["numero"]	=  htmlspecialchars("code");
	$translate["nofileexists"]= htmlspecialchars("No file exists");	
	$translate["non"]= htmlspecialchars("No");
	$translate["no_rigth_for_this_functionnality"]= htmlspecialchars("Access forbidden.You try to access to a page, feature {%do%} that is not allowed to your user.");	
	$translate["no_rigth_for_this_functionnality_ajax"]= htmlspecialchars("Access forbidden.You try to access to a page, feature that is not allowed to your user.");	
	
	$translate["oui"]= htmlspecialchars("yes");	
	$translate["ou"]= htmlspecialchars("or");	
	$translate["options"]= htmlspecialchars("options");	
	$translate["op_workflow"]= htmlspecialchars("opérations sur le workflow");	
	$translate["op_gestion"]= htmlspecialchars("opérations sur les documents");	
	$translate["op_utilisateur"]= htmlspecialchars("opérations sur les utilisateurs");	
	$translate["op_administration"]= htmlspecialchars("opérations administratives");
	$translate["on"] = htmlspecialchars("to");
				
	$translate['paging_abtract']	= htmlspecialchars('Result(s) {%start%} from {%end%} to {%total%}');	
	$translate['parametres']	= htmlspecialchars('settings');	 	
	$translate["par_titre"] = htmlspecialchars("Title"); 
	$translate['par_tag'] = htmlspecialchars("Tag");
	
	$translate['password']	= htmlspecialchars('password');	 		
	$translate["permission"] = htmlspecialchars("right");			
    $translate["prefixed_by"]	=  htmlspecialchars("commençant par");
	$translate["postfixed_by"]	=  htmlspecialchars("se terminant par");
	$translate["profil"] = htmlspecialchars("profile");
	$translate["processus"] = htmlspecialchars("process");	
	$translate["precedent"] = htmlspecialchars("previous");
	
	$translate["recommencer"]	=  htmlspecialchars("reset");
	$translate["rechercher"]	=  htmlspecialchars("search");
	$translate["recherche"]	=  htmlspecialchars("search");
	$translate["recherche_processus"]	=  htmlspecialchars("Process search");
	$translate["resultat"] = htmlspecialchars("result(s)");
	
	$translate["recherche_doc"] = htmlspecialchars("Document search");
	
	$translate["sesameflow_powered_by_interfacesa"] = htmlspecialchars("Sesameflow is powered by ")."<a  target=\"_blank\" href=\"http://www.interfacesa.com\">INTERFACE SA</a>";		
	$translate["selection"] = htmlspecialchars("selection");
	$translate["supprimer"] = htmlspecialchars("delete");
	$translate["send_en_html"]	=  htmlspecialchars("PHP mail"); 
	$translate["sendmail"]	=  htmlspecialchars("sendmail"); 
	$translate["serveur_smtp"]	=  htmlspecialchars("SMTP Server"); 
	$translate["suivant"]	=  htmlspecialchars("next"); 
	
	$translate["serveur_de_mail"]	=  htmlspecialchars("Mail server"); 
	$translate["adresse_expéditeur"]	=  htmlspecialchars("Sender's adress"); 
	$translate["nom_expéditeur"]	=  htmlspecialchars("Sender's Name"); 
	$translate["chemin_accès_sendmail"]	=  htmlspecialchars("Path of sendmail"); 
    $translate["identification_SMTP_requise"]	=   htmlspecialchars("SMTP Identification required"); 
	$translate["utilisateur_SMTP"]	=  htmlspecialchars("SMTP User"); 
	$translate["mot_de_passe_SMTP"]	=  htmlspecialchars("SMTP Password"); 
	$translate["hôte_SMTP"]	=  htmlspecialchars("SMTP Host"); 	
    
	$translate["tache"] = htmlspecialchars("task");
	$translate["taches"] = htmlspecialchars("tasks");
	$translate["taille_depasse_max_srv"] = htmlspecialchars("Max size allowed on the server overloaded");	
	$translate["todo"] = htmlspecialchars("ToDo");
	$translate["titre"] = htmlspecialchars("title");
	$translate["tout"] = htmlspecialchars("all");
	$translate["type_doc"] = htmlspecialchars("Document type");
		
	$translate["unite"] = htmlspecialchars("unit");
	$translate["update_valid_success"] = ("Update succeeded");
	$translate["utilisateur"] = htmlspecialchars("user");
	$translate["utilisateur SMTP"]	=  htmlspecialchars("SMTP User");
	
	$translate["valider"] = htmlspecialchars("validate");	
	
	$translate["xml"] = htmlspecialchars("xml");
	$translate["xml_file"] = htmlspecialchars("XML File");
	$translate["xls"] = htmlspecialchars("xls");
	
	$translate["workflow"] = htmlspecialchars("workflow");
?>