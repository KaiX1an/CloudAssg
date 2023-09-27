<?php 
	session_start();
	include 'core/init.php';
?>

<?php 
	if(!isset($_SESSION['email'])){
      echo "<script>window.open('login.php','_self')</script>";
    }else{
        echo "<script>window.open('','_self')</script>";
    }
?>

<?php
	$email = $_SESSION['email'];
	$sql = "SELECT * FROM student WHERE email = '$email'";
    $result = $db->query($sql);
    while ($row_pro = mysqli_fetch_array($result)) {
          $cus_id = $row_pro['studentID'];
          $cus_name = $row_pro['name'];
          $cus_email = $row_pro['email'];
          $cus_course = $row_pro['course'];
    }
?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Assignment</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your emptom styles (optional) -->
  <link href="css/style.css" rel="stylesheet">  
</head>
<body>
	<nav class="mb-1 navbar navbar-expand-lg navbar-dark default-color">
      	<a class="navbar-brand" href="index.php"><?=$cus_name;?></a>
        <!-- Collapse button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
        aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      	</button>
	      <!-- Collapsible content -->
	      	<div class="collapse navbar-collapse" id="basicExampleNav">
	        <!-- Links -->
		        <ul class="navbar-nav mr-auto smooth-scroll">
          			<li class="nav-item">
            			<a class="nav-link" href="myaccount.php?change_password">Change Password</a>
          			</li>
          			<li class="nav-item">
            			<a class="nav-link" href="myaccount.php?delete_account">Delete Account</a>
          			</li>
		        </ul>
	    	</div>
		
	</nav>
	<?php 
			if (!isset($_GET['edit_account'])) {
				if(!isset($_GET['change_password'])){
					if(!isset($_GET['delete_account'])){
						echo 
						"
							<div class='card'>
								<div class='card-header'>
									<h3 class='h3-responsive p-2'>Hello $cus_name</h3>
								</div>
								<div class='card-body table-responsive'>
									<table class='table table-striped table-condensed' style='display: table'>
										
										<tr>
											<th style='width:15%;'><i class='fa fa-user prefix px-2'></i><b> Name: </b></th>
											<td>$cus_name</td>
										</tr>
										<tr>
											<th><i class='fa fa-envelope prefix px-2'></i><b>Email: </b></th>
											<td>$cus_email</td>
										</tr>
                                                                                <tr>
                                                                                        <th><i class='fa fa-book prefix px-2'></i><b>Course: </b></th>
                                                                                        <td>$cus_course</td>
                                                                                </tr>
                                                                                <tr>
                                                                                        <th><i class='fa fa-building prefix px-2'></i><b>Company Name: </b></th>
                                                                                        <td></td>
                                                                                </tr>
                                                                                <tr>
                                                                                        <th><i class='fa fa-location-arrow prefix px-2'></i><b>Company Location: </b></th>
                                                                                        <td></td>
                                                                                </tr>
                                                                                <tr>
                                                                                        <th><i class='fa fa-calendar prefix px-2'></i><b>Start Date: </b></th>
                                                                                        <td></td>
                                                                                </tr>
                                                                                <tr>
                                                                                        <th><i class='fa fa-calendar prefix px-2'></i><b>End Date: </b></th>
                                                                                        <td></td>
                                                                                </tr>
                                                                                <tr>
                                                                                        <th><i class='fa fa-address-card prefix px-2'></i><b>Supervisor Name: </b></th>
                                                                                        <td></td>
                                                                                </tr>
									</table>
								</div>
							</div>
						";
					}
				}
			}
		
	?>
	<?php
		if(isset($_GET['edit_account'])){
			include 'student/edit_account.php';
		}
		if(isset($_GET['change_password'])){
			include 'student/change_password.php';
		}
		if(isset($_GET['delete_account'])){
			include 'student/delete_account.php';
		}
	?>
</body>
</html>
<?php include 'includes/footer.php';?>
