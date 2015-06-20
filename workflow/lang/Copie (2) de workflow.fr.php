<?php
/**
 * @version		1.0
 * @package		Workflow
 * @subpackage	Workflow
 * @copyright (C) 2009 INTERFACE SA. Tous droits r�serv�s
 * @license		INTERFACE SA
 * @author 		Bello Adamou <moustaphbi@yahoo.fr>
 * @desc		Script de traduction des libell�s du sous-module Workflow en langue francaise
 * @updates
 * 	# samedi 20 juin 2009 (Patrick Mveng)
 * 		- suppression de ! dans l'instruction if (is_null($translate)) $translate = array();
 *   Cette derni�re r�initialisait le tablau et �crasait les libell�s existant en m�moire
 * 	# mardi 18 mai 2010 (BELLO Adamou)
 * 		- modification du libell� "en cours" en "all"
 */
 global $translate;

 if (is_null($translate)) $translate = array();

    $translate["en_cours"]	=  htmlspecialchars("tous");
    $translate["donneesworkflow"]	=  htmlspecialchars("Cr�er un workflow");
	$translate["moddonneesworkflow"]	=  htmlspecialchars("modifier un workflow");
		
	$translate["datedebutworkflow"]	=  htmlspecialchars("date de d�but");
	$translate["expediteur"]	=  htmlspecialchars("exp�diteur");
	
	$translate["piecesjointesworkflow"]	=  htmlspecialchars("Pi�ces jointes");
	$translate["pourcentageprogressionworkflow"]	=  htmlspecialchars("Pourcentage de progression");
	
	$translate["rechercher_workflow"]	=  htmlspecialchars("rechercher un workflow");
	$translate["parlib_workflow"]	=  htmlspecialchars("par libell�");
	$translate["pardatedebut_workflow"]	=  htmlspecialchars("par date de d�but");
	$translate["parduree_workflow"]	=  htmlspecialchars("par dur�e");
	
  	$translate["resultat_workflow"]	=  htmlspecialchars("il n'y a aucun workflow");
  	$translate["date_debut_circuit"]	=  htmlspecialchars("Date d�but");
	$translate["numworkflow"]	=  htmlspecialchars("Num�ro du workflow");
	$translate["datedebutwf"]	=  htmlspecialchars("Date de d�but");
	$translate["heuredebutwf"]	=  htmlspecialchars("Heure de d�but");
	$translate["creerworkflow"]	=  htmlspecialchars("cr�er un workflow");
?>