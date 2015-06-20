<table width="100%">
	<tr>
		<td>
          <?php		 				  
		  $nbr_processus = 0;		  
          ?>        	
		 <form action="<?php echo $siteweb->get_url(); ?>/gabarit/page.gabarit.php?do=processus_search&lang=<?php echo $lang; ?>" method="post" name="form_processus_search">
			<input type="hidden" id="do" name="do" value="processus_search"  />
			<input type="hidden" id="lang" name="lang" value="<?php echo $lang; ?>"  />
			<input type="hidden" id="login" name="lang" value="<?php echo $login; ?>"  />
			<fieldset class="adminform" >
		<legend> <?php echo ucfirst($translate["rechercher_processus"]); ?> </legend>
			<table width="405" cellspacing="1" class="admintable" hspace="123">
				
				<tr>
				  <td class="key">
				  <label for="name"> <?php echo ucfirst($translate["libelle"]); ?> </label></td>
					<td ><?php 
							echo $siteweb->sel_option_search(array( "class" => "texte_gris" , "name" => "sel_option_libprocessus")
							 , $sel_option_libprocessus , ucfirst($translate["choisissez"])); 
					?></td>
<td>
<input name="libprocessus" type="text" class="inputbox" id="libprocessus" value="<?php echo $libprocessus; ?>" size="50" />
</td>
				</tr>
				
				<tr>
					<td class="key">
						<label for="login"> <?php echo ucfirst($translate["duree"]); ?> </label>					</td>
					<td>
						<?php 
							echo $siteweb->sel_option_search_entier(array( "class" => "texte_gris" , "name" => "sel_option_dureeprocessus")
							 , $sel_option_dureeprocessus , ucfirst($translate["choisissez"])); 
						?>
					</td>
					<td ><input name="dureeprocessus" type="text" class="inputbox" id="dureeprocessus" value="<?php echo $dureeprocessus; ?>" size="50" />
					</td>
				</tr>
				<tr>
					<td class="key">
						<label for="login"> <?php echo ucfirst($translate["etat"]); ?> </label>					</td>
					<td>
						<?php 
							echo $process->sel_option_search_etat(array( "class" => "texte_gris" , "name" => "etatprocessus")
							 , $etatprocessus , ucfirst($translate["choisissez"])); 
						?>
					</td>
					<td >&nbsp;</td>
				</tr>
				<tr>
					<td colspan="3" align="center">
						<br/>
						<input type="submit" onclick="javascript:document.form_processus_search.submit();" value="<?php echo ucfirst($translate["rechercher"]); ?>" />
						<input type="button" onclick="javascript:document.form_processus_search.libprocessus.value = '';document.form_processus_search.dureeprocessus.value = '';" value="<?php echo ucfirst($translate["recommencer"]); ?>"></input>
					
					</td>
				</tr>
			<tr>								
	<td>
	</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
	
				</tr>
				
	    </table>
		</fieldset>
		</form>
		</td>
	</tr>	
	<tr>
		<td>
			<?php
				echo $result_recherche_processus;
			?>
		</td>
	</tr>
</table>