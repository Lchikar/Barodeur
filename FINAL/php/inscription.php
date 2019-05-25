<<<<<<< HEAD:front/inscription.php
 <?php 
  session_start(); // permet d'accéder aux cookies, se trouve en début de chaque page qui en a besoin

  include("connexion.php"); // connexion.php : fichier où on se connecte à la BDD
  $pseudo = $_POST["pseudo"];
  $mdp = sha1($_POST["mdp"]); // la fonction sha1(string) crypte une chaine de caractere
  
  $sql = "SELECT pseudo FROM User WHERE Pseudo ='".$pseudo."';";
  $res = $bdd->query($sql);
  $donnees=$res->fetch();	
 
    if (empty($donnees["Pseudo"]) == False){
        $res->closeCursor();
        session_destroy(); // ferme la session et ecrase les cookies
        header ("location: page_principale.html"); // redirige la page vers accueil.html?erreur=err
        exit();
    }
    else{
      $sql = "INSERT INTO User(pseudo, mdp) VALUES ('".$pseudo."','".$mdp."');"; 
      $res = $bdd->query($sql);
      $res->closeCursor();	

      $_SESSION["pseudo"] = $pseudo;
      $_SESSION["mdp"] = $mdp;
      // à partir de maintenant, dans toutes les pages où on n'a pas encore fait de session_destroy()
      // les variable $_SESSION["pseudo"] et $_SESSION["mdp"] sont accessibles
=======
<?php 
session_start(); // permet d'accéder aux cookies, se trouve en début de chaque page qui en a besoin
require_once '../MyPDO_config/MyPDO.db.include.php'; // connexion à la bdd
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
            header('location: accueil.php?err=errpseudo');// pseudo déjà utilisé
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
            
    header ("location: page_principale.php"); // redirection vers la page page_principale.php? new=pseudo
    exit();
    
} else {
    header('location: accueil.php?err=errManqueInfos');// tous les champs n'ont pas été correctement remplis
    exit();
}
>>>>>>> master:FINAL/php/inscription.php

      header ("location:page_principale.html"); // redirection vers la page page_principale.html? new=pseudo
    }	
exit();
  ?>