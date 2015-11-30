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
  $docTC = $_SESSION['docTC'];
}



if (!empty($_POST['add-submit'])) {

  if (isset($_POST['gun']) && isset($_POST['bsaat'])) {
    $gun = $_POST['gun'];
    $bsaat = $_POST['bsaat'];

    if (empty($gun) || empty($bsaat)) {
            #echo "Alanlar bos birakilamaz";
      $content = "<div class='alert alert-info alert-dismissible' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      Alanlar bos birakilamaz.
    </div>";
  }

  else {

    $query = "SELECT * FROM Hasta WHERE TC='$user'";
    $result = mysql_query($query) or die(mysql_error());
    $row = mysql_fetch_array($result);
    $aa = $row['Ad'];
    $bb = $row['Soyad'];
    $saatler = array("09:00:00","09:30:00","10:00:00","10:30:00","11:00:00","11:30:00","12:00:00","12:30:00","13:00:00","13:30:00","14:00:00","14:30:00","15:00:00","15:30:00","16:00:00","16:30:00","17:00:00","17:30:00","18:00:00");
    $bas = array_search($bsaat, $saatler);

      $mytext = "return [
      {
        id : 'E07',
        title : '".$aa.' '.$bb."',
        start : '".$gun.' '.$bsaat."',
        end : '".$gun.' '.$saatler[$bas+1]."',
        backgroundColor: '#12CA6B',
        textColor : '#FFF'
      },";

      $path_to_file = 'doktor/'.$docTC.'/dataset.js';
      $file_contents = file_get_contents($path_to_file);
      $file_contents = str_replace("return [",$mytext,$file_contents);
      file_put_contents($path_to_file,$file_contents);

    

    $content = "<div class='alert alert-info alert-dismissible' role='alert'>
    <span class='close' data-dismiss='alert'>&times;</span>
    Randevu bilgisi takviminize eklendi.
  </div>";
}

}

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
          <li><a href="/hasta.php"><?php echo $user;?></a><li>
            <li><a href="/logout.php">Çıkış Yap</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>


    <br><br>
    <div class="container">
      <div class="row">


        <div class="col-md-4">

          <div class="col-md-10">

            <?php echo $content; ?> 
            <form id="randevu-ekle" action="" method="post" role="form" style="display: block;">
              <div class="form-group">

                <label for="gun_l">Gün Seçiniz:</label>
                <select name="gun" id="gun" class="form-control">
                  <option></option>
                  <option value="30-11-2015">Monday, 30 Nov</option>
                  <option value="1-12-2015">Tuesday, 01 Dec</option>
                  <option value="2-12-2015">Wednesday, 02 Dec</option>
                  <option value="3-12-2015">Thursday, 03 Dec</option>
                  <option value="4-12-2015">Friday, 04 Dec</option>
                  <option value="5-12-2015">Saturday, 05 Dec</option>
                  <option value="6-12-2015">Sunday, 06 Dec</option>
                </select>

                <br>
                <label for="bsaat_l">Randevu Saati Seçiniz:</label>
                <select name="bsaat" id="bsaat" class="form-control">
                  <option></option>
                  <option value="09:00:00">09:00</option>
                  <option value="09:30:00">09:30</option>
                  <option value="10:00:00">10:00</option>
                  <option value="10:30:00">10:30</option>
                  <option value="11:00:00">11:00</option>
                  <option value="11:30:00">11:30</option>
                  <option value="12:00:00">12:00</option>
                  <option value="12:30:00">12:30</option>
                  <option value="13:00:00">13:00</option>
                  <option value="13:30:00">13:30</option>
                  <option value="14:00:00">14:00</option>
                  <option value="14:30:00">14:30</option>
                  <option value="15:00:00">15:00</option>
                  <option value="15:30:00">15:30</option>
                  <option value="16:00:00">16:00</option>
                  <option value="16:30:00">16:30</option>
                  <option value="17:00:00">17:00</option>
                  <option value="17:30:00">17:30</option>
                </select>
              </div>
              <br><br>
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-6 col-sm-offset-3">
                    <input type="submit" name="add-submit" id="add-submit" tabindex="4" class="form-control btn btn-login" value="Randevu Ekle">
                  </div>
                </div>
              </div>
            </form>

          </div>

        </div>

        <div class="col-md-8">
          <div class="mycal" style="width:100%;"></div>

          <script type="text/javascript" src="/lib/underscore-min.js"></script>
          <script type="text/javascript" src="/lib/moment.min.js"></script>
          <script type="text/javascript" src="<?php echo "/doktor/".$docTC;?>/dataset.js"></script>
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
              
              //overlapColor : '#FF0',
              //overlapTextColor : '#000',
              //overlapTitle : 'Multiple'
            });

          </script>
          <br><br>
          <a href="/hasta.php" class="btn btn-info btn-block btn-lg" role="button">Ana Sayfaya Geri Dön</a>

        </div>

      </div>
    </div>
  </div>



</body>
</html>