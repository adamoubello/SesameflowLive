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
 
    global $siteweb ;
    require_once($siteweb->get_document_root().DS.'ged'.DS.'traitements'.DS.'tformulaire_create.php');

?>

<form action="<?php echo $siteweb->get_url()."/ged/traitements/partie_centrale.php" ?>" id="form_doc_view" name="form_doc_view"  method="POST" ENCTYPE="multipart/form-data">
	<input type="hidden" id="typedoc" name="typedoc" value="dde_credit"  />
	<input type="hidden" id="lang" name="lang" value="<?php echo $lang; ?>"  />
	<input type="hidden" id="login" name="login" value="<?php echo $login; ?>"  />
	<input type="hidden" id="do" name="do" value="doc_create_valid"  />
	<input type="hidden" id="liste_elements" name="liste_elements" value=""  />
	<input type="hidden" id="titredoc" name="titredoc" value="demande de crédit"  />
	<input type="hidden" id="codeuser" name="codeuser" value="<?php echo $luser->codeuser; ?>"  />
	<input type="hidden" id="numtache" name="numtache" value="<?php echo $numtache; ?>"  />
	<input type="hidden" id="numtachesuiv" name="numtachesuiv" value="<?php echo $numtachesuiv; ?>"  />
	<input type="hidden" id="numworkflow" name="numworkflow" value="<?php echo $numworkflow; ?>"  />
	<input type="hidden" id="numdoc" name="numdoc" value="<?php echo $numdoc; ?>"  />
	<input type="hidden" id="codecircuit" name="codecircuit" value="<?php echo $codecircuit; ?>"  />
				
  	<div>
		<fieldset class="adminform">
			<legend><?php echo ucfirst($translate["donne_dde"]);?></legend>
			<table class="admintable" cellspacing="1">
				<tr>
					<td width="150" class="key">
						<label for="name">
						<?php echo ucfirst($translate["auteur"]);?>
						</label>
					</td>
					<td>
						<?php echo $link_auteur ;?>
					</td>
				</tr>
				<tr>
					<td width="150" class="key">
						<label for="name">
						<?php echo ucfirst($translate["retenue"]);?>
						</label>
					</td>
					<td>
						<input type="text" name="retenue" id="retenue" class="inputbox" size="30" value="" />
					</td>
				</tr>
				<tr>
					<td width="150" class="key">
						<label for="name">
						<?php  echo ucfirst($translate["montant_dde"]);?>
						</label>
					</td>
					<td>
						<input type="text" name="montant" id="montant" class="inputbox" size="30" value="" />
					</td>
				</tr>					
				<tr>
					<td width="150" class="key">
						<label for="name">
						<?php echo ucfirst($translate["date_dde"]);?>
						</label>
					</td>
					<td>
						<input disabled type="text" name="txt_date_creation" id="txt_date_creation" class="inputbox" size="15" value="<?php echo date("d/m/Y") ?>" />						
					</td>
				</tr>				
				<tr>
					<td width="150" class="key">
						<label for="name">
						<?php echo ucfirst($translate["heure_creation"]);?>
						</label>
					</td>
					<td>
						<input disabled type="text" name="txt_heure_creation" id="txt_heure_creation" class="inputbox" size="15" value="<?php echo date("H:m:s") ?>" />						
					</td>
				</tr>								
				<tr>
					<td class="key" width="150">
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

	<div>
		<fieldset class="adminform">
			<legend><?php echo ucfirst($translate["det_annuite"]);?></legend>
			<table class="admintable" cellspacing="1" border="0">						
				<tr>
					<td colspan="2" class="key">
						<input type="checkbox" name="ret_annuite" id="ret_annuite" size="1" onclick="if (this.checked) this.value=1; else this.value=0;"/>&nbsp;&nbsp;
						<label for="password">
							<b>
							<?php echo ucfirst($translate["ret_par_annuite"]);?>
							</b>
							
						</label>														
					</td>
				</tr>
				<tr>
					<td class="key">
						<label for="password">
						<?php echo ucfirst($translate["nbr_annuite"]);?>
						</label>
					</td>
					<td>
						<input class="inputbox" type="text" name="nbr_annuite" id="nbr_annuite" size="30" value=""/>
					</td>
				</tr>							
				<tr>
					<td class="key">
						<label for="password">
						<?php echo ucfirst($translate["annuite"]);?>
						</label>
					</td>
					<td>
						<input class="inputbox" type="text" name="annuite" id="annuite" size="30" value=""/>
					</td>
				</tr>
			</table>
		</fieldset>
	</div>	
</form>