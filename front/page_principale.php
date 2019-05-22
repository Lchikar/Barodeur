<!DOCTYPE html>
<html lang="fr" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bienvenue à Bar à Gogo !">
    <meta name="keywords" content="bar etudiant">
    <link rel="stylesheet" type="text/css" href="css/menu.css">
    <link href="https://fonts.googleapis.com/css?family=El+Messiri" rel="stylesheet">
    <title>Page principale</title>
<?php session_start(); ?>
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
		
		<div id="AllBars"> 
			<div id="affiche_bar" > 
				<div id="picture"> </div> 
				<div id="infos"> Infos bar</div>
				<p id="moy">Note Moyenne [notebdd]/5</p> 
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