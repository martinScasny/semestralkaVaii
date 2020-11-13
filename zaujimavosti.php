<?php
    require "Storage.php";
    $storage = new Storage();

    $articles = $storage->getAll();
?>
<?php echo file_get_contents("header.html"); ?>


<?php
if ($_GET == null) {
    foreach ($articles as $article) { ?>

        <div class="container col-md-6 align-content-center">
            <h1 class="display-4"><?=$article->getNazov()?></h1>
            <p><?=$article->getText()?></p>
            <a href="<?= "?a=edit" . "&id=" . $article->getId()?>" class="btn btn-link"><i class="fas fa-edit"></i> Uprav</a>
            <a href="<?= "?a=delete" . "&id=" . $article->getId()?>" class="btn btn-link"><i class="fas fa-trash-alt"></i> Zmaž</a>
        </div>

    <hr class="featurette-divider zaujimavosti">

    <?php }
    ?>
    <div class="container col-md-6 align-content-center tlacitko">
        <a href="?a=add" class="btn btn-outline-primary"><i class="far fa-plus-square"></i> Pridať</a>
    </div>
<?php } else {
    if ($_GET['a'] == 'add') { ?>
        <div class="container col-md-7 align-content-center">
            <form method="post">
                <div class="form-group">
                    <label>Názov</label>
                    <input name="nazov" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label>Text</label>
                    <textarea name="text" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn-dark" >Submit</button>
            </form>
        </div>

<?php
        if (isset($_POST['nazov'])) {
            $article = new Article($_POST['nazov'], $_POST['text'], $id = rand(1,100000));
            $storage->saveArticle($article);
            header("Location: zaujimavosti.php");
        }
    }
    if ($_GET['a'] == 'delete') {
        $id=$_GET['id'];
        $storage->removeArticle($id);
        header("Location: zaujimavosti.php");
    }
    if ($_GET['a'] == 'edit') { ?>
        <div class="container col-md-7 align-content-center">
            <form method="post">
                <div class="form-group">
                    <label>Názov</label>
                    <input name="nazov" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label>Text</label>
                    <textarea name="text" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn-dark" >Submit</button>
            </form>
        </div>

        <?php
        if (isset($_POST['nazov'])) {
            $pom = $storage->editArticle($_GET['id'],$_POST['nazov'],$_POST['text']);
            if ($pom) {
                header("Location: zaujimavosti.php");
            } else echo "<script type='text/javascript'>alert('Zadaj platný text !');</script>";
        }
    }
} ?>

<?php echo file_get_contents("footer.html"); ?>