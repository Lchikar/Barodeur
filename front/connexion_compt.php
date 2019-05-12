<?php 
session_start(); // on ouvre une session pour utiliser les cookies
session_unset (); // met à zero les cookies au cas où il y avait une autre session d'ouverte
require_once 'MyPDO.db.include.php'; // connexion à la bdd
$stmt = MyPDO::getInstance()->prepare(<<<SQL
    SELECT pseudo, password FROM User
SQL
); 
// recherche des tous les users

$stmt->execute();


if (isset($_POST['pseudo']) && isset($_POST['mdp'])) { // vérification des variables du formulaire
    while(($ligne = $stmt->fetch())){ // parcours de la requete (liste des pseudos et mdp de chaque user)
        if( $_POST['pseudo'] == $ligne['pseudo'] && sha1($_POST['mdp']) == $ligne['mdp']){
        // user retrouvé
        $_SESSION['pseudo'] = $_POST['pseudo'];
        $_SESSION['mdp'] = $_POST['mdp'];
        $connexion = 0;
        }
    }

    if ($connexion==0){
        header('location: page_principale.html'); // connexion reussie, redirection vers profil user
        exit();
    }
    else{
        header('location: accueil.html?err=err'); // echec connexion, redirection page de connexion
        exit();
    }
}

?>