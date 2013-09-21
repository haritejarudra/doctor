<?php
session_start();
$thispage="more";
require_once ("../prod_conn.php");
if(isset($_POST['reg_app'])){
		
			$_POST['dob']=date("Y-m-d",strtotime($_POST['dob']));
			$_POST['date']=date("Y-m-d",strtotime($_POST['date']));
			$patientquery="INSERT INTO patient (first_name,last_name,email,mobile,gender,age,date_of_birth,address,parent_guardian) VALUES ('$_POST[fname]', '$_POST[lname]', '$_POST[email]', '$_POST[mobile]', '$_POST[gender]', $_POST[age], '$_POST[dob]', '$_POST[address]', '$_POST[parent_guardian]')";
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
				</HEAD>
				<BODY>
					<!--wrapper begin-->
					<div id="wrapper">
						<!--header and navbar -->
						<?php include '../header_navbar.php';?>
						<!--maincontentarea begin-->
						<div id="content-main">
			<?php 
			if($result=mysql_query($patientquery) ){
				$requestquery="INSERT INTO patient_request(patient_id,schedule_id,problem_history,planned_date_consultation,request_status,status_change_date) VALUES (".mysql_insert_id().", $_POST[schedule_id], '$_POST[desc]', '$_POST[date]','Pending', CURDATE())";
				if($result2=mysql_query($requestquery)){
			?>
			<p>Your appointment request has been registered, We have sent an email to <?php $_POST['email'];?> with the appointment details. Please use the email for any future references.  </p>
			<h1>Appointment Details</h1>
			<?php 
			$details = "<div style='width:100%'>
			<table style='border-collapse:collapse;border:1px solid #ccc;background:#eee;' cellpadding='5px' class='table'>
			<tr><td>Appointment ID :</td><td>".mysql_insert_id()."</td></tr>
			<tr><td>Doctor :</td><td> $_POST[doctor]</td></tr>
			<tr><td>Clinic :</td><td> $_POST[clinic]</td></tr>
			<tr><td>Date :</td><td> $_POST[date]</td></tr>
			<tr><td>Time :</td><td> $_POST[time]</td></tr>
			<tr><td>Patient Name :</td><td> $_POST[fname] $_POST[lname]</td></tr>
			<tr><td>Problem Description :</td><td> $_POST[desc]</td></tr>
			</table></div>";
			echo $details;
			$params=
			array(
			$email=$_POST['email'],
			$subject="Ackowledgement - Appointment Request",
			$displayname=$_POST['fname']." ".$_POST['lname'],
			$mailtext="This is to acknowledge that the following request for consultation with Dr. $_POST[doctor] has been submitted by you on UC website Peoples's Doctors page.<br /><br /> $details <br />You may reply to this email or call +91-8008-884422 for any futher information you may like to have from <a href=\"www.yousee.in\">YouSee</a><br /><br />",
			$doc_email = $_POST['doctor_email']
			);
			call_user_func_array('sendEmail',$params);
			}
			}
			?>
			</div>
			<br />
			<br />
			<?php include "../footer.php"; ?>
			</div>
			</BODY>
			</html>
<?php
}
else{
	exit(0);
}
function sendEmail(){
	try{
		
			require_once "../Email/class.phpmailer.php";
			require_once "../Email/config.php";
		$params=func_get_args();
		if(func_num_args()>4){
			$ccadd=$params[4];
			$mail->AddCC($ccadd);
		}
		if(func_num_args()>5){
		for($i=5;$i<func_num_args();$i++){
			$bccadd=$params[$i];
			$mail->AddBCC($bccadd);
		}
		}
		$to = $params[0];
		$mail->AddAddress($to);
	//	$mail->AddBCC("contact@yousee.in");
		$body =  "Dear  " .$params[2]. ",<br><br>".$params[3];
		$body.="<br><br><br> From,<bt /><img src='../images/uc-logo.jpg' alt='YouSee' /><br /> Contact phone : +91-8008-884422 <br /> Website : <a href=\"www.yousee.in\">www.yousee.in</a>";
		$mail->Subject = $params[1];
		$mail->Body = $body;
		if($mail->Send())
		{
			$mail->ClearAllRecipients();
			$mail->ClearAttachments();
			$mail->ClearCustomHeaders();
		}
		else{
			echo "<script>alert('email failed');</script>";
			$mail->ErrorInfo;
			showError();
		}
	}
	catch (phpmailerException $e) {
		echo $e->errorMessage();
		echo "<script>alert('Message failed');</script>";
	}
}
?>