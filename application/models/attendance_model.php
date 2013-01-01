<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Attendance_model extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function insert($data){
		$this->db->insert_batch('attendance', $data);
	}
	
	public function tes($data){
		$this->db->insert('tes', $data);
	}
	
	public function filter($user, $class, $time){
		$db = $this->db;
		$db->select('*');
		$db->from('attendance');
		$db->where('userMac', $user);
		$db->where('classId', $class);
		$db->like('attendanceTime', $time); 
		return $db->get();
	}
}