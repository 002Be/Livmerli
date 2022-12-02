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
                <h1><strong class="titles">İçerik</strong></h1>
            </div>
            <hr>
            <?php
            $sorgu = $conn->prepare("SELECT * FROM liv WHERE id=?");
            $sorgu->execute([$_GET["id"]]);
            $cikti = $sorgu->fetch(PDO::FETCH_ASSOC); ?>
            <div class="card mt-3" style="margin-bottom: 10px;">
                <div class="card-header opacity-75 boxBackgroundColor">
                <span style="float: left;"> <a style="color: dimgrey; text-decoration: none;" href="profile.php?user=<?php echo $cikti["username"];?>"><?php echo $cikti["username"];?></a></span>
                    <span style="float: right;">
                        <div class="btn-group dropend">
                            <span class="badge rounded-pill text-bg-secondary" style="float: right;"><?php timeDiff($cikti["sendDate"]); ?></span>
                        </div>
                    </span>
                </div>
                <div class="card-body boxBackgroundColor">
                    <h5 class="card-title"><?php echo $cikti["title"] ?></h5>
                    <p class="card-text"><?php echo $cikti["text"] ?></p>
                </div>
            </div>
            <div>
                <button type="button" class="btn" style="background-color: gainsboro;"><img src="images/heart.png" alt="Beğen"></button>
                <button type="button" class="btn" style="background-color: gainsboro;"><img src="images/save.png" alt="Kaydet"></button>
                <button type="button" class="btn" style="background-color: gainsboro;" data-bs-toggle="modal" data-bs-target="#commentLiv"><img src="images/chat.png" alt="Yorum Yap"></button>
                <button type="button" class="btn" style="background-color: gainsboro;"><img src="images/flag.png" alt="Şikayet Et"></button>
            </div>
            <hr>
            <?php
                $sorgu = $conn->prepare("SELECT * FROM liv_comment WHERE livId=? ORDER BY sendDate DESC");
                $sorgu->execute([$_GET["id"]]);
                while($cikti = $sorgu->fetch(PDO::FETCH_ASSOC)){ ?>
                    <div class="card mt-3">
                        <div class="card-header opacity-75 boxBackgroundColor">
                        <span style="float: left;"> <a style="color: dimgrey; text-decoration: none;" href="profile.php?user=<?php echo $cikti["username"];?>"><?php echo $cikti["username"];?></a></span>
                            <span style="float: right;">
                                <div class="btn-group dropend">
                                    <span class="badge rounded-pill text-bg-secondary" style="float: right;"><?php timeDiff($cikti["sendDate"]); ?></span>
                                </div>
                            </span>
                        </div>
                        <div class="card-body boxBackgroundColor">
                            <p class="card-text"><?php echo $cikti["text"] ?></p>
                        </div>
                    </div>
                <?php
                }
            ?>
            
        </div>
        <p style="margin-top: 150px;"></p>
        <!-- Contents} -->

        <!-- {Modal -->
        <div class="modal fade" id="commentLiv" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Yorum Yaz</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form id="contactForm" action="includes/transactions.php" method="POST">
                        <div class="mb-3 mt-3">
                            <textarea type="text" name="text" class="form-control boxBackgroundColor" id="exampleFormControlTextarea1" style="height: 300px;" required></textarea>
                        </div>
                    <!-- </form> -->
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                        <button name="addComment" value="<?php echo $_GET["id"]; ?>" type="submit" class="btn btn-primary">Gönder</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal} -->


        <!-- {Footer -->
        <?php footer(); ?>
        <!-- Footer} -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
    </body>
</html>