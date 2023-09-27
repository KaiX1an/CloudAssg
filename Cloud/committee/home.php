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
        <h3 class="text-center p-3">Committee Home</h3>
        
        <br>
    </main>

<?php include 'includes/footer.php';  ?>