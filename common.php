<?php
# epg link for cctv
$tvmao2cctv = array(
                    "AHTV1" => "anhui",
                    "BTV1" => "btv1",
                    "BTV6" => "btv6",
                    "BTV9" => "btv9",
                    "CCQTV1" => "chongqing",
                    "CCTV1" => "cctv1",
                    "CCTV2" => "cctv2",
                    "CCTV4" => "cctv4",
                    "CCTV5" => "cctv5",
                    "CCTV5-PLUS" => "cctv5plus",
                    "CCTV6" => "cctv6",
                    "CCTV7" => "cctv7",
                    "CCTV9" => "cctvjilu",
                    "CCTV10" => "cctv10",
                    "CCTV12" => "cctv12",
                    "CCTV13" => "cctv13",
                    "CCTV15" => "cctv15",
                    "CCTVAMERICAS" => "cctvamerica",
                    "CCTVEUROPE" => "cctveurope",
                    "cctvgaowang" => "cctvgaowang",
                    "cctvzhengquanzixun" => "cctvzhengquanzixun",
                    "DONGFANG1" => "dongfang",
                    "FJTV2" => "dongnan",
                    "GDTV1" => "guangdong",
                    "GSTV1" => "gansu",
                    "GUANXI1" => "guangxi",
                    "GUIZOUTV1" => "guizhou",
                    "HEBEI1" => "hebei",
                    "HKS" => "xianggangweishi",
                    "HLJTV1" => "heilongjiang",
                    "HNTV1" => "henan",
                    "HUBEI1" => "hubei",
                    "HUNANTV1" => "hunan",
                    "JILIN1" => "jilin",
                    "JSTV1" => "jiangsu",
                    "JXTV1" => "jiangxi",
                    "LNTV1" => "liaoning",
                    "NMGTV1" => "neimenggu",
                    "NXTV2" => "ningxia",
                    "QHTV1" => "qinghai",
                    "SCTV1" => "sichuan",
                    "SDTV1" => "shandong",
                    "SHXITV1" => "shan3xi",
                    "SXTV1" => "shan1xi",
                    "SZTV1" => "shenzhen",
                    "TJTV1" => "tianjin",
                    "XIZANGTV2" => "xizang",
                    "YNTV1" => "yunnan",
                    "ZJTV1" => "zhejiang",
                   );

function download($url, $referer = null, $post = null, $retries = 3) {
    $curl = curl_init();                           
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:28.0) Gecko/20100101 Firefox/28.0');
    curl_setopt($curl, CURLOPT_REFERER, $referer);

    if(isset($post) === true){
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, (is_array($post) === true) ? http_build_query($post, "", "&"): $post);
    }

    $data = false;
    while(($data === false) && (--$retries > 0)){
        $data = curl_exec($curl);                    
    }
    curl_close($curl);                             

	return $data;                                   
}                                                                                       
                                                                                                
?>
