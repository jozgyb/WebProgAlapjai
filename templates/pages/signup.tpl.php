<?php
// Include config file
define('__ROOT__', dirname(dirname(dirname(__FILE__))));
require_once __ROOT__ . "/includes/db_config.inc.php";

// Define variables and initialize with empty values
$username = $password = $lastname = $firstname = $confirm_password = "";
$username_err = $password_err = $lastname_err = $firstname_err = $confirm_password_err = "";

// Processing form data when form is submitted
$alreadyRegistered = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Kérem adja meg felhasználónevét.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // store result
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    $username_err = "Ez a felhasználónév már létezik.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Hoppá! Hiba történt. Kérem próbálja újra később.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Validate lastname
    if (empty(trim($_POST["lastname"]))) {
        $lastname_err = "Kérem adja meg vezetéknevét.";
    } else {
        $lastname = trim($_POST["lastname"]);
    }

    // Validate firstname
    if (empty(trim($_POST["firstname"]))) {
        $firstname_err = "Kérem adja meg keresztnevét.";
    } else {
        $firstname = trim($_POST["firstname"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Kérem adjon meg egy jelszót.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "A jelszónak legalább 6 karakterből kell állnia.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Kérem erősítse meg jelszavát.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "A jelszavak nem egyeznek.";
        }
    }

    // Check input errors before inserting in database
    if (empty($username_err) && empty($password_err) && empty($lastname_err) && empty($firstname_err) && empty($confirm_password_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO users (username, lastname, firstname, password) VALUES (?, ?, ?, ?)";

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssss", $param_username, $param_lastname, $param_firstname, $param_password);

            // Set parameters
            $param_username = $username;
            $param_lastname = $lastname;
            $param_firstname = $firstname;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to login page
                $alreadyRegistered = true;
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
<?php if ($alreadyRegistered == false) { ?>
    <h2>Regisztráció</h2>
    <p>Kérem töltse ki az alábbi adatokat a felhasználói fiók létrehozásához.</p>
    <form method="post">
        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
            <label>Felhasználónév</label>
            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
            <span class="help-block"><?php echo $username_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($lastname_err)) ? 'has-error' : ''; ?>">
            <label>Vezetéknév</label>
            <input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>">
            <span class="help-block"><?php echo $lastname_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($firstname_err)) ? 'has-error' : ''; ?>">
            <label>Keresztnév</label>
            <input type="text" name="firstname" class="form-control" value="<?php echo $firstname; ?>">
            <span class="help-block"><?php echo $firstname_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label>Jelszó</label>
            <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
            <span class="help-block"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
            <label>Jelszó megerősítése</label>
            <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
            <span class="help-block"><?php echo $confirm_password_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Regisztráció">
            <input type="reset" class="btn btn-default" value="Reset">
        </div>
        <p>Már van felhasználód? <a href="/belepes">Bejelentkezés</a>.</p>
    </form>
<?php } else { ?>
    <p>Sikeres regisztráció. <a href="/belepes">Bejelentkezés</a>.</p>
<?php } ?>