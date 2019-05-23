<!DOCTYPE html>
<html lang="fr" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#">

<head>
<?php
session_start();
require_once 'MyPDO.db.include.php'; // connexion à la bdd

if(!isset($_GET['bar'])){
	echo "Erreur GET\n";
}
?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bienvenue à Bar à Gogo !">
    <meta name="keywords" content="bar etudiant">
    <link rel="stylesheet" type="text/css" href="css/afficher.css">
    <link href="https://fonts.googleapis.com/css?family=El+Messiri" rel="stylesheet">
    <title>Afficher bar</title>
</head>

<body>
	
		<nav id="menu" >
			<div id="classement">
				<div id="classer"  onClick="Afficher()"></div>
			</div>
			<div>
				<form>
					<input type="text" name="rechercher"  placeholder="Rechercher" />
				</form>
			</div>
			<div>
				<input type="submit" id="deconnection" value="" />
			</div>
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
					$src = "image/bars/".$general['photo'];
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
			<div id="bottom">
				
				<form id="notes" method="post" action="">
				<div><h2>Notes :</h2></div>
				<div> </div>
				<div><h2>Moyenne :</h2></div>
				<div ><h3 class="h3">Ambiance :</h3></div>
					<div >
					<button class="ambiance1" type="button"> 1</button>
					<button class="ambiance1" type="button"> 2</button>
					<button class="ambiance1" type="button"> 3</button>
					<button class="ambiance1" type="button"> 4</button>
					<button class="ambiance1" type="button"> 5</button>
					</div>
				<div>
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
				<div ><h3>Prix :</h3></div>
					<div >
					<button class="Prix1" type="button"> 1</button>
					<button class="Prix1" type="button"> 2</button>
					<button class="Prix1" type="button"> 3</button>
					<button class="Prix1" type="button"> 4</button>
					<button class="Prix1" type="button"> 5</button>
					</div>
					<div>
						<?php
						$stmt =  MyPDO::getInstance()->prepare(
						"SELECT Mark.value as 'value'
						FROM Bar NATURAL JOIN Mark NATURAL JOIN markType 
						WHERE Bar.name = :bar AND markType.markType = 'prix';");
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
				<div ><h3 class="h3">Distance :</h3></div>
					<div >
					<button class="Distance1" type="button"> 1</button>
					<button class="Distance1" type="button"> 2</button>
					<button class="Distance1" type="button"> 3</button>
					<button class="Distance1" type="button"> 4</button>
					<button class="Distance1" type="button"> 5</button>
					</div>
					<div>
						<?php
						$stmt =  MyPDO::getInstance()->prepare(
						"SELECT Mark.value as 'value'
						FROM Bar NATURAL JOIN Mark NATURAL JOIN markType 
						WHERE Bar.name = :bar AND markType.markType = 'distance';");
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
				<div ><h3 class="h3">Général :</h3></div>
					<div >
					<button class="Général1" type="button"> 1</button>
					<button class="Général1" type="button"> 2</button>
					<button class="Général1" type="button"> 3</button>
					<button class="Général1" type="button"> 4</button>
					<button class="Général1" type="button"> 5</button>
					</div>
					<div>
						<?php
						$stmt =  MyPDO::getInstance()->prepare(
						"SELECT Mark.value as 'value'
						FROM Bar NATURAL JOIN Mark NATURAL JOIN markType 
						WHERE Bar.name = :bar AND markType.markType = 'general';");
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
					
				</form>
				<h2>Commentaires :</h2>
					<?php 
						echo("<input type='text' name='comm' id='comm' placeholder='".$_SESSION['pseudo'].", laisse ton commentaire'/>");
						
					?>
				<div id="boutons">
				<form id="Publie" method="post" action="">
				<input type="submit" id="publieA"value="Publie ton comm'"/>
				</form>
				<form id="Retour" method="post" action="page_principale.php">
				<input type="submit" id="retourA"value="Retour"/>
				</form>
				</div>
			</div>
		</div>
		
		<!--deuxieme interface quand on clique sur le bouton-->
		
		<div id="hidden" style="display: none;" >
			<div id="croix" onClick="Cacher()">

			</div>
			<form id="mainForm" method="post">
	
 				 <div id="trier"><input type="submit"  value="Classer par :" /></div>
 	 				<div id="cocher">
 	 				<label><input type="radio" id="prix" name="tri" value="Prix">Prix</label>
    				<label><input type="radio" id="ambiance" name="tri" value="Ambiance">Ambiance</label>
    				<label><input type="radio" id="note" name="tri" value="Note">Note</label>
    				<label><input type="radio" id="distance" name="tri" value="Distance">Distance</label>
    				</div>
    
    			<input type="submit"  value="Ajouter bar" />
    			<input type="submit"  value="Se déconnecter" />
    	</form>
    </div>

	

    <script src="js/menu.js"></script>
</body>

</html>