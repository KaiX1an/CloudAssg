<?php 
  session_start();
  require_once '../core/init.php';
  include('includes/header.php');
?>


<?php 
  $sql = "SELECT * FROM student";
  $students = $db->query($sql);
?>
<main>
  <h3 class="text-center p-3">Student List</h3>
  <div class="m-4" width="100%">
    <!-- List of Internships -->
    <table class="table">
        <tr>
            <td width="15%">Student ID</td>
            <td width="20%">Student Name</td>
            <td width="20%">Student Email</td>
            <td width="20%">Internship Status</td>
            <td width="20%"></td>
        </tr>
    <?php while($student = mysqli_fetch_assoc($students)): ?>
        <tr>
            <td><?=$student['studentID'];?> </td>
            <td><?=$student['name'];?> </td>
            <td><?=$student['email'];?> </td>
            
            <?php 
            $studentID = $student['studentID'];
            $sql1 = "SELECT * FROM Internship WHERE studentID = '$studentID'";
            $internships = $db->query($sql1);
            
            while($internship = mysqli_fetch_assoc($internships)): ?>
            <td>
            <?=$internship['status'];?>
            </td>
            <?php endwhile;?>

            <td><a href="studentDetails.php"><button type="button" class="btn btn-primary">View Details</button></a> </td>
        </tr>
    <?php endwhile;?>
   </table>
  </div>
  <br>
</main>
<?php include 'includes/footer.php'; ?>