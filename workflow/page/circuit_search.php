<?php
/**
 * @version			1.0
 * @package			Workflow
 * @subpackage		Circuit
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			patrick mveng<patrick.mveng@interfacesa.local>
 * @desc			Script pour la fiche de recherche des circuits
 * @creationdate	samedi 27 juin 2009
 * @updates
 */	
?>
<table>
	<tr>
		<td> 
	   <div align="center" style="display:block" >
				 <form action="page.gabarit.php?do=circuit_search&lang=<?php echo $lang; ?>" method="post" name="form_circuit_search">
					<input type="hidden" id="do" name="do" value="ircuit_search"  />
					<input type="hidden" id="lang" name="lang" value="<?php echo $lang; ?>"  />
					<input type="hidden" id="login" name="login" value="<?php echo $login; ?>"  />
					
		<fieldset class="adminform" >
		<legend><?php echo ucfirst($translate["recherche_circuit"]); ?> </legend>
			<div id="div_circuit_search">
			<table width="405" cellspacing="1" class="admintable" hspace="123">
				
				<tr>
				  <td class="key">
				  <label for="name"> <?php echo ucfirst($translate["libelle"]); ?> </label></td>
					<td ><?php 
							echo $siteweb->sel_option_search(array( "class" => "texte_gris" , "name" => "sel_option_libcircuit")
							 , $sel_option_libcircuit , ucfirst($translate["choisissez"])); 
					?></td>
				  <td>
				  <input name="libcircuit" type="text" class="inputbox" id="libcircuit" value="<?php echo $libcircuit; ?>" size="60" />
				  </td>
				
				</tr>
				<tr>
					<td class="key">
						<label for="login"> <?php echo ucfirst($translate["duree"]); ?> </label>					</td>
					<td><?php 
							echo $siteweb->sel_option_search_entier(array( "class" => "texte_gris" , "name" => "sel_option_dureecircuit")
							 , $sel_option_dureecircuit , ucfirst($translate["choisissez"])); 
					?></td>
					<td ><input name="dureecircuit" type="text" class="inputbox" id="dureecircuit" value="<?php echo $dureecircuit; ?>" size="10" />
					</td>
				</tr>
				<tr>
					<td class="key">
						<label for="login"> <?php echo ucfirst($translate["processus"]); ?> </label>					</td>
					<td>
					<?php 
						echo $select_processus;
					?>
					</td>
					<td >&nbsp;</td>
				</tr>				
				<tr>
					<td colspan="3" align="center">
						<br/>
						<input type="submit" onclick="javascript:document.form_circuit_search.submit();" value="<?php echo ucfirst($translate["rechercher"]); ?>" />
						<input type="button" onclick="javascript:document.form_circuit_search.libcircuit.value = '';document.form_processus_search.dureecircuit.value = '';" value="<?php echo ucfirst($translate["recommencer"]); ?>"></input>
					</td>
				</tr>
	    </table></div>
		</fieldset>
		</form>
	</div>
	</td>
</table>
<div>
	<?php
		echo $result_recherche_circuit;
	?> 
</div>