<?php
require_once('./common.php');

$query = preg_split('/&/', $_SERVER['QUERY_STRING']);
foreach ($query as $key => $value){
    $paras = preg_split('/=/', $value);
    $channel[$paras[0]] = $paras[1];
}

$query_date = preg_split('/\//', $channel['d']);
$dayback = date('Y-m-d', mktime(0,0,0,$query_date[1],$query_date[2],$query_date[0]));

$time = preg_split('/:/', $channel['t']);

$number = (int)($time[1]/5);
if($number < 10) { $number = "0".$number; }
echo $number + $time[0]*12;

//$channel['c'] = strtolower($channel['c']);
$channel['c'] = $tvmao2cctv[$channel['c']];
if($channel['c'] == "cctv9") { $channel['c'] = "cctvjilu"; }

$xmlDoc = new DOMDocument('1.0', 'UTF-8');
$xml_tvback = $xmlDoc->createElement( "tvback" );
for ($i = 0; $i < 24; $i++){
    if($i < 10) { $i = "0".$i; }
    for ($j = 1; $j < 13; $j++){
        $xml_url = $xmlDoc->createElement( "url" );
        if($j < 10) { $j = "0".$j; }
//        $xml_url->nodeValue = "http://v.cctv.com/flash/live_back/nettv_".$channel['c']."/".$channel['c']."-".$dayback."-".$i."-0".$j.".mp4";
        $xml_url->nodeValue = "http://vod.cntv.lxdns.com/flash/live_back/nettv_".$channel['c']."/".$channel['c']."-".$dayback."-".$i."-0".$j.".mp4";
        $xml_tvback->appendChild($xml_url);
    }
}

$xmlDoc->appendChild($xml_tvback);
file_put_contents($channel['f'], $xmlDoc->saveXML());


?>
