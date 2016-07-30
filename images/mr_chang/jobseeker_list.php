<?php
require_once "sysconfig.php";
unset($_SESSION['edit']);
if(!$_SESSION['authority']){
	echo "<script>alert('No authority !! Return to Previous Page !!'); history.back()</script> ";
}
?>
<html>
<head>
<script src="jquery-1.11.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("p.flip").hide();
	$(".flip").mouseenter(function(){
		$("h3.flip").hide();
		$(this).children().toggle();
		$(this).children().addClass('tored');
	}).mouseleave(function(){
		$("h3.flip").show();	
		$(this).children().toggle();
		$(this).children().removeClass('tored');

	});
});
</script>
</head>
<link href="style.css" rel="stylesheet" type="text/css" />
<h1 style="text-align:left;color:#fff355;">Hello <?php echo $_SESSION['admin'];?>  </h1>
<input style="float:left;" type="image" src="image/log_out.png" onclick="location.href='logout.php';"><br>
	<body>
		<div class="jobseeker">
		<?php
			$sql = "SELECT * FROM `jangsc27_cs`.`user` ";
			$sth = $db->prepare($sql);
			$sth->execute();
			function show_specialty($db,$id){
				$sql= "SELECT * FROM `jangsc27_cs`.`specialty` "."WHERE `id` = ?";
				$sth = $db->prepare($sql);
				$sth->execute(array($id));
				return $sth->fetchObject()->specialty;
			}
		?>
				<p style="font-size:40px;">Job Seeker List</p>
				<table><col><col><col><col><col><col><col><col><col><tr>
				<th>ID</th>
				<th>Name</th>
				<th>Gender</th>
				<th>Age</th>
				<th>Education</th>
				<th>Expected Salary</th>
				<th>Phone Number</th>
				<th>Email</th>
				<th>Specialty</th>
				</tr> 
		<?	while($result = $sth->fetchObject()){
				$sql2 = "SELECT * FROM `jangsc27_cs`.`user_specialty` "."WHERE `user` = ?";
				$sth2 = $db->prepare($sql2);
				$sth2->execute(array($result->account));?>
				<tr>
				<td><? echo $result->id ?></td>
				<td><? echo $result->account ?></td>
				<td><? echo $result->gender ?></td>
				<td><? echo $result->age ?></td>
				<td><? echo $result->education ?></td>
				<td><? echo $result->salary ?></td>
				<td><? echo $result->phone ?></td>
				<td><? echo $result->email ?></td>
				<td style="width:200px;"><div class="flip" id="flip"><h4>click</h4>
				<?
				while($result2=$sth2->fetchObject())
					echo '<p class="flip">'.show_specialty($db,$result2->specialty_id).'</p>';
				?></div></td></tr> 
			<?}?>
				</table>
			</br>
			<input type="image" src="image/back_to_vacancy_job.png" onclick="location.href='employer.php'">
		</div>
	</body>
</html>