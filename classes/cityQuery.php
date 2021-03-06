<?php 
require_once ("classes/Query.php");
require_once ("classes/city.php");
class CityQuery extends Query {
	var $_rowCount = 0;
	function CityQuery () {
		$this->Query();
	}
	function getRowCount() {
		return $this->_rowCount;
	}
	function fetchCity() {
		$array = $this->_conn->fetchRow();
		if ($array == false) {
			return false;
		}
		return $this->_mkObj($array);
	}
	function getCities(){
		$sql = $this->mkSQL("select * from city where city_id IN (select distinct city_id from location where location_id IN (
					select location_id from schedule where expiry_date > CURDATE() ))");
		return array_map(array($this, '_mkObj'), $this->exec($sql));
	}
	function _mkObj($array) {
		$obj = new City();
		$obj->setCity_id($array["city_id"]);
		$obj->setLat($array["lat"]);
		$obj->setLong($array["long"]);
		$obj->setCity($array["city"]);
		return $obj;
	}
	function selectAll($last,$count) {
		$sql = $this->mkSQL("select * from city limit %N, %N",$last, $count);
		return array_map(array($this, '_mkObj'), $this->exec($sql));
	}
	function selectCity_id($city_id) {
		$sql = $this->mkSQL("select * from city where city_id  = %N",
				$city_id
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function selectLat($lat) {
		$sql = $this->mkSQL("select * from city where lat  = %N",
				$lat
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function selectLong($long) {
		$sql = $this->mkSQL("select * from city where long  = %N",
				$long
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function selectCity($city) {
		$sql = $this->mkSQL("select * from city where city  = %Q",
				$city
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function insert($city) {
		$sql = $this->mkSQL("insert into city values (%N, %N, %N, %Q)",
				$city->getCity_id(),$city->getLat(),$city->getLong(),$city->getCity()
			);
		$ret = $this->_query($sql,"Insert failed on city table");
	}
	function updateCity_id($city) {
		$sql = $this->mkSQL("update city
				set lat = %N, long = %N, city = %Q where city_id = %N ",
				$city->getLat(),$city->getLong(),$city->getCity(),$city->get(),$city->getCity_id()
			);
		$ret = $this->_query($sql,"Update using column city_id failed on city table");
	}
	function updateLat($city) {
		$sql = $this->mkSQL("update city
				set city_id = %N, long = %N, city = %Q where lat = %N ",
				$city->getCity_id(),$city->getLong(),$city->getCity(),$city->get(),$city->getLat()
			);
		$ret = $this->_query($sql,"Update using column lat failed on city table");
	}
	function updateLong($city) {
		$sql = $this->mkSQL("update city
				set city_id = %N, lat = %N, city = %Q where long = %N ",
				$city->getCity_id(),$city->getLat(),$city->getCity(),$city->get(),$city->getLong()
			);
		$ret = $this->_query($sql,"Update using column long failed on city table");
	}
	function updateCity($city) {
		$sql = $this->mkSQL("update city
				set city_id = %N, lat = %N, long = %N where city = %Q ",
				$city->getCity_id(),$city->getLat(),$city->getLong(),$city->get(),$city->getCity()
			);
		$ret = $this->_query($sql,"Update using column city failed on city table");
	}
	function deleteCity_id($city) {
		$sql = $this->mkSQL("delete from city where city_id = %Q ",
				$city->getCity_id()
			);
		$ret = $this->_query($sql,"Delete using column city_id failed on city table");
	}
	function deleteLat($city) {
		$sql = $this->mkSQL("delete from city where lat = %Q ",
				$city->getLat()
			);
		$ret = $this->_query($sql,"Delete using column lat failed on city table");
	}
	function deleteLong($city) {
		$sql = $this->mkSQL("delete from city where long = %Q ",
				$city->getLong()
			);
		$ret = $this->_query($sql,"Delete using column long failed on city table");
	}
	function deleteCity($city) {
		$sql = $this->mkSQL("delete from city where city = %Q ",
				$city->getCity()
			);
		$ret = $this->_query($sql,"Delete using column city failed on city table");
	}
}
?>
