<?php
/**
 * Created by PhpStorm.
 * User: matthieuparis
 * Date: 10/11/2018
 * Time: 09:21
 */

session_start();

if (empty($_SESSION)) {
    header('Location: index.php');
}

require_once 'uploadFile.php';
include 'header.php';

if (!empty($_POST)) {
    include 'db_connect.php';
    createArticle($_POST['title'], $_POST['content'], $dbh);
}

function createArticle(string $title, string $content, PDO $dbh)
{
    if ($title != null && $content != null) {
        $stmt_user = $dbh->prepare("SELECT * FROM users WHERE id = :id");
        $stmt_user->bindParam('id', $_SESSION['id']);
        $stmt_user->execute();

        $user = $stmt_user->fetch();

        if ($user) {
            $stmt = $dbh->prepare("INSERT INTO article (title, content, image, author) VALUES (:title, :content, :image, :author)");
            $stmt->bindParam('title', $title);
            $stmt->bindParam('content', $content);

            $newFile = uploadFile();

            $stmt->bindParam('image', $newFile);
            $stmt->bindParam('author', $user['id']);

            $stmt->execute();

            echo "<div class=\"msg msg-valid z-depth-3 scale-transition\"> The article was created</div>";
        } else {
            echo "<div class=\"msg msg-error z-depth-3 scale-transition\"> The user does not exist</div>";
        }
    }
}





?>


<section>
    <div class="row">
        <div class="col s12">
            <h4 class="center-align">Create an article</h4>
        </div>
        <div class="col s3"></div>
        <div class="row">
            <form class="col s6" method="post" action="" enctype="multipart/form-data">
                <div class="row">

                    <div class="input-field col s12">
                        <i class="material-icons prefix">title</i>
                        <input id="icon_prefix" type="text" class="validate" name="title" required>
                        <label for="icon_prefix">Title</label>
                    </div>
                    <div class="input-field col s12">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">textsms</i>
                            <textarea id="textarea2" class="materialize-textarea" data-length="1000" required name="content"></textarea>
                            <label for="textarea2">Content</label>
                        </div>
                    </div>
                    <div class="file-field input-field col s12">
                        <div class="btn">
                            <span>File</span>
                            <input type="file" accept="image/jpeg,image/png,image/jpg" required name="image">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
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
include 'footer.php';
?>

<script type="text/javascript">
    $(document).ready(function() {
        $('input#input_text, textarea#textarea2').characterCounter();
    });
</script>