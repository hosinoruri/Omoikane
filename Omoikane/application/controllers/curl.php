<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Curl extends CI_Controller 
{
	public function index()
	{
		include ("application/libraries/LIB_http.php");
		include ("application/libraries/LIB_parse.php");
		$ref="http://www.wenku8.cn";
		$method="GET";
		$this->load->model("insertmodel");
		$success="Catch OK";
		for ($xx=1; $xx < 1700; $xx++)
		{ 
			$target='http://www.wenku8.cn/wap/article/packshow.php?id='.$xx.'&type=txtfull';
			$web_page=http_get($target,$ref);
			//novel_name
			$label='<card';
			$meta_tag_array=parse_array($web_page['FILE'],$label,">");
			$meta_tag_array=str_replace(" ","",$meta_tag_array);
			$meta_tag_array=str_replace("-","",$meta_tag_array);
			$meta_tag=split_string($meta_tag_array[0],"title=\"",AFTER,EXCL);
			$novel_name=strip_tags(split_string($meta_tag,"TXT",BEFORE,EXCL));
			//update_time
			preg_match_all("/\d{4}-\d{1,2}-\d{1,2}/",@$web_page['FILE'],$matches_array);
			foreach ($matches_array[0] as $key => $value) 
			{
				$update_time=$value;
			}
			echo $update_time;
			//size
			preg_match_all("/\d+K/",@$web_page['FILE'],$get_array);
			foreach ($get_array[0] as $key => $value) 
			{
				$size=$value;
			}
		     $data = array(
		     	'novel_id' => $xx,
		     	'novel_name' =>empty($novel_name)?'没有这本小说':$novel_name,
		     	'update_time'=>$update_time,
		     	'size'=>$size.K
		     	);
		     //print_r($data);
		     echo "<br>";
		     $this->insertmodel->insert_Novel($data);
		//echo $data;
		}
		$this->load->view('curl_result',$success);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */