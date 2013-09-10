<?php 
class Doctor {
var $doctor_id;
function getDoctor_id() {
return $this->_doctor_id;
 }
function setDoctor_id($doctor_id) {
$this->_doctor_id=$doctor_id;
 }
var $first_name;
function getFirst_name() {
return $this->_first_name;
 }
function setFirst_name($first_name) {
$this->_first_name=$first_name;
 }
var $last_name;
function getLast_name() {
return $this->_last_name;
 }
function setLast_name($last_name) {
$this->_last_name=$last_name;
 }
var $mobile;
function getMobile() {
return $this->_mobile;
 }
function setMobile($mobile) {
$this->_mobile=$mobile;
 }
var $speciality;
function getSpeciality() {
return $this->_speciality;
 }
function setSpeciality($speciality) {
$this->_speciality=$speciality;
 }
var $gender;
function getGender() {
return $this->_gender;
 }
function setGender($gender) {
$this->_gender=$gender;
 }
var $address;
function getAddress() {
return $this->_address;
 }
function setAddress($address) {
$this->_address=$address;
 }
var $city;
function getCity() {
return $this->_city;
 }
function setCity($city) {
$this->_city=$city;
 }
var $state;
function getState() {
return $this->_state;
 }
function setState($state) {
$this->_state=$state;
 }
var $country;
function getCountry() {
return $this->_country;
 }
function setCountry($country) {
$this->_country=$country;
 }
var $sub_speciality_id;
function getSub_speciality_id() {
return $this->_sub_speciality_id;
 }
function setSub_speciality_id($sub_speciality_id) {
$this->_sub_speciality_id=$sub_speciality_id;
 }
var $picture;
function getPicture() {
return $this->_picture;
 }
function setPicture($picture) {
$this->_picture=$picture;
 }
var $current_hospital;
function getCurrent_hospital() {
return $this->_current_hospital;
 }
function setCurrent_hospital($current_hospital) {
$this->_current_hospital=$current_hospital;
 }
var $experience;
function getExperience() {
return $this->_experience;
 }
function setExperience($experience) {
$this->_experience=$experience;
 }
var $qualification_id;
function getQualification_id() {
return $this->_qualification_id;
 }
function setQualification_id($qualification_id) {
$this->_qualification_id=$qualification_id;
 }
var $date_of_birth;
function getDate_of_birth() {
return $this->_date_of_birth;
 }
function setDate_of_birth($date_of_birth) {
$this->_date_of_birth=$date_of_birth;
 }
var $age;
function getAge() {
return $this->_age;
 }
function setAge($age) {
$this->_age=$age;
 }
}
?>