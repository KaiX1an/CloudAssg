<?php 
  session_start();
  require_once 'core/init.php';
  include('includes/header.php');
?>

<?php 
    if(!isset($_SESSION['email'])){
        echo "<script>window.open('login.php','_self')</script>";
    }else{
        echo "<script>window.open('','_self')</script>";
    }
?>

<head>
    <link rel="stylesheet" href="scss/fileUpload.css">
</head>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function activateLabel(inputElement, labelElement) {
    // Detect when the input field is focused
    inputElement.focus(function() {
        // Add the 'active' class to the label
        labelElement.addClass('active');
    });

    // Detect when the input field loses focus
    inputElement.blur(function() {
        // Check if the input field is empty
        if ($(this).val() === '') {
            // Remove the 'active' class from the label
            labelElement.removeClass('active');
        }
    });

    // Check on page load if the input field has content
    if (inputElement.val() !== '') {
        // Add the 'active' class to the label
        labelElement.addClass('active');
    }
}

$(document).ready(function() {
    // Use the activateLabel function for specific inputs and labels
    activateLabel($('#companyname'), $('label[for="companyname"]'));
    activateLabel($('#location'), $('label[for="location"]'));
    activateLabel($('#startdate'), $('label[for="startdate"]'));
    activateLabel($('#enddate'), $('label[for="enddate"]'));
});
</script>

<div class="container-fluid p-2">
	<div class="card">
		<div class="card-header">
                    <h3 class="h3-responsive p-2 text-center">Enter your Internship Details</h3> 
		</div>
		<div class="card-body">
			<div class="container-fluid">
                            <form class="p-3 grey-text" method="post" action="formUpload.php" enctype="multipart/form-data">
				<div class="md-form form-sm"> <i class="fa fa-city prefix"></i>
                                    <input type="text" id="companyname" class="form-control form-control-sm" name="companyname" required>
                                    <label for="companyname">Company Name</label>
                                </div>
                                <div class="md-form form-sm"> <i class="fa fa-map-marker-alt prefix"></i>
                                    <input type="text" id="location" class="form-control form-control-sm" name="location" required>
                                    <label for="location">Location</label>
                                </div>
                                <div class="md-form form-sm"> <i class="fa fa-business-time prefix"></i>
                                    <input type="date" id="startdate" class="form-control form-control-sm" name="startdate" required>
                                    <label for="startdate" class="pt-3">Start Date</label>
                                </div>
                                <div class="md-form form-sm"> <i class="fa fa-calendar-times prefix"></i>
                                    <input type="date" id="enddate" class="form-control form-control-sm" name="enddate" required>
                                    <label for="enddate" class="pt-3">End Date</label>
                                </div>
                               
                                
                                <br /><br />
                                <div class="divider">Internship Forms Submission</div>
                                
                                <div>
                                    <label for="indemnityletter" class="form-label mb-0">Indemnity Letter</label>
                                    <div class="mb-3 md-form form-sm mt-1"> <i class="fa fa-address-book prefix"></i>
                                        <input class="form-control" type="file" id="indemnityletter" name="indemnityletter" required>
                                    </div>
                                </div>
                                <div>
                                    <label for="companyletter" class="form-label mb-0">Company Acceptance</label>
                                    <div class="mb-3 md-form form-sm mt-1"> <i class="fa fa-pen-nib prefix"></i>
                                        <input class="form-control" type="file" id="companyletter" name="companyletter" required>
                                    </div>
                                </div>
                                <div>
                                    <label for="parentform" class="form-label mb-0">Parent Acknowledgement Form</label>
                                    <div class="mb-3 md-form form-sm mt-1"> <i class="fa fa-file prefix"></i>
                                        <input class="form-control" type="file" id="parentform" name="parentform" required>
                                    </div>
                                </div>
                                <div class="text-center mt-4">
                                    <button class="btn btn-default" type="submit" name="submit_indemnity">Submit Internship Details<i class="fa fa-paper-plane-o ml-1"></i></button>
                                </div>				
                            </form>
			</div>
		</div>
	</div>
</div>

<?php include 'supervisor/includes/footer.php'; ?>
