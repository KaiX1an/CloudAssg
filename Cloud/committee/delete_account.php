<?php 
	include('../core/init.php');
?>
<div class="container-fluid p-2">
	<div class="card">
		<div class="card-header">
			<h3 class="h3-responsive p-2 text-center">Delete Account?</h3>
		</div>
		<div class="card-body">
			<div class="container-fluid">
				<div class="">
					<p class="lead text-center">Do you really want to delete your account
				</div>
				<form class="p-3 grey-text" method="post" action="" enctype="multipart/form-data">
					<div class="text-center mt-4 float-left">
		              	<button class="btn btn-danger" type="submit" name="yes" style="background: #607d8b">Yes, I do</button>
			        </div>
			        <div class="text-center mt-4 float-right">
		              	<button class="btn btn-success" type="submit" name="no" style="background: #607d8b">No, I don't</button>
			        </div>	
				</form>
			</div>
		</div>
	</div>
</div>
<?php
	$committeeEemail = $_SESSION['committeeEmail'];
	if(isset($_POST['yes'])){
		$delete_committee = "DELETE FROM committee WHERE email = '$committeeEmail'";
		$run_delete = $db->query($delete_committee);
		echo "<script>alert('Your account has been deleted successfully!')</script>";
		echo "<script>window.open('../index.php', '_self')</script>";
                session_destroy();
	}
	if(isset($_POST['no'])){
		echo "<script>alert('We are glad you are with us!')</script>";
		echo "<script>window.open('myaccount.php', '_self')</script>";
	}
        
?>