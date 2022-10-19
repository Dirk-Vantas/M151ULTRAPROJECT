<?php

/**
 * @author Gideon Watson
 * @description This file is gonna render and execut a password change
 */


// Datenbankverbindung
include('inc/db.php');

// TODO - Sessionhandling starten
session_start();




//logic
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // Passwort ausgefüllt
    if (isset($_POST['password1'])) {
        if (isset($_POST['password2'])) {
        

        //trim and sanitize
        $password = trim($_POST['password']);

        //mindestens 1 Zeichen , entsprich RegEX
        if (empty($password) || !preg_match("/(?=^.{8,255}$)((?=.*\d+)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/", $password)) {
            $error .= "Geben Sie bitte einen korrektes Password ein.<br />";
        }

        }
        
    } else {
        $error .= "Geben Sie bitte ein Password ein.<br />";
    }

    // wenn kein Fehler vorhanden ist, schreiben der Daten in die Datenbank
    if (empty($error)) {

        $password = $_POST['password2'];
        // Password haschen
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Query erstellen
        $query = "UPDATE users SET password=? WHERE username=?";

        // Query vorbereiten
        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            $error .= 'prepare() failed ' . $conn->error . '<br />';
        }

        // Parameter an Query binden
        if (!$stmt->bind_param('ss', $password_hash, $_SESSION['username'])) {
            $error .= 'bind_param() failed ' . $conn->error . '<br />';
        }

        // Query ausführen
        if (!$stmt->execute()) {
            $error .= 'execute() failed ' . $conn->error . '<br />';
        }

        // kein Fehler!
        if (empty($error)) {
            $conn->close();
            // Weiterleiten auf login.php
            header('Location: index.php');
            // beenden des Scriptes
            exit();
        }
    }



}

//render interface
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administrationbereich</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/aa92474866.js" crossorigin="anonymous"></script>
</head>

<div class="container">
    <h1>Passwort Aendern</h1>
    <p>
        Pee Pee Poo Poo
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
        <!-- Password1 -->
        <div class="form-group">
            <label for="password1">Neues Passwort *</label>
            <input type="text" name="password1" class="form-control" id="password1" 
                   placeholder="Geben sie ein neues Passwort ein" maxlength="30" required="true">
        </div>
        <!-- nachname -->
        <div class="form-group">
            <label for="lastname">Passwort wiederholen *</label>
            <input type="text" name="Password2" class="form-control" id="password2" 
                   placeholder="Geben sie es erneut ein" maxlength="30" required="true">
        </div>
        <!-- Send / Reset -->
        <button type="submit" name="button" value="submit" class="btn btn-info">Senden</button>
        <button type="reset" name="button" value="reset" class="btn btn-warning">Löschen</button>
    </form>
</div>

<?php include('inc/footer.php')?>