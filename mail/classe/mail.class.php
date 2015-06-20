<?php

/**
 * @version			1.0
 * @package			Mail
 * @subpackage		Mail
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			Patrick Mveng
 * @desc			Spécification d'un mail
 * @creationdate	????
 * @updates
 */

require_once($siteweb->get_document_root().DS.'classe'.DS.'table.class.php');


class CMail extends Table
{

	public $code_mail;
	public $auteur_mail;
	public $sujet_mail;
	public $body_mail;
	public $date_mail;
	public $lang_mail;
	public $format_mail;
	public $list_cod_mail;

	public $mail_server;
	public $sender_email;
	public $sender_name;
	public $sendmail_path;
	public $smtp_auth;
	public $smtp_user;
	public $smtp_pwd;
	public $smtp_host;

	public $log_id;	//id de la liste d'envoi
	public $log_date;	//date d'envoi de la liste
	public $log_status;	//status d'envoi d'un mail	1 = Send, 0 = Not Send
	public $log_email;	//email de réception du mail
	public $log_nom;	//nom  de réception du mail
	public $log_prenom;	//nom  de réception du mail

	function __construct()
	{
		parent::init();
		$this->codecircuit = null;
		$this->etatprocessus = null;
		$this->est_initiale = null;
		$this->est_terminale = null;
	}

	/**
	 * accesseurs
	 */
	public function est_initiale(){return $this->est_initiale;}
	public function est_terminale(){return $this->est_terminale;}


	/**
	 * modificateurs
	 */
	public function set_terminale($petat = null){$this->est_terminale = $petat;}
	public function set_initiale($petat = null){$this->est_initiale = $petat;}



	/**
	 * fonction qui archive un mail
	 * @return unknown
	 */
	function archiver()
	{

		$this->exception = "";
		$lretval = false;

		$lparam_type = array();
		$lparam_data = array();

		$lsql = " update mail_mail set archive_mail = 1 where code_mail = ? ";

		$lparam_type = array(" integer ");

		$this->connect_db();

		if (! $this->db->isError ($lprepare = $this->db->prepare($lsql , $lparam_type)))
		{
			$lparam_data[] = intval($this->code_mail);			//$pcode_mail;

			//die($this->redraw_sql($lsql , $lparam_data , $lparam_type));

			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				$lretval = true;
			}
			else
			{
				$this->exception = "CMail::archiver() - ".$result-> getDebugInfo() . ' in ' . $lsql;
				$lretval = false;
			}
		}
		else
		{
			$this->exception = "CMail::archiver() - ".$lprepare-> getDebugInfo() . ' in ' . $lsql;
			$lretval = false;
		}

		unset($lprepare);
		unset($result);
		unset($lparam_data);
		unset($lparam_type);
		unset($lsql);

		$this->db->disconnect();
		return $lretval;
	}


	function charger_parametres()
	{
		$this->exception = "";
		$lretval = false;
		$lparam_type = array();
		$lparam_data = array();

		$lselect = " select mail_server , sender_email , sender_name , sendmail_path , smtp_auth , smtp_user , smtp_pwd , smtp_host ";
		$lfrom = "  from mail_config ";
		$land = "";	//clause and de la requete sql
		$lwhere = "";	//clause where de la requete sql

		$lsql = $lselect . $lfrom . $lwhere . $land ;

		$this->connect_db();
		//die($this->redraw_sql($lsql , $lparam_data));
		if (! $this->db->isError ($lprepare = $this->db->prepare($lsql , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				if ($result->valid())
				{
					$obj =  $result->FetchRow();
					foreach ($obj as $key => $val)
					{
						$this->$key = $val;
					}
					$lretval = true;
				}
				else
				{
					$lretval = false;
				}
			}
			else
			{
				$this->exception = "CMail::charger_parametres() - ".$result-> getDebugInfo() . ' in ' . $lsql;
				$lretval = false;
			}
		}
		else
		{
			$this->exception = "CMail::charger_parametres() - ".$lprepare-> getDebugInfo() . ' in ' . $lsql;
			$lretval = false;
		}

		unset($lprepare);
		unset($result);
		unset($lparam_data);
		unset($lparam_type);
		unset($lsql);

		$this->db->disconnect();
		return $lretval;
	}

	
	function existe_log_id()
	{

		$sql = "select log_id from mail_log where log_id = {$this->log_id} ";
		$this->connect_db();

		$result = $this->db->Query($sql);
		if ($this->db->isError($result) == false)
		{
			if ($result->FetchRow())
			{
				return true;
			}
			else return false;
		}
		else
		{
			return false;
		}

	}


	function existe_parametres()
	{
		$sql = "select mail_server from mail_config ";
		$this->connect_db();

		$result = $this->db->Query($sql);
		if ($this->db->isError($result) == false)
		{
			if ($result->FetchRow())
			{
				return true;
			}
			else return false;
		}
		else
		{
			return false;
		}

	}


	/*
	@name		:	get_next_id
	@desc		:	Calcul du code de la newsletter
	@return		:	-1 si erreur, > 0 sinon
	*/
	function get_next_log_id()
	{

		$mynum=-1;
		$sql2 = "select max(log_id) as code_max from mail_log ";

		$this->connect_db();

		if (!$this->db->isError($result2 = $this->db->Query($sql2)))
		{
			if ($result2->valid())
			{
				$obj2 = $result2->FetchRow();
				$max =  $obj2['code_max'];

				//recherche d'un index libre
				$i = 1;
				$Found = false;

				while((! $Found) and ($i <= $max))
				{
					$this->log_id = $i;
					if ($this->existe_log_id()) $i++;
					else
					{	//index libre
						$lCode = $i;
						$Found = true;
					}
				}

				//si tjrs pas trouve
				if (! $Found ) $lCode = $max + 1;

				$mynum = $lCode;
			}
		}

		return $mynum;
	}


	function historique()
	{

		$this->exception = "";
		$lretval = null;

		$lparam_type = array();
		$lparam_data = array();

		$lselect = " select log.log_id , mail.code_mail , log.log_date , log.log_heure, log.log_status, log.log_email , mail.sujet_mail ";
		$lfrom = "  from mail_log log
			      inner join mail_mail mail on log.log_id = mail.code_mail";

		$land = "";	//clause and de la requete sql
		$lwhere = " where not log.log_id  is null ";	//clause where de la requete sql
		$lorderby = "";	//clause order by de la requete sql

		if (trim($this->code_mail)) // a ton sélectionne un fabriquant de produit ?
		{//oui
			$land .= " and mail.code_mail = ? ";
			$lparam_data[] = $this->code_mail;
			$lparam_type[] = "integer";
		}

		/*	if (trim($this->lang_mail) != "")
		{
		$land .= " and news.lang_mail = ? ";
		$lparam_data[] = trim($this->lang_mail);
		$lparam_type[] = "text";
		}*/


		$lsql = $lselect . $lfrom . $lwhere . $land ;

		$this->connect_db();
		//die($this->redraw_sql($lsql , $lparam_data , $lparam_type));
		if (! $this->db->isError ($lprepare = $this->db->prepare($lsql , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{

				if ($result->valid())
				{
					$lretval =  $result->FetchAll();
				}
				else
				{
					$lretval = null;
				}
			}
			else
			{
				$this->exception = "CMail::historique() - ".$result-> getDebugInfo() . ' in ' . $lsql;
				$lretval = null;
			}
		}
		else
		{
			$this->exception = "CMail::historique() - ".$lprepare-> getDebugInfo() . ' in ' . $lsql;
			$lretval = null;
		}


		unset($lprepare);
		unset($result);
		unset($lparam_data);
		unset($lparam_type);
		unset($lsql);

		return $lretval;
	}



	function update_mail_status($pstatut_mail)
	{

		$this->exception = "";
		$lretval = false;

		$lparam_type = array();
		$lparam_data = array();

		$lsql = " update mail_mail set statut_mail = ? where code_mail = ? ";

		$lparam_type = array(" integer " ," integer ");

		$this->connect_db();

		if (! $this->db->isError ($lprepare = $this->db->prepare($lsql , $lparam_type)))
		{

			$lparam_data[] = intval($pstatut_mail);
			$lparam_data[] = intval($this->code_mail);			//$pcode_mail;


			//die($this->redraw_sql($lsql , $lparam_data , $lparam_type));

			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{

				$lretval = true;
			}
			else
			{
				$this->exception = "CMail::update_mail_status() - ".$result-> getDebugInfo() . ' in ' . $lsql;
				$lretval = false;
			}
		}
		else
		{
			$this->exception = "CMail::update_mail_status() - ".$lprepare-> getDebugInfo() . ' in ' . $lsql;
			$lretval = false;
		}


		unset($lprepare);
		unset($result);
		unset($lparam_data);
		unset($lparam_type);
		unset($lsql);

		$this->db->disconnect();

		return $lretval;
	}


	/**
	 * fonction de génération d'un nouveau numéro de tâche
 	 * @access 		:	public
	 * @author 		:	patrick mveng<patrick.mveng@interfacesa.local>
	 * @param 		:	boolean - $psysteme - définit si la tache est système ou non
	 * 					Une tache système est une tache prédéfinie et réutilisable dans plusieurs procsssus. Leur numtache est < -1
	 * @return -1 si erreur, sinon un nouveau numéro entier
	 */
	public function generer_numero()
	{
		$this->exception = "";
		$retvalue = -1;
		$lparam_type = array();
		$lparam_data = array();

		$func = "max";
		$req = " select {$func}(code_mail) as code_max from mail_mail ";

		$this->connect_db();
		if (! $this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				if ($result->valid())  //vérifie s'il ya au moins une ligne dans le résultat
				{
					$obj2 = $result->FetchRow();
					if ($psysteme == true)  $retvalue = $obj2["code_max"] - 1;
					else $retvalue = $obj2["code_max"] + 1;
				}
				else
				{
					$retvalue = -1;
				}
			}
			else
			{
				$this->exception = "CMail::generer_numero() - ".$result-> getDebugInfo() . ' in ' . $req;
				$retvalue = -1;
			}
		}
		else
		{
			$this->exception = "CMail::generer_numero() - ".$lprepare-> getDebugInfo() . ' in ' . $req;
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

	/**
	 * fonction qui retourne une liste déroulante des taches
	 * @author 	:	patrick mveng<patrick.mveng@interfacesa.local>
	 * @param array $pattributes	- attributs de la balise select
	 * @param string $pdefault - valeur de l'option à afficher par défaut
	 * @param string -  $pchoisissez - message
	 * @return string - code HTML de la liste déroulante
	 */
	function liste_deroulante($pattributes , $pdefault = null , $pchoisissez = null)
	{
		global $translate;

		$this->exception = "";

		$list = $this->select_ouvrante_tag($pattributes);
		$list .= "<option value=\"\">$pchoisissez</option>\n";
		if (! is_null($this->listetache))
		{
			foreach($this->listetache as $obj)
			{
				if (trim($obj["libtache"]) != "")
				{
					$list .= "<option value=\"".$obj['numtache']."\"";
					if ((trim(strval($pdefault)) == trim(strval($obj['numtache'])) ))
					{
						$list .= " selected";
					}
					$list .= ">".$obj["libtache"]."</option>\n";
				}
			}
		}
		$list .= "</select>\n";

		//libérer la mémoire
		unset($obj);

		return $list;
	}

	/**
	 * *
	 * fonction qui ajoute un log de mail dans la base de données
	 * @return unknown
	 */
	function log()
	{

		$this->exception = "";
		$lretval = false;

		$lparam_type = array();
		$lparam_data = array();

		$lsql = " insert into mail_log ( log_id , log_date , log_heure ,  log_status , log_email )
		values ( ?, ? , ? , ? , ?   ) 
		";

		$lparam_type = array("integer" , "date" , "text" , "integer" , "text" );

		$this->connect_db();

		if (! $this->db->isError ($lprepare = $this->db->prepare($lsql , $lparam_type)))
		{

			$lparam_data[] = intval($this->log_id);
			$lparam_data[] = $this->format_date2database($this->log_date);
			$lparam_data[] = $this->log_heure;
			$lparam_data[] = (trim($this->log_status) == "") ? 0 : intval($this->log_status);
			$lparam_data[] = $this->log_email;

			//die($this->redraw_sql($lsql , $lparam_data , $lparam_type));
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{

				$lretval = true;
			}
			else
			{
				$this->exception = "mail::log() - ".$result-> getDebugInfo() . ' in ' . $lsql;
				$lretval = false;
			}
		}
		else
		{
			$this->exception = "mail::log() - ".$lprepare-> getDebugInfo() . ' in ' . $lsql;
			$lretval = false;
		}


		unset($lprepare);
		unset($result);
		unset($lparam_data);
		unset($lparam_type);
		unset($lsql);

		return $lretval;
	}

	/**
 * fonction de modification d'une tâche dans la BD
 * @author 	:	patrick mveng<patrick.mveng@interfacesa.local>
 * @return true si modification ok, false sinon
 */
	public function modifier()
	{
		$bool=false;
		$this->exception = "";

		//initialisation du tableau de paramètres formels et effectifs pour la requête
		$lparam_type = array();
		$lparam_data = array();

		$lparam_type[] = "text";
		$lparam_type[] = "text";
		$lparam_type[] = "integer";
		$lparam_type[] = "integer";

		$lsql = 'update mail_mail  set   sujet_mail =  ? , body_mail = ? , format_mail = ?   where code_mail = ? ';

		//die($this->redraw_sql($lsql , $lparam_data));

		$this->connect_db();
		if (! $this->db->isError ($lprepare = $this->db->prepare($lsql , $lparam_type)))
		{

			$lparam_data[] = trim($this->sujet_mail);
			$lparam_data[] = trim($this->body_mail);
			$lparam_data[] = ($this->format_mail);
			$lparam_data[] = intval($this->code_mail);

			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				$bool=true;
			}
			else
			{
				$this->exception = "CMail::modifier() - ".$result-> getDebugInfo() . ' in ' . $sql;
				$bool = false;
			}
		}
		else
		{
			$this->exception = "CMail::modifier() - ".$lprepare-> getDebugInfo() . ' in ' . $sql;
			$bool = false;
		}

		$this->db->disconnect();
		return $bool;
	}

	/**
	 * fonction de recherche des taches dans la base de données suivant certains critères. les critères de recheche sont passés dans 
	 * les attributs de la classe en cours
	 *
	 * @param 	string $this->codecircuit - avec ce critère, on retourne toutes les tâches appartenat à un circuit. Avec ce critère, on
	 * 			vide l'ancienne requete $req et on créé une nouvelle requete qui fait à partir de la table circuit_tache , des inner join sur tache, processus , circuit 
	 * 			et des outer join sur profil , utilisateur, tache as tachprec , tache as tachsuiv
	 * @return Array si exécution aec succès, false sinon. Dans ce dernier cas, $this->exception contient le message d'erreur
	 * 
	 */
	public function rechercher()
	{
		$retvalue = array();
		$lselect = " select mail.code_mail , mail.sujet_mail , mail.body_mail , mail.format_mail , mail.archive_mail
	  , mail.statut_mail , mail.auteur_mail , mail.date_mail ";
		$lfrom = " from mail_mail mail ";
		$lwhere= " where (not mail.code_mail is null) ";
		$land = "";
		//$lorderby = " order by sujet_mail  ";

		//initialisation du tableau de paramètres formels et effectifs pour la requête
		$lparam_type = array();
		$lparam_data = array();

		//Rechercher par le sujet
		if (trim($this->sujet_mail) != "")
		{
			switch(intval($this->sel_option_sujet_mail))
			{
				case 0:	//cas "commencant par "
				$land .= " and mail.sujet_mail like ? ";
				$lparam_data[] = trim($this->sujet_mail)."%";
				$lparam_type[] = "text";
				break;
				case 1:	//cas "contient "
				$land .= " and mail.sujet_mail like ? ";
				$lparam_data[] = "%".trim($this->sujet_mail)."%";
				$lparam_type[] = "text";
				break;
				case 3:	//cas "finissant par "
				$land .= " and mail.sujet_mail like ? ";
				$lparam_data[] = "%".trim($this->sujet_mail);
				$lparam_type[] = "text";
				break;
				case 4:	//cas "est égal à"
				$land .= " and mail.sujet_mail = ? ";
				$lparam_data[] = trim($this->sujet_mail);
				$lparam_type[] = "text";
				break;
			}

		}

		//Rechercher un mail par le corps

		if (trim($this->body_mail) != "")
		{
			switch(intval($this->sel_option_body_mail))
			{
				case 1://cas "contient "
				$land .= " and mail.body_mail like ? ";
				$lparam_data[] = "%".trim($this->body_mail)."%";
				$lparam_type[] = "text";
				break;
			}
		}

		//Rechercher un mail par son statut
		//print_r($this->sel_option_etat); die();
		if (is_array($this->sel_option_etat))	 
		 {   
			 		  		$land_etat = "";
		foreach ($this->sel_option_etat as $letat)
		{		  		switch (strtolower(trim($letat)))
		{		  			
			case "archive" :
				if (trim($land_etat) != "")
				$land_etat .= " or mail.archive_mail = 1 ";
				else $land_etat .= " mail.archive_mail = 1 ";
		break;
			case "lu" :
				if (trim($land_etat) != "")
				$land_etat .= " or mail.statut_mail = 1 ";
				else $land_etat .= "  mail.statut_mail = 1 ";
				break;
			case "nonlu" :
				if (trim($land_etat) != "")
				$land_etat .= " or mail.statut_mail = 0 ";
				else $land_etat .= "  mail.statut_mail = 0 ";
				break;

		}		  	}
		if (trim($land_etat) != "") $land .= " and ({$land_etat}) ";
		}
		//cas "archivé "
		/*if (trim($this->sel_option_etat) != "")
		{
		if ($this->sel_option_etat[0] == 0){
		$land .= " and mail.archive_mail = 1 ";
		}
		}


		//cas "Lu "
		if (trim($this->sel_option_etat) != "")
		{
		if ($this->sel_option_etat[0] == 1){
		$land .= " and mail.statut_mail = 1 ";
		}
		}

		//cas "Non Lu"
		if (trim($this->sel_option_etat) != "")
		{
		if ($this->sel_option_etat[0] == 2){
		$land .= " and mail.statut_mail = 0 ";
		}
		}*/

		//Rechercher un mail par la date

		if ((trim($this->dat_deb_creation ) != "") && (trim($this->dat_fin_creation ) != ""))
		{
			$land .= " and mail.date_mail between ?  and  ? ";
			$lparam_type[] = "text";
			$lparam_type[] = "text";

			$lparam_data[] = $this->dat_deb_creation;
			$lparam_data[] = $this->dat_fin_creation;

		}
		else if ((trim($this->dat_deb_creation ) != ""))
		{
			$land .= " and mail.date_mail >= ? ";

			$lparam_type[] = "date";

			$lparam_data[] = $this->dat_deb_creation;


			/*$date_deb_creation = $this->dat_deb_creation;
			$date_mail=  "select mail.date_mail from mail_mail mail where code_mail= ?";
			//Extraction des données
			list($jour1, $mois1,$annee1 ) = explode('/', $date_deb_creation );
			list($jour2, $mois2,$annee2 ) = explode('/', $date_mail);

			//Calcul des timestamp
			$date_deb_creation = mktime(0,0,0,$jour1,$mois1,$annee1 );
			$date_mail = mktime(0,0,0,$jour2,$mois2,$annee2 );
			$ecart =  ceil(($date_mail - $date_deb_creation)/86400);
			//echo $date1 ."#". $date2;
			$land .= " and '" . $ecart . "' >0";*/


		}
		else if((trim($this->dat_fin_creation ) != ""))
		{
			$land .= " and mail.date_mail <= ? ";
			$lparam_type[] = "date";
			$lparam_data[] = $this->dat_fin_creation;

		}

		if (trim($this->code_mail) != "")
		{
			$land .= " and mail.code_mail = ? ";
			$lparam_type[] = "integer";
			$lparam_data[] = intval($this->code_mail);
		}

		$req = $lselect . $lfrom;
		$req .= $lwhere . $land;//.$lorderby;

		$this->connect_db();
		//die($this->redraw_sql($req , $lparam_data , $lparam_type));
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
				$this->exception = "CMail::rechercher() - ".$result-> getDebugInfo() . ' in ' . $req;
				$retvalue = null;
			}
		}
		else
		{
			$this->exception = "CMail::rechercher() - ".$lprepare-> getDebugInfo() . ' in ' . $req;
			$retvalue = null;
		}
		$this->db->disconnect();
		return $retvalue;
	}

	/**
  * fonction qui ajoute un mail dans la BD
  *
  * @return unknown
  */
	function ajouter()
	{

		$this->exception = "";
		$lretval = false;

		$lparam_type = array();
		$lparam_data = array();

		$lsql = " insert into mail_mail ( code_mail , sujet_mail , body_mail , format_mail , archive_mail , statut_mail , auteur_mail , date_mail )
		values ( ?, ? , ? , ? , ? , ? , ? , ? ) 
		";

		$lparam_type = array("integer" , "text" , "text" , "integer" , "integer" , "integer" , "integer" , "date" );

		$this->connect_db();

		if (! $this->db->isError ($lprepare = $this->db->prepare($lsql , $lparam_type)))
		{

			$lparam_data[] = intval($this->code_mail);
			$lparam_data[] = str_replace("'","''",$this->sujet_mail);
			$lparam_data[] = str_replace("'","''",$this->body_mail);
			$lparam_data[] = (trim($this->format_mail) == "") ? 1 : $this->format_mail;
			$lparam_data[] = 0;
			$lparam_data[] = 0;
			$lparam_data[] = intval($this->auteur_mail);
			$lparam_data[] = $this->format_date2database(trim($this->date_mail));

			//die($this->redraw_sql($lsql , $lparam_data , $lparam_type));
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{

				$lretval = true;
			}
			else
			{
				$this->exception = "CMail::ajouter() - ".$result-> getDebugInfo() . ' in ' . $lsql;
				$lretval = false;
			}
		}
		else
		{
			$this->exception = "CMail::ajouter() - ".$lprepare-> getDebugInfo() . ' in ' . $lsql;
			$lretval = false;
		}


		unset($lprepare);
		unset($result);
		unset($lparam_data);
		unset($lparam_type);
		unset($lsql);

		return $lretval;
	}

	public function charger()
	{
		$retvalue = array();
		$lparam_data = array();
		$lparam_type = array();

		$req = "select mail.code_mail, mail.sujet_mail, mail.body_mail , mail.format_mail , mail.statut_mail , mail.auteur_mail
	  , mail.date_mail
	  from mail_mail mail
	  inner join utilisateur u on mail.auteur_mail = u.codeuser ";
		$lwhere = " where (not mail.code_mail is null ) ";
		$land = "";

		if (trim($this->code_mail) != "")
		{
			$land .= " and mail.code_mail = ? ";
			$lparam_type[] = "integer";
			$lparam_data[] = $this->code_mail;
		}

		$req .= $lwhere . $land ;
		//die($this->redraw_sql($req , $lparam_data , $lparam_type ));
		$this->connect_db();
		if (! $this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				$lrow = $result->FetchRow();

				//Transformer les noms de colonnes en champ de l'objet mail en cours
				if (is_array($lrow))
				{
					foreach ($lrow as $lchamp => $lvaleur)
					{
						$this->$lchamp = $lvaleur;
					}
				}

				$retvalue =  true;	//chargement effectué avec succès

				//libérer la mémoire
				unset($lchamp);
				unset($lvaleur);
			}
			else
			{
				$this->exception = "CMail::charger() - ".$result-> getDebugInfo() . ' in ' . $req;
				$retvalue = false;
			}
		}
		else
		{
			$this->exception = "CMail::charger() - ".$lprepare-> getDebugInfo() . ' in ' . $req;
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

	function sel_option_search($pattributes , $pdefault = null , $pchoisissez = null)
	{
		global $translate;
		$this->exception = "";

		$larr_option_search = array();
		$larr_option_search[] = array("code" => 0 , "value" => $translate['prefixed_by']);
		$larr_option_search[] = array("code" => 1 , "value" => $translate['contient']);
		$larr_option_search[] = array("code" => 3 , "value" => $translate['postfixed_by']);
		$larr_option_search[] = array("code" => 4 , "value" => $translate['equals_to']);

		$list = $this->select_ouvrante_tag($pattributes);
		$list .= "<option value=\"\">$pchoisissez</option>\n";
		foreach($larr_option_search as $obj)
		{
			$list .= "<option value=\"".$obj['code']."\"";
			if ((trim(strval($pdefault)) == trim(strval($obj['code'])) ))
			{
				$list .= " selected";
			}
			$list .= ">".$obj[value]."</option>\n";
		}
		$list .= "</select>\n";

		//libérer la mémoire
		unset($larr_option_search);
		unset($obj);

		return $list;

	}

	function sel_option_search_entier($pattributes , $pdefault = null , $pchoisissez = null)
	{
		global $translate;
		$this->exception = "";

		$larr_option_search = array();
		$larr_option_search[] = array("code" => 0 , "value" => "=");
		$larr_option_search[] = array("code" => 1 , "value" => "<=");
		$larr_option_search[] = array("code" => 2 , "value" => ">=");

		$list = $this->select_ouvrante_tag($pattributes);
		$list .= "<option value=\"\">$pchoisissez</option>\n";
		foreach($larr_option_search as $obj)
		{
			$list .= "<option value=\"".$obj['code']."\"";
			if ((trim(strval($pdefault)) == trim(strval($obj['code'])) ))
			{
				$list .= " selected";
			}
			$list .= ">".$obj[value]."</option>\n";
		}
		$list .= "</select>\n";

		//libérer la mémoire
		unset($larr_option_search);
		unset($obj);

		return $list;

	}
	/**
 	 * fabriquer une liste déroulante des options de sélection du serveur de mail
 	 *
 	 * @param unknown_type $pattributes
 	 * @param entier -  $pdefault - code de l'option a afficher par défaut
 	 * @param string - $pchoisissez - message choisissez à afficher
 	 * @return unknown
 	 */
	function sel_option_mail_server($pattributes , $pdefault = null , $pchoisissez = null)
	{
		global $translate;
		$this->exception = "";

		$larr_option_mail_server = array();

		$larr_option_mail_server[] = array("code" => 1 , "value" => ucfirst($translate["func_mail_php"]));
		$larr_option_mail_server[] = array("code" => 2 , "value" => ucfirst($translate["sendmail"]));
		$larr_option_mail_server[] = array("code" => 3 , "value" => ucfirst($translate["serveur_smtp"]));

		$list = $this->select_ouvrante_tag($pattributes);
		if (trim($pchoisissez) != "") $list .= "<option value=\"\">$pchoisissez</option>\n";
		foreach($larr_option_mail_server as $obj)
		{
			$list .= "<option value=\"".$obj['code']."\"";
			if ((trim(strval($pdefault)) == trim(strval($obj['code'])) ))
			{
				$list .= " selected";
			}
			$list .= ">".$obj[value]."</option>\n";
		}
		$list .= "</select>\n";

		//libérer la mémoire
		unset($larr_option_mail_server);
		unset($obj);

		return $list;

	}

	function supprimer()
	{

		$this->exception = "";
		$lretval = false;

		$lparam_type = array();
		$lparam_data = array();

		$lsql = "";

		$lcond = "";

		$lparam_data = $this->list_code_mail;
		for ($i = 0; $i < count($this->list_code_mail); $i++)
		{
			if (trim($lcond) == "") $lcond = " ? ";
			else $lcond .= " , ? ";
			$lparam_type[] = "integer";
		}

		if (trim($lcond) != "")
		{
			$lcond = " ( {$lcond} ) ";
		}
		else return true;

		$lsql .= " delete  from mail_mail where code_mail in {$lcond} ";

		$this->connect_db();
		//die($this->redraw_sql($lsql , $lparam_data , $lparam_type));
		if (! $this->db->isError ($lprepare = $this->db->prepare($lsql , $lparam_type)))
		{
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				$lretval = true;
			}
			else
			{
				$this->exception = "CMail::supprimer() - ".$result-> getDebugInfo() . ' in ' . $lsql;
				$lretval = false;
			}
		}
		else
		{
			$this->exception = "CMail::supprimer() - ".$lprepare-> getDebugInfo() . ' in ' . $lsql;
			$lretval = false;
		}


		unset($lprepare);
		unset($result);
		unset($lparam_data);
		unset($lparam_type);
		unset($lsql);

		return $lretval;
	}

	function sel_mail_search($pattributes , $pdefault = null)
	{
		global $translate;

		$this->exception = "";

		$larr_option_search = array();

		$larr_option_search[] = array("code" => "archive" , "value" => ucfirst($translate['Archive']));
		$larr_option_search[] = array("code" => "lu" , "value" => ucfirst($translate['read']));
		$larr_option_search[] = array("code" => "nonlu" , "value" => ucfirst($translate['unread']));
		/*$larr_option_search[] = array("code" => 3 , "value" => ucfirst($translate['Archive_read']));
		$larr_option_search[] = array("code" => 4 , "value" => ucfirst($translate['Archive_unread']));	*/

		$list = $this->select_multiple_tag($pattributes);

		foreach($larr_option_search as $obj)
		{
			$list .= "<option value=\"".$obj['code']."\"";
			if (is_array($pdefault))
			{
				if (in_array($obj['code'],$pdefault))
				{
					$list .= " selected";
				}
			}

			@$list .= ">".$obj[value]."</option>\n";

		}
		$list .= "</select>\n";

		//libérer la mémoire
		unset($larr_option_search);
		unset($obj);
		return $list;
	}


	/**
	 * *
	 * fonction qui ajoute une newsletter dans la base de données
	 * @return unknown
	 */
	function enregistrer_parametres()
	{

		$this->exception = "";
		$lretval = false;

		$lparam_type = array();
		$lparam_data = array();

		$lsql = " insert into mail_config ( mail_server , sender_email , sender_name , sendmail_path , smtp_auth , smtp_user , smtp_pwd , smtp_host )
		values ( ?, ? , ? , ? , ? , ? , ? , ? ) 
		";

		$lparam_type = array("integer" , "text" , "text" , "text" , "integer" , "text" , "text" , "text" );

		$this->connect_db();

		if (! $this->db->isError ($lprepare = $this->db->prepare($lsql , $lparam_type)))
		{

			$lparam_data[] = intval($this->mail_server);
			$lparam_data[] = trim($this->sender_email);
			$lparam_data[] = trim($this->sender_name);
			$lparam_data[] = trim($this->sendmail_path);
			$lparam_data[] = intval($this->smtp_auth);
			$lparam_data[] = trim($this->smtp_user);
			$lparam_data[] = trim($this->smtp_pwd);
			$lparam_data[] = trim($this->smtp_host);

			//die($this->redraw_sql($lsql , $lparam_data , $lparam_type));
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{

				$lretval = true;
			}
			else
			{
				$this->exception = "mail::enregistrer_parametres() - ".$result-> getDebugInfo() . ' in ' . $lsql;
				$lretval = false;
			}
		}
		else
		{
			$this->exception = "mail::enregistrer_parametres() - ".$lprepare-> getDebugInfo() . ' in ' . $lsql;
			$lretval = false;
		}


		unset($lprepare);
		unset($result);
		unset($lparam_data);
		unset($lparam_type);
		unset($lsql);

		return $lretval;
	}



	function modifier_parametres()
	{

		$this->exception = "";
		$lretval = false;

		$lparam_type = array();
		$lparam_data = array();

		$lsql = " update mail_config  set mail_server = ?
		, sender_email = ?
		, sender_name = ? 
		, sendmail_path = ? 
		, smtp_auth = ? 
		, smtp_user = ? 
		, smtp_pwd = ? 
		, smtp_host = ? 
		";

		$lparam_type = array("integer" , "text" , "text" , "text" , "integer" , "text" , "text" , "text" );

		$this->connect_db();

		if (! $this->db->isError ($lprepare = $this->db->prepare($lsql , $lparam_type)))
		{

			$lparam_data[] = intval($this->mail_server);
			$lparam_data[] = trim($this->sender_email);
			$lparam_data[] = trim($this->sender_name);
			$lparam_data[] = trim($this->sendmail_path);
			$lparam_data[] = intval($this->smtp_auth);
			$lparam_data[] = trim($this->smtp_user);
			$lparam_data[] = trim($this->smtp_pwd);
			$lparam_data[] = trim($this->smtp_host);

			//die($this->redraw_sql($lsql , $lparam_data , $lparam_type));
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{

				$lretval = true;
			}
			else
			{
				$this->exception = "mail::modifier_parametres() - ".$result-> getDebugInfo() . ' in ' . $lsql;
				$lretval = false;
			}
		}
		else
		{
			$this->exception = "mail::modifier_parametres() - ".$lprepare-> getDebugInfo() . ' in ' . $lsql;
			$lretval = false;
		}


		unset($lprepare);
		unset($result);
		unset($lparam_data);
		unset($lparam_type);
		unset($lsql);

		return $lretval;
	}

	/**
 	 * focntion qui met à jour le status d'un envoi de mail
 	 *
 	 * @return unknown
 	 */
	function modifier_status()
	{

		$this->exception = "";
		$lretval = false;

		$lparam_type = array();
		$lparam_data = array();

		$lsql = " update mail_log set log_status = ? , log_date = ?
		where log_id = ? 
		
		";

		$lparam_type = array("integer" , "date" , "integer");

		$this->connect_db();

		if (! $this->db->isError ($lprepare = $this->db->prepare($lsql , $lparam_type)))
		{

			$lparam_data[] = (trim($this->log_status) == "") ? 0 : intval($this->log_status);
			$lparam_data[] = $this->format_date2database(trim($this->log_date));
			$lparam_data[] = intval($this->log_id);

			//die($this->redraw_sql($lsql , $lparam_data , $lparam_type));
			if (! $this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{

				$lretval = true;
			}
			else
			{
				$this->exception = "mail::modifier_status() - ".$result-> getDebugInfo() . ' in ' . $lsql;
				$lretval = false;
			}
		}
		else
		{
			$this->exception = "mail::modifier_status() - ".$lprepare-> getDebugInfo() . ' in ' . $lsql;
			$lretval = false;
		}


		unset($lprepare);
		unset($result);
		unset($lparam_data);
		unset($lparam_type);
		unset($lsql);

		$this->db->disconnect();

		return $lretval;
	}

}

?>