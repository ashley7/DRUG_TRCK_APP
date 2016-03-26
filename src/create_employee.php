<?php
include("function.php");
if (isset($_SESSION['save'])) {
				unset($_SESSION['save']);
	 }
$_name = mysqli_real_escape_string($con,$_POST['b_name']);
$_number = mysqli_real_escape_string($con,$_POST['b_number']);
$_adreesss = mysqli_real_escape_string($con,$_POST['branch']);
$_phone = mysqli_real_escape_string($con,$_POST['E_phone']);
mysqli_query($con, "CREATE TABLE employees(ID INT(11) NOT NULL 
	AUTO_INCREMENT, PRIMARY KEY(ID),E_NAME TEXT(100) NOT NULL,
	E_NUMBER varchar(25) not null unique, 
	Pasword text(255), BRANCH VARCHAR(25) NOT
	 NULL REFERENCES branches(B_NUMBER), E_phone TEXT(20))");
$save = mysqli_query($con, "INSERT INTO employees(E_NAME,E_NUMBER,
	BRANCH,E_phone)VALUES('$_name','$_number','$_adreesss','$_phone ')");
if ($save) {
	$_SESSION['save'] = "<i class = 'text-success'>Employee created successifully!!!</i>";
	# code...
}
else{
	$_SESSION['save'] = "<i class = 'text-danger'>Employee Number $_number is aleady created</i>";
}
header("Location:admin.php");
?>