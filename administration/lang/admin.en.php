<?php
/**
 * @version		1.0
 * @package		Administration
 * @subpackage	I18N
 * @copyright (C) 2009 INTERFACE SA. Tous droits réservés
 * 
 * @license		INTERFACE SA
 * @author 		
 * @desc		Script de traduction des libellés du module Configuration en langue anglaise
 * @updates
 */
 
 global $translate;
 
 if (is_null($translate)) $translate = array();
 	
	$translate["action"] = htmlspecialchars('action');
	$translate["activer"] = htmlspecialchars('activate');
	
    $translate["circuit_search"] = htmlspecialchars("circuit search");
    $translate["circuit_view"] = htmlspecialchars("circuit view");
    $translate["circuit_create"] = htmlspecialchars("circuit create");
    $translate["circuit_create_valid"] = htmlspecialchars("circuit create valid");
    $translate["circuit_update_valid"] = htmlspecialchars("circuit update valid");
    $translate["circuit_delete_valid"] = htmlspecialchars("circuit delete valid");
    
    $translate["config"] = htmlspecialchars('config');
    $translate["config_general"]	=  htmlspecialchars("General setup");	
    
    $translate['database']	= htmlspecialchars('Database name');	 	
	$translate['databasepaie']	= htmlspecialchars("database's name SESAME PAIE");
	$translate["databaserh"]	= htmlspecialchars("database's  name SESAME  RH");	 	
	$translate["desactiver"] = htmlspecialchars('deactivate');		
	$translate["description"] = htmlspecialchars('description');

    $translate["dep_search"]= htmlspecialchars("department search");
    $translate["dep_view"]= htmlspecialchars("department view");
    $translate["dep_create"]= htmlspecialchars("department create");
    $translate["dep_create_valid"]= htmlspecialchars("department create valid");
    $translate["dep_update_valid"]= htmlspecialchars("department update valid");
    $translate["dep_delete_valid"]= htmlspecialchars("department delete valid");

    $translate["doc_search"] = htmlspecialchars("document search");
    $translate["doc_view"] = htmlspecialchars("document view");
    $translate["doc_create"] = htmlspecialchars("document create");
    $translate["doc_create_valid"] = htmlspecialchars("document create valid");
    $translate["doc_update_valid"] = htmlspecialchars("document update valid");
    $translate["doc_delete_valid"] = htmlspecialchars("document delete valid");

    $translate["droa_search"]= htmlspecialchars("right search");
    $translate["droa_view"]= htmlspecialchars("right view");
    $translate["droa_create"]= htmlspecialchars("right create");
    $translate["droa_update_valid"]= htmlspecialchars("right update valid");

    $translate["groupe_search"]= htmlspecialchars("group search");
    $translate["groupe_view"]= htmlspecialchars("group  view");
    $translate["groupe_create"]= htmlspecialchars("group  create");
    $translate["groupe_create_valid"]= htmlspecialchars("group create valid");
    $translate["groupe_update_valid"]= htmlspecialchars("group update valid");
    $translate["groupe_delete_valid"]= htmlspecialchars("group delete valid");
    
    $translate['identifiant']	= htmlspecialchars('Database login');
	$translate['identifiant_acces_bd_paie']	= htmlspecialchars("Database's login SESAME PAIE ");
	$translate["identifiant_acces_bd_rh"]	= htmlspecialchars("Database's login SESAME RH ");	 
	$translate["interfacage_paie"] = htmlspecialchars('interface with SESAME PAIE');
	$translate["interfacage_rh"] = htmlspecialchars('interface with SESAME RH');
	$translate["interfacage"] = htmlspecialchars('interface');
	
	
	$translate['longueur_liste']	= htmlspecialchars('number of line per grid');
	    
    $translate["mail_search"]= htmlspecialchars("mail search");
    $translate["mail_view"]= htmlspecialchars("mail view");
    $translate["mail_create"]= htmlspecialchars("mail create");
    $translate["mail_create_valid"]= htmlspecialchars("mail create valid");
    $translate["mail_update_valid"]= htmlspecialchars("mail update valid");
    $translate["mail_delete_valid"]= htmlspecialchars("mail delete valid");
    $translate["mail_archive"]= htmlspecialchars("archive's mail");
    $translate["mail_param"]= htmlspecialchars("parameter's mail");
	$translate["mail_param_save"]= htmlspecialchars("save of parameter's mail");
    $translate["mail_historic"]= htmlspecialchars("historic's mail");
	$translate["mail_send_valid"]= htmlspecialchars("send mail");
	$translate["mail_log"]= htmlspecialchars("historic's send mail");
	
	$translate['nom_serveur']	= htmlspecialchars('host');
	$translate['nom_serveur_site']	= htmlspecialchars("Web site host");		
	$translate['nom_serveur_bd_paie']	= htmlspecialchars("database's name server SESAME PAIE ");
	$translate["nom_serveur_bd_rh"]	= htmlspecialchars("database's name server SESAME RH ");	
	$translate['notifier_email_receiver']	= htmlspecialchars('Notify an email to the receiver');
		 	
	
	$translate['param_base_donnee']	= htmlspecialchars('parameters of database');
	$translate["param_du_site"] = htmlspecialchars('Configuration of web site');
	$translate["param_du_workflow"] = htmlspecialchars("Workflow's configuration");
	$translate["passwordpaie"] = htmlspecialchars('passmord');
	$translate["passwordrh"] = htmlspecialchars('passmord');
	
	
    $translate["processus_search"]	=  htmlspecialchars("process search");
	$translate["processus_view"]	=  htmlspecialchars("process view");
	$translate["processus_create"]	=  htmlspecialchars("process create");
    $translate["processus_create_valid"] = htmlspecialchars("process create valid");
    $translate["processus_update_valid"] = htmlspecialchars("process update valid");
    $translate["processus_delete_valid"] = htmlspecialchars("process delete valid");

    $translate["profi_search"]= htmlspecialchars("profil search");
    $translate["profi_view"]= htmlspecialchars("profil view");
    $translate["profi_create"]= htmlspecialchars("profil create");
    $translate["profi_create_valid"]= htmlspecialchars("profil create valid");
    $translate["profi_update_valid"]= htmlspecialchars("profil update valid");
    $translate["profi_delete_valid"]= htmlspecialchars("profil delete valid");

    $translate["tache_search"] = htmlspecialchars("task search");
    $translate["tache_view"] = htmlspecialchars("task view");
    $translate["tache_create"] = htmlspecialchars("task create");
    $translate["tache_create_valid"] = htmlspecialchars("task create valid");
    $translate["tache_update_valid"] = htmlspecialchars("task update valid");
    $translate["tache_delete_valid"] = htmlspecialchars("task delete valid");
    
    $translate['tester_connexion']	= htmlspecialchars('Test connection');
    $translate['type_base_donnee_paie']	= htmlspecialchars("database's type server SESAME PAIE ");	 
	$translate['type_base_donnee']	= htmlspecialchars('Database type');
	$translate["type_base_donnee_rh"]	= htmlspecialchars("database's type server SESAME RH ");	 

	$translate['unite_duree']	= htmlspecialchars('unity of duration(process, circuit, task)');
	$translate['unite_duree_tache']	= htmlspecialchars('unity of duration of a task');	 	
	$translate['unite_duree_process']	= htmlspecialchars('unity of duration of a process');
	$translate['unite_duree_circuit']	= htmlspecialchars('unity of duration of a circuit');	 	
		
    $translate["user_search"] = htmlspecialchars("user search");
    $translate["user_view"] = htmlspecialchars("user view");
    $translate["user_create"] = htmlspecialchars("user create");
    $translate["user_create_valid"] = htmlspecialchars("user create valid");
    $translate["user_update_valid"] = htmlspecialchars("user update valid");
    $translate["user_delete_valid"]= htmlspecialchars("user delete valid");

    $translate["workflow_search"]= htmlspecialchars("workflow search");
    $translate["workflow_view"]= htmlspecialchars("workflow view");
    $translate["workflow_create"]= htmlspecialchars("workflow create");
    $translate["workflow_create_valid"]= htmlspecialchars("workflow create valid");
    $translate["workflow_update_valid"]= htmlspecialchars("workflow update valid");
    $translate["workflow_delete_valid"]= htmlspecialchars("workflow delete valid");

    $translate["processus"]= htmlspecialchars("process");
    $translate["circuit"]= htmlspecialchars("circuit");
    $translate["tache"]= htmlspecialchars("task");
    $translate["document"]= htmlspecialchars("document");
    $translate["utilisateur"]= htmlspecialchars("user");
    $translate["groupe"]= htmlspecialchars("group");
    $translate["departement"]= htmlspecialchars("department");
    $translate["workflow"]= htmlspecialchars("workflow");
    $translate["profil"]= htmlspecialchars("profil");
    $translate["mail"]= htmlspecialchars("mail");
    $translate["droit"]= htmlspecialchars("right");
    
    $translate["enregistrer"]= htmlspecialchars("save");
	$translate["annuler"]= htmlspecialchars("cancel");
	
	$translate['mysql'] = htmlspecialchars("MySQL");
	$translate['mssql'] = htmlspecialchars("Microsoft SQL Server");
	$translate['oci8']= htmlspecialchars("Oracle");
        
    $translate["port"]= htmlspecialchars("port");

?>
