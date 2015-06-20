<?php

/**
 * @version		1.0
 * @package		Administration
 * @subpackage	I18N (Gestion de l'internationnalisation)
 * @copyright (C) 2009 INTERFACE SA. Tous droits r�serv�s
 * @license		INTERFACE SA
 * @author 		Bello
 * @updates
 * 	# samedi 20 juin 2009 (Patrick Mveng)
 * 		- suppression de ! dans l'instruction if (is_null($translate)) $translate = array();
 *   Cette derni�re r�initialisait le tablau et �crasait les libell�s existant en m�moire
 * 
 * @updates
 * 	# vendredi 24 juillet 2009 (Rao�l Ngambia)
 * 		- ajout de la variable de traduction mail pour son occurence dans le menu de droite
 *   Sans celle-ci libell� "mail" ne s'affichait pas dans le menu de droite
 * 
 * @updates
 * 	# vendredi 31 juillet 2009 (Rao�l Ngambia)
 * 		- ajout des traductions pour les pages mail_create et mail_param,
 *     pour affichage des titres dans la partie centrale et le menu centrale
 *   
 */
 
 global $translate;  
 
 if (is_null($translate)) $translate = array();
 
	$translate["nomuser"]	=  htmlspecialchars("nom");
	$translate["prenomuser"]	=  htmlspecialchars("pr�nom");
	$translate["emailuser"]	=  htmlspecialchars("email");
	$translate["loginuser"]	=  htmlspecialchars("login");
	$translate["passworduser"]	=  htmlspecialchars("mot de passe");
	$translate["passworduser1"]	=  htmlspecialchars("confirmer le mot de passe");
	$translate["numteluser"]	=  htmlspecialchars("t�l�phone portable");
	$translate["numburuser"]	=  htmlspecialchars("t�l�phone fixe bureau");
	$translate["numfaxuser"]	=  htmlspecialchars("num�ro fax");
	$translate["datenaissanceuser"]	=  htmlspecialchars("date de naissance");
    $translate["typeuser"]	=  htmlspecialchars("type");
	$translate["seltypeuser"]	=  htmlspecialchars("s�lectionnez un type");
	$translate["categorieuser"]	=  htmlspecialchars("cat�gorie");
	$translate["selcategorieuser"]	=  htmlspecialchars("s�lectionnez une cat�gorie");
	$translate["villeuser"]	=  htmlspecialchars("ville");
	$translate["paysuser"]	=  htmlspecialchars("pays");
 

	$translate["acteur"]	=  htmlspecialchars("acteur");
	$translate["activation_valid_success"]	=  ("Activation effectu&eacute;e avec succ&egrave;s");
	$translate["any_droit_found"]	=  htmlspecialchars("Aucun droit n'existe ");
	$translate["any_log_found"]     =  htmlspecialchars("Pas d'historique existant!");
	$translate["any_groupe_found"]	=  htmlspecialchars("Aucun groupe n'existe ");
	$translate["any_tache_found"]	=  htmlspecialchars("Aucune t�che n'existe ");
	$translate["any_processus_found"]	=  htmlspecialchars("Aucun processus n'existe ");
	$translate["any_circuit_found"]	=  htmlspecialchars("Aucun circuit n'existe ");
	$translate["any_user_found"]	=  htmlspecialchars("Aucun utilisateur n'existe ");
	$translate["any_dep_found"]	=  htmlspecialchars("Aucun service n'existe ");
	$translate["any_doc_found"]	=  htmlspecialchars("Aucun document n'existe ");
	$translate["any_mail_found"]	=  htmlspecialchars("Vous n'avez pas de mail dans votre bo�te");
	$translate["any_profil_found"]	=  htmlspecialchars("Aucune fonction n'existe ");
	$translate["any_workflow_found"]	=  htmlspecialchars("Aucun workflow n'existe ");
	$translate["aucun"]	=  htmlspecialchars("aucun");
	$translate["aucune"]	=  htmlspecialchars("aucune");
	$translate["annuler"]	=  htmlspecialchars("annuler");
	$translate["archive"] = htmlspecialchars("Archiv�");
	$translate["archiver"] = htmlspecialchars("archiver");
	$translate["Archive"] = htmlspecialchars("Archiv�");
	$translate["archives"]	=  htmlspecialchars("archives");
	$translate["aucun_fichier_uploaded"] = htmlspecialchars("Aucun fichier n'a �t� t�l�charg�");
	$translate["auteur"] = htmlspecialchars("auteur");
	$translate["accueil"]	=  htmlspecialchars("accueil");	
	$translate["aide"] = htmlspecialchars("Aide");
	$translate["administration"] = htmlspecialchars("administration");
	$translate["active"]	=  htmlspecialchars("activ�");
	$translate["au"] =  htmlspecialchars ("au");
	$translate['a'] =  htmlspecialchars ("�");
	
	$translate["bienvenue"]	=  htmlspecialchars("Bienvenue");
	 
	$translate["choisissez"]	=  htmlspecialchars("choisissez");
	$translate["contient"]	=  htmlspecialchars("contient");
	$translate["configuration"]	=  htmlspecialchars("configuration");
	$translate["config_general"]	=  htmlspecialchars("Configuration g�n�rale");
	$translate["connexion_valid_error"]	=  htmlspecialchars("Identifiant ou mot de passe inexistant");
	$translate["consultation"]	=  htmlspecialchars("consultation");
	$translate["code"]	=  htmlspecialchars("code");
	$translate["circulation"] = htmlspecialchars("circulation");
	$translate["circuit"] = htmlspecialchars("circuit");
	$translate["creer"]	=  htmlspecialchars("cr�er");	
	$translate["creer_processus"] = htmlspecialchars("Cr�ation d'un processus");
	$translate["creer_tache"] = htmlspecialchars("Cr�ation d'une t�che");
	$translate["creer_circuit"] = htmlspecialchars("Cr�ation d'un circuit");
	$translate["creer_workflow"] = htmlspecialchars("Cr�ation d'un workflow");	
	$translate["creer_dep"] = htmlspecialchars("Cr�ation d'un d�partement");
	$translate["csv"] = htmlspecialchars("csv");	
	$translate["csv_file"] = htmlspecialchars("Fichier CSV");
	$translate["creation"] = htmlspecialchars("cr�ation");
	
	$translate["date_creation"] = htmlspecialchars("Date cr�ation");
	$translate["date_envoi"] = htmlspecialchars("Date d'envoi");
	
	$translate["dde_credit"] = htmlspecialchars("Demande de cr�dit");
	$translate["dde_conge"] = htmlspecialchars("Demande de cong�");
	$translate["deconnexion"] = htmlspecialchars("d�connexion");
	$translate["delete_valid_success"] = htmlspecialchars("Suppression effectu�e avec succ�s");
    $translate["detail"]	=  htmlspecialchars("detail");	
    $translate["destinataire"]	=  htmlspecialchars("destinataire");
	$translate["document"] = htmlspecialchars("document");
	$translate["departement"] = htmlspecialchars("service");	
	$translate["droit_acces"] = htmlspecialchars("droit d'acc�s");		
	$translate["droit"] = htmlspecialchars("droit");	
	$translate["demande_credit"] = htmlspecialchars("demande de cr�dit");
	$translate["duree"]	=  htmlspecialchars("dur�e");
	$translate["desactive"]	=  htmlspecialchars("d�sactiv�");
	$translate["desactivation_valid_success"]	=  ("D&eacute;sactivation effectu&eacute;e avec succ&egrave;s");	
	
		
	$translate["equals_to"]	=  htmlspecialchars("est �gal �");
	$translate["enregistrer"]	=  htmlspecialchars("enregistrer");
	$translate["etape"]	=  htmlspecialchars("�tape");
	$translate["etat"]	=  htmlspecialchars("etat");
	$translate["error_move_file"]	=  htmlspecialchars("Erreur d�placement de fichier");
	$translate["excel_file"]	=  htmlspecialchars("Fichier Excel");
	$translate["exporter"]	=  htmlspecialchars("exporter");
	$translate["exportation"]	=  htmlspecialchars("exportation vers");
	
	
	$translate["fermer"]	=  htmlspecialchars("Fermer");
	$translate["file_wasnt_uploaded"]	=  htmlspecialchars("Le fichier n'a pas �t� t�l�charg�");	
	$translate['Filtre_Recherche']      =  htmlspecialchars("Filtre Recherche");	
	$translate["func_mail_php"]	=  htmlspecialchars("Fonction mail PHP");
	
	$translate["gestion_electronic_doc"] = htmlspecialchars("gestion documentaire");
	$translate["groupe_create"] = htmlspecialchars("Cr�ation de groupe");
	
	$translate["heure_creation"] = htmlspecialchars("Heure cr�ation");	
	$translate["heure"]	=  htmlspecialchars("heure");	
	$translate["historique"]	=  htmlspecialchars("historique");
	
	$translate["info_bulle_gestion_profil"]	=  htmlspecialchars("Afficher ou rechercher les informations sur les profils d'utilisateurs");		
	$translate["info_bulle_workflow"]	=  htmlspecialchars("Afficher ou rechercher les informations sur les instances de workflow");		
	$translate["info_bulle_processus"]	=  htmlspecialchars("Afficher ou rechercher les informations sur les processus");		
	$translate["info_bulle_processus"]	=  htmlspecialchars("Afficher ou rechercher les informations sur les t�ches");		
	$translate["info_bulle_circuit"]	=  htmlspecialchars("Mod�les de circulation");		
	$translate["info_bulle_tache"]	=  htmlspecialchars("Afficher ou rechercher les informations sur les t�ches");		
	$translate["info_bulle_document"]	=  htmlspecialchars("Afficher ou rechercher les informations sur les documents");		
	$translate["info_bulle_departement"]	=  htmlspecialchars("Afficher ou rechercher les informations sur les services");		
	$translate["info_bulle_utilisateur"]	=  htmlspecialchars("Afficher ou rechercher les informations sur les utilisateurs");		
	$translate["info_bulle_droit"]	=  htmlspecialchars("Contr�le des droits d'acc�s d'utilisateurs");
	$translate["info_bulle_config_unite_duree"]	=  htmlspecialchars("Cliquez ici pour modifier l'unit� de la dur�e");
			
	$translate["interfacage"] =  htmlspecialchars("interfa�age");
	
	$translate["insert_valid_success"] = ("Ajout effectu&eacute; avec succ&egrave;s");
	$translate["insert_valid_error"] = ("Erreur ajout");
	$translate['Recommencer']=("Recommencer");
	
	$translate["fonction"] = htmlspecialchars("fonction");
	
	$translate["groupe"]	=  htmlspecialchars("groupe");		
	
	$translate["jour"]	=  htmlspecialchars("jour");		
	$translate["Joined"] = htmlspecialchars("Import�");
	
	$translate["champs_obligatoires"]	=  htmlspecialchars("Champs obligatoires");
	$translate["libelle"]	=  htmlspecialchars("libell�");
	$translate['lib_reglages_email']=  htmlspecialchars("R�glages des mails");
	$translate["logicieldistribue"] = htmlspecialchars("s�sameflow est un logiciel distribu� par la soci�t�");
	$translate["login"]	=  htmlspecialchars($login);
	
	$translate["mail"]	=  htmlspecialchars("Mail");
	$translate["mail_log"]	=  htmlspecialchars("Log");
	$translate["mes_taches"]	=  htmlspecialchars("Mes T�ches");
	$translate["modification_profil"]	=  htmlspecialchars("Modification d'une fonction");
	$translate["modification_processus"]	=  htmlspecialchars("modification d'un processus");
	$translate["modification_tache"]	=  htmlspecialchars("modification d'une t�che");
	$translate["modification_user"]	=  htmlspecialchars("modification d'un utilisateur");
	$translate["modification_circuit"]	=  htmlspecialchars("modification d'un circuit");
	$translate["modification_droit"]	=  htmlspecialchars("modification d'un droit");
	$translate["modification_workflow"]	=  htmlspecialchars("modification d'un workflow");
	$translate["modifier"]	=  htmlspecialchars("enregistrer");
	$translate["module"]	=  htmlspecialchars("module");
	$translate["mois"]	=  htmlspecialchars("mois");
	
	$translate["nouveau"] = htmlspecialchars("Nouveau");
	$translate["nouvelle"] = htmlspecialchars("nouvelle");
	$translate["numero"]	=  htmlspecialchars("num�ro");
	$translate["nofileexists"]= htmlspecialchars("Le fichier � t�l�charger n'existe pas");
	$translate["non"]= htmlspecialchars("non");
	$translate["no_rigth_for_this_functionnality"]= htmlspecialchars("Acc�s non autoris�. Vous essayez d'acc�der � une page ou � une fonctionnalit� {%do%} qui n'est pas autoris�e pour votre compte utilisateur.");
	$translate["no_rigth_for_this_functionnality_ajax"]= ("Acc&egrave;s non autoris&eacute;. Vous essayez d'acc&eacute;der &agrave; une page ou &egrave; une fonctionnalit&eacute; qui n'est pas autoris&eacute;e pour votre compte utilisateur.");
	
	$translate["oui"]= htmlspecialchars("oui");	
	$translate["ou"]= htmlspecialchars("ou");	
	$translate["options"]= htmlspecialchars("options");	
	$translate["op_workflow"]= htmlspecialchars("op�rations sur le workflow");	
	$translate["op_gestion"]= htmlspecialchars("op�rations sur les documents");	
	$translate["op_utilisateur"]= htmlspecialchars("op�rations sur les utilisateurs");	
	$translate["op_administration"]= htmlspecialchars("op�rations administratives");
	$translate["on"] = htmlspecialchars("sur");	
				
	$translate['page_precedente']	= htmlspecialchars('Page pr�c�dente');	 	
	$translate['page_suivante']	= htmlspecialchars('Page suivante');	 	
	$translate['paging_abtract']	= htmlspecialchars('R�sultat(s) {%start%} a {%end%} sur {%total%} au total');	 	
	$translate['parametres']	= htmlspecialchars('param�tres');	
	$translate["par_titre"] = htmlspecialchars("Par Titre");  	
	$translate['par_tag'] = htmlspecialchars("Tag");
	$translate['password']	= htmlspecialchars('Mot de passe');	 	
	$translate['permission']	= htmlspecialchars('permission');	 	
    $translate["precedent"]	=  htmlspecialchars("pr�c�dent");
    $translate["prefixed_by"]	=  htmlspecialchars("commen�ant par");
	$translate["postfixed_by"]	=  htmlspecialchars("se terminant par");
	$translate["profil"] = htmlspecialchars("fonction");
	$translate["processus"] = htmlspecialchars("processus");	
	$translate["precedent"] = htmlspecialchars("pr�c�dent");
	
	$translate["recommencer"]	=  htmlspecialchars("recommencer");
	$translate["rechercher"]	=  htmlspecialchars("rechercher");
	$translate["recherche"]	=  htmlspecialchars("recherche");
	$translate["recherche_processus"]	=  htmlspecialchars("recherche de processus");
	$translate["resultat"] = htmlspecialchars("r�sultat(s)");
	
	$translate["recherche_doc"] = htmlspecialchars("Rechercher un document");
	
	
	$translate["sendmail"]	=  htmlspecialchars("sendmail"); 
	$translate["serveur_smtp"]	=  htmlspecialchars("Serveur SMTP"); 
	$translate["serveur_de_mail"]	=  htmlspecialchars("Serveur de mail"); 
	
	$translate["nom_exp�diteur"]	=  htmlspecialchars("Nom de l'exp�diteur"); 
	$translate["chemin_acc�s_sendmail"]	=  htmlspecialchars("Chemin d'acc�s � sendmail"); 
    $translate["identification_SMTP_requise"]	=  htmlspecialchars("Identification SMTP requise"); 
	$translate["utilisateur_SMTP"]	=  htmlspecialchars("Utilisateur SMTP"); 
	$translate["mot_de_passe_SMTP"]	=  htmlspecialchars("Mot de passe SMTP"); 
	$translate["h�te_SMTP"]	=  htmlspecialchars("H�te SMTP"); 
	
	$translate["rejeter"]	=  htmlspecialchars("rejeter");	
	$translate["sesameflow_powered_by_interfacesa"] = ("SesameFlow est un logiciel distribu&eacute; par la soci&eacute;t&eacute; ")."<a target=\"_blank\" href=\"http://www.interfacesa.com\">INTERFACE SA</a>";	
	$translate["selection"] = htmlspecialchars("selection");
	$translate["suivant"] = htmlspecialchars("suivant");
	$translate["supprimer"] = htmlspecialchars("Supprimer");

	$translate["taille_depasse_max_srv"] = htmlspecialchars("Le fichier t�l�charg� exc�de la taille autoris�e par le serveur");
	$translate["tache"] = htmlspecialchars("t�che");
	$translate["taches"] = htmlspecialchars("t�ches");
	$translate["todo"] = htmlspecialchars("A faire");
	$translate["titre"] = htmlspecialchars("titre");
	$translate["type_doc"] = htmlspecialchars("Type de document");
	$translate["sujet_mail"] = htmlspecialchars("sujet du mail");
	$translate["tout"] = htmlspecialchars("tout");	
	
	$translate["unite"] = htmlspecialchars("unit�");
	$translate["update_valid_success"] = ("Modification effectu&eacute;e avec succ&egrave;s");
	$translate["connexion_valid_success"] = ("Connexion effectu&eacute;e avec succ&egrave;s");
	$translate["utilisateur"] = htmlspecialchars("utilisateur");
	
	$translate["valider"] = htmlspecialchars("valider");
	
	$translate["xls"] = htmlspecialchars("Excel");
	$translate["xml"] = htmlspecialchars("xml");
	$translate["xml_file"] = htmlspecialchars("Fichier XML");
	
	$translate["workflow"] = htmlspecialchars("workflow");
	$translate["workflow_delete_valid_success"] = htmlspecialchars("workflow supprim� avec succ�s");
	
?>