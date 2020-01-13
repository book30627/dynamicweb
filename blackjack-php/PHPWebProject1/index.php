<!DOCTYPE html>
<?php
session_start();
?>
<html>
<head>
<!-- /***************************
     4105056019 許睦昆 第六次作業6/8
    ***************************/-->
    <meta charset="utf-8" />
    <title>HW06</title>
    <style>
      li{display:inline}
        .button {
            display:inline;
            margin-left:50px;
        }
       .high{
        height:150px;
       } 
        body{background-color:green;}
        .buttonpos{
            position:absolute;
            top:350px;
        }
        .buttonpos2{
            position:absolute;
            top:280px;
            left:500px;
        }
        cardpos1{
            position:absolute;
            top:0px;
        }
        cardpos2{
            position:absolute;
            top:50px;
        }
        .ppos{
            position:absolute;
            top:400px;
        }
        .ppos-1{
            position:absolute;
            top:420px;
        }
        .ppos1{
            position:absolute;
            top:400px;
            left:150px;
        }
        .ppos1-1{
            position:absolute;
            top:420px;
            left:150px;
        }
        .ppos2{
            color:blue;
            position:absolute;
            top:200px;
            left:530px;
        }
        .ppos3{
            color:blue;
            position:absolute;
            top:100px;
            left:500px;
            font-size:3em;
        }
        .tabblepos{
            position:absolute;
            top:400px;
            left:400px;
            color:blue;
        }
        table{
            background-color:white;
        }
    </style>
</head>
<body>
<?php
        error_reporting(E_ALL ^ E_NOTICE); 
 /*      foreach($_COOKIE as $key => $value )
    print("<p>$key:$value</p>");*/
        //setcookie("key", "", time()-3600);
if($_POST['hidden'] =='addcash')
            addcash();
else if($_POST['hidden'] =='add')
    add();
else if($_POST['hidden'] =='addcard')
    addcard();
else if($_POST['hidden'] =='noaddcard')
    noaddcard(0);
else if($_POST['hidden'] =='enter')
clear();
else{
 $_SESSION["cash"]=300;
 $_SESSION["money"]=0;
 $_SESSION["currntcardindex"]=1;
 $_SESSION["cardnumappear"]=0;
 $_SESSION["colorindexappear"]=0;
 $_SESSION["playerindex"]=0;
 $_SESSION["playernum"]=0;
 $_SESSION["change"]=0;
 $_SESSION["game"]=0;
 $_SESSION["str"]=0;
 $_SESSION["moneycheck"]=0;
 $_SESSION["key"]=0;
 echo '<p class="ppos">目前籌碼:'.$_SESSION["cash"].'</p>';
}
if($_SESSION["moneycheck"]==1){
    if( $_SESSION["change"]==0){
        if( $_SESSION["currntcardindex"]==1){
                    startshowcard();
                    printable();
        }
        else
        showcard();
        printable();
        printbutton();
    }
    else if($_SESSION["change"]==1){
        showcard();
        printable();
        printstop();
    }
}
else if($_SESSION["moneycheck"]==0){
    if( $_SESSION["change"]==1)
    echo '<p class="ppos">目前籌碼:'.$_SESSION["cash"].'</p>';
    start(); 
    printable();
}
$_SESSION["key"]=1;
?>
        <?php
            function start()
            {
                $_SESSION["change"]=0;
                echo '<div class="buttonpos"><form action="index.php" class="button" method="post">
                <input  type="text" name="money" />
                <input  type="submit" value="確定下注"/>
                <input  type="hidden" name="hidden" value="addcash" />
                </form></div>';
            } 
            function printbutton(){
                echo '<div class="buttonpos"><form action="index.php" class="button" method="post">
                <input  type="text" name="addmoney" />
                <input  type="submit" value="確定加注"/>
                <input  type="hidden" name="hidden" value="add" />
                </form>
                <form action="index.php" class="button" method="post">
                <input id="add" type="submit" value="加牌" />
                <input  type="hidden" name="hidden" value="addcard" />
                </form>
                <form action="index.php" class="button" method="post">
                <input id="no" type="submit" value="不加牌" />
                <input  type="hidden" name="hidden" value="noaddcard" />
                </form></div>';
            }
            function printstop(){
                if($_SESSION["cash"]==0)
                echo '<p class="ppos3">遊戲結束</p>';
                $_SESSION["moneycheck"]=0;
                echo '<div class="buttonpos2"><form action="index.php" class="button" method="post">
                <input id="no" type="submit" value="確定" />
                <input  type="hidden" name="hidden" value="enter" />
                </form></div>';
            }
        ?>
    </div>
</body>
<?php
        function addcash()
        {
            $money=(int)$_POST['money'] ;
            $cash=(int) $_SESSION["cash"];
            $current=$cash-$money;
            if($money<0){
              echo '<p class="ppos">目前籌碼:'.$cash.'</p>';
              echo '<p class="ppos1">請輸入正確押注金額</p>';  
            }
            else if($money==0){
                echo '<p class="ppos">目前籌碼:'.$cash.'</p>';
                echo '<p class="ppos1">請記得押注</p>';
            }
            else if ($current >= 0) {
                echo '<p class="ppos">目前籌碼:'.$current.'</p>';
                echo '<p class="ppos-1">目前賭金:'.$money.'</p>';
                $_SESSION["cash"]=$current;
                $_SESSION["money"]=$money;
                $_SESSION["moneycheck"]=1;
            }
            else if($current <0){
                echo '<p class="ppos">目前籌碼:'.$cash.'</p>';
                echo '<p class="ppos1">押注超過目前的籌碼</p>';
            }
        }
        function add()
        {
            $money=(int)$_POST['addmoney'] ;
            $cash=(int) $_SESSION["cash"];
            $current=$cash-$money;
            $sessionmoney=$_SESSION["money"];
           if($money<0){
            echo '<p class="ppos">目前籌碼:'.$cash.'</p>';
            echo '<p class="ppos-1">目前賭金:'.$sessionmoney.'</p>';
            echo '<p class="ppos1">請輸入正確押注金額</p>';
           }
           else if($money==0){
                echo '<p class="ppos">目前籌碼:'.$current.'</p>';
                echo '<p class="ppos-1">目前賭金:'.$sessionmoney.'</p>';
                echo '<p class="ppos1">請記得押注</p>';
            }
            else if ($current >= 0) {
                $_SESSION["cash"]=$current;
                $_SESSION["money"]=$money+$sessionmoney;
                addcard();
                if( $_SESSION["playernum"]<=21)
                noaddcard(1);
            }
            else if($current <0){
                echo '<p class="ppos">目前籌碼:'.$cash.'</p>';
                echo '<p class="ppos-1">目前賭金:'.$sessionmoney.'</p>';
                echo '<p class="ppos1">押注超過目前的籌碼</p>';
            }
        }
        function startshowcard(){
            $color = array('C','D','H','S');
            $i = 0;
            while ( $i < 4) {
                $cardnum = rand(1,13);
                $colorindex =rand(0,3); 
                if ($i < 2) {
                    $key = 0;
                    $key = checkrepeat($cardnum, $colorindex);
                    if ($i == 0) {
                        echo '<div class="high,cardpos1">';
                        echo '<li><img src = "撲克牌/gray_back.png" height="150"></li>';
                    }
                    if ($key == 0 && $i == 1) {
                        echo '<li><img src = "撲克牌/'.$cardnum.$color[$colorindex].'.png" height="150"></li></div>';
                    }
                    if ($key == 0)
                        $i++;
                }
                else {
                    $key = 0;
                    $key = checkrepeat($cardnum, $colorindex);
                   if ($key == 0) {
                         if($i==2)
                        echo '<div class="high,cardpos2">';
                        echo '<li><img src = "撲克牌/'.$cardnum.$color[$colorindex].'.png" height="150"></li>';
                        if($i==3)
                        echo '</div>';
                        $i++;
                    } 
                }
            }
            $currntcardindex=(int) $_SESSION["currntcardindex"];
            $num = countnum(3, $currntcardindex-1, 0,0);
            echo "<p class='ppos1'>玩家目前點數:$num</p>";
        }
        function checkrepeat($cardnum,$colorindex)
        {
            $currntcardindex=(int) $_SESSION["currntcardindex"];
            $cardnumappear=(string)$_SESSION["cardnumappear"];
            $colorindexappear=(string)$_SESSION["colorindexappear"];
            $key = 0;
            $cardn=explode(" ",$cardnumappear);
            $colorn=explode(" ",$colorindexappear);
            for ($j = 1; $j < $currntcardindex; $j++) {
                if ($cardnum == $cardn[$j] && $colorindex == $colorn[$j]) {
                    $key = 1;
                    break;
                }
            }
            if ($key == 0) {
                $currntcardindex+=1;
                $_SESSION["currntcardindex"]=$currntcardindex;
                $cardnumappear=$cardnumappear." ".(string)$cardnum;
                $_SESSION["cardnumappear"]=$cardnumappear;
                $colorindexappear=$colorindexappear." ".(string)$colorindex;
                $_SESSION["colorindexappear"]=$colorindexappear;
                }
            return $key;
        }
        function addcard() {
            $color = array('C','D','H','S');
            $key = 2;
            while ($key != 0) {
                $cardnum = rand(1,13);
                $colorindex =rand(0,3); 
                $key = checkrepeat($cardnum, $colorindex);
            }
            $currntcardindex=(int) $_SESSION["currntcardindex"];
            $num = countnum(3, $currntcardindex-1, 0,0);
            $_SESSION["playernum"]=$num;
            echo "<p class='ppos1'>玩家目前點數:$num</p>";
            if($num>21){
                echo "<h1 class='ppos2'>you lose</h1>";
                    winorlose('l',0);
            }
        }
        function winorlose($c,$key){
            $_SESSION["game"]=$_SESSION["game"]+1;
            if($c=='l'){
                setcookie( $_SESSION["game"],"lose ".$_SESSION["cash"],time()+3600);
                $str="lose";
            }
            else if($c=='w'){
                if($key==0){
                    $_SESSION["cash"]=(int)$_SESSION["cash"]+2*(int)$_SESSION["money"];
                    setcookie( $_SESSION["game"],"win ".$_SESSION["cash"],time()+3600);
                }
                else{
                    $_SESSION["cash"]=(int)$_SESSION["cash"]+2.5*(int)$_SESSION["money"];
                    setcookie( $_SESSION["game"],"win ".$_SESSION["cash"],time()+3600);
                }
                $str="win";
            }
            else if($c=='e'){
                $_SESSION["cash"]=(int)$_SESSION["cash"]+(int)$_SESSION["money"];
                setcookie( $_SESSION["game"],"equal ".$_SESSION["cash"],time()+3600);
                $str="equal";
            }
            $_SESSION["str"]=$str;
            $_SESSION["key"]=0;
            printable();
            setchange();
        }
        function printable(){
            echo   '<div class="tabblepos">
            <table border="1" class="table">
                <caption>遊戲紀錄</caption>
                <thead>
                    <tr><th>場次</th><th>結果</th><th>剩餘籌碼</th></tr>
                </thead>
                <tbody>';
                for($i=1;$i<= $_SESSION["game"];$i++){
                    if( $_SESSION["key"]==0&&$i==$_SESSION["game"])
                        echo "<tr><td>第".$i."場</td><td>".$_SESSION["str"]."</td><td>".$_SESSION["cash"]."</td></tr>";
                    else{
                        $result=explode(" ",$_COOKIE[$i]);
                        echo "<tr><td>第".$i."場</td><td>".$result[0]."</td><td>".$result[1]."</td></tr>";
                    }
                }
            echo ' </tbody></table></div>';
        }
        function setchange(){
            $_SESSION["money"]=0;
            $_SESSION["change"]=1;
        }
        function clear(){ 
            $_SESSION["currntcardindex"]=1;
            $_SESSION["cardnumappear"]=0;
            $_SESSION["colorindexappear"]=0;
            $_SESSION["playerindex"]=0;
            $_SESSION["playernum"]=0;
            if( $_SESSION["cash"]==0){
                $_SESSION["cash"]=300;
                $_SESSION["change"]=0;
                $_SESSION["game"]=0;
                $_SESSION["str"]=0;
                $_SESSION["key"]=0;
                echo '<p class="ppos">目前籌碼:'.$_SESSION["cash"].'</p>';
            }
        }
        function noaddcard($k) {
            $currntcardindex=(int) $_SESSION["currntcardindex"];
            $_SESSION["playerindex"]=$currntcardindex-1;
            $color = array('C','D','H','S');
             $num = countnum(1, 2, 0,0);//(start,end,originalnum)
            while ($num < 17) {
                $key = 2;
                while ($key != 0) {
                    $cardnum = rand(1,13);
                    $colorindex =rand(0,3); 
                    $key = checkrepeat($cardnum, $colorindex);
                }
                $currntcardindex1=(int) $_SESSION["currntcardindex"];
                $num = countnum($currntcardindex1-1, $currntcardindex1-1, $num,0);
            }
            $playernum=countnum(3, $currntcardindex-1, 0,0);;
            echo "<p class='ppos1'>玩家目前點數:$playernum</p>";
            echo "<p class='ppos1-1'>莊家目前點數:$num</p>";
            if ($num > 21 || $playernum> $num) {
                echo "<h1 class='ppos2'>you win</h1>";
                winorlose('w',$k);
            }
            else if ($playernum == $num) {
                echo "<h1 class='ppos2'>equal</h1>";
                winorlose('e',$k);
            }
            else if ($playernum < $num) {
                echo "<h1 class='ppos2'>you lose</h1>";
                winorlose('l',$k);
            }
        }
        function countnum($start, $end, $orinum,$hostace) {
            $cardnumappear=(string)$_SESSION["cardnumappear"];
            $cardn=explode(" ",$cardnumappear);
             $num = 0;
            $num += $orinum;
            for ($i = $start; $i <=$end; $i++) {
                if ($cardn[$i] == 1) {
                    $hostace++;
                    $num += 11;
                }
                else if ($cardn[$i] > 10)
                    $num += 10;
                else
                    $num += (int)$cardn[$i];
            }
            while ($hostace > 0 && $num > 21) {
                $num -= 10;
                $hostace--;
                if ($hostace == 0 && $num > 21)
                    break;
            }
            return $num;
        }
        function showcard(){
            $color = array('C','D','H','S');
            $currntcardindex=(int) $_SESSION["currntcardindex"];
            $cardnumappear=(string)$_SESSION["cardnumappear"];
            $colorindexappear=(string)$_SESSION["colorindexappear"];
            $playerindex=$_SESSION["playerindex"];
            $key = 0;
            $cardn=explode(" ",$cardnumappear);
            $colorn=explode(" ",$colorindexappear);
            $cash=(int) $_SESSION["cash"];
            $sessionmoney=$_SESSION["money"];
            echo '<p class="ppos">目前籌碼:'.$cash.'</p>';
            echo '<p class="ppos-1">目前賭金:'.$sessionmoney.'</p>';
            if($playerindex==0)
            for ($j = 1; $j < $currntcardindex; $j++) {
                if ($j==1) {
                    echo '<div class="high,cardpos1">';
                    echo '<li><img src = "撲克牌/gray_back.png" height="150"></li>';
                }
                else if($j==2)
                    echo '<li><img src = "撲克牌/'.$cardn[$j].$color[$colorn[$j]].'.png" height="150"></li></div>';
                else if($j==3){
                    echo '<div class="high,cardpos1">';
                    echo '<li><img src = "撲克牌/'.$cardn[$j].$color[$colorn[$j]].'.png" height="150"></li>';
                }
                else if($j== $currntcardindex-1){
                    echo '<li><img src = "撲克牌/'.$cardn[$j].$color[$colorn[$j]].'.png" height="150"></li></div>';
                }
                else{
                    echo '<li><img src = "撲克牌/'.$cardn[$j].$color[$colorn[$j]].'.png" height="150"></li>';
                }
            }
            else{
                for ($j = 1; $j < $currntcardindex; $j++) {
                    if ($j==1) {
                        echo '<div class="high,cardpos1">';
                        echo '<li><img src = "撲克牌/'.$cardn[$j].$color[$colorn[$j]].'.png" height="150"></li>';
                    }
                    else if($j==2){
                        echo '<li><img src = "撲克牌/'.$cardn[$j].$color[$colorn[$j]].'.png" height="150"></li>';
                        if($playerindex+1==$currntcardindex){
                            echo '</div>';
                            break;
                        }
                    }   
                    else if($j>$playerindex){
                        echo '<li><img src = "撲克牌/'.$cardn[$j].$color[$colorn[$j]].'.png" height="150"></li>';
                    }
                    else if($j== $currntcardindex-1){
                        echo '<li><img src = "撲克牌/'.$cardn[$j].$color[$colorn[$j]].'.png" height="150"></li></div>';
                    }
                }
                for ($j = 3; $j <= $playerindex; $j++) {
                    if($j==3){
                        echo '<div class="high,cardpos1">';
                        echo '<li><img src = "撲克牌/'.$cardn[$j].$color[$colorn[$j]].'.png" height="150"></li>';
                    }
                    else if($j== $playerindex){
                        echo '<li><img src = "撲克牌/'.$cardn[$j].$color[$colorn[$j]].'.png" height="150"></li></div>';
                    }
                    else{
                        echo '<li><img src = "撲克牌/'.$cardn[$j].$color[$colorn[$j]].'.png" height="150"></li>';
                    }
                }
            }
        }
   ?>
</html>