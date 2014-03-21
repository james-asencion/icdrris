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

	public function reportIncidentPolygon(){
		$this->load->view('includes/mapReportingHeader');
		$this->load->view('polygonView');
		$this->load->view('includes/footer');
	}
	public function reportIncidentMarker(){
		$this->load->view('includes/mapReportingHeader');
		$this->load->view('markerView');
		$this->load->view('includes/footer');
	}
	function getIncidentCount(){
		$count  = $this->IncidentModel->countIncidents();
		echo $count;
	}
	function getNewIncident(){
		$incident = $this->IncidentModel->getNewIncident();
		echo $incident->incident_location_id;
	}
	function savePolygon(){
		$incident_data = array(
						'incident_description' => $this->input->post('description'),
						'disaster_type' => $this->input->post('disaster_type'),
						'incident_date' => $this->input->post('date')
						);

		$incident_report_id = $this->IncidentModel->addIncident($incident_data);
		$incident_location_data = array(
									$incident_report_id, 
									'1',
									'3',
									$this->input->post('polygon'),
									$this->input->post('deaths'),
									$this->input->post('injured'),
									$this->input->post('missing'),
									$this->input->post('families_affected'),
									$this->input->post('houses_destroyed'),
									$this->input->post('damage_cost'),
									$this->input->post('source')
								);

		$result = $this->IncidentModel->saveIncidentPolygon($incident_location_data);
		if($result){
			echo "success";
		}else{
			echo "failed";
		}
	}
	function saveMarker(){
		$incident_data = array(
						'incident_description' => $this->input->post('description'),
						'disaster_type' => $this->input->post('disaster_type'),
						'incident_date' => $this->input->post('date')
						);

		$incident_report_id = $this->IncidentModel->addIncident($incident_data);
		$incident_location_data = array(
									'incident_report_id' => $incident_report_id, 
									'location_id' => '1',
									'incident_intensity' =>'3',
									'lat'=> $this->input->post('lat'),
									'lng'=> $this->input->post('lng'),
									'death_toll' => $this->input->post('deaths'),
									'no_of_injuries' => $this->input->post('injured'),
									'no_of_people_missing' => $this->input->post('missing'),
									'no_of_families_affected' => $this->input->post('families_affected'),
									'no_of_houses_destroyed' => $this->input->post('houses_destroyed'),
									'estimated_damage_cost' => $this->input->post('damage_cost'),
									'incident_info_source' => $this->input->post('source')
								);

		$result = $this->IncidentModel->saveIncidentMarker($incident_location_data);
		if($result){
			echo "success";
		}else{
			echo "failed";
		}
	}
	public function incidentTitle(){
			$incident_report_id = $this->input->post("incident_report_id");
			//$incident_location_id = $this->input->post("incident_location_id");
            $incident = $this->IncidentModel->getIncidentTitle($incident_report_id);
            echo $incident->incident_description;

    }

        public function incidentDetails(){
            $incident_location_id = $this->input->post("incident_location_id");
            $details = $this->IncidentModel->getIncidentDetails($incident_location_id);

				echo '<script type="text/javascript">
                     	$(document).ready(function(){
                        	$("#span-approve-li").html('.$details->flag_true_rating.');
                        	$("#span-disapprove-li").html('.$details->flag_false_rating.');
                        	$(".editinfo-li").attr("data-incidentdesc", "'.$details->incident_description.'");
                        	$(".editinfo-li").attr("data-incidentdate", "'.$details->incident_date.'");
                        	$(".editinfo-li").attr("data-disastertype", "'.$details->disaster_type.'");
                        	
							$("#incident-stat").attr("data-deaths", '.$details->death_toll.');
							$("#incident-stat").attr("data-familiesaffected", '.$details->no_of_families_affected.');
							$("#incident-stat").attr("data-peoplemissing", '.$details->no_of_people_missing.');
							$("#incident-stat").attr("data-housesdestroyed", '.$details->no_of_houses_destroyed.');
							$("#incident-stat").attr("data-injured", '.$details->no_of_injuries.');
							$("#incident-stat").attr("data-damagecost", '.$details->estimated_damage_cost.');
							$("#incident-stat").attr("data-infosource", "'.$details->incident_info_source.'");
                        });

                        $(document).ready(function(){
                            if(typeof(Storage)!=="undefined"){

                            //get set var in localStorage
                            var rateClick= localStorage.getItem("i'.$incident_location_id.'");
                            console.log("incident rate: "+ rateClick+ " i'.$incident_location_id.'.");
                            	if(rateClick == null){
                                	$("#approve-li'.$incident_location_id.'").css("background-color", "");
                                	$("#disapprove-li'.$incident_location_id.'").css("background-color", "");
                                	console.log("incident rate color: none since null");
                            	}                                                                  

                            	if (rateClick == "rateFalse"){
                        	   		//if disapproved, retain thumbsdown color
                                	$("#disapprove-li'.$incident_location_id.'").css("background-color", "red");
                                	$("#approve-li'.$incident_location_id.'").css("background-color", "");
                                	console.log("incident Thumbs Down color red");
                            	}
                            	if(rateClick == "rateTrue"){
                                	//if approved,  retain thumbsup color
                                	$("#approve-li'.$incident_location_id.'").css("background-color", "green");
                                	$("#disapprove-li'.$incident_location_id.'").css("background-color", "");
                                	console.log("incident Thumbs up color green");
                            	}
                                                           
                        	}
                            else{
                                alert("Sorry, your browser does not support web storage...");
                            }
                        });  
                       	</script>
                                    
                        <div class="details" style="margin-left: 15px; margin-top: 10px">
							<div class="row-fluid">
								<div class="span12">
									<div id="fieldlabel" class="span4">Disaster Name:  </div>
									<div id="fieldvalue" class="span8"> '.$details->incident_description.'</div>
									</div>
							</div>
							<div class="row-fluid">
									<div class="span12">
										<div id="fieldlabel" class="span4">Type:  </div>
										<div id="fieldvalue" class="span8">  '.$details->disaster_type.'</div>
									</div>
							</div>
							<div class="row-fluid">
									<div class="span12">
										<div id="fieldlabel" class="span4">Date Occurred:  </div>
										<div id="fieldvalue" class="span8"> '.$details->incident_date.'</div>
									</div>
							</div>
							
							<div class="row-fluid">
									<div class="span12">
										<div id="fieldlabel" class="span4">Location:  </div>
										<div id="fieldvalue" class="span8"> '.$details->location_address.', '.$details->barangay.'</div>
									</div>
							</div>

						</div>

						<div class="navbar" style="height:30px;">
							 <div class="navbar-inner" style="height: 30px; min-height: 25px; background-image: linear-gradient(to bottom,#051849,#332F2F);">
								<p class="brand" href="#" style="font-size: 14px;"> <i class="icon-white icon-signal" style="margin-top:4px"> </i> STATISTICS</p>
								';
								if($this->session->userdata('user_type') == 'cdrrmo' || $this->session->userdata('user_type') == 'bdrrmo'){
						echo	'<div class="incident-stat"><p class="brand" style="font-size: 14px;"> <a href="#"  id="incident-stat" data-incidentid= "'.$incident_location_id.'" data-incidentreportid="'.$details->incident_report_id.'" class="btn-link" role="button" data-toggle="modal" onclick="modifyIncidentStat(this)">[Update]</a> </p></div>';
							}
						echo '</div>
						</div>

						<div class="details">
							<div class="row-fluid">
								<div class="row-fluid">
									<div class="span6">
										<div id="fieldlabel" class="span7">Deaths: </div>
										<div class="span1">'.$details->death_toll.'</div>
									</div>

									<div class="span6">
										<div id="fieldlabel" class="span7"> Families Affected: </div>
										<div class="span1">'.$details->no_of_families_affected.'</div>
									</div>
								</div>
								<div class="row-fluid">
									<div class="span6">
										<div id="fieldlabel" class="span7">People Missing: </div>
										<div class="span1">'.$details->no_of_people_missing.'</div>
									</div>
									<div class="span6">
										<div id="fieldlabel" class="span7"> Houses Destroyed: </div>
										<div class="span1">'.$details->no_of_houses_destroyed.'</div>
									</div>
								</div>
								<div class="row-fluid">
									<div class="span6">
										<div id="fieldlabel" class="span7"> Injured: </div>
										<div class="span1">'.$details->no_of_injuries.'</div>
									</div>
									<div class="span6">
										<div id="fieldlabel" class="span7"> Damage Cost (PHP): </div>
										<div class="span5">  '.$details->estimated_damage_cost.'</div>
									</div>
								</div>
								<div class="row-fluid">
									<div class="span12">
										<div id="fieldlabel" class="span5">Information Source: </div>
										<div class="span4"> <i> '.$details->incident_info_source.'</i></div>
									</div>
								</div>
							</div>
						</div>';
			
        }
	
        function rateUpOrDown(){
		$incident_location_id = $this->input->post('incident_location_id');
		$upOrDown = $this->input->post('upOrDown');
		$actionType = $this->input->post('actionType');
		
		$status = "false";
		$updateRecords = 0;
		
		$updateRecords= $this->IncidentModel->updateRate($incident_location_id, $upOrDown, $actionType);
	
		if($updateRecords > 0){
			$status = "true";
		}
		echo $status;
	}
        
		function confirmIncident(){
		$incident_location_id = $this->input->post("incident_location_id");
		$userid = $this->session->userdata('user_id');
		$query_results = $this->IncidentModel->confirmThisIncident($incident_location_id, $userid);
		if($query_results){
			echo "success";
		}
		else{
			echo $query_results;
		}
	}
	
        function getDeploymentDetails($id){
        	$deployment = $this->IncidentModel->getDeploymentDetails($id);

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
						</div>';
        }

        function updateIncident(){
			$incident_location_id = $this->input->post("incident_location_id"); 
			$incident_report_id = $this->input->post("incident_report_id");
			$incident_description = $this->input->post("incident_description");
			$date_happened = $this->input->post("date_happened");
			$disaster_type = $this->input->post("disaster_type");
        
            $query_results = $this->IncidentModel->updateIncident($incident_location_id, $incident_report_id, $incident_description, $date_happened, $disaster_type);
			if($query_results){
				echo "success";
			}
			else{
				echo $query_results;
			}
		}
		
		 function updateIncidentStatistics(){
			$incident_location_id = $this->input->post("incident_location_id"); 
			$death_toll = $this->input->post("death_toll");
			$no_of_injuries = $this->input->post("no_of_injuries");
			$no_of_people_missing = $this->input->post("no_of_people_missing");
			$no_of_families_affected = $this->input->post("no_of_families_affected");
			$no_of_houses_destroyed = $this->input->post("no_of_houses_destroyed");
			$estimated_damage_cost = $this->input->post("estimated_damage_cost");
			$incident_info_source = $this->input->post("incident_info_source");
        
            $query_results = $this->IncidentModel->updateIncidentStatistics($incident_location_id, $death_toll, $no_of_injuries, $no_of_people_missing, $no_of_families_affected, $no_of_houses_destroyed, $estimated_damage_cost, $incident_info_source);
			if($query_results){
				echo "success";
			}
			else{
				echo $query_results;
			}
		}

        function deleteIncident(){
            $incident_location_id = $this->input->post("incident_location_id");
            $query_results = $this->IncidentModel->deleteIncident($incident_location_id);
            if($query_results){
                echo 'success';
            }
            else{
                echo $query_results;
            }
        }

}
?>
