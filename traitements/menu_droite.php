
<?php

/**
 * @version			1.0
 * @package			Administration
 * @subpackage		Template	(Gestion des templates, des gabarits)
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			patrick mveng<patrick.mveng@interfacesa.com>
 * @desc			Script pour l'affichage du menu à l'extrême droite
 * @creationdate	26 juin 2009
 * @updates 
 * 	# vendredi 24 juillet 2009 (Raoul Ngambia)
 * 		- ajout dans la fonction "switch" du block de "case" permettant de selectionner l'acces au mail dans le menu_droite du module MAIL
 *   l'abscence de ce dernier empéchait l'affichage du lien "mail" et donc l'accces aux mails des utilisateurs
 **/
 
?>

	<div id="content-pane" class="pane-sliders">
	
		<div class="panel"><h3 class="jpane-toggler title" id="params-page">
			<span><?php echo strtoupper($translate["accueil"]); ?></span></h3>
			<div class="jpane-slider content">
				<table width="100%" class="paramlist admintable" cellspacing="1">
					<tr>
						<td width=" 100%" class="paramlist_key">
							<span class="editlinktip">
								<label id="detailscreated_by-lbl" for="detailscreated_by" class="hasTip" title="">
									<a href="<?php echo$siteweb->get_url()."/gabarit/page.gabarit.php?lang={$lang}&do=accueil_user";?>"><?php echo ucfirst($translate["mes_taches"]); ?></a>
								</label>
							</span>
						</td>
					</tr>
				</table>
			</div>
		</div>
		
		<div class="panel">
			<h3 class="jpane-toggler title" id="params-page">
				<span><?php echo strtoupper($translate["utilisateur"]); ?></span>
			</h3>
			<div class="jpane-slider content">
				<table width="100%" class="paramlist admintable" cellspacing="1">
					<tr>
						<td width=" 100%" class="paramlist_key">
							<span class="editlinktip">
								<label id="detailscreated_by-lbl" for="detailscreated_by" class="hasTip" title="">
									<a href="<?php echo$siteweb->get_url()."/gabarit/page.gabarit.php?lang={$lang}&do=user_search";?>"><?php echo ucfirst($translate["utilisateur"]); ?></a>
								</label>
							</span>
						</td>
					</tr>
				</table>
			</div>
		</div>

		<div class="panel">
			<h3 class="jpane-toggler title" id="detail-page"><span><?php echo strtoupper($translate["workflow"]); ?></span></h3>
				<div class="jpane-slider content">
					<table width="100%" class="paramlist admintable" cellspacing="1">
					<tr>
						<td width=" 100%" class="paramlist_key">
							<span class="editlinktip">
								<label id="detailscreated_by-lbl" for="detailscreated_by" class="hasTip" title="">
									<a href="<?php echo$siteweb->get_url()."/gabarit/page.gabarit.php?lang={$lang}&do=workflow_search";?>"><?php echo ucfirst($translate["workflow"]); ?></a>
								</label>
							</span>
						</td>
					</tr>
					<tr>
						<td width=" 100%" class="paramlist_key">
							<span class="editlinktip">
								<label id="detailscreated_by-lbl" for="detailscreated_by" class="hasTip" title="">
									<a href="<?php echo$siteweb->get_url()."/gabarit/page.gabarit.php?lang={$lang}&do=processus_search";?>"><?php echo ucfirst($translate["processus"]); ?></a>
								</label>
							</span>
						</td>
					</tr>
					<tr>
						<td width=" 100%" class="paramlist_key">
							<span class="editlinktip">
								<label id="detailscreated_by-lbl" for="detailscreated_by" class="hasTip" title="">
									<a href="<?php echo$siteweb->get_url()."/gabarit/page.gabarit.php?lang={$lang}&do=circuit_search";?>"><?php echo ucfirst($translate["circuit"]); ?></a>
								</label>
							</span>
						</td>
					</tr>
					<tr>
						<td width=" 100%" class="paramlist_key">
							<span class="editlinktip">
								<label id="detailscreated_by-lbl" for="detailscreated_by" class="hasTip" title="">
									<a href="<?php echo$siteweb->get_url()."/gabarit/page.gabarit.php?lang={$lang}&do=tache_search";?>"><?php echo ucfirst($translate["tache"]); ?></a>
								</label>
							</span>
						</td>
					</tr>
				</table>
			</div>
		</div>
		
		<div class="panel"  id="panel_ged">
			<h3 class="jpane-toggler title" id="params-page">
				<span><?php echo strtoupper($translate["gestion_electronic_doc"]); ?></span>
			</h3>
			<div class="jpane-slider content">
				<table width="100%" class="paramlist admintable" cellspacing="1">
					<tr>
						<td width=" 100%" class="paramlist_key">
							<span class="editlinktip">
								<label id="detailscreated_by-lbl" for="detailscreated_by" class="hasTip" title="">
									<a href="<?php echo$siteweb->get_url()."/gabarit/page.gabarit.php?lang={$lang}&do=doc_search";?>"><?php echo ucfirst($translate["document"]); ?></a>
								</label>
							</span>
						</td>
					</tr>
				</table>
			</div>
		</div>
		
		<div class="panel" id="panel_mail"><h3 class="jpane-toggler title" id="params-page">
			<span><?php echo strtoupper($translate["mail"]); ?></span></h3>
			<div class="jpane-slider content">
				<table width="100%" class="paramlist admintable" cellspacing="1">
					<tr>
						<td width=" 100%" class="paramlist_key">
							<span class="editlinktip">
								<label id="detailscreated_by-lbl" for="detailscreated_by" class="hasTip" title="">
									<a href="<?php echo$siteweb->get_url()."/gabarit/page.gabarit.php?lang={$lang}&do=mail_search";?>"><?php echo ucfirst($translate["mail"]); ?></a>
								</label>
							</span>
						</td>
					</tr>
				</table>
			</div>
		</div>

		<div class="panel"><h3 class="jpane-toggler title" id="params-page"><span><?php echo strtoupper($translate["administration"]); ?></span></h3>
			<div class="jpane-slider content">
				<table width="100%" class="paramlist admintable" cellspacing="1">
					<!--<tr>
						<td width=" 100%" class="paramlist_key">
							<span class="editlinktip">
								<label id="detailscreated_by-lbl" for="detailscreated_by" class="hasTip" title="">
									<a href="<?php echo$siteweb->get_url()."/gabarit/page.gabarit.php?lang={$lang}&do=groupe_search";?>"><?php echo ucfirst($translate["permission"]); ?></a>
								</label>
							</span>
						</td>
					</tr>-->
					
					<tr>
						<td width=" 100%" class="paramlist_key">
							<span class="editlinktip">
								<label id="detailscreated_by-lbl" for="detailscreated_by" class="hasTip" title="">
									<a href="<?php echo$siteweb->get_url()."/gabarit/page.gabarit.php?lang={$lang}&do=config_view";?>"><?php echo ucfirst($translate["configuration"]); ?></a>
								</label>
							</span>
						</td>
					</tr>
					<tr>
						<td width=" 100%" class="paramlist_key">
							<span class="editlinktip">
								<label id="detailscreated_by-lbl" for="detailscreated_by" class="hasTip" title="">
									<a href="<?php echo$siteweb->get_url()."/gabarit/page.gabarit.php?lang={$lang}&do=groupe_search";?>"><?php echo ucfirst($translate["groupe"]); ?></a>
								</label>
							</span>
						</td>
					</tr>					
					<tr>
						<td width=" 100%" class="paramlist_key">
							<span class="editlinktip">
								<label id="detailscreated_by-lbl" for="detailscreated_by" class="hasTip" title="">
									<a href="<?php echo$siteweb->get_url()."/gabarit/page.gabarit.php?lang={$lang}&do=dep_search";?>"><?php echo ucfirst($translate["departement"]); ?></a>
								</label>
							</span>
						</td>
					</tr>		
					<tr>
						<td width=" 100%" class="paramlist_key">
							<span class="editlinktip">
								<label id="detailscreated_by-lbl" for="detailscreated_by" class="hasTip" title="">
									<a href="<?php echo$siteweb->get_url()."/gabarit/page.gabarit.php?lang={$lang}&do=profi_search";?>"><?php echo ucfirst($translate["profil"]); ?></a>
								</label>
							</span>
						</td>
					</tr>					

					<tr>
						<td width=" 100%" class="paramlist_key">
							<span class="editlinktip">
								<label id="detailscreated_by-lbl" for="detailscreated_by" class="hasTip" title="">
									<a href="<?php echo$siteweb->get_url()."/gabarit/page.gabarit.php?lang={$lang}&do=skin_search";?>"><?php echo ucfirst($translate["skin"]); ?></a>
								</label>
							</span>
						</td>
					</tr>
					<tr>
						<td width=" 100%" class="paramlist_key">
							<span class="editlinktip">
								<label id="detailscreated_by-lbl" for="detailscreated_by" class="hasTip" title="">
									<a href="<?php echo$siteweb->get_url()."/gabarit/page.gabarit.php?lang={$lang}&do=preference_search";?>"><?php echo ucfirst($translate["preferences"]); ?></a>
								</label>
							</span>
						</td>
					</tr>
					
				</table>
			</div>
		</div>
		
	</div>