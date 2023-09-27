<?php 
	session_start();
	include 'includes/header.php';
	include 'core/init.php';
?>

<form name="studentForm" method="post" enctype="multipart/form-data" action ="upload.php">
    <table>
        <tr>
            <td>
                <input type="file" id="indem" name="indem"/>
            </td>
        </tr>
    </table>
    <input type="submit" name="submit" value="submit"/>
</form>


<?php
	include 'includes/footer.php';
?>