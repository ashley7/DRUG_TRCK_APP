  <center>Seach Results</center>
<table class = "table table-hover"> 
<tr class = "danger">
    <TH>DRUG NAME</TH><th>AMOUNT</th><TH>DATE RECORDED</TH><th>SALER</th>
</tr>
<?php
 
$q = $_REQUEST["q"];

$hint = "";

include("function.php");
$get_values = mysqli_query($con, "SELECT * FROM drugs_out");
 

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
              
                $select = mysqli_query($con, "SELECT * FROM drugs_out,drugs WHERE drugs_out.BRANCH = '$name'
                AND  drugs_out.DRUG_NUMBER = drugs.DRUG_ID ORDER BY ID DESC");
                                if ($select ) {
                                    if (mysqli_num_rows($select) > 0) {
                                        # code...                                     
                                    while ($counter = mysqli_fetch_assoc($select)) {
                                        $drug_id = $counter['DRUG_NUMBER']; 
                                        // get drug names
                                         
                                         
                                                # code...
                                                $dug_name = $counter['DRUG_NAME'];

                                        $drug_doses = $counter['NUMBER_OF_DOSES'];
                                         $date_recorded = $counter['DATES_RECORDED'];
                                         $SALER_DETAIALS = $counter['SALER_DETAIALS'];
                                         $COST_DOSE = $counter['COST_DOSE'];
                                         $id = $counter['ID'];
                                         
                                        echo "<tr class = 'alert-index alert-warning'>
                                          <td>$dug_name</td>
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
                            else{
                                echo "<p class = 'text-danger'>No drugs saved.</p>";
                            }

                                    # code...
                                }
                                else
                                    echo mysqli_error($con);
                                
                                ?>


                
                 

                
              


 




                    



                
     <?php

            }
        }
    }
}
}
}?>
</table>
