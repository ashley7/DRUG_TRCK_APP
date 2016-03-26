<!DOCTYPE HTML>
<?php
$charles_pin  =  "";
	include("function.php");

 


	if (!empty($_POST['password_track'])) {
		$pin = $_POST['password_track'];
		$strong_pin = hash("ripemd128", $pin);

		// check current pin
		$select = mysqli_query($con, "SELECT PIN FROM SECURITY limit 1");
		if ($select) {
			while ($counter = mysqli_fetch_assoc($select)) {
				$pin = $counter['PIN'];
				if ($strong_pin == $pin) {
					# code...
					$_SESSION['strong_pin'] = $strong_pin;
					header("location:admin.php");
					exit();
					  
				}
				else{
					$charles_pin = "Access Denied.";
				}
				# code...
			}
			# code...
		}

		# code...
	}

?>
<HTML lang = "en">
	<head>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">

	</head>
	<body>
			 <center class = "alert alert-info">THE DRUCK TRACK</center>

			<li class = "dropdown ">				
			  <a class="dropdown-toggle" 
			  data-toggle="dropdown" href="#"> 
			  	Welcome <span class="caret"></span>
			  </a>
			   <ul class = "dropdown-menu">
 			  <li><a href="#myModalsystem" data-toggle="modal">Admin start System</a></li> 					 
			  <li><a href="#myModal" data-toggle="modal">Sign up</a></li> 
			<li><a href="#myModallogin" data-toggle="modal">Login</a>
</li>
			    </ul>
			</li>
			<?php
if (isset($_SESSION['non'])) {
	echo $_SESSION['non'];
	# code...
}

			?>




			<div id="myModalsystem" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<a href="" class="close" data-dismiss="modal">
								&times
							</a>
						 
						</div>

						<div class="modal-body">

		<div class = "row">
			<div class = "col-md-3 col-lg-3">
			</div>
			<div class = "col-md-6 col-lg-6">

				<h3><center class = "alert alert-warning">Start system</center></h3>
				<form method = "POST" class = "alert alert-warning">
					Enter password:
					<input type = "password" name = "password_track" class = "form-control" required autofocus>
					<br/>
					<input type = "submit" class = "btn btn-primary btn-block" value = "Activate System">
					<br/><p class = "alert-index alert-danger"><?php echo $charles_pin?></p>
				</form>
			</div>
			<div class = "col-md-3 col-lg-3">
			</div>
		</div> 



 						</div>
 
					</div>
				</div>
			</div>



			<div id="myModal" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<a href="" class="close" data-dismiss="modal">
								&times
							</a>
 						</div>
						<div class="modal-body">

		 <div class = "row">
			<div class = "col-md-3 col-lg-3">
			</div>
			<div class = "col-md-6 col-lg-6">

				<h3><center class = "alert alert-warning">Activate account</center></h3>
				<form method = "POST" action = "register.php" class = "alert alert-warning">
					Enter your Number
					<input type = "text" name = "number_track" class = "form-control" required autofocus>
					<br/>
					Enter password:
					<input type = "password" name = "password_track" class = "form-control" required autofocus>
					<br/>
					Confirm password:
					<input type = "password" name = "comfirm_password_track" class = "form-control" required autofocus>
					<br/>
					<input type = "submit" class = "btn btn-primary btn-block" value = "Activate System">
					 
				</form>
			</div>
			<div class = "col-md-3 col-lg-3">
			</div>
		</div> 



 						</div>
						<div class="modal-footer">
 						</div>
					</div>
				</div>
			</div>


 			<div id="myModallogin" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<a href="" class="close" data-dismiss="modal">
								&times
							</a>
							 
						</div>
						<div class="modal-body">

		<div class = "row">
			<div class = "col-md-3 col-lg-3">
			</div>
			<div class = "col-md-6 col-lg-6">

				<h3><center class = "alert alert-warning">Login</center></h3>
				<form method = "POST" class = "alert alert-warning" action="login.php">
					Enter Your Number:
					<input type = "text" name = "number_track" class = "form-control" required autofocus>
					<br/>
					Enter password:
					<input type = "password" name = "password_track" class = "form-control" required autofocus>
					<br/>
					<input type = "submit" class = "btn btn-primary btn-block" value = "Activate System">
					<br/><p class = "alert-index alert-danger"> </p>
				</form>
			</div>
			<div class = "col-md-3 col-lg-3">
			</div>
		</div>




 						</div>
						<div class="modal-footer">
 						</div>
					</div>
				</div>
			</div>

		<script type="text/javascript" src="../js/jquery-1.9.0.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>

	</body>
</HTML>