<?php

include('inc/db.php');

session_start();
session_regenerate_id(true);

//logic
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['password1'])) {
        if (isset($_POST['password2'])) {
            if($_POST['password1'] === $_POST['password2']){
                $password = trim($_POST['password']);

                if (empty($password) || !preg_match("/(?=^.{8,255}$)((?=.*\d+)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/", $password)) {
                    $error .= "Geben Sie bitte einen korrektes Password ein.<br />";
                }
            }else{
                $error .= "Passwort stimmt nicht überein<br />";
            }
        }
    } else {
        $error .= "Geben Sie bitte ein Password ein.<br />";
    }

    if (empty($error)) {
        $password = $_POST['password2'];
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
            header('Location: index.php');
            exit();
        }
    }
}

?>

<?php
$title = "Passwort ändern";
include('inc/header.php');
?>

<?php include('inc/menu.php'); ?>

    <div class="container">
        <h1>Passwort Ändern</h1>

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

<?php include('inc/footer.php') ?>