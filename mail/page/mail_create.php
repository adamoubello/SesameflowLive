<?php 
/**
 * @version			1.0
 * @package			Mail
 * @subpackage		Mail
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @created		:	29 mars 2009 by patrick mveng
 * @author 			Patrick Mveng
 * @desc		:	script pour la fiche de création d'un mail
 * 					
 * @creationdate	
 * @updates
 */
?>
<form action="<?php echo $siteweb->get_url()."/mail/traitements/controleur.php"; ?>" method="post" name="frm_create_mail" id="frm_create_mail">
	<input type="hidden" id="do" name="do" value="mail_create_valid"  />
	<input type="hidden" id="lang" name="lang" value="<?php echo $lang; ?>"  />
	<input type="hidden" id="login" name="login" value="<?php echo $login; ?>"  />
	<input type="hidden" id="code_mail" name="code_mail" value=""  />
	<input type="hidden" id="from" name="from" value=""  />
	<table width="100%">
		<tr>
			<td width="30%" valign="top">
				<fieldset class="adminform">
					<legend><?php echo ucfirst($translate["detail"]); ?></legend>
		
					<table class="admintable">
					<tbody>
					<tr>
						 <td class="key">
							<label for="date_mail">
								<?php echo ucfirst($translate["date_creation"]); ?>:
							</label>
						</td>
						<td>
							<input disabled class="inputbox" name="date_mail" id="date_mail" value="<?php echo $date_mail; ?>" size="30" type="text">
						</td>
					</tr>								
					<tr>
						<td class="key">
							<label for="mm_mode">
								<?php echo ucfirst($translate["send_en_html"]); ?>:
							</label>
						</td>
						<td>
							<input name="chkbox_format_mail" id="chkbox_format_mail" value="<?php echo $chkbox_format_mail; ?>" type="checkbox" <?php echo ($chkbox_format_mail == 1) ? "checked=\"checked\"" : ""; ?> >
						</td>
					</tr>
					</tbody></table>
				</fieldset>
			</td>
			<td width="70%" valign="top">
				<fieldset class="adminform">
					<legend><?php echo ucfirst($translate["mail"]); ?></legend>
		
					<table class="admintable">
					<tbody>
					<tr>
						<td class="key">
							<label for="mm_subject">
								<?php echo ucfirst($translate["sujet"]); ?>:
								
							</label>
						</td>
						<td>
							<input class="inputbox" name="sujet_mail" id="sujet_mail" value="<?php echo $sujet_mail; ?>" size="150" type="text">
							<em><font color="Red"><b>*</b></font></em>
						</td>
					</tr>
															
					<tr>
						<td class="key" valign="top">
							<label for="mm_message">
								<?php echo ucfirst($translate["body"]); ?>:
							</label>
						</td>
						<td id="mm_pane">
							<textarea id="body_mail" name="body_mail" rows="15" cols="80" style="width: 100%"><?php echo $body_mail;  ?></textarea>
						</td>
					</tr>
					
					</tbody></table>
				</fieldset>
			</td>
		</tr>	
		<tr><td colspan="2"><em><font color="Red"><b>*&nbsp;<?php echo ucfirst($translate["champs_obligatoires"]) ?></b></font></em></td></tr>
	</table>
</form>
