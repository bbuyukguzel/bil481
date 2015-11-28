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
          <li><a href="/doktor.php"><?php echo $user;?></a><li>
            <li><a href="/logout.php">Çıkış Yap</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>




    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">

          <a href="/takvim_ekle.php" class="btn btn-info btn-block btn-lg" role="button">Randevu Saati Belirle</a>
          <a href="/takvim.php" class="btn btn-info btn-block btn-lg" role="button">Takvimi Gör</a>

        </div>
      </div>
    </div>



  </body>
  </html>