<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <?php
            // TODO - wenn Session personalisiert
            if (!empty($_SESSION)) {
                echo '<li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>';
            } else {
                // TODO wenn Session nicht personalisiert
                echo '<li class="nav-item"><a class="nav-link" href="register.php">Registrierung</a></li>';
                echo '<li class="nav-item"><a class="nav-link" href="index.php">Login</a></li>';
            }
            ?>
        </ul>
    </div>
</nav>