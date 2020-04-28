<?php
function doDB(){

	global $mysqli;

	//connect to server and select database; you may need it
	$mysqli = mysqli_connect("localhost", "root", "", "tv_forum");
	//$mysqli = mysqli_connect("localhost", "lisabalbach_kelly292", "CIT190110", "lisabalbach_kelly292");
	//if connection fails, stop script execution
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
}
?>