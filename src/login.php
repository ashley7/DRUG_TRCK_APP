<?php
$charles_pin  =  "";
	include("function.php");	 

	if (!empty($_POST['password_track'])) {
		$pin = $_POST['password_track'];
		$e_number = $_POST['number_track'];
			$strong_pin = hash("ripemd128", $pin);


		$select = mysqli_query($con, "SELECT Pasword,E_NAME,BRANCH FROM employees WHERE E_NUMBER = '$e_number'");
if ($select) {
 
	if (mysqli_num_rows($select)==1) {

		while ($counter = mysqli_fetch_assoc($select)) {
			# code...
			$password = $counter['Pasword'];
			$name = $counter['E_NAME'];
			$b_num = $counter['BRANCH'];
			if ($strong_pin == $password) {
				# code...

				$_SESSION['e_num'] = $e_number;
				$_SESSION['name'] = $name;
				$_SESSION['strong_pin'] = $strong_pin;
				$_SESSION['banch'] = $b_num;
				header("location:admin_task.php");
				exit();

			}
			else
			 $_SESSION['non'] = "<p class = 'text-danger'>passwod is not correct, try again.</p>".mysqli_error($con);


		}
	}
	else
		 $_SESSION['non'] = "<p class = 'text-danger'>Number $e_number not found.</p>".mysqli_error($con);

}
		

		# code...
	}
	header("location:index.php");

 	echo "$strong_pin/$password";

?>