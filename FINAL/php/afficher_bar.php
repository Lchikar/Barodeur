<!DOCTYPE html>
<html lang="fr" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#">

<head>
    <?php
session_start();
require_once '../MyPDO_config/MyPDO.db.include.php'; // connexion à la bdd

if(!isset($_GET['bar']) || empty($_GET['bar'])){
	header('location: page_principale.php');// ce bar est déjà enregistré
    exit();
}
?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bienvenue à Bar à Gogo !">
    <meta name="keywords" content="bar etudiant">
    <link rel="stylesheet" type="text/css" href="../css/afficher.css">
    <link rel="stylesheet" type="text/css" href="../css/menu.css">
    <link rel="stylesheet" type="text/css" href="../css/rating.css">
    <link href="https://fonts.googleapis.com/css?family=El+Messiri" rel="stylesheet">
    <title>Afficher bar</title>
</head>

<body>
	
		<nav id="menu" >
			<div id="classement">
				<div id="classer"  onClick="Afficher()"></div>
			</div>
			<div>
				<form id="formRecherche" method="get" action="recherche_bar.php">
					<input type="text" name="rechercher"  placeholder="Rechercher" />
				</form>
			</div>
			<a href="deconnexion.php" class="deconnexion">
                <div class="divDeco"></div>
            </a>
		</nav>
		
		<div id="affiche_bar" >
			<?php
				$stmt =  MyPDO::getInstance()->prepare(
				"SELECT name, 
				CONCAT (numStreet, ' ', street, ' ', postalCode,' ', cityName) as adresse,
				website, numPhone, infos, photo
				FROM Bar NATURAL JOIN City
				WHERE Bar.name = :bar");
				$stmt->bindValue(':bar', $_GET['bar']);
				$stmt->execute();	
			?>
				<div id="top">
				<div id="picture"> 
				<?php 
				while($general = $stmt->fetch()){
					$src = "../image/bars/".$general['photo'];
					echo ('<img class="photo"
				     src="'.$src.'"
				     alt="'.$general['name'].'" height="240" width="280"/>');
				}
				?>
            </div>
            <div id="infos">
                <?php
				$stmt->execute();
				while($general = $stmt->fetch()){
					echo "<h3>".$general['name']."</h3>";
					echo "<br>".$general['adresse']."<br>";
					echo $general['numPhone']."<br>";
					echo "<a href=".$general['website']."target=\"_blank\"><u>Site du bar</u></a>";
				}
				?>
            </div>

            <div id="informations">
                <?php
				$stmt->execute();
				while($general = $stmt->fetch()){
					echo $general['infos'];
				}
				?>
				</div>
			</div>
			<div></div><div></div><div></div><div></div>
			<div></div><div></div><div></div><div></div>
			<div id="bottom">
				
				<form id="notes" method="GET" action="ajouter_note.php">
				<p class="wrapper">
				<div class="notes"><h2>Notes :</h2></div>
				<div class="vide"> </div>
				<div class="moyenne"><h2>Moyenne :</h2></div>
					<div class="un"><h3 class="h3">Ambiance :</h3></div>
						<div class="rating_amb deux">
	                        <input id="staramb1" name="ambi5" type="radio" value="1" class="radio-btn hide" />
	                        <label for="staramb1" ><img src="../image/wine-glasses.png" height='35px' width='35px'></label>
	                        <input id="staramb2" name="ambi4" type="radio" value="2" class="radio-btn hide" />
	                        <label for="staramb2" ><img src="../image/wine-glasses.png" height='35px' width='35px'></label>
	                        <input id="staramb3" name="ambi3" type="radio" value="3" class="radio-btn hide" />
	                        <label for="staramb3" ><img src="../image/wine-glasses.png" height='35px' width='35px'></label>
	                        <input id="staramb4" name="ambi2" type="radio" value="4" class="radio-btn hide" />
	                        <label for="staramb4" ><img src="../image/wine-glasses.png" height='35px' width='35px'></label>
	                        <input id="staramb5" name="ambi1" type="radio" value="5" class="radio-btn hide" />
	                        <label for="staramb5" ><img src="../image/wine-glasses.png" height='35px' width='35px'></label>
	                    </div>
					<div class="trois">
						<?php
							$stmt =  MyPDO::getInstance()->prepare(
							"SELECT Mark.value as 'value'
							FROM Bar NATURAL JOIN Mark NATURAL JOIN markType 
							WHERE Bar.name = :bar AND markType.markType = 'ambiance';");
							$stmt->bindValue(':bar', $_GET['bar']);
							
							$stmt->execute();
							$cpt = 0; $somme = 0;	
							while($note = $stmt->fetch()){
								$cpt ++;
								$somme += $note['value'];
							}
							if(0 == $cpt) $moy = 0;
							else $moy = $somme/$cpt;
							echo $moy."/5";
						?>
                    </div>

                    <div class="quatre">
                        <h3>Prix :</h3>
                    </div>
                    <div class="rating_prix cinq">
                        <input id="starprix5" name="prix1" type="radio" value="5" class="radio-btn hide" />
                        <label for="starprix5"><img src="../image/wine-glasses.png" height='35px' width='35px'></label>
                        <input id="starprix4" name="prix2" type="radio" value="4" class="radio-btn hide" />
                        <label for="starprix4"><img src="../image/wine-glasses.png" height='35px' width='35px'></label>
                        <input id="starprix3" name="prix3" type="radio" value="3" class="radio-btn hide" />
                        <label for="starprix3"><img src="../image/wine-glasses.png" height='35px' width='35px'></label>
                        <input id="starprix2" name="prix4" type="radio" value="2" class="radio-btn hide" />
                        <label for="starprix2"><img src="../image/wine-glasses.png" height='35px' width='35px'></label>
                        <input id="starprix1" name="prix5" type="radio" value="1" class="radio-btn hide" />
                        <label for="starprix1"><img src="../image/wine-glasses.png" height='35px' width='35px'></label>
                    </div>
                    <div class="six">
                        <?php
						$stmt =  MyPDO::getInstance()->prepare(
						"SELECT Mark.value as 'value'
						FROM Bar NATURAL JOIN Mark NATURAL JOIN MarkType 
						WHERE Bar.name = :bar AND MarkType.markType = 'prix';");
						$stmt->bindValue(':bar', $_GET['bar']);
						
						$stmt->execute();
						$cpt = 0; $somme = 0;	
						while($note = $stmt->fetch()){
							$cpt ++;
							$somme += $note['value'];
						}
						if(0 == $cpt) $moy = 0;
						else $moy = $somme/$cpt;
						echo $moy."/5";
					?></div>


                    <div class="sept">
                        <h3 class="h3">Distance :</h3>
                    </div>
                    <div class="rating_dist huit">
                        <input id="stardist5" name="dist1" type="radio" value="5" class="radio-btn hide" />
                        <label for="stardist5"><img src="../image/wine-glasses.png" height='35px' width='35px'></label>
                        <input id="stardist4" name="dist2" type="radio" value="4" class="radio-btn hide" />
                        <label for="stardist4"><img src="../image/wine-glasses.png" height='35px' width='35px'></label>
                        <input id="stardist3" name="dist3" type="radio" value="3" class="radio-btn hide" />
                        <label for="stardist3"><img src="../image/wine-glasses.png" height='35px' width='35px'></label>
                        <input id="stardist2" name="dist4" type="radio" value="2" class="radio-btn hide" />
                        <label for="stardist2"><img src="../image/wine-glasses.png" height='35px' width='35px'></label>
                        <input id="stardist1" name="dist5" type="radio" value="1" class="radio-btn hide" />
                        <label for="stardist1"><img src="../image/wine-glasses.png" height='35px' width='35px'></label>
                    </div>
                    <div class="neuf">
                        <?php
						$stmt =  MyPDO::getInstance()->prepare(
						"SELECT Mark.value as 'value'
						FROM Bar NATURAL JOIN Mark NATURAL JOIN MarkType 
						WHERE Bar.name = :bar AND MarkType.markType = 'distance';");
						$stmt->bindValue(':bar', $_GET['bar']);
						
						$stmt->execute();
						$cpt = 0; $somme = 0;	
						while($note = $stmt->fetch()){
							$cpt ++;
							$somme += $note['value'];
						}
						if(0 == $cpt) $moy = 0;
						else $moy = $somme/$cpt;
						echo $moy."/5";
					?></div>

                    <div class="dix">
                        <h3 class="h3">Général :</h3>
                    </div>
                    <div class="rating_gen onze">
                        <input id="stargen5" name="gen1" type="radio" value="5" class="radio-btn hide" />
                        <label for="stargen5"><img src="../image/wine-glasses.png" height='35px' width='35px'></label>
                        <input id="stargen4" name="gen2" type="radio" value="4" class="radio-btn hide" />
                        <label for="stargen4"><img src="../image/wine-glasses.png" height='35px' width='35px'></label>
                        <input id="stargen3" name="gen3" type="radio" value="3" class="radio-btn hide" />
                        <label for="stargen3"><img src="../image/wine-glasses.png" height='35px' width='35px'></label>
                        <input id="stargen2" name="gen4" type="radio" value="2" class="radio-btn hide" />
                        <label for="stargen2"><img src="../image/wine-glasses.png" height='35px' width='35px'></label>
                        <input id="stargen1" name="gen5" type="radio" value="1" class="radio-btn hide" />
                        <label for="stargen1"><img src="../image/wine-glasses.png" height='35px' width='35px'></label>
                    </div>
                    <div class="douze">
                        <?php
						$stmt =  MyPDO::getInstance()->prepare(
						"SELECT Mark.value as 'value'
						FROM Bar NATURAL JOIN Mark NATURAL JOIN MarkType 
						WHERE Bar.name = :bar AND MarkType.markType = 'general';");
						$stmt->bindValue(':bar', $_GET['bar']);
						
						$stmt->execute();
						$cpt = 0; $somme = 0;	
						while($note = $stmt->fetch()){
							$cpt ++;
							$somme += $note['value'];
						}
						if(0 == $cpt) $moy = 0;
						else $moy = $somme/$cpt;
						echo $moy."/5";
					?></div>
					<?php
					echo('<input type="hidden" name="bar" id="bar" value="'.$_GET['bar'].'"/>');
					?>
					<input type="submit" id="envoi_notes" value="Envoie tes notes"/>

					</form>
				</p>


				<h2>Commentaires :</h2>
					<?php
					echo '<form id="Publie" method="GET" action="ajouter_comm.php">';
					?>	
					<?php 
						echo("<input type='text' name='comm' id='comm' placeholder='".$_SESSION['pseudo'].", laisse ton commentaire'/>");
					?>
<<<<<<< HEAD:front/afficher_bar.php
				<form id="Retour" method="post" action="accueil.html">
				<input type="submit" id="retourA"value="Retour à l'accueil"/>
				</form>
=======
						<input type="submit" id="publieA"value="Publie ton comm'"/>
					</form>
				<div class="commentaires">
					<?php
						$stmt =  MyPDO::getInstance()->prepare(
						"SELECT User.pseudo, 
						Comment.text 
						FROM Bar NATURAL JOIN Comment NATURAL JOIN User 
						WHERE Bar.name = :bar ORDER BY Comment.id_comment;");
						$stmt->bindValue(':bar', $_GET['bar']);
						$stmt->execute();

						while($comm = $stmt->fetch()){
							echo $comm['pseudo']." dit :\"".$comm['text']."\"";
						}
					?>
            </div>
            <div id="boutons">
                <form id="Retour" method="post" action="page_principale.php">
                    <input type="submit" id="retourA" value="Retour" />
                </form>
            </div>

        </div>
    </div>

    <!--deuxieme interface quand on clique sur le bouton-->

            </div>
    <script src="../js/menu.js"></script>
    <script src="../js/redirection.js"></script>
>>>>>>> master:FINAL/php/afficher_bar.php
</body>

</html>