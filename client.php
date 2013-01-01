<?php
if(isset($_POST['data'])){
	mysql_connect('localhost', 'root', '');
	mysql_select_db('bluetooth-attendance');

	//$json = '{"3":{"addr":"B0:89:91:74:1A:95","name":"LG-T300"},"2":{"addr":"AE:2D:22:00:FF:00","name":"WOLFDALE"},"1":{"addr":"00:22:15:F8:2D:D4","name":"SPONDBOB-PC"},"0":{"addr":"AE:2D:22:00:FF:00","name":"WOLFDALE"}}';
	$data = json_decode($_POST['data']);
	$values = '';
	foreach($data as $r){
		$values .= "('','".$r->addr."','1',NOW()), ";
	}

	$values = substr($values,0,(strlen($values) - 2));
	mysql_query("insert into attendance values ".$values."");
}else{
	echo 'what?';
}
?>
