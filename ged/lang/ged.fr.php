<?php
/**
 * @version		1.0
 * @package		GED
 * @subpackage	I18N (Gestion de l'internationnalisation)
 * @copyright (C) 2009 INTERFACE SA. Tous droits réservés
 * @license		INTERFACE SA
 * @author 		William<william.nkingne@laposte.net>
 * @desc		Script de traduction des libellés du module GED en langue française
 * @creationdate mercredi 17 juin 2009
 * @updates
 * 	# samedi 20 juin 2009 (Patrick Mveng)
 * 		- suppression de ! dans l'instruction if (is_null($translate)) $translate = array();
 *   Cette dernière réinitialisait le tablau et écrasait les libellés existant en mémoire
 */

global $translate;
 if (is_null($translate)) $translate = array();
 
 	$translate["annuite"] = htmlspecialchars("annuité");
 	$translate["aucun_doc_trouve"] = htmlspecialchars("Aucun document n'a été document trouvé !");
	$translate["any_doc_found"]	=  htmlspecialchars("Aucun document n'existe "); 	
	$translate["any_tag_found"]	=  htmlspecialchars("Aucun mot-clé n'existe "); 	
 	$translate["ajout_fichier"] = htmlspecialchars("Joindre un fichier ");
 	$translate["ajout_doc"] = htmlspecialchars("Joindre le document ");
	$translate["ajouter"]=htmlspecialchars ("ajouter");
	$translate["auteur_dde"] =  htmlspecialchars ("auteur demande");
		
	$translate["entete"] =  htmlspecialchars ("INTERFACE SA");	
	$translate["titre_dde"] =  htmlspecialchars ("Formulaire de demande de crédit ");	
	$translate["Nom_Prénom"] =  htmlspecialchars ("Nom  et Prénom   :");	
	$translate["date_dde"] =  htmlspecialchars ("Date de demande   :");	
	$translate["retenue"] =  htmlspecialchars ("Retenue   :");	
	$translate["montant"] =  htmlspecialchars ("Montant crédit demandé  :");	
	$translate["datecreation"] =  htmlspecialchars ("Date de demande   : ");	
	$translate["heurecreation"] =  htmlspecialchars ("Heure de création   :");	
	$translate["date_credit"] =  htmlspecialchars ("Date de début de crédit   :");	
	$translate["ret_annuite"] =  htmlspecialchars ("Retenue par nombre d'annuités   :");	
	$translate["nbr_annuite"] =  htmlspecialchars ("Nombre d 'annuités   :");	
	$translate["annuite"] =  htmlspecialchars ("Annuité   :");	
	$translate["numero"] =  htmlspecialchars ("Demande N°");	
	

	
 	$translate["code_user"] = htmlspecialchars("code utilisateur");
 	$translate["creation_valide"] = htmlspecialchars("demande traitée avec succès");
	$translate["creation_invalide"] = htmlspecialchars("échec lors du traitement de la demande");
 	
 	$translate["dde_credit"] = htmlspecialchars("Demande de crédit");
	$translate["dde_achat"]  = htmlspecialchars("demande d'achat");
 	$translate["dde_conge"] = htmlspecialchars("Demande de congé");
 	$translate["date_dde"] = htmlspecialchars("Date demande");
 	$translate["date_deb_credit"] = htmlspecialchars("date de début de crédit");
 	$translate["date_deb_conge"] = htmlspecialchars("date de début du congé");
 	$translate["date_fin_conge"] = htmlspecialchars("date de fin du congé");
 	$translate["date_import"] = htmlspecialchars("date importation");
 	$translate["det_annuite"] = htmlspecialchars("détails annuité");
 	$translate["donne_dde"] = htmlspecialchars("données de la demande");
 	$translate['dde_valide'] = htmlspecialchars("demande validée");
 	$translate['du'] = htmlspecialchars("du");
	$translate['dde_invalide'] = htmlspecialchars("demande non validée");
	$translate['detail_dde'] = htmlspecialchars("détails de la demande");
	$translate['designation'] = htmlspecialchars("désignation");
	$translate['duree_conge'] = htmlspecialchars("durée du congé");
	
 	
 	$translate["entre"] = htmlspecialchars("entre");
 	$translate["erreur_date"] = ("Une des dates de recherche est invalide"); 	
 	$translate["et"] = htmlspecialchars("et");
	
	$translate['heure_dde'] = htmlspecialchars("heure demande");
	$translate['heure_import'] = htmlspecialchars("heure importation");
	
	$translate['infos'] = htmlspecialchars("informations sur la demande");
 	
 	$translate["lib_doc_search"] = htmlspecialchars("Recherche d'un document");
 	
 	$translate["montant_dde"] = htmlspecialchars("montant crédit demandé");	
 	$translate["motif"] = htmlspecialchars("motif de la demande");	
 	
 	//$translate["nbr_annuite"] = htmlspecialchars("nombre d'annuités");
 	$translate["num_dde"] = htmlspecialchars("numéro de la demande");
	
	$translate['objet'] = htmlspecialchars("objet demande");
	$translate["observation"] = htmlspecialchars ("observations");
 	
 	$translate["par_titre"] = htmlspecialchars("Titre");
 	$translate["par_tag"] = htmlspecialchars("Tag");
 	$translate["par_date_creation"] = htmlspecialchars("Date de création");
 	$translate["par_date_modif"] = htmlspecialchars("Date de modification");
 	$translate["par_auteur"] = htmlspecialchars("Auteur");
 	$translate["par_etat"] = htmlspecialchars("Etat du document"); 
	$translate['periode'] = htmlspecialchars('période de couverture');	
	$translate['pieces_jointes'] = htmlspecialchars('Pièces jointes');
	$translate["pleaz_saisir_code"] 	= "Veuillez saisir le code de l'utilisateur";	
	$translate["precision"] 	= htmlspecialchars("précision sur demande");	
 	 	
 	$translate["rechercher"] = htmlspecialchars("Rechercher");
 	//$translate["retenue"] = htmlspecialchars("retenue");
 	$translate["ret_par_annuite"] = htmlspecialchars("Retenue par nombre d'annuités");
 	
 	$translate["tags_cloud"] = htmlspecialchars("nuage de mots clés"); 	
 	$translate["tags"] = htmlspecialchars("mots clés"); 	
 	$translate["type"] = htmlspecialchars("type"); 	
    $translate["telechargement"] = htmlspecialchars("téléchargement");
 	$translate["telecharger"] = htmlspecialchars("télécharger");
 	
 
?>