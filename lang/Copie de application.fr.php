<?php

/**
 * @version		1.0
 * @package		Administration
 * @subpackage	I18N (Gestion de l'internationnalisation)
 * @copyright (C) 2009 INTERFACE SA. Tous droits réservés
 * @license		INTERFACE SA
 * @author 		Bello
 * @updates
 * 	# samedi 20 juin 2009 (Patrick Mveng)
 * 		- suppression de ! dans l'instruction if (is_null($translate)) $translate = array();
 *   Cette dernière réinitialisait le tablau et écrasait les libellés existant en mémoire
 * 
 * @updates
 * 	# vendredi 24 juillet 2009 (Raoûl Ngambia)
 * 		- ajout de la variable de traduction mail pour son occurence dans le menu de droite
 *   Sans celle-ci libellé "mail" ne s'affichait pas dans le menu de droite
 * 
 * @updates
 * 	# vendredi 31 juillet 2009 (Raoûl Ngambia)
 * 		- ajout des traductions pour les pages mail_create et mail_param,
 *     pour affichage des titres dans la partie centrale et le menu centrale
 *   
 */
 
 global $translate;  
 
 if (is_null($translate)) $translate = array();
 
	$translate["nomuser"]	=  htmlspecialchars("nom");
	$translate["prenomuser"]	=  htmlspecialchars("prénom");
	$translate["emailuser"]	=  htmlspecialchars("email");
	$translate["loginuser"]	=  htmlspecialchars("login");
	$translate["passworduser"]	=  htmlspecialchars("mot de passe");
	$translate["passworduser1"]	=  htmlspecialchars("confirmer le mot de passe");
	$translate["numteluser"]	=  htmlspecialchars("téléphone portable");
	$translate["numburuser"]	=  htmlspecialchars("téléphone fixe bureau");
	$translate["numfaxuser"]	=  htmlspecialchars("numéro fax");
	$translate["datenaissanceuser"]	=  htmlspecialchars("date de naissance");
    $translate["typeuser"]	=  htmlspecialchars("type");
	$translate["seltypeuser"]	=  htmlspecialchars("sélectionnez un type");
	$translate["categorieuser"]	=  htmlspecialchars("catégorie");
	$translate["selcategorieuser"]	=  htmlspecialchars("sélectionnez une catégorie");
	$translate["villeuser"]	=  htmlspecialchars("ville");
	$translate["paysuser"]	=  htmlspecialchars("pays");
 

	$translate["acteur"]	=  htmlspecialchars("acteur");
	$translate["activation_valid_success"]	=  ("Activation effectu&eacute;e avec succ&egrave;s");
	$translate["any_droit_found"]	=  htmlspecialchars("Aucun droit n'existe ");
	$translate["any_log_found"]     =  htmlspecialchars("Pas d'historique existant!");
	$translate["any_groupe_found"]	=  htmlspecialchars("Aucun groupe n'existe ");
	$translate["any_tache_found"]	=  htmlspecialchars("Aucune tâche n'existe ");
	$translate["any_processus_found"]	=  htmlspecialchars("Aucun processus n'existe ");
	$translate["any_circuit_found"]	=  htmlspecialchars("Aucun circuit n'existe ");
	$translate["any_user_found"]	=  htmlspecialchars("Aucun utilisateur n'existe ");
	$translate["any_dep_found"]	=  htmlspecialchars("Aucun service n'existe ");
	$translate["any_doc_found"]	=  htmlspecialchars("Aucun document n'existe ");
	$translate["any_mail_found"]	=  htmlspecialchars("Vous n'avez pas de mail dans votre boîte");
	$translate["any_profil_found"]	=  htmlspecialchars("Aucune fonction n'existe ");
	$translate["any_workflow_found"]	=  htmlspecialchars("Aucun workflow n'existe ");
	$translate["aucun"]	=  htmlspecialchars("aucun");
	$translate["aucune"]	=  htmlspecialchars("aucune");
	$translate["annuler"]	=  htmlspecialchars("annuler");
	$translate["archive"] = htmlspecialchars("Archivé");
	$translate["archiver"] = htmlspecialchars("archiver");
	$translate["Archive"] = htmlspecialchars("Archivé");
	$translate["archives"]	=  htmlspecialchars("archives");
	$translate["aucun_fichier_uploaded"] = htmlspecialchars("Aucun fichier n'a été téléchargé");
	$translate["auteur"] = htmlspecialchars("auteur");
	$translate["accueil"]	=  htmlspecialchars("accueil");	
	$translate["aide"] = htmlspecialchars("Aide");
	$translate["administration"] = htmlspecialchars("administration");
	$translate["active"]	=  htmlspecialchars("activé");
	$translate["au"] =  htmlspecialchars ("au");
	$translate['a'] =  htmlspecialchars ("à");
	
	$translate["bienvenue"]	=  htmlspecialchars("Bienvenue");
	 
	$translate["choisissez"]	=  htmlspecialchars("choisissez");
	$translate["contient"]	=  htmlspecialchars("contient");
	$translate["configuration"]	=  htmlspecialchars("configuration");
	$translate["config_general"]	=  htmlspecialchars("Configuration générale");
	$translate["connexion_valid_error"]	=  htmlspecialchars("Identifiant ou mot de passe inexistant");
	$translate["consultation"]	=  htmlspecialchars("consultation");
	$translate["code"]	=  htmlspecialchars("code");
	$translate["circulation"] = htmlspecialchars("circulation");
	$translate["circuit"] = htmlspecialchars("circuit");
	$translate["creer"]	=  htmlspecialchars("créer");	
	$translate["creer_processus"] = htmlspecialchars("Création d'un processus");
	$translate["creer_tache"] = htmlspecialchars("Création d'une tâche");
	$translate["creer_circuit"] = htmlspecialchars("Création d'un circuit");
	$translate["creer_workflow"] = htmlspecialchars("Création d'un workflow");	
	$translate["creer_dep"] = htmlspecialchars("Création d'un département");
	$translate["csv"] = htmlspecialchars("csv");	
	$translate["csv_file"] = htmlspecialchars("Fichier CSV");
	$translate["creation"] = htmlspecialchars("création");
	
	$translate["date_creation"] = htmlspecialchars("Date création");
	$translate["date_envoi"] = htmlspecialchars("Date d'envoi");
	
	$translate["dde_credit"] = htmlspecialchars("Demande de crédit");
	$translate["dde_conge"] = htmlspecialchars("Demande de congé");
	$translate["deconnexion"] = htmlspecialchars("déconnexion");
	$translate["delete_valid_success"] = htmlspecialchars("Suppression effectuée avec succès");
    $translate["detail"]	=  htmlspecialchars("detail");	
    $translate["destinataire"]	=  htmlspecialchars("destinataire");
	$translate["document"] = htmlspecialchars("document");
	$translate["departement"] = htmlspecialchars("service");	
	$translate["droit_acces"] = htmlspecialchars("droit d'accès");		
	$translate["droit"] = htmlspecialchars("droit");	
	$translate["demande_credit"] = htmlspecialchars("demande de crédit");
	$translate["duree"]	=  htmlspecialchars("durée");
	$translate["desactive"]	=  htmlspecialchars("désactivé");
	$translate["desactivation_valid_success"]	=  ("D&eacute;sactivation effectu&eacute;e avec succ&egrave;s");	
	
		
	$translate["equals_to"]	=  htmlspecialchars("est égal à");
	$translate["enregistrer"]	=  htmlspecialchars("enregistrer");
	$translate["etape"]	=  htmlspecialchars("étape");
	$translate["etat"]	=  htmlspecialchars("etat");
	$translate["error_move_file"]	=  htmlspecialchars("Erreur déplacement de fichier");
	$translate["excel_file"]	=  htmlspecialchars("Fichier Excel");
	$translate["exporter"]	=  htmlspecialchars("exporter");
	$translate["exportation"]	=  htmlspecialchars("exportation vers");
	
	
	$translate["fermer"]	=  htmlspecialchars("Fermer");
	$translate["file_wasnt_uploaded"]	=  htmlspecialchars("Le fichier n'a pas été téléchargé");	
	$translate['Filtre_Recherche']      =  htmlspecialchars("Filtre Recherche");	
	$translate["func_mail_php"]	=  htmlspecialchars("Fonction mail PHP");
	
	$translate["gestion_electronic_doc"] = htmlspecialchars("gestion documentaire");
	$translate["groupe_create"] = htmlspecialchars("Création de groupe");
	
	$translate["heure_creation"] = htmlspecialchars("Heure création");	
	$translate["heure"]	=  htmlspecialchars("heure");	
	$translate["historique"]	=  htmlspecialchars("historique");
	
	$translate["info_bulle_gestion_profil"]	=  htmlspecialchars("Afficher ou rechercher les informations sur les profils d'utilisateurs");		
	$translate["info_bulle_workflow"]	=  htmlspecialchars("Afficher ou rechercher les informations sur les instances de workflow");		
	$translate["info_bulle_processus"]	=  htmlspecialchars("Afficher ou rechercher les informations sur les processus");		
	$translate["info_bulle_processus"]	=  htmlspecialchars("Afficher ou rechercher les informations sur les tâches");		
	$translate["info_bulle_circuit"]	=  htmlspecialchars("Modèles de circulation");		
	$translate["info_bulle_tache"]	=  htmlspecialchars("Afficher ou rechercher les informations sur les tâches");		
	$translate["info_bulle_document"]	=  htmlspecialchars("Afficher ou rechercher les informations sur les documents");		
	$translate["info_bulle_departement"]	=  htmlspecialchars("Afficher ou rechercher les informations sur les services");		
	$translate["info_bulle_utilisateur"]	=  htmlspecialchars("Afficher ou rechercher les informations sur les utilisateurs");		
	$translate["info_bulle_droit"]	=  htmlspecialchars("Contrôle des droits d'accès d'utilisateurs");
	$translate["info_bulle_config_unite_duree"]	=  htmlspecialchars("Cliquez ici pour modifier l'unité de la durée");
			
	$translate["interfacage"] =  htmlspecialchars("interfaçage");
	
	$translate["insert_valid_success"] = ("Ajout effectu&eacute; avec succ&egrave;s");
	$translate["insert_valid_error"] = ("Erreur ajout");
	$translate['Recommencer']=("Recommencer");
	
	$translate["fonction"] = htmlspecialchars("fonction");
	
	$translate["groupe"]	=  htmlspecialchars("groupe");		
	
	$translate["jour"]	=  htmlspecialchars("jour");		
	$translate["Joined"] = htmlspecialchars("Importé");
	
	$translate["champs_obligatoires"]	=  htmlspecialchars("Champs obligatoires");
	$translate["libelle"]	=  htmlspecialchars("libellé");
	$translate['lib_reglages_email']=  htmlspecialchars("Réglages des mails");
	$translate["logicieldistribue"] = htmlspecialchars("sésameflow est un logiciel distribué par la société");
	$translate["login"]	=  htmlspecialchars($login);
	
	$translate["mail"]	=  htmlspecialchars("Mail");
	$translate["mail_log"]	=  htmlspecialchars("Log");
	$translate["mes_taches"]	=  htmlspecialchars("Mes Tâches");
	$translate["modification_profil"]	=  htmlspecialchars("Modification d'une fonction");
	$translate["modification_processus"]	=  htmlspecialchars("modification d'un processus");
	$translate["modification_tache"]	=  htmlspecialchars("modification d'une tâche");
	$translate["modification_user"]	=  htmlspecialchars("modification d'un utilisateur");
	$translate["modification_circuit"]	=  htmlspecialchars("modification d'un circuit");
	$translate["modification_droit"]	=  htmlspecialchars("modification d'un droit");
	$translate["modification_workflow"]	=  htmlspecialchars("modification d'un workflow");
	$translate["modifier"]	=  htmlspecialchars("enregistrer");
	$translate["module"]	=  htmlspecialchars("module");
	$translate["mois"]	=  htmlspecialchars("mois");
	
	$translate["nouveau"] = htmlspecialchars("Nouveau");
	$translate["nouvelle"] = htmlspecialchars("nouvelle");
	$translate["numero"]	=  htmlspecialchars("numéro");
	$translate["nofileexists"]= htmlspecialchars("Le fichier à télécharger n'existe pas");
	$translate["non"]= htmlspecialchars("non");
	$translate["no_rigth_for_this_functionnality"]= htmlspecialchars("Accès non autorisé. Vous essayez d'accéder à une page ou à une fonctionnalité {%do%} qui n'est pas autorisée pour votre compte utilisateur.");
	$translate["no_rigth_for_this_functionnality_ajax"]= ("Acc&egrave;s non autoris&eacute;. Vous essayez d'acc&eacute;der &agrave; une page ou &egrave; une fonctionnalit&eacute; qui n'est pas autoris&eacute;e pour votre compte utilisateur.");
	
	$translate["oui"]= htmlspecialchars("oui");	
	$translate["ou"]= htmlspecialchars("ou");	
	$translate["options"]= htmlspecialchars("options");	
	$translate["op_workflow"]= htmlspecialchars("opérations sur le workflow");	
	$translate["op_gestion"]= htmlspecialchars("opérations sur les documents");	
	$translate["op_utilisateur"]= htmlspecialchars("opérations sur les utilisateurs");	
	$translate["op_administration"]= htmlspecialchars("opérations administratives");
	$translate["on"] = htmlspecialchars("sur");	
				
	$translate['page_precedente']	= htmlspecialchars('Page précédente');	 	
	$translate['page_suivante']	= htmlspecialchars('Page suivante');	 	
	$translate['paging_abtract']	= htmlspecialchars('Résultat(s) {%start%} a {%end%} sur {%total%} au total');	 	
	$translate['parametres']	= htmlspecialchars('paramètres');	
	$translate["par_titre"] = htmlspecialchars("Par Titre");  	
	$translate['par_tag'] = htmlspecialchars("Tag");
	$translate['password']	= htmlspecialchars('Mot de passe');	 	
	$translate['permission']	= htmlspecialchars('permission');	 	
    $translate["precedent"]	=  htmlspecialchars("précédent");
    $translate["prefixed_by"]	=  htmlspecialchars("commençant par");
	$translate["postfixed_by"]	=  htmlspecialchars("se terminant par");
	$translate["profil"] = htmlspecialchars("fonction");
	$translate["processus"] = htmlspecialchars("processus");	
	$translate["precedent"] = htmlspecialchars("précédent");
	
	$translate["recommencer"]	=  htmlspecialchars("recommencer");
	$translate["rechercher"]	=  htmlspecialchars("rechercher");
	$translate["recherche"]	=  htmlspecialchars("recherche");
	$translate["recherche_processus"]	=  htmlspecialchars("recherche de processus");
	$translate["resultat"] = htmlspecialchars("résultat(s)");
	
	$translate["recherche_doc"] = htmlspecialchars("Rechercher un document");
	
	
	$translate["sendmail"]	=  htmlspecialchars("sendmail"); 
	$translate["serveur_smtp"]	=  htmlspecialchars("Serveur SMTP"); 
	$translate["serveur_de_mail"]	=  htmlspecialchars("Serveur de mail"); 
	
	$translate["nom_expéditeur"]	=  htmlspecialchars("Nom de l'expéditeur"); 
	$translate["chemin_accès_sendmail"]	=  htmlspecialchars("Chemin d'accès à sendmail"); 
    $translate["identification_SMTP_requise"]	=  htmlspecialchars("Identification SMTP requise"); 
	$translate["utilisateur_SMTP"]	=  htmlspecialchars("Utilisateur SMTP"); 
	$translate["mot_de_passe_SMTP"]	=  htmlspecialchars("Mot de passe SMTP"); 
	$translate["hôte_SMTP"]	=  htmlspecialchars("Hôte SMTP"); 
	
	$translate["rejeter"]	=  htmlspecialchars("rejeter");	
	$translate["sesameflow_powered_by_interfacesa"] = ("SesameFlow est un logiciel distribu&eacute; par la soci&eacute;t&eacute; ")."<a target=\"_blank\" href=\"http://www.interfacesa.com\">INTERFACE SA</a>";	
	$translate["selection"] = htmlspecialchars("selection");
	$translate["suivant"] = htmlspecialchars("suivant");
	$translate["supprimer"] = htmlspecialchars("Supprimer");

	$translate["taille_depasse_max_srv"] = htmlspecialchars("Le fichier téléchargé excède la taille autorisée par le serveur");
	$translate["tache"] = htmlspecialchars("tâche");
	$translate["taches"] = htmlspecialchars("tâches");
	$translate["todo"] = htmlspecialchars("A faire");
	$translate["titre"] = htmlspecialchars("titre");
	$translate["type_doc"] = htmlspecialchars("Type de document");
	$translate["sujet_mail"] = htmlspecialchars("sujet du mail");
	$translate["tout"] = htmlspecialchars("tout");	
	
	$translate["unite"] = htmlspecialchars("unité");
	$translate["update_valid_success"] = ("Modification effectu&eacute;e avec succ&egrave;s");
	$translate["connexion_valid_success"] = ("Connexion effectu&eacute;e avec succ&egrave;s");
	$translate["utilisateur"] = htmlspecialchars("utilisateur");
	
	$translate["valider"] = htmlspecialchars("valider");
	
	$translate["xls"] = htmlspecialchars("Excel");
	$translate["xml"] = htmlspecialchars("xml");
	$translate["xml_file"] = htmlspecialchars("Fichier XML");
	
	$translate["workflow"] = htmlspecialchars("workflow");
	$translate["workflow_delete_valid_success"] = htmlspecialchars("workflow supprimé avec succès");
	
?>