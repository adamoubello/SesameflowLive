 <?php
/**
 * @version			1.0
 * @package			MAIL
 * @subpackage		MAIL
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Raoul<ngambiaraoul@yahoo.fr>
 * @desc			script pour l'affichage de la page de recherche des mails
 * @creationdate	vendredi 24 juillet 2009
 * @updates
 * 	
 */
 ?>
 
<table width="100%">
	<tr>
		<td>		   
			<form action="<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?login={$login}&lang={$lang}&do=mail_search"; ?>" method="post" name="form_mail_search" id="form_mail_search">
				<input type="hidden" id="do" name="do" value="mail_search"  />
				  <input type="hidden" id="lang" name="lang" value="<?php echo $lang; ?>"  />
					<input type="hidden" id="login" name="login" value="<?php echo $login; ?>"  />
						<fieldset class="adminform" >
							<legend><?php echo $translate['lib_mail_search'] ?></legend>
							<div id="div_doc_search">
								<table width="100%" cellspacing="1" class="admintable" hspace="123">
								   <tr>
										<td class="key" width="30%">
											<label for="name"><?php echo ucfirst($translate['sujet']); ?></label>
										</td>
										<td width="60%" >&nbsp;&nbsp;
											<?php
											echo $siteweb->sel_option_search(array( "class" => "texte_gris" , "name" => "sel_option_sujet_mail" , "id" => "sel_option_sujet_mail")
											, $sel_option_sujet_mail , ucfirst($translate["choisissez"]));
											?>
											<input name="sujet_mail" type="text" class="inputbox" id="sujet_mail" value="<?php echo $sujet_mail; ?>" size="50" />
										</td>
									</tr>
									<tr>
										<td class="key" width="30%">
											<label for="name"><?php echo ucfirst($translate['body']); ?></label>
										</td>
										<td width="60%" >&nbsp;&nbsp;
											<input name="body_mail" type="text" class="inputbox" id="body_mail" value="<?php echo $body_mail; ?>" size="50" />
										</td>
									</tr>
									<tr>
										<td class="key">
											<label for="name"><?php echo ucfirst($translate['date_creation']); ?></label>
										</td>
										<td><?php echo $translate['entre']; ?>&nbsp;&nbsp;<?php echo $siteweb->date_tag(array("type" => "text" , "name" => "dat_deb_creation" , "id" => "dat_deb_creation" , "class" => "inputbox" , "size" => "11" , "value"=>"{$dat_deb_creation}" ) ,array("src" => $siteweb->get_url()."/images/cal.gif" , "id" => "img_dat_deb_creation" , "style" => "cursor: pointer; border: none;" , "title" => $translate["date_selector"]));
											?>
											&nbsp;<?php echo $translate['et'];?>&nbsp;&nbsp;<?php echo $siteweb->date_tag(array("type" => "text" , "name" => "dat_fin_creation" , "id" => "dat_fin_creation" , "class" => "inputbox" , "size" => "11" , "value"=>"{$dat_fin_creation}" ) ,array("src" => $siteweb->get_url()."/images/cal.gif" , "id" => "img_dat_fin_creation" , "style" => "cursor: pointer; border: none;" , "title" => $translate["date_selector"]));
											?>
										</td>
									</tr>
									
									<tr>
										<td class="key">
											<label for="name"><?php echo ucfirst($translate['etat']); ?></label>
										</td>
										<td>&nbsp;&nbsp;
											<?php
											echo $lmail->sel_mail_search(array( "class" => "texte_gris" , "name" => "sel_option_etat[]" , "id" => "sel_option_etat")
											, $sel_option_etat);
											?>
										</td>
									</tr>								
									<tr>
										<td colspan="2" align="center">
											<input type="button" onclick="javascript:document.form_mail_search.submit();" value="<?php echo ucfirst($translate['recherche']); ?>"/>
											<input type="button" onclick="javascript:document.getElementById('form_mail_search').reset();" value="<?php echo ucfirst($translate['recommencer']); ?>"/>
										</td>
									</tr>
								</table>
							</div>
						</fieldset>
				</form>
		</td>
	</tr>
</table>
<?php echo($result_recherche_mail);?>