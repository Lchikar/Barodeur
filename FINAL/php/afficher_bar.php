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

    <nav id="menu">
        <div id="classement">
            <div id="afficher" onClick="Afficher()"></div>
        </div>
        <div>
            <form id="formRecherche" method="get" action="recherche_bar.php">
                <input type="text" name="rechercher" placeholder="Rechercher" />
            </form>
        </div>
        <a href="deconnexion.php" class="deconnexion">
            <div class="divDeco"></div>
        </a>
    </nav>

    <div id="affiche_bar">
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
                    if ($general['website'] != ''){
                        echo "<a href=".$general['website']."target=\"_blank\"><u>Site du bar</u></a>";
                    }
					
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

            <form id="notes" method="GET" action="ajouter_note.php">
                <h2>Notes</h2>
                <h2>Moyennes</h2>
                <div class="un div_affiche_note ">
                    <h3 class="h3">Ambiance :</h3>
                    <input id="staramb1" name="ambi5" type="radio" value="1" class="radio-btn hide amb" onChange="selec_amb(this.id)" />
                    <label for="staramb1" id="label_staramb1" class="label_staramb"><img src="../image/wine-glasses.png" height='35px' width='35px'></label>
                    <input id="staramb2" name="ambi4" type="radio" value="2" class="radio-btn hide amb" onChange="selec_amb(this.id)"/>
                    <label for="staramb2" id="label_staramb2" class="label_staramb"><img src="../image/wine-glasses.png" height='35px' width='35px'></label>
                    <input id="staramb3" name="ambi3" type="radio" value="3" class="radio-btn hide amb" onChange="selec_amb(this.id)" />
                    <label for="staramb3" id="label_staramb3" class="label_staramb"><img src="../image/wine-glasses.png" height='35px' width='35px'></label>
                    <input id="staramb4" name="ambi2" type="radio" value="4" class="radio-btn hide amb" onChange="selec_amb(this.id)"/>
                    <label for="staramb4" id="label_staramb4" class="label_staramb"><img src="../image/wine-glasses.png" height='35px' width='35px'></label>
                    <input id="staramb5" name="ambi1" type="radio" value="5" class="radio-btn hide amb" onChange="selec_amb(this.id)"/>
                    <label for="staramb5" id="label_staramb5" class="label_staramb"><img src="../image/wine-glasses.png" height='35px' width='35px'></label>
                </div>
                <div class="trois div_affiche_moyenne">
                    <?php
							$stmt =  MyPDO::getInstance()->prepare(
							"SELECT Mark.value as 'value'
							FROM Bar NATURAL JOIN Mark NATURAL JOIN MarkType 
							WHERE Bar.name = :bar AND MarkType.markType = 'ambiance';");
							$stmt->bindValue(':bar', $_GET['bar']);
							
							$stmt->execute();
							$cpt = 0; $somme = 0;	
							while($note = $stmt->fetch()){
								$cpt ++;
								$somme += $note['value'];
							}
							if(0 == $cpt) $moy = 0;
							else $moy = $somme/$cpt;
							echo round($moy, 1)."/5";
						?>
                </div>

                <div class="quatre div_affiche_note">
                    <h3>Prix :</h3>
                    <input id="starprix1" name="prix1" type="radio" value="1" class="radio-btn hide" onChange="selec_prix(this.id)" />
                    <label for="starprix1" id="label_starprix1" class="label_starprix"><img src="../image/wine-glasses.png" height='35px' width='35px'></label>
                    <input id="starprix2" name="prix2" type="radio" value="2" class="radio-btn hide" onChange="selec_prix(this.id)"/>
                    <label for="starprix2" id="label_starprix2" class="label_starprix"><img src="../image/wine-glasses.png" height='35px' width='35px'></label>
                    <input id="starprix3" name="prix3" type="radio" value="3" class="radio-btn hide" onChange="selec_prix(this.id)"/>
                    <label for="starprix3" id="label_starprix3" class="label_starprix"><img src="../image/wine-glasses.png" height='35px' width='35px'></label>
                    <input id="starprix4" name="prix4" type="radio" value="4" class="radio-btn hide" onChange="selec_prix(this.id)"/>
                    <label for="starprix4" id="label_starprix4" class="label_starprix"><img src="../image/wine-glasses.png" height='35px' width='35px'></label>
                    <input id="starprix5" name="prix5" type="radio" value="5" class="radio-btn hide" onChange="selec_prix(this.id)"/>
                    <label for="starprix5" id="label_starprix5" class="label_starprix"><img src="../image/wine-glasses.png" height='35px' width='35px'></label>
                </div>
                <div class="six div_affiche_moyenne">
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
                    echo round($moy, 1)."/5";
                ?></div>

                <div class="sept div_affiche_note">
                    <h3 class="h3">Distance :</h3>
                    <input id="stardist1" name="dist1" type="radio" value="1" class="radio-btn hide" onChange="selec_dist(this.id)"/>
                    <label for="stardist1" id="label_stardist1" class="label_stardist"><img src="../image/wine-glasses.png" height='35px' width='35px'></label>
                    <input id="stardist2" name="dist2" type="radio" value="2" class="radio-btn hide" onChange="selec_dist(this.id)"/>
                    <label for="stardist2" id="label_stardist2" class="label_stardist"><img src="../image/wine-glasses.png" height='35px' width='35px'></label>
                    <input id="stardist3" name="dist3" type="radio" value="3" class="radio-btn hide" onChange="selec_dist(this.id)"/>
                    <label for="stardist3" id="label_stardist3" class="label_stardist"><img src="../image/wine-glasses.png" height='35px' width='35px'></label>
                    <input id="stardist4" name="dist4" type="radio" value="4" class="radio-btn hide" onChange="selec_dist(this.id)"/>
                    <label for="stardist4" id="label_stardist4" class="label_stardist"><img src="../image/wine-glasses.png" height='35px' width='35px'></label>
                    <input id="stardist5" name="dist5" type="radio" value="5" class="radio-btn hide" onChange="selec_dist(this.id)"/>
                    <label for="stardist5" id="label_stardist5" class="label_stardist"><img src="../image/wine-glasses.png" height='35px' width='35px'></label>
                </div>
                <div class="neuf div_affiche_moyenne">
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
						echo round($moy, 1)."/5";
					?></div>

                <div class="dix div_affiche_note">
                    <h3 class="h3">Général :</h3>
                    <input id="stargen1" name="gen1" type="radio" value="1" class="radio-btn hide" onChange="selec_gen(this.id)"/>
                    <label for="stargen1" id="label_stargen1" class="label_stargen"><img src="../image/wine-glasses.png" height='35px' width='35px'></label>
                    <input id="stargen2" name="gen2" type="radio" value="2" class="radio-btn hide" onChange="selec_gen(this.id)"/>
                    <label for="stargen2" id="label_stargen2" class="label_stargen"><img src="../image/wine-glasses.png" height='35px' width='35px'></label>
                    <input id="stargen3" name="gen3" type="radio" value="3" class="radio-btn hide" onChange="selec_gen(this.id)"/>
                    <label for="stargen3" id="label_stargen3" class="label_stargen"><img src="../image/wine-glasses.png" height='35px' width='35px'></label>
                    <input id="stargen4" name="gen4" type="radio" value="4" class="radio-btn hide" onChange="selec_gen(this.id)"/>
                    <label for="stargen4" id="label_stargen4" class="label_stargen"><img src="../image/wine-glasses.png" height='35px' width='35px'></label>
                    <input id="stargen5" name="gen5" type="radio" value="5" class="radio-btn hide" onChange="selec_gen(this.id)"/>
                    <label for="stargen5" id="label_stargen5" class="label_stargen"><img src="../image/wine-glasses.png" height='35px' width='35px'></label>
                </div>
                <div class="douze div_affiche_moyenne">
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
						echo round($moy, 1)."/5";
					?></div>
                <?php
					echo('<input type="hidden" name="bar" id="bar" value="'.$_GET['bar'].'"/>');
					?>
                <input type="submit" id="envoi_notes" value="Envoie tes notes" />

            </form>


            <h2 id="titre_commentaires">Commentaires :</h2>
            <?php
					echo '<form id="Publie" method="GET" action="ajouter_comm.php">';
					?>
            <?php 
						echo("<input type='text' name='comm' id='comm' placeholder='".$_SESSION['pseudo'].", laisse ton commentaire'/>");
						echo('<input type="hidden" name="bar" id="bar" value="'.$_GET['bar'].'"/>');
					?>
            <input type="submit" id="publieA" value="Publie ton comm'" />
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
							echo "<p class='un_comm_uti'>".$comm['pseudo']." dit : \"".$comm['text']."\"</p>";
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
            <div id="hidden" style="display: none;">
                <div id="croix" onClick="Cacher()"> </div>
                <form id="mainForm" method="post">
                    <div id="trier"><input type="submit" value="Classer par :" /></div>
                    <div id="cocher">
                        <label><input type="radio" id="note" name="tri" value="Note" onClick="redir_Note()">Note générale</label>
                        <label><input type="radio" id="prix" name="tri" value="Prix" onClick="redir_Prix()">Prix</label>
                        <label><input type="radio" id="ambiance" name="tri" value="Ambiance" onClick="redir_Ambiance()">Ambiance</label>
                        <label><input type="radio" id="distance" name="tri" value="Distance" onClick="redir_Distance()">Distance</label>
                    </div>
                    <input type="button" value="Ajouter bar" onClick="redir_Ajout()" />
                </form>
            </div>
            <script>
                //plutôt ajouter un événement
                /*var notes = document.getElementById("notes").querySelectorAll(".radio-btn");
                for(var note of notes){
                    if(note.checked == true && note.classList.contains("amb")){
                        var numero = note.id.substr(note.id.length - 1);
                        document.querySelector(".staramb"+numero).classList.add("note_selec");
                    }
                }*/
                
                /*var notes_amb = document.querySelectorAll(".amb");
                for (var une_note_amb of notes_amb){
                    addEventListener("click", function(){
                        console.log(this.id);
                        var elemtn_id = this.id;
                        var numero = elemtn_id.substr(elemtn_id.length - 1);
                        document.querySelector(".staramb"+numero).classList.toggle("note_selec");
                    });
                }*/
                
                function selec_amb(id){
                    var labels_amb = document.querySelectorAll(".label_staramb");
                    for(var label_amb of labels_amb){
                        if(label_amb.classList.contains('note_selec')){
                            label_amb.classList.remove('note_selec');
                        }
                    }
                    document.getElementById("label_"+id).classList.add("note_selec");
                }
                
                function selec_prix(id){
                    var labels_prix = document.querySelectorAll(".label_starprix");
                    for(var label_prix of labels_prix){
                        if(label_prix.classList.contains('note_selec')){
                            label_prix.classList.remove('note_selec');
                        }
                    }
                    document.getElementById("label_"+id).classList.add("note_selec");
                }
                
                function selec_dist(id){
                    var labels_dist = document.querySelectorAll(".label_stardist");
                    for(var label_dist of labels_dist){
                        if(label_dist.classList.contains('note_selec')){
                            label_dist.classList.remove('note_selec');
                        }
                    }
                    document.getElementById("label_"+id).classList.add("note_selec");
                }
                
                function selec_gen(id){
                    var labels_gen = document.querySelectorAll(".label_stargen");
                    for(var label_gen of labels_gen){
                        if(label_gen.classList.contains('note_selec')){
                            label_gen.classList.remove('note_selec');
                        }
                    }
                    document.getElementById("label_"+id).classList.add("note_selec");
                }
                
                
                
            </script>
            <script src="../js/menu.js"></script>
            <script src="../js/redirection.js"></script>
</body>

</html>