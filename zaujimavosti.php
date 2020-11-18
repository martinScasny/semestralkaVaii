<?php
    require "Databaza.php";
    $databaza = new Databaza();

    $prispevky = $databaza->getAll();
?>
<?php echo file_get_contents("header.html"); ?>

<br>
<?php
if ($_GET == null) {
    foreach ($prispevky as $prispevok) { ?>

        <div class="container col-md-6 align-content-center">
            <h1 class="display-4"><?=$prispevok->getNazov()?></h1>
            <hr class="featurette-divider zaujimavosti">
            <p><?=$prispevok->getText()?></p>
            <hr class="featurette-divider zaujimavosti">
            <a href="<?= "?a=edit" . "&id=" . $prispevok->getId()?>" class="btn btn-link"><i class="fas fa-edit"></i> Uprav</a>
            <a href="<?= "?a=delete" . "&id=" . $prispevok->getId()?>" class="btn btn-link"><i class="fas fa-trash-alt"></i> Zmaž</a>
        </div>



    <?php }
    ?>
    <div class="container col-md-6 align-content-center tlacitko">
        <a href="?a=add" class="btn btn-outline-primary"><i class="far fa-plus-square"></i> Pridať</a>
    </div>
<?php } else {
    if ($_GET['a'] == 'add') { ?>
        <div class="container col-md-7 align-content-center">
            <hr class="featurette-divider zaujimavosti">
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
            <hr class="featurette-divider zaujimavosti">
        </div>

<?php
        if (isset($_POST['nazov'])) {
            $prispevok = new Prispevok($_POST['nazov'], $_POST['text'], $id = rand(1    ,100000));
            $databaza->saveArticle($prispevok);
            header("Location: zaujimavosti.php");
        }
    }
    if ($_GET['a'] == 'delete') {
        $id=$_GET['id'];
        $databaza->removeArticle($id);
        header("Location: zaujimavosti.php");
    }
    if ($_GET['a'] == 'edit') { ?>
        <div class="container col-md-7 align-content-center">
            <form method="post">
                <div class="form-group">
                    <label>Názov</label>
                    <input name="nazov" type="text" class="form-control" value="<?= $databaza->getTextPreId($_GET['id'])['nazov'] ?>">
                </div>
                <div class="form-group">
                    <label>Text</label>
                    <textarea name="text" class="form-control"><?= $databaza->getTextPreId($_GET['id'])['text'] ?></textarea>
                </div>
                <div class="container col-md-1 align-content-center">
                    <button type="submit" class="btn-dark">Submit</button>
                </div>
            </form>
        </div>
        <?php
        if (isset($_POST['nazov'])) {
            $pom = $databaza->editArticle($_GET['id'],$_POST['nazov'],$_POST['text']);
            if ($pom) {
                header("Location: zaujimavosti.php");
            } else echo "<script type='text/javascript'>alert('Zadaj platný text !');</script>";
        }
    }
} ?>

<?php echo file_get_contents("footer.html"); ?>