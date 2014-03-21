<?php

/* 
 * This project is licensed to team-dasig 2013
 * James R. Asencion  * 
 * Czareannah Leigh S. Villanca  * 
 * Femarie C. Manga  * 
 */

ini_set('display_errors',1);
error_reporting(E_ALL);

class Recovery extends CI_Controller
{
    public function __construct(){
        parent :: __construct();
        $this->load->model('LivelihoodModel');
    }
    function index()
    {   //first initialization of login form
            //$data= $this->countIncidents();
            $this->load->view('includes/recoveryHeader');
            $this->load->view('RecoveryHome');
            $this->load->view('includes/recoveryFooter'); 
    } 
    // function index(){
    //     $this->load->view('addLivelihoodOrg');
    // }
    function addMembers($orgId){

            $this->load->view('includes/header');
            $this->load->view('addOrgView.php');
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

}

