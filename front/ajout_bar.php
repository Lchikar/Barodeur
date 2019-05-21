<?php
session_start();
require_once 'MyPDO.db.include.php'; // connexion à la bdd
$stmt1 = MyPDO::getInstance()->prepare(<<<SQL
    SELECT name FROM Bar
SQL
); 
$stmt1->execute();

if(isset($_POST['nom_bar']) && !empty($_POST['nom_bar'])){
    while(($ligne = $stmt1->fetch())){ // parcours de la requete (liste des pseudos et mdp de chaque user)
        if( $_POST['nom_bar'] == $ligne['name']){
            header('location: ajouter_bar.html?err=errBarExisteDeja');// ce bar est déjà enregistré
            exit();
        }
    }
    $nom_bar = $_POST['nom_bar'];
    echo $nom_bar."</br>";
} else {
    header('location: ajouter_bar.html?err=errOubli');// vous n'avez pas rempli tous les champs obligatoires
    exit();
}

if(isset($_POST['numero_rue']) && !empty($_POST['numero_rue'])){
    $numero_rue = $_POST['numero_rue'];
    echo $numero_rue."</br>";
} else {
    header('location: ajouter_bar.html?err=errOubli');// vous n'avez pas rempli tous les champs obligatoires
    exit();
}

if(isset($_POST['adresse']) && !empty($_POST['adresse'])){
    $adresse = $_POST['adresse'];
    echo $adresse." ";
} else {
    header('location: ajouter_bar.html?err=errOubli');// vous n'avez pas rempli tous les champs obligatoires
    exit();
}


if(isset($_POST['ville']) && !empty($_POST['ville'])){
    $ville = $_POST['ville'];
    echo $ville."</br>";
} else {
    header('location: ajouter_bar.html?err=errOubli');// vous n'avez pas rempli tous les champs obligatoires
    exit();
}


if(isset($_POST['code_postal']) && !empty($_POST['code_postal'])){
    $code_postal = $_POST['code_postal'];
    echo $code_postal."</br>";
} else {
    header('location: ajouter_bar.html?err=errOubli');// vous n'avez pas rempli tous les champs obligatoires
    exit();
}

if(isset($_POST['telephone_bar']) && !empty($_POST['telephone_bar'])){
    $telephone_bar = $_POST['telephone_bar'];
    echo $telephone_bar."</br>";
} else {
    $telephone_bar = "";
}

if(isset($_POST['site_web']) && !empty($_POST['site_web'])){
    $site_web = $_POST['site_web'];
    echo $site_web."</br>";
} else {
    $site_web = "";
}

if(isset($_POST['ajout_photo']) && !empty($_POST['ajout_photo'])){
    $ajout_photo = $_POST['ajout_photo'];
    
    /*if(isset($_FILES['ajout_photo'])){
        echo "la boucle";
        //test validite fichier
        if ($_FILES['ajout_photo']['error'] > 0) echo "Erreur lors du transfert";

        //deplacement dans dossier img
        $nom = "img/$ajout_photo";
        $resultat = move_uploaded_file($_FILES['ajout_photo']['tmp_name'],$nom);
        if ($resultat) echo "Transfert réussi";
    }*/
    
    echo $ajout_photo."</br>";
}

if(isset($_POST['type_bar']) && !empty($_POST['type_bar'])){
    $type_bar = $_POST['type_bar'];
    echo $type_bar."</br>";
}

if(isset($_POST['plus_dinfos']) && !empty($_POST['plus_dinfos'])){
    $plus_dinfos = $_POST['plus_dinfos'];
    echo $plus_dinfos."</br>";
} else {
    $plus_dinfos ="";
}

if(isset($_POST['commentaire_ajout']) && !empty($_POST['commentaire_ajout'])){
    $commentaire_ajout = $_POST['commentaire_ajout'];
    echo $commentaire_ajout."</br>";
}

$stmt = MyPDO::getInstance()->prepare(<<<SQL
        INSERT INTO Bar (name, numStreet, street, postalCode, website, numPhone, infos) 
        VALUES('$nom_bar', '$numero_rue', '$adresse', '$code_postal', '$site_web', '$telephone_bar', '$plus_dinfos')
SQL
);

$stmt->execute();
echo "ca a marché ! "."</br>";


$stmt2 = MyPDO::getInstance()->prepare(<<<SQL
    SET @id_bar = (SELECT id_bar FROM Bar WHERE name='$nom_bar');
    SET @id_barType = (SELECT id_barType FROM BarType WHERE barType='$type_bar');
    INSERT INTO BarBelongsType (id_bar, id_barType) 
    VALUES (@id_bar, @id_barType);
SQL
);

$stmt2->execute();
echo "insertion type ok"."</br>";

/*$stmt3 = MyPDO::getInstance()->prepare(<<<SQL
    INSERT INTO Bar(photo)
    VALUES ('$nom')
SQL
);
    
$stmt3->execute();
echo "insertion photo ok"."</br>";   */ 
    

?>