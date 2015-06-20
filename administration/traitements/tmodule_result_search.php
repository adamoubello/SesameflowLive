<?php
/**
 * @version			1.0
 * @package			Administration
 * @subpackage		Droit
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			patrick mveng<patrick.mveng@interfacesa.local> 
 * @desc			script pour la fabrication de la grille des modules de l'application
 * 					
 * @creationdate	samedi 15 juillet 2009
 * @updates
 */

//tableau des descriptifs des modules

/*$larr_module = array();

$larr_module[] = 	array("codemod" => "ged" , "module" => "GED", "description" => "Permet de stocker et administrer une base de documents" , "etat" => 1 , "config" => "" );
$larr_module[] = 	array("codemod" => "mail" , "module" => "MAIL", "description" => "Gestion des mails" , "etat" => 1 , "config" => "" );
$larr_module[] = 	array("codemod" => "medicare" , "module" => "MEDICARE", "description" => "Gestion du dossier médical" , "etat" => 1 , "config" => "" );
*/
if(! is_null($listemodule))
{
	$nbr_module = count($listemodule);
	if ($nbr_module > 0)
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

			$ldata_grid_module =& new Structures_DataGrid(null);

			if ($listemodule)
			{
				$count = count($listemodule);
				$NbDelivForSel  = ($limit > $count) ? $count : $limit;
				$ldata_grid_module->_dataSource =& $ldata_grid_module->loadDriver(Structures_DataGrid_DataSource_Array);
				$ldata_grid_module->bind($listemodule);
			}//if ($listemodule)
			else $count = 0;

			//Fonction qui formatte le contenu de la colonne Module
			function format_module ($params)
			{
				extract($params);


				return strtoupper($record["codemod"]);
			}
			
			//Fonction qui formatte le contenu de la colonne Config
			function format_config ($params)
			{
				global $siteweb, $lang , $login;
				extract($params);
				
				$ldetail = "";
				switch (trim(strtolower($record["codemod"])))
				{
					case "mail" :
						$ldetail = "<a href=\"#\" onclick=\"window.location='".$siteweb->get_url()."/gabarit/page.gabarit.php?do=mail_param&login={$login}&lang={$lang}"."';\" title=\"Configuration\" ><img src=\"".$siteweb->get_url()."/images/setup.png"."\" /></a>";
						break;
					case "medicare" :
						$ldetail = "<a href=\"#\" onclick=\"window.location='".$siteweb->get_url()."/gabarit/page.gabarit.php?do=medicare_param&login={$login}&lang={$lang}"."';\" title=\"Configuration\" ><img src=\"".$siteweb->get_url()."/images/setup.png"."\" /></a>";
						break;			
						default:
						break;
				}
				return $ldetail;
			}

			
			//Fonction qui formatte le contenu de la colonne Action
			function format_action ($params)
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
				return  $ldetail;
			}
			
			//Fonction qui formatte le contenu de la colonne Description
			function format_descr ($params)
			{
				extract($params);

				return ucfirst($record["libmod"]);
			}

			$ldata_grid_module->addColumn(new Structures_DataGrid_Column(ucfirst($translate["module"]), null , null , array("align"=>"center" , "width" => "10%") , null , 'format_module()'));
			$ldata_grid_module->addColumn(new Structures_DataGrid_Column(ucfirst($translate["description"]), null , null , null , null , 'format_descr()'));
			$ldata_grid_module->addColumn(new Structures_DataGrid_Column(ucfirst($translate["action"]), null, null, array("align"=>"center" , "width" => "10%") , null , 'format_action()'));
			$ldata_grid_module->addColumn(new Structures_DataGrid_Column(ucfirst($translate["config"]), null, null  , array("align"=>"center" , "width" => "10%") , null , 'format_config()'));

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
			$result_recherche_module = $table->toHtml();


		}//if ($limit > 0)



	}//if(! is_null($listemodule))
}
else
{
	$result_recherche_module .= "<center>".ucfirst($translate["any_module_found"])."</center>";
}


?>