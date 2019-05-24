<?php
session_start();
require_once '../MyPDO_config/MyPDO.db.include.php'; // connexion à la bdd

echo("Ajout des notes de ". $_SESSION['pseudo']." pour ".$_GET['bar']."<br>");

if(isset($_GET['prix1'])) $markprice = $_GET['prix1'];
else if(isset($_GET['prix2'])) $markprice = $_GET['prix2'];
else if(isset($_GET['prix3'])) $markprice = $_GET['prix3'];
else if(isset($_GET['prix4'])) $markprice = $_GET['prix4'];
else if(isset($_GET['prix5'])) $markprice = $_GET['prix5'];
else $markprice = 0;

if(isset($_POST['ambi1'])) $markambi = $_POST['ambi1'];
else if(isset($_POST['ambi2'])) $markambi = $_POST['ambi2'];
else if(isset($_POST['ambi3'])) $markambi = $_POST['ambi3'];
else if(isset($_POST['ambi4'])) $markambi = $_POST['ambi4'];
else if(isset($_POST['ambi5'])) $markambi = $_POST['ambi5'];
else $markambi = 0;

if(isset($_POST['dist1'])) $markdist = $_POST['dist1'];
else if(isset($_POST['dist2'])) $markdist = $_POST['dist2'];
else if(isset($_POST['dist3'])) $markdist = $_POST['dist3'];
else if(isset($_POST['dist4'])) $markdist = $_POST['dist4'];
else if(isset($_POST['dist5'])) $markdist = $_POST['dist5'];
else $markdist = 0;

if(isset($_POST['gen1'])) $markgen = $_POST['gen1'];
else if(isset($_POST['gen2'])) $markgen = $_POST['gen2'];
else if(isset($_POST['gen3'])) $markgen = $_POST['gen3'];
else if(isset($_POST['gen4'])) $markgen = $_POST['gen4'];
else if(isset($_POST['gen5'])) $markgen = $_POST['gen5'];
else $markgen = 0;

$marktypes = array('ambiance' => $markambi, 'general' => $markgen,
             'prix' => $markprice, 'distance' => $markdist);

if(isset($_GET['bar']) && !empty($_GET['bar'])){
    foreach ($marktypes as $marktype => $markvalue) {
        $stmt2 = MyPDO::getInstance()->prepare(
                "INSERT INTO Mark (id_markType, id_user, id_bar, value) VALUES(
                (SELECT markType.id_markType FROM markType WHERE markType.markType = :markType),
                (SELECT User.id_user FROM User WHERE User.pseudo = :pseudo),
                (SELECT Bar.id_bar FROM Bar WHERE Bar.name = :bar),
                :value_mark);");

        $stmt2->bindValue(':markType', $marktype);
        $stmt2->bindValue(':value_mark', $markvalue);
        $stmt2->bindValue(':pseudo', $_SESSION['pseudo']);
        $stmt2->bindValue(':bar', $_GET['bar']);

        $stmt2->execute();
        $stmt2->closeCursor();

        echo $marktype.": ".$markvalue."<br>";
    }
}
//header('location: afficher_bar.php?bar='.$_GET['bar']);
//exit();

?>