<?php
	
class PolygonController extends CI_Controller
{
	function index(){
		$this->load->library('googlemaps');
		//$this->load->

		$config['center'] = '8.228021,124.245242';
		$config['zoom'] = '12';
		$this->googlemaps->initialize($config);

		$polygon = array();
		$points = array();
		array_push($points,'8.266025,124.251165');
		array_push($points,'8.242666,124.255714');
		array_push($points,'8.250226,124.270477');
		array_push($points,'8.255662,124.25374');
		array_push($points,'8.266025,124.25108');

		$polygon['points'] = $points;
		$polygon['strokeColor'] = '#000099';
		$polygon['fillColor'] = '#000099';
		
		$this->googlemaps->add_polygon($polygon);

		$data['map'] = $this->googlemaps->create_map();

		$this->load->view('test_map', $data);
	}

}
?>