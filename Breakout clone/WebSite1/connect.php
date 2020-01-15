<?php
    /***************************
     4105056019 許睦昆 期末專題6/29
    ***************************/
$host='localhost';
$dbuser='root';
$dbpw='xxxxxxxxxxxx';
$dbname='my_db';
$link=mysqli_connect($host,$dbuser,$dbpw,$dbname);
if($link){
    mysqli_query($link,"SET NAMES utf8");
    echo '連線成功';
}
else
echo '連線失敗';
?>
