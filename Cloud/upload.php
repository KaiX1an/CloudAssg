<html>
<body>
    
<?php 
	session_start();
	include 'includes/header.php';
	include 'core/init.php';


// Define the target directory where you want to move the uploaded file
$target_directory = 'uploads/'; // Change this to your desired directory

// Check if the form was submitted
if(isset($_POST['submit'])) {
    
$target_file1 = $target_directory . basename($_FILES["indem"]["name"]);


$sql = "INSERT INTO studentreport (reportID, indemnityReport, companyAccLetter, parentAck, status, studentID) 
            VALUES 
            ('R001', '$target_file1', '', '', '', 'STD001')";


$db->query($sql);

        // Perform the database query
        if (move_uploaded_file($_FILES['indem']['tmp_name'], $target_file1)) {
            echo "Indemnity Report file uploaded successfully.<br>";
        } else {
            echo "Error moving the Indemnity Report file to the target directory.<br>";
        }
}
?>
</body>
</html>
