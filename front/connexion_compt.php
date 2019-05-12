<?php 
session_start(); // on ouvre une session pour utiliser les cookies
session_unset (); // met à zero les cookies au cas où il y avait une autre session d'ouverte
include("connexion.php"); // connexion à la bdd
$res = $pdo->query("SELECT pseudo, mdp FROM User;"); // recherche des tous les users

if (isset($_POST['pseudo']) && isset($_POST['mdp'])) { // vérification des variables du formulaire
    while($ligne = $res->fetch() ){ // parcours de la requete (liste des pseudos et mdp de chaque user)
        if( $_POST['pseudo'] == $ligne['pseudo'] && sha1($_POST['mdp']) == $ligne['mdp']){
        // user retrouvé
        $_SESSION['pseudo'] = $_POST['pseudo'];
        $_SESSION['mdp'] = $_POST['mdp'];
        }
    }
    $res->closeCursor();
    if (isset($_SESSION['pseudo'])){
        header('location: page_principale.html'); // connexion reussie, redirection vers profil user
        exit();
    }
    else{
        header('location: accueil.html'); // echec connexion, redirection page de connexion
        exit();
    }
}

?>