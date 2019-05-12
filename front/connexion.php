<?php
$dsn = 'mysql:host=sqletud.u-pem.fr;dbname=lchikar_db';

	try {
 
$pdo = new PDO($dsn, 'lchikar', 'qkiu8yaY8w');

}
catch (PDOException $e) {
	echo "<div class='error-message'>Erreur:
	".$e->getMessage()."</div>";
	die();
}
	
?>