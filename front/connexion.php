<?php
//$dsn = 'mysql:host=sqletud.u-pem.fr;dbname=lchikar_db';
$dsn = 'mysql:host=91.216.107.164;dbname=lucie899583';

	try {
 
//$pdo = new PDO($dsn, 'lchikar', 'qkiu8yaY8w');
$pdo = new PDO($dsn, 'lucie899583', 'cqeg5bydbw');

}
catch (PDOException $e) {
	echo "<div class='error-message'>Erreur:
	".$e->getMessage()."</div>";
	die();
}
	
?>