<?php

	$connection = mysql_connect('localhost', 'root', 'fPNHh6O1');
	if (!$connection){
	    die("Database Connection Failed" . mysql_error());
	}
	$select_db = mysql_select_db('bil481');
	if (!$select_db){
	    die("Database Selection Failed" . mysql_error());
	}

?>
