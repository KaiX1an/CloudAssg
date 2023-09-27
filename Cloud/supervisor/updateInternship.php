<?php
session_start();
require_once '../core/init.php';
include('includes/header.php');

if (isset($_GET['studentID'])) {
    $selectedStudent = $_GET['studentID'];
    $status = $_GET['status'];
    
    //echo "$selectedStudent $status";

    $sql = "UPDATE internship SET status='$status' WHERE studentID='$selectedStudent'";

    if ($db->query($sql)) {
         //Update successful
        echo "<script>alert('Status of student updated successfully.')</script>";
        echo "<script>window.open('studentList.php','_self')</script>";
    } else {
        // Update failed
        echo "Error updating status: " . $db->error;
    }
}
?>
