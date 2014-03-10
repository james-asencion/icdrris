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
    function addResOrg(){
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
            $id = $this->ResOrgModel->createResOrg();
            //http://localhost/icdrris/ResponseOrg/ViewResOrg/id/2
            $this->viewNewResOrg($id);
           // $url = 
            redirect('/ResponseOrg/viewNewResOrg/id/'.$id);
            //echo $response['org_id'];
            //$this->addOrgMembers($dataArray);
    	}

    }
    function addNewMemberSkillset(){
        $skillset_description = $this->input->post('skillset_description');
        $this->ResOrgModel->addNewMemberSkillset($skillset_description);

        return $this->getAllSkillsCheckboxList();
    }
    function addResponseOrgModal(){
        $this->ResOrgModel->createResOrgModal();
        return $this->getAllResponseOrgTable();
    }

    function getAllResponseOrgTable(){
        $organizations = $this->ResOrgModel->getUserResponseOrganizations();
        echo "<tr><th>Response Organization Name</th><th>Phone Number</th><th>Email</th><th>Address</th><th>Contact Person</th><th>Members Count</th><th>Members Available</th><th>Actions</th></tr>";
        foreach ($organizations as $organization) {
                echo "<tr><td><span href=\"#\" id=\"response_organization_name\" data-name\"response_organization_name\" data-type=\"text\" data-pk=\"".$organization->response_organization_id."\" data-title=\"Enter Name\">".$organization->response_organization_name.
                "</span></td><td><span href=\"#\" id=\"response_organization_phone_num\" data-name\"response_organization_phone_num\" data-type=\"text\" data-pk=\"".$organization->response_organization_id."\" data-title=\"Enter Phone Number\">".$organization->response_organization_phone_num."</span></td>
                <td><span href=\"#\" id=\"response_organization_email\" data-name\"response_organization_email\" data-type=\"text\" data-pk=\"".$organization->response_organization_id."\" data-title=\"Enter Email\">".$organization->response_organization_email."</span></td>
                <td><span href=\"#\" id=\"response_organization_address\" data-name\"response_organization_address\" data-type=\"text\" data-pk=\"".$organization->response_organization_id."\" data-title=\"Enter Address\">".$organization->response_organization_address."</span></td>
                <td><span href=\"#\" id=\"response_organization_contact_person\" data-name\"response_organization_contact_person\" data-type=\"text\" data-pk=\"".$organization->response_organization_id."\" data-title=\"Enter Contact Person\">".$organization->response_organization_contact_person."</span></td>
                <td><span href=\"#\" id=\"response_organization_members_count\" data-name\"response_organization_members_count\" data-type=\"text\" data-pk=\"".$organization->response_organization_id."\" data-title=\"Enter Members Count\">".$organization->response_organization_members_count."</span></td>
                <td><span href=\"#\" id=\"response_organization_members_available\" data-name\"response_organization_members_available\" data-type=\"text\" data-pk=\"".$organization->response_organization_id."\" data-title=\"Enter Members Available\">".$organization->response_organization_members_available."</span></td>
                <td><a href=\"#\" class=\"confirm-deleteResOrgMember\" data-orgid=".$org->response_organization_id." data-lastname=\"".$member->response_organization_member_last_name."\" data-id=".$member->response_organization_member_id."><i class=\"icon-trash\"></i></a></td></tr><a class=\"confirm-edit\" align=\"center\" href=ViewResOrg/id/\"".$organization->response_organization_id."\"><i class=\"icon-search\"></i></a><a align=\"center\" href=deployResponseOrganization/\"".base_convert($organization->response_organization_id,10,36)."\"><i class=\"icon-share-alt\"></i></a></td></tr>";
                

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

        $skills = $this->ResOrgModel->getSkillsByMember($member->member_id);
        $skillsString = "";
        foreach ($skills as $s) {
            $skillsString .= $s->skillset_description.", ";
        } 
           
                echo "<tr>
                <td><span href=\"#\" id=\"response_organization_member_first_name\" data-name\"response_organization_member_first_name\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter First Name\">".$member->member_first_name."</span></td>
                <td><span href=\"#\" id=\"response_organization_member_last_name\" data-name\"response_organization_member_last_name\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter Last Name\">".$member->member_last_name."</a></td>
                <td><span href=\"#\" id=\"response_organization_member_sex\" data-name\"response_organization_member_sex\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter Sex\">".$member->member_sex."</a></td>
                <td><span href=\"#\" id=\"response_organization_member_birthday\" data-name\"response_organization_member_birthday\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter Birthday\">".$member->member_birthday."</a></td>
                <td><span href=\"#\" id=\"response_organization_member_civil_status\" data-name\"response_organization_member_civil_status\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter Civil Status\">".$member->member_civil_status."</a></td>
                <td><span href=\"#\" id=\"response_organization_member_civil_status\" data-name\"response_organization_member_civil_status\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter Member Status\">".$member->member_status."</a></td>
                <td><span href=\"#\" id=\"response_organization_member_civil_status\" data-name\"response_organization_member_civil_status\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter Skills\">".$skillsString."</a></td>
                <td><a href=\"#\" class=\"confirm-deleteResOrgMember\" data-lastname=\"".$member->member_last_name."\" data-id=".$member->member_id."><i class=\"icon-trash\"></i></a></td></tr>";
        }
    }

    function getAllResOrgCheckboxList(){
        $members = $this->ResOrgModel->getAllDeployableResOrgMembers(intval($this->input->post('org_id'),36));

       foreach ($members as $member) {
                echo "<label class='checkbox'><input type='checkbox' data-id=".$member->member_id.">".$member->member_first_name."</input></label>";
        }
    }
    function getAllSkillsCheckboxList(){
        $skills = $this->ResOrgModel->getAllSkillset();
        foreach ($skills as $skill) {
            echo "<li><label class = \"checkbox\"><input type = \"checkbox\" data-id =".$skill->skillset_id.">".$skill->skillset_description."</input></label></li>";
        }
    }
    function deployMembers(){
        $members = json_decode($_POST['membersToDeploy']);

        $orgDeploymentData = array(
                                'response_organization_id' => intval($this->input->post('org_id'),36),
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
            $this->ResOrgModel->updateMemberStatus($member,'deployed');
        }

        return $this->getAllResOrgCheckboxList(intval($this->input->post('org_id'),36));
    }
    function undeployResponseOrg(){
        //undeploy members first
        $members = $this->ResOrgModel->getAllDeployedMembers($this->input->post('response_organization_location_id'));
        $this->undeployMembers($members->result(),$this->input->post('response_organization_location_id'));

        //then undeploy the response organization on that location
        $this->ResOrgModel->undeployResponseOrg($this->input->post('response_organization_location_id'));
    }
    function undeployMembers($members, $response_organization_location_id){
        foreach ($members as $member) {
            $this->ResOrgModel->undeployMember($member->member_id, $response_organization_location_id);
            $this->ResOrgModel->updateMemberStatus($member->member_id, 'available');
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

    function deployResponseOrganization(){
        $this->load->view('includes/deployResOrgheader');
        $this->load->view('deployResOrg');
        $this->load->view('includes/footer');
    }

    function viewResOrg($id){
        //query for the data
        $get = $this->uri->uri_to_assoc();
        //echo $get['id'];
        $data['org'] = $this->ResOrgModel->getResOrg($get['id']);
        $data['members'] = $this->ResOrgModel->getAllResOrgMembers($get['id']);
        $data['skills'] = $this->ResOrgModel->getAllSkillset();
          
        //echo count($data['livelihood_org']);
        //pass the query results to the view
        $this->load->view('includes/header');
        $this->load->view('ResOrgView',$data);
        $this->load->view('includes/footer');       
    }
    function viewNewResOrg(){
        //query for the data
        $get = $this->uri->uri_to_assoc();
        $id = $get['id'];
        $data['org'] = $this->ResOrgModel->getResOrg($id);
        $data['members'] = $this->ResOrgModel->getAllResOrgMembers($id);
        $data['skills'] = $this->ResOrgModel->getAllSkillset();
          
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

    function viewAllUserResOrgs(){
        $data['organizations'] = $this->ResOrgModel->getUserResponseOrganizations();
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
         
        
    }
    function getDeployedOrganizationName(){
        $org = $this->ResOrgModel->getDeployedOrganization($this->input->post('id'));
        echo $org->response_organization_name;

    }
    function getDeployedOrganizationDetails(){

        $org = $this->ResOrgModel->getDeployedOrganization($this->input->post('id'));


        echo '<h4><div id="incident-title" class="span8" style="color:darkorange">'.$org->response_organization_name.'</div></h4>';
        if(($this->session->userdata('user_type') === 'response organization') & ($this->session->userdata('is_logged_in'))){
            $isOwned = $this->ResOrgModel->isOrganizationOwnedByUser($org->response_organization_id,$this->session->userdata('user_id'));
            if($isOwned){
                echo '<a class= "label label-info"  data-id='.$org->response_organization_location_id.' onclick="undeployRespondent('.$org->response_organization_location_id.')" ><i class= "icon-eye-open icon-white" title="Undeploy"> </i> Undeploy </a>'; 
            }
            else{
                echo '<h5>'.$isOwned.'</h5>';
            }
        }              

                    echo '<div class="details" style="margin-left: 15px; margin-top: 10px">
                          <div class="row-fluid">
                              <div class="span12">
                                <div id="activityDescriptionLabel" class="span4">Deployment Activity:  </div>
                                <div id="activityDescriptionField" class="span8">'.$org->activity_description.'</div>
                              </div>
                          </div>
                          <div class="row-fluid">
                              <div class="span12">
                                <div id="activityDescriptionLabel" class="span4">Deployment Location:  </div>
                                <div id="activityDescriptionField" class="span8">'.$org->location_address.'</div>
                              </div>
                          </div>
                        <div class="row-fluid">
                            <div class="span12">
                              <div id="activityStartDateLabel" class="span4">Activity Start Date:  </div>
                              <div id="activityStartDateField" class="span8">'.$org->activity_start_date.'</div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                              <div id="activityEndDateLabel" class="span4">Activity End Date:  </div>
                              <div id="activityEndDateField" class="span8">'.$org->activity_end_date.'</div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                              <div id="deploymentStatusLabel" class="span4">Deployment Status:  </div>
                              <div id="deploymentStatusField" class="span8">'.$org->activity_status.'</div>
                            </div>
                        </div>
                    </div>';
    }
    function getAllDeployedMembers(){

        $orgId = $this->input->post("orgId");
        $query = $this->ResOrgModel->getAllDeployedMembers($orgId);
        $members = $query->result(); 

                if($query-> num_rows() == 0){
                    echo '<center><font style="color: red;"><b>No members deployed.</b></font></center>';
                }
                else{
                    echo '<table>
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Skills</th>
                                    </tr>
                                </thead>
                                <tbody>';
                                                    
                    foreach($members as $member){
                        $skills = $this->ResOrgModel->getMemberSkills($member->member_id);
                        echo        '<tr>
                                        <td>'.$member->member_first_name." ".$member->member_last_name.'</td>
                                        <td>'.$member->member_status.'</td>
                                        <td>';
                                            foreach($skills as $skill){
                                                echo $skill->skillset_description.', ';
                                        }
                        echo        '</td>
                                    </tr>';

                    }
                            echo '</tbody>
                            </table>';
                }
                    
    }          
        

    function test(){
        $this->load->view('includes/header');
        $this->load->view('dropdowntrial');
        $this->load->view('includes/footer');
    }

 

}

