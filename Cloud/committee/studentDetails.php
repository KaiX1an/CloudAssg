<?php 
  session_start();
  require_once '../core/init.php';
  include('includes/header.php');
?>

<?php 
  $retStudentID = $_GET['studID'];
  $sql = "SELECT * FROM student WHERE studentID = '$retStudentID'";
    $students = $db->query($sql);
?>
  
    <main>
        <h3 class="text-center p-3">Student Details</h3>
        <div class="m-4 border shadow-sm" width="100%">
          <table class="table">
                <tr>
                    <td width="15%" style="font-weight: bold">Student ID</td>
                    <td width="20%" style="font-weight: bold">Student Name</td>
                    <td width="20%" style="font-weight: bold">Student Email</td>
                    <td width="20%" style="font-weight: bold">Course</td>
                </tr
     
                <?php while($student = mysqli_fetch_assoc($students)): ?>
                    <tr>
                        <td><?=$student['studentID'];?> </td>
                        <td><?=$student['name'];?> </td>
                        <td><?=$student['email'];?> </td>
                        <td><?=$student['course'];?> </td>
                    </tr>
                <?php endwhile;?>
              
         </table>
        </div>
        <br>
        
<?php 
  $sql2 = "SELECT supervisor.*
FROM student, supervisor
WHERE student.supervisorID = supervisor.supervisorID AND student.studentID = '$retStudentID'";
    $sups = $db->query($sql2);
?>
        
        <h4 class="text-center pt-3 pb-0">Supervisor Details</h3>
        <div class="m-2 mx-4 border shadow-sm" width="100%">
          <table class="table">
              <tr>
                  <td width="15%" style="font-weight: bold">Supervisor ID</td>
                  <td width="20%" style="font-weight: bold">Supervisor Name</td>
                  <td width="20%" style="font-weight: bold">Supervisor Email</td>
                  <td width="20%" style="font-weight: bold">Department</td>
                  <td width="20%"></td>
              </tr>
              
              <?php if(mysqli_num_rows($sups) > 0): ?>
                <?php while($sup = mysqli_fetch_assoc($sups)): ?>
                    <tr>
                        <td><?=$sup['supervisorID'];?></td>
                        <td><?=$sup['name'];?></td>
                        <td><?=$sup['email'];?></td>
                        <td><?=$sup['department'];?></td>
                        <td><a href="editSupervisor.php?studID=<?=$retStudentID;?>"><button type="button" class="btn btn-primary">Edit</button></a> </td>
                    </tr>
                <?php endwhile;?>
              <?php endif;?>
              
              <?php if(mysqli_num_rows($sups) <= 0): ?>
                    <td>- Not Assigned -</td>
                    <td>- Not Assigned -</td>
                    <td>- Not Assigned -</td>
                    <td>- Not Assigned -</td>
                        <td><a href="editSupervisor.php?studID=<?=$retStudentID;?>"><button type="button" class="btn btn-primary">Edit</button></a> </td>
              <?php endif;?>
              
            
         </table>
        </div>
        <br>
        
<?php 
  $sql3 = "SELECT internship.*
        FROM student, internship
        WHERE student.studentID = internship.studentID AND student.studentID = '$retStudentID'";
    $inDets = $db->query($sql3);
?>
<!--        
        <h4 class="text-center p-3">Internship Details</h3>
        <div class="m-4 border shadow-sm" width="100%">-->
        <h4 class="text-center pt-3 pb-0">Internship Details</h3>
        <div class="m-2 mx-4 border shadow-sm" width="100%">
          <!-- List of Internships -->
          <table class="table">
              <tr>
                  <td width="15%" style="font-weight: bold">Internship ID</td>
                  <td width="20%" style="font-weight: bold">Company Name</td>
                  <td width="20%" style="font-weight: bold">Location</td>
                  <td width="10%" style="font-weight: bold">Start Date</td>
                  <td width="10%" style="font-weight: bold">End Date</td>
                  <td width="15%" style="font-weight: bold">Status</td>
              </tr>
                     
                <?php if(mysqli_num_rows($inDets) > 0): ?>
                <?php while($inDet = mysqli_fetch_assoc($inDets)): ?>
                    <tr>
                        <td><?=$inDet['internshipID'];?></td>
                        <td><?=$inDet['companyName'];?></td>
                        <td><?=$inDet['location'];?></td>
                        <td><?=$inDet['startDate'];?></td>
                        <td><?=$inDet['endDate'];?></td>
                        <td><?=$inDet['status'];?></td>
                    </tr>
                <?php endwhile;?>
              <?php endif;?>
              
              <?php if(mysqli_num_rows($inDets) <= 0): ?>
                    <tr>
                        <td>- Waiting Student Response -</td>
                        <td>- Waiting Student Response -</td>
                        <td>- Waiting Student Response -</td>
                        <td>- Waiting Student Response -</td>
                        <td>- Waiting Student Response -</td>
                        <td>- Waiting Student Response -</td>
                    </tr>
              <?php endif;?>
         </table>
        </div>
        <br>
        
<?php 
  $sql4 = "SELECT studentReport.*
        FROM student, studentReport
        WHERE student.studentID = studentReport.studentID AND student.studentID = '$retStudentID'";
    $inDocs = $db->query($sql4);
?>
        
<!--        <h4 class="text-center p-3">Internship Documents</h3>
        <div class="m-4 border shadow-sm" width="100%">-->
        <h4 class="text-center pt-3 pb-0">Internship Documents</h3>
        <div class="m-2 mx-4 border shadow-sm" width="100%">
          <!-- List of Internships -->
          <table class="table">
              <tr>
                  <td width="15%" style="font-weight: bold">Report ID</td>
                  <td width="20%" style="font-weight: bold">Indemnity Letter</td>
                  <td width="20%" style="font-weight: bold">Company Acceptance Letter</td>
                  <td width="20%" style="font-weight: bold">Parent Acknowledgement Letter</td>
                  <td width="20%" style="font-weight: bold">Status</td>
              </tr>
        <?php if(mysqli_num_rows($inDocs) > 0): ?>
                <?php while($inDoc = mysqli_fetch_assoc($inDocs)): ?>
                    <tr>
                        <td><?=$inDoc['reportID'];?></td>
                        <td><a class="text-primary" href="<?php echo $inDoc['indemnityReport'];?>" target="_blank" download><u><?php echo $inDoc['indemnityReport'];?></u></a></td>
                        <td><a class="text-primary" href="<?php echo $inDoc['companyAccLetter'];?>" target="_blank" download><u><?php echo $inDoc['companyAccLetter'];?></u></a></td>
                        <td><a class="text-primary" href="<?php echo $inDoc['parentAck'];?>" target="_blank" download><u><?php echo $inDoc['parentAck'];?></u></a></td>
                        <td><?=$inDoc['status'];?></td>
                    </tr>
                <?php endwhile;?>
              <?php endif;?>
              
              <?php if(mysqli_num_rows($inDets) <= 0): ?>
                    <tr>
                        <td>- Waiting Student Response -</td>
                        <td>- Waiting Student Response -</td>
                        <td>- Waiting Student Response -</td>
                        <td>- Waiting Student Response -</td>
                        <td>- Waiting Student Response -</td>
                    </tr>
              <?php endif;?>
         </table>
        </div>
        <br>

<?php 
  $sql5 = "SELECT progressreport.*, COALESCE(progressreport.marks, 'pending') AS marks
        FROM student, progressreport
        WHERE student.studentID = progressreport.studentID AND student.studentID = '$retStudentID'";
    $prgs = $db->query($sql5);
?>
        
        <h4 class="text-center pt-3 pb-0">Progress Reports</h3>
        <div class="m-2 mx-4 border shadow-sm" width="100%">
          <!-- List of Internships -->
          <table class="table">
              <tr>
                  <td width="15%" style="font-weight: bold">Progress ID</td>
                  <td width="20%" style="font-weight: bold">File Name</td>
                  <td width="20%" style="font-weight: bold">Submission Date</td>
                  <td width="20%" style="font-weight: bold">Marks</td>
                  <td width="20%" style="font-weight: bold">Status</td>
              </tr>
              
              <?php if(mysqli_num_rows($prgs) > 0): ?>
                <?php while($prg = mysqli_fetch_assoc($prgs)): ?>
                    <tr>
                        <td><?=$prg['progressID'];?></td>
                        <td><a class="text-primary" href="<?php echo $inDoc['progressReport'];?>" target="_blank" download><u><?php echo $inDoc['progressReport'];?></u></a></td>
                        <td><?=$prg['submissionDate'];?></td>
                        <td><?=$prg['marks'];?></td>
                        <td><?=$prg['status'];?></td>
                    </tr>
                <?php endwhile;?>
              <?php endif;?>
              
              <?php if(mysqli_num_rows($prgs) <= 0): ?>
                    <tr>
                        <td>- Waiting Student Response -</td>
                        <td>- Waiting Student Response -</td>
                        <td>- Waiting Student Response -</td>
                        <td>- Waiting Student Response -</td>
                        <td>- Waiting Student Response -</td>
                    </tr>
              <?php endif;?>
         </table>
        </div>
        <br>
    </main>

<?php include 'includes/footer.php';  ?>