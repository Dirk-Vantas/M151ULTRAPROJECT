<?php

// Initialisierung
$error = '';
$firstname = $lastname = $email = $username = $password = '';

// Wurden Daten mit "POST" gesendet?
if($_SERVER['REQUEST_METHOD'] == "POST"){
  // Ausgabe des gesamten $_POST Arrays
  echo "<pre>";
  print_r($_POST);
  echo "</pre>";

  if(isset($_POST['firstname'])){
    //trim and sanitize
    $firstname = trim(htmlspecialchars($_POST['firstname']));
    
    //mindestens 1 Zeichen und maximal 30 Zeichen lang
    if(empty($firstname) || strlen($firstname) > 30){
      $error .= "Geben Sie bitte einen korrekten Vornamen ein.<br />";
    }
    } else {
      $error.= "Geben Sie bitte einen Vornamen ein.<br />";
  }

  if(isset($_POST['lastname'])){
    //trim and sanitize
    $lastname = trim(htmlspecialchars($_POST['lastname']));
    
    //mindestens 1 Zeichen und maximal 30 Zeichen lang
    if(empty($lastname) || strlen($lastname) > 30){
      $error .= "Geben Sie bitte einen korrekten Nachnamen ein.<br />";
    }
    } else {
      $error.= "Geben Sie bitte einen Nachnamen ein.<br />";
  }

  if(isset($_POST['email'])){
    //trim and sanitize
    $email = trim(htmlspecialchars($_POST['email']));
    
    //mindestens 1 Zeichen und maximal 30 Zeichen lang
    if(empty($email) || strlen($email) > 100){
      $error .= "Geben Sie bitte eine korrekte Email ein.<br />";
    }
    } else {
      $error.= "Geben Sie bitte eine Email ein.<br />";
  }

  if(isset($_POST['username'])){
    //trim and sanitize
    $username = trim(htmlspecialchars($_POST['username']));
    
    //mindestens 1 Zeichen und maximal 30 Zeichen lang
    if(empty($username) || strlen($username) > 30){
      $error .= "Geben Sie bitte einen korrekten Benutzernamen ein.<br />";
    }
    } else {
      $error.= "Geben Sie bitte einen Benutzernamen ein.<br />";
  }

  if(isset($_POST['username'])){
    //trim and sanitize
    $username = trim(htmlspecialchars($_POST['username']));
    
    //mindestens 1 Zeichen und maximal 30 Zeichen lang
    if(empty($username) || strlen($username) > 30){
      $error .= "Geben Sie bitte einen korrekten Benutzernamen ein.<br />";
    }
    } else {
      $error.= "Geben Sie bitte einen Benutzernamen ein.<br />";
  }

  if(isset($_POST['password'])){
    //trim and sanitize
    $password = trim(htmlspecialchars($_POST['password']));
    
    //mindestens 1 Zeichen und maximal 30 Zeichen lang
    if(empty($password) || strlen($password) > 255){
      $error .= "Geben Sie bitte ein korrektes Passwort ein.<br />";
    }
    } else {
      $error.= "Geben Sie bitte ein Passwort ein.<br />";
  }
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
        // Ausgabe der Fehlermeldungen
        if(strlen($error)){
          echo "<div class=\"alert alert-danger\" role=\"alert\">" . $error . "</div>";
        }
      ?>
      <form action="" method="post">
        <!-- TODO: Clientseitige Validierung: vorname -->
        <div class="form-group">
          <label for="firstname">Vorname *</label>
          <input type="name" name="firstname" class="form-control" id="firstname" required maxlength="30"
                  value="<?php echo $firstname ?>"
                  placeholder="Geben Sie Ihren Vornamen an.">
        </div>
        <!-- TODO: Clientseitige Validierung: nachname -->
        <div class="form-group">
          <label for="lastname">Nachname *</label>
          <input type="name" name="lastname" class="form-control" id="lastname" required maxlength="30"
                  value="<?php echo $lastname ?>"
                  placeholder="Geben Sie Ihren Nachnamen an">
        </div>
        <!-- TODO: Clientseitige Validierung: email -->
        <div class="form-group">
          <label for="email">Email *</label>
          <input type="email" name="email" class="form-control" id="email" required maxlength="100"
                  value="<?php echo $email ?>"
                  placeholder="Geben Sie Ihre Email-Adresse an.">
        </div>
        <!-- TODO: Clientseitige Validierung: benutzername -->
        <div class="form-group">
          <label for="username">Benutzername *</label>
          <input type="text" name="username" class="form-control" id="username" required maxlength="30" minlength="6"
                  value="<?php echo $username ?>"
                  placeholder="Gross- und Keinbuchstaben, min 6 Zeichen.">
        </div>
        <!-- TODO: Clientseitige Validierung: password -->
        <div class="form-group">
          <label for="password">Password *</label>
          <input type="password" name="password" class="form-control" id="password" required maxlength="255" minlength="8"
                  placeholder="Gross- und Kleinbuchstaben, Zahlen, Sonderzeichen, min. 8 Zeichen, keine Umlaute">
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
