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
        <div class="container">
            <div class="text-center mt-5">
                <h1><strong>Üye Ol</strong></h1>
            </div>
            <hr>
            <div class="float-center mt-5 mx-auto" style="width: 400px;">
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
                        <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Parola" required>
                    </div>
                    <div class="mb-3">
                        <input name="repassword" type="password" class="form-control" id="exampleInputPassword1" placeholder="Parola tekrar" required>
                        <div id="passwordHelpBlock" class="form-text">Şifreniz 8-20 karakter uzunluğunda olmalı, harf ve rakamlardan oluşmalı ve boşluk, özel karakter veya emoji içermemelidir.</div>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                        <label class="form-check-label" for="exampleCheck1">Okudum kabul ediyorum</label>
                    </div>
                    <button name="register" type="submit" class="btn btn-primary container">Kayıt Ol</button>
                    <div class="mb-3 text-center">
                    <?php
                        if(isset($_GET["durum"])=="basarisiz"){
                            ?>
                                <p>Kullanıcı adı veya mail adresi zaten kullanılmaktadır</p> <!-- Ayrı ayrı hata verecek -->
                            <?php
                        }else{
                            ?> <br> <?php
                        } ?>
                        <br><a href="login.php" class="link-secondary">Zaten üye misin?</a>
                    </div>
                </form>
            </div>
        </div>
        <!-- Contents} -->


        <!-- {Footer -->
        <?php footer(); ?>
        <!-- Footer} -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
    </body>
</html>