<?php
// @RiyanCoday //
error_reporting(0);
function read ($length='255') 
{ 
   if (!isset ($GLOBALS['StdinPointer'])) 
   { 
      $GLOBALS['StdinPointer'] = fopen ("php://stdin","r"); 
   } 
   $line = fgets ($GLOBALS['StdinPointer'],$length); 
   return trim ($line); 
}
function curl($url,$use,$data){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	 $h = array();
    $h[] = "Host: e.gift.id";
    $h[] = "Connection: keep-alive";
    $h[] = "Accept: application/json, text/plain, */*";
    $h[] = "Origin: https://e.gift.id";
    $h[] = "Save-Data: on";
    $h[] = "User-Agent: Mozilla/5.0 (Linux; Android 6.0.1; Redmi Note 4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.80 Mobile Safari/537.36";
    $h[] = "Content-Type: application/json;charset=UTF-8";
    $h[] = "Referer: https://e.gift.id/u/16281bqpoj662";
    $h[] = "Accept-Language: en-US,en;q=0.9,id;q=0.8";
    curl_setopt($ch, CURLOPT_HTTPHEADER, $h);
    if($use) {
			curl_setopt($ch, CURLOPT_POST, 0);
curl_setopt($ch, CURLOPT_COOKIEJAR, "coday");
	}else{	curl_setopt($ch, CURLOPT_POST, 1);
}   curl_setopt($ch, CURLOPT_COOKIEFILE, "coday");
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $x = curl_exec($ch);
    curl_close($ch);
    return $x;
}

	
echo "Codenya Apa Bos Coday ? ";
$s = read();
echo "Tokopedia[1] atau Alfamart[2] Bos Coday ? ";
$type = read();
	if($type == 1){
		$type = 8346;
	}else{
		$type = 1662;
	}
$url = 'https://e.gift.id/api/egifts/redemption_external/'.$type.'/'.$s;
$data = '{"terminalId":"external","recaptchaToken":"03ADlfD18KExMdp8DLa_jmfxzjjMqI2ek8fKsIGCrBBrNxo9Hi3Pka00MfJYW0f1kWAHaKRE5MtJwgQQsw2PcOuCT8-jJxSaM_zao4JU51Xab94LNi-tWkwJYQ_pPqZOH1Om88XYGDie3pJB1SjwRAT9Hcyq39nvaUe41tcfAVACFgZI7lttiZcb44I8dBvEh0lzNhvcHPgi9QT77P290BnqbGUHuNDc87pgJhmU5p6l0ULcTkSn7A7NZPY3afBz5R6UrJcoLRLSm8zIqhwNFVtWFS7ryvDYyCNw"}';
$dat = curl($url,0,$data);
//echo $dat;
    if(stripos($dat,"Bad gateway")){
echo "Renew Cookie";
        $cookie = curl("https://e.gift.id/u/837qsoynaz546?fbclid=XXXXX",1,0);
 }else{
	 $c = json_decode($dat);
if (stripos($dat, 'has banned your IP address')) {
		echo'BANNED IP => Num: '.$s.' ['.$type.']';echo "\n";
}elseif($c->body->message == "eVoucher is already used"){
	echo 'Sudah diClaim => Num: '.$s.''; echo "\n";
}elseif($c->body->replyCardStatus == "active"){
		echo 'Belum diClaim => Num: '.$c->body->replyCardNo.' | Rp.'.$c->body->replyCardBalance.' | Code: '.$c->body->external_number->number.'';echo "\n";
}elseif($c->body->message == "eVoucher not found or expired"){
		echo 'Sudah Mati/Voucher tidak ada => Num: '.$s.' ['.$type.']';echo "\n";
}else{
	echo'Error => Num: '.$s.'';echo "\n";
}
        }