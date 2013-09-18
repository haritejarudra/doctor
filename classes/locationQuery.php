<?php 
require_once ("classes/Query.php");
require_once ("classes/location.php");
class LocationQuery extends Query {
	var $_rowCount = 0;
	function LocationQuery () {
		$this->Query();
	}
	function getRowCount() {
		return $this->_rowCount;
	}
	function fetchLocation() {
		$array = $this->_conn->fetchRow();
		if ($array == false) {
			return false;
		}
		return $this->_mkObj($array);
	}
	function getLocationsForCity($city) {
		$sql = $this->mkSQL("select * from location where city_id in (select city_id from city where city = %Q)",$city);
		return array_map(array($this, '_mkObj'), $this->exec($sql));
	}
	function getLocationsInTheSameCityAs($locationid) {
		$sql = $this->mkSQL("select * from location where city_id = (select city_id from location where location_id = %N) ", $locationid);
		return array_map(array($this, '_mkObj'), $this->exec($sql));
	}
	function getLocationsForCriteria($city,$speciality,$subspeciality) {

		$sqlstring =  "select a.* from location a, schedule b, doctor c, speciality_sub_speciality_link d, speciality e, sub_speciality f";
		$sqlstring .= " where a.city_id in (select city_id from city where city = '" .$city. "')";
		$sqlstring .= " and a.location_id = b.location_id and b.doctor_id = c.doctor_id";
		$sqlstring .= " and c.speciality_sub_speciality_link_id = d.speciality_sub_speciality_link_id";
		$sqlstring .= " and d.speciality_id = e.speciality_id and d.sub_speciality_id = f.sub_speciality_id";
		if ( !(empty($speciality)) && (strlen($speciality) > 0) )
			$sqlstring .= " and d.speciality = '" . $speciality . "'";

		if ( !(empty($subspeciality)) && (strlen($subspeciality) > 0) )
			$sqlstring .= " and e.speciality = '" . $subspeciality . "'";

		return array_map(array($this, '_mkObj'), $this->exec($sql));

	}
	function getCityOfLocation($chosenlocationid)
	{
		$sql = $this->mkSQL("select city from city where city_id in (select city_id from location where location_id= %N)",$chosenlocationid);
		$result= $this->exec($sql);
		return $result[0]['city'];
	}
	function _mkObj($array) {
		$obj = new Location();
		$obj->setLocation_id($array["location_id"]);
		$obj->setLat($array["lat"]);
		$obj->setLong($array["long"]);
		$obj->setCity_id($array["city_id"]);
		$obj->setLocation($array["location"]);
		return $obj;
	}
	function selectAll($last,$count) {
		$sql = $this->mkSQL("select * from location limit %N, %N",$last, $count);
		return array_map(array($this, '_mkObj'), $this->exec($sql));
	}
	function selectLocation_id($location_id) {
		$sql = $this->mkSQL("select * from location where location_id  = %N",
				$location_id
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function selectLat($lat) {
		$sql = $this->mkSQL("select * from location where lat  = %N",
				$lat
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function selectLong($long) {
		$sql = $this->mkSQL("select * from location where long  = %N",
				$long
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function selectCity_id($city_id) {
		$sql = $this->mkSQL("select * from location where city_id  = %N",
				$city_id
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function selectLocation($location) {
		$sql = $this->mkSQL("select * from location where location  = %Q",
				$location
			);
		$result= $this->exec($sql);
		$this->_rowCount = $this->_conn->numRows();
		return $this->_mkObj($result[0]);
	}
	function insert($location) {
		$sql = $this->mkSQL("insert into location values (%N, %N, %N, %N, %Q)",
				$location->getLocation_id(),$location->getLat(),$location->getLong(),$location->getCity_id(),$location->getLocation()
			);
		$ret = $this->_query($sql,"Insert failed on location table");
	}
	function updateLocation_id($location) {
		$sql = $this->mkSQL("update location
				set lat = %N, long = %N, city_id = %N, location = %Q where location_id = %N ",
				$location->getLat(),$location->getLong(),$location->getCity_id(),$location->getLocation(),$location->get(),$location->getLocation_id()
			);
		$ret = $this->_query($sql,"Update using column location_id failed on location table");
	}
	function updateLat($location) {
		$sql = $this->mkSQL("update location
				set location_id = %N, long = %N, city_id = %N, location = %Q where lat = %N ",
				$location->getLocation_id(),$location->getLong(),$location->getCity_id(),$location->getLocation(),$location->get(),$location->getLat()
			);
		$ret = $this->_query($sql,"Update using column lat failed on location table");
	}
	function updateLong($location) {
		$sql = $this->mkSQL("update location
				set location_id = %N, lat = %N, city_id = %N, location = %Q where long = %N ",
				$location->getLocation_id(),$location->getLat(),$location->getCity_id(),$location->getLocation(),$location->get(),$location->getLong()
			);
		$ret = $this->_query($sql,"Update using column long failed on location table");
	}
	function updateCity_id($location) {
		$sql = $this->mkSQL("update location
				set location_id = %N, lat = %N, long = %N, location = %Q where city_id = %N ",
				$location->getLocation_id(),$location->getLat(),$location->getLong(),$location->getLocation(),$location->get(),$location->getCity_id()
			);
		$ret = $this->_query($sql,"Update using column city_id failed on location table");
	}
	function updateLocation($location) {
		$sql = $this->mkSQL("update location
				set location_id = %N, lat = %N, long = %N, city_id = %N where location = %Q ",
				$location->getLocation_id(),$location->getLat(),$location->getLong(),$location->getCity_id(),$location->get(),$location->getLocation()
			);
		$ret = $this->_query($sql,"Update using column location failed on location table");
	}
	function deleteLocation_id($location) {
		$sql = $this->mkSQL("delete from location where location_id = %Q ",
				$location->getLocation_id()
			);
		$ret = $this->_query($sql,"Delete using column location_id failed on location table");
	}
	function deleteLat($location) {
		$sql = $this->mkSQL("delete from location where lat = %Q ",
				$location->getLat()
			);
		$ret = $this->_query($sql,"Delete using column lat failed on location table");
	}
	function deleteLong($location) {
		$sql = $this->mkSQL("delete from location where long = %Q ",
				$location->getLong()
			);
		$ret = $this->_query($sql,"Delete using column long failed on location table");
	}
	function deleteCity_id($location) {
		$sql = $this->mkSQL("delete from location where city_id = %Q ",
				$location->getCity_id()
			);
		$ret = $this->_query($sql,"Delete using column city_id failed on location table");
	}
	function deleteLocation($location) {
		$sql = $this->mkSQL("delete from location where location = %Q ",
				$location->getLocation()
			);
		$ret = $this->_query($sql,"Delete using column location failed on location table");
	}
}
?>
