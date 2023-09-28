<?php 
	session_start();
	include 'includes/header.php';
 
$selectedStudent = $_SESSION['updateTo'];
$reportID = $_SESSION['reportID'];

if(isset($_POST['submit'])) {

    $marks = $_POST['marks'];
    
    $sql = "UPDATE progressreport SET status='Marked', marks='$marks' WHERE progressID = '$reportID'";

    //$db->query($sql);

    if ($db->query($sql)) {
         //Update successful
        echo "<script>alert('Status of report updated successfully.')</script>";
        echo "<script>window.open('progressReport.php?','_self')</script>";
    } else {
        // Update failed
        echo "Error updating status: " . $db->error;
    }
}

?>