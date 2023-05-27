<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <script src="https://kit.fontawesome.com/ed629eedcd.js" crossorigin="anonymous"></script>
    <title>Ecolotri - Total date</title>
</head>
<body>
<header>
    <nav>
        <!-- Accueil -->
        <a id="home" href="index.html">
            <img src="../image/ecolotri.png" width="50" height="50">
        </a>

        <div class="navRight">
            <a class="navbutton" href="../pesee.php">Nouvelle pesées</a>

            <a class="navbutton" href="../liste.php">Liste pesées</a>

            <a class="navbutton" href="../menu.html">Statistiques</a>
        </div>

    </nav>
</header>
<?php
include '../entity/Connexion.php';

if(isset($_GET['date1']) && isset($_GET['date2'])){
    echo "<h1>Total de Déchet entre le ".date('d/m/Y',strtotime($_GET['date1']))." et le ".date('d/m/Y',strtotime($_GET['date2']))."</h1>";
}else {
    echo "<h1>Total de Déchet entre Deux Dates</h1>";
}
?>
    <div class="containerTable">
        <form action="totalDate.php" method="get">
            <label for="date">Choisir un intervalle de date :</label>
            <?php
            if(isset($_GET['date1']) && isset($_GET['date2'])){ 
                echo "<input type='date' name='date1' value='".$_GET['date1']."'>";
                echo "<input type='date' name='date2' value='".$_GET['date2']."'>";
            }else {
                echo "<input type='date' name='date1'>";
                echo "<input type='date' name='date2'>";
            }
            ?>
            <input type="submit" class="submit" value="Valider">
        </form>
    </div>

        <?php
                if(isset($_GET['date1']) && isset($_GET['date2'])){
                    $query = Connexion::getInstance()->prepare("SELECT SUM(poidArrivee - poidDepart) AS TOTAL FROM pesee WHERE dateDepot BETWEEN :date1 AND :date2");
                    $query->bindParam(':date1', $_GET['date1']);
                    $query->bindParam(':date2', $_GET['date2']);
                    $query->execute();
                    $result = $query->fetchAll();
                    foreach($result as $row) {
                        echo "
                        <div class=\"boite_container\">
                            <div class=\"box\">
                                <p> Le total de déchet entre le ".date('d/m/Y',strtotime($_GET['date1']))." et le ".date('d/m/Y',strtotime($_GET['date2']))." est de ".$row['TOTAL']." tonnes.</p>
                            </div>
                        </div>
                        ";
                    }
                }
            ?>
        <footer>
        <p>STEPHAN Léo </p>
    </footer>
</body>
</html>