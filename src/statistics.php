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
		<li><a href="admin.php">Back</a></li>
		<li class = "active"><a href="statistics.php">Inspect Statistic</a></li>
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
				<center class = "alert-index alert-danger">Sales Statistis</center>
				<br>
				<table class = "table table-hover"> 


				<?php
				include("serach_stat.html");

				if (isset($_POST['branch_number'])) {
					# code...
					$b_number = $_POST['branch_number'];
					$name = mysqli_real_escape_string($con,$b_number);

		 $selectq = mysqli_query($con, "SELECT *FROM branches where B_NUMBER = '$name'");
				if ($selectq) {
					if (mysqli_num_rows($selectq)>0) {
						# code...
						while ($counterq = mysqli_fetch_assoc($selectq)) {
							$namex = $counterq['B_NAME'];
							$b_name = $counterq['B_NUMBER'];
							$add = $counterq['b_address'];

							echo "<h3 class = 'alert-index alert-warning'>Branch Name:$namex, Number:$b_name</h3>
							&nbsp;&nbsp;<i class = 'text-danger'>$add</i>";
							# code...
						}
					}
					else{
						echo "<p class = 'text-info'>No branches yet!!</p>";
					}
					# code...
				}	
					?>

 <tr class = "danger">
    <TH>DATE RECORDED</TH><th>AMOUNT</th> 
</tr>
<?php

// get dates 
$dates = mysqli_query($con,"SELECT *FROM date_sales_track WHERE BRANCH_NUMBER = '$name'");
if ($dates) {
	while ($date_counter = mysqli_fetch_assoc($dates)) {
		$DATES_RECORDED = $date_counter['DATES_RECORDED'];

		 $selecat = mysqli_query($con, "SELECT ID,SUM(COST_DOSE) FROM drugs_out WHERE 
		 	DATES_RECORDED = '$DATES_RECORDED' AND BRANCH = '$name'");

		 if ($selecat) {
		 	while ($get_sum = mysqli_fetch_assoc($selecat)) {
		 		# code...
		 		$sumation = $get_sum['SUM(COST_DOSE)'];
		 		$id = $get_sum['ID'];	 	 

		 		echo "<tr><td>		 		
		 <a href='#charles$id'  data-toggle='modal'>$DATES_RECORDED</a>
		 		</td><td>$sumation</td></tr>";

		 	$date_recorded = $DATES_RECORDED;
		 		?>

            <div id="charles<?php echo $id?>" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <a href="" class="close" data-dismiss="modal">
                                &times
                            </a>
                           <center  class = "alert-index alert-warning">The sales made on <?php echo $date_recorded?></center>
                        </div>
                        <div class="modal-body">

                            <?php
                            $tatal = "";

                            $selectz = mysqli_query($con, "SELECT * FROM `drugs_out` WHERE 
                                    BRANCH = '$name'
                                     ORDER BY ID DESC");
                                if ($selectz ) {
                                    if (mysqli_num_rows($selectz) > 0) {

                                        $selectzsum = mysqli_query($con, "SELECT SUM(COST_DOSE) FROM `drugs_out` WHERE DATES_RECORDED = '$date_recorded'
                                     ORDER BY ID DESC");
                                        if ($selectzsum) {
                                            while ($sum = mysqli_fetch_assoc($selectzsum)) {
                                                # code...
                                                $tatal = $sum['SUM(COST_DOSE)'];
                                            }
                                            # code...
                                        }
                                        $counter_number = 1;
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
                                        echo "$counter_number. $dug_name =  $COST_DOSEz;<i class = 'text-info'>&nbsp;By $SALER_DETAIALSz, &nbsp; $drug_dosesz doses.</i><br/>";

                                        }
                                    }
                                    $counter_number++;
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


		 }
		 	# code...
		 }

		 }
	 }
 
                                        
         
    
								 
								
}

							 
						 

			?>




					 

			</div>
		</div>	  

			 


	<script type="text/javascript" src="../js/jquery-1.9.0.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>

	</body>
</HTML>