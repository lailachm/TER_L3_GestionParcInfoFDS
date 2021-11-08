/* 

Insertion de tuples dans les relations

*/


INSERT INTO CentreResponsable (NomCR,typeStructure ,CodeCR)VALUES
 ('LIRMM','RECHERCHE' ,2023),
 ('DRED','DIRECTION' ,1866),
 ('LMGC','RECHERCHE' ,2024),
 ('FDS','UFR INSTITUT ECOLE' ,1890);


INSERT INTO Commande(IdCommandeSIFAC ,Fournisseur ,DateDebutGarantie ,IdCR) VALUES
('4500112396','ECONOCOM' ,'2016-01-07',4),
('45001120212','ECONOCOM' ,'2017-04-24' ,4),
('4500112397','ECONOCOM' ,'2019-09-08' ,1),
('4500112017','ECONOCOM' ,'2017-12-04' ,1);

INSERT INTO Lieu (IdLieu,NumSalle,NomSalle, NumBatiment,NomBatiment,NumCampus, NomCampus, NumNiveau, CapaciteTheorique, IdCR) VALUES
('01/6/00/6.02','6.02','salle info', 6,'bat 6',01, 'Triolet', '00', 30,4),
('01/6/00/6.03','6.03','salle info', 6,'bat 6',01, 'Triolet', '00', 30,4),
('01/36/02/36.204','36.204','salle info',36,'bat 36',01, 'Triolet', '02', 40,1);


INSERT INTO Personne (Nom,Prenom,email,NumTelephone,Qualite) VALUES
('Rolland','Marc','Marc.Rolland@umontpellier.fr',0754788911,'enseignant'),
('Kern','Norbert','Norbert.Kern@umontpellier.fr',0767253736,'chercheur'),
('Gall-Borut','Pascale','Pascale.Gall-Borut@umontpellier.fr',0777072536,'enseignant'),
('bessy','stefan','stefan.bessy@umontpellier.fr',0637459812,'chercheur');

INSERT INTO Compte ( Login,password,IdPersonne) VALUES
( 'MarcRolland',sha1('12345'),1),
( 'kernnorbert',sha1('12345'),2),
( 'gallpascale',sha1('12345'),3),
( 'bessystefan',sha1('12345'),4);



INSERT INTO Gerer (IdPersonne,IdLieu,fonction) VALUES
(1,'01/6/00/6.02','ResponsableSI'),
(1,'01/6/00/6.03','ResponsableSI'),
(4,'01/36/02/36.204','ResponsableSI');

INSERT INTO  Dirige (IdPersonne,IdCR) VALUES
(1,3),
(2,1),
(3,4),
(4,2);


INSERT INTO Ordinateur(NumSerie, Typee, Modele,NumImmobilisation,Fabricant,NumInventaire,Etat,Statut, detailSortieInventaire,Remarque,NbrAnneGarantie, dateDebutGestion,IdCR,NumCommande, IdLieu) VALUES
('8CRMH5J', 'Workstation', 'OptiPlex 790','57M4HG12','Dell','UM000001', 'Fonctionnel','Dans inventaire FDS', NULL, 'Manque souris',2, '2016-02-12 00:00:00',1,1, '01/36/02/36.204'),
('FCRMH5J', 'Workstation', 'OptiPlex 790','10LFH472','Dell','UM004000','En panne','Dans inventaire FDS', Null ,NULL, 3 ,'2018-02-12 00:00:00',1,2, '01/6/00/6.02'),
('4FRMH5J', 'Workstation', 'OptiPlex 790','35D7PE45','Dell','UM004200', 'Fonctionnel','Dans inventaire FDS', NULL,NULL, 2,'2020-02-12 00:00:00',4,3, '01/6/00/6.03'),
('3DRMH5J', 'Workstation', 'OptiPlex 790','89SQW032','Dell','UM005000','Fonctionnel', 'Dans inventaire FDS', NULL, NUll, 3,'2019-05-15 00:00:00',4,4, '01/6/00/6.02'),
('1FRMH5K', 'Workstation', 'OptiPlex 790','57M4HG12','Dell','UM000001', 'Fonctionnel','Dans inventaire Paris8', NULL, NULL,2, '2016-02-12 00:00:00',1,1, '01/36/02/36.204');


/*

INSERT INTO  Gere_Par_Hist(IdCR,NumSerie,dateDebutGestion,dateFinGestion,InfoFicheInventaire,compteurModification,typefiche) VALUES
 (4,'8CRMH5J','1900-01-01','2016-01-07','Gall-Borut;Pascale;0777072536;Pascale.Gall-Borut@umontpellier.fr;FDS UFR INSTITUT ECOLE;4500112396;OptiPlex 790;Workstation;Dell;ECONOCOM;8CRMH5J;'';01/6/00/6.02;2016-01-07;57M4HG12;UM000001;'';'';'';'';'';'';Rolland;Marc;0754788911;Marc.Rolland@umontpellier.fr',1,'Entrée'),
 (4,'FCRMH5J','1900-01-01','2017-04-24','Gall-Borut;Pascale;0777072536;Pascale.Gall-Borut@umontpellier.fr;FDS UFR INSTITUT ECOLE;45001120212;OptiPlex 790;Workstation;Dell;ECONOCOM;FCRMH5J;'';01/36/02/36.204;2017-04-24;10LFH472;UM004000;'';'';'';'';'';'';bessy;stefan;0637459812;stefan.bessy@umontpellier.fr',1,'Entrée'),
 (1,'4FRMH5J','1900-01-01','2019-09-08','Kern;Norbert;0767253736;Norbert.Kern@umontpellier.fr;LIRMM RECHERCHE;4500112397;OptiPlex 790;Workstation;Dell;ECONOCOM;4FRMH5J;'';01/6/00/6.02;2019-09-08;35D7PE45;UM004200;'';'';'';'';'';'';Rolland;Marc;0754788911;Marc.Rolland@umontpellier.fr',1,'Entrée'),
 (1,'3DRMH5J','1900-01-01','2017-12-04','Kern;Norbert;0767253736;Norbert.Kern@umontpellier.fr;LIRMM RECHERCHE;4500112017;OptiPlex 790;Workstation;Dell;ECONOCOM;3DRMH5J;'';01/6/00/6.03;2017-12-04;89SQW032;UM005000;'';'';'';'';'';'';Rolland;Marc;0754788911;Marc.Rolland@umontpellier.fr',1,'Entrée') ,

 (4,'8CRMH5J','2016-01-07','2016-02-12',''';'';'';'';'';'';OptiPlex 790;Workstation;Dell;'';8CRMH5J;01/6/00/6.02;01/36/02/36.204;'';57M4HG12;UM000001;'';2016-02-12;Rolland;Marc;0754788911;Marc.Rolland@umontpellier.fr;bessy;stefan;0637459812;stefan.bessy@umontpellier.fr',2,'Modification'),

 (4,'FCRMH5J','2017-04-24','2018-02-12',''';'';'';'';'';'';OptiPlex 790;Workstation;Dell;'';FCRMH5J;01/36/02/36.204;01/6/00/6.03;'';10LFH472;UM004000;'';2018-02-12;bessy;stefan;0637459812;stefan.bessy@umontpellier.fr;Rolland;Marc;0754788911;Marc.Rolland@umontpellier.fr',2,'Modification'),

 (1,'4FRMH5J','2019-09-08','2020-02-12',''';'';'';'';'';'';OptiPlex 790;Workstation;Dell;'';4FRMH5J;01/6/00/6.02;01/6/00/6.03;'';35D7PE45;UM004200;'';2020-02-12;Rolland;Marc;0754788911;Marc.Rolland@umontpellier.fr;Rolland;Marc;0754788911;Marc.Rolland@umontpellier.fr',2,'Modification'),

 (1,'3DRMH5J','2017-12-04','2019-05-15',''';'';'';'';'';'';OptiPlex 790;Workstation;Dell;'';3DRMH5J;01/6/00/6.03;01/6/00/6.02;'';89SQW032;UM005000;'';2019-05-15;Rolland;Marc;0754788911;Marc.Rolland@umontpellier.fr;Rolland;Marc;0754788911;Marc.Rolland@umontpellier.fr',2,'Modification');


*/
