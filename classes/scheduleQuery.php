<?php 
require_once ("classes/Query.php");
require_once ("classes/schedule.php");
class ScheduleQuery extends Query {
	var $_rowCount = 0;
	function ScheduleQuery () {
		$this->Query();
	}
	function getRowCount() {
		return $this->_rowCount;
	}
	function fetchSchedule() {
		$array = $this->_conn->fetchRow();
		if ($array == false) {
			return false;
		}
		return $this->_mkObj($array);
	}
	function _mkObj($array) {
		$obj = new Schedule();
		$obj->setSchedule_id($array["schedule_id"]);
		$obj->setFrom_date($array["from_date"]);
		$obj->setTo_date($array["to_date"]);
		$obj->setExpiry_date($array["expiry_date"]);
		$obj->setDays_of_week($array["days_of_week"]);
		$obj->setFrom_time($array["from_time"]);
		$obj->setTo_time($array["to_time"]);
		$obj->setLocation_id($array["location_id"]);
		$obj->setDoctor_id($array["doctor_id"]);
		$obj->setDescription($array["description"]);
		return $obj;
	}
	/********************************************************************************
	*  this query returns schedule details for a given doctor at a location
	*
	* @param string city
	* &param
	* @return Copy returns copy or false, if error occurs
	* @access public
	********************************************************************************
	*/
	function getSchedulesByCriteria($doctorid, $chosenlocationid) {
			$sqlstring  = "select b.schedule_id schedule_id, b.description as clinic,
			IF( b.from_date = b.to_date AND b.from_date!='0000-00-00', date_format(b.from_date,'%D-%b-%Y'), IF( b.days_of_week != '' , b.days_of_week, CONCAT(date_format(b.from_date,'%D-%b-%Y'),' to ',date_format(b.to_date,'%D-%b-%Y')))) date, date_format(b.from_time,'%h:%i %p') as 'from', date_format(b.to_time, '%h:%i %p') as 'to' ";
			$sqlstring .= " from doctor a, schedule b";
			$sqlstring .= " where a.doctor_id = " . $doctorid . " and a.doctor_id = b.doctor_id";
			if($chosenlocationid!=NULL){
			    $sqlstring .= " and b.location_id = " . $chosenlocationid;
			}
			return $this->exec($sqlstring);
    	}	
	/********************************************************************************
	*  this query returns all doctors who have a free clinic at a given location
	*
	* @param string city
	* &param
	* @return Copy returns copy or false, if error occurs
	* @access public
	********************************************************************************
	*/
	function getDoctorsByCriteria($speciality, $subspeciality, $chosencity, $chosenlocationid, $last,$count) {
		$sqlstring  = "select x.doctor_id, concat(a.first_name, ' ', a.last_name) as doctor, d.speciality as speciality, e.speciality as 'sub speciality',";
		$sqlstring .= " g.city as city, f.location as location";
		$sqlstring .= " from donors a, doctor x, schedule b, speciality_sub_speciality_link c, speciality d, sub_speciality e, location f, city g";
		$sqlstring .= " where a.donor_id = x.donor_id and x.doctor_id = b.doctor_id and x.speciality_Sub_Speciality_link_id = c.speciality_Sub_Speciality_link_id";
		$sqlstring .= " and c.speciality_id = d.speciality_id and c.sub_speciality_id = e.sub_speciality_id";
		$sqlstring .= " and b.location_id = f.location_id and f.city_id = g.city_id";

		if ( !(empty($speciality)) && (strlen($speciality) > 0) )
			$sqlstring .= " and d.speciality = '" . $speciality . "'";

		if ( !(empty($subspeciality)) && (strlen($subspeciality) > 0) )
			$sqlstring .= " and e.speciality = '" . $subspeciality . "'";

		if ( !(empty($chosencity)) && (strlen($chosencity) > 0) )
			$sqlstring .= " and g.city = '". $chosencity . "'";

		if ( !(empty($chosenlocationid)) && (strlen($chosenlocationid) > 0) )
			$sqlstring .= " and f.location_id = ". $chosenlocationid;
		
		$sqlstring .= " group by doctor_id, doctor, Speciality, 'Sub Speciality', city, location";
		$sqlstring .= " limit  ". $last. ",". $count;

		return $this->exec($sqlstring);
	}

	/********************************************************************************
	*  this query returns count of doctors found for given criteria
	*
	* @param string city
	* &param
	* @return Copy returns copy or false, if error occurs
	* @access public
	********************************************************************************
	*/
	function getCountOfDoctorsByCriteria($speciality, $subspeciality, $chosencity, $chosenlocationid) {

		$sqlstring  = "select count(*) as numberofrecords ";
		$sqlstring .= " FROM doctor a, schedule b, speciality_sub_speciality_link c, speciality d, sub_speciality e, location f, city g";
		$sqlstring .= " WHERE a.doctor_id = b.doctor_id";
		$sqlstring .= " AND a.speciality_Sub_Speciality_link_id = c.speciality_Sub_Speciality_link_id AND c.speciality_id = d.speciality_id";
		$sqlstring .= " and c.sub_speciality_id = e.sub_speciality_id and  b.location_id = f.location_id AND f.city_id = g.city_id";

		if ( !(empty($speciality)) && (strlen($speciality) > 0) )
			$sqlstring .= " and d.speciality = '" . $speciality . "'";

		if ( !(empty($subspeciality)) && (strlen($subspeciality) > 0) )
			$sqlstring .= " and e.speciality = '" . $subspeciality . "'";

		if ( !(empty($chosencity)) && (strlen($chosencity) > 0) )
			$sqlstring .= " and g.city = '". $chosencity . "'";

		if ( !(empty($chosenlocationid)) && (strlen($chosenlocationid) > 0) )
			$sqlstring .= " and f.location_id = ". $chosenlocationid;
		
		$result=$this->exec($sqlstring);
		
		return $result[0]['numberofrecords'];
	}

	
	function selectAll($last,$count) {
		$sql = $this->mkSQL("select * from schedule limit %N, %N",$last, $count);
		return array_map(array($this, '_mkObj'), $this->exec($sql));
	}
	function selectSchedule_id($schedule_id) {
		$sql = $this->mkSQL("select * from schedule where schedule_id  = %N",
				$schedule_id
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function selectFrom_date($from_date) {
		$sql = $this->mkSQL("select * from schedule where from_date  = %Q",
				$from_date
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function selectTo_date($to_date) {
		$sql = $this->mkSQL("select * from schedule where to_date  = %Q",
				$to_date
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function selectExpiry_date($expiry_date) {
		$sql = $this->mkSQL("select * from schedule where expiry_date  = %Q",
				$expiry_date
			);
		if (!$this->_query($sql, "Error in selecting from table schedule")) {
			 return false;
		}
		$this->_rowCount = $this->_conn->numRows();
		return true;
	}
	function selectDays_of_week($days_of_week) {
		$sql = $this->mkSQL("select * from schedule where days_of_week  = %Q",
				$days_of_week
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function selectFrom_time($from_time) {
		$sql = $this->mkSQL("select * from schedule where from_time  = %Q",
				$from_time
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function selectTo_time($to_time) {
		$sql = $this->mkSQL("select * from schedule where to_time  = %Q",
				$to_time
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function selectLocation_id($location_id) {
		$sql = $this->mkSQL("select * from schedule where location_id  = %N",
				$location_id
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function selectDoctor_id($doctor_id) {
		$sql = $this->mkSQL("select * from schedule where doctor_id  = %N",
				$doctor_id
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function selectDescription($description) {
		$sql = $this->mkSQL("select * from schedule where description  = %Q",
				$description
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function insert($schedule) {
		$sql = $this->mkSQL("insert into schedule values (%N, %Q, %Q, %Q, %Q, %Q, %Q, %N, %N, %Q)",
				$schedule->getSchedule_id(),$schedule->getFrom_date(),$schedule->getTo_date(),$schedule->getExpiry_date(),$schedule->getDays_of_week(),$schedule->getFrom_time(),$schedule->getTo_time(),$schedule->getLocation_id(),$schedule->getDoctor_id(),$schedule->getDescription()
			);
		$ret = $this->_query($sql,"Insert failed on schedule table");
	}
	function updateSchedule_id($schedule) {
		$sql = $this->mkSQL("update schedule
				set from_date = %Q, to_date = %Q, expiry_date = %Q, days_of_week = %Q, from_time = %Q, to_time = %Q, location_id = %N, doctor_id = %N, description = %Q where schedule_id = %N ",
				$schedule->getFrom_date(),$schedule->getTo_date(),$schedule->getExpiry_date(),$schedule->getDays_of_week(),$schedule->getFrom_time(),$schedule->getTo_time(),$schedule->getLocation_id(),$schedule->getDoctor_id(),$schedule->getDescription(),$schedule->get(),$schedule->getSchedule_id()
			);
		$ret = $this->_query($sql,"Update using column schedule_id failed on schedule table");
	}
	function updateFrom_date($schedule) {
		$sql = $this->mkSQL("update schedule
				set schedule_id = %N, to_date = %Q, expiry_date = %Q, days_of_week = %Q, from_time = %Q, to_time = %Q, location_id = %N, doctor_id = %N, description = %Q where from_date = %Q ",
				$schedule->getSchedule_id(),$schedule->getTo_date(),$schedule->getExpiry_date(),$schedule->getDays_of_week(),$schedule->getFrom_time(),$schedule->getTo_time(),$schedule->getLocation_id(),$schedule->getDoctor_id(),$schedule->getDescription(),$schedule->get(),$schedule->getFrom_date()
			);
		$ret = $this->_query($sql,"Update using column from_date failed on schedule table");
	}
	function updateTo_date($schedule) {
		$sql = $this->mkSQL("update schedule
				set schedule_id = %N, from_date = %Q, expiry_date = %Q, days_of_week = %Q, from_time = %Q, to_time = %Q, location_id = %N, doctor_id = %N, description = %Q where to_date = %Q ",
				$schedule->getSchedule_id(),$schedule->getFrom_date(),$schedule->getExpiry_date(),$schedule->getDays_of_week(),$schedule->getFrom_time(),$schedule->getTo_time(),$schedule->getLocation_id(),$schedule->getDoctor_id(),$schedule->getDescription(),$schedule->get(),$schedule->getTo_date()
			);
		$ret = $this->_query($sql,"Update using column to_date failed on schedule table");
	}
	function updateExpiry_date($schedule) {
		$sql = $this->mkSQL("update schedule
				set schedule_id = %N, from_date = %Q, to_date = %Q, days_of_week = %Q, from_time = %Q, to_time = %Q, location_id = %N, doctor_id = %N, description = %Q where expiry_date = %Q ",
				$schedule->getSchedule_id(),$schedule->getFrom_date(),$schedule->getTo_date(),$schedule->getDays_of_week(),$schedule->getFrom_time(),$schedule->getTo_time(),$schedule->getLocation_id(),$schedule->getDoctor_id(),$schedule->getDescription(),$schedule->get(),$schedule->getExpiry_date()
			);
		$ret = $this->_query($sql,"Update using column expiry_date failed on schedule table");
	}
	function updateDays_of_week($schedule) {
		$sql = $this->mkSQL("update schedule
				set schedule_id = %N, from_date = %Q, to_date = %Q, expiry_date = %Q, from_time = %Q, to_time = %Q, location_id = %N, doctor_id = %N, description = %Q where days_of_week = %Q ",
				$schedule->getSchedule_id(),$schedule->getFrom_date(),$schedule->getTo_date(),$schedule->getExpiry_date(),$schedule->getFrom_time(),$schedule->getTo_time(),$schedule->getLocation_id(),$schedule->getDoctor_id(),$schedule->getDescription(),$schedule->get(),$schedule->getDays_of_week()
			);
		$ret = $this->_query($sql,"Update using column days_of_week failed on schedule table");
	}
	function updateFrom_time($schedule) {
		$sql = $this->mkSQL("update schedule
				set schedule_id = %N, from_date = %Q, to_date = %Q, expiry_date = %Q, days_of_week = %Q, to_time = %Q, location_id = %N, doctor_id = %N, description = %Q where from_time = %Q ",
				$schedule->getSchedule_id(),$schedule->getFrom_date(),$schedule->getTo_date(),$schedule->getExpiry_date(),$schedule->getDays_of_week(),$schedule->getTo_time(),$schedule->getLocation_id(),$schedule->getDoctor_id(),$schedule->getDescription(),$schedule->get(),$schedule->getFrom_time()
			);
		$ret = $this->_query($sql,"Update using column from_time failed on schedule table");
	}
	function updateTo_time($schedule) {
		$sql = $this->mkSQL("update schedule
				set schedule_id = %N, from_date = %Q, to_date = %Q, expiry_date = %Q, days_of_week = %Q, from_time = %Q, location_id = %N, doctor_id = %N, description = %Q where to_time = %Q ",
				$schedule->getSchedule_id(),$schedule->getFrom_date(),$schedule->getTo_date(),$schedule->getExpiry_date(),$schedule->getDays_of_week(),$schedule->getFrom_time(),$schedule->getLocation_id(),$schedule->getDoctor_id(),$schedule->getDescription(),$schedule->get(),$schedule->getTo_time()
			);
		$ret = $this->_query($sql,"Update using column to_time failed on schedule table");
	}
	function updateLocation_id($schedule) {
		$sql = $this->mkSQL("update schedule
				set schedule_id = %N, from_date = %Q, to_date = %Q, expiry_date = %Q, days_of_week = %Q, from_time = %Q, to_time = %Q, doctor_id = %N, description = %Q where location_id = %N ",
				$schedule->getSchedule_id(),$schedule->getFrom_date(),$schedule->getTo_date(),$schedule->getExpiry_date(),$schedule->getDays_of_week(),$schedule->getFrom_time(),$schedule->getTo_time(),$schedule->getDoctor_id(),$schedule->getDescription(),$schedule->get(),$schedule->getLocation_id()
			);
		$ret = $this->_query($sql,"Update using column location_id failed on schedule table");
	}
	function updateDoctor_id($schedule) {
		$sql = $this->mkSQL("update schedule
				set schedule_id = %N, from_date = %Q, to_date = %Q, expiry_date = %Q, days_of_week = %Q, from_time = %Q, to_time = %Q, location_id = %N, description = %Q where doctor_id = %N ",
				$schedule->getSchedule_id(),$schedule->getFrom_date(),$schedule->getTo_date(),$schedule->getExpiry_date(),$schedule->getDays_of_week(),$schedule->getFrom_time(),$schedule->getTo_time(),$schedule->getLocation_id(),$schedule->getDescription(),$schedule->get(),$schedule->getDoctor_id()
			);
		$ret = $this->_query($sql,"Update using column doctor_id failed on schedule table");
	}
	function updateDescription($schedule) {
		$sql = $this->mkSQL("update schedule
				set schedule_id = %N, from_date = %Q, to_date = %Q, expiry_date = %Q, days_of_week = %Q, from_time = %Q, to_time = %Q, location_id = %N, doctor_id = %N where description = %Q ",
				$schedule->getSchedule_id(),$schedule->getFrom_date(),$schedule->getTo_date(),$schedule->getExpiry_date(),$schedule->getDays_of_week(),$schedule->getFrom_time(),$schedule->getTo_time(),$schedule->getLocation_id(),$schedule->getDoctor_id(),$schedule->get(),$schedule->getDescription()
			);
		$ret = $this->_query($sql,"Update using column description failed on schedule table");
	}
	function deleteSchedule_id($schedule) {
		$sql = $this->mkSQL("delete from schedule where schedule_id = %Q ",
				$schedule->getSchedule_id()
			);
		$ret = $this->_query($sql,"Delete using column schedule_id failed on schedule table");
	}
	function deleteFrom_date($schedule) {
		$sql = $this->mkSQL("delete from schedule where from_date = %Q ",
				$schedule->getFrom_date()
			);
		$ret = $this->_query($sql,"Delete using column from_date failed on schedule table");
	}
	function deleteTo_date($schedule) {
		$sql = $this->mkSQL("delete from schedule where to_date = %Q ",
				$schedule->getTo_date()
			);
		$ret = $this->_query($sql,"Delete using column to_date failed on schedule table");
	}
	function deleteExpiry_date($schedule) {
		$sql = $this->mkSQL("delete from schedule where expiry_date = %Q ",
				$schedule->getExpiry_date()
			);
		$ret = $this->_query($sql,"Delete using column expiry_date failed on schedule table");
	}
	function deleteDays_of_week($schedule) {
		$sql = $this->mkSQL("delete from schedule where days_of_week = %Q ",
				$schedule->getDays_of_week()
			);
		$ret = $this->_query($sql,"Delete using column days_of_week failed on schedule table");
	}

	function deleteFrom_time($schedule) {
		$sql = $this->mkSQL("delete from schedule where from_time = %Q ",
				$schedule->getFrom_time()
			);
		$ret = $this->_query($sql,"Delete using column from_time failed on schedule table");
	}
	function deleteTo_time($schedule) {
		$sql = $this->mkSQL("delete from schedule where to_time = %Q ",
				$schedule->getTo_time()
			);
		$ret = $this->_query($sql,"Delete using column to_time failed on schedule table");
	}
	function deleteLocation_id($schedule) {
		$sql = $this->mkSQL("delete from schedule where location_id = %Q ",
				$schedule->getLocation_id()
			);
		$ret = $this->_query($sql,"Delete using column location_id failed on schedule table");
	}
	function deleteDoctor_id($schedule) {
		$sql = $this->mkSQL("delete from schedule where doctor_id = %Q ",
				$schedule->getDoctor_id()
			);
		$ret = $this->_query($sql,"Delete using column doctor_id failed on schedule table");
	}
	function deleteDescription($schedule) {
		$sql = $this->mkSQL("delete from schedule where description = %Q ",
				$schedule->getDescription()
			);
		$ret = $this->_query($sql,"Delete using column description failed on schedule table");
	}
}
?>
