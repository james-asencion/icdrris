<?php
class Evacuation extends  CI_Controller
{
	public function __construct() {
		parent:: __construct();
		$this->load->model("EvacuationModel");
	}

	public function index(){
		 //temporary: should display list of incidents
		 $this->load->view('includes/header');
		 $this->load->view('polyHome');
		 $this->load->view('includes/footer');
	}
	public function mapEvacuationSite(){
		$this->load->view('includes/evacuationSiteHeader');
		$this->load->view('evacuationSiteRegistrationView');
		$this->load->view('includes/footer');
	}
	public function saveEvacuationSite(){
		$data = array(
                    'evacuation_site_name' => $this->input->post('evacuation_site_name'),
                    'location_id' => '1',
                    'site_maximum_capacity' => $this->input->post('site_maximum_capacity'),
                    'evacuation_site_status' => $this->input->post('evacuation_site_status'), 
                    'evacuation_site_lat' => $this->input->post('lat'),
                    'evacuation_site_lng' => $this->input->post('lng')
                    );

        $result = $this->EvacuationModel->registerEvacuationSite($data);
        if($result){
        	echo "success";
        }
	}
	function getSiteName(){
		$site = $this->EvacuationModel->getEvacuationSite($this->input->post('id'));
		echo $site->evacuation_site_name;
	}
	function getSiteDetails(){

        $site = $this->EvacuationModel->getEvacuationSite($this->input->post('id'));
        //$site = $query->row();
        

        echo '<h4><div id="incident-title" class="span8" style="color:darkorange">'.$site->evacuation_site_name.'</div></h4>';              

                    echo '<div class="details" style="margin-left: 15px; margin-top: 10px">
                          <div class="row-fluid">
                              <div class="span12">
                                <div id="activityDescriptionLabel" class="span4">Site Address:  </div>
                                <div id="activityDescriptionField" class="span8">'.$site->location_address.'</div>
                              </div>
                          </div>
                          <div class="row-fluid">
                              <div class="span12">
                                <div id="activityDescriptionLabel" class="span4">Maximum Capacity:  </div>
                                <div id="activityDescriptionField" class="span8">'.$site->site_maximum_capacity.'</div>
                              </div>
                          </div>
                        <div class="row-fluid">
                            <div class="span12">
                              <div id="activityStartDateLabel" class="span4">Current Evacues Count:  </div>
                              <div id="activityStartDateField" class="span8">'.$site->current_evacues_count.'</div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                              <div id="activityEndDateLabel" class="span4">Site Status:  </div>
                              <div id="activityEndDateField" class="span8">'.$site->evacuation_site_status.'</div>
                            </div>
                        </div>
                    </div>';
            
    }
}