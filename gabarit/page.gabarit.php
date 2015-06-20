<?php

/**
 * @version			1.0
 * @package			Administration
 * @subpackage		Template	(Gestion des templates, des gabarits)
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello Adamou <moustaphbi@yahoo.fr>
 * @desc			Script pour le gabarit, template par défaut de toutes les pages web de l'application
 * 					Tous les paramètres de la page gabarit sont certains paramètres postés
 * @param 			do - code de la page web à afficher dans la partie centrale du gabarit
 * 					login - code de l'utilisateur en cours de session
 * 					lang  - code de la langue en cours d'utilisation. - fr est la valeur par défaut
 * @creationdate	????
 * @updates
 * 	# samedi 20 juin 2009 (Patrick Mveng)
 * 		- suppression de la fonction init()
 * 		- suppression de l'attribut onload dans la balise body
 * 		- en cas de déconnexion, redirection vers la page d'accueil
 * 
 *  # vendredi 26 juin 2009 by patrick mveng<patrick.mveng@interfacesa.com>
 * 		- intégration du séparateur de dossier du OS en cours dans la constante DS
 *  # jeudi 16 juillet 2009 by patrick mveng <patrick.mveng@interfacesa.com>
 * 		- l'inclusion en double du package calendar, empêche l'insertion de la date calendrier dans la zone de saisie. Suppression
 * 		  de l'appel du package dans case doc_view.
 * # vendredi 24 juillet 2009 by patrick mveng <patrick.mveng@interfacesa.com>
 * 		- afichage du nombre de nouveau mail de l'utilisateur en cours.Ajout du lien vers la page mail_search
 * 		- affichage du drapeau anglais et francais pour l'internationnalisation
 * 	# vendredi 24 juillet 2009 (Raoul Ngambia)
 * 		- ajout dans la fonction "switch" du block de "case" permettant de selectionner l'acces au mail dans le menu_droite du module MAIL
 *        l'abscence de ce dernier empéchait l'affichage du lien "mail" et donc l'accces aux mails des utilisateurs
 *  # vendredi 24 juillet 2009 by patrick mveng <patrick.mveng@interfacesa.com>
 * 		- intégration du droit d'accès à une fonctionnalité
 
 * @todo 	:	- lors de l'installation la base de données doit supporter au minimum ucs2
                - la suppression des pièces jointes sous Internet Explorer 6 et 7 requiert une suppression préalable des fichiers temporaires et cookies
                - dans la prerequis de l'application, mentionner que le serveur doit avoir la même date que les postes clients.
                - résoudre le problème de recherche de document en fonction de la date de création (en requête paramétrée, il n'y a pas récupration de la date)
				- PHP complains about ZipArchive not being found
				 Make sure you meet all Requirements, especially php_zip extension should be enabled.
				Activer l'extension zip.iso dans php.ini
				- activer l'extension php_mysql
				- activer l'extension php_mssql
				
				Le message du mail n'est pas modifié !
				- Multiplication de mail lors de l'envoi d'un mail existant
				-- mettre statut_mail à 1 dans la bd à l'ouverture d'un mail
				
				-- installation vers SQL Server
				-- création correcte du fichier config.txt
				--- gestion de l'apostrophe dans une chaine à envoyer dans la BD
				
	@rule	:	l'utilisateur en cours peut consulter ou modifier son profil. Mais il peut le supprimer ssi l'admisnitrateur
	lui a donné le droit de le faire.
	@rule	:	seuls les membres du groupe "superadmin" peuvent accéder à la page de configuration


 */
 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr-fr" lang="fr-fr" dir="ltr" id="minwidth" >
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
  <meta name="robots" content="index, follow" />
  <meta name="keywords" content="sesameflow , workflow, erp, interface" />
  <meta name="description" content="SesameFlow - Un autre regard sur le workflow" />

 <?php
 	session_start();

 	
	$login= (isset($_SESSION["login"])) ? (! is_null($_SESSION["login"])) ? $_SESSION["login"] : null : null;
    $rejeter = (isset($data["rejeter"])) ? (! is_null($data["rejeter"])) ? $data["rejeter"] : null : null;
	
	$_POST["login"] = $login;
	$_POST["rejeter"]=$rejeter;
	
	$data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
		$data[$lkey] = $lvalue;
	}
	

	
    //obtenir le séparateur de dossier pour le OS en cours
    if (! defined("DS")) define( 'DS', DIRECTORY_SEPARATOR );

	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";	
	$typedoc = (isset($data["typedoc"])) ? (! is_null($data["typedoc"])) ? $data["typedoc"] : "" : "";
	$state = (isset($data["state"])) ? (! is_null($data["state"])) ? $data["state"] : null : null;
	$from = (isset($data["from"])) ? (! is_null($data["from"])) ? $data["from"] : "" : "";	//do de la fonctionnalité précédente
	$do = (isset($data["do"])) ? (! is_null($data["do"])) ? $data["do"] : "accueil_user" : "accueil_user";	
		
	if (trim($lang) == "") $lang = "fr";
 	
  	$chemin = dirname(__FILE__);
    $chemin = str_replace("gabarit","",$chemin);	
	require_once($chemin.'classe'.DS.'application.class.php');	
	$siteweb = new Application();
	global $siteweb;  
    require_once($siteweb->get_document_root().DS.'lang'.DS.'application.'.$lang.'.php');
?>  

 <?php echo $siteweb->title_tag($do); ?>
 
<!-- <link href="<?php echo $siteweb->get_url(); ?>/gabarit/templates/khepri/favicon.ico" rel="shortcut icon" type="image/x-icon" />-->

 <?php
 	echo "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"". $siteweb->get_url().$siteweb->get_dossier_plugin()."/includes/popcal/skins/aqua/theme.css\" title=\"Aqua\" />\n";
	echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url().$siteweb->get_dossier_plugin()."/includes/popcal/calendar.js\"></script>\n";			
	echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url().$siteweb->get_dossier_plugin()."/includes/popcal/calendar-setup.js\"></script>\n";			
	
	//language for the calendar 
	echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url().$siteweb->get_dossier_plugin()."/includes/popcal/lang/calendar-".$lang.".js\"></script>\n";
 ?>	 
 <?php echo $siteweb->title_tag($do); ?>
	<script type="text/javascript" src="<?php echo $siteweb->get_url(); ?>/media/system/js/calendar.js"></script>
    <script type="text/javascript" src="<?php echo $siteweb->get_url(); ?>/media/system/js/calendar-setup.js"></script>
	<link rel="stylesheet" type="text/css" href="templates/khepri/css/rounded.css" />
	<!--<script type="text/javascript" src="<?php echo $siteweb->get_url(); ?>/includes/js/joomla.javascript.js"></script>
	<script type="text/javascript" src="<?php echo $siteweb->get_url(); ?>/media/system/js/mootools.js"></script>
	<script type="text/javascript" src="<?php echo $siteweb->get_url(); ?>/media/system/js/switcher.js"></script>
	<script type="text/javascript">window.addEvent('domready', function(){ var JTooltips = new Tips($$('.hasTip'), { maxTitleChars: 50, fixed: false}); });</script>  -->
    <script type="text/javascript" src="<?php echo $siteweb->get_url(); ?>/includes/JSCookMenu/JSCookMenu.js"></script>
	<script type="text/javascript" src="<?php echo $siteweb->get_url(); ?>/includes/JSCookMenu/ThemeGray/theme.js"></script>
	<link rel="stylesheet" href="<?php echo $siteweb->get_url(); ?>/includes/JSCookMenu/ThemeGray/theme.css" type="text/css">		
    <link rel="stylesheet" href="<?php echo $siteweb->get_url(); ?>/gabarit/templates/system/css/system.css" type="text/css" />
	<link href="<?php echo $siteweb->get_url(); ?>/gabarit/templates/khepri/css/template.css" rel="stylesheet" type="text/css" />
	
<!--[if IE 7]>
<link href="<?php echo $siteweb->get_url(); ?>/gabarit/templates/khepri/css/ie7.css" rel="stylesheet" type="text/css" />
<![endif]-->

<!--[if lte IE 6]>
<link href="<?php echo $siteweb->get_url(); ?>/gabarit/templates/khepri/css/ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo $siteweb->get_url(); ?>/gabarit/templates/khepri/css/rounded.css" />
  
<?php

  echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url(). "/lang/application.".$lang.".js\"></script>"."\n";			

  switch (trim($do))
  {

    case "user_view":
	case "user_search" :	
	case "user_create" :
	echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url(). "/utilisateur/lang/utilisateur.".$lang.".js\"></script>"."\n";
	echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url(). "/includes/prototype/prototype.js\"></script>"."\n";	
	echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url(). "/utilisateur/js/utilisateur.js\"></script>";
	//echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url(). "/includes/ajax/ajax.js\">;
	require_once($siteweb->get_document_root().'\utilisateur\lang\utilisateur.'.$lang.'.php');							
	    break;

	    
    case "groupe_view":
	case "groupe_search" :	
	case "groupe_create" :
	echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url(). "/utilisateur/lang/groupe.".$lang.".js\"></script>"."\n";		
	require_once($siteweb->get_document_root().'\utilisateur\lang\groupe.'.$lang.'.php');							
	echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url(). "/includes/prototype/prototype.js\"></script>"."\n";
	echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url(). "/utilisateur/js/groupe.js\"></script>"."\n";		
	echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url(). "/administration/js/admin.js\"></script>"."\n";		
		break;

		
	case "dep_view":
	case "dep_create":
	case "dep_search" :	
	echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url(). "/utilisateur/lang/departement.".$lang.".js\"></script>"."\n";		
	require_once($siteweb->get_document_root().'\utilisateur\lang\departement.'.$lang.'.php');							
	echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url(). "/includes/prototype/prototype.js\"></script>"."\n";
	//echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url(). "/includes/ajax/ajax.js\">;	
	echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url(). "/utilisateur/js/departement.js\"></script>"."\n";		
		break; 

		 
	case "profi_view":
	case "profi_search" :	
	case "profi_create" :
	echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url(). "/utilisateur/lang/profil.".$lang.".js\"></script>"."\n";
	echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url(). "/includes/prototype/prototype.js\"></script>"."\n";	
	require_once($siteweb->get_document_root().'\utilisateur\lang\profil.'.$lang.'.php');									
	echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url(). "/utilisateur/js/profil.js\"></script>"."\n";	
	//echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url(). "/includes/ajax/ajax.js\">."\n";	
		break;
	 
		 
	case "tache_search":
	case "tache_create" :
	case "tache_admin_view" :
	case "tache_view_user" :
	case "tache_view":
	case "tache_update":
	echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url(). "/workflow/lang/tache.".$lang.".js\"></script>"."\n";
	echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url(). "/includes/prototype/prototype.js\"></script>"."\n";	
	require_once($siteweb->get_document_root().'\workflow\lang\tache.'.$lang.'.php');									
	echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url(). "/workflow/js/tache.js\"></script>"."\n";	
	//echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url(). "/includes/ajax/ajax.js\">"."\n";	
		break;
	
		
	case "processus_search":
	case "processus_create" :
	case "processus_admin_view" :
	case "processus_view_user" :
	case "processus_view":
	case "processus_update":
	echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url(). "/workflow/lang/processus.".$lang.".js\"></script>"."\n";		
	require_once($siteweb->get_document_root().'\workflow\lang\processus.'.$lang.'.php');							
	echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url(). "/includes/prototype/prototype.js\"></script>"."\n";	
	echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url(). "/workflow/js/processus.js\"></script>"."\n";		
		break;

		
	case "workflow_search":
	case "workflow_view":
	case "workflow_update":
    case "accueil_user":	
    case "workflow_create" :	
	echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url(). "/ged/lang/ged.".$lang.".js\"></script>"."\n";
	echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url(). "/ged/js/ged.js\"></script>";
	echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url(). "/workflow/js/workflow.js\"></script>";
    echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url(). "/includes/prototype/prototype.js\"></script>"."\n";
	require_once($siteweb->get_document_root().'\workflow\lang\workflow.'.$lang.'.php');	
	require_once($siteweb->get_document_root().DS.'ged'.DS.'lang'.DS.'ged.'.$lang.'.php');
	    break;

	    
	case "circuit_search":
	case "cir_create1" :
	case "cir_create2" :
	case "circuit_view":
	echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url(). "/workflow/lang/circuit.".$lang.".js\"></script>"."\n";				
	echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url(). "/workflow/js/circuit.js\"></script>";
	//echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url(). "/includes/ajax/ajax.js\">";
	echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url(). "/includes/prototype/prototype.js\"></script>"."\n";	
	require_once($siteweb->get_document_root().'\workflow\lang\circuit.'.$lang.'.php');
	    break;
	 
	     
	case "doc_view":
	case "doc_search" :
	case "doc_create" :
	echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url(). "/ged/lang/ged.".$lang.".js\"></script>"."\n";
	echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url(). "/ged/js/ged.js\"></script>";
    echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url(). "/includes/prototype/prototype.js\"></script>"."\n";
	require_once($siteweb->get_document_root().DS.'ged'.DS.'lang'.DS.'ged.'.$lang.'.php');
	    break;
	   
	     
	case "mail_view":
	case "mail_search" :
	case "mail_create" :
	case "mail_select_dest" :
	case "doc_update_reject_valid" :	
	case "mail_log" :
	case "mail_param" :
	case "mail_param_valid" :
	case "doc_update_reject":	
	echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url(). "/mail/lang/mail.".$lang.".js\"></script>"."\n";
	echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url(). "/mail/js/mail.js\"></script>";
    echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url(). "/includes/prototype/prototype.js\"></script>"."\n";
	require_once($siteweb->get_document_root().DS.'mail'.DS.'lang'.DS.'mail.'.$lang.'.php');
	    break;

	    
	case "config_view":
	case "paie_param":
	case "rh_param":
	echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url(). "/administration/lang/admin.".$lang.".js\"></script>"."\n";
	echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url(). "/administration/js/admin.js\"></script>";
    echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url(). "/includes/prototype/prototype.js\"></script>"."\n";
	require_once($siteweb->get_document_root().DS.'administration'.DS.'lang'.DS.'admin.'.$lang.'.php');
	    break;
	   
  }	
  
?>
	<script type="text/javascript">
		/*
		 fonction qui retourne la traduction d'un code
		 @param	pcode_traduction string	le code de traduction
		 @return	string
		*/
	function get_traduction(pcode_traduction)
	{
		if (Translate != undefined)
		{
			var ltraduction = Translate[pcode_traduction];
			if (ltraduction != undefined) return ltraduction;
			else return pcode_traduction;
		}
		else return pcode_traduction;
	}

	</script>
	
</head>
<body id="minwidth-body">
	<div id="border-top" class="h_green">
		<div>
			<div>
<!--				<span class="title">SesameFlow</span>-->
				<span class="version"> Version <?php echo $siteweb->get_numero_version(); ?>&nbsp;
				<?php
				//obtenir juste les paramètres	do=user_search&login=admin&lang=en
				$lparam_url = $_SERVER["QUERY_STRING"];
				//extraire les paires de paramètres
				$larr_param = explode("&",trim($lparam_url));

				//fabriquer un tableau associatif
				$larr_param2 = array();
				foreach ($larr_param as $lpaire) 
				{
						$larr_element = explode("=" , $lpaire);
						$larr_param2[$larr_element[0]] = trim($larr_element[1]);
				}
					
				//affichage du drapeau anglais et francais pour l'internationalisation
				 if (trim(strtolower($lang)) == "fr")
				 {
				 	$larr_param2["lang"] = "en";
				 	echo "<img src=\"".$siteweb->get_url()."/images/flag_fr.gif\" alt=\"Version fran&ccedil;aise\" title=\"Version fran&ccedil;aise\" width=\"14\" height=\"13\" border=\"0\">"."\n";
				 	echo $siteweb->a_tag("<img src=\"".$siteweb->get_url()."/images/flag_gb.gif\" alt=\"English version\" title=\"English version\" width=\"14\" height=\"13\" border=\"0\">" , $siteweb->get_url()."/gabarit/page.gabarit.php" , array() , $larr_param2  )."\n";
				  }
				  else
				 {
				 	$larr_param2["lang"] = "fr";
				 	echo $siteweb->a_tag("<img src=\"".$siteweb->get_url()."/images/flag_fr.gif\" alt=\"Version fran&ccedil;aise\" title=\"English version\" width=\"14\" height=\"13\" border=\"0\">" , $siteweb->get_url()."/gabarit/page.gabarit.php" , array() , $larr_param2  )."\n";
				 	echo "<img src=\"".$siteweb->get_url()."/images/flag_gb.gif\" alt=\"English version\" title=\"English version\" width=\"14\" height=\"13\" border=\"0\"></a>"."\n";
				  }
				  
				  //libérer la mémoire
				  unset($lparam_url);
				  unset($larr_param);
				  unset($larr_param2);
				?>
				 </span>
			</div>
		</div>
	</div>
	<div id="header-box">
		<div id="module-status">
			
			<a href="<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=mail_search&login={$login}&lang={$lang}&sel_option_etat=nonlu" ?>"><span class="no-unread-messages"><?php echo count($listemail); ?></span></a>
			
			<?php
		
				//charger les packages de PEAR::MDB2					
				ini_set('include_path', $siteweb->get_document_root().DS.'includes'.DS.'pear');
				require_once($siteweb->get_document_root().DS.'utilisateur'.DS.'classe'.DS.'utilisateur.class.php');
		     	$user = new Utilisateur();
				$user->connected = 1;
				$listeuser = $user->rechercher();
				if ($user->has_exception())  die($user->exception);	
				
				unset($_SESSION["is_superadmin"]);	//supprimer la variable qui permet de savoir si 
				//l'utilisaeur en cours est un super administrateur
				
				//rechercher la ligne ayant le login en cours
				if (count($listeuser) == 1)
				{
					$lnom = $listeuser[0]["nomuser"];
					$lprenom = $listeuser[0]["prenomuser"];
					$lcodeuser = $listeuser[0]["codeuser"];
					$lloginuser = $listeuser[0]["loginuser"];
					$_SESSION["is_superadmin"] = (intval($listeuser[0]["codegroup"]) == 1);
					//@see tprocessus_view.php , tprocessus_create.php , tcircuit_view.php , ttache_view.php
				}
				else 
				{
					$lfound = false;
					$i = 0;
					while( (! $lfound) && ($i < count($listeuser)) )
					{
						$linfo_user  = $listeuser[$i];
						if (trim(strtolower($login)) == trim(strtolower($linfo_user["loginuser"])))
						{
							$lfound = true;
							$lnom = $linfo_user["nomuser"];
							$lprenom = $linfo_user["prenomuser"];
							$lcodeuser = $linfo_user["codeuser"];
							$lloginuser = $linfo_user["loginuser"];
							$_SESSION["is_superadmin"] = (intval($linfo_user["codegroup"]) == 1);
						}
						else $i++;
					}
				}
				
			?>
			<span class="loggedin-users"><?php echo count($listeuser); ?></span>
			<span class="loggedin-users2">&nbsp;&nbsp;
				<a href="<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=user_view&login={$login}&lang={$lang}&codeuser={$lcodeuser}" ?>"><?php echo ucfirst($login)." (".ucfirst($lprenom)." ".ucfirst($lnom)." )"; ?></a>
			</span>
			<span class="logout">
    	<a href="#" onclick="javascript: window.location='<?php echo $siteweb->get_url()."/traitements/deconnexionbd.php?login={$login}&lang={$lang}"; ?>';"> <?php echo ucfirst($translate["deconnexion"]); ?>  </a>
			</span>
			
		</div>
		</div>
		  <?php
		  
		        //libérer la mémoire
				unset($linfo_user);
				unset($lnom);
				unset($lprenom);
				unset($lfound);
				unset($i);
				
		   //charger les packages de PEAR::MDB2
		   ini_set('include_path', $siteweb->get_document_root().'\includes\pear');		
		   require_once($siteweb->get_document_root().DS."workflow".DS."classe".DS."tache.class.php");
		   require_once($siteweb->get_document_root().DS."workflow".DS."classe".DS."processus.class.php");
		   $proc = new processus ();
		   //obtenir la liste des taches initiales pour les processus activés
		   $ltache = new tache();
		   $ltache->etatprocessus = 1;
		   $ltache->set_initiale(true);
	   	   $larr_tache_initiale = $ltache->rechercher();
	   	   if ($ltache->has_exception()) die($ltache->exception);
		   
			/**
			* *
			* Array ( [0] => Array ( 
			* [numprocessus] => 1 [libprocessus] => Gestion des achats [codecircuit] => 22 [libcircuit] => ezze [numtache] => 1 [libtache] => initier demande d\'achat )
			*  [1] => Array ( [numprocessus] => 1 [libprocessus] => Gestion des achats [codecircuit] => 22 [libcircuit] => ezze [numtache] => 1 [libtache] => initier demande d\'achat ) ) 
			*/
			/**
			* oobtenir la liste des processus uniquement
			*/
			 
			$larr_processus = array();
			$larr_numprocessus = array();
			
			if (! is_null($larr_tache_initiale))
			{
				foreach ($larr_tache_initiale as $linfo_tache)
				{
					$lnumprocessus = $linfo_tache["numprocessus"];
					//ce numéro de processus a-t-il déjà été traité ?
					if (! in_array($lnumprocessus , $larr_numprocessus))
					{//NON. l'ajouter dans la liste des processus recensés
					array_push($larr_processus , array("numprocessus" => $linfo_tache["numprocessus"] , "libprocessus" => $linfo_tache["libprocessus"]));
					array_push($larr_numprocessus , $lnumprocessus);
					}
				}
			}
			
			//libérer la mémoire
			unset($lnumprocessus);
			unset($larr_numprocessus);
			unset($linfo_tache);
			
			//ordonner la liste de processus
			//array_multisort($larr_processus , SORT_ASC);
			
		   //ne sélectionner que les processus activés
		   /*$proc->etatprocessus = 1;
		   $affiche_processus = $proc->rechercher();
		   $nbr_menu_processus=count($affiche_processus);*/
		   //print_r($larr_tache_initiale);  die();
		  ?>		
		  
		<script type="text/javascript">
			var myMenu =
			[
				<?php
 				
		   		foreach ($larr_processus as $linfo_processus) 
		   		{ 	
					//la simple quote est un caractère critique pour javascript
					$llib_processus = ucfirst(trim($linfo_processus["libprocessus"]));
					$llib_processus = str_replace("\\" , "" , $llib_processus);
					$llib_processus = str_replace("'" , "\\'" , $llib_processus);
		   		?>
					[null, '<?php echo $llib_processus;  ?>', null, null, '<?php echo $llib_processus;  ?>',   // a folder item
						<?php
						
							foreach ($larr_tache_initiale as $linfo_tache) 
							{
								if (intval($linfo_processus["numprocessus"]) == intval($linfo_tache["numprocessus"]))
								{
									//la simple quote est un caractère critique pour javascript
									$llib_tache = ucfirst(trim($linfo_tache["libtache"]));
									$llib_tache = str_replace("\\" , "" , $llib_tache);
									$llib_tache = str_replace("'" , "\\'" , $llib_tache);
									$lnumtache = intval($linfo_tache["numtache"]);
						?>
							        [null, '<?php echo $llib_tache ; ?>', '<?php echo $siteweb->get_url()."/gabarit/page.gabarit.php?do=workflow_create&login={$login}&lang={$lang}&numtache={$lnumtache}&codecircuit=".$linfo_tache["codecircuit"]."&typedoc=".($linfo_tache["typedoc"]);?>', null , '<?php echo $llib_tache; ?>'],  // a menu item
				        <?php
								}
					   		}
				        ?>
				    ], 
			   <?php  
			   }
			   
				   //libérer la mémoire
				   unset($linfo_tache);
				   unset($larr_tache_initiale);
				   unset($linfo_processus);
				   unset($ltache);
				   
			    ?> 
			];
			
		</script>
		<div id="myMenuID"></div>
		<SCRIPT language="JavaScript" type="text/javascript">
		cmDraw ('myMenuID', myMenu, 'hbr', cmThemeGray, 'ThemeGray');
		</SCRIPT>	 
		
		<div class="clr"></div>
	</div>
	<div id="content-box">
		<div class="border">
			<div class="padding">
				<div id="toolbar-box">
   			<div class="t">

				<div class="t">
					<div class="t"></div>
				</div>
			</div>
			<div class="m">
				<div class="toolbar" id="toolbar">
					<?php require_once($siteweb->get_document_root().'\traitements\menu_central.php'); ?>
				</div>
				
				<?php echo $div_titre_menu_central; ?>

				<div class="clr"></div>
			</div>
			<div class="b">

				<div class="b">
					<div class="b"></div>
				</div>
			</div>
  		</div>
  		<?php
  			//controle des permissions de l'utilisateur en cours
  			
			//if (("accueil_user" == trim(strtolower($do))) || (trim(strtolower($login)) == "admin"))
			if ( in_array(trim(strtolower($do)) , array("accueil_user","workflow_create","workflow_update")) || (trim(strtolower($login)) == "admin"))
			{//on a toujours le droit d'accéder à la page d'accueil.
				//le super administrateur admin a toujours le droit d'accéder à une fonctionnalité
				$lhas_right = true;
			}
			else if (trim(strtolower($do)) == "user_view")
			{//tout utilisateur peut consulter son propre profil et le modifier
				$lhas_right = true;
			}
			else 
			{
				
				//si on est dans un workflow, gestion des permission suivant la définition du circuit
				if ( in_array(trim(strtolower($pdo)) , array("workflow_update","workflow_create","workflow_create_valid","workflow_update_valid")))
				{
					//les taches autoriés par le login en cours
					require_once($this->get_document_root().DS.'workflow'.DS.'classe'.DS.'tache.class.php');
					$ltache = new tache();
					
					$ltache->loginuser = trim($plogin);
					$ltache->codecircuit = intval($pcodecircuit);
					
					$listetache = $ltache->rechercher();
					if ($ltache->has_exception()) die($ltache->get_exception());
					
					//recherche $pnumtache dans la liste des tâches
					$lfound = false;
					$i = 0;
					while ( (! $lfound) && ($i < count($listetache)) )
					{
						$lfound = ( intval($pnumtache) == intval($listetache["numtache"]) );
					}
					
					$lhas_right = $lfound;
					
					unset($ltache);
					unset($listetache);
					unset($lfound);
					
				}
				else 
				{
 
		  			require_once($siteweb->get_document_root().DS.'administration'.DS.'classe'.DS.'droa.class.php');
		  			require_once($siteweb->get_document_root().DS.'administration'.DS.'lang'.DS.'admin.'.$lang.'.php');
		  			
		  			$lpermission = new droit();
		  			$lpermission->loginuser = $login;
		  			$listedroit = $lpermission->rechercher();
		  			
		  			$lhas_right = false;
		  			$lmessage_class = "fade";
		  			$lmessage_status =  ucfirst($translate["no_rigth_for_this_functionnality"]);
		  			$lmessage_status = str_replace( '{%do%}' , "(".$translate[$pdo].")" , $lmessage_status);
		  			
		  			if (is_array($listedroit))
		  			{
		  				foreach($listedroit as $larr_permission)
						{
							$lcodeaction = $larr_permission["codeaction"];
							if (trim(strtolower($lcodeaction)) == trim(strtolower($do)))
							{
								$lhas_right = true;
								break;
							}
						}
		  			}
	  			
				}
			}
			
  			if (! $lhas_right)
  			{
  				$state = "no_rigth_for_this_functionnality";
  				$lmessage_class = "error";
  			}
  			
  			//libérer la mémoire
  			unset($lpermission);
  			unset($listedroit);
  			unset($lcodeaction);
  		?>
   		<div class="clr"></div>
   		<?php //afficher une alerte
  			echo $siteweb->alert($state , $lmessage_class , $lmessage_status , $lang , $do , $from);
  		 ?>
		
		<div id="element-box">
			<div class="t">
		 		<div class="t">

					<div class="t"></div>
		 		</div>
			</div>
			<div class="m">

		<table cellspacing="0" cellpadding="0" border="0" width="100%">

		<tr>
			<td valign="top">
				<?php
				
			    $data = $_POST;
				foreach ($_GET as $lkey => $lvalue)
				{
				$data[$lkey] = $lvalue;
				}
				
				$do = $data["do"];
				$username = $data["username"];
				$passwd = $data["passwd"];
				$rech = $data["nom"];
				global $rech;
			     
				//prétraitement pour la partie centrale, c'est la zone réservée à l'affichage des formulaires
				ini_set('include_path', $siteweb->get_document_root().'\includes\pear');
				//seul l'utilisateur ayant les droits d'accès peut exécuter la partie centrale
				//if ($lhas_right)
				{
					require_once($siteweb->get_document_root().DS.'traitements'.DS.'partie_centrale.php');		
				}
				
				?>
				
			</td>
			<td valign="top" width="200px" style="padding: 7px 0 0 5px">
				<?php require_once($siteweb->get_document_root().DS."traitements".DS."menu_droite.php"); ?>			
			</td>
		</tr>
		</table>

				<div class="clr"></div>
			</div>
			<div class="b">
				<div class="b">
					<div class="b"></div>
				</div>
			</div>
   		</div>
		<noscript>
	Attention! Le support du javaScript doit être activé dans votre navigateur pour une utilisation optimale de Sésameflow!.		        </noscript>
		<div class="clr"></div>
	</div>
	<div class="clr"></div>
</div>
</div>
	<div id="border-bottom"><div><div></div></div></div>
	<div id="footer">
		<p class="copyright">
			<?php echo $translate["sesameflow_powered_by_interfacesa"]; ?>
		</p>
	</div>
</body>
</html>