<?php
class MapController extends  CI_Controller
{
	public function __construct(){
        parent :: __construct();
        $this->load->model('MapModel');
    }

	public function viewPolygonReports(){
		$this->load->view('polyHome');
	}

	public function viewMarkerReports(){
		$this->load->view('markerHome');
	}

	public function getAllMapElements(){
		//$dateFrom = $_GET['dateFrom'];
		$get = $this->uri->uri_to_assoc();
		//$dateFrom = $get['fromYear']."-".$get['fromMonth']."-".$get['fromDay'];
		//$dateTo = $get['toYear']."-".$get['toMonth']."-".$get['toDay'];
		$dateFrom = date('Y-m-d', strtotime($get['dateFrom']));
		$dateTo = date('Y-m-d', strtotime($get['dateTo']));
		//echo $dateFrom."   ".$dateTo;

		$data['elements']  = $this->MapModel->getMapElements1($dateFrom, $dateTo);
		$data['respondents'] = $this->MapModel->getAllDeployedResponseOrganizations($dateFrom, $dateTo);
		//echo count($data['responseOrganizations']);
		$this->load->view('getAllMapElements',$data);


	}
}

?>