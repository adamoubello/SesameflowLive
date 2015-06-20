<?php
/**
 * @version			1.0
 * @package			Workflow
 * @subpackage		Circuit
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello<@yahoo.fr> 
 * @desc			script pour l'affichage de la page web de l'étape 1 pour la création d'un circuit
 * 					le numéro de circuit est affiché uniquement si on vient de l'étape 2
 * 					
 * @creationdate	????
 * @updates
 */
   	
?>
<form action="<?php echo $siteweb->get_url()."/workflow/traitements/partie_centrale.php" ?>" method="post" name="form_create_circuit" id="form_create_circuit" >
	<input type="hidden" id="lang" name="lang" value="<?php echo $lang ?>">
	<input type="hidden" id="login" name="login" value="<?php echo $login ?>">
	<input type="hidden" id="do" name="do" value="circuit_create_valid">
	<input type="hidden" id="nbr_tache" name="nbr_tache" value="0">
	<input type="hidden" id="nbr_tache_initiale" name="nbr_tache_initiale" value="0">
	<div>
		<fieldset class="adminform">
		<legend> <?php echo ucfirst($translate["detail"]); ?> </legend>
			<table class="admintable" cellspacing="1">
		<?php
		if (trim($codecircuit) != "")
		{	//afficher le numéro circuit uiquement si on est au moins à l'étape 2
		?>

			<tr>
					<td width="150" class="key">
						<label for="name">

							<?php echo ucfirst($translate["code"]); ?>					</label>					</td>
				  <td><input type="text" disabled="disabled" name="txt_codecircuit" id="txt_codecircuit" class="inputbox" size="10" 
				  value="<?php 	echo $codecircuit; ?>" /></td>
				</tr>
				<?php
				}
				?>				
				<tr>
					<td width="150" class="key">
						<label for="name">

							<?php echo ucfirst($translate["libelle"]); ?>					</label>					</td>
				  <td>
				  	<input type="text" name="libcircuit" id="libcircuit" class="inputbox" style="width:300px" size="30" value="<?php 	echo $libcircuit; ?>" />
				  	<em><font color="Red"><b>*</b></font></em>
				  </td>
				</tr>
				
				<tr>
					<td width="150" class="key">
						<label for="name">

							<?php echo ucfirst($translate["duree"]); ?>				</label>					</td>
					<td>
						<input type="text" name="dureecircuit" id="dureecircuit" class="inputbox" size="10" value="<?php 	echo $dureecircuit; ?>" />&nbsp;(&nbsp;<?php echo $unite_duree; // echo str_replace("{unite_duree_circuit}" , $unite_duree_circuit , $translate["en_x_unite"]); ?>&nbsp;)</td>
				</tr>
				<tr>
					<td width="150" class="key">
						<label for="name">

							<?php echo ucfirst($translate["processus"]); ?>					</label>					</td>
					<td>
						<?php echo $select_processus; ?>
						<em><font color="Red"><b>*</b></font></em>
					</td>
				</tr>
				<tr><td colspan="2"><em><font color="Red"><b>*&nbsp;<?php echo ucfirst($translate["champs_obligatoires"]) ?></b></font></em></td></tr>
		</table>
		</fieldset>
	</div>
	<div>
	

   <?php
  
//fonctions utilisées dans le datagrid

function printCheckbox($params)
{
extract($params);
return '<input type="checkbox" name="idList[]" value="' . $record['nomuser'] . '">';
}

function printFullName($params)
{
extract($params);
return $record['nomuser'];
}

function printListeDeroulante()
{
echo('<select name="table">');
while ($tableaudep) 
{
echo('<option>'.$tableaudep->libdep.'</option>'); 
} 
echo('</select>'); 
}

function printUserSelector2()  
 {  
	 global $select_user;
	 $select_user_i = str_replace("sel_acteur" , "sel_acteur".$currRow , $select_user);
	 return $select_user_i;  
 }  
 
 function printProfilSelector()  
 {  
 	global $select_profil;
 	return $select_profil;  
 }  
 
 function printTacheSelector()  
 {  
 global $select_tache;
 return $select_tache;  
 }  
 
?>

<TABLE width="100%">
<TR>
	<TD>
		<div>
		<fieldset >
			<legend> <?php echo ucfirst($translate["taches"]); ?> </legend>
			<?php 
				echo "<center>".ucfirst($translate["departement"])." : {$select_departement}</center><br/>";
			?>
		 <?php 

	$listetache = array();
	/*$listetache[] = array(
	"tacheprec" => $select_tache
	, "acteur" => $select_user
	, "profil" => $select_profil
	, "tache" => $select_tache
	,"modifier" => ""
	);
	*/
	// Création de la grille de données
	$datagrid =& new Structures_DataGrid($nbre); // Display 20 records per page
	
	// Spécifie comment la grille de données doit être triée par défaut
	$datagrid->setDefaultSort(array('nomuser' => 'ASC'));
	
	// et on lie le conteneur DataSource : $listetesteur  la grille
	$test = $datagrid->bind($listetache);
	if (PEAR::isError($test)) 
	    {
		echo $test->getMessage();
		}
		
	//Fonction qui formatte le contenu de la colonne Selection
	function format_selection ($params)
	{
		extract($params);
		
		return '<input type="radio" id="rdio_'.$currRow.'  name="rdio_"'.$currRow.'" title"'.ucfirst($translate["selection"]).'" />';
	}

	//Fonction qui formatte le contenu de la colonne Supprimer
	function format_supprimer ($params)
	{
		global $siteweb , $translate;
		extract($params);
		
		
	}	
		
	// Définition des colonnes
	//$datagrid->addColumn(new Structures_DataGrid_Column(null, null, null, array('width' => '0.5%'), null, 'printCheckbox()'));
	$datagrid->addColumn(new Structures_DataGrid_Column(ucfirst($translate["tache_precedente"])." ".$select_tache_prec, null , null , array('width' => '0.5%'), null, 'printTacheSelector()'));
	$datagrid->addColumn(new Structures_DataGrid_Column("<div id=\"div_acteur\">".ucfirst($translate["acteur"])."{$select_user}</div><br/>".strtoupper($translate["ou"])." ".ucfirst($translate["profil"])." ".$select_profil, null, null, array('width' => '0.5%'), null, 'printUserSelector2()'));
//	$datagrid->addColumn(new Structures_DataGrid_Column(ucfirst($translate["profil"])." ".$select_profil, null, null, array('width' => '0.5%'), null, 'printProfilSelector()'));
	$datagrid->addColumn(new Structures_DataGrid_Column(ucfirst($translate["tache"])." ".$select_tache."<em><font color=\"Red\"><b>*</b></font></em>", null, null, array('width' => '0.5%'), null, 'printTacheSelector()'));
	$datagrid->addColumn(new Structures_DataGrid_Column(null, null, null, array('width' => '0.5%'), null, 'format_supprimer()'));
	$datagrid->addColumn(new Structures_DataGrid_Column('<input  type="button" name="btn_ajout" id="btn_ajout" value="'.ucfirst($translate["ajouter"]).'" onclick="javascript:on_circuit_add_tache(\''.$siteweb->get_url().'\' , \'form_create_circuit\');" />', null, null, array('width' => '0.5%'), null, 'format_selection()'));
	//$datagrid->addColumn(new Structures_DataGrid_Column('<a href="#" title="'.ucfirst($translate["ajouter"]).'" onclick="javascript:on_circuit_add_tache();"   ><img src="'.$siteweb->get_url()."/images/edit_add.gif".'" /></a>', null, null, array('width' => '0.5%'), null, 'format_selection()'));
		
	// Définition de l'apparence
	$tableAttribs = array(
		'id' => 'table_taches',
		'name' => 'table_taches',
		'width' => '100%',
		'cellspacing' => '0',
		'cellpadding' => '4',
		'class' => 'adminList'
	);
	$headerAttribs = array(
		'bgcolor' => '#CCCCCC'
	);
	$evenRowAttribs = array(
		'bgcolor' => '#FFFFFF'
	);
	$oddRowAttribs = array(
		'bgcolor' => '#EEEEEE'
	);
	$rendererOptions = array(
		'sortIconASC' => '?',
		'sortIconDESC' => '?'
	);
	
	// Création du tableau HTML
	$table = new HTML_Table($tableAttribs);
	$tableHeader =& $table->getHeader();
	$tableBody =& $table->getBody();
	
	// Demande à la grille de données de remplir le tableau HTML avec les données, en utilisant les options d'affichage définies
	$test = $datagrid->fill($table, $rendererOptions);
	    //$table->addRow('azer');
		//$table->display();
		
	if (PEAR::isError($test)) {
		echo $test->getMessage();
	}
	    
	// Définition des attributs pour la ligne d'en-tête
	$tableHeader->setRowAttributes(0, $headerAttribs);
	
	// Définition des attributs de lignes alternativement
	$tableBody->altRowAttributes(0, $evenRowAttribs, $oddRowAttribs, true);
	
	// Affichage de la table et des liens page par page
	echo $table->toHtml();
	
	// Affichage des liens page par page
	//$test = $datagrid->render(DATAGRID_RENDER_PAGER);
	if (PEAR::isError($test)) {
		echo $test->getMessage();
	}
	
  ?>
</fieldset>
</div>
</TD>
</TR>  
</TABLE>	
	
	</div>
</form>
	<div class="clr"></div>