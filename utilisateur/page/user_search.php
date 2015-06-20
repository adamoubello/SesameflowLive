<table width="100%" >
	<tr>	
		<td>	   
			 <form action="<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php"; ?>" method="post" name="form_user_search">
				<input type="hidden" id="do" name="do" value="user_search"  />
				<input type="hidden" id="lang" name="lang" value="<?php echo $lang; ?>"  />
				<input type="hidden" id="login" name="login" value="<?php echo $login; ?>"  />
				<fieldset class="adminform" >
				<legend><?php echo ucfirst($translate["recherche_utilisateur"]); ?></legend>
					<table width="405" cellspacing="1" class="admintable" hspace="123">
						<tr>
							<td class="key">
						  <label for="name"> <?php echo ucfirst($translate["parnom_utilisateur"]); ?> </label>					</td>
							<td ><?php 
  echo $siteweb->sel_option_search(array( "class" => "texte_gris" , "name" => "sel_option_nomuser")
									 , $sel_option_nomuser , ucfirst($translate["choisissez"])); 
							?></td>
							<td><input name="nomuser" type="text" class="inputbox" id="nomuser" value="<?php echo $nomuser; ?>" size="50" />
			                </td>
						</tr>
						
						<tr>
							<td class="key">
								<label for="surname"> <?php echo ucfirst($translate["parprenom_utilisateur"]); ?> </label>					</td>
							<td ><?php 
									echo $siteweb->sel_option_search(array( "class" => "texte_gris" , "name" => "sel_option_prenomuser")
									 , $sel_option_prenomuser , ucfirst($translate["choisissez"])); 
							?></td>
							<td ><input name="prenomuser" type="text" class="inputbox" id="prenomuser" value="<?php echo $prenomuser; ?>" size="50" />
							<!--<input type="submit" style="border: 0; padding: 0; margin: 0; width: 0px; height: 0px;" value="rechercher" name="btn2" />-->				    </td>
						  <td>&nbsp;</td>
						</tr>
						
						<tr>
							<td class="key">
								<label for="login"> <?php echo ucfirst($translate["parlogin_utilisateur"]); ?> </label>					</td>
							<td ><?php 
echo $siteweb->sel_option_search(array( "class" => "texte_gris" , "name" => "sel_option_loginuser") , $sel_option_loginuser , ucfirst($translate["choisissez"])); 
							?></td>
							<td ><input name="loginuser" type="text" class="inputbox" id="loginuser" value="<?php echo $loginuser; ?>" size="50" />
							<!--<input type="submit" style="border: 0; padding: 0; margin: 0; width: 0px; height: 0px;" value="rechercher" name="btn2" />-->				    </td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
							<td class="key">
								<label for="name"> <?php echo ucfirst($translate["partype_utilisateur"]); ?> </label>					</td>
							<td ><?php 
									echo $siteweb->sel_option_search_type(array( "class" => "texte_gris" , "name" => "sel_option_typeuser")
									 , $sel_option_typeuser , ucfirst($translate["choisissez"])); 
							?></td>
							<td ></td>
							<td></td>
						</tr>
						<tr>
							<td colspan="3" align="center">
								<br/>
								<input type="submit" onclick="javascript:document.form_user_search.submit();" value="<?php echo ucfirst($translate["rechercher"]); ?>" />
								<input type="button" onclick="javascript:document.form_user_search.nomuser.value = '';document.form_user_search.prenomuser.value = '';document.form_user_search.loginuser.value = '';" value="<?php echo ucfirst($translate["recommencer"]); ?>"></input>
							
							</td>
						</tr>				
				    </table>
				</fieldset>
			</form>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $result_recherche_user; ?>				
		</td>
	</tr>
</table>