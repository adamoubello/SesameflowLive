<?php
/**
 * @version			1.0
 * @package			Workflow
 * @subpackage		Processus
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			patrick mveng<patrick.mveng@interfacesa.local> 
 * @desc			script pour la fabrication de la grille ayant les processus
 * 					
 * @creationdate	mardi 07 juillet 2009
 * @updates
 */
				 if(! is_null($listeprocessus))
				{
					$nbr_processus = count($listeprocessus);
					if ($nbr_processus > 0)
					//if ($lrs_offre_promo->numRows() > 0)
					{
						$limit = $siteweb->get_record_per_page();
						
						if ($limit > 0)
						{
							if (isset($_GET['orderBy']) && in_array($_GET['orderBy'], array('numprocessus', 'libprocessus', 'dureeprocessus' , "etatprocessus")))
							{
								$setDefaultSortDeliv = array($_GET['orderBy'] => $_GET['direction']);
							}
							else 
							{
								$setDefaultSortDeliv = array('libprocessus' => 'ASC');
							}
							
								$ldata_grid_processus =& new Structures_DataGrid($limit);
								
								$ldata_grid_processus->sortRecordSet($setDefaultSortDeliv);
								
								if ($listeprocessus) 
								{
									//$count = $lrs_offre_promo->numRows();
									$count = count($listeprocessus);
									$NbDelivForSel  = ($limit > $count) ? $count : $limit;
									 
									$ldata_grid_processus->_dataSource =& $ldata_grid_processus->loadDriver(Structures_DataGrid_DataSource_Array);
									
									$ldata_grid_processus->bind($listeprocessus);
								}//if ($listeprocessus) 
								else $count = 0;
								
								//Fonction qui formatte le contenu de la colonne Numéro
								function format_numprocessus ($params)
								{
									global $siteweb , $lang , $login;
									extract($params);
									
									$request['numprocessus'] = $record['numprocessus'];
									$request['lang'] = $lang;
									$request['login'] = $login;
									$request['do'] = "processus_view";
									$query = http_build_query($request);
									$detail = "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".$record['numprocessus']."</a>";

									return $detail;
								}
								
								//Fonction qui formatte le contenu de la colonne Libellé
								function format_libprocessus ($params)
								{
									global $siteweb , $lang , $login;
									extract($params);
									
									$request['numprocessus'] = $record['numprocessus'];
									$request['lang'] = $lang;
									$request['login'] = $login;
									$request['do'] = "processus_view";
									$query = http_build_query($request);
									$detail = "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".str_replace("\'","'",$record['libprocessus'])."</a>";

									return $detail;
								}
								
								//Fonction qui formatte le contenu de la colonne Durée
								function format_dureeprocessus ($params)
								{
									global $siteweb , $lang , $translate , $unite_duree_processus , $process;
									extract($params);
									
									//calucler la durée de chaque processus. Cette durée est la somme des durée de ses tâches
									$lduree_process = $process->db->QueryOne("select sum(dureetache) from tache where numprocessus = ".$record["numprocessus"]);
									
									$request['dureeprocessus'] = $record['dureeprocessus'];
									$request['sel_option_dureeprocessus'] = 0;	//option est égal à
									$request['lang'] = $lang;
									$request['do'] = "processus_search";
									$query = http_build_query($request);
									
									//if ( (trim($record["dureeprocessus"]) == "") || (intval($record["dureeprocessus"]) == 0)) $detail = ucfirst($translate["aucune"]);
									//else $detail =  "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".$record['dureeprocessus']."</a>"." ".$unite_duree_processus;
									
									if ( (trim($lduree_process) == "") || (intval($lduree_process) == 0)) $detail = ucfirst($translate["aucune"]);
									else $detail =  "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".$lduree_process."</a>"." ".$unite_duree_processus;

									return $detail;
								}
								
								//Fonction qui formatte le contenu de la colonne etat
								function format_etatprocessus ($params)
								{   
								    global $siteweb , $lang , $login,$translate;
								    extract($params);
								    
								    $request['etatprocessus'] = $record['etatprocessus'];
									$request['lang'] = $lang;
									$request['login'] = $login;
									$request['do'] = "processus_search";
									$query = http_build_query($request);
									
									$valeur=$record['etatprocessus'];
									if ($valeur==0)  {
									$valeur=ucfirst($translate["desactive"]);
									}else  {
									$valeur=ucfirst($translate["active"]);
									}

									$detail = "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".$valeur."</a>";

									return $detail;
								}
									
                //$ldata_grid_processus->addColumn(new Structures_DataGrid_Column("<input type=\"checkbox\" onclick=\"check_uncheck_all_offer(this.checked);\" />", null, null , null, null, 'format_checkbox()'));
				$ldata_grid_processus->addColumn(new Structures_DataGrid_Column(ucfirst($translate["numero"]), 'numprocessus', 'numprocessus' , array("align"=>"center" , "width" => "10%") , null , 'format_numprocessus()'));
				$ldata_grid_processus->addColumn(new Structures_DataGrid_Column(ucfirst($translate["libelle"]), 'libprocessus', 'libprocessus', null , null , 'format_libprocessus()'));				
				$ldata_grid_processus->addColumn(new Structures_DataGrid_Column(ucfirst($translate["duree"]), 'dureeprocessus', 'dureeprocessus', array("align"=>"center", "width" => "10%") , null , 'format_dureeprocessus()'));				
				$ldata_grid_processus->addColumn(new Structures_DataGrid_Column(ucfirst($translate["etat"]), 'etatprocessus', 'etatprocessus' , array("align"=>"center", "width" => "10%") , null , 'format_etatprocessus()'));		
												
								// Définition de l'apparence
							$tableAttribs = array(
								'cellspacing' => '1',
								'cellpadding' => '4',
								'border' => '0',
								'width' => '100%',
								'class' => 'adminlist'
							);
							$headerAttribs = array(
								'bgcolor' => '#CCCCCC',
								'class' => 'listResultsHeading'
							);
							$evenRowAttribs = array(
								'bgcolor' => '#FFFFF0',
								/*'class' => 'texte_noir2'*/
								'class' => 'row0'
							);
							$oddRowAttribs = array(
								'bgcolor' => '#EEEEEE',
								/*'class' => 'listResultsRowOdd'*/
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
								$test = $ldata_grid_processus->fill($table, $rendererOptions);
								if (PEAR::isError($test)) {

									$result_recherche_processus = $test->getMessage();
									//echo $test->getMessage();
								}
							}				
							
							// Définition des attributs pour la ligne d'en-tête
							$tableHeader->setRowAttributes(0, $headerAttribs);
							
							// Définition des attributs de lignes alternativement
							$tableBody->altRowAttributes(0, $evenRowAttribs, $oddRowAttribs, true);
							
							// Définition du titre de la page
							$title = $siteweb->set_short_list_title(null, $count, $limit); 
							
							// Affichage des liens page par page
							$test = "";
							$lpager = $ldata_grid_processus->getOutput(DATAGRID_RENDER_PAGER);
							/*$lpager = '<del class="container">
									<div class="pagination">
										<div class="button2-right off">
											<div class="start">
												<span>Début</span>
											</div>
										</div>
										<div class="button2-right off">
											<div class="prev">
												<span>Préc</span>
											</div>
										</div>
										<div class="button2-left">
											<div class="page">
												<span>1</span>
												<a href="#" title="2" onclick="javascript: document.adminForm.limitstart.value=20; submitform();return false;">2</a>
												<a href="#" title="3" onclick="javascript: document.adminForm.limitstart.value=40; submitform();return false;">3</a>
											</div>
										</div>
										<div class="button2-left">
											<div class="next">
												<a href="#" title="Suivant" onclick="javascript: document.adminForm.limitstart.value=20; submitform();return false;">Suivant</a>
											</div>
										</div>
										<div class="button2-left">
											<div class="end">
												<a href="#" title="Fin" onclick="javascript: document.adminForm.limitstart.value=40; submitform();return false;">Fin</a>
											</div>
										</div>
										<div class="limit">Page 1 sur 3</div>
										<input type="hidden" name="limitstart" value="0" />
									</div>
								</del>';*/
							// Affichage de la table et des liens page par page
							$result_recherche_processus = "<center>{$title}</center><br/><center>{$lpager}</center>";
							
							$result_recherche_processus .= $table->toHtml();
													
						}//if ($limit > 0)
	
					}//if(! is_null($listeprocessus))
				
				else
			{
				$result_recherche_processus = ucfirst($translate["resultat_recherche_processus"]);
				
		}
	}
	else
	{
		$result_recherche_processus = ucfirst($translate["resultat_recherche_processus"]);
	
	}
?> 
