<?php
/**
 * @version			1.0
 * @package			GED
 * @subpackage		Document
 * @copyright 		(C) 2009 INTERFACE SA. Tous droits réservés
 * @license			INTERFACE SA
 * @author 			William<william.nkingne@laposte.net>
 * @desc			Spécification d'un document dans le système de workflow
 * @creationdate	jeudi 18 juin 2009
 * @updates
 * 	# samedi 20 juin 2009 (Patrick Mveng<patrick.mveng@interfacesa.local>)
 * 		- suppression de l'attribut abstract
 * 	# samedi 27 juin 2009 (Patrick Mveng<patrick.mveng@interfacesa.local>)
 * 		-  ajout de la méthode telecharger qui permet le téléchargement d'un fichier
 * 		-  ajout de la méthode typeMime qui retourne le type d'un fichier
 * 	# jeudi 2 juillet 2009 (William Nkingné<william.nkingne@laposte.net>)
 * 		- modification de la méthode archiver()
 * 		- suppression du modificateur setArchive() qui ne servait à rien
 *  # mardi 28 juillet 2009
 *      - Modification de la fonction de recherche
 *      -Ajout du critère de recherche par état (archivé et importé)
 * @todo 
 *  # Ecrire les codes else des méthodes getTitredoc, getCodeuser
 * 	# Définir la méthode imprimer()
 *  # Ecrire le code du cas de recherche de document importés
 */


/*$chemin = dirname(__FILE__);
$chemin = str_replace("\ged\classe","",$chemin);
require_once($chemin.'\classe\application.class.php');
require_once ($chemin.'\ged\lang\ged.'.$lang.'.php');*/
$siteweb = new Application();
require_once($siteweb->get_document_root().DS.'classe'.DS.'table.class.php');

//Définition de la classe qui gère un document
/**
 * Classe mère
 *
 */
class Document extends Table {
	//Attributs
	public $chemin_acces;	
	public $numdoc;
	public $titredoc;
	public $tagdoc;
	public $datecreation;
	public $heurecreation;
	public $codeuser;
	public $numtache;
	public $archive;
//	public $dat_deb_creation;
//	public $dat_fin_creation;
    public $typedoc;
    public $codeusercours;

    public function Document()
	{
		$this->init();
	}
    
	//Accesseurs
	public function getNumdoc (){
		return $this->numdoc;
	}

	public function getTitredoc($valeur=null){
		if (is_null($valeur)){
			return $this->titredoc;
		}
		else {

		}
	}
	
	public function getCodeuser ($valeur){
		if (is_null($valeur)){
			return $this->codeuser;
		}
		else {

		}
	}
	
	public function getNumtache ($valeur){
		return $this->numtache;
	}
	
	public function est_archive () {
		if ($this->archive=1){
			return 1;
		}
		else {
			return 0;
		}
	}
	
	public function getTagdoc (){
		return $this->tag;
	}
	
	public function get_chemin_acces() {
	   return $this->chemin_acces;
    }
	
	//Modificateurs
	public function setNumdoc($valeur=null){
		$this->numdoc=$valeur;
	}

    public function setTypedoc($valeur=null){
		$this->typedoc=$valeur;
	}

	public function setTitredoc ($valeur=null){
		$this->titredoc=$valeur;
	}

	public function setCodeuser ($valeur=null){
		$this->codeuser=$valeur;
	}
	
	public function setTagdoc($valeur){
		$this->tag=$valeur;
	}
	
	public function setNumtache ($valeur){
		$this->numtache=$valeur;
	}
	
	public function getCodeusercours ($valeur){
		if (is_null($valeur)){
			return $this->codeusercours;
		}
		else {

		}
	}
	
	/**
	 * Autres méthodes de la classe
	 * @param create() est la foncton qui permet de créer un nouveau document
	 * @param modify() est la fonction qui permet de modifier un document
	 * @param delete() est la fonction qui permet de supprimer un document
	 * @param rechercher () est la fonction de recherche d'un document
	 * @param archiver () sert à l'archivage d'un document
	 * @param getTag () unknow
	 * 
	 */
	
	public function charger(){
	  $retvalue = array();

	  $req = "Select d.numdoc, d.titredoc, d.datecreation, d.codeuser, d.numtache,
	   u.nomuser, u.prenomuser from document d inner join utilisateur u ";
	  $lwhere = "on d.codeuser=u.codeuser ";
	  $land = "";

      if (trim($this->numdoc) != "")
	  {
	  	$land .= " and numdoc = ? ";
	  	$lparam_type = "integer";
	  	$lparam_data = $this->numdoc;
	  }
	  		
	   $req .= $lwhere . $land ;
		//die($this->redraw_sql($req , $lparam_type))
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
				$retvalue =  true;	//chargement effectué avec succès
				
				//libérer la mémoire
				unset($lchamp);
				unset($lvaleur);
			}
			else 
			{
				$this->exception = "document::charger() - ".$result-> getDebugInfo() . ' in ' . $req;
				$retvalue = false;
			}
		}
		else 
		{
			$this->exception = "document::charger() - ".$lprepare-> getDebugInfo() . ' in ' . $req; 
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

	public function modify(){
		
		$retvalue = false;

		$req = "update document set titredoc= ?, datecreation= ?,  codeuser= ? where numdoc= ?";

		$lparam_type=array();
        $lparam_data=array();

		$lparam_type[]="text";
		$lparam_type[]="date";
		$lparam_type[]="integer";
		$lparam_type[]="integer";


		$this->connect_db();
		if (!$this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type))){
            $lparam_data[]=trim($this->titredoc);
		    $lparam_data[]= $this->format_date2database(trim($this->datecreation));
		    $lparam_data[]=trim($this->codeuser);
		    $lparam_data[]=trim($this->numdoc);
			if (!$this->db->isError ($result = $lprepare->Execute($lparam_data))){

				$retvalue =  true;
								
			}
			else {
				$this->exception = "document::modify() - ".$result-> getDebugInfo() . ' in ' . $req;
				$retvalue = false;
			}
		}
		else {
			$this->exception = "document::modify()- ".$lprepare-> getDebugInfo() . ' in ' . $req;
			$retvalue = false;
		}
		$this->db->disconnect();
		return $retvalue;
	}

	public function delete(){	
		
	}

	public function imprimer (){
		//A faire ultérieurement
	}
		
	
	public function rechercher (){
		

 	  	$retvalue = array();
        $req="";
        $req1="";
        $req2="";

	  	$lselect1 = " select doc.codeuser , doc.numdoc , doc.titredoc, doc.datecreation, doc.heurecreation , doc.numtache
	  	 , user.nomuser , user.prenomuser , typedoc ";
	  	$lfrom1 = "  from document doc 
	  	inner join utilisateur user on doc.codeuser = user.codeuser
	  	";
	  	$lwhere1= " ";
	  		  	
	  	$land1 = " ";
	  	
	  	$lselect2 = " select doc.codeuser , n.numdoc , n.libfich as titredoc, n.dateimport as datecreation
	  	, n.heureimport as heurecreation , doc.numtache , user.nomuser , user.prenomuser, 'numeric' as typedoc"; 
	  	$lfrom2 = "  from numerique n 
	  	inner join document doc on n.numform = doc.numdoc 
	  	inner join utilisateur user on doc.codeuser = user.codeuser
	  	";
	  	$lwhere2= " ";
	  		  	
	  	$land2 = " ";
	  		  
	  	//initialisation du tableau de paramètres formels
	  	$lparam_type1 = array();
	  	$lparam_type2 = array();
	  	$lparam_type3 = array();
	  	$lparam_type4 = array();
	  	
	  	$lparam_data1 = array();
	  	$lparam_data2 = array();
	  	$lparam_data3 = array();
	  	$lparam_data4 = array();
	  
	  	//initialisation du tableau de paramètres effectifs pour la requête
	  	$lparam_data = array();
	  	
	  	if (trim($this->numform) != "")
	  	{
	  		$land2 = " and n.numform = ? ";
	  		$lparam_type2[] = "integer";
			$lparam_data2[] = intval($this->numform);
	  	}
	  	
	  if (trim($this->titredoc) != "") {	  
	  		switch(intval($this->sel_option_titredoc)) {
	  			//Cas "Commençant par "
				case 0:
					$land1 .= " and titredoc like ? ";
					$lparam_type1[] = "text";
					$lparam_data1[] = trim($this->titredoc . "%");

                    $land2 .= " and n.libfich like ? ";
					$lparam_type2[] = "text";
					$lparam_data2[] = trim($this->titredoc . "%");
				break;
				//Cas "Contient "
				case 1:	
					$land1 .= " and titredoc like ? ";
					$lparam_type1[] = "text";
					$lparam_data1[] = "%".trim($this->titredoc . "%");

                    $land2 .= " and n.libfich like ? ";
					$lparam_type2[] = "text";
					$lparam_data2[] = "%".trim($this->titredoc . "%");
				break;
				//Cas "Finissant par "			
				case 3:	
					$land1 .= " and doc.titredoc like ? ";
					$lparam_type1[] = "text";
					$lparam_data1[] = trim("%" . $this->titredoc);

                    $land2 .= " and n.libfich like ? ";
					$lparam_type2[] = "text";
					$lparam_data2[] = trim("%" . $this->titredoc);
				break;
				//Cas "Est égal à"
				case 4:
					$land1 .= " and titredoc = ? ";
					$lparam_type1[] = "text";
					$lparam_data1[] = trim($this->titredoc);

                    $land2 .= " and n.libfich = ? ";
					$lparam_type2[] = "text";
					$lparam_data2[] = trim($this->titredoc);
				break;
	  		}
	  	}
	  	
	  	if (trim($this->codeuser) != "") {
	  		$land1 .= " and doc.codeuser = ? ";
			$lparam_type1[] = "integer";
			$lparam_data1[] = intval($this->codeuser);
			
			$land2 .= " and doc.codeuser = ? ";
			$lparam_type2[] = "integer";
			$lparam_data2[] = intval($this->codeuser);
	  	}
	  	
	  	if (trim($this->tag) != "") {
	  		$land1 .= " and doc.tag like ? ";
			$lparam_type1[] = "text";
			$lparam_data1[] = "%".trim($this->tagdoc . "%");
			
			$land2 .= " and n.tag like ? ";
			$lparam_type2[] = "text";
			$lparam_data2[] = "%".trim($this->tag . "%");
	  	}
	  	
		if ( (trim($this->dat_deb_creation) != "") && (trim($this->dat_fin_creation) != "") )
	  	{
	  		$land1 .= " and doc.datecreation between '".$this->format_date2database(trim($this->dat_deb_creation))."' and '".$this->format_date2database(trim($this->dat_fin_creation))."' ";
	  		$land2 .= " and n.dateimport between '".$this->format_date2database(trim($this->dat_deb_creation))."' and '".$this->format_date2database(trim($this->dat_fin_creation))."' ";
	  	}
	  	elseif (trim($this->dat_deb_creation) != "")
	  	{
	  		$land1 .= " and doc.datecreation >= '".$this->format_date2database(trim($this->dat_deb_creation))."' ";
	  		$land2 .= " and n.dateimport >= '".$this->format_date2database(trim($this->dat_deb_creation))."' ";
	  	}
	  	elseif (trim($this->dat_fin_creation) != "")
	  	{
	  		$land1 .= " and doc.datecreation <= '".$this->format_date2database(trim($this->dat_fin_creation))."' ";
	  		$land2 .= " and n.dateimport <= '".$this->format_date2database(trim($this->dat_fin_creation))."' ";
	  	}
	  		  	
	  	/*if ((trim($this->dat_deb_creation) != "") && (trim($this->dat_fin_creation) !="")) {
	  		if (trim($this->dat_deb_creation)==(trim($this->dat_fin_creation))){
	  			$land1 .= " and doc.datecreation = ?";
				$lparam_type1[] = "text";
	  			$lparam_data1[]=trim($this->dat_fin_creation);

	  			$land2 .= " and n.dateimport = ?";
				$lparam_type2[] = "text";
	  			$lparam_data2[]=trim($this->dat_fin_creation);
	  		}
	  		else {
	  			$ddebut=explode("/", $this->dat_deb_creation);
	  			$dfin=explode("/", $this->dat_fin_creation);
	  			  		
	  			$date_ini=$ddebut[2].$ddebut[1].$ddebut[0];
	  			$date_fin=$dfin[2].$dfin[1].$dfin[0];

	  			if ($date_fin>$date_ini){
	  				$land1 .= " and doc.datecreation between '" .$this->dat_deb_creation. "' and '" .$this->dat_fin_creation. "' ";
	  				$lparam_type1[] = "texte";
	  				$lparam_type1[] = "texte";
	  				$lparam_data1[]=trim($this->dat_deb_creation);
	  				$lparam_data1[]=trim($this->dat_fin_creation);

	  				$land2 .= " and n.dateimport between '" .$this->dat_deb_creation. "' and '" .$this->dat_fin_creation. "' ";
	  				$lparam_type2[] = "texte";
	  				$lparam_type2[] = "texte";
	  				$lparam_data2[]=trim($this->dat_deb_creation);
	  				$lparam_data2[]=trim($this->dat_fin_creation);
	  			}
	  			else {
	  				//echo ucfirst($translate["erreur_date"]).'non'; 
	  				echo 'Une des dates de recherche est invalide';
	  				break;
	  			}
	  		}
	  	}
	  	else if ((trim($this->dat_deb_creation) != "") && (trim($this->dat_fin_creation) == "")){
	  		$land1 .= " and doc.datecreation = ? ";
	  		$lparam_type1[] = "text";
	  		$lparam_data1[]=trim($this->dat_deb_creation);
	  		
	  		$land2 .= " and n.dateimport = ? ";
	  		$lparam_type2[] = "text";
	  		$lparam_data2[]=trim($this->dat_deb_creation);
	  	}
	  	else if ((trim($this->dat_deb_creation) == "") && (trim($this->dat_fin_creation) != "")) {
	  		$land .= " and doc.datecreation ='" .$this->dat_fin_creation. "'";
	  		$lparam_type1[] = "text";
	  		$lparam_data1[]=trim($this->dat_fin_creation);

	  		$land2 .= " and n.dateimport = ? ";
	  		$lparam_type2[] = "text";
	  		$lparam_data2[]=trim($this->dat_fin_creation);
	  	}
	  	*/

	  	if (trim($this->auteurdoc) != "") {
	  		switch(intval($this->sel_option_auteurdoc)) {
	  			//Cas "Commençant par"
	  			case 0:	
	  				$land1 .= " and user.nomuser like ? ";
					$lparam_type1[] = "text";
					$lparam_data1[] = trim($this->auteurdoc . "%");
					
					$land2 .= " and user.nomuser like ? ";
					$lparam_type2[] = "text";
					$lparam_data2[] = trim($this->auteurdoc . "%");
				break;
				
				//Cas "Contient"
				case 1:	
				  	$land1 .= " and user.nomuser like ? ";
					$lparam_type1[] = "text";
					$lparam_data1[] = "%".trim($this->auteurdoc . "%");
					
					$land2 .= " and user.nomuser like ? ";
					$lparam_type2[] = "text";
					$lparam_data2[] = "%".trim($this->auteurdoc . "%");
				break;
				
				//Cas "Finissant par"			
				case 3:	
			  		$land1 .= " and user.nomuser like ? ";
					$lparam_type1[] = "text";
					$lparam_data1[] = "%" . $this->auteurdoc;
					
					$land2 .= " and user.nomuser like ? ";
					$lparam_type2[] = "text";
					$lparam_data2[] = "%" . $this->auteurdoc;
				break;
				
				//Cas "Est égal à"
				case 4:	
				  	$land1 .= " and user.nomuser = ? ";
					$lparam_type1[] = "text";
					$lparam_data1[] = $this->auteurdoc;
					
					$land2 .= " and user.nomuser = ? ";
					$lparam_type2[] = "text";
					$lparam_data2[] = $this->auteurdoc;
				break;
	  		}
	  	}

        if (!empty($this->sel_option_etat)) {
            if ($this->sel_option_etat[0] == 0){
              $land1 .= " and doc.archive = 1 ";

              $land2 .= " and n.archive = 1 ";

              $req1 = $lselect1 . $lfrom1 ;
	  	      $req1 .= $lwhere1 . $land1 ;

    	      $req2 = $lselect2 . $lfrom2 ;
	  	      $req2 .= $lwhere2 . $land2 ;

	  	      $req =  "({$req1}) union ({$req2})	";
            }
            if ($this->sel_option_etat[0] == 1){
              $req2 = $lselect2 . $lfrom2 ;
	  	      $req2 .= $lwhere2 . $land2 ;

	  	      $req = $req2;
            }
            if (!empty($this->sel_option_etat[1])){
              $land2 .= " and n.archive = 1 ";

              $req2 = $lselect2 . $lfrom2 ;
	  	      $req2 .= $lwhere2 . $land2 ;

	  	      $req = $req2;
            }
	  	}
        else {
          $land1 .= " and doc.archive = 0 ";

          $land2 .= " and n.archive = 0 ";

          $req1 = $lselect1 . $lfrom1 ;
	  	  $req1 .= $lwhere1 . $land1 ;

    	  $req2 = $lselect2 . $lfrom2 ;
	  	  $req2 .= $lwhere2 . $land2 ;

	  	  $req =  "({$req1}) union ({$req2})	";
        }
	  	 
	  	if (trim($this->typedoc) != "") {
	  	 	switch (trim(strtolower($this->typedoc))){
	  	 		case "numeric" :
	  	 			$req = $req2;
    	  	 		break;
	  	 		default:	
	  	 			$req = $req1;
	  	 			break;
	  	 	}
	  	 	
	  	 }
	  	 
	  	$this->connect_db();
	  	$lparam_type = array_merge($lparam_type1 , $lparam_type2);
	  	$lparam_data = array_merge($lparam_data1 , $lparam_data2);
                 //die ($req);
	  	if (! $this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type))) {
	  		if (! $this->db->isError ($result = $lprepare->Execute($lparam_data))) {

	  			//Vérifie s'il y a au moins une ligne dans le résultat
	  			if ($result->valid()) {
					$retvalue =  $result->FetchAll();
				}
				else {
					$retvalue = null;
				}
			}
			else {
				$this->exception = "document::rechercher() - ".$result-> getDebugInfo() . ' in ' . $req;
				$retvalue = null;
			}
		}
		else {
			$this->exception = "document::rechercher() - ".$lprepare-> getDebugInfo() . ' in ' . $req;
			$retvalue = null;
            echo $this->exception;
		}
//       die($req);
		$this->db->disconnect();
		return $retvalue;
	}
	
	public function archiver ()
	{
		$retvalue = false;
		$req = "update document set archive = 1  where numdoc= ?";

		$lparam_type=array();
        $lparam_data=array();
		$lparam_type[]="integer";
		$lparam_data[]=intval($this->numdoc);
		
        //die($this->redraw_sql($req , $lparam_data , $lparam_type));
		
        $this->connect_db();
		if (!$this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type)))
		{
        	if (!$this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				$retvalue =  true;
			}
			else 
			{
				$this->exception = "document::archiver() - ".$result-> getDebugInfo() . ' in ' . $req;
				$retvalue = false;
			}
		}
		else 
		{
			$this->exception = "document::archiver()- ".$lprepare-> getDebugInfo() . ' in ' . $req;
			$retvalue = false;
		}
		$this->db->disconnect();
		
		return $retvalue;
	}

	
	public function addTag($valeur){
		$this->tag .= trim("," .$valeur);
	}
	
	public function deleteTag($valeur){
		$this->tag -= trim("," .$valeur);
	}

	 function telecharger($pnomFichier = null) {

	   // on détermine le type MIME du fichier
	   // cf. http://www.asp-php.net/ressources/codes/PHP-Type+MIME+d%27un+fichier+a+partir+de+son+nom.aspx
	   $typeFichier=$this->typeMime($pnomFichier);
	
	   // on nettoie le tampon d'affichage, et on désactive la compression ZLib
	   @ob_end_clean();
	   @ini_set('zlib.output_compression', '0');
	
	   // date courante
	   $maintenant=gmdate('D, d M Y H:i:s').' GMT';
	
	   // envoi des en-têtes nécessaires au navigateur
	   header('Content-Disposition: attachment; filename="'.basename($pnomFichier).'"');	   
	   header("Content-Type: application/force-download");
	   //header("Content-Type: ".$typeFichier."\n");
	   header("Content-Transfer-Encoding: ".$typeFichier."\n");

	
	   // Internet Explorer nécessite des en-têtes spécifiques
	   if(preg_match('/msie|(microsoft internet explorer)/i', $_SERVER['HTTP_USER_AGENT']))
	   {
	      header('Cache-Control: must-revalidate');//, post-check=0, pre-check=0');
	      header('Pragma: public');
	   }
	   else {
	   		header('Pragma: no-cache');
	   }
	
	   header("Expires: 0");
	   readfile($pnomFichier);
	}

	/* retourne le type MIME à partir de l'extension de fichier contenu dans $nomFichier
	Exemple : $nomFichier = "fichier.pdf" => type renvoyé : "application/pdf"
	 * @author 		:	patrick mveng<adelrick@gmail.com>
	 * @date		:	27 juin 2009
	 * @param string - $nomFichier - chemin d'accès à un fichier
	 */
	 function typeMime($nomFichier)
	{
	   // on détecte d'abord le navigateur, ça nous servira plus tard
	   if(preg_match("@Opera(/| )([0-9].[0-9]{1,2})@", $_SERVER['HTTP_USER_AGENT'], $resultats))
	      $navigateur="Opera";
	   elseif(preg_match("@MSIE ([0-9].[0-9]{1,2})@", $_SERVER['HTTP_USER_AGENT'], $resultats))
	      $navigateur="Internet Explorer";
	   else $navigateur="Mozilla";
	
	   // on récupère la liste des extensions de fichiers et leurs types Mime associés
	   $mime=parse_ini_file($this->doc_root .'/includes/mime.ini');
	   $extension=substr($nomFichier, strrpos($nomFichier, ".")+1);
	
	   /* on affecte le type Mime si on a trouvé l'extension sinon le type par défaut (un flux d'octets).
	   Attention : Internet Explorer et Opera ne supporte pas le type MIME standard */
	   
	   if(array_key_exists($extension, $mime)) {
	   	$type=$mime[$extension];
	   }	   
	   else {
	   	$type = ($navigateur!="Mozilla") ? 'application/octetstream' : 'application/octet-stream';
	   }
	//die ($navigateur);
	   return $type;
	}

	/**
	 * fonction qui fabrique une liste déroulante de type de documents
	 *
	 * @param unknown_type $pattributes
	 * @param unknown_type $pdefault
	 * @return unknown
	 */
	function sel_typedoc($pattributes , $pdefault = null, $pchoisissez = null)
	{
		global $translate;
		$this->exception = "";
		
		$larr_option_search = array();
		$larr_option_search[] = array("code" => 'dde_conge' , "value" => ucfirst($translate['dde_conge']));
		$larr_option_search[] = array("code" => 'dde_credit' , "value" => ucfirst($translate['dde_credit']));
						
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
	 * Télécharge le contenu d'un fichier sur le client de l'internaute, avec le nom spécifié.
	 *
	 * @param string $contenuFichier Le contenu du fichier à télécharger
	 * (obtenu avec file_get_contents() par exemple).
	 * @param string $nomFichier Nom du fichier qui sera proposé par défaut à l'internaute.
	 */
	function telechargerFichier($contenuFichier, $nomFichier)
	{
	   // on détermine le type MIME du fichier
	   // cf. http://www.asp-php.net/ressources/codes/PHP-Type+MIME+d%27un+fichier+a+partir+de+son+nom.aspx
	   $typeFichier=$this->typeMime($nomFichier);
	
	   // on nettoie le tampon d'affichage, et on désactive la compression ZLib
	   @ob_end_clean();
	   @ini_set('zlib.output_compression', '0');
	
	   // date courante
	   $maintenant=gmdate('D, d M Y H:i:s').' GMT';
	
	   // envoi des en-têtes nécessaires au navigateur
	   header('Content-Type: '.$typeFichier);
	   header('Content-Disposition: attachment; filename="'.$nomFichier.'"');
	
	   // Internet Explorer nécessite des en-têtes spécifiques
	   if(preg_match('/msie|(microsoft internet explorer)/i', $_SERVER['HTTP_USER_AGENT']))
	   {
	      header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	      header('Pragma: public');
	   }
	   else {
	   		header('Pragma: no-cache');
	   }
	
	   header('Last-Modified: '.$maintenant);
	   header('Expires: '.$maintenant);
	   header('Content-Length: '.strlen($contenuFichier));
	
	   // il ne reste plus qu'à envoyer le contenu du fichier
	   echo $contenuFichier;
	}
	
	
public function modifier_route_doc()
	{
		$retvalue = false;
		$req = "update document set numtache = ? , codeusercours = ? where numdoc= ?";

		$lparam_type=array();
        $lparam_data=array();
		$lparam_type[]="integer";
		$lparam_type[]="integer";
		$lparam_type[]="integer";
		
		$lparam_data[]=intval($this->numtache);
		$lparam_data[]=intval($this->codeusercours);
		$lparam_data[]=intval($this->numdoc);
		
//die($this->redraw_sql($req , $lparam_data , $lparam_type));
		
        $this->connect_db();
		if (!$this->db->isError ($lprepare = $this->db->prepare($req , $lparam_type)))
		{
        	if (!$this->db->isError ($result = $lprepare->Execute($lparam_data)))
			{
				$retvalue =  true;
			}
			else 
			{
				$this->exception = "document::modify() - ".$result-> getDebugInfo() . ' in ' . $req;
				$retvalue = false;
			}
		}
		else 
		{
			$this->exception = "document::modify()- ".$lprepare-> getDebugInfo() . ' in ' . $req;
			$retvalue = false;
		}
		$this->db->disconnect();
		
		return $retvalue;
	}

	
public function rechercher_tachecourante()
 {   
      $retvalue = array();      
      $this->exception = "";
	  
	  $lselect = " select numdoc , numtache ";
	  $lfrom = " from document ";
	  $lwhere = " where (not numdoc is null) ";
	  $land = " and numdoc = ? ";
	  	  
	  //initialisation du tableau de paramètres formels et effectifs pour la requête
	  $lparam_type = array();
	  $lparam_data = array();
	  
	  $lparam_type[]="integer";	  
	  $lparam_data[]=intval($this->numdoc);	  
	  
	  $req = $lselect . $lfrom . $lwhere . $land ;
	  
	  //die($this->redraw_sql($req , $lparam_data , $lparam_type));	  
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
				$this->exception = "workflow::rechercher_tachecourante() - ".$result->getDebugInfo() . ' in ' . $req;
				$retvalue = null;
			}
		}
		else 
		{
			$this->exception = "workflow::rechercher_tachecourante() - ".$lprepare->getDebugInfo() . ' in ' . $req;
			$retvalue = null;
		}
	  	$this->db->disconnect();
		return $retvalue;				
 }

 
public function rechercher_usercourant()
 {   
      $retvalue = array();      
      $this->exception = "";
	  
	  $lselect = " select numdoc , codeuser , numtache , archive ";
	  $lfrom = " from document ";
	  $lwhere = " where (not numdoc is null) ";
	  $land = " and codeusercours = ? and archive != 1 ";
	  	  
	  //initialisation du tableau de paramètres formels et effectifs pour la requête
	  $lparam_type = array();
	  $lparam_data = array();
	  
	  $lparam_type[]="integer";	  
	  $lparam_data[]=intval($this->codeusercours);	  
	  
	  $req = $lselect . $lfrom . $lwhere . $land ;
	  
	  //die($this->redraw_sql($req , $lparam_data , $lparam_type));	  
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
				$this->exception = "workflow::rechercher_usercourant() - ".$result->getDebugInfo() . ' in ' . $req;
				$retvalue = null;
			}
		}
		else 
		{
			$this->exception = "workflow::rechercher_usercourant() - ".$lprepare->getDebugInfo() . ' in ' . $req;
			$retvalue = null;
		}
	  	$this->db->disconnect();
		return $retvalue;				
 }


 public function rechercher_usernegatif()
 {   
      $retvalue = array();      
      $this->exception = "";
	  
	  $lselect = " select codeusercours,numdoc";
	  $lfrom = " from document ";
	  $lwhere = " where (not numdoc is null) ";
	  $land = " and archive != 1 and codeusercours < 0 ";
	  	  
	  //initialisation du tableau de paramètres formels et effectifs pour la requête
	  $lparam_type = array();
	  $lparam_data = array();
	  //$lparam_type[]="integer";	  
	  //$lparam_data[]=intval($this->numdoc);
	  
	  $req = $lselect . $lfrom . $lwhere . $land ;
	  	  
	  //die($this->redraw_sql($req , $lparam_data , $lparam_type));	  
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
				$this->exception = "workflow::rechercher_usernegatif() - ".$result->getDebugInfo() . ' in ' . $req;
				$retvalue = null;
			}
		}
		else 
		{
			$this->exception = "workflow::rechercher_usernegatif() - ".$lprepare->getDebugInfo() . ' in ' . $req;
			$retvalue = null;
		}
	  	$this->db->disconnect();
		return $retvalue;				
 }

 
 
}


?>