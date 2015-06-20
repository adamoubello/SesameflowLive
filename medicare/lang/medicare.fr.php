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
 
 	$translate["type"] = htmlspecialchars("Type de consommable");
 	$translate["designation"] = htmlspecialchars("D�signation");
	$translate["presentation"]	=  htmlspecialchars("Pr�sentation"); 	
	$translate["quantite"]	=  htmlspecialchars("Quantit�"); 	
 	$translate["stock_dispo"] = htmlspecialchars("Stock disponible");
 	$translate["observation"] = htmlspecialchars("Observation");
 	$translate["titredoc"] = htmlspecialchars("Entr�e en stock");
?>