<?php
/**
 * @version			1.0
 * @package			GED
 * @subpackage		traitements
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			William Nkingné <william.nkingne@laposte.net>
 * @desc			Script de traitement de la mise à jour d'un document.
 * 
 * @creationdate	mercredi 30 juin 2009
 * @updates
 */
   
	$data = $_POST;
	foreach ($_GET as $lkey => $lvalue)
	{
		$data[$lkey] = $lvalue;
	}
	$numdoc=$data["numdoc"];
	$typedoc = $data["typedoc"];

	$ajax = (isset($data["ajax"])) ? (! is_null($data["ajax"])) ? $data["ajax"] : 0 : 0;
	$login = (isset($data["login"])) ? (! is_null($data["login"])) ? $data["login"] : "" : "";
	$do = (isset($data["do"])) ? (! is_null($data["do"])) ? $data["do"] : "accueil" : "accueil";
	$lang = (isset($data["lang"])) ? (! is_null($data["lang"])) ? $data["lang"] : "fr" : "fr";
	$from = (isset($data["from"])) ? (! is_null($data["from"])) ? $data["from"] : "accueil" : "accueil";

   //obtenir le séparateur de dossier pour la OS en cours
   if (! defined("DS")) define( 'DS', DIRECTORY_SEPARATOR );
	
	$chemin = dirname(__FILE__);    
	$chemin = str_replace(DS."ged".DS."traitements","",$chemin);
	require_once($chemin.DS.'classe'.DS.'application.class.php');	
   	$siteweb = new Application();
   
   //chargement des spécifications de la classe numérique
   require_once($siteweb->get_document_root().DS."ged".DS."classe".DS."document.class.php");
   require_once($siteweb->get_document_root().DS."ged".DS."classe".DS."numerique.class.php");
   require_once($siteweb->get_document_root().DS."ged".DS."classe".DS."formulaire.class.php");

   //instancier un objet numérique
   $lnumeric = new Numerique();

      //chargement de PEAR
  ini_set('include_path', $siteweb->get_document_root().'\includes\pear');	//charger les packages de PEAR::MDB2	
  require_once($siteweb->get_document_root().DS.'lang'.DS.'application.'.$lang.'.php');	

   if ($lnumeric->importer($siteweb->get_document_root().DS."ged".DS."document", "logosite")) 
   {
        $lnumeric->setNumdoc($lnumeric->generer_numero());
        $lnumeric->setLibfich($lnumeric->chemin_acces);
        $lnumeric->setDateImportation();
        $lnumeric->setHeureImportation();
        $lnumeric->setNumform($numdoc);

        //enregistrer cette pièce dans la BD
        if ( $lnumeric->create())
            {

                if (intval($ajax) == 1) 
                {
					//relance la recherche de spièces jointes associées au formulaire $numdoc
	                $lform = new Formulaire();
	                $lform->setNumdoc($numdoc);
	                $lform->setTypedoc("numeric");
	                $listedoc = $lform->rechercher();
                	require_once($siteweb->get_document_root().DS."ged".DS."traitements".DS."tdoc_result_search.php");
                }
                $lretval = "
                  <h2 class='tab'>".ucfirst($translate["pieces_jointes"])."</h2>
      			  <script type='text/javascript'>tp1.addTabPage( document.getElementById( 'tabPage2' ) );</script>
                  {$resulat_recherche_doc}
                   ";
                
                $state = "insert_valid_success";

            }
         else
         {
         		$lretval = "
                  <h2 class='tab'>".ucfirst($translate["pieces_jointes"])."</h2>
      			<script type='text/javascript'>tp1.addTabPage( document.getElementById( 'tabPage2' ) );</script>

      			<dt class=\"message\">Message</dt>

      			<dd class=\"message message error\">
      				<ul>
      					<li>".$lnumeric->exception."</li>
      				</ul>
      			</dd>";
         		die($lnumeric->exception);
         		$state = "insert_valid_error";
         }


   }
   else
   {
   		$lretval = "
            <h2 class='tab'>".ucfirst($translate["pieces_jointes"])."</h2>
			<script type='text/javascript'>tp1.addTabPage( document.getElementById( 'tabPage2' ) );</script>

			<dt class=\"message\">Message</dt>

			<dd class=\"message message error\">
				<ul>
					<li>".$lnumeric->state."</li>
				</ul>
			</dd>";
   		$state = $lnumeric->state;
   }
   
   if (intval($ajax) == 1) die($lretval);
   
?>