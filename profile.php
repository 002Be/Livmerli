<?php
    include("sections.php");
    include("includes/timeDifference.php");
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
            <div class="text-center">
                <h1><strong class="titles">Profilim</strong></h1>
                <hr>
                <h3 class="titles">Hakkımda</h3>
                <p class="titles">Hakımda</p>
                <button type="button" class="btn btn-outline-info">Düzenle</button>
                <!-- <img src="https://picsum.photos/id/386/50/50" class="rounded mx-auto d-block" alt="...profilResmi..."> -->
                <!-- <textarea name="text" class="form-control mt-3" id="exampleFormControlTextarea1" style="height: 150px;" placeholder="Hakkımda" rows="3" required></textarea> -->
                <!-- <button style="margin-top: 50px; width: 100px;" type="submit" class="btn btn-outline-primary">Kaydet</button> -->
                <hr>
                <h3 class="titles">Livlerim</h3>
                <form action="includes/transactions.php" method="POST">
                    <?php
                        $sorgu = $conn->prepare("SELECT * FROM liv ORDER BY sendDate DESC");
                        $sorgu->execute();
                        while ($cikti = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                            if($_SESSION["Username"]==$cikti["username"] && $cikti["status"]==1){
                            ?>
                                <div class="card mt-3">
                                    <div class="card-header opacity-75 boxBackgroundColor">
                                        <span style="float: left;"><?php echo $cikti["username"];?></span>
                                        <!-- <span class="badge rounded-pill text-bg-secondary" style="float: center;"><?php timeDiff($cikti["sendDate"]); ?></span> -->
                                        <span style="float: right;">
                                            <div class="btn-group dropend">
                                                <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <?php timeDiff($cikti["sendDate"]); ?>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a name="editLiv" href="liv.php?id=<?php echo $cikti["id"]; ?>" value="<?php echo $cikti["id"]; ?>" type="submit" class="dropdown-item" href="#">Düzenle</a></li>
                                                    <li><button name="deleteLiv" value="<?php echo $cikti["id"]; ?>" type="submit" class="dropdown-item" href="#">Sil</button></li>
                                                </ul>
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