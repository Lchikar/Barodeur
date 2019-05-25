<!DOCTYPE html>
<html lang="fr" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bienvenue à Bar à Gogo !">
    <meta name="keywords" content="bar etudiant">
    <meta name="viewport" content="width=device-width"/>
    <link rel="stylesheet" type="text/css" href="../css/general.css">
    <link href="https://fonts.googleapis.com/css?family=El+Messiri" rel="stylesheet">
    <title>Accueil</title>
</head>

<body id="pageAccueil">
    <main id="accueil">
        <h1>Bienvenue sur Barôdeur !</h1>
        <h2>Tu es à la recherche du bar perdu? <br/>
        		Tu es bien tombé.e ! <br/>
        		Ici, tu vas pouvoir noter, commenter, poster ou juste t'informer sur les bars du Jeudimac.</h2>
        			
        		
        		<?php
        			//if($_GET['erreur']=='err'){
        			//$message = '<h2>une erreur s\'est produite pendant votre identification. Vous devez remplir tous les champs</h2>
			        //<h2>Cliquez <a href="./accueil.html">ici</a> pour revenir</h2>';
        			//}
        		?>
        <form id="formConnexion" method="post" action="">
            <div id="divConnexion">
                <input type="text" name="pseudo" id="pseudo" placeholder=" Pseudo de la race"/>
                <input type="password" name="mdp" id="mdp" placeholder=" Mot de passe de boloss" />
            </div>
            <div id="Connexion">	
                <button  id="submitConnexion" >Connexion</button>
                <button  id="submitInscription">Inscription</button>
            </div>
        </form>
    </main>

  <script src="../js/redirection.js"></script>
</body>

</html>