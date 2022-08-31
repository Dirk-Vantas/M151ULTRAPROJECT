<?php

// Initialisierung
$error = '';
$firstname = $lastname = $email = $username = '';

// Wurden Daten mit "POST" gesendet?
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Ausgabe des gesamten $_POST Arrays
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    if (isset($_POST['firstname'])):
        if (strlen($_POST['firstname']) > 0):
            if (strlen($_POST['firstname']) < 31) :
                $firstname = htmlspecialchars(trim($_POST['firstname']));
            else:
                $error .= "<li>Name ist zu lang</li>";
            endif;
        else :
            $error .= "<li>Name wurde nicht ausgefüllt</li>";
        endif;
    endif;

    if (isset($_POST['lastname'])):
        if (strlen($_POST['lastname']) > 0):
            if (strlen($_POST['lastname']) < 31) :
                $lastname = htmlspecialchars(trim($_POST['lastname']));
            else:
                $error .= "<li>Nachname ist zu lang</li>";
            endif;
        else :
            $error .= "<li>Nachname wurde nicht ausgefüllt</li>";
        endif;
    endif;

    if (isset($_POST['email'])):
        if (strlen($_POST['email']) > 4):
            if (strlen($_POST['email']) < 101) :
                $email = htmlspecialchars(trim($_POST['email']));
            else:
                $error .= "<li>Email ist zu lang</li>";
            endif;
        else :
            $error .= "<li>Email wurde nicht ausgefüllt</li>";
        endif;
    endif;

    if (isset($_POST['username'])):
        if (strlen($_POST['username']) > 5):
            if (strlen($_POST['username']) < 31) :
                $username = htmlspecialchars(trim($_POST['username']));
            else:
                $error .= "<li>Benutzername ist zu lang</li>";
            endif;
        else :
            $error .= "<li>Benutzername wurde nicht ausgefüllt</li>";
        endif;
    endif;

    if (isset($_POST['password'])):
        if (strlen($_POST['password']) > 5):
            if (strlen($_POST['password']) < 255) :
                $password = htmlspecialchars(trim($_POST['password']));
            else:
                $error .= "<li>Password ist zu lang</li>";
            endif;
        else :
            $error .= "<li>Password wurde nicht ausgefüllt</li>";
        endif;
    endif;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrierung</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div class="container">
    <h1>Registrierung</h1>
    <p>
        Bitte registrieren Sie sich, damit Sie diesen Dienst benutzen können.
    </p>
    <?php
    if (strlen($error)) {
        echo "<div class=\"alert alert-danger\" role=\"alert\">" . $error . "</div>";
    }
    ?>
    <form action="validirung.php" method="post">

        <div class="form-group">
            <label for="firstname">Vorname *</label>
            <input type="text" name="firstname" class="form-control" id="firstname"
                   value="<?php echo $firstname ?>"
                   placeholder="Geben Sie Ihren Vornamen an." maxlength="30" required>
        </div>

        <div class="form-group">
            <label for="lastname">Nachname *</label>
            <input type="text" name="lastname" class="form-control" id="lastname"
                   value="<?php echo $lastname ?>"
                   placeholder="Geben Sie Ihren Nachnamen an" maxlength="30" required>
        </div>

        <div class="form-group">
            <label for="email">Email *</label>
            <input type="email" name="email" class="form-control" id="email"
                   value="<?php echo $email ?>"
                   placeholder="Geben Sie Ihre Email-Adresse an." minlength="5" maxlength="100" required>
        </div>

        <div class="form-group">
            <label for="username">Benutzername *</label>
            <input type="text" name="username" class="form-control" id="username"
                   value="<?php echo $username ?>"
                   placeholder="Gross- und Keinbuchstaben, min 6 Zeichen." minlength="6" maxlength="30" required>
        </div>

        <div class="form-group">
            <label for="password">Password *</label>
            <input type="password" name="password" class="form-control" id="password"
                   placeholder="Gross- und Kleinbuchstaben, Zahlen, Sonderzeichen, min. 8 Zeichen, keine Umlaute"
                   minlength="8" maxlength="255" required>
        </div>
        <button type="submit" name="button" value="submit" class="btn btn-info">Senden</button>
        <button type="reset" name="button" value="reset" class="btn btn-warning">Löschen</button>
    </form>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
