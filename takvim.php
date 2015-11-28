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
        <div class="col-md-10 col-md-offset-1">


          <div class="mycal" style="width:100%;"></div>

          <script type="text/javascript" src="/lib/underscore-min.js"></script>
          <script type="text/javascript" src="/lib/moment.min.js"></script>
          <script type="text/javascript" src="<?php echo "/doktor/".$user;?>/dataset.js"></script>
          <script type="text/javascript" src="easycal.js"></script>

          <script>
            $('.mycal').easycal({
              startDate : '30-11-2015', // OR 31/10/2104
              timeFormat : 'HH:mm',
              columnDateFormat : 'dddd, DD MMM',
              minTime : '09:00:00',
              maxTime : '18:30:00',
              slotDuration : 30,
              timeGranularity : 15,
              
              dayClick : function(el, startTime){
                console.log('Slot selected: ' + startTime);
              },
              eventClick : function(eventId){
                console.log('Event was clicked with id: ' + eventId);
              },

              events : getEvents(),
              
              overlapColor : '#FF0',
              overlapTextColor : '#000',
              overlapTitle : 'Multiple'
            });

          </script>
          <br><br>
          <a href="/doktor.php" class="btn btn-info btn-block btn-lg" role="button">Ana Sayfaya Geri Dön</a>

        </div>
      </div>
    </div>



  </body>
  </html>