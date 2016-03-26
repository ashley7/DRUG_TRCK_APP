<?php
include("function.php");

	 // un do record
					if (isset($_POST['undo'])) {
					 if (isset($_POST['drug_number'])) {
						$id = $_POST['drug_number'];	
						echo "$id ";				 
							 
							$select = mysqli_query($con, "SELECT NUMBER_OF_DOSES,DRUG_NUMBER FROM drugs_out WHERE ID = '$id'");

							if ($select) {
								while ($count = mysqli_fetch_assoc($select)) {
									$does_cooun = $count['NUMBER_OF_DOSES'];
									$num  = $count['DRUG_NUMBER'];
									echo "$does_cooun";

							 $selectzz = mysqli_query($con, "SELECT DRUG_DOSES FROM drugs 
							 	WHERE DRUG_ID = '$num'");
							 if ($selectzz) {
							 	while ($dose_count = mysqli_fetch_assoc($selectzz)) {
							 		# code...
							 		$num_drugs = $dose_count['DRUG_DOSES'];
							 		$eload_to_defore = $num_drugs + $num;
							 		echo "$eload_to_defore ";


							 		mysqli_query($con, "UPDATE drugs SET DRUG_DOSES = '$eload_to_defore' WHERE DRUG_ID = '$num'");

							 		mysqli_query($con, "DELETE FROM drugs_out WHERE 
							 			ID = '$id'");
							 	}

							 	# code...
							 }
							 else{
							 	echo mysqli_error($con);
							 }


									}
								}
							}
						}



/****** saving drugs out*********/
if (isset($_POST['save_them'])) {

	if (isset($_SESSION['e_num'])) {
	# code...
	 $numberaler = $_SESSION['e_num'];
	 $name = $_SESSION['name'];
	 $bra_num = $_SESSION['banch'];
	 $saler = "$name; No.$numberaler";

}
	# code...
 
if (isset($_POST['drug_number'])) {
	$id = $_POST['drug_number'];


	if (isset($_POST['numberr_of_doses'])) {
		$number = $_POST['numberr_of_doses'];
   $select = mysqli_query($con, "SELECT EXPIRY_DATE,DRUG_DOSES,COSTPAR_DOSE FROM drugs WHERE DRUG_ID = '$id'");
	if ($select ) {

		if (mysqli_num_rows($select) > 0) {

			# code...									 
		while ($counter = mysqli_fetch_assoc($select)) {
			$drug_doses = $counter['DRUG_DOSES'];
			$cost = $counter['COSTPAR_DOSE'];
			$exp_date = $counter['EXPIRY_DATE'];

			$drugs_cost = $number * $cost;
			 
			// get diff
			$difference = $drug_doses - $number;
			if ($difference >= 0) {


				 $Today = date('y:m:d');
					    $new = date('d F, Y', strtotime($Today));
				    	$expiry_dates=date_create($exp_date);
						$today=date_create($new);
						$diff=date_diff($today,$expiry_dates);
						$diiff = $diff->format("%R%a");
						echo "$diiff";

						if ($diiff > 1) {//only sale dugs more then two daya to expire
							# code...
							echo "$saler";
							// udate number of doses
				$update = mysqli_query($con, "UPDATE drugs SET 
					DRUG_DOSES = '$difference' WHERE DRUG_ID = '$id'");
				if ($update) {

					   
					 
					$table_for_drugs_out = mysqli_query($con, "CREATE TABLE 
						drugs_out(ID INT(11) NOT NULL AUTO_INCREMENT, 
							PRIMARY KEY(ID), DRUG_NUMBER INT(11) NOT NULL REFERENCES 
							 drugs(DRUG_ID), NUMBER_OF_DOSES text(11) NOT NULL,
							  DATES_RECORDED TEXT(255) NOT NULL,SALER_DETAIALS TEXT(255) NOT NULL, 
							  COST_DOSE DOUBLE(65,2) NOT NULL,BRANCH TEXT(25))");

					// this table will help me to do the statistics
					mysqli_query($con,"CREATE TABLE date_sales_track(ID INT(11) NOT NULL AUTO_INCREMENT, 
						PRIMARY KEY(ID), DATES_RECORDED TEXT(50) NOT NULL, BRANCH_NUMBER TEXT(25) NOT NULL, 
						DUPLICA VARCHAR(75) NOT NULL UNIQUE)");
				 
					$save_out = mysqli_query($con, "INSERT INTO drugs_out(DRUG_NUMBER, 
						DATES_RECORDED,NUMBER_OF_DOSES,SALER_DETAIALS, COST_DOSE,BRANCH) VALUES('$id','$new','$number',
						'$saler','$drugs_cost','$bra_num')");

					mysqli_query($con,"INSERT INTO date_sales_track(DATES_RECORDED,
						BRANCH_NUMBER,DUPLICA)VALUES('$new','$bra_num','$bra_num $new') ");


					if (!$save_out) {
						echo mysqli_error($con);
						# code...
					}


					# code...
				}

				if (!$update) {
					echo mysqli_error($con);
					# code...
				}



						}
						else{
							$_SESSION['chales'] = "<p class >
						Drug is left with $diiff days tp expire, it can not be sold.</p>";
					}




				
				# code...
			}
			else{
				$_SESSION['chales'] = "<p class = 'text-danger'>Drug Number $id is out of stock.></p>";

			}
		}
	}
	else
		$_SESSION['chales'] = "<p class = 'text-danger'>Drug Number $id does not exist.></p>";
}

		# code...
	}


}
}
header("location:admin_task.php");

?>