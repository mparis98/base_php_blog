<?php
/**
 * Created by PhpStorm.
 * User: matthieuparis
 * Date: 10/11/2018
 * Time: 13:45
 */

session_start();

include 'header.php';
include 'db_connect.php';

if (!empty($_POST)) {
    addComment($_POST['username'], $_POST['content'], $dbh);
}

function addComment(string $username, string $content, PDO $dbh)
{
    if ($username != null && $content != null) {
        $stmt_addcomment= $dbh->prepare("INSERT INTO commentaire (username, content, article) VALUES (:username, :content, :article)");
        $stmt_addcomment->bindParam('username', $username);
        $stmt_addcomment->bindParam('content', $content);
        $stmt_addcomment->bindParam('article', $_GET['id']);

        $stmt_addcomment->execute();

        unset($_POST);
    }
}

if (!empty($_GET)) {
    $stmt = $dbh->prepare("SELECT * FROM article WHERE id=:id");
    $stmt->bindParam('id', $_GET['id']);
    $stmt->execute();
    $article = $stmt->fetch();

    $stmt_comments= $dbh->prepare("SELECT * FROM commentaire WHERE article=:id");
    $stmt_comments->bindParam('id', $_GET['id']);
    $stmt_comments->execute();
    $comments = $stmt_comments->fetchAll(); ?>

    <section>
        <div class="row">
            <div class="col s12">
                <h4 class="center-align"><?php echo htmlentities($article['title']) ?></h4>
            </div>
            <div class="col s3"></div>
                <div class="col s6 imageArticle" style="background-image: url(uploads/<?php echo htmlentities($article['image']) ?>);"></div>
            <div class="col s3"></div>
        </div>
        <div class="row">
        <div class="col s3"></div>
            <div class="col s6">
                <p><?php echo htmlentities($article['content']) ?></p>
            </div>
            <div class="col s3"></div>
        </div>

        <?php
        if (!empty($comments)) {
            foreach ($comments as $row) {
                ?>
            <div class="row">
                <div class="col s3"></div>
                <div class="col s6">
                    <ul class="collection">
                        <li class="collection-item avatar">
                            <img src="images/user.svg" alt="" class="circle">
                            <span class="title bold"><?php echo htmlentities($row['username']) ?></span>
                            <p><?php echo htmlentities($row['content']) ?>

                            </p>
                            <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
                        </li>
                    </ul>
                </div>
                <div class="col s3"></div>
            </div>

            <?php
            }
        }
}
        include "comments.php";
        include "footer.php";
        ?>
        <script type="text/javascript">
            $(document).ready(function() {
                $('input#input_text, textarea#textarea2').characterCounter();
            });
        </script>

