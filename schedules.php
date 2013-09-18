<?php

require_once("classes/scheduleQuery.php");
require_once("classes/schedule.php");
require_once ("classes/Paginated.php");
require_once ("classes/DoubleBarLayout.php");

$NUMBER_OF_RECORDS_PER_PAGE = 20;

$schedq = new scheduleQuery();


if(isset($_GET['page'])&&($_GET['page']!=''))
{
	$page=$_GET['page'];
	$lastcount = ($page-1)*$NUMBER_OF_RECORDS_PER_PAGE;
	$count=$_GET['numberofrecords'];
} else {
	$page=1;
	$lastcount=0;
	$count = $schedq->getCountOfDoctorsByCriteria($speciality, $subspeciality, $chosencity, $chosenlocationid);
}

$schedules=$schedq->getDoctorsByCriteria($speciality, $subspeciality, $chosencity, $chosenlocationid, $lastcount, $NUMBER_OF_RECORDS_PER_PAGE);

//set conditions to supress columns of the listing based on search conditions chosen

?>

<script> 
		<?php if ( (isset($speciality)) && ($speciality != '')) { ?> 
				$(document).ready(function() { $('.speciality').hide();});
	    <?php } ?>			
		<?php if ( (isset($chosenlocationid)) && ($chosenlocationid != '') ) { ?> 
				$(document).ready(function() { $('.location').hide();});
	    <?php } ?>			
		<?php if ( (isset($chosencity)) && ($chosencity != 'ALL') )  { ?> 
				$(document).ready(function() { $('.city').hide();});
		<?php } ?>
</script>

<div id="bookListing" style="width:800px; height: 500px" onload="supressColumns();">
		<br />
		<?php 
			if($schedules==null)
			{
				echo "<br></br><br></br><font style='color:red;font-weight:bold;font-size:16px;text-align:center;padding:20px' >No Schedules Found </font>\n";
				
			}
			else {
?>

		<table id="table-search" style="position:relative;float:left;" width="100%">
		<tr><td colspan="100" style="background:#eee;color:#333;font-size:15px;text-align:center;font-weight:bold;">Books Listing</td></tr>
			<tr style="background: #ccc">
				<th class="category">Doctor</th>
				<th>Speciality</th>
				<th>Sub Speciality</th>
				<th class="city">City</th>
				<th class="location">Location</th>
				<th>View and Commit</th>
			</tr>
			<?php
			$pagedResults = new Paginated($schedules,$count,$NUMBER_OF_RECORDS_PER_PAGE, $page);
			while($schedule = $pagedResults->fetchPagedRow()) { ?>
			<tr align="center">
				<td class="doctor"><?php echo $schedule["doctor"] ?>
				<td class="speciality"><?php echo $schedule["speciality"] ?></td>
				<td class="clinic"><?php echo $schedule["sub speciality"] ?></td>
				<td class="city"><?php echo $schedule["city"] ?></td>
				<td class="location"><?php echo $schedule["location"] ?></td>
			</tr>
			<?php }

			//set all the post or get variables depending on the condition of the schedule listing
			$queryVars = "";
			switch ($condition) {
				/*
				 * Condition 1 from map_doctor_locations for schedule listing
				*
				* 1a - when an icon is clicked on map_doctor_cities the map of all locations in that city is shown along with a list of schedules
				* 1b - when an icon is clicked on map_doctor_locations the map of all locations in the city of that location is shown + schedules
				*
				*/

				case 1:
					if (isset($chosencity) && $chosencity !='') {
						$queryVars .= "&chosencity=".$chosencity;
						$queryVars .= "&lat=".$_GET['lat'];
						$queryVars .= "&long=".$_GET['long'];
						if (isset($chosenlocationid) && $chosenlocationid !='')
							$queryVars .= "&location=".$chosenlocationid;
						$queryVars .= "&condition=1";
						$queryVars .= "&numberofrecords=".$count;
					}
					break;

				/*
				 * Condition 2 from map_doctor_locations for schedule listing
				*
				* 2a - when a search button is clicked after choosing a location ($location)
				* 2b - a location is clicked on the map then list all the schedules in that location
				*
				*/

				case 2:
					//if (isset($citydetails) && $citydetails !='') {
					if (isset($chosencity) && $chosencity !='') {
						$queryVars .= "&chosencity=".$chosencity;
						$queryVars .= "&speciality=".$speciality;
						$queryVars .= "&subspeciality=".$subspeciality;
						$queryVars .= "&location=".$chosenlocationid;
						$queryVars .= "&lat=".$_GET['lat'];
						$queryVars .= "&long=".$_GET['long'];
					}
					$queryVars .= "&condition=2";
					$queryVars .= "&numberofrecords=".$count;
					break;

				/*
				 * Condition 3 from map_doctor_cities for schedule listing
				*
				* when a search button is clicked  without choosing a location but choosing a city
				* then display the locations in the city and the schedules in that city
				*
				*/

				case 3:
					if (isset($chosencity) && $chosencity !='') {
						$queryVars .= "&chosencity=".$chosencity;
						$queryVars .= "&speciality=".$speciality;
						$queryVars .= "&subspeciality=".$subspeciality;
						$queryVars .= "&location=".$chosenlocationid;
						$queryVars .= "&lat=".$_GET['lat'];
						$queryVars .= "&long=".$_GET['long'];
					}
					$queryVars .= "&condition=3";
					$queryVars .= "&numberofrecords=".$count;
					break;

				/*
				 * Condition 4 from map_doctor_cities for book listing
				*
				* when a search button is clicked  without choosing a location
				* show the cities and the books
				*
				*/

				case 4:
					$queryVars .= "&speciality=".$speciality;
					$queryVars .= "&subspeciality=".$subspeciality;
					if(isset($_GET['lat']))
						$queryVars .= "&lat=".$_GET['lat'];
					if(isset($_GET['long']))
						$queryVars .= "&long=".$_GET['long'];
					$queryVars .= "&condition=4";
					$queryVars .= "&numberofrecords=".$count;

					break;

				default:
					$queryVars .= "&speciality=".$speciality;
					$queryVars .= "&subspeciality=".$subspeciality;
					if(isset($_GET['lat']))
						$queryVars .= "&lat=".$_GET['lat'];
					if(isset($_GET['long']))
						$queryVars .= "&long=".$_GET['long'];
					$queryVars .= "&condition=4";
					$queryVars .= "&numberofrecords=".$count;

					break;

			}
			?>
			<tr>
				<?php   			
				$pagedResults->setLayout(new DoubleBarLayout());
				echo $pagedResults->fetchPagedNavigation($queryVars);
				?>
			</tr>
		</table>
		<table width="100%"><tr><td><?php echo $pagedResults->fetchPagedNavigation($queryVars); }?></td></tr></table>

	</div>


