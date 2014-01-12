<?php
class Incident extends  CI_Controller
{
	public function index(){

		$this->load->view('polygonView');
	}
	public function reportIncident(){
		$this->load->view('polygonView');
	}
}

?>