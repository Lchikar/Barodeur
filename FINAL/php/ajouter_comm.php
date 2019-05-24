<?php
session_start();
require_once '../MyPDO_config/MyPDO.db.include.php'; // connexion à la bdd


echo "Commentaire GET: ".$_GET['comm'];

if(isset($_GET['comm']) && !empty($_GET['comm'])){
    $comm = $_GET['comm'];
}

if(isset($_GET['bar']) && !empty($_GET['bar'])){
    $stmt = MyPDO::getInstance()->prepare(
            "INSERT INTO Comment (id_user, id_bar, text) VALUES (
                (SELECT User.id_user FROM User WHERE User.pseudo = :pseudo),
                (SELECT Bar.id_bar FROM Bar WHERE Bar.name = :bar),
                :comm);");

    $stmt->bindValue(':bar', $_GET['bar']);
    $stmt->bindValue(':pseudo', $_SESSION['pseudo']);
    $stmt->bindValue(':comm', $comm);
    $stmt->execute();
    $stmt->closeCursor();
}
echo("Ajout du comm '".$comm."' de ". $_SESSION['pseudo']." pour ".$_GET['bar']);
header('location: afficher_bar.php?bar='.$_GET['bar']);
exit();

?>