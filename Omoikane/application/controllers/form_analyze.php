<?php
/*
使用方法：copy想要hack的网站的表单页面，把form action替换成这个form_analyze.php，通过填写那个被copy的网站表单，
可以分析出它最后post到服务器的结果，即使它被JavaScript弄得很乱，或者HTML结构很差。
*/
/*ini_set("error_reporting",E_ALL ^ E_NOTICE);
setcookie("SET BY THIS PAGE","This is a diagnostic cookie");*/
?>
<head>
	<title>HTTP Request Diagnostic Page</title>
	<style type="text/css">
	p{color: black;font-weight: bold;font-size: 110%;font-family: arial}
	.title{color: black;font-weight: bold;font-size: 110%;font-family: arial}
	.text{font-weight: normal;font-size: 90%;}
	TD{color: black;font-size: 100%;font-family: courier;vertical-align: top;}
	.column_title{color: black;font-size: 100%;background-color: eeeeee;font-weight: bold;font-family: arial}
	</style>
</head>

<p class="title">Webbot analyze Page</p>
<p class="text">This web page is a tool to diagnose webbot functionality by examining what the webbot sends to webservers.</p>
<table border="1" cellspacing="0" cellpadding="3" width="800">
	<tr class="column_title">
		<th width="25%">Variable</th>
		<th width="75%">Value sent to server</th>
	</tr>
	<tr>
		<td>HTTP Request Method</td><td><?php echo $_SERVER["REQUEST_METHOD"];?></td>
	</tr>
	<tr>
		<td>Your IP Address</td><td><?php echo $_SERVER["REMOTE_ADDR"];?></td>
	</tr>
	<tr>
		<td>Server Port</td><td><?php echo $_SERVER["SERVER_PORT"];?></td>
	</tr>
	<tr>
		<td>Referer</td>
		<td>
			<?php
			if(isset($SERVER["HTTP_REFERER"])){
				echo $_SERVER["HTTP_REFERER"];
			}
			else{
				echo "NULL<br>";
			}
			?>
		</td>
	</tr>
	<tr>
		<td>Agent Name</td>
		<td>
			<?php
				if (isset($_SERVER['HTTP_USER_AGENT'])) {
					echo $_SERVER['HTTP_USER_AGENT'];
				}
				else{
					echo "NULL<br>";
				}
			?>
		</td>
	</tr>
	<tr>
		<td>Get Variables</td>
		<td>
			<?php
			if (count($_GET)>0) {
				var_dump($_GET);
			}
			else{
				echo "NULL";
			}
			?>
		</td>
	</tr>
	<tr>
		<td>Post Variables</td>
		<td>
			<?php
			if (count($_POST)>0) {
				var_dump($_POST);
			}
			else{
				echo "NULL";
			}
			?>
		</td>
	</tr>
	<tr>
		<td>Cookies</td>
		<td><?php
		if (count($_COOKIE)>0) {
			var_dump($_COOKIE);
		}
		else{
			echo "NULL";
		}
		?>
		</td>	
	</tr>
</table>
<p class="text">This Web page also sets a diagnotic cookie,which should be visible the second time you access this page</p>