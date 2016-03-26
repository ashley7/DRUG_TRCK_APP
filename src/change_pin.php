<?php
include("function.php");
if (!empty($_POST['old_password'])) {
	if (!empty($_POST['new_password'])) {
		if (!empty($_POST['confirm_password'])) {
			$old = mysqli_real_escape_string($con, $_POST['old_password']);
			$new_pin = mysqli_real_escape_string($con, $_POST['new_password']);
			$comfirm = mysqli_real_escape_string($con, $_POST['confirm_password']);
			// get old password
			$select = mysqli_query($con, "SELECT PIN FROM security");
			if ($select) {
				while ($counter = mysqli_fetch_assoc($select)) {
					$pin=$counter['PIN'];

					if (hash("ripemd128",$old)==$pin) {
						# code...
						if ($new_pin == $comfirm) {
							$strong_password = hash("ripemd128", $comfirm);
							$update = mysqli_query($con, "UPDATE security 
								SET PIN = '$strong_password'");
							if ($update) {
								$_SESSION['pin_invali'] = "Operation successifull!!!";
								# code...
							}
							# code...
						}
					}
					else{
						$_SESSION['pin_invali'] = "Old pin in not correct. try again";
					}

					# code...
				}
				# code...
			}



			# code...
		}
		# code...
	}
	# code...
}
header("location:admin_task.php");
?>