<?php

/* 
 * This project is licensed to team-dasig 2013
 * James R. Asencion  * 
 * Czareannah Leigh S. Villanca  * 
 * Femarie C. Manga  * 
 */

class Home extends  CI_Controller
{
	function index()
	{   //first initialization of login form
            //$data= $this->countIncidents();
            $this->load->view('includes/header');
            $this->load->view('login_form'); 
            $this->load->view('polyHome');
            $this->load->view('includes/footer'); 
	}   
       
        function countIncidents(){
            
            $config = array();
            $config["base_url"] = base_url() . "home";
            $this->load->model("IncidentModel");
            $total_rows = $this->IncidentModel->totalIncidents();
            $config["total_rows"] = $total_rows;
            $config["per_page"] = 5;
           // $config["uri_segment"] = 3;
        
            $this->pagination->initialize($config);
          //  $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
          //  $data["results"] = $this->IncidentModel->
           // fetch_countries($config["per_page"], $page);
            $data["links"] = $this->pagination->create_links();
            $data['total_rows'] = $total_rows;
 
          //  $this->load->view("example1", $data);
         //   $this->load->model('IncidentModel');
         //   $resuxlt=$this->IncidentModel->totalIncidents();
               
            return $data;
        }
        
}

