<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library(array('table'));
		$this->load->model(array('attendance_model','user_model','class_model'));
		$this->load->helper(array('url','form'));
	}
	
	public function index(){
		$class = array(1 => 'Jaringan Nirkabel dan Komputasi Bergerak (A)', 2 => 'Topik Khusus Komputasi Berbasis Jaringan (A)');
		$date = array();
		for ($i = 1; $i <= date('t'); $i++){
            if(strlen($i) == 1) $i = '0'.$i;
			$date[$i] = $i;
        }
		$month = array('01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', '05' => 'Mei', '06' => 'Jun', 
            '07' => 'Jul', '08' => 'Agu', '09' => 'Sep', '10 '=> 'Okt', '11' => 'Nov', '12' => 'Des');
		echo form_open('admin').
		anchor('admin', 'home').' '.
		form_dropdown('class', $class).' '.
		form_dropdown('date', $date, date('d')).' '.
		form_dropdown('month', $month, date('m')).' '.
		form_submit('filter', 'filter').' '.
		form_close();
		
		if(isset($_POST['class'])){
			$data = $this->user_model->listAll();
			echo $this->class_model->getDetail($_POST['class'])->row()->className;
			//$data = $this->user_model->filter($_POST['class'], date('Y').'-'.$_POST['month'].'-'.$_POST['date']);
			
			$table = $this->table;
			$tmpl = array ( 'table_open'  => '<table border="1" cellpadding="2" cellspacing="1" class="mytable">' );
			$table->set_template($tmpl); 
			$table->set_heading(array('Name', 'Mac Address', 'Time'));
			foreach($data->result() as $r){
				$d = $this->attendance_model->filter($r->userMac, $_POST['class'], date('Y').'-'.$_POST['month'].'-'.$_POST['date']);
				$table->add_row(array($r->userName, $r->userMac, ($d->num_rows() == 0 ? 'absent' : date('j/M/Y H:i', strtotime($d->row()->attendanceTime)))));
			}
			echo $table->generate(); 
		}
	}
	
	public function stat(){
		
	}
}