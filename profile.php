<?php

// Start your session
require ("connect.php");

session_start();

if (empty($_SESSION['TC'])) {
    header("Location: index.php");
    die("Redirecting to index.php");
}

// Read your session (if it is set)
if (isset($_SESSION['TC'])) {
    $user = $_SESSION['TC'];
}



if (isset($_SESSION['priv'])) {
    if($_SESSION['priv'] == 1){

        $doktorform = "block";
        $hastaform = "none";

        ////////////////////////////////////////////
        ////////////////////////////////////////////
        $query = "SELECT * FROM Doktor WHERE TC='$user'";
        $result = mysql_query($query) or die(mysql_error());
        $row = mysql_fetch_array($result);

        $TC = $row["TC"];
        $ad = $row["Ad"];
        $soyad = $row["Soyad"];
        $eposta = $row["EPosta"];
        $sifre = $row["Sifre"];
        $birim = $row["BirimID"];
        $urladr = '/doktor.php';
        ////////////////////////////////////////////
        ////////////////////////////////////////////


        if (!empty($_POST['add-submit-d'])) {

                if (isset($_POST['eposta']) && !empty($_POST['eposta'])){
                    $eposta = $_POST['eposta'];
                }
                if (isset($_POST['sifre']) && !empty($_POST['sifre'])){
                    $sifre = $_POST['sifre'];
                }
                
                $query = "UPDATE `Doktor` SET EPosta='$eposta',Sifre='$sifre' WHERE TC='$TC'";
                $result = mysql_query($query);
                if ($result) {
                    $content = "<div class='alert alert-info alert-dismissible' role='alert'>
                    <span class='close' data-dismiss='alert'>&times;</span>
                    Bilgileriniz guncellendi.
                    </div>";
                }

            }

    }

    else{
        $doktorform = "none";
        $hastaform = "block";

        ////////////////////////////////////////////
        ////////////////////////////////////////////
        $query = "SELECT * FROM Hasta WHERE TC='$user'";
        $result = mysql_query($query) or die(mysql_error());
        $row = mysql_fetch_array($result);

        $TC = $row["TC"];
        $ad = $row["Ad"];
        $soyad = $row["Soyad"];
        $cinsiyet = $row["Cinsiyet"];
        $dtarih = $row["DTarih"];
        $eposta = $row["EPosta"];
        $sifre = $row["Sifre"];
        $telefon = $row["Telefon"];
        $adres = $row["Adres"];
        $urladr = '/hasta.php';
        ////////////////////////////////////////////
        ////////////////////////////////////////////


        if (!empty($_POST['add-submit-h'])) {

                if (isset($_POST['eposta']) && !empty($_POST['eposta'])){
                    $eposta = $_POST['eposta'];
                }
                if (isset($_POST['sifre']) && !empty($_POST['sifre'])){
                    $sifre = $_POST['sifre'];
                }
                if (isset($_POST['adres']) && !empty($_POST['adres'])){
                    $adres = $_POST['adres'];
                }
                if (isset($_POST['telefon']) && !empty($_POST['telefon'])){
                    $telefon = $_POST['telefon'];
                }
                
                $query = "UPDATE `Hasta` SET EPosta='$eposta',Sifre='$sifre',Adres='$adres',Telefon='$telefon' WHERE TC='$TC'";
                $result = mysql_query($query);
                if ($result) {
                    $content = "<div class='alert alert-info alert-dismissible' role='alert'>
                    <span class='close' data-dismiss='alert'>&times;</span>
                    Bilgileriniz guncellendi.
                    </div>";
                }

            }

    }
}





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Kullanıcı Bilgileri</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    
    <style type="text/css">
        body { background: #EBEBEB !important; } /* Adding !important forces the browser to overwrite the default style applied by Bootstrap */
    </style>
    
</head>

<body>

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo $urladr ?>"><?php echo $user;?></a><li>
                    <li><a href="/logout.php">Çıkış Yap</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    
    
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-login">
                    <div class="panel-heading">
                        <div class="row">
                            <?php echo $content; ?> 
                            <div class="col-xs-6">
                                <a href="#" class="active" id="doktor-guncelle-link">Kullanıcı Bilgilerini Düzenle</a>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">

                                <form id="doktor-guncelle" action="" method="post" role="form" style="display: <?php echo $doktorform?>;">
                                    <label for="l_TC">TC Kimlik No:</label>
                                    <div class="form-group">
                                        <input type="text" name="TC" id="TC" tabindex="1" class="form-control" placeholder="Doktor TC Kimlik No" value="<?php echo $TC ?>" readonly>
                                    </div>
                                    <label for="l_ad">Ad:</label>
                                    <div class="form-group">
                                        <input type="text" name="ad" id="ad" tabindex="1" class="form-control" placeholder="Doktor Adı" value="<?php echo $ad ?>" readonly>
                                    </div>
                                    <label for="l_soyad">Soyad:</label>
                                    <div class="form-group">
                                        <input type="text" name="soyad" id="soyad" tabindex="1" class="form-control" placeholder="Doktor Soyadı" value="<?php echo $soyad ?>" readonly>
                                    </div>                    
                                    <label for="l_eposta">E-Posta:</label>                                                        
                                    <div class="form-group">
                                        <input type="email" name="eposta" id="eposta" tabindex="1" class="form-control" placeholder="Yeni E-Posta" value="<?php echo $eposta ?>">
                                    </div>
                                    <label for="l_sifre">Şifre:</label>
                                    <div class="form-group">
                                        <input type="password" name="sifre" id="sifre" tabindex="2" class="form-control" placeholder="Yeni Şifre">
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="add-submit-d" id="add-submit-d" tabindex="4" class="form-control btn btn-login" value="Bilgileri Güncelle">
                                            </div>
                                        </div>
                                    </div>
                                </form>



                                <form id="hasta-guncelle" action="" method="post" role="form" style="display: <?php echo $hastaform?>;">
                                    <label for="l_TC">TC Kimlik No:</label>
                                    <div class="form-group">
                                        <input type="text" name="TC" id="TC" tabindex="1" class="form-control" placeholder="Hasta TC Kimlik No" value="<?php echo $TC ?>" readonly>
                                    </div>
                                    <label for="l_ad">Ad:</label>
                                    <div class="form-group">
                                        <input type="text" name="ad" id="ad" tabindex="1" class="form-control" placeholder="Hasta Adı" value="<?php echo $ad ?>" readonly>
                                    </div>
                                    <label for="l_soyad">Soyad:</label>
                                    <div class="form-group">
                                        <input type="text" name="soyad" id="soyad" tabindex="1" class="form-control" placeholder="Hasta Soyadı" value="<?php echo $soyad ?>" readonly>
                                    </div>        
                                    <label for="l_cinsiyet">Cinsiyet:</label>     
                                    <div class="form-group">
                                        <input type="text" name="cinsiyet" id="cinsiyet" tabindex="1" class="form-control" placeholder="Hasta Cinsiyeti" value="<?php echo $cinsiyet ?>" readonly>
                                    </div>     
                                    <label for="l_dtarih">Doğum Tarihi:</label>
                                    <div class="form-group">
                                        <input type="text" name="dtarih" id="dtarih" tabindex="1" class="form-control" placeholder="Hasta Doğum Tarihi" value="<?php echo $dtarih ?>" readonly>
                                    </div>     
                                    <label for="l_telefon">Telefon:</label>
                                    <div class="form-group">
                                        <input type="text" name="telefon" id="telefon" tabindex="1" class="form-control" placeholder="Hasta Telefon" value="<?php echo $telefon ?>">
                                    </div>    
                                    <label for="l_adres">Adres:</label>  
                                    <div class="form-group">
                                        <textarea name="adres" id="adres" tabindex="1" class="form-control" placeholder="Hasta Adresi" rows="3"><?php echo $adres ?></textarea>
                                    </div>       
                                    <label for="l_eposta">E-Posta:</label>
                                    <div class="form-group">
                                        <input type="email" name="eposta" id="eposta" tabindex="1" class="form-control" placeholder="Hasta E-Posta" value="<?php echo $eposta ?>">
                                    </div>
                                    <label for="l_sifre">Şifre:</label>
                                    <div class="form-group">
                                        <input type="password" name="sifre" id="sifre" tabindex="2" class="form-control" placeholder="Hasta Şifre">
                                    </div>


                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="add-submit-h" id="add-submit-h" tabindex="4" class="form-control btn btn-login" value="Bilgileri Güncelle">
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
    
    



</body>
</html>