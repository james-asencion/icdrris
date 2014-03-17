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
    function index()
    {   //first initialization of login form
            //$data= $this->countIncidents();
            $data['programs'] = $this->LivelihoodModel->getAllLivelihoodPrograms();
            $this->load->view('includes/livelihoodHeader');
            $this->load->view('livelihoodHome',$data);
            $this->load->view('includes/livelihoodFooter'); 
    } 
    // function index(){
    //     $this->load->view('addLivelihoodOrg');
    // }
    function addMembers($orgId){

            $this->load->view('includes/header');
            $this->load->view('addOrgView.php');
            $this->load->view('includes/footer'); 
    }
    function addLivelihoodOrg()
    {
        // $this->load->library('form_validation');
        // $this->form_validation->set_rules('name', 'Organization Name', 'trim|required');
        // $this->form_validation->set_rules('address', 'Address', 'trim|required');
        // $this->form_validation->set_rules('members', 'Number of members', 'trim|required');
        // $this->form_validation->set_rules('initial_income', 'Initial Income', 'trim|required');
        // $this->form_validation->set_rules('status', 'Organization Status', 'trim|required');
        // $this->form_validation->set_rules('date_formed', 'Date established', 'trim|required');
        // $this->form_validation->set_rules('business_type', 'Business Activity Type', 'trim|required');

        // if($this->form_validation->run() == FALSE){
        //     echo "failed";
        //     //$this->registerLivelihoodOrg();
        // }
        // else{
            //$id = $this->LivelihoodModel->createLivelihoodOrg();
        $data = array(
                    'livelihood_organization_name' => $this->input->post('name'),
                    'livelihood_organization_address' => $this->input->post('address'),
                    'no_of_members' => $this->input->post('members'),
                    'initial_income' => $this->input->post('initial_income'),
                    'livelihood_organization_status' => $this->input->post('status'),
                    'date_established' => $this->input->post('date_formed'),
                    'business_activity_type' => $this->input->post('business_type'),
                    'location_id' => 1,
                    'livelihood_org_lat' => $this->input->post('lat'),
                    'livelihood_org_lng' => $this->input->post('lng')
                    );
        
        $this->LivelihoodModel->createLivelihoodOrg($data);
            //echo $response['org_id'];
            //$this->viewNewLivelihoodOrg($id);
            //$this->addOrgMembers($dataArray);
        // }

    }

    // function registerLivelihoodOrg()
    // {
    //         $this->load->view('includes/header');
    //         $this->load->view('addOrgView');
    //         $this->load->view('includes/footer'); 
    // }
    function registerLivelihoodOrg(){
        $this->load->view('includes/mapLivelihoodOrgHeader');
        $this->load->view('registerLivelihood');
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
          
           foreach ($query->result() as $member) {
                echo "<tr>
                <td><span href=\"#\" id=\"first_name\" data-name\"member_first_name\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter First Name\">".$member->first_name."</span></td>
                <td><span href=\"#\" id=\"middle_name\" data-name\"member_middle_name\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter Middle Name\">".$member->middle_name."</span></td>
                <td><span href=\"#\" id=\"last_name\" data-name\"member_last_name\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter Last Name\">".$member->last_name."</span></td>
                <td><span href=\"#\" id=\"sex\" data-name\"member_sex\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter Sex\">".$member->sex."</span></td>
                <td><span href=\"#\" id=\"birthday\" data-name\"member_birthday\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter Birthday\">".$member->birthday."</span></td>
                <td><span href=\"#\" id=\"age\" data-name\"member_age\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter Age\">".$member->age."</span></td>
                <td><span href=\"#\" id=\"monthly_income\" data-name\"member_monthly_income\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter Monthly Income\">".$member->monthly_income."</span></td>
                <td><span href=\"#\" id=\"source_of_income\" data-name\"member_source_of_income\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter Source of Income\">".$member->source_of_income."</span></td>
                <td><span href=\"#\" id=\"civil_status\" data-name\"member_civil_status\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter Civil Status\">".$member->civil_status."</span></td>
                <td><span href=\"#\" id=\"no_of_children\" data-name\"member_no_of_children\" data-type=\"text\" data-pk=\"".$member->member_id."\" data-title=\"Enter No of children\">".$member->no_of_children."</span></td>
                <td><a align=\"center\" href=localhost/icdrris/Livelihood/deleteMember?id=".$member->member_id."</a></td></tr>";
           }  
           echo "</table>";
        }
        
        else{
           echo "Fail: ".$query;
        }
    }

    function viewDeploy(){
        $this->load->view('includes/deployheader');
        $this->load->view('testDeploy');
        $this->load->view('includes/footer');
    }
    function viewLivelihoodOrganization(){
        //query for the data
        $get = $this->uri->uri_to_assoc();
        //echo $get['id'];
        $data['livelihood_org'] = $this->LivelihoodModel->getLivelihoodOrg($get['id']);
        $data['members'] = $this->LivelihoodModel->getAllMembers($get['id']);
        $data['livelihood_programs'] = $this->LivelihoodModel->getAllAvailableLivelihoodPrograms($get['id']);
        $data['requests'] = $this->LivelihoodModel->getAllOrganizationRequests($get['id']);
        $data['grants'] = $this->LivelihoodModel->getAllOrganizationProgramGrants($get['id']);
          
        //echo count($data['livelihood_org']);
        //pass the query results to the view
        $this->load->view('includes/header');
        $this->load->view('livelihoodOrgView',$data);
        $this->load->view('includes/footer');        
    }
    function getLivelihoodOrganizationName(){
        $org = $this->LivelihoodModel->getLivelihoodOrg($this->input->post('id'));
        echo $org->livelihood_organization_name;
        //echo "test";
    }
    function getBarangayName(){
        $result = $this->LivelihoodModel->getBarangayName($this->input->post('id'));
        echo $result->location_address;
    }
    function getResourceByCategory(){
        $query = $this->LivelihoodModel->getBarangayResourceByCategory($this->input->post('location_id'), $this->input->post('resource_category'));
        $resources = $query->result();
        //echo count($resources);
        echo "<table class='table table-condensed' style='color:#cccccc;'>";
        if($query->num_rows()>0){
            foreach ($resources as $resource) {
            //echo $resource->resource_category;
            echo "<tr><td>".$resource->location_resource_description."</td>
            <td>".$resource->location_resource_quantity."</td></tr>";
            }
        }
        echo "</table>";
        
    }
    function getLivelihoodOrganizationDetails(){

        $org = $this->LivelihoodModel->getLivelihoodOrg($this->input->post('id'));


        echo '<h4><div id="incident-title" class="span8" style="color:darkorange">'.$org->livelihood_organization_name.'</div></h4>';
        if(($this->session->userdata('user_type') === 'cdlo') & ($this->session->userdata('is_logged_in'))){
                echo '<button type="button" class= "grant-map btn btn-success"  data-id='.$org->livelihood_organization_id.' onclick="grantLivelihoodProgramFromMap('.$org->livelihood_organization_id.')"><i class= "icon icon-share icon-white" title="Grant"></i>Grant Livelihood Program</button>'; 
        }              

                    echo '<div class="details" style="margin-left: 5px; margin-top: 10px">
                          <div class="row-fluid">
                              <div class="span12">
                                <div id="activityDescriptionLabel" class="span4">Livelihood Organization Name:  </div>
                                <div id="activityDescriptionField" class="span8">'.$org->livelihood_organization_name.'</div>
                              </div>
                          </div>
                          <div class="row-fluid">
                              <div class="span12">
                                <div id="activityDescriptionLabel" class="span4">Business Activity Type:  </div>
                                <div id="activityDescriptionField" class="span8">'.$org->business_activity_type.'</div>
                              </div>
                          </div>
                        <div class="row-fluid">
                            <div class="span12">
                              <div id="activityStartDateLabel" class="span4">Livelihood Organization Address:  </div>
                              <div id="activityStartDateField" class="span8">'.$org->livelihood_organization_address.'</div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                              <div id="activityEndDateLabel" class="span4">Number of members:  </div>
                              <div id="activityEndDateField" class="span8">'.$org->no_of_members.'</div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                              <div id="deploymentStatusLabel" class="span4">Organization Status:  </div>
                              <div id="deploymentStatusField" class="span8">'.$org->livelihood_organization_status.'</div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                              <div id="deploymentStatusLabel" class="span4">Initial Income:  </div>
                              <div id="deploymentStatusField" class="span8">'.$org->initial_income.'</div>
                            </div>
                        </div>
                    </div>';
    
    }

    function addNewProgramResource(){
        $resource_description = $this->input->post('resource_description');
        $this->LivelihoodModel->addNewProgramResource($resource_description);
        
        return $this->getAllLivelihoodResourcesDropdown();
    }
    function getAllLivelihoodResourcesDropdown(){
        $resources = $this->LivelihoodModel->getAllLivelihoodResources();
        echo "<select name=\"resource_id\" id=\"resource_id\">";
        echo "<option value=\"\">   </option>";
        foreach($resources as $resource){
          echo "<option value=\"".$resource->livelihood_resource_id."\">".$resource->livelihood_resource_description."</option>";
        }
        echo "</select>";
    }
    function viewNewLivelihoodOrg($id){

        $data['livelihood_org'] = $this->LivelihoodModel->getLivelihoodOrg($id);
        $data['members'] = $this->LivelihoodModel->getAllMembers($id);
        $data['grants']=$this->LivelihoodModel->getAllOrganizationProgramGrants($id);
        $data['requests']=$this->LivelihoodModel->getAllOrganizationRequests($id);
          
        //echo count($data['livelihood_org']);
        //pass the query results to the view
        $this->load->view('includes/header');
        $this->load->view('livelihoodOrgView',$data);
        $this->load->view('includes/footer'); 

    }
    
    function viewAllLivelihoodOrgs(){
        $data['organizations'] = $this->LivelihoodModel->getAllLivelihoodOrgs();
        $this->load->view('includes/header');
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
    function registerLivelihoodProgram(){
        $data['resources'] = $this->LivelihoodModel->getAllLivelihoodResources();
        $this->load->view('includes/header');
        $this->load->view('addLivelihoodProgram',$data);
        $this->load->view('includes/footer');
    }
    function addLivelihoodProgram(){
            $data = array(
                    'livelihood_type' => $this->input->post('livelihood_type'),
                    'livelihood_description' => $this->input->post('livelihood_description'),
                    'livelihood_program_cost' => $this->input->post('livelihood_program_cost'),
                    'target_recipients' => $this->input->post('target_recipients'),
                    'liveliood_program_status' => $this->input->post('liveliood_program_status'), 
                    );

            $result = $this->LivelihoodModel->createLivelihoodProgram($data);
            if($result){
                redirect('Livelihood/tagExternalOrganization/id/'.$result['id']);
            }else{
                echo "error encountered".$result;
            }

    }
    function addLivelihoodResource(){
        $data = array(
                'livelihood_program_id'=> $this->input->post('program_id'),
                'livelihood_resource_id'=>$this->input->post('resource_id'),
                'quantity_available'=>$this->input->post('resource_quantity'));
        
        $this->LivelihoodModel->addLivelihoodProgramResource($data);

        return $this->getProgramResourcesTable($this->input->post('program_id'));
    }
    function getProgramResourcesTable($id){

        $resources = $this->LivelihoodModel->getLivelihoodProgramResources($id);
        if($resources){
            echo "<table class=\"table table-striped\">";
            echo "<tr><th>Resource Description</th><th>Quantity Available</th><th>Actions</th></tr>";
            foreach ($resources as $resource) {
                        
                        echo "<tr><td>".$resource->livelihood_resource_description.
                        "</td><td>".$resource->quantity_available."</td>
                        <td><a href=\"#\" class=\"confirm-delete\" data-name=\"".$resource->livelihood_program_resource_id."\" data-id=".$resource->livelihood_program_resource_id."><i class=\"icon-trash\"></i></a>
                        <a class=\"confirm-edit\" align=\"center\" href=viewLivelihooodProgram/id/".$resource->livelihood_program_resource_id."><i class=\"icon-search\"></i></a>
                        </td></tr>";
            } 
            echo "</table>";
        }
        else{
            echo "unable to fetch livelihood program resources";
        }
        
    }
    function getAllOrganizationRequestsTable($id){
        $requests= $this->LivelihoodModel->getAllOrganizationRequests($id);
        echo "<tr><th>Request Status</th><th>Request Description</th><th>Date Requested</th><th>Date Granted</th><th>Livelihood Description</th><th>Livelihood Type</th><th>Actions</th></tr>";
        foreach ($requests as $request) {
                    echo "<tr><td>".$request->request_status.
                    "</td><td>".$request->request_description."</td>
                    <td>".$request->date_requested."</td>
                    <td>".$request->date_granted."</td>
                    <td>".$request->livelihood_description."</td>
                    <td>".$request->livelihood_type."</td>
                    <td><a class=\"btn btn-danger cancel-request\" align=\"center\" data-id=".$request->livelihood_organization_program_request_id." ><i class=\"icon-trash\"></i>cancel</a>
                    </td></tr>";
        }  
    }
    function deployLivelihoodResource(){
        $quantities = json_decode($_POST['quantities']);
        $resources = json_decode($_POST['resources']);
        $program_resources = json_decode($_POST['program_resources']);
        $program_id = $_POST['program_id'];
        $org_id = $_POST['org_id'];
        
        $itemCount = count($quantities);
        $grant_id = $this->LivelihoodModel->grantLivelihoodProgram($program_id, $org_id);

        for($i=0;$i<$itemCount;$i++){
            $this->LivelihoodModel->deployToLivelihoodOrg($grant_id,$resources[$i],$quantities[$i], $program_resources[$i]);
            echo "resource id:".$resources[$i]."  resource quantity:".$quantities[$i];
        }

    }
    function approveLivelihoodRequest(){
        $this->load->helper('date');
        $quantities = json_decode($_POST['quantities']);
        $resources = json_decode($_POST['resources']);
        $program_resources = json_decode($_POST['program_resources']);
        $program_id = $_POST['program_id'];
        $org_id = $_POST['org_id'];
        $request_id = $_POST['request_id'];
        $grant_date = date('Y-m-d H:i:s',now());
        
        $itemCount = count($quantities);

        for($i=0;$i<$itemCount;$i++){
            $this->LivelihoodModel->grantResourceToRequest($request_id,$resources[$i],$quantities[$i], $program_resources[$i]);
            echo "resource id:".$resources[$i]."  resource quantity:".$quantities[$i];
        }

        $this->LivelihoodModel->approveLivelihoodProgramRequest($request_id, $grant_date);
    }
    function tagExternalOrganization(){
        $get = $this->uri->uri_to_assoc();
        $data['livelihood_program'] = $this->LivelihoodModel->getLivelihoodProgram($get['id']);
        $data['external_organizations'] = $this->LivelihoodModel->getAllExternalOrganizations();
        $data['tagged_external_organizations'] = $this->LivelihoodModel->getTaggedExternalOrganizations($get['id']);
        $data['resources'] = $this->LivelihoodModel->getAllLivelihoodResources();
        $data['program_resources'] = $this->LivelihoodModel->getLivelihoodProgramResources($get['id']);
        $data['pending_requests'] = $this->LivelihoodModel->getAllPendingRequests($get['id']);
        $data['livelihood_organizations_not_requested'] = $this->LivelihoodModel->getAllLivelihoodOrgsNotRequested($get['id']);
        $data['recipients'] = $this->LivelihoodModel->getAllRecipients($get['id']);
        //$data['requests'] = $this->LivelihoodModel->getLivelihoodRequests($get['id']);
        //$data['external_organizations'] = $this->LivelihoodModel->getExternalOrganizations($get['id']);
        $this->load->view('includes/header');
        $this->load->view('tagExternalOrganization',$data);
        $this->load->view('includes/footer');
    }
    function viewAllLivelihoodPrograms(){
        $data['livelihood_programs'] = $this->LivelihoodModel->getAllLivelihoodPrograms();
        $this->load->view('includes/header');
        $this->load->view('livelihoodProgramsView',$data);
        $this->load->view('includes/footer');
    }
    function viewAvailableLivelihoodPrograms(){
        $data['livelihood_programs'] = $this->LivelihoodModel->getAllAvailableLivelihoodPrograms();
        $this->load->view('includes/header');
        $this->load->view('availableLivelihoodProgramsView',$data);
        $this->load->view('includes/footer');
    }
    function sendLivelihoodRequest(){
        $this->load->helper('date');
        $data = array(
                'livelihood_organization_id' => $this->input->post('organization_id'),
                'livelihood_program_id' => $this->input->post('program_id'),
                'request_status' => 'pending',
                'request_description' => $this->input->post('request_description'),
                'date_requested' => date('Y-m-d H:i:s',now())
                );
        $this->LivelihoodModel->sendLivelihoodRequest($data);
    }
    function cancelLivelihoodRequest(){
        $requestId = $this->input->post('request_id');
        $organizationId = $this->input->post('org_id');
        $this->LivelihoodModel->cancelLivelihoodRequest($requestId);

        return $this->getAllOrganizationRequestsTable($organizationId);
    }
    function deployLivelihoodProgramFromList(){

        $get = $this->uri->uri_to_assoc();
        $data['livelihood_program'] = $this->LivelihoodModel->getLivelihoodProgram($get['id']);
        $data['pending_requests'] = $this->LivelihoodModel->getAllPendingRequests($get['id']);
        $data['livelihood_organizations_not_requested'] = $this->LivelihoodModel->getAllLivelihoodOrgsNotRequested($get['id']);
        $data['recipients'] = $this->LivelihoodModel->getAllRecipients($get['id']);
        $data['program_resources'] = $this->LivelihoodModel->getDeployableLivelihoodProgramResources($get['id']);
        $this->load->view('includes/header');
        $this->load->view('livelihoodProgramDeploymentList',$data);
        $this->load->view('includes/footer');
    }
    function tagExternalOrganizations(){
        $organizations = json_decode($_POST['testData']);
        $program_id = $_POST['programId'];
        foreach ($organizations as $organization) {
            $this->LivelihoodModel->tagExternalOrganization($program_id,$organization);
        }

        echo $this->getTaggedOrganizations($program_id);

    }
    function getTaggedOrganizations($program_id){

        $result = $this->LivelihoodModel->getTaggedExternalOrganizations($program_id);
        if($result){
            echo "<div class = \"well offset3 span4\">";
            echo "<h4>External Organization Provider/s</h4>";
            echo "<table class=\"table table-striped\">";
            echo "<tr><th>Agency Name</th><th>Agency Address</th><th>Contact Information</th><th>Actions</th></tr>";
          
           foreach ($result as $row) {
                echo "<tr><td>".$row->agency_name."</td><td>".$row->agency_address."</td><td>".$row->contact_number."</td><td></td></tr>";
           }  
           echo "</table></div>";
        }
        else{
            echo "error encountered"+$result;
        }
    }
    function viewAllExternalOrganizations(){
        $data['external_organizations'] = $this->LivelihoodModel->getAllExternalOrganizations();
        $this->load->view('includes/header');
        $this->load->view('externalOrganizationsView',$data);
        $this->load->view('includes/footer');
    }
    function viewLivelihooodProgram(){

        $get = $this->uri->uri_to_assoc();
        $data['livelihood_program'] = $this->LivelihoodModel->getLivelihoodProgram($get['id']);
        $data['external_organizations'] = $this->LivelihoodModel->getAllExternalOrganizations();
        $data['tagged_external_organizations'] = $this->LivelihoodModel->getTaggedExternalOrganizations($get['id']);
        $data['resources'] = $this->LivelihoodModel->getAllLivelihoodResources();
        $data['program_resources'] = $this->LivelihoodModel->getLivelihoodProgramResources($get['id']);
        $data['pending_requests'] = $this->LivelihoodModel->getAllPendingRequests($get['id']);
        $data['livelihood_organizations_not_requested'] = $this->LivelihoodModel->getAllLivelihoodOrgsNotRequested($get['id']);
        $data['recipients'] = $this->LivelihoodModel->getAllRecipients($get['id']);
        $this->load->view('includes/header');
        $this->load->view('livelihoodProgramView',$data);
        $this->load->view('includes/footer');
        
    }
    function manageBarangayResources(){

        $get = $this->uri->uri_to_assoc();
        $data['barangay'] = $this->LivelihoodModel->getBarangay($get['id']);
        $data['physicalResources'] = $this->LivelihoodModel->getBarangayResource($get['id'],'1');
        $data['naturalResources'] = $this->LivelihoodModel->getBarangayResource($get['id'],'2');
        $data['humanResources'] = $this->LivelihoodModel->getBarangayResource($get['id'],'3');
        $data['socialResources'] = $this->LivelihoodModel->getBarangayResource($get['id'],'4');
        $data['financialResources'] = $this->LivelihoodModel->getBarangayResource($get['id'],'5');
        $this->load->view('includes/livelihoodHeader');
        $this->load->view('barangayResourceView',$data);
        $this->load->view('includes/livelihoodFooter');
        
    }
    function addBarangayResource(){
        $data = array(  'resource_id' => $this->input->post('resource_id'),
                        'location_id' => $this->input->post('location_id'),
                        'location_resource_quantity' => $this->input->post('quantity'),
                        'location_resource_description' => $this->input->post('description')
                    );
        
        $this->LivelihoodModel->addBarangayResource($data);
        return $this->displayBarangayResourceTable($this->input->post('location_id'), $this->input->post('resource_id'));
        

    }
    function displayBarangayResourceTable($location_id, $resource_id){
        $result = $this->LivelihoodModel->getBarangayResource($location_id,$resource_id);
        echo "<tr><th>Resource Description</th><th>Resource Quantity</th><th>Actions</th></tr>";
        foreach ($result as $r) {
                echo "<tr>
                <td>".$r->location_resource_description."</td>
                <td>".$r->location_resource_quantity."</td>
                <td>
                <a href=\"#\" class=\"confirm-delete\" data-name=\"".$r->location_resource."\" data-id=".$r->location_resource.">
                <i class=\"icon-trash\"></i></a>
                </td></tr>";
        }  
    }
    function getAllLivelihoodProgramsCheckboxList(){
        $programs = $this->LivelihoodModel->getAllLivelihoodPrograms();

       foreach ($programs as $program) {
                echo "<label class='checkbox'><input type='checkbox' data-id=".$program->livelihood_program_id.">".$program->livelihood_description."</input></label>";
        }
    }
    function constructLivelihoodProgramResourceForm(){
        $id = $this->input->post('program_id');
        $program_resources = $this->LivelihoodModel->getLivelihoodProgramResources($id);

        echo "<form class='form-horizontal'>";
              foreach ($program_resources as $resource) {
                echo "  <label class=\"control-label\">".$resource->livelihood_resource_description."   (".$resource->quantity_available.")</label>
                            <div class=\"controls resourceInput\">
                                <input type=\"number\" min=\"0\" max=\"".$resource->quantity_available."\"data-id=\"".$resource->livelihood_resource_id."\" data-resource=\"".$resource->livelihood_program_resource_id."\">
                            </div><br>";

            }
            
        echo "</form>";
    }
    function registerExternalOrganization(){

        $this->load->view('includes/header');
        $this->load->view('addExternalOrganization');
        $this->load->view('includes/footer');
    }
    function addExternalOrganization(){
        $data = array(
                    'agency_name' => $this->input->post('agency_name'),
                    'agency_address' => $this->input->post('agency_address'),
                    'contact_number' => $this->input->post('contact_number')
                    );

        $result = $this->LivelihoodModel->createExternalOrganization($data);
        if($result){
            redirect('Livelihood/viewAllExternalOrganizations');
        }else{
            echo "error on query".$result;
        }
    }
    function addTagExternalOrganization(){
        $data = array(
                    'agency_name' => $this->input->post('agency_name'),
                    'agency_address' => $this->input->post('agency_address'),
                    'contact_number' => $this->input->post('contact_number')
                    );
        $livelihood_program_id = $this->input->post('program_id');

        $external_organization_id = $this->LivelihoodModel->createExternalOrganization($data);
        $this->LivelihoodModel->tagExternalOrganization($livelihood_program_id,$external_organization_id);
        
        $result = $this->LivelihoodModel->getTaggedExternalOrganizations($livelihood_program_id);

        if($result){
            echo "<div class = \"well offset3 span4\">";
            echo "<h4>External Organization Provider/s</h4>";
            echo "<table class=\"table table-striped\">";
            echo "<tr><th>Agency Name</th><th>Agency Address</th><th>Contact Information</th><th>Actions</th></tr>";
          
           foreach ($result as $row) {
                echo "<tr><td>".$row->agency_name."</td><td>".$row->agency_address."</td><td>".$row->contact_number."</td><td></td></tr>";
           }  
           echo "</table></div>";
        }
        else{
            echo "error encountered"+$result;
        }

    }
    function fetchApprovedAndPendingRequests($programId){

        $approvedRequests = $this->LivelihoodModel->getAllApprovedRequests($programId);
        $pendingRequests = $this->LivelihoodModel->getAllPendingRequests($programId);

        if($approvedRequests){
            echo "<div class = \"well offset1 span11\">";
            echo "<h5>Approved Requests:</h5>";
            echo "<table class=\"table table-striped\">";
            echo "<tr><th>Livelihood Organization Name</th><th>Business Activity Type</th><th>Request Status</th><th>Request Description</th><th>Date Requested</th><th>Date Granted</th></tr>";
          
           foreach ($approvedRequests as $row) {
                echo "<tr><td>".$row->livelihood_organization_name."</td><td>".$row->business_activity_type."</td><td>".$row->request_status."</td><td>".$row->request_description."</td><td>".$row->date_requested."</td><td>".$row->date_granted."</td></tr>";
           }  
           echo "</table></div><br>";
        }
        else{
            echo "error encountered"+$result;
        }

        if($pendingRequests){
            echo "<div class = \"well offset1 span11\">";
            echo "<h5>Pending Requests:</h5>";
            echo "<table class=\"table table-striped\">";
            echo "<tr><th>Livelihood Organization Name</th><th>Business Activity Type</th><th>Request Status</th><th>Request Description</th><th>Date Requested</th></tr>";
          
           foreach ($pendingRequests as $row) {
                echo "<tr><td>".$row->livelihood_organization_name."</td><td>".$row->business_activity_type."</td><td>".$row->request_status."</td><td>".$row->request_description."</td><td>".$row->date_requested."</td></tr>";
           }  
           echo "</table></div>";
        }
        else{
            echo "error encountered"+$result;
        }
    }

    function grantLivelihoodProgram(){
        $programId = $this->input->post('program_id');
        $organizationId = $this->input->post('organization_id');
        $result = $this->LivelihoodModel->grantLivelihoodProgram($programId, $organizationId);

        return $result;
    }
    function testEditable(){
         $result = $this->LivelihoodModel->updateMemberEditable($this->input->post('pk'), $this->input->post('name'), $this->input->post('value'));
         if($result){
            echo "can be any string";
         }
         else{
            header('HTTP 400 Bad Request', true, 400);
            echo "error encountered";
         }
        
    }


}

