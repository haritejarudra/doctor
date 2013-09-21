<?php 
require_once ("classes/Query.php");
require_once ("classes/sub_speciality.php");
class Sub_specialityQuery extends Query {
	var $_rowCount = 0;
	function Sub_specialityQuery () {
		$this->Query();
	}
	function getRowCount() {
		return $this->_rowCount;
	}
	function fetchSub_speciality() {
		$array = $this->_conn->fetchRow();
		if ($array == false) {
			return false;
		}
		return $this->_mkObj($array);
	}
	function getSubSpecialitiesFor($speciality){
		$sql = $this->mkSQL("select * from sub_speciality where sub_speciality_id IN(select sub_speciality_id from speciality_sub_speciality_link where 					speciality_id IN (select speciality_id from speciality where speciality=%Q))",$speciality);
		return array_map(array($this, '_mkObj'), $this->exec($sql));
	}
	function _mkObj($array) {
		$obj = new Sub_speciality();
		$obj->setSub_speciality_id($array["sub_speciality_id"]);
		$obj->setSpeciality($array["speciality"]);
		return $obj;
	}
	function selectAll($last,$count) {
		$sql = $this->mkSQL("select * from sub_speciality limit %N, %N",$last, $count);
		return array_map(array($this, '_mkObj'), $this->exec($sql));
	}
	function selectSub_speciality_id($sub_speciality_id) {
		$sql = $this->mkSQL("select * from sub_speciality where sub_speciality_id  = %N",
				$sub_speciality_id
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function selectSpeciality($speciality) {
		$sql = $this->mkSQL("select * from sub_speciality where speciality  = %Q",
				$speciality
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function insert($sub_speciality) {
		$sql = $this->mkSQL("insert into sub_speciality values (%N, %Q)",
				$sub_speciality->getSub_speciality_id(),$sub_speciality->getSpeciality()
			);
		$ret = $this->_query($sql,"Insert failed on sub_speciality table");
	}
	function updateSub_speciality_id($sub_speciality) {
		$sql = $this->mkSQL("update sub_speciality
				set speciality = %Q where sub_speciality_id = %N ",
				$sub_speciality->getSpeciality(),$sub_speciality->get(),$sub_speciality->getSub_speciality_id()
			);
		$ret = $this->_query($sql,"Update using column sub_speciality_id failed on sub_speciality table");
	}
	function updateSpeciality($sub_speciality) {
		$sql = $this->mkSQL("update sub_speciality
				set sub_speciality_id = %N where speciality = %Q ",
				$sub_speciality->getSub_speciality_id(),$sub_speciality->get(),$sub_speciality->getSpeciality()
			);
		$ret = $this->_query($sql,"Update using column speciality failed on sub_speciality table");
	}
	function deleteSub_speciality_id($sub_speciality) {
		$sql = $this->mkSQL("delete from sub_speciality where sub_speciality_id = %Q ",
				$sub_speciality->getSub_speciality_id()
			);
		$ret = $this->_query($sql,"Delete using column sub_speciality_id failed on sub_speciality table");
	}
	function deleteSpeciality($sub_speciality) {
		$sql = $this->mkSQL("delete from sub_speciality where speciality = %Q ",
				$sub_speciality->getSpeciality()
			);
		$ret = $this->_query($sql,"Delete using column speciality failed on sub_speciality table");
	}
}
?>
