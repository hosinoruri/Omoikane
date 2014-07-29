<?php
class InsertModel extends CI_Model
{
	function insertmodel()
	{
		parent::__construct();
		$this->load->database();
	}
	function insert_Novel($data)
	{
		$this->db->insert('novel',$data);
	}
}
//end of this file