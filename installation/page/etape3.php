<?php
    $data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
		$data[$lkey] = $lvalue;
	}
	
	$portsite = (isset($data["portsite"])) ? (! is_null($data["portsite"])) ? $data["portsite"] : 80 : 80;
?>
	

	<form name="form_instal3"  method="POST" id = "form_instal3" action='<?php echo $siteweb->get_url()."/installation/index.php?lang={$lang}&etape=4";?>'  >
		<input type="hidden" id="lang" name="lang" value="<?php echo $lang ?>">
		<input type="hidden" name="etape" id="etape" value="4" />
		<table width = "100%">
			<tr>
				<td valign="middle" bgcolor="">
					<fieldset class="adminform" >
						<legend>
						<?php echo ucfirst($translate["Etape3_installation_Sesameflow-Fichiers_configuration"]);?>
						</legend>
					<table >
						<tbody>
								<tr>
									<td  class="key">
										<span class="editlinktip hasTip">
										<label for="typebd"> <?php echo ucfirst($translate["type_base_donnee"]); ?> </label>
										</span>
									</td>
									<td>
										<?php
										echo $siteweb->sel_option_typebd(array("class"=>"text_area" , "name"=>"typebd" , "id"=>"typebd" ) , $lconfig->typebd );
										?>
									</td>
								</tr>
								<tr>
									<td class="key">
										<span class="editlinktip hasTip" title="Nom du serveur::Nom d'hôte de votre base de données saisit lors de l'installation. Ne modifiez pas ce champ sauf absolue nécessité, comme par exemple lors d'un transfert vers un nouvel hôte.">
										 <label for="hotesite"><?php echo ucfirst($translate["nom_serveur_site"]); ?></span></label>   
									</td>
									<td>
										<input class="text_area" type="text" name="hotesite" id="hotesite"  size="60" value="<?php echo $lconfig->hotebd; ?>" />
										<em><font color="Red"><b>*</b></font>&nbsp;&nbsp;(Exemple : localhost )</em>
									</td>
								</tr>
								<tr>
									<td width="185" class="key">
										<span class="editlinktip hasTip" >
										 <label for="portsite"> <?php echo ucfirst($translate["port"]); ?></label>  </span>
									</td>
									<td>
										<input class="text_area" type="text" name="portsite" id="portsite"  size="10" value="<?php echo $portsite; ?>" />
										<em><font color="Red"><b>*</b></font></em>
									</td>
								</tr>
								<tr>
									<td class="key">
										<span class="editlinktip hasTip" title="Identifiant::Identifiant pour l'accès à la base de données saisit lors de l'installation.  Ne modifiez pas ce champ sauf absolue nécessité, comme par exemple lors d'un transfert vers un nouvel hôte.">
											 <label for="userbd">	<?php echo ucfirst($translate["identifiant"]); ?></label>  </span>
									</td>
									<td>
										<input class="text_area" type="text" name="userbd" id="userbd" size="30" value="<?php echo $lconfig->userbd; ?>" />
										<em><font color="Red"><b>*</b></font></em>
									</td>
								</tr>
								<tr>
									<td class="key">
										<span class="editlinktip hasTip" title="Identifiant::Identifiant pour l'accès à la base de données saisit lors de l'installation.  Ne modifiez pas ce champ sauf absolue nécessité, comme par exemple lors d'un transfert vers un nouvel hôte.">
											<label for="pwdbd"> <?php echo ucfirst($translate["password"]); ?></label></span>
									</td>
									<td>
										<input class="text_area" type="text" name="pwdbd" id="pwdbd" size="30" value="<?php echo $lconfig->pwdbd; ?>" />
									</td>
								</tr>
								<tr>
									<td class="key">
										<span class="editlinktip hasTip" title="Base de données::Nom de votre base de données saisit lors de l'installation. Ne modifiez pas ce champ sauf absolue nécessité, comme par exemple lors d'un transfert vers un nouvel hôte.">
										 <label for="nombd"> <?php echo ucfirst($translate["database"]); ?></label>  </span>
									</td>
									<td>
										<input class="text_area" type="text" name="nombd" id="nombd" size="30" value="<?php echo $lconfig->nombd; ?>" />
										<em><font color="Red"><b>*</b></font></em>
									</td>
								</tr>		
								<tr>
									<td width="185" class="key">
										<span class="editlinktip hasTip" title="Nom du serveur::Nom d'hôte de votre application web. Ne modifiez pas ce champ sauf absolue nécessité, comme par exemple lors d'un transfert vers un nouvel hôte.">
										 <label for="hotebd"> <?php echo ucfirst($translate["nom_serveur"]); ?></label>  </span>
									</td>
									<td>
										<input class="text_area" type="text" name="hotebd" id="hotebd"  size="60" value="<?php echo $lconfig->hotesite; ?>" />
										<em><font color="Red"><b>*</b></font>&nbsp;&nbsp;(Exemple : localhost )</em>
									</td>
								</tr>					
								<tr>
									<td >
										<input class="spip_bouton" type="button" value="<?php echo ucfirst($translate['Etape_precedente']);?>" onclick="javascript:window.history.back();" name ="state2">
									</td>
									<td >
											<input class="spip_bouton" type="button" value="<?php echo ucfirst($translate['Etape_suivante']);?>" onclick="javascript:on_etape3_valid('<?php echo $siteweb->get_url()."/installation/traitements/tetape3.php";?>');" name ="state1"> 
									</td>
									<td >
											<input class="spip_bouton" type="button" value="<?php echo ucfirst($translate['Recommencer']);?>" onclick="javascript:document.getElementById('form_instal3').reset()" name ="state1">
									</td>
									<td >
										<input class="spip_bouton" type="button" value="<?php echo ucfirst($translate['quitter']);?>" onclick="javascript:Confirm_Ok_Cancel();" name ="state1">
									</td>
								</tr>
							</tbody>
						</table>
					</fieldset>
				</td>
			</tr>
			<tr><td colspan="2"><em><font color="Red"><b>*&nbsp;<?php echo ucfirst($translate["champs_obligatoires"]) ?></b></font></em></td></tr>
		</table>
	</form>