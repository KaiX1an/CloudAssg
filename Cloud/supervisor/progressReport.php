<?php 
  session_start();
  require_once '../core/init.php';
  include('includes/header.php');
?>

<?php 
    if (isset($_GET['studentID'])) {
        $selectedStudent = $_GET['studentID'];
        $_SESSION['updateTo'] = $selectedStudent;
    }else{
        $selectedStudent = $_SESSION['updateTo'];
    }
  $id = $_SESSION['supervisorID'];

  $sql = "SELECT * FROM progressreport WHERE studentID = '$selectedStudent'";

  $reports = $db->query($sql);
?>

<main>
  <h3 class="text-center p-3">Submitted Progress Report List</h3>
  <div class="m-4" width="100%">
    <table class="table">
        <tr>
            <td width="35%">Progress Report</td>
            <td width="20%">Submission Date</td>
            <td width="20%">Report Marks</td>
            <td width="20%">Status</td>
        </tr>
    <?php while($report = mysqli_fetch_assoc($reports)): ?>
        <tr>
            <td><a href="../<?php echo $report['progressReport'];?>" target="_blank" style="color:blue;text-decoration: underline;"><?=$report['progressReport'];?></a> </td>
            <td><?=$report['submissionDate'];?> </td>
            <?php 
            $_SESSION['reportID'] = $report['progressID'];
            ?>
            <?php if($report['marks']==0):?>
            <td>
                <form method="post" action='updateMarks.php?'>
                    <input type="text" id="email" class="form-control form-control-sm" name="marks" required>
                    <button type="submit" name="submit" class="btn btn-black" style="border-radius: 10em;background: #1c2a48">Submit</button>
                </form>
            </td>
            <td>---</td>
            <?php else: ?> 
            <td><?=$report['marks'];?></td>
            <td><?=$report['status'];?> </td>
            <?php endif; ?>
        </tr>
    <?php endwhile; ?>
   </table>
  </div>
  <br>
</main>
<?php include 'includes/footer.php'; ?>