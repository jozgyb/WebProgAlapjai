<?php
// Include config file
define('__ROOT__', dirname(dirname(dirname(__FILE__))));
require_once __ROOT__ . "/includes/db_config.inc.php";

$requestMessagesByChronologicalOrder = "SELECT sender, sendermail, subject, message, created_at FROM messages ORDER BY created_at DESC";
$queryResult = $mysqli->query($requestMessagesByChronologicalOrder);

if($queryResult->num_rows > 0)
{
    while($row = $queryResult->fetch_assoc()) {
        echo "Feladó: " . $row["sender"]. " E-mail címe: " . $row["sendermail"]. " Tárgy: ". $row["subject"]. " Üzenet: " . $row["message"].  " Időbélyeg : " . $row["created_at"]. "<br>";
    }
} else {
    echo "Jelenleg egy üzenet sem található az adatbázisban.";
}

?>