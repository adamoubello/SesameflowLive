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

    $translate["en_cours"]	=  htmlspecialchars("all");
     
    $translate["donneesworkflow"]	=  htmlspecialchars("create a workflow");
	$translate["moddonneesworkflow"]	=  htmlspecialchars("update a workflow");
		
	$translate["datedebutworkflow"]	=  htmlspecialchars("Date of beginning");
	$translate["piecesjointesworkflow"]	=  htmlspecialchars("inclosure");
	$translate["pourcentageprogressionworkflow"]	=  htmlspecialchars("Percentage of progression");
	
	$translate["rechercher_workflow"]	=  htmlspecialchars("search a workflow");
	$translate["parlib_workflow"]	=  htmlspecialchars("by label");
	$translate["pardatedebut_workflow"]	=  htmlspecialchars("by date of beginning");
	$translate["parduree_workflow"]	=  htmlspecialchars("by duration");
	
  	$translate["resultat_workflow"]	=  htmlspecialchars("there is not workflow");
	$translate["date_debut_circuit"]	=  htmlspecialchars("Beginning date");
    $translate["numworkflow"]	=  htmlspecialchars("Number");
	$translate["datedebutwf"]	=  htmlspecialchars("Beginning date");
	$translate["heuredebutwf"]	=  htmlspecialchars("Beginning hour"); 

?>