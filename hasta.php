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
    if($_SESSION['priv'] == 1){
        header("Location: doktor.php");
        die("Redirecting to: doktor.php");
    }
    elseif($_SESSION['priv'] == 2){
        header("Location: yonetici.php");
        die("Redirecting to: yonetici.php");
    }
    else{
        $user = $_SESSION['TC'];
    }
}

$step1 = "block";
$step2 = "none";

if (!empty($_POST['add-submit'])) {
    if (isset($_POST['birimid'])) {
        $_SESSION['birimid'] = $_POST['birimid'];
        $step2 = "block";
        $stepb = "none";
        #header("Location: randevu_al.php");
        #die("Redirecting to: randevu_al.php");
    }
}

if (!empty($_POST['add-submit1'])) {
    if (isset($_POST['doktoradi'])) {
        $_SESSION['docTC'] = $_POST['doktoradi'];
        header("Location: takvim_gor.php");
        die("Redirecting to: takvim_gor.php");
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Doktor Paneli</title>
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
            <li><a href="/profile.php">Profil Bilgileri</a></li>
            <li><a href="/hasta.php"><?php echo $user;?></a><li>
                <li><a href="/logout.php">Çıkış Yap</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>



<br><br>
<div class="container">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-4">

            <h4>Mevcut Randevularınız:</h4>
        </hr>

    </div>
    <div class="col-md-6">

        <form id="randevu-ekle" action="" method="post" role="form" style="display: <?php echo $step1?>;">
            <div class="form-group">
                <label for="birimadi">Birim Seçiniz:</label>
                <select name="birimid" id="birimid" class="form-control">

                    <?php
                    if($step2=="block"){
                        $query = "SELECT * FROM Birim WHERE BirimID=".$_POST['birimid'];
                        $result = mysql_query($query) or die(mysql_error());
                        $row = mysql_fetch_array($result);
                        echo "<option value=".$row['BirimAdi'].">".$row['BirimAdi']."</option>";
                    }
                    else{
                        echo "<option></option>";
                        require("connect.php");
                        $query = "SELECT * FROM Birim";
                        $result = mysql_query($query) or die(mysql_error());
                        $i = 0;
                        while ($row = mysql_fetch_array($result)) {
                            echo "<option value=".++$i.">".$row['BirimAdi']."</option>";
                        }
                    }   
                    ?>
                </select>
            </div>        

            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <input type="submit" name="add-submit" id="add-submit" tabindex="4" class="form-control btn btn-login" style="display: <?php echo $stepb?>;" value="Devam">
                    </div>
                </div>
            </div>

        </form>           


        <form id="randevu-ekle" action="" method="post" role="form" style="display: <?php echo $step2?>;">
            <div class="form-group">
                <label for="birimadi">Doktor Seçiniz:</label>
                <select name="doktoradi" id="doktoradi" class="form-control">
                    <option></option>
                    <?php
                    require("connect.php");
                    $query = "SELECT * FROM Doktor WHERE BirimID =".$_SESSION['birimid'];
                    $result = mysql_query($query) or die(mysql_error());

                    while ($row = mysql_fetch_array($result)) {
                        echo "<option value=".$row['TC'].">".$row["Ad"]." ".$row["Soyad"]."</option>";
                    }
                    ?>
                </select>
            </div>    

            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                    <br>
                        <input type="submit" name="add-submit1" id="add-submit1" tabindex="4" class="form-control btn btn-login" value="Devam">
                    </div>
                </div>
            </div>

        </form>                                



    </div>
    <div class="col-md-1"></div>
</div>
</div>

</body>
</html>