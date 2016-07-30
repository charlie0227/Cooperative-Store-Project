<?php
require_once "sysconfig.php";
?>
<html>
<link href="style.css" rel="stylesheet" type="text/css" />
	<body>
		<div class="jobseeker">
		<?php
			function employer($db,$id){
				$sql = "SELECT * FROM `jangsc27_cs`.`employer` WHERE `id`=?";
				$sth = $db->prepare($sql);
				$sth->execute(array($id));
				return $sth->fetchObject()->account;
			}
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
			$way = isset($_SESSION['way'])?$_SESSION['way']:'id ASC';
			$_SESSION['search']=isset($_SESSION['search'])?$_SESSION['search']:'';
			$sql = "SELECT * FROM `jangsc27_cs`.`recruit` ".$_SESSION['search']." ORDER BY $way";
			$sth = $db->prepare($sql);
			$sth->execute();
			?>
				<p style="font-size:40px;">Job Vancancy</p>
				<form id="inline" action="search.php" method="POST">
					<input id="block" style="width:120px;" type="text" name="s_occupation" placeholder="Occupation">
					<input id="block" style="width:100px;" type="text" name="s_location"   placeholder="Location">
					<input id="block" style="width:120px;" type="text" name="s_work_time"  placeholder="Work time">
					<input id="block" type="text" name="s_education"  placeholder="Education Required">
					<input id="block" type="text" name="s_experience" placeholder="Working Experience">
					<select id="block" style="width:220px;" name="s_salary">
						<option value=0>No matter How much</option>
						<option value=20000><20000</option>
						<option value=40000>20001~40000</option>
						<option value=60000>40001~60000</option>
						<option value=80000>60001~80000</option>
						<option value=99999>>80001</option>
					</select>
					<input type="image" src="image/search.png" onclick="send()">
				</form>
				<input type="image" src="image/clear.png" onclick="location.href=('search_clear.php')">
				<table><col><col><col><col><col><col><col><?if($_SESSION['authority']){ echo '<col>';}?><tr>
				<th>ID
				<form id="inline" action="sort.php" method="POST"><input type="image" src="image/down_key.png"   name="way" value="id" onclick="send();"></form>
				</th>
				<th>Occupation</th>
				<th>Location</th>
				<th>Working</th>
				<th>Education</th>
				<th>Experience</th>
				<th>Salary
				<form style="display:inline;" action="sort.php" method="POST"><input type="image" src="image/up_key.png"   name="way" value="salary DESC,id ASC" onclick="send();"></form>
				<form style="display:inline;" action="sort.php" method="POST"><input type="image" src="image/down_key.png" name="way" value="salary ASC ,id ASC" onclick="send();"></form>
				</th>
				<?if($_SESSION['authority']){ echo '<th>Operation</th>';}?>
				</tr> 
			<?while($result = $sth->fetchObject()){  
				if($_SESSION['edit']!=$result->id){
					echo '<tr>
					<td>'.$result->id.'</td>
					<td>'.occupation($db,$result->occupation_id).'</td>
					<td>'.location($db,$result->location_id).'</td>
					<td>'.$result->working_time.'</td>
					<td>'.$result->education.'</td>
					<td>'.experience($result->experience).'</td>
					<td>'.$result->salary.'</td>';
					if($_SESSION['authority']){ echo '<td>';
						if($_SESSION['admin']==employer($db,$result->employer_id)){?>
							<form id="button1" action="edit.php" method="POST">
							<input value="<?echo $result->id?>" type="hidden" name="edit_id">
							<input type="image" src="image/edit.png" onclick="send();"></form>
							<form id="button2" action="delete_job.php" method="POST">
							<input value="<?echo $result->id?>" type="hidden" name="delete_id">
							<input type="image" src="image/delete.png" onclick="send();"></form><?
							}
						if($_SESSION['authority']=='jobseeker'){
							$sql = "SELECT * FROM `jangsc27_cs`.`application` WHERE `user_id`=? AND `recruit_id`=?";
							$sth2 = $db->prepare($sql);
							$sth2->execute(array(jobseeker_id($db),$result->id));
							if(!$sth2->fetchObject()){?>
								<form id="button1" action="apply.php" method="POST">
								<input name="recruit_id" value="<?echo $result->id?>" type="hidden">
								<input name="jobseeker_id" value="<?echo jobseeker_id($db,$_SESSION['admin'])?>" type="hidden">	
								<input type="image" src="image/apply.png" onclick="send();"></form>
							<?}
							else{?>
								<p id="waiting">Waiting for <br>employer</p>	
							<?}
							$sql = "SELECT * FROM `jangsc27_cs`.`favorite` WHERE `user_id`=? AND `recruit_id`=?";
							$sth2 = $db->prepare($sql);
							$sth2->execute(array(jobseeker_id($db),$result->id));
							if(!$sth2->fetchObject()){?>
								<form  id="inline" action="favorite.php" method="POST">
								<input name="recruit_id" value="<?echo $result->id?>" type="hidden">
								<input name="jobseeker_id" value="<?echo jobseeker_id($db)?>" type="hidden">
								<input name="way" value="add" type="hidden">
								<input id="favorite" type="image" src="image/vacant_favorite.png" onclick="send();"></form><?
							}
							else{?>
								<form  id="inline" action="favorite.php" method="POST">
							        <input name="recruit_id" value="<?echo $result->id?>" type="hidden">
								<input name="jobseeker_id" value="<?echo jobseeker_id($db)?>" type="hidden">
							        <input name="way" value="delete" type="hidden">
							        <input id="favorite" type="image" src="image/favorite.png" onclick="send();"></form><?
							}
						}

						echo '</td>';
					}
					echo '</tr>';
				}
				else{
					$sql = "SELECT * FROM `jangsc27_cs`.`occupation` ";
					$sth1 = $db->prepare($sql);
					$sth1->execute();
					echo' <form action="edit_confirm.php" method="Post" >
					<tr><td>'.$result->id.'</td><td><select name="occupation" >';
					while($result1 = $sth1->fetchObject()){
						if($result->occupation_id==$result1->id)
							echo '<option selected="selected" value='.$result1->id.'>'.$result1->occupation.'</option>'; 
						else
							echo '<option value='.$result1->id.'>'.$result1->occupation.'</option>'; 
					}
					echo '</select></td>
					<td><select name="location" selected="selected">';
					$sql = "SELECT * FROM `jangsc27_cs`.`location` ";
					$sth1 = $db->prepare($sql);
					$sth1->execute();
					while($result1 = $sth1->fetchObject()){
						if($result->location_id==$result1->id)
							echo '<option selected="selected" value='.$result1->id.'>'.$result1->location.'</option>'; 
						else
							echo '<option value='.$result1->id.'>'.$result1->location.'</option>'; 
					}
					echo '</select></td>';
					$sql = "SELECT * FROM `jangsc27_cs`.`recruit` WHERE id = ?";
					$sth1 = $db->prepare($sql);
					$sth1->execute(array($result->id));
					$result1=$sth1->fetchObject();
					echo '
					<td><select name="working">';
						if($result1->working_time=="Morning") 
							 echo '<option selected="selected" value="Morning">Morning</option>';
						else echo '<option value="Morning">Morning</option>';
						if($result1->working_time=="Afternoon") 
							 echo '<option selected="selected" value="Afternoon">Afternoon</option>';
						else echo '<option value="Afternoon">Afternoon</option>';
						if($result1->working_time=="Night") 
							 echo '<option selected="selected" value="Night">Night</option>';
						else echo '<option value="Night">Night</option>
					</select></td>
					<td><select name="education">';
						if($result1->education=="Graduate School")
							 echo '<option selected="selected" value="Graduate School">Graduate School</option>';
						else echo '<option value="Graduate School">Graduate School</option>';
						if($result1->education=="Undergraduate School")
							 echo '<option selected="selected" value="Undergraduate School">Undergraduate School</option>';
						else echo '<option value="Undergraduate School">Undergraduate School</option>';
						if($result1->education=="Senior High School")
							 echo '<option selected="selected" value="Senior High School">Senior High School</option>';
						else echo '<option value="Senior High School">Senior High School</option>';
						if($result1->education=="Junior High School")
							 echo '<option selected="selected" value="Junior High School">Junior High School</option>';
						else echo '<option value="Junior High School">Junior High School</option>';
						if($result1->education=="Elementary School")
							 echo '<option selected="selected" value="Elementary School">Elementary School</option>';
						else echo '<option value="Elementary School">Elementary School</option>
						</select></td>
					<td><select name="experience">';
						if($result1->experience==0)
							 echo '<option selected="selected" value=0>No experience required</option>';
						else echo '<option value=0>No experience required</option>';
						if($result1->experience==1)
							 echo '<option selected="selected" value=1>1 Year</option>';
						else echo '<option value=1>2 Year</option>';
						if($result1->experience==2)
							 echo '<option selected="selected" value=2>2 Years</option>';
						else echo '<option value=2>5 Years</option>';
						if($result1->experience==3)
							 echo '<option selected="selected" value=3>3 Years</option>';
						else echo '<option value=3>10 Years</option>
						</select></td>
					<td><input type="text" name="salary" value="'.$result->salary.'"></td>
					<input value='.$result->id.' type="hidden" name="edit_id">
					<td>
						<input id="button1" type="image" src="image/confirm.png" onclick="send()"></form>
						<input id="button2" type="image" src="image/cancel.png" onclick="location.href=';echo "'edit_cancel.php'";echo ';">
					</td>
					</tr>';
				}
			}
			if($_SESSION['authority']==employer && !$_SESSION['edit']){
				echo '<tr>';
				include("new_job.php");
				echo '</tr>';
			}
			echo '</table>';
			?>
		</div>
	</body>
</html>
