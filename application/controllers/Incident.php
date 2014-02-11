<?php
class Incident extends  CI_Controller
{
	public function __construct() {
		parent:: __construct();
		$this->load->model("IncidentModel");
	}
        
	public function index(){
		 //temporary: should display list of incidents
		 $this->load->view('includes/header');
		 $this->load->view('polyHome');
		 $this->load->view('includes/footer');
	}
       
	public function reportIncident(){
		$this->load->view('polygonView');
	}
	public function reportIncidentMarker(){
		$this->load->view('markerView');
	}
	 public function incidentTitle(){
			$id = $this->input->post("id");
            $query_results = $this->IncidentModel->getIncidentDetails($id); 
            
			if($query_results == 'false'){
				echo "error";
			}
			else{
				foreach($query_results->result() as $row_incident){
					$incident_report_id = $row_incident->incident_report_id;
					$incident_description = $row_incident->incident_description;
				}
				echo ' <ul class="nav nav-tabs" style="margin-bottom:10px;">
							<li class="span8" style="color:darkorange">
								<h4>'.$incident_description.'</h4>
							</li>
							<li class="active"><a href="#tab1" data-incidentid="'.$incident_report_id.'" data-toggle="tab"> Details </a></li>
							<li onclick="victimsTab()"><a href="#tab2" id="victims-tab" class="victims-tab" data-incidentid="'.$incident_report_id.'" data-toggle="tab"> Victims </a></li>
                      </ul>';
			}
        }
		
        public function incidentDetails(){
			$id = $this->input->post("id");
            $query_results = $this->IncidentModel->getIncidentDetails($id); 
            
			if($query_results == 'false'){
				echo "error";
			}
			else{
				foreach($query_results->result() as $row_incident){
					$incident_report_id = $row_incident->incident_report_id;
					$incident_description = $row_incident->incident_description;
					$disaster_type = $row_incident->disaster_type;
					$incident_date = $row_incident->incident_date;
					$death_toll = $row_incident->death_toll;
					$no_of_injuries = $row_incident->no_of_injuries;
					$no_of_people_missing = $row_incident->no_of_people_missing;
					$no_of_families_affected = $row_incident->no_of_families_affected;
					$no_of_houses_destroyed = $row_incident->no_of_houses_destroyed;
					$estimated_damage_cost = $row_incident->estimated_damage_cost;
					$incident_info_source = $row_incident->incident_info_source;
					$lat = $row_incident->lat;
					$lng = $row_incident->lng;
					$reportPolygon = $row_incident->reportPolygon;
				}
				echo '<div style="margin-left: 15px; margin-top: 10px">
							<p> Disaster Name: '.$incident_description.'</p>
							<p> Type: '.$disaster_type.'</p>
							<p> Date Occurred: '.$incident_date.'</p>
						</div>
							  
						<div class="navbar" style="height:30px;">
							 <div class="navbar-inner" style="height: 30px; min-height: 25px; background-image: linear-gradient(to bottom,#051849,#332F2F);">
								<p class="brand" href="#" style="font-size: 14px;"> <i class="icon-white icon-signal" style="margin-top:4px"> </i> STATISTICS</p>              
							 </div>
						</div>

						<div style="margin-left: 15px;">
							 <p> Deaths: '.$death_toll.'</p>
							 <p> People Missing: '.$no_of_people_missing.'</p>
							 <p> Injured: '.$no_of_injuries.'</p>
							 <p> Families Affected: '.$no_of_families_affected.'</p>
							 <p> Houses Destroyed: '.$no_of_houses_destroyed.'</p>
							 <p> Damage Cost: '.$estimated_damage_cost.'</p>
							 <p> Information Source: '.$incident_info_source.'</p>
						</div>';
			}
        }
        
        public function doEdit($id){
           
            
            $this->load->view();
        }
        
        public function doDelete($id){
            $this->load->view();
        }
       
}

?>