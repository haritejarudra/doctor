<?php 
require_once ("classes/Query.php");
require_once ("classes/doctor.php");
class DoctorQuery extends Query {
	var $_rowCount = 0;
	function DoctorQuery () {
		$this->Query();
		$this->_loc = new Localize(OBIB_LOCALE,"classes")
	}
	function getRowCount() {
		return $this->_rowCount;
	}
	function fetchDoctor() {
		$array = $this->_conn->fetchRow();
		if ($array == false) {
			return false;
		}
		return $this->_mkObj($array)
	}
	function mkObj($array) {
		$obj = new Doctor();
		$obj->setDoctor_id($array["doctor_id"]);
		$obj->setFirst_name($array["first_name"]);
		$obj->setLast_name($array["last_name"]);
		$obj->setMobile($array["mobile"]);
		$obj->setSpeciality($array["speciality"]);
		$obj->setGender($array["gender"]);
		$obj->setAddress($array["address"]);
		$obj->setCity($array["city"]);
		$obj->setState($array["state"]);
		$obj->setCountry($array["country"]);
		$obj->setSub_speciality_id($array["sub_speciality_id"]);
		$obj->setPicture($array["picture"]);
		$obj->setCurrent_hospital($array["current_hospital"]);
		$obj->setExperience($array["experience"]);
		$obj->setQualification_id($array["qualification_id"]);
		$obj->setDate_of_birth($array["date_of_birth"]);
		$obj->setAge($array["age"]);
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
	function selectDoctor_id($doctor) {
		$sql = $this->mkSQL("select * from doctor where doctor_id  = %N",
				$doctor->getDoctor_id(),
			);
		if (!$this->_query($sql, "Error in selecting from table doctor")) {
			 return false;
		}
		$this->_rowCount = $this->_conn->numRows();
		return true;
	}
	function selectFirst_name($doctor) {
		$sql = $this->mkSQL("select * from doctor where first_name  = %N",
				$doctor->getFirst_name(),
			);
		if (!$this->_query($sql, "Error in selecting from table doctor")) {
			 return false;
		}
		$this->_rowCount = $this->_conn->numRows();
		return true;
	}
	function selectLast_name($doctor) {
		$sql = $this->mkSQL("select * from doctor where last_name  = %N",
				$doctor->getLast_name(),
			);
		if (!$this->_query($sql, "Error in selecting from table doctor")) {
			 return false;
		}
		$this->_rowCount = $this->_conn->numRows();
		return true;
	}
	function selectMobile($doctor) {
		$sql = $this->mkSQL("select * from doctor where mobile  = %N",
				$doctor->getMobile(),
			);
		if (!$this->_query($sql, "Error in selecting from table doctor")) {
			 return false;
		}
		$this->_rowCount = $this->_conn->numRows();
		return true;
	}
	function selectSpeciality($doctor) {
		$sql = $this->mkSQL("select * from doctor where speciality  = %N",
				$doctor->getSpeciality(),
			);
		if (!$this->_query($sql, "Error in selecting from table doctor")) {
			 return false;
		}
		$this->_rowCount = $this->_conn->numRows();
		return true;
	}
	function selectGender($doctor) {
		$sql = $this->mkSQL("select * from doctor where gender  = %N",
				$doctor->getGender(),
			);
		if (!$this->_query($sql, "Error in selecting from table doctor")) {
			 return false;
		}
		$this->_rowCount = $this->_conn->numRows();
		return true;
	}
	function selectAddress($doctor) {
		$sql = $this->mkSQL("select * from doctor where address  = %N",
				$doctor->getAddress(),
			);
		if (!$this->_query($sql, "Error in selecting from table doctor")) {
			 return false;
		}
		$this->_rowCount = $this->_conn->numRows();
		return true;
	}
	function selectCity($doctor) {
		$sql = $this->mkSQL("select * from doctor where city  = %N",
				$doctor->getCity(),
			);
		if (!$this->_query($sql, "Error in selecting from table doctor")) {
			 return false;
		}
		$this->_rowCount = $this->_conn->numRows();
		return true;
	}
	function selectState($doctor) {
		$sql = $this->mkSQL("select * from doctor where state  = %N",
				$doctor->getState(),
			);
		if (!$this->_query($sql, "Error in selecting from table doctor")) {
			 return false;
		}
		$this->_rowCount = $this->_conn->numRows();
		return true;
	}
	function selectCountry($doctor) {
		$sql = $this->mkSQL("select * from doctor where country  = %N",
				$doctor->getCountry(),
			);
		if (!$this->_query($sql, "Error in selecting from table doctor")) {
			 return false;
		}
		$this->_rowCount = $this->_conn->numRows();
		return true;
	}
	function selectSub_speciality_id($doctor) {
		$sql = $this->mkSQL("select * from doctor where sub_speciality_id  = %N",
				$doctor->getSub_speciality_id(),
			);
		if (!$this->_query($sql, "Error in selecting from table doctor")) {
			 return false;
		}
		$this->_rowCount = $this->_conn->numRows();
		return true;
	}
	function selectPicture($doctor) {
		$sql = $this->mkSQL("select * from doctor where picture  = %N",
				$doctor->getPicture(),
			);
		if (!$this->_query($sql, "Error in selecting from table doctor")) {
			 return false;
		}
		$this->_rowCount = $this->_conn->numRows();
		return true;
	}
	function selectCurrent_hospital($doctor) {
		$sql = $this->mkSQL("select * from doctor where current_hospital  = %N",
				$doctor->getCurrent_hospital(),
			);
		if (!$this->_query($sql, "Error in selecting from table doctor")) {
			 return false;
		}
		$this->_rowCount = $this->_conn->numRows();
		return true;
	}
	function selectExperience($doctor) {
		$sql = $this->mkSQL("select * from doctor where experience  = %N",
				$doctor->getExperience(),
			);
		if (!$this->_query($sql, "Error in selecting from table doctor")) {
			 return false;
		}
		$this->_rowCount = $this->_conn->numRows();
		return true;
	}
	function selectQualification_id($doctor) {
		$sql = $this->mkSQL("select * from doctor where qualification_id  = %N",
				$doctor->getQualification_id(),
			);
		if (!$this->_query($sql, "Error in selecting from table doctor")) {
			 return false;
		}
		$this->_rowCount = $this->_conn->numRows();
		return true;
	}
	function selectDate_of_birth($doctor) {
		$sql = $this->mkSQL("select * from doctor where date_of_birth  = %N",
				$doctor->getDate_of_birth(),
			);
		if (!$this->_query($sql, "Error in selecting from table doctor")) {
			 return false;
		}
		$this->_rowCount = $this->_conn->numRows();
		return true;
	}
	function selectAge($doctor) {
		$sql = $this->mkSQL("select * from doctor where age  = %N",
				$doctor->getAge(),
			);
		if (!$this->_query($sql, "Error in selecting from table doctor")) {
			 return false;
		}
		$this->_rowCount = $this->_conn->numRows();
		return true;
	}
	function insert($doctor) {
		$sql = $this->mkSQL("insert into doctor values (%Q, %Q, %Q, %Q, %Q, %Q, %Q, %Q, %Q, %Q, %Q, %Q, %Q, %Q, %Q, %Q, %Q)",
				$doctor->getDoctor_id(),$doctor->getFirst_name(),$doctor->getLast_name(),$doctor->getMobile(),$doctor->getSpeciality(),$doctor->getGender(),$doctor->getAddress(),$doctor->getCity(),$doctor->getState(),$doctor->getCountry(),$doctor->getSub_speciality_id(),$doctor->getPicture(),$doctor->getCurrent_hospital(),$doctor->getExperience(),$doctor->getQualification_id(),$doctor->getDate_of_birth(),$doctor->getAge())
			);
		$ret = $this->_query($sql,"Insert failed on doctor table");
	}
	function updateDoctor_id($doctor) {
		$sql = $this->mkSQL("update doctor
				set first_name = %Q, last_name = %Q, mobile = %Q, speciality = %Q, gender = %Q, address = %Q, city = %Q, state = %Q, country = %Q, sub_speciality_id = %Q, picture = %Q, current_hospital = %Q, experience = %Q, qualification_id = %Q, date_of_birth = %Q, age = %Q where doctor_id  = %N",
				$doctor->getFirst_name(),$doctor->getLast_name(),$doctor->getMobile(),$doctor->getSpeciality(),$doctor->getGender(),$doctor->getAddress(),$doctor->getCity(),$doctor->getState(),$doctor->getCountry(),$doctor->getSub_speciality_id(),$doctor->getPicture(),$doctor->getCurrent_hospital(),$doctor->getExperience(),$doctor->getQualification_id(),$doctor->getDate_of_birth(),$doctor->getAge(),$doctor->get(),$doctor->getDoctor_id()
			);
		$ret = $this->_query($sql,"Update using column doctor_id failed on doctor table");
	}
	function updateFirst_name($doctor) {
		$sql = $this->mkSQL("update doctor
				set doctor_id = %Q, last_name = %Q, mobile = %Q, speciality = %Q, gender = %Q, address = %Q, city = %Q, state = %Q, country = %Q, sub_speciality_id = %Q, picture = %Q, current_hospital = %Q, experience = %Q, qualification_id = %Q, date_of_birth = %Q, age = %Q where first_name  = %N",
				$doctor->getDoctor_id(),$doctor->getLast_name(),$doctor->getMobile(),$doctor->getSpeciality(),$doctor->getGender(),$doctor->getAddress(),$doctor->getCity(),$doctor->getState(),$doctor->getCountry(),$doctor->getSub_speciality_id(),$doctor->getPicture(),$doctor->getCurrent_hospital(),$doctor->getExperience(),$doctor->getQualification_id(),$doctor->getDate_of_birth(),$doctor->getAge(),$doctor->get(),$doctor->getFirst_name()
			);
		$ret = $this->_query($sql,"Update using column first_name failed on doctor table");
	}
	function updateLast_name($doctor) {
		$sql = $this->mkSQL("update doctor
				set doctor_id = %Q, first_name = %Q, mobile = %Q, speciality = %Q, gender = %Q, address = %Q, city = %Q, state = %Q, country = %Q, sub_speciality_id = %Q, picture = %Q, current_hospital = %Q, experience = %Q, qualification_id = %Q, date_of_birth = %Q, age = %Q where last_name  = %N",
				$doctor->getDoctor_id(),$doctor->getFirst_name(),$doctor->getMobile(),$doctor->getSpeciality(),$doctor->getGender(),$doctor->getAddress(),$doctor->getCity(),$doctor->getState(),$doctor->getCountry(),$doctor->getSub_speciality_id(),$doctor->getPicture(),$doctor->getCurrent_hospital(),$doctor->getExperience(),$doctor->getQualification_id(),$doctor->getDate_of_birth(),$doctor->getAge(),$doctor->get(),$doctor->getLast_name()
			);
		$ret = $this->_query($sql,"Update using column last_name failed on doctor table");
	}
	function updateMobile($doctor) {
		$sql = $this->mkSQL("update doctor
				set doctor_id = %Q, first_name = %Q, last_name = %Q, speciality = %Q, gender = %Q, address = %Q, city = %Q, state = %Q, country = %Q, sub_speciality_id = %Q, picture = %Q, current_hospital = %Q, experience = %Q, qualification_id = %Q, date_of_birth = %Q, age = %Q where mobile  = %N",
				$doctor->getDoctor_id(),$doctor->getFirst_name(),$doctor->getLast_name(),$doctor->getSpeciality(),$doctor->getGender(),$doctor->getAddress(),$doctor->getCity(),$doctor->getState(),$doctor->getCountry(),$doctor->getSub_speciality_id(),$doctor->getPicture(),$doctor->getCurrent_hospital(),$doctor->getExperience(),$doctor->getQualification_id(),$doctor->getDate_of_birth(),$doctor->getAge(),$doctor->get(),$doctor->getMobile()
			);
		$ret = $this->_query($sql,"Update using column mobile failed on doctor table");
	}
	function updateSpeciality($doctor) {
		$sql = $this->mkSQL("update doctor
				set doctor_id = %Q, first_name = %Q, last_name = %Q, mobile = %Q, gender = %Q, address = %Q, city = %Q, state = %Q, country = %Q, sub_speciality_id = %Q, picture = %Q, current_hospital = %Q, experience = %Q, qualification_id = %Q, date_of_birth = %Q, age = %Q where speciality  = %N",
				$doctor->getDoctor_id(),$doctor->getFirst_name(),$doctor->getLast_name(),$doctor->getMobile(),$doctor->getGender(),$doctor->getAddress(),$doctor->getCity(),$doctor->getState(),$doctor->getCountry(),$doctor->getSub_speciality_id(),$doctor->getPicture(),$doctor->getCurrent_hospital(),$doctor->getExperience(),$doctor->getQualification_id(),$doctor->getDate_of_birth(),$doctor->getAge(),$doctor->get(),$doctor->getSpeciality()
			);
		$ret = $this->_query($sql,"Update using column speciality failed on doctor table");
	}
	function updateGender($doctor) {
		$sql = $this->mkSQL("update doctor
				set doctor_id = %Q, first_name = %Q, last_name = %Q, mobile = %Q, speciality = %Q, address = %Q, city = %Q, state = %Q, country = %Q, sub_speciality_id = %Q, picture = %Q, current_hospital = %Q, experience = %Q, qualification_id = %Q, date_of_birth = %Q, age = %Q where gender  = %N",
				$doctor->getDoctor_id(),$doctor->getFirst_name(),$doctor->getLast_name(),$doctor->getMobile(),$doctor->getSpeciality(),$doctor->getAddress(),$doctor->getCity(),$doctor->getState(),$doctor->getCountry(),$doctor->getSub_speciality_id(),$doctor->getPicture(),$doctor->getCurrent_hospital(),$doctor->getExperience(),$doctor->getQualification_id(),$doctor->getDate_of_birth(),$doctor->getAge(),$doctor->get(),$doctor->getGender()
			);
		$ret = $this->_query($sql,"Update using column gender failed on doctor table");
	}
	function updateAddress($doctor) {
		$sql = $this->mkSQL("update doctor
				set doctor_id = %Q, first_name = %Q, last_name = %Q, mobile = %Q, speciality = %Q, gender = %Q, city = %Q, state = %Q, country = %Q, sub_speciality_id = %Q, picture = %Q, current_hospital = %Q, experience = %Q, qualification_id = %Q, date_of_birth = %Q, age = %Q where address  = %N",
				$doctor->getDoctor_id(),$doctor->getFirst_name(),$doctor->getLast_name(),$doctor->getMobile(),$doctor->getSpeciality(),$doctor->getGender(),$doctor->getCity(),$doctor->getState(),$doctor->getCountry(),$doctor->getSub_speciality_id(),$doctor->getPicture(),$doctor->getCurrent_hospital(),$doctor->getExperience(),$doctor->getQualification_id(),$doctor->getDate_of_birth(),$doctor->getAge(),$doctor->get(),$doctor->getAddress()
			);
		$ret = $this->_query($sql,"Update using column address failed on doctor table");
	}
	function updateCity($doctor) {
		$sql = $this->mkSQL("update doctor
				set doctor_id = %Q, first_name = %Q, last_name = %Q, mobile = %Q, speciality = %Q, gender = %Q, address = %Q, state = %Q, country = %Q, sub_speciality_id = %Q, picture = %Q, current_hospital = %Q, experience = %Q, qualification_id = %Q, date_of_birth = %Q, age = %Q where city  = %N",
				$doctor->getDoctor_id(),$doctor->getFirst_name(),$doctor->getLast_name(),$doctor->getMobile(),$doctor->getSpeciality(),$doctor->getGender(),$doctor->getAddress(),$doctor->getState(),$doctor->getCountry(),$doctor->getSub_speciality_id(),$doctor->getPicture(),$doctor->getCurrent_hospital(),$doctor->getExperience(),$doctor->getQualification_id(),$doctor->getDate_of_birth(),$doctor->getAge(),$doctor->get(),$doctor->getCity()
			);
		$ret = $this->_query($sql,"Update using column city failed on doctor table");
	}
	function updateState($doctor) {
		$sql = $this->mkSQL("update doctor
				set doctor_id = %Q, first_name = %Q, last_name = %Q, mobile = %Q, speciality = %Q, gender = %Q, address = %Q, city = %Q, country = %Q, sub_speciality_id = %Q, picture = %Q, current_hospital = %Q, experience = %Q, qualification_id = %Q, date_of_birth = %Q, age = %Q where state  = %N",
				$doctor->getDoctor_id(),$doctor->getFirst_name(),$doctor->getLast_name(),$doctor->getMobile(),$doctor->getSpeciality(),$doctor->getGender(),$doctor->getAddress(),$doctor->getCity(),$doctor->getCountry(),$doctor->getSub_speciality_id(),$doctor->getPicture(),$doctor->getCurrent_hospital(),$doctor->getExperience(),$doctor->getQualification_id(),$doctor->getDate_of_birth(),$doctor->getAge(),$doctor->get(),$doctor->getState()
			);
		$ret = $this->_query($sql,"Update using column state failed on doctor table");
	}
	function updateCountry($doctor) {
		$sql = $this->mkSQL("update doctor
				set doctor_id = %Q, first_name = %Q, last_name = %Q, mobile = %Q, speciality = %Q, gender = %Q, address = %Q, city = %Q, state = %Q, sub_speciality_id = %Q, picture = %Q, current_hospital = %Q, experience = %Q, qualification_id = %Q, date_of_birth = %Q, age = %Q where country  = %N",
				$doctor->getDoctor_id(),$doctor->getFirst_name(),$doctor->getLast_name(),$doctor->getMobile(),$doctor->getSpeciality(),$doctor->getGender(),$doctor->getAddress(),$doctor->getCity(),$doctor->getState(),$doctor->getSub_speciality_id(),$doctor->getPicture(),$doctor->getCurrent_hospital(),$doctor->getExperience(),$doctor->getQualification_id(),$doctor->getDate_of_birth(),$doctor->getAge(),$doctor->get(),$doctor->getCountry()
			);
		$ret = $this->_query($sql,"Update using column country failed on doctor table");
	}
	function updateSub_speciality_id($doctor) {
		$sql = $this->mkSQL("update doctor
				set doctor_id = %Q, first_name = %Q, last_name = %Q, mobile = %Q, speciality = %Q, gender = %Q, address = %Q, city = %Q, state = %Q, country = %Q, picture = %Q, current_hospital = %Q, experience = %Q, qualification_id = %Q, date_of_birth = %Q, age = %Q where sub_speciality_id  = %N",
				$doctor->getDoctor_id(),$doctor->getFirst_name(),$doctor->getLast_name(),$doctor->getMobile(),$doctor->getSpeciality(),$doctor->getGender(),$doctor->getAddress(),$doctor->getCity(),$doctor->getState(),$doctor->getCountry(),$doctor->getPicture(),$doctor->getCurrent_hospital(),$doctor->getExperience(),$doctor->getQualification_id(),$doctor->getDate_of_birth(),$doctor->getAge(),$doctor->get(),$doctor->getSub_speciality_id()
			);
		$ret = $this->_query($sql,"Update using column sub_speciality_id failed on doctor table");
	}
	function updatePicture($doctor) {
		$sql = $this->mkSQL("update doctor
				set doctor_id = %Q, first_name = %Q, last_name = %Q, mobile = %Q, speciality = %Q, gender = %Q, address = %Q, city = %Q, state = %Q, country = %Q, sub_speciality_id = %Q, current_hospital = %Q, experience = %Q, qualification_id = %Q, date_of_birth = %Q, age = %Q where picture  = %N",
				$doctor->getDoctor_id(),$doctor->getFirst_name(),$doctor->getLast_name(),$doctor->getMobile(),$doctor->getSpeciality(),$doctor->getGender(),$doctor->getAddress(),$doctor->getCity(),$doctor->getState(),$doctor->getCountry(),$doctor->getSub_speciality_id(),$doctor->getCurrent_hospital(),$doctor->getExperience(),$doctor->getQualification_id(),$doctor->getDate_of_birth(),$doctor->getAge(),$doctor->get(),$doctor->getPicture()
			);
		$ret = $this->_query($sql,"Update using column picture failed on doctor table");
	}
	function updateCurrent_hospital($doctor) {
		$sql = $this->mkSQL("update doctor
				set doctor_id = %Q, first_name = %Q, last_name = %Q, mobile = %Q, speciality = %Q, gender = %Q, address = %Q, city = %Q, state = %Q, country = %Q, sub_speciality_id = %Q, picture = %Q, experience = %Q, qualification_id = %Q, date_of_birth = %Q, age = %Q where current_hospital  = %N",
				$doctor->getDoctor_id(),$doctor->getFirst_name(),$doctor->getLast_name(),$doctor->getMobile(),$doctor->getSpeciality(),$doctor->getGender(),$doctor->getAddress(),$doctor->getCity(),$doctor->getState(),$doctor->getCountry(),$doctor->getSub_speciality_id(),$doctor->getPicture(),$doctor->getExperience(),$doctor->getQualification_id(),$doctor->getDate_of_birth(),$doctor->getAge(),$doctor->get(),$doctor->getCurrent_hospital()
			);
		$ret = $this->_query($sql,"Update using column current_hospital failed on doctor table");
	}
	function updateExperience($doctor) {
		$sql = $this->mkSQL("update doctor
				set doctor_id = %Q, first_name = %Q, last_name = %Q, mobile = %Q, speciality = %Q, gender = %Q, address = %Q, city = %Q, state = %Q, country = %Q, sub_speciality_id = %Q, picture = %Q, current_hospital = %Q, qualification_id = %Q, date_of_birth = %Q, age = %Q where experience  = %N",
				$doctor->getDoctor_id(),$doctor->getFirst_name(),$doctor->getLast_name(),$doctor->getMobile(),$doctor->getSpeciality(),$doctor->getGender(),$doctor->getAddress(),$doctor->getCity(),$doctor->getState(),$doctor->getCountry(),$doctor->getSub_speciality_id(),$doctor->getPicture(),$doctor->getCurrent_hospital(),$doctor->getQualification_id(),$doctor->getDate_of_birth(),$doctor->getAge(),$doctor->get(),$doctor->getExperience()
			);
		$ret = $this->_query($sql,"Update using column experience failed on doctor table");
	}
	function updateQualification_id($doctor) {
		$sql = $this->mkSQL("update doctor
				set doctor_id = %Q, first_name = %Q, last_name = %Q, mobile = %Q, speciality = %Q, gender = %Q, address = %Q, city = %Q, state = %Q, country = %Q, sub_speciality_id = %Q, picture = %Q, current_hospital = %Q, experience = %Q, date_of_birth = %Q, age = %Q where qualification_id  = %N",
				$doctor->getDoctor_id(),$doctor->getFirst_name(),$doctor->getLast_name(),$doctor->getMobile(),$doctor->getSpeciality(),$doctor->getGender(),$doctor->getAddress(),$doctor->getCity(),$doctor->getState(),$doctor->getCountry(),$doctor->getSub_speciality_id(),$doctor->getPicture(),$doctor->getCurrent_hospital(),$doctor->getExperience(),$doctor->getDate_of_birth(),$doctor->getAge(),$doctor->get(),$doctor->getQualification_id()
			);
		$ret = $this->_query($sql,"Update using column qualification_id failed on doctor table");
	}
	function updateDate_of_birth($doctor) {
		$sql = $this->mkSQL("update doctor
				set doctor_id = %Q, first_name = %Q, last_name = %Q, mobile = %Q, speciality = %Q, gender = %Q, address = %Q, city = %Q, state = %Q, country = %Q, sub_speciality_id = %Q, picture = %Q, current_hospital = %Q, experience = %Q, qualification_id = %Q, age = %Q where date_of_birth  = %N",
				$doctor->getDoctor_id(),$doctor->getFirst_name(),$doctor->getLast_name(),$doctor->getMobile(),$doctor->getSpeciality(),$doctor->getGender(),$doctor->getAddress(),$doctor->getCity(),$doctor->getState(),$doctor->getCountry(),$doctor->getSub_speciality_id(),$doctor->getPicture(),$doctor->getCurrent_hospital(),$doctor->getExperience(),$doctor->getQualification_id(),$doctor->getAge(),$doctor->get(),$doctor->getDate_of_birth()
			);
		$ret = $this->_query($sql,"Update using column date_of_birth failed on doctor table");
	}
	function updateAge($doctor) {
		$sql = $this->mkSQL("update doctor
				set doctor_id = %Q, first_name = %Q, last_name = %Q, mobile = %Q, speciality = %Q, gender = %Q, address = %Q, city = %Q, state = %Q, country = %Q, sub_speciality_id = %Q, picture = %Q, current_hospital = %Q, experience = %Q, qualification_id = %Q, date_of_birth = %Q where age  = %N",
				$doctor->getDoctor_id(),$doctor->getFirst_name(),$doctor->getLast_name(),$doctor->getMobile(),$doctor->getSpeciality(),$doctor->getGender(),$doctor->getAddress(),$doctor->getCity(),$doctor->getState(),$doctor->getCountry(),$doctor->getSub_speciality_id(),$doctor->getPicture(),$doctor->getCurrent_hospital(),$doctor->getExperience(),$doctor->getQualification_id(),$doctor->getDate_of_birth(),$doctor->get(),$doctor->getAge()
			);
		$ret = $this->_query($sql,"Update using column age failed on doctor table");
	}
	function deleteDoctor_id($doctor) {
		$sql = $this->mkSQL("delete from doctor where doctor_id  = %N",
				$doctor->getDoctor_id(),
			);
		$ret = $this->_query($sql,"Delete using column doctor_id failed on doctor table");
	}
	function deleteFirst_name($doctor) {
		$sql = $this->mkSQL("delete from doctor where first_name  = %N",
				$doctor->getFirst_name(),
			);
		$ret = $this->_query($sql,"Delete using column first_name failed on doctor table");
	}
	function deleteLast_name($doctor) {
		$sql = $this->mkSQL("delete from doctor where last_name  = %N",
				$doctor->getLast_name(),
			);
		$ret = $this->_query($sql,"Delete using column last_name failed on doctor table");
	}
	function deleteMobile($doctor) {
		$sql = $this->mkSQL("delete from doctor where mobile  = %N",
				$doctor->getMobile(),
			);
		$ret = $this->_query($sql,"Delete using column mobile failed on doctor table");
	}
	function deleteSpeciality($doctor) {
		$sql = $this->mkSQL("delete from doctor where speciality  = %N",
				$doctor->getSpeciality(),
			);
		$ret = $this->_query($sql,"Delete using column speciality failed on doctor table");
	}
	function deleteGender($doctor) {
		$sql = $this->mkSQL("delete from doctor where gender  = %N",
				$doctor->getGender(),
			);
		$ret = $this->_query($sql,"Delete using column gender failed on doctor table");
	}
	function deleteAddress($doctor) {
		$sql = $this->mkSQL("delete from doctor where address  = %N",
				$doctor->getAddress(),
			);
		$ret = $this->_query($sql,"Delete using column address failed on doctor table");
	}
	function deleteCity($doctor) {
		$sql = $this->mkSQL("delete from doctor where city  = %N",
				$doctor->getCity(),
			);
		$ret = $this->_query($sql,"Delete using column city failed on doctor table");
	}
	function deleteState($doctor) {
		$sql = $this->mkSQL("delete from doctor where state  = %N",
				$doctor->getState(),
			);
		$ret = $this->_query($sql,"Delete using column state failed on doctor table");
	}
	function deleteCountry($doctor) {
		$sql = $this->mkSQL("delete from doctor where country  = %N",
				$doctor->getCountry(),
			);
		$ret = $this->_query($sql,"Delete using column country failed on doctor table");
	}
	function deleteSub_speciality_id($doctor) {
		$sql = $this->mkSQL("delete from doctor where sub_speciality_id  = %N",
				$doctor->getSub_speciality_id(),
			);
		$ret = $this->_query($sql,"Delete using column sub_speciality_id failed on doctor table");
	}
	function deletePicture($doctor) {
		$sql = $this->mkSQL("delete from doctor where picture  = %N",
				$doctor->getPicture(),
			);
		$ret = $this->_query($sql,"Delete using column picture failed on doctor table");
	}
	function deleteCurrent_hospital($doctor) {
		$sql = $this->mkSQL("delete from doctor where current_hospital  = %N",
				$doctor->getCurrent_hospital(),
			);
		$ret = $this->_query($sql,"Delete using column current_hospital failed on doctor table");
	}
	function deleteExperience($doctor) {
		$sql = $this->mkSQL("delete from doctor where experience  = %N",
				$doctor->getExperience(),
			);
		$ret = $this->_query($sql,"Delete using column experience failed on doctor table");
	}
	function deleteQualification_id($doctor) {
		$sql = $this->mkSQL("delete from doctor where qualification_id  = %N",
				$doctor->getQualification_id(),
			);
		$ret = $this->_query($sql,"Delete using column qualification_id failed on doctor table");
	}
	function deleteDate_of_birth($doctor) {
		$sql = $this->mkSQL("delete from doctor where date_of_birth  = %N",
				$doctor->getDate_of_birth(),
			);
		$ret = $this->_query($sql,"Delete using column date_of_birth failed on doctor table");
	}
	function deleteAge($doctor) {
		$sql = $this->mkSQL("delete from doctor where age  = %N",
				$doctor->getAge(),
			);
		$ret = $this->_query($sql,"Delete using column age failed on doctor table");
	}
}
?>