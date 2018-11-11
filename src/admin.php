<?php
/**
 * Created by PhpStorm.
 * User: matthieuparis
 * Date: 10/11/2018
 * Time: 10:39
 */

session_start();


if (empty($_SESSION)) {
    header('Location: index.php');
}
include 'db_connect.php';
include 'header.php';

if (!empty($_GET['delete'])) {
    delete($_GET['delete'], $dbh);
}

function delete(int $id, PDO $dbh)
{
    if (empty($_SESSION)) {
        header('Location: index.php');
    } else {
        $stmt = $dbh->prepare("DELETE FROM article WHERE id= :id");
        $stmt->bindParam('id', $id);
        $stmt->execute();
    }
}


$stmt = $dbh->prepare("SELECT * FROM article");
$stmt->execute();
?>

<section>
    <div class="row">
        <div class="col s12">
            <h4 class="center-align">Admin</h4>
        </div>
        <table class="striped">
            <thead>
            <th>Title</th>
            <th>Content</th>
            <th>Link</th>
            <th>Edit</th>
            <th>Delete</th>


            </thead>
            <tbody>
            <?php
            while ($row = $stmt->fetch()) {
                $id =$row['id'];
                echo "<tr>";
                echo "<td>".htmlentities($row['title'])."</td>";
                echo "<td>".htmlentities($row['content'])."</td>";
                echo "<td><a href='articleView.php?id=$id'> View article</a></td>";
                echo "<td><a href='editArticle.php?edit=$id'><i class=\"material-icons prefix\">edit</i></a></td>";
                echo "<td><a href='admin.php?delete=$id'><i class=\"material-icons prefix\">delete</i></a></td>";
                echo "</tr>";
            }
            $stmt->closeCursor();
            ?>
            </tbody>
        </table>

    </div>
</section>


<?php
include 'footer.php';
?>
