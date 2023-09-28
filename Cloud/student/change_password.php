<?php 
	include('core/init.php');
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    activateLabel($('#current'), $('label[for="current"]'));
    activateLabel($('#new'), $('label[for="new"]'));
    activateLabel($('#confirm'), $('label[for="confirm"]'));
});
</script>

<div class="container-fluid p-2" style="height: 150%;">
	<div class="card">
		<div class="card-header">
			<h3 class="h3-responsive p-2 text-center">Change Your Password</h3>
		</div>
		<div class="card-body">
			<div class="container-fluid">
				<form class="p-3 grey-text" method="post" action="" enctype="multipart/form-data">
					<div class="md-form form-sm"> <i class="fa fa-lock prefix"></i>
		              	<input type="password" id="current" class="form-control form-control-sm" name="current" required>
		              	<label for="current">Current Password</label>
		            </div>
		            <div class="md-form form-sm"> <i class="fa fa-lock prefix"></i>
		              	<input type="password" id="new" class="form-control form-control-sm" name="new" required>
		              	<label for="new">New Password</label>
		            </div>
		            <div class="md-form form-sm"> <i class="fa fa-lock prefix"></i>
		              	<input type="password" id="confirm" class="form-control form-control-sm" name="confirm" required>
		              	<label for="confirm">Confirm Password</label>
		            </div>
		            <div class="text-center mt-4">
		              	<button class="btn btn-default" type="submit" name="update_password">Change Password <i class="fa fa-paper-plane-o ml-1"></i></button>
			        </div>					
				</form>
			</div>
		</div>
	</div>
</div>
<?php
	
	$email = $_SESSION['email'];
	if(isset($_POST['update_password'])){
		$current_password = $_POST['current'];
		$new_password = $_POST['new'];
		$confirm_password = $_POST['confirm'];

		$sqlPass = "SELECT * FROM student WHERE password = '$current_password' AND email = '$email'";
		$runPass = $db->query($sqlPass);
		$checkPass = mysqli_num_rows($runPass);
		if($checkPass == 0){
			echo "<script>alert('Your current password is wrong')</script>";
			exit();
		}
		if($confirm_password != $new_password){
			echo "<script>alert('Your password does not match')</script>";
			exit();
		}
		else{
			$updatePassword = "UPDATE student SET password = '$new_password' WHERE email = '$email'";
			$runUpdate = $db->query($updatePassword);
			echo "<script>alert('Your password has been updated successfully!')</script>";
			echo "<script>window.open('myaccount.php','_self')</script>";
		}
	}
?>
