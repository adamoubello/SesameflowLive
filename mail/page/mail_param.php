<table width="100%">
	<tr>
		<td valign="top">
		<fieldset class="adminform">
			<legend><label for="name"><?php echo $translate['lib_reglages_email'] ?></label></legend>
			<form action="<?php echo $siteweb->get_url()."/mail/traitements/controleur.php"; ?>" method="post" name="frm_create_param_nenwsletter" id="frm_create_param_nenwsletter">
				<input type="hidden" name="do"  id="do" value="mail_param_valid" />
				<input type="hidden" id="lang" name="lang" value="<?php echo $lang; ?>"  />
				<input type="hidden" id="login" name="login" value="<?php echo $login; ?>"  />
					<table class="admintable" cellspacing="1">
				
						<tbody>
						<tr>
							<td class="key" width="50%">
								<span class="editlinktip hasTip">
										<label for="name"><?php echo $translate["serveur_de_mail"] ?></label>	</span>
							</td>
							<td width="60%">
								<?php
									echo $lmail->sel_option_mail_server(
										array("name"=>"sel_mail_server" , "id"=>"sel_mail_server" , "class"=>"inputbox" , "size"=>"1")
										, $mail_server);
								?>
							</td>
						</tr>
						<tr>
							<td class="key">
								<span class="editlinktip hasTip">
										<label for="name"><?php echo $translate["adresse_expéditeur"] ?></label>				</span>
							</td>
							<td>
								<input class="text_area" name="sender_email" id="sender_email" size="60" value="<?php echo $sender_email ?>" type="text">
										<em><font color="Red"><b>*</b></font></em>
							</td>
						</tr>
						<tr>
							<td class="key">
								<span class="editlinktip hasTip">
										<label for="name"><?php echo $translate["nom_expéditeur"] ?></label></span>
							</td>
							<td>
								<input class="text_area" name="sender_name" id="sender_name"  size="60" value="<?php echo $sender_name ?>" type="text">
							</td>
						</tr>
						<tr>
							<td class="key">
								<span class="editlinktip hasTip">
										<label for="name"><?php echo $translate["chemin_accès_sendmail"] ?></label>	</span>
							</td>
							<td>
								<input class="text_area" name="sendmail_path" id="sendmail_path" size="100" value="<?php echo $sendmail_path; ?>" type="text">
								<em><font color="Red"><b>*</b></font></em>
							</td>
						</tr>
						<tr>
							<td class="key">
								<span class="editlinktip hasTip">
										<label for="name"><?php echo $translate["identification_SMTP_requise"] ?></label></span>
							</td>
							<td>
								<input name="smtp_auth" id="smtpauth0" value="0" <?php if (intval($smtp_auth) == 0) echo "checked=\"checked\""; ?>  class="inputbox" type="radio">
								<label for="smtpauth0"><?php echo $translate["non"] ?></label>
								<input name="smtp_auth" id="smtpauth1" value="1" <?php if (intval($smtp_auth) == 1) echo "checked=\"checked\""; ?> class="inputbox" type="radio">
								<label for="smtpauth1"><?php echo $translate["oui"] ?></label>
							</td>
						</tr>
						<tr>
							<td class="key">
								<span class="editlinktip hasTip">
										<label for="name"><?php echo $translate["utilisateur_SMTP"] ?></label>	</span>
							</td>
							<td>
								<input class="text_area" id="smtp_user"  name="smtp_user" size="60" value="<?php echo $smtp_user; ?>" type="text">
								<em><font color="Red"><b>*</b></font></em>
							</td>
						</tr>
						<tr>
							<td class="key">
								<span class="editlinktip hasTip">
										<label for="name"><?php echo $translate["mot_de_passe_SMTP"] ?></label></span>
										
							</td>
							<td>
								<input class="text_area" id="smtp_pwd"  name="smtp_pwd" size="30" value="<?php echo $smtp_pwd; ?>" type="password">
								<em><font color="Red"><b>*</b></font></em>
							</td>
						</tr>
						<tr>
							<td class="key">
								<span class="editlinktip hasTip">
										<label for="name"><?php echo $translate["hôte_SMTP"] ?></label>	</span>
							</td>
							<td>
								<input class="text_area" id="smtp_host" name="smtp_host" size="60" value="<?php echo $smtp_host; ?>" type="text">
								<em><font color="Red"><b>*</b></font></em>
							</td>
						</tr>
						</tbody>
					</table>
				</form>
		</fieldset>
		</td>
	</tr>
			<tr><td colspan="2"><em><font color="Red"><b>*&nbsp;<?php echo ucfirst($translate["champs_obligatoires"]) ?></b></font></em></td></tr>
</table>		