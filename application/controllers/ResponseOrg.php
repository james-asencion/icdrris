<?php

/* 
 * This project is licensed to team-dasig 2013
 * James R. Asencion  * 
 * Czareannah Leigh S. Villanca  * 
 * Femarie C. Manga  * 
 */

ini_set('display_errors',1);
error_reporting(E_ALL);

class ResponseOrg extends CI_Controller
{
    public function __construct(){
        parent :: __construct();
        $this->load->model('ResOrgModel');
    }
    function index(){
        $this->load->view('addResOrgView');
    }
    function addMembers($orgId){

            $this->load->view('includes/header');
            $this->load->view('addResOrgView.php');
            $this->load->view('includes/footer'); 
    }
    function addResOrg()
    {
    	$this->load->library('form_validation');
    	$this->form_validation->set_rules('name', 'Response Organization Name', 'trim|required');
    	$this->form_validation->set_rules('phone_num', 'Phone Number', 'trim|required');
    	$this->form_validation->set_rules('email', 'E-mail Address', 'trim|required');
    	$this->form_validation->set_rules('address', 'Address', 'trim|required');
    	$this->form_validation->set_rules('contact_person', 'Contact Person', 'trim|required');
    	$this->form_validation->set_rules('members_count', 'Members Count', 'trim|required');
    	$this->form_validation->set_rules('members_available', 'Members Available', 'trim|required');

    	if($this->form_validation->run() == FALSE){
    		echo "failed";
            //$this->registerLivelihoodOrg();
    	}
        else{
            $dataArray = $this->ResOrgModel->createResOrg();
            //echo $response['org_id'];
            $this->addOrgMembers($dataArray);
    	}

    }

    function registerResOrg()
    {
            $this->load->view('includes/header');
            $this->load->view('addResOrgView.php');
            $this->load->view('includes/footer'); 
    }
    function success(){
            $data['message'] = 'SUCCESS';
            $this->load->view('includes/header');
            $this->load->view('testView', $data);
            $this->load->view('includes/footer');    
    }
    function fail(){
            $data['message'] = 'FAIL';
            $this->load->view('includes/header');
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
            $this->load->view('addResOrgMembersView',$data);
            $this->load->view('includes/footer');
    }
    function submitMember(){
        $data = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'sex' => $this->input->post('sex'), 
                    'birthday' => $this->input->post('birthday'),
                    'civil_status' => $this->input->post('civil_status'),
                    'org_id' => $this->input->post('org_id')
                    );

        $query = $this->ResOrgModel->addMember($data);

        if($query){
            echo "<h4>Response Organization Members</h4>";
            echo "<table class=\"table table-striped\">";
            echo "<tr><th>First Name</th><th>Last Name</th><th>Sex</th><th>Birthday</th><th>Civil Status</th></tr>";
          
           foreach ($query->result() as $row) {
                echo "<tr><td>".$row->response_organization_member_first_name."</td><td>".$row->response_organization_members_last_name."</td><td>".$row->response_organization_members_sex."</td><td>".$row->response_organization_members_birthday."</td><td>".$row->response_organization_members_civil_status."</td></tr>";
           }  
           echo "</table>";
        }
        
        else{
           echo "Fail: ".$query;
        }
    }

      function viewDeploy(){
        $this->load->view('includes/deployheader');
        $this->load->view('deployResOrg');
        $this->load->view('includes/footer');
    }

    function viewResOrg($id){
        //query for the data
        $get = $this->uri->uri_to_assoc();
        //echo $get['id'];
        $data['response_org'] = $this->ResOrgModel->getResOrg($get['id']);
        $data['members'] = $this->ResOrgModel->getAllResOrgMembers($get['id']);
          
        //echo count($data['livelihood_org']);
        //pass the query results to the view
        $this->load->view('includes/header');
        $this->load->view('ResOrgView',$data);
        $this->load->view('includes/footer');       
    }

    function viewAllResOrgs(){
        $data['organizations'] = $this->ResOrgModel->getAllResOrgs();
        $this->load->view('includes/header');
        $this->load->view('ViewAllResOrg',$data);
        $this->load->view('includes/footer');

    }

    function deleteOrganization(){
        $result = $this->ResOrgModel->deleteOrganization($this->input->post('org_id'));
        echo $result;
    }

    function testEditable(){
         $result = $this->ResOrgModel->updateMemberEditable($this->input->post('pk'), $this->input->post('name'), $this->input->post('value'));
         if($result){
            echo "can be any string";
         }
         else{
            header('HTTP 400 Bad Request', true, 400);
            echo "error encountered";
         }
         //else{
            //echo "error encountered";
            //$a = array("username"=>"username already exist");
            //$arr = array("errors"=>$a);
            //$responseData = json_encode($arr);
            //echo $responseData;
            //header('HTTP 400 Bad Request', true, 400);
            //echo "error encountered";
            //{"errors": {"username": "username already exist"} }
            //$responseData = json_encode("{success:false, message:'server error'}");
            
            //echo "Error in Query".$this->input->post('pk');
         //}
        
    }

}

