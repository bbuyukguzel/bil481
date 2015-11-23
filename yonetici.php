<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/bootstrap.css">

    <title>Yonetici Paneli</title>
    
    <style type="text/css">
        body { background: #EBEBEB !important; } /* Adding !important forces the browser to overwrite the default style applied by Bootstrap */
    </style>

  </head>

  <body>
  
  		<?php
		   //Start your session
  			require("connect.php");
		    session_start();

		    if(empty($_SESSION['TC'])){
		        header("Location: index.php");
		        die("Redirecting to index.php"); 
		    }

		    //Read your session (if it is set)
		    if (isset($_SESSION['TC'])){
		   		$user = $_SESSION['TC'];
		   }

		?>

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
	
    
    
<div class="col-md-offset-1 col-md-1">
      <ul class="nav nav-pills nav-stacked">
        <li style="background-color: red"><a href="#">Doktor Ekle</a></li>
        <li><a href="#">Doktor Sil</a></li>
      </ul>
    </div>
    
    
<div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-login">
                    <div class="panel-heading">
                        <div class="row">
                            <?php echo $content; ?>	
                            <div class="col-xs-6">
                                <a href="#" class="active" id="login-form-link">Doktor Ekleme</a>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form id="login-form" action="" method="post" role="form" style="display: block;">
                                    <div class="form-group">
                                        <input type="text" name="TC" id="TC" tabindex="1" class="form-control" placeholder="TC Kimlik No" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="sifre" id="sifre" tabindex="2" class="form-control" placeholder="Şifre">
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Doktor Ekle">
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