<form action="<?php echo $siteweb->get_url()."/utilisateur/traitements/partie_centrale.php" ?>" method="post" name="form_create_user" id="form_create_user" >
<table width="100%">
	<tr>
		<td width="50%">
 	<input type="hidden" id="lang" name="lang" value="<?php echo $lang ?>">
	<input type="hidden" id="login" name="login" value="<?php echo $login ?>">
	<input type="hidden" id="do" name="do" value="user_create_valid"> 
	<input type="hidden" id="codeuser" name="codeuser" value="<?php echo $user->codeuser; ?>"> 
		<fieldset class="adminform">
		<legend> <?php echo ucfirst($translate["donneesuser"]); ?> </legend>
			<table class="admintable" cellspacing="1">
				<tr>
					<td width="150" class="key">
						<label for="name">

							<?php echo ucfirst($translate["code"]); ?>						</label>					</td>
					<td>
						<input type="text" disabled="disabled" name="txt_code" id="txt_code" class="inputbox" size="40" value="<?php echo $user->codeuser; ?>" />
					</td>
				</tr>
				<tr>
					<td width="150" class="key">
						<label for="name">

							<?php echo ucfirst($translate["nomuser"]); ?>						</label>					</td>
					<td>
						<input type="text" name="nomuser" id="nomuser" class="inputbox" size="40" value="" />
						<em><font color="Red"><b>*</b></font></em>
					</td>
				</tr>
				<tr>
				<tr>
					<td width="150" class="key">
						<label for="name">

							<?php echo ucfirst($translate["prenomuser"]); ?>					</label>					</td>
					<td>
						<input type="text" name="prenomuser" id="prenomuser" class="inputbox" size="40" value="" />					</td>
				</tr>
				
				<tr>

					<td class="key">
						<label for="email">
							<?php echo ucfirst($translate["emailuser"]); ?>						</label>					</td>
					<td>
						<input class="inputbox" type="text" name="emailuser" id="emailuser" size="40" value="" />					</td>
				</tr>
                 <tr>
					<td class="key">

						<label for="username">
							<?php echo ucfirst($translate["loginuser"]); ?>						</label>					</td>
					<td>
						<input type="text" name="loginuser" id="loginuser" class="inputbox" size="40" value="" autocomplete="off" />					
						<em><font color="Red"><b>*</b></font></em>
					</td>
				</tr>
				<tr>
					<td class="key">
						<label for="password">
							<?php echo ucfirst($translate["passworduser"]); ?>						</label>					</td>
					<td>
						<input class="inputbox" type="password" name="passworduser" id="passworduser" size="40" value=""/>
						<em><font color="Red"><b>*</b></font></em>
					</td>
				</tr>
				<tr>
					<td class="key">
						<label for="password2">
							<?php echo ucfirst($translate["passworduser1"]); ?>						</label>					</td>
					<td>
						<input class="inputbox" type="password" name="password2" id="password2" size="40" value=""/>
						<em><font color="Red"><b>*</b></font></em>
					</td>
				</tr>
				
				<tr>
					<td class="key"><?php echo ucfirst($translate["profil"]); ?></td>
					<td>
						<?php
							echo $select_profil;
						?>
					</td>
				</tr>
						
	    </table>
		</fieldset>
		</td>
		<td width="50%">
		<fieldset class="adminform">
		<legend> <?php echo ucfirst($translate["detailsuser"]); ?> </legend>
			<table class="admintable">
				<tr>
					<td>

<table class="admintable" cellspacing="1">
				
				<tr>
				<tr>
					<td width="150" class="key">
						<label for="name">

							<?php echo ucfirst($translate["villeuser"]); ?>					</label>
					</td>
					<td>
						<input type="text" name="villeuser" id="villeuser" class="inputbox" size="40" value="" />
					</td>
				</tr>
				<tr>

					<td class="key">
						<label for="email">
							<?php echo ucfirst($translate["numteluser"]); ?>				</label>
					</td>
					<td>
						<input class="inputbox" type="text" name="numteluser" id="numteluser" size="20" value="" />
					</td>
				</tr>
                 
				<tr>
					<td class="key">
						<label for="password">
						<?php echo ucfirst($translate["numburuser"]); ?>						</label>					</td>
					<td>
						<input class="inputbox" type="text" name="numburuser" id="numburuser" size="20" value=""/>
				  </td>

				</tr>
				<tr>
					<td class="key">
						<label for="password2">
							<?php echo ucfirst($translate["numfaxuser"]); ?>					</label>
					</td>
					<td>
													<input class="inputbox" type="text" name="numfaxuser" id="numfaxuser" size="20" value="" />

				  </td>
				</tr>
				
				<tr>
					<td class="key">
						<label for="password2">
							<?php echo ucfirst($translate["datenaissanceuser"]); ?>					</label>
					</td>
					<td>
													<!--<input class="inputbox" type="text" name="datenaiss" id="datenaiss" size="40" value="" />-->
<?php echo $siteweb->date_tag(array("type" => "text" , "name" => "datenaissanceuser" , "id" => "datenaissanceuser" , "class" => "inputbox" , "size" => "11" , "value"=>"" ) ,array("src" => $siteweb->get_url()."/images/cal.gif" , "id" => "img_datenaiss" , "style" => "cursor: pointer; border: none;" , "title" => $translate["date_selector"]  )); ?>

				  </td>
				</tr>					
							
				<tr>
					<td valign="top" class="key">
						<label for="gid">
							<?php echo ucfirst($translate["groupe"]); ?>					</label>
					</td>
					<td>
						<?php echo $select_groupe;  ?>
						<em><font color="Red"><b>*</b></font></em>
					</td>

				</tr>
				<tr>
					<td valign="top" class="key">
						<label for="gid">
							<?php echo ucfirst($translate["departement"]); ?>						</label>
					</td>
					<td>
						<?php echo $select_departement;  ?>
					</td>
				</tr>
				
				</table>
				</td>
				</tr>
			</table>
		</fieldset>
		</td>
	</tr>
	<tr><td colspan="2"><em><font color="Red"><b>*&nbsp;<?php echo ucfirst($translate["champs_obligatoires"]) ?></b></font></em></td></tr>
</table>		
</form>
