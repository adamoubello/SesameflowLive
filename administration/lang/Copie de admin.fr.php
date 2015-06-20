<?php
/**
 * @version		1.0
 * @package		Administration
 * @subpackage	I18N
 * @copyright (C) 2009 INTERFACE SA. Tous droits réservés
 * @license		INTERFACE SA
 * @author 		xaverie
 * @desc		Script de traduction des libellés du module Configuration en langue francaise
 * @updates
 */


 if (is_null($translate)) $translate = array();

	$translate["action"] = htmlspecialchars('action');
	$translate["activer"] = htmlspecialchars('activer');
	
	
	
	
    $translate["circuit_search"] = htmlspecialchars("Recherche de circuit");
    $translate["circuit_view"] = htmlspecialchars("Consultation de circuit");
    $translate["circuit_create"] = htmlspecialchars("Création de circuit");
    $translate["circuit_create_valid"] = htmlspecialchars("Validation création de circuit");
    $translate["circuit_update_valid"] = htmlspecialchars("Validation modification de circuit");
    $translate["circuit_delete_valid"] = htmlspecialchars("Validation suppression de circuit");
    
    $translate["config"] = htmlspecialchars('config');
    
    $translate['database']	= htmlspecialchars('base de données');	 	
	$translate['databasepaie']	= htmlspecialchars('base de données de SESAME PAIE');
	$translate["databaserh"]	= htmlspecialchars('base de données de SESAME RH');	 	
	$translate["description"] = htmlspecialchars('description');
	$translate["desactiver"] = htmlspecialchars('désactiver');
	

    $translate["dep_search"]= htmlspecialchars("Recherche de service");
    $translate["dep_view"]= htmlspecialchars("Consultation de service");
    $translate["dep_create"]= htmlspecialchars("Création de service");
    $translate["dep_create_valid"]= htmlspecialchars("Validation création de service");
    $translate["dep_update_valid"]= htmlspecialchars("Validation modification de service");
    $translate["dep_delete_valid"]= htmlspecialchars("Validation suppression de service");

    $translate["doc_search"] = htmlspecialchars("Recherche de document");
    $translate["doc_view"] = htmlspecialchars("Consultation de document");
    $translate["doc_create"] = htmlspecialchars("Création de document");
    $translate["doc_create_valid"] = htmlspecialchars("Validation création de document");
    $translate["doc_update_valid"] = htmlspecialchars("Validation modification de document");
    $translate["doc_delete_valid"] = htmlspecialchars("Validation suppression de document");

    $translate["droa_search"]= htmlspecialchars("Recherche de droit");
    $translate["droa_view"]= htmlspecialchars("Consultation de droit");
    $translate["droa_create"]= htmlspecialchars("Création de droit");
    $translate["droa_update_valid"]= htmlspecialchars("Validation modification de droit");

    $translate["groupe_search"]= htmlspecialchars("Recherche de groupe");
    $translate["groupe_view"]= htmlspecialchars("Consultation de groupe");
    $translate["groupe_create"]= htmlspecialchars("Création de groupe");
    $translate["groupe_create_valid"]= htmlspecialchars("Validation création de groupe");
    $translate["groupe_update_valid"]= htmlspecialchars("Validation modification de groupe");
    $translate["groupe_delete_valid"]= htmlspecialchars("Validation suppression de groupe");
    
    $translate['identifiant']	= htmlspecialchars('identifiant');
	$translate['identifiant_acces_bd_paie']	= htmlspecialchars("identifiant de la base de données SESAME PAIE");
	$translate["identifiant_acces_bd_rh"]	= htmlspecialchars("identifiant de la base de données SESAME RH");		
	$translate["interfacage"] = htmlspecialchars('interfaçage');
	$translate['interfacage_paie']	= htmlspecialchars('interfaçage avec SESAME PAIE');
	$translate["interfacage_rh"]	= htmlspecialchars('interfaçage avec SESAME RH');
	
    
    $translate['longueur_liste']	= htmlspecialchars('Nombre de lignes par grille');	 	

    $translate["mail_search"]= htmlspecialchars("Recherche de mail");
    $translate["mail_view"]= htmlspecialchars("Consultation de mail");
    $translate["mail_create"]= htmlspecialchars("Création de mail");
    $translate["mail_create_valid"]= htmlspecialchars("Validation création de mail");
    $translate["mail_update_valid"]= htmlspecialchars("Validation modification de mail");
    $translate["mail_delete_valid"]= htmlspecialchars("Validation suppression de mail");
	$translate["mail_archive"]= htmlspecialchars("archive des mails");
	$translate["mail_param"]= htmlspecialchars("paramètres des mails");
	$translate["mail_param_save"]= htmlspecialchars("enregistrement des paramètres des mails");
	$translate["mail_historic"]= htmlspecialchars("historique des mails");
	$translate["mail_send_valid"]= htmlspecialchars("envoie de mails");
	$translate["mail_log"]= htmlspecialchars("historique d'envoie de mails");
	
	$translate['nom_serveur']	= htmlspecialchars('hôte');	
	$translate['nom_serveur_site']	= htmlspecialchars("hôte de l'application");	
	$translate['nom_serveur_bd_paie']	= htmlspecialchars('hôte de la base de données de SESAME PAIE');
	$translate["nom_serveur_bd_rh"]	= htmlspecialchars('hôte de la base de données de la SESAME RH');	
	$translate['notifier_email_receiver']	= htmlspecialchars('Envoyer une notification par mail au récepteur');
		
	$translate['param_base_donnee']	= htmlspecialchars('Paramètres de la base de données');
	$translate["param_du_site"] = htmlspecialchars('Paramètres du site');
	$translate["param_du_workflow"] = htmlspecialchars('Paramètres du workflow');
	$translate["passwordpaie"] = htmlspecialchars('mot de passe');
	$translate["passwordrh"] = htmlspecialchars('mot de passe');
		
	$translate["processus_search"]	=  htmlspecialchars("Recherche de processus");
	$translate["processus_view"]	=  htmlspecialchars("Consultation de processus");
	$translate["processus_create"]	=  htmlspecialchars("Création de processus");
    $translate["processus_create_valid"] = htmlspecialchars("Validation création de processus");
    $translate["processus_update_valid"] = htmlspecialchars("Validation modification de processus");
    $translate["processus_delete_valid"] = htmlspecialchars("Validation suppression de processus");

	$translate["profi_search"]= htmlspecialchars("Recherche de fonction");
    $translate["profi_view"]= htmlspecialchars("Consultation de fonction");
    $translate["profi_create"]= htmlspecialchars("Création de fonction");
    $translate["profi_create_valid"]= htmlspecialchars("Validation création de fonction");
    $translate["profi_update_valid"]= htmlspecialchars("Validation modification de fonction");
    $translate["profi_delete_valid"]= htmlspecialchars("Validation suppression de fonction");

    $translate["tache_search"] = htmlspecialchars("Recherche de tâche");
    $translate["tache_view"] = htmlspecialchars("Consultation de tâche");
    $translate["tache_create"] = htmlspecialchars("Création de tâche");
    $translate["tache_create_valid"] = htmlspecialchars("Validation création de tâche");
    $translate["tache_update_valid"] = htmlspecialchars("Validation modification de tâche");
    $translate["tache_delete_valid"] = htmlspecialchars("Validation suppression de tâche");
    
    $translate['tester_connexion']	= htmlspecialchars('Tester la connexion');
    $translate['type_base_donnee']	= htmlspecialchars('Type de base de données');
    $translate["type_base_donnee_rh"] =	htmlspecialchars('Type de la base de données de SESAME RH');
	$translate['type_base_donnee_paie']	= htmlspecialchars('Type de la base de données de SESAME PAIE');
	
	$translate['unite_duree']	= htmlspecialchars('Unité de la durée(processus, circuit, tâche)');	 	
	$translate['unite_duree_tache']	= htmlspecialchars("Unité de la durée d'une tâche");	 	
	$translate['unite_duree_process']	= htmlspecialchars("Unité de la durée d'un processus");	 	
	$translate['unite_duree_circuit']	= htmlspecialchars("Unité de la durée d'un circuit");	 	
    
    $translate["user_search"] = htmlspecialchars("Recherche d'utilisateur");
    $translate["user_view"] = htmlspecialchars("Consultation d'utilisateur");
    $translate["user_create"] = htmlspecialchars("Création d'utilisateur");
    $translate["user_create_valid"] = htmlspecialchars("Validation création d'utilisateur");
    $translate["user_update_valid"] = htmlspecialchars("Validation modification d'utilisateur");
    $translate["user_delete_valid"]= htmlspecialchars("Validation suppression d'utilisateur");

    $translate["workflow_search"]= htmlspecialchars("Recherche de workflow");
    $translate["workflow_view"]= htmlspecialchars("Consultation de workflow");
    $translate["workflow_create"]= htmlspecialchars("Création de workflow");
    $translate["workflow_create_valid"]= htmlspecialchars("Validation création de workflow");
    $translate["workflow_update_valid"]= htmlspecialchars("Validation modification de workflow");
    $translate["workflow_delete_valid"]= htmlspecialchars("Validation suppression de workflow");

    $translate["processus"]= htmlspecialchars("processus");
    $translate["circuit"]= htmlspecialchars("circuit");
    $translate["tache"]= htmlspecialchars("tâche");
    $translate["document"]= htmlspecialchars("document");
    $translate["utilisateur"]= htmlspecialchars("utilisateur");
    $translate["groupe"]= htmlspecialchars("groupe");
    $translate["departement"]= htmlspecialchars("service");
    $translate["workflow"]= htmlspecialchars("workflow");
    $translate["fonction"]= htmlspecialchars("fonction");
    $translate["mail"]= htmlspecialchars("mail");
    $translate["droit"]= htmlspecialchars("droit");
    
    $translate["enregistrer"]= htmlspecialchars("enregistrer");
    $translate["annuler"]= htmlspecialchars("annuler");
    $translate["mssql"]= htmlspecialchars("Microsoft SQL Server");
    $translate["mysql"]= htmlspecialchars("MySQL");
    $translate["oci8"]= htmlspecialchars("Oracle");
    
    $translate["port"]= htmlspecialchars("port");

?>
