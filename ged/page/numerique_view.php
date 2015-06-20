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
	<input type="hidden" name="numtache" id="numtache" value="<?php echo $document->numtache;?>" />
	<input type="hidden" name="typedoc" id="typedoc" value="<?php echo $typedoc; ?>" />
	<table width="100%">
		<tr>
			<td width="100%" valign="top">
				<fieldset class="adminform">
				<legend></legend>
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
								<?php echo ucfirst($translate["date_import"]);?>
							</label>
						</td>
						<td>
							<input type="text" name="date_dde" id="date_dde" class="inputbox" size="30" value="<?php echo $document->dateimport; ?>" disabled/>						
						</td>
					</tr>
					<tr>
						<td class="key">
							<label for="username">
								<?php echo ucfirst($translate["heure_import"]);?>
							</label>
						</td>
						<td>
							<input type="text" name="date_dde" id="date_dde" class="inputbox" size="30" value="<?php echo $document->heureimport; ?>" disabled/>						
						</td>
					</tr>
		    </table>	    
			</fieldset>
		</td>	
	</tr>
</table>		
</form>
<iframe src="<?php echo $url_file_name; ?>" 
	name="frm_pub"
	id="frm_pub"
	width="100%" 
	height="600px"
	frameborder="1" 
	align="middle">
</iframe>