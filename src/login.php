<?php

if (!empty($_POST)) {
    include 'db_connect.php';
    loginUser($_POST['login'], $_POST['password'], $dbh);
}

function loginUser(string $login, string $password, PDO $dbh)
{
    if ($login != null && $password != null) {
        $stmt = $dbh->prepare("SELECT * FROM users WHERE username = :login");
        $stmt->bindParam('login', $login);

        $stmt->execute();
        $user = $stmt->fetch();
        if ($user) {
            if (password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['username'] = $user['username'];
                $_SESSION['id'] = $user['id'];
                header('Location: article.php');
                exit();
            } else {
                echo "<div class=\"msg msg-error z-depth-3 scale-transition\">Incorrect password</div>";
            }
        } else {
            echo "<div class=\"msg msg-error z-depth-3 scale-transition\">The user does not exist</div>";
        }
    }
}

function logout()
{
    if (!empty($_SESSION)) {
        session_destroy();
    }
}

include 'header.php';

?>

<section>
    <div class="row">
        <div class="col s12">
            <h4 class="center-align">Connection</h4>
        </div>
        <div class="col s3"></div>
        <form class="col s6" method="post" action="">
            <div class="input-field col s12">
                <i class="material-icons prefix">account_circle</i>
                <input id="icon_prefix" type="text" class="validate" name="login">
                <label for="icon_prefix">Login</label>
            </div>
            <div class="input-field col s12">
                <i class="material-icons prefix">https</i>
                <input id="icon_https" type="password" class="validate" name="password">
                <label for="icon_https">Password</label>
            </div>
            <div class="input-field col s12">
                <button class="btn waves-effect waves-light right" type="submit">Submit
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </form>
        <div class="col s3"></div>

    </div>
</section>


<?php
include 'footer.php'
?>
