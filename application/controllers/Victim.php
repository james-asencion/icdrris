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


                            echo '<table id="victimTable" class="table table-condensed " style="color:#cccccc;">
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

                            echo '    <tr>
										<td>'.(++$i).'</td>
										<td>'.$first_name.' '.$middle_name.' '.$last_name.'</td>
										<td>'.$victim_status.'</td>
										<td>
												<a href="#" class="approved-victim" data-incidentid="'.$incident_report_id.'" data-victimid="'.$victim_id.'"><i class="icon-white icon-thumbs-up" title="Confirm Report"> </i></a> '.$report_rating_true.' <span class="divider"> | </span>
												<a href="#" class="disapproved-victim" data-incidentid="'.$incident_report_id.'" data-victimid="'.$victim_id.'"><i class="icon-white icon-thumbs-down" title="False Report" > </i> </a> '.$report_rating_false.' <span class="divider"> | </span>
												<a href="#" class="details-victim" data-toggle="popover" title="" data-content="Hello there.\n How are you?" data-original-title="A Title"><i class="icon-white icon-info-sign" title="Show Details"> </i> </a><span class="divider"> | </span>
												<a href="#" class="edit-victim" data-incidentid="'.$incident_report_id.'" data-victimid="'.$victim_id.'" data-firstname= "'.$first_name.'" data-middlename="'.$middle_name.'" data-lastname="'.$last_name.'" data-address="'.$address.'" data-victimstatus="'.$victim_status.'"><i class="icon-white icon-edit" title="Edit Victim" onclick="editVictim(this);"> </i> </a><span class="divider"> | </span>
												<a href="#" class="delete-victim"  data-incidentid="'.$incident_report_id.'" data-victimid="'.$victim_id.'" data-victimname="'.$first_name.' '.$middle_name.' '.$last_name.'"><i class="icon-white icon-trash" title="Delete Report" onclick="deleteVictim(this);"> </i> </a><span class="divider"> | </span>
										</td>
                                      </tr>

                                    ';
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
    
    function success(){
        $data['succ_message']= 'Your report is sent.';
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
                   redirect('Victim/success');
                }
                else{   //$query == false
                    $data['err_message'] = 'Something is wrong with the data input.';
                  
                }
            }
            else{   // error $this->$victimModel->validate
                $data['err_message']= 'The victim is already reported.';
               
            }
        }
        else{   //form_validation_run == false
              $data['err_message']= '';
           
        }
          $this->done($data);
    }   //end of validate()
    
	/**
	 *		GET VICTIM DETAILS FUNCTION
	 */
	function getVictimDetails(){
	
		// variables for post id values
		$incident_report_id= $this->input->post('incident_report_id');
        $victim_id= $this->input->post('victim_id');
		
		// call Victim Model
       // $query_result = $this->VictimModel->selectVictim($incident_report_id, $victim_id);
		
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
       //}
       /** else{   //form_validation_run == false
              echo validation_errors();
			  $variables = 'incidentid='.$incident_report_id.'&victimid='.$victim_id.'&firstname='.$first_name.'&middlename='.$middle_name.'&lastname='.$last_name.'&address='.$address.'&victimstatus='.$victim_status;
			  echo '\n'.$variables;
           
        }*/
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
}

