<?php
class DrawingToolController extends  CI_Controller
{
	public function index(){
		/**
		$this->load->library('googlemaps');
		$this->load->model('PolygonModel');
		$res=$this->PolygonModel->getPolyPoints();

		$config['center'] = '8.228021,124.245242';
		$config['zoom'] = '12';
		$this->googlemaps->initialize($config);

		
		if($res->num_rows()>0)
		{
			foreach($res->result() as $row)
			{
				$coordinates_array=explode(";",$row->poly_points);
				$polygon=array();
				$points=array();
				
				foreach ($coordinates_array as $element) {
						
						array_push($points, $element);
						//echo $element;
						//echo "<br>";	
					
				}
				$polygon['points']=$points;
				echo count($polygon);
				$polygon['strokeColor'] = '#000099';
				$polygon['fillColor'] = '#000099';
				
				$this->googlemaps->add_polygon($polygon);
				//$data[]=$row;
			}

			$data['map']=$this->googlemaps->create_map();
			*/
			$this->load->view('drawToolPolygon');
		


		//$this->load->view('');
	}
}

?>