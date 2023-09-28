<?php 
  session_start();
  require_once '../core/init.php';
  include('includes/header.php');
?>

<?php 

    $retStudentID = $_GET['studID'];
//    $sql = "SELECT * FROM student WHERE studentID = '$retStudentID'";
    $sql = "SELECT student.*, COALESCE(supervisor.name, '- Not Assigned -') AS supName
            FROM student
            LEFT JOIN supervisor ON student.supervisorID = supervisor.supervisorID
            WHERE studentID = '$retStudentID'";
    $students = $db->query($sql);
?>


  
    <main>
        <h3 class="text-center p-3">Edit Supervisor</h3>
        <div class="m-4 border" width="100%">
          <!-- List of Internships -->
          <table class="table">
              <tr>
                  <td width="15%" style="font-weight: bold">Student ID</td>
                  <td width="20%" style="font-weight: bold">Student Name</td>
                  <td width="20%" style="font-weight: bold">Student Email</td>
                  <td width="20%" style="font-weight: bold">Course</td>
                  <td width="20%" style="font-weight: bold">Supervisor Name</td>
              </tr
            
              <?php while($student = mysqli_fetch_assoc($students)): ?>
                    <tr>
                        <td><?=$student['studentID'];?> </td>
                        <td><?=$student['name'];?> </td>
                        <td><?=$student['email'];?> </td>
                        <td><?=$student['course'];?> </td>
                        <td><?=$student['supName'];?> </td>
                    </tr>
                <?php endwhile;?>
         </table>
        </div>
        <br>

<?php 
    $sql2 = "SELECT * FROM supervisor";
    $sups = $db->query($sql2);
?>
        
        <h4 class="text-center  pt-3 pb-0">Select Supervisor</h3>
        <div class="mx-4 m-2 border" width="100%">
          <!-- List of Internships -->
          <table class="table">
              <tr>
                  <td width="70%" style="font-weight: bold">New Supervisor Name</td>
                  <td width="20%"></td>
              </tr>
       
              
              <tr>
                <form action="#" method="post">
                  <td> 
                        <select class="my-3" style="width: 300px; height: 30px" name="supervisorIDSelected">  
                        <option selected="true" disabled="disabled">-- Select --</option>
                            <?php while($sup = mysqli_fetch_assoc($sups)): ?><option value="<?=$sup['supervisorID'];?>"><?=$sup['supervisorID'];?> - <?=$sup['name'];?></option><?php endwhile;?></select> 
                  </td>
                  <!--<td><a href="studentDetails.php"><button type="button" class="btn btn-primary">Confirm</button></a> </td>-->
                  <td>
                      <input style="background-color: #4285f4!important; color: #fff; box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.12);
    padding: .84rem 2.14rem;
    font-size: .81rem; border: none; margin-top: 5px" type="submit" value="UPDATE" onclick="return confirm('Are you sure?');" >
                        <input type="hidden" name="confirm_update" value="yes">
                        
                  </td>
                </form>
              </tr>
<?php   
                        if(isset($_POST["confirm_update"]) && $_POST["confirm_update"] == "yes") {
                          
                            if (isset($_POST['supervisorIDSelected'])){ 
                                
                                $selectedSupervisorID = $_POST['supervisorIDSelected'];  // Storing Selected Value In Variable
                                // Execute the SQL update operation here
                                $sqlUpdateSup = "UPDATE `student` SET `supervisorID`='$selectedSupervisorID' WHERE `studentID` = '$retStudentID'";
                                $students = $db->query($sqlUpdateSup);
                            
                                echo "<script>window.open('studentDetails.php?studID=$retStudentID','_self')</script>";
                            }    
                             else{
                                echo '<script>alert("Please select supervisor.")</script>';
                            }
                        } 
?>
         </table>
        </div>
        <br>
        
        
              
         </table>
        </div>
        <br>
    </main>

<?php include 'includes/footer.php';  ?>