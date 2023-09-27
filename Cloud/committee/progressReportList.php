<?php 
  session_start();
  require_once '../core/init.php';
  include('includes/header.php');
?>

<?php 
//  $email = $_SESSION['email'];
//  $sql = "SELECT * FROM employer WHERE email = '$email'";
//    $result = $db->query($sql);
//    while ($row_pro = mysqli_fetch_array($result)) {
//          $emp_id = $row_pro['id'];
//          $emp_name = $row_pro['nameOfCompany'];
//          $emp_about = $row_pro['aboutCompany'];
//          $emp_email = $row_pro['email'];
//          $emp_address1 = $row_pro['address1'];
//          $emp_address2 = $row_pro['address2'];
//          $emp_city = $row_pro['city'];
//          $emp_state = $row_pro['state'];
//          $emp_zipcode = $row_pro['zipcode'];
//          $emp_phone = $row_pro['phone'];
//          $emp_country = $row_pro['country'];
//    }
?>

<?php 
//  if(!isset($_SESSION['email'])){
//      echo "<script>window.open('login.php','_self')</script>";
//    }else{
?>
  
    <main>
        <h3 class="text-center p-3">Progress Report</h3>
        <div class="m-4" width="100%">
          <!-- List of Internships -->
          <table class="table">
              <tr>
                  <td width="15%">Student ID</td>
                  <td width="20%">Student Name</td>
                  <td width="20%">Student Email</td>
                  <td width="20%">Internship</td>
                  <td width="20%"></td>
              </tr
        <?php /*
            <?php while($student = mysqli_fetch_assoc($students)): ?>
              <?php if($student['supervisorID'] == "V001"): ?>
        */ ?>
              <tr>
                  <td>S1</td>
                  <td>Chan Jia Wei</td>
                  <td>chanjw@gmail.com</td>
                  <td>2093894</td>
                  <td><a href="studentDetails.php"><button type="button" class="btn btn-primary">View Details</button></a> </td>
              </tr>
              
              <tr>
                  <td>S2</td>
                  <td>Chan Jin Wei</td>
                  <td>chanjw@gmail.com</td>
                  <td>2093894</td>
                  <td><a href="studentDetails.php"><button type="button" class="btn btn-primary">View Details</button></a> </td>
              </tr>
        <?php /*
              <?php endif; ?>
          <?php endwhile;?>
        */ ?>
         </table>
        </div>
        <br>
    </main>

<?php include 'includes/footer.php';  ?>