<?php 
require_once ("classes/Query.php");
require_once ("classes/doctor.php");
class DoctorQuery extends Query {
	var $_rowCount = 0;
	function DoctorQuery () {
		$this->Query();
	}
	function getRowCount() {
		return $this->_rowCount;
	}
	function fetchDoctor() {
		$array = $this->_conn->fetchRow();
		if ($array == false) {
			return false;
		}
		return $this->_mkObj($array);
	}
	function _mkObj($array) {
		$obj = new Doctor();
		$obj->setDoctor_id($array["doctor_id"]);
		$obj->setDonor_id($array["donor_id"]);
		$obj->setCurrent_hospital($array["current_hospital"]);
		$obj->setExperience($array["experience"]);
		$obj->setAge($array["age"]);
		$obj->setCity_id($array["city_id"]);
		$obj->setSpeciality_Sub_Speciality_link_id($array["speciality_Sub_Speciality_link_id"]);
		return $obj;
	}
	function selectAll($last,$count) {
		$sql = $this->mkSQL("select * from doctor limit %N, %N",$last, $count);
		if (!$this->_query($sql, "Error in selecting from table doctor")) {
			 return false;
		}
		$this->_rowCount = $this->_conn->numRows();
		return true;
	}
	function selectDoctor_id($doctor_id) {
		$sql = $this->mkSQL("select * from doctor where doctor_id  = %N",
				$doctor_id
			);
		$result = $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		$this->_mkObj($result[0]);
	}
	function selectDonor_id($donor_id) {
		$sql = $this->mkSQL("select * from doctor where donor_id  = %N",
				$donor_id
			);
		$result = $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		$this->_mkObj($result[0]);
	}
	function selectCurrent_hospital($current_hospital) {
		$sql = $this->mkSQL("select * from doctor where current_hospital  = %Q",
				$current_hospital
			);
		$result = $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		$this->_mkObj($result[0]);
	}
	function selectExperience($experience) {
		$sql = $this->mkSQL("select * from doctor where experience  = %Q",
				$experience
			);
		$result = $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		$this->_mkObj($result[0]);
	}
	function selectAge($age) {
		$sql = $this->mkSQL("select * from doctor where age  = %N",
				$age
			);
		$result = $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		$this->_mkObj($result[0]);
	}
	function selectCity_id($city_id) {
		$sql = $this->mkSQL("select * from doctor where city_id  = %N",
				$city_id
			);
		$result = $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		$this->_mkObj($result[0]);
	}
	function selectSpeciality_Sub_Speciality_link_id($speciality_Sub_Speciality_link_id) {
		$sql = $this->mkSQL("select * from doctor where speciality_Sub_Speciality_link_id  = %N",
				$speciality_Sub_Speciality_link_id
			);
		$result = $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		$this->_mkObj($result[0]);
	}
	function insert($doctor) {
		$sql = $this->mkSQL("insert into doctor values (%N, %N, %Q, %Q, %N, %N, %N)",
				$doctor->getDoctor_id(),$doctor->getDonor_id(),$doctor->getCurrent_hospital(),$doctor->getExperience(),$doctor->getAge(),$doctor->getCity_id(),$doctor->getSpeciality_Sub_Speciality_link_id()
			);
		$ret = $this->_query($sql,"Insert failed on doctor table");
	}
	function updateDoctor_id($doctor) {
		$sql = $this->mkSQL("update doctor
				set donor_id = %N, current_hospital = %Q, experience = %Q, age = %N, city_id = %N, speciality_Sub_Speciality_link_id = %N where doctor_id = %N ",
				$doctor->getDonor_id(),$doctor->getCurrent_hospital(),$doctor->getExperience(),$doctor->getAge(),$doctor->getCity_id(),$doctor->getSpeciality_Sub_Speciality_link_id(),$doctor->get(),$doctor->getDoctor_id()
			);
		$ret = $this->_query($sql,"Update using column doctor_id failed on doctor table");
	}
	function updateDonor_id($doctor) {
		$sql = $this->mkSQL("update doctor
				set doctor_id = %N, current_hospital = %Q, experience = %Q, age = %N, city_id = %N, speciality_Sub_Speciality_link_id = %N where donor_id = %N ",
				$doctor->getDoctor_id(),$doctor->getCurrent_hospital(),$doctor->getExperience(),$doctor->getAge(),$doctor->getCity_id(),$doctor->getSpeciality_Sub_Speciality_link_id(),$doctor->get(),$doctor->getDonor_id()
			);
		$ret = $this->_query($sql,"Update using column donor_id failed on doctor table");
	}
	function updateCurrent_hospital($doctor) {
		$sql = $this->mkSQL("update doctor
				set doctor_id = %N, donor_id = %N, experience = %Q, age = %N, city_id = %N, speciality_Sub_Speciality_link_id = %N where current_hospital = %Q ",
				$doctor->getDoctor_id(),$doctor->getDonor_id(),$doctor->getExperience(),$doctor->getAge(),$doctor->getCity_id(),$doctor->getSpeciality_Sub_Speciality_link_id(),$doctor->get(),$doctor->getCurrent_hospital()
			);
		$ret = $this->_query($sql,"Update using column current_hospital failed on doctor table");
	}
	function updateExperience($doctor) {
		$sql = $this->mkSQL("update doctor
				set doctor_id = %N, donor_id = %N, current_hospital = %Q, age = %N, city_id = %N, speciality_Sub_Speciality_link_id = %N where experience = %Q ",
				$doctor->getDoctor_id(),$doctor->getDonor_id(),$doctor->getCurrent_hospital(),$doctor->getAge(),$doctor->getCity_id(),$doctor->getSpeciality_Sub_Speciality_link_id(),$doctor->get(),$doctor->getExperience()
			);
		$ret = $this->_query($sql,"Update using column experience failed on doctor table");
	}
	function updateAge($doctor) {
		$sql = $this->mkSQL("update doctor
				set doctor_id = %N, donor_id = %N, current_hospital = %Q, experience = %Q, city_id = %N, speciality_Sub_Speciality_link_id = %N where age = %N ",
				$doctor->getDoctor_id(),$doctor->getDonor_id(),$doctor->getCurrent_hospital(),$doctor->getExperience(),$doctor->getCity_id(),$doctor->getSpeciality_Sub_Speciality_link_id(),$doctor->get(),$doctor->getAge()
			);
		$ret = $this->_query($sql,"Update using column age failed on doctor table");
	}
	function updateCity_id($doctor) {
		$sql = $this->mkSQL("update doctor
				set doctor_id = %N, donor_id = %N, current_hospital = %Q, experience = %Q, age = %N, speciality_Sub_Speciality_link_id = %N where city_id = %N ",
				$doctor->getDoctor_id(),$doctor->getDonor_id(),$doctor->getCurrent_hospital(),$doctor->getExperience(),$doctor->getAge(),$doctor->getSpeciality_Sub_Speciality_link_id(),$doctor->get(),$doctor->getCity_id()
			);
		$ret = $this->_query($sql,"Update using column city_id failed on doctor table");
	}
	function updateSpeciality_Sub_Speciality_link_id($doctor) {
		$sql = $this->mkSQL("update doctor
				set doctor_id = %N, donor_id = %N, current_hospital = %Q, experience = %Q, age = %N, city_id = %N where speciality_Sub_Speciality_link_id = %N ",
				$doctor->getDoctor_id(),$doctor->getDonor_id(),$doctor->getCurrent_hospital(),$doctor->getExperience(),$doctor->getAge(),$doctor->getCity_id(),$doctor->get(),$doctor->getSpeciality_Sub_Speciality_link_id()
			);
		$ret = $this->_query($sql,"Update using column speciality_Sub_Speciality_link_id failed on doctor table");
	}
	function deleteDoctor_id($doctor) {
		$sql = $this->mkSQL("delete from doctor where doctor_id = %Q ",
				$doctor->getDoctor_id()
			);
		$ret = $this->_query($sql,"Delete using column doctor_id failed on doctor table");
	}
	function deleteDonor_id($doctor) {
		$sql = $this->mkSQL("delete from doctor where donor_id = %Q ",
				$doctor->getDonor_id()
			);
		$ret = $this->_query($sql,"Delete using column donor_id failed on doctor table");
	}
	function deleteCurrent_hospital($doctor) {
		$sql = $this->mkSQL("delete from doctor where current_hospital = %Q ",
				$doctor->getCurrent_hospital()
			);
		$ret = $this->_query($sql,"Delete using column current_hospital failed on doctor table");
	}
	function deleteExperience($doctor) {
		$sql = $this->mkSQL("delete from doctor where experience = %Q ",
				$doctor->getExperience()
			);
		$ret = $this->_query($sql,"Delete using column experience failed on doctor table");
	}
	function deleteAge($doctor) {
		$sql = $this->mkSQL("delete from doctor where age = %Q ",
				$doctor->getAge()
			);
		$ret = $this->_query($sql,"Delete using column age failed on doctor table");
	}
	function deleteCity_id($doctor) {
		$sql = $this->mkSQL("delete from doctor where city_id = %Q ",
				$doctor->getCity_id()
			);
		$ret = $this->_query($sql,"Delete using column city_id failed on doctor table");
	}
	function deleteSpeciality_Sub_Speciality_link_id($doctor) {
		$sql = $this->mkSQL("delete from doctor where speciality_Sub_Speciality_link_id = %Q ",
				$doctor->getSpeciality_Sub_Speciality_link_id()
			);
		$ret = $this->_query($sql,"Delete using column speciality_Sub_Speciality_link_id failed on doctor table");
	}
}
?>