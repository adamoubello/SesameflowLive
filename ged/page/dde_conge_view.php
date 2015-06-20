<?php
/**
 * @version			1.0
 * @package			GED
 * @subpackage		Document
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			William<william.nkingne@laposte.net>
 * @desc			script pour la visualisation des données d'un document formulaire
 * @creationdate	mardi 30 juin 2009
 * @updates
 */
 ?>

<form action="<?php echo $siteweb->get_url()."/ged/traitements/partie_centrale.php"; ?>" method="post" name="form_doc_view" id="form_doc_view" enctype="multipart/form-data">
	<input type="hidden" id="do" name="do" value="doc_view"  />
	<input type="hidden" id="lang" name="lang" value="<?php echo $lang; ?>"  />
	<input type="hidden" id="login" name="login" value="<?php echo $login; ?>"  />
    <input type="hidden" name="numdoc" id="numdoc" value="<?php echo $document->numdoc; ?>" />
	<input type="hidden" name="codeuser" id="codeuser" value="<?php echo $document->codeuser;?>" />
	<input type="hidden" name="liste_elements" id="liste_elements" value="" />
	<input type="hidden" name="numtache" id="numtache" value="<?php echo $document->numtache;?>" />
	<input type="hidden" id="numtachesuiv" name="numtachesuiv" value="<?php echo $numtachesuiv; ?>"  />	
	<input type="hidden" id="numworkflow" name="numworkflow" value="<?php echo $numworkflow; ?>"  />	
	<input type="hidden" name="typedoc" id="typedoc" value="<?php echo $typedoc; ?>" />
	<input type="hidden" id="liste_elements" name="liste_elements" value=""  />
	<table width="100%">
		<tr>
			<td width="50%" valign="top">
				<fieldset class="adminform">
				<legend><?php echo ucfirst($translate["donne_dde"]); ?></legend>
				<table class="admintable" width="100%">
					<tr>
						<td class="key">
							<label for="name">
							<?php echo ucfirst($translate["numero"]); ?>
							</label>
						</td>
						<td>
							<input disabled type="text" name="txt_numdoc" id="txt_numdoc" class="inputbox" size="30" value="<?php echo $document->numdoc; ?>"/>
						</td>
					</tr>
					<tr>
						<td class="key">
							<label for="name">
							<?php echo ucfirst($translate["type"]); ?>
							</label>
						</td>
						<td>
							<input type="text" name="titredoc" id="titredoc" class="inputbox" size="30" value="<?php echo $document->titredoc; ?>" disabled/>
						</td>
					</tr>
					<tr>
						<td class="key">
							<label for="name">
							<?php echo ucfirst($translate["auteur"]); ?>
							</label>
						</td>
						<td>
							<?php echo $link_auteur; ?>
						</td>
					</tr>
                    <tr>
						<td class="key">
							<label for="username">
								<?php echo ucfirst($translate["date_dde"]);?>
							</label>
						</td>
						<td>
							<input type="text" name="date_dde" id="date_dde" class="inputbox" size="30" value="<?php echo $document->datecreation; ?>" disabled/>
						</td>
					</tr>
		    </table>
			</fieldset>
		</td>
		<td width="50%" valign="top">
			<fieldset class="adminform">
			<legend> <?php echo ucfirst($translate["detail_dde"]); ?> </legend>
				<table class="admintable" width="100%">
                    <tr>
						<td class="key">
							<label for="email">
							<?php echo ucfirst($translate["date_deb_conge"]);?>
							</label>
						</td>
						<td>
							<?php echo $siteweb->date_tag(array("type" => "text" , "name" => "date_deb_conge" , "id" => "date_deb_conge"
							, "class" => "inputbox" , "size" => "30" , "value"=> $lchamp["dat_deb_conge"] )
							,array("src" => $siteweb->get_url()."/images/cal.gif" , "id" => "img_date2" , "style" => "cursor: pointer; border: none;" , "title" => $translate["date_selector"]));?>
						</td>
					</tr>
                    <tr>
						<td class="key">
							<label for="email">
							<?php echo ucfirst($translate["date_fin_conge"]);?>
							</label>
						</td>
						<td>
							<?php echo $siteweb->date_tag(array("type" => "text" , "name" => "date_fin_conge" , "id" => "date_fin_conge"
							, "class" => "inputbox" , "size" => "30" , "value"=> $lchamp["dat_fin_conge"] )
							,array("src" => $siteweb->get_url()."/images/cal.gif" , "id" => "img_date2" , "style" => "cursor: pointer; border: none;" , "title" => $translate["date_selector"]));?>
						</td>
					</tr>
                    <tr>
						<td class="key">
							<label for="password">
							<?php echo ucfirst($translate["motif"]);?>
							</label>
						</td>
						<td>
							<input class="inputbox" type="text" name="motif" id="motif" size="30" value="<?php echo $lchamp["motif"]; ?>"/>
						</td>
					</tr>
					<tr>
						<td class="key">
							<label for="password">
							<?php echo ucfirst($translate["precision"]);?>
							</label>
						</td>
						<td>
							<input class="inputbox" type="text" name="precision" id="precision" size="30" value="<?php echo $lchamp["precision"]; ?>"/>
						</td>
					</tr>
				</table>
			</fieldset>
		</td>
	</tr>
</table>
</form>