<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/navbar.css">
    <script src="https://kit.fontawesome.com/ed629eedcd.js" crossorigin="anonymous"></script>
    <title>Ecolotri - Nouvelle pesée</title>
</head>
<body>

    <?php
        include 'entity/Connexion.php';
        date_default_timezone_set('Europe/Paris');
        try{

            $requete =  Connexion::getInstance()->prepare("SELECT nom, id
                        from syndicat");

            $requete->execute();

            $curseur = $requete->fetchAll();

        }catch (PDOException $e) {
            echo "ça marche pas";
        }
    ?>

    <header>
        <nav>
            <!-- Accueil -->
            <a id="home" href="index.html">
                <img src="image/ecolotri.png" width="50" height="50">
            </a>

            <div class="navRight">
                <a class="navbutton" href="pesee.php">Nouvelle pesées</a>

                <a class="navbutton" href="liste.php">Liste pesées</a>

                <a class="navbutton" href="menu.html">Statistiques</a>
            </div>

        </nav>
    </header>

    <h1>Nouvelle Pesée</h1>
    <div class="containerTable">
        <form action="pesee.php" method="POST">
            <label for="syndicat">Choisir le Syndicat:</label>

            <select name="syndicat">
                <?php 
                foreach($curseur as $row) {
                    echo "<option value='" . $row['id'] ."'>".$row['nom']."</option>";
                }
                ?>
            </select>
            <?php
            $requete =  Connexion::getInstance()->prepare("SELECT id, libelle from typedechet");

            $requete->execute();

            $curseur = $requete->fetchAll();
            ?>
            <label for="dechet">Choisir le déchet :</label>
            <select name="dechet">
                <?php 
                foreach($curseur as $row) {
                    echo "<option value='" . $row['id'] ."'>".$row['libelle']."</option>";
                }
                ?>
            </select>
            <label for="dateDepot">Date de dépot : </label>
            <input type="date" name="dateDepot" value="<?php echo date('Y-m-d'); ?>" required>
            <label for="heure">Heure : </label>
            <input type="time" name="heure" value="<?php echo date('H:i'); ?>" required>
            <label for="poidArrivee">Poids d'arrivée (en tonnes)</label>
            <input type="number" name="poidArrivee" required>
            <label for="poidDepart">poids de Départ (en tonnes)</label>
            <input type="number" name="poidDepart" required>
            <label for="immatriculationCamion"> Immatriculation du Camion </label>
            <input type="text" name = "immatriculationCamion" placeholder="WW 251 WW" required>


            <input type="submit" value="Envoyer le formulaire" style="margin-top : 30px;">
        </form>
    </div>
    <?php 
        if ($_POST){
            $syndicat = $_POST['syndicat'];
            $dechet = $_POST['dechet'];
            $dateDepot = $_POST['dateDepot'];
            $heure = $_POST['heure'];
            $poidArrivee = $_POST['poidArrivee'];
            $poidDepart = $_POST['poidDepart'];
            $immatriculationCamion = $_POST['immatriculationCamion'];
            $query = Connexion::getInstance()->prepare("INSERT INTO pesee (dateDepot, heure, poidArrivee, poidDepart, immatriculationCamion, idDechet, idSyndicat) VALUES (:dateDepot, :heure, :poidArrivee, :poidDepart, :immatriculationCamion, :dechet, :syndicat)");
            $query->bindValue(':dateDepot', $dateDepot, PDO::PARAM_STR);
            $query->bindValue(':heure', $heure, PDO::PARAM_STR);
            $query->bindValue(':poidArrivee', $poidArrivee, PDO::PARAM_INT);
            $query->bindValue(':poidDepart', $poidDepart, PDO::PARAM_INT);
            $query->bindValue(':immatriculationCamion', $immatriculationCamion, PDO::PARAM_STR);
            $query->bindValue(':dechet', $dechet, PDO::PARAM_INT);
            $query->bindValue(':syndicat', $syndicat, PDO::PARAM_INT);
            $query->execute();
            echo('<div class="notification">
            <p><i class="fa-solid fa-check"></i> La pesée a bien été enregistrée</p>
            </div>');
        }
    ?>
        <footer>
        <p>STEPHAN Léo</p>
    </footer>
</body>
</html>