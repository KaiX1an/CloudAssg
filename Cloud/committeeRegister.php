<?php 
	session_start();
	include('core/init.php');
	include('includes/header.php');

?>

<div class="container-fluid p-3 col-md-9">
	<div class="card">
		<div class="card-header">
			<h3 class="h3-responsive p-2 text-center">Committee Registration Form</h3>
		</div>
		<div class="card-body">
			<div class="container-fluid">
				<form class="p-3 grey-text" method="post" action="committeeRegister.php">
					<div class="row">					
						<div class="col-md-12">
							<div class="md-form form-sm"> <i class="fa fa-user prefix"></i>
				              <input type="text" id="committeeFullname" class="form-control form-control-sm" name="committeeFullname">
				              <label for="committeeFullname">Full Name</label>
				            </div>
				            <div class="md-form form-sm"> <i class="fa fa-envelope prefix"></i>
				              <input type="email" id="committeeEmail" class="form-control form-control-sm" name="committeeEmail">
				              <label for="committeeEmail">Email</label>
				            </div>
				            <div class="md-form form-sm"> <i class="fa fa-lock prefix"></i>
				              <input type="password" id="committeePassword" class="form-control form-control-sm" name="committeePassword">
				              <label for="committeePassword">Password</label>
				            </div>
						</div>
						<div class="text-center mt-4">
			              	<button class="btn btn-default" type="submit" name="submit">Submit <i class="fa fa-paper-plane-o ml-1"></i></button>
			            </div>					
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php
	if(isset($_POST['submit'])){
	$sqlSelectCommID = "SELECT MAX(committeeID) FROM committee";
        $selectCommID = $db->query($sqlSelectCommID);
        $row = $selectCommID->fetch_assoc();
        $maxID = $row['MAX(committeeID)'];

        if ($maxID === null) {
            $committeeId = "COM001";
        } else {
            $numericPart = intval(substr($maxID, 3));
            $newIDNum = $numericPart + 1;
            $committeeId = "COM" . str_pad($newIDNum, 3, '0', STR_PAD_LEFT);
        }
		$committeeFullname = sanitize($_POST['committeeFullname']);
		$committeeEmail = sanitize($_POST['committeeEmail']);
		$committeePassword = sanitize($_POST['committeePassword']);
                
		$insertCommittee = "INSERT INTO committee (committeeID, name, email, password) VALUES ('$committeeId', '$committeeFullname','$committeeEmail','$committeePassword')";
		$db->query($insertCommittee);

		$sel_committee = "SELECT * FROM committee WHERE committeeID = '$committeeId'";
		$run_committee = $db->query($sel_committee);
		$check_committee = mysqli_num_rows($run_committee);
		if($check_committee == 0){
			$_SESSION['committeeEmail'] = $committeeEmail;

			echo "<script>alert('Account has been created successfully')</script>";
			echo "<script>window.open('myaccount.php','_self')</script>";
		}else{
			$_SESSION['committeeEmail'] = $committeeEmail;

			echo "<script>alert('Account has been created successfully')</script>";
			echo "<script>window.open('committee/home.php','_self')</script>";
		}
	}
?>

<?php include('includes/footer.php'); ?>