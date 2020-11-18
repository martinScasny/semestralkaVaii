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

        <div class="container col-md-6 align-content-center zaujimavosti">
            <h1 class="display-4"><?=$prispevok->getNazov()?></h1>
            <hr class="featurette-divider zaujimavosti">
            <p class="prispevky"><?=$prispevok->getText()?></p>
            <hr class="featurette-divider zaujimavosti">
            <p class="datum"><?= $prispevok->getDatum() ?></p>
            <a href="<?= "?do=edit" . "&id=" . $prispevok->getId()?>" class="btn btn-link"><i class="fas fa-edit"></i> Uprav</a>
            <a href="<?= "?do=delete" . "&id=" . $prispevok->getId()?>" class="btn btn-link"><i class="fas fa-trash-alt"></i> Zmaž</a>
        </div>
    <?php }
    ?>
    <div class="container col-md-6 align-content-center tlacitko">
        <a href="?do=add" class="btn btn-outline-primary"><i class="far fa-plus-square"></i> Pridať</a>
    </div>
<?php } else {
    if ($_GET['do'] == 'add') { ?>
        <div class="container col-md-7 align-content-center">
            <hr class="featurette-divider zaujimavosti">
            <form method="post">
                <div class="form-group">
                    <label>Názov</label>
                    <input name="nazov" type="text" class="form-control" placeholder="Vložte názov príspevku (max 30znakov)">
                </div>
                <div class="form-group">
                    <label>Text</label>
                    <textarea name="text" class="form-control" placeholder="Sem píšte text...(max 255znakov)"></textarea>
                </div>
                <button type="submit" class="btn-dark" >Submit</button>
            </form>
            <hr class="featurette-divider zaujimavosti">
        </div>

<?php
        if (isset($_POST['nazov']) && isset($_POST['text'])) {
            if ($_POST['nazov'] != "" && $_POST['text'] != "") {
                $pom = $databaza->createPost($_POST['nazov'],$_POST['text'],$databaza->generujID() + 1);
                if ($pom)
                header("Location: zaujimavosti.php");
            }
        }
    }
    if ($_GET['do'] == 'delete') {
        $id=$_GET['id'];
        $databaza->removeArticle($id);
        header("Location: zaujimavosti.php");
    }
    if ($_GET['do'] == 'edit') { ?>
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
        if (isset($_POST['nazov']) && isset($_POST['text'])) {
            $pom = $databaza->editArticle($_GET['id'],$_POST['nazov'],$_POST['text']);
            if ($pom) {
                header("Location: zaujimavosti.php");
            } else echo "<script type='text/javascript'>alert('Zadaj platný text !');</script>";
        }
    }
} ?>

<?php echo file_get_contents("footer.html"); ?>