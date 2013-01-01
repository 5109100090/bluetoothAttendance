<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Class_model extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function getDetail($classId){
		return $this->db->get_where('class', array('classId' => $classId));
	}
}