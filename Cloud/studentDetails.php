<?php 
  session_start();
  require_once 'core/init.php';
  include('includes/header.php');
?>

<h2 class="text-center"> </h2>

<div class="row">
<?php 
    if (isset($_GET['studentID'])) {
        $selectedStudent = $_GET['studentID'];
    }
  $id = $_SESSION['supervisorID'];

  $sql = "SELECT * FROM student WHERE supervisorID = '$id'";

  $students = $db->query($sql);
?>
    <div class="col-md-3 m-4">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Student ID</th>
                    <th scope="col">Name</th>
                </tr>
            </thead>
            <?php while ($student = mysqli_fetch_assoc($students)): ?>
                <tr onclick="window.location='studentDetails.php?studentID=<?php echo $student['studentID']; ?>';">
                    <th scope="col">
                        <?= $student['studentID']; ?>&nbsp;&nbsp;
                    </th>
                    <td>
                        <?= $student['name']; ?>
                    </td>
                </tr>
            <?php endwhile; ?>

        </table>
    </div>
<?php 
  $sql = "SELECT * FROM student WHERE studentID = 'SDT002'";
  $students = $db->query($sql);
?>
    <div class="col-md-8">
        <div class="card m-4 p-4">
            <table width="100%" class="table">
            <?php while($student = mysqli_fetch_assoc($students)): ?>
                <tr>
                    <td colspan="3"><h4><?=$student['studentID'];?>&nbsp;&nbsp;<?=$student['name'];?></h4></td>
                </tr>
                <tr>
                    <td>Student Email</td>
                    <td>:</td>
                    <td> <?=$student['email'];?></td>
                </tr>
                <tr>
                    <td>Course</td>
                    <td>:</td>
                    <td> <?=$student['course'];?></td>
                </tr>
            <?php endwhile;?>
            </table>
        </div>
        
        
        <div class="card m-4 p-4">
<?php 
  $sql = "SELECT * FROM internship WHERE studentID = 'SDT002'";
  $internships = $db->query($sql);
?>
            
            <table width="100%" class="table table-striped">
            <?php while($student = mysqli_fetch_assoc($internships)): ?>
                <tr>
                    <td width="25%">Internship ID</td>
                    <td width="5%">:</td>
                    <td width="60%"> <?=$student['internshipID'];?></td>
                </tr>
                <tr>
                    <td>Company Name</td>
                    <td>:</td>
                    <td> <?=$student['companyName'];?></td>
                </tr>
                <tr>
                    <td>Location</td>
                    <td>:</td>
                    <td> <?=$student['location'];?></td>
                </tr>
                <tr>
                    <td>Start Date</td>
                    <td>:</td>
                    <td> <?=$student['startDate'];?></td>
                </tr>
                <tr>
                    <td>End Date</td>
                    <td>:</td>
                    <td> <?=$student['endDate'];?></td>
                </tr>
                <tr>
                    <td>Current Status</td>
                    <td>:</td>
                    <td>  <?=$student['status'];?></td>
                </tr>
                
                <?php $sql = "SELECT * FROM studentreport where studentID = 'SDT002'";

                $files = $db->query($sql);

                while($file = mysqli_fetch_assoc($files)): ?>
                
                <tr>
                    <td>Company Acceptance Letter</td>
                    <td>:</td>
                    <td>
                        <a href="<?php echo $file['companyAccLetter'];?>" target="_blank" style="color:blue;text-decoration: underline;">(<?php echo $file['companyAccLetter'];?>)</a>
                    </td>
                </tr>
                <?php
endwhile;

?>
                <tr>
                    <td>Indemnity Letter</td>
                    <td>:</td>
                    <td><a href="" target="_blank" style="color:blue;text-decoration: underline;">View Indemnity Letter</a></td>
                </tr>
                <tr>
                    <td>Parent Acknowledgement Letter</td>
                    <td>:</td>
                    <td><a href="" target="_blank" style="color:blue;text-decoration: underline;">View Parent Acknowledgement Letter</a></td>
                </tr>
            </table>
            <?php $status =$student['status'];?>
            <?php if ($status=="Pending Approval"): ?>
            <div class="row">
                <div class="col-md-6 m-4">
                    <a href="updateInternship.php?studentID=<?php echo $student['studentID']; ?>&status=Approved">
                        <button type="submit" name="approve" class="btn btn-primary" width="100%">Approve</button></a>
                    <a href="updateInternship.php?studentID=<?php echo $student['studentID']; ?>&status=Rejected">
                        <button type="submit" name="reject" class="btn btn-primary" width="100%">Reject</button></a>
                </div>
            </div>
 <?php endif; ?>
            <?php endwhile;?>

</div>
    </div> 
    

