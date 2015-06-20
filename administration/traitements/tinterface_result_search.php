<?php
/**
 * @version			1.0
 * @package			Administration
 * @subpackage		Configuration
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			patrick mveng<patrick.mveng@interfacesa.local> 
 * @desc			script pour la fabrication de la grille des modules Interface
 * 					
 * @creationdate	samedi 15 aout 2009
 * @updates
 */
if(! is_null($listeinterface))
{
	$nbr_interface = count($listeinterface);
	if ($nbr_interface > 0)
	{
		$limit = $siteweb->get_record_per_page();

		if ($limit > 0)
		{
			if (isset($_GET['orderBy']) && in_array($_GET['orderBy'], array()))
			{
				$setDefaultSortDeliv = array($_GET['orderBy'] => $_GET['direction']);
			}
			else
			{
				//$setDefaultSortDeliv = array('module' => 'ASC');
			}

			$ldata_grid_module = new Structures_DataGrid(null);

			if ($listeinterface)
			{
				$count = count($listeinterface);
				$NbDelivForSel  = ($limit > $count) ? $count : $limit;
				$ldata_grid_module->_dataSource =& $ldata_grid_module->loadDriver(Structures_DataGrid_DataSource_Array);
				$ldata_grid_module->bind($listeinterface);
			}//if ($listeinterface)
			else $count = 0;

			//Fonction qui formatte le contenu de la colonne Module
			function format_module2 ($params)
			{
				extract($params);


				return strtoupper($record["codemod"]);
			}
			
			//Fonction qui formatte le contenu de la colonne Config
			function format_config2 ($params)
			{
				global $siteweb, $lang , $login;
				extract($params);
				
				$ldetail = "";
				switch (trim(strtolower($record["codemod"])))
				{
					case "paie" :
						$ldetail = "<a href=\"#\" onclick=\"window.location='".$siteweb->get_url()."/gabarit/page.gabarit.php?do=paie_param&login={$login}&lang={$lang}"."';\" title=\"Configuration\" ><img src=\"".$siteweb->get_url()."/images/setup.png"."\" /></a>";
						break;
					case "rh" :
						$ldetail = "<a href=\"#\" onclick=\"window.location='".$siteweb->get_url()."/gabarit/page.gabarit.php?do=rh_param&login={$login}&lang={$lang}"."';\" title=\"Configuration\" ><img src=\"".$siteweb->get_url()."/images/setup.png"."\" /></a>";
						break;
					default:
						break;
				}
				return $ldetail;
			}

			
			//Fonction qui formatte le contenu de la colonne Action
			function format_action2 ($params)
			{
				global $translate , $siteweb;
				extract($params);

				if (intval($record["etatmod"]) == 1) 
				{
					$ltext_btn = ucfirst($translate["desactiver"]);
					$letatmod_dual = 0;
				}
				else 
				{
					$ltext_btn = ucfirst($translate["activer"]);
					$letatmod_dual = 1;
				}

				$ldetail = "<input id=\"btnmodule".$currRow."\" type=\"button\" onclick=\"javascript:on_onoff_module('".$record["codemod"]."' , '".$siteweb->get_url()."/administration/traitements/tmodule_activer_valid.php"."' , '".$siteweb->get_url()."' , this , {$currRow} ); \" value=\"{$ltext_btn}\" />
				<input type=\"hidden\" id=\"etatmod".$currRow."\" name=\"etatmod".$currRow."\" value=\"{$letatmod_dual}\"  />
				"; 
				
				/*$ldetail = "<input id=\"btnmodule".$currRow."\" type=\"button\" onclick=\"javascript:on_onoff_module('".$record["codemod"]."' , '".$siteweb->get_url()."/administration/traitements/tmodule_activer_valid.php"."' , '".$siteweb->get_url()."' , this , {$currRow} ); \" value=\"{$ltext_btn}\" />
				<input type=\"hidden\" id=\"etatmod".$currRow."\" name=\"etatmod".$currRow."\" value=\"".intval($record["etatmod"])."\"  />
				";*/ 
				return  $ldetail;
			}
			
			//Fonction qui formatte le contenu de la colonne Description
			function format_descr2 ($params)
			{
				extract($params);

				return ucfirst($record["description"]);
			}

			$ldata_grid_module->addColumn(new Structures_DataGrid_Column(ucfirst($translate["module"]), null , null , array("align"=>"center" , "width" => "10%") , null , 'format_module2()'));
			$ldata_grid_module->addColumn(new Structures_DataGrid_Column(ucfirst($translate["description"]), null , null , null , null , 'format_descr2()'));
			$ldata_grid_module->addColumn(new Structures_DataGrid_Column(ucfirst($translate["action"]), null, null, array("align"=>"center" , "width" => "10%") , null , 'format_action2()'));
			$ldata_grid_module->addColumn(new Structures_DataGrid_Column(ucfirst($translate["config"]), null, null  , array("align"=>"center" , "width" => "10%") , null , 'format_config2()'));

			// Définition de l'apparence
			$tableAttribs = array(
			'cellspacing' => '1',
			'cellpadding' => '1',
			'border' => '0',
			'width' => '100%',
			'class' => 'adminlist'
			);
			$headerAttribs = array(
			'bgcolor' => '#FFFFFF',
			'class' => 'listResultsHeading'
			);
			$evenRowAttribs = array(
			'bgcolor' => '#CCOO99',
			'class' => 'row0'
			);
			$oddRowAttribs = array(
			'bgcolor' => '#FFFFFF',
			'class' => 'row1'
			);
			$rendererOptions = array(
			'sortIconASC' => '&uArr;',
			'sortIconDESC' => '&dArr;',
			//	    'class' => 'listResultsRowHover'
			);

			$table = new HTML_Table($tableAttribs);
			$tableHeader =& $table->getHeader();
			$tableBody =& $table->getBody();

			if ($count > 0){
				$test = $ldata_grid_module->fill($table, $rendererOptions);
				if (PEAR::isError($test)) {

					$result_recherche_module = $test->getMessage();
					//echo $test->getMessage();
				}
			}

			// Définition des attributs pour la ligne d'en-tête
			$tableHeader->setRowAttributes(0, $headerAttribs);

			// Définition des attributs de lignes alternativement
			$tableBody->altRowAttributes(0, $evenRowAttribs, $oddRowAttribs, true);

			// Définition du titre de la page
			$translate['paging_abtract']	= htmlspecialchars('Résultat(s) {%start%} a {%end%} sur {%total%} au total');

			$title = $siteweb->set_short_list_title(null, $count, $limit);

			// Affichage des liens page par page
			$lpager = $ldata_grid_module->getOutput(DATAGRID_RENDER_PAGER);
			// Affichage de la table et des liens page par page
			$result_recherche_interface = $table->toHtml();


		}//if ($limit > 0)



	}//if(! is_null($listeinterface))
}
else
{
	$result_recherche_interface .= "<center>".ucfirst($translate["any_module_found"])."</center>";
}


?>