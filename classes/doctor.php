<?php 
class Doctor {
var $doctor_id;
function getDoctor_id() {
return $this->_doctor_id;
 }
function setDoctor_id($doctor_id) {
$this->_doctor_id=$doctor_id;
 }
var $donor_id;
function getDonor_id() {
return $this->_donor_id;
 }
function setDonor_id($donor_id) {
$this->_donor_id=$donor_id;
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
var $age;
function getAge() {
return $this->_age;
 }
function setAge($age) {
$this->_age=$age;
 }
var $city_id;
function getCity_id() {
return $this->_city_id;
 }
function setCity_id($city_id) {
$this->_city_id=$city_id;
 }
var $speciality_Sub_Speciality_link_id;
function getSpeciality_Sub_Speciality_link_id() {
return $this->_speciality_Sub_Speciality_link_id;
 }
function setSpeciality_Sub_Speciality_link_id($speciality_Sub_Speciality_link_id) {
$this->_speciality_Sub_Speciality_link_id=$speciality_Sub_Speciality_link_id;
 }
}
?>