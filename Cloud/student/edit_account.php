<?php 
	include('core/init.php');
?>
<?php
	$email = $_SESSION['email'];
	$sql = "SELECT * FROM student WHERE email = '$email'";
    $result = $db->query($sql);
    while ($row_pro = mysqli_fetch_array($result)) {
          $cus_id = $row_pro['studentID'];
          $cus_name = $row_pro['name'];
          $cus_email = $row_pro['email'];
    }
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="container-fluid p-2">
	<div class="card">
		<div class="card-header">
			<h3 class="h3-responsive p-2 text-center">Edit Account</h3>
		</div>
		<div class="card-body">
			<div class="container-fluid">
				<form class="p-3 grey-text" method="post" action="" enctype="multipart/form-data">
					<div class="row">					
						<div class="col-md-6">
							<div class="md-form form-sm"> <i class="fa fa-user prefix"></i>
				              <input type="text" id="fullname" class="form-control form-control-sm" name="fullname" value="<?php echo $cus_name;?>">
				              <label for="fullname">Full Name</label>
				            </div>
                                                    <div class="md-form form-sm"><i class="fa fa-book prefix"></i>
                                                        <input type="text" id="course" class="form-control form-control-sm" name="course" value="<?php echo $cus_course;?>">
                                                        <label for="course">Course</label>
                                                    </div>
						</div>
                                            <div class="col-md-6">
                                                <div class="md-form form-sm"> <i class="fa fa-envelope prefix"></i>
				              <input type="email" id="email" class="form-control form-control-sm" name="email" value="<?php echo $cus_email;?>">
				              <label for="email">Email</label>
				            </div>
                                            </div>
						<div class="text-center mt-4">
			              	<button class="btn btn-default" type="submit" name="update">Update <i class="fa fa-paper-plane-o ml-1"></i></button>
			            </div>					
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function() {
    // Function to handle label behavior for input fields
    function handleLabel(inputField) {
        // Check if the input has a value
        if (inputField.val() !== '') {
            // If it has a value, add a class to move the label up
            inputField.siblings('label').addClass('active');
        }
    }

    handleLabel($('#fullname'));
    handleLabel($('#email'));
    handleLabel($('#course'));
});
</script>
<?php
	if(isset($_POST['update'])){
		$ip = getIp();
		$customer_id = $cus_id;
		$fullname = $_POST['fullname'];
		$email = $_POST['email'];
		$address1 = $_POST['address1'];
		$address2 = $_POST['address2'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$zipcode = $_POST['zipcode'];
		$phone = $_POST['phone'];
		$country = $_POST['country'];

		$updateCus = "UPDATE customers SET fullname = '$fullname', email = '$email', address1 = '$address1', address2 = '$address2', city = '$city', state = '$state', zipcode = '$zipcode', phone = '$phone', country = '$country' WHERE id = '$customer_id'";
		$run_query = $db->query($updateCus);
		if($run_query){
			echo "<script>alert('Your account has been successfully updated')</script>";
			echo "<script>window.open('myaccount.php','_self')</script>";
		}
	}
?>