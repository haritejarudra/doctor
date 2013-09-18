<?php
	 require_once ("../classes/dbutility.php");
	 echo '<br><br>---------------Creating Class Files--------------------<br><br>';
 	 $util = new DBUtility();
	 $util->createModelClass("patient_request.sql");
	 echo '<BR>---------------Creating Query Class Files--------------------<br><br>';
	 $util->createQuery("patient_request.sql");
?>
