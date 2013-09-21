<?php
session_start();
$thispage="more";
require_once ("../prod_conn.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
<HEAD>
<meta http-equiv="content-type" content="text/ html;charset=utf-8">
<META NAME="Description"
	CONTENT="UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors, in order to improve access to these services especially for the poor. These sectors need a much larger infusion of capital of various kinds including Financial, Intellectual and Social Capital.">
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<title>People's Doctors | YouSee</title>
<link rel="stylesheet" type="text/css" href="../css/main.css">
<link rel="stylesheet" href="../scripts/jquery-ui.css">
<script src="../scripts/jquery.min.js"></script>
	<script src="../scripts/jquery.ui.core.js"></script>
	<script src="../scripts/jquery.ui.widget.js"></script>
	<script src="../scripts/datepicker.js"></script>
<script>
$(function(){
	$("#dob").datepicker({
	});
});
</script>
<style>
	input.patient{
		width:300px;
		height:30px;
		border-radius:0.2em;
		border:1px solid #ccc;
		padding:5px;
		margin:5px;
		font-size:15px;
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
		
		<div class="patient_form">
		<fieldset style="border:1px solid #ccc;border-radius:0.2em;margin:10px;padding:10px;" >
			<legend><h1>Reuqest Appointment Form</h1></legend>
			<form action="register_appointment.php" method="POST">
			<?php 
		if(isset($_GET['schedule'])){
			$schedule_id = mysql_real_escape_string(trim($_GET['schedule']));
			$result=mysql_query("SELECT CONCAT(first_name,' ',last_name) doctor, preferred_email doctor_email, description clinic,location,from_date,to_date,expiry_date,days_of_week,CONCAT(date_format(from_time,'%h:%i %p'),' to ',date_format(to_time,'%h:%i %p'))time FROM doctor JOIN donors ON doctor.donor_id=donors.donor_id JOIN schedule ON doctor.doctor_id=schedule.doctor_id JOIN location ON schedule.location_id = location.location_id WHERE schedule_id =$schedule_id");
			while($row=mysql_fetch_array($result)){
				echo "
				<table style='border:1px solid #ccc;border-radius:0.2em;width:500px;padding:10px;margin:5px;background:#eee;' cellpadding='5px'>
				<tr><td align='right'>
				Doctor :</td> <td>$row[doctor]<input type='text' value='$row[doctor]' name='doctor' hidden /></td></tr>
				<tr>
				<td  align='right'>
				Clinic Description : </td>
				<td>$row[clinic] <input type='text' value='$row[clinic]' name='clinic' hidden /> </td>
				</tr>
				<tr>
				<td align='right'>
				Location :
				</td>
				<td> $row[location]<input type='text' value='$row[location]' name='clinic_loc' hidden /></td>
				</tr>
				<tr>
				<td align='right'>
				Timings :
				</td>
				<td> $row[time]<input type='text' value='$row[time]' name='time' hidden /><input type='text' value='$row[doctor_email]' name='doctor_email' hidden /></td>
				</tr>
				</table>";
				if($row['from_date']==$row['to_date'] && $row['from_date']!='0000-00-00'){
				?>
				<script>
				$(function(){
					$("#appointment_date").val("<?php echo date('d-M-Y',strtotime($row['from_date'])); ?>");
					$("#appointment_date").prop('readOnly',true);
				});
				</script>
				<?php
				}
				elseif($row['days_of_week']!=''){
					$days=explode(",",$row['days_of_week']);
				?>
				<script>
					$(function(){
						$('#appointment_date').datepicker({
							beforeShowDay : function(date){
								var day=date.getDay();
								 if(day == <?php echo $days[0]; foreach($days as $day){echo ' || day=='.$day;}?>){
									return [true,'','Available'];
								}
								else {
									return [false,'','Unavailable'];
								}
							},
							minDate : 0,
							maxDate : '+3M'
						});		
					});
				</script>
				<?php
				}
				else{
					?>
				<script>
				$(function(){
				var fromdate = new Date(<?php echo date("Y,m-1,d",strtotime($row['from_date']));?>);
				var todate = new Date(<?php echo date("Y,m-1,d",strtotime($row['to_date']));?>);
				$('#appointment_date').datepicker({
				minDate : fromdate,
				maxDate : todate
				});
				});
				</script>
				<?php	
				 }
			}
		}
		?>
			<div><textarea style="width:500px;height:100px;border:1px solid #ccc;border-radius:0.2em;padding:5px;margin:5px;" placeholder="Describe your problem (Symptoms and medical history)" name="desc" id="description" required class="patient" ></textarea></div>
			<div><input name="date" type="text" placeholder="Select a Date" id="appointment_date" required class="patient"/></div>			<hr>
			<h1>Personal Info</h1>
			<div><input type="text" name="fname" placeholder="First Name" class="patient" required /></div>
			<div><input type="text" name="lname" placeholder="Last Name" class="patient" required /></div>
			<div><input type="text" name="email" placeholder="Email" class="patient" required /></div>
			<div><input type="number" maxlength="10" name="mobile" placeholder="Mobile number" class="patient" required /></div>
			<div style="width:300px;height:30px;padding:5px;margin:5px;font-size:14px;">Gender : <input type="radio" name="gender" value="M" id="male" required /><label for="male">Male</label><input type="radio" name="gender" value="F" id="female" required />
			<label for="female">Female</label></div>
			<div><input type="text" name="age" placeholder="Age" class="patient" maxlength="3" required /></div>
			<div><input type="text" name="dob" id="dob" placeholder="Date of Birth" class="patient" /></div>
			<div><textarea  style="width:500px;height:100px;border:1px solid #ccc;border-radius:0.2em;padding:5px;margin:5px;" name="address" placeholder="Address" required></textarea></div>
			<div><input type="text" name="parent_guardian" placeholder="Parent/Guardian Name (Only for Minors)" class="patient" /></div>
			<div><input type="text" name="schedule_id" value="<?php echo $schedule_id;?>" class="patient" hidden /></div>
			<div><input type="submit" name="reg_app" value="Request an Appointment" style="width:200px;height:50px;padding:10px;margin:10px;border-radius:0.2em;border:1px solid #ccc;cursor:pointer;" /></div>
		</form>
		</fieldset>
		</div>
		</div>
		<?php include '../footer.php';?>
	</div>
</BODY>
</HTML>