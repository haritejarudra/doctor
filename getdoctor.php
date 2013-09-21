<?php 	
		session_start();
		$thispage = "more";	
		require_once "../prod_conn.php";
		$id=mysql_real_escape_string(trim($_GET['doctor']));
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
 <HEAD>
  <meta http-equiv="content-type" content="text/ html;charset=utf-8">
  <META NAME="Description" CONTENT="UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors, in order to improve access to these services especially for the poor. These sectors need a much larger infusion of capital of various kinds including Financial, Intellectual and Social Capital.">
  <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
  <link rel="stylesheet" type="text/css" href="/css/main.css">
  <link rel="stylesheet" type="text/css" href="/css/div.css">
  <script src="/scripts/jquery.min.js"></script>
  </HEAD>
  <BODY>
  
<!--wrapper-->

<div id="wrapper">

<!--header and navbar -->

<?php include '../header_navbar.php';?>

<!--maincontentarea-->

<div id="uccertificate-main">
<?php 
$query = "SELECT CONCAT('Dr. ',trim(first_name),' ',trim(last_name)) name,doctor.*,s.speciality spec,sub_s.speciality sub_spec FROM doctor JOIN donors on donors.donor_id = doctor.donor_id JOIN speciality_sub_speciality_link sssl ON doctor.speciality_Sub_Speciality_link_id = sssl.speciality_Sub_Speciality_link_id JOIN speciality s ON sssl.speciality_id = s.speciality_id JOIN sub_speciality sub_s ON sssl.sub_speciality_id = sub_s.sub_speciality_id WHERE doctor_id = $id ";
$result=mysql_query($query);
$qualifications_query = "SELECT * FROM qualification WHERE doctor_id = $id ORDER BY year ASC";
while($row=mysql_fetch_array($result)){
?>
<title><?php echo $row['name'];?> | YouSee</title>
<div style="width:800px;border:1px solid #ccc;border-radius:0.2em;padding:10px;margin:10px;">
<table width="100%">
<tr><td>
	<h1 style="padding:0px;font-size:20px;"><?php echo $row['name']; ?></h1>
</td>
</tr>
	<tr>
		<td>Speciality : <?php echo $row['spec'].", ".$row['sub_spec']; ?></td>
	</tr>
<tr>
	
<td>
	<span>Current Hospital : <?php echo $row['current_hospital']; ?></span>
</td>
</tr>

	<tr>
		<td rowspan="10"><h1>Qualifications</h1><table id="table-search" style="border-collapse:collapse" >
		<thead>
			<th align="left">Degree</th>
			<th align="left">Year</th>
			<th align="left">Institution</th></thead>
			<?php 
			$result2 = mysql_query($qualifications_query);
			while($qual=mysql_fetch_array($result2)){
				echo "<tr>
					<td>$qual[degree]</td>
					<td>$qual[year]</td>
					<td>$qual[university]</td>
				</tr>";
			}
			?>
		</table></td>
	</tr>
	<tr></tr>
</table>



</div>
<?php } ?>
</div>
 <?php include '../footer.php' ; ?>

</div>
<!--#footer-->
  </BODY>
  </HTML>