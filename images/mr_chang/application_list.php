<?php
require_once "sysconfig.php";
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
<h1 style="text-align:left;color:#fff355;">Hello <?php echo $_SESSION['admin'];?>  </h1>
<input style="float:left;" type="image" src="image/log_out.png" onclick="location.href='logout.php';"><br>
<link href="style.css" rel="stylesheet" type="text/css" />
        <body>
		<div class="application">
		<p id="Header">Who Applies for Your Job</p>
		<table><col><col><col><col><col><col><col><col><col>
		<?
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
		function show_specialty($db,$id){
			$sql= "SELECT * FROM `jangsc27_cs`.`specialty` "."WHERE `id` = ?";
			$sth = $db->prepare($sql);
			$sth->execute(array($id));
			return $sth->fetchObject()->specialty;
		}
		$sql = "SELECT *,recruit.id AS r_id  FROM `jangsc27_cs`.`recruit`  JOIN `jangsc27_cs`.`employer` ON recruit.employer_id = employer.id WHERE employer.account = ?";
		$sth = $db->prepare($sql);
		$sth->execute(array($_SESSION['admin']));
		while($result = $sth->fetchObject()){
		?>	
			<tr>
			<th><?echo occupation($db,$result->occupation_id)?></th>
			<th><?echo location($db,$result->location_id)?></th>
			<th><?echo $result->working_time?></th>
			<th><?echo $result->education?></th>
			<th><?echo experience($result->experience)?></th>
			<th><?echo $result->salary?></th>
			<th></th><th></th><th></th>
			</tr>		
			<?
			$sql = "SELECT * FROM `user` LEFT JOIN `application` ON user.id = application.user_id WHERE application.recruit_id = ?";
			$sth2 = $db->prepare($sql);
			$sth2->execute(array($result->r_id));
			while($result2 = $sth2->fetchObject()){
				$sql = "SELECT * FROM `specialty` LEFT JOIN `user_specialty` ON specialty.id = user_specialty.specialty_id WHERE user_specialty.user = ?";
				$sth3 = $db->prepare($sql);
				$sth3->execute(array($result2->account));
			?>
				<tr>
				<td><?echo $result2->account?></td>
				<td><?echo $result2->gender?></td>
				<td><?echo $result2->age?></td>
				<td><?echo $result2->education?></td>
				<td><?echo $result2->salary?></td>
				<td><?echo $result2->phone?></td>
				<td><?echo $result2->email?></td>
				<td style="width:200px;"><div class="flip" id="flip"><h4>click</h4>
				<?
				while($result3=$sth3->fetchObject())
					echo '<p class="flip">'.show_specialty($db,$result3->specialty_id).'</p>';
				?></div></td>
				<td>
				<form action="hire.php" method="POST">
				<input name="recruit_id" type="hidden" value="<?echo $result->r_id?>">
				<input name="user_id" type="hidden" value="<?echo $result2->id?>">
				<input type="image" src="image/hire.png" onclick="send();">
				</form>
				</td>
				</tr>		
			<?
			}
		}	
?>
</table></div></body>
</br></br>
<input type="image" src="image/back_to_vacancy_job.png" onclick="location.href='employer.php'">
</html>
