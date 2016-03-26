<?php
	include("function.php");
$e_number = $_POST['number_track'];
$pin_one = $_POST['password_track'];
$c_pin_code = $_POST['comfirm_password_track'];
if (isset($_SESSION['non'])) {
	unset($_SESSION['non']);
	# code...
}

// check $e_number
 $select = mysqli_query($con, "SELECT * FROM employees WHERE E_NUMBER = '$e_number'");
if ($select) {
	echo mysqli_num_rows($select);
	if (mysqli_num_rows($select)==1) {
		if ($pin_one == $c_pin_code) {
			$c_pin_code  = hash("ripemd128", $c_pin_code);
			$ok = mysqli_query($con,"UPDATE employees SET Pasword = '$c_pin_code' 
				WHERE E_NUMBER  = '$e_number'");
			if ($ok) {
		$_SESSION['non'] = "<p class = 'text-success'>Successifully registred!!!</p>";	

				# code...
			}
			else{

			}
 
		}
		else{
		$_SESSION['non'] = "<p class = 'text-danger'>Your password did not match. Try again</p>";	
		}
	}
	else{
		$_SESSION['non'] = "<p class = 'text-danger'>Number $e_number not found.</p>".mysqli_error($con);
	}
}

if (isset($_SESSION['non'])) {
	echo $_SESSION['non'];
	# code...
}
header("location:index.php");
?>