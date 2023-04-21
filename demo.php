<?php
// 引入相应的类别

use Sup\Utils\SupArr;

include_once __DIR__.'/vendor/autoload.php';

$arr = array('', 'test ', '  ');
echo "<pre>";
var_dump($arr);
var_dump(SupArr::removeEmpty($arr)); 
echo "</pre>";
var_dump("----------------------------------------------------------");
$rows = array(
    array('id' => 1, 'value' => '1-1'),
    array('id' => 2, 'value' => '2-1'),
);
echo "<pre>";
var_dump($rows);
var_dump(SupArr::getCols($rows,'value')); 
echo "</pre>";
?>
