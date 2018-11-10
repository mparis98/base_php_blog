<nav>
    <div class="nav-wrapper">
        <a href="#" class="brand-logo left">Blog IPSSI</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <?php
            if (!empty($_SESSION)) {
                $username = $_SESSION['username'];
                echo "<li><p class='margeP'>Hello $username</p></li>";
                echo "<li><a href=\"article.php\">Create an article</a></li>";
                echo "<li><a href=\"admin.php\">Admin</a></li>";
                echo "<li><a href=\"index.php?logout\">Log out</a></li>";
            } else {
                echo "<li><a href=\"index.php\">Connection</a></li>";
                echo "<li><a href=\"registration.php\">Registration</a></li>";
            }
            ?>
        </ul>
    </div>
</nav>
<body>

<section>
    <div class="row">
        <div class="col s12 bg-home">
            <h1 class="center-align white-text">Blog IPSSI</h1>
        </div>

    </div>
</section>

<main>
