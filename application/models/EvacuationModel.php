<?php

class EvacuationModel extends CI_Model
{
	 
        function registerEvacuationSite($data){
            $result = $this->db->insert('evacuation_sites',$data);
            if($result){
                return true;
            }else{
                return false;
            }
        }
        // function getEvacuationSite($id){
        //     $this->db->where('evacuation_site_id', $id);
        //     $query = $this->db->get('evacuation_sites');
        //     return $query->result();
        // }
        function getEvacuationSite($id){
            $query = $this->db->query(" SELECT e.evacuation_site_id, e.evacuation_site_name, e.site_maximum_capacity, e.current_evacues_count, e.evacuation_site_status, e.evacuation_site_lat, e.evacuation_site_lng, l.location_address
                                    FROM evacuation_sites e
                                    LEFT JOIN locations l
                                    ON l.location_id = e.location_id
                                    WHERE e.evacuation_site_id = '$id';");
            return $query->row();
        }
}

?>
