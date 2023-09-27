<?php 
  session_start();
  require_once '../core/init.php';
  include('includes/header.php');
?>

<?php 

    $retStudentID = $_GET['studID'];
//    $sql = "SELECT * FROM student WHERE studentID = '$retStudentID'";
    $sql = "SELECT student.*, COALESCE(supervisor.name, '-- Not Assigned --') AS supName
            FROM student
            LEFT JOIN supervisor ON student.supervisorID = supervisor.supervisorID
            WHERE studentID = '$retStudentID'";
    $students = $db->query($sql);
?>

<?php 
//  if(!isset($_SESSION['email'])){
//      echo "<script>window.open('login.php','_self')</script>";
//    }else{
?>
  
    <main>
        <h3 class="text-center p-3">Edit Supervisor</h3>
        <div class="m-4 border" width="100%">
          <!-- List of Internships -->
          <table class="table">
              <tr>
                  <td width="15%">Student ID</td>
                  <td width="20%">Student Name</td>
                  <td width="20%">Student Email</td>
                  <td width="20%">Course</td>
                  <td width="20%">Supervisor Name</td>
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
        
        <h4 class="text-center p-3">Supervisor Details</h3>
        <div class="m-4 border" width="100%">
          <!-- List of Internships -->
          <table class="table">
              <tr>
                  <td width="70%">Supervisor Name</td>
                  <td width="20%"></td>
              </tr>
       
              
              <tr>
                <form action="#" method="post">
                  <td> 
                      <select style="width: 300px; height: 30px" name="supervisorIDSelected">  
                        <option selected="true" value="f" disabled="disabled">-- Select --</option>
                        <?php while($sup = mysqli_fetch_assoc($sups)): ?>
                            <option value="<?=$sup['supervisorID'];?>"><?=$sup['supervisorID'];?> - <?=$sup['name'];?></option>
                        <?php endwhile;?>
                    </select> 
                  </td>
                  <!--<td><a href="studentDetails.php"><button type="button" class="btn btn-primary">Confirm</button></a> </td>-->
                  <td>
                      
                        <input type="submit" value="Update" onclick="return confirm('Are you sure?');" >
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
                            
                                header("Location: editSupervisor.php?studID=$retStudentID");
                                exit;
                            }    
                             else{
                                echo '<script>alert("Please select supervisor.")</script>';
                            }
                        } 
                       
                        
                        
//                        echo '<script>alert("Are you sure?")</script>';
//                        if(confirm("Are you sure?")){
//                            $sqlUpdateSup = "UPDATE `student` SET `supervisorID`='$selectedSupervisorID' WHERE `studentID` = '$retStudentID'";
//                            $students = $db->query($sqlUpdateSup);
//                        }
                        
                        
                        
                        
                        
                    
                ?>
              
              
         </table>
        </div>
        <br>
        
        
              
              
        <?php /*
              <?php endif; ?>
          <?php endwhile;?>
        */ ?>
         </table>
        </div>
        <br>
    </main>

<?php include 'includes/footer.php';  ?>