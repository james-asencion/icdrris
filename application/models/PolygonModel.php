<?php

class PolygonModel extends CI_Model
{
	public function getPolyPoints(){

		$q=$this->db->query('SELECT poly_points FROM barangays WHERE id=1');

		/**
		if($q->num_rows()>0)
		{
			foreach($q->result() as $row)
			{
				$data[]=$row;
			}

			return $data;
		}
		*/
		return $q;

	}	
}

?>