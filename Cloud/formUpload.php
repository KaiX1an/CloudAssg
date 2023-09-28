<html>
    <body>

        <?php 
            session_start();
            include 'includes/header.php';
            include 'core/init.php';

            // Define the target directory where you want to move the uploaded file
            $target_directory = 'uploads/'; // Change this to your desired directory

            // Check if the form was submitted
            if(isset($_POST['submit_indemnity'])) {
                //for insert report
                $sqlSelectStudReportID = "SELECT MAX(reportID) FROM studentreport";
                $selectStudReportID = $db->query($sqlSelectStudReportID);
                $row = $selectStudReportID->fetch_assoc();
                $maxID = $row['MAX(reportID)'];

                if ($maxID === null) {
                    $id = "SRP001";
                } else {
                    $numericPart = intval(substr($maxID, 3));
                    $newIDNum = $numericPart + 1;
                    $id = "SRP" . str_pad($newIDNum, 3, '0', STR_PAD_LEFT);
                }
                
                //for insert internship
                $sqlSelectInternshipID = "SELECT MAX(internshipID) FROM internship";
                $selectInternshipID = $db->query($sqlSelectInternshipID);
                $row1 = $selectInternshipID->fetch_assoc();
                $maxID1 = $row1['MAX(internshipID)'];

                if ($maxID1 === null) {
                    $id1 = "ITP001";
                } else {
                    $numericPart = intval(substr($maxID1, 3));
                    $newIDNum = $numericPart + 1;
                    $id1 = "ITP" . str_pad($newIDNum, 3, '0', STR_PAD_LEFT);
                }

                //get current student id for fk insert
                $email = $_SESSION['email'];
                $sql = "SELECT * FROM student WHERE email = '$email'";
                $result = $db->query($sql);
                while ($row_pro = mysqli_fetch_array($result)) {
                      $fk_id = $row_pro['studentID'];
                }
                
                //get internship variables from form
                $company_name = sanitize($_POST['companyname']);
                $location = sanitize($_POST['location']);
                $start_date = sanitize($_POST['startdate']);
                $end_date = sanitize($_POST['enddate']);
                
                //internship validation
                date_default_timezone_set('Singapore');
                $currentDateTime = new DateTime('now');
                $datetoday = $currentDateTime->format('Y-m-d');
                if($start_date < $datetoday){
                    echo "<script>alert('The start date cannot be before the current date')</script>";
                    echo "<script>window.open('indemnityLetter.php','_self')</script>";
                }
                if($end_date <= $start_date){
                    echo "<script>alert('Start date must not be later than end date')</script>";
                    echo "<script>window.open('indemnityLetter.php','_self')</script>";
                }
                
                $uploadOk = 1;
                //get file type
                $target_file1 = $target_directory . basename($_FILES["indemnityletter"]["name"]);
                $target_file2 = $target_directory . basename($_FILES["companyletter"]["name"]);
                $target_file3 = $target_directory . basename($_FILES["parentform"]["name"]);
                $fileType1 = strtolower(pathinfo($target_file1,PATHINFO_EXTENSION));
                $fileType2 = strtolower(pathinfo($target_file2,PATHINFO_EXTENSION));
                $fileType3 = strtolower(pathinfo($target_file3,PATHINFO_EXTENSION));
                
                
                // Allow pdf file format only
                if($fileType1 != "pdf" || $fileType2 != "pdf" || $fileType3 != "pdf") {
                  echo "<script>alert('Only PDF files are allowed. ')</script>";
                  echo "<script>window.open('indemnityLetter.php','_self')</script>";
                  $uploadOk = 0;
                }

                // Check if file already exists
/*                if (file_exists($target_file1) || file_exists($target_file2) || file_exists($target_file3)) {
                  echo "<script>alert('This file already exists. Please rename. ')</script>";
                  $uploadOk = 0;
                  }
 */
                
                if ($uploadOk == 0){
                    echo "<script>alert('Your files were not uploaded. Please try again. ')</script>";
                    echo "<script>window.open('indemnityLetter.php','_self')</script>";
                }else{
                    //upload if everything ok
                    $uploadMainTo = null;
                    if(isset($_FILES['indemnityletter'])){
                      $main_image_name = $_FILES['indemnityletter']['name'];
                      $main_image_size = $_FILES['indemnityletter']['size'];
                      $main_image_tmp = $_FILES['indemnityletter']['tmp_name'];
                      $uploadMainTo = $target_directory.$main_image_name;
                      $moveMain = move_uploaded_file($main_image_tmp,$uploadMainTo);
                    }

                    $uploadSecondTo = null;
                    if(isset($_FILES['companyletter'])){
                      $second_image_name = $_FILES['companyletter']['name'];
                      $second_image_size = $_FILES['companyletter']['size'];
                      $second_image_tmp = $_FILES['companyletter']['tmp_name'];
                      $uploadSecondTo = $target_directory.$second_image_name;
                      $moveSecond = move_uploaded_file($second_image_tmp,$uploadSecondTo);
                    }

                    $uploadThirdTo = null;
                    if(isset($_FILES['parentform'])){
                      $third_image_name = $_FILES['parentform']['name'];
                      $third_image_size = $_FILES['parentform']['size'];
                      $third_image_tmp = $_FILES['parentform']['tmp_name'];
                      $uploadThirdTo = $target_directory.$third_image_name;
                      $moveThird = move_uploaded_file($third_image_tmp,$uploadThirdTo);
                    }
                    
                    //check if record belonging to stud already exists
                    $sel_exist = "SELECT * FROM studentreport WHERE studentID = '$fk_id'";
                    $run_exist = $db->query($sel_exist);
                    $num_rowsExist = mysqli_num_rows($run_exist);
                    if ($num_rowsExist > 0) {
                        // update if existing
                        $insertStudentReport = "UPDATE studentreport SET `indemnityReport`='$uploadMainTo',`companyAccLetter`='$uploadSecondTo',`parentAck`='$uploadThirdTo',`status`='Pending Approval' "
                                . "WHERE studentID = '$fk_id'";
                    }
                    else {
                        //add if no records
                        $insertStudentReport = "INSERT INTO studentreport (reportID, indemnityReport, companyAccLetter, parentAck, status, studentID) 
                        VALUES ('$id', '$uploadMainTo', '$uploadSecondTo', '$uploadThirdTo', 'Pending Approval', '$fk_id')";
                    }
                    
                    
                    //check if record belonging to stud already exists
                    $sel_existex = "SELECT * FROM studentreport WHERE studentID = '$fk_id'";
                    $run_existex = $db->query($sel_existex);
                    $num_rowsExistex = mysqli_num_rows($run_existex);
                    if ($num_rowsExistex > 0) {
                        // update if existing
                        $insertInternship = "UPDATE internship SET `companyName`='$company_name',`location`='$location',`startDate`='$start_date',`endDate`='$end_date',`status`='Pending' WHERE studentID = '$fk_id'";
                    }
                    else {
                        //add if no records
                        $insertInternship = "INSERT INTO internship (internshipID, companyName, location, startDate, endDate, status, studentID) VALUES ('$id1', '$company_name','$location','$start_date', '$end_date', 'Pending', '$fk_id')";
                    }
                    
                    
                    //insert report and internship tgt
                    /*$db->query($insertStudentReport);
                    $db->query($insertInternship);
                    
                    //check whether report record insert
                    $sel_rep = "SELECT * FROM studentreport WHERE reportID = '$id'";
                    $run_rep = $db->query($sel_rep);
                    $check_rep = mysqli_num_rows($run_rep);
                    
                    //check whether intern record insert
                    $sel_intern = "SELECT * FROM internship WHERE internshipID = '$id1'";
                    $run_intern = $db->query($sel_intern);
                    $check_intern = mysqli_num_rows($run_intern);*/
                    //if($check_rep == 0 || $check_intern == 0){
                    if($db->query($insertStudentReport) && $db->query($insertInternship)){
                            $_SESSION['email'] = $email;

                            echo "<script>alert('Details have been submitted successfully')</script>";
                            echo "<script>window.open('index.php','_self')</script>";
                    }else{
                            $_SESSION['email'] = $email;

                            echo "<script>alert('Your details have not been submitted')</script>";
                            echo "<script>window.open('indemnityLetter.php','_self')</script>";
                    }
                }
            }
        ?>
    </body>
</html>
