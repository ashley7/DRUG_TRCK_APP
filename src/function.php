<?php
session_start();
$con = mysqli_connect("localhost","root","");
$make_db = mysqli_query($con, "CREATE DATABASE medic");
$con = mysqli_connect("localhost","root","","medic");
// make default password
$create_tablePsecurity = mysqli_query($con, "CREATE TABLE 
SECURITY(ID INT(11) NOT NULL AUTO_INCREMENT,
 PIN TEXT(32) NOT NULL,PRIMARY KEY(ID))");

 // check if password is there 
$check = mysqli_query($con,"SELECT PIN FROM SECURITY");
if ($check) {
	if (mysqli_num_rows($check) == 0) {
		# code...
		$pin = "12345";
		$strong_pin = hash("ripemd128", $pin);
		$save = mysqli_query($con, "INSERT INTO SECURITY(PIN)VALUES('$strong_pin')");
	}
	else{
		// do nothing
	}
	# code...
}


?>