<form name="form_instal" id = "form_instal1" action="index.php"  >
				<input type="hidden" name="etape" id="etape" value="1" />
				<table width = "100%">
					<tr>
						<td valign="middle" bgcolor="">
							<fieldset class="adminform" >
								<legend>
								<?php echo ucfirst($translate['Etape1_installation_Sesameflow-choisissez_langue']);?>
								</legend>
								<table >
									<tbody>
										<tr>
											<td class="key">
											<label for="lang"><?php echo ucfirst($translate['langue_défaut_utiliser']);?></label> 
											 <select name="lang" id="lang"  value="<?php echo $lang ?>" ondblclick ="window.location='index.php?etape=1&lang=' + document.getElementById('lang').value;  " >
												<option value="fr">Français</option>
												<option value="en">English</option>								
												</select>
											</td>
										</tr>
										<tr >
											<td >
												<input class="spip_bouton" type="button" value="<?php echo ucfirst($translate['Etape_suivante']);?>" onclick="window.location='index.php?etape=2&lang=' + document.getElementById('lang').value;" name ="state1">
											</td>
											<td >
												<input class="spip_bouton" type="button" value="<?php echo ucfirst($translate['quitter']);?>" onclick="javascript:Confirm_Ok_Cancel();" name ="state1">
											</td>
										</tr>
									</body>
								</table>
							</fieldset>
						</td>
					</tr>
					
				</table>
			</form>