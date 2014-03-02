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
    	$this->form_validation->set_rules('ro_name', 'Response Organization Name', 'trim|required');
    	$this->form_validation->set_rules('ro_phone_num', 'Phone Number', 'trim|required');
    	$this->form_validation->set_rules('ro_email', 'E-mail Address', 'trim|required');
    	$this->form_validation->set_rules('ro_address', 'Address', 'trim|required');
    	$this->form_validation->set_rules('ro_contact_person', 'Contact Person', 'trim|required');
    	$this->form_validation->set_rules('ro_members_count', 'Members Count', 'trim|required');
    	$this->form_validation->set_rules('ro_members_available', 'Members Available', 'trim|required');

    	if($this->form_validation->run() == FALSE){
    		echo "failed";
            //$this->registerLivelihoodOrg();
    	}
        else{
            $dataArray = $this->ResOrgModel->createResOrg();
            //echo $response['org_id'];
            $this->addOrgMembers($dataArray);
         //   $this->viewResOrg();
    	}

    }
    function addResponseOrgModal(){
        $this->ResOrgModel->createResOrgModal();
        return $this->getAllResponseOrgTable();
    }

    function getAllResponseOrgTable(){
        $organizations = $this->ResOrgModel->getAllResOrgs();
        echo "<tr><th>Response Organization Name</th><th>Phone Number</th><th>Email</th><th>Address</th><th>Contact Person</th><th>Members Count</th><th>Members Available</th><th>Actions</th></tr>";
        foreach ($organizations as $organization) {
                echo "<tr><td><span href=\"#\" id=\"response_organization_name\" data-name\"response_organization_name\" data-type=\"text\" data-pk=\"".$organization->response_organization_id."\" data-title=\"Enter Name\">".$organization->response_organization_name.
                "</span></td><td><span href=\"#\" id=\"response_organization_phone_num\" data-name\"response_organization_phone_num\" data-type=\"text\" data-pk=\"".$organization->response_organization_id."\" data-title=\"Enter Phone Number\">".$organization->response_organization_phone_num."</span></td>
                <td><span href=\"#\" id=\"response_organization_email\" data-name\"response_organization_email\" data-type=\"text\" data-pk=\"".$organization->response_organization_id."\" data-title=\"Enter Email\">".$organization->response_organization_email."</span></td>
                <td><span href=\"#\" id=\"response_organization_address\" data-name\"response_organization_address\" data-type=\"text\" data-pk=\"".$organization->response_organization_id."\" data-title=\"Enter Address\">".$organization->response_organization_address."</span></td>
                <td><span href=\"#\" id=\"response_organization_contact_person\" data-name\"response_organization_contact_person\" data-type=\"text\" data-pk=\"".$organization->response_organization_id."\" data-title=\"Enter Contact Person\">".$organization->response_organization_contact_person."</span></td>
                <td><span href=\"#\" id=\"response_organization_members_count\" data-name\"response_organization_members_count\" data-type=\"text\" data-pk=\"".$organization->response_organization_id."\" data-title=\"Enter Members Count\">".$organization->response_organization_members_count."</span></td>
                <td><span href=\"#\" id=\"response_organization_members_available\" data-name\"response_organization_members_available\" data-type=\"text\" data-pk=\"".$organization->response_organization_id."\" data-title=\"Enter Members Available\">".$organization->response_organization_members_available."</span></td>
                <td><a href=\"#\" class=\"confirm-deleteResOrgMember\" data-orgid=".$org->response_organization_id." data-lastname=\"".$member->response_organization_member_last_name."\" data-id=".$member->response_organization_member_id."><i class=\"icon-trash\"></i></a></td></tr>";
        }
    }

    function addResOrgMemberModal(){
        $data1= array(
                    'member_first_name' => $this->input->post('first_name'),
                    'member_last_name' => $this->input->post('last_name'),
                    'member_sex' => $this->input->post('sex'), 
                    'member_birthday' => $this->input->post('birthday'),
                    'member_civil_status' => $this->input->post('civil_status')
                    );


        $member_id = $this->ResOrgModel->addMemberModal($data1,$this->input->post('org_id'));
        $skills = json_decode($_POST['skill']);

        foreach($skills as $skill) {
            $this->ResOrgModel->addMemberSkills($member_id, $skill);
        }

        return $this->getAllResOrgMembersTable($this->input->post('org_id'));
    }

    function getAllResOrgMembersTable($id){
        $members = $this->ResOrgModel->getAllResOrgMembers($id);
        echo "<tr><th>First Name</th><th>Last Name</th><th>Sex</th><th>Birthday</th><th>Civil Status</th><th>Availability</th><th>Skills</th><th>Actions</th></tr>";
       foreach ($members as $member) {

        $skills = $this->ResOrgModel->getSkillsByMember($member);
        echo $member;
        $string = "";
        if($skills){
            foreach ($skills as $s) {
            echo $s->skillset_description;
            }      
        }
           
                echo "<tr>
                <td><span href=\"#\" id=\"response_organization_member_first_name\" data-name\"response_organization_member_first_name\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter First Name\">".$member->member_first_name."</span></td>
                <td><span href=\"#\" id=\"response_organization_member_last_name\" data-name\"response_organization_member_last_name\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter Last Name\">".$member->member_last_name."</a></td>
                <td><span href=\"#\" id=\"response_organization_member_sex\" data-name\"response_organization_member_sex\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter Sex\">".$member->member_sex."</a></td>
                <td><span href=\"#\" id=\"response_organization_member_birthday\" data-name\"response_organization_member_birthday\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter Birthday\">".$member->member_birthday."</a></td>
                <td><span href=\"#\" id=\"response_organization_member_civil_status\" data-name\"response_organization_member_civil_status\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter Civil Status\">".$member->member_civil_status."</a></td>
                <td><span href=\"#\" id=\"response_organization_member_civil_status\" data-name\"response_organization_member_civil_status\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter Member Status\">".$member->member_status."</a></td>
                <td><span href=\"#\" id=\"response_organization_member_civil_status\" data-name\"response_organization_member_civil_status\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter Skills\">".$string."</a></td>
                <td><a href=\"#\" class=\"confirm-deleteResOrgMember\" data-lastname=\"".$member->member_last_name."\" data-id=".$member->member_id."><i class=\"icon-trash\"></i></a></td></tr>";
        }
    }

    function getAllResOrgCheckboxList(){
        $members = $this->ResOrgModel->getAllDeployableResOrgMembers($this->input->post('org_id'));

       foreach ($members as $member) {
                echo "<label class='checkbox'><input type='checkbox' data-id=".$member->member_id.">".$member->member_first_name."</input></label>";
        }
    }
    function deployMembers(){
        $members = json_decode($_POST['membersToDeploy']);

        $orgDeploymentData = array(
                                'response_organization_id' => $this->input->post('org_id'),
                                'location_id' => $this->input->post('location_id'),
                                'activity_description' => $this->input->post('response_activity_description'),
                                'activity_start_date' => $this->input->post('activity_start_date'),
                                'activity_end_date' => $this->input->post('activity_end_date'),
                                'deployment_lat' => $this->input->post('deployment_lat'),
                                'deployment_lng' => $this->input->post('deployment_lng')
                                );


        $deploymentId = $this->ResOrgModel->deployResponseOrganization($orgDeploymentData);

        foreach ($members as $member) {
            $deploymentData = array(
                                'member_id' => $member,
                                'response_organization_location_id' => $deploymentId
                                );

            $this->ResOrgModel->deployResponseOrgMember($deploymentData);
            $this->ResOrgModel->updateMemberStatus($member);
        }

        //$this->getAllResOrgCheckboxList($org_id);
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
            $this->load->view('ResOrgView',$data);
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
          
           foreach ($query as $row) {
                echo "<tr><td>".$row->member_first_name."</td><td>".$row->member_last_name."</td><td>".$row->member_sex."</td><td>".$row->member_birthday."</td><td>".$row->member_civil_status."</td></tr>";
           }  
           echo "</table>";
        }
        
        else{
           echo "Fail: ".$query;
        }
    }

      function viewDeploy(){
        $this->load->view('includes/deploylivelihoodheader');
        $this->load->view('deployResOrg');
        $this->load->view('includes/footer');
    }

    function viewResOrg($id){
        //query for the data
        $get = $this->uri->uri_to_assoc();
        //echo $get['id'];
        $data['org'] = $this->ResOrgModel->getResOrg($get['id']);
        $data['members'] = $this->ResOrgModel->getAllResOrgMembers($get['id']);
        $data['skills']=$this->ResOrgModel->getAllSkills();
          
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

    function getAllSkills() {

        $data['skills']=$this->ResOrgModel->getAllSkills();
        $this->load->view('includes/header');
        $this->load->view('dropdowntrial', $data);
        $this->load->view('includes/footer');
    }

    function deleteOrganization(){
        $result = $this->ResOrgModel->deleteOrganization($this->input->post('org_id'));
        echo $result;
    }

    function deleteResOrgMember(){
        $result = $this->ResOrgModel->deleteResOrgMember($this->input->post('member_id'));
        return $this->getAllResOrgMembersTable($this->input->post('org_id'));

        //echo $result;
    }

    function testEditable2() {
         $result = $this->ResOrgModel->updateResOrgEditable($this->input->post('pk'), $this->input->post('name'), $this->input->post('value'));
         if($result){
            echo "can be any string";
         }
         else{
            header('HTTP 400 Bad Request', true, 400);
            echo "error encountered";
         }
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

    function test(){
        $this->load->view('includes/header');
        $this->load->view('dropdowntrial');
        $this->load->view('includes/footer');
    }

 

}

