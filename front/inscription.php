<?php 
session_start(); // permet d'accéder aux cookies, se trouve en début de chaque page qui en a besoin
require_once 'MyPDO.db.include.php'; // connexion à la bdd
$stmt1 = MyPDO::getInstance()->prepare(<<<SQL
    SELECT pseudo, password FROM User
SQL
); 

$pseudo = $_POST['pseudo'];
$mdp = sha1($_POST["mdp"]);// la fonction sha1(string) crypte une chaine de caractere
echo "mdp : ".$mdp;

$stmt1->execute();

if (isset($_POST['pseudo']) && isset($_POST['mdp'])) { // vérification des variables du formulaire
    while(($ligne = $stmt1->fetch())){ // parcours de la requete (liste des pseudos et mdp de chaque user)
        if( $pseudo == $ligne['pseudo']){
            header('location: accueil.html?err=errpseudo');// pseudo déjà utilisé
            exit();
        }
    }
    
    $stmt2 = MyPDO::getInstance()->prepare(<<<SQL
        INSERT INTO User(pseudo, password) VALUES ('$pseudo','$mdp')
SQL
);
    $stmt2->execute();
    
    $_SESSION['pseudo'] = $_POST['pseudo'];
    $_SESSION['mdp'] = $_POST['mdp'];
            
    header ("location:page_principale.html"); // redirection vers la page page_principale.html? new=pseudo
    exit();
    
} else {
    header('location: accueil.html?err=errManqueInfos');// tous les champs n'ont pas été correctement remplis
    exit();
}

?>