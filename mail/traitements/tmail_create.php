<?php
/**
 * @version			1.0
 * @package			Mail
 * @subpackage		Mail
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @created		:	29 mars 2009 by patrick mveng
 * @author 			Patrick Mveng
 * @desc		:	script de traitement pour la fiche de création d'un mail
 * 					
 * @creationdate	
 * @updates
 */
   
    $data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
	$data[$lkey] = $lvalue;
	}
   
    //obtenir le séparateur de dossier pour la OS en cours
    if (! defined("DS")) define( 'DS', DIRECTORY_SEPARATOR );
  
	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
	$login= (isset($data["login"])) ? (! is_null($data["login"])) ? $data["login"] : null : null;
	$do = (isset($data["do"])) ? (! is_null($data["do"])) ? $data["do"] : "accueil" : "accueil";	
	$code_mail = (isset($vars["code_mail"])) ? (! is_null($vars["code_mail"])) ? $vars["code_mail"] : null : null;
	$sujet_mail = (isset($vars["sujet_mail"])) ? (! is_null($vars["sujet_mail"])) ? $vars["sujet_mail"] : "" : "";
	$body_mail = (isset($vars["body_mail"])) ? (! is_null($vars["body_mail"])) ? $vars["body_mail"] : "" : "";
	$date_mail = (isset($vars["date_mail"])) ? (! is_null($vars["date_mail"])) ? $vars["date_mail"] : date("d/m/Y H:m:s") : date("d/m/Y H:m:s");
	$sel_lang_mail = (isset($vars["sel_lang_mail"])) ? (! is_null($vars["sel_lang_mail"])) ? $vars["sel_lang_mail"] : "fr" : "fr";
	$format_mail = (isset($vars["format_mail"])) ? (! is_null($vars["format_mail"])) ? $vars["format_mail"] : 1 : 1;
	$state = (isset($vars["state"])) ? (! is_null($vars["state"])) ? $vars["state"] : null : null;
	$chkbox_format_mail = $format_mail;  
    $chemin = dirname(__FILE__);
	$chemin = str_replace(DS."mail".DS."traitements","",$chemin);
	require_once($chemin.DS.'classe'.DS.'application.class.php');	
    $siteweb = new Application();
   
    global $siteweb;//global $rejeter;print_r($rejeter);die("mal garé");	
    ini_set('include_path', $siteweb->get_document_root().DS.'includes'.DS.'pear');	//charger les packages de PEAR::MDB2	
  	require_once($siteweb->get_document_root().DS."mail".DS."classe".DS."mail.class.php");

	if ( trim($code_mail) != "")	{
		//charger les infos de cette newsletter
		
		$lmail = new CMail();
		
		$lnewsletter->code_mail = $code_mail;
		$lnewsletter->charger();
		
		$sujet_mail = $lnewsletter->sujet_mail;
		$date_mail = $lnewsletter->date_mail;
		$sujet_mail = $lnewsletter->sujet_mail;
		$body_mail = $lnewsletter->body_mail;
		$format_mail = $lmail->format_mail;
		$chkbox_format_mail = $format_mail;
		$sel_lang_mail = $lmail->lang_mail;
		
	}
	
?>
<script type="text/javascript" src="<?php echo $siteweb->get_url()."/includes/tiny_mce/tiny_mce.js"; ?>"></script>

<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		element : "body_mail",
		/*language : "fr" ,*/
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		// Theme options
		theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,ButtonName,ButtonPrenom,ButtonEMail",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
		
		// add these two lines for absolute urls
		relative_urls : false,		
        remove_script_host : false,
        convert_urls : false,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		},
		setup : function(ed) {
				}
	});
</script>