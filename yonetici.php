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
    if($_SESSION['priv'] == 0){
        header("Location: hasta.php");
        die("Redirecting to: hasta.php");
    }
    elseif($_SESSION['priv'] == 1){
        header("Location: doktor.php");
        die("Redirecting to: doktor.php");
    }
    else{
        $user = $_SESSION['TC'];
    }
}


/////////////////////////////////////////////////
/////////////////////////////////////////////////

if (!empty($_POST['add-submit'])) {

    if (isset($_POST['TC']) && isset($_POST['ad']) && isset($_POST['soyad']) && isset($_POST['eposta']) && isset($_POST['birimid']) && isset($_POST['sifre'])) {
        $TC = $_POST['TC'];
        $ad = $_POST['ad'];
        $soyad = $_POST['soyad'];
        $eposta = $_POST['eposta'];
        $sifre = $_POST['sifre'];
        $birimid = $_POST['birimid'];
        
        if (empty($TC) || empty($ad) || empty($soyad) || empty($eposta) || empty($birimid) || empty($sifre)) {
            echo "Alanlar bos birakilamaz";
        }
        else {
            $query = "INSERT INTO `Doktor` (TC, Ad, Soyad, EPosta, Sifre, BirimID) VALUES ('$TC', '$ad', '$soyad', '$eposta', '$sifre', '$birimid')";
            $result = mysql_query($query);
            if ($result) {
                if (!file_exists('doktor/'.$TC)) {
                    mkdir('doktor/'.$TC, 0777, true);
                }

                $myfile = fopen("doktor/".$TC."/dataset.js", "w") or die("Unable to open file!");
                $txt = "function getEvents(){

    return [

    ];
}";
                fwrite($myfile, $txt);
                fclose($myfile);

                $content = "<div class='alert alert-info alert-dismissible' role='alert'>
                            <span class='close' data-dismiss='alert'>&times;</span>
                            Doktor bilgisi sisteme eklendi.
                            </div>";
            }
        }
    }
}


if (!empty($_POST['remove-submit'])) {

    if (isset($_POST['TC']) && isset($_POST['ad']) && isset($_POST['soyad'])) {
        $TC = $_POST['TC'];
        $ad = $_POST['ad'];
        $soyad = $_POST['soyad'];
        
        if (empty($TC) || empty($ad) || empty($soyad)) {
            echo "Alanlar bos birakilamaz";
        }
        else {
            $query = "DELETE FROM `Doktor` WHERE TC='$TC' AND Ad='$ad' AND Soyad='$soyad'";
            $result = mysql_query($query);
              
            $query = mysql_query("SELECT * FROM `Doktor` WHERE TC='$TC' AND Ad='$ad' AND Soyad='$soyad'");
            $num_rows = mysql_num_rows($query);
            
            if ($num_rows > 0) {
                $content = "<div class='alert alert-info alert-dismissible' role='alert'>
                            <span class='close' data-dismiss='alert'>&times;</span>
                            Doktor bilgisi sistemden kaldırıldı.
                            </div>";
            }
            else{
                $content = "<div class='alert alert-info alert-dismissible' role='alert'>
                            <span class='close' data-dismiss='alert'>&times;</span>
                            Doktor bilgisi bulunamadi.
                            </div>";
            }
            
            
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Yonetici Paneli</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <script>
        $(function() {

            $('#doktor-ekle-link').click(function(e) {
                $("#doktor-ekle").delay(100).fadeIn(100);
                $("#doktor-sil").fadeOut(100);
                $('#doktor-sil-link').removeClass('active');
                $(this).addClass('active');
                e.preventDefault();
            });
            $('#doktor-sil-link').click(function(e) {
                $("#doktor-sil").delay(100).fadeIn(100);
                $("#doktor-ekle").fadeOut(100);
                $('#doktor-ekle-link').removeClass('active');
                $(this).addClass('active');
                e.preventDefault();
            });

        });
    </script>
    
    <style type="text/css">
        body { background: #EBEBEB !important; } /* Adding !important forces the browser to overwrite the default style applied by Bootstrap */
    </style>
    
</head>

  <body>

	<nav class="navbar navbar-default">
  		<div class="container-fluid">
    		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav navbar-right">
		      	<li><a href="/yonetici.php"><?php echo $user;?></a><li>
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
                                <a href="#" class="active" id="doktor-ekle-link">Doktor Ekle</a>
                            </div>
                            <div class="col-xs-6">
                                <a href="#" id="doktor-sil-link">Doktor Sil</a>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                
                                <form id="doktor-ekle" action="" method="post" role="form" style="display: block;">
                                    <div class="form-group">
                                        <label for="birimadi">Doktor Birimi:</label>
                                        <select name="birimid" id="birimid" class="form-control">
                                            <option></option>
                                            <?php
                                                require("connect.php");
                                                $query = "SELECT * FROM Birim";
                                                        $result = mysql_query($query) or die(mysql_error());
                                                $i = 0;
                                                while ($row = mysql_fetch_array($result)) {
                                                    echo "<option value=".++$i.">".$row["BirimAdi"]."</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>                                    
                                    <div class="form-group">
                                        <input type="text" name="TC" id="TC" tabindex="1" class="form-control" placeholder="Doktor TC Kimlik No" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="ad" id="ad" tabindex="1" class="form-control" placeholder="Doktor Adı" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="soyad" id="soyad" tabindex="1" class="form-control" placeholder="Doktor Soyadı" value="">
                                    </div>                                                                            
                                    <div class="form-group">
                                        <input type="email" name="eposta" id="eposta" tabindex="1" class="form-control" placeholder="Doktor E-Posta" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="sifre" id="sifre" tabindex="2" class="form-control" placeholder="Doktor Şifre">
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="add-submit" id="add-submit" tabindex="4" class="form-control btn btn-login" value="Doktor Ekle">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                
                                
                                <form id="doktor-sil" action="" method="post" role="form" style="display: none;">
                                    <div class="form-group">
                                        <input type="text" name="TC" id="TC" tabindex="1" class="form-control" placeholder="Doktor TC Kimlik No" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="ad" id="ad" tabindex="1" class="form-control" placeholder="Doktor Adı" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="soyad" id="soyad" tabindex="1" class="form-control" placeholder="Doktor Soyadı" value="">
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="remove-submit" id="remove-submit" tabindex="4" class="form-control btn btn-danger" value="Doktor Sil">
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