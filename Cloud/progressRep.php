<?php 
  session_start();
  require_once 'core/init.php';
  include('includes/header.php');
?>

<?php 
    if(!isset($_SESSION['email'])){
        echo "<script>window.open('login.php','_self')</script>";
    }else{
        echo "<script>window.open('','_self')</script>";
    }
    
    $email = $_SESSION['email'];
                $sqlE = "SELECT * FROM student WHERE email = '$email'";
                $resultE = $db->query($sqlE);
                while ($row_pro = mysqli_fetch_array($resultE)) {
                      $fk_id = $row_pro['studentID'];
                }
    
    $sql = "SELECT * FROM progressreport WHERE studentID = '$fk_id'";
    $reports = $db->query($sql);
?>

<head>
    <link rel="stylesheet" href="scss/fileUpload.css">
</head>

<div class="container-fluid p-2">
	<div class="card">
		<div class="card-header">
			<h3 class="h3-responsive p-2 text-center">- - Submitted Progress Reports - -</h3>
		</div>
            
                <!-- List of Prog Reports -->
                <table class="table">
                    <tr>
                        <td width="15%" style="padding-left: 40px;">Report ID</td>
                        <td width="30%">Progress Report</td>
                        <td width="20%">Status</td>
                        <td width="17%">Marks</td>
                        <td width="18%">Submission Date</td>
                    </tr>
                <?php while($report = mysqli_fetch_assoc($reports)): ?>
                    <tr>
                        <td style="padding-left: 40px;"><?=$report['progressID'];?> </td>
                        <td><a href="<?php echo $report['progressReport'];?>" target="_blank" style="color:blue;text-decoration: underline;"><?php echo $report['progressReport'];?></a></td>
                        <td><?=$report['status'];?> </td>
                        <td><?=$report['marks'];?> </td>
                        <td><?=$report['submissionDate'];?> </td>
                    </tr>
                <?php endwhile;?>
               </table>
            
		<div class="card-body">
			<div class="container-fluid">
                            <form class="p-3 grey-text" method="post" action="" enctype="multipart/form-data">
                                
                                <br /><br />
                                <div class="divider">Submit your progress report here</div>
                                
                                
                                <div>
                                    <label for="progReport" class="form-label mb-0">Progress Report Submission</label>
                                    <div class="mb-3 md-form form-sm mt-1"> <i class="fa fa-chart-line prefix"></i>
                                        <input class="form-control" type="file" id="progReport" name="progReport" required>
                                    </div>
                                </div>
                                <div class="text-center mt-4">
                                    <button class="btn btn-default" type="submit" name="submit_progress">Submit Report<i class="fa fa-paper-plane-o ml-1"></i></button>
                                </div>				
                            </form>
			</div>
		</div>
	</div>
</div>

<?php 
    
    if(isset($_POST['submit_progress'])) {
        $sqlSelectProgReportID = "SELECT MAX(progressID) FROM progressreport";
        $selectProgReportID = $db->query($sqlSelectProgReportID);
        $row = $selectProgReportID->fetch_assoc();
        $maxID = $row['MAX(progressID)'];

        if ($maxID === null) {
            $id = "PRP001";
        } else {
            $numericPart = intval(substr($maxID, 3));
            $newIDNum = $numericPart + 1;
            $id = "PRP" . str_pad($newIDNum, 3, '0', STR_PAD_LEFT);
        }

        //get current student id for fk insert
        $email = $_SESSION['email'];
        $sql = "SELECT * FROM student WHERE email = '$email'";
        $result = $db->query($sql);
        while ($row_pro = mysqli_fetch_array($result)) {
              $fk_id = $row_pro['studentID'];
        }

        //get report variables from form
        $target_directory = 'uploads/';
        $target_file = $target_directory . basename($_FILES["progReport"]["name"]); 
        
        //get current date
        date_default_timezone_set('Singapore');
        $currentDateTime = new DateTime('now');
        $datetoday = $currentDateTime->format('Y-m-d');
        

        $uploadOk = 1;
        //get file type
        $target_file = $target_directory . basename($_FILES["progReport"]["name"]);
        $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


        // Allow certain file formats
        if($fileType != "pdf") {
          echo "<script>alert('Only PDF files are allowed. ')</script>";
          echo "<script>window.open('progressRep.php','_self')</script>";
          $uploadOk = 0;
        }


        if ($uploadOk == 0){
            echo "<script>alert('Your report was not uploaded. Please try again. ')</script>";
            echo "<script>window.open('progressRep.php','_self')</script>";
        }else{
            //upload if everything ok
            $insertProgress = "INSERT INTO progressreport (progressID, progressReport, marks, status, submissionDate, studentID) VALUES ('$id', '$target_file','','Pending', '$datetoday', '$fk_id')";
            $db->query($insertProgress);

            // Perform the database query
            if (move_uploaded_file($_FILES['progReport']['tmp_name'], $target_file)) {
                echo "Progress Report file has been uploaded successfully.<br>";
            } else {
                echo "Error moving the Indemnity Report file to the target directory.<br>";
            }

            //check whether report record insert
            $sel_rep = "SELECT * FROM progressreport WHERE progressID = '$id'";
            $run_rep = $db->query($sel_rep);
            $check_rep = mysqli_num_rows($run_rep);

            if($check_rep == 0){
                    $_SESSION['email'] = $email;

                    echo "<script>alert('Your report has not been submitted')</script>";
                    echo "<script>window.open('progressRep.php','_self')</script>";
            }else{
                    $_SESSION['email'] = $email;

                    echo "<script>alert('Your report has been submitted successfully')</script>";
                    echo "<script>window.open('index.php','_self')</script>";
            }
        }
    }
?>

<?php include 'supervisor/includes/footer.php'; ?>