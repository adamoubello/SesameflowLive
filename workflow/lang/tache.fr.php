<?php

/**
 * @version		1.0
 * @package		Workflow
 * @subpackage	Tache
 * @copyright (C) 2009 INTERFACE SA. Tous droits r�serv�s
 * @license		INTERFACE SA
 * @author 		Bello
 * @desc		Script de traduction des libell�s du sous-module tache en langue francaise
 * @updates
 * 	# samedi 20 juin 2009 (Patrick Mveng)
 * 		- suppression de ! dans l'instruction if (is_null($translate)) $translate = array();
 *   Cette derni�re r�initialisait le tablau et �crasait les libell�s existant en m�moire
 */
 
 global $translate;
 if ( is_null($translate)) $translate = array();

	$translate["creertache"]	=  htmlspecialchars("cr�er une tache");
	$translate["moddonneestache"]	=  htmlspecialchars("modifier une tache");
	$translate["donneestache"]	=  htmlspecialchars("donn�es de la tache");
	
	$translate["info_bulle_gestion_tache"]	=  htmlspecialchars("Rechercher ou afficher les informations sur les taches");
	$translate["modification_tache"]	=  htmlspecialchars("Modification d'une tache");
	$translate["tache_update_success"]	=  "Modification effectu&eacute;e avec succ&egrave;s !";
	$translate["tache_update_failure"]	=  "Echec modification";
	$translate["tache_create_success"]	=  "Cr&eacute;ation effectu&eacute;e avec succ&egrave;s !";
	$translate["tache_create_failure"]	=  "Echec cr&eacute;ation";
	$translate["creation_tache"]	=  htmlspecialchars("cr�ation d'une t�che");	
	
	$translate["parametre_url"]	=  htmlspecialchars("Param�tres URL");
	$translate["processus_tache"]	=  htmlspecialchars("processus rattach�");
	$translate["choisir"]	=  htmlspecialchars("choisir");
	
	$translate["recherche_tache"]	=  htmlspecialchars("rechercher une tache");
	$translate["btn_recherche_tache"]	=  htmlspecialchars("rechercher");
	$translate["resultat_recherche_tache"]	=  htmlspecialchars("il n'y a aucune t�che");
	$translate["systeme"]	=  htmlspecialchars("syst�me");
?>