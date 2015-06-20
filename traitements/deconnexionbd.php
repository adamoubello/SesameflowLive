<?php
 /**
 * @desc		script d'authentification  � la base de donn�es
 * @version		1.0
 * @package		Administration
 * @copyright (C) 2009 INTERFACE SA. Tous droits r�serv�s
 * @license		INTERFACE SA
 * @author 		Bello Adamou <moustaphbi@yahoo.fr>
 */
	$data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
		$data[$lkey] = $lvalue;
	}
	
	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
	$login= (isset($data["login"])) ? (! is_null($data["login"])) ? $data["login"] : null : null;

	$chemin = dirname(__FILE__);
	$chemin = str_replace("\\traitements","",$chemin);
	require_once($chemin.'\classe\application.class.php');	
	$siteweb = new Application(); 
	ini_set('include_path', $siteweb->get_document_root().'\includes\pear');//charger les packages de PEAR::MDB2
	require_once($siteweb->get_document_root().'\utilisateur\classe\utilisateur.class.php');
    $user = new Utilisateur();
	$user->loginuser = $login;
	//mettre �  jour le champ connected = 0 pour ce login dans la BD
	$user->set_connected(0 , $login);	// 1 => connected , 0 = not connected
	
	//d�triure la session
	//session_destroy();
	unset($_SESSION);
?>


<script type="text/javascript"> window.location='<?php echo $siteweb->get_url()."/"; ?>'; </script>