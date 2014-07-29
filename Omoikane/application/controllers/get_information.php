<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Get_information extends CI_Controller 
{
	public function index()
	{
		$this->load->view('curl_result');
	}
}