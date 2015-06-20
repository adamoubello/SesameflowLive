<form action="" method="post" name="form_create_circuit2" id="form_create_circuit2" >
 	<input type="hidden" id="lang" name="lang" value="<?php echo $lang ?>">
	<input type="hidden" id="login" name="login" value="<?php echo $login ?>">
	<input type="hidden" id="do" name="do" value="cir_create2_valid">

   <?php
   $nbre=$_POST["nbreacteurscircuit"];
   //global $nbre;
   $nbre=3;
  
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
 
function printEditLink($params)
{
extract($params);
return '<input type="button" value="supprimer" name="idList[]" onclick="DeleteRow('.($currRow+1).');" >';
} 

$selectuser= printUserSelector2();
 	
?>

<TABLE>
<TR><TD >

</TD></TR>
<TR>&nbsp;</TR>
<TR><TD WIDTH=5% HEIGHT=150%>

<div>
<fieldset >
	<legend> <?php echo ucfirst($translate["hierarchisation_circuit"]); ?> </legend>
	<?php 	echo "<center>{$select_departement}</center>";	?>
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
	$datagrid->addColumn(new Structures_DataGrid_Column(ucfirst($translate["tache"])." ".$select_tache, null, null, array('width' => '0.5%'), null, 'printTacheSelector()'));
	$datagrid->addColumn(new Structures_DataGrid_Column(null, null, null, array('width' => '0.5%'), null, 'format_supprimer()'));
	$datagrid->addColumn(new Structures_DataGrid_Column('<input  type="button" name="btn_ajout" id="btn_ajout" value="'.ucfirst($translate["ajouter"]).'" onclick="javascript:on_circuit_add_tache(\''.$siteweb->get_url().'\');" />', null, null, array('width' => '0.5%'), null, 'format_selection()'));
	//$datagrid->addColumn(new Structures_DataGrid_Column('<a href="#" title="'.ucfirst($translate["ajouter"]).'" onclick="javascript:on_circuit_add_tache();"   ><img src="'.$siteweb->get_url()."/images/edit_add.gif".'" /></a>', null, null, array('width' => '0.5%'), null, 'format_selection()'));
		
	// Définition de l'apparence
	$tableAttribs = array(
		'id' => 'table_taches',
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
</form>