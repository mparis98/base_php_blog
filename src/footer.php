<?php
/**
 * Created by PhpStorm.
 * User: matthieuparis
 * Date: 09/11/2018
 * Time: 21:01
 */
?>

</main>
<footer class="page-footer">
    <div class="container">
        <div class="row margin_bottom">
            <div class="col l6 s12">
                <h5 class="white-text">Matthieu PARIS</h5>
                <p class="grey-text text-lighten-4">Make with Materialize css</p>
            </div>
            <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Links</h5>
                <ul>
                    <?php
                    if (!empty($_SESSION)) {
                        $username = htmlentities($_SESSION['username']);
                        echo "<li><a class=\"grey-text text-lighten-3\" href=\"article.php\">Create an article</a></li>";
                        echo "<li><a class=\"grey-text text-lighten-3\" href=\"admin.php\">Admin</a></li>";
                    } else {
                        echo "<li><a class=\"grey-text text-lighten-3\" href=\"index.php\">Home</a></li>";
                        echo "<li><a class=\"grey-text text-lighten-3\" href=\"login.php\">Connection</a></li>";
                        echo "<li><a class=\"grey-text text-lighten-3\" href=\"registration.php\">Registration</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</footer>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>
