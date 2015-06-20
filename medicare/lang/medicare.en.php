<?php
/**
 * @version		1.0
 * @package		GED
 * @subpackage	I18N (Gestion de l'internationnalisation)
 * @copyright (C) 2009 INTERFACE SA. Tous droits réservés
 * @license		INTERFACE SA
 * @author 		patrick mveng<patrick.mveng@interfacesa.local>
 * @desc		Script de traduction des affichage javascript du module GED en langue anglaise
 * @creationdate vendredi 24 juillet 2009
 * @updates
 */

global $translate;
 if (is_null($translate)) $translate = array();
 
 	$translate["annuite"] = htmlspecialchars("annuité");
 	$translate["aucun_doc_trouve"] = htmlspecialchars("No document found  !");
	$translate["any_doc_found"]	=  htmlspecialchars("Aucun document n'existe "); 	
	$translate["any_tag_found"]	=  htmlspecialchars("Aucun mot-clé n'existe "); 	
 	$translate["ajout_fichier"] = htmlspecialchars("Joindre un fichier ");
 	$translate["ajout_doc"] = htmlspecialchars("Joindre le document ");
	$translate["ajouter"]=htmlspecialchars ("ajouter");
	$translate["auteur_dde"] =  htmlspecialchars ("auteur demande");
	$translate["au"] =  htmlspecialchars ("au");
 	
 	$translate["code_user"] = htmlspecialchars("code utilisateur");
 	$translate["creation_valide"] = htmlspecialchars("demande traitée avec succès");
	$translate["creation_invalide"] = htmlspecialchars("échec lors du traitement de la demande");
 	
 	$translate["dde_credit"] = htmlspecialchars("Demande de crédit");
	$translate["dde_achat"]  = htmlspecialchars("demande d'achat");
 	$translate["dde_conge"] = htmlspecialchars("Demande de congé");
 	$translate["date_dde"] = htmlspecialchars("Date demande");
 	$translate["date_deb_credit"] = htmlspecialchars("date de début de crédit");
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
 	$translate["et"] = htmlspecialchars("et");
	
	$translate['heure_dde'] = htmlspecialchars("heure demande");
	$translate['heure_import'] = htmlspecialchars("heure importation");
	
	$translate['infos'] = htmlspecialchars("informations sur la demande");
 	
 	$translate["lib_doc_search"] = htmlspecialchars("Recherche d'un document");
 	
 	$translate["montant_dde"] = htmlspecialchars("montant crédit demandé");	
 	$translate["motif"] = htmlspecialchars("motif de la demande");	
 	
 	$translate["nbr_annuite"] = htmlspecialchars("nombre d'annuités");
 	$translate["num_dde"] = htmlspecialchars("numéro de la demande");
	
	$translate['objet'] = htmlspecialchars("objet demande");
	$translate["observation"] = htmlspecialchars ("observations");
 	
 	$translate["par_titre"] = htmlspecialchars("Par Titre");
 	$translate["par_tag"] = htmlspecialchars("Par Tag");
 	$translate["par_date_creation"] = htmlspecialchars("Par date de création");
 	$translate["par_date_modif"] = htmlspecialchars("Par date de modification");
 	$translate["par_auteur"] = htmlspecialchars("Par auteur");
 	$translate["par_etat"] = htmlspecialchars("Etat du document"); 
	$translate['periode'] = htmlspecialchars('période de couverture');	
	$translate['pieces_jointes'] = htmlspecialchars('Pièces jointes');
	$translate["pleaz_saisir_code"] 	= "Veuillez saisir le code de l'utilisateur";	
	$translate["precision"] 	= htmlspecialchars("précision sur demande");	
 	 	
 	$translate["rechercher"] = htmlspecialchars("Rechercher");
 	$translate["retenue"] = htmlspecialchars("retenue");
 	$translate["ret_par_annuite"] = htmlspecialchars("retenue par nombre d'annuités");
 	
 	$translate["tags_cloud"] = htmlspecialchars("nuage de mots clés"); 	
 	$translate["tags"] = htmlspecialchars("mots clés"); 	
 	$translate["type"] = htmlspecialchars("type"); 	
    $translate["telechargement"] = htmlspecialchars("téléchargement");
 	$translate["telecharger"] = htmlspecialchars("télécharger");
 	
 
?>