
/* Quelques requetes  */

/* 
Affichage des tuples
*/
SELECT * FROM Ordinateur;
SELECT * FROM Commande;
SELECT * FROM CentreResponsable;
SELECT * FROM Lieu;
SELECT * FROM Personne;
SELECT * FROM Compte;
SELECT * FROM Gerer;
SELECT * FROM Gere_Par_Hist;
SELECT * FROM  Dirige;

/* la date de fin de garantie d'un ordinateur */

SELECT ADDDATE(DateDebutGarantie,INTERVAL NbrAnneGarantie YEAR) as DateFinGarantie
FROM Ordinateur,Commande
WHERE Commande.NumCommande=Ordinateur.NumCommande;

/* le nombre d'ordinateur dans chaque salle avec la capacité de cet salle (pour savoir si eventuellement on peut ajoiuter un ordinateur)*/

SELECT NumSalle,count(DISTINCT NumSerie) as nombres_ordis,CapaciteTheorique
FROM Ordinateur, Lieu
WHERE Lieu.IdLieu=Ordinateur.IdLieu
GROUP BY NumSalle;

/* afficher les salles qui sont gerer par une personne donnée */

SELECT NumSalle,NomSalle
FROM Lieu,Personne,Gerer
WHERE Gerer.IdPersonne=Personne.IdPersonne AND Gerer.IdLieu=Lieu.IdLieu
      AND nom='Rolland' AND prenom='Marc';


/* afficher l'ordinateur que son numSerie  passer en parametre */

SELECT * FROM Ordinateur WHERE NumSerie='8CRMH5J';


/* afficher les ordinateurs qui sont dans la salle qu on a passer son NumSalle en parametre */                                           
SELECT NumSerie
FROM Ordinateur, Lieu 
WHERE Ordinateur.IdLieu=Lieu.IdLieu AND Lieu.NumSalle ='6.02';


/* afficher les ordinateurs qui sont dans le batiment qu'on a passer son Numero  en parametre */                                           

SELECT NumSerie
FROM Ordinateur, Lieu 
WHERE Ordinateur.IdLieu=Lieu.IdLieu AND Lieu.NumBatiment ='36';

/* afficher les ordinateurs qui sont sous garantie  */
SELECT NumSerie
FROM Ordinateur O1,Commande
WHERE O1.NumCommande=Commande.NumCommande AND SYSDATE()<(SELECT ADDDATE(DateDebutGarantie,INTERVAL NbrAnneGarantie YEAR) as DateFinGarantie								FROM Ordinateur O2,Commande
      					      		WHERE Commande.NumCommande=O2.NumCommande AND O2.NumSerie=O1.NumSerie);
/* afficher les ordinateurs qui sont hors garantie */

SELECT NumSerie
FROM Ordinateur O1,Commande
WHERE O1.NumCommande=Commande.NumCommande AND SYSDATE()>(SELECT ADDDATE(DateDebutGarantie,INTERVAL NbrAnneGarantie YEAR) as DateFinGarantie								FROM Ordinateur O2,Commande
      					      		WHERE Commande.NumCommande=O2.NumCommande AND O2.NumSerie=O1.NumSerie);

/* afficher les ordinateurs qui sont En panne  */

SELECT NumSerie 
FROM Ordinateur 
WHERE Ordinateur.Etat='En panne';

/* afficher les ordinateurs qui sont Fonctionnel */

SELECT NumSerie 
FROM Ordinateur 
WHERE Ordinateur.Etat='Fonctionnel';

/* afficher les ordinateurs qui sont En reparation */

SELECT NumSerie 
FROM Ordinateur 
WHERE Ordinateur.Etat='En reparation';
/* afficher les ordinateurs qui sont Dans inventaire UM  */


SELECT NumSerie 
FROM Ordinateur 
WHERE Ordinateur.Statut=' Dans inventaire UM ';

/* afficher les ordinateurs qui sont  Hors inventaire UM dans FDS */

SELECT NumSerie
FROM Ordinateur 
WHERE Ordinateur.Etat=' Hors inventaire UM dans FDS';


/* afficher les ordinateurs qui sont Hors inventaire UM  */


SELECT NumSerie
FROM Ordinateur 
WHERE Ordinateur.Etat='Hors inventaire UM';


/* Afficher le statut d’un ordinateur */ 

SELECT Statut FROM Ordinateur WHERE NumSerie ='8CRMH5J';
							
/* Afficher la liste des ordinateurs de la salle ainsi que leur état */

SELECT Statut,NumSerie, NumSalle  FROM Ordinateur, Lieu
WHERE  Lieu.IdLieu=Ordinateur.IdLieu
GROUP BY NumSalle, NumSerie, Statut;

/* Afficher la personne à contacter en cas de problème sur un ordinateur */

Select Personne.IdPersonne,email
FROM Personne, Ordinateur, Gerer
Where Personne.IdPersonne=Gerer.IdPersonne AND Ordinateur.IdLieu=Gerer.IdLieu
      AND NumSerie='8CRMH5J';
       

/* Afficher l’historique d’un ordinateur donné(entrée,sortie,modification) */

SELECT InfoFicheInventaire
FROM Gere_Par_Hist
WHERE NumSerie='8CRMH5J'
ORDER BY dateFinGestion;
      
/* Afficher l’historique de modification d'inventaire d’un ordinateur donné*/

SELECT InfoFicheInventaire
FROM Gere_Par_Hist
WHERE NumSerie='8CRMH5J' AND typefiche='Modification'
ORDER BY dateFinGestion;

/* Afficher la liste des ordinateurs à renouveler (i.e en fin de garantie ou arrivant en fin de garantie avant l’année prochaine) */
SELECT NumSerie
FROM Ordinateur O1,Commande
WHERE O1.NumCommande=Commande.NumCommande
AND SYSDATE()>=(SELECT ADDDATE(DateDebutGarantie,INTERVAL NbrAnneGarantie-1 YEAR) as DateFinGarantie
FROM Ordinateur O2,Commande
WHERE Commande.NumCommande=O2.NumCommande AND O2.NumSerie=O1.NumSerie);

/* Afficher l’historique d'entrée inventaire des ordinateurs  */


SELECT InfoFicheInventaire 
FROM Gere_Par_Hist
WHERE typefiche='Entrée'
ORDER BY dateFinGestion;

/*  Afficher l’historique de sortie inventaire des ordinateurs */

SELECT InfoFicheInventaire 
FROM Gere_Par_Hist
WHERE typefiche='Sortie'
ORDER BY dateFinGestion;



/*  Afficher l’historique de modification inventaire des ordinateurs  */


SELECT InfoFicheInventaire 
FROM Gere_Par_Hist
WHERE typefiche='Modification'
ORDER BY dateFinGestion;


/*  Afficher les ordinateurs sans étiquetes c-à-d sans NumInventaire  */


SELECT NumSerie 
FROM Ordinateur
WHERE NumInventaire is NULL;


/* afficher les ordinateurs qui sont En panne  ou en reparation*/

SELECT NumSerie 
FROM Ordinateur 
WHERE Ordinateur.Etat='En panne' OR Ordinateur.Etat='En reparation';

/* Modifier le lieu et le centre responsable d'un ordinateur donné */

UPDATE Ordinateur SET IdCR=3 , IdLieu='01/6/00/6.03'    WHERE NumSerie='3DRMH5J';


/* Modifier le lieu d'un ordinateur donné*/

UPDATE Ordinateur SET IdLieu='01/6/00/6.03'    WHERE NumSerie='3DRMH5J';


/* Modifier le centre responsable d'un ordinateur donné*/

UPDATE Ordinateur SET IdCR=3  WHERE NumSerie ='3DRMH5J';

/* Modifier le statut d'un ordinateur donné*/

UPDATE Ordinateur SET Statut= 'Hors inventaire UM'  WHERE NumSerie ='11AZ45ER';


UPDATE Ordinateur SET IdLieu='01/6/00/6.02' WHERE NumSerie=1FRMH5K;
