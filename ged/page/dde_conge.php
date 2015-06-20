<?php
/**
 * @version			1.0
 * @package			GED
 * @subpackage		Document
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			William<william.nkingne@laposte.net>
 * @desc			script de demande de congé
 * @creationdate	vendredi 17 juillet 2009
 * @updates
 */

    global $siteweb;
    require_once($siteweb->get_document_root().DS.'ged'.DS.'traitements'.DS.'tformulaire_create.php');
?>
<form action="<?php echo $siteweb->get_url()."/ged/traitements/partie_centrale.php" ?>" id="form_doc_view" name="form_doc_view"  method="POST" ENCTYPE="multipart/form-data" accept-charset="utf-16">
	<input type="hidden" id="typedoc" name="typedoc" value="dde_conge"  />
	<input type="hidden" id="lang" name="lang" value="<?php echo $lang; ?>"  />
	<input type="hidden" id="login" name="login" value="<?php echo $login; ?>"  />
	<input type="hidden" id="do" name="do" value="doc_create_valid"  />
	<input type="hidden" id="liste_elements" name="liste_elements" value=""  />
	<input type="hidden" id="titredoc" name="titredoc" value="demande de congé"  />
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
						<?php echo $link_auteur; ?>
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
			</table>                 
		</fieldset>
	</div>

	<div>
		<fieldset class="adminform">
			<legend><?php echo ucfirst($translate["detail_dde"]);?></legend>
			<table class="admintable" cellspacing="1" border="0">
				<tr>
					<td width="150" class="key">
						<label for="name">
						<?php echo ucfirst($translate["departement"]);?>
						</label>
					</td>
					<td>
						<?php echo $select_departement;?>
<!--						<input type="text" name="departement" id="departement" class="inputbox" size="30" value="" />-->
					</td>
				</tr>				
				<tr>
					<td width="150" class="key">
						<label for="name">
						<?php echo ucfirst($translate["motif"]);?>
						</label>
					</td>
					<td>
						<input type="text" name="motif" id="motif" class="inputbox" size="30" value="" />
					</td>
				</tr>
				<tr>
					<td width="150" class="key">
						<label for="name">
						<?php echo ucfirst($translate["precision"]);?>
						</label>
					</td>
					<td>
						<textarea id="precision" name="precision" rows="5" cols="80" style="width: 100%"></textarea>
					</td>
				</tr>				
				<tr>
					<td class="key" width="150">
						<label for="email">
						<?php echo ucfirst($translate["duree_conge"]);?>
						</label>
					</td>
					<td>
						<?php echo ucfirst($translate['du']); ?>&nbsp;&nbsp;<?php echo $siteweb->date_tag(array("type" => "text" , "name" => "dat_deb_conge" , "id" => "dat_deb_conge" , "class" => "inputbox" , "size" => "11" , "value"=>"{$dat_deb_conge}" ) ,array("src" => $siteweb->get_url()."/images/cal.gif" , "id" => "img_dat_deb_conge" , "style" => "cursor: pointer; border: none;" , "title" => $translate["date_selector"]));?>&nbsp;
						<?php echo ucfirst($translate['au']);?>&nbsp;&nbsp;<?php echo $siteweb->date_tag(array("type" => "text" , "name" => "dat_fin_conge" , "id" => "dat_fin_conge" , "class" => "inputbox" , "size" => "11" , "value"=>"{$dat_fin_conge}" ) ,array("src" => $siteweb->get_url()."/images/cal.gif" , "id" => "img_dat_fin_conge" , "style" => "cursor: pointer; border: none;" , "title" => $translate["date_selector"]));?>
					</td>
				</tr>
				<!--<tr>
					<td class="key" width="150">
						<label for="email">
						<?php echo ucfirst($translate["ajout_fichier"]);?>
						</label>
					</td>
					<td>                       
						<input type="file" id="chemin_acces" name="chemin_acces" size="50" value="">
					</td>
				</tr>-->
			</table>
		</fieldset>
	</div>	
</form>