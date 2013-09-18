<?php 
class Schedule {
var $schedule_id;
function getSchedule_id() {
return $this->_schedule_id;
 }
function setSchedule_id($schedule_id) {
$this->_schedule_id=$schedule_id;
 }
var $from_date;
function getFrom_date() {
return $this->_from_date;
 }
function setFrom_date($from_date) {
$this->_from_date=$from_date;
 }
var $to_date;
function getTo_date() {
return $this->_to_date;
 }
function setTo_date($to_date) {
$this->_to_date=$to_date;
 }
var $expiry_date;
function getExpiry_date() {
return $this->_expiry_date;
 }
function setExpiry_date($expiry_date) {
$this->_expiry_date=$expiry_date;
 }
var $days_of_week;
function getDays_of_week() {
return $this->_days_of_week;
 }
function setDays_of_week($days_of_week) {
$this->_days_of_week=$days_of_week;
 }
var $from_time;
function getFrom_time() {
return $this->_from_time;
 }
function setFrom_time($from_time) {
$this->_from_time=$from_time;
 }
var $to_time;
function getTo_time() {
return $this->_to_time;
 }
function setTo_time($to_time) {
$this->_to_time=$to_time;
 }
var $location_id;
function getLocation_id() {
return $this->_location_id;
 }
function setLocation_id($location_id) {
$this->_location_id=$location_id;
 }
var $doctor_id;
function getDoctor_id() {
return $this->_doctor_id;
 }
function setDoctor_id($doctor_id) {
$this->_doctor_id=$doctor_id;
 }
var $description;
function getDescription() {
return $this->_description;
 }
function setDescription($description) {
$this->_description=$description;
 }
}
?>