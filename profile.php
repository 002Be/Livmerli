<?php
    include("sections.php");
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
                <h1><strong class="titles"> <?php echo $user; ?> </strong></h1>
                <hr>
                <h3 class="titles">Hakkında</h3>
                <?php $sorgu = $conn->prepare("SELECT about FROM userbio WHERE username=?");
                $sorgu->execute([$user]);
                $cikti = $sorgu->fetch(PDO::FETCH_ASSOC) ?>
                <p class="titles"><?php echo $cikti["about"] ?></p>
                <!-- <img src="https://picsum.photos/id/386/50/50" class="rounded mx-auto d-block" alt="...profilResmi..."> -->
                <!-- <textarea name="text" class="form-control mt-3" id="exampleFormControlTextarea1" style="height: 150px;" placeholder="Hakkımda" rows="3" required></textarea> -->
                <!-- <button style="margin-top: 50px; width: 100px;" type="submit" class="btn btn-outline-primary">Kaydet</button> -->
                <hr>
                <div class="btn-group" style="float: left; margin-bottom: 10px;">
                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Listeleme Türü
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="profile.php?paylasilanlar&user=<?php echo $user; ?>">Paylaşılanlar</a></li>
                        <li><a class="dropdown-item" href="profile.php?kaydedilenler&user=<?php echo $user; ?>">Kaydedilenler</a></li>
                        <li><a class="dropdown-item" href="profile.php?begenilenler&user=<?php echo $user; ?>">Beğenilenler</a></li>
                    </ul>
                </div>
                <form style="clear: both;" action="includes/transactions.php" method="POST">
                    <?php
                        if(isset($_GET["begenilenler"])){
                            ?><h3 class="titles">Beğenilenler</h3><?php
                            $sorgu = $conn->prepare("SELECT * FROM liv, liv_like WHERE liv.status=1 AND liv_like.username=? AND liv.id=liv_like.livId ORDER BY liv.sendDate DESC");
                            $sorgu->execute([$user]);
                        }elseif(isset($_GET["kaydedilenler"])){
                            ?><h3 class="titles">Kaydedilenler</h3><?php
                            $sorgu = $conn->prepare("SELECT * FROM liv, liv_save WHERE liv.status=1 AND liv_save.username=? AND liv.id=liv_save.livId ORDER BY liv.sendDate DESC");
                            $sorgu->execute([$user]);
                        }else{
                            ?><h3 class="titles">Paylaşılanlar</h3><?php
                            $sorgu = $conn->prepare("SELECT * FROM liv WHERE status=1 AND senderUsername=? ORDER BY liv.sendDate DESC");
                            $sorgu->execute([$user]);
                        }
                        while ($cikti = $sorgu->fetch(PDO::FETCH_ASSOC)){
                            ?>
                                <div class="card mt-3">
                                    <div class="card-header opacity-75 boxBackgroundColor">
                                        <span style="float: left;"><?php echo $cikti["senderUsername"];?></span>
                                        <div class="btn-group dropend" style="float: right;">
                                            <span class="badge rounded-pill text-bg-secondary" style="float: right; margin-top: 2px;"><?php timeDiff($cikti["sendDate"]); ?></span>
                                        </div>
                                    </div>
                                    <div class="card-body boxBackgroundColor">
                                        <h5 class="card-title"><?php echo $cikti["title"] ?></h5>
                                        <p class="card-text"><?php echo $cikti["text"] ?></p>
                                    </div>
                                </div>
                            <?php
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