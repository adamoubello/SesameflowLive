<form action="<?php echo $siteweb->get_url()."/mail/traitements/controleur.php"; ?>" method="post"  id="form_mail_view" name="form_mail_view">
	<input type="hidden" id="do" name="do" value="mail_update_valid"  />
	<input type="hidden" id="lang" name="lang" value="<?php echo $lang; ?>"  />
	<input type="hidden" id="login" name="login" value="<?php echo $login; ?>"  />
    <input type="hidden" name="code_mail"  id="code_mail" value="<?php echo $code_mail; ?>" />	
    <input type="hidden" id="cb0" name="cid[]" value="<?php echo $code_mail; ?>">
    <input type="hidden" id="boxchecked" name="boxchecked" value="1">
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
							<input disabled class="inputbox" name="date_mail" id="date_mail" value="<?php echo $lmail->date_mail; ?>" size="30" type="text">
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
			<td>
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
						<label>
							<?php echo ucfirst($translate["body"]); ?>:
						</label>
					</td>
					<td>
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
