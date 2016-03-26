<?php
include("function.php");
?>
<HTML lang = "en">
	<head>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">

	</head>
	<body>
			 <center class = "alert alert-info">THE DRUCK TRACK</center>

		<div class = "row">
			<div class = "col-md-3 col-lg-3">

		 <div id="accordion" class="panel-group">
				<div class="panel panel-success">					 
					<div class="panel-collapse collapse in" id="one">
						<div class="panel-body">
	<ul class = "nav">
		<li> <a href="#sectionOne" data-toggle="collapse">Register Banches</a></li>
		<li><a href="#sectionTwo" data-toggle="collapse">Register Employees</a></li>
		<li> <a href="#sectiondrug" data-toggle="collapse">Record Drugs</a>
	 <li> <a href="#sectiondrugView" data-toggle="collapse">View Drugs</a>
	 	<li><a href="statistics.php">Inspect Statistic</a></li>
	 <li><a href="#myModalp" data-toggle="modal">Change system password</a>
</li>
<li><a href="#delte" data-toggle="collapse"><i class = "text-danger">Delete Drug</i></a>
</li>

</li>

	</ul>	

					<div id="delte" class="collapse">
						<div class="alert-index alert-warning">
							<form method = "POST">
								Drug Number:<input type = "number" class = "form-control" name = "dug_number" required>
							<br/>
							<input type = "submit" class = "btn btn-danger" value = "Delete">
							</form>
							<?php
							if (isset($_POST['dug_number'])) {
								$id = $_POST['dug_number'];
								$del = mysqli_query($con, "DELETE FROM drugs WHERE DRUG_ID = '$id'");
								# code...
							}
							?>
						</div>
					</div>


						</div>
					</div>
				</div>
			</div>

			</div>
			<div class = "col-md-9 col-lg-9">
				 <h3><center class = "alert alert-warning">THE DRUG TRACK</center></h3>
				<?php
				if (isset($_POST['manual_serach'])) {
					$b_number = $_POST['manual_serach'];
				 
	$Today = date('y:m:d');
    $new = date('d F, Y', strtotime($Today));
    // echo " $new";

    $select = mysqli_query($con, "SELECT *FROM branches where B_NUMBER = '$b_number'");
				if ($select) {
					if (mysqli_num_rows($select)>0) {
						# code...
						while ($counter = mysqli_fetch_assoc($select)) {
							$name = $counter['B_NAME'];
							$b_name = $counter['B_NUMBER'];
							$add = $counter['b_address'];

							echo "<p class = 'alert-index alert-warning'>Branch Name:$name, Number:$b_name</p>
							&nbsp;&nbsp;<i class = 'text-danger'>$add</i>


							";
							# code...
						}
					}
					else{
						echo "<p class = 'text-info'>No branches yet!!</p>";
					}
					# code...
				}	
   

					?>

						<table class = "table table-hover">
								 <center class = "alert-index alert-info">DRUGS RECORDED IN</center> 
								<tr class = "danger">
									<th>DRUG NUMBER</th><TH>DRUG NAME</TH><TH>NUMBER DOSES</TH><TH>DATE RECORDED</TH><TH>EXPIRY DATE</TH><th>COST</th>
								</tr>
								<?php
								$select = mysqli_query($con, "SELECT *FROM drugs WHERE BRANCH = '$b_number'");
								if ($select ) {
									if (mysqli_num_rows($select) > 0) {
										# code...									 
									while ($counter = mysqli_fetch_assoc($select)) {
										$drug_id = $counter['DRUG_ID'];
										$drug_name = $counter['DRUG_NAME'];
										$drug_doses = $counter['DRUG_DOSES'];
										$date_recorded = $counter['DATE_RECORDED'];
										$expiry_date = $counter['EXPIRY_DATE'];
										$cost = $counter['COSTPAR_DOSE'];

										$expiry_dates=date_create($expiry_date);
										$today=date_create($new);
										$diff=date_diff($today,$expiry_dates);
										$diiff = $diff->format("%R%a");
										// echo "$diiff";


										if ($drug_doses == 0) {

									echo "<tr class = 'danger' title = 'out of stock'>
										<td>$drug_id</td><td >$drug_name</td><td>$drug_doses</td>
										<td>$date_recorded</td><td>$expiry_date</td><td>$cost</td>
										</tr><tr></tr>";
											# code...
										}

										if ($diiff < 1) {
										echo "<tr class = 'danger' title = 'Drug is expiied'>
										<td>$drug_id</td><td >$drug_name</td><td>$drug_doses</td>
										<td>$date_recorded</td><td>$expiry_date</td><td>$cost</td>
										</tr><tr></tr>";
										}

										else
										{
										echo "<tr class = 'success'>
										<td>$drug_id</td><td>$drug_name</td><td>$drug_doses</td>
										<td>$date_recorded</td><td>$expiry_date</td><td>$cost</td>
										</tr>
										<tr></tr>

										";
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
					<?php

					# code...
				}


				?>

		<div id="sectiondrugView" class="collapse">
			<div class="well">
				<p>Search drugs.</p>
				<?php
				include("serach_drugs.php");
				?>			 


			</div>
		</div>

		<div id="sectiondrug" class="collapse">
			<div class="well">
				<center class = "alert alert-danger">RECORD NEW DRUGS</center>

	 <div class = "row">
			<div class = "col-md-12 col-lg-12 alert alert-warning">

				<form method = "POST" action = "save_drugs.php">
				 <p>Drug Name:</p>
					<input type = "text" name = "b_name" required class = "form-control">
				 <p>Number of doses:</p>
					<input type = "text" name = "numdoses" required class = "form-control">
				     Expiry Date:
							<?php
							include("datepicker.html");
							?>

				 <p>Cost Per each dose:</p>
					<input type = "text" name = "cost" required class = "form-control">
					<p>Brach</p>
					<select name = "branch" required class = "form-control">
								<option></option>
			 <?php

				$select = mysqli_query($con, "SELECT *FROM branches");
				if ($select) {
					if (mysqli_num_rows($select)>0) {
						# code...
						while ($counter = mysqli_fetch_assoc($select)) {
							$name = $counter['B_NAME'];
							$b_nam = $counter['B_NUMBER'];
							$add = $counter['b_address'];

							echo "<option title = 'Name $name; $add'>$b_nam</option>";
 						 
						}
					}
					else{
						echo "<p class = 'text-info'>No branches yet!!</p>";
					}
					# code...
				}			 

				?>

						</select>

				 <p>Desription <i>e.g dosage</i>:</p>
					<textarea name = "desc_doses" required class = "form-control"></textarea>
				  
					
					<br>
					 <input type = "submit" value = "save drug" class = "btn btn-primary btn-block">

				</form>
			</div>			 
		</div>
		</div>
		</div>



		 <div id="sectionOne" class="collapse">
			<div class="well">
		 <div class = "row">
			<div class = "col-md-4 col-lg-4 alert alert-warning">
				<p><?php
				if (isset($_SESSION['save'])) {
					echo $_SESSION['save'];
					# code...
				}

				?></p>
				<center>Register Branches</center>
				<form method = "POST" action = "create_branch.php">
					<p>Name:</p>
					<input type = "text" name = "b_name" required class = "form-control">
						<p>Number:</p>
					<input type = "text" name = "b_number" required class = "form-control">
						<p>Location:</p>
					<input type = "text" name = "b_location" required class = "form-control">
					<br>
					 <input type = "submit" value = "save branch" class = "btn btn-primary btn-block">

				</form>
	 <a href="#sectionTwodel" data-toggle="collapse"><p class = "text-danger">Delete Branch</p></a>

		<div id="sectionTwodel" class="collapse">
			<div class="well">
				<?php
				if (isset($_POST['b_number'])) {
					$del = mysqli_real_escape_string($con, $_POST['b_number']);
					mysqli_query($con, "DELETE FROM branches WHERE B_NUMBER = '$del'");
					# code...
				}

				?>

				<form method = "POST">
					
					<p>Number:</p>
					<input type = "text" name = "b_number" required class = "form-control">
				 		<br>
					 <input type = "submit" value = "Delete" class = "btn btn-danger btn-block">

				</form>
			</div>
		</div>

				

			</div>
			<div class = "col-md-8 col-lg-8">

				<?php
				$select = mysqli_query($con, "SELECT *FROM branches");
				if ($select) {
					if (mysqli_num_rows($select)>0) {
						# code...
						while ($counter = mysqli_fetch_assoc($select)) {
							$name = $counter['B_NAME'];
							$b_name = $counter['B_NUMBER'];
							$add = $counter['b_address'];

							echo "<p class = 'alert-index alert-warning'>Branch Name:$name, Number:$b_name</p>
							&nbsp;&nbsp;<i class = 'text-danger'>$add</i>


							";
							# code...
						}
					}
					else{
						echo "<p class = 'text-info'>No branches yet!!</p>";
					}
					# code...
				}			 

				?>
			</div>
		</div>
			 
			</div>
		</div>



		<div id="sectionTwo" class="collapse">
			<div class="well">
		 <div class = "row">
			<div class = "col-md-4 col-lg-4">

				<center>Register employees</center>
				<form method = "POST" action = "create_employee.php">
					<p>Name:</p>
					<input type = "text" name = "b_name" required class = "form-control">
						<p>Employee Number:</p>
					<input type = "text" name = "b_number" required class = "form-control">
						<p>Branch Number:</p>
						<select name = "branch" required class = "form-control">
								<option></option>
								<?php

				$select = mysqli_query($con, "SELECT *FROM branches");
				if ($select) {
					if (mysqli_num_rows($select)>0) {
						# code...
						while ($counter = mysqli_fetch_assoc($select)) {
							$name = $counter['B_NAME'];
							$b_nam = $counter['B_NUMBER'];
							$add = $counter['b_address'];

							echo "<option title = 'Name $name; $add'>$b_nam</option>";
 
 
							 
						}
					}
					else{
						echo "<p class = 'text-info'>No branches yet!!</p>";
					}
					# code...
				}			 

				?>

						</select>

						<p>Employee Phone:</p>

					<input type = "text" name = "E_phone" required class = "form-control">
					




					 <br>
					 <input type = "submit" value = "save branch" class = "btn btn-primary btn-block">

				</form>



			</div>
			<div class = "col-md-8 col-lg-8">

				<?php

				$selectx = mysqli_query($con, "SELECT * FROM branches");
				if ($selectx) {
					if (mysqli_num_rows($selectx)>0) {
						# code...
						while ($counterx = mysqli_fetch_assoc($selectx)) {					 
						 
							$name = $counterx['B_NAME'];
							$b_nam = $counterx['B_NUMBER'];
							$add = $counterx['b_address'];
							echo "<p class = 'alert-index alert-warning'>Branch Name:$name, Number:$b_name</p>
							&nbsp;&nbsp;<i class = 'text-danger'>$add</i>";
					 

	   
							
	 $select = mysqli_query($con, "SELECT * FROM employees WHERE BRANCH = '$b_nam '");
				if ($select) {
					if (mysqli_num_rows($select)>0) {
						# code...
						while ($counter = mysqli_fetch_assoc($select)) {					 
							 $e_name = $counter['E_NAME'];
							 $e_phone= $counter['E_phone'];
							 $e_number= $counter['E_NUMBER'];
							 echo "<p class = 'alert alert-warning'>
							 Name: $e_name<br/>
							 Phone: $e_phone<br/>
							 Number: $e_number<br/>

							 </p>";
						}
					}
				} 
 
							 
					 
 				 
						}
					}
					else{
						echo "<p class = 'text-info'>No branches yet!!</p>";
					}
					# code...
				}			 

				?>



			</div>
		</div>

				 
			</div>
		</div>
				 
			</div>			 
		</div> 


			<div id="myModalp" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">						 
						</div>
						<div class="modal-body">
							<form method = "POST" action = "change_pin.php" class = "alert alert-warning">
								<p><center class = "alert-index alert-info">Change system password</center></p>
								Old Password: <input type = "password" name = "old_password" class = "form-control">
							    New Password: <input type = "password" name = "new_password" class = "form-control">
							 	Confirm Password: <input type = "password" name = "confirm_password" class = "form-control">
							 	<br/>
							 	 <input type = "submit" value = "OK" class = "btn btn-primary">
							</form>
							<?php
							if (isset($_SESSION['pin_invali'])) {
								echo $_SESSION['pin_invali'];
								# code...
							}

							?>
						 
						</div>						 
					</div>
				</div>



	<script type="text/javascript" src="../js/jquery-1.9.0.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>

	</body>
</HTML>