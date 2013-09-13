<?php
 require_once("classes/locationQuery.php");
 require_once("classes/location.php");
 $city = $_GET['city'];
 $locq = new locationQuery();
 $locations = $locq->getLocationsForCity($city);
?>
<p><b><font color="red">Choose Location</font></b></p>
		<select name="locationid" style="width:140px;">
			<option value='' select="selected">--ALL--</option>
<?php
 foreach ($locations as $l) { 
				echo '<option value="'.$l->getLocation_id().'">'.$l->getLocation().'</option>';
			    }
?>
		</select>

