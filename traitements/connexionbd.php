
<?php
/**
 * @desc		script d'authentification  à la base de données
 * @version		1.0
 * @package		Administration
 * @copyright (C) 2009 INTERFACE SA. Tous droits réservés
 * @license		INTERFACE SA
 * @author 		Bello Adamou <moustaphbi@yahoo.fr>
 * @updates
 * 	# samedi 20 juin 2009 (Patrick Mveng)
 * 		- suppression de la fonction init()
 * 		- postage de la langue et le login de l'utilisateur à la page gabarit
 */

   session_start();
   
    $data = $_POST;

	foreach ($_GET as $lkey => $lvalue)
	{
	$data[$lkey] = $lvalue;
	}

	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
	$ajax= (isset($data["ajax"])) ? (! is_null($data["ajax"])) ? $data["ajax"] : 0 : 0;
	
	$username = $data["username"];
	$passwd = $data["passwd"];
	global $username;
	
      if (! defined("DS")) define("DS" , DIRECTORY_SEPARATOR);

	$chemin = dirname(__FILE__);
	$chemin = str_replace(DS."traitements","",$chemin);
	require_once($chemin.DS.'classe'.DS.'application.class.php'); 
	$siteweb = new Application();
	ini_set('include_path', $siteweb->get_document_root().'\includes\pear');//charger les packages de PEAR::MDB2
	require_once($siteweb->get_document_root().'\utilisateur\classe\utilisateur.class.php');
    $user = new Utilisateur();
 
    $passwd = md5(trim($passwd));
    //die(trim($passwd));
	$result = $user->login($username  , $passwd);

	if ($result == true)
	{
		global $siteweb; 
		$user->loginuser = trim($username);
		//mettre à  jour le flag connected = 1 pour ce login dans la BD
		$user->set_connected(1 , trim($username));	// 1 => connected , 0 = not connected
		
		$_SESSION["login"] = $user->loginuser;
		$_SESSION["lang"] = $lang;
		
		if (intval($ajax) == 1)
		{
		 		$lretval = "";
		 		die($lretval);
		}

?>

<script type="text/javascript">window.location = '<?php echo $siteweb->get_url().'/gabarit/page.gabarit.php?login='.$username."&lang={$lang}&do=accueil_user"; ?>';</script>

<?php

	} 
	else
	{

		//détruire la session 	
		session_destroy();
		unset($_SESSION);

		if (intval($ajax) == 1)
		{
			require_once($siteweb->get_document_root().DS."lang".DS."application.fr.php");
		 		$lretval = "
				<dt class=\"message\">Message</dt>
	
				<dd class=\"message message error\">
					<ul>
						<li>Identifiant ou mot de passe incorrect !</li>
					</ul>
				</dd>";
		 		
		 		die($lretval);

		}
		else 
		{
	
	?>
	   <script type="text/javascript">
	    window.history.back();
		alert('Identifiant ou mot de passe incorrect ! ');
		document.login.username.select();
		document.login.username.focus();
	   </script>
	<?php
	 	exit;
		}
	}
?>
