<?php

/* 
 * This project is licensed to team-dasig 2013
 * James R. Asencion  * 
 * Czareannah Leigh S. Villanca  * 
 * Femarie C. Manga  * 
 */

ini_set('display_errors',1);
error_reporting(E_ALL);

class Livelihood extends CI_Controller
{
    public function __construct(){
        parent :: __construct();
        $this->load->model('LivelihoodModel');
    }
    function index(){
        $this->load->view('addLivelihoodOrg');
    }
    function addMembers($orgId){

            $this->load->view('includes/header');
            $this->load->view('login_form'); 
            $this->load->view('addOrgView.php');
            $this->load->view('includes/footer'); 
    }
    function addLivelihoodOrg()
    {
    	$this->load->library('form_validation');
    	$this->form_validation->set_rules('name', 'Organization Name', 'trim|required');
    	$this->form_validation->set_rules('address', 'Address', 'trim|required');
    	$this->form_validation->set_rules('members', 'Number of members', 'trim|required');
    	$this->form_validation->set_rules('initial_income', 'Initial Income', 'trim|required');
    	$this->form_validation->set_rules('status', 'Organization Status', 'trim|required');
    	$this->form_validation->set_rules('date_formed', 'Date established', 'trim|required');
    	$this->form_validation->set_rules('business_type', 'Business Activity Type', 'trim|required');

    	if($this->form_validation->run() == FALSE){
    		echo "failed";
            //$this->registerLivelihoodOrg();
    	}
        else{
            $orgID = $this->LivelihoodModel->createLivelihoodOrg();
            //echo $response['org_id'];
            $this->addOrgMembers($orgID);
    	}

    }

    function registerLivelihoodOrg()
    {
            $this->load->view('includes/header');
            $this->load->view('login_form'); 
            $this->load->view('addOrgView');
            $this->load->view('includes/footer'); 
    }
    function success(){
            $data['message'] = 'SUCCESS';
            $this->load->view('includes/header');
            $this->load->view('login_form'); 
            $this->load->view('testView', $data);
            $this->load->view('includes/footer');    
    }
    function fail(){
            $data['message'] = 'FAIL';
            $this->load->view('includes/header');
            $this->load->view('login_form'); 
            $this->load->view('testView', $data);
            $this->load->view('includes/footer');    
    }
    function checkOrg(){
        $orgName = $this->input->post('name');
        $result = $this->LivelihoodModel->checkOrgExist($orgName);
       if($result)
        {
            echo "false";
        }
        else
        {
            echo "true";
        }
    }
    function addOrgMembers($data){
        
            $this->load->view('includes/header');
            $this->load->view('login_form');
            $this->load->view('addOrgMembersView',$data);
            $this->load->view('includes/footer');
    }
    function submitMember(){
        $data = array(
                    'first_name' => $this->input->post('first_name'),
                    'middle_name' => $this->input->post('middle_name'),
                    'last_name' => $this->input->post('last_name'),
                    'sex' => $this->input->post('sex'), 
                    'birthday' => $this->input->post('birthday'),
                    'age' => $this->input->post('age'),
                    'monthly_income' => $this->input->post('monthly_income'),
                    'source_of_income' => $this->input->post('source_of_income'),
                    'civil_status' => $this->input->post('civil_status'),
                    'no_of_children' => $this->input->post('no_of_children'),
                    'org_id' => $this->input->post('org_id')
                    );

        $query = $this->LivelihoodModel->addMember($data);

        if($query){
            echo "<h4>Livelihood Organization Members</h4>";
            echo "<table class=\"table table-striped\">";
            echo "<tr><th>First Name</th><th>Middle Name</th><th>Last Name</th><th>Sex</th><th>Birthday</th><th>Age</th><th>Monthly Income</th><th>Source of income</th><th>Civil Status</th><th>Number of Children</th></tr>";
          
           foreach ($query->result() as $row) {
                echo "<tr><td>".$row->first_name."</td><td>".$row->middle_name."</td><td>".$row->last_name."</td><td>".$row->sex."</td><td>".$row->birthday."</td><td>".$row->age."</td><td>".$row->monthly_income."</td><td>".$row->source_of_income."</td><td>".$row->civil_status."</td><td>".$row->no_of_children."</td></tr>";
           }  
           echo "</table>";
        }
        
        else{
           echo "Fail: ".$query;
        }
    }
    function viewLivelihoodOrganization(){
        //query for the data
        $id = $this->input->get('id');
        $data['livelihood_org'] = $this->LivelihoodModel->getLivelihoodOrg($id);
        $data['members'] = $this->LivelihoodModel->getAllMembers($id);
            
        //pass the query results to the view
        $this->load->view('includes/header');
        $this->load->view('login_form');
        $this->load->view('livelihoodOrganizationView',$data);
        $this->load->view('includes/footer');        
    }
    function viewAllLivelihoodOrgs(){
        $data['organizations'] = $this->LivelihoodModel->getAllLivelihoodOrgs();
        $this->load->view('includes/header');
        $this->load->view('login_form');
        $this->load->view('livelihoodOrganizationsView',$data);
        $this->load->view('includes/footer');

    }
    function updateMember(){
        $this->LivelihoodModel->updateMember();
    }
    function deleteOrganization(){
        $result = $this->LivelihoodModel->deleteOrganization($this->input->post('org_id'));
        echo $result;
    }


}

