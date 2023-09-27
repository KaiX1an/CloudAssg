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
    $sql = "SELECT student.*, COALESCE(supervisor.name, '-- Not Assigned --') AS supName
            FROM student
            LEFT JOIN supervisor ON student.supervisorID = supervisor.supervisorID
            ORDER BY student.studentID ASC";
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
                  <td width="15%">Student ID</td>
                  <td width="20%">Student Name</td>
                  <td width="20%">Student Email</td>
                  <td width="20%">Supervisor Name</td>
                  <td width="20%"></td>
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
                    <td><a href="studentDetails.php?studID=<?=$student['studentID'];?>"><button type="button" class="btn btn-primary">View Details</button></a> </td>
                </tr>
        <?php endwhile;?>
        
         </table>
        </div>
        <br>
    </main>

<?php include 'includes/footer.php';  ?>