<?php
/**
 * @version			1.0
 * @package			Utilisateur
 * @subpackage		Utilisateur
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			patrick mveng<patrick.mveng@interfacesa.local> 
 * @desc			script pour la fabrication de la grille ayant les groupes d'utilisateurs
 * 					
 * @creationdate	mardi 07 juillet 2009
 * @updates
 */
				switch(trim($do))
				{
					case "groupe_view" :
						$btn_nouveau = "<p align=\"right\"><input type=\"button\" value=\"".ucfirst($translate["nouveau"])."\"  onclick=\"window.location = '" . $siteweb->get_url()."/gabarit/page.gabarit.php?lang={$lang}&login={$login}&do=user_create&codegroup=".$codegroup."';\" /></p>";
						break;
					case "profi_view" :
						$btn_nouveau = "<p align=\"right\"><input type=\"button\" value=\"".ucfirst($translate["nouveau"])."\"  onclick=\"window.location = '" . $siteweb->get_url()."/gabarit/page.gabarit.php?lang={$lang}&login={$login}&do=user_create&codeprofil={$codeprofil}';\" /></p>";
						break;	
					case "dep_view" :
						$btn_nouveau = "<p align=\"right\"><input type=\"button\" value=\"".ucfirst($translate["nouveau"])."\"  onclick=\"window.location = '" . $siteweb->get_url()."/gabarit/page.gabarit.php?lang={$lang}&login={$login}&do=user_create&codedep={$codedep}';\" /></p>";
						break;
					default:
						$btn_nouveau = "";
						break;	
				}

				 if(! is_null($listeuser))
				{
					$nbr_user = count($listeuser);
					if ($nbr_user > 0)
					//if ($lrs_offre_promo->numRows() > 0)
					{
						$limit = $siteweb->get_record_per_page();
						
						if ($limit > 0)
						{
							if (isset($_GET['orderBy']) && in_array($_GET['orderBy'], array('codeuser', 'nomuser', 'prenomuser', 'loginuser', 'emailuser', 'datenaissanceuser', 'villeuser', 'datenaissanceuser' )))
							{
								$setDefaultSortDeliv = array($_GET['orderBy'] => $_GET['direction']);
							}
							else 
							{
								$setDefaultSortDeliv = array('nomuser' => 'ASC');
							}
							
								$ldata_grid_user =& new Structures_DataGrid($limit);
								$ldata_grid_user->sortRecordSet($setDefaultSortDeliv);
								
								if ($listeuser) 
								{
									//$count = $lrs_offre_promo->numRows();
									 $count = count($listeuser);
									 $NbDelivForSel  = ($limit > $count) ? $count : $limit;
							         $ldata_grid_user->_dataSource =& $ldata_grid_user->loadDriver(Structures_DataGrid_DataSource_Array);
									 $ldata_grid_user->bind($listeuser);
								}//if ($listeuser) 
								else $count = 0;
								
								//Fonction qui formatte le contenu de la colonne Code
								function format_codeuser ($params)
								{
									global $siteweb , $lang;
									extract($params);
									$request['codeuser'] = $record['codeuser'];
									$request['lang'] = $lang;
									$request['do'] = "user_view";
									$query = http_build_query($request);
									$detail = "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".$record['codeuser']."</a>";

									return $detail;
								}
								
								//Fonction qui formatte le contenu de la colonne Login
								function format_loginuser ($params)
								{
									global $siteweb , $lang , $login;
									extract($params);
									$request['codeuser'] = $record['codeuser'];
									$request['lang'] = $lang;
									$request['login'] = $login;
									$request['do'] = "user_view";
									$query = http_build_query($request);
									$detail = "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".$record['loginuser']."</a>";

									return $detail;
								}
								
								//Fonction qui formatte le contenu de la colonne Nom
								function format_nomuser ($params)
								{
									global $siteweb , $lang , $login;
									extract($params);
									$request['codeuser'] = $record['codeuser'];
									$request['lang'] = $lang;		
									$request['login'] = $login;
									$request['do'] = "user_view";
									$query = http_build_query($request);
									$detail = "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".$record['nomuser']."</a>";

									return $detail;
								}
								
								//Fonction qui formatte le contenu de la colonne Libellé du groupe
								function format_libgroupe_user ($params)
								{
									global $siteweb , $lang , $login;
									extract($params);
									
									$request['codegroup'] = $record['codegroup'];
									$request['lang'] = $lang;
									$request['login'] = $login;
									$request['do'] = "groupe_view";
									$query = http_build_query($request);
									$llibgroupe = str_replace('\\', "" , $record['libgroup']);
									$detail = "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".$llibgroupe."</a>";
			
									return $detail;
								}
								
								//Fonction qui formatte le contenu de la colonne Libellé du profil
								function format_libprofil_user ($params)
								{
									global $siteweb , $lang , $login , $translate;
									extract($params);
									
									$request['codeprofil'] = $record['codeprofil'];
									$request['lang'] = $lang;
									$request['login'] = $login;
									$request['do'] = "profi_view";
									$query = http_build_query($request);
									$llibprofil = str_replace('\\', "" , $record['libprofil']);
									
									if ( (trim($record['codeprofil']) == "") || (trim($record['codeprofil']) == 0)) $detail = ucfirst($translate["aucune"]);
									else $detail = "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".$llibprofil."</a>";
			
									return $detail;
								}
								
								//Fonction qui formatte le contenu de la colonne Libellé du département
								function format_libdep_user ($params)
								{
									global $siteweb , $lang , $login , $translate;
									extract($params);
									
									$request['codedep'] = $record['codedep'];
									$request['lang'] = $lang;
									$request['login'] = $login;
									$request['do'] = "dep_view";
									$query = http_build_query($request);
									$llibdep = str_replace('\\', "" , $record['libdep']);
									
									if ( (trim($record['codedep']) == "") || (trim($record['codedep']) == 0)) $detail = ucfirst($translate["aucun"]);
									else $detail = "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".$llibdep."</a>";
			
									return $detail;
								}
								
									//Fonction qui formatte le contenu de la colonne ayant les cases à cocher
									function format_checkbox ($params)
									{
										global $ginterface;
										extract($params);
										
										return "<input type=\"checkbox\" id=\"cb{$currRow}\" name=\"cid[]\" value=\"".$record["emailuser"].";".$record["nomuser"].";". $record["prenomuser"] . "\" onclick=\"on_check_abonne(this.checked , 'frm_abonne');\" />";
							
									}
									
									//Fonction qui formatte le contenu de la colonne Date de naissance
									function format_datenaissance ($params)
									{
										global $ginterface , $user;
										extract($params);
										
										$detail = $user->format_database2date($record['datenaissanceuser']);
										
										return $detail;
									}



								switch (trim(strtolower($do)))
								{
									case "mail_select_dest" :
										
										$ldata_grid_user->addColumn(new Structures_DataGrid_Column("<input type=\"checkbox\" onclick=\"check_uncheck_all_abonne(this.checked);\" />", null, null , null, null, 'format_checkbox()'));
										$ldata_grid_user->addColumn(new Structures_DataGrid_Column(ucfirst($translate["nomuser"]), null, null , null , null , 'format_nomuser()'));				
										$ldata_grid_user->addColumn(new Structures_DataGrid_Column(ucfirst($translate["prenomuser"]), 'prenomuser', 'prenomuser', null , null));				
										$ldata_grid_user->addColumn(new Structures_DataGrid_Column(ucfirst($translate["emailuser"]), 'emailuser', 'emailuser' ));
										$ldata_grid_user->addColumn(new Structures_DataGrid_Column(ucfirst($translate["villeuser"]),'villeuser', 'villeuser'));
										//$ldata_grid_user->addColumn(new Structures_DataGrid_Column(ucfirst($translate["groupe"]), 'libgroup', 'libgroup', null , null , 'format_libgroupe_user()'));				
										$ldata_grid_user->addColumn(new Structures_DataGrid_Column(ucfirst($translate["departement"]), null, null, null , null , 'format_libdep_user()'));				
										$ldata_grid_user->addColumn(new Structures_DataGrid_Column(ucfirst($translate["profil"]), null, null, null , null , 'format_libprofil_user()'));				
										
										break;
									default:

										$ldata_grid_user->addColumn(new Structures_DataGrid_Column(ucfirst($translate["nomuser"]), 'nomuser', 'nomuser', null , null , 'format_nomuser()'));				
										$ldata_grid_user->addColumn(new Structures_DataGrid_Column(ucfirst($translate["prenomuser"]), 'prenomuser', 'prenomuser', null , null));				
										$ldata_grid_user->addColumn(new Structures_DataGrid_Column(ucfirst($translate["loginuser"]), 'loginuser', 'loginuser' , null , null , 'format_loginuser()'));			
										$ldata_grid_user->addColumn(new Structures_DataGrid_Column(ucfirst($translate["emailuser"]), 'emailuser', 'emailuser' ));
										$ldata_grid_user->addColumn(new Structures_DataGrid_Column(ucfirst($translate["numteluser"]),'numteluser', 'numteluser'));
										$ldata_grid_user->addColumn(new Structures_DataGrid_Column(ucfirst($translate["datenaissanceuser"]),'datenaissanceuser', 'datenaissanceuser' , null , null , 'format_datenaissance()'));
										$ldata_grid_user->addColumn(new Structures_DataGrid_Column(ucfirst($translate["villeuser"]),'villeuser', 'villeuser'));
										$ldata_grid_user->addColumn(new Structures_DataGrid_Column(ucfirst($translate["groupe"]), 'libgroup', 'libgroup', null , null , 'format_libgroupe_user()'));				
										$ldata_grid_user->addColumn(new Structures_DataGrid_Column(ucfirst($translate["departement"]), 'libdep', 'libdep', null , null , 'format_libdep_user()'));				
										$ldata_grid_user->addColumn(new Structures_DataGrid_Column(ucfirst($translate["profil"]), 'libprofil', 'libprofil', null , null , 'format_libprofil_user()'));				
												
										break;	
								}
								
                            $codesuppr=$record['codeuser'];
							global $codesuppr; 
								
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
								$test = $ldata_grid_user->fill($table, $rendererOptions);
								if (PEAR::isError($test)) {

									$result_recherche_user = $test->getMessage();
									//echo $test->getMessage();
								}
							}				
							
							// Définition des attributs pour la ligne d'en-tête
							$tableHeader->setRowAttributes(0, $headerAttribs);
							
							// Définition des attributs de lignes alternativement
							$tableBody->altRowAttributes(0, $evenRowAttribs, $oddRowAttribs, true);
							
							// Définition du titre de la page
							$translate['paging_abtract']	= htmlspecialchars(ucfirst($translate["resultat"]). ' {%start%} '.$translate['a']. ' {%end%} '.$translate['on'].' {%total%}'); 
							
							$title = $siteweb->set_short_list_title(null, $count, $limit);
							
							//$ginterface->grid_box_header('716', $title, null, null, 0, null, $buttons);
							//if ($count > 0) echo ucfirst($title)."<br/>";
							
							// Affichage des liens page par page
							$lpager = $ldata_grid_user->getOutput(DATAGRID_RENDER_PAGER);
							// Affichage de la table et des liens page par page
							$result_recherche_user = $btn_nouveau;
							$result_recherche_user .= "<center>{$title}</center><br/><center>{$lpager}</center>";
							$result_recherche_user .= $table->toHtml();
										
												
						}//if ($limit > 0)
														
							
					}//if(! is_null($listeuser))
				}
	else
	{
		$result_recherche_user = $btn_nouveau;
		$result_recherche_user .= "<center>".ucfirst($translate["any_user_found"])."</center>";  
	}


?>