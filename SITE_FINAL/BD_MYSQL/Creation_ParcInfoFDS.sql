
/*
- SUPPRESSION DE LA BASE DE DONNEES
- CREATION DE LA BASE DE DONNEES
- SUPPRESSIONS DE TOUTES LES BASES CREEES POUR LE PROJET
*/


DROP DATABASE IF EXISTS Gestion_ParcInfoFDS;
CREATE DATABASE Gestion_ParcInfoFDS;
USE Gestion_ParcInfoFDS;

/*
Création de la base de  données
*/

DROP TABLE  IF EXISTS Ordinateur;
DROP TABLE  IF EXISTS Commande;
DROP TABLE  IF EXISTS CentreResponsable;
DROP TABLE  IF EXISTS Personne;
DROP TABLE  IF EXISTS Lieu;
DROP TABLE  IF EXISTS Compte;
DROP TABLE  IF EXISTS Gerer;
DROP TABLE  IF EXISTS Gere_Par_Hist;
DROP TABLE  IF EXISTS Dirige; 
DROP TABLE  IF EXISTS LOGERROR;


/*
Creation des relations 
*/

/* Structure de la table ordinateur */



CREATE TABLE Ordinateur (
  NumSerie varchar(30) ,
  Typee varchar(100) NOT NULL,
  Modele varchar(50) NOT NULL,
  NumImmobilisation varchar(50) UNIQUE,
  Fabricant varchar(50) NOT NULL,
  NumInventaire varchar(50) UNIQUE,
  Etat varchar(50) NOT NULL,
  Statut varchar(100) NOT NULL,
  detailSortieInventaire varchar(100) DEFAULT NULL,
  Remarque varchar(200) DEFAULT NULL,
  NbrAnneGarantie NUMERIC(2) NOT NULL DEFAULT 0,
  dateDebutGestion DATETIME  NOT NULL ,
  IdCR INT(15)   NOT NULL ,
  NumCommande INT(10) NOT NULL ,
  IdLieu varchar(25) NOT NULL,
    CONSTRAINT PK_Ordinateur PRIMARY Key (NumSerie)
    ) ;

/* Structure de la table Commande */

CREATE TABLE Commande (
  NumCommande INT(10) AUTO_INCREMENT,
  IdCommandeSIFAC varchar(50) DEFAULT NULL,
  Fournisseur varchar(50) NOT NULL,
  DateDebutGarantie Date  NOT NULL,
  IdCR INT(15)   NOT NULL ,
    CONSTRAINT PK_Commande PRIMARY Key (NumCommande)
    ) ;


/* Structure de la table CentreResponsable */

CREATE TABLE CentreResponsable (
  IdCR INT(15)   AUTO_INCREMENT,
  NomCR varchar(50) NOT NULL,
  typeStructure varchar(30) ,
  CodeCR NUMERIC(4)  ,
 
    CONSTRAINT PK_CentreResponsable PRIMARY Key (IdCR)
    ) ;

/* Structure de la table Personne */

CREATE TABLE Personne (
  IdPersonne INT(10)  AUTO_INCREMENT,
  Nom varchar(50) NOT NULL,
  Prenom varchar(50) NOT NULL,
  email varchar(50) UNIQUE ,
  NumTelephone NUMERIC(10) DEFAULT NULL,
  Qualite varchar(30),
 
    CONSTRAINT PK_Personne PRIMARY Key (IdPersonne)
    ) ;

/* Structure de la table Compte */

CREATE TABLE Compte (
  Login varchar(50)   ,
  password varchar(50)NOT NULL,
  IdPersonne INT(10) NOT NULL ,
 
    CONSTRAINT PK_Compte PRIMARY Key (Login)
    ) ;

/* Structure de la table Lieu */

CREATE TABLE Lieu (
  IdLieu varchar(25),
  NumSalle varchar(6) NOT NULL,
  NomSalle varchar(50) ,
  NumBatiment NUMERIC(2) NOT NULL ,
  NomBatiment varchar(50),
  NumCampus NUMERIC(2) NOT NULL,
  NomCampus varchar(50),
  NumNiveau varchar(2) NOT NULL,
  CapaciteTheorique  NUMERIC(3) NOT NULL,
  IdCR INT(15)   NOT NULL ,
  
 
    CONSTRAINT PK_Lieu PRIMARY Key (IdLieu)
    
    ) ;


/* Structure de la table Gerer */

CREATE TABLE Gerer (
  IdPersonne INT(10) NOT NULL   ,
  IdLieu varchar(25) NOT NULL,
  fonction varchar(50) ,
 
    CONSTRAINT PK_Gerer PRIMARY Key (IdPersonne,IdLieu)
    ) ;

/* Structure de la table Geré_Par_Hist */

CREATE TABLE Gere_Par_Hist (
  IdCR INT(15) NOT NULL ,
  NumSerie varchar(30) NOT NULL,
  dateDebutGestion DATETIME NOT NULL ,
  dateFinGestion DATETIME ,
  InfoFicheInventaire TEXT  NOT NULL,
  compteurModification INT(50) NOT NULL,
  typefiche varchar(100) NOT NULL,
 
    CONSTRAINT PK_Gere_Par_Hist PRIMARY Key (IdCR,NumSerie,dateDebutGestion)
    ) ;

/* Structure de la table Dirige */

CREATE TABLE Dirige (
  IdPersonne INT(10) NOT NULL ,
  IdCR INT(15) NOT NULL,
 
    CONSTRAINT PK_Dirige PRIMARY Key (IdPersonne,IdCR)
    ) ;




/*Les Contraintes clés étrangéres*/

ALTER TABLE Ordinateur  ADD CONSTRAINT fk1_Ordinateur FOREIGN KEY (IdCR) REFERENCES CentreResponsable (IdCR) ON DELETE CASCADE;    
ALTER TABLE Ordinateur ADD CONSTRAINT fk2_Ordinateur FOREIGN KEY (IdLieu) REFERENCES Lieu (IdLieu) ON DELETE CASCADE;
ALTER TABLE Ordinateur  ADD CONSTRAINT fk3_Ordinateur FOREIGN KEY (NumCommande) REFERENCES Commande (NumCommande) ON DELETE CASCADE;
ALTER TABLE Commande  ADD CONSTRAINT fk_Commande FOREIGN KEY (IdCR) REFERENCES CentreResponsable (IdCR) ON DELETE CASCADE;
ALTER TABLE Lieu ADD CONSTRAINT fk_Lieu FOREIGN KEY (IdCR) REFERENCES CentreResponsable  (IdCR) ON DELETE CASCADE;
ALTER TABLE Compte ADD CONSTRAINT fk_Compte FOREIGN KEY (IdPersonne) REFERENCES Personne (IdPersonne) ON DELETE CASCADE;
ALTER TABLE Gerer ADD CONSTRAINT fk1_Gerer FOREIGN KEY (IdPersonne) REFERENCES Personne (IdPersonne) ON DELETE CASCADE;
ALTER TABLE Gerer ADD CONSTRAINT fk2_Gerer FOREIGN KEY (IdLieu) REFERENCES Lieu (IdLieu) ON DELETE CASCADE;
ALTER TABLE Dirige ADD CONSTRAINT fk1_Dirige FOREIGN KEY (IdPersonne) REFERENCES Personne (IdPersonne) ON DELETE CASCADE;
ALTER TABLE Dirige ADD CONSTRAINT fk2_Dirige FOREIGN KEY (IdCR) REFERENCES CentreResponsable (IdCR) ON DELETE CASCADE;
ALTER TABLE Gere_Par_Hist ADD CONSTRAINT fk1_Gere_Par_Hist FOREIGN KEY ( IdCR) REFERENCES CentreResponsable  (IdCR) ON DELETE CASCADE;
ALTER TABLE Gere_Par_Hist ADD CONSTRAINT fk2_Gere_Par_Hist FOREIGN KEY ( NumSerie) REFERENCES Ordinateur (NumSerie) ON DELETE CASCADE;