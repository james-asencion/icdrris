<?php

class MapModel extends CI_Model
{

	public function extractData()
	{



		// Select all the rows in the markers table
		$query = $this->db->get('barangays');
		return $query;

	}	
	
}

?>