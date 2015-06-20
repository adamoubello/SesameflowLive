<?php
/**
 * @version			1.0
 * @package			GED
 * @subpackage		Etiquette
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			patrick mveng<patrick.mveng@interfacesa.local>
 * @desc			Spécification d'une étiquette , mot-clé associé à un document
 * @creationdate	samedi 05 juillet 2009 
 */

class Etiquette extends Document {
	public $tag;	
	public $frequence;
	public $numdoc;
	
	public function get_tag (){
		return $this->tag;
	}
	
	public function get_numero_document (){
		return $this->numdoc;
	}
	
	public function get_frequence (){
		return $this->frequence;
	}
	
	public function set_tag ($valeur){
		$this->tag=$valeur;
	}
	
	public function set_frequence ($valeur){
		$this->frequence=$valeur;
	}
	
	public function set_numero_document ($valeur){
		$this->numdoc=$valeur;
	}
	
	public function ajouter(){
		
		$retvalue = false;

		$req = "insert into etiquette (tag , freq , numdoc) values( ? , ? , ?)";

		$lparam_type=array();
		$lparam_type[]="text";
		$lparam_type[]="float";
		$lparam_type[]="integer";

		$lparam_data=array();
		$lparam_data[]=$this->tag;
		$lparam_data[]=floatval($this->frequence);
		$lparam_data[]=intval($this->numdoc);
		
		$this->connect_db();
		if (!$this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type))){
			if (!$this->db->isError ($result = $lprepare->Execute($lparam_data))){ 

				$retvalue =  true;

			}
			else {
				$this->exception = "etiquette::ajouter() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = false;
			}
		}
		else {
			$this->exception = "etiquette::ajouter() - ".$lprepare->getMessage() . ' in ' . $req;
			$retvalue = false;
		}
		$this->db->disconnect();
		return $retvalue;
	}

	public function rechercher()
	{
		
	}
}
?>