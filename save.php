<?php
    include("sections.php");
    control();

    $sorgu = $conn->prepare("SELECT * FROM liv");
    $sorgu->execute();
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
            <?php
            if(isset($_GET["user"])){
                $user = $_GET["user"];
            }
        ?>


        <div class="container float-center mt-5 mx-auto" style="width: 800px;">
            <div class="text-center">
                <h1><strong class="titles">Kaydedilenler</strong></h1>
                <hr>
                <form action="includes/transactions.php" method="POST">
                    <?php
                        while($cikti = $sorgu->fetch(PDO::FETCH_ASSOC)){
                            $sorgu2 = $conn->prepare("SELECT * FROM liv_save");
                            $sorgu2->execute();
                            while($cikti2 = $sorgu2->fetch(PDO::FETCH_ASSOC)){
                                if($cikti["id"]==$cikti2["livId"]){
                                    ?>
                                        <div class="card mt-3">
                                            <div class="card-header opacity-75 boxBackgroundColor">
                                                <span style="float: left;"><?php echo $cikti["username"];?></span>
                                                <span style="float: right;">
                                                    <div class="btn-group dropend">
                                                        <?php if(isset($_SESSION["Username"])){ ?>
                                                            <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <?php timeDiff($cikti["sendDate"]); ?>
                                                            </button>
                                                        <?php }else{ ?>
                                                                <span class="badge rounded-pill text-bg-secondary" style="float: right;"><?php timeDiff($cikti["sendDate"]); ?></span>
                                                        <?php } ?>
                                                            <ul class="dropdown-menu">
                                                                <?php if($_SESSION["Username"]==$cikti["username"]){ ?>
                                                                    <form action="includes/transactions.php" method="POST">
                                                                        <li><button type="button" class="dropdown-item">Beğen</button></li>
                                                                        <li><button type="button" class="dropdown-item">Yorum Yap</button></li>
                                                                        <li><button name="deleteSaveLiv" value="<?php echo $cikti["id"]; ?>" type="submit" class="dropdown-item">Kayıttan Kaldır</button></li>
                                                                        <li><a name="editLiv" href="liv.php?id=<?php echo $cikti["id"]; ?>" value="<?php echo $cikti["id"]; ?>" type="submit" class="dropdown-item">Düzenle</a></li>
                                                                        <li><button name="deleteLiv" value="<?php echo $cikti["id"]; ?>" type="submit" class="dropdown-item">Sil</button></li>
                                                                    </form>
                                                                <?php }else{ ?>
                                                                    <form action="includes/transactions.php" method="POST">
                                                                        <li><button type="button" class="dropdown-item">Beğen</button></li>
                                                                        <li><button type="button" class="dropdown-item">Yorum Yap</button></li>
                                                                        <li><button name="deleteSaveLiv" value="<?php echo $cikti["id"]; ?>" type="submit" class="dropdown-item">Kayıttan Kaldır</button></li>
                                                                        <li><button type="button" class="dropdown-item">Şikayet Et</button></li>
                                                                    </form>
                                                            <?php } ?>
                                                    </div>
                                                </span>
                                            </div>
                                            <div class="card-body boxBackgroundColor">
                                                <h5 class="card-title"><?php echo $cikti["title"] ?></h5>
                                                <p class="card-text"><?php echo $cikti["text"] ?></p>
                                            </div>
                                        </div>
                                    <?php
                                }
                            }
                        }
                    ?>
                </form>
            </div>
        </div>
        <!-- Contents} -->


        <!-- {Footer -->
        <div style="margin-bottom: 80px;"></div>
        <?php footer(); ?>
        <!-- Footer} -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
    </body>
</html>