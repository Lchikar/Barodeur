<?php
session_start();
require_once 'MyPDO.db.include.php'; // connexion à la bdd
$stmt1 = MyPDO::getInstance()->prepare(<<<SQL
    SELECT name FROM Bar
SQL
); 

$nom_bar = $_POST['nom_bar'];
$numero_rue = $_POST['numero_rue'];
$adresse = $_POST['adresse'];
$ville = $_POST['ville'];
$code_postal = $_POST['code_postal'];
$telephone_bar = $_POST['telephone_bar'];
$site_web = $_POST['site_web'];
$ajout_photo = $_POST['ajout_photo'];
$type_bar = $_POST['type_bar'];
$plus_dinfos = $_POST['plus_dinfos'];
$commentaire_ajout = $_POST['commentaire_ajout'];



if(!isset($nom_bar)){
    echo $nom_bar;
} else {
    echo "pas de numéro de bar";
}








?>