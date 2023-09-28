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
        
        $sql = "SELECT student.*, 
       COALESCE(supervisor.name, '- Not Assigned -') AS supName,
       CASE
           WHEN internship.studentID IS NULL THEN '- Waiting Student Response -'
           ELSE internship.status
       END AS InternshipStatus
FROM student
LEFT JOIN supervisor ON student.supervisorID = supervisor.supervisorID
LEFT JOIN internship ON student.studentID = internship.studentID
WHERE internship.studentID IS NULL";
    $students = $db->query($sql);
?>

<?php 
//  if(!isset($_SESSION['email'])){
//      echo "<script>window.open('login.php','_self')</script>";
//    }else{
?>

    <nav class="mb-1 navbar navbar-expand-lg navbar-light" style="background-color: #b2ede7;position: sticky;width: 100%; top: 0px;">
<!--        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
          aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>-->
        <div id="navbarSupportedContent-333" >
            <ul class="navbar-nav mr-auto">
              <li class="nav-item mx-5">
                <a class="nav-link" href="studentList.php">All Students</a>
              </li>
              <li class="nav-item mx-5">
                  <a class="nav-link" href="studentListNotAssigned.php">Not Assigned</a>
              </li>
              <li class="nav-item mx-5" style="border-bottom-style: solid; border-bottom-width: thin;">
                  <a class="nav-link" href="studentListWait.php">Waiting Student Response</a>
              </li>
             
            </ul>
        </div>
    </nav>

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

<button class="back-to-top" onclick="topFunction()">Top</button>

<script>
// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {
    scrollFunction();
};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.querySelector(".back-to-top").style.display = "block";
    } else {
        document.querySelector(".back-to-top").style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
</script>

<?php include 'includes/footer.php';  ?>