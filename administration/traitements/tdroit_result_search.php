<?php
/**
 * @version			1.0
 * @package			Administration
 * @subpackage		Droit
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			patrick mveng<patrick.mveng@interfacesa.local> 
 * @desc			script pour la fabrication de la grille ayant les permissions des groupes d'utilisateurs
 * 					
 * @creationdate	vendredi 24 juillet 2009
 * @updates
 */

//tableau des descriptifs des droits

$larr_action = array();

$larr_action[] = 	array("codeaction" => "" , "module" => "circuit", "droit" => "" );
$larr_action[] = 	array("codeaction" => "circuit_search" , "module" => ucfirst($translate["circuit"]) , "droit" => ucfirst($translate["circuit_search"]) );
$larr_action[] = 	array("codeaction" => "circuit_view" , "module" => ucfirst ($translate["circuit"]) , "droit" => ucfirst($translate["circuit_view"]) );
$larr_action[] = 	array("codeaction" => "cir_create1" , "module" => ucfirst($translate["circuit"]) , "droit" => ucfirst($translate["circuit_create"]) );
$larr_action[] = 	array("codeaction" => "circuit_create_valid" , "module" => ucfirst($translate["circuit"]), "droit" => ucfirst($translate["circuit_create_valid"]) );
$larr_action[] = 	array("codeaction" => "circuit_update_valid" , "module" => ucfirst($translate["circuit"]) , "droit" => ucfirst($translate["circuit_update_valid"]) );
$larr_action[] = 	array("codeaction" => "circuit_delete_valid" , "module" => ucfirst($translate["circuit"]) , "droit" => ucfirst($translate["circuit_delete_valid"]) );

$larr_action[] = 	array("codeaction" => "" , "module" => "service" , "droit" => "" );
$larr_action[] = 	array("codeaction" => "dep_search" , "module" => ucfirst($translate["departement"]) , "droit" => ucfirst($translate["dep_search"]) );
$larr_action[] = 	array("codeaction" => "dep_view" , "module" => ucfirst($translate["departement"]) , "droit" => ucfirst($translate["dep_view"]) );
$larr_action[] = 	array("codeaction" => "dep_create" , "module" => ucfirst($translate["departement"]) , "droit" => ucfirst($translate["dep_create"]) );
$larr_action[] = 	array("codeaction" => "dep_create_valid" , "module" => ucfirst($translate["departement"]) , "droit" => ucfirst($translate["dep_create_valid"]) );
$larr_action[] = 	array("codeaction" => "dep_update_valid" , "module" => ucfirst($translate["departement"]) , "droit" => ucfirst($translate["dep_update_valid"]) );
$larr_action[] = 	array("codeaction" => "dep_delete_valid" , "module" => ucfirst($translate["departement"]) , "droit" => ucfirst($translate["dep_delete_valid"]) );

$larr_action[] = 	array("codeaction" => "" , "module" => "document" , "droit" => "" );
$larr_action[] = 	array("codeaction" => "doc_search" , "module" => ucfirst( $translate["document"]) , "droit" => ucfirst($translate["doc_search"]) );
$larr_action[] = 	array("codeaction" => "doc_view" , "module" => ucfirst($translate["document"]) , "droit" => ucfirst($translate["doc_view"]) );
$larr_action[] = 	array("codeaction" => "doc_create" , "module" => ucfirst($translate["document"]) , "droit" => ucfirst($translate["doc_create"]) );
$larr_action[] = 	array("codeaction" => "doc_create_valid" , "module" => ucfirst($translate["document"]) , "droit" => ucfirst($translate["doc_create_valid"]) );
$larr_action[] = 	array("codeaction" => "doc_update_valid" , "module" => ucfirst($translate["document"]) , "droit" => ucfirst($translate["doc_update_valid"]) );
$larr_action[] = 	array("codeaction" => "doc_delete_valid" , "module" => ucfirst($translate["document"]) , "droit" => ucfirst($translate["doc_delete_valid"]) );

$larr_action[] = 	array("codeaction" => "" , "module" => "permission" , "droit" => "" );
//$larr_action[] = 	array("codeaction" => "droa_search" , "module" => ucfirst($translate["droit"]) , "droit" => ucfirst($translate["droa_search"]) );
//$larr_action[] = 	array("codeaction" => "droa_view" , "module" => ucfirst($translate["droit"]) , "droit" => ucfirst($translate["droa_view"]) );
//$larr_action[] = 	array("codeaction" => "droa_create" , "module" => ucfirst($translate["droit"]) , "droit" => ucfirst($translate["droa_create"]) );
$larr_action[] = 	array("codeaction" => "droa_update_valid" , "module" => ucfirst($translate["permission"]) , "droit" => ucfirst($translate["droa_update_valid"]) );

$larr_action[] = 	array("codeaction" => "" , "module" => "groupe" , "droit" => "" );
$larr_action[] = 	array("codeaction" => "groupe_search" , "module" => ucfirst($translate["groupe"]) , "droit" => ucfirst($translate["groupe_search"]) );
$larr_action[] = 	array("codeaction" => "groupe_view" , "module" => ucfirst($translate["groupe"]) , "droit" => ucfirst($translate["groupe_view"]) );
$larr_action[] = 	array("codeaction" => "groupe_create" , "module" => ucfirst($translate["groupe"]) , "droit" => ucfirst($translate["groupe_create"]) );
$larr_action[] = 	array("codeaction" => "groupe_create_valid" , "module" => ucfirst($translate["groupe"]) , "droit" => ucfirst($translate["groupe_create_valid"]) );
$larr_action[] = 	array("codeaction" => "groupe_update_valid" , "module" => ucfirst($translate["groupe"]) , "droit" => ucfirst($translate["groupe_update_valid"]) );
$larr_action[] = 	array("codeaction" => "groupe_delete_valid" , "module" => ucfirst($translate["groupe"]) , "droit" => ucfirst($translate["groupe_delete_valid"]) );

$larr_action[] = 	array("codeaction" => "" , "module" => "mail" , "droit" => "" );
$larr_action[] = 	array("codeaction" => "mail_search" , "module" => ucfirst($translate["mail"]) , "droit" => ucfirst($translate["mail_search"]) );
$larr_action[] = 	array("codeaction" => "mail_view" , "module" => ucfirst($translate["mail"]) , "droit" => ucfirst($translate["mail_view"]) );
$larr_action[] = 	array("codeaction" => "mail_create" , "module" => ucfirst($translate["mail"]) , "droit" => ucfirst($translate["mail_create"]) );
$larr_action[] = 	array("codeaction" => "mail_create_valid" , "module" => ucfirst($translate["mail"]) , "droit" => ucfirst($translate["mail_create_valid"]) );
$larr_action[] = 	array("codeaction" => "mail_update_valid" , "module" => ucfirst($translate["mail"]) , "droit" => ucfirst($translate["mail_update_valid"]) );
$larr_action[] = 	array("codeaction" => "mail_delete_valid" , "module" => ucfirst($translate["mail"]) , "droit" => ucfirst($translate["mail_delete_valid"]) );
$larr_action[] = 	array("codeaction" => "mail_archive" , "module" => ucfirst($translate["mail"]) , "droit" => ucfirst($translate["mail_archive"]) );
$larr_action[] = 	array("codeaction" => "mail_param" , "module" => ucfirst($translate["mail"]) , "droit" => ucfirst($translate["mail_param"]) );
$larr_action[] = 	array("codeaction" => "mail_param_save" , "module" => ucfirst($translate["mail"]) , "droit" => ucfirst($translate["mail_param_save"]) );
$larr_action[] = 	array("codeaction" => "mail_historic" , "module" => ucfirst($translate["mail"]) , "droit" => ucfirst($translate["mail_historic"]) );
$larr_action[] = 	array("codeaction" => "mail_send_valid" , "module" => ucfirst($translate["mail"]) , "droit" => ucfirst($translate["mail_send_valid"]) );
$larr_action[] = 	array("codeaction" => "mail_log" , "module" => ucfirst($translate["mail"]) , "droit" => ucfirst($translate["mail_log"]) );

$larr_action[] = 	array("codeaction" => "" , "module" => "processus" , "droit" => "" );
$larr_action[] = 	array("codeaction" => "processus_search" , "module" =>ucfirst ($translate["processus"]) , "droit" => ucfirst($translate["processus_search"]));
$larr_action[] = 	array("codeaction" => "processus_view" , "module" => ucfirst($translate["processus"]) , "droit" => ucfirst($translate["processus_view"]) );
$larr_action[] = 	array("codeaction" => "processus_create" , "module" =>ucfirst($translate["processus"]) , "droit" => ucfirst($translate["processus_create"]) );
$larr_action[] = 	array("codeaction" => "processus_create_valid" , "module" =>ucfirst($translate["processus"]) , "droit" => ucfirst($translate["processus_create_valid"]));
$larr_action[] = 	array("codeaction" => "processus_update_valid" , "module" => ucfirst($translate["processus"]) , "droit" => ucfirst($translate["processus_update_valid"]) );
$larr_action[] = 	array("codeaction" => "processus_delete_valid" , "module" => ucfirst($translate["processus"]) , "droit" => ucfirst($translate["processus_delete_valid"]) );

$larr_action[] = 	array("codeaction" => "" , "module" => "fonction" , "droit" => "" );
$larr_action[] = 	array("codeaction" => "profi_search" , "module" => ucfirst($translate["profil"]) , "droit" => ucfirst($translate["profi_search"]) );
$larr_action[] = 	array("codeaction" => "profi_view" , "module" => ucfirst($translate["profil"]) , "droit" => ucfirst($translate["profi_view"]) );
$larr_action[] = 	array("codeaction" => "profi_create" , "module" => ucfirst($translate["profil"]) , "droit" => ucfirst($translate["profi_create"]) );
$larr_action[] = 	array("codeaction" => "profi_create_valid" , "module" => ucfirst($translate["profil"]) , "droit" => ucfirst($translate["profi_create_valid"]) );
$larr_action[] = 	array("codeaction" => "profi_update_valid" , "module" => ucfirst($translate["profil"]) , "droit" => ucfirst($translate["profi_update_valid"]) );
$larr_action[] = 	array("codeaction" => "profi_delete_valid" , "module" => ucfirst($translate["profil"]) , "droit" => ucfirst($translate["profi_delete_valid"]) );

$larr_action[] = 	array("codeaction" => "" , "module" => "tache" , "droit" => "" );
$larr_action[] = 	array("codeaction" => "tache_search" , "module" => ucfirst($translate["tache"]) , "droit" => ucfirst($translate["tache_search"]) );
$larr_action[] = 	array("codeaction" => "tache_view" , "module" => ucfirst($translate["tache"]) , "droit" => ucfirst($translate["tache_view"]) );
$larr_action[] = 	array("codeaction" => "tache_create" , "module" => ucfirst($translate["tache"]) , "droit" => ucfirst($translate["tache_create"]) );
$larr_action[] = 	array("codeaction" => "tache_create_valid" , "module" => ucfirst($translate["tache"]) , "droit" => ucfirst($translate["tache_create_valid"]) );
$larr_action[] = 	array("codeaction" => "tache_update_valid" , "module" => ucfirst($translate["tache"]) , "droit" => ucfirst($translate["tache_update_valid"]) );
$larr_action[] = 	array("codeaction" => "tache_delete_valid" , "module" => ucfirst($translate["tache"]) , "droit" => ucfirst($translate["tache_delete_valid"]) );


$larr_action[] = 	array("codeaction" => "" , "module" => "utilisateur" , "droit" => "" );
$larr_action[] = 	array("codeaction" => "user_search" , "module" => ucfirst($translate["utilisateur"]) , "droit" => ucfirst($translate["user_search"]) );
$larr_action[] = 	array("codeaction" => "user_view" , "module" => ucfirst($translate["utilisateur"]) , "droit" => ucfirst($translate["user_view"]) );
$larr_action[] = 	array("codeaction" => "user_create" , "module" => ucfirst($translate["utilisateur"]) , "droit" => ucfirst($translate["user_create"]) );
$larr_action[] = 	array("codeaction" => "user_create_valid" , "module" => ucfirst($translate["utilisateur"]) , "droit" => ucfirst($translate["user_create_valid"]) );
$larr_action[] = 	array("codeaction" => "user_update_valid" , "module" => ucfirst($translate["utilisateur"]) , "droit" => ucfirst($translate["user_update_valid"]) );
$larr_action[] = 	array("codeaction" => "user_delete_valid" , "module" => ucfirst($translate["utilisateur"]) , "droit" => ucfirst($translate["user_delete_valid"]) );



$larr_action[] = 	array("codeaction" => "" , "module" => "workflow" , "droit" => "" );
$larr_action[] = 	array("codeaction" => "workflow_search" , "module" => ucfirst($translate["workflow"]) , "droit" => ucfirst($translate["workflow_search"]) );
$larr_action[] = 	array("codeaction" => "workflow_view" , "module" => ucfirst($translate["workflow"]) , "droit" => ucfirst($translate["workflow_view"]) );
$larr_action[] = 	array("codeaction" => "workflow_create" , "module" => ucfirst($translate["workflow"]) , "droit" => ucfirst($translate["workflow_create"]) );
$larr_action[] = 	array("codeaction" => "workflow_create_valid" , "module" => ucfirst($translate["workflow"]) , "droit" => ucfirst($translate["workflow_create_valid"]) );
$larr_action[] = 	array("codeaction" => "workflow_update_valid" , "module" => ucfirst($translate["workflow"]) , "droit" => ucfirst($translate["workflow_update_valid"]) );
$larr_action[] = 	array("codeaction" => "workflow_delete_valid" , "module" => ucfirst($translate["workflow"]) , "droit" => ucfirst($translate["workflow_delete_valid"]) );




if(! is_null($larr_action))
{
	$nbr_droit = count($larr_action);
	if ($nbr_droit > 0)
	//if ($lrs_offre_promo->numRows() > 0)
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

			//$ldata_grid_droit =& new Structures_DataGrid($limit);
			$ldata_grid_droit =& new Structures_DataGrid(null);
			//$ldata_grid_droit->sortRecordSet($setDefaultSortDeliv);

			if ($larr_action)
			{
				$count = count($larr_action);
				$NbDelivForSel  = ($limit > $count) ? $count : $limit;
				$ldata_grid_droit->_dataSource =& $ldata_grid_droit->loadDriver(Structures_DataGrid_DataSource_Array);
				$ldata_grid_droit->bind($larr_action);
			}//if ($larr_action)
			else $count = 0;

			//Fonction qui formatte le contenu de la colonne ayant les cases à cocher
			function format_case ($params)
			{
				global $siteweb , $lang , $larr_action , $codegroup , $translate , $listedroit;
				extract($params);
				$request['codegroup'] = $codegroup;
				$request['lang'] = $lang;
				$request['do'] = "user_view";
				$query = http_build_query($request);
				if (trim(strtolower($record["codeaction"])) == "")
				{
					$detail = "<a id=\"".strtolower(trim($record["module"]))."\" title=\"".ucfirst($translate["tout"])."\" href=\"#".strtolower(trim($record["module"]))."\" onclick=\"javascript:set_all_permission('".strtolower(trim($record["module"]))."' , true)\"  >".ucfirst($translate["tout"])."</a> / <a id=\"any_".strtolower(trim($record["module"]))."\" href=\"#any_".strtolower(trim($record["module"]))."\"  onclick=\"javascript:set_all_permission('".strtolower(trim($record["module"]))."' , false )\" >".ucfirst($translate["aucun"])."</a>";
				}
				else
				{
					$lchecked = "";
					//si permission pour ce groupe, cocher la case
					if (is_array($listedroit))
					{
						foreach($listedroit as $larr_permission)
						{
							$lcodeaction = $larr_permission["codeaction"];
							if (trim(strtolower($lcodeaction)) == trim(strtolower($record["codeaction"])))
							{
								$lchecked = "checked=\"true\"";
								break;
							}
						}
					}
					$detail = "<input type=\"checkbox\" ".$lchecked. " name=\"arr_action[]\" id=\"".$record["codeaction"]."\" value=\"".$record["codeaction"]."\"  />";
				}

				return $detail;
			}

			//Fonction qui formatte le contenu de la colonne Module
			function format_module ($params)
			{
				extract($params);


				return $record["module"];
			}
			
			//Fonction qui formatte le contenu de la colonne Droit
			function format_droit ($params)
			{
				extract($params);

				return $record["droit"];
			}
			

			//Fonction qui formatte le contenu de la colonne Permission
			function format_permission ($params)
			{
				global $larr_action , $lang , $login , $codegroup ;
				extract($params);
				$request['codeuser'] = $record['codeuser'];
				$request['lang'] = $lang;
				$request['login'] = $login;
				$request['do'] = "user_view";
				$request['codegroup'] = $codegroup;

				$query = http_build_query($request);
				$detail = "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".$record['nomuser']."</a>";

				return $detail;
			}

			$ldata_grid_droit->addColumn(new Structures_DataGrid_Column(ucfirst($translate["module"]), null , null , null , null , 'format_module()'));
			$ldata_grid_droit->addColumn(new Structures_DataGrid_Column(null, null, null, array("align"=>"center" , "width" => "10%") , null , 'format_case()'));
			$ldata_grid_droit->addColumn(new Structures_DataGrid_Column(ucfirst($translate["droit"]), null, null  , null , null , 'format_droit()'));

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
				$test = $ldata_grid_droit->fill($table, $rendererOptions);
				if (PEAR::isError($test)) {

					$result_recherche_droit = $test->getMessage();
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
			$lpager = $ldata_grid_droit->getOutput(DATAGRID_RENDER_PAGER);
			// Affichage de la table et des liens page par page
			//$result_recherche_droit = "<center>{$title}</center><br/><center>{$lpager}</center>";
			$result_recherche_droit = "<p><center><input type=\"button\" value=\"".ucfirst($translate["valider"])."\" onclick=\" document.getElementById('frm_droit').submit(); \" /></center></p><br/>";
			$result_recherche_droit .= $table->toHtml();


		}//if ($limit > 0)



	}//if(! is_null($larr_action))
}
else
{
	$result_recherche_droit .= "<center>".ucfirst($translate["any_droit_found"])."</center>";
}


?>