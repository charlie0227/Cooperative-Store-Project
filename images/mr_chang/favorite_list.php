<?php
require_once "sysconfig.php";
?>
<html>
<link href="style.css" rel="stylesheet" type="text/css" />
<h1 style="text-align:left;color:#fff355;">Hello <?php echo $_SESSION['admin'];?>  </h1>
<input style="float:left;" type="image" src="image/log_out.png" onclick="location.href='logout.php';"><br>
<body>
	<div class="jobseeker">
		<p style="font-size:40px;">Job Vancancy</p>
			<table><col><col><col><col><col><col><col><col><tr>
				<th>ID</th>
				<th>Occupation</th>
				<th>Location</th>
				<th>Working</th>
				<th>Education</th>
				<th>Experience</th>
				<th>Salary</th>
				<th>Operation</th>
				</tr> 
			<?
			function jobseeker_id($db){
				$sql = "SELECT * FROM `jangsc27_cs`.`user` WHERE `account`=?";
				$sth = $db->prepare($sql);
				$sth->execute(array($_SESSION['admin']));
				return $sth->fetchObject()->id;
			}
			function occupation($db,$id){
				$sql = "SELECT * FROM `jangsc27_cs`.`occupation` WHERE `id`=?";
				$sth = $db->prepare($sql);
				$sth->execute(array($id));
				return $sth->fetchObject()->occupation;
			}
			function location($db,$id){
				$sql = "SELECT * FROM `jangsc27_cs`.`location` WHERE `id`=?";
				$sth = $db->prepare($sql);
				$sth->execute(array($id));
				return $sth->fetchObject()->location;
			}
			function experience($id){
				if($id==0) return 'No experience required';
				if($id==1) return '2 Year';
				if($id==2) return '5 Years';
				if($id==3) return '10 Years';	
			}

			$sql = "SELECT * FROM `jangsc27_cs`.`recruit` LEFT JOIN `jangsc27_cs`.`favorite` ON recruit.id = favorite.recruit_id WHERE favorite.user_id = ?";
			$sth = $db->prepare($sql);
			$sth->execute(array(jobseeker_id($db)));
			
			while($result = $sth->fetchObject()){?>
					<tr>
					<td><?echo $result->id?></td>
					<td><?echo occupation($db,$result->occupation_id)?></td>
					<td><?echo location($db,$result->location_id)?></td>
					<td><?echo $result->working_time?></td>
					<td><?echo $result->education?></td>
					<td><?echo experience($result->experience)?></td>
					<td><?echo $result->salary?></td>
					<td>
					<form  id="inline" action="favorite.php" method="POST">
					<input name="recruit_id" value="<?echo $result->id?>" type="hidden">
					<input name="jobseeker_id" value="<?echo jobseeker_id($db)?>" type="hidden">
					<input name="way" value="delete" type="hidden">
					<input id="favorite" type="image" src="image/favorite.png" onclick="send();"></form>
					</td>
					</tr><?
			}?>
		</table>
	</div>
</body>
</br>
<input type="image" src="image/back_to_vacancy_job.png" onclick="location.href='jobseeker.php'">		
</html>


