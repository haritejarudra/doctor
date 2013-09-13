<?php
require_once ("classes/sub_specialityQuery.php");
require_once ("classes/sub_speciality.php");

 $speciality = $_GET['speciality'];
 $subspecq = new sub_specialityQuery();
 $subspecialities = $subspecq->getSubSpecialitiesFor($speciality);
?>
<p><b><font color="red">Choose Sub Speciality</font></b></p>
		<select name="subspecialityid" style="width:140px;">
			<option value='' select="selected">--ALL--</option>
<?php
 foreach ($subspecialities as $subspeciality) { 
				echo '<option value="'.$subspeciality->getLocation_id().'">'.$subspeciality->getLocation().'</option>';
			    }
?>
		</select>

