<?php

include ("simple_html_dom.php");

$curl = curl_init();
$resultList = [];
$result = null;
$pagination = [0,10,20,30];

foreach ($pagination as $page){

    curl_setopt($curl,CURLOPT_URL,"http://www.google.com/search?q=coding+ninjas&start=$page");
    curl_setopt($curl,CURLOPT_FOLLOWLOCATION,true);
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
    $result = curl_exec($curl);
    curl_close($curl);

    $domResult = new simple_html_dom();
    $domResult->load($result);

    foreach ($domResult->find( '.BNeawe.UPmit.AP7Wnd'  ) as $link){
        $resultList[] = $link->plaintext;
    }
}

echo "<ol>";
foreach ($resultList as $topResult){
    echo "<li> $topResult </li>";
}
echo "</ol>";

$file = dirname(__FILE__) . '/updatedTime.txt';

$data = "Updated at " . date('d/m/Y H:i:s') . "\n";

file_put_contents($file,$data,FILE_APPEND);


