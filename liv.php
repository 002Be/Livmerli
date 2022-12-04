<?php
    include("sections.php");
    control();
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Livmerli</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
        <?php meta(); ?>
    </head>
    <body>
        <!-- {Navbar -->
        <?php navbar(); ?>
        <!-- Navbar} -->


        <!-- {Contents -->
        <div class="container">
            <div class="text-center mt-5">
                <h1><strong class="titles">Liv Yaz</strong></h1>
            </div>
            <hr>
            <?php
                if(isset($_GET["id"])){
                    $id = $_GET["id"];
                    $sorgu = $conn->prepare("SELECT * FROM liv WHERE id=? ORDER BY sendDate DESC");
                    $sorgu->execute([$id]);
                    $cikti = $sorgu->fetch(PDO::FETCH_ASSOC);
                    ?>
                        <div class="float-center mt-5 mx-auto" style="width: 400px;">
                            <form id="contactForm" action="includes/transactions.php" method="post">
                                <div class="col-auto">
                                    <div class="input-group">
                                    <div class="input-group-text">Başlık</div>
                                    <input name="title" type="text" class="form-control boxBackgroundColor" id="autoSizingInputGroup" value="<?php echo $cikti["title"] ?>" required>
                                    </div>
                                </div>
                                <div class="mb-3 mt-3">
                                    <textarea type="text" name="text" class="form-control boxBackgroundColor" id="exampleFormControlTextarea1" style="height: 300px;" required><?php echo $cikti["text"] ?></textarea>
                                </div>
                                <div id="passwordHelpBlock" class="form-text titles" style="margin-top: -15px;">Liv başlığı maksimum 25 karakter ve içerik maksimum 180 karakter içermelidir.</div>
                                <button name="editLiv" value="<?php echo $id ?>" type="submit" class="btn btn-primary">Düzenle</button>
                            </form>
                        </div>
                    <?php
                }else{
                    ?>
                        <div class="float-center mt-5 mx-auto" style="width: 400px;">
                            <form id="contactForm" action="includes/transactions.php" method="post">
                                <div class="col-auto">
                                    <div class="input-group">
                                    <div class="input-group-text">Başlık</div>
                                    <input name="title" type="text" class="form-control boxBackgroundColor" id="autoSizingInputGroup" placeholder="" required>
                                    </div>
                                </div>
                                <div class="mb-3 mt-3">
                                    <textarea name="text" class="form-control boxBackgroundColor" id="exampleFormControlTextarea1" style="height: 300px;" placeholder="Metin" rows="3" required></textarea>
                                </div>
                                <div id="passwordHelpBlock" class="form-text titles" style="margin-top: -15px;">Liv başlığı maksimum 25 karakter ve içerik maksimum 180 karakter içermelidir.</div>
                                <br><button name="addLiv" type="submit" class="btn btn-primary container">Paylaş</button>
                            </form>
                        </div>
                    <?php
                }
            ?>
        </div>
        <!-- Contents} -->


        <!-- {Footer -->
        <?php footer(); ?>
        <!-- Footer} -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
    </body>
</html>