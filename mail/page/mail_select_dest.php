<?php 

	/**
	 * @author 		:	Patrick Mveng
	 * @package 	:	Newsletter
	 * @copyright 	:	2009 INTERFACESA
	 * @name 		: script pour la fiche de recherche des abonnés
	 */

?>
<table width="100%">
	<tr>
		<td valign="top" width="30%">
			<fieldset class="adminform">
				<legend><?php echo ucfirst($translate["mail"]); ?></legend>
				<form action="<?php echo $siteweb->get_url()."/mail/traitements/controleur.php"; ?>" method="post" name="frm_create_mail" id="frm_create_mail">

				<table class="admintable">
				<tbody>
				<tr>
					<td class="key">
						<label for="date_mail"><?php echo ucfirst($translate["sujet"]); ?></label>
					</td>
					<td>
						<input disabled class="inputbox" name="sujet_mail" id="sujet_mail" value="<?php echo substr($sujet_mail, 0 , 60); ?>" size="70" type="text">
					</td>
				</tr>
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
				</form>
			</fieldset>
			<fieldset class="adminform">
				<legend><?php echo ucfirst($translate['Filtre_Recherche']) ?></legend>
				<form id="frm_search_dest" name="frm_search_dest" action="<?php echo $siteweb->get_url()."/mail/traitements/controleur.php"; ?>" method="POST">
				<input type="hidden" id="code_mail" name="code_mail" value="<?php echo $code_mail; ?>"  />
				<table class="admintable">
				<tbody>
				<tr>
					<td class="key">
						<label for="nomuser"><?php echo ucfirst($translate["nomuser"]); ?>
					</td>
					<td>
						<?php 
							echo $siteweb->sel_option_search(array( "class" => "texte_gris" , "name" => "sel_option_nomuser" , "id" => "sel_option_nomuser") , $sel_option_nomuser); 
						?>
						<input class="inputbox" name="nomuser" id="nomuser" value="<?php echo $nomuser; ?>" size="30" type="text">
					</td>
				</tr>	
				<tr>
					<td class="key">
						<label for="prenomuser"><?php echo ucfirst($translate["prenomuser"]); ?>
					</td>
					<td>
						<?php 
							echo $siteweb->sel_option_search(array( "class" => "texte_gris" , "name" => "sel_option_prenomuser" , "id" => "sel_option_prenomuser") , $sel_option_prenomuser ); 
						?>
						<input class="inputbox" name="prenomuser" id="prenomuser" value="<?php echo $prenomuser; ?>" size="30" type="text">
					</td>
				</tr>				

				<tr>
					<td class="key">
						<label for="emailuser"><?php echo ucfirst($translate["emailuser"]); ?></label>
					</td>
					<td>
						<?php 
							echo $siteweb->sel_option_search(array( "class" => "texte_gris" , "name" => "sel_option_emailuser" , "id" => "sel_option_emailuser") , $sel_option_emailuser); 
						?>
						<input class="inputbox" name="emailuser" id="emailuser" value="<?php echo $emailuser; ?>" size="50" type="text">
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<input type="button" onclick="javascript:on_valid_recherche_abonne('<?php echo $siteweb->get_url()."/mail/traitements/tmail_select_dest.php"; ?>' , '<?php echo $siteweb->get_url(); ?>');" value="<?php echo ucfirst($translate['recherche']); ?>" />
						<input type="reset" onclick="document.frm_search_dest.reset();" value="<?php echo ucfirst($translate['recommencer']); ?>" />
					</td>
				</tr>
				
				</tbody></table>
				</form>
			</fieldset>
		</td>
		<td width="70%" valign="top">
			<div id="div_result_select_dest">
				<fieldset class="adminform">
					<legend><?php echo ucfirst($translate["destinataire"]); ?></legend>
					<form name="frm_abonne" id="frm_abonne" action="<?php echo $siteweb->get_url()."/mail/traitements/controleur.php"; ?>" method="POST" >
						<input type="hidden" id="boxchecked" name="boxchecked" value="0" />
						<input type="hidden" name="nbr_abonne" id="nbr_abonne" value="<?php echo count($listeuser); ?>" />
						<input type="hidden" id="code_mail" name="code_mail" value="<?php echo $code_mail; ?>"  />
						<input type="hidden" id="do" name="do" value="mail_send_valid"  />
						<input type="hidden" id="lang" name="lang" value="<?php echo $lang; ?>"  />
						<input type="hidden" id="login" name="login" value="<?php echo $login; ?>"  />
						<?php echo $result_recherche_user; ?>
					</form>
				</fieldset>
			</div>
		</td>		
	</tr>
</table>		
