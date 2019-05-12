<?php
require_once 'MyPDO.db.include.php';

$stmt = MyPDO::getInstance()->prepare(<<<SQL
	SELECT *
	FROM Bar
	ORDER BY id_bar
SQL
);

$stmt->execute();

while (($row = $stmt->fetch()) !== false) {
	echo "<div>{$row['name']}</div>";
}
?>