<?php
// TO DO : à modifier si jamais
require_once 'MyPDO.class.php';

// TO DO : à modifier
// host=votre serveur (localhost si travail en local)
// n'oubliez pas d'ajouter le port (sur mac notamment, ex: localhost:8080)
MyPDO::setConfiguration('mysql:host=localhost;dbname=barodeur;charset=utf8', 'root', '');

?>