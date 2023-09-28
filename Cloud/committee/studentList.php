<?php 
  session_start();
  require_once '../core/init.php';
  include('includes/header.php');
?>

<?php 
//  $email = $_SESSION['email'];
    //$sql = "SELECT * FROM student";
//    $sql = "SELECT `student`.*, `supervisor`.`name` AS `supName`, `supervisor`.`supervisorID`
//            FROM `student`, `supervisor`
//            WHERE `supervisor`.`supervisorID` = `student`.`supervisorID`";

//    //    $sql = "SELECT student.*, COALESCE(supervisor.name, '-- Not Assigned --') AS supName
//            FROM student
//            LEFT JOIN supervisor ON student.supervisorID = supervisor.supervisorID
//            ORDER BY student.studentID ASC";

//        $sql = "SELECT student.name AS name, COALESCE(supervisor.name, 'NA') AS supName, CASE WHEN internship.studentID IS NULL THEN 'waiting' ELSE internship.status END AS InternshipStatus 
//        FROM student 
//        LEFT JOIN supervisor ON student.supervisorID = supervisor.supervisorID 
//        LEFT JOIN internship ON student.studentID = internship.studentID";
        
        $sql = "SELECT student.*, COALESCE(supervisor.name, '- Not Assigned -') AS supName,
        CASE
                WHEN internship.studentID IS NULL THEN '- Waiting Student Response -'
                ELSE internship.status
            END AS InternshipStatus
        FROM student
        LEFT JOIN supervisor  ON student.supervisorID = supervisor.supervisorID
        LEFT JOIN internship  ON student.studentID = internship.studentID";
    $students = $db->query($sql);
?>

<?php 
//  if(!isset($_SESSION['email'])){
//      echo "<script>window.open('login.php','_self')</script>";
//    }else{
?>


    <main>
        <h3 class="text-center p-3">Student List</h3>
        <div class="m-4" width="100%">
          <!-- List of students -->
          <table class="table">
              <tr>
                  <th width="15%" style="font-weight: bold">Student ID</td>
                  <th width="15%" style="font-weight: bold">Student Name</td>
                  <td width="20%" style="font-weight: bold">Student Email</td>
                  <th width="20%" style="font-weight: bold">Supervisor Name</td>
                  <th width="20%" style="font-weight: bold">Internship Status</td>
                  <th width="10%" style="font-weight: bold"></td>
              </tr>
              
<!--              <tr>
                  <td>S1</td>
                  <td>Chan Jia Wei</td>
                  <td>chanjw@gmail.com</td>
                  <td>2093894</td>
                  <td><a href="studentDetails.php"><button type="button" class="btn btn-primary">View Details</button></a> </td>
              </tr>-->
              
        <?php while($student = mysqli_fetch_assoc($students)): ?>
                <tr>
                    <td><?=$student['studentID'];?> </td>
                    <td><?=$student['name'];?> </td>
                    <td><?=$student['email'];?> </td>
                    <td><?=$student['supName'];?> </td>
                    <td><?=$student['InternshipStatus'];?> </td>
                    <td><a href="studentDetails.php?studID=<?=$student['studentID'];?>"><button type="button" class="btn btn-primary">View Details</button></a> </td>
                </tr>
        <?php endwhile;?>
        
         </table>
        </div>
        <br>
    </main>

<?php include 'includes/footer.php';  ?>