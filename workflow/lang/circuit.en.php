<?php
/**
 * @version		1.0
 * @package		Workflow
 * @subpackage	Circuit
 * @copyright (C) 2009 INTERFACE SA. Tous droits réservés
 * @license		INTERFACE SA
 * @author 		patrick mveng<patrick.mveng@interfacesa.local>
 * @desc		Script de traduction des libellés du sous-module circuit en langue anglaise
 * @created		25 juillet 2009
 * @updates
 */
 
 global $translate;  
 if (is_null($translate)) $translate = array();

	$translate["aucune_tache"]	=  htmlspecialchars("Aucune tâche");
	$translate["nbreacteurscircuit"]	=  htmlspecialchars("nombre d'acteurs");
	$translate["etape_circuit_create1"]	=  htmlspecialchars("etape 1/2 : Créer un circuit");
	
	$translate["suivant"]	=  htmlspecialchars("following");
	$translate["precedent"]	=  htmlspecialchars("previous");
	
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
	$translate["supprimer"]	=  htmlspecialchars("delete");
	$translate["ajouter"]	=  htmlspecialchars("add");
	
	$translate["parnom_circuit"]	=  htmlspecialchars("par nom");
	$translate["partache_circuit"]	=  htmlspecialchars("par tâche");
	
	$translate["tache_precedente"]	=  htmlspecialchars("previous task");
	$translate["tache_suivante"]	=  htmlspecialchars("following task");
	$translate["tout_acteur"]	=  htmlspecialchars("Any user");
	$translate["toute_fonction"]	=  htmlspecialchars("Any role");

?>