<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function listAll(){
		return $this->db->get('user');
	}
	
	public function filter($class, $time){
		return $this->db->query("
			SELECT user.userMac, userName, user.classId, attendanceTime
			FROM `user`
			LEFT JOIN attendance
			ON `user`.userMac = attendance.userMac
			WHERE `user`.classId = $class
			AND (attendanceTime LIKE '$time%' OR attendanceTime is NULL) 
			");
	}
}