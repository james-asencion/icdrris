<?php 

class HashTweets extends CI_Model{

	function saveHashTweets($id,$screen_name,$time,$text){
		$sql = "INSERT INTO `twitter` (`id`,`screen_name`,`time`,`text`,`hidden`) VALUES ('$id','$screen_name','$time','$text','n')";
		$query= $this->db->query($sql);
		if($query){ 
			return true; 
		}
       else{ 
			return false;
       }
	}
	
	function displaySavedTweets(){
		$sql = "SELECT * FROM `twitter` WHERE `hidden` != 'y' ORDER BY `time` DESC LIMIT 10";
		$query= $this->db->query($sql);
			if($query){ 
				return $query; 
			}
		   else{ 
				return false;
		   }
	}

}

?>