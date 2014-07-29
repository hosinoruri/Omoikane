<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Omoikane</title>

	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0 15px 0 15px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>
<div id="container">
	<div id="body"><h1>CURL LAB</h1>
<?php
include ("application/libraries/LIB_http.php");
include ("application/libraries/LIB_parse.php");
include ("application/libraries/LIB_thumbnail.php");
//
$ref="http://www.wenku8.cn";
$method="GET";
$this->load->model("insertmodel");
for ($xx=1; $xx < 1800; $xx++) { 
	$target='http://www.wenku8.cn/wap/article/packshow.php?id='.$xx.'&type=txtfull';
	$web_page=http_get($target,$ref);
	//print_r($web_page);
	//<a href="articleinfo.php?id=1200">打工族买屋记</a>
	//$removed_string=remove($web_page，" - TXT","全文下载");
	$label='<card';
	$meta_tag_array=parse_array($web_page['FILE'],$label,">");
	$meta_tag_array=str_replace(" ","",$meta_tag_array);
	$meta_tag_array=str_replace("-","",$meta_tag_array);
	$meta_tag=$meta_tag_array[0];
	//<cardid="packshow.php"title="文学少女TXT全文下载">
	$meta_tag=split_string($meta_tag,"title=\"",AFTER,EXCL);
	$novel_name=split_string($meta_tag,"TXT",BEFORE,EXCL);
	for ($i=0; $i < count($meta_tag); $i++)
	{
     $data = array('novel_id' => $xx,'novel_name' =>$novel_name);
     $this->insertmodel->insert_Novel($data);
	}
}
?>
	</div>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>
</body>
</html>