<?php
session_start();
require_once '../MyPDO_config/MyPDO.db.include.php'; // connexion à la bdd
$stmt1 = MyPDO::getInstance()->prepare(<<<SQL
    SELECT name FROM Bar
SQL
); 
$stmt1->execute();

if(isset($_POST['nom_bar']) && !empty($_POST['nom_bar'])){
    while(($ligne = $stmt1->fetch())){ // parcours de la requete (liste des pseudos et mdp de chaque user)
        if( $_POST['nom_bar'] == $ligne['name']){
            header('location: ajouter_bar.php?err=errBarExisteDeja');// ce bar est déjà enregistré
            exit();
        }
    }
    $nom_bar = $_POST['nom_bar'];
    echo $nom_bar."</br>";
} else {
    header('location: ajouter_bar.php?err=errOubli');// vous n'avez pas rempli tous les champs obligatoires
    exit();
}

if(isset($_POST['numero_rue']) && !empty($_POST['numero_rue'])){
    $numero_rue = $_POST['numero_rue'];
    echo $numero_rue."</br>";
} else {
    header('location: ajouter_bar.php?err=errOubli');// vous n'avez pas rempli tous les champs obligatoires
    exit();
}

if(isset($_POST['adresse']) && !empty($_POST['adresse'])){
    $adresse = $_POST['adresse'];
    echo $adresse." ";
} else {
    header('location: ajouter_bar.php?err=errOubli');// vous n'avez pas rempli tous les champs obligatoires
    exit();
}


if(isset($_POST['ville']) && !empty($_POST['ville'])){
    $ville = $_POST['ville'];
    echo $ville."</br>";
} else {
    header('location: ajouter_bar.php?err=errOubli');// vous n'avez pas rempli tous les champs obligatoires
    exit();
}


if(isset($_POST['code_postal']) && !empty($_POST['code_postal'])){
    $code_postal = $_POST['code_postal'];
    echo $code_postal."</br>";
} else {
    header('location: ajouter_bar.php?err=errOubli');// vous n'avez pas rempli tous les champs obligatoires
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


if(isset($_FILES['ajout_photo'])){
    $ajout_photo = basename($_FILES["ajout_photo"]["name"]);
    $target_dir = "C:\\Users\\Loulou\\OndeDrive\\IMAC1\\Git\\Projet_Web_S2\\FINAL\\image\\bars\\"; // CHEMIN ABSOLU DU DOSSIER 'bars'
    $target_file = $target_dir.basename($_FILES["ajout_photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["ajout_photo"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["ajout_photo"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["ajout_photo"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["ajout_photo"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
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

$stmt = MyPDO::getInstance()->prepare(
        "INSERT IGNORE INTO City(postalCode, cityName) VALUES (:code_postal, :ville);");

$stmt->bindValue(':code_postal', $code_postal);
$stmt->bindValue(':ville', $ville);
$stmt->execute();
$stmt->closeCursor();

$stmt3 = MyPDO::getInstance()->prepare(
        "INSERT INTO Bar (name, numStreet, street, postalCode, website, numPhone, infos) 
        VALUES(:bar, :num_rue, :adresse, 
            (SELECT postalCode FROM City WHERE postalCode = :code_postal),
            :site_web, :tel, :infos);");

$stmt3->bindValue(':bar', $nom_bar);
$stmt3->bindValue(':num_rue', $numero_rue);
$stmt3->bindValue(':adresse', $adresse);
$stmt3->bindValue(':code_postal', $code_postal);
$stmt3->bindValue(':site_web', $site_web);
$stmt3->bindValue(':tel', $telephone_bar);
$stmt3->bindValue(':infos', $plus_dinfos);
$stmt3->execute();
$stmt3->closeCursor();

$stmt4 = MyPDO::getInstance()->prepare(
        "INSERT INTO BarBelongsType VALUES (
            (SELECT Bar.id_bar FROM Bar WHERE Bar.name = :bar),
            (SELECT BarType.id_barType FROM BarType WHERE BarType.barType = :type));");

$stmt4->bindValue(':bar', $nom_bar);            
$stmt4->bindValue(':type', $type_bar);
$stmt4->execute();
$stmt4->closeCursor();

if(isset($_POST['commentaire_ajout']) && !empty($_POST['commentaire_ajout'])){
    $stmt5 = MyPDO::getInstance()->prepare(
            "INSERT INTO Comment (id_user, id_bar, text) VALUES (
                (SELECT User.id_user FROM User WHERE User.pseudo = :pseudo),
                (SELECT Bar.id_bar FROM Bar WHERE Bar.name = :bar),
                :comm);");

    $stmt5->bindValue(':bar', $nom_bar);
    $stmt5->bindValue(':pseudo', $_SESSION['pseudo']);
    $stmt5->bindValue(':comm', $commentaire_ajout);
    $stmt5->execute();
    $stmt5->closeCursor();

    echo "GENERAL ca a marché ! "."</br>";
}


if(isset($_POST['prix1'])) $markprice = $_POST['prix1'];
else if(isset($_POST['prix2'])) $markprice = $_POST['prix2'];
else if(isset($_POST['prix3'])) $markprice = $_POST['prix3'];
else if(isset($_POST['prix4'])) $markprice = $_POST['prix4'];
else if(isset($_POST['prix5'])) $markprice = $_POST['prix5'];
else $markprice = 0;

if(isset($_POST['ambi1'])) $markambi = $_POST['ambi1'];
else if(isset($_POST['ambi2'])) $markambi = $_POST['ambi2'];
else if(isset($_POST['ambi3'])) $markambi = $_POST['ambi3'];
else if(isset($_POST['ambi4'])) $markambi = $_POST['ambi4'];
else if(isset($_POST['ambi5'])) $markambi = $_POST['ambi5'];
else $markambi = 0;

if(isset($_POST['dist1'])) $markdist = $_POST['dist1'];
else if(isset($_POST['dist2'])) $markdist = $_POST['dist2'];
else if(isset($_POST['dist3'])) $markdist = $_POST['dist3'];
else if(isset($_POST['dist4'])) $markdist = $_POST['dist4'];
else if(isset($_POST['dist5'])) $markdist = $_POST['dist5'];
else $markdist = 0;

if(isset($_POST['gen1'])) $markgen = $_POST['gen1'];
else if(isset($_POST['gen2'])) $markgen = $_POST['gen2'];
else if(isset($_POST['gen3'])) $markgen = $_POST['gen3'];
else if(isset($_POST['gen4'])) $markgen = $_POST['gen4'];
else if(isset($_POST['gen5'])) $markgen = $_POST['gen5'];
else $markgen = 0;

$marktypes = array('ambiance' => $markambi, 'general' => $markgen,
             'prix' => $markprice, 'distance' => $markdist);

foreach ($marktypes as $marktype => $markvalue) {
    $stmt2 = MyPDO::getInstance()->prepare(
            "INSERT INTO Mark (id_markType, id_user, id_bar, value) VALUES(
            (SELECT markType.id_markType FROM markType WHERE markType.markType = :markType),
            (SELECT User.id_user FROM User WHERE User.pseudo = :pseudo),
            (SELECT Bar.id_bar FROM Bar WHERE Bar.name = :bar),
            :value_mark);");

    $stmt2->bindValue(':markType', $marktype);
    $stmt2->bindValue(':value_mark', $markvalue);
    $stmt2->bindValue(':pseudo', $_SESSION['pseudo']);
    $stmt2->bindValue(':bar', $nom_bar);

    $stmt2->execute();
    $stmt2->closeCursor();
}


echo "insertion note ok"."</br>";

$update_photo = "UPDATE Bar SET Bar.photo=? WHERE Bar.name=?";
$stmt6 = MyPDO::getInstance()->prepare($update_photo);
$stmt6->execute([$ajout_photo, $nom_bar]);

echo "insertion photo ok"."</br>";   

$pagebar = 'afficher_bar.php?bar='.$nom_bar;
header('location: '.$pagebar);
exit();

    

?>