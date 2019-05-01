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
        header ("location: accueil.html"); // redirige la page vers accueil.html?erreur=err
    }
    else{
      $sql = "INSERT INTO User(pseudo, mdp) VALUES ('".$pseudo."','".$mdp."');"; 
      $res = $bdd->query($sql);
      $res->closeCursor();	

      $_SESSION["pseudo"] = $pseudo;
      $_SESSION["mdp"] = $mdp;
      // à partir de maintenant, dans toutes les pages où on n'a pas encore fait de session_destroy()
      // les variable $_SESSION["pseudo"] et $_SESSION["mdp"] sont accessibles

      header ("location:page_principale.html"); // redirection vers la page page_principale.html? new=pseudo
    }	
  ?>