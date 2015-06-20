<form action="<?php echo $siteweb->get_url()."/workflow/traitements/partie_centrale.php" ?>" method="post" name="form_create_tache" id="form_create_tache" >
	<input type="hidden" id="lang" name="lang" value="<?php echo $lang ?>">
	<input type="hidden" id="login" name="login" value="<?php echo $login ?>">
	<input type="hidden" id="do" name="do" value="tache_create_valid">
	<input type="hidden" id="numtache" name="numtache" value="<?php echo $numtache ;?>">

	<div>
		<fieldset class="adminform">
		<legend><?php echo ucfirst($translate["creertache"]); ?> </legend>
			<table class="admintable" cellspacing="1">
				<tr>
					<td width="150" class="key">
						<label for="name">

							<?php echo ucfirst($translate["numero"]); ?>						</label>					</td>
				  <td><input type="text" disabled="disabled" name="numerotache" id="numerotache" class="inputbox" size="10" value="<?php $_POST["numerotache"]=$incr_code_tache;echo $numtache; ?>" /></td>
				</tr>
				<tr>
					<td width="150" class="key">
						<label for="name">

							<?php echo ucfirst($translate["libelle"]); ?>				</label>					</td>
					<td> <input type="text" name="libtache" id="libtache" class="inputbox" size="50" value="" /> 
					<em><font color="Red"><b>*</b></font></em>
					</td>
				</tr>
				<tr>
					<td width="150" class="key">
						<label for="name">
							<?php echo ucfirst($translate["duree"]); ?>					</label>					</td>
					<td>
						 <input type="text" name="dureetache" id="dureetache" class="inputbox" size="10" value="" />
						 &nbsp;<?php echo $unite_duree; ?>
					</td>
				</tr>
				<tr>
					<td width="150" class="key">
						<label for="name">	<?php echo ucfirst($translate["processus"]); ?>	</label>			</td>
					<td>
						<?php echo $select_processus; ?><em><font color="Red"><b>*</b></font></em>
					</td>
				</tr>
				<tr>
					<td width="150" class="key">
						<label for="name">

							<?php echo ucfirst($translate["type_doc"]); ?>					</label>					</td>
					<td>
						<?php echo $select_typedoc; ?>
					</td>
				</tr>
				<tr><td colspan="2"><em><font color="Red"><b>*&nbsp;<?php echo ucfirst($translate["champs_obligatoires"]) ?></b></font></em></td></tr>
			</table>
		</fieldset>
	</div>

</form>