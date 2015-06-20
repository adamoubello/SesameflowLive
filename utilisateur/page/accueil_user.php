
<?php
/**
 * @version			1.0
 * @package			Utilisateur
 * @subpackage		Accueil user
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello Adamou <moustaphbi@yahoo.fr>
 * @desc			Script pour l'affichage des tâches en cours pour chaque utilisateur
 * @creationdate	31 Juillet 2009
 */	
?>

<table>
<td> 
          <?php	
		        	  				  
			    $nbr_accueil_user = 0;		  
           ?>        	
	   <div align="center" style="display:block" >
				 <form action="page.gabarit.php?do=accueil_user&lang=<?php echo $lang; ?>" method="post" name="form_accueil_user">
					<input type="hidden" id="do" name="do" value="accueil_user"  />
					<input type="hidden" id="lang" name="lang" value="<?php echo $lang; ?>"  />
					<input type="hidden" id="login" name="login" value="<?php echo $login; ?>"  />
					
		<fieldset class="adminform" >
		<legend><?php echo ucfirst($translate["recherche"]); ?> </legend>
			<div id="div_accueil_user">
			<table width="405" cellspacing="1" class="admintable" hspace="123">
				
				<tr>
				  <td class="key"> <label for="name"> <?php echo ucfirst($translate["libelle"]); ?> </label> </td>
					<td ><?php 
						echo $siteweb->sel_option_search(array( "class" => "texte_gris" , "name" => "sel_option_libaccueil_user")
							 , $sel_option_libaccueil_user , ucfirst($translate["choisissez"])); ?>
					</td>
				  <td>
				  <input name="libaccueil_user" type="text" class="inputbox" id="libaccueil_user" value="<?php echo $libaccueil_user; ?>" size="80" />
				  </td>
				</tr>
				
				<tr>
					<td class="key">
						<label for="login"> <?php echo ucfirst($translate["duree"]); ?> </label>					</td>
					<td><?php 
                         echo $siteweb->sel_option_search_entier(array( "class" => "texte_gris" , "name" => "sel_option_dureeaccueil_user")
							 , $sel_option_dureeaccueil_user , ucfirst($translate["choisissez"]));   ?>
					</td>
				<td ><input name="dureeaccueil_user" type="text" class="inputbox" id="dureeaccueil_user" value="<?php echo $dureeaccueil_user; ?>" size="10" /></td>
			   </tr>
				
				<tr>
					<td colspan="3" align="center">
						<br/>
						<input type="submit" onclick="javascript:document.form_accueil_user.submit();" value="<?php echo ucfirst($translate["rechercher"]); ?>" />
						<input type="button" onclick="javascript:document.form_accueil_user.libaccueil_user.value = '';document.form_processus_search.dureeaccueil_user.value = '';" value="<?php echo ucfirst($translate["recommencer"]); ?>"></input>
					</td>
				</tr>
				
	    </table></div>
		</fieldset>
		</form>
	</div>
	</td>
	</tr>
</table>
<?php
    
    echo $record_set_vide;
	echo $result_recherche_accueil_user;
?>