<?php
    session_start();
    include("includes/connection.php");
    include("includes/notifications.php");
    include("includes/functions.php");

    // if(empty($_SESSION["lang"])){
    //     include("includes/lang_tr.php");  //Varsayılan dil TR
    // }else{
    //     if ($_SESSION["SiteDili"] == "tr") {
    //         include("includes/lang_tr.php");
    //     }else{
    //         include("includes/lang_en.php");
    //     }
    // }
?>
<!-- Theme -->
<?php
    function meta(){?>
        <style>
            <?php
                if($_SESSION["theme"]=="dark"){
                    ?>
                    body{
                        background-color: rgb(18, 18, 18);
                    }
                    .titles{
                            color: rgb(242, 242, 242);
                        }
                    .boxBackgroundColor{
                        background-color: rgb(179, 179, 179);
                    }
                    <?php
                }
            ?>
        </style>
    <?php
    }
?>

<!-- Navbar -->
<?php
    function navbar(){?>
        <nav class="navbar navbar-expand-lg bg-dark">
            <div class="container">
                <a class="navbar-brand" style="color: white;" href="index.php">Livmerli</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <?php
                    if(isset($_SESSION["GirisDurumu"])==true){ ?>
                        <div class="d-flex" id="navbarNavDropdown">
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" style="color: white;" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php echo $_SESSION["Username"]; ?>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-dark">
                                        <li><a class="dropdown-item" href="profile.php?user=<?php echo $_SESSION["Username"]; ?>">Profilim</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="liv.php">Liv Gönder</a></li>
                                        <li><a class="dropdown-item" href="friends.php">Arkadaşlar</a></li>
                                        <li><a class="dropdown-item" href="notifications.php">Bildirimler</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="settings.php">Ayarlar</a></li>
                                        <li><a class="dropdown-item" href="includes/transactions.php?exit">Çıkış Yap</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div> <?php
                    }else{ ?>
                        <div class="d-flex" id="navbarNavDropdown">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" style="color: white;" href="login.php">Giriş Yap</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" style="color: white;" href="register.php">Üye Ol</a>
                                </li>
                            </ul>
                        </div> <?php
                    }
                ?>
            </div>
        </nav> <?php
    }
?>


<!-- Footer -->
<?php
    function footer(){?>
        <footer class="bg-light text-center text-lg-start">
            <div class="text-center p-3 bg-dark" style="position: fixed; bottom: 0; width: 100%; color: white;">
                © 2020 Copyright <a class="text-light" href="index.php">livmerli.com</a>
            </div>
        </footer> <?php
    }
?>