<?php
    session_start();
    error_reporting(0); 
    $member=$_SESSION["email"];
    $mid = $_SESSION['mid'];
    ob_start(); // 開始緩衝輸出
?>
<!DOCTYPE html>
<html lang="en" id="darkorlight" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>安全交易...進行中</title>
    <script src="./js/kit.fontawesome.com_b8ad2c2a06.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./css/font.css">
    <link rel="shortcut icon" href="./img/logo.png" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400&display=swap" rel="stylesheet">
    <style>

  </style>
</head>
<body>
<form action="./SafetyPay" method="POST">
<nav class="navbar  navbar-expand-lg shadow p-1 bg-body rounded">
            <div class="container-fluid">
                <a class="navbar-brand align-middle" href="./choose"><img src="./img/logo.png" width="48" height="48">IVM多元化販賣機</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="./choose">主選單</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="account_setting">帳戶設定</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./Purchase details">購買明細</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="./Pay" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                付款設定
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="./AddPay">新增信用卡</a></li>
                                <li><a class="dropdown-item" href="./PayManager">信用卡管理</a></li>
                                <li><a class="dropdown-item" href="./InterMoney">電子錢包</a></li>

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./buycar">購物袋</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./Fetch">交易驗證</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./interface">開發歷程</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./contact.php">聯絡我們</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./learnmone">隱私權政策</a>
                        </li>
                        <li class="nav-item dropdown">
                        <li class="nav-item ">
                            <button type="submit" class="nav-link" name="logout" onclick="logout()" value="登出">登出</button>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
</form>
<form action="./SafetyPay" method="post">
    <div class="modal fade" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-body">
            <p id='Checkres' class="text text-center">交易進行中請勿關閉此畫面</p>
        <div class="progress">
            <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
        </div>
        <span id="progressLabel" class="ml-2">0%</span>
        </div>
            <div class="modal-footer">
                <button type="submit" name="next" id="next" class="btn btn-success d-none">下一步</button>
            </div>
        </div>
    </div>
    </div>
</form>


<?php

// ! 導覽列部分

if(isset($_POST['logout'])){
    session_destroy();
    header("Location: login");
    
}


$pname=$_SESSION['onlick_pname'];               //商品名稱
$img=$_SESSION['onlick_img'];                   //商品圖片
$price=$_SESSION['onlick_price'];               //商品價格
$quantity=$_SESSION['onlick_quantity'];         //商品數量
$pno=$_SESSION['onlick_pno'];                   //商品編號
$catalog=$_SESSION['onlick_catalog'];           //商品種類
$PayCardid=$_SESSION['PayCardid'];              //信用卡號
$viewmoney=$_SESSION['viewmoney'];              //電子錢包
$tradingmodel=$_SESSION['tradingmodel'];        //交易模式
require_once('ivm_database.php'); 
$transaction = $pdo->prepare("select * from transaction ORDER BY transtime DESC LIMIT 1");
$transaction->execute();
$count = $transaction->rowCount();
// ? 查詢交易資料表
while ($row = $transaction->fetch(PDO::FETCH_ASSOC)) {
    $tno = $row['tno'];
    $state = $row['state'];
    $tran_code = $row['tran_code'];       //驗證6碼
    $tno_value = substr($row['tno'], 4, 3);
  }
  $tran = "tran";  //自動編號前面要加上的文字
  $add_quantity = "1";
  if ($count == "0") {
    $add = "tran1";
  } else {
    $add = $tran . ($tno_value + "1");
  }
  $random = rand(100000, 999999);
  if ($count=="0") {
    $random_value = $random;
  }elseif($random==$tran_code){
    $random_value = $random;
  }else{
    $random_value = $random;
  }
if(isset($_POST['next'])){
    if($_SESSION['tradingmodel']=="onepd"){
        if($PayCardid!=""){
            echo '信用卡有資料';
            $transaction = $pdo->prepare("UPDATE transaction SET state='已失效' WHERE transmid=? AND state='尚未驗證'");
            $transaction->execute([$mid]);
        
            $SQL_HF024 = $pdo->prepare('INSERT INTO transaction(tno,pno,transmid,pname,catalog,quantity,price,moneypay,cardid,tran_code) value (?,?,?,?,?,?,?,?,?,?)');
            $SQL_HF024->execute([$add, $pno, $mid, $pname, $catalog,'1', $price,"NAN", $PayCardid, $random_value]);
            unset($_SESSION['PayCardid']);   
        }
        if($viewmoney!=""){
            echo '使用電子錢包';
            $transaction = $pdo->prepare("UPDATE transaction SET state='已失效' WHERE transmid=? AND state='尚未驗證'");
            $transaction->execute([$mid]);
        
            $SQL_HF024 = $pdo->prepare('INSERT INTO transaction(tno,pno,transmid,pname,catalog,quantity,price,moneypay,cardid,tran_code) value (?,?,?,?,?,?,?,?,?,?)');
            $SQL_HF024->execute([$add, $pno, $mid, $pname, $catalog,'1', $price,"Y", "NAN", $random_value]);

            $upmoney = $pdo->prepare("UPDATE intermoney SET money=money-$price WHERE mid=?");
            $upmoney->execute([$mid]);

            unset($_SESSION['viewmoney']);  
     
        }

    }elseif($_SESSION['tradingmodel']=="manypd"){
        echo '購物車模式';
        if($PayCardid!=""){
            echo '信用卡有資料';
            $transaction = $pdo->prepare("UPDATE transaction SET state='已失效' WHERE transmid=? AND state='尚未驗證'");
            $transaction->execute([$mid]);
        
            $upbuycar = $pdo->prepare("UPDATE buycar SET state=? WHERE mid=?");
            $upbuycar->execute([$random_value,$mid]);

        }
        if($viewmoney!=""){
            echo '使用電子錢包';
            $transaction = $pdo->prepare("UPDATE transaction SET state='已失效' WHERE transmid=? AND state='尚未驗證'");
            $transaction->execute([$mid]);
        
            $upbuycar = $pdo->prepare("UPDATE buycar SET state=? WHERE mid=?");
            $upbuycar->execute([$random_value,$mid]);
     
      
        //購物袋按下結帳-把前一筆驗證碼改成失效-產生一組新的
        //新的先新增近購物車的資料表
        //驗證畫面用'tradingmodel'去抓的模式判斷要拿哪裡的驗證碼
        //商品輸出後將購物資料新增回'transaction'驗證碼皆一致
    }
    
}
    header("Location:./Fetch");

}
ob_end_flush(); // 將輸出送到瀏覽器



?>   

<script>
var myModal=new bootstrap.Modal(document.getElementById("myModal"));myModal.show();function updateProgressBar(){var g=document.getElementById("progressBar");var a=document.getElementById("progressLabel");var f=document.getElementById("Checkres");var d=document.getElementById("next");var c=Math.floor(Math.random()*10)+1;var b=parseInt(g.style.width);var e=parseInt(g.style.width)+c;console.log(e);if(e>=100){e=100;d.classList.remove("d-none");d.classList.add("d-block");f.innerText="交易完成請點擊下一步"}g.style.width=e+"%";g.setAttribute("aria-valuenow",e);a.innerText=e+"%";if(e<100){setTimeout(updateProgressBar,100)}}updateProgressBar();
</script>

</body>
</html>

