<?php
/**
 * @version		1.0
 * @package		Workflow
 * @subpackage	Circuit
 * @copyright (C) 2009 INTERFACE SA. Tous droits réservés
 * @license		INTERFACE SA
 * @author 		Bello
 * @desc		Script de traduction des libellés du sous-module circuit en langue francaise
 * @updates
 * 	# samedi 20 juin 2009 (Patrick Mveng)
 * 		- suppression de ! dans l'instruction if (is_null($translate)) $translate = array();
 *   Cette dernière réinitialisait le tablau et écrasait les libellés existant en mémoire
 */
 
 global $translate;  
 if (is_null($translate)) $translate = array();

	$translate["aucune_tache"]	=  htmlspecialchars("Aucune tâche");
	$translate["nbreacteurscircuit"]	=  htmlspecialchars("nombre d'acteurs");
	$translate["etape_circuit_create1"]	=  htmlspecialchars("etape 1/2 : Créer un circuit");
	
	$translate["suivant"]	=  htmlspecialchars("suivant");
	$translate["precedent"]	=  htmlspecialchars("précédent");
	
	$translate["info_bulle_gestion_circuit"]	=  htmlspecialchars("Rechercher ou afficher les informations sur les circuits de processus");
	$translate["modification_circuit"]	=  htmlspecialchars("Modification d'un circuit");
	$translate["circuit_update_success"]	=  "Modification effectu&eacute;e avec succ&egrave;s !";
	$translate["circuit_update_failure"]	=  "Echec modification";
	$translate["circuit_create_success"]	=  "Cr&eacute;ation effectu&eacute;e avec succ&egrave;s !";
	$translate["circuit_create_failure"]	=  "Echec cr&eacute;ation";
	$translate["creation_circuit"]	=  htmlspecialchars("création d'un circuit : étape 1");
	
	$translate["en_x_unite"]	=  htmlspecialchars("en {unite_duree_circuit}");
	$translate["hierarchisation_circuit"]	=  htmlspecialchars("hiérarchisation du circuit");
	$translate["acteur"]	=  htmlspecialchars("acteur");
	$translate["supprimer"]	=  htmlspecialchars("supprimer");
	$translate["ajouter"]	=  htmlspecialchars("ajouter");
	
	$translate["parnom_circuit"]	=  htmlspecialchars("par nom");
	$translate["partache_circuit"]	=  htmlspecialchars("par tâche");
	
	$translate["tache_precedente"]	=  htmlspecialchars("tâche précédente");
	$translate["tache_suivante"]	=  htmlspecialchars("tâche suivante");
	$translate["tout_acteur"]	=  htmlspecialchars("Tout acteur");
	$translate["toute_fonction"]	=  htmlspecialchars("Toute fonction");

?>