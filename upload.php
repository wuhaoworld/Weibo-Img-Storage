<?php
include "config.php";
include "saetv2.ex.class.php";
$c = new SaeTClientV2(WB_AKEY, WB_SKEY, TOKEN);

$img_url = isset($_GET['img_url']) ? $_GET['img_url'] : "";
if($img_url){
	$img_url = urldecode($img_url);
	$ret = $c->upload(time(), $img_url);
	if ( isset($ret['error_code']) && $ret['error_code'] > 0 ) {
		$result['status'] = 'error';
		$result['message'] = 'upload error';
	} else {
		$result['status'] = 'success';
		$result['url'] = $ret['original_pic'];
		$c->delete($ret['id']);
	}
}else{
	$result['status'] = 'error';
	$result['message'] = 'img_url can not be null';
}

header("Content-type: application/json");
echo json_encode($result);
