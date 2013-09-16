
	<div id="searchConditionsDisplayed" style="width: 800px; height: 50px">
		<table>
			<tr><font style=" color:#369;font-weight:normal;font-size:12px;"><br>Search By: </font>
			<font style=" color:#369;font-weight:normal;font-size:11px;">&nbsp;&nbsp;&nbsp;
			<?php if ((isset($speciality)) && ($speciality != '') && ($speciality != ' ')) echo "Speciality: "?></font>
			<font style=" color:#333;font-weight:bold;font-size:11px;">
			<?php echo $speciality." ";?></font>
			<font style=" color:#369;font-weight:normal;font-size:11px;">&nbsp;&nbsp;&nbsp;
			<?php if ((isset($subspeciality)) && ($subspeciality != '')  && ($subspeciality != ' ') ) echo "SubSpeciality: ";?>&nbsp;</font>
			<font style=" color:#333;font-weight:bold;font-size:11px;">
			<?php echo $subspeciality." ";?></font>
			<font style="color:#369;font-weight:normal;font-size:11px;">&nbsp;&nbsp;&nbsp;
			<?php if ((    (isset($_POST['city'])) && ($_POST['city'] != '')  && ($_POST['city'] != ' ') )  || 
				  (    (isset($_GET['chosencity'])) && ($_GET['chosencity'] != '') && ($_GET['chosencity'] != ' ') ) || 
				  (    (isset($chosencity)) && ($chosencity != '') && ($chosencity != ' ') ) 
				 ) echo "City: ";?>&nbsp;&nbsp;</font>
			<font style="color:#333;font-weight:bold;font-size:11px;">
			<?php echo $chosencity." ";?></font>
			<font style="color:#369;font-weight:normal;font-size:11px;">&nbsp;&nbsp;&nbsp;
			<?php if ( isset($_POST['locationid']) && ($_POST['locationid']!='') ) {
				$locq=new locationQuery();
				$searchedloc=$locq->selectLocation_id($_POST['locationid']);	
				$searchlocation=$searchedloc->getLocation();
				echo "Location: ";
			}
			else if(isset($_GET['location'])){
				$locq=new locationQuery();
				$searchedloc=$locq->selectLocation_id($_GET['location']);	
				$searchlocation=$searchedloc->getLocation();
				echo "Location: ";
			}
			else if ((isset($chosenlocationid)) && ($chosenlocationid!=0) ) {
				$locq=new locationQuery();
				$searchedloc=$locq->selectLocation_id($chosenlocationid);	
				$searchlocation=$searchedloc->getLocation();
				echo "Location: ";
			}
			?>&nbsp;</font>
			<font style=" color:#333;font-weight:bold;font-size:11px;">
			<?php echo $searchlocation; ?>
				</font>
			</tr>
		</table>
	</div>
