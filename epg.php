<?php
require_once('./common.php');

$query = preg_split('/&/', $_SERVER['QUERY_STRING']);
foreach ($query as $key => $value){
    $paras = preg_split('/=/', $value);
    $channel[$paras[0]] = $paras[1];
}
$query_date = preg_split('/\//', $channel['d']);
$time = mktime(0,0,0,$query_date[1],$query_date[2],$query_date[0]);
$dayofweek = date('w', $time);
if($dayofweek == 0) { $dayofweek = 7; }


$cntvchannel = $tvmao2cctv[$channel['c']];
$cntvurl = "http://tv.cntv.cn/index.php?action=epg-list&date=".date('Y-m-d', $time)."&channel=".$cntvchannel;
$cntvepghtml = download($cntvurl, "http://tv.cntv.cn/epg");
preg_match_all('/(<a class="p_name" href="###">|<a target="_blank" href="\/live\/[^>]+" class="p_name_a">)([^<]+?)</i', $cntvepghtml, $matches);
preg_match('/<li class="cur" rel="([^<]+?)">.*\n.*<h3><a href="javascript:;">([^<]+?)</i', $cntvepghtml, $weekday);
$playItems = array_merge(array($weekday[1]." ".$weekday[2]), $matches[2]);
#print_r($playItems);

$xmlDoc = new DOMDocument('1.0', 'UTF-8');
$xml_channel = $xmlDoc->createElement( "channel" );
$xml_channel->setAttribute( "name", $channel['c'] );
$xml_channel->setAttribute( "date", array_shift($playItems) );
foreach ($playItems as $key => $value){
    $xml_tv = $xmlDoc->createElement( "tv" );
    $epg = preg_split('/ /',$value);
    $xml_tv->setAttribute( "time", $epg[0] );
    $xml_tv->setAttribute( "program", implode(array_slice($epg, 1)));
    $xml_channel->appendChild($xml_tv);
}

$xmlDoc->appendChild($xml_channel);
echo $xmlDoc->saveXML();

?>
