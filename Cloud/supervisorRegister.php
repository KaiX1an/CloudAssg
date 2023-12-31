<?php 
	session_start();
	include('core/init.php');
	include('includes/header.php');

?>

<script>
function activateLabel(inputElement, labelElement) {
    // Detect when the input field is focused
    inputElement.focus(function() {
        // Add the 'active' class to the label
        labelElement.addClass('active');
    });

    // Detect when the input field loses focus
    inputElement.blur(function() {
        // Check if the input field is empty
        if ($(this).val() === '') {
            // Remove the 'active' class from the label
            labelElement.removeClass('active');
        }
    });

    // Check on page load if the input field has content
    if (inputElement.val() !== '') {
        // Add the 'active' class to the label
        labelElement.addClass('active');
    }
}

$(document).ready(function() {
    // Use the activateLabel function for specific inputs and labels
    activateLabel($('#supervisorFullname'), $('label[for="supervisorFullname"]'));
    activateLabel($('#supervisorEmail'), $('label[for="supervisorEmail"]'));
    activateLabel($('#supervisorPassword'), $('label[for="supervisorPassword"]'));
    activateLabel($('#position'), $('label[for="position"]'));
    activateLabel($('#department'), $('label[for="department"]'));
});
</script>

<div class="container-fluid p-3 col-md-9">
	<div class="card">
		<div class="card-header">
			<h3 class="h3-responsive p-2 text-center">Supervisor Registration Form</h3>
		</div>
		<div class="card-body">
			<div class="container-fluid">
				<form class="p-3 grey-text" method="post" action="supervisorRegister.php">
					<div class="row">					
						<div class="col-md-12">
							<div class="md-form form-sm"> <i class="fa fa-user prefix"></i>
				              <input type="text" id="supervisorFullname" class="form-control form-control-sm" name="supervisorFullname" required>
				              <label for="supervisorFullname">Full Name</label>
				            </div>
				            <div class="md-form form-sm"> <i class="fa fa-envelope prefix"></i>
				              <input type="email" id="supervisorEmail" class="form-control form-control-sm" name="supervisorEmail" required>
				              <label for="supervisorEmail">Email</label>
				            </div>
				            <div class="md-form form-sm"> <i class="fa fa-lock prefix"></i>
				              <input type="password" id="supervisorPassword" class="form-control form-control-sm" name="supervisorPassword" required>
				              <label for="supervisorPassword">Password</label>
				            </div>
				            <div class="md-form form-sm"> <i class="fas fa-id-badge prefix"></i>
				              <input type="text" id="position" class="form-control form-control-sm" name="position" required>
				              <label for="position">Position</label>
				            </div>
                                            <div class="md-form form-sm"> <i class="fas fa-building prefix"></i>
				              <input type="text" id="department" class="form-control form-control-sm" name="department" required>
				              <label for="department">Department</label>
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
	$sqlSelectSupervisorID = "SELECT MAX(supervisorID) FROM supervisor";
        $selectSupervisorID = $db->query($sqlSelectSupervisorID);
        $row = $selectSupervisorID->fetch_assoc();
        $maxID = $row['MAX(supervisorID)'];

        if ($maxID === null) {
            $supervisorId = "SPV001";
        } else {
            $numericPart = intval(substr($maxID, 3));
            $newIDNum = $numericPart + 1;
            $supervisorId = "SPV" . str_pad($newIDNum, 3, '0', STR_PAD_LEFT);
        }
		$supervisorFullname = sanitize($_POST['supervisorFullname']);
		$supervisorEmail = sanitize($_POST['supervisorEmail']);
		$supervisorPassword = sanitize($_POST['supervisorPassword']);
		$position = sanitize($_POST['position']);
                $department = sanitize($_POST['department']);
                
		$insertSupervisor = "INSERT INTO supervisor (supervisorID, name, email, password, position, department) VALUES ('$supervisorId', '$supervisorFullname','$supervisorEmail','$supervisorPassword', '$position', '$department')";
		$db->query($insertSupervisor);

		$sel_supervisor = "SELECT * FROM supervisor WHERE supervisorID = '$supervisorId'";
		$run_supervisor = $db->query($sel_supervisor);
		$check_supervisor = mysqli_num_rows($run_supervisor);
		if($check_supervisor == 0){
			$_SESSION['supervisorEmail'] = $supervisorEmail;

			echo "<script>alert('Account has been created successfully')</script>";
			echo "<script>window.open('supervisor/myaccount.php','_self')</script>";
		}else{
			$_SESSION['supervisorEmail'] = $supervisorEmail;

			echo "<script>alert('Account has been created successfully')</script>";
			echo "<script>window.open('supervisor/studentList.php','_self')</script>";
		}
	}
?>

<?php include('includes/footer.php'); ?>