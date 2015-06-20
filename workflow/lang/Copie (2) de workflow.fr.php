<?php
/**
 * @version		1.0
 * @package		Workflow
 * @subpackage	Workflow
 * @copyright (C) 2009 INTERFACE SA. Tous droits réservés
 * @license		INTERFACE SA
 * @author 		Bello Adamou <moustaphbi@yahoo.fr>
 * @desc		Script de traduction des libellés du sous-module Workflow en langue francaise
 * @updates
 * 	# samedi 20 juin 2009 (Patrick Mveng)
 * 		- suppression de ! dans l'instruction if (is_null($translate)) $translate = array();
 *   Cette dernière réinitialisait le tablau et écrasait les libellés existant en mémoire
 * 	# mardi 18 mai 2010 (BELLO Adamou)
 * 		- modification du libellé "en cours" en "all"
 */
 global $translate;

 if (is_null($translate)) $translate = array();

    $translate["en_cours"]	=  htmlspecialchars("tous");
    $translate["donneesworkflow"]	=  htmlspecialchars("Créer un workflow");
	$translate["moddonneesworkflow"]	=  htmlspecialchars("modifier un workflow");
		
	$translate["datedebutworkflow"]	=  htmlspecialchars("date de début");
	$translate["expediteur"]	=  htmlspecialchars("expéditeur");
	
	$translate["piecesjointesworkflow"]	=  htmlspecialchars("Pièces jointes");
	$translate["pourcentageprogressionworkflow"]	=  htmlspecialchars("Pourcentage de progression");
	
	$translate["rechercher_workflow"]	=  htmlspecialchars("rechercher un workflow");
	$translate["parlib_workflow"]	=  htmlspecialchars("par libellé");
	$translate["pardatedebut_workflow"]	=  htmlspecialchars("par date de début");
	$translate["parduree_workflow"]	=  htmlspecialchars("par durée");
	
  	$translate["resultat_workflow"]	=  htmlspecialchars("il n'y a aucun workflow");
  	$translate["date_debut_circuit"]	=  htmlspecialchars("Date début");
	$translate["numworkflow"]	=  htmlspecialchars("Numéro du workflow");
	$translate["datedebutwf"]	=  htmlspecialchars("Date de début");
	$translate["heuredebutwf"]	=  htmlspecialchars("Heure de début");
	$translate["creerworkflow"]	=  htmlspecialchars("créer un workflow");
?>