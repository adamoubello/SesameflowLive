

<form action="<?php echo $siteweb->get_url()."/administration/traitements/partie_centrale.php";?>" method="POST" name="form_module" id="form_module">
		<input type="hidden" id="lang" name="lang" value="<?php echo $lang ?>">
		<input type="hidden" id="login" name="login" value="<?php echo $login ?>">
		<input type="hidden" id="do" name="do" value="rh_param_update">
		<input type="hidden" id="liste_elements" name="liste_elements" value=""  />
		<input type="hidden" id="codemod" name="codemod" value="rh"  />
		<table width="100%">
			<tr>
				<td valign="top">
					<fieldset class="adminform">
						<legend><?php echo ucfirst($translate["interfacage_rh"]); ?></legend>
							<table class="admintable" cellspacing="1">
								<tbody>
								<tr>
									<td  class="key" width="50%">
										<span class="editlinktip hasTip" title="Type de base de donn�es de la rh">
										<?php echo ucfirst($translate["type_base_donnee_rh"]); ?></span>										
									</td>
									<td> 
										<?php
										
										echo $siteweb->sel_option_typebd(array("class"=>"text_area" , "name"=>"typebd" , "id"=>"typebd" ) , $lmodule->typebd );
										?>
									</td>
								</tr>
							<tr>
								<td width="60%" class="key">
									<span class="editlinktip hasTip" title="Nom du serveur::Nom d'h�te de votre base de donn�es de la rh saisit lors de l'installation. Ne modifiez pas ce champ sauf absolue n�cessit�, comme par exemple lors d'un transfert vers un nouvel h�te.">
									<?php echo ucfirst($translate["nom_serveur_bd_rh"]); ?></span>
								</td>
								<td>
									<input class="text_area" type="text" name="hotebd" id="hotebd"  size="30" value="<?php echo $lmodule->hotebd; ?>" />
									<em><font color="Red"><b>*</b></font></em>
								</td>
						</tr>
						<tr>				
							<td class="key">
								<span class="editlinktip hasTip" title="Identifiant::Identifiant pour l'acc�s � la base de donn�es de la rh saisit lors de l'installation.  Ne modifiez pas ce champ sauf absolue n�cessit�, comme par exemple lors d'un transfert vers un nouvel h�te.">
										<?php echo ucfirst($translate["identifiant_acces_bd_rh"]); ?></span>
							</td>
							<td>
								<input class="text_area" type="text" name="userbd" id="userbd" size="30" value="<?php echo $lmodule->userbd; ?>" />
								<em><font color="Red"><b>*</b></font></em>
							</td>
						</tr>
						<tr>				
							<td class="key">
								<span class="editlinktip hasTip" title="Identifiant::Identifiant pour l'acc�s � la base de donn�es de la rh saisit lors de l'installation.  Ne modifiez pas ce champ sauf absolue n�cessit�, comme par exemple lors d'un transfert vers un nouvel h�te.">
										<?php echo ucfirst($translate["passwordrh"]); ?></span>
							</td>
							<td>
								<input class="text_area" type="text" name="pwdbd" id="pwdbd" size="30" value="<?php echo $lmodule->pwdbd; ?>" />
							</td>
						</tr>
						<tr>
							<td class="key">
								<span class="editlinktip hasTip" title="Base de donn�es::Nom de votre base de donn�es de la rh saisit lors de l'installation. Ne modifiez pas ce champ sauf absolue n�cessit�, comme par exemple lors d'un transfert vers un nouvel h�te.">
								<?php echo ucfirst($translate["databaserh"]); ?></span>
							</td>
							<td>
								<input class="text_area" type="text" name="nombd" id="nombd" size="30" value="<?php echo $lmodule->nombdp; ?>" />
								<em><font color="Red"><b>*</b></font></em>
							</td>
						</tr>
						<tr>
							<td>
								&nbsp;&nbsp;<input type="button" value="<?php echo $translate["tester_connexion"]; ?>" onclick="javascript:on_test_connexion_database('<?php echo $siteweb->get_url()."/administration/traitements/ttest_connexion.php"  ; ?>' , '<?php echo $siteweb->get_url()  ; ?>');" />
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
