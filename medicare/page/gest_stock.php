<?php
/**
 * @version			1.0
 * @package			GED
 * @subpackage		Document
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			William<william.nkingne@laposte.net>
 * @desc			Script pour l'affichage du formulaire de demande de crédit
 * @creationdate	mardi 16 juin 2009
 * @updates
 * 	# samedi 04 juillet 2009 by patrick mveng<patrick.mveng@interfacesa.local>
 * 		-	suppression de référence link vers des feuilles de styles. Ces styles et javascript sont déjà chargés dans la page gabarit
 * 		-	substitution de code utilisateur par Auteur. l'utilisateur en cours est l'auteur.
 * 		-   date demande = date du jour
 * 		-	affichage de l'heure système
 * 		-	ajout du paramètre hidden liste_elements. Ce paramètre est à repeter dans chaque page pour de création d'un formulaire
 * @todo
 */
 
    global $siteweb;
    require_once($siteweb->get_document_root().'\ged\\traitements\\tformulaire_create.php');

	
    /*echo "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"". $siteweb->get_url().$siteweb->get_dossier_plugin()."/popcal/skins/aqua/theme.css\" title=\"Aqua\" />\n";
	echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url().$siteweb->get_dossier_plugin()."/popcal/calendar.js\"></script>\n";			
	echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url().$siteweb->get_dossier_plugin()."/popcal/calendar-setup.js\"></script>\n";			
	//language for the calendar -->
	echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url().$siteweb->get_dossier_plugin()."/popcal/lang/calendar-".$lang.".js\"></script>\n";*/

?>

<form action="<?php echo $siteweb->get_url()."/ged/traitements/partie_centrale.php" ?>" id="form_gest_stock" name="form_gest_stock" method="POST">
	<input type="hidden" id="typedoc" name="typedoc" value="gest_stock"  />
	<input type="hidden" id="lang" name="lang" value="<?php echo $lang; ?>"  />
	<input type="hidden" id="login" name="login" value="<?php echo $login; ?>"  />
	<input type="hidden" id="do" name="do" value="doc_create_valid"  />
	<input type="hidden" id="liste_elements" name="liste_elements" value=""  />
	<input type="hidden" id="titredoc" name="titredoc" value="<?php echo ucfirst($translate["titredoc"]);?>"  />
	<input type="hidden" id="codeuser" name="codeuser" value="<?php echo $luser->codeuser; ?>"  />
	<input type="hidden" id="numtache" name="numtache" value="<?php echo $numtache; ?>"  />
  	<div>
		<fieldset class="adminform">
			<legend><?php echo ucfirst($translate["donne_dde"]);?></legend>
			<table class="admintable" cellspacing="1">
				<tr>
					<td width="150">
						<label for="name">
						<?php echo ucfirst($translate["auteur"]);?>
						</label>
					</td>
					<td>
						<input type="text" disabled value="<?php echo ucfirst($luser->nomuser)." ".ucfirst($luser->prenomuser); ?>" name="txt_loginuser" id="txt_loginuser" class="inputbox" size="30" value="" onfocus="if (document.getElementById('system-message')) document.getElementById('system-message').style.display = 'none'; "/>
					</td>
				</tr>
				<tr>
					<td width="150">
						<label for="name">
						<?php echo ucfirst($translate["type"]);?>
						</label>
					</td>
					<td><select name="type" id="type">
					  <option>Consommable medicamenteux</option>
					  <option>Consommable non m&eacute;dicamenteux</option>
					  </select>
					</td>
				</tr><tr>
					<td width="150">
						<label for="name">
						<?php echo ucfirst($translate["designation"]);?>
						</label>
					</td>
					<td>
						<input type="text" name="designation" id="designation" class="inputbox" size="30" value="" />
					</td>
				</tr><tr>
					<td width="150">
						<label for="name">
						<?php echo ucfirst($translate["presentation"]);?>
						</label>
					</td>
					<td>
						<input type="text" name="presentation" id="presentation" class="inputbox" size="30" value="" />
					</td>
				</tr><tr>
					<td width="150">
						<label for="name">
						<?php echo ucfirst($translate["quantite"]);?>
						</label>
					</td>
					<td>
						<input type="text" name="quantite" id="quantite" class="inputbox" size="30" value="" />
					</td>
				</tr><tr>
					<td width="150">
						<label for="name">
						<?php echo ucfirst($translate["stock_dispo"]);?>
						</label>
					</td>
					<td>
						<input type="text" name="stock_dispo" id="stock_dispo" class="inputbox" size="30" value="" />
					</td>
				</tr><tr>
					<td width="150">
						<label for="name">
						<?php echo ucfirst($translate["observation"]);?>
						</label>
					</td>
					<td>
						<textarea name="observation" cols="50" rows="10" class="inputbox" id="observation"></textarea>
					</td>
				</tr>
								
				<tr>
					<td width="150">
						<label for="name">
						<?php echo ucfirst($translate["date_dde"]);?>
						</label>
					</td>
					<td>
						<input disabled type="text" name="txt_date_creation" id="txt_date_creation" class="inputbox" size="15" value="<?php echo date("d/m/Y") ?>" />						
					</td>
				</tr>				
				<tr>
					<td width="150">
						<label for="name">
						<?php echo ucfirst($translate["heure_creation"]);?>
						</label>
					</td>
					<td>
						<input disabled type="text" name="txt_heure_creation" id="txt_heure_creation" class="inputbox" size="15" value="<?php echo date("H:m:s") ?>" />						
					</td>
				</tr>								
				<tr>
					<td width="150">
						<label for="email">
						<?php echo ucfirst($translate["date_deb_credit"]);?>
						</label>
					</td>
					<td>
						<?php echo $siteweb->date_tag(array("type" => "text" 
						, "name" => "date_credit" , "id" => "date_credit" , "class" => "inputbox" , "size" => "30" 
						, "value"=>"" ) ,array("src" => $siteweb->get_url()."/images/cal.gif" , "id" => "img_date2" 
						, "style" => "cursor: pointer; border: none;" , "title" => $translate["date_selector"]));?>
					</td>
				</tr>
				
			</table>                 
		</fieldset>
	</div>
	
</form>