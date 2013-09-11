<?php
	 require_once ("classes/dbutility.php");
	 echo '<br><br>---------------Creating Class Files--------------------<br><br>';
 	 $util = new DBUtility();
	 $util->createModelClass("C:\Users\RishiSharan\Documents\peoples_doctor_h.sql");
	 
	 echo '---------------Creating Query Class Files--------------------<br><br>';
	 $util->createQuery("C:\Users\RishiSharan\Documents\peoples_doctor_h.sql");
?>
