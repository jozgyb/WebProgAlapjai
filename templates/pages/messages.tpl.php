<?php
// Include config file
define('__ROOT__', dirname(dirname(dirname(__FILE__))));
require_once __ROOT__ . "/includes/db_config.inc.php";

$requestMessagesByChronologicalOrder = "SELECT sender, sendermail, subject, message, created_at FROM messages ORDER BY created_at DESC";
$queryResult = $mysqli->query($requestMessagesByChronologicalOrder);

?>
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Feladó</th>
                <th scope="col">E-mail címe</th>
                <th scope="col">Tárgy</th>
                <th scope="col">Üzenet</th>
                <th scope="col">Időbélyeg</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($queryResult->num_rows > 0) {
                while ($row = $queryResult->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td> " . $row["sender"] . " </td> ";
                    echo "<td> " . $row["sendermail"] . " </td> ";
                    echo "<td> " . $row["subject"] . " </td> ";
                    echo "<td> " . $row["message"] . " </td> ";
                    echo "<td> " . $row["created_at"] . " </td> ";
                    echo "</tr>";
                }
            } else {
                echo "Jelenleg egy üzenet sem található az adatbázisban.";
            }

            ?>
        </tbody>
    </table>
</div>