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
    <title>註冊</title>
</head>
<body>
    <?php
    error_reporting(E_ALL ^ E_NOTICE); 
    $username=$_POST['username'];
    $password=$_POST['password'];
    $checkpassword=$_POST['checkpassword'];
    if($password!= $checkpassword)//php md5函式加密
    echo '密碼錯誤';
    else{
        $playername=$_POST['playername'];
        if(strlen($usr)>50)
        echo '帳號過長';
        else if(strlen($password)>100)
        echo '密碼過長';
        else if(strlen($playername)>30)
        echo '名稱過長';
        else{
            $sql="SELECT `playername` FROM `user`WHERE `playername`='{$playername}';";
            $result=mysqli_query($link,$sql);
            if(mysqli_num_rows($result)==1){
               mysqli_free_result($result);
               echo '<script language="javascript">';
                    echo 'alert("此名稱已有人註冊，請換新名稱")';
                    echo '</script>';
                    header('Refresh:0;url="registerscene.html"');
            }
            else{
                $sql2="INSERT INTO `user`(`username`,`password`,`playername`,`level`)VALUE('{$username}','{$password}','{$playername}',1)";
                $result2=mysqli_query($link,$sql2);
                if(mysqli_affected_rows($link)>0){
                    echo '<script language="javascript">';
                    echo 'alert("註冊成功，頁面轉至遊戲畫面")';
                    echo '</script>';
                    header('Refresh:0;url="index1.html"');
                }
                else if(mysqli_affected_rows($link)==0)
                echo '無資料新增';
                else
                echo '執行失敗';
            }
        }
    }
    ?>
    <?php
    mysqli_close($link);
    ?>
</body>
</html>