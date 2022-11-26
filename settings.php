<?php
    include("sections.php");
    if(isset($_GET["theme"])){
        if($_GET["theme"]=="1"){$_SESSION["theme"]="light";}
        if($_GET["theme"]=="2"){$_SESSION["theme"]="dark";}
    }
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
                <h1><strong class="titles">Ayarlar</strong></h1>
                <hr>
                <h3 class="titles">Genel Ayarlar</h3>
                <div class="float-center mt-3 mx-auto" style="width: 400px;">
                    <form method="get">
                        <select name="theme" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                            <option selected>Tema Ayarı</option>
                            <option value="1">Aydınlık Tema</option></a>
                            <option value="2">Karanlık Tema</option>
                            <!-- <option value="3">Tam Siyah Tema</option> -->
                        </select>
                        <button name="save" value="theme" type="submit" class="btn btn-primary container">Kaydet</button>
                    </form>
                </div>
                <hr>
                <h3 class="titles">Kullanıcı Ayarlar</h3>
                <div class="float-center mt-3 mx-auto" style="width: 400px;">
                    <form id="contactForm" action="includes/transactions.php" method="post">
                        <div class="col-auto">
                            <div class="input-group">
                            <!-- <div class="input-group-text">@</div> -->
                            <input name="username" type="text" class="form-control" id="autoSizingInputGroup" placeholder="Kullanıcı adı" required>
                            </div>
                        </div>
                        <div class="mb-3 mt-3">
                            <input name="mail" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="E-posta adresi" required>
                        </div>
                        <div class="mb-3">
                            <input name="password" type="password" class="form-control" placeholder="Eski Parola" required>
                        </div>
                        <div class="mb-3">
                            <input name="newpassword" type="password" class="form-control" id="exampleInputPassword1" placeholder="Yeni Parola" required>
                        </div>
                        <div class="mb-3">
                            <input name="newrepassword" type="password" class="form-control" id="exampleInputPassword1" placeholder="Yeni Parola tekrar" required>
                            <div id="passwordHelpBlock" class="form-text">Şifreniz 8-20 karakter uzunluğunda olmalı, harf ve rakamlardan oluşmalı ve boşluk, özel karakter veya emoji içermemelidir.</div>
                        </div>
                        <button name="updateAccount" type="submit" class="btn btn-primary container">Güncelle</button>
                        <div class="mb-3 text-center">
                        <?php
                            if(isset($_GET["durum"])=="basarisiz"){
                                ?>
                                    <p>Kullanıcı adı veya mail adresi zaten kullanılmaktadır</p> <!-- Ayrı ayrı hata verecek -->
                                <?php
                            }else{
                                ?> <br> <?php
                            } ?>
                        </div>
                    </form>
                </div>
                <hr>
                <h3 class="titles">Diğer Ayarlar</h3>
                <form action="includes/transactions.php" method="post">
                    <button name="deleteAccount" value="theme" type="submit" class="btn btn-danger container mt-3" style="width: 400px;">Hesabı Kalıcı Olarak Sil</button>
                </form>
            </div>
        </div>
        <!-- Contents} -->


<?php $deger = true ?>

        <!-- {Footer -->
        <div style="margin-bottom: 80px;"></div>
        <?php footer(); ?>
        <!-- Footer} -->


        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>


        <!-- {Notifications -->
        <?php
            if(isset($_GET["save"])=="theme"){
                notificationSave("Bildiri", "", "İçerikler başarıyla kaydedildi");
            }
        ?>
        <!-- Notifications} -->
    </body>
</html>