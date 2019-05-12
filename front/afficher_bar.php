<?php
session_start(); 
include("connexion.php"); 

if(!isset($_POST['bar'])){
	echo "Erreur POST\n";
}

$general = $bdd->query("SELECT name, 
CONCAT (numStreet, street, postalCode, cityName) as adresse,
website, numPhone, infos, photo
FROM Bar NATURAL JOIN City
WHERE Bar.name = ". $_POST['bar'] .";");

$note = $bdd->query("SELECT Bar.name, 
User.pseudo, 
Mark.value, 
markType.markType 
FROM Bar NATURAL JOIN Mark NATURAL JOIN User NATURAL JOIN markType 
WHERE Bar.name = ". $_POST['bar'].";");

$comm = $bdd->query("SELECT Bar.name, 
User.pseudo, 
Comment.text 
FROM Bar NATURAL JOIN Comment NATURAL JOIN User 
WHERE Bar.name = ".$_POST['bar'].";");

?>