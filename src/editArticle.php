<?php
/**
 * Created by PhpStorm.
 * User: matthieuparis
 * Date: 10/11/2018
 * Time: 12:29
 */
session_start();
require_once 'uploadFile.php';
include 'db_connect.php';

if (empty($_SESSION)) {
    header('Location: index.php');
}
include 'header.php';

if (!empty($_POST)) {
    editArticle($_POST['title'], $_POST['content'], $dbh);
}

function getArticle(int $id, PDO $dbh)
{
    $stmt_article = $dbh->prepare("SELECT * FROM article WHERE id = :id");
    $stmt_article->bindParam('id', $id);
    $stmt_article->execute();

    return $article = $stmt_article->fetch();
}

function editArticle(string $title, string $content, PDO $dbh)
{
    if ($title != null && $content != null) {
        $stmt = $dbh->prepare("UPDATE article SET title=:title, content=:content, image=:image WHERE id =:id");
        $stmt->bindParam('title', $title);
        $stmt->bindParam('content', $content);

        $newImage = uploadFile();

        $stmt->bindParam('image', $newImage);
        $stmt->bindParam('id', $_GET['edit']);

        $stmt->execute();
    }
}

?>

<?php
$article = getArticle($_GET['edit'], $dbh);
?>
<section>
    <div class="row">
        <div class="col s12">
            <h4 class="center-align">Edit</h4>
        </div>
        <div class="col s3"></div>
        <div class="row">
            <form class="col s6" method="post" action="" enctype="multipart/form-data">
                <div class="row">

                    <div class="input-field col s12">
                        <i class="material-icons prefix">title</i>
                        <input id="icon_prefix" type="text" class="validate" name="title" required value="<?php echo htmlentities($article['title']) ?>">
                        <label for="icon_prefix">Title</label>
                    </div>
                    <div class="input-field col s12">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">textsms</i>
                            <textarea id="textarea2" class="materialize-textarea" data-length="1000" required name="content" ><?php echo htmlentities($article['content'])?></textarea>
                            <label for="textarea2">Content</label>
                        </div>
                    </div>
                    <div class="file-field input-field col s12">
                        <div class="btn">
                            <span>File</span>
                            <input type="file" accept="image/jpeg,image/png,image/jpg" required name="image">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" value="<?php echo htmlentities($article['image']) ?>">
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
include "footer.php";

?>

<script type="text/javascript">
    $(document).ready(function() {
        $('input#input_text, textarea#textarea2').characterCounter();
    });
</script>
