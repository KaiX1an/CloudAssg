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
    activateLabel($('#fullname'), $('label[for="fullname"]'));
    activateLabel($('#email'), $('label[for="email"]'));
    activateLabel($('#password'), $('label[for="password"]'));
    activateLabel($('#course'), $('label[for="course"]'));
});
</script>

<div class="container-fluid p-3 col-md-9">
	<div class="card">
		<div class="card-header">
			<h3 class="h3-responsive p-2 text-center">Student Registration Form</h3>
		</div>
		<div class="card-body">
			<div class="container-fluid">
				<form class="p-3 grey-text" method="post" action="register.php">
					<div class="row">					
						<div class="col-md-12">
							<div class="md-form form-sm"> <i class="fa fa-user prefix"></i>
				              <input type="text" id="fullname" class="form-control form-control-sm" name="fullname" required>
				              <label for="fullname">Full Name</label>
				            </div>
				            <div class="md-form form-sm"> <i class="fa fa-envelope prefix"></i>
				              <input type="email" id="email" class="form-control form-control-sm" name="email" required>
				              <label for="email">Email</label>
				            </div>
				            <div class="md-form form-sm"> <i class="fa fa-lock prefix"></i>
				              <input type="password" id="password" class="form-control form-control-sm" name="password" required>
				              <label for="password">Password</label>
				            </div>
				            <div class="md-form form-sm"> <i class="fas fa-book prefix"></i>
				              <input type="text" id="course" class="form-control form-control-sm" name="course" required>
				              <label for="course">Course</label>
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
	$sqlSelectStudID = "SELECT MAX(studentID) FROM student";
        $selectStudID = $db->query($sqlSelectStudID);
        $row = $selectStudID->fetch_assoc();
        $maxID = $row['MAX(studentID)'];

        if ($maxID === null) {
            $id = "STD001";
        } else {
            $numericPart = intval(substr($maxID, 3));
            $newIDNum = $numericPart + 1;
            $id = "STD" . str_pad($newIDNum, 3, '0', STR_PAD_LEFT);
        }
		$fullname = sanitize($_POST['fullname']);
		$email = sanitize($_POST['email']);
		$password = sanitize($_POST['password']);
		$course = sanitize($_POST['course']);
                
		$insertStud = "INSERT INTO student (studentID, name, email, password, course) VALUES ('$id', '$fullname','$email','$password', '$course')";
		$db->query($insertStud);

		$sel_stud = "SELECT * FROM student WHERE studentID = '$id'";
		$run_stud = $db->query($sel_stud);
		$check_stud = mysqli_num_rows($run_stud);
		if($check_stud == 0){
			$_SESSION['email'] = $email;

			echo "<script>alert('Account has been created successfully')</script>";
			echo "<script>window.open('myaccount.php','_self')</script>";
		}else{
			$_SESSION['email'] = $email;

			echo "<script>alert('Account has been created successfully')</script>";
			echo "<script>window.open('index.php','_self')</script>";
		}
	}
?>

<?php include('includes/footer.php'); ?>