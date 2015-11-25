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
                <li><a href="/profile.php">Profil Bilgileri</a></li>
                <li><a href="/doktor.php"><?php echo $user;?></a><li>
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
                                <p> Kullanıcı bilgilerini düzenle </p>
                            </div>

                        </div>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">                           
                                
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