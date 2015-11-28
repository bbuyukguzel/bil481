
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
  <link rel="stylesheet" type="text/css" href="easycal.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


  <style type="text/css">
    body{ 
      background: #EBEBEB !important; 
      margin: 0 auto !important; 
      font-size: 12px !important; 
      box-sizing: border-box; !important
  }
td:hover { 
   background: gray; 
}
td a { 
    width: 100%
   display: block; 
   border: 1px solid black;
}
</style>

<script type="text/javascript">
    function createTable()
    {   
        var hhmm = ["09:00", "09:30", "10:00", "10:30", "11:00", "11:30", "12:00", "12:30", "13:00", "13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30", "17:00", "17:30", "18:00"];
        var i = 0;
        var theader = '<table border="1">\n';
        var tbody = '<th></th><th>Monday, 30 Nov</th><th>Tuesday, 01 Dec</th><th>Wednesday, 02 Dec</th><th>Thursday, 03 Dec</th><th>Friday, 04 Dec</th><th>Saturday, 05 Dec</th><th>Sunday, 06 Dec</th>';

        for( var i=0; i<19;i++)
        {   
            tbody += '<tr>';
            for( var j=0; j<7;j++)
            {
                if(j==0){
                    tbody += '<td>'+hhmm[i]+'</td>';
                }
                tbody += '<td><a href="#">  </a>';
                tbody += '</td>';
            }
            tbody += '</tr>\n';
        }
        var tfooter = '</table>';
        document.getElementById('wrapper').innerHTML = theader + tbody + tfooter;
    }
</script>

</head>

<body onload="createTable();">


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
    <div class="col-md-10 col-md-offset-1">


        


            <div id="wrapper"></div>
            <br><br>
            <a href="/doktor.php" class="btn btn-info btn-block btn-lg" role="button">Ana Sayfaya Geri Dön</a>

        </div>
    </div>
</div>



</body>
</html>