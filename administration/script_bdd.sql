-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Ven 14 Août 2009 à 11:25
-- Version du serveur: 5.0.51
-- Version de PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `bdd_workflow`
--

-- --------------------------------------------------------

--
-- Structure de la table `champ`
--

DROP TABLE IF EXISTS `champ`;
CREATE TABLE IF NOT EXISTS `champ` (
  `numchamp` int(11) NOT NULL,
  `nomchamp` varchar(20) NOT NULL,
  `typechamp` varchar(15) NOT NULL,
  `numdoc` int(4) NOT NULL,
  `valeurdonnee` varchar(255) default NULL,
  PRIMARY KEY  (`numchamp`)
) ENGINE=InnoDB DEFAULT CHARSET=ucs2;
-- --------------------------------------------------------

--
-- Structure de la table `circuit`
--

DROP TABLE IF EXISTS `circuit`;
CREATE TABLE IF NOT EXISTS `circuit` (
  `codecircuit` int(3) NOT NULL,
  `libcircuit` varchar(60) NOT NULL,
  `dureecircuit` int(3) NOT NULL,
  `numprocessus` int(4) NOT NULL,
  `archivecircuit` smallint(6) NOT NULL default '0',
  PRIMARY KEY  (`codecircuit`)
) ENGINE=InnoDB DEFAULT CHARSET=ucs2;

--
-- Structure de la table `circuit_tache`
--

DROP TABLE IF EXISTS `circuit_tache`;
CREATE TABLE IF NOT EXISTS `circuit_tache` (
  `numtache` int(3) NOT NULL,
  `codecircuit` int(3) default NULL,
  `codeprofil` int(2) default NULL,
  `codeuser` int(3) default NULL,
  `numtacheprec` int(3) default NULL,
  `numtachesuiv` int(3) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2;


--
-- Structure de la table `departement`
--

DROP TABLE IF EXISTS `departement`;
CREATE TABLE IF NOT EXISTS `departement` (
  `codedep` int(2) NOT NULL,
  `libdep` varchar(40) NOT NULL,
  PRIMARY KEY  (`codedep`)
) ENGINE=InnoDB DEFAULT CHARSET=ucs2;

--
-- Structure de la table `document`
--

DROP TABLE IF EXISTS `document`;
CREATE TABLE IF NOT EXISTS `document` (
  `numdoc` int(4) NOT NULL,
  `titredoc` varchar(40) NOT NULL,
  `datecreation` varchar(10) NOT NULL,
  `heurecreation` varchar(8) NOT NULL,
  `codeuser` int(3) NOT NULL,
  `numtache` int(3) NOT NULL,
  `archive` smallint(6) NOT NULL default '0',
  `typedoc` varchar(20) NOT NULL,
  PRIMARY KEY  (`numdoc`)
) ENGINE=InnoDB DEFAULT CHARSET=ucs2;


--
-- Structure de la table `donnee`
--

DROP TABLE IF EXISTS `donnee`;
CREATE TABLE IF NOT EXISTS `donnee` (
  `numchamp` int(11) NOT NULL,
  `datemodif` varchar(10) NOT NULL,
  `heuremodif` varchar(10) NOT NULL,
  `valeurdonnee` varchar(255) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2;


--
-- Structure de la table `etiquette`
--

DROP TABLE IF EXISTS `etiquette`;
CREATE TABLE IF NOT EXISTS `etiquette` (
  `tag` varchar(20) NOT NULL,
  `freq` float NOT NULL default '0',
  `numdoc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2;

--
-- Structure de la table `groupe`
--

DROP TABLE IF EXISTS `groupe`;
CREATE TABLE IF NOT EXISTS `groupe` (
  `codegroup` int(11) NOT NULL,
  `libgroup` varchar(100) NOT NULL,
  `supprimgroup` smallint(6) NOT NULL default '0'
) ENGINE=InnoDB DEFAULT CHARSET=ucs2;

--
-- Contenu de la table `groupe`
--

INSERT INTO `groupe` (`codegroup`, `libgroup`, `supprimgroup`) VALUES
(1, 'admin', 1),
(10, ',b,n', 0);

-- --------------------------------------------------------

--
-- Structure de la table `mail_account`
--

DROP TABLE IF EXISTS `mail_account`;
CREATE TABLE IF NOT EXISTS `mail_account` (
  `email` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2;


--
-- Structure de la table `mail_config`
--

DROP TABLE IF EXISTS `mail_config`;
CREATE TABLE IF NOT EXISTS `mail_config` (
  `mail_server` int(1) NOT NULL,
  `sender_email` varchar(100) default NULL,
  `sender_name` varchar(100) default NULL,
  `sendmail_path` varchar(255) default NULL,
  `smtp_auth` int(1) NOT NULL,
  `smtp_user` varchar(60) default NULL,
  `smtp_pwd` varchar(15) default NULL,
  `smtp_host` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=ucs2;

--
-- Contenu de la table `mail_config`
--

INSERT INTO `mail_config` (`mail_server`, `sender_email`, `sender_name`, `sendmail_path`, `smtp_auth`, `smtp_user`, `smtp_pwd`, `smtp_host`) VALUES
(3, NULL, NULL, 'azerty', 0, NULL, 'william', 'server-intranet.interfacesa.local');

-- --------------------------------------------------------

--
-- Structure de la table `mail_log`
--

DROP TABLE IF EXISTS `mail_log`;
CREATE TABLE IF NOT EXISTS `mail_log` (
  `log_id` int(1) NOT NULL,
  `log_date` varchar(10) NOT NULL,
  `log_heure` varchar(10) NOT NULL,
  `log_status` varchar(10) NOT NULL,
  `log_email` varchar(60) NOT NULL,
  PRIMARY KEY  (`log_id`)
) ENGINE=MyISAM DEFAULT CHARSET=ucs2;

--
-- Contenu de la table `mail_log`
--


-- --------------------------------------------------------

--
-- Structure de la table `mail_mail`
--

DROP TABLE IF EXISTS `mail_mail`;
CREATE TABLE IF NOT EXISTS `mail_mail` (
  `code_mail` int(1) NOT NULL,
  `sujet_mail` varchar(255) character set cp1250 NOT NULL,
  `body_mail` text,
  `format_mail` int(1) NOT NULL,
  `archive_mail` int(1) NOT NULL,
  `statut_mail` smallint(6) NOT NULL default '0',
  `auteur_mail` int(11) NOT NULL,
  `date_mail` varchar(10) NOT NULL,
  PRIMARY KEY  (`code_mail`)
) ENGINE=MyISAM DEFAULT CHARSET=ucs2;

--
-- Structure de la table `numerique`
--

DROP TABLE IF EXISTS `numerique`;
CREATE TABLE IF NOT EXISTS `numerique` (
  `numdoc` int(4) NOT NULL,
  `libfich` varchar(255) NOT NULL,
  `dateimport` varchar(10) NOT NULL,
  `heureimport` varchar(8) NOT NULL,
  `archive` smallint(6) NOT NULL default '0',
  `numform` int(11) NOT NULL,
  PRIMARY KEY  (`numdoc`)
) ENGINE=InnoDB DEFAULT CHARSET=ucs2;

--
-- Structure de la table `participe`
--

DROP TABLE IF EXISTS `participe`;
CREATE TABLE IF NOT EXISTS `participe` (
  `numworkflow` int(4) NOT NULL,
  `codeuser` int(3) NOT NULL,
  `utilisateurcourant` varchar(40) NOT NULL,
  `tempsmis` int(2) NOT NULL,
  `datecour` date NOT NULL,
  PRIMARY KEY  (`numworkflow`,`codeuser`)
) ENGINE=InnoDB DEFAULT CHARSET=ucs2;

--
-- Contenu de la table `participe`
--


-- --------------------------------------------------------

--
-- Structure de la table `processus`
--

DROP TABLE IF EXISTS `processus`;
CREATE TABLE IF NOT EXISTS `processus` (
  `numprocessus` int(4) NOT NULL,
  `libprocessus` varchar(40) NOT NULL,
  `dureeprocessus` int(2) default NULL,
  `etatprocessus` smallint(1) NOT NULL default '0',
  `supprimeprocessus` smallint(3) NOT NULL default '0',
  PRIMARY KEY  (`numprocessus`)
) ENGINE=InnoDB DEFAULT CHARSET=ucs2;

--
-- Contenu de la table `processus`
--

INSERT INTO `processus` (`numprocessus`, `libprocessus`, `dureeprocessus`, `etatprocessus`, `supprimeprocessus`) VALUES
(-1, 'Syst?me', NULL, 1, 0),
(1, 'Demande de cr?dit', NULL, 1, 0),
(2, 'jtyuiiyuiu', NULL, 1, 0),
(3, 'demande de congÃ©', 12, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `profil`
--

DROP TABLE IF EXISTS `profil`;
CREATE TABLE IF NOT EXISTS `profil` (
  `codeprofil` int(2) NOT NULL,
  `libprofil` varchar(40) NOT NULL,
  PRIMARY KEY  (`codeprofil`)
) ENGINE=InnoDB DEFAULT CHARSET=ucs2;

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `codeuser` int(3) NOT NULL,
  `nomuser` varchar(30) NOT NULL,
  `prenomuser` varchar(30) default NULL,
  `emailuser` varchar(30) default NULL,
  `loginuser` varchar(20) NOT NULL,
  `passworduser` varchar(35) NOT NULL,
  `numteluser` varchar(20) default NULL,
  `numburuser` varchar(20) default NULL,
  `numfaxuser` varchar(20) default NULL,
  `datenaissanceuser` varchar(10) default NULL,
  `typeuser` varchar(20) default NULL,
  `codegroup` int(11) NOT NULL,
  `villeuser` varchar(30) default NULL,
  `paysuser` varchar(30) default NULL,
  `codedep` int(3) default NULL,
  `codeprofil` int(11) default NULL,
  `connected` smallint(6) NOT NULL default '0',
  PRIMARY KEY  (`codeuser`)
) ENGINE=InnoDB DEFAULT CHARSET=ucs2;


--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`codeuser`, `nomuser`, `prenomuser`, `emailuser`, `loginuser`, `passworduser`, `numteluser`, `numburuser`, `numfaxuser`, `datenaissanceuser`, `typeuser`, `codegroup`, `villeuser`, `paysuser`, `codedep`, `codeprofil`, `connected`) VALUES
(1, 'admin', NULL, 'adelrick@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 1, 1),
(2, 'a', NULL, NULL, 'a', '0cc175b9c0f1b6a831c399e269772661', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 0, 0, 1),
(3, 'circuit', 'prenom', 'adelrick@yahoo.fr', 'circuit', 'de83e9b3d38c7a88b21f6ee0ef1d3647', '75353502', '33205478', '33205478', NULL, NULL, 3, 'yaounde', NULL, 0, 0, 0),
(4, 'kamga', NULL, NULL, 'kamga', '7e938df0a9e6a4325f33561b77681fc9', NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 0, 1, 0),
(5, 'ged', NULL, NULL, 'ged', '51072799958f8ae0d7bf4b415116ac47', NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, 0, 0, 0);

-- --------------------------------------------------------

DROP TABLE IF EXISTS `tache`;
CREATE TABLE IF NOT EXISTS `tache` (
  `numtache` int(3) NOT NULL,
  `libtache` varchar(100) NOT NULL,
  `dureetache` int(2) default NULL,
  `numprocessus` int(4) NOT NULL,
  `typedoc` varchar(255) default NULL,
  PRIMARY KEY  (`numtache`)
) ENGINE=InnoDB DEFAULT CHARSET=ucs2;

--
-- Contenu de la table `tache`
--

INSERT INTO `tache` (`numtache`, `libtache`, `dureetache`, `numprocessus`, `typedoc`) VALUES
(-8, 'Supprimer', 0, -1, 'do=doc_delete_valid'),
(-7, 'Archiver', 0, -1, 'do=doc_archive_valid'),
(-6, 'Rejeter', 0, -1, 'do=doc_rejeter_valid'),
(-5, 'Valider', 0, -1, 'do=doc_valider_valid'),
(-4, 'Réceptionner', 0, -1, 'do=doc_recevoir_valid'),
(-3, 'Modifier', 0, -1, 'do=doc_update_valid'),
(-2, 'Envoyer', 0, -1, NULL),
(-1, 'Enregistrer', 0, -1, 'do=doc_create_valid');



--
-- Structure de la table `module`
--

DROP TABLE IF EXISTS `module`;
CREATE TABLE IF NOT EXISTS `module` (
  `codemod` varchar(10) NOT NULL,
  `etatmod` smallint(6) NOT NULL default '1',
  `libmod` varchar(60) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2;

--
-- Contenu de la table `module`
--

INSERT INTO `module` (`codemod`, `etatmod`, `libmod`) VALUES
('ged', 0, 'Permet de stocker et administrer une base de documents'),
('mail', 0, 'Gestion des mails'),
('medicare', 0, 'Gestion du dossier médical');

-- --------------------------------------------------------

--
-- Structure de la table `module_config`
--

DROP TABLE IF EXISTS `module_config`;
CREATE TABLE IF NOT EXISTS `module_config` (
  `numchamp` int(11) NOT NULL,
  `nomchamp` varchar(20) NOT NULL,
  `typechamp` varchar(15) NOT NULL,
  `codemod` varchar(10) NOT NULL,
  `valeurdonnee` varchar(255) default NULL,
  PRIMARY KEY  (`numchamp`)
) ENGINE=InnoDB DEFAULT CHARSET=ucs2;

--
-- Contenu de la table `module_config`
--

--22 aout 2009

DROP TABLE IF EXISTS `config`;
CREATE TABLE IF NOT EXISTS `config` (
  `typebd` varchar(10) NOT NULL default 'mysql',
  `hotebd` varchar(30) NOT NULL,
  `userbd` varchar(15) NOT NULL,
  `pwdbd` varchar(15) default NULL,
  `nombd` varchar(20) NOT NULL,
  `uniteduree_process` int(11) NOT NULL default '1',
  `uniteduree_circuit` smallint(6) NOT NULL default '0',
  `uniteduree_tache` smallint(6) NOT NULL default '0',
  `listlimit` int(11) NOT NULL default '10',
  `notifmail` smallint(6) NOT NULL default '0',
  `hotesite` varchar(30) NOT NULL,
  `portsite` int(11) NOT NULL default '80'
) ENGINE=InnoDB DEFAULT CHARSET=ucs2;

-- 25 aout 2009


--
-- Structure de la table `workflow`
--

DROP TABLE IF EXISTS `workflow`;
CREATE TABLE IF NOT EXISTS `workflow` (
  `numworkflow` int(4) NOT NULL,
  `datedebutwf` varchar(10) NOT NULL,
  `heuredebutwf` varchar(10) NOT NULL,
  `dureewf` int(2) NOT NULL,
  `avancementwf` float NOT NULL default '0',
  `codecircuit` int(2) NOT NULL,
  `numtache` int(11) NOT NULL,
  `numdoc` int(11) NOT NULL,
  `archivewf` smallint(6) NOT NULL default '0',
  PRIMARY KEY  (`numworkflow`)
) ENGINE=InnoDB DEFAULT CHARSET=ucs2;

-- 25 aout 2009

--
-- Structure de la table `droit`
--


DROP TABLE IF EXISTS `droit`;
CREATE TABLE IF NOT EXISTS `droit` (
  `codeaction` varchar(30) NOT NULL,
  `codegroup` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2;
