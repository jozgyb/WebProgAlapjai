<?php
// Include config file
define('__ROOT__', dirname(dirname(dirname(__FILE__))));
require_once __ROOT__ . "/includes/db_config.inc.php";

$requestMessagesByChronologicalOrder = "SELECT sender, sendermail, subject, message, created_at FROM messages ORDER BY created_at DESC";
$queryResult = $mysqli->query($requestMessagesByChronologicalOrder);

?>
<div class="col-12">
    <div class="table-responsive-md">
        <table class="table table-hover">
        <caption>All messages from the database, descending order.</caption>
            <thead>
                <tr>
                    <th scope="col">From</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Message</th>
                    <th scope="col">Timestamp</th>
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
                    echo "No messages can be found in the database.";
                }

                ?>
            </tbody>
        </table>
    </div>
</div>