<?php
/**
 * Created by PhpStorm.
 * User: matthieuparis
 * Date: 10/11/2018
 * Time: 10:39
 */

session_start();
include 'db_connect.php';
include 'header.php';

if (!empty($_GET['delete'])) {
    delete($_GET['delete'], $dbh);
}

function delete(int $id, PDO $dbh)
{
    $stmt = $dbh->prepare("DELETE FROM article WHERE id= :id");
    $stmt->bindParam('id', $id);
    $stmt->execute();
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
            <th>Edit</th>
            <th>Delete</th>

            </thead>
            <tbody>
            <?php
            while ($row = $stmt->fetch()) {
                $id =$row['id'];
                echo "<tr>";
                echo "<td>".$row['title']."</td>";
                echo "<td>".$row['content']."</td>";
                echo "<td><i class=\"material-icons prefix\">edit</i></td>";
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
