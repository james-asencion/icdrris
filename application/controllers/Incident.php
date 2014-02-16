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
				echo $incident_description;
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
				echo '<div class="details" style="margin-left: 15px; margin-top: 10px">
							<div class="row-fluid">
									<div class="span12">
										<div id="fieldlabel" class="span4">Disaster Name:  </div>
										<div id="fieldvalue" class="span8"> '.$incident_description.'</div>
									</div>
							</div>
							<div class="row-fluid">
									<div class="span12">
										<div id="fieldlabel" class="span4">Type:  </div>
										<div id="fieldvalue" class="span8">  '.$disaster_type.'</div>
									</div>
							</div>
							<div class="row-fluid">
									<div class="span12">
										<div id="fieldlabel" class="span4">Date Occurred:  </div>
										<div id="fieldvalue" class="span8"> '.$incident_date.'</div>
									</div>
							</div>
							
						</div>
							  
						<div class="navbar" style="height:30px;">
							 <div class="navbar-inner" style="height: 30px; min-height: 25px; background-image: linear-gradient(to bottom,#051849,#332F2F);">
								<p class="brand" href="#" style="font-size: 14px;"> <i class="icon-white icon-signal" style="margin-top:4px"> </i> STATISTICS</p>              
							 </div>
						</div>

						<div class="details">
							<div class="row-fluid">
								<div class="row-fluid">
									<div class="span6">
										<div id="fieldlabel" class="span7">Deaths: </div>
										<div class="span1">'.$death_toll.'</div>
									</div>
								
									<div class="span6">
										<div id="fieldlabel" class="span7"> Families Affected: </div>
										<div class="span1">'.$no_of_families_affected.'</div>
									</div>
								</div>
								<div class="row-fluid">
									<div class="span6">
										<div id="fieldlabel" class="span7">People Missing: </div>
										<div class="span1">'.$no_of_people_missing.'</div>
									</div>
									<div class="span6">
										<div id="fieldlabel" class="span7"> Houses Destroyed: </div>
										<div class="span1">'.$no_of_houses_destroyed.'</div>
									</div>
								</div>
								<div class="row-fluid">
									<div class="span6">
										<div id="fieldlabel" class="span7"> Injured: </div>
										<div class="span1">'.$no_of_injuries.'</div>
									</div>
									<div class="span6">
										<div id="fieldlabel" class="span7"> Damage Cost: </div>
										<div class="span5"> PHP '.$estimated_damage_cost.'</div>
									</div>
								</div>        
								<div class="row-fluid">
									<div class="span12">
										<div id="fieldlabel" class="span5">Information Source: </div>
										<div class="span4"> <i> '.$incident_info_source.'</i></div>
									</div>
								</div>
							</div>
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