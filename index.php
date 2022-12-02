<?php
    include("sections.php");

    $sorgu = $conn->prepare("SELECT * FROM liv ORDER BY sendDate DESC");
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
        <div class="container float-center mt-5 mx-auto" style="width: 800px;">
            <?php
                if(isset($_GET["arkadaslar"])){ ?>
                    <div class="text-center">
                        <h1><strong class="titles">Arkadaş Livleri</strong></h1>
                    </div>
                <?php
                    if(isset($_SESSION["GirisDurumu"])==true){ ?>
                        <div class="btn-group">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Arkadaşlar
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="index.php">Global</a></li>
                            </ul>
                        </div>
                    <?php
                    }
                    while($cikti = $sorgu->fetch(PDO::FETCH_ASSOC)){
                        $sorgu2 = $conn->prepare("SELECT * FROM friends");
                        $sorgu2->execute();
                        while($cikti2 = $sorgu2->fetch(PDO::FETCH_ASSOC)){
                            if($_SESSION["Username"]==$cikti2["username"] && $cikti["status"]==1){
                                ?>
                                    <div class="card mt-3">
                                    <div class="card-header opacity-75 boxBackgroundColor">
                                            <span style="float: left;"> <a style="color: dimgrey; text-decoration: none;" href="profile.php?user=<?php echo $cikti2["friendUsername"];?>"><?php echo $cikti2["friendUsername"];?></a></span>
                                            <span style="float: right;">
                                                <div class="btn-group dropend">
                                                        <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <?php timeDiff($cikti["sendDate"]); ?>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <?php if($_SESSION["Username"]==$cikti["username"]){ ?>
                                                                <form action="includes/transactions.php" method="POST">
                                                                    <li><button type="button" class="dropdown-item">Beğen</button></li>
                                                                    <li><a href="comment.php?id=<?php echo $cikti["id"]; ?>" class="dropdown-item">Yorum Yap</a></li>
                                                                    <li><button name="addSaveLiv" value="<?php echo $cikti["id"]; ?>" type="submit" class="dropdown-item">Kaydet</button></li>
                                                                    <li><a name="editLiv" href="liv.php?id=<?php echo $cikti["id"]; ?>" value="<?php echo $cikti["id"]; ?>" type="submit" class="dropdown-item">Düzenle</a></li>
                                                                    <li><button name="deleteLiv" value="<?php echo $cikti["id"]; ?>" type="submit" class="dropdown-item">Sil</button></li>
                                                                </form>
                                                            <?php }else{ ?>
                                                                <form action="includes/transactions.php" method="POST">
                                                                    <li><button type="button" class="dropdown-item">Beğen</button></li>
                                                                    <li><a href="comment.php?id=<?php echo $cikti["id"]; ?>" class="dropdown-item">Yorum Yap</a></li>
                                                                    <li><button name="addSaveLiv" value="<?php echo $cikti["id"]; ?>" type="submit" class="dropdown-item">Kaydet</button></li>
                                                                    <li><button type="button" class="dropdown-item">Şikayet Et</button></li>
                                                                </form>
                                                                <?php } ?>
                                                        </ul>
                                                </div>
                                            </span>
                                        </div>
                                        <div class="card-body boxBackgroundColor">
                                        <a style="color: black; margin-bottom: 0px; text-decoration: none;" href="comment.php?id=<?php echo $cikti["id"]; ?>">
                                            <h5 class="card-title"><?php echo $cikti["title"] ?></h5>
                                            <p class="card-text"><?php echo $cikti["text"] ?></p>
                                        </a>
                                        </div>
                                    </div>
                                <?php
                            }
                        }
                    }
                }else{ ?>
                    <div class="text-center">
                        <h1><strong class="titles">Tüm Livler</strong></h1>
                    </div>
                <?php
                    if(isset($_SESSION["GirisDurumu"])==true){ ?>
                        <div class="btn-group">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Global
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="index.php?arkadaslar">Arkadaşlar</a></li>
                            </ul>
                        </div>
                    <?php
                    }
                    while ($cikti = $sorgu->fetch(PDO::FETCH_ASSOC)){
                        if($cikti["status"]==1){
                            ?>
                                <div class="card mt-3">
                                    <div class="card-header opacity-75 boxBackgroundColor">
                                        <span style="float: left;"> <a style="color: dimgrey; text-decoration: none;" href="profile.php?user=<?php echo $cikti["username"];?>"><?php echo $cikti["username"];?></a></span>
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
                                                                <li><a href="comment.php?id=<?php echo $cikti["id"]; ?>" class="dropdown-item">Yorum Yap</a></li>
                                                                <li><button name="addSaveLiv" value="<?php echo $cikti["id"]; ?>" type="submit" class="dropdown-item">Kaydet</button></li>
                                                                <li><a name="editLiv" href="liv.php?id=<?php echo $cikti["id"]; ?>" value="<?php echo $cikti["id"]; ?>" type="submit" class="dropdown-item">Düzenle</a></li>
                                                                <li><button name="deleteLiv" value="<?php echo $cikti["id"]; ?>" type="submit" class="dropdown-item">Sil</button></li>
                                                            </form>
                                                        <?php }else{ ?>
                                                            <form action="includes/transactions.php" method="POST">
                                                                <li><button type="button" class="dropdown-item">Beğen</button></li>
                                                                <li><a href="comment.php?id=<?php echo $cikti["id"]; ?>" class="dropdown-item">Yorum Yap</a></li>
                                                                <li><button name="addSaveLiv" value="<?php echo $cikti["id"]; ?>" type="submit" class="dropdown-item">Kaydet</button></li>
                                                                <li><button type="button" class="dropdown-item">Şikayet Et</button></li>
                                                            </form>
                                                        <?php } ?>
                                                    </ul>
                                            </div>
                                        </span>
                                    </div>
                                    <div class="card-body boxBackgroundColor">
                                        <a style="color: black; margin-bottom: 0px; text-decoration: none;" href="comment.php?id=<?php echo $cikti["id"]; ?>">
                                            <h5 class="card-title"><?php echo $cikti["title"] ?></h5>
                                            <p class="card-text"><?php echo $cikti["text"] ?></p>
                                        </a>
                                    </div>
                                    <?php
                                        $sorgu3 = $conn->prepare("SELECT * FROM liv_comment WHERE livId=? LIMIT 5");
                                        $sorgu3->execute([$cikti["id"]]);
                                        $counter = $sorgu3->rowCount();
                                        if($counter>0){ ?>
                                            <a style="color: black; margin-bottom: 0px; text-decoration: none;" href="comment.php?id=<?php echo $cikti["id"]; ?>">
                                                <div class="card-header opacity-75 boxBackgroundColor"><?php
                                                    while ($cikti3 = $sorgu3->fetch(PDO::FETCH_ASSOC)){ ?>
                                                        <p style="margin-bottom: 0px;"><?php echo $cikti3["username"]." : ".$cikti3["text"]; ?></p>
                                                    <?php } ?>
                                                </div>
                                            </a> <?php
                                        }
                                    ?>
                                </div>
                            <?php
                        }
                    }
                }
            ?>
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