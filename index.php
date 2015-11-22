<!DOCTYPE html>
<html lang="en">

<head>
    <title>Hasta Randevu Sistemi</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <script>
        $(function() {

            $('#login-form-link').click(function(e) {
                $("#login-form").delay(100).fadeIn(100);
                $("#register-form").fadeOut(100);
                $('#register-form-link').removeClass('active');
                $(this).addClass('active');
                e.preventDefault();
            });
            $('#register-form-link').click(function(e) {
                $("#register-form").delay(100).fadeIn(100);
                $("#login-form").fadeOut(100);
                $('#login-form-link').removeClass('active');
                $(this).addClass('active');
                e.preventDefault();
            });

        });
    </script>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-login">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-6">
                                <a href="#" class="active" id="login-form-link">Kullanıcı Girişi</a>
                            </div>
                            <div class="col-xs-6">
                                <a href="#" id="register-form-link">Kullanıcı Kaydı</a>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form id="login-form" action="!!!!!!!!!" method="post" role="form" style="display: block;">
                                    <div class="form-group">
                                        <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                                    </div>
                                    <div class="form-group text-center">
                                        <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
                                        <label for="remember"> Beni Hatırla</label>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Giriş Yap">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="text-center">
                                                    <a href="!!!!!!!" tabindex="5" class="forgot-password">Şifremi Unuttum</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                
                                <form id="register-form" action="" method="post" role="form" style="display: none;">
                                    <div class="form-group">
                                        <label for="l_TC">TC Kimlik No:</label>
                                        <input type="text" name="TC" id="TC" tabindex="1" class="form-control" placeholder="TC Kimlik No" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="ad" id="ad" tabindex="1" class="form-control" placeholder="Ad" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="soyad" id="soyad" tabindex="1" class="form-control" placeholder="Soyad" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="cinsiyet" id="cinsiyet" tabindex="1" class="form-control" placeholder="Cinsiyet" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="dtarih" id="dtarih" tabindex="1" class="form-control" placeholder="Doğum Tarihi" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="eposta" id="eposta" tabindex="1" class="form-control" placeholder="E-Posta" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="tel" id="tel" tabindex="1" class="form-control" placeholder="Telefon" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="adres" id="adres" tabindex="1" class="form-control" placeholder="Adres" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="sifre" id="sifre" tabindex="2" class="form-control" placeholder="Şifre">
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Kayıt Ol">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php
            require('connect.php');
                if (isset($_POST['TC']) && isset($_POST['ad']) && isset($_POST['soyad']) && isset($_POST['cinsiyet']) && isset($_POST['dtarih']) && isset($_POST['eposta']) && isset($_POST['tel']) && isset($_POST['adres']) && isset($_POST['sifre'])){
                    $TC = $_POST['TC'];
                    $ad = $_POST['ad'];
                    $soyad = $_POST['soyad'];
                    $cinsiyet = $_POST['cinsiyet'];
                    $dtarih = $_POST['dtarih'];
                    $eposta = $_POST['eposta'];
                    $tel = $_POST['tel'];
                    $adres = $_POST['adres'];
                    $sifre = $_POST['sifre'];

                    if (empty($TC) || empty($ad) || empty($soyad) || empty($cinsiyet) || empty($dtarih) || empty($eposta) || empty($tel) || empty($adres) || empty($sifre)) {
                        echo "Alanlar bos birakilamaz";
                    }

                    else{
                      $query = "INSERT INTO `Hasta` (TC, Ad, Soyad, Cinsiyet, DTarih, EPosta, Telefon, Adres, Sifre) VALUES ('$TC', '$ad', '$soyad', '$cinsiyet', '$dtarih', '$eposta', '$tel', '$adres', '$sifre')";
                      $result = mysql_query($query);

                      if($result){
                          echo "User Created Successfully.";
                      }
                    }
                }
        ?>

</body>

</html>