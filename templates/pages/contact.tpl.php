<?php
// Include config file
define('__ROOT__', dirname(dirname(dirname(__FILE__))));
require_once __ROOT__ . "/includes/db_config.inc.php";

// Define variables and initialize with empty values
$sender = $sendermail = $subject = $message = "";
$sender_err = $sendermail_err = $subject_err = $message_err = "";
$messageSent = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate Sender name
    if (empty(trim($_POST["sender"]))) {
        $sender_err = "Kérem adja meg a nevét.";
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $_POST["sender"])) {
        $sender_err = "Ez a mező csak betűket és szöközöket tartalmazhat!";
    } else {
        $sender = trim($_POST["sender"]);
    }

    // Validate Sender e-mail
    if (empty(trim($_POST["sendermail"]))) {
        $sendermail_err = "Kérem adja meg e-mail címét.";
    } elseif (!filter_var($_POST["sendermail"], FILTER_VALIDATE_EMAIL)) {
        $sendermail_err = "Helytelen e-mail formátum.";
    } else {
        $sendermail = trim($_POST["sendermail"]);
    }

    // Validate subject
    if (empty(trim($_POST["subject"]))) {
        $subject_err = "Kérem adja meg az üzenet tárgyát.";
    } elseif (strlen(trim($_POST["subject"])) > 255) {
        $subject_err = "Túl hosszú tárgy, kérem 255 karakternél rövidebben fogalmazza meg.";
    } else {
        $subject = trim($_POST["subject"]);
    }

    // Validate message
    if (empty(trim($_POST["message"]))) {
        $message_err = "Kérem adjon meg egy üzenetet.";
    } else {
        $message = trim($_POST["message"]);
    }


    // Check input errors before inserting in database
    if (empty($sender_err) && empty($sendermail_err) && empty($subject_err) && empty($message_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO messages (sender, sendermail, subject, message) VALUES (?, ?, ?, ?)";

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssss", $sender, $sendermail, $subject, $message);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                $messageSent = true;
            } else {
                echo "Hiba történt. Kérem próbálja újra később!.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Close connection
    $mysqli->close();
}
?>

<?php if ($messageSent == false) { ?>
    <h2>Kapcsolatfelvétel</h2>
    <p>Az alábbi űrlapon üzenetet küldhet nekünk.</p>
    <form id="messageForm" method="post">
        <div class="form-group <?php echo (!empty($sender_err)) ? 'has-error' : ''; ?>">
            <label for="sender">Feladó neve</label>
            <input id="sender" type="text" name="sender" class="form-control" value="<?php echo $sender; ?>" required maxlength="75">
            <span class="help-block"><?php echo $sender_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($sendermail_err)) ? 'has-error' : ''; ?>">
            <label for="sendermail">Feladó e-mail címe</label>
            <input id="sendermail" type="text" name="sendermail" class="form-control" value="<?php echo $sendermail; ?>" required maxlength="75">
            <span class="help-block"><?php echo $sendermail_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($subject_err)) ? 'has-error' : ''; ?>">
            <label for="subject">Tárgy</label>
            <input id="subject" type="text" name="subject" class="form-control" value="<?php echo $subject; ?>" required maxlength="255">
            <span class="help-block"><?php echo $subject_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($message_err)) ? 'has-error' : ''; ?>">
            <label for="message">Üzenet</label>
            <textarea id="message" name="message" class="form-control" required><?php echo $message; ?></textarea>
            <span class="help-block"><?php echo $message_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Küldés">
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

    <!-- <script>
        jQuery.validator.setDefaults({
            debug: true,
            success: "valid"
        });
        $("#messageForm").validate({
            rules: {
                sendermail: {
                    required: true,
                    email: true
                }
            }
        });
    </script> -->
<?php } else { ?>
    <h2>Sikeres üzenetküldés</h2>
    <p>Az alábbi üzenetet sikeresen elküldte nekünk: </p>
    <form id="printedMessage" method="post">
        <div class="form-group <?php echo (!empty($sender_err)) ? 'has-error' : ''; ?>">
            <label for="sender">Feladó neve</label>
            <input id="sender" type="text" name="sender" readonly class="form-control" value="<?php echo $sender; ?>">
            <span class="help-block"><?php echo $sender_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($sendermail_err)) ? 'has-error' : ''; ?>">
            <label for="sendermail">Feladó e-mail címe</label>
            <input id="sendermail" type="text" name="sendermail" readonly class="form-control" value="<?php echo $sendermail; ?>">
            <span class="help-block"><?php echo $sendermail_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($subject_err)) ? 'has-error' : ''; ?>">
            <label for="subject">Tárgy</label>
            <input id="subject" type="text" name="subject" readonly class="form-control" value="<?php echo $subject; ?>">
            <span class="help-block"><?php echo $subject_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($message_err)) ? 'has-error' : ''; ?>">
            <label for="message">Üzenet</label>
            <textarea id="message" name="message" readonly class="form-control"><?php echo $message; ?></textarea>
            <span class="help-block"><?php echo $message_err; ?></span>
        </div>
    </form>
<?php } ?>