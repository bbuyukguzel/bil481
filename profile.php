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


        if (!empty($_POST['add-submit'])) {

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
        echo "asdasdasd";
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
                                <a href="#" class="active" id="doktor-ekle-link">Kullanıcı Bilgilerini Düzenle</a>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">

                                <form id="doktor-ekle" action="" method="post" role="form" style="display: block;">

                                    <div class="form-group">
                                        <input type="text" name="TC" id="TC" tabindex="1" class="form-control" placeholder="Doktor TC Kimlik No" value="<?php echo $TC ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="ad" id="ad" tabindex="1" class="form-control" placeholder="Doktor Adı" value="<?php echo $ad ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="soyad" id="soyad" tabindex="1" class="form-control" placeholder="Doktor Soyadı" value="<?php echo $soyad ?>" readonly>
                                    </div>                                                                            
                                    <div class="form-group">
                                        <input type="email" name="eposta" id="eposta" tabindex="1" class="form-control" placeholder="Yeni E-Posta" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="sifre" id="sifre" tabindex="2" class="form-control" placeholder="Yeni Şifre">
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="add-submit" id="add-submit" tabindex="4" class="form-control btn btn-login" value="Bilgileri Güncelle">
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