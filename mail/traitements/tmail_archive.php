<?php

	/**
	 * @author 		:	Patrick Mveng
	 * @package 	:	Newsletter
	 * @copyright 	:	2009 INTERFACESA
	 * @name 		: script pour l'affichage de l'archives des newsletter
	 */


	$baseDir2 = str_replace('\\','/',dirname(__FILE__));
	//supprimer le class, afin d'obtenir la racine du répertoire virtuel en cours
	$baseDir2 = str_replace("/lot1/BO/traitement/newsletter","",$baseDir2);
	$lracine = $baseDir2. "/";
	unset($baseDir2);
	define("DOCUMENT_ROOT",$lracine);

	require_once(DOCUMENT_ROOT."class/application.class.php");							
	$ginterface = new capplication();
	
	ini_set('include_path', $ginterface->get_doc_root().'package/php/pear');	//charger les packages de PEAR::MDB2	

	require_once(DOCUMENT_ROOT."class/newsletter.class.php");					
	$lnewsletter = new CNewsletter();
	
	$lnewsletter->cod_newslett = null;	
	$lnewsletter->lang_newslett = null;
	
	//lancer la recherche de produit dans le catalogue
	$lrs_newsletter = $lnewsletter->search();
		//libérer la mémoire
		unset($lnewsletter);
	$nbr_newsletter = 0;	
	
		require_once ("Structures/DataGrid.php");
		require_once ("HTML/Table.php");
			
				
		if(! is_null($lrs_newsletter))
		{
			$nbr_newsletter = count($lrs_newsletter);
			if ($nbr_newsletter > 0)
			//if ($lrs_newsletter->numRows() > 0)
			{
	
			global $ginterface;

			//$buttons = $ginterface->button_tag(array("value" => ucfirst($translate['retour']) , "onclick" => "window.history.back();" ), "button" , "button");
			
			$limit = $ginterface->get_record_per_page();
			
				if ($limit > 0)
				{
					if (isset($_GET['orderBy']) && in_array($_GET['orderBy'], array('cod_newslett', 'sujet_newslett', 'date_newslett', 'format_newslett', 'lang_newslett')))
					{
						$setDefaultSortDeliv = array($_GET['orderBy'] => $_GET['direction']);
					}
					else 
					{
						$setDefaultSortDeliv = array('cod_newslett' => 'ASC');
					}
					
						$ldata_grid_newsletter =& new Structures_DataGrid($limit);
						
						$ldata_grid_newsletter->sortRecordSet($setDefaultSortDeliv);
						
						if ($lrs_newsletter) 
						{
							//$count = $lrs_newsletter->numRows();
							 $count = count($lrs_newsletter);
							 $NbDelivForSel  = ($limit > $count) ? $count : $limit;
							 
							$ldata_grid_newsletter->_dataSource =& $ldata_grid_newsletter->loadDriver(Structures_DataGrid_DataSource_Array);
							
							$ldata_grid_newsletter->bind($lrs_newsletter);
						}
						else $count = 0;
					}
					
					
					//Fonction qui formatte le contenu de la colonne Code
					function format_code_news ($params)
					{
						global $ginterface , $lang;
						extract($params);
						
						 $request['cod_newslett'] = $record['cod_newslett'];
					    $query = http_build_query($request);
					    $detail = "<a class=\"lien_nav3\" href=\"".$ginterface->get_url()."/lot1/BO/fiche/newsletter/newsletter_view.php?$query\">".$record['cod_newslett']."</a>";
						
					    return $detail;
					}
					//Fonction qui formatte le contenu de la colonne ayant les cases à cocher
					function format_checkbox ($params)
					{
						global $ginterface;
						extract($params);
						
						return "<input type=\"checkbox\" id=\"cb{$currRow}\" name=\"cid[]\" value=\"".$record["cod_newslett"]."\" onclick=\"isChecked(this.checked);\" />";
			
					}
					
					function format_langue_news ($params)
					{
						extract($params);
						
						switch(trim($record["lang_newslett"]))
						{
							case "fr" : $llangue = "Français";
								break;
							case "en" : $llangue = "Anglais";
								break;
							default: $llangue = "Français";
								break;		
						}
						
					    return htmlspecialchars($llangue) ;
					}
					
					function format_format_news ($params)
					{
						extract($params);
						
						switch(intval($record["format_newslett"]))
						{
							case 1 : $lformat_envoi = "HTML";
								break;
							case 2 : $lformat_envoi = "Texte";
								break;
							default: $lformat_envoi = "HTML";
								break;		
						}
						
					    return htmlspecialchars($lformat_envoi) ;
					}
					
					$ldata_grid_newsletter->addColumn(new Structures_DataGrid_Column("<input type=\"checkbox\" onclick=\"check_uncheck_all_news(this.checked);\" />", null, null , null, null, 'format_checkbox()'));
					$ldata_grid_newsletter->addColumn(new Structures_DataGrid_Column("Code", 'cod_newslett', 'cod_newslett' , null , null , 'format_code_news()'));
					$ldata_grid_newsletter->addColumn(new Structures_DataGrid_Column("Sujet", 'sujet_newslett', 'sujet_newslett' ));				
					$ldata_grid_newsletter->addColumn(new Structures_DataGrid_Column("Date création", 'date_newslett', 'date_newslett' ));				
					$ldata_grid_newsletter->addColumn(new Structures_DataGrid_Column("Format envoi",'format_newslett', 'format_newslett'  , null, null, 'format_format_news()'));				
					$ldata_grid_newsletter->addColumn(new Structures_DataGrid_Column("Langue",'lang_newslett', 'lang_newslett'  , null, null, 'format_langue_news()'));								
						
					// Définition de l'apparence
					$tableAttribs = array(
					//    'width' => '45%',
					    'cellspacing' => '2',
					    'cellpadding' => '0',
					    'border' => '0',
					    'width' => '80%',
					    'class' => 'tablo'
					);
					$headerAttribs = array(
					    'bgcolor' => '#CCCCCC',
					    'class' => 'listResultsHeading'
					);
					$evenRowAttribs = array(
					    'bgcolor' => '#FFFFFF',
					    'class' => 'texte_noir2',
					    'align' => 'center'
					);
					$oddRowAttribs = array(
					    'bgcolor' => '#EEEEEE',
					    'class' => 'listResultsRowOdd',
					    'align' => 'center'
					);
					$rendererOptions = array(
					    'sortIconASC' => '&uArr;',
					    'sortIconDESC' => '&dArr;',
			//		    'class' => 'listResultsRowHover'
					);
					
					if (!$export || $export == '')
					{
						$table = new HTML_Table($tableAttribs);
						$tableHeader =& $table->getHeader();
						$tableBody =& $table->getBody();	
										
						if ($count > 0){
							$test = $ldata_grid_newsletter->fill($table, $rendererOptions);
							if (PEAR::isError($test)) {
								$result_recherche_newsletter = $test->getMessage();
						    	//echo $test->getMessage();
							}
						}				
						
						// Définition des attributs pour la ligne d'en-tête
						$tableHeader->setRowAttributes(0, $headerAttribs);
						
						// Définition des attributs de lignes alternativement
						$tableBody->altRowAttributes(0, $evenRowAttribs, $oddRowAttribs, true);
						
						// Définition du titre de la page
						$translate['paging_abtract']	= htmlspecialchars('Résultat(s) {%start%} à {%end%} sur {%total%} au total'); 
						$title = $ginterface->set_short_list_title(null, $count, $limit);
						
						//$ginterface->grid_box_header('716', $title, null, null, 0, null, $buttons);
						//if ($count > 0) echo ucfirst($title)."<br/>";
						
						// Affichage des liens page par page
						//$test = $ldata_grid_newsletter->render(DATAGRID_RENDER_PAGER);
						 
						// Affichage de la table et des liens page par page
						//$result_recherche_newsletter = $title."<br/><br/>";
						$result_recherche_newsletter .= $table->toHtml();
						//echo $table->toHtml();
						
						//$ginterface->box_footer();
						
					}
						
				}	//if ($lrs_newsletter->numRows() > 0)
				else
				{
					$result_recherche_newsletter = "Il n'y a pas encore de newsletter  !!";
					//echo "<p class=\"texte_rouge2\"><strong>".ucfirst($translate["aucun_produit_en_stock"])."&nbsp;!</strong></p><br><br>";
				} 
		}
		else
		{
			$result_recherche_newsletter = "Il n'y a pas encore de newsletter !!";
			//echo "<p class=\"texte_rouge2\"><strong>".ucfirst($translate["aucun_produit_en_stock"])."&nbsp;!</strong></p><br><br>";
		}	
	
?>