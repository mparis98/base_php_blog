<?php
/**
 * Created by PhpStorm.
 * User: matthieuparis
 * Date: 09/11/2018
 * Time: 21:43
 */

declare(strict_types = 1);

include 'header.php';


if (!empty($_POST)) {
    include 'db_connect.php';

    insertUser($_POST['login'], $_POST['password'], $_POST['confirm_password'], $dbh);
}

function insertUser(string $login, string $password, string $confirm_password, PDO $dbh)
{
    if ($login != null && $password != null && $confirm_password != null) {
        $stmt_username = $dbh->prepare("SELECT * FROM users WHERE username = :username");
        $stmt_username->bindParam('username', $login);
        $stmt_username->execute();
        $username = $stmt_username->fetch();


        if ($password == $confirm_password) {
            if ($username == null) {
                $password_hash = password_hash($password, PASSWORD_DEFAULT);

                $stmt = $dbh->prepare("INSERT INTO users (username, password) VALUES (:login, :password)");

                $stmt->bindParam('login', $login);
                $stmt->bindParam('password', $password_hash);

                $stmt->execute();

                echo "<div class=\"msg msg-valid z-depth-3 scale-transition\"> Account created</div>";
            } else {
                echo "<div class=\"msg msg-error z-depth-3 scale-transition\"> Login already used</div>";
            }
        } else {
            echo "<div class=\"msg msg-error z-depth-3 scale-transition\"> The two fields are not identical</div>";
        }
    }
}


?>

<section>
    <div class="row">
        <div class="col s12">
            <h4 class="center-align">Registration</h4>
        </div>
        <div class="col s3"></div>
        <div class="row">
        <form class="col s6" method="post" action="">
            <div class="row">

            <div class="input-field col s12">
                <i class="material-icons prefix">account_circle</i>
                <input id="icon_prefix" type="text" class="validate" name="login" required>
                <label for="icon_prefix">Login</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">https</i>
                <input id="icon_https" type="password" class="validate" name="password" required>
                <label for="icon_https">Password</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">https</i>
                <input id="icon_https" type="password" class="validate" name="confirm_password" required>
                <label for="icon_https">Confirmation password</label>
            </div>
            <div class="input-field col s12">
                <button class="btn waves-effect waves-light right" type="submit">Submit
                    <i class="material-icons right">send</i>
                </button>
            </div>
            </div>
        </form>
        </div>
        <div class="col s3"></div>

    </div>
</section>

<?php
include 'footer.php'
?>


