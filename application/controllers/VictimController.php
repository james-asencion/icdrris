<?php

/* 
 * This project is licensed to team-dasig 2013
 * James R. Asencion  * 
 * Czareannah Leigh S. Villanca  * 
 * Femarie C. Manga  * 
 */

class VictimController extends CI_Controller
{
    function index(){
        $this->load->view('forms/victimReport');
    }
    
    function reportVictim($data){
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

            $this->load->model('Victim');

            if($this->Victim->validate($fname, $mname, $lname, $reportNo)){
                
                $query=$this->Victim->reportVictim($fname, $mname, $lname, $address, $victim_status, $reportNo);
                if($query){
                   redirect('VictimController/success');
                }
                else{   //$query == false
                    $data['err_message'] = 'Something is wrong with the data input.';
                   // $this->reportVictim($data);
                    //echo "dili sakto ang query sa values";
                }
            }
            else{   // error $this->$victimModel->validate
                $data['err_message']= 'The victim is already reported.';
               // $this->reportVictim($data);
                //echo "naay duplication of victim sa incident_victim table";
            }
        }
        else{   //form_validation_run == false
              $data['err_message']= '';
           
            //echo "form_validation_run == false";
        }
          $this->reportVictim($data);
    }   //end of validate()
}

