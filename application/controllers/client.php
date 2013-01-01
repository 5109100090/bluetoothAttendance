<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Client extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(array('attendance_model'));
	}
	
	public function index(){
		if(isset($_POST['bluetoothData'])){
			$this->attendance_model->tes(array('tes'=>'oke'));
			$data = json_decode($_POST['bluetoothData']);
			$values = array();
			$time = date('Y-m-d H:i:s');
			foreach($data as $r){
				array_push($values, array('attendanceId' => '', 'userMac' => $r->addr, 'classId' => $r->classId, 'attendanceTime' => $time));
			}
			$this->attendance_model->tes(array('tes'=>$values));
			$this->attendance_model->insert($values);
		}else{
			echo 'what?';
		}
	}
}