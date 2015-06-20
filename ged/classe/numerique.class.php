<?php
/**
 * @version			1.0
 * @package			GED
 * @subpackage		Numerique
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			William<william.nkingne@laposte.net>
 * @desc			Spécification d'une pièce jointe à un formulaire dans le système de workflow
 * @creationdate	lundi 15 juin 2009
 * @updates		# samedi 27 juin 2009 (Patrick Mveng<patrick.mveng@interfacesa.local>)
 * 		-  ajout de la méthode importer
 * @todo 			Vérifier que tous les accesseurs et modificateurs sont définis
 */


$chemin = dirname(__FILE__);
$chemin = str_replace("\ged\classe","",$chemin);
require_once($chemin.'\classe\application.class.php');
$siteweb = new Application();

require_once($siteweb->get_document_root().'\ged\classe\document.class.php');
ini_set('include_path', $siteweb->get_document_root().'\includes\pear');

class Numerique extends Document {
	//Attributs
	public $numfich;
	public $libfich;
	public $auteurfich;
	public $tagfich;
	public $dateimport;
	public $heureimport;
	public $numdoc;
	public $numform;
	public $maxfilesize;


	//Accesseurs
	public function getDateImportation (){
		return $this->datecreation;
	}
	
	public function getHeureImportation (){
		return $this->heurecreation;
	}
	
	public function getDocumentMere (){
		return $this->docmere;
	}
	
	public function get_upload_max_filesize(){
		return $this->maxfilesize;
	}
	
	public function getLibfich ($valeur){
      $result = "";
	  $req = "Select N.libfich from numerique N where N.numdoc = ".$valeur." ";

	  $this->connect_db();
      if (! $this->db->isError ($lprepare = $this->db->prepare($req))) {
        if (! $this->db->isError ($result = $lprepare->Execute())){
          $lrow = $result->FetchRow();

		  //Transformer les noms de colonnes en champ de l'objet document en cours
		  foreach ($lrow as $lchamp => $lvaleur){
		    $this->$lchamp = $lvaleur;
		  }
		  $result = $this->libfich;

		  //libérer la mémoire
		  unset($lchamp);
		  unset($lvaleur);
		  }
		  else {
		    $this->exception = "numerique::charger() - ".$result->getMessage() . ' in ' . $req;
			$retvalue = false;
		  }
		}
		else {
		  $this->exception = "numerique::charger() - ".$lprepare->getMessage() . ' in ' . $req;
		  $retvalue = false;
		}

		//libérer la mémoire
	   	unset($req);

		$this->db->disconnect();
		return $result;
	}

	//Modificateurs
	public function setNumfich ($valeur){
		$this->numfich=$valeur;
	}

    public function setNumform ($valeur){
		$this->numform=$valeur;
	}
	
	public function setAuteurfich ($valeur){
		$this->auteurfich=$valeur;
	}

	public function setLibfich ($valeur){
		$this->libfich=$valeur;
	}
	
	public function set_upload_max_filesize($valeur){
		$this->maxfilesize=$valeur;
	}

	public function setDateImportation (){
		$this->datecreation=date("d/m/Y");
	}
	
	public function setHeureImportation (){
		$this->heurecreation=date("H:i:s");
	}
	
	public function setChemin_acces ($valeur=null){
		$this->chemin_acces=$valeur;
	}
	
	public function setDocumentMere ($valeur){
		$this->docmere=$valeur;
	}

	public function delete()
	{
		$retvalue = false;

		$req = "delete from numerique where numdoc='".$this->numdoc."'";

		$lparam_type=array();
		$lparam_type[]="integer";
		$lparam_type[]="text";
		$lparam_type[]="text";
		$lparam_type[]="text";
		
		$lparam_data=array();
		$lparam_data[]=$this->numdoc;
		$lparam_data[]=trim($this->libfich);
		$lparam_data[]=trim($this->dateimport);
		$lparam_data[]=trim($this->heureimport);

		$this->connect_db();
		if (!$this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type))){
			if (!$this->db->isError ($result = $lprepare->Execute($lparam_data))){


				$retvalue =  true;
			}
			else {
				$this->exception = "document::delete() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = false;
			}
		}
		else {
			$this->exception = "document::delete() - ".$lprepare->getMessage() . ' in ' . $req;
			$retvalue = false;
		}
		$this->db->disconnect();
		return $retvalue;
	}
	
	/**
	 * fonction d'importation d'un document
	 * @author 			:	patrick mveng<patrick.mveng@interfacesa.com>
	 * @datecreation	:	samedi 27 juin 2009	
	 * @param string - $pdestfolder - dossier destinataire du fichier importé
	 * @param string - $pparam_name - nom de l'élément HTML ayant le chemin du fichier à importer
	 * @return true si importation avec succès, l'attribut $chemin_acces contient le nom du fichier uniquement
	 * 			, sinon false et l'attribut state contient la raison de l'échec
	 */
	public function importer($pdestfolder,$pparam_name)
	{
		if(!empty($_FILES[$pparam_name]))
  		{
			if($_FILES[$pparam_name]['error']==1)
			 {
				$this->state = $pparam_name."_taille_depasse_max_srv";
				$this->state = "taille_depasse_max_srv";
			  	//Le fichier téléchargé excède la taille autorisée par le serveur
			  	return false;
			 }			
			//on controle si y a un fichier a uploadé
			elseif($_FILES[$pparam_name]['error']==4)
			{
				$this->state = "aucun_fichier_uploaded";
			 	//Aucun fichier n'a été téléchargé</div>";
			 	return false;
			}  
			
			//$ltype=explode("/", $_FILES[$pparam_name]['type']);
			$ltype = explode(".", $_FILES[$pparam_name]['name']);
			$lpath_parts = pathinfo($_FILES[$pparam_name]['name']);
			// on récupère l'extension appropriée
			//$lfilename = $ltype[0]; 
			//$lext=$ltype [1]; 
			$lext = $lpath_parts['extension'];
			$lfilename = basename ($lpath_parts['basename'],".".$lext); 
			
			//$lext = $this->format_extension($lext);
			//on donne le nom voulue au fichier, ici avec le nom d'utilisateur de la session.
			$lnom_fic= $pdestfolder."/".$lfilename.".".$lext;
			$luploaddir = dirname($lnom_fic);
			
			unset($lpath_parts);
			unset($lfilename);
			unset($lext);
	 
			//on commence par verifier que le dossier d'upload existe
	      if (! file_exists($luploaddir)) 
	      {
	      	if (!is_dir($luploaddir))
			{
				@mkdir($luploaddir, 0777);
			}
	      }
	      
	      if (!is_writable($luploaddir))
			{
				@chmod($luploaddir, 0777);
			}
			
		unset($luploaddir);	
		  		
      //on verifie que le fichier soit bien uploader pour des questions de securite
      	if (is_uploaded_file($_FILES[$pparam_name]['tmp_name'])) 
      	{
      		if (move_uploaded_file($_FILES[$pparam_name]['tmp_name'] , $lnom_fic));
      		else 
      		{
      			$this->state = "error_move_file";
      			unset($lnom_fic);
      			
      			return false;
      		}
      	}
      	else 
  		{
  			$this->state = "file_wasnt_uploaded";
  			unset($lnom_fic);
  			return false;
  		}
      	
      	
      	$this->chemin_acces = basename($lnom_fic);
      	
      	unset($lnom_fic);
      	return true;

	}
	else 
	{   //die('non');
		$this->state = "nofileexists";
		return false;
	}
  }
  
  //Autres méthodes de la classe
	public function create(){
		
		$retvalue = false;

		$req = "insert into numerique (numdoc , libfich , dateimport, heureimport, archive , numform )
		values( ?, ?, ?, ?, ?, ? )";

		$lparam_type=array();
		$lparam_type[]="integer";
		$lparam_type[]="text";
		$lparam_type[]="text";
		$lparam_type[]="text";
		$lparam_type[]="integer";
		$lparam_type[]="integer";

		$lparam_data=array();
		$lparam_data[]=$this->numdoc;
		$lparam_data[]=trim($this->libfich);
		$lparam_data[]= date("d/m/Y");
		$lparam_data[]= date("H:m:s");
		$lparam_data[]=0;
        $lparam_data[]=trim($this->numform);


		$this->connect_db();
		if (!$this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type))){
			if (!$this->db->isError ($result = $lprepare->Execute($lparam_data))){

				$retvalue =  true;

			}
			else {
				$this->exception = "numerique::create() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = false;
			}
		}
		else {
			$this->exception = "numerique::create() - ".$lprepare->getMessage() . ' in ' . $req;
			$retvalue = false;
		}
		$this->db->disconnect();
		return $retvalue;
	}
	
	public function archiver (){
		$bool=false; 
		$this->exception = "";
					  
		//initialisation du tableau de paramètres formels
		$lparam_type = array();
		//initialisation du tableau de paramètres effectifs pour la requête
		$lparam_data = array();
		  
  	    $lparam_type[] = "integer";

		$sql = 'update numerique set archive =  1 where numdoc = ? ';
		       
		$this->connect_db();
		if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))	{
			$lparam_data[] = intval($this->numdoc);
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))	{
				$bool=true;
			}
			else {
				$this->exception = "document::archiver() - ".$result->getMessage() . ' in ' . $sql;
				$bool = false;
			}
		}
		else {
			$this->exception = "document::archiver() - ".$lprepare->getMessage() . ' in ' . $sql;
			$bool = false;
		}
		$this->db->disconnect();

		return $bool;
	}
  
 	public function charger()
 	{
		$retvalue = array();
		$lparam_data = array();
		$lparam_type = array();

	  $req = "select N.numdoc, N.libfich, N.dateimport, N.heureimport , N.archive, N.numform
	   , u.codeuser , u.nomuser, u.prenomuser
	   from numerique N 
	   left outer join document d on N.numform = d.numdoc
	   left outer join utilisateur u on d.codeuser = u.codeuser ";
	  $lwhere = " where (not N.numdoc is null) ";
	  $land = "";

      if (trim($this->numdoc) != "")
	  {
	  	$land .= " and N.numdoc = ? ";
	  	$lparam_type[] = "integer";
	  	$lparam_data[] = $this->numdoc;
	  }
	  		
	   $req .= $lwhere . $land ;
		//die($this->redraw_sql($req , $lparam_data , $lparam_type));
	   $this->connect_db();
	   if (! $this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				$lrow = $result->FetchRow();
				
				//Transformer les noms de colonnes en champ de l'objet document en cours
				foreach ($lrow as $lchamp => $lvaleur)
				{
					$this->$lchamp = $lvaleur;
				}
				$this->chemin_acces = $this->libfich;
				$retvalue =  true;	//chargement effectué avec succès
				
				//libérer la mémoire
				unset($lchamp);
				unset($lvaleur);
			}
			else 
			{
				$this->exception = "numerique::charger() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = false;
			}
		}
		else 
		{
			$this->exception = "numerique::charger() - ".$lprepare->getMessage() . ' in ' . $req; 
			$retvalue = false;
		}

		//libérer la mémoire
		unset($lparam_data);
		unset($lparam_type);
		unset($req);
		unset($result);
		
		$this->db->disconnect();
		return $retvalue;
	}


    public function generer_numero()
	{

		$this->exception = "";
		$retvalue = -1;
		$lparam_type = array();
		$lparam_data = array();

		$req = " select max(numdoc) as nbr_max from numerique ";

		$this->connect_db();
		if (! $this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{

				if ($result->valid())  //vérifie s'il ya au moins une ligne dans le résultat
				{

					$obj2 = $result->FetchRow();
					$retvalue = $obj2["nbr_max"] + 1;
				}
				else
				{
					$retvalue = -1;
				}
			}
			else
			{
				$this->exception = "numerique::generer_numero() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = -1;
			}
		}
		else
		{
			$this->exception = "numerique::generer_numero() - ".$lprepare->getMessage() . ' in ' . $req;
			$retvalue = -1;
		}
		$this->db->disconnect();

		unset($lprepare);
		unset($result);
		unset($lparam_data);
		unset($lparam_type);
		unset($lsql);
		unset($Found);
		unset($lCode);
		unset($i);
		unset($max);

		return $retvalue;

	}
}
?>