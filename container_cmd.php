<?php

include 'config.php';
date_default_timezone_set('UTC');
if(isset($_POST['ctnerId']) && isset($_POST['cmd'])){
	$ctnerIdArr=explode(' ',trim($_POST['ctnerId']));
	foreach ($ctnerIdArr as  $ctnerId) {
		$url= DOCKER_URL.'/containers/'.$ctnerId.'/'.trim($_POST['cmd']);
		$statusCode=dk_post($url);
	}
	echo $statusCode;
}

// echo dk_post('http://192.168.1.104:2375/containers/'.trim($_POST['ctnerId']).'/'.trim($_POST['cmd']));

// print_r($_POST);


	
function dk_post($url, $postdata='', $header=array(), $file=null){
	$ch=curl_init();
	$opt=array(
		CURLOPT_URL => $url,
		CURLOPT_HEADER => false,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_HTTPHEADER => $header,
		CURLOPT_POSTFIELDS => $postdata,
		CURLOPT_RETURNTRANSFER => true,
	);
	curl_setopt_array($ch,$opt);
	curl_exec($ch);
	//获取响应状态码
	$code=curl_getinfo($ch,CURLINFO_HTTP_CODE);
	curl_close($ch);
	return $code;
}



