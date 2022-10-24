<?php
session_start();
session_regenerate_id(true);

$error = $message = '';

if (!empty($_SESSION)) {
    $message .= "Herzlich Willkommen " . $_SESSION['username'];
} else {
    $error .= "Sie sind nicht angemeldet, melden Sie sich bitte auf der  <a href='login.php'>Login-Seite</a> an.";
}
?>

<?php
$title = "Management";
include('inc/header.php')
?>

<?php include('inc/menu.php') ?>

<div class="container">
    <?php
    if (!empty($error)) {
        echo "<div class=\"alert alert-danger\" role=\"alert\">" . $error . "</div>";
    } else if (!empty($message)) {
        echo "<div class=\"alert alert-success\" role=\"alert\">" . $message . "</div>";

        //load in all requirements
        require('BOToDoManager.php');
        require('UIToDoManager.php');

        $testCollection = array('item1','item2');

        $controlls = new UIRenderToDoManager;
        $user = new BOToDoManager;

        //debug giving userobject fake ID
        $user->setID(500);

        //catch input if user made one
        $user->catchInput();

        //populate user with all his tasks
        $user->populate();

        //render the control pannel for the user
        $controlls->renderControls();

        //render all tasks from the user last
        $controlls->renderList($user->itemCollection);

    }
    ?>
</div>

<?php include('inc/footer.php') ?>