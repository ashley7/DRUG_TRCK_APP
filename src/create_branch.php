<?php
include("function.php");
if (isset($_SESSION['save'])) {
				unset($_SESSION['save']);
	 }
$_name = mysqli_real_escape_string($con,$_POST['b_name']);
$_number = mysqli_real_escape_string($con,$_POST['b_number']);
$_adreesss = mysqli_real_escape_string($con,$_POST['b_location']);
mysqli_query($con, "CREATE TABLE branches(ID INT(11) NOT NULL 
	AUTO_INCREMENT, PRIMARY KEY(ID),B_NAME TEXT(100) NOT NULL,
	B_NUMBER varchar(25) not null unique, b_address text(255) not null)");
$save = mysqli_query($con, "INSERT INTO branches(B_NAME,B_NUMBER,
	b_address)VALUES('$_name','$_number','$_adreesss')");
if ($save) {
	$_SESSION['save'] = "<i class = 'text-success'>Branch created successifully!!!</i>";
	# code...
}
else{
	$_SESSION['save'] = "<i class = 'text-danger'>Banch Number $_number is aleady created</i>";
}
header("Location:admin.php");
?>