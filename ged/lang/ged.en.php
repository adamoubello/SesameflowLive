<?php
/**
 * @version		1.0
 * @package		GED
 * @subpackage	I18N (Gestion de l'internationnalisation)
 * @copyright (C) 2009 INTERFACE SA. Tous droits r�serv�s
 * @license		INTERFACE SA
 * @author 		patrick mveng<patrick.mveng@interfacesa.local>
 * @desc		Script de traduction des affichage javascript du module GED en langue anglaise
 * @creationdate vendredi 24 juillet 2009
 * @updates
 */

global $translate;
 if (is_null($translate)) $translate = array();
 
 	$translate["annuite"] = htmlspecialchars("annuit�");
 	$translate["aucun_doc_trouve"] = htmlspecialchars("No document found  !");
	$translate["any_doc_found"]	=  htmlspecialchars("Aucun document n'existe "); 	
	$translate["any_tag_found"]	=  htmlspecialchars("Aucun mot-cl� n'existe "); 	
 	$translate["ajout_fichier"] = htmlspecialchars("add a file ");
 	$translate["ajout_doc"] = htmlspecialchars("add a document ");
	$translate["ajouter"]=htmlspecialchars ("ajouter");
	$translate["auteur_dde"] =  htmlspecialchars ("author");
	$translate["au"] =  htmlspecialchars ("to");
 	
 	$translate["code_user"] = htmlspecialchars("code utilisateur");
 	$translate["creation_valide"] = htmlspecialchars("demande trait�e avec succ�s");
	$translate["creation_invalide"] = htmlspecialchars("�chec lors du traitement de la demande");
 	
 	$translate["dde_credit"] = htmlspecialchars("Demande de cr�dit");
	$translate["dde_achat"]  = htmlspecialchars("demande d'achat");
 	$translate["dde_conge"] = htmlspecialchars("Demande de cong�");
 	$translate["date_dde"] = htmlspecialchars("Date demande");
 	$translate["date_deb_credit"] = htmlspecialchars("date de d�but de cr�dit");
 	$translate["date_import"] = htmlspecialchars("date importation");
 	$translate["det_annuite"] = htmlspecialchars("d�tails annuit�");
 	$translate["donne_dde"] = htmlspecialchars("donn�es de la demande");
 	$translate['dde_valide'] = htmlspecialchars("demande valid�e");
 	
	$translate['dde_invalide'] = htmlspecialchars("demande non valid�e");
	$translate['detail_dde'] = htmlspecialchars("d�tails de la demande");
	$translate['designation'] = htmlspecialchars("description");
	$translate['duree_conge'] = htmlspecialchars("dur�e du cong�");
	
 	
 	$translate["entre"] = htmlspecialchars("between"); 	
 	$translate["erreur_date"] = htmlspecialchars("one of the two dates is not correct");
 	$translate["et"] = htmlspecialchars("and");
	
	$translate['heure_dde'] = htmlspecialchars("heure demande");
	$translate['heure_import'] = htmlspecialchars("heure importation");
	
	$translate['infos'] = htmlspecialchars("informations sur la demande");
 	
 	$translate["lib_doc_search"] = htmlspecialchars("Recherche d'un document");
 	
 	$translate["montant_dde"] = htmlspecialchars("montant cr�dit demand�");	
 	$translate["motif"] = htmlspecialchars("motif de la demande");	
 	
 	$translate["nbr_annuite"] = htmlspecialchars("nombre d'annuit�s");
 	$translate["num_dde"] = htmlspecialchars("num�ro de la demande");
	
	$translate['objet'] = htmlspecialchars("objet demande");
	$translate["observation"] = htmlspecialchars ("observations");
 	
 	$translate["par_titre"] = htmlspecialchars("By title");
 	$translate["par_tag"] = htmlspecialchars("By Tag");
 	$translate["par_date_creation"] = htmlspecialchars("By date of creation");
 	$translate["par_date_modif"] = htmlspecialchars("Par date de modification");
 	$translate["par_auteur"] = htmlspecialchars("By author");
 	$translate["par_etat"] = htmlspecialchars("Etat du document"); 
	$translate['periode'] = htmlspecialchars('p�riode de couverture');	
	$translate['pieces_jointes'] = htmlspecialchars('Pi�ces jointes');
	$translate["pleaz_saisir_code"] 	= "Please type the user's code";	
	$translate["precision"] 	= htmlspecialchars("pr�cision sur demande");	
 	 	
 	$translate["rechercher"] = htmlspecialchars("Search");
 	$translate["retenue"] = htmlspecialchars("retenue");
 	$translate["ret_par_annuite"] = htmlspecialchars("retenue par nombre d'annuit�s");
 	
 	$translate["tags_cloud"] = htmlspecialchars("tag cloud"); 	
 	$translate["tags"] = htmlspecialchars("mots cl�s"); 	
 	$translate["type"] = htmlspecialchars("type"); 	
    $translate["telechargement"] = htmlspecialchars("download");
 	$translate["telecharger"] = htmlspecialchars("download");
 	
 	$translate["entete"] =  htmlspecialchars ("INTERFACE SA");	
	$translate["titre_dde"] =  htmlspecialchars ("Formular of credit application ");	
	$translate["Nom_Pr�nom"] =  htmlspecialchars ("Name & Firsname");	
	$translate["date_dde"] =  htmlspecialchars ("Application date :");	
	$translate["retenue"] =  htmlspecialchars ("Retenue:");	
	$translate["montant"] =  htmlspecialchars ("Amount of application:");	
	$translate["heurecreation"] =  htmlspecialchars ("Creation Time:");	
	$translate["date_credit"] =  htmlspecialchars ("Credit begining D:");	
	$translate["ret_annuite"] =  htmlspecialchars ("Retenue par nombre d\'annuit�s :");	
	$translate["nbr_annuite"] =  htmlspecialchars ("Annuity Number:");	
	$translate["annuite"] =  htmlspecialchars ("Annuity :");	
	$translate["numero"] =  htmlspecialchars ("Demande N�");	
 	
 
?>