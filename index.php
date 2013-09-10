<?php
	 require_once ("classes/dbutility.php");
	 echo '<br><br>---------------Creating Class Files--------------------<br><br>';
 	 $util = new DBUtility();
	 $util->createModelClass("/home/yousee/Downloads/peoples_doctor.sql");
	 echo '---------------Creating Query Class Files--------------------<br><br>';
	 $util->createQuery("/home/yousee/Downloads/peoples_doctor.sql");
?>
