<?php
include("function.php");
 
    $Today = date('y:m:d');
    $new = date('d F, Y', strtotime($Today));
    echo $new;

    $cteate_table = mysqli_query($con, "CREATE TABLE drugs(DRUG_ID 
    	INT(11) NOT NULL AUTO_INCREMENT, PRIMARY KEY(DRUG_ID), DRUG_NAME  
    	TEXT(255) NOT NULL, DESCRIPTION TEXT(500),
    	DRUG_DOSES TEXT(11) NOT NULL,DATE_RECORDED TEXT(100), 
    	EXPIRY_DATE TEXT(100) NOT NULL,COSTPAR_DOSE DOUBLE(65,2) NOT NULL,
    	BRANCH TEXT(25) NOT NULL REFERENCES branches(B_NUMBER))");

    

                         
if (!empty($_POST['b_name'])) {
	if (!empty($_POST['numdoses'])) {
		if (!empty($_POST['t_o_p'])) {
			$d_name = $_POST['b_name'];
			$dose_number = $_POST['numdoses'];
			$ext_date = $_POST['t_o_p'];
			$cost = $_POST['cost'];
			$desc_drug = $_POST['desc_doses'];
			$branch = $_POST['branch'];
			  $save = mysqli_query($con, "INSERT INTO drugs(DRUG_NAME,DRUG_DOSES,DATE_RECORDED,
    	EXPIRY_DATE,COSTPAR_DOSE,BRANCH,DESCRIPTION )VALUES('$d_name','$dose_number','$new',
    	'$ext_date','$cost','$branch','$desc_drug')");
			  if ($save) {
			  	$_SESSION['save'] = "Drug saved successifully!!!";
			  	# code...
			  }
			  else{

			  } 
		}
		# code...
	}
	# code...
}
header("location:admin.php");
?>