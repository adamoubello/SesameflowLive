<?php

/**
 * @version			1.0
 * @package			installation
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			xaverie Onana <onana_carine@yahoo.fr>
 * @desc			Script pour l'installation de sesameflow
 * @creationdate	24 Août 2009
 */
 ?>
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr-fr" lang="fr-fr" dir="ltr" id="minwidth" >
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
  <meta name="robots" content="index, follow" />
  <meta name="keywords" content="sesameflow , workflow, erp, interface" />
  <meta name="description" content="SesameFlow - Un autre regard sur le workflow" />
  <title>Installation de SESAMEFLOW</title>
  
  <?php

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
  $etape = (isset($data["etape"])) ? (! is_null($data["etape"])) ? $data["etape"] : 1 : 1;

  if (trim($lang) == "") $lang = "fr";

  $chemin = dirname(__FILE__);
  $chemin = str_replace("installation","",$chemin);
  require_once($chemin.'classe'.DS.'application.class.php');
  $siteweb = new Application();
  global $siteweb;
  //if (file_exists($siteweb->get_document_root().DS.'lang'.DS.'install.'.$lang.'.php'))
  require_once($siteweb->get_document_root().DS.'installation'.DS.'lang'.DS.'install.'.$lang.'.php');

?>  

 <?php echo $siteweb->title_tag($etape); ?>
 

 <?php
 echo "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"". $siteweb->get_url().$siteweb->get_dossier_plugin()."/popcal/skins/aqua/theme.css\" title=\"Aqua\" />\n";
 echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url().$siteweb->get_dossier_plugin()."/popcal/calendar.js\"></script>\n";
 echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url().$siteweb->get_dossier_plugin()."/popcal/calendar-setup.js\"></script>\n";

 //language for the calendar -->
 echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url().$siteweb->get_dossier_plugin()."/popcal/lang/calendar-".$lang.".js\"></script>\n";
 ?>	 
 <?php echo $siteweb->title_tag($etape); ?>
	<link rel="stylesheet" type="text/css" href="templates/khepri/css/rounded.css" />
	<script type="text/javascript" src="<?php echo $siteweb->get_url(); ?>/includes/js/joomla.javascript.js"></script>
	<script type="text/javascript" src="<?php echo $siteweb->get_url(); ?>/media/system/js/mootools.js"></script>
	<script type="text/javascript" src="<?php echo $siteweb->get_url(); ?>/media/system/js/switcher.js"></script>
    <link rel="stylesheet" href="<?php echo $siteweb->get_url(); ?>/gabarit/templates/system/css/system.css" type="text/css" />
	<link href="<?php echo $siteweb->get_url(); ?>/gabarit/templates/khepri/css/template.css" rel="stylesheet" type="text/css" />
	 
<!--[if IE 7]>
<link href="<?php echo $siteweb->get_url(); ?>/gabarit/templates/khepri/css/ie7.css" rel="stylesheet" type="text/css" />
<![endif]-->

<!--[if lte IE 6]>
<link href="<?php echo $siteweb->get_url(); ?>/gabarit/templates/khepri/css/ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->

	   <link rel="stylesheet" type="text/css" href="<?php echo $siteweb->get_url(); ?>/gabarit/templates/khepri/css/rounded.css" />
  
<div id="border-top" class="h_green">
		<div>
			<div> 
				<span class="title"></span>
			</div>
		</div>
	</div>
	
	<link rel="stylesheet" type="text/css" href="css/rounded.css" />
	<script type="text/javascript" src="includes/prototype/prototype.js"></script>
	<script type="text/javascript" src="js/install.js"></script>
	<!--<script type="text/javascript" src="lang/install.".$lang.".js"></script>-->
	<?php echo "<script type=\"text/javascript\" src=\"".$siteweb->get_url(). "/installation/lang/install.".$lang.".js\"></script>"."\n"; ?>
</head>
<body>
	<div id="content-box">
		<div class="padding">
			<div id="element-box" class="login">
				<div class="t">
					<div class="t">
						<div class="t"></div>
					</div>
				</div>
				<div class="m">

					<h1><?php echo ucfirst($translate["installation_de_sesameflow"]); ?> !</h1>
				<dl id="system-message" style="display:none">
					<dt class="error">Erreur</dt>
					<dd class="error message fade">
						<ul>
							<li></li>
						</ul>
					</dd>
				</dl>
	
							<div id="section-box">
			<div class="t">
				<div class="t">
					<div class="t"></div>
		 		</div>
	 		</div>
			<div class="m"> 
<?php

 switch (intval($etape))
 {
 	case 1 :
 		require_once($siteweb->get_document_root().DS.'installation'.DS.'page'.DS.'etape1.php');
 		break;

 	case 2 :

 		require_once($siteweb->get_document_root().DS.'installation'.DS.'page'.DS.'etape2.php');
 		break;

 	case 3 :

 		require_once($siteweb->get_document_root().DS.'installation'.DS.'page'.DS.'etape3.php');
 		break;

 	case 4 :

 		require_once($siteweb->get_document_root().DS.'installation'.DS.'traitements'.DS.'tetape4.php');
 		require_once($siteweb->get_document_root().DS.'installation'.DS.'page'.DS.'etape4.php');
 		break;

 	case 5 :
 		require_once($siteweb->get_document_root().DS.'installation'.DS.'traitements'.DS.'tetape5.php');
 		require_once($siteweb->get_document_root().DS.'installation'.DS.'page'.DS.'etape5.php');
 		break;

 	case 6:
 		require_once($siteweb->get_document_root().DS.'installation'.DS.'page'.DS.'etape6.php');
 		break;

 	case 7:
 		require_once($siteweb->get_document_root().DS.'installation'.DS.'traitements'.DS.'tetape7.php');
 		require_once($siteweb->get_document_root().DS.'installation'.DS.'page'.DS.'etape7.php');
 		break;
 }
 ?>
				<div class="clr"></div>
			</div>
			<div class="b">
				<div class="b">
		 			<div class="b"></div>
				</div>
			</div>
		</div>
					<div id="lock"></div>
					<div class="clr"></div>
				</div>
				<div class="b">
					<div class="b">
						<div class="b"></div>
					</div>
				</div>
			</div>
			<noscript>
				Attention! Le support du JavaScript doit &Eacute;atre activ&eacute; dans votre navigateur pour une utilisation optimale de l'Administration de SesameFlow!.			</noscript>
			<div class="clr"></div>
		</div>
	</div>
	<div id="border-bottom"><div><div></div></div>
</div>
<div id="footer">
	<p class="copyright">
		<?php
			echo $translate["sesameflow_powered_by_interfacesa"]; 
		?>
	</p>
</div>
</body>
</html>