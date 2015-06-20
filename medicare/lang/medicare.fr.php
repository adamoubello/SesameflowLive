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
 
 	$translate["type"] = htmlspecialchars("Type de consommable");
 	$translate["designation"] = htmlspecialchars("Désignation");
	$translate["presentation"]	=  htmlspecialchars("Présentation"); 	
	$translate["quantite"]	=  htmlspecialchars("Quantité"); 	
 	$translate["stock_dispo"] = htmlspecialchars("Stock disponible");
 	$translate["observation"] = htmlspecialchars("Observation");
 	$translate["titredoc"] = htmlspecialchars("Entrée en stock");
?>