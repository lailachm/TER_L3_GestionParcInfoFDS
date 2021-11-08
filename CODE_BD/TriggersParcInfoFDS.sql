/*creation de la table LOGERROR pour la gestion des erreurs par les triggers */

DROP TABLE  IF EXISTS LOGERROR;

CREATE TABLE LOGERROR  (
  ID INT(11) AUTO_INCREMENT,
  MESSAGE VARCHAR(255) DEFAULT NULL,
  CONSTRAINT PK_LOGERROR PRIMARY KEY (ID)
);


/* quelques triggers  */

/* ce trigger vérifié a chaque insertion d'un tuple dans 
la table personne que le mail est valide ( i.e sous la forme text@umontpellier.fr ), le nom et le prenom
ne sont pas null*/

DROP TRIGGER IF EXISTS before_insert_Personne;

DELIMITER $$
CREATE TRIGGER before_insert_Personne BEFORE INSERT
ON Personne
FOR EACH ROW
BEGIN
    IF New.Nom IS NULL
    THEN
    INSERT INTO LOGERROR (MESSAGE) VALUES (CONCAT('ERREUR : Le nom ne doit pas être NULL'));
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le nom ne doit pas être NULL';
    END IF;
    IF New.Prenom IS NULL
    THEN
    INSERT INTO LOGERROR (MESSAGE) VALUES (CONCAT('ERREUR : Le prenom ne doit pas être NULL'));
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le prenom ne doit pas être NULL';
    END IF;
    IF NEW.email NOT REGEXP '^[A-Z0-9._%-]+@umontpellier.fr$'
    THEN
    INSERT INTO LOGERROR (MESSAGE) VALUES (CONCAT('ERREUR : Votre email n"est pas valide , doit etre sous la forme "text@umontpellier.fr"'));
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Votre email n"est pas valide, doit etre sous la forme "text@umontpellier.fr"';
    END IF;
END $$
DELIMITER ;





/* ce trigger vérifié pour chaque modification dans la table personne 
 que le mail est valide ( i.e sous la forme text@umontpellier.fr ), le nom et le prenom ne sont pas null. */


DROP TRIGGER IF EXISTS before_update_Personne;

DELIMITER $$
CREATE TRIGGER before_update_Personne BEFORE UPDATE ON Personne
FOR EACH ROW
BEGIN
    IF New.Nom IS NULL
    THEN
    INSERT INTO LOGERROR (MESSAGE) VALUES (CONCAT('ERREUR : Le nom ne doit pas être NULL'));
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le nom ne doit pas être NULL';
    END IF;
     IF New.Prenom IS NULL
    THEN
    INSERT INTO LOGERROR (MESSAGE) VALUES (CONCAT('ERREUR : Le prenom ne doit pas être NULL'));
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le prenom ne doit pas être NULL';
    END IF;
    IF NEW.email NOT REGEXP '^[A-Z0-9._%-]+@umontpellier.fr$'
    THEN
    INSERT INTO LOGERROR (MESSAGE) VALUES (CONCAT('ERREUR :Votre email n"est pas valide,doit etre sous la forme "text@umontpellier.fr"'));
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Votre email n"est pas valide,doit etre sous la forme "text@umontpellier.fr"';
    END IF;
END
$$
DELIMITER ;



/* ce triggers verifie a chaque insertion dans la table ordinateur que 
l'etat est soit en panne, fonctionnel ou en réparation
Et le statut est soit Dans inventaire FDS ou Hors FDS dans inventaire UM ou bien Hors inventaire UM 
ET que le modele , type , fabricant,etat ,statut et la dateDebutGestion ne sont pas null .
*/

DROP TRIGGER IF EXISTS before_insert_Ordinateur;

DELIMITER $$
CREATE TRIGGER before_insert_Ordinateur BEFORE INSERT
ON Ordinateur
FOR EACH ROW
BEGIN

 IF New.Etat != 'En panne'
   AND New.Etat != 'Fonctionnel'
   AND New.Etat != 'En reparation'
      THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : L''etat doit être soit "En panne" ou "Fonctionnel" ou bien "En reparation"'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : L''etat doit être soit "En panne" ou "Fonctionnel" ou bien "En reparation"';
    END IF;
 IF New.Statut != 'Dans inventaire FDS'
   AND New.Statut != 'Hors FDS dans inventaire UM'
   AND New.Statut != 'Hors inventaire UM'
      THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le statut doit être soit "Dans inventaire FDS" ou "Hors FDS dans inventaire UM" ou bien "Hors inventaire UM"'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le statut doit être soit "Dans inventaire FDS" ou "Hors FDS dans inventaire UM" ou bien "Hors inventaire UM"';
    END IF;
   
    IF NEW.Modele IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le modele  ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le modele ne doit pas être NULL';
    END IF;
IF NEW.Fabricant IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le fabricant  ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le fabricant ne doit pas être NULL';
    END IF;
IF NEW.Typee IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le type  ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le type ne doit pas être NULL';
    END IF;
IF NEW.Etat IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : L"etat de l"ordinateur ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : L"etat de l"ordinateur ne doit pas être NULL';
    END IF;
IF NEW.Statut IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le statut d"un ordinateur ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le statut d"un ordinateur ne doit pas être NULL';
    END IF;
IF NEW.dateDebutGestion IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR:La date debut gestion d"un ordinateur par un centre responsable ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR:La date debut gestion d"un ordinateur par un centre responsable ne doit pas être NULL';
    END IF;
    
END $$
DELIMITER ;

/*Apres chaque insertion dans la table ordinateur, ce trriger insere  dans la table Gere_Par_Hist un tuplet que typefiche est Entrée et
mettre dans l'attribut  InfoFicheInventaire les informations necessaire pour la fiche entrée inventaire
*/

DROP TRIGGER IF EXISTS after_insert_Ordinateur;

DELIMITER $$
CREATE TRIGGER after_insert_Ordinateur AFTER INSERT
ON Ordinateur
FOR EACH ROW
BEGIN
DECLARE IdLieuNew,NumInv,NumImmo,nom,prenom,tel,mail,NomCR,typeStructure,sifac,fournisseur,nomResp,prenomResp,mailResp,telResp,dateGarantie VARCHAR(100);
SET NumInv=New.NumInventaire;
SET NumImmo=New.NumImmobilisation;
SET IdLieuNew=REPLACE(New.IdLieu,'/',';');

IF NumInv IS NULL
THEN SET NumInv='NULL';
END IF;
IF NumImmo IS NULL
THEN SET NumImmo='NULL';
END IF;

SELECT P1.Nom,P1.Prenom,P1.NumTelephone,P1.email,CentreResponsable.NomCR,CentreResponsable.typeStructure,Commande.IdCommandeSIFAC,Commande.Fournisseur,P2.Nom,P2.Prenom,P2.email,P2.NumTelephone,Commande.DateDebutGarantie INTO nom,prenom,tel,mail,NomCR,typeStructure,sifac,fournisseur,nomResp,prenomResp,mailResp,telResp,dateGarantie
FROM Personne P1,Personne P2,Commande,CentreResponsable,Gerer,Dirige
WHERE Gerer.IdPersonne=P2.IdPersonne AND Gerer.IdLieu=New.IdLieu AND Commande.NumCommande=New.NumCommande AND Commande.IdCR=CentreResponsable.IdCR AND Commande.IdCR=Dirige.IdCR AND P1.IdPersonne=Dirige.IdPersonne;

IF sifac IS NULL
THEN SET sifac='NULL';
END IF;
IF tel IS NULL
THEN SET tel='NULL';
END IF;
IF telResp IS NULL
THEN SET telResp='NULL';
END IF;


  	INSERT INTO Gere_Par_Hist(IdCR,NumSerie,dateDebutGestion,dateFinGestion,InfoFicheInventaire,compteurModification,typefiche) VALUES (New.IdCR,New.NumSerie,'1900-01-01',SYSDATE(),CONCAT(nom,';',prenom,';',tel,';',mail,';',NomCR,' ',typeStructure,';',sifac,';',New.Modele,';',New.Typee,';',New.Fabricant,';',fournisseur,';',New.NumSerie,';','',';',IdLieuNew,';',dateGarantie,';',NumImmo,';',NumInv,';','',';','',';','',';','',';','',';','',';',nomResp,';',prenomResp,';',telResp,';',mailResp),1,'Entrée'); 
    
END $$
DELIMITER ;



/*
À chaque modification du centre responsable ou du lieu d'un ordinateur ou les deux , ce triggers sera declanché pour modifier 
la dateDebutGestion par la date du jour de la modification et inserera dans la table geré-par-hist le numero de serie de cette ordi,
l'ancienne date debut gestion, la date du jour même comme date de fin gestion ,incrementera le compteur de modification, mettre dans l'attribut typefiche 'Modification' et mettre dans l'attribut infoFicheInventaire les informations concernant la fivhe d'une modification d'iventaire.   
Dans le cas ou c'est une modification de Statut le triggers sera declanché pour faire la meme chose sauf que dans l'attribut typefiche 'Sortie' et mettre dans l'attribut infoFicheInventaire les informations concernant la fiche d'une Sortie d'iventaire.  
Et verifie que l'etat est soit en panne, fonctionnel ou en réparation.
Et le statut est soit Dans inventaire FDS ou Hors FDS dans inventaire UM ou bien Hors inventaire UM 
ET que le modele , type , fabricant,etat ,statut et la dateDebutGestion ne sont pas null .
*/



DROP TRIGGER IF EXISTS before_update_Ordinateur;

DELIMITER $$
CREATE TRIGGER before_update_Ordinateur BEFORE UPDATE ON Ordinateur
FOR EACH ROW
BEGIN
DECLARE CPT INTEGER;
DECLARE detailSortieInv,IdLieuNew,IdLieuOld,NumInv,NumImmo,nomAncien,prenomAncien,telAncien,mailAncien,nomNouveau,prenomNouveau,mailNouveau,telNouveau VARCHAR(100);

SET NumInv=New.NumInventaire;
SET NumImmo=New.NumImmobilisation;
SET IdLieuNew=REPLACE(New.IdLieu,'/',';');
SET IdLieuOld=REPLACE(Old.IdLieu,'/',';');
SET detailSortieInv=New.detailSortieInventaire;

IF NumInv IS NULL
THEN SET NumInv='NULL';
END IF;
IF NumImmo IS NULL
THEN SET NumImmo='NULL';
END IF;

IF telAncien IS NULL
THEN SET telAncien='NULL';
END IF;
IF telNouveau IS NULL
THEN SET telNouveau='NULL';
END IF;


IF New.IdCR <> Old.IdCR OR Old.IdLieu <> New.IdLieu
    THEN
    SET New.dateDebutGestion=SYSDATE();
    END IF;
IF New.IdCR <> Old.IdCR OR  Old.IdLieu <> New.IdLieu
THEN

SELECT P1.Nom,P1.Prenom,P1.NumTelephone,P1.email,P2.Nom,P2.Prenom,P2.email,P2.NumTelephone
INTO nomAncien,prenomAncien,telAncien,mailAncien,nomNouveau,prenomNouveau,mailNouveau,telNouveau 
FROM Personne P1,Personne P2,Dirige D1, Dirige D2
WHERE D1.IdCR=old.IdCR AND D1.IdPersonne=P1.IdPersonne AND D2.IdCR=old.IdCR AND  P2.IdPersonne=D2.IdPersonne ;

 SELECT compteurModification INTO CPT FROM Gere_Par_Hist WHERE Gere_Par_Hist.NumSerie=Old.NumSerie AND Gere_Par_Hist.compteurModification>=ALL(SELECT compteurModification FROM Gere_Par_Hist WHERE Gere_Par_Hist.NumSerie=Old.NumSerie);
         



	INSERT INTO Gere_Par_Hist(IdCR,NumSerie,dateDebutGestion,dateFinGestion,InfoFicheInventaire,compteurModification,typefiche) VALUES (Old.IdCR,Old.NumSerie,Old.DateDebutGestion,SYSDATE(),CONCAT("",';','',';','',';','',';','',';','',';',Old.Modele,';',Old.Typee,';',Old.Fabricant,';','',';',Old.NumSerie,';',IdLieuOld,';',IdLieuNew,';','',';',NumImmo,';',NumInv,';','',SYSDATE(),';',nomAncien,';',prenomAncien,';',telAncien,';',mailAncien,';',nomNouveau,';',prenomNouveau,';',telNouveau,';',mailNouveau),CPT+1,'Modification');

END IF;

 IF new.Etat != 'En panne'
   AND new.Etat != 'Fonctionnel'
   AND new.Etat != 'En reparation'
      THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : L''etat doit être soit "En panne" ou "Fonctionnel" ou bien "En reparation"'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : L''etat doit être soit "En panne" ou "Fonctionnel" ou bien "En reparation"';
    END IF;
 IF new.Statut != 'Dans inventaire FDS'
   AND new.Statut != 'Hors FDS dans inventaire UM'
   AND new.Statut != 'Hors inventaire UM'

      THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le statut doit être soit "Dans inventaire FDS" ou "Hors FDS dans inventaire UM" ou bien "Hors inventaire UM"'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le statut doit être soit "Dans inventaire FDS" ou "Hors FDS dans inventaire UM" ou bien "Hors inventaire UM"';
    END IF;
    IF NEW.Statut='Hors inventaire UM'
    THEN
SELECT P1.Nom,P1.Prenom,P1.email,P1.NumTelephone
INTO nomNouveau,prenomNouveau,mailNouveau,telNouveau 
FROM Personne P1,Dirige D1 
WHERE D1.IdCR=Old.IdCR AND D1.IdPersonne=P1.IdPersonne;
 SELECT compteurModification INTO CPT FROM Gere_Par_Hist WHERE Gere_Par_Hist.NumSerie=Old.NumSerie AND Gere_Par_Hist.compteurModification>=ALL(SELECT compteurModification FROM Gere_Par_Hist WHERE Gere_Par_Hist.NumSerie=Old.NumSerie);


IF detailSortieInv IS NULL
THEN SET detailSortieInv='NULL';
END IF;
 INSERT INTO Gere_Par_Hist(IdCR,NumSerie,dateDebutGestion,dateFinGestion,InfoFicheInventaire,compteurModification,typefiche) VALUES (Old.IdCR,Old.NumSerie,Old.DateDebutGestion,SYSDATE(),CONCAT("",';','',';','',';','',';','',';','',';',Old.Modele,';',Old.Typee,';',Old.Fabricant,';','',';',Old.NumSerie,';',IdLieuOld,';','',';','',';',NumImmo,';',NumInv,';',detailSortieInv,';',SYSDATE(),';','',';','',';','',';','',';',nomNouveau,';',prenomNouveau,';',telNouveau,';',mailNouveau),CPT+1,'Sortie');

END IF; 
IF NEW.Modele IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le modele  ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le modele ne doit pas être NULL';
    END IF;
IF NEW.Fabricant IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le fabricant  ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le fabricant ne doit pas être NULL';
    END IF;
IF NEW.Typee IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le type  ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le type ne doit pas être NULL';
    END IF;
IF NEW.Etat IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : L"etat de l"ordinateur ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : L"etat de l"ordinateur ne doit pas être NULL';
    END IF;
IF NEW.Statut IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le statut d"un ordinateur ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le statut d"un ordinateur ne doit pas être NULL';
    END IF;
IF NEW.dateDebutGestion IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR:La date debut gestion d"un ordinateur par un centre responsable ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR:La date debut gestion d"un ordinateur par un centre responsable ne doit pas être NULL';
    END IF;
   
END $$
DELIMITER ;


/* verifie a chaque insertion dans la table compte que Le mot de passe et le login ne doivent pas être null*/

DROP TRIGGER IF EXISTS before_insert_Compte;

DELIMITER $$
CREATE TRIGGER before_insert_Compte BEFORE INSERT
ON Compte
FOR EACH ROW
BEGIN
IF NEW.Login IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le login ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le login ne doit pas être NULL';
    END IF;
    IF New.password IS NULL
    THEN
    INSERT INTO LOGERROR (MESSAGE) VALUES (CONCAT('ERREUR : Le mot de passe ne doit pas être NULL'));
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le mot de passe ne doit pas être NULL';
    END IF;
    
END $$
DELIMITER ;



/* verifie a chaque insertion dans la table compte que Le mot de passe et le login ne doivent pas être null*/

DROP TRIGGER IF EXISTS before_update_Compte;

DELIMITER $$
CREATE TRIGGER before_update_Compte BEFORE UPDATE
ON Compte
FOR EACH ROW
BEGIN
IF NEW.Login IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le login ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le login ne doit pas être NULL';
    END IF;
    IF New.password IS NULL
    THEN
    INSERT INTO LOGERROR (MESSAGE) VALUES (CONCAT('ERREUR : Le mot de passe ne doit pas être NULL'));
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le mot de passe ne doit pas être NULL';
    END IF;
END $$
DELIMITER ;

/* verifie que la capacite d'une salle n'est pas negative ou nul
et que NumSalle, NumBatiment,NumCampus et NumNiveau ne sont pas null */

DROP TRIGGER IF EXISTS before_insert_Lieu;

DELIMITER $$
CREATE TRIGGER before_insert_Lieu BEFORE INSERT 
ON Lieu
FOR EACH ROW
BEGIN
  IF NEW.NumSalle IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le numero de la salle ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le numero de la salle ne doit pas être NULL';
    END IF;
IF NEW.NumBatiment IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le numero du batiment  ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le numero du batiment ne doit pas être NULL';
    END IF;
IF NEW.NumCampus IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le numero du campus  ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le numero du campus ne doit pas être NULL';
    END IF;
IF NEW.NumNiveau IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le numero d"étage(NumNiveau)  ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le numero d"etage(NumNiveau) ne doit pas être NULL';
    END IF;

IF NEW.CapaciteTheorique IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : La capacité ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : La capacité ne doit pas être NULL';
    END IF;
    IF New.CapaciteTheorique < 0
    THEN
    INSERT INTO LOGERROR (MESSAGE) VALUES (CONCAT('ERREUR : La capacité de passe ne doit pas être negative'));
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : La capacité de passe ne doit pas être negative';
    END IF;
END $$
DELIMITER ;


/*ce trigger  verifie a chaque modification que la capacite d'une salle n'est pas negative ou nul
et que NumSalle, NumBatiment,NumCampus et NumNiveau ne sont pas null */

DROP TRIGGER IF EXISTS before_update_Lieu;

DELIMITER $$
CREATE TRIGGER before_update_Lieu BEFORE UPDATE
ON Lieu
FOR EACH ROW
BEGIN
IF NEW.NumSalle IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le numero de la salle ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le numero de la salle ne doit pas être NULL';
    END IF;
IF NEW.NumBatiment IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le numero du batiment  ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le numero du batiment ne doit pas être NULL';
    END IF;
IF NEW.NumCampus IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le numero du campus  ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le numero du campus ne doit pas être NULL';
    END IF;
IF NEW.NumNiveau IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le numero d"étage(NumNiveau)  ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le numero d"etage(NumNiveau) ne doit pas être NULL';
    END IF;
IF NEW.CapaciteTheorique IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : La capacité ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : La capacité ne doit pas être NULL';
    END IF;
    IF New.CapaciteTheorique < 0
    THEN
    INSERT INTO LOGERROR (MESSAGE) VALUES (CONCAT('ERREUR : La capacité de passe ne doit pas être negative'));
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : La capacité de passe ne doit pas être negative';
    END IF;
END $$
DELIMITER ;



/*ce trigger vérifié a chaque insertion d'un tuple dans 
la table Gere_Par_Hist  que la date est valide (dateDebutGestion > dateFinGestion),
que le typefiche n'est null et que il est soit  'Entrée','Modification'ou bien 'Sortie'.
 */

DROP TRIGGER IF EXISTS before_insert_Gere_Par_Hist;

DELIMITER $$
CREATE TRIGGER before_insert_Gere_Par_Hist BEFORE INSERT
ON Gere_Par_Hist
FOR EACH ROW
BEGIN
      IF new.typefiche != 'Entrée'
        AND new.typefiche != 'Modification'
        AND new.typefiche != 'Sortie'
      THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le typefiche doit être soit "Entrée" ou "Modification" ou bien "Sortie"'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le typefiche doit être soit "Entrée" ou "Modification" ou bien "Sortie"';
    END IF;
    IF NEW.typefiche IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le typefiche ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le typefiche ne doit pas être NULL';
    END IF;
    IF New.dateDebutGestion > NEW.dateFinGestion 
    THEN
    INSERT INTO LOGERROR (MESSAGE) VALUES (CONCAT('ERREUR : la date est invalide'));
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : la date est invalide';
    END IF;
END $$
DELIMITER ;

/*ce trigger vérifié a chaque insertion d'un tuple dans 
la table CentreResponsable que le NomCR n'est pas null.
 */

DROP TRIGGER IF EXISTS before_insert_CentreResponsable;

DELIMITER $$
CREATE TRIGGER before_insert_CentreResponsable BEFORE INSERT
ON CentreResponsable
FOR EACH ROW
BEGIN
      IF NEW.NomCR IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le nom du Centre Responsable ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le nom du Centre Responsable ne doit pas être NULL';
    END IF;
 END $$   
DELIMITER ;

/*ce trigger vérifié a chaque modification d'un tuple dans 
la table CentreResponsable que le NomCR n'est pas null.
 */
DROP TRIGGER IF EXISTS before_update_CentreResponsable;

DELIMITER $$
CREATE TRIGGER before_update_CentreResponsable BEFORE UPDATE
ON CentreResponsable
FOR EACH ROW
BEGIN
      IF NEW.NomCR IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le nom du Centre Responsable ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le nom du Centre Responsable ne doit pas être NULL';
    END IF;
    END $$
DELIMITER ;

/*ce trigger vérifié a chaque insertion d'un tuple dans 
la table Commande que le fournisseur et la date debut de gestion ne sont pas null.
 */

DROP TRIGGER IF EXISTS before_insert_Commande;

DELIMITER $$
CREATE TRIGGER before_insert_Commande BEFORE INSERT
ON Commande
FOR EACH ROW
BEGIN
      IF NEW.Fournisseur IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le fournisseur ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le fournisseur ne doit pas être NULL';
    END IF;
     IF NEW.DateDebutGarantie IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : La DateDebutGarantie  ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : La DateDebutGarantie ne doit pas être NULL';
    END IF;
    END $$
DELIMITER ;


/*ce trigger vérifié a chaque modification d'un tuple dans 
la table Commande que le fournisseur et la date debut de gestion ne sont pas null.
 */

DROP TRIGGER IF EXISTS before_update_Commande;

DELIMITER $$
CREATE TRIGGER before_update_Commande BEFORE UPDATE
ON Commande
FOR EACH ROW
BEGIN
      IF NEW.Fournisseur IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : Le fournisseur ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : Le fournisseur ne doit pas être NULL';
    END IF;
     IF NEW.DateDebutGarantie IS NULL THEN
       INSERT INTO LOGERROR (MESSAGE) VALUES(CONCAT('ERREUR : La DateDebutGarantie  ne doit pas être NULL'));
       SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='ERREUR : La DateDebutGarantie ne doit pas être NULL';
    END IF;
    END $$
DELIMITER ;


