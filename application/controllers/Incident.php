<?php
class Incident extends  CI_Controller
{
	public function index(){

		$this->load->view('polygonView');
	}
	public function reportIncidentPolygon(){
		$this->load->view('polygonView');
	}
	public function reportIncidentMarker(){
		$this->load->view('markerView');
	}
}

?>