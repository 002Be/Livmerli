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
                if(isset($_GET["arkadaslar"])){
                    ?>
                        <div class="text-center">
                            <h1><strong class="titles">Arkadaş Livleri</strong></h1>
                        </div>
                        <div class="btn-group">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Arkadaşlar
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="index.php">Global</a></li>
                            </ul>
                        </div>
                    <?php
                    while($cikti = $sorgu->fetch(PDO::FETCH_ASSOC)){
                        $sorgu2 = $conn->prepare("SELECT * FROM friends WHERE username=?");
                        $sorgu2->execute([$_SESSION["Username"]]);
                        while($cikti2 = $sorgu2->fetch(PDO::FETCH_ASSOC)){
                            if($cikti["status"]==1 & $cikti["username"]==$cikti2["friendUsername"]){
                                ?>
                                <div class="card mt-3">
                                    <div class="card-header opacity-75 boxBackgroundColor">
                                        <span style="float: left;"> <a style="color: dimgrey; text-decoration: none;" href="profile.php?user=<?php echo $cikti["username"];?>"><?php echo $cikti["username"];?></a></span>
                                        <div class="dropend">
                                            <button class="btn-menu-button-color" data-bs-toggle="dropdown" aria-expanded="false" style="float: right; margin-left: 13px; margin-top: -2px; border: 0px;">
                                                <img src="assets/images/menu.png">
                                            </button>
                                            <ul class="dropdown-menu">
                                            <form action="includes/transactions.php" method="POST">
                                                <button type="submit" class="btn" name="likeLiv" value="<?php echo $cikti["id"]; ?>" style="<?php likeBackColor($cikti["id"]); ?>; margin-left: 7px;"><img src="assets/images/heart.png" alt="Beğen"></button>
                                                <a href="comment.php?id=<?php echo $cikti["id"]; ?>" class="btn" style="background-color: gainsboro;"><img src="assets/images/chat.png" alt="Yorum Yap"></a>
                                                <button type="submit" class="btn" name="saveLiv" value="<?php echo $cikti["id"]; ?>" style="<?php saveBackColor($cikti["id"]); ?>;"><img src="assets/images/save.png" alt="Kaydet"></button>
                                                <a href="comment.php?id=<?php echo $cikti["id"]; ?>" class="btn" style="margin-right: 7px; background-color: gainsboro;"><img src="assets/images/flag.png" alt="Şikayet Et"></a>
                                            </form>
                                            </ul>
                                        </div>
                                        <div class="btn-group dropend" style="float: right;">
                                            <span class="badge rounded-pill text-bg-secondary" style="float: right; margin-top: 2px;"><?php timeDiff($cikti["sendDate"]); ?></span>
                                        </div>
                                    </div>
                                    <div class="card-body boxBackgroundColor">
                                        <a style="color: black; margin-bottom: 0px; text-decoration: none;" href="comment.php?id=<?php echo $cikti["id"]; ?>">
                                            <h5 class="card-title"><?php echo $cikti["title"] ?></h5>
                                            <p class="card-text"><?php echo $cikti["text"] ?></p>
                                        </a>
                                    </div>
                                    <?php
                                        $sorgu3 = $conn->prepare("SELECT * FROM liv_comment WHERE livId=? ORDER BY sendDate DESC LIMIT 5");
                                        $sorgu3->execute([$cikti["id"]]);
                                        $counter = $sorgu3->rowCount();
                                        if($counter>0){ ?>
                                                <a style="color: black; margin-bottom: 0px; text-decoration: none;" href="comment.php?id=<?php echo $cikti["id"]; ?>">
                                                <div class="card-footer opacity-75 boxBackgroundColor"><?php
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
                }else{
                    if(isset($_SESSION["GirisDurumu"])==true){ ?>
                        <div class="text-center">
                            <h1><strong class="titles">Tüm Livler</strong></h1>
                        </div>
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
                                        <div class="dropend">
                                            <button class="btn-menu-button-color" data-bs-toggle="dropdown" aria-expanded="false" style="float: right; margin-left: 13px; margin-top: -2px; border: 0px;">
                                                <img src="assets/images/menu.png">
                                            </button>
                                            <ul class="dropdown-menu">
                                            <form action="includes/transactions.php" method="POST">
                                                <button type="submit" class="btn" name="likeLiv" value="<?php echo $cikti["id"]; ?>" style="<?php likeBackColor($cikti["id"]); ?>; margin-left: 7px;"><img src="assets/images/heart.png" alt="Beğen"></button>
                                                <a href="comment.php?id=<?php echo $cikti["id"]; ?>" class="btn" style="background-color: gainsboro;"><img src="assets/images/chat.png" alt="Yorum Yap"></a>
                                                <button type="submit" class="btn" name="saveLiv" value="<?php echo $cikti["id"]; ?>" style="<?php saveBackColor($cikti["id"]); ?>;"><img src="assets/images/save.png" alt="Kaydet"></button>
                                                <a href="comment.php?id=<?php echo $cikti["id"]; ?>" class="btn" style="margin-right: 7px; background-color: gainsboro;"><img src="assets/images/flag.png" alt="Şikayet Et"></a>
                                                <?php
                                                if($_SESSION["Username"]==$cikti["username"]){ ?>
                                                <a href="liv.php?id=<?php echo $cikti["id"]; ?>" class="btn" style="background-color: gainsboro;"><img src="assets/images/edit.png" alt="Düzenle"></a>
                                                <button type="submit" class="btn" style="background-color: gainsboro; margin-right: 7px;" name="deleteLiv" value="<?php echo $cikti["id"]; ?>"><img src="assets/images/delete4.png" alt="Sil"></button>
                                                <?php
                                                } ?>
                                            </form>
                                            </ul>
                                        </div>
                                        <div class="btn-group dropend" style="float: right;">
                                            <span class="badge rounded-pill text-bg-secondary" style="float: right; margin-top: 2px;"><?php timeDiff($cikti["sendDate"]); ?></span>
                                        </div>
                                    </div>
                                    <div class="card-body boxBackgroundColor">
                                        <a style="color: black; margin-bottom: 0px; text-decoration: none;" href="comment.php?id=<?php echo $cikti["id"]; ?>">
                                            <h5 class="card-title"><?php echo $cikti["title"] ?></h5>
                                            <p class="card-text"><?php echo $cikti["text"] ?></p>
                                        </a>
                                    </div>
                                    <?php
                                        $sorgu3 = $conn->prepare("SELECT * FROM liv_comment WHERE livId=? ORDER BY sendDate DESC LIMIT 5");
                                        $sorgu3->execute([$cikti["id"]]);
                                        $counter = $sorgu3->rowCount();
                                        if($counter>0){ ?>
                                                <a style="color: black; margin-bottom: 0px; text-decoration: none;" href="comment.php?id=<?php echo $cikti["id"]; ?>">
                                                <div class="card-footer opacity-75 boxBackgroundColor"><?php
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