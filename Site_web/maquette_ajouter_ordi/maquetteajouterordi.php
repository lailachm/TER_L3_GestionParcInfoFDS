<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="CSS/style.css"/> 
    <title>Ajouter un ordinateur</title>
</head>

<body>
    <div>
        <img src="images/logo.png" alt="Logo UM" class="logo" />
        <a href="#" class="bttn_accueil">Accueil</a>
        <h1 class="h1_inventaire"> INVENTAIRE </h1>
    </div>

    <div class="corps_inventaire">
        <div class="div_inventaire">
            <h2 class="h2_inventaire">Ajouter des ordinateurs via un fichier CSV</h2>

            <form>
                <label class="label_inventaire">Fichier</label>
                <input type="file" name="fichier" accept=".csv">
                <button type="submit" name ="Envoyer"> Envoyer </button>
            </form>
            <br>

            <div class="div_inventaire">
                <h3 class="h3_inventaire">Trame du fichier CSV pour ajouter des ordinateurs</h3>
                Les fichiers CSV doivent respecter cet ordre (veiller à bien respecter la casse et à créer les colonnes même si elles ne seront pas remplies par la suite):
                <br>
                <br>

                <table>
                   <tr>
                       <th>numSerie <span style="color: red;">*</span></th>
                       <th>type <span style="color: red;">*</span></th>
                       <th>marque <span style="color: red;">*</span></th>
                       <th>modele <span style="color: red;">*</span></th>
                       <th>nbAnneeGarantie <span style="color: red;">*</span></th>
                       <th>numCommande <span style="color: red;">*</span></th>
                       <th>fournisseur </th>
                       <th>dateDebGarantie <span style="color: red;">*</span></th>
                       <th>idLieu <span style="color: blue;">**</span></th>
                       <th>idCentreResponsable <span style="color: blue;">**</span></th>
                       <th>numInventaire </th>
                       <th>numImmo </th>
                   </tr>

                   <tr>
                       <td>8D9VJX2</td>
                       <td>Workstation</td>
                       <td>Dell</td>
                       <td>Optiplex 7440 AIO</td>
                       <td>5</td>
                       <td>4500112396</td>
                       <td>FDS</td>
                       <td>05/07/2016</td>
                       <td>01/05/1/47.0</td>
                       <td>152</td>
                       <td></td>
                       <td></td>
                   </tr>
               </table>
               <br>

               <span style="color: red;">* OBLIGATOIRE</span>
               <br>
               <br>

               <span style="color: blue;">** EXPLICATIONS</span>
               <br>

               Correspondance entre idLieu et les salles de la FDS :
               <br>
               <br>
               <table>
                <tr>
                    <th>idLieu</th>
                    <th>Salle correspondante</th>
                </tr>
                <tr>
                    <td>01/05/1/47.0</td>
                    <td>Campus Triolet / Bâtiment 5 / Étage 1 / TD5.17</td>
                </tr>
            </table>
            <br>
            <br>

            Correspondance entre idCentreResponsable et les centres responsables :
            <br>
            <br>
            <table>
                <tr>
                    <th>idCentreResponsable</th>
                    <th>Centre responsable correspondant</th>
                </tr>
                <tr>
                    <td>152</td>
                    <td>Département Informatique</td>
                </tr>
            </table>
            <br>
            <br>
        </div>
    </div>

    <div class="div_inventaire">
        <h2 class="h2_inventaire">Ajouter un ordinateur manuellement</h2>
        <form>
            <label class="label_inventaire">N° Série <span style="color: red;">*</span> :</label>
            <input type="text" name="numserie" placeholder="ex : 8D9VJX2" required>


            <label class="label_inventaire">Type <span style="color: red;">*</span> :</label>
            <input type="text" name="type" placeholder="ex : Workstation" required>


            <label class="label_inventaire">Marque <span style="color: red;">*</span> :</label>
            <input type="text" name="marque" placeholder="ex : Dell" required>
            <br>
            <br>

            <label class="label_inventaire">Modèle <span style="color: red;">*</span> :</label>
            <input type="text" name="modele" placeholder="ex : Optiplex 7440 AIO" required>


            <label class="label_inventaire">Nombre d'années de garantie <span style="color: red;">*</span> :</label>
            <input type="number" name="nbAnneeGarantie" required>


            <label class="label_inventaire">N° Commande <span style="color: red;">*</span> :</label>
            <input type="text" name="numCommande" placeholder="ex : 4500112396" required>
            <br>
            <br>

            <label class="label_inventaire">Fournisseur :</label>
            <input type="text" name="fournisseur" placeholder="ex : FDS">


            <label class="label_inventaire">Date de début de garantie (=date d'expédition) <span style="color: red;">*</span> :</label>
            <input type="date" name="dateDebGarantie" placeholder="ex : 05/07/2016" required>


            <label class="label_inventaire">Centre responsable :</label>
            <select name="CR" size="1">
                <option/>Non renseigné
                <option/>Commun FDS
                <option/>Département Informatique
                <option/>Département Chimie
                <option/>Département Physique
                <option/>Département Mathématiques
            </select>
            <br>
            <br>

            <label class="label_inventaire">Salle :</label>
            <select name="salle" size="1">
                <option/>Non renseigné
                <option/>TD1.01
                <option/>TD1.02
                <option/>TD1.03
            </select>

            <label class="label_inventaire">N° Inventaire :</label>
            <input type="text" name="numinventaire">

            <label class="label_inventaire">N° Immobilisation :</label>
            <input type="text" name="numimmobilisation">
            <br>
            <br>

            <button type="submit" name ="ajouter">Ajouter</button>
        </form>
        <br>
        <br>
        <span style="color: red;">* OBLIGATOIRE</span>
        <br>
        <br>
    </div>


</div>

</body>
</html>