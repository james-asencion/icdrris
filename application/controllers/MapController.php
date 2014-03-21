<?php
class MapController extends  CI_Controller
{
	public function __construct(){
        parent :: __construct();
        $this->load->model('MapModel');
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
		$data['requests'] = $this->MapModel->getAllRequests($dateFrom, $dateTo);
		$data['evacuationSites'] = $this->MapModel->getAllEvacuationSites();
		//echo count($data['responseOrganizations']);
		$this->load->view('getAllMapElements',$data);


	}
	public function getLivelihoodMappingElements(){
		//$dateFrom = $_GET['dateFrom'];
		$get = $this->uri->uri_to_assoc();
		//$dateFrom = $get['fromYear']."-".$get['fromMonth']."-".$get['fromDay'];
		//$dateTo = $get['toYear']."-".$get['toMonth']."-".$get['toDay'];
		$dateFrom = date('Y-m-d', strtotime($get['dateFrom']));
		$dateTo = date('Y-m-d', strtotime($get['dateTo']));
		//echo $dateFrom."   ".$dateTo;

		$data['elements']  = $this->MapModel->getMapElements1($dateFrom, $dateTo);
		$data['organizations'] = $this->MapModel->getAllLivelihoodOrganizations();
		$data['barangayListItem'] = $this->MapModel->getAllBarangays();
		//echo count($data['responseOrganizations']);
		$this->load->view('getAllLivelihoodMappingElements',$data);
	}
	public function getRecoveryMappingElements(){

		$data['barangayListItem'] = $this->MapModel->getAllBarangays();
		//echo count($data['responseOrganizations']);
		$this->load->view('getAllRecoveryMappingElements',$data);
	}
}

?>