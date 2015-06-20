<?php
/**
 * @version		1.0
 * @package		GED
 * @subpackage	I18N (Gestion de l'internationnalisation)
 * @copyright (C) 2009 INTERFACE SA. Tous droits r�serv�s
 * @license		INTERFACE SA
 * @author 		William<william.nkingne@laposte.net>
 * @desc		Script de traduction des libell�s du module GED en langue fran�aise
 * @creationdate mercredi 17 juin 2009
 * @updates
 * 	# samedi 20 juin 2009 (Patrick Mveng)
 * 		- suppression de ! dans l'instruction if (is_null($translate)) $translate = array();
 *   Cette derni�re r�initialisait le tablau et �crasait les libell�s existant en m�moire
 */

global $translate;
 if (is_null($translate)) $translate = array();
 
 	$translate["annuite"] = htmlspecialchars("annuit�");
 	$translate["aucun_doc_trouve"] = htmlspecialchars("Aucun document n'a �t� document trouv� !");
	$translate["any_doc_found"]	=  htmlspecialchars("Aucun document n'existe "); 	
	$translate["any_tag_found"]	=  htmlspecialchars("Aucun mot-cl� n'existe "); 	
 	$translate["ajout_fichier"] = htmlspecialchars("Joindre un fichier ");
 	$translate["ajout_doc"] = htmlspecialchars("Joindre le document ");
	$translate["ajouter"]=htmlspecialchars ("ajouter");
	$translate["auteur_dde"] =  htmlspecialchars ("auteur demande");
		
	$translate["entete"] =  htmlspecialchars ("INTERFACE SA");	
	$translate["titre_dde"] =  htmlspecialchars ("Formulaire de demande de cr�dit ");	
	$translate["Nom_Pr�nom"] =  htmlspecialchars ("Nom  et Pr�nom   :");	
	$translate["date_dde"] =  htmlspecialchars ("Date de demande   :");	
	$translate["retenue"] =  htmlspecialchars ("Retenue   :");	
	$translate["montant"] =  htmlspecialchars ("Montant cr�dit demand�  :");	
	$translate["datecreation"] =  htmlspecialchars ("Date de demande   : ");	
	$translate["heurecreation"] =  htmlspecialchars ("Heure de cr�ation   :");	
	$translate["date_credit"] =  htmlspecialchars ("Date de d�but de cr�dit   :");	
	$translate["ret_annuite"] =  htmlspecialchars ("Retenue par nombre d'annuit�s   :");	
	$translate["nbr_annuite"] =  htmlspecialchars ("Nombre d 'annuit�s   :");	
	$translate["annuite"] =  htmlspecialchars ("Annuit�   :");	
	$translate["numero"] =  htmlspecialchars ("Demande N�");	
	

	
 	$translate["code_user"] = htmlspecialchars("code utilisateur");
 	$translate["creation_valide"] = htmlspecialchars("demande trait�e avec succ�s");
	$translate["creation_invalide"] = htmlspecialchars("�chec lors du traitement de la demande");
 	
 	$translate["dde_credit"] = htmlspecialchars("Demande de cr�dit");
	$translate["dde_achat"]  = htmlspecialchars("demande d'achat");
 	$translate["dde_conge"] = htmlspecialchars("Demande de cong�");
 	$translate["date_dde"] = htmlspecialchars("Date demande");
 	$translate["date_deb_credit"] = htmlspecialchars("date de d�but de cr�dit");
 	$translate["date_deb_conge"] = htmlspecialchars("date de d�but du cong�");
 	$translate["date_fin_conge"] = htmlspecialchars("date de fin du cong�");
 	$translate["date_import"] = htmlspecialchars("date importation");
 	$translate["det_annuite"] = htmlspecialchars("d�tails annuit�");
 	$translate["donne_dde"] = htmlspecialchars("donn�es de la demande");
 	$translate['dde_valide'] = htmlspecialchars("demande valid�e");
 	$translate['du'] = htmlspecialchars("du");
	$translate['dde_invalide'] = htmlspecialchars("demande non valid�e");
	$translate['detail_dde'] = htmlspecialchars("d�tails de la demande");
	$translate['designation'] = htmlspecialchars("d�signation");
	$translate['duree_conge'] = htmlspecialchars("dur�e du cong�");
	
 	
 	$translate["entre"] = htmlspecialchars("entre");
 	$translate["erreur_date"] = ("Une des dates de recherche est invalide"); 	
 	$translate["et"] = htmlspecialchars("et");
	
	$translate['heure_dde'] = htmlspecialchars("heure demande");
	$translate['heure_import'] = htmlspecialchars("heure importation");
	
	$translate['infos'] = htmlspecialchars("informations sur la demande");
 	
 	$translate["lib_doc_search"] = htmlspecialchars("Recherche d'un document");
 	
 	$translate["montant_dde"] = htmlspecialchars("montant cr�dit demand�");	
 	$translate["motif"] = htmlspecialchars("motif de la demande");	
 	
 	//$translate["nbr_annuite"] = htmlspecialchars("nombre d'annuit�s");
 	$translate["num_dde"] = htmlspecialchars("num�ro de la demande");
	
	$translate['objet'] = htmlspecialchars("objet demande");
	$translate["observation"] = htmlspecialchars ("observations");
 	
 	$translate["par_titre"] = htmlspecialchars("Titre");
 	$translate["par_tag"] = htmlspecialchars("Tag");
 	$translate["par_date_creation"] = htmlspecialchars("Date de cr�ation");
 	$translate["par_date_modif"] = htmlspecialchars("Date de modification");
 	$translate["par_auteur"] = htmlspecialchars("Auteur");
 	$translate["par_etat"] = htmlspecialchars("Etat du document"); 
	$translate['periode'] = htmlspecialchars('p�riode de couverture');	
	$translate['pieces_jointes'] = htmlspecialchars('Pi�ces jointes');
	$translate["pleaz_saisir_code"] 	= "Veuillez saisir le code de l'utilisateur";	
	$translate["precision"] 	= htmlspecialchars("pr�cision sur demande");	
 	 	
 	$translate["rechercher"] = htmlspecialchars("Rechercher");
 	//$translate["retenue"] = htmlspecialchars("retenue");
 	$translate["ret_par_annuite"] = htmlspecialchars("Retenue par nombre d'annuit�s");
 	
 	$translate["tags_cloud"] = htmlspecialchars("nuage de mots cl�s"); 	
 	$translate["tags"] = htmlspecialchars("mots cl�s"); 	
 	$translate["type"] = htmlspecialchars("type"); 	
    $translate["telechargement"] = htmlspecialchars("t�l�chargement");
 	$translate["telecharger"] = htmlspecialchars("t�l�charger");
 	
 
?>