<?php 
	session_start();
	include 'includes/header.php';
	include 'core/init.php';
?>
<div class="container p-3">
	<div class="card">
		<div class="card-header">
			<h3 class="p-2 h3-responsive">Supervisor Login</h3>
		</div>
		<form action="" method="post">
			<div class="card-body">
				<div class="md-form form-sm">
					<input type="text" id="supervisorEmail" class="form-control form-control-sm" name="supervisorEmail" required>
					<label for="supervisorEmail">Email</label>
				</div>
				<div class="md-form form-sm">
					<input type="password" id="supervisorPassword" class="form-control form-control-sm" name="supervisorPassword" required>
					<label for="supervisorPassword">Password</label>
				</div>
				<div class="p-3">
					<div class="float-left">
						<p class="">Forgot your password? <a href="checkout.php?forgot_pass">Click here</a></p>
					</div>
					<div class="float-right">
						<p class="">Don't have an account? <a href="supervisorRegister.php">Register now</a></p>
					</div>
				</div>
			</div>			
			<div class="card-footer">
				<div class="float-right">
					<button type="submit" name="login" class="btn btn-black" style="border-radius: 10em;background: #1c2a48">Login</button>
				</div>
			</div>
		</form>
		<?php 
			if(isset($_POST['login'])){
				$supervisorEmail = $_POST['supervisorEmail'];
				$supervisorPassword = $_POST['supervisorPassword'];

				$sql = "SELECT * FROM supervisor WHERE password = '$supervisorPassword' AND Email = '$supervisorEmail'";
				$runSql = $db->query($sql);
				$check_supervisor = mysqli_num_rows($runSql);
				if($check_supervisor == 0){
					echo "<script>alert('Your password or email is incorrect, please try again!')</script>";
					exit();
				}			
				if($check_supervisor > 0){
					$_SESSION['supervisorEmail'] = $supervisorEmail;
                                        while($id = mysqli_fetch_assoc($runSql)):
                                    $_SESSION['supervisorID'] = $id['supervisorID'];
                                endwhile;
					echo "<script>alert('You logged in successfully!')</script>";
					echo "<script>window.open('supervisor/studentList.php','_self')</script>";
				}else{
					$_SESSION['supervisorEmail'] = $supervisorEmail;
					echo "<script>alert('You logged in successfully!')</script>";
					echo "<script>window.open('cart.php','_self')</script>";
				}
			}
		?>
	</div>
</div>

<?php
	include 'includes/footer.php';
?>