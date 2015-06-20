<?php
/**
 * @version			1.0
 * @package			Administration
 * @subpackage		Configuration
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			patrick mveng<@yahoo.fr> 
 * @desc			script pour le test de connexion à une base de donnée
 * @creationdate	lundi 27 juillet 2009
 */
	
	       
	$data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
		$data[$lkey] = $lvalue;
	}
   
	$ajax = (isset($data["ajax"])) ? (! is_null($data["ajax"])) ? $data["ajax"] : 0 : 1;
	$login = (isset($data["login"])) ? (! is_null($data["login"])) ? $data["login"] : "" : "";
	$codemod = (isset($data["codemod"])) ? (! is_null($data["codemod"])) ? $data["codemod"] : null : null;
	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
	
    $chemin = dirname(__FILE__);
    
	//obtenir le séparateur de dossier pour la OS en cours
   if (! defined("DS")) define( 'DS', DIRECTORY_SEPARATOR );
	
    $chemin = dirname(__FILE__);
    $chemin = str_replace(DS."administration".DS."traitements","",$chemin);
	require_once($chemin.DS.'classe'.DS.'application.class.php');	
	
   	
   $siteweb = new Application();
   
	ini_set('include_path', $siteweb->get_document_root().'\includes\pear'); //charger les packages de PEAR::MDB2
  
   require_once($siteweb->get_document_root().DS.'classe'.DS.'table.class.php');	
   require_once($siteweb->get_document_root().DS.'lang'.DS."application.{$lang}.php");	
   
   $ltable = new Table();
   
   switch (trim(strtolower($codemod)))
   {
   		case "sesameflow" :
   				$ltable->typebd = $data["typebd"];
   				$ltable->hotebd= $data["hotebd"];
   				$ltable->userbd = $data["userbd"];
   				$ltable->pwdbd = $data["pwdbd"];
   				$ltable->nombd = $data["nombd"];
   			break;
   			
   }
   
   
	$lretval = $ltable->connection_database();
	$ltable->db->disconnect();

   if ($lretval == true)
 	$lretval = "
				<dt class=\"message\">Message</dt>
				<dd class=\"message message fade \" >
					<ul>
						<li>".ucfirst($translate["connexion_valid_success"])."</li>
					</ul>
				</dd>";
   else 
   $lretval = "
				<dt class=\"message\">Message</dt>
				<dd class=\"message message error \" >
					<ul>
						<li>".$ltable->get_exception()."</li>
					</ul>
				</dd>";
		  
	if (intval($ajax) == 1)
	{
		die($lretval);
	}
   
     ?> 