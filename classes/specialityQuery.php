<?php 

require_once ("classes/Query.php");
require_once ("classes/speciality.php");

class SpecialityQuery extends Query {
	var $_rowCount = 0;
	function SpecialityQuery () {
		$this->Query();
	}
	function getRowCount() {
		return $this->_rowCount;
	}
	function fetchSpeciality() {
		$array = $this->_conn->fetchRow();
		if ($array == false) {
			return false;
		}
		return $this->_mkObj($array);
	}
	function getSpecialities (){
		$sql = $this->mkSQL("select * from speciality");
		return array_map(array($this, '_mkObj'), $this->exec($sql));
	}
	function _mkObj($array) {
		$obj = new Speciality();
		$obj->setSpeciality_id($array["speciality_id"]);
		$obj->setSpeciality($array["speciality"]);
		return $obj;
	}
	function selectAll($last,$count) {
		$sql = $this->mkSQL("select * from speciality limit %N, %N",$last, $count);
		return array_map(array($this, '_mkObj'), $this->exec($sql));
	}
	function selectSpeciality_id($speciality_id) {
		$sql = $this->mkSQL("select * from speciality where speciality_id  = %N",
				$speciality_id
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function selectSpeciality($speciality) {
		$sql = $this->mkSQL("select * from speciality where speciality  = %Q",
				$speciality
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function insert($speciality) {
		$sql = $this->mkSQL("insert into speciality values (%N, %Q)",
				$speciality->getSpeciality_id(),$speciality->getSpeciality()
			);
		$ret = $this->_query($sql,"Insert failed on speciality table");
	}
	function updateSpeciality_id($speciality) {
		$sql = $this->mkSQL("update speciality
				set speciality = %Q where speciality_id = %N ",
				$speciality->getSpeciality(),$speciality->get(),$speciality->getSpeciality_id()
			);
		$ret = $this->_query($sql,"Update using column speciality_id failed on speciality table");
	}
	function updateSpeciality($speciality) {
		$sql = $this->mkSQL("update speciality
				set speciality_id = %N where speciality = %Q ",
				$speciality->getSpeciality_id(),$speciality->get(),$speciality->getSpeciality()
			);
		$ret = $this->_query($sql,"Update using column speciality failed on speciality table");
	}
	function deleteSpeciality_id($speciality) {
		$sql = $this->mkSQL("delete from speciality where speciality_id = %Q ",
				$speciality->getSpeciality_id()
			);
		$ret = $this->_query($sql,"Delete using column speciality_id failed on speciality table");
	}
	function deleteSpeciality($speciality) {
		$sql = $this->mkSQL("delete from speciality where speciality = %Q ",
				$speciality->getSpeciality()
			);
		$ret = $this->_query($sql,"Delete using column speciality failed on speciality table");
	}
}
?>
