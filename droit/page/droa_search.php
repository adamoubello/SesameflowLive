<table>
<td>
	       <?php		
				  $nbr_droa = 0;		  
           ?>
<div class="col width-45" align="center" style="display:block" >
				 <form action="page.gabarit.php?page=droa_search&lang=<?php echo $lang; ?>" method="post" name="form_droa_search">
					<input type="hidden" id="page" name="page" value="droa_search"  />
					<input type="hidden" id="lang" name="lang" value="<?php echo $lang; ?>"  />
		<fieldset class="adminform" >
		<legend><input type="checkbox" onchange="afficher_div_droa_search();" id="checkbox_droa_search" name="checkbox_droa_search"/> <?php echo ucfirst($translate["recherche_droit"]); ?> </legend>
		<div id="div_droa_search">
			<table width="405" cellspacing="1" class="admintable" hspace="123">
				
				<tr>
					<td class="key">
				  <label for="name"> <?php echo ucfirst($translate["libelle"]); ?> </label>					</td>
					<td ><?php 
							echo $siteweb->sel_option_search(array( "class" => "texte_gris" , "name" => "sel_option_libdroa")
							 , $sel_option_libdroa , ucfirst($translate["choisissez"])); 
					?></td>
					<td><input name="libdroa" type="text" class="inputbox" id="libdroa" value="<?php echo $libdroa; ?>" size="50" />
				  <!--<input type="submit" style="border: 0; padding: 0; margin: 0; width: 0px; height: 0px;" value="rechercher" name="btn2" />-->	    </td>
				    </tr>
				
				<tr>
					<td class="key">
						<label for="surname"> <?php echo ucfirst($translate["niveau_droit"]); ?> </label>					</td>
					<td ><?php 
							echo $siteweb->sel_option_search_entier(array( "class" => "texte_gris" , "name" => "sel_option_niveau_accesdroa")
							 , $sel_option_niveau_accesdroa , ucfirst($translate["choisissez"])); 
					?></td>
					<td ><input name="niveau_accesdroa" type="text" class="inputbox" id="niveau_accesdroa" value="<?php echo $niveau_accesdroa; ?>" size="50" />
					<!--<input type="submit" style="border: 0; padding: 0; margin: 0; width: 0px; height: 0px;" value="rechercher" name="btn2" />-->				    </td>
				  <td>&nbsp;</td>
				</tr>
					<td></td>
					<td></td>
										
	<td>
					<div class="button1">
		<div class="next">
			<a href="javascript:document.form_droa_search.submit();" >
				<?php echo ucfirst($translate["rechercher"]); ?></a>		</div>
	</div>	</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
				</tr>
	    </table></div>
		</fieldset>
		</form>
	</div>
	</td>
	<tr>	
	<?php // Définition du titre de la page
		 $translate['paging_abtract']; 
		 $title = $siteweb->set_short_list_title(null, $count, $limit);
							
	 ?>
	 </tr>
	<tr>
	<div>
	<?php
				  if(! is_null($listedroa))
				{
					$nbr_droa = count($listedroa);
					if ($nbr_droa > 0)
					//if ($lrs_offre_promo->numRows() > 0)
					{
						$limit = $siteweb->get_record_per_page();
						
						if ($limit > 0)
						{
							if (isset($_GET['orderBy']) && in_array($_GET['orderBy'], array('codedroa', 'libdroa', 'niveau_accesdroa')))
							{
								$setDefaultSortDeliv = array($_GET['orderBy'] => $_GET['direction']);
							}
							else 
							{
								$setDefaultSortDeliv = array('libdroa' => 'ASC');
							}
							
								$ldata_grid_droa =& new Structures_DataGrid($limit);
								
								$ldata_grid_droa->sortRecordSet($setDefaultSortDeliv);
								
								if ($listedroa) 
								{
									//$count = $lrs_offre_promo->numRows();
									 $count = count($listedroa);
									 $NbDelivForSel  = ($limit > $count) ? $count : $limit;
									 
									$ldata_grid_droa->_dataSource =& $ldata_grid_droa->loadDriver(Structures_DataGrid_DataSource_Array);
									
									$ldata_grid_droa->bind($listedroa);
								}//if ($listedroa) 
								else $count = 0;
								
								//Fonction qui formatte le contenu de la colonne Code
								function format_codedroa ($params)
								{
									global $siteweb , $lang;
									extract($params);
									
									$request['codedroa'] = $record['codedroa'];
									$request['lang'] = $lang;
									$request['do'] = "droa_view";
									$query = http_build_query($request);
									$detail = "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".$record['codedroa']."</a>";

									return $detail;
								}
								
								//Fonction qui formatte le contenu de la colonne Login
								function format_libdroa ($params)
								{
									global $siteweb , $lang;
									extract($params);
									
									$request['codedroa'] = $record['codedroa'];
									$request['lang'] = $lang;
									$request['do'] = "droa_view";
									$query = http_build_query($request);
									$detail = "<a class=\"lien_nav3\" href=\"".$siteweb->get_url()."/gabarit/page.gabarit.php?$query\">".$record['libdroa']."</a>";

									return $detail;
								}
								
								$ldata_grid_droa->addColumn(new Structures_DataGrid_Column(ucfirst($translate["code"]), 'codedroa', 'codedroa' , null , null , 'format_codedroa()'));
								$ldata_grid_droa->addColumn(new Structures_DataGrid_Column(ucfirst($translate["libelle"]), 'libdroa', 'libdroa', null , null , 'format_libdroa()'));				
								$ldata_grid_droa->addColumn(new Structures_DataGrid_Column(ucfirst($translate["niveau_acces_droit"]), 'niveau_accesdroa', 'niveau_accesdroa', null , null , 'format_niveau_accesdroa()'));				
															
								// Définition de l'apparence
							$tableAttribs = array(
							    'width' => '50%',
								'cellspacing' => '1',
								'cellpadding' => '1',
								'border' => '1',
								'width' => '100%',
								'class' => 'tablo'
								
							);
							$headerAttribs = array(
								'bgcolor' => '#FFFFFF',
								'class' => 'listResultsHeading'
							);
							$evenRowAttribs = array(
								'bgcolor' => '#CCOO99',
								'class' => 'texte_noir2',
								'margin-left' => '5px',
								'align-center' => '5px'
							);
							$oddRowAttribs = array(
								'bgcolor' => '#FFFFFF',
								'class' => 'listResultsRowOdd',
								'margin-left' => '5px',
								'align-center' => '5px'
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
								$test = $ldata_grid_droa->fill($table, $rendererOptions);
								if (PEAR::isError($test)) {

									$result_recherche_droa = $test->getMessage();
									//echo $test->getMessage();
								}
							}				
							
							// Définition des attributs pour la ligne d'en-tête
							$tableHeader->setRowAttributes(0, $headerAttribs);
							
							// Définition des attributs de lignes alternativement
							$tableBody->altRowAttributes(0, $evenRowAttribs, $oddRowAttribs, true);
							
							$title = $siteweb->set_short_list_title(null, $count, $limit);
							
							//$ginterface->grid_box_header('716', $title, null, null, 0, null, $buttons);
							//if ($count > 0) echo ucfirst($title)."<br/>";
							
							// Affichage des liens page par page
							$test = $ldata_grid_droa->render(DATAGRID_RENDER_PAGER);
							// Affichage de la table et des liens page par page
							$result_recherche_droa = $title."<br/><br/>";
							$result_recherche_droa .= $table->toHtml();
							
												
						}//if ($limit > 0)
							
							
							
					}//if(! is_null($listedroa))
				
				else
			{
				$result_recherche_droa = ucfirst($translate["resultat_droit"]);
				
			}
			}

     ?> 
</div>
</tr>
</table>