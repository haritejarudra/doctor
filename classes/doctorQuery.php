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
		$obj->setFirst_name($array["first_name"]);
		$obj->setLast_name($array["last_name"]);
		$obj->setMobile($array["mobile"]);
		$obj->setGender($array["gender"]);
		$obj->setAddress($array["address"]);
		$obj->setState($array["state"]);
		$obj->setCountry($array["country"]);
		$obj->setCurrent_hospital($array["current_hospital"]);
		$obj->setExperience($array["experience"]);
		$obj->setDate_of_birth($array["date_of_birth"]);
		$obj->setAge($array["age"]);
		$obj->setCity_id($array["city_id"]);
		$obj->setSpeciality_Sub_Speciality_link_id($array["speciality_Sub_Speciality_link_id"]);
		return $obj;
	}
	function selectAll($last,$count) {
		$sql = $this->mkSQL("select * from doctor limit %N, %N",$last, $count);
		return array_map(array($this, '_mkObj'), $this->exec($sql));
	}
	function selectDoctor_id($doctor_id) {
		$sql = $this->mkSQL("select * from doctor where doctor_id  = %N",
				$doctor_id
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function selectFirst_name($first_name) {
		$sql = $this->mkSQL("select * from doctor where first_name  = %Q",
				$first_name
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function selectLast_name($last_name) {
		$sql = $this->mkSQL("select * from doctor where last_name  = %Q",
				$last_name
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function selectMobile($mobile) {
		$sql = $this->mkSQL("select * from doctor where mobile  = %Q",
				$mobile
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function selectGender($gender) {
		$sql = $this->mkSQL("select * from doctor where gender  = %Q",
				$gender
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function selectAddress($address) {
		$sql = $this->mkSQL("select * from doctor where address  = %Q",
				$address
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function selectState($state) {
		$sql = $this->mkSQL("select * from doctor where state  = %Q",
				$state
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function selectCountry($country) {
		$sql = $this->mkSQL("select * from doctor where country  = %Q",
				$country
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function selectCurrent_hospital($current_hospital) {
		$sql = $this->mkSQL("select * from doctor where current_hospital  = %Q",
				$current_hospital
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function selectExperience($experience) {
		$sql = $this->mkSQL("select * from doctor where experience  = %Q",
				$experience
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function selectDate_of_birth($date_of_birth) {
		$sql = $this->mkSQL("select * from doctor where date_of_birth  = %Q",
				$date_of_birth
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function selectAge($age) {
		$sql = $this->mkSQL("select * from doctor where age  = %N",
				$age
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function selectCity_id($city_id) {
		$sql = $this->mkSQL("select * from doctor where city_id  = %N",
				$city_id
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function selectSpeciality_Sub_Speciality_link_id($speciality_Sub_Speciality_link_id) {
		$sql = $this->mkSQL("select * from doctor where speciality_Sub_Speciality_link_id  = %N",
				$speciality_Sub_Speciality_link_id
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function insert($doctor) {
		$sql = $this->mkSQL("insert into doctor values (%N, %Q, %Q, %Q, %Q, %Q, %Q, %Q, %Q, %Q, %Q, %N, %N, %N)",
				$doctor->getDoctor_id(),$doctor->getFirst_name(),$doctor->getLast_name(),$doctor->getMobile(),$doctor->getGender(),$doctor->getAddress(),$doctor->getState(),$doctor->getCountry(),$doctor->getCurrent_hospital(),$doctor->getExperience(),$doctor->getDate_of_birth(),$doctor->getAge(),$doctor->getCity_id(),$doctor->getSpeciality_Sub_Speciality_link_id()
			);
		$ret = $this->_query($sql,"Insert failed on doctor table");
	}
	function updateDoctor_id($doctor) {
		$sql = $this->mkSQL("update doctor
				set first_name = %Q, last_name = %Q, mobile = %Q, gender = %Q, address = %Q, state = %Q, country = %Q, current_hospital = %Q, experience = %Q, date_of_birth = %Q, age = %N, city_id = %N, speciality_Sub_Speciality_link_id = %N where doctor_id = %N ",
				$doctor->getFirst_name(),$doctor->getLast_name(),$doctor->getMobile(),$doctor->getGender(),$doctor->getAddress(),$doctor->getState(),$doctor->getCountry(),$doctor->getCurrent_hospital(),$doctor->getExperience(),$doctor->getDate_of_birth(),$doctor->getAge(),$doctor->getCity_id(),$doctor->getSpeciality_Sub_Speciality_link_id(),$doctor->get(),$doctor->getDoctor_id()
			);
		$ret = $this->_query($sql,"Update using column doctor_id failed on doctor table");
	}
	function updateFirst_name($doctor) {
		$sql = $this->mkSQL("update doctor
				set doctor_id = %N, last_name = %Q, mobile = %Q, gender = %Q, address = %Q, state = %Q, country = %Q, current_hospital = %Q, experience = %Q, date_of_birth = %Q, age = %N, city_id = %N, speciality_Sub_Speciality_link_id = %N where first_name = %Q ",
				$doctor->getDoctor_id(),$doctor->getLast_name(),$doctor->getMobile(),$doctor->getGender(),$doctor->getAddress(),$doctor->getState(),$doctor->getCountry(),$doctor->getCurrent_hospital(),$doctor->getExperience(),$doctor->getDate_of_birth(),$doctor->getAge(),$doctor->getCity_id(),$doctor->getSpeciality_Sub_Speciality_link_id(),$doctor->get(),$doctor->getFirst_name()
			);
		$ret = $this->_query($sql,"Update using column first_name failed on doctor table");
	}
	function updateLast_name($doctor) {
		$sql = $this->mkSQL("update doctor
				set doctor_id = %N, first_name = %Q, mobile = %Q, gender = %Q, address = %Q, state = %Q, country = %Q, current_hospital = %Q, experience = %Q, date_of_birth = %Q, age = %N, city_id = %N, speciality_Sub_Speciality_link_id = %N where last_name = %Q ",
				$doctor->getDoctor_id(),$doctor->getFirst_name(),$doctor->getMobile(),$doctor->getGender(),$doctor->getAddress(),$doctor->getState(),$doctor->getCountry(),$doctor->getCurrent_hospital(),$doctor->getExperience(),$doctor->getDate_of_birth(),$doctor->getAge(),$doctor->getCity_id(),$doctor->getSpeciality_Sub_Speciality_link_id(),$doctor->get(),$doctor->getLast_name()
			);
		$ret = $this->_query($sql,"Update using column last_name failed on doctor table");
	}
	function updateMobile($doctor) {
		$sql = $this->mkSQL("update doctor
				set doctor_id = %N, first_name = %Q, last_name = %Q, gender = %Q, address = %Q, state = %Q, country = %Q, current_hospital = %Q, experience = %Q, date_of_birth = %Q, age = %N, city_id = %N, speciality_Sub_Speciality_link_id = %N where mobile = %Q ",
				$doctor->getDoctor_id(),$doctor->getFirst_name(),$doctor->getLast_name(),$doctor->getGender(),$doctor->getAddress(),$doctor->getState(),$doctor->getCountry(),$doctor->getCurrent_hospital(),$doctor->getExperience(),$doctor->getDate_of_birth(),$doctor->getAge(),$doctor->getCity_id(),$doctor->getSpeciality_Sub_Speciality_link_id(),$doctor->get(),$doctor->getMobile()
			);
		$ret = $this->_query($sql,"Update using column mobile failed on doctor table");
	}
	function updateGender($doctor) {
		$sql = $this->mkSQL("update doctor
				set doctor_id = %N, first_name = %Q, last_name = %Q, mobile = %Q, address = %Q, state = %Q, country = %Q, current_hospital = %Q, experience = %Q, date_of_birth = %Q, age = %N, city_id = %N, speciality_Sub_Speciality_link_id = %N where gender = %Q ",
				$doctor->getDoctor_id(),$doctor->getFirst_name(),$doctor->getLast_name(),$doctor->getMobile(),$doctor->getAddress(),$doctor->getState(),$doctor->getCountry(),$doctor->getCurrent_hospital(),$doctor->getExperience(),$doctor->getDate_of_birth(),$doctor->getAge(),$doctor->getCity_id(),$doctor->getSpeciality_Sub_Speciality_link_id(),$doctor->get(),$doctor->getGender()
			);
		$ret = $this->_query($sql,"Update using column gender failed on doctor table");
	}
	function updateAddress($doctor) {
		$sql = $this->mkSQL("update doctor
				set doctor_id = %N, first_name = %Q, last_name = %Q, mobile = %Q, gender = %Q, state = %Q, country = %Q, current_hospital = %Q, experience = %Q, date_of_birth = %Q, age = %N, city_id = %N, speciality_Sub_Speciality_link_id = %N where address = %Q ",
				$doctor->getDoctor_id(),$doctor->getFirst_name(),$doctor->getLast_name(),$doctor->getMobile(),$doctor->getGender(),$doctor->getState(),$doctor->getCountry(),$doctor->getCurrent_hospital(),$doctor->getExperience(),$doctor->getDate_of_birth(),$doctor->getAge(),$doctor->getCity_id(),$doctor->getSpeciality_Sub_Speciality_link_id(),$doctor->get(),$doctor->getAddress()
			);
		$ret = $this->_query($sql,"Update using column address failed on doctor table");
	}
	function updateState($doctor) {
		$sql = $this->mkSQL("update doctor
				set doctor_id = %N, first_name = %Q, last_name = %Q, mobile = %Q, gender = %Q, address = %Q, country = %Q, current_hospital = %Q, experience = %Q, date_of_birth = %Q, age = %N, city_id = %N, speciality_Sub_Speciality_link_id = %N where state = %Q ",
				$doctor->getDoctor_id(),$doctor->getFirst_name(),$doctor->getLast_name(),$doctor->getMobile(),$doctor->getGender(),$doctor->getAddress(),$doctor->getCountry(),$doctor->getCurrent_hospital(),$doctor->getExperience(),$doctor->getDate_of_birth(),$doctor->getAge(),$doctor->getCity_id(),$doctor->getSpeciality_Sub_Speciality_link_id(),$doctor->get(),$doctor->getState()
			);
		$ret = $this->_query($sql,"Update using column state failed on doctor table");
	}
	function updateCountry($doctor) {
		$sql = $this->mkSQL("update doctor
				set doctor_id = %N, first_name = %Q, last_name = %Q, mobile = %Q, gender = %Q, address = %Q, state = %Q, current_hospital = %Q, experience = %Q, date_of_birth = %Q, age = %N, city_id = %N, speciality_Sub_Speciality_link_id = %N where country = %Q ",
				$doctor->getDoctor_id(),$doctor->getFirst_name(),$doctor->getLast_name(),$doctor->getMobile(),$doctor->getGender(),$doctor->getAddress(),$doctor->getState(),$doctor->getCurrent_hospital(),$doctor->getExperience(),$doctor->getDate_of_birth(),$doctor->getAge(),$doctor->getCity_id(),$doctor->getSpeciality_Sub_Speciality_link_id(),$doctor->get(),$doctor->getCountry()
			);
		$ret = $this->_query($sql,"Update using column country failed on doctor table");
	}
	function updateCurrent_hospital($doctor) {
		$sql = $this->mkSQL("update doctor
				set doctor_id = %N, first_name = %Q, last_name = %Q, mobile = %Q, gender = %Q, address = %Q, state = %Q, country = %Q, experience = %Q, date_of_birth = %Q, age = %N, city_id = %N, speciality_Sub_Speciality_link_id = %N where current_hospital = %Q ",
				$doctor->getDoctor_id(),$doctor->getFirst_name(),$doctor->getLast_name(),$doctor->getMobile(),$doctor->getGender(),$doctor->getAddress(),$doctor->getState(),$doctor->getCountry(),$doctor->getExperience(),$doctor->getDate_of_birth(),$doctor->getAge(),$doctor->getCity_id(),$doctor->getSpeciality_Sub_Speciality_link_id(),$doctor->get(),$doctor->getCurrent_hospital()
			);
		$ret = $this->_query($sql,"Update using column current_hospital failed on doctor table");
	}
	function updateExperience($doctor) {
		$sql = $this->mkSQL("update doctor
				set doctor_id = %N, first_name = %Q, last_name = %Q, mobile = %Q, gender = %Q, address = %Q, state = %Q, country = %Q, current_hospital = %Q, date_of_birth = %Q, age = %N, city_id = %N, speciality_Sub_Speciality_link_id = %N where experience = %Q ",
				$doctor->getDoctor_id(),$doctor->getFirst_name(),$doctor->getLast_name(),$doctor->getMobile(),$doctor->getGender(),$doctor->getAddress(),$doctor->getState(),$doctor->getCountry(),$doctor->getCurrent_hospital(),$doctor->getDate_of_birth(),$doctor->getAge(),$doctor->getCity_id(),$doctor->getSpeciality_Sub_Speciality_link_id(),$doctor->get(),$doctor->getExperience()
			);
		$ret = $this->_query($sql,"Update using column experience failed on doctor table");
	}
	function updateDate_of_birth($doctor) {
		$sql = $this->mkSQL("update doctor
				set doctor_id = %N, first_name = %Q, last_name = %Q, mobile = %Q, gender = %Q, address = %Q, state = %Q, country = %Q, current_hospital = %Q, experience = %Q, age = %N, city_id = %N, speciality_Sub_Speciality_link_id = %N where date_of_birth = %Q ",
				$doctor->getDoctor_id(),$doctor->getFirst_name(),$doctor->getLast_name(),$doctor->getMobile(),$doctor->getGender(),$doctor->getAddress(),$doctor->getState(),$doctor->getCountry(),$doctor->getCurrent_hospital(),$doctor->getExperience(),$doctor->getAge(),$doctor->getCity_id(),$doctor->getSpeciality_Sub_Speciality_link_id(),$doctor->get(),$doctor->getDate_of_birth()
			);
		$ret = $this->_query($sql,"Update using column date_of_birth failed on doctor table");
	}
	function updateAge($doctor) {
		$sql = $this->mkSQL("update doctor
				set doctor_id = %N, first_name = %Q, last_name = %Q, mobile = %Q, gender = %Q, address = %Q, state = %Q, country = %Q, current_hospital = %Q, experience = %Q, date_of_birth = %Q, city_id = %N, speciality_Sub_Speciality_link_id = %N where age = %N ",
				$doctor->getDoctor_id(),$doctor->getFirst_name(),$doctor->getLast_name(),$doctor->getMobile(),$doctor->getGender(),$doctor->getAddress(),$doctor->getState(),$doctor->getCountry(),$doctor->getCurrent_hospital(),$doctor->getExperience(),$doctor->getDate_of_birth(),$doctor->getCity_id(),$doctor->getSpeciality_Sub_Speciality_link_id(),$doctor->get(),$doctor->getAge()
			);
		$ret = $this->_query($sql,"Update using column age failed on doctor table");
	}
	function updateCity_id($doctor) {
		$sql = $this->mkSQL("update doctor
				set doctor_id = %N, first_name = %Q, last_name = %Q, mobile = %Q, gender = %Q, address = %Q, state = %Q, country = %Q, current_hospital = %Q, experience = %Q, date_of_birth = %Q, age = %N, speciality_Sub_Speciality_link_id = %N where city_id = %N ",
				$doctor->getDoctor_id(),$doctor->getFirst_name(),$doctor->getLast_name(),$doctor->getMobile(),$doctor->getGender(),$doctor->getAddress(),$doctor->getState(),$doctor->getCountry(),$doctor->getCurrent_hospital(),$doctor->getExperience(),$doctor->getDate_of_birth(),$doctor->getAge(),$doctor->getSpeciality_Sub_Speciality_link_id(),$doctor->get(),$doctor->getCity_id()
			);
		$ret = $this->_query($sql,"Update using column city_id failed on doctor table");
	}
	function updateSpeciality_Sub_Speciality_link_id($doctor) {
		$sql = $this->mkSQL("update doctor
				set doctor_id = %N, first_name = %Q, last_name = %Q, mobile = %Q, gender = %Q, address = %Q, state = %Q, country = %Q, current_hospital = %Q, experience = %Q, date_of_birth = %Q, age = %N, city_id = %N where speciality_Sub_Speciality_link_id = %N ",
				$doctor->getDoctor_id(),$doctor->getFirst_name(),$doctor->getLast_name(),$doctor->getMobile(),$doctor->getGender(),$doctor->getAddress(),$doctor->getState(),$doctor->getCountry(),$doctor->getCurrent_hospital(),$doctor->getExperience(),$doctor->getDate_of_birth(),$doctor->getAge(),$doctor->getCity_id(),$doctor->get(),$doctor->getSpeciality_Sub_Speciality_link_id()
			);
		$ret = $this->_query($sql,"Update using column speciality_Sub_Speciality_link_id failed on doctor table");
	}
	function deleteDoctor_id($doctor) {
		$sql = $this->mkSQL("delete from doctor where doctor_id = %Q ",
				$doctor->getDoctor_id()
			);
		$ret = $this->_query($sql,"Delete using column doctor_id failed on doctor table");
	}
	function deleteFirst_name($doctor) {
		$sql = $this->mkSQL("delete from doctor where first_name = %Q ",
				$doctor->getFirst_name()
			);
		$ret = $this->_query($sql,"Delete using column first_name failed on doctor table");
	}
	function deleteLast_name($doctor) {
		$sql = $this->mkSQL("delete from doctor where last_name = %Q ",
				$doctor->getLast_name()
			);
		$ret = $this->_query($sql,"Delete using column last_name failed on doctor table");
	}
	function deleteMobile($doctor) {
		$sql = $this->mkSQL("delete from doctor where mobile = %Q ",
				$doctor->getMobile()
			);
		$ret = $this->_query($sql,"Delete using column mobile failed on doctor table");
	}
	function deleteGender($doctor) {
		$sql = $this->mkSQL("delete from doctor where gender = %Q ",
				$doctor->getGender()
			);
		$ret = $this->_query($sql,"Delete using column gender failed on doctor table");
	}
	function deleteAddress($doctor) {
		$sql = $this->mkSQL("delete from doctor where address = %Q ",
				$doctor->getAddress()
			);
		$ret = $this->_query($sql,"Delete using column address failed on doctor table");
	}
	function deleteState($doctor) {
		$sql = $this->mkSQL("delete from doctor where state = %Q ",
				$doctor->getState()
			);
		$ret = $this->_query($sql,"Delete using column state failed on doctor table");
	}
	function deleteCountry($doctor) {
		$sql = $this->mkSQL("delete from doctor where country = %Q ",
				$doctor->getCountry()
			);
		$ret = $this->_query($sql,"Delete using column country failed on doctor table");
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
	function deleteDate_of_birth($doctor) {
		$sql = $this->mkSQL("delete from doctor where date_of_birth = %Q ",
				$doctor->getDate_of_birth()
			);
		$ret = $this->_query($sql,"Delete using column date_of_birth failed on doctor table");
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
