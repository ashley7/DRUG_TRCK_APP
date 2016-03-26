<?php
include("function.php");
if (!isset($_SESSION['strong_pin'])) {
	header("location:index.php");
	exit();
	# code...
}
 
if (isset($_SESSION['e_num'])) {
	# code...
	 $number = $_SESSION['e_num'];
	 $name = $_SESSION['name'];
	 $bra_num = $_SESSION['banch'];
	 // echo "$bra_num";
	 $saler = "$name; No.$number";
}
else{
	header("location:index.php");
	exit();
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	 
	<link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
	<script type="text/javascript" src="../js/jquery-1.9.0.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
</head>
<body>
	 <center class = "alert alert-info">THE DRUCK TRACK</center>
	<div class = "container">	 
		<div class = "row">			 
			<div class = "col-md-12 col-lg-12">
				<div class = "row">
					<div class = "col-md-3 col-lg-3 alert-index alert-warning">
						<?php
						$Today = date('y:m:d');
					    $new = date('l, F d, Y', strtotime($Today));
					    echo "<p class = 'alert-index alert-danger'>$new</p>";
		

						?>


						<br/><a href="#update_dugs" data-toggle="collapse"><center><p class = "alert-index alert-info">RECORD DRUG OUT</p></a></center>
					<div id="update_dugs" class="collapse">
						<div class="alert-index alert-warning">
				<form method = "POST" action = "drug_out.php">
					 Drug Number:<input type = "number" min = "1" class = "form-control" 
					 name = "drug_number" required>
					 Number of Doses:<input type = "number" min = "0" step = "any" class = "form-control" 
					 name = "numberr_of_doses">
						<br/>
					<input type = "submit" name = "save_them" class = "btn btn-success btn-block" value = "Save">
					<input type = "submit" title = "This will delete the medical record for sales of the DRUG_ID that You entred and set back the available drugs to previous figure. You may live the number of doses space blank for this case." 
					name = "undo" class "btn btn-warning" value = "Undo Record">
		 		</form>
							 <a href="#display" data-toggle="collapse">View Dugs Out.</a>
							 
						</div>
					</div>

					<?php
				echo "$name, Number: $number";


					?>



				 <br/><a href="log_out.php">Log out</a>







					</div>
					
						<div class = "col-md-9 col-lg-9">


							<?php
							include("seach_drug.html");
							?>



	 

		<div id="display" class="collapse">
			<table class = "table">
				 <center class = "alert-index alert-info">DRUGS GIVEN OUT</center> 
				<tr class = "danger">
					<th>DRUG ID</th><TH>DOSES</TH><TH>DRUG NAME</TH><th>AMOUNT</th><TH>DATE RECORDED</TH><th>SALER</th>
				</tr>
					<?php 
								$select = mysqli_query($con, "SELECT * FROM `drugs_out` WHERE 
									SALER_DETAIALS= '$saler' ORDER BY ID DESC");
								if ($select ) {
									if (mysqli_num_rows($select) > 0) {
										# code...
									 
									while ($counter = mysqli_fetch_assoc($select)) {
										$drug_id = $counter['DRUG_NUMBER'];	
										// get drug names
										$get = mysqli_query($con, "SELECT DRUG_NAME FROM drugs 
											WHERE DRUG_ID = '$drug_id'");
										if ($get) {
											while ($c = mysqli_fetch_assoc($get)) {
												# code...
												$dug_name = $c['DRUG_NAME'];

										$drug_doses = $counter['NUMBER_OF_DOSES'];
										 $date_recorded = $counter['DATES_RECORDED'];
										 $SALER_DETAIALS = $counter['SALER_DETAIALS'];
										 $COST_DOSE = $counter['COST_DOSE'];
										 $id = $counter['ID'];
										 
										echo "<tr class = 'alert-index alert-warning'>
										<td>$id</td><td>$drug_doses</td> <td>$dug_name</td>
										<td>$COST_DOSE</td><td>
										
										";?>

		 <a href="#charles<?php echo $id?>"   data-toggle="modal"><?php echo $date_recorded?></a>
			<div id="charles<?php echo $id?>" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<a href="" class="close" data-dismiss="modal">
								&times
							</a>
							<h2>The sales of <?php echo $date_recorded?></h2>
						</div>
						<div class="modal-body">

							<?php
							$tatal = "";

							$selectz = mysqli_query($con, "SELECT * FROM `drugs_out` WHERE 
									SALER_DETAIALS= '$saler' AND DATES_RECORDED = '$date_recorded'
									 ORDER BY ID DESC");
								if ($selectz ) {
									if (mysqli_num_rows($selectz) > 0) {

										$selectzsum = mysqli_query($con, "SELECT SUM(COST_DOSE) FROM `drugs_out` WHERE 
									SALER_DETAIALS= '$saler' AND DATES_RECORDED = '$date_recorded'
									 ORDER BY ID DESC");
										if ($selectzsum) {
											while ($sum = mysqli_fetch_assoc($selectzsum)) {
												# code...
												$tatal = $sum['SUM(COST_DOSE)'];
											}
											# code...
										}
										# code...									 
									while ($counterz = mysqli_fetch_assoc($selectz)) {
										$drug_id = $counterz['DRUG_NUMBER'];	
										// get drug names
										$getz = mysqli_query($con, "SELECT DRUG_NAME FROM drugs 
											WHERE DRUG_ID = '$drug_id'");
										if ($getz) {
											while ($cz = mysqli_fetch_assoc($getz)) {
									 	$dug_name = $cz['DRUG_NAME'];
										$drug_dosesz = $counterz['NUMBER_OF_DOSES'];
										$date_recordedz = $counterz['DATES_RECORDED'];
										$SALER_DETAIALSz = $counterz['SALER_DETAIALS'];
										$COST_DOSEz = $counterz['COST_DOSE'];
										echo "$dug_name =  $COST_DOSEz<br/>";

										}
									}
								}
							}
						}
						echo "<br/><br/><br/>";
						printf("************** TOTAL = %.2f **************",$tatal);
							?>							 
						</div>
						 
					</div>
				</div>
			</div>


										<?php
										echo "</td> <td> $SALER_DETAIALS</td>
										</tr>";
											}
											# code...
										}
									

									# code...
								}
							}
							else{
								echo "<p class = 'text-danger'>No drugs saved.</p>";
							}

									# code...
								}
								else
									echo mysqli_error($con);
								
								?>

			 
			</table>			 
		</div>


							<table class = "table table-hover">
								 <center class = "alert-index alert-info">DRUGS RECORDED IN</center> 
								<tr class = "success">
									<th>DRUG NUMBER</th><TH>DRUG NAME</TH><th>DESCRIPTION</th><th>COAST (shs)</th><th>DOSES</th><TH>EXPIRY DATE</TH>
								</tr>
								<?php
								 
								$select = mysqli_query($con, "SELECT *FROM drugs WHERE BRANCH = '$bra_num'");
								if ($select ) {
									if (mysqli_num_rows($select) > 0) {
										# code...
									 
									while ($counter = mysqli_fetch_assoc($select)) {
										$drug_id = $counter['DRUG_ID'];
										$drug_name = $counter['DRUG_NAME'];
										$drug_doses = $counter['DRUG_DOSES'];
										$date_recorded = $counter['DATE_RECORDED'];
										$expiry_date = $counter['EXPIRY_DATE'];
										$DESCRIPTION = $counter['DESCRIPTION'];
										$cost = $counter['COSTPAR_DOSE'];
										$expiry_dates=date_create($expiry_date);
										$today=date_create($new);
										$diff=date_diff($today,$expiry_dates);
										$diiff = $diff->format("%R%a");
										// echo "$diiff";

										if ($drug_doses == 0) {

									echo "<tr class = 'alert-index alert-warning danger' title = 'out of stock'>
										<td>$drug_id</td><td > $drug_name</td><td>$drug_doses</td>
										<td>$date_recorded</td><td>$expiry_date</td><td>$cost</td>
										</tr>";
											# code...
										}

										if ($diiff < 1) {
										echo "<tr class = 'alert-index alert-warning danger' title = 'Drug is expiied'>
										<td>$drug_id</td><td  
										 >$drug_name</td><td>$DESCRIPTION</td><td>$cost</td><td>$drug_doses</td>
										<td>$expiry_date</td>
										</tr>";
										}

										else
										{
										echo "<tr class = 'alert-index alert-warning'>
										<td>$drug_id</td><td  
										 >$drug_name</td><td>$DESCRIPTION</td><td>$cost</td><td>$drug_doses</td>
										<td>$expiry_date</td>
										</tr>";
									}

									# code...
								}
							}
							else{
								echo "<p class = 'text-danger'>No drugs saved.</p>";
							}

									# code...
								}
								
								?>
							</table>
						</div>
				</div>
			</div>
		</div>
	</div>	 
</body>
</html>