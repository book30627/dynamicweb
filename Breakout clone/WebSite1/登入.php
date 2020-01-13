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
    <title>登入</title>
</head>
<body>
<?php
$key=0;
$username=$_POST['username'];
$password=$_POST['password'];
$sql="SELECT * FROM `user`WHERE `username`='{$username}';";
$result=mysqli_query($link,$sql);
while($row = mysqli_fetch_row($result))
{
    if($row[1]!=null&&$row[2]!=null&&$row[1]==$username&&$row[2]==$password){
        echo"登入成功，玩家$row[3]";
        setcookie("id", $row[0], time()+3600);
        echo '<div>';
        echo '<p>已解鎖的關卡</p>';
        for($i=1;$i<=$row[4];$i++)
        {
            echo "<h1>關卡:<a href='index$i.html'>$i</a></h1>";
        }
        echo '</div>';
        $key=1;
   }
}
if($key==0){
    echo '<script language="javascript">';
    echo 'alert("登入失敗")';
    echo '</script>';
    header('Refresh:0;url="logscene.html"');
}
?>
<?php
    mysqli_close($link);
?>
</body>
</html>