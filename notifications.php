<?php
    include("sections.php");
    control();

    $sorgu = $conn->prepare("SELECT * FROM friend_request");
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
                <h1><strong class="titles">Bildirimler</strong></h1>
                <hr>
                <?php
                    while($cikti = $sorgu->fetch(PDO::FETCH_ASSOC)){
                        if($_SESSION["Username"]==$cikti["requestUsername"]){
                            ?>
                                <div class="card mt-3">
                                    <div class="card-header opacity-75 ">
                                        <span class="badge rounded-pill text-bg-success">Arkadaşlık İsteği</span>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">Gönderen : <?php echo $cikti["username"] ?></h5>
                                        <form action="includes/transactions.php" method="POST">
                                            <button name="acceptRequest" value="<?php echo $cikti["username"] ?>" type="submit" class="btn btn-outline-success">Kabul Et</button>
                                            <button name="rejectRequest" value="<?php echo $cikti["username"] ?>" type="submit" class="btn btn-outline-danger">Reddet</button>
                                        </form>
                                    </div>
                                </div>
                            <?php
                        }
                    }
                ?>
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