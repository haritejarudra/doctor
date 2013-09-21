<?php 
require_once ("classes/Query.php");
require_once ("classes/patient.php");
class PatientQuery extends Query {
	var $_rowCount = 0;
	function PatientQuery () {
		$this->Query();
	}
	function getRowCount() {
		return $this->_rowCount;
	}
	function fetchPatient() {
		$array = $this->_conn->fetchRow();
		if ($array == false) {
			return false;
		}
		return $this->_mkObj($array);
	}
	function _mkObj($array) {
		$obj = new Patient();
		$obj->setPatient_id($array["patient_id"]);
		$obj->setFirst_name($array["first_name"]);
		$obj->setLast_name($array["last_name"]);
		$obj->setEmail($array["email"]);
		$obj->setMobile($array["mobile"]);
		$obj->setGender($array["gender"]);
		$obj->setAge($array["age"]);
		$obj->setDate_of_birth($array["date_of_birth"]);
		$obj->setAddress($array["address"]);
		$obj->setParent_guardian($array["parent_guardian"]);
		return $obj;
	}
	function selectAll($last,$count) {
		$sql = $this->mkSQL("select * from patient limit %N, %N",$last, $count);
		return array_map(array($this, '_mkObj'), $this->exec($sql));
	}
	function selectPatient_id($patient_id) {
		$sql = $this->mkSQL("select * from patient where patient_id  = %N",
				$patient_id
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function selectFirst_name($first_name) {
		$sql = $this->mkSQL("select * from patient where first_name  = %Q",
				$first_name
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function selectLast_name($last_name) {
		$sql = $this->mkSQL("select * from patient where last_name  = %Q",
				$last_name
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function selectEmail($email) {
		$sql = $this->mkSQL("select * from patient where email  = %Q",
				$email
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function selectMobile($mobile) {
		$sql = $this->mkSQL("select * from patient where mobile  = %Q",
				$mobile
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function selectGender($gender) {
		$sql = $this->mkSQL("select * from patient where gender  = %Q",
				$gender
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function selectAge($age) {
		$sql = $this->mkSQL("select * from patient where age  = %N",
				$age
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function selectDate_of_birth($date_of_birth) {
		$sql = $this->mkSQL("select * from patient where date_of_birth  = %Q",
				$date_of_birth
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function selectAddress($address) {
		$sql = $this->mkSQL("select * from patient where address  = %Q",
				$address
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function selectParent_guardian($parent_guardian) {
		$sql = $this->mkSQL("select * from patient where parent_guardian  = %Q",
				$parent_guardian
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function insert($patient) {
		$sql = $this->mkSQL("insert into patient values (%N, %Q, %Q, %Q, %Q, %Q, %N, %Q, %Q, %Q)",
				$patient->getPatient_id(),$patient->getFirst_name(),$patient->getLast_name(),$patient->getEmail(),$patient->getMobile(),$patient->getGender(),$patient->getAge(),$patient->getDate_of_birth(),$patient->getAddress(),$patient->getParent_guardian()
			);
		$ret = $this->_query($sql,"Insert failed on patient table");
	}
	function updatePatient_id($patient) {
		$sql = $this->mkSQL("update patient
				set first_name = %Q, last_name = %Q, email = %Q, mobile = %Q, gender = %Q, age = %N, date_of_birth = %Q, address = %Q, parent_guardian = %Q where patient_id = %N ",
				$patient->getFirst_name(),$patient->getLast_name(),$patient->getEmail(),$patient->getMobile(),$patient->getGender(),$patient->getAge(),$patient->getDate_of_birth(),$patient->getAddress(),$patient->getParent_guardian(),$patient->get(),$patient->getPatient_id()
			);
		$ret = $this->_query($sql,"Update using column patient_id failed on patient table");
	}
	function updateFirst_name($patient) {
		$sql = $this->mkSQL("update patient
				set patient_id = %N, last_name = %Q, email = %Q, mobile = %Q, gender = %Q, age = %N, date_of_birth = %Q, address = %Q, parent_guardian = %Q where first_name = %Q ",
				$patient->getPatient_id(),$patient->getLast_name(),$patient->getEmail(),$patient->getMobile(),$patient->getGender(),$patient->getAge(),$patient->getDate_of_birth(),$patient->getAddress(),$patient->getParent_guardian(),$patient->get(),$patient->getFirst_name()
			);
		$ret = $this->_query($sql,"Update using column first_name failed on patient table");
	}
	function updateLast_name($patient) {
		$sql = $this->mkSQL("update patient
				set patient_id = %N, first_name = %Q, email = %Q, mobile = %Q, gender = %Q, age = %N, date_of_birth = %Q, address = %Q, parent_guardian = %Q where last_name = %Q ",
				$patient->getPatient_id(),$patient->getFirst_name(),$patient->getEmail(),$patient->getMobile(),$patient->getGender(),$patient->getAge(),$patient->getDate_of_birth(),$patient->getAddress(),$patient->getParent_guardian(),$patient->get(),$patient->getLast_name()
			);
		$ret = $this->_query($sql,"Update using column last_name failed on patient table");
	}
	function updateEmail($patient) {
		$sql = $this->mkSQL("update patient
				set patient_id = %N, first_name = %Q, last_name = %Q, mobile = %Q, gender = %Q, age = %N, date_of_birth = %Q, address = %Q, parent_guardian = %Q where email = %Q ",
				$patient->getPatient_id(),$patient->getFirst_name(),$patient->getLast_name(),$patient->getMobile(),$patient->getGender(),$patient->getAge(),$patient->getDate_of_birth(),$patient->getAddress(),$patient->getParent_guardian(),$patient->get(),$patient->getEmail()
			);
		$ret = $this->_query($sql,"Update using column email failed on patient table");
	}
	function updateMobile($patient) {
		$sql = $this->mkSQL("update patient
				set patient_id = %N, first_name = %Q, last_name = %Q, email = %Q, gender = %Q, age = %N, date_of_birth = %Q, address = %Q, parent_guardian = %Q where mobile = %Q ",
				$patient->getPatient_id(),$patient->getFirst_name(),$patient->getLast_name(),$patient->getEmail(),$patient->getGender(),$patient->getAge(),$patient->getDate_of_birth(),$patient->getAddress(),$patient->getParent_guardian(),$patient->get(),$patient->getMobile()
			);
		$ret = $this->_query($sql,"Update using column mobile failed on patient table");
	}
	function updateGender($patient) {
		$sql = $this->mkSQL("update patient
				set patient_id = %N, first_name = %Q, last_name = %Q, email = %Q, mobile = %Q, age = %N, date_of_birth = %Q, address = %Q, parent_guardian = %Q where gender = %Q ",
				$patient->getPatient_id(),$patient->getFirst_name(),$patient->getLast_name(),$patient->getEmail(),$patient->getMobile(),$patient->getAge(),$patient->getDate_of_birth(),$patient->getAddress(),$patient->getParent_guardian(),$patient->get(),$patient->getGender()
			);
		$ret = $this->_query($sql,"Update using column gender failed on patient table");
	}
	function updateAge($patient) {
		$sql = $this->mkSQL("update patient
				set patient_id = %N, first_name = %Q, last_name = %Q, email = %Q, mobile = %Q, gender = %Q, date_of_birth = %Q, address = %Q, parent_guardian = %Q where age = %N ",
				$patient->getPatient_id(),$patient->getFirst_name(),$patient->getLast_name(),$patient->getEmail(),$patient->getMobile(),$patient->getGender(),$patient->getDate_of_birth(),$patient->getAddress(),$patient->getParent_guardian(),$patient->get(),$patient->getAge()
			);
		$ret = $this->_query($sql,"Update using column age failed on patient table");
	}
	function updateDate_of_birth($patient) {
		$sql = $this->mkSQL("update patient
				set patient_id = %N, first_name = %Q, last_name = %Q, email = %Q, mobile = %Q, gender = %Q, age = %N, address = %Q, parent_guardian = %Q where date_of_birth = %Q ",
				$patient->getPatient_id(),$patient->getFirst_name(),$patient->getLast_name(),$patient->getEmail(),$patient->getMobile(),$patient->getGender(),$patient->getAge(),$patient->getAddress(),$patient->getParent_guardian(),$patient->get(),$patient->getDate_of_birth()
			);
		$ret = $this->_query($sql,"Update using column date_of_birth failed on patient table");
	}
	function updateAddress($patient) {
		$sql = $this->mkSQL("update patient
				set patient_id = %N, first_name = %Q, last_name = %Q, email = %Q, mobile = %Q, gender = %Q, age = %N, date_of_birth = %Q, parent_guardian = %Q where address = %Q ",
				$patient->getPatient_id(),$patient->getFirst_name(),$patient->getLast_name(),$patient->getEmail(),$patient->getMobile(),$patient->getGender(),$patient->getAge(),$patient->getDate_of_birth(),$patient->getParent_guardian(),$patient->get(),$patient->getAddress()
			);
		$ret = $this->_query($sql,"Update using column address failed on patient table");
	}
	function updateParent_guardian($patient) {
		$sql = $this->mkSQL("update patient
				set patient_id = %N, first_name = %Q, last_name = %Q, email = %Q, mobile = %Q, gender = %Q, age = %N, date_of_birth = %Q, address = %Q where parent_guardian = %Q ",
				$patient->getPatient_id(),$patient->getFirst_name(),$patient->getLast_name(),$patient->getEmail(),$patient->getMobile(),$patient->getGender(),$patient->getAge(),$patient->getDate_of_birth(),$patient->getAddress(),$patient->get(),$patient->getParent_guardian()
			);
		$ret = $this->_query($sql,"Update using column parent_guardian failed on patient table");
	}
	function deletePatient_id($patient) {
		$sql = $this->mkSQL("delete from patient where patient_id = %Q ",
				$patient->getPatient_id()
			);
		$ret = $this->_query($sql,"Delete using column patient_id failed on patient table");
	}
	function deleteFirst_name($patient) {
		$sql = $this->mkSQL("delete from patient where first_name = %Q ",
				$patient->getFirst_name()
			);
		$ret = $this->_query($sql,"Delete using column first_name failed on patient table");
	}
	function deleteLast_name($patient) {
		$sql = $this->mkSQL("delete from patient where last_name = %Q ",
				$patient->getLast_name()
			);
		$ret = $this->_query($sql,"Delete using column last_name failed on patient table");
	}
	function deleteEmail($patient) {
		$sql = $this->mkSQL("delete from patient where email = %Q ",
				$patient->getEmail()
			);
		$ret = $this->_query($sql,"Delete using column email failed on patient table");
	}
	function deleteMobile($patient) {
		$sql = $this->mkSQL("delete from patient where mobile = %Q ",
				$patient->getMobile()
			);
		$ret = $this->_query($sql,"Delete using column mobile failed on patient table");
	}
	function deleteGender($patient) {
		$sql = $this->mkSQL("delete from patient where gender = %Q ",
				$patient->getGender()
			);
		$ret = $this->_query($sql,"Delete using column gender failed on patient table");
	}
	function deleteAge($patient) {
		$sql = $this->mkSQL("delete from patient where age = %Q ",
				$patient->getAge()
			);
		$ret = $this->_query($sql,"Delete using column age failed on patient table");
	}
	function deleteDate_of_birth($patient) {
		$sql = $this->mkSQL("delete from patient where date_of_birth = %Q ",
				$patient->getDate_of_birth()
			);
		$ret = $this->_query($sql,"Delete using column date_of_birth failed on patient table");
	}
	function deleteAddress($patient) {
		$sql = $this->mkSQL("delete from patient where address = %Q ",
				$patient->getAddress()
			);
		$ret = $this->_query($sql,"Delete using column address failed on patient table");
	}
	function deleteParent_guardian($patient) {
		$sql = $this->mkSQL("delete from patient where parent_guardian = %Q ",
				$patient->getParent_guardian()
			);
		$ret = $this->_query($sql,"Delete using column parent_guardian failed on patient table");
	}
}
?>
