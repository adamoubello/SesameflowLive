<?php
/**
 * @version			1.0
 * @package			GED
 * @subpackage		Données
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			William<william.nkingne@laposte.net>
 * @desc			Spécification d'une donnée enregistrée par formulaire
 * @creationdate	lundi 29 juin 2009 
 */

$chemin = dirname(__FILE__);
$chemin = str_replace("\ged\classe","",$chemin);
require_once($chemin.'\classe\application.class.php');
$siteweb = new Application();


require_once($siteweb->get_document_root().'\classe\table.class.php');
ini_set('include_path', $siteweb->get_document_root().'\includes\pear');	//charger les packages de PEAR::MDB2


class Donnee extends Table {
	public $numdonnees;
	
	public $numchamp;
	public $datemodif;
	public $heuremodif;
	public $valeurdonnee;
	
	public function __construct()
	{
		$this->init();
	}
	
	public function get_numchamp (){
		return $this->numchamp;
	}
	
	public function getValeurdonnee (){
		return $this->valeurdonnee;
	}
	
	public function get_date_modification (){
		return $this->datemodif;
	}
	
	public function setDatemodif (){
		$this->datemodif=date("d/m/Y");
	}
	
	public function setHeuremodif (){
		$this->heuremodif=date("h:m:s");
	}
	
	public function setNumchamp ($valeur){
		$this->numchamp=$valeur;
	}
	
	public function setValeurdonnee ($valeur){
		$this->valeurdonnee=$valeur;
	}	
	
	public function create(){
		
		$retvalue = false;

		$req = "insert into donnee (numchamp , datemodif , heuremodif , valeurdonnee) values( ? , ? , ? , ?)";
		
		$lparam_type=array();
		$lparam_type[]="integer";
		$lparam_type[]="date";
		$lparam_type[]="text";
		$lparam_type[]="text";
		
		$lparam_data=array();
		$lparam_data[]= intval($this->numchamp);
		$lparam_data[]= $this->format_date2database(trim($this->datemodif));
		$lparam_data[]= trim($this->heuremodif);
		$lparam_data[]=trim($this->valeurdonnes);
		$lparam_data[]=trim(strval($this->valeurdonnee));
		
		$this->connect_db();
		if (!$this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type))){
			if (!$this->db->isError ($result = $lprepare->Execute($lparam_data))){

				$retvalue =  true;
				
			}
			else {
				$this->exception = "donnee::create() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = false;
			}
		}
		else {
			$this->exception = "donnee::create() - ".$lprepare->getMessage() . ' in ' . $req;
			$retvalue = false;
		}
		$this->db->disconnect();
		return $retvalue;
	}
	
	
 	public function rechercher()
 	{
      $retvalue = array();
	  
	  $lselect = "select d.numchamp,c.nomchamp,c.typechamp,c.numdoc,c.valeurdonnee ";
	  $lfrom = " from donnee d
	  inner join champ c on d.numchamp = c.numchamp  ";
	  $lwhere = " where not d.numchamp is null ";
	  $land = "";
	  
	  $lparam_type = array();
	  $lparam_data = array();
	  
	  if (trim($this->numdoc) != "")
	  {
	  	$land .= " and c.numdoc = ? ";
	  	$lparam_type[] = "integer";
	  	$lparam_data[] = $this->numdoc;
	  }
	  
	  $req = $lselect . $lfrom;
	  $req .= $lwhere . $land ;
	  
	  $this->connect_db();
	 
	  if (! $this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
    			if ($result->valid())  
				{
					$retvalue =  $result->FetchAll();
				}
				else 
				{
					$retvalue = null;
				}
			}
			else 
			{
				$this->exception = "donnee::rechercher() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = null;
			}
		}
		else 
		{
			$this->exception = "donnee::rechercher() - ".$lprepare->getMessage() . ' in ' . $req;
			$retvalue = null;
		}
		
	    $this->db->disconnect(); 
		return $retvalue ;
 }
}
?>