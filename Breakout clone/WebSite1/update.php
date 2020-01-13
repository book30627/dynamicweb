<?php
require_once 'connect.php'
?>
<!DOCTYPE html>
<html>
<head>
<!-- /***************************
     4105056019 許睦昆 期末專題6/29
    ***************************/-->
    <meta charset="utf-8" />
    <title>更新</title>
</head>
<body>
<?php
$level=$_POST['level'];
$id=$_COOKIE['id'];
$sql="SELECT * FROM `user`WHERE `id`='{$id}';";
$result=mysqli_query($link,$sql);
$row = mysqli_fetch_row($result);
if($row[4]<$level){
    $sql2="UPDATE `user` SET `level`='{$level}' WHERE `id`='{$id}';";
    $result2=mysqli_query($link,$sql2);
    if(mysqli_affected_rows($link)>0){
        header('Refresh:0;url="startpage.html"');
    }
    else if(mysqli_affected_rows($link)==0)
    echo '無資料更新';
    else
    echo '執行失敗';
    header('Refresh:0;url="startpage.html"');
}
else{
    header('Refresh:0;url="startpage.html"');
}
?>
<?php
    mysqli_close($link);
?>
</body>
</html>