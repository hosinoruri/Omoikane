<?php
class Getmodel extends CI_Model
{
			function getmodel(){
					parent::__construct();
					$this->load->database();
				}
			function getNovelName($novel_id){
					$this->db->where('user_username',$username);
					$this->db->select('user_username');
					$query=$this->db->get('user')->result();
					return $query;
				}
}
//end of this file