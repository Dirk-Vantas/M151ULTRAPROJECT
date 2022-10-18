<nav class="navbar">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul>
            <?php
            if (!empty($_SESSION)) {
                echo '<li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>';
            } else {
                echo '<li class="nav-item"><a class="nav-link" href="register.php">Registrierung</a></li>';
                echo '<li class="nav-item"><a class="nav-link" href="index.php">Login</a></li>';
            }
            ?>
        </ul>
    </div>
</nav>