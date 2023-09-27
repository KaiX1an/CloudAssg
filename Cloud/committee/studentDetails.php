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
        <div class="m-4 border" width="100%">
          <table class="table">
                <tr>
                    <td width="15%">Student ID</td>
                    <td width="20%">Student Name</td>
                    <td width="20%">Student Email</td>
                    <td width="20%">Course</td>
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
        
        <h4 class="text-center p-3">Supervisor Details</h3>
        <div class="m-4 border" width="100%">
          <table class="table">
              <tr>
                  <td width="15%">Supervisor ID</td>
                  <td width="20%">Supervisor Name</td>
                  <td width="20%">Supervisor Email</td>
                  <td width="20%">Department</td>
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
                    <td>-- Not Assigned --</td>
                    <td>-- Not Assigned --</td>
                    <td>-- Not Assigned --</td>
                    <td>-- Not Assigned --</td>
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
        
        <h4 class="text-center p-3">Internship Details</h3>
        <div class="m-4 border" width="100%">
          <!-- List of Internships -->
          <table class="table">
              <tr>
                  <td width="15%">Internship ID</td>
                  <td width="20%">Company Name</td>
                  <td width="20%">Location</td>
                  <td width="10%">Start Date</td>
                  <td width="10%">End Date</td>
                  <td width="15%">Status</td>
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
                        <td>-- Pending Placement --</td>
                        <td>-- Pending Placement --</td>
                        <td>-- Pending Placement --</td>
                        <td>-- Pending Placement --</td>
                        <td>-- Pending Placement --</td>
                        <td>-- Pending Placement --</td>
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
        
        <h4 class="text-center p-3">Internship Documents</h3>
        <div class="m-4 border" width="100%">
          <!-- List of Internships -->
          <table class="table">
              <tr>
                  <td width="15%">Report ID</td>
                  <td width="20%">Indemnity Letter</td>
                  <td width="20%">Company Acceptance Letter</td>
                  <td width="20%">Parent Acknowledgement Letter</td>
                  <td width="20%">Status</td>
              </tr>
        <?php if(mysqli_num_rows($inDocs) > 0): ?>
                <?php while($inDoc = mysqli_fetch_assoc($inDocs)): ?>
                    <tr>
                        <td><?=$inDoc['reportID'];?></td>
                        <td><a><u><?=$inDoc['indemnityReport'];?></u></a></td>
                        <td><a><u><?=$inDoc['companyAccLetter'];?></u></a></td>
                        <td><a><u><?=$inDoc['parentAck'];?></u></a></td>
                        <td><?=$inDoc['status'];?></td>
                    </tr>
                <?php endwhile;?>
              <?php endif;?>
              
              <?php if(mysqli_num_rows($inDets) <= 0): ?>
                    <tr>
                        <td>-- Pending Placement --</td>
                        <td>-- Pending Placement --</td>
                        <td>-- Pending Placement --</td>
                        <td>-- Pending Placement --</td>
                        <td>-- Pending Placement --</td>
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
        
        <h4 class="text-center p-3">Progress Reports</h3>
        <div class="m-4 border" width="100%">
          <!-- List of Internships -->
          <table class="table">
              <tr>
                  <td width="15%">Progress ID</td>
                  <td width="20%">File Name</td>
                  <td width="20%">Submission Date</td>
                  <td width="20%">Marks</td>
                  <td width="20%">Status</td>
              </tr>
              
              <?php if(mysqli_num_rows($prgs) > 0): ?>
                <?php while($prg = mysqli_fetch_assoc($prgs)): ?>
                    <tr>
                        <td><?=$prg['progressID'];?></td>
                        <td><a><u><?=$prg['progressReport'];?></u></a></td>
                        <td><?=$prg['submissionDate'];?></td>
                        <td><?=$prg['marks'];?></td>
                        <td><?=$prg['status'];?></td>
                    </tr>
                <?php endwhile;?>
              <?php endif;?>
              
              <?php if(mysqli_num_rows($prgs) <= 0): ?>
                    <tr>
                        <td>-- Pending Placement --</td>
                        <td>-- Pending Placement --</td>
                        <td>-- Pending Placement --</td>
                        <td>-- Pending Placement --</td>
                        <td>-- Pending Placement --</td>
                    </tr>
              <?php endif;?>
         </table>
        </div>
        <br>
    </main>

<?php include 'includes/footer.php';  ?>