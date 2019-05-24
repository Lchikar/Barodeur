<?php
session_start();
require_once '../MyPDO_config/MyPDO.db.include.php'; // connexion à la bdd

echo("Ajout des notes de ". $_SESSION['pseudo']." pour ".$_GET['bar']."<br>");

if(isset($_GET['ambi1'])) $markambi = $_GET['ambi1'];
else if(isset($_GET['ambi2'])) $markambi = $_GET['ambi2'];
else if(isset($_GET['ambi3'])) $markambi = $_GET['ambi3'];
else if(isset($_GET['ambi4'])) $markambi = $_GET['ambi4'];
else if(isset($_GET['ambi5'])) $markambi = $_GET['ambi5'];
else $markambi = 0;

if(isset($_GET['prix1'])) $markprice = $_GET['prix1'];
else if(isset($_GET['prix2'])) $markprice = $_GET['prix2'];
else if(isset($_GET['prix3'])) $markprice = $_GET['prix3'];
else if(isset($_GET['prix4'])) $markprice = $_GET['prix4'];
else if(isset($_GET['prix5'])) $markprice = $_GET['prix5'];
else $markprice = 0;

if(isset($_GET['dist1'])) $markdist = $_GET['dist1'];
else if(isset($_GET['dist2'])) $markdist = $_GET['dist2'];
else if(isset($_GET['dist3'])) $markdist = $_GET['dist3'];
else if(isset($_GET['dist4'])) $markdist = $_GET['dist4'];
else if(isset($_GET['dist5'])) $markdist = $_GET['dist5'];
else $markdist = 0;

if(isset($_GET['gen1'])) $markgen = $_GET['gen1'];
else if(isset($_GET['gen2'])) $markgen = $_GET['gen2'];
else if(isset($_GET['gen3'])) $markgen = $_GET['gen3'];
else if(isset($_GET['gen4'])) $markgen = $_GET['gen4'];
else if(isset($_GET['gen5'])) $markgen = $_GET['gen5'];
else $markgen = 0;

$marktypes = array('ambiance' => $markambi, 'prix' => $markprice,
              'distance' => $markdist, 'general' => $markgen);

foreach ($marktypes as $marktype => $markvalue)
    echo "$marktype = $markvalue<br>";


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
header('location: afficher_bar.php?bar='.$_GET['bar']);
exit();

?>