<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/ed629eedcd.js" crossorigin="anonymous"></script>
    <title>Ecolotri - Détail</title>
</head>
<body>
<?php 
    include 'entity/Connexion.php';
?>
<div class="nav">
    <a href="liste.php" class="returnarrow"><i class="fa-solid fa-arrow-left"></i><p>Retour</p></a>
    <a href="index.html" ><img src="image/ecolotri.png" alt="logo"></a>
</div>
<h1>Détail de la Pesée <?php echo $_GET['id'] ?></h1>
<div class="container">
    <div class="row">
        <div class='cell'>
            <p>Identifiant</p>
        </div>
        <div class='cell'>
            <p>Syndicat</p>
        </div>
        <div class='cell'>
            <p>Type de Déchet</p>
        </div>
        <div class='cell'>
            <p>Date depot</p>
        </div>
        <div class='cell'>
            <p>Heure</p>
        </div>
        <div class='cell'>
            <p>Poid d'arrivée</p>
        </div>
        <div class='cell'>
            <p>Poid de départ</p>
        </div>
        <div class='cell'>
            <p>Immatriculation camion</p>
        </div>
    </div>

<?php
    $requete =  Connexion::getInstance()->prepare("SELECT * FROM pesee INNER JOIN syndicat ON pesee.idSyndicat=syndicat.id INNER JOIN typedechet ON pesee.idDechet=typedechet.id WHERE pesee.id=:id");
    $requete->bindValue(':id', $_GET['id']);

    $requete->execute();

    $curseur = $requete->fetchAll();

    foreach($curseur as $r) {
        echo "<div class='row'>";
        echo "<div class='cell2'>";
        echo "<p>".$r['id']."</p>";
        echo "</div>";
        echo "<div class='cell2'>";
        echo "<p>".$r['nom']."</p>";
        echo "</div>";
        echo "<div class='cell2'>";
        echo "<p>".$r['libelle']."</p>";
        echo "</div>";
        echo "<div class='cell2'>";
        echo "<p>".date('d/m/Y',strtotime($r['dateDepot']))."</p>";
        echo "</div>";
        echo "<div class='cell2'>";
        echo "<p>".$r['heure']."</p>";
        echo "</div>";
        echo "<div class='cell2'>";
        echo "<p>".$r['poidArrivee']." tonnes</p>";
        echo "</div>";
        echo "<div class='cell2'>";
        echo "<p>".$r['poidDepart']." tonnes</p>";
        echo "</div>";
        echo "<div class='cell2'>";
        echo "<p>".$r['immatriculationCamion']."</p>";
        echo "</div>";
        echo "</div>";
    }
?>
</div>
    <footer>
        <p>Guillaume Bihry </p>
    </footer>
</body>
</html>