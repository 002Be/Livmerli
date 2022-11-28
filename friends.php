<?php
    include("sections.php");
    control();

    $sorgu = $conn->prepare("SELECT * FROM friends");
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
            <div class="text-center">
                <h1><strong class="titles">Arkadaşlar</strong></h1>
                <hr>
            </div>
            <form id="contactForm" action="includes/transactions.php" method="post" style="margin-bottom: 100px">
                <div class="input-group mb-3 float-center mx-auto" style="width: 400px;">
                    <input name="friendUsername" type="text" class="form-control" placeholder="Kullanıcı Adı" aria-label="Username" aria-describedby="basic-addon1" required>
                    <button name="addFriend" class="btn btn-outline-secondary" type="submit" id="button-addon1">Ekle</button>
                </div>
            </form>
            <?php
                while($cikti = $sorgu->fetch(PDO::FETCH_ASSOC)){ ?>
                    <div class="card mt-3 float-center mx-auto" style="width: 30rem;">
                        <div class="btn-group dropend">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <h6 class="card-title"><?php echo $cikti["friendUsername"]; ?></h6>
                            </button>
                            <ul class="dropdown-menu">
                                <form action="includes/transactions.php" method="post">
                                    <li><button name="outFriend" value="<?php echo $cikti["friendUsername"]; ?>" type="submit" class="dropdown-item">Arkadaşı Çıkar</button></li>
                                    <li><button name="sendMessage" value="<?php echo $cikti["friendUsername"]; ?>" type="submit" class="dropdown-item">Mesaj Gönder</button></li>
                                </form>
                            </ul>
                        </div>
                    </div> <?php
                } ?>
        </div>
        <!-- Contents} -->


        <!-- {Footer -->
        <div style="margin-bottom: 80px;"></div>
        <?php footer(); ?>
        <!-- Footer} -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
        <!-- {Notifications -->
            <?php
            if(isset($_GET["successful1"])){
                notificationSave("Bildiri", "", "Arkadaş eklendi");
            }
            if(isset($_GET["successful2"])){
                notificationSave("Bildiri", "", "Arkadaş çıkartıldı");
            }
        ?>
        <!-- Notifications} -->
    </body>
</html>