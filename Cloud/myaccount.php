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
    $check_customer = mysqli_num_rows($result);
    if($check_customer == 0){
            $cus_id = '-';
          $cus_name = '-';
          $cus_email = '-';
          $cus_course = '-';
    }			
    if($check_customer > 0){
             while ($row_pro = mysqli_fetch_array($result)) {
          $cus_id = $row_pro['studentID'];
          $cus_name = $row_pro['name'];
          $cus_email = $row_pro['email'];
          $cus_course = $row_pro['course'];
    }
    }
   
    $sql2 = "SELECT * FROM student WHERE email = '$email'";
    $result2 = $db->query($sql2);
    $check_customer2 = mysqli_num_rows($result2);
    if($check_customer2 == 0){
          $internStudID = '-';
            $intern_supervisor = '-';
    }			
    if($check_customer2 > 0){
          while($row_pro = mysqli_fetch_array($result2)){
            $internStudID = $row_pro['studentID'];
            $intern_supervisor = $row_pro['supervisorID'];
            }
    }
                
    $sql4 = "SELECT * FROM supervisor WHERE supervisorID = '$intern_supervisor'";
    $result4 = $db->query($sql4);
    $check_customer4 = mysqli_num_rows($result4);
    if($check_customer4 == 0){
          $supervisor_name = '-';
    }			
    if($check_customer4 > 0){
          while($row_pro = mysqli_fetch_array($result4)){
        $supervisor_name = $row_pro['name'];
    }
    }
    
    
    $sql3 = "SELECT * FROM internship WHERE studentID = '$internStudID'";
    $result3 = $db->query($sql3);
    $check_customer3 = mysqli_num_rows($result3);
    if($check_customer3 == 0){
           $intern_id = '-';
          $intern_name = '-';
          $intern_location = '-';
          $intern_startDate = '-';
          $intern_endDate = '-';
          $intern_status = '-';
    }			
    if($check_customer3 > 0){
        while ($row_pro = mysqli_fetch_array($result3)) {
          $intern_id = $row_pro['internshipID'];
          $intern_name = $row_pro['companyName'];
          $intern_location = $row_pro['location'];
          $intern_startDate = $row_pro['startDate'];
          $intern_endDate = $row_pro['endDate'];
          $intern_status = $row_pro['status'];
    }
    }
    
    $sql5 = "SELECT * FROM studentreport WHERE studentID = '$internStudID'";
    $result5 = $db->query($sql5);
    $check_customer5 = mysqli_num_rows($result5);
    
    while ($row_pro = mysqli_fetch_array($result5)) {
          $studentreportid = $row_pro['reportID'];
          $studentreportindem = $row_pro['indemnityReport'];
          $studentreportcom = $row_pro['companyAccLetter'];
          $studentreportparent = $row_pro['parentAck'];
          $studentreportstatus = $row_pro['status'];
          $studentreportstudid = $row_pro['studentID'];
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
      	<a class="navbar-brand" href="indemnityLetter.php"><?=$cus_name;?></a>
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
                                                                    <div class='card-header'>
                                                                        <h3 class='h3-responsive p-2 mb-1'>Personal Information</h3>
                                                                    </div>
									<table class='table table-striped table-condensed' style='display: table'>
										
										<tr>
											<th style='width:20%;'><i class='fa fa-user prefix px-2'></i><b> Name: </b></th>
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
                                                                                        <td>$intern_name</td>
                                                                                </tr>
                                                                                <tr>
                                                                                        <th><i class='fa fa-location-arrow prefix px-2'></i><b>Company Location: </b></th>
                                                                                        <td>$intern_location</td>
                                                                                </tr>
                                                                                <tr>
                                                                                        <th><i class='fa fa-calendar prefix px-2'></i><b>Start Date: </b></th>
                                                                                        <td>$intern_startDate</td>
                                                                                </tr>
                                                                                <tr>
                                                                                        <th><i class='fa fa-calendar prefix px-2'></i><b>End Date: </b></th>
                                                                                        <td>$intern_endDate</td>
                                                                                </tr>
                                                                                <tr>
                                                                                        <th><i class='fa fa-address-card prefix px-2'></i><b>Supervisor Name: </b></th>
                                                                                        <td>$supervisor_name</td>
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
    
    <div class='card'>
       <div class='card-body table-responsive'>
           <div class='card-header'>
               <div class="row">
                    <h3 class='h3-responsive p-2 mb-1 ml-4'>Internship Documents</h3>
                    <div style="float: right;" class="text-right">
                        <h6 class='p-2 mb-1'>(<?php echo $intern_status;?>)</h6>
                    </div>
               </div>
           </div>
           <table class='table table-striped table-condensed' style='display: table'>
               <tr>
                   <th style='width:30%;'><i class='fa fa-address-book prefix px-2'></i><b>Indemnity Letter: </b></th>
                   <td><a href="../<?php echo $studentreportindem;?>" target="_blank" style="color:blue;text-decoration: underline;">View Indemnity Letter</a></td>
               </tr>
               <tr>
                   <th><i class='fa fa-pen-nib prefix px-2'></i><b>Company Acceptance Letter: </b></th>
                   <td><a href="../<?php echo $studentreportcom;?>" target="_blank" style="color:blue;text-decoration: underline;">View Company Acceptance Letter</a></td>
               </tr>
               <tr>
                   <th><i class='fa fa-file prefix px-2'></i><b>Parents Acknowledgement Form: </b></th>
                   <td><a href="../<?php echo $studentreportparent;?>" target="_blank" style="color:blue;text-decoration: underline;">View Parents Acknowledgement Form</a></td>
               </tr>
           </table>
       </div>
    </div>
    
</body>
</html>
<?php include 'includes/footer.php';?>
