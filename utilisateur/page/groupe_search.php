<table width="100%" >
	<tr>	
		<td>	   
		 <form action="<?php echo $siteweb->get_url()."/gabarit"; ?>/page.gabarit.php?do=groupe_search&lang=<?php echo $lang; ?>" method="post" name="form_groupe_search" id="form_groupe_search">
			<input type="hidden" id="do" name="do" value="groupe_search"  />
			<input type="hidden" id="lang" name="lang" value="<?php echo $lang; ?>"  />
			<input type="hidden" id="login" name="login" value="<?php echo $login; ?>"  />
			<fieldset class="adminform" >
				<legend> <?php echo ucfirst($translate["rechercher_groupe"]); ?> </legend>
					<table width="405" cellspacing="1" class="admintable" hspace="123">
						
						<tr>
						  <td class="key">
						  <label for="name"> <?php echo ucfirst($translate["libelle"]); ?> </label></td>
							<td ><?php 
              echo $siteweb->sel_option_search(array( "class" => "texte_gris" , "name" => "sel_option_libgroup" , "id" => "sel_option_libgroup") , $sel_option_libgroup , ucfirst($translate["choisissez"])); 
							?></td>
						  <td><input name="libgroup" type="text" class="inputbox" id="libgroup" value="<?php echo $libgroup; ?>" size="50" />	    </td>
						</tr>
						
						<tr>
							<td colspan="3" align="center">
								<br/>
								<input type="button" onclick="javascript:on_groupe_search_valid();" value="<?php echo ucfirst($translate["rechercher"]); ?>" />
								<input type="button" onclick="javascript:document.form_groupe_search.libgroup.value = '';" value="<?php echo ucfirst($translate["recommencer"]); ?>"></input>
							
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
		<?php echo $result_recherche_groupe;	?>
		</td>
	</tr>
</table>
