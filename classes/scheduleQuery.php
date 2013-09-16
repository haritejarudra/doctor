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

	/********************************************************************************
	 *  this query returns title, author, category, checked out status for all copies
	*  present in the given location, city, for a given author, title, category
	*
	* @param string city
	* &param
	* @return Copy returns copy or false, if error occurs
	* @access public
	********************************************************************************
	*/
	function getSchedulesByCriteria($speciality, $subspeciality, $chosencity, $chosenlocationid, $last,$count) {
		$sqlstring  = "select concat(b.first_name,' ',b.last_name) as doctor, concat(e.speciality,' ',f.speciality) as speciality,";
		$sqlstring .= " a.description as clinic, g.city as city, c.location as location";
		$sqlstring .= " from schedule a, doctor b, location c, city g, speciality_sub_speciality_link d, speciality e, sub_speciality f";
		$sqlstring .= " where a.doctor_id = b.doctor_id and a.location_id = c.location_id and c.city_id = g.city_id";
		$sqlstring .= " and b.speciality_Sub_Speciality_link_id = d.speciality_Sub_Speciality_link_id";
		$sqlstring .= " and d.speciality_id = e.speciality_id and d.sub_speciality_id = f.sub_speciality_id";

		if ( !(empty($speciality)) && (strlen($speciality) > 0) )
			$sqlstring .= " and e.speciality = '" . $speciality . "'";

		if ( !(empty($subspeciality)) && (strlen($subspeciality) > 0) )
			$sqlstring .= " and f.speciality = '" . $subspeciality . "'";

		if ( !(empty($city)) && (strlen($city) > 0) )
			$sqlstring .= " and g.city = '". $city . "'";

		if ( !(empty($location)) && (strlen($location) > 0) )
			$sqlstring .= " and c.location_id = ". $location;
		
		$sqlstring .= " limit  ". $last. ",". $count;

		return $this->exec($sqlstring);
	}

	/********************************************************************************
	*  this query returns count of books found for given criteria
	*
	* @param string city
	* &param
	* @return Copy returns copy or false, if error occurs
	* @access public
	********************************************************************************
	*/
	function getCountOfSchedulesByCriteria($speciality, $subspeciality, $chosencity, $chosenlocationid) {

		$sqlstring  = "select count(*) as numberofrecords ";
		$sqlstring .= " from schedule a, doctor b, location c, city g, speciality_sub_speciality_link d, speciality e, sub_speciality f";
		$sqlstring .= " where a.doctor_id = b.doctor_id and a.location_id = c.location_id and c.city_id = g.city_id";
		$sqlstring .= " and b.speciality_Sub_Speciality_link_id = d.speciality_Sub_Speciality_link_id";
		$sqlstring .= " and d.speciality_id = e.speciality_id and d.sub_speciality_id = f.sub_speciality_id";

		if ( !(empty($speciality)) && (strlen($speciality) > 0) )
			$sqlstring .= " and e.speciality = '" . $speciality . "'";

		if ( !(empty($subspeciality)) && (strlen($subspeciality) > 0) )
			$sqlstring .= " and f.speciality = '" . $subspeciality . "'";

		if ( !(empty($city)) && (strlen($city) > 0) )
			$sqlstring .= " and g.city = '". $city . "'";

		if ( !(empty($location)) && (strlen($location) > 0) )
			$sqlstring .= " and c.location_id = ". $location;
		
		$result=$this->exec($sqlstring);
		
		return $result[0]['numberofrecords'];
	}

	
	function _mkObj($array) {
		$obj = new Schedule();
		$obj->setSchedule_id($array["schedule_id"]);
		$obj->setFrom_date($array["from_date"]);
		$obj->setTo_date($array["to_date"]);
		$obj->setFrom_time($array["from_time"]);
		$obj->setTo_time($array["to_time"]);
		$obj->setLocation_id($array["location_id"]);
		$obj->setDoctor_id($array["doctor_id"]);
		$obj->setDescription($array["description"]);
		return $obj;
	}
	function selectAll($last,$count) {
		$sql = $this->mkSQL("select * from schedule limit %N, %N",$last, $count);
		if (!$this->_query($sql, "Error in selecting from table schedule")) {
			 return false;
		}
		$this->_rowCount = $this->_conn->numRows();
		return true;
	}
	function selectSchedule_id($schedule) {
		$sql = $this->mkSQL("select * from schedule where schedule_id  = %N",
				$schedule->getSchedule_id()
			);
		if (!$this->_query($sql, "Error in selecting from table schedule")) {
			 return false;
		}
		$this->_rowCount = $this->_conn->numRows();
		return true;
	}
	function selectFrom_date($schedule) {
		$sql = $this->mkSQL("select * from schedule where from_date  = %N",
				$schedule->getFrom_date()
			);
		if (!$this->_query($sql, "Error in selecting from table schedule")) {
			 return false;
		}
		$this->_rowCount = $this->_conn->numRows();
		return true;
	}
	function selectTo_date($schedule) {
		$sql = $this->mkSQL("select * from schedule where to_date  = %N",
				$schedule->getTo_date()
			);
		if (!$this->_query($sql, "Error in selecting from table schedule")) {
			 return false;
		}
		$this->_rowCount = $this->_conn->numRows();
		return true;
	}
	function selectFrom_time($schedule) {
		$sql = $this->mkSQL("select * from schedule where from_time  = %N",
				$schedule->getFrom_time()
			);
		if (!$this->_query($sql, "Error in selecting from table schedule")) {
			 return false;
		}
		$this->_rowCount = $this->_conn->numRows();
		return true;
	}
	function selectTo_time($schedule) {
		$sql = $this->mkSQL("select * from schedule where to_time  = %N",
				$schedule->getTo_time()
			);
		if (!$this->_query($sql, "Error in selecting from table schedule")) {
			 return false;
		}
		$this->_rowCount = $this->_conn->numRows();
		return true;
	}
	function selectLocation_id($schedule) {
		$sql = $this->mkSQL("select * from schedule where location_id  = %N",
				$schedule->getLocation_id()
			);
		if (!$this->_query($sql, "Error in selecting from table schedule")) {
			 return false;
		}
		$this->_rowCount = $this->_conn->numRows();
		return true;
	}
	function selectDoctor_id($schedule) {
		$sql = $this->mkSQL("select * from schedule where doctor_id  = %N",
				$schedule->getDoctor_id()
			);
		if (!$this->_query($sql, "Error in selecting from table schedule")) {
			 return false;
		}
		$this->_rowCount = $this->_conn->numRows();
		return true;
	}
	function selectDescription($schedule) {
		$sql = $this->mkSQL("select * from schedule where description  = %N",
				$schedule->getDescription()
			);
		if (!$this->_query($sql, "Error in selecting from table schedule")) {
			 return false;
		}
		$this->_rowCount = $this->_conn->numRows();
		return true;
	}
	function insert($schedule) {
		$sql = $this->mkSQL("insert into schedule values (%N, %Q, %Q, %Q, %Q, %N, %N, %Q)",
				$schedule->getSchedule_id(),$schedule->getFrom_date(),$schedule->getTo_date(),$schedule->getFrom_time(),$schedule->getTo_time(),$schedule->getLocation_id(),$schedule->getDoctor_id(),$schedule->getDescription()
			);
		$ret = $this->_query($sql,"Insert failed on schedule table");
	}
	function updateSchedule_id($schedule) {
		$sql = $this->mkSQL("update schedule
				set from_date = %Q, to_date = %Q, from_time = %Q, to_time = %Q, location_id = %N, doctor_id = %N, description = %Q where schedule_id = %N ",
				$schedule->getFrom_date(),$schedule->getTo_date(),$schedule->getFrom_time(),$schedule->getTo_time(),$schedule->getLocation_id(),$schedule->getDoctor_id(),$schedule->getDescription(),$schedule->get(),$schedule->getSchedule_id()
			);
		$ret = $this->_query($sql,"Update using column schedule_id failed on schedule table");
	}
	function updateFrom_date($schedule) {
		$sql = $this->mkSQL("update schedule
				set schedule_id = %N, to_date = %Q, from_time = %Q, to_time = %Q, location_id = %N, doctor_id = %N, description = %Q where from_date = %Q ",
				$schedule->getSchedule_id(),$schedule->getTo_date(),$schedule->getFrom_time(),$schedule->getTo_time(),$schedule->getLocation_id(),$schedule->getDoctor_id(),$schedule->getDescription(),$schedule->get(),$schedule->getFrom_date()
			);
		$ret = $this->_query($sql,"Update using column from_date failed on schedule table");
	}
	function updateTo_date($schedule) {
		$sql = $this->mkSQL("update schedule
				set schedule_id = %N, from_date = %Q, from_time = %Q, to_time = %Q, location_id = %N, doctor_id = %N, description = %Q where to_date = %Q ",
				$schedule->getSchedule_id(),$schedule->getFrom_date(),$schedule->getFrom_time(),$schedule->getTo_time(),$schedule->getLocation_id(),$schedule->getDoctor_id(),$schedule->getDescription(),$schedule->get(),$schedule->getTo_date()
			);
		$ret = $this->_query($sql,"Update using column to_date failed on schedule table");
	}
	function updateFrom_time($schedule) {
		$sql = $this->mkSQL("update schedule
				set schedule_id = %N, from_date = %Q, to_date = %Q, to_time = %Q, location_id = %N, doctor_id = %N, description = %Q where from_time = %Q ",
				$schedule->getSchedule_id(),$schedule->getFrom_date(),$schedule->getTo_date(),$schedule->getTo_time(),$schedule->getLocation_id(),$schedule->getDoctor_id(),$schedule->getDescription(),$schedule->get(),$schedule->getFrom_time()
			);
		$ret = $this->_query($sql,"Update using column from_time failed on schedule table");
	}
	function updateTo_time($schedule) {
		$sql = $this->mkSQL("update schedule
				set schedule_id = %N, from_date = %Q, to_date = %Q, from_time = %Q, location_id = %N, doctor_id = %N, description = %Q where to_time = %Q ",
				$schedule->getSchedule_id(),$schedule->getFrom_date(),$schedule->getTo_date(),$schedule->getFrom_time(),$schedule->getLocation_id(),$schedule->getDoctor_id(),$schedule->getDescription(),$schedule->get(),$schedule->getTo_time()
			);
		$ret = $this->_query($sql,"Update using column to_time failed on schedule table");
	}
	function updateLocation_id($schedule) {
		$sql = $this->mkSQL("update schedule
				set schedule_id = %N, from_date = %Q, to_date = %Q, from_time = %Q, to_time = %Q, doctor_id = %N, description = %Q where location_id = %N ",
				$schedule->getSchedule_id(),$schedule->getFrom_date(),$schedule->getTo_date(),$schedule->getFrom_time(),$schedule->getTo_time(),$schedule->getDoctor_id(),$schedule->getDescription(),$schedule->get(),$schedule->getLocation_id()
			);
		$ret = $this->_query($sql,"Update using column location_id failed on schedule table");
	}
	function updateDoctor_id($schedule) {
		$sql = $this->mkSQL("update schedule
				set schedule_id = %N, from_date = %Q, to_date = %Q, from_time = %Q, to_time = %Q, location_id = %N, description = %Q where doctor_id = %N ",
				$schedule->getSchedule_id(),$schedule->getFrom_date(),$schedule->getTo_date(),$schedule->getFrom_time(),$schedule->getTo_time(),$schedule->getLocation_id(),$schedule->getDescription(),$schedule->get(),$schedule->getDoctor_id()
			);
		$ret = $this->_query($sql,"Update using column doctor_id failed on schedule table");
	}
	function updateDescription($schedule) {
		$sql = $this->mkSQL("update schedule
				set schedule_id = %N, from_date = %Q, to_date = %Q, from_time = %Q, to_time = %Q, location_id = %N, doctor_id = %N where description = %Q ",
				$schedule->getSchedule_id(),$schedule->getFrom_date(),$schedule->getTo_date(),$schedule->getFrom_time(),$schedule->getTo_time(),$schedule->getLocation_id(),$schedule->getDoctor_id(),$schedule->get(),$schedule->getDescription()
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
