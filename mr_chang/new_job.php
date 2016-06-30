<?php
require_once "sysconfig.php";
session_start();

$sql = "SELECT * FROM `jangsc27_cs`.`occupation` ";
$sth = $db->prepare($sql);
$sth->execute();
echo'<form action="add_job.php" method="Post" >
<td></td><td><select name="occupation">';
while($result = $sth->fetchObject()){
	echo "<option value=$result->id>";
	echo $result->occupation;
	echo '</option>'; 
}
echo '</select></td>
<td><select name="location">';
$sql = "SELECT * FROM `jangsc27_cs`.`location` ";
$sth = $db->prepare($sql);
$sth->execute();
while($result = $sth->fetchObject()){
	echo "<option value=$result->id>";
	echo $result->location;
	echo '</option>'; 
}
echo '</select></td>';
echo '
<td><select name="working">
	<option value="Morning">Morning</option>
	<option value="Afternoon">Afternoon</option>
	<option value="Night">Night</option>
</select></td>
<td><select name="education">
	<option value="Graduate School">Graduate School</option>
	<option value="Undergraduate School">Undergraduate School</option>
	<option value="Senior High School">Senior High School</option>
	<option value="Junior High School">Junior High School</option>
	<option value="Elementary School">Elementary School</option>
</select></td>
<td><select name="experience">
	<option value=0>No experience required</option>
	<option value=1>2 Year</option>
	<option value=2>5 Years</option>
	<option value=3>10 Years</option>
</select></td>
<td><input type="text" name="salary"></td>
<td><input type="image" src="image/add_new_job.png" onclick="send();"/></td>
</form>';

?>
