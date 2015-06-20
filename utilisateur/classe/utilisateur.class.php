<?php
/**
 * @version			1.0
 * @package			Utilisateur
 * @subpackage		Utilisateur
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Bello Adamou <moustaphbi@yahoo.fr>
 * @desc			Spécification d'un utilisateur, un acteur du système de workflow
 * @creationdate	????
 * @updates
 * 	# samedi 20 juin 2009 (Patrick Mveng)
 * 		- suppression de la fonction init()
 *  # mardi 30 juin 2009 by patrick mveng <patrick.mveng@interfacesa.local>
 * 		- ajout de la méthode générer_numero()
 *  # samedi juillet 2004 by patrick mveng <patrick.mveng@interfacesa.local>
 * 		- surcharge de la méthode charger par ajout du critère $loginuser
 */
  
 $siteweb = new Application();
 require_once($siteweb->get_document_root().'\classe\table.class.php');
   
class Utilisateur extends Table
{
	public  $codeuser;	

	function __construct()
	{
		parent::init();
	}

 /**
  * fonction qui ajoute un utilisateur dans la BD
  *
  * @return unknown
  */
 public function ajouter()
 {
      $bool=false; 
 	  $this->exception = "";
	  
	  //initialisation du tableau de paramètres formels et effectifs pour la requête
	  $lparam_type = array();
      $lparam_data = array();

		 $sql = 'insert into utilisateur values( ? , ?, ? , ? , ? , ? , ? , ?, ? , ?, ? , ? , ? , ? , ? , ? , ?)';
		 $lparam_type[] = "integer"; 
		 $lparam_type[] = "text"; 
		 $lparam_type[] = "text"; 
		 $lparam_type[] = "text"; 
		 $lparam_type[] = "text"; 
		 $lparam_type[] = "text"; 
		 $lparam_type[] = "text"; 
		 $lparam_type[] = "text"; 
		 $lparam_type[] = "text"; 
		 $lparam_type[] = "date"; 
		 $lparam_type[] = "text"; 
		 $lparam_type[] = "integer"; 
		 $lparam_type[] = "text"; 
		 $lparam_type[] = "text"; 
		 $lparam_type[] = "integer"; 
		 $lparam_type[] = "integer"; 
		 $lparam_type[] = "integer"; 
		 
			  
			  $this->connect_db();
			  if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
			  {	
					$lparam_data[] = intval($this->codeuser);
					$lparam_data[] = trim($this->nomuser);
					$lparam_data[] = trim($this->prenomuser);
					$lparam_data[] = trim($this->emailuser);
					$lparam_data[] = trim($this->loginuser);
					$lparam_data[] = trim($this->passworduser);
					$lparam_data[] = trim($this->numteluser);
					$lparam_data[] = trim($this->numburuser);
					$lparam_data[] = trim($this->numfaxuser);
					$lparam_data[] = $this->format_date2database(trim($this->datenaissanceuser));
					$lparam_data[] = trim($this->typeuser);
					$lparam_data[] = intval($this->codegroup);
					$lparam_data[] = trim($this->villeuser);
					$lparam_data[] = trim($this->paysuser);
					$lparam_data[] = intval($this->codedep);
					$lparam_data[] = intval($this->codeprofil);
					$lparam_data[] = 0;
					
					//print_r($this);
					//die($this->redraw_sql($sql , $lparam_data , $lparam_type));
					if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
					{
						$bool = true;
					}
					else 
					{
						$this->exception = "utilisateur::ajouter() - ".$result->getMessage() . ' in ' . $sql;
						$bool=false;
					}
				}
				else 
				{
					$this->exception = "utilisateur::ajouter() - ".$lprepare->getMessage() . ' in ' . $sql;
					$bool=false;
				}
			   		
		$this->db->disconnect();
		return $bool;
}
	
	
	/**
	 * fonction de génération d'un nouveau numéro utilisateur
 	 * @access 		:	public
	 * @author 		:	patrick mveng<patrick.mveng@interfacesa.local>
	 * @return -1 si erreur, sinon un nouveau numéro entier
	 */
	public function generer_numero()
	{
		$this->exception = "";
		$retvalue = -1;
		$lparam_type = array();
		$lparam_data = array();
		
		$req = " select max(codeuser) as code_max from utilisateur ";		
		
		$this->connect_db();
		if (! $this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				if ($result->valid())  //vérifie s'il ya au moins une ligne dans le résultat
				{
					$obj2 = $result->FetchRow();
					$retvalue = $obj2["code_max"] + 1;
				}
				else 
				{
					$retvalue = -1;
				}
			}
			else 
			{
				$this->exception = "utilisateur::generer_numero() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = -1;
			}
		}
		else 
		{
			$this->exception = "utilisateur::generer_numero() - ".$lprepare->getMessage() . ' in ' . $req;
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
	


 public function get_profil()
 { 
 	  $retvalue = array();
	  
	  //initialisation du tableau de paramètres formels et effectifs pour la requête
	  $lparam_type = array();
	  $lparam_data = array();
	  
	  $req = " select u.codeprofil , p.libprofil
	  from utilisateur u 
	  left outer join profil p on u.codeprofil = p.codeprofil ";
	  $lwhere = " where ( not u.codeuser is null) ";
	  $land = "";
	  
	  if (trim($this->codeuser) != "")
	  {
	  	$land .= " and u.codeuser = ? ";
	  	$lparam_type = "integer";
	  	$lparam_data = $this->codeuser;	
	  }
	  
	  if (trim($this->loginuser) != "")
	  {
	  	$land .= " and u.loginuser = ? ";
	  	$lparam_type = "text";
	  	$lparam_data = $this->loginuser;	
	  }		
	  
	  $req .= $lwhere . $land ;
	  
	   $this->connect_db();
	   if (! $this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				$lrow = $result->FetchRow();
				
				//Transformer les noms de colonnes en champ de l'objet utilisateur en cours
				foreach ($lrow as $lchamp => $lvaleur)
				{
				$this->$lchamp = $lvaleur;
				}
				$retvalue =  true;	//chargement effectué avec succès
				
				//libérer la mémoire
				unset($lchamp);
				unset($lvaleur);
			}
			else 
			{
			$this->exception = "utilisateur::charger() - ".$result->getMessage() . ' in ' . $req;
			$retvalue = false;
			}
		}
		else 
		{
			$this->exception = "utilisateur::charger() - ".$lprepare->getMessage() . ' in ' . $req; 
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
	
	
	/**
	 * fonction qui retourne une liste déroulante d'utilisateurs
	 * @author 	:	patrick mveng<patrick.mveng@interfacesa.local>
	 * @param array $pattributes	- attributs de la balise select
	 * @param string $pdefault - valeur de l'option à afficher par défaut
	 * @param string -  $pchoisissez - message
	 * @return string - code HTML de la liste déroulante
	 */
	function liste_deroulante($pattributes , $pdefault = null , $pchoisissez = null)
	{
		$this->exception = "";
		
		$list = $this->select_ouvrante_tag($pattributes);
		$list .= "<option value=\"\">$pchoisissez</option>\n";
		if (! is_null($this->listeuser))
		{
			foreach($this->listeuser as $obj)
			{
				if (trim($obj["codeuser"]) != "")
				{
					$list .= "<option value=\"".$obj['codeuser']."\"";
					if ((trim(strval($pdefault)) == trim(strval($obj['nomuser'])) ))
					{
					$list .= " selected";
					}
					$list .= ">".$obj["nomuser"]." ".$obj["prenomuser"]."</option>\n";
				}
			}
		}
		$list .= "</select>\n";
		
		//libérer la mémoire
		unset($obj);
		
		return $list;
	}
	
	
 public function login($id , $pwd)
 {
      $retvalue = false;
	  
	  //initialisation du tableau de paramètres formels et effectifs pour la requête
	  $lparam_type = array();
	  $lparam_data = array();
	 
	  $req = " select loginuser,passworduser from utilisateur where loginuser = ? and passworduser=  ? ";
	  
	  $lparam_type[] = "text";
	  $lparam_type[] = "text";
	  $lparam_data[] = $id;
	  $lparam_data[] = $pwd;
	  
	  $this->connect_db();
	  if (! $this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				
				if ($result->valid())  //vérifie s'il ya au moins une ligne dans le résultat
				{
					$retvalue =  $result->FetchAll();	
				}
				else 
				{
					$retvalue = false;
				}
			}
			else 
			{
				$this->exception = "utilisateur::login() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = false;
			}
		}
		else 
		{
			$this->exception = "utilisateur::login() - ".$lprepare->getMessage() . ' in ' . $req;
			$retvalue = false;
		}
	    $this->db->disconnect();
		return $retvalue;
}
 
 
 public function rechercher()
 {
      $retvalue = array();
	  $req = "select codeuser,nomuser,prenomuser,emailuser,loginuser,passworduser,numteluser,numburuser,numfaxuser
	  ,datenaissanceuser,typeuser,villeuser,paysuser,user.codedep,user.codeprofil , user.codegroup, g.libgroup, dep.libdep
	  , prof.libprofil
	  from utilisateur user
	  inner join groupe g on user.codegroup = g.codegroup 
	  left outer join departement dep on user.codedep = dep.codedep
	  left outer join profil prof on user.codeprofil = prof.codeprofil
	  ";
	  $lwhere = " where ( not user.codeuser is null) ";
	  $land = "";
	  
	  //initialisation du tableau de paramètres formels et effectifs pour la requête
	  $lparam_type = array();
	  $lparam_data = array();
	  	  
	  if (trim($this->nomuser) != "")
	  {
	  	switch(intval($this->sel_option_nomuser))
		{
			case 0:	//cas "commencant par "
				  	$land .= " and nomuser like ? ";
				  	$lparam_data[] = trim($this->nomuser)."%";
					$lparam_type[] = "text";				
				break;
			case 1:	//cas "contient "
				  	$land .= " and nomuser like ? ";
				  	$lparam_data[] = "%".trim($this->nomuser)."%";
					$lparam_type[] = "text";				
				break;				
			case 3:	//cas "finissant par "
			  	    $land .= " and nomuser like ? ";
			  	    $lparam_data[] = "%".trim($this->nomuser);
					$lparam_type[] = "text";				
				break;
			case 4:	//cas "est égal à"
				  	$land .= " and nomuser = ? ";	
				  	$lparam_data[] = trim($this->nomuser);
					$lparam_type[] = "text";						
				break;
		}

	  }
	  
	  if (trim($this->codedep) != "")
	  {
	  	$land .= " and user.codedep = ? ";
		$lparam_data[] = $this->codedep;
		$lparam_type[] = "integer";				
	  }
	  
	  if (trim($this->codeprofil) != "")
	  {
	  	$land .= " and user.codeprofil = ? ";
		$lparam_data[] = $this->codeprofil;
		$lparam_type[] = "integer";				
	  }

	  
	  if (trim($this->codegroup) != "")
	  {
	  	$land .= " and user.codegroup = ? ";
		$lparam_data[] = intval($this->codegroup);
		$lparam_type[] = "integer";				
	  }
	  
	  if (trim($this->prenomuser) != "")
	  {
	  	switch(intval($this->sel_option_prenomuser))
		{
			case 0:	//cas "commencant par "
				  	$land .= " and prenomuser like '" . $this->prenomuser . "%'";
				break;
			case 1:	//cas "contient "
				  	$land .= " and prenomuser like '%" . $this->prenomuser . "%'";
				break;				
			case 3:	//cas "finissant par "
			  	    $land .= " and prenomuser like '%" . $this->prenomuser . "'";
				break;
			case 4:	//cas "est égal à"
				  	$land .= " and prenomuser = '" . $this->prenomuser . "'";			
				break;
		}

	  }
	  
	  //Rechercher par le critère de l'email
	 if (trim($this->emailuser) != "")
	  {
	  	switch(intval($this->sel_option_emailuser))
		{
			case 0:	//cas "commencant par "
				  	$land .= " and emailuser like ? ";
				  	$lparam_data[] = trim($this->emailuser)."%";
					$lparam_type[] = "text";								
				break;
			case 1:	//cas "contient "
				  	$land .= " and emailuser like  ? ";
				  	$lparam_data[] = "%".trim($this->emailuser)."%";
					$lparam_type[] = "text";								
				break;				
			case 3:	//cas "finissant par "
			  	    $land .= " and eamailuser like ? ";
			  	    $lparam_data[] = "%".trim($this->emailuser);
					$lparam_type[] = "text";								
				break;
			case 4:	//cas "est égal à"
				  	$land .= " and emailuser = ? ";	
				  	$lparam_data[] = trim($this->emailuser);
					$lparam_type[] = "text";								
				break;
		}

	  }
	   
	  if (trim($this->loginuser) != "")
	  {
	  	switch(intval($this->sel_option_loginuser))
		{
			case 0:	//cas "commencant par "
				  	$land .= " and loginuser like '" . $this->loginuser . "%'";
				break;
			case 1:	//cas "contient "
				  	$land .= " and loginuser like '%" . $this->loginuser . "%'";
				break;				
			case 3:	//cas "finissant par "
			  	    $land .= " and loginuser like '%" . $this->loginuser . "'";
				break;
			case 4:	//cas "est égal à"
				  	$land .= " and loginuser = '" . $this->loginuser . "'";			
				break;
		}

	  }
	  
	  if (trim($this->sel_option_typeuser) != "")
	  {
	   switch(intval($this->sel_option_typeuser))
		{
			case 0:	//cas "recepteur "
				  	$land .= " and typeuser = '" . $this->sel_option_typeuser= "recepteur" . "'";
				break;
			case 1:	//cas "validateur "
				  	$land .= " and typeuser = '" . $this->sel_option_typeuser= "validateur" . "'";
				break;				
			case 2:	//cas "emetteur "
			  	    $land .= " and typeuser = '" . $this->sel_option_typeuser= "emetteur" . "'";
				break;
		}
		  
	  }
	  
	  if (trim($this->connected) != "")
	  {
	  		$land .= " and connected = ? ";
	  		$lparam_type[] = "integer";
	  		$lparam_data[] = intval($this->connected);
	  }
	  	  
	   $req .= $lwhere . $land ;
	   
	   //die($this->redraw_sql($req , $lparam_data , $lparam_type));
	   $this->connect_db();
	   if (! $this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				
				if ($result->valid())  //vérifie s'il y a au moins une ligne dans le résultat
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
				$this->exception = "utilisateur::rechercher() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = null;
			}
		}
		else 
		{
			$this->exception = "utilisateur::rechercher() - ".$lprepare->getMessage() . ' in ' . $req;
			$retvalue = null;
		}
	    $this->db->disconnect();
	  	return $retvalue;			
 }


public function modifier()
 {
      $bool=false; 
 	  $retvalue = array();
	 
	  //initialisation du tableau de paramètres formels et effectifs pour la requête
	  $lparam_type = array();
	  $lparam_data = array();
	  
  
	 $sql = " update utilisateur set 
	 	nomuser = ?
	 	, prenomuser = ?
	 	, emailuser = ?
	 	, loginuser = ?
	 	, passworduser = ?
	 	, numteluser = ?
	 	, numburuser = ?
	 	, numfaxuser = ?
	 	, datenaissanceuser = ?
	 	, codegroup = ?
	 	, villeuser = ?
	 	, paysuser = ?
	 	, codedep = ?
	 	, codeprofil = ?
	  where codeuser = ? ";
	 
		 $lparam_type[] = "text"; 
		 $lparam_type[] = "text"; 
		 $lparam_type[] = "text"; 
		 $lparam_type[] = "text"; 
		 $lparam_type[] = "text"; 
		 $lparam_type[] = "text"; 
		 $lparam_type[] = "text"; 
		 $lparam_type[] = "text"; 
		 $lparam_type[] = "date"; 
		 $lparam_type[] = "text"; 
		 $lparam_type[] = "text"; 
		 $lparam_type[] = "text"; 
		 $lparam_type[] = "integer"; 
		 $lparam_type[] = "integer"; 
		 $lparam_type[] = "integer"; 
		 
		$lparam_data[] = trim($this->nomuser);
		$lparam_data[] = trim($this->prenomuser);
		$lparam_data[] = trim($this->emailuser);
		$lparam_data[] = trim($this->loginuser);
		$lparam_data[] = trim($this->passworduser);
		$lparam_data[] = trim($this->numteluser);
		$lparam_data[] = trim($this->numburuser);
		$lparam_data[] = trim($this->numfaxuser);
		$lparam_data[] = $this->format_date2database(trim($this->datenaissanceuser));
		$lparam_data[] = intval($this->codegroup);
		$lparam_data[] = trim($this->villeuser);
		$lparam_data[] = trim($this->paysuser);
		$lparam_data[] = intval($this->codedep);
		$lparam_data[] = intval($this->codeprofil);
		$lparam_data[] = intval($this->codeuser);
			
	   $this->connect_db();
	   //die($this->redraw_sql($sql , $lparam_data , $lparam_type));
	   if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				
				$bool = true;
			}
			else 
			{
				$this->exception = "utilisateur::modifier() - " .$result->getMessage() . ' in ' . $req;
				$retvalue = null;
			}
		}
		else 
		{
			$this->exception = "utilisateur::modifier() - " .$lprepare->getMessage() . ' in ' . $req;
			$retvalue = null;
		}
	   $bool=true;
 
		$this->db->disconnect(); 
		return $bool;
}


 public function charger()
 { 
 	  $retvalue = array();
	  
	  //initialisation du tableau de paramètres formels et effectifs pour la requête
	  $lparam_type = array();
	  $lparam_data = array();
	  
	  $req = " select codeuser,nomuser,prenomuser,emailuser,loginuser,passworduser,numteluser,numburuser,numfaxuser
	  ,datenaissanceuser,typeuser,codegroup,villeuser,paysuser,codedep,codeprofil
	  from utilisateur ";
	  $lwhere = " where not codeuser is null ";
	  $land = "";
	  
	  //$land .= " and codeuser = '" . $this->codeuser . "'"; 
	  if (trim($this->codeuser) != "")
	  {
	  	$land .= " and codeuser = ? ";
	  	$lparam_type = "integer";
	  	$lparam_data = $this->codeuser;	
	  }
	  
	  if (trim($this->loginuser) != "")
	  {
	  	$land .= " and loginuser = ? ";
	  	$lparam_type = "text";
	  	$lparam_data = $this->loginuser;	
	  }		
	  
	  $req .= $lwhere . $land ;
	  //die($this->redraw_sql($lsql , $lparam_data , $lparam_type));
	   $this->connect_db();
	   if (! $this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				$lrow = $result->FetchRow();
				
				//Transformer les noms de colonnes en champ de l'objet utilisateur en cours
				foreach ($lrow as $lchamp => $lvaleur)
				{
				$this->$lchamp = $lvaleur;
				}
				$retvalue =  true;	//chargement effectué avec succès
				
				//libérer la mémoire
				unset($lchamp);
				unset($lvaleur);
			}
			else 
			{
			$this->exception = "utilisateur::charger() - ".$result->getMessage() . ' in ' . $req;
			$retvalue = false;
			}
		}
		else 
		{
			$this->exception = "utilisateur::charger() - ".$lprepare->getMessage() . ' in ' . $req; 
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


public function rechercher_user_dep($valindex)
 {
 	  $retvalue = array();
	  
	  //initialisation du tableau de paramètres formels et effectifs pour la requête
	  $lparam_type = array();
	  $lparam_data = array();
	  
	  $req = "Select u.nom from utilisateur as u ";
	  $lwhere = " where u.codedep = ".$valindex." ";
	  $land = "";
	  $req .= $lwhere . $land ;	  
	   //die($this->redraw_sql($lsql , $lparam_data , $lparam_type));	
	   $this->connect_db();
	   if (! $this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				if ($result->valid())  //vérifie s'il ya au moins une ligne dans le résultat
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
				$this->exception = "utilisateur::rechercher_user_dep() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = null;
			}
		}
		else 
		{
			$this->exception = "utilisateur::rechercher_user_dep() - ".$lprepare->getMessage() . ' in ' . $req;
			$retvalue = null;
		}
		    return $retvalue;
 }
 
 
public function printUserSelector()  
 {  
 global $listeuser;
 $html = '<select name="user_id">';  
 
  foreach ($listeuser as $lindex => $lvaleur) 
 { 
 $html .= "<option value=\"$lindex\"> $lvaleur[1] </option>\n";  
 }  
 $html .= '</select>';  
 return $html;  
 }  
 
 	/**
	 * Enter description here...
	 * @param integer -  $pstate - statut de connectio = 1 => connected , =0 => not connected
	 * @param string -  $plogin - login d'un utilisateur
	 * @return true, si update ok, sinon false
	 */
public function set_connected($pstate = 1 , $plogin = null)
	 {
	 	  $retvalue = false;
	 	  if (trim($plogin) == "") $llogin = $this->loginuser;
	 	  else $llogin = $plogin;
		  
		  //initialisation du tableau de paramètres formels et effectifs pour la requête
		  $lparam_type = array("integer" , "text");
		  $lparam_data = array($pstate , $plogin);
		  
	      $sql = ' update utilisateur set connected = ? where loginuser = ? '; 
	       
		  $this->connect_db();
		  //die($this->redraw_sql($sql , $lparam_data , $lparam_type));
		   if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
			{
				if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
				{
					$retvalue = true;				
				}
				else 
				{
					$this->exception = "utilisateur::set_connected() - ".$result->getMessage() . ' in ' . $sql;
					$retvalue = false;
				}
			}
			else 
			{
				    $this->exception = "utilisateur::set_connected() - ".$lprepare->getMessage() . ' in ' . $sql;
				    $retvalue = false;
			}
	       $this->db->disconnect(); 
	       return $retvalue;
	}
	
	
		
public function supprimer()
	 {
	      $bool=false; 
		  $this->exception = "";
					  
		  //initialisation du tableau de paramètres formels et effectifs pour la requête
		  $lparam_type = array();
		  $lparam_data = array();
		  
		  $lparam_type[] = "integer"; 
  		  
		  $sql = 'delete from utilisateur where codeuser = ? ';
		   //   die($this->redraw_sql($sql,$lparam_data,$lparam_type); 
		   $this->connect_db();
		   if (! $this->db->isError ($lprepare = $this->db->prepare($sql , $lparam_type)))
			{
				$lparam_data[] = intval($this->codeuser);

				if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
				{
					$bool=true;
				}
				else 
				{
					$this->exception = "utilisateur::supprimer() - ".$result->getMessage() . ' in ' . $sql;
					$bool = false;
				}
			}
			else 
			{
				$this->exception = "utilisateur::supprimer() - ".$lprepare->getMessage() . ' in ' . $sql;
				$bool = false;
			}
			   
		$this->db->disconnect();
		return $bool;
	}


//Fonction qui traite l'affichage des tâches d'un utilisateur en faisant une jointure entre les tables circuit_tache et utilisateur
public function rechercher_tache_user()
 {
      $retvalue = array();
	  //initialisation du tableau de paramètres formels et effectifs pour la requête
	  $lparam_type = array();
	  $lparam_data = array();
	  
	 // $req = "select u.codeuser,u.nomuser,u.prenomuser,u.emailuser,u.loginuser,u.passworduser,u.numteluser,u.numburuser,u.numfaxuser
//	  ,u.datenaissanceuser,u.typeuser,u.villeuser,u.paysuser,u.codedep,u.codeprofil , u.codegroup, ct.numtache,ct.codeuser,ct.codecircuit,
//	  ct.codeprofil,ct.numtacheprec,ct.numtachesuiv
//	  from utilisateur user, circuit_tache ct ";
//	  $lwhere = " where ( not u.codeuser is null) ";
//	  $land = "";
	  		  
	  $req = " select codeuser,nomuser,prenomuser,emailuser,loginuser,passworduser,numteluser,numburuser,numfaxuser
	  ,datenaissanceuser,typeuser,codegroup,villeuser,paysuser,codedep,codeprofil
	  from utilisateur ";
	  $lwhere = " where not codeuser is null ";
	  $land = "";
	  
	  //$land .= " and codeuser = '" . $this->codeuser . "'"; 
	  if (trim($this->codeuser) != "")
	  {
	  	$land .= " and codeuser = ? ";
	  	$lparam_type = "integer";
	  	$lparam_data = $this->codeuser;	
	  }
	  
	  if (trim($this->loginuser) != "")
	  {
	  	$land .= " and loginuser = ? ";
	  	$lparam_type = "text";
	  	$lparam_data = $this->loginuser;	
	  }		
	  
	   $req .= $lwhere . $land ;
	  
	   $this->connect_db();
	   if (! $this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				$lrow = $result->FetchRow();
			}
			else 
			{
			$this->exception = "utilisateur::rechercher_tache_user() - ".$result->getMessage() . ' in ' . $req;
			$retvalue = false;
			}
		}
		else 
		{
			$this->exception = "utilisateur::rechercher_tache_user() - ".$lprepare->getMessage() . ' in ' . $req; 
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
	
	
public function charger_user()
 { 
 	  $retvalue = array();
	   //initialisation du tableau de paramètres formels et effectifs pour la requête
	  $lparam_type = array();
	  $lparam_data = array();
	  
	  $req = " select codeuser,nomuser,prenomuser,emailuser,loginuser,passworduser,numteluser,numburuser,numfaxuser
	  ,datenaissanceuser,typeuser,codegroup,villeuser,paysuser,codedep,codeprofil
	  from utilisateur ";
	  $lwhere = " where not codeuser is null ";
	  $land = "and codeuser = ?";
	  	  
	  	$lparam_type = "integer";
	  	$lparam_data = $this->codeuser;	
	  
	   $req .= $lwhere . $land ;
	  //die($this->redraw_sql($lsql , $lparam_data , $lparam_type));
	   
	   $this->connect_db();
	   if (! $this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				$lrow = $result->FetchRow();
				
				//Transformer les noms de colonnes en champ de l'objet utilisateur en cours
				foreach ($lrow as $lchamp => $lvaleur)
				{
				$this->$lchamp = $lvaleur;
				}
				$retvalue =  true;	//chargement effectué avec succès
				
				//libérer la mémoire
				unset($lchamp);
				unset($lvaleur);
			}
			else 
			{
			$this->exception = "utilisateur::charger_user() - ".$result->getMessage() . ' in ' . $req;
			$retvalue = false;
			}
		}
		else 
		{
			$this->exception = "utilisateur::charger_user() - ".$lprepare->getMessage() . ' in ' . $req; 
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

 public function rechercher_initiateur()
 {
      $retvalue = array();
	  $req = "select codeuser,nomuser,prenomuser,emailuser,loginuser,passworduser,numteluser,numburuser,numfaxuser
	  ,datenaissanceuser,typeuser,villeuser,paysuser
	  from utilisateur ";
	  $lwhere = " where ( not codeuser is null) ";
	  $land = " and codeuser = ? ";
	  
	  //initialisation du tableau de paramètres formels et effectifs pour la requête
	  $lparam_type = array();
	  $lparam_data = array();
	  
 	  $lparam_type = "integer";
	  $lparam_data = $this->codeuser;
      
	  $req .= $lwhere . $land ;
	   
	   //die($this->redraw_sql($req , $lparam_data , $lparam_type));
	   $this->connect_db();
	   if (! $this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				
				if ($result->valid())  //vérifie s'il y a au moins une ligne dans le résultat
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
				$this->exception = "utilisateur::rechercher() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = null;
			}
		}
		else 
		{
			$this->exception = "utilisateur::rechercher() - ".$lprepare->getMessage() . ' in ' . $req;
			$retvalue = null;
		}
	    $this->db->disconnect();
	  	return $retvalue;			
 }
 
 
 public function rechercher_userduprofil()
 {
      $retvalue = array();
	  $req = "select codeuser,nomuser,prenomuser,emailuser,loginuser,passworduser,numteluser,numburuser,numfaxuser
	  ,datenaissanceuser,typeuser,villeuser,paysuser
	  from utilisateur";
	  $lwhere = " where ( not codeuser is null) ";
	  $land = " and codeprofil = ? ";
	  
	  //initialisation du tableau de paramètres formels et effectifs pour la requête
	  $lparam_type = array();
	  $lparam_data = array();
 	  $lparam_type = "integer";
	  $lparam_data = $this->codeprofil;
      
	  $req .= $lwhere . $land ;
	   
	   //die($this->redraw_sql($req , $lparam_data , $lparam_type));
	   $this->connect_db();
	   if (! $this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
     			if ($result->valid())  //vérifie s'il y a au moins une ligne dans le résultat
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
				$this->exception = "utilisateur::rechercher_userduprofil() - ".$result->getMessage() . ' in ' . $req;
				$retvalue = null;
			}
		}
		else 
		{
			$this->exception = "utilisateur::rechercher_userduprofil() - ".$lprepare->getMessage() . ' in ' . $req;
			$retvalue = null;
		}
	    $this->db->disconnect();
	  	return $retvalue;			
 }
 
	
}

?>