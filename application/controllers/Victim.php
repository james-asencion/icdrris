<?php

/* 
 * This project is licensed to team-dasig 2013
 * James R. Asencion  * 
 * Czareannah Leigh S. Villanca  * 
 * Femarie C. Manga  * 
 */

class Victim extends CI_Controller
{
	public function __construct() {
		parent:: __construct();
		$this->load->model("VictimModel");
	}

    function index(){
        $data = array();
        $this->load->view('forms/victimReport');
    }
	
    function viewAllVictims(){
		$id = $this->input->post("id");
        $query_results = $this->VictimModel->viewAllVictims($id); 

                    if($query_results == 'false'){
                            echo "error";
                    }
                    else{
                            if($query_results-> num_rows() == 0){
                            echo '
								<center><font style="color: red;"><b>No results found.</b></font></center>';
                            }else{


                            echo '
				
								<table id="victimTable" class="table table-condensed " style="color:#cccccc;">
									<caption><h4>List of Victims Reported</h4><br></caption>
									<thead>
									  <tr>
											<th>No.</th>
											<th>Name</th>
											<th>Status</th>
											<th>Actions</th>
									  </tr>
									</thead>
									<tbody>';
										$i=0;
										foreach($query_results->result() as $row_victims){
												$incident_report_id = $row_victims->incident_report_id;
												$victim_id = $row_victims->victim_id;
												$first_name = $row_victims->first_name;
												$middle_name = $row_victims->middle_name;
												$last_name = $row_victims->last_name;
												$address = $row_victims->address;
												$victim_status = $row_victims->victim_status;
												$flag_confirmed = $row_victims->flag_confirmed;
												$report_rating_false = $row_victims->report_rating_false;
												$report_rating_true = $row_victims->report_rating_true;
												
												$ratedTrue= 1;
												
												$ratedFalse = 0;
								
                            echo '   
								<script type="text/javascript">
									console.log("Inside script for localStorage check rateVictim to change icon color");
									$(document).ready(function(){
									console.log("Inside document ready function for localstorage check rateVictim to change icon color")
									if(typeof(Storage)!=="undefined"){
									
										//get set var in localStorage
										var rateClick= localStorage.getItem("'.$incident_report_id.''.$victim_id.'");
										for(var i = 0; i < localStorage.length; i++) {  // Length gives the # of pairs
												var name = localStorage.key(i);             // Get the name of pair i
												var val = localStorage.getItem(name);             // Get the val of pair name
												console.log("localstorage names: "+ name + " value: "+ val);    // Get the value of that pair
											}
										if (rateClick == "rateFalse"){
											//if disapproved, retain thumbsdown color
											$("#iThumbsDown'.$incident_report_id.''.$victim_id.'").css("background-color", "red");
											console.log("Thumbs Down color red");
										}
									  if(rateClick == "rateTrue"){
											//if approved,  retain thumbsup color
											$("#iThumbsUp'.$incident_report_id.''.$victim_id.'").css("background-color", "green");
											console.log("Thumbs up color green");
									  }
					
									}
									else{
									  alert("Sorry, your browser does not support web storage...");
									}
								});
								</script>
				
								<tr>
									<td>'.(++$i).'</td>
									<td>'.$first_name.' '.$middle_name.' '.$last_name.'</td>
									<td>'.$victim_status.'</td>
									<td>
											<a href="#" class="rateVictim" data-upordown="'.$ratedTrue.'" data-incidentid="'.$incident_report_id.'" data-victimid="'.$victim_id.'"><i id="iThumbsUp'.$incident_report_id.''.$victim_id.'" class="icon-white icon-thumbs-up" title="True Report" onclick= "rateVictim('.$incident_report_id.','.$victim_id.','.$ratedTrue.')"> </i></a> '.$report_rating_true.' <span class="divider"> | </span>
										
											<a href="#" class="rateVictim" data-upordown="'.$ratedFalse.'" data-incidentid="'.$incident_report_id.'" data-victimid="'.$victim_id.'"><i id="iThumbsDown'.$incident_report_id.''.$victim_id.'" class="icon-white icon-thumbs-down" title="False Report" onclick= "rateVictim('.$incident_report_id.','.$victim_id.', '.$ratedFalse.')"> </i> </a> '.$report_rating_false.' <span class="divider"> | </span>
										
											<a href="#" class="details-victim" data-incidentid= "'.$incident_report_id.'" data-victimid="'.$victim_id.'" data-firstname= "'.$first_name.'" data-middlename="'.$middle_name.'" data-lastname="'.$last_name.'" data-address="'.$address.'" data-victimstatus="'.$victim_status.'" data-flagconfirmed="'.$flag_confirmed.'" data-ratingtrue="'.$report_rating_true.'" data-ratingfalse="'.$report_rating_false.'"><i class="icon-white icon-info-sign" title="Show Details" onclick="detailsVictim(this);"> </i> </a><span class="divider"> | </span>
											';
                                                                        if(($this->session->userdata('user_type') == 'cswd') || ($this->session->userdata('user_type') == 'cdrrmo' || $this->session->userdata('user_type') == 'bdrrmo') ){
                                                                                  echo '<a href="#" class="edit-victim" data-incidentid="'.$incident_report_id.'" data-victimid="'.$victim_id.'" data-firstname= "'.$first_name.'" data-middlename="'.$middle_name.'" data-lastname="'.$last_name.'" data-addressvictim="'.$address.'" data-victimstatus="'.$victim_status.'"><i class="icon-white icon-edit" title="Update Victim" onclick="editVictim(this);"> </i> </a><span class="divider"> | </span>';
											if($flag_confirmed == 0){
												echo '<a href="#" class="delete-victim"  data-incidentid="'.$incident_report_id.'" data-victimid="'.$victim_id.'" data-victimname="'.$first_name.' '.$middle_name.' '.$last_name.'"><i class="icon-white icon-trash" title="Delete Report" onclick="deleteVictim(this);"> </i> </a><span class="divider"> | </span>';
											}
											if($flag_confirmed == 0){
												echo '<a href="#" class="confirmtrue-victim"  data-incidentid="'.$incident_report_id.'" data-victimid="'.$victim_id.'" data-victimname="'.$first_name.' '.$middle_name.' '.$last_name.'"><i class="icon-white icon-ok" title="Confirm Report" onclick="confirmVictim('.$incident_report_id.', '.$victim_id.');"> </i> </a><span class="divider"> | </span>';
											}
                                                                        }
							echo '</td>
								  </tr>';
                            }
                            echo ' 		</tbody>
									</table>
                    ';
                            }
                    }
    }
    
    /** FOR REPORT VICTIM
     *      FUNCTION
     */
    
    function reportVictim(){
        $this->load->view('forms/victimReport');
    }
	
	function done($data){
        $this->load->view('forms/victimReport', $data);
    }
  
    function validate(){
        
        $this->form_validation->set_rules('reportNo','Incident No','trim|required');
        $this->form_validation->set_rules('first_name','First Name','trim|required|min_length[1]|max_length[40]');
        $this->form_validation->set_rules('middle_name','Middle Name','trim|required|min_length[1]|max_length[40]');
        $this->form_validation->set_rules('last_name','Last Name','trim|required|min_length[1]|max_length[40]');
        $this->form_validation->set_rules('address','Address','trim|required|min_length[1]|max_length[40]');
        $this->form_validation->set_rules('victim_status','Victim Status','trim|required|max_length[40]');
		
        $reportNo = $this->input->post("reportNo");
        $fname = $this->input->post("first_name");
        $mname = $this->input->post("middle_name");
        $lname = $this->input->post("last_name");
        $address = $this->input->post("address");
        $victim_status = $this->input->post("victim_status");
       
        if($this->form_validation-> run()){

            //$this->load->model('Victim');

            if($this->VictimModel->validate($fname, $mname, $lname, $reportNo)){
                
                $query=$this->VictimModel->reportVictim($fname, $mname, $lname, $address, $victim_status, $reportNo);
                if($query){
                   //redirect('Victim/success');
				   echo "success";
                }
                else{   //$query == false
                    //$data['err_message'] = 'Something is wrong with the data input.';
                  echo "Query failed.";
                }
            }
            else{   // error $this->$victimModel->validate
                // $data['err_message']= 'The victim is already reported.';
               echo "The victim is already reported.";
            }
        }
        else{   
				echo " validation error";
        }
         
    }   //end of validate()
    
	
	function confirmVictim(){
		$incident_report_id = $this->input->post('incident_report_id');
		$victim_id= $this->input->post('victim_id');
		$userid= $this->session->userdata('user_id');
		
		$query = $this->VictimModel->confirmThisVictim($incident_report_id, $victim_id, $userid);
		if($query){
			echo "success";
		}else{
			echo $query;
		}

	}
	
	/**
	 *		UPDATE VICTIM FUNCTION
	 */ 
	 
	function updateVictim(){

        $incident_report_id= $this->input->post('incidentid');
        $victim_id= $this->input->post('victimid');
        $first_name= $this->input->post('firstname');
        $middle_name= $this->input->post('middlename');
        $last_name= $this->input->post('lastname');
        $address= $this->input->post('address');
        $victim_status= $this->input->post('victimstatus');
        
        /**
        $this->form_validation->set_rules('first_name','First Name','trim|required|min_length[1]|max_length[40]');
        $this->form_validation->set_rules('middle_name','Middle Name','trim|required|min_length[1]|max_length[40]');
        $this->form_validation->set_rules('last_name','Last Name','trim|required|min_length[1]|max_length[40]');
        $this->form_validation->set_rules('address','Address','trim|required|min_length[1]|max_length[40]');
        $this->form_validation->set_rules('victim_status','Victim Status','trim|required|max_length[40]');
		*/	
        //if($this->form_validation-> run()){

            if($this->VictimModel->validateOnUpdate($first_name, $middle_name, $last_name, $incident_report_id, $victim_id)){
                
                $query=$this->VictimModel->updateVictim($incident_report_id, $victim_id, $first_name, $middle_name, $last_name, $address, $victim_status);
                if($query){
                   echo 'success';
                }
                else{   //$query == false
					echo $query.'.\n';
                    echo 'Something is wrong with the data input.';
                }
            }
            else{   // error $this->$victimModel->validate
                echo 'The victim is already reported.';
            }
     
	}
	
    /** 
     *     DELETE VICTIM FUNCTION
     */
    function deleteVictim(){
        $incident_report_id= $this->input->post('incident_report_id');
        $victim_id= $this->input->post('victim_id');
        $query_result = $this->VictimModel->deleteVictim($incident_report_id, $victim_id);
        //echo $query_result;
		if($query_result == 'success'){
            echo 'success';
        }
        else{
            echo $query_result;
        }
    }
	
	function rateUpOrDown(){
		$incident_report_id = $this->input->post('incident_report_id');
		$victim_id = $this->input->post('victim_id');
		$upOrDown = $this->input->post('upOrDown');
		$actionType = $this->input->post('actionType');
		
		$status = "false";
		$updateRecords = 0;
		
		$updateRecords= $this->VictimModel->updateRate($incident_report_id, $victim_id, $upOrDown, $actionType);
	
		if($updateRecords > 0){
			$status = "true";
		}
		echo $status;
	}
}

