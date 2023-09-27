<?php 
  session_start();
  require_once '../core/init.php';
  include('includes/header.php');
?>


<?php 
    $id = $_SESSION['supervisorID'];

    $sql = "SELECT * FROM student WHERE supervisorID = '$id'";

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
            $internships = $db->query($sql1);?>
            <td>
            <?php while($internship = mysqli_fetch_assoc($internships)): ?>
            <?=$internship['status'];?>
            <?php endwhile;?>
                
            <?php if (mysqli_num_rows($internships) === 0): ?>
            <!-- Display your "else" message here -->
            <p>(Waiting student response)</p>
            <?php endif; ?>
            </td>
            <?php
                echo '<td><a href="studentDetails.php?studentID=' . $studentID . '"><button type="button" class="btn btn-primary">View Details</button></a></td>';
                ?>
</tr>
    <?php endwhile;?>
   </table>
  </div>
  <br>
</main>
<?php include 'includes/footer.php'; ?>