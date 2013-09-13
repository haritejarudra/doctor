<?php
session_start();
$thispage="more";
require_once ("shared/global_constants.php");
require_once ("classes/CityQuery.php");
require_once ("classes/City.php");
require_once ("classes/SpecialityQuery.php");
require_once ("classes/Speciality.php");

$cityq = new CityQuery ();
$cities = $cityq->getCities ();

$specq = new SpecialityQuery ();
$specialities = $specq->getSpecialities ();

// initialize these variables
$chosencity = '';
$chosenlocationid='';
$searchlocation = '';
$speciality = '';
$subspeciality = '';

//condition 1 - city is clicked on cities map to get a map of all locations in the city having a Peoples Doctor Clinic and list of clinics in the table
//condition 2 - location is clicked on locations map  OR (location is selected from search bar PLUS any of Speciality and Sub Speciality conditions)
//condition 3 - city is selected from search bar without choosing location  PLUS any of Speciality and Sub Speciality conditions
//condition 4 - Submit is clicked without choosing any parameters



if (isset ( $_GET ['page'] ) && $_GET ['page'] != '') {
	
	$condition = $_GET ['condition'];
	
	if ($condition == 1) {
		$chosencity = $_GET ['chosencity'];

	} else if ($condition == 2) {
		
		$speciality = $_GET ['speciality'];
		$chosencity = $_GET ['chosencity'];
		$lat = $_GET ['lat'];
		$long = $_GET ['long'];

		if(isset($_GET['location']))
			$chosenlocationid = $_GET ['location'];

	} else if ($condition == 3) {
		
		$speciality = $_GET ['speciality'];
		$chosencity = $_GET ['chosencity'];
		$lat = $_GET ['lat'];
		$long = $_GET ['long'];

	} else if ($condition == 4) {
		
		$speciality = $_GET ['speciality'];
	}

} else if ((isset ( $_POST ['Submit'] ))) {

	$speciality = $_POST ['speciality'];
	
	$citydetails = explode ( ",", $_POST ['city'] );
	
	if (($citydetails != "") && ($citydetails [0] != "")) {
		
		if (isset ( $_POST ['locationid'] ) && ($_POST ['locationid'] != '')) {
			$chosenlocationid = $_POST ['locationid'];
			$condition = 2;
		} else
			$condition = 3;
		$chosencity = $citydetails [0];
		$lat = $citydetails [1];
		$_GET ['lat'] = $lat;
		$long = $citydetails [2];
		$_GET ['long'] = $long;
	} else {
		$condition = 4;
	}
} // this page can be re-entered when a city or location is chosen from the map. the $chosencity or $chosenlocationid variable gets the city or location is chosen.
else if (isset ( $_GET ['chosencity'] ) && $_GET ['chosencity'] != '') {
	$chosencity = $_GET ['chosencity'];
	$condition = 1;
}else if (isset ( $_GET ['locationid'] ) && $_GET ['locationid'] != '') {
	$chosenlocationid = $_GET ['locationid'];
	$condition = 1;
} else
	$condition = 4;

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
<HEAD>
<TITLE>UC is an exchange platform to channel Philanthropic Resources to
	Education, Health and Environmental services sectors</TITLE>
<meta http-equiv="content-type" content="text/ html;charset=utf-8">
<META NAME="Description"
	CONTENT="UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors, in order to improve access to these services especially for the poor. These sectors need a much larger infusion of capital of various kinds including Financial, Intellectual and Social Capital.">
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<link rel="stylesheet" type="text/css" href="../css/main.css">
<link rel="stylesheet" type="text/css" href="../css/div.css">
<link rel="stylesheet" type="text/css" href="../css/opencity.css">
<link rel="stylesheet" href="../scripts/jquery-ui.css">
<script src="../scripts/jquery.min.js"></script>
<style type="text/css">
div.button{
padding:10px;font-size:13px;font-weight:bold;text-align:center;border:1px solid #333; 
border-radius:1em;background-color:rgba(194,194,194,0.1);transition:background-color 1s;
position:relative;
margin-bottom:20px;
}
div.button:hover{
	background-color:rgba(194,194,194,0.5);
}
div#searchAllConditionsDisplayed, div#searchConditionsDisplayed {
	padding-top:10px;
	margin-bottom:-20px !important;
}
</style>

</HEAD>
<BODY>

	<!--wrapper begin-->
	<div id="wrapper">

		<!--header and navbar -->
		<?php include '../header_navbar.php';?>
		<!--maincontentarea begin-->
		<div id="content-main">
			<table style="margin-bottom:80px;">
				<tr>
					<td colspan="4">
					</td>
				</tr>
				<tr>
					<td valign="top">
							<?php include 'search_doctor.php';?>
						<div class="button">
						 <a style="color:black;text-decoration:none;" href="opencityregistration.php"><font
						color="#369"> <?php echo "Get Membership!";?>
						</font></a>
						</div>
						<div class="button">
						<span class="tooltip">
						 <a> <?php echo "Start a People's Library";?>
						<span>
						To start a People's Library in your community, you can contact us at<br />Email : contact@yousee.in<br />Phone : +91-8008-884422 </span></a>
						</span>
						</div>
					</td>
				<td valign="top"><?php
						// when a city is clicked upon in the map, display the locations of the city that have a open library
						if ($condition == 1 || $condition == 2 || $condition == 3) {
							?>
						<div align="justify">
							 <br> 
							 <font style="font-size:15px;color:#369;font-weight:bold;font-family:Trebuchet MS;">People's Library</font>
							 <p style="color:#666;font-size:12px;font-family:Trebuchet MS;"><b>People's Library</b> is an attempt to bring libraries closer to people and in the process bring the community together. The way it works is as follows.
							 Donated books have been selected by volunteers to start a library at a location of their choice; residents of the community can borrow books from these libraries at specified times scheduled by the volunteer librarian.
							 Books are tracked by the librarian using an open source online library management system customized by UC volunteers.<br /><br />
							 <font style='color:#666;font-weight:normal;font-size:12px;'>To browse books in the Library click on any of the locations shown in the map below or use the search bar on the left for advanced search.
							</font><br><br> 
						</div>
						<div id="mapLocations">
							<?php
							include 'map_doctor_locations.php';
							?>
						</div> 
						<?php
						} else {
							?>
						<div align="justify">
							 <br> 
							 <font style="font-size:15px;color:#369;font-weight:bold;font-family:Trebuchet MS;">People's Library</font>
							 <p style="color:#666;font-size:12px;font-family:Trebuchet MS;"><b>People's Library</b> is an attempt to bring libraries closer to people and in the process bring the community together. The way it works is as follows.
							 Donated books have been selected by volunteers to start a library at a location of their choice; residents of the community can borrow books from these libraries at specified times scheduled by the volunteer librarian.
							 Books are tracked by the librarian using an open source online library management system customized by UC volunteers.<br /><br />
							 <font style='color:#666;font-weight:normal;font-size:12px;'>Click on any of the cities shown in the map below to get a list of Library locations and a listing of books in that city. You can also use the search bar on the left for advanced search.
							</font><br><br> 
						</div>
							<div id="mapCitiesWithDoctors">
							<?php
							include 'map_doctor_cities.php';
							?>
						</div>
						</div> 
						<?php
						}?>
						<div id="conditionsFromMap">
							<?php 
							include 'display_search_conditions.php';
						?>
						</div> 
						<div  id="ListingSchedulesForClick">
							<?php
							include 'schedules.php';
							?>
						</div>
					</td>
				</tr>
			</table>
			</div>
			<?php  include '../footer.php' ;?>

</div>
</BODY>
</HTML>

