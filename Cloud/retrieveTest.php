<?php 
	session_start();
	include 'includes/header.php';
	include 'core/init.php';
        
$sql = "SELECT * FROM studentreport ";

$files = $db->query($sql);

while($file = mysqli_fetch_assoc($files)):
    ?>
<a href="<?php echo $file['indemnityReport'];?>" target="_blank" download><?php echo $file['indemnityReport'];?>
    </a>
<a href="<?php echo $file['companyAccLetter'];?>" target="_blank" download><?php echo $file['companyAccLetter'];?>
    </a>
<a href="<?php echo $file['parentAck'];?>" target="_blank" download><?php echo $file['parentAck'];?>
    </a>
        
<?php
endwhile;

?>

