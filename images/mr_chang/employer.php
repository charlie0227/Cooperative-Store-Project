<?php
require_once "sysconfig.php";
if(!$_SESSION['authority']){
	echo "<script>alert('No authority !! Return to Previous Page !!'); history.back()</script> ";
}
?>
<html>
<h1 style="text-align:left;color:#fff355;">Hello <?php echo $_SESSION['admin'];?>  </h1>
<input style="float:left;" type="image" src="image/log_out.png" onclick="location.href='logout.php';"><br>
<?php
	include("job.php");
?>
</br></br>
<input type="image" src="image/job_seeker_list.png" onclick="location.href='jobseeker_list.php';">
<input type="image" src="image/who_applies_your_job.png" onclick="location.href='application_list.php';">
</html>
