
          <center>Seach Results</center>
<table class = "table"> 
<tr class = "danger">
    <th>DRUG ID</th><TH>DRUG NAME</TH><th>DESCRIPTION</th><th>AMOUNT</th><TH>DOSES</TH><TH>DATE RECORDED</TH>
</tr>
<?php
 
$q = $_REQUEST["q"];

$hint = "";

include("function.php");
$get_values = mysqli_query($con, "SELECT * FROM drugs");
 

    if ($get_values) {
        while ( $a = mysqli_fetch_array($get_values)) {
            # code...
  if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    $counter = 0;
    foreach($a as $name) {
        if (stristr($q, substr($name, 0, $len))) {
            if ($hint === "") {
                $hint = $name;
            } else {
                $hint .= ", $name";
                 

       
     $number = $_SESSION['e_num'];   
     $bra_num = $_SESSION['banch'];
     $Today = date('y:m:d');
     $new = date('d F, Y', strtotime($Today));
                       

    $select = mysqli_query($con, "SELECT *FROM drugs WHERE BRANCH = '$bra_num' 
        AND DRUG_NAME = '$name'");
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
                           

            }
        }
    }
}
}
}
?>
</table>
