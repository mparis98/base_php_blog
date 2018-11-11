<?php

include 'db_connect.php';

$stmt = $dbh->prepare("SELECT COUNT(*) AS nbArticle FROM article ORDER BY id");
$stmt->execute();
$articlebypage= 5;
$articles = $stmt->fetch();
$allArticles = $articles['nbArticle'];
$nbPages =ceil($allArticles/$articlebypage);


include 'header.php';

?>

<section>
    <div class="row">
        <div class="col s12">
            <h4 class="center-align">The articles</h4>
        </div>
        <div class="col s12 center-align">
            <ul class="pagination">
                <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>

            <?php

            for ($i=1;$i<= $nbPages;$i++) {
                echo '<li><a class="waves-effect" href="index.php?page=' . $i . '">' . $i . '</a></li>';
            }
            if (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page']>0 && $_GET['page']<= $nbPages) {
                $page=intval($_GET['page']);
            } else {
                $page=1;
            }
?>
                <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>

            </ul>
        </div>
    </div>
            <?php
            $firstArticle=$page*$articlebypage-$articlebypage;

            $listing=$dbh->prepare("SELECT * FROM article ORDER BY id DESC LIMIT :offset, :id");
            $listing->bindParam(':id', $articlebypage, \PDO::PARAM_INT);
            $listing->bindParam(':offset', $firstArticle, \PDO::PARAM_INT);

            $listing->execute();

            $count = 0;

            if ($listing->fetch() == null) {
                ?>
                <div class="row">
                    <div class="col s12">
                    <p class="center-align"> There are no items to display
                    </p>
                    </div>
                </div>

    <?php
            }



            while ($articles = $listing->fetch()) {
                if ($count % 2 == 0) {
                    ?>
        <div class="row">
            <div class="col s1"></div>
            <div class="col s5 imageArticleIndex" style="background-image: url(uploads/<?php echo htmlentities($articles['image']) ?>);">

            </div>
            <div class="col s5">
                <h4 class="center-align"><?php echo htmlentities($articles['title']) ?></h4>
                <p class="block-ellipsis"><?php echo htmlentities($articles['content']) ?></p>
                <div class="center-align margin-top">
                    <a class="center-align" href='articleView.php?id=<?php echo htmlentities($articles['id']) ?>'> See more</a>
                </div>
            </div>
                    <div class="col s1"></div>
        </div>
git status


    <?php
                } else {
                    ?>
                        <div class="row">
                            <div class="col s1"></div>

                            <div class="col s5">
                                <h4 class="center-align"><?php echo htmlentities($articles['title']) ?></h4>
                                <p class="block-ellipsis"><?php echo htmlentities($articles['content']) ?></p>
                                <div class="center-align margin-top">
                                    <a class="center-align" href='articleView.php?id=<?php echo htmlentities($articles['id']) ?>'> See more</a>
                                </div>

                            </div>
                            <div class="col s5 imageArticleIndex" style="background-image: url(uploads/<?php echo htmlentities($articles['image']) ?>);">

                            </div>
                            <div class="col s1"></div>

                        </div>

    <?php
                }
                $count++;
            }
    $listing->closeCursor();

    ?>
</section>


<?php
include 'footer.php'
?>
