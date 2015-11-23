<?php 
    require("connect.php"); 
	session_start();
	session_destroy();
	echo 'Cikis yaptiniz. Giris sayfasina yonlendirileceksiniz.';
	header("refresh:2; url=/index.php" );
?>
