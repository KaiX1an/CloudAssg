<?php 
  session_start();
  require_once '../core/init.php';
  include('includes/header.php');
?>

<h2 class="text-center">Student Internship List</h2>

<div class="row">
<?php 
  $sql = "SELECT * FROM student WHERE supervisorID = 'SPV001'";
  $students = $db->query($sql);
?>
    <div class="col-md-3 m-4">
        <table class="table table-hover">
            <thead>
            <thead>
                <tr>
                    <th scope="col">Student ID</th>
                    <th scope="col">Name</th>
                </tr>
            </thead>
            </thead>
        <?php while($student = mysqli_fetch_assoc($students)): ?>
            <tr>
                <th scope="col">
                    <?=$student['studentID'];?>&nbsp;&nbsp;
                </th>
                <td>
                    <?=$student['name'];?>
                </td>
            </tr>
        <?php endwhile; ?>
        </table>
    </div>
<?php 
  $sql = "SELECT * FROM student WHERE studentID = 'STD001'";
  $students = $db->query($sql);
?>
    <div class="col-md-8">
        <div class="card m-4 p-4">
            <table width="100%">
            <?php while($student = mysqli_fetch_assoc($students)): ?>
                <tr>
                    <td width="30%">Student ID</td>
                    <td width="5%">:</td>
                    <td width="60%"> <?=$student['studentID'];?></td>
                </tr>
                <tr>
                    <td>Student Name</td>
                    <td>:</td>
                    <td> <?=$student['name'];?></td>
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
  $sql = "SELECT * FROM internship WHERE studentID = 'STD001'";
  $internships = $db->query($sql);
?>
            
            <table width="100%">
            <?php while($student = mysqli_fetch_assoc($internships)): ?>
                <tr>
                    <td width="30%">Internship ID</td>
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
            </table>
            <?php $status =$student['status'];?>
            <?php if ($status=="pending"): ?>
            <div class="row">
                <div class="col-md-6 m-4">
                    <button type="button" class="btn btn-primary" width="100%">Approve</button>
                    <button type="button" class="btn btn-primary" width="100%">Reject</button>
                </div>
            </div>
 <?php endif; ?>
            <?php endwhile;?>

    </div>
</div>
    </div> 

