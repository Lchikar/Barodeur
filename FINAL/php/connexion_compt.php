<?php 
session_start(); // on ouvre une session pour utiliser les cookies
session_unset (); // met à zero les cookies au cas où il y avait une autre session d'ouverte
require_once '../MyPDO_config/MyPDO.db.include.php'; // connexion à la bdd
$stmt = MyPDO::getInstance()->prepare("SELECT pseudo, password FROM User"); 
// recherche des tous les users

$stmt->execute();


if (isset($_POST['pseudo']) && isset($_POST['mdp'])) { // vérification des variables du formulaire
    while(($ligne = $stmt->fetch())){ // parcours de la requete (liste des pseudos et mdp de chaque user)
        if( $_POST['pseudo'] == $ligne['pseudo'] && sha1($_POST['mdp']) == ($ligne['password'])){
        // user retrouvé
        $_SESSION['pseudo'] = $_POST['pseudo'];
        $_SESSION['mdp'] = $_POST['mdp'];
        echo "<script>window.alert( 'Debug Objects');</script>";
        }
    }

    if (isset($_SESSION['pseudo']) && isset($_SESSION['mdp'])){
        header('location: page_principale.php'); // connexion reussie, redirection vers profil user
        exit();
    } else {
        header('location: accueil.php?err=err1'); // echec connexion, redirection page de connexion
        exit();
    }
} else {
        header('location: accueil.php?err=err2'); // tous les champs n'ont pas été correctement remplis
        exit();
    }

?>