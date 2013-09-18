<script type="text/javascript">
function displayLocationDiv() {
    var selectcity = document.getElementById("city");
    var selectedCityValue = selectcity.options[selectcity.selectedIndex].value;
    var selectedCityName = selectcity.options[selectcity.selectedIndex].text;
 			if(selectedCityValue !='')	{  
				document.getElementById("location_div").style.display="block";
				$('#location_div').load('get_locations.php?city=' + selectedCityName);
			} else 
				{document.getElementById("location_div").style.display="none"; }


   }
function displaySubSpecialityDiv() {
    var selectspec = document.getElementById("speciality");
    var selectedSpecValue = selectspec.options[selectspec.selectedIndex].value;
    var selectedSpecName = selectspec.options[selectspec.selectedIndex].text;
 			if(selectedSpecValue !='')	{  
				document.getElementById("sub_speciality_div").style.display="block";
				$('#sub_speciality_div').load('get_sub_specialities.php?speciality=' + selectedSpecName);
			} else 
				{document.getElementById("sub_speciality_div").style.display="none"; }
   }
</script>
<form method="post" name="search_doctor" action="index.php" >
<div id="search_contents" class="cube-I">
	<div id="search_by">
		<br><br>
		<h3>Search By:</h3>
	</div>
	<div id="speciality_div">
		<p><b><font color="red">Choose Speciality</font></b></p>
		<select name="speciality" id="speciality" style="width:140px;" onchange="displaySubSpecialityDiv();" >
			<option value='' select="selected">--ALL--</option>
			<?php
				foreach($specialities as $nextspec)
				{
					$id=$nextspec->getSpeciality_id();
					$data=$nextspec->getSpeciality();
					echo '<option value="'.$data.'" name="'.$data.'">'.$data.'</option>';
				}
			?>
		</select>
	</div>
	<div id="sub_speciality_div" style="display:none">
		<p><b><font color="red">Choose SubSpeciality</font></b></p>
		<select name="subspeciality" id="subspeciality" style="width:140px;" >
			<option value='' select="selected">--ALL--</option>
			<?php
				foreach($subspecialities as $nextsub)
				{
					$id=$nextsub->getSub_speciality_id();
					$data=$nextsub->getSpeciality();
					echo '<option value="'.$data.'" name="'.$data.'">'.$data.'</option>';
				}
			?>
		</select>
	</div>
	<div id="city_div"> 
		<p><b><font>City </font></b></p>
				<select id="city" name="city" style="width:140px;" onchange="displayLocationDiv();">
					<option value='' select="selected">--ALL--</option>
		<?php
		foreach ($cities as $c) { 
		echo '<option value="'.$c->getCity().','.$c->getLat().','.$c->getLong().'" name="'.$c->getCity().'">'.$c->getCity().'</option>';
				    }
		?>
				</select>


	</div>
	<div id="location_div"  style="display:none">
	</div>
	</br></br>
	<input type="submit" name="Submit" value="Submit">
	 <a style="color:black;text-decoration:none;" href="opencityregistration.php"><font
						color="#369">
						</font> </a> <div style="margin-top: 20px;">
						<div class="button">
						<span class="tooltip">
						 <a> <?php echo "Registration</br>For</br>PATIENTS";?>
						 <span>	
						 					
<form>
<font color="#369">
<div class="button">
			<input type="Radio" name="Registration" value="New Registration">New Registration<br>
</div>
<div class="button">
      		<input type="Radio" name="Registration" value="Already Member">Already Member</form>
</font>
</div>
 </span>
 </span> </a>
 </div>
				 
		            	<div class="button">
						<span class="tooltip">
						 <a> <?php echo "Registration</br>For</br>DOCTORS";?>
						<span>
<form>
<div class="button">
            <font color="#369">
			<input type="Radio" name="Registration" value="New Registration">New Registration<br>
</div>
<div class="button">
      		<input type="Radio" name="Registration" value="Already Member">Already Member</form>
			</font>
</div>
        </span>              </span> </a> </td>
</div>

</form>
