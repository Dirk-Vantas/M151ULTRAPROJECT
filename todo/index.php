<?php

// TODO - Sessionhandling starten
session_start();
session_regenerate_id();

// Datenbankverbindung
include('inc/db.php');

$error = '';
$message = '';
$username = $password = '';

// Formular wurde gesendet und Besucher ist noch nicht angemeldet.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // username
    if (isset($_POST['username'])) {
        //trim and sanitize
        $username = htmlspecialchars(trim($_POST['username']));

        // Prüfung username
        if (empty($username) || !preg_match("/(?=.*[a-z])(?=.*[A-Z])[a-zA-Z]{6,30}/", $username)) {
            $error .= "Der Benutzername entspricht nicht dem geforderten Format.<br />";
        }
    } else {
        $error .= "Geben Sie bitte den Benutzername an.<br />";
    }
    // password
    if (isset($_POST['password'])) {
        //trim and sanitize
        $password = trim($_POST['password']);
        // passwort gültig?
        if (empty($password) || !preg_match("/(?=^.{8,255}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/", $password)) {
            $error .= "Das Passwort entspricht nicht dem geforderten Format.<br />";
        }
    } else {
        $error .= "Geben Sie bitte das Passwort an.<br />";
    }

    // kein Fehler
    if (empty($error)) {
        // Query erstellen
        $query = "SELECT id, username, password from users where username = ?";

        // Query vorbereiten
        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            $error .= 'prepare() failed ' . $conn->error . '<br />';
        }
        // Parameter an Query binden
        if (!$stmt->bind_param("s", $username)) {
            $error .= 'bind_param() failed ' . $conn->error . '<br />';
        }
        // Query ausführen
        if (!$stmt->execute()) {
            $error .= 'execute() failed ' . $conn->error . '<br />';
        }
        // Daten auslesen
        $result = $stmt->get_result();

        // Userdaten lesen
        if ($row = $result->fetch_assoc()) {

            // Passwort ok?
            if (password_verify($password, $row['password'])) {

                // TODO - Session personifizieren
                $_SESSION['username'] = $username;
                //$_SESSION['userID'] = $row['id'];
                // TODO - Session ID regenerieren
                session_regenerate_id(true);
                // TODO - weiterleiten auf admin.php
                header('Location: admin.php');
                // TODO - Script beenden
                exit(true);

            } else {
                $error .= "Benutzername oder Passwort sind falsch";
            }
        } else {
            $error .= "Benutzername oder Passwort sind falsch";
        }
    }
}

?>

<?php
$title = "Login";
include('inc/header.php');
?>

<?php include('inc/menu.php'); ?>

<div class="container">
    <h1>Login</h1>
    <p>
        Bitte melden Sie sich mit Benutzernamen und Passwort an.
    </p>
    <?php
    // fehlermeldung oder nachricht ausgeben
    if (!empty($message)) {
        echo "<div class=\"alert alert-success\" role=\"alert\">" . $message . "</div>";
    } else if (!empty($error)) {
        echo "<div class=\"alert alert-danger\" role=\"alert\">" . $error . "</div>";
    }
    ?>
    <form action="index.php" method="post">
        <div class="form-group">
            <label for="username">Benutzername *</label>
            <input type="text" name="username" class="form-control" id="username" value=""
                   placeholder="Gross- und Kleinbuchstaben, min 6 Zeichen." pattern="(?=.*[a-z])(?=.*[A-Z])[a-zA-Z]{6,}"
                   title="Gross- und Kleinbuchstaben, min 6 Zeichen." maxlength="30" required>
        </div>
        <!-- password -->
        <div class="form-group">
            <label for="password">Password *</label>
            <input type="password" name="password" class="form-control" id="password"
                   placeholder="Gross- und Kleinbuchstaben, Zahlen, Sonderzeichen, min. 8 Zeichen, keine Umlaute"
                   pattern="(?=^.{8,}$)((?=.*\d+)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"
                   title="mindestens einen Gross-, einen Kleinbuchstaben, eine Zahl und ein Sonderzeichen, mindestens 8 Zeichen lang,keine Umlaute."
                   maxlength="255" required>
        </div>
        <button type="submit" name="button" value="submit" class="btn btn-info">Senden</button>
        <button type="reset" name="button" value="reset" class="btn btn-warning">Löschen</button>
    </form>
</div>


<?php include("inc/footer.php"); ?>