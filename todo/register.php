<?php

// TODO - Sessionhandling starten
session_start();
session_regenerate_id(true);

// Datenbankverbindung
include('inc/db.php');

// Initialisierung
$error = $message = '';
$firstname = $lastname = $email = $username = $password = '';

// Wurden Daten mit "POST" gesendet?
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // Vorname ausgefüllt?
    if (isset($_POST['firstname'])) {
        //trim and sanitize
        $firstname = htmlspecialchars(trim($_POST['firstname']));

        //mindestens 1 Zeichen und maximal 30 Zeichen lang
        if (empty($firstname) || strlen($firstname) > 30) {
            $error .= "Geben Sie bitte einen korrekten Vornamen ein.<br />";
        }
    } else {
        $error .= "Geben Sie bitte einen Vornamen ein.<br />";
    }

    // Nachname ausgefüllt?
    if (isset($_POST['lastname'])) {
        //trim and sanitize
        $lastname = htmlspecialchars(trim($_POST['lastname']));

        //mindestens 1 Zeichen und maximal 30 Zeichen lang
        if (empty($lastname) || strlen($lastname) > 30) {
            $error .= "Geben Sie bitte einen korrekten Nachname ein.<br />";
        }
    } else {
        $error .= "Geben Sie bitte einen Nachname ein.<br />";
    }

    // Email ausgefüllt?
    if (isset($_POST['email'])) {
        //trim an sanitize
        $email = htmlspecialchars(trim($_POST['email']));

        //mindestens 1 Zeichen und maximal 100 Zeichen lang, gültige Emailadresse
        if (empty($email) || strlen($email) > 100 || filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $error .= "Geben Sie bitte eine korrekten Emailadresse ein.<br />";
        }
    } else {
        $error .= "Geben Sie bitte eine Emailadresse ein.<br />";
    }

    // Username ausgefüllt?
    if (isset($_POST['username'])) {
        //trim and sanitize
        $username = htmlspecialchars(trim($_POST['username']));

        //mindestens 1 Zeichen , entsprich RegEX
        if (empty($username) || !preg_match("/(?=.*[a-z])(?=.*[A-Z])[a-zA-Z]{6,30}/", $username)) {
            $error .= "Geben Sie bitte einen korrekten Usernamen ein.<br />";
        }
    } else {
        $error .= "Geben Sie bitte einen Username ein.<br />";
    }

    // Passwort ausgefüllt
    if (isset($_POST['password'])) {
        //trim and sanitize
        $password = trim($_POST['password']);

        //mindestens 1 Zeichen , entsprich RegEX
        if (empty($password) || !preg_match("/(?=^.{8,255}$)((?=.*\d+)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/", $password)) {
            $error .= "Geben Sie bitte einen korrektes Password ein.<br />";
        }
    } else {
        $error .= "Geben Sie bitte ein Password ein.<br />";
    }

    // wenn kein Fehler vorhanden ist, schreiben der Daten in die Datenbank
    if (empty($error)) {
        // Password haschen
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Query erstellen
        $query = "Insert into users (firstname, lastname, username, password, email) values (?,?,?,?,?)";

        // Query vorbereiten
        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            $error .= 'prepare() failed ' . $conn->error . '<br />';
        }

        // Parameter an Query binden
        if (!$stmt->bind_param('sssss', $firstname, $lastname, $username, $password_hash, $email)) {
            $error .= 'bind_param() failed ' . $conn->error . '<br />';
        }

        // Query ausführen
        if (!$stmt->execute()) {
            $error .= 'execute() failed ' . $conn->error . '<br />';
        }

        // kein Fehler!
        if (empty($error)) {
            $message .= "Die Daten wurden erfolgreich in die Datenbank geschrieben<br/ >";
            // Felder leeren und Weiterleitung auf anderes Script: z.B. Login!
            $username = $password = $firstname = $lastname = $email = '';
            // Verbindung schliessen
            $conn->close();
            // Weiterleiten auf login.php
            header('Location: index.php');
            // beenden des Scriptes
            exit();
        }
    }
}

?>


    <?php
    $title = "Registrieren";
    include('inc/header.php');
    ?>

<?php include('inc/menu.php'); ?>

<div class="container">
    <h1>Registrierung</h1>
    <p>
        Bitte registrieren Sie sich, damit Sie diesen Dienst benutzen können.
    </p>
    <?php
    // Ausgabe der Fehlermeldungen
    if (!empty($error)) {
        echo "<div class=\"alert alert-danger\" role=\"alert\">" . $error . "</div>";
    } else if (!empty($message)) {
        echo "<div class=\"alert alert-success\" role=\"alert\">" . $message . "</div>";
    }
    ?>
    <form action="" method="post">
        <!-- vorname -->
        <div class="form-group">
            <label for="firstname">Vorname *</label>
            <input type="text" name="firstname" class="form-control" id="firstname" value="<?php echo $firstname ?>"
                   placeholder="Geben Sie Ihren Vornamen an." maxlength="30" required="true">
        </div>
        <!-- nachname -->
        <div class="form-group">
            <label for="lastname">Nachname *</label>
            <input type="text" name="lastname" class="form-control" id="lastname" value="<?php echo $lastname ?>"
                   placeholder="Geben Sie Ihren Nachnamen an" maxlength="30" required="true">
        </div>
        <!-- email -->
        <div class="form-group">
            <label for="email">Email *</label>
            <input type="email" name="email" class="form-control" id="email" value="<?php echo $email ?>"
                   placeholder="Geben Sie Ihre Email-Adresse an." maxlength="100" required="true">
        </div>
        <!-- benutzername -->
        <div class="form-group">
            <label for="username">Benutzername *</label>
            <input type="text" name="username" class="form-control" id="username" value="<?php echo $username ?>"
                   placeholder="Gross- und Keinbuchstaben, min 6 Zeichen." pattern="(?=.*[a-z])(?=.*[A-Z])[a-zA-Z]{6,}"
                   title="Gross- und Keinbuchstaben, min 6 Zeichen." maxlength="30" required="true">
        </div>
        <!-- password -->
        <div class="form-group">
            <label for="password">Password *</label>
            <input type="password" name="password" class="form-control" id="password"
                   placeholder="Gross- und Kleinbuchstaben, Zahlen, Sonderzeichen, min. 8 Zeichen, keine Umlaute"
                   pattern="(?=^.{8,}$)((?=.*\d+)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"
                   title="mindestens einen Gross-, einen Kleinbuchstaben, eine Zahl und ein Sonderzeichen, mindestens 8 Zeichen lang,keine Umlaute."
                   maxlength="255" required="true">
        </div>
        <!-- Send / Reset -->
        <button type="submit" name="button" value="submit" class="btn btn-info">Senden</button>
        <button type="reset" name="button" value="reset" class="btn btn-warning">Löschen</button>
    </form>
</div>

<?php include('inc/footer.php')?>