
<?php

/**
 * @version			1.0
 * @package			Administration
 * @subpackage		Administration
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			patrick mveng <patrick.mveng@interfacesa.local>
 * @desc			Script qui aiguille vers l'affichage du menu central, en fonction de la page web sollicité
 * @param  			do - code de la page web à afficher dans la partie centrale du gabarit
 * @param 			div_titre_menu_central - chaine contenant le code HTML pour imprimer le div du titre du menu de commande.C'est un paramètre de sortie
 * @creationdate	26 juin 2009
 * @updates
 * * 	# vendredi 24 juillet 2009 (Raoul Ngambia)
 * 		- ajout dans la fonction "switch" du block de case "mail_search" permettant de selectionner l'acces au mail dans le menu_droite du module MAIL
 *        l'abscence de ce dernier empéchait l'affichage du titre "Mail" dans le menu centrale
 *        
 *        @rule	:	pas besoin de bouton Nouveau pour l'entité workflow. La création de workflow se fait par le clic sur 
 *        la tâche initiale d'un circuit
 */

	 define("DS", DIRECTORY_SEPARATOR);
	 
	 $login= (isset($data["login"])) ? (! is_null($data["login"])) ? $data["login"] : null : null;
	 $typedoc = (isset($data["typedoc"])) ? (! is_null($data["typedoc"])) ? $data["typedoc"] : null : null;
	 $do = (isset($data["do"])) ? (! is_null($data["do"])) ? $data["do"] : "accueil" : "accueil";
	 $lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
	 $numdoc = (isset($data["numdoc"])) ? (! is_null($data["numdoc"])) ? $data["numdoc"] : null : null;
	 $numtache = (isset($data["numtache"])) ? (! is_null($data["numtache"])) ? $data["numtache"] : null : null;
	 $numworkflow = (isset($data["numworkflow"])) ? (! is_null($data["numworkflow"])) ? $data["numworkflow"] : null : null;
	 $codecircuit = (isset($data["codecircuit"])) ? (! is_null($data["codecircuit"])) ? $data["codecircuit"] : null : null;
		 
    $chemin = dirname(__FILE__);
	$chemin = str_replace(DS."traitements","",$chemin);
	require_once($chemin.DS."classe".DS."application.class.php");
    $siteweb = new Application();
    ini_set('include_path', $siteweb->get_document_root().'\includes\pear');	//charger les packages de PEAR::MDB2	
    $rejeter=false;global $rejeter; 
    $_POST["rejeter"]=$rejeter;
    	
     //die($do);
	 
	 switch (trim($do))
	 {

	 	case "user_search" :
		?>
		<table class="toolbar">
			<tr>	
				<td class="button" id="toolbar-save">
				<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=user_create&lang={$lang}"; ?>';" class="toolbar">
				<span class="icon-32-new" title="<?php echo ucfirst($translate["nouveau"]); ?>">
				</span>
				<?php echo ucfirst($translate["nouveau"]); ?>
				</a>
				</td>
				
				<td class="button" id="toolbar-back">
					<a href="#" onclick="javascript:window.go(-1);" class="toolbar">
					<span class="icon-32-back" title="<?php echo ucfirst($translate["page_precedent"]); ?>">
					</span>
					<?php echo ucfirst($translate["precedent"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-forward">
					<a href="#" onclick="javascript:window.history.go(1);" class="toolbar">
					<span class="icon-32-forward" title="<?php echo ucfirst($translate["page_suivante"]); ?>">
					</span>
					<?php echo ucfirst($translate["suivant"]); ?>
					</a>
				</td>
			
				<td class="button" id="toolbar-help">
				<a href="#"   class="toolbar">
				<span class="icon-32-help" title="<?php echo ucfirst($translate["aide"]); ?>">
				</span>
				<?php echo ucfirst($translate["aide"]); ?>
				</a>
				</td>
			</tr>
		</table>
		<?php
		$div_titre_menu_central = "<div class=\"header icon-48-user\">". ucfirst($translate["utilisateur"])." : <small><small>[ ". ucfirst($translate["recherche"]) ." ]</small></small></div>";
		break;

	 	case "user_create" :
		?>
		<table class="toolbar">
			<tr>	
			
				<td class="button" id="toolbar-save">
				<a href="#" onclick="javascript:on_user_create_valid();" class="toolbar">
				<span class="icon-32-save" title="<?php echo ucfirst($translate["enregistrer"]); ?>">
				</span>
				<?php echo ucfirst($translate["enregistrer"]); ?>
				</a>
				</td>
				
				<td class="button" id="toolbar-apply">
				<a href="#" onclick="javascript:window.history.back();" class="toolbar">
				<span class="icon-32-cancel" title="<?php echo ucfirst($translate["annuler"]); ?>">
				</span>
				<?php echo ucfirst($translate["annuler"]); ?>
				</a>
				</td>
				
			
				<td class="button" id="toolbar-save">
				<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=user_create&lang={$lang}"; ?>';" class="toolbar">
				<span class="icon-32-new" title="<?php echo ucfirst($translate["nouveau"]); ?>">
				</span>
				<?php echo ucfirst($translate["nouveau"]); ?>
				</a>
				</td>
			
				<td class="button" id="toolbar-preview">
				<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=user_search&lang={$lang}"; ?>';" class="toolbar">
				<span class="icon-32-preview" title="<?php echo ucfirst($translate["recherche"]); ?>">
				</span>
				<?php echo ucfirst($translate["recherche"]); ?>
				</a>
				</td>
						
				<td class="button" id="toolbar-back">
					<a href="#" onclick="javascript:window.go(-1);" class="toolbar">
					<span class="icon-32-back" title="<?php echo ucfirst($translate["page_precedent"]); ?>">
					</span>
					<?php echo ucfirst($translate["precedent"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-forward">
					<a href="#" onclick="javascript:window.history.go(1);" class="toolbar">
					<span class="icon-32-forward" title="<?php echo ucfirst($translate["page_suivante"]); ?>">
					</span>
					<?php echo ucfirst($translate["suivant"]); ?>
					</a>
				</td>
			
				<td class="button" id="toolbar-help">
				<a href="#"   class="toolbar">
				<span class="icon-32-help" title="<?php echo ucfirst($translate["aide"]); ?>">
				</span>
				<?php echo ucfirst($translate["aide"]); ?>
				</a>
				</td>
			</tr>
		</table>
		<?php
		$div_titre_menu_central = "<div class=\"header icon-48-user\">". ucfirst($translate["utilisateur"])." : <small><small>[ ". ucfirst($translate["nouveau"]) ." ]</small></small></div>";
		break;

	 	case "user_view" :
			?>
			<table class="toolbar">
				<tr>	
					<td class="button" id="toolbar-save">
					<a href="#" onclick="javascript:on_user_update_valid('<?php echo $siteweb->get_url()."/utilisateur/traitements/partie_centrale.php" ?>');" class="toolbar">
					<span class="icon-32-apply" title="<?php echo ucfirst($translate["modifier"]); ?>">
					</span>
					<?php echo ucfirst($translate["modifier"]); ?>
					</a>
					</td>
				
					<td class="button" id="toolbar-apply">
					<a href="#" onclick="javascript:window.history.back();" class="toolbar">
					<span class="icon-32-cancel" title="<?php echo ucfirst($translate["annuler"]); ?>">
					</span>
					<?php echo ucfirst($translate["annuler"]); ?>
					</a>
					</td>

					<td class="button" id="toolbar-save">
					<a href="#" onclick="javascript:on_user_delete_valid();" class="toolbar">
					<span class="icon-32-trash" title="<?php echo ucfirst($translate["supprimer"]); ?>">
					</span>
					<?php echo ucfirst($translate["supprimer"]); ?>
					</a>
					</td>
					
					<td class="button" id="toolbar-preview">
					<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=user_search&lang={$lang}"; ?>';" class="toolbar">
					<span class="icon-32-preview" title="<?php echo ucfirst($translate["recherche"]); ?>">
					</span>
					<?php echo ucfirst($translate["recherche"]); ?>
					</a>
					</td>

					<td class="button" id="toolbar-save">
					<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=user_create&lang={$lang}"; ?>';" class="toolbar">
					<span class="icon-32-new" title="<?php echo ucfirst($translate["nouveau"]); ?>">
					</span>
					<?php echo ucfirst($translate["nouveau"]); ?>
					</a>
					</td>
							
					<td class="button" id="toolbar-back">
						<a href="#" onclick="javascript:window.go(-1);" class="toolbar">
						<span class="icon-32-back" title="<?php echo ucfirst($translate["page_precedent"]); ?>">
						</span>
						<?php echo ucfirst($translate["precedent"]); ?>
						</a>
					</td>
					
					<td class="button" id="toolbar-forward">
						<a href="#" onclick="javascript:window.history.go(1);" class="toolbar">
						<span class="icon-32-forward" title="<?php echo ucfirst($translate["page_suivante"]); ?>">
						</span>
						<?php echo ucfirst($translate["suivant"]); ?>
						</a>
					</td>
				
					<td class="button" id="toolbar-help">
					<a href="#"   class="toolbar">
					<span class="icon-32-help" title="<?php echo ucfirst($translate["aide"]); ?>">
					</span>
					<?php echo ucfirst($translate["aide"]); ?>
					</a>
					</td>

					</tr>
			</table>
			
		<?php
		$div_titre_menu_central = "<div class=\"header icon-48-user\">". ucfirst($translate["utilisateur"])." : <small><small>[ ". ucfirst($translate["consultation"]) ." ]</small></small></div>";
		break;

	 	case "dep_search" :
		?>
		<table class="toolbar">
			<tr>	
				<td class="button" id="toolbar-save">
				<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=dep_create&lang={$lang}"; ?>';" class="toolbar">
				<span class="icon-32-new" title="<?php echo ucfirst($translate["nouveau"]); ?>">
				</span>
				<?php echo ucfirst($translate["nouveau"]); ?>
				</a>
				</td>
			
				<td class="button" id="toolbar-back">
					<a href="#" onclick="javascript:window.go(-1);" class="toolbar">
					<span class="icon-32-back" title="<?php echo ucfirst($translate["page_precedent"]); ?>">
					</span>
					<?php echo ucfirst($translate["precedent"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-forward">
					<a href="#" onclick="javascript:window.history.go(1);" class="toolbar">
					<span class="icon-32-forward" title="<?php echo ucfirst($translate["page_suivante"]); ?>">
					</span>
					<?php echo ucfirst($translate["suivant"]); ?>
					</a>
				</td>
			
				<td class="button" id="toolbar-help">
				<a href="#"   class="toolbar">
				<span class="icon-32-help" title="<?php echo ucfirst($translate["aide"]); ?>">
				</span>
				<?php echo ucfirst($translate["aide"]); ?>
				</a>
				</td>

				</tr>
		</table>
		<?php
		$div_titre_menu_central = "<div class=\"header icon-48-user\">". ucfirst($translate["departement"])." : <small><small>[ ". ucfirst($translate["recherche"]) ." ]</small></small></div>";
		break;

	 	case "dep_create" :
		?>
		<table class="toolbar">
			<tr>	
			
				<td class="button" id="toolbar-save">
				<a href="#" onclick="javascript:on_dep_create_valid();" class="toolbar">
				<span class="icon-32-save" title="<?php echo ucfirst($translate["enregistrer"]); ?>">
				</span>
				<?php echo ucfirst($translate["enregistrer"]); ?>
				</a>
				</td>
				
				<td class="button" id="toolbar-apply">
				<a href="#" onclick="javascript:window.history.back();" class="toolbar">
				<span class="icon-32-cancel" title="<?php echo ucfirst($translate["annuler"]); ?>">
				</span>
				<?php echo ucfirst($translate["annuler"]); ?>
				</a>
				</td>
							
				<td class="button" id="toolbar-save">
				<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=dep_create&lang={$lang}"; ?>';" class="toolbar">
				<span class="icon-32-new" title="<?php echo ucfirst($translate["nouveau"]); ?>">
				</span>
				<?php echo ucfirst($translate["nouveau"]); ?>
				</a>
				</td>
			
				<td class="button" id="toolbar-preview">
				<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=dep_search&lang={$lang}"; ?>';" class="toolbar">
				<span class="icon-32-preview" title="<?php echo ucfirst($translate["recherche"]); ?>">
				</span>
				<?php echo ucfirst($translate["recherche"]); ?>
				</a>
				</td>
						
				<td class="button" id="toolbar-back">
					<a href="#" onclick="javascript:window.go(-1);" class="toolbar">
					<span class="icon-32-back" title="<?php echo ucfirst($translate["page_precedent"]); ?>">
					</span>
					<?php echo ucfirst($translate["precedent"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-forward">
					<a href="#" onclick="javascript:window.history.go(1);" class="toolbar">
					<span class="icon-32-forward" title="<?php echo ucfirst($translate["page_suivante"]); ?>">
					</span>
					<?php echo ucfirst($translate["suivant"]); ?>
					</a>
				</td>
			
				<td class="button" id="toolbar-help">
				<a href="#"   class="toolbar">
				<span class="icon-32-help" title="<?php echo ucfirst($translate["aide"]); ?>">
				</span>
				<?php echo ucfirst($translate["aide"]); ?>
				</a>
				</td>

			</tr>
		</table>
		<?php
		$div_titre_menu_central = "<div class=\"header icon-48-user\">". ucfirst($translate["departement"])." : <small><small>[ ". ucfirst($translate["nouveau"]) ." ]</small></small></div>";
		break;

	 	case "dep_view" :
			?>
			<table class="toolbar">
				<tr>	
					<td class="button" id="toolbar-save">
					<a href="#" onclick="javascript:on_dep_update_valid('<?php echo $siteweb->get_url()."/utilisateur/traitements/partie_centrale.php" ?>' , '<?php echo $siteweb->get_url(); ?>');" class="toolbar">
					<span class="icon-32-apply" title="<?php echo ucfirst($translate["modifier"]); ?>">
					</span>
					<?php echo ucfirst($translate["modifier"]); ?>
					</a>
					</td>
				
					<td class="button" id="toolbar-apply">
					<a href="#" onclick="javascript:window.history.back();" class="toolbar">
					<span class="icon-32-cancel" title="<?php echo ucfirst($translate["annuler"]); ?>">
					</span>
					<?php echo ucfirst($translate["annuler"]); ?>
					</a>
					</td>
					
					<td class="button" id="toolbar-save">
					<a href="#" onclick="javascript:on_dep_delete_valid();" class="toolbar">
					<span class="icon-32-trash" title="<?php echo ucfirst($translate["supprimer"]); ?>">
					</span>
					<?php echo ucfirst($translate["supprimer"]); ?>
					</a>
					</td>
					
					<td class="button" id="toolbar-preview">
					<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=dep_search&lang={$lang}"; ?>';" class="toolbar">
					<span class="icon-32-preview" title="<?php echo ucfirst($translate["recherche"]); ?>">
					</span>
					<?php echo ucfirst($translate["recherche"]); ?>
					</a>
					</td>

					<td class="button" id="toolbar-save">
					<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=dep_create&lang={$lang}"; ?>';" class="toolbar">
					<span class="icon-32-new" title="<?php echo ucfirst($translate["nouveau"]); ?>">
					</span>
					<?php echo ucfirst($translate["nouveau"]); ?>
					</a>
					</td>
							
				<td class="button" id="toolbar-back">
					<a href="#" onclick="javascript:window.go(-1);" class="toolbar">
					<span class="icon-32-back" title="<?php echo ucfirst($translate["page_precedent"]); ?>">
					</span>
					<?php echo ucfirst($translate["precedent"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-forward">
					<a href="#" onclick="javascript:window.history.go(1);" class="toolbar">
					<span class="icon-32-forward" title="<?php echo ucfirst($translate["page_suivante"]); ?>">
					</span>
					<?php echo ucfirst($translate["suivant"]); ?>
					</a>
				</td>
			
				<td class="button" id="toolbar-help">
				<a href="#"   class="toolbar">
				<span class="icon-32-help" title="<?php echo ucfirst($translate["aide"]); ?>">
				</span>
				<?php echo ucfirst($translate["aide"]); ?>
				</a>
				</td>

				</tr>
			</table>
			
		<?php
		$div_titre_menu_central = "<div class=\"header icon-48-user\">". ucfirst($translate["departement"])." : <small><small>[ ". ucfirst($translate["consultation"]) ." ]</small></small></div>";
		break;


	 	case "profi_search" :
		?>
		<table class="toolbar">
			<tr>	
				<td class="button" id="toolbar-save">
				<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=profi_create&lang={$lang}"; ?>';" class="toolbar">
				<span class="icon-32-new" title="<?php echo ucfirst($translate["nouveau"]); ?>">
				</span>
				<?php echo ucfirst($translate["nouveau"]); ?>
				</a>
				</td>

				<td class="button" id="toolbar-back">
					<a href="#" onclick="javascript:window.go(-1);" class="toolbar">
					<span class="icon-32-back" title="<?php echo ucfirst($translate["page_precedent"]); ?>">
					</span>
					<?php echo ucfirst($translate["precedent"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-forward">
					<a href="#" onclick="javascript:window.history.go(1);" class="toolbar">
					<span class="icon-32-forward" title="<?php echo ucfirst($translate["page_suivante"]); ?>">
					</span>
					<?php echo ucfirst($translate["suivant"]); ?>
					</a>
				</td>
			
				<td class="button" id="toolbar-help">
				<a href="#"   class="toolbar">
				<span class="icon-32-help" title="<?php echo ucfirst($translate["aide"]); ?>">
				</span>
				<?php echo ucfirst($translate["aide"]); ?>
				</a>
				</td>
				
			</tr>
		</table>
		<?php
		$div_titre_menu_central = "<div class=\"header icon-48-user\">". ucfirst($translate["profil"])." : <small><small>[ ". ucfirst($translate["recherche"]) ." ]</small></small></div>";
		break;

	 	case "profi_create" :
		?>
		<table class="toolbar">
			<tr>	
			
				<td class="button" id="toolbar-save">
				<a href="#" onclick="javascript:on_profil_create_valid();" class="toolbar">
				<span class="icon-32-save" title="<?php echo ucfirst($translate["enregistrer"]); ?>">
				</span>
				<?php echo ucfirst($translate["enregistrer"]); ?>
				</a>
				</td>
				
				<td class="button" id="toolbar-apply">
				<a href="#" onclick="javascript:window.history.back();" class="toolbar">
				<span class="icon-32-cancel" title="<?php echo ucfirst($translate["annuler"]); ?>">
				</span>
				<?php echo ucfirst($translate["annuler"]); ?>
				</a>
				</td>
				
			
				<td class="button" id="toolbar-save">
				<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=profi_create&lang={$lang}"; ?>';" class="toolbar">
				<span class="icon-32-new" title="<?php echo ucfirst($translate["nouveau"]); ?>">
				</span>
				<?php echo ucfirst($translate["nouveau"]); ?>
				</a>
				</td>
			
				<td class="button" id="toolbar-preview">
				<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=profi_search&lang={$lang}"; ?>';" class="toolbar">
				<span class="icon-32-preview" title="<?php echo ucfirst($translate["recherche"]); ?>">
				</span>
				<?php echo ucfirst($translate["recherche"]); ?>
				</a>
				</td>

				<td class="button" id="toolbar-back">
					<a href="#" onclick="javascript:window.go(-1);" class="toolbar">
					<span class="icon-32-back" title="<?php echo ucfirst($translate["page_precedent"]); ?>">
					</span>
					<?php echo ucfirst($translate["precedent"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-forward">
					<a href="#" onclick="javascript:window.history.go(1);" class="toolbar">
					<span class="icon-32-forward" title="<?php echo ucfirst($translate["page_suivante"]); ?>">
					</span>
					<?php echo ucfirst($translate["suivant"]); ?>
					</a>
				</td>

				<td class="button" id="toolbar-help">
				<a href="#"   class="toolbar">
				<span class="icon-32-help" title="<?php echo ucfirst($translate["aide"]); ?>">
				</span>
				<?php echo ucfirst($translate["aide"]); ?>
				</a>
				</td>
			</tr>
		</table>
		<?php
		$div_titre_menu_central = "<div class=\"header icon-48-user\">". ucfirst($translate["profil"])." : <small><small>[ ". ucfirst($translate["nouveau"]) ." ]</small></small></div>";
		break;

	 	case "profi_view" :
			?>
			<table class="toolbar">
				<tr>	
					<td class="button" id="toolbar-save">
					<a href="#" onclick="javascript:on_profil_update_valid('<?php echo $siteweb->get_url()."/utilisateur/traitements/partie_centrale.php" ?>' , '<?php echo $siteweb->get_url(); ?>');" class="toolbar">
					<span class="icon-32-apply" title="<?php echo ucfirst($translate["modifier"]); ?>">
					</span>
					<?php echo ucfirst($translate["modifier"]); ?>
					</a>
					</td>
				
					<td class="button" id="toolbar-apply">
					<a href="#" onclick="javascript:window.history.back();" class="toolbar">
					<span class="icon-32-cancel" title="<?php echo ucfirst($translate["annuler"]); ?>">
					</span>
					<?php echo ucfirst($translate["annuler"]); ?>
					</a>
					</td>

					<td class="button" id="toolbar-save">
					<a href="#" onclick="javascript:on_profil_delete_valid();" class="toolbar">
					<span class="icon-32-trash" title="<?php echo ucfirst($translate["supprimer"]); ?>">
					</span>
					<?php echo ucfirst($translate["supprimer"]); ?>
					</a>
					</td>
					
					<td class="button" id="toolbar-preview">
					<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=profi_search&lang={$lang}"; ?>';" class="toolbar">
					<span class="icon-32-preview" title="<?php echo ucfirst($translate["recherche"]); ?>">
					</span>
					<?php echo ucfirst($translate["recherche"]); ?>
					</a>
					</td>

					<td class="button" id="toolbar-save">
					<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=profi_create&lang={$lang}"; ?>';" class="toolbar">
					<span class="icon-32-new" title="<?php echo ucfirst($translate["nouveau"]); ?>">
					</span>
					<?php echo ucfirst($translate["nouveau"]); ?>
					</a>
					</td>

				<td class="button" id="toolbar-back">
					<a href="#" onclick="javascript:window.go(-1);" class="toolbar">
					<span class="icon-32-back" title="<?php echo ucfirst($translate["page_precedent"]); ?>">
					</span>
					<?php echo ucfirst($translate["precedent"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-forward">
					<a href="#" onclick="javascript:window.history.go(1);" class="toolbar">
					<span class="icon-32-forward" title="<?php echo ucfirst($translate["page_suivante"]); ?>">
					</span>
					<?php echo ucfirst($translate["suivant"]); ?>
					</a>
				</td>
					
					<td class="button" id="toolbar-help">
					<a href="#"   class="toolbar">
					<span class="icon-32-help" title="<?php echo ucfirst($translate["aide"]); ?>">
					</span>
					<?php echo ucfirst($translate["aide"]); ?>
					</a>
					</td>
				</tr>
			</table>
			
		<?php
		$div_titre_menu_central = "<div class=\"header icon-48-user\">". ucfirst($translate["profil"])." : <small><small>[ ". ucfirst($translate["consultation"]) ." ]</small></small></div>";
		break;

	 	case "groupe_search" :
		?>
		<table class="toolbar">
			<tr>	
				<td class="button" id="toolbar-save">
				<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=groupe_create&lang={$lang}"; ?>';" class="toolbar">
				<span class="icon-32-new" title="<?php echo ucfirst($translate["nouveau"]); ?>">
				</span>
				<?php echo ucfirst($translate["nouveau"]); ?>
				</a>
				</td>

				<td class="button" id="toolbar-back">
					<a href="#" onclick="javascript:window.go(-1);" class="toolbar">
					<span class="icon-32-back" title="<?php echo ucfirst($translate["page_precedent"]); ?>">
					</span>
					<?php echo ucfirst($translate["precedent"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-forward">
					<a href="#" onclick="javascript:window.history.go(1);" class="toolbar">
					<span class="icon-32-forward" title="<?php echo ucfirst($translate["page_suivante"]); ?>">
					</span>
					<?php echo ucfirst($translate["suivant"]); ?>
					</a>
				</td>
				
				
				<td class="button" id="toolbar-help">
				<a href="#"   class="toolbar">
				<span class="icon-32-help" title="<?php echo ucfirst($translate["aide"]); ?>">
				</span>
				<?php echo ucfirst($translate["aide"]); ?>
				</a>
				</td>
			</tr>
		</table>
		<?php
		$div_titre_menu_central = "<div class=\"header icon-48-user\">". ucfirst($translate["groupe"])." : <small><small>[ ". ucfirst($translate["recherche"]) ." ]</small></small></div>";
		break;

	 	case "groupe_create" :
		?>
		<table class="toolbar">
			<tr>	
			
				<td class="button" id="toolbar-save">
				<a href="#" onclick="javascript:on_groupe_create_valid('<?php echo $siteweb->get_url()."/utilisateur/traitements/tgroupe_create_valid.php" ?>');" class="toolbar">
				<span class="icon-32-save" title="<?php echo ucfirst($translate["enregistrer"]); ?>">
				</span>
				<?php echo ucfirst($translate["enregistrer"]); ?>
				</a>
				</td>
				
				<td class="button" id="toolbar-apply">
				<a href="#" onclick="javascript:window.history.back();" class="toolbar">
				<span class="icon-32-cancel" title="<?php echo ucfirst($translate["annuler"]); ?>">
				</span>
				<?php echo ucfirst($translate["annuler"]); ?>
				</a>
				</td>
				
			
				<td class="button" id="toolbar-save">
				<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=groupe_create&lang={$lang}"; ?>';" class="toolbar">
				<span class="icon-32-new" title="<?php echo ucfirst($translate["nouveau"]); ?>">
				</span>
				<?php echo ucfirst($translate["nouveau"]); ?>
				</a>
				</td>
			
				<td class="button" id="toolbar-preview">
				<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=groupe_search&lang={$lang}"; ?>';" class="toolbar">
				<span class="icon-32-preview" title="<?php echo ucfirst($translate["recherche"]); ?>">
				</span>
				<?php echo ucfirst($translate["recherche"]); ?>
				</a>
				</td>

				<td class="button" id="toolbar-back">
					<a href="#" onclick="javascript:window.go(-1);" class="toolbar">
					<span class="icon-32-back" title="<?php echo ucfirst($translate["page_precedent"]); ?>">
					</span>
					<?php echo ucfirst($translate["precedent"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-forward">
					<a href="#" onclick="javascript:window.history.go(1);" class="toolbar">
					<span class="icon-32-forward" title="<?php echo ucfirst($translate["page_suivante"]); ?>">
					</span>
					<?php echo ucfirst($translate["suivant"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-help">
				<a href="#"   class="toolbar">
				<span class="icon-32-help" title="<?php echo ucfirst($translate["aide"]); ?>">
				</span>
				<?php echo ucfirst($translate["aide"]); ?>
				</a>
				</td>
			</tr>
		</table>
		<?php
		$div_titre_menu_central = "<div class=\"header icon-48-user\">". ucfirst($translate["groupe"])." : <small><small>[ ". ucfirst($translate["nouveau"]) ." ]</small></small></div>";
		break;

	 	case "groupe_view" :
			?>
			<table class="toolbar">
				<tr>	
					<td class="button" id="toolbar-save">
					<a href="#" onclick="javascript:on_groupe_update_valid('<?php echo $siteweb->get_url()."/utilisateur/traitements/partie_centrale.php" ?>');" class="toolbar">
					<span class="icon-32-apply" title="<?php echo ucfirst($translate["modifier"]); ?>">
					</span>
					<?php echo ucfirst($translate["modifier"]); ?>
					</a>
					</td>
				
					<td class="button" id="toolbar-apply">
					<a href="#" onclick="javascript:document.getElementById('form_groupe_view').reset();" class="toolbar">
					<span class="icon-32-cancel" title="<?php echo ucfirst($translate["annuler"]); ?>">
					</span>
					<?php echo ucfirst($translate["annuler"]); ?>
					</a>
					</td>

					<td class="button" id="toolbar-save">
					<a href="#" onclick="javascript:on_groupe_delete_valid();" class="toolbar">
					<span class="icon-32-trash" title="<?php echo ucfirst($translate["supprimer"]); ?>">
					</span>
					<?php echo ucfirst($translate["supprimer"]); ?>
					</a>
					</td>
					
					<td class="button" id="toolbar-preview">
					<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=groupe_search&lang={$lang}"; ?>';" class="toolbar">
					<span class="icon-32-preview" title="<?php echo ucfirst($translate["recherche"]); ?>">
					</span>
					<?php echo ucfirst($translate["recherche"]); ?>
					</a>
					</td>

					<td class="button" id="toolbar-save">
					<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=groupe_create&lang={$lang}"; ?>';" class="toolbar">
					<span class="icon-32-new" title="<?php echo ucfirst($translate["nouveau"]); ?>">
					</span>
					<?php echo ucfirst($translate["nouveau"]); ?>
					</a>
					</td>

				<td class="button" id="toolbar-back">
					<a href="#" onclick="javascript:window.go(-1);" class="toolbar">
					<span class="icon-32-back" title="<?php echo ucfirst($translate["page_precedent"]); ?>">
					</span>
					<?php echo ucfirst($translate["precedent"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-forward">
					<a href="#" onclick="javascript:window.history.go(1);" class="toolbar">
					<span class="icon-32-forward" title="<?php echo ucfirst($translate["page_suivante"]); ?>">
					</span>
					<?php echo ucfirst($translate["suivant"]); ?>
					</a>
				</td>
					
					<td class="button" id="toolbar-help">
					<a href="#"   class="toolbar">
					<span class="icon-32-help" title="<?php echo ucfirst($translate["aide"]); ?>">
					</span>
					<?php echo ucfirst($translate["aide"]); ?>
					</a>
					</td>
				</tr>
			</table>
			
		<?php
		$div_titre_menu_central = "<div class=\"header icon-48-user\">". ucfirst($translate["groupe"])." : <small><small>[ ". ucfirst($translate["consultation"]) ." ]</small></small></div>";
		break;

	 	case "processus_search" :
		?>
		<table class="toolbar">
			<tr>	
				<td class="button" id="toolbar-save">
				<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=processus_create&lang={$lang}"; ?>';" class="toolbar">
				<span class="icon-32-new" title="<?php echo ucfirst($translate["nouveau"]); ?>">
				</span>
				<?php echo ucfirst($translate["nouveau"]); ?>
				</a>
				</td>

				<td class="button" id="toolbar-back">
					<a href="#" onclick="javascript:window.go(-1);" class="toolbar">
					<span class="icon-32-back" title="<?php echo ucfirst($translate["page_precedent"]); ?>">
					</span>
					<?php echo ucfirst($translate["precedent"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-forward">
					<a href="#" onclick="javascript:window.history.go(1);" class="toolbar">
					<span class="icon-32-forward" title="<?php echo ucfirst($translate["page_suivante"]); ?>">
					</span>
					<?php echo ucfirst($translate["suivant"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-help">
				<a href="#"   class="toolbar">
				<span class="icon-32-help" title="<?php echo ucfirst($translate["aide"]); ?>">
				</span>
				<?php echo ucfirst($translate["aide"]); ?>
				</a>
				</td>
			</tr>
		</table>
		<?php
		$div_titre_menu_central = "<div class=\"header icon-48-plugin\">". ucfirst($translate["processus"])." : <small><small>[ ". ucfirst($translate["recherche"]) ." ]</small></small></div>";
		break;

	 	case "processus_create" :
		?>
		<table class="toolbar">
			<tr>	
			
				<td class="button" id="toolbar-save">
				<a href="#" onclick="javascript:on_processus_create_valid('<?php echo $siteweb->get_url()."/workflow/traitements/tprocessus_create_valid.php" ?>');" class="toolbar">
				<span class="icon-32-save" title="<?php echo ucfirst($translate["enregistrer"]); ?>">
				</span>
				<?php echo ucfirst($translate["enregistrer"]); ?>
				</a>
				</td>
				
				<td class="button" id="toolbar-apply">
				<a href="#" onclick="javascript:window.history.back();" class="toolbar">
				<span class="icon-32-cancel" title="<?php echo ucfirst($translate["annuler"]); ?>">
				</span>
				<?php echo ucfirst($translate["annuler"]); ?>
				</a>
				</td>
				
			
				<td class="button" id="toolbar-save">
				<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=processus_create&lang={$lang}"; ?>';" class="toolbar">
				<span class="icon-32-new" title="<?php echo ucfirst($translate["nouveau"]); ?>">
				</span>
				<?php echo ucfirst($translate["nouveau"]); ?>
				</a>
				</td>
			
				<td class="button" id="toolbar-preview">
				<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=processus_search&lang={$lang}"; ?>';" class="toolbar">
				<span class="icon-32-preview" title="<?php echo ucfirst($translate["recherche"]); ?>">
				</span>
				<?php echo ucfirst($translate["recherche"]); ?>
				</a>
				</td>

				<td class="button" id="toolbar-back">
					<a href="#" onclick="javascript:window.go(-1);" class="toolbar">
					<span class="icon-32-back" title="<?php echo ucfirst($translate["page_precedent"]); ?>">
					</span>
					<?php echo ucfirst($translate["precedent"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-forward">
					<a href="#" onclick="javascript:window.history.go(1);" class="toolbar">
					<span class="icon-32-forward" title="<?php echo ucfirst($translate["page_suivante"]); ?>">
					</span>
					<?php echo ucfirst($translate["suivant"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-help">
				<a href="#"   class="toolbar">
				<span class="icon-32-help" title="<?php echo ucfirst($translate["aide"]); ?>">
				</span>
				<?php echo ucfirst($translate["aide"]); ?>
				</a>
				</td>
			</tr>
		</table>
		<?php
		$div_titre_menu_central = "<div class=\"header icon-48-plugin\">". ucfirst($translate["processus"])." : <small><small>[ ". ucfirst($translate["nouveau"]) ." ]</small></small></div>";
		break;

	 	case "processus_view" :
		?>
			<table class="toolbar">
				<tr>	
					<td class="button" id="toolbar-save">
					<a href="#" onclick="javascript:on_processus_update_valid('<?php echo $siteweb->get_url()."/workflow/traitements/partie_centrale.php" ?>');" class="toolbar">
					<span class="icon-32-apply" title="<?php echo ucfirst($translate["modifier"]); ?>">
					</span>
					<?php echo ucfirst($translate["modifier"]); ?>
					</a>
					</td>
				
					<td class="button" id="toolbar-apply">
					<a href="#" onclick="javascript:window.history.back();" class="toolbar">
					<span class="icon-32-cancel" title="<?php echo ucfirst($translate["annuler"]); ?>">
					</span>
					<?php echo ucfirst($translate["annuler"]); ?>
					</a>
					</td>

					<td class="button" id="toolbar-save">
					<a href="#" onclick="javascript:on_processus_delete_valid();" class="toolbar">
					<span class="icon-32-trash" title="<?php echo ucfirst($translate["supprimer"]); ?>">
					</span>
					<?php echo ucfirst($translate["supprimer"]); ?>
					</a>
					</td>
					
					<td class="button" id="toolbar-preview">
					<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=processus_search&lang={$lang}"; ?>';" class="toolbar">
					<span class="icon-32-preview" title="<?php echo ucfirst($translate["recherche"]); ?>">
					</span>
					<?php echo ucfirst($translate["recherche"]); ?>
					</a>
					</td>

					<td class="button" id="toolbar-save">
					<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=processus_create&lang={$lang}"; ?>';" class="toolbar">
					<span class="icon-32-new" title="<?php echo ucfirst($translate["nouveau"]); ?>">
					</span>
					<?php echo ucfirst($translate["nouveau"]); ?>
					</a>
					</td>

				<td class="button" id="toolbar-back">
					<a href="#" onclick="javascript:window.go(-1);" class="toolbar">
					<span class="icon-32-back" title="<?php echo ucfirst($translate["page_precedent"]); ?>">
					</span>
					<?php echo ucfirst($translate["precedent"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-forward">
					<a href="#" onclick="javascript:window.history.go(1);" class="toolbar">
					<span class="icon-32-forward" title="<?php echo ucfirst($translate["page_suivante"]); ?>">
					</span>
					<?php echo ucfirst($translate["suivant"]); ?>
					</a>
				</td>
					
					<td class="button" id="toolbar-help">
					<a href="#"   class="toolbar">
					<span class="icon-32-help" title="<?php echo ucfirst($translate["aide"]); ?>">
					</span>
					<?php echo ucfirst($translate["aide"]); ?>
					</a>
					</td>
				</tr>
			</table>
		<?php
		$div_titre_menu_central = "<div class=\"header icon-48-plugin\">". ucfirst($translate["processus"])." : <small><small>[ ". ucfirst($translate["consultation"]) ." ]</small></small></div>";
		break;

	 	case "accueil_user" :
		?>
		<table class="toolbar">
			<tr>	

				<td class="button" id="toolbar-back">
					<a href="#" onclick="javascript:window.go(-1);" class="toolbar">
					<span class="icon-32-back" title="<?php echo ucfirst($translate["page_precedent"]); ?>">
					</span>
					<?php echo ucfirst($translate["precedent"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-forward">
					<a href="#" onclick="javascript:window.history.go(1);" class="toolbar">
					<span class="icon-32-forward" title="<?php echo ucfirst($translate["page_suivante"]); ?>">
					</span>
					<?php echo ucfirst($translate["suivant"]); ?>
					</a>
				</td>
			
				<td class="button" id="toolbar-help">
				<a href="#"   class="toolbar">
				<span class="icon-32-help" title="<?php echo ucfirst($translate["aide"]); ?>">
				</span>
				<?php echo ucfirst($translate["aide"]); ?>
				</a>
				</td>
			</tr>
		</table>
		<?php

		$div_titre_menu_central = "<div class=\"header icon-48-frontpage\">".ucfirst($translate["bienvenue"])."  <small><small> " . ucfirst($translate["login"])." </small></small></div> ";

		break;


	 	case "tache_search" :

		?>
		<table class="toolbar">
			<tr>	
				<td class="button" id="toolbar-save">
				<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=tache_create&lang={$lang}"; ?>';" class="toolbar">
				<span class="icon-32-new" title="<?php echo ucfirst($translate["nouveau"]); ?>">
				</span>
				<?php echo ucfirst($translate["nouveau"]); ?>
				</a>
				</td>

				<td class="button" id="toolbar-back">
					<a href="#" onclick="javascript:window.go(-1);" class="toolbar">
					<span class="icon-32-back" title="<?php echo ucfirst($translate["page_precedent"]); ?>">
					</span>
					<?php echo ucfirst($translate["precedent"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-forward">
					<a href="#" onclick="javascript:window.history.go(1);" class="toolbar">
					<span class="icon-32-forward" title="<?php echo ucfirst($translate["page_suivante"]); ?>">
					</span>
					<?php echo ucfirst($translate["suivant"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-help">
				<a href="#"   class="toolbar">
				<span class="icon-32-help" title="<?php echo ucfirst($translate["aide"]); ?>">
				</span>
				<?php echo ucfirst($translate["aide"]); ?>
				</a>
				</td>
			</tr>
		</table>
		<?php
		$div_titre_menu_central = "<div class=\"header icon-48-plugin\">". ucfirst($translate["tache"])." : <small><small>[ ". ucfirst($translate["recherche"]) ." ]</small></small></div>";
		break;

	 	case "tache_create" :
		?>
		<table class="toolbar">
			<tr>	
			
				<td class="button" id="toolbar-save">
				<a href="#" onclick="javascript:on_tache_create_valid();" class="toolbar">
				<span class="icon-32-save" title="<?php echo ucfirst($translate["enregistrer"]); ?>">
				</span>
				<?php echo ucfirst($translate["enregistrer"]); ?>
				</a>
				</td>
				
				<td class="button" id="toolbar-apply">
				<a href="#" onclick="javascript:window.history.back();" class="toolbar">
				<span class="icon-32-cancel" title="<?php echo ucfirst($translate["annuler"]); ?>">
				</span>
				<?php echo ucfirst($translate["annuler"]); ?>
				</a>
				</td>
				
			
				<td class="button" id="toolbar-save">
				<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=tache_create&lang={$lang}"; ?>';" class="toolbar">
				<span class="icon-32-new" title="<?php echo ucfirst($translate["nouveau"]); ?>">
				</span>
				<?php echo ucfirst($translate["nouveau"]); ?>
				</a>
				</td>
			
				<td class="button" id="toolbar-preview">
				<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=tache_search&lang={$lang}"; ?>';" class="toolbar">
				<span class="icon-32-preview" title="<?php echo ucfirst($translate["recherche"]); ?>">
				</span>
				<?php echo ucfirst($translate["recherche"]); ?>
				</a>
				</td>

				<td class="button" id="toolbar-back">
					<a href="#" onclick="javascript:window.go(-1);" class="toolbar">
					<span class="icon-32-back" title="<?php echo ucfirst($translate["page_precedent"]); ?>">
					</span>
					<?php echo ucfirst($translate["precedent"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-forward">
					<a href="#" onclick="javascript:window.history.go(1);" class="toolbar">
					<span class="icon-32-forward" title="<?php echo ucfirst($translate["page_suivante"]); ?>">
					</span>
					<?php echo ucfirst($translate["suivant"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-help">
				<a href="#"   class="toolbar">
				<span class="icon-32-help" title="<?php echo ucfirst($translate["aide"]); ?>">
				</span>
				<?php echo ucfirst($translate["aide"]); ?>
				</a>
				</td>
			</tr>
		</table>
		<?php
		$div_titre_menu_central = "<div class=\"header icon-48-plugin\">". ucfirst($translate["tache"])." : <small><small>[ ". ucfirst($translate["nouveau"]) ." ]</small></small></div>";
		break;

	 	case "tache_view" :
		?>
			<table class="toolbar">
				<tr>	
					<td class="button" id="toolbar-save">
					<a href="#" onclick="javascript:on_tache_update_valid('<?php echo $siteweb->get_url()."/workflow/traitements/partie_centrale.php" ?>');" class="toolbar">
					<span class="icon-32-apply" title="<?php echo ucfirst($translate["modifier"]); ?>">
					</span>
					<?php echo ucfirst($translate["modifier"]); ?>
					</a>
					</td>
				
					<td class="button" id="toolbar-apply">
					<a href="#" onclick="javascript:document.getElementById('form_tache_view').reset();" class="toolbar">
					<span class="icon-32-cancel" title="<?php echo ucfirst($translate["annuler"]); ?>">
					</span>
					<?php echo ucfirst($translate["annuler"]); ?>
					</a>
					</td>
					
					<td class="button" id="toolbar-save">
					<a href="#" onclick="javascript:on_tache_delete_valid();" class="toolbar">
					<span class="icon-32-trash" title="<?php echo ucfirst($translate["supprimer"]); ?>">
					</span>
					<?php echo ucfirst($translate["supprimer"]); ?>
					</a>
					</td>
					
					<td class="button" id="toolbar-preview">
					<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=tache_search&lang={$lang}"; ?>';" class="toolbar">
					<span class="icon-32-preview" title="<?php echo ucfirst($translate["recherche"]); ?>">
					</span>
					<?php echo ucfirst($translate["recherche"]); ?>
					</a>
					</td>

					<td class="button" id="toolbar-save">
					<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=tache_create&lang={$lang}"; ?>';" class="toolbar">
					<span class="icon-32-new" title="<?php echo ucfirst($translate["nouveau"]); ?>">
					</span>
					<?php echo ucfirst($translate["nouveau"]); ?>
					</a>
					</td>

				<td class="button" id="toolbar-back">
					<a href="#" onclick="javascript:window.go(-1);" class="toolbar">
					<span class="icon-32-back" title="<?php echo ucfirst($translate["page_precedent"]); ?>">
					</span>
					<?php echo ucfirst($translate["precedent"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-forward">
					<a href="#" onclick="javascript:window.history.go(1);" class="toolbar">
					<span class="icon-32-forward" title="<?php echo ucfirst($translate["page_suivante"]); ?>">
					</span>
					<?php echo ucfirst($translate["suivant"]); ?>
					</a>
				</td>
					
					<td class="button" id="toolbar-help">
					<a href="#"   class="toolbar">
					<span class="icon-32-help" title="<?php echo ucfirst($translate["aide"]); ?>">
					</span>
					<?php echo ucfirst($translate["aide"]); ?>
					</a>
					</td>
				</tr>
			</table>
			
		<?php
		$div_titre_menu_central = "<div class=\"header icon-48-plugin\">". ucfirst($translate["tache"])." : <small><small>[ ". ucfirst($translate["consultation"]) ." ]</small></small></div>";
		break;

	 	case "circuit_search" :
		?>
		<table class="toolbar">
			<tr>	
				<td class="button" id="toolbar-save">
				<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=cir_create1&lang={$lang}"; ?>';" class="toolbar">
				<span class="icon-32-new" title="<?php echo ucfirst($translate["nouveau"]); ?>">
				</span>
				<?php echo ucfirst($translate["nouveau"]); ?>
				</a>
				</td>

				<td class="button" id="toolbar-back">
					<a href="#" onclick="javascript:window.go(-1);" class="toolbar">
					<span class="icon-32-back" title="<?php echo ucfirst($translate["page_precedent"]); ?>">
					</span>
					<?php echo ucfirst($translate["precedent"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-forward">
					<a href="#" onclick="javascript:window.history.go(1);" class="toolbar">
					<span class="icon-32-forward" title="<?php echo ucfirst($translate["page_suivante"]); ?>">
					</span>
					<?php echo ucfirst($translate["suivant"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-help">
				<a href="#"   class="toolbar">
				<span class="icon-32-help" title="<?php echo ucfirst($translate["aide"]); ?>">
				</span>
				<?php echo ucfirst($translate["aide"]); ?>
				</a>
				</td>
			</tr>
		</table>
		<?php
		$div_titre_menu_central = "<div class=\"header icon-48-plugin\">". ucfirst($translate["circuit"])." : <small><small>[ ". ucfirst($translate["recherche"]) ." ]</small></small></div>";
		break;

	 	case "cir_create1" :
		?>
		<table class="toolbar">
			<tr>	
			
				<td class="button" id="toolbar-save">
				<a href="#" onclick="javascript:on_circuit_create1_valid();" class="toolbar">
				<span class="icon-32-save" title="<?php echo ucfirst($translate["enregistrer"]); ?>">
				</span>
				<?php echo ucfirst($translate["enregistrer"]); ?>
				</a>
				</td>
				
				<td class="button" id="toolbar-apply">
				<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=circuit_search&lang={$lang}"; ?>';" class="toolbar">
				<span class="icon-32-cancel" title="<?php echo ucfirst($translate["annuler"]); ?>">
				</span>
				<?php echo ucfirst($translate["annuler"]); ?>
				</a>
				</td>
				
			
				<td class="button" id="toolbar-save">
				<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=cir_create1&lang={$lang}"; ?>';" class="toolbar">
				<span class="icon-32-new" title="<?php echo ucfirst($translate["nouveau"]); ?>">
				</span>
				<?php echo ucfirst($translate["nouveau"]); ?>
				</a>
				</td>
			
				<td class="button" id="toolbar-preview">
				<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=circuit_search&lang={$lang}"; ?>';" class="toolbar">
				<span class="icon-32-preview" title="<?php echo ucfirst($translate["recherche"]); ?>">
				</span>
				<?php echo ucfirst($translate["recherche"]); ?>
				</a>
				</td>

				<td class="button" id="toolbar-back">
					<a href="#" onclick="javascript:window.go(-1);" class="toolbar">
					<span class="icon-32-back" title="<?php echo ucfirst($translate["page_precedent"]); ?>">
					</span>
					<?php echo ucfirst($translate["precedent"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-forward">
					<a href="#" onclick="javascript:window.history.go(1);" class="toolbar">
					<span class="icon-32-forward" title="<?php echo ucfirst($translate["page_suivante"]); ?>">
					</span>
					<?php echo ucfirst($translate["suivant"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-help">
				<a href="#"   class="toolbar">
				<span class="icon-32-help" title="<?php echo ucfirst($translate["aide"]); ?>">
				</span>
				<?php echo ucfirst($translate["aide"]); ?>
				</a>
				</td>
			</tr>
		</table>
		<?php
		$div_titre_menu_central = "<div class=\"header icon-48-plugin\">". ucfirst($translate["circuit"])." : <small><small>[ ". ucfirst($translate["nouveau"]) ." ]</small></small></div>";
		break;

	 	case "cir_create2" :
	 		//récupérer le code du circuit éventuellement posté
	 		$data = $_POST;
	 		foreach ($_GET as $lkey => $lvalue)
	 		{
	 			$data[$lkey] = $lvalue;
	 		}
	 		$codecircuit = $data["codecircuit"];

		?>
		<table class="toolbar">
			<tr>	
				<td class="button" id="toolbar-backward">
				<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=cir_create1&codecircuit={$codecircuit}&lang={$lang}"; ?>';" class="toolbar">
				<span class="icon-32-backward" title="<?php echo ucfirst($translate["precedent"]); ?>">
				</span>
				<?php echo ucfirst($translate["precedent"]); ?>
				</a>
				</td>
			
				<td class="button" id="toolbar-forward">
				<a href="#" onclick="javascript:on_circuit_create1_valid();" class="toolbar">
				<span class="icon-32-forward" title="<?php echo ucfirst($translate["suivant"]); ?>">
				</span>
				<?php echo ucfirst($translate["suivant"]); ?>
				</a>
				</td>
				
				<td class="button" id="toolbar-apply">
				<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=circuit_search&lang={$lang}"; ?>';" class="toolbar">
				<span class="icon-32-cancel" title="<?php echo ucfirst($translate["annuler"]); ?>">
				</span>
				<?php echo ucfirst($translate["annuler"]); ?>
				</a>
				</td>
							
				<td class="button" id="toolbar-save">
				<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=cir_create1&lang={$lang}"; ?>';" class="toolbar">
				<span class="icon-32-new" title="<?php echo ucfirst($translate["nouveau"]); ?>">
				</span>
				<?php echo ucfirst($translate["nouveau"]); ?>
				</a>
				</td>
			
				<td class="button" id="toolbar-preview">
				<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=circuit_search&lang={$lang}"; ?>';" class="toolbar">
				<span class="icon-32-preview" title="<?php echo ucfirst($translate["recherche"]); ?>">
				</span>
				<?php echo ucfirst($translate["recherche"]); ?>
				</a>
				</td>
						
				<td class="button" id="toolbar-help">
				<a href="#"   class="toolbar">
				<span class="icon-32-help" title="<?php echo ucfirst($translate["aide"]); ?>">
				</span>
				<?php echo ucfirst($translate["aide"]); ?>
				</a>
				</td>
			</tr>
		</table>
		<?php
		$div_titre_menu_central = "<div class=\"header icon-48-plugin\">". ucfirst($translate["circuit"])." : <small><small>[ ". ucfirst($translate["nouveau"]) ." ]</small></small></div>";
		break;

	 	case "circuit_view" :
			?>
			<table class="toolbar">
				<tr>	
					<td class="button" id="toolbar-save">
					<a href="#" onclick="javascript:on_circuit_update_valid('<?php echo $siteweb->get_url()."/workflow/traitements/partie_centrale.php" ?>');" class="toolbar">
					<span class="icon-32-apply" title="<?php echo ucfirst($translate["modifier"]); ?>">
					</span>
					<?php echo ucfirst($translate["modifier"]); ?>
					</a>
					</td>
				
					<td class="button" id="toolbar-apply">
					<a href="#" onclick="javascript:document.getElementById('form_circuit_view').reset();" class="toolbar">
					<span class="icon-32-cancel" title="<?php echo ucfirst($translate["annuler"]); ?>">
					</span>
					<?php echo ucfirst($translate["annuler"]); ?>
					</a>
					</td>
					
					<td class="button" id="toolbar-archive">
					<a href="#" onclick="javascript:on_circuit_archiver_valid();" class="toolbar">
					<span class="icon-32-archive" title="<?php echo ucfirst($translate["archiver"]); ?>">
					</span>
					<?php echo ucfirst($translate["archiver"]); ?>
					</a>
					</td>

					<td class="button" id="toolbar-save">
					<a href="#" onclick="javascript:on_circuit_delete_valid();" class="toolbar">
					<span class="icon-32-trash" title="<?php echo ucfirst($translate["supprimer"]); ?>">
					</span>
					<?php echo ucfirst($translate["supprimer"]); ?>
					</a>
					</td>
					
					<td class="button" id="toolbar-preview">
					<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=circuit_search&lang={$lang}"; ?>';" class="toolbar">
					<span class="icon-32-preview" title="<?php echo ucfirst($translate["recherche"]); ?>">
					</span>
					<?php echo ucfirst($translate["recherche"]); ?>
					</a>
					</td>

					<td class="button" id="toolbar-save">
					<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=cir_create1&lang={$lang}"; ?>';" class="toolbar">
					<span class="icon-32-new" title="<?php echo ucfirst($translate["nouveau"]); ?>">
					</span>
					<?php echo ucfirst($translate["nouveau"]); ?>
					</a>
					</td>

				<td class="button" id="toolbar-back">
					<a href="#" onclick="javascript:window.go(-1);" class="toolbar">
					<span class="icon-32-back" title="<?php echo ucfirst($translate["page_precedent"]); ?>">
					</span>
					<?php echo ucfirst($translate["precedent"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-forward">
					<a href="#" onclick="javascript:window.history.go(1);" class="toolbar">
					<span class="icon-32-forward" title="<?php echo ucfirst($translate["page_suivante"]); ?>">
					</span>
					<?php echo ucfirst($translate["suivant"]); ?>
					</a>
				</td>
					
					<td class="button" id="toolbar-help">
					<a href="#"   class="toolbar">
					<span class="icon-32-help" title="<?php echo ucfirst($translate["aide"]); ?>">
					</span>
					<?php echo ucfirst($translate["aide"]); ?>
					</a>
					</td>
				</tr>
			</table>
			
		<?php
		$div_titre_menu_central = "<div class=\"header icon-48-plugin\">". ucfirst($translate["circuit"])." : <small><small>[ ". ucfirst($translate["consultation"]) ." ]</small></small></div>";
		break;


	 	case "cir_create1" :
		?>
		<table class="toolbar">
			<tr>	
				<td class="button" id="toolbar-save">
				<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=cir_create1&lang={$lang}"; ?>';" class="toolbar">
				<span class="icon-32-new" title="<?php echo ucfirst($translate["nouveau"]); ?>">
				</span>
				<?php echo ucfirst($translate["nouveau"]); ?>
				</a>
				</td>

				<td class="button" id="toolbar-back">
					<a href="#" onclick="javascript:window.go(-1);" class="toolbar">
					<span class="icon-32-back" title="<?php echo ucfirst($translate["page_precedent"]); ?>">
					</span>
					<?php echo ucfirst($translate["precedent"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-forward">
					<a href="#" onclick="javascript:window.history.go(1);" class="toolbar">
					<span class="icon-32-forward" title="<?php echo ucfirst($translate["page_suivante"]); ?>">
					</span>
					<?php echo ucfirst($translate["suivant"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-help">
				<a href="#"   class="toolbar">
				<span class="icon-32-help" title="<?php echo ucfirst($translate["aide"]); ?>">
				</span>
				<?php echo ucfirst($translate["aide"]); ?>
				</a>
				</td>
			</tr>
		</table>
		<?php
		$div_titre_menu_central = "<div class=\"header icon-48-plugin\">". ucfirst($translate["circuit"])." : <small><small>[ ". ucfirst($translate["recherche"]) ." ]</small></small></div>";
		break;


	 	case "doc_search" :
		?>
		<table class="toolbar">
			<tr>	

				<td class="button" id="toolbar-back">
					<a href="#" onclick="javascript:window.go(-1);" class="toolbar">
					<span class="icon-32-back" title="<?php echo ucfirst($translate["page_precedent"]); ?>">
					</span>
					<?php echo ucfirst($translate["precedent"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-forward">
					<a href="#" onclick="javascript:window.history.go(1);" class="toolbar">
					<span class="icon-32-forward" title="<?php echo ucfirst($translate["page_suivante"]); ?>">
					</span>
					<?php echo ucfirst($translate["suivant"]); ?>
					</a>
				</td>
			
				<td class="button" id="toolbar-help">
				<a href="#"   class="toolbar">
				<span class="icon-32-help" title="<?php echo ucfirst($translate["aide"]); ?>">
				</span>
				<?php echo ucfirst($translate["aide"]); ?>
				</a>
				</td>
			</tr>
		</table>
		<?php
		$div_titre_menu_central = "<div class=\"header icon-48-addedit\">". ucfirst($translate["document"])." : <small><small>[ ". ucfirst($translate["recherche"]) ." ]</small></small></div>";
		break;

	 	case "doc_create" :
	 	//case "workflow_create" :
	 		//on est sur une tache initiale. obtenir la liste des taches suivantes
	 		$ltache = new tache();
	 		$ltache->numtache = $numtache;
	 		$ltache->codecircuit = $codecircuit;
	 		$listetache = $ltache->rechercher();
	 		if ($ltache->has_exception()) die($ltache->get_exception());
	 		//print_r($listetache); die();
	 		//libérer la mémoire
	 		unset($ltache);
		?>
		<table class="toolbar">
			<tr>	
			
				<?php
				if (is_array($listetache))
				{
					foreach ($listetache as $linfo_tache)
					{
						echo "<td class=\"button\" id=\"toolbar-save\">"."\n";
						$lattributes = array("class"=>"toolbar");

						//la fonction associée à onclick varie suivant le type de tache prédéfinie
						switch (intval($linfo_tache["numtachesuiv"]))
						{      
							case -1 :	// Enregistrement
							case -3 :	// Modifier
							case -8 :	// Supprimer
							case -5 :	// Valider
							$lattributes["onclick"] = "javascript:on_workflow_doc_create('".$siteweb->get_url()."/workflow/traitements/partie_centrale.php"."', '".$siteweb->get_url()."' , ". $linfo_tache["numtachesuiv"] .");";
							break;
						}
						echo $siteweb->a_tag("<span class=\"icon-32-save\" title=\"".ucfirst($translate[$linfo_tache["libtachesuiv"]])."\"></span>".ucfirst($translate[$linfo_tache["libtachesuiv"]])
						, "#"
						, $lattributes
						, array()
						, ucfirst($translate[$linfo_tache["libtachesuiv"]]) );

						echo "</td>"."\n";
					}
				};
				?>			
			
				<!--<td class="button" id="toolbar-save">
				<a href="#" onclick="javascript:soumet('<?php echo $siteweb->get_url()."/ged/traitements/tdocument_create_valid.php" ?>');" class="toolbar">
				<span class="icon-32-save" title="<?php echo ucfirst($translate["enregistrer"]); ?>">
				</span>
				<?php echo ucfirst($translate["enregistrer"]); ?>
				</a>
				</td>-->
				
				<td class="button" id="toolbar-apply">
				<a href="#" onclick="javascript:window.history.back();" class="toolbar">
				<span class="icon-32-cancel" title="<?php echo ucfirst($translate["annuler"]); ?>">
				</span>
				<?php echo ucfirst($translate["annuler"]); ?>
				</a>
				</td>
							
				<td class="button" id="toolbar-preview">
				<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=doc_search&lang={$lang}"; ?>';" class="toolbar">
				<span class="icon-32-preview" title="<?php echo ucfirst($translate["recherche"]); ?>">
				</span>
				<?php echo ucfirst($translate["recherche"]); ?>
				</a>
				</td>
						
				<td class="button" id="toolbar-help">
				<a href="#"   class="toolbar">
				<span class="icon-32-help" title="<?php echo ucfirst($translate["aide"]); ?>">
				</span>
				<?php echo ucfirst($translate["aide"]); ?>
				</a>
				</td>
			</tr>
		</table>
		<?php
		switch(trim($typedoc))
		{
			case "dde_credit" :
				$div_titre_menu_central = "<div class=\"header icon-48-addedit\">". ucfirst($translate[$typedoc])." : <small><small>[ ". ucfirst($translate["nouvelle"]) ." ]</small></small></div>";
				break;
			case "dde_achat":
				$div_titre_menu_central = "<div class=\"header icon-48-addedit\">".ucfirst($translate["dde_achat"])." : <small> <small>[ ".ucfirst($translate["nouvelle"]) ." ]</small></small></div>";
				break;
			case "dde_conge":
				$div_titre_menu_central = "<div class=\"header icon-48-addedit\">".ucfirst($translate["dde_conge"])." : <small> <small>[ ".ucfirst($translate["nouvelle"]) ." ]</small></small></div>";
				break;
			default:
				$div_titre_menu_central = "<div class=\"header icon-48-addedit\">". ucfirst($translate["document"])." : <small><small>[ ". ucfirst($translate["nouveau"]) ." ]</small></small></div>";
				break;
		}
		break;
		
		case "workflow_update" :
	 		//on est sur une tache intermédiaire. obtenir la liste des taches suivantes
	 		$ltache = new tache();
	 		$ltache->numtacheprec = $numtache;
	 		$ltache->codecircuit = $codecircuit;
	 		$listetache = $ltache->rechercher();
	 		if ($ltache->has_exception()) die($ltache->get_exception());
	 		//print_r($listetache); die();
	 		//libérer la mémoire
	 		unset($ltache);
		?>
		<table class="toolbar">
			<tr>	
			
				<?php
				if (is_array($listetache))
				{
					foreach ($listetache as $linfo_tache)
					{
						echo "<td class=\"button\" id=\"toolbar-save\">"."\n";

						$lattributes = array("class"=>"toolbar");

						//la fonction assicié à onlick varie suivant le type de tache prédéfinie
						switch (intval($linfo_tache["numtache"]))
						{
							case -1 :	// Enregistrement
							$lattributes["onclick"] = "javascript:on_doc_create('".$siteweb->get_url()."/workflow/traitements/partie_centrale.php"."', '".$siteweb->get_url()."' , '-1' );";
							echo $siteweb->a_tag("<span class=\"icon-32-save\" title=\"".ucfirst($linfo_tache["numtache"])."\"></span>".ucfirst($linfo_tache["libtache"])
						, "#"
						, $lattributes
						, array()
						, ucfirst($linfo_tache["libtache"]) );
							break;
							case -3 :	// Modifier
							$lattributes["onclick"] = "javascript:on_workflow_doc_update_valid('".$siteweb->get_url()."/workflow/traitements/partie_centrale.php"."', '".$siteweb->get_url()."' , '-3' );";
							echo $siteweb->a_tag("<span class=\"icon-32-save\" title=\"".ucfirst($linfo_tache["numtache"])."\"></span>".ucfirst($linfo_tache["libtache"])
						, "#"
						, $lattributes
						, array()
						, ucfirst($linfo_tache["libtache"]) );
							break;
							case -8 :	// Supprimer
							$lattributes["onclick"] = "javascript:on_workflow_doc_delete_valid('".$siteweb->get_url()."/workflow/traitements/partie_centrale.php"."', '".$siteweb->get_url()."');";
							echo $siteweb->a_tag("<span class=\"icon-32-trash\" title=\"".ucfirst($linfo_tache["numtache"])."\"></span>".ucfirst($linfo_tache["libtache"])
						, "#"
						, $lattributes
						, array()
						, ucfirst($linfo_tache["libtache"]) );
							break;
						}
						

						echo "</td>"."\n";
					}
				};
				?>			
			
				<td class="button" id="toolbar-apply">
				<a href="#" onclick="javascript:window.history.back();" class="toolbar">
				<span class="icon-32-cancel" title="<?php echo ucfirst($translate["annuler"]); ?>">
				</span>
				<?php echo ucfirst($translate["annuler"]); ?>
				</a>
				</td>
							
				<td class="button" id="toolbar-preview">
				<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=doc_search&lang={$lang}"; ?>';" class="toolbar">
				<span class="icon-32-preview" title="<?php echo ucfirst($translate["recherche"]); ?>">
				</span>
				<?php echo ucfirst($translate["recherche"]); ?>
				</a>
				</td>
						
				<td class="button" id="toolbar-help">
				<a href="#"   class="toolbar">
				<span class="icon-32-help" title="<?php echo ucfirst($translate["aide"]); ?>">
				</span>
				<?php echo ucfirst($translate["aide"]); ?>
				</a>
				</td>
			</tr>
		</table>
		<?php
		
		switch(trim($typedoc))
		{
			case "dde_credit" :
				$div_titre_menu_central = "<div class=\"header icon-48-addedit\">". ucfirst($translate[$typedoc])." : <small><small>[ ". ucfirst($translate["consultation"]) ." ]</small></small></div>";
				break;
			case "dde_achat":
				$div_titre_menu_central = "<div class=\"header icon-48-addedit\">".ucfirst($translate["dde_achat"])." : <small> <small>[ ".ucfirst($translate["consultation"]) ." ]</small></small></div>";
				break;
			case "dde_conge":
				$div_titre_menu_central = "<div class=\"header icon-48-addedit\">".ucfirst($translate["dde_conge"])." : <small> <small>[ ".ucfirst($translate["nouvelle"]) ." ]</small></small></div>";
				break;
			default:
				$div_titre_menu_central = "<div class=\"header icon-48-addedit\">". ucfirst($translate["document"])." : <small><small>[ ". ucfirst($translate["nouveau"]) ." ]</small></small></div>";
				break;
		}
		break;		

		
	 	case "doc_view" :
	 		
			?>
			<table class="toolbar">
				<tr>	
					<td class="button" id="toolbar-save">
					<a href="#" onclick="javascript:on_doc_update_valid('<?php echo $siteweb->get_url()."/ged/traitements/partie_centrale.php" ?>');" class="toolbar">
					<span class="icon-32-apply" title="<?php echo ucfirst($translate["modifier"]); ?>">
					</span>
					<?php 
					
    require_once($siteweb->get_document_root().DS."ged".DS."classe".DS."document.class.php");
    $doc = new Document();
    $doc->numdoc = $numdoc ;
    if ( ! $doc->rechercher_tachecourante())  die($doc->get_exception());
    $listetachecourante = $doc->rechercher_tachecourante();
    
    require_once($siteweb->get_document_root().DS."workflow".DS."classe".DS."tache.class.php");
	$ltache = new tache();
	$ltache->numtache = $listetachecourante[0][numtache];
	if ( ! $ltache->rechercher_libelletachecourante()) die($ltache->get_exception());
    $listelibelletachecourante = $ltache->rechercher_libelletachecourante();
    $libelletachecourante = $listelibelletachecourante[0][libtache];
    echo ucfirst($libelletachecourante); 
    
                    ?>
					</a>
					</td>
				
				<?php 
				
	require_once($siteweb->get_document_root().DS."workflow".DS."classe".DS."circuit.class.php");
	//instancier un objet circuit
    $lcircuit = new circuit();    
    $lcircuit->codecircuit = $codecircuit;
    if ( ! $lcircuit->rechercher_tacheinitiale())  die($lcircuit->get_exception());
    $listecircuitroute=$lcircuit->rechercher_tacheinitiale();
    $numtacheinitiale=$listecircuitroute[0]["numtache"];//print_r($numtache);die("karante huit heures");
    			
				if ( ($numtache == $numtacheinitiale) or ($numtache == -7))
				{				
				?> 	
					<td class="button" id="toolbar-apply">
					<a href="#" onclick="javascript: on_doc_reject_valid('<?php echo $siteweb->get_url()."/ged/traitements/partie_centrale.php" ?>');" class="toolbar">
					<span class="icon-32-cancel" title="<?php echo ucfirst($translate["rejeter"]); ?>">
					</span>
					<?php echo ucfirst($translate["rejeter"]);$rejeter=true;global $rejeter;$_POST["rejeter"]=$rejeter; ?>
					</a>
					</td>
                <?php 
				}
				else 
				{				
                ?>   		
                    <td class="button" id="toolbar-apply">
					<a href="#" onclick="javascript:document.getElementById('form_doc_view').reset();" class="toolbar">
					<span class="icon-32-cancel" title="<?php echo ucfirst($translate["annuler"]); ?>">
					</span>
					<?php echo ucfirst($translate["annuler"]); ?>
					</a>
					</td>
                <?php 
				}								
                ?>
									
					<td class="button" id="toolbar-help">
					<a href="#"   class="toolbar">
					<span class="icon-32-help" title="<?php echo ucfirst($translate["aide"]); ?>">
					</span>
					<?php echo ucfirst($translate["aide"]); ?>
					</a>
					</td>
				</tr>
			</table>
			
		<?php
		switch(trim($typedoc))
		{
			case "dde_credit" :
				$div_titre_menu_central = "<div class=\"header icon-48-addedit\">". ucfirst($translate[$typedoc])." : <small><small>[ ". ucfirst($translate["consultation"]) ." ]</small></small></div>";
				break;
			case "dde_achat":
				$div_titre_menu_central = "<div class=\"header icon-48-addedit\">".ucfirst($translate["dde_achat"])." : <small> <small>[ ".ucfirst($translate["consultation"]) ." ]</small></small></div>";
				break;
			case "dde_conge":
				$div_titre_menu_central = "<div class=\"header icon-48-addedit\">".ucfirst($translate["dde_conge"])." : <small> <small>[ ".ucfirst($translate["consultation"]) ." ]</small></small></div>";
				break;
			default:
				$div_titre_menu_central = "<div class=\"header icon-48-addedit\">". ucfirst($translate["document"])." : <small><small>[ ". ucfirst($translate["consultation"]) ." ]</small></small></div>";
				break;
		}
		break;
        
		case "doc_update_reject" :
		?>
		
		<table class="toolbar">
			<tr>	
				<td class="button" id="toolbar-send">
				<a onclick="javascript:on_mail_create_valid_doc('<?php echo $siteweb->get_url(); ?>' , 'frm_create_mail','doc_update_reject');"  href="#" class="toolbar">
				<span class="icon-32-send" title="<?php echo ucfirst($translate["envoyer"]); ?>"></span>
				<?php echo ucfirst($translate["envoyer"]); ?>
				</a>
				</td>
			
				<td class="button" id="toolbar-apply">
				<a href="#" onclick="javascript:document.frm_create_mail.reset();" class="toolbar">
				<span class="icon-32-cancel" title="<?php echo ucfirst($translate["annuler"]); ?>">
				</span>
				<?php echo ucfirst($translate["annuler"]); ?>
				</a>
				</td>
				
				<td class="button" id="toolbar-help">
				<a href="#"   class="toolbar">
				<span class="icon-32-help" title="<?php echo ucfirst($translate["aide"]); ?>">
				</span>
				<?php echo ucfirst($translate["aide"]); ?>
				</a>
				</td>
			</tr>
		</table>
		
		<?php
		$div_titre_menu_central = "<div class=\"header icon-48-inbox\">". ucfirst($translate["mail"])." : <small><small>[ ". ucfirst($translate["rejeter"]) ." ]</small></small></div>";
		break;
 

	 	case "mail_search" :
		?>
		<table class="toolbar">
			<tr>
				<td class="button" id="toolbar-save">
					<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=mail_create&lang={$lang}"; ?>';" class="toolbar">
					<span class="icon-32-new" title="<?php echo ucfirst($translate["nouveau"]); ?>">
					</span>
					<?php echo ucfirst($translate["nouveau"]); ?>
					</a>
				</td>	
				
				<td class="button" id="toolbar-popup-Popup">
					<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=mail_param&lang={$lang}"; ?>';" class="toolbar">
					<span class="icon-32-config" title="<?php echo ucfirst($translate["parametres"]); ?>"></span>
					<?php echo ucfirst($translate["parametres"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-popup-Popup">
					<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=mail_log&lang={$lang}"; ?>';" class="toolbar">				
					<span class="icon-32-archive" title="<?php echo ucfirst($translate["historique"]); ?>"></span>
					<?php echo ucfirst($translate["historique"]); ?>
					</a>
				</td>								

				<td class="button" id="toolbar-back">
					<a href="#" onclick="javascript:window.go(-1);" class="toolbar">
					<span class="icon-32-back" title="<?php echo ucfirst($translate["page_precedent"]); ?>">
					</span>
					<?php echo ucfirst($translate["precedent"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-forward">
					<a href="#" onclick="javascript:window.history.go(1);" class="toolbar">
					<span class="icon-32-forward" title="<?php echo ucfirst($translate["page_suivante"]); ?>">
					</span>
					<?php echo ucfirst($translate["suivant"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-help">
					<a href="#"   class="toolbar">
					<span class="icon-32-help" title="<?php echo ucfirst($translate["aide"]); ?>">
					</span>
					<?php echo ucfirst($translate["aide"]); ?>
					</a>
				</td>
				
			</tr>
		</table>
		<?php
		$div_titre_menu_central = "<div class=\"header icon-48-inbox\">". ucfirst($translate["mail"])." : <small><small>[ ". ucfirst($translate["recherche"]) ." ]</small></small></div>";
		break;


	 	case "mail_create" :
	 	
	 	?>			
		
		<table class="toolbar">
			<tr>	
				<td class="button" id="toolbar-send">
				<a onclick="javascript:on_mail_select_dest('<?php echo $siteweb->get_url(); ?>' , 'frm_create_mail','mail_create');"  href="#" class="toolbar">
				<span class="icon-32-send" title="<?php echo ucfirst($translate["envoyer"]); ?>"></span>
				<?php echo ucfirst($translate["envoyer"]); ?>
				</a>
				</td>
			
				<td class="button" id="toolbar-save">
				<a href="#" onclick="javascript:on_mail_create_valid();" class="toolbar">
				<span class="icon-32-save" title="<?php echo ucfirst($translate["enregistrer"]); ?>">
				</span>
				<?php echo ucfirst($translate["enregistrer"]); ?>
				</a>
				</td>
				
				<td class="button" id="toolbar-apply">
				<a href="#" onclick="javascript:document.frm_create_mail.reset();" class="toolbar">
				<span class="icon-32-cancel" title="<?php echo ucfirst($translate["annuler"]); ?>">
				</span>
				<?php echo ucfirst($translate["annuler"]); ?>
				</a>
				</td>
				
			
				<td class="button" id="toolbar-save">
				<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=mail_create&lang={$lang}"; ?>';" class="toolbar">
				<span class="icon-32-new" title="<?php echo ucfirst($translate["nouveau"]); ?>">
				</span>
				<?php echo ucfirst($translate["nouveau"]); ?>
				</a>
				</td>
			
				<td class="button" id="toolbar-preview">
				<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=mail_search&lang={$lang}"; ?>';" class="toolbar">
				<span class="icon-32-preview" title="<?php echo ucfirst($translate["recherche"]); ?>">
				</span>
				<?php echo ucfirst($translate["recherche"]); ?>
				</a>
				</td>

				<td class="button" id="toolbar-popup-Popup">
					<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=mail_param&lang={$lang}"; ?>';" class="toolbar">
					<span class="icon-32-config" title="<?php echo ucfirst($translate["parametres"]); ?>"></span>
					<?php echo ucfirst($translate["parametres"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-popup-Popup">
					<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=mail_search&lang={$lang}&sel_option_etat=archive"; ?>';" class="toolbar">
					<span class="icon-32-archive" title="<?php echo ucfirst($translate["archives"]); ?>"></span>
					<?php echo ucfirst($translate["archives"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-popup-Popup">
					<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=mail_log&lang={$lang}"; ?>';" class="toolbar">				
					<span class="icon-32-archive" title="<?php echo ucfirst($translate["historique"]); ?>"></span>
					<?php echo ucfirst($translate["historique"]); ?>
					</a>
				</td>								

				<td class="button" id="toolbar-back">
					<a href="#" onclick="javascript:window.go(-1);" class="toolbar">
					<span class="icon-32-back" title="<?php echo ucfirst($translate["page_precedent"]); ?>">
					</span>
					<?php echo ucfirst($translate["precedent"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-forward">
					<a href="#" onclick="javascript:window.history.go(1);" class="toolbar">
					<span class="icon-32-forward" title="<?php echo ucfirst($translate["page_suivante"]); ?>">
					</span>
					<?php echo ucfirst($translate["suivant"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-help">
				<a href="#"   class="toolbar">
				<span class="icon-32-help" title="<?php echo ucfirst($translate["aide"]); ?>">
				</span>
				<?php echo ucfirst($translate["aide"]); ?>
				</a>
				</td>
			</tr>
		</table>
		<?php
				
		$div_titre_menu_central = "<div class=\"header icon-48-inbox\">". ucfirst($translate["mail"])." : <small><small>[ ". ucfirst($translate["nouveau"]) ." ]</small></small></div>";
		break;

	 	case "mail_select_dest" :
		?>
		<table class="toolbar">
			<tr>	
				<td class="button" id="toolbar-send">
					<a href="#" onclick="javascript:on_mail_send_valid('<?php echo $siteweb->get_url()."/mail/traitements/controleur.php?do=mail_send_valid&lang={$lang}"; ?>' , '<?php echo $siteweb->get_url(); ?>');" class="toolbar">					
					<span class="icon-32-send" title="<?php echo ucfirst($translate["envoyer"]); ?>"></span>
					<?php echo ucfirst($translate["envoyer"]); ?>
					</a>
				</td>
			
				<td class="button" id="toolbar-apply">
				<a href="#" onclick="javascript:window.history.back();" class="toolbar">
				<span class="icon-32-cancel" title="<?php echo ucfirst($translate["annuler"]); ?>">
				</span>
				<?php echo ucfirst($translate["annuler"]); ?>
				</a>
				</td>
				<td class="button" id="toolbar-save">
					<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=mail_create&lang={$lang}"; ?>';" class="toolbar">
					<span class="icon-32-new" title="<?php echo ucfirst($translate["nouveau"]); ?>">
					</span>
					<?php echo ucfirst($translate["nouveau"]); ?>
					</a> 
				</td>
			
				<td class="button" id="toolbar-preview">
				<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=mail_search&lang={$lang}"; ?>';" class="toolbar">
				<span class="icon-32-preview" title="<?php echo ucfirst($translate["recherche"]); ?>">
				</span>
				<?php echo ucfirst($translate["recherche"]); ?>
				</a>
				</td>

				<td class="button" id="toolbar-popup-Popup">
					<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=mail_param&lang={$lang}"; ?>';" class="toolbar">
					<span class="icon-32-config" title="<?php echo ucfirst($translate["parametres"]); ?>"></span>
					<?php echo ucfirst($translate["parametres"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-popup-Popup">
					<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=mail_search&lang={$lang}"; ?>';" class="toolbar">
					<span class="icon-32-archive" title="<?php echo ucfirst($translate["archives"]); ?>"></span>
					<?php echo ucfirst($translate["archives"]); ?>
					</a>
				</td>

				<td class="button" id="toolbar-popup-Popup">
					<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=mail_log&lang={$lang}"; ?>';" class="toolbar">				
					<span class="icon-32-archive" title="<?php echo ucfirst($translate["historique"]); ?>"></span>
					<?php echo ucfirst($translate["historique"]); ?>
					</a>
				</td>								

				<td class="button" id="toolbar-back">
					<a href="#" onclick="javascript:window.go(-1);" class="toolbar">
					<span class="icon-32-back" title="<?php echo ucfirst($translate["page_precedent"]); ?>">
					</span>
					<?php echo ucfirst($translate["precedent"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-forward">
					<a href="#" onclick="javascript:window.history.go(1);" class="toolbar">
					<span class="icon-32-forward" title="<?php echo ucfirst($translate["page_suivante"]); ?>">
					</span>
					<?php echo ucfirst($translate["suivant"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-help">
				<a href="#"   class="toolbar">
				<span class="icon-32-help" title="<?php echo ucfirst($translate["aide"]); ?>">
				</span>
				<?php echo ucfirst($translate["aide"]); ?>
				</a>
				</td>
			</tr>
		</table>
		<?php
		$div_titre_menu_central = "<div class=\"header icon-48-inbox\">". ucfirst($translate["mail"])." : <small><small>[ ". ucfirst($translate["recherche_dest"]) ." ]</small></small></div>";
		break;

	 	case "mail_view" :
			?>
			<table class="toolbar">
				<tr>	
					<td class="button" id="toolbar-save">
					<a href="#" onclick="javascript:on_mail_update_valid('<?php echo $siteweb->get_url()."/mail/traitements/controleur.php" ?>' , '<?php echo $siteweb->get_url(); ?>');" class="toolbar">
					<span class="icon-32-apply" title="<?php echo ucfirst($translate["modifier"]); ?>">
					</span>
					<?php echo ucfirst($translate["modifier"]); ?>
					</a>
					</td>
				
					<td class="button" id="toolbar-apply">
					<a href="#" onclick="javascript:document.getElementById('form_mail_view').reset();" class="toolbar">
					<span class="icon-32-cancel" title="<?php echo ucfirst($translate["annuler"]); ?>">
					</span>

					<?php echo ucfirst($translate["annuler"]); ?>
					</a>
					</td>
					
				<td class="button" id="toolbar-send">
					<a onclick="javascript:on_mail_select_dest('<?php echo $siteweb->get_url(); ?>' , 'form_mail_view','mail_view');"  href="#" class="toolbar">
					<span class="icon-32-send" title="<?php echo ucfirst($translate["envoyer"]); ?>"></span>
					<?php echo ucfirst($translate["envoyer"]); ?>
					</a>
				</td>
					
					<td class="button" id="toolbar-save">
					<a href="#" onclick="javascript:on_mail_delete_valid('<?php echo $siteweb->get_url()."/mail/traitements/controleur.php" ?>' , '<?php echo $siteweb->get_url(); ?>');" class="toolbar">
					<span class="icon-32-trash" title="<?php echo ucfirst($translate["supprimer"]); ?>">
					</span>
					<?php echo ucfirst($translate["supprimer"]); ?>
					</a>
					</td>
					
					<td class="button" id="toolbar-preview">
					<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=mail_search&lang={$lang}"; ?>';" class="toolbar">
					<span class="icon-32-preview" title="<?php echo ucfirst($translate["recherche"]); ?>">
					</span>
					<?php echo ucfirst($translate["recherche"]); ?>
					</a>
					</td>

					<td class="button" id="toolbar-save">
						<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=mail_create&lang={$lang}"; ?>';" class="toolbar">
						<span class="icon-32-new" title="<?php echo ucfirst($translate["nouveau"]); ?>">
						</span>
						<?php echo ucfirst($translate["nouveau"]); ?>
						</a>
					</td>	
					
					<td class="button" id="toolbar-popup-Popup">
						<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=mail_param&lang={$lang}"; ?>';" class="toolbar">
						<span class="icon-32-config" title="<?php echo ucfirst($translate["parametres"]); ?>"></span>
						<?php echo ucfirst($translate["parametres"]); ?>
						</a>
					</td>
					
					<td class="button" id="toolbar-popup-Popup">
						<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=mail_search&lang={$lang}&sel_option_etat=archive"; ?>';" class="toolbar">
						<span class="icon-32-archive" title="<?php echo ucfirst($translate["archives"]); ?>"></span>
						<?php echo ucfirst($translate["archives"]); ?>
						</a>
					</td>
	
					<td class="button" id="toolbar-popup-Popup">
						<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=mail_log&lang={$lang}"; ?>';" class="toolbar">				
						<span class="icon-32-archive" title="<?php echo ucfirst($translate["historique"]); ?>"></span>
						<?php echo ucfirst($translate["historique"]); ?>
						</a>
					</td>								

				<td class="button" id="toolbar-back">
					<a href="#" onclick="javascript:window.go(-1);" class="toolbar">
					<span class="icon-32-back" title="<?php echo ucfirst($translate["page_precedent"]); ?>">
					</span>
					<?php echo ucfirst($translate["precedent"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-forward">
					<a href="#" onclick="javascript:window.history.go(1);" class="toolbar">
					<span class="icon-32-forward" title="<?php echo ucfirst($translate["page_suivante"]); ?>">
					</span>
					<?php echo ucfirst($translate["suivant"]); ?>
					</a>
				</td>
					
					<td class="button" id="toolbar-help">
					<a href="#"   class="toolbar">
					<span class="icon-32-help" title="<?php echo ucfirst($translate["aide"]); ?>">
					</span>
					<?php echo ucfirst($translate["aide"]); ?>
					</a>
					</td>
				</tr>
			</table>
			
		<?php
		$div_titre_menu_central = "<div class=\"header icon-48-inbox\">". ucfirst($translate["mail"])." : <small><small>[ ". ucfirst($translate["consultation"]) ." ]</small></small></div>";
		break;

	 	case "mail_param" :
			?>
			<table class="toolbar">
				<tr>	
					<td class="button" id="toolbar-save">
					<a href="#" onclick="javascript:on_mail_param_valid('<?php echo $siteweb->get_url()."/mail/traitements/tmail_param_update_valid.php" ?>');" class="toolbar">
					<span class="icon-32-save" title="<?php echo ucfirst($translate["enregistrer"]); ?>">
					</span>
					<?php echo ucfirst($translate["enregistrer"]); ?>
					</a>
					</td>
				
					<td class="button" id="toolbar-apply">
					<a href="#" onclick="javascript:document.getElementById('form_mail_param').reset();" class="toolbar">
					<span class="icon-32-cancel" title="<?php echo ucfirst($translate["annuler"]); ?>">
					</span>
					<?php echo ucfirst($translate["annuler"]); ?>
					</a>
					</td>
					
					<td class="button" id="toolbar-preview">
					<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=mail_search&lang={$lang}"; ?>';" class="toolbar">
					<span class="icon-32-preview" title="<?php echo ucfirst($translate["recherche"]); ?>">
					</span>
					<?php echo ucfirst($translate["recherche"]); ?>
					</a>
					</td>

					<td class="button" id="toolbar-save">
						<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=mail_create&lang={$lang}"; ?>';" class="toolbar">
						<span class="icon-32-new" title="<?php echo ucfirst($translate["nouveau"]); ?>">
						</span>
						<?php echo ucfirst($translate["nouveau"]); ?>
						</a>
					</td>	
					
					<td class="button" id="toolbar-popup-Popup">
						<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=mail_search&lang={$lang}&sel_option_etat=archive"; ?>';" class="toolbar">
						<span class="icon-32-archive" title="<?php echo ucfirst($translate["archives"]); ?>"></span>
						<?php echo ucfirst($translate["archives"]); ?>
						</a>
					</td>
	
					<td class="button" id="toolbar-popup-Popup">
						<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=mail_log&lang={$lang}"; ?>';" class="toolbar">				
						<span class="icon-32-archive" title="<?php echo ucfirst($translate["historique"]); ?>"></span>
						<?php echo ucfirst($translate["historique"]); ?>
						</a>
					</td>								

				<td class="button" id="toolbar-back">
					<a href="#" onclick="javascript:window.go(-1);" class="toolbar">
					<span class="icon-32-back" title="<?php echo ucfirst($translate["page_precedent"]); ?>">
					</span>
					<?php echo ucfirst($translate["precedent"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-forward">
					<a href="#" onclick="javascript:window.history.go(1);" class="toolbar">
					<span class="icon-32-forward" title="<?php echo ucfirst($translate["page_suivante"]); ?>">
					</span>
					<?php echo ucfirst($translate["suivant"]); ?>
					</a>
				</td>
					
					<td class="button" id="toolbar-help">
					<a href="#"   class="toolbar">
					<span class="icon-32-help" title="<?php echo ucfirst($translate["aide"]); ?>">
					</span>
					<?php echo ucfirst($translate["aide"]); ?>
					</a>
					</td>
				</tr>
			</table>
			
		<?php
		$div_titre_menu_central = "<div class=\"header icon-48-inbox\">". ucfirst($translate["mail"])." : <small><small>[ ". ucfirst($translate["parametres"]) ." ]</small></small></div>";
		break;


	 	case "mail_search" :
		?>
		<table class="toolbar">
			<tr>	
				<td class="button" id="toolbar-save">
				<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=mail_create&lang={$lang}"; ?>';" class="toolbar">
				<span class="icon-32-new" title="<?php echo ucfirst($translate["nouveau"]); ?>">
				</span>
				<?php echo ucfirst($translate["nouveau"]); ?>
				</a>
				</td>

				<td class="button" id="toolbar-back">
					<a href="#" onclick="javascript:window.go(-1);" class="toolbar">
					<span class="icon-32-back" title="<?php echo ucfirst($translate["page_precedent"]); ?>">
					</span>
					<?php echo ucfirst($translate["precedent"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-forward">
					<a href="#" onclick="javascript:window.history.go(1);" class="toolbar">
					<span class="icon-32-forward" title="<?php echo ucfirst($translate["page_suivante"]); ?>">
					</span>
					<?php echo ucfirst($translate["suivant"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-help">
				<a href="#"   class="toolbar">
				<span class="icon-32-help" title="<?php echo ucfirst($translate["aide"]); ?>">
				</span>
				<?php echo ucfirst($translate["aide"]); ?>
				</a>
				</td>
			</tr>
		</table>
		<?php
		$div_titre_menu_central = "<div class=\"header icon-48-inbox\">". ucfirst($translate["mail"])." : <small><small>[ ". ucfirst($translate["recherche"]) ." ]</small></small></div>";
		break;

	 	case "mail_log" :
		?>
		<table class="toolbar">
			<tr>	
				<td class="button" id="toolbar-save">
				<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=mail_create&lang={$lang}"; ?>';" class="toolbar">
				<span class="icon-32-new" title="<?php echo ucfirst($translate["nouveau"]); ?>">
				</span>
				<?php echo ucfirst($translate["nouveau"]); ?>
				</a>
				</td>
								
				<td class="button" id="toolbar-popup-Popup">
				<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=mail_search&lang={$lang}&sel_option_etat=archive"; ?>';" class="toolbar">
				<span class="icon-32-archive" title="<?php echo ucfirst($translate["archives"]); ?>"></span>
				<?php echo ucfirst($translate["archives"]); ?>
				</a>
				</td>
	
				<td class="button" id="toolbar-popup-Popup">
				<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=mail_param&lang={$lang}"; ?>';" class="toolbar">				
				<span class="icon-32-config" title="<?php echo ucfirst($translate["parametres"]); ?>"></span>
				<?php echo ucfirst($translate["parametres"]); ?>
				</a>
				</td>			

				<td class="button" id="toolbar-back">
					<a href="#" onclick="javascript:window.go(-1);" class="toolbar">
					<span class="icon-32-back" title="<?php echo ucfirst($translate["page_precedent"]); ?>">
					</span>
					<?php echo ucfirst($translate["precedent"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-forward">
					<a href="#" onclick="javascript:window.history.go(1);" class="toolbar">
					<span class="icon-32-forward" title="<?php echo ucfirst($translate["page_suivante"]); ?>">
					</span>
					<?php echo ucfirst($translate["suivant"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-help">
				<a href="#"   class="toolbar">
				<span class="icon-32-help" title="<?php echo ucfirst($translate["aide"]); ?>">
				</span>
				<?php echo ucfirst($translate["aide"]); ?>
				</a>
				</td>
			</tr>
		</table>
		<?php
		$div_titre_menu_central = "<div class=\"header icon-48-inbox\">". ucfirst($translate["mail"])." : <small><small>[ ". ucfirst($translate["mail_log"]) ." ]</small></small></div>";
		break;



	 	case "accueil" :
			?>
			<table class="toolbar">
				<tr>	
					<td class="button" id="toolbar-help">
					<a href="#"   class="toolbar">
					<span class="icon-32-help" title="<?php echo ucfirst($translate["aide"]); ?>">
					</span>
					<?php echo ucfirst($translate["aide"]); ?>
					</a>
					</td>
				</tr>
			</table>
			
		<?php
		$div_titre_menu_central = "<div class=\"header icon-48-frontpage\">".ucfirst($translate["bienvenue"])."  <small><small> " . ucfirst($translate["login"])." </small></small></div> ";
		break;

	 	case "paie_param"
		?>
		<table class="toolbar">
			<tr>
				<td class="button" id="toolbar-save">
					<a href="#" onclick="javascript:on_paie_param_valid('<?php echo $siteweb->get_url()."/administration/traitements/partie_centrale.php" ?>');" class="toolbar">
					<span class="icon-32-save" title="<?php echo ucfirst($translate["enregistrer"]); ?>">
					</span>
					<?php echo ucfirst($translate["enregistrer"]);?>
					</a>		
				</td>
				<td class="button" id="toolbar-apply">
					<a href="#" onclick="javascript:document.getElementById('form_module').reset();" class="toolbar">
					<span class="icon-32-cancel" title="<?php echo ucfirst($translate["annuler"]); ?>">
					</span>
					<?php echo ucfirst($translate["annuler"]); ?> 
					</a>
				</td>

				<td class="button" id="toolbar-back">
					<a href="#" onclick="javascript:window.go(-1);" class="toolbar">
					<span class="icon-32-back" title="<?php echo ucfirst($translate["page_precedent"]); ?>">
					</span>
					<?php echo ucfirst($translate["precedent"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-forward">
					<a href="#" onclick="javascript:window.history.go(1);" class="toolbar">
					<span class="icon-32-forward" title="<?php echo ucfirst($translate["page_suivante"]); ?>">
					</span>
					<?php echo ucfirst($translate["suivant"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-help">
					<a href="#"   class="toolbar">
					<span class="icon-32-help" title="<?php echo ucfirst($translate["config"]); ?>">
					</span>
					<?php echo ucfirst($translate["aide"]); ?>
					</a>
				</td>	
			</tr>
		</table>
		<?php
		$div_titre_menu_central = "<div class=\"header icon-48-config\">".ucfirst($translate["interfacage_paie"]).": <small><small>[".ucfirst($translate["parametres"])."]</small></small></div>";
		break;

	 	case "rh_param"
		?>
		<table class="toolbar">
			<tr>
				<td class="button" id="toolbar-save">
					<a href="#" onclick="javascript:on_rh_param_valid('<?php echo $siteweb->get_url()."/administration/traitements/partie_centrale.php" ?>');" class="toolbar">
					<span class="icon-32-save" title="<?php echo ucfirst($translate["enregistrer"]); ?>">
					</span>
					<?php echo ucfirst($translate["enregistrer"]);?>
					</a>		
				</td>
				<td class="button" id="toolbar-apply">
					<a href="#" onclick="javascript:document.getElementById('form_module').reset();" class="toolbar">
					<span class="icon-32-cancel" title="<?php echo ucfirst($translate["annuler"]); ?>">
					</span>
					<?php echo ucfirst($translate["annuler"]); ?> 
					</a>
				</td>

				<td class="button" id="toolbar-back">
					<a href="#" onclick="javascript:window.go(-1);" class="toolbar">
					<span class="icon-32-back" title="<?php echo ucfirst($translate["page_precedent"]); ?>">
					</span>
					<?php echo ucfirst($translate["precedent"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-forward">
					<a href="#" onclick="javascript:window.history.go(1);" class="toolbar">
					<span class="icon-32-forward" title="<?php echo ucfirst($translate["page_suivante"]); ?>">
					</span>
					<?php echo ucfirst($translate["suivant"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-help">
					<a href="#"   class="toolbar">
					<span class="icon-32-help" title="<?php echo ucfirst($translate["config"]); ?>">
					</span>
					<?php echo ucfirst($translate["aide"]); ?>
					</a>
				</td>	
			</tr>
		</table>
		<?php
		$div_titre_menu_central = "<div class=\"header icon-48-config\">".ucfirst($translate["interfacage_rh"]).": <small><small>[".ucfirst($translate["parametres"])."]</small></small></div>";
		break;

	 	case "config_view" :
		?>
		<table class="toolbar">
		<tr>	
			<td class="button" id="toolbar-save">
				<a href="#" onclick="javascript:on_config_update_valid('<?php echo $siteweb->get_url()."/administration/traitements/partie_centrale.php" ?>');" class="toolbar">
					<span class="icon-32-save" title="<?php echo ucfirst($translate["enregistrer"]); ?>">
					</span>
					<?php echo ucfirst($translate["enregistrer"]); ?>
					</a>
					</td>  
									
			<td class="button" id="toolbar-apply">
					<a href="#" onclick="javascript:document.getElementById('form_config_view').reset();" class="toolbar">
					<span class="icon-32-cancel" title="<?php echo ucfirst($translate["annuler"]); ?>">
					</span>
					<?php echo ucfirst($translate["annuler"]); ?>
					</a>
					</td>					

				<td class="button" id="toolbar-back">
					<a href="#" onclick="javascript:window.go(-1);" class="toolbar">
					<span class="icon-32-back" title="<?php echo ucfirst($translate["page_precedent"]); ?>">
					</span>
					<?php echo ucfirst($translate["precedent"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-forward">
					<a href="#" onclick="javascript:window.history.go(1);" class="toolbar">
					<span class="icon-32-forward" title="<?php echo ucfirst($translate["page_suivante"]); ?>">
					</span>
					<?php echo ucfirst($translate["suivant"]); ?>
					</a>
				</td>
					
					<td class="button" id="toolbar-help">
				<a href="#"   class="toolbar">
				<span class="icon-32-help" title="<?php echo ucfirst($translate["config"]); ?>">
				</span>
				<?php echo ucfirst($translate["aide"]); ?>
				</a>
				</td>
			</tr>
		</table>
		<?php
		$div_titre_menu_central = "<div class=\"header icon-48-config\">". ucfirst($translate["config_general"])." : <small><small>[ ". ucfirst($translate["consultation"]) ." ]</small></small></div>";
		break;


        	case "workflow_search" :
		?>
		<table class="toolbar">
			<tr>	
				<td class="button" id="toolbar-back">
					<a href="#" onclick="javascript:window.go(-1);" class="toolbar">
					<span class="icon-32-back" title="<?php echo ucfirst($translate["page_precedent"]); ?>">
					</span>
					<?php echo ucfirst($translate["precedent"]); ?>
					</a>
				</td>
				
				<td class="button" id="toolbar-forward">
					<a href="#" onclick="javascript:window.history.go(1);" class="toolbar">
					<span class="icon-32-forward" title="<?php echo ucfirst($translate["page_suivante"]); ?>">
					</span>
					<?php echo ucfirst($translate["suivant"]); ?>
					</a>
				</td>
			
				<td class="button" id="toolbar-help">
				<a href="#"   class="toolbar">
				<span class="icon-32-help" title="<?php echo ucfirst($translate["aide"]); ?>">
				</span>
				<?php echo ucfirst($translate["aide"]); ?>
				</a>
				</td>
			</tr>
		</table>
		<?php
		$div_titre_menu_central = "<div class=\"header icon-48-plugin\">". ucfirst($translate["workflow"])." : <small><small>[ ". ucfirst($translate["recherche"]) ." ]</small></small></div>";
		break;
        
        
		case "workflow_view" :
			
		?>
			<table class="toolbar">
				<tr>	
					<td class="button" id="toolbar-save">
					<a href="#" onclick="javascript:on_workflow_update_valid('<?php echo $siteweb->get_url()."/workflow/traitements/partie_centrale.php" ?>');" class="toolbar">
					<span class="icon-32-apply" title="<?php echo ucfirst($translate["modifier"]); ?>">
					</span>
					<?php echo ucfirst($translate["modifier"]); ?>
					</a>
					</td>
				
					<td class="button" id="toolbar-apply">
					<a href="#" onclick="javascript:window.history.back();" class="toolbar">
					<span class="icon-32-cancel" title="<?php echo ucfirst($translate["annuler"]); ?>">
					</span>
					<?php echo ucfirst($translate["annuler"]); ?>
					</a>
					</td>

					<td class="button" id="toolbar-save">
					<a href="#" onclick="javascript:on_workflow_delete_valid();" class="toolbar">
					<span class="icon-32-trash" title="<?php echo ucfirst($translate["supprimer"]); ?>">
					</span>
					<?php echo ucfirst($translate["supprimer"]); ?>
					</a>
					</td>
					
					<td class="button" id="toolbar-preview">
					<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=workflow_search&lang={$lang}"; ?>';" class="toolbar">
					<span class="icon-32-preview" title="<?php echo ucfirst($translate["recherche"]); ?>">
					</span>
					<?php echo ucfirst($translate["recherche"]); ?>
					</a>
					</td>

					<td class="button" id="toolbar-save">
					<a href="#" onclick="javascript: window.location = '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=workflow_create&lang={$lang}"; ?>';" class="toolbar">
					<span class="icon-32-new" title="<?php echo ucfirst($translate["nouveau"]); ?>">
					</span>
					<?php echo ucfirst($translate["nouveau"]); ?>
					</a>
					</td>
							
					<td class="button" id="toolbar-back">
					<a href="#" onclick="javascript:window.go(-1);" class="toolbar">
					<span class="icon-32-back" title="<?php echo ucfirst($translate["page_precedent"]); ?>">
					</span>
					<?php echo ucfirst($translate["precedent"]); ?>
					</a>
					</td>
					
					<td class="button" id="toolbar-forward">
					<a href="#" onclick="javascript:window.history.go(1);" class="toolbar">
					<span class="icon-32-forward" title="<?php echo ucfirst($translate["page_suivante"]); ?>">
					</span>
					<?php echo ucfirst($translate["suivant"]); ?>
					</a>
					</td>
				
					<td class="button" id="toolbar-help">
					<a href="#"   class="toolbar">
					<span class="icon-32-help" title="<?php echo ucfirst($translate["aide"]); ?>">
					</span>
					<?php echo ucfirst($translate["aide"]); ?>
					</a>
					</td>

				</tr>
			</table>
			
		<?php
		$div_titre_menu_central = "<div class=\"header icon-48-plugin\">". ucfirst($translate["workflow"])." : <small><small>[ ". ucfirst($translate["consultation"]) ." ]</small></small></div>";
		break;
		
		
		case "workflow_create" :
		?>
		<table class="toolbar">
			<tr>	
			
				<td class="button" id="toolbar-save">
				<a href="#" onclick="javascript:on_workflow_create_valid();" class="toolbar">
				<span class="icon-32-save" title="<?php echo ucfirst($translate["enregistrer"]); ?>">
				</span>
				<?php echo ucfirst($translate["enregistrer"]); ?>
				</a>
				</td>
				
				<td class="button" id="toolbar-apply">
				<a href="#" onclick="javascript:window.history.back();" class="toolbar">
				<span class="icon-32-cancel" title="<?php echo ucfirst($translate["annuler"]); ?>">
				</span>
				<?php echo ucfirst($translate["annuler"]); ?>
				</a>
				</td>
			
			    <td class="button" id="toolbar-help">
				<a href="#" onclick="popupWindow('http://help2.joomla.org/index2.php?option=com_content&amp;task=findkey&amp;tmpl=component;1&amp;keyref=screen.config.15', 'Aide', 640, 480, 1)" class="toolbar">
				<span class="icon-32-help" title="<?php echo ucfirst($translate["aide"]); ?>">
				</span>
				<?php echo ucfirst($translate["aide"]); ?>
				</a>
				</td>
			</tr>
		</table>
	<?php

	$div_titre_menu_central = "<div class=\"header icon-48-plugin\">". ucfirst($translate["workflow"])." : <small><small>[ ". ucfirst($translate["creation"]) ." ]</small></small></div>";
	break;
	 }
	?>