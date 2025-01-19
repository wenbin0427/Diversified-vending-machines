<?php
    session_start();
    error_reporting(0); 
    $member=$_SESSION["email"];
    $mid = $_SESSION['mid'];
    // ! 導覽列部分
    if(isset($_POST['logout'])){
        session_destroy();
        header("Location: login");
    }

?>
<!DOCTYPE html>
<html lang="en" id="darkorlight" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>取物驗證</title>
    <script src="./js/kit.fontawesome.com_b8ad2c2a06.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./css/font.css">
    <link rel="shortcut icon" href="./img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="./css/anaition.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="./js/jquery-3.7.1.min.js"></script>
</head>

<body>
<form action="./Fetch" method="POST">
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

<?php
require_once('ivm_database.php'); 

$BuyPayCardid=$_SESSION['PayCardid'];              //信用卡號
$viewmoney=$_SESSION['viewmoney'];              //電子錢包
$tradingmodel=$_SESSION['tradingmodel'];        //交易模式
$transactioncount = $pdo->prepare("SELECT * FROM transaction WHERE transmid=$mid ");
$transactioncount->execute();
$count = $transactioncount->rowCount();

$transaction = $pdo->prepare("SELECT * FROM transaction WHERE transmid=$mid ORDER BY transtime DESC LIMIT 1");
$transaction->execute();

// ? 查詢交易資料表
if($count==0){
    $tran_code='尚未有未驗證的驗證碼';

}else{
    while ($row = $transaction->fetch(PDO::FETCH_ASSOC)) {
        $tno = $row['tno'];
        $state = $row['state'];
            if($state=='尚未驗證'){
                $tran_code = $row['tran_code'];       //驗證6碼
                $tno_value = substr($row['tno'], 4, 3);
            }elseif($state=="交易完成"){
                $tran_code='尚未有未驗證的驗證碼';
            }
    }
}


$transaction = $pdo->prepare("SELECT * FROM transaction WHERE transmid=$mid ORDER BY transtime DESC LIMIT 1");
$transaction->execute();

// ? 查詢交易資料表
while ($row = $transaction->fetch(PDO::FETCH_ASSOC)) {
    $tno = $row['tno'];
    $pno = $row['pno'];
    $transmid = $row['transmid'];
    $pname = $row['pname'];
    $catalog = $row['catalog'];
    $quantity = $row['quantity'];
    $price = $row['price'];
    $PayCardid = $row['cardid'];

}
// ? 查產品圖片
$product = $pdo->prepare("SELECT * FROM product WHERE pno = ?");
$product->execute([$pno]);
while ($row = $product->fetch(PDO::FETCH_ASSOC)) {
    $img = $row['img'];
    $PD_quantity = $row['quantity'];
}

// ? 查會員填問卷
$memberqu = $pdo->prepare("SELECT * FROM member");
$memberqu->execute();
while ($row = $memberqu->fetch(PDO::FETCH_ASSOC)) {
    if($row['mid']==$mid){
        $QuestionnaireLog=$row['Questionnaire'];
    }
}

// ? 查會員購物車
$memberbuycar = $pdo->prepare("SELECT * FROM buycar");
$memberbuycar->execute();
$buycarcount=$memberbuycar->rowCount();
if($buycarcount>0){
    while ($row = $memberbuycar->fetch(PDO::FETCH_ASSOC)) {
        if($row['mid']==$mid){
            $_SESSION['car_mid']=$row['mid'];
            $_SESSION['car_pno']=$row['pno'];
            $_SESSION['car_pname']=$row['pname'];
            $_SESSION['car_catalog']=$row['catalog'];
            $_SESSION['car_quantity']=$row['quantity'];
            $_SESSION['car_price']=$row['price'];
            $_SESSION['car_state']=$row['state'];
            $view_car_state=$row['state'];
        }
    }
}else{
    $view_car_state='尚未有未驗證的驗證碼';
}
// if($_SESSION['tradingmodel']=="onepd"){

// }elseif($_SESSION['tradingmodel']=="manypd"){

// }

?>

<form action="Fetch" method="post" id="FetchmyForm">
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-xl-6 col-xxl-3 mx-auto position-absolute top-50 start-50 translate-middle mt-5 z-1" >
            <div class="card border border-tertiary">
                <div class="shadow-lg card-body">
                    <div class="position-relative rotation-element">
                        <img class="img-fluid mx-auto d-block" src="./img/大齒輪－修.png" width="30%" height="10%">
                    </div>
                        <div class="mb-3">
                        <?php
                            if($_SESSION['tradingmodel']=="onepd"){
                                ?>
                                <input type="text" class="form-control text-center" name="CheckFetch" id="CheckFetch" value="<?php echo $tran_code; ?>" disabled>
                                <?php
                            }elseif($_SESSION['tradingmodel']=="manypd"){
                                ?>
                                <input type="text" class="form-control text-center" name="CheckFetch" id="CheckFetch" value="<?php echo $view_car_state; ?>" disabled>
                                <?php
                            }
                            
                        ?>
                        </div>
                        <?php
                            if($state=='尚未驗證' && $_SESSION['tradingmodel']=="onepd"){
                        ?>
                            <button type="submit" id="next" name="next" value="<?php echo $tran_code; ?>"  class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#ShowProduct">確認</button>
                        <?php
                            }elseif($buycarcount>0 && $_SESSION['tradingmodel']=="manypd"){
                            ?>
                                <button type="submit" id="next" name="next" value="<?php echo $_SESSION['car_state']; ?>"  class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#ShowProduct">確認</button>
                            <?php
                            }elseif($buycarcount == 0 || $count == 0){
                            ?>
                            <button type="button" class="btn btn-success w-100" data-bs-toggle="modal"  onclick="location.href='./choose'">返回</button>
                            <?php
                            }
                        ?>
                        <div class="text text-danger text-center">本網站僅提供體驗故驗證碼採自動帶入</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="modal fade" id="ShowProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered ">
    <div class="modal-content">
        <div class="modal-body">
            <div class="container">
                <div class="text-center fs-5 mb-3">商品出貨中請稍後</div>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" id="Receive_Product" class="btn btn-success w-100 d-none" data-bs-toggle="modal" data-bs-target="#Receive_Product_Bt">點此領取商品</button>
        </div>
        </div>
  </div>
</div>

<div class="modal fade" id="Receive_Product_Bt" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered ">
    <div class="modal-content">
        <div class="modal-body">
            <div class="container">
                <div class="text-danger text-center">注意本網站僅供體驗與展示</div>
                <div class="text-danger text-center">體驗者並不會獲得任何實體商品</div>
                <img class="mx-auto d-block" src="<?php echo $img;?>" width="40%" height="40%">
            </div>
            <div class="modal-footer">
                <?php
                if($QuestionnaireLog=="尚未填寫"){
                ?>
                    <button type="button" class="btn btn-success w-100" data-bs-toggle="modal" onclick="location.href='./choose'">回主畫面</button>
                    <button type="button" class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#QuestionnaireModel">下一步</button>
                <?php
                }else{
                ?>
                    <button type="button" class="btn btn-success w-100" data-bs-toggle="modal" onclick="location.href='./choose'">回主畫面</button>
                <?php
                }
                ?>
            </div>
        </div>
  </div>
    </div>
</div>
<!-- 這邊要寫問卷尚未填寫的彈窗 -->
<div class="modal fade" id="QuestionnaireModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered ">
    <div class="modal-content">
        <div class="modal-body">
            <div class="container">
                <div class="text-danger text-center">
                    感謝您體驗本小組設計的網站，您的建議將是我們進步的動力，點擊下方按鈕前往填寫問卷吧！<br>
                    如已填寫無須理會點擊回主畫面即可!
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success w-100" data-bs-toggle="modal" onclick="location.href='./choose'">回主畫面</button>
                <button type="button" class="btn btn-success w-100" data-bs-toggle="modal" onclick="window.open('https://forms.gle/m8GYhTVVYJoh8cbH8', '_blank')" >前往填寫</button>
            </div>
        </div>
  </div>
    </div>
</div>

<?php

$showModal = isset($_SESSION['showModal']) ? $_SESSION['showModal'] : false;

//$PayCardid=$_SESSION['PayCardid'];              //信用卡號
//$viewmoney=$_SESSION['viewmoney'];              //電子錢包
//$tradingmodel=$_SESSION['tradingmodel'];        //交易模式


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
  $car_mid=$_SESSION['car_mid'];
  $car_pno=$_SESSION['car_pno'];
  $car_pname=$_SESSION['car_pname'];
  $car_catalog=$_SESSION['car_catalog'];
  $car_quantity=$_SESSION['car_quantity'];
  $car_price=$_SESSION['car_price'];
  $car_state=$_SESSION['car_state'];

if(isset($_POST['next'])){
    if($_SESSION['tradingmodel']=="onepd"){
        if($_POST['next']==$tran_code){
            if($catalog=='日常用品'){
                $_SESSION['run_motor_pd']='PD_D';
            }elseif($catalog=='餅乾'){
                $_SESSION['run_motor_pd']='PD_F';
            }elseif($catalog=='飲料'){
                $_SESSION['run_motor_pd']='PD_J';
            }
            $transaction = $pdo->prepare("UPDATE product SET quantity=? WHERE pno=?");
            $transaction->execute([$PD_quantity-1,$pno]);
            $transaction = $pdo->prepare("UPDATE transaction SET state='交易完成' WHERE transmid=? AND state='尚未驗證'");
            $transaction->execute([$mid]);
            $showModal = true;
            $_SESSION['showModal'] = true;
            ?>
            <script>
                var FetchmyForm = $('#FetchmyForm').serialize();
    
              $.ajax({
                  type: "POST",
                  url: "./run_motor.php",
                  data: FetchmyForm,
                      success: function(response) {
                        console.log('送出成功');
                        // 处理成功响应
                        console.log('結果' + response); // 这里处理服务器响应
                    },
                    error: function(xhr, status, error) {
                        console.log('送出失败');
                        // 处理错误
                    }
              });
            </script>
            <?php
        }
    
    }elseif($_SESSION['tradingmodel']=="manypd"){
        if($_POST['next']==$car_state){
            if($BuyPayCardid!=""){

                $memberbuycar = $pdo->prepare("SELECT * FROM buycar");
                $memberbuycar->execute();
                while ($row = $memberbuycar->fetch(PDO::FETCH_ASSOC)) {
                    $FETR = $pdo->prepare('INSERT INTO transaction(tno,pno,transmid,pname,catalog,quantity,price,moneypay,cardid,tran_code,state) value (?,?,?,?,?,?,?,?,?,?,?)');
                    $FETR->execute([$add,$row['pno'],$row['mid'],$row['pname'],$row['catalog'],$row['quantity'],$row['price']*$row['quantity'] ,'NAN',$BuyPayCardid ,$row['state'],'交易完成']);

                    $subtotal = $row['quantity'] * $row['price'];
                    $totalPrice += $subtotal;  // 累加至總金額

                    $upproductq = $pdo->prepare("UPDATE product SET quantity=? WHERE pno=?");
                    $upproductq->execute([$PD_quantity-$row['quantity'],$row['pno']]);
                    
                    $BuyCarcatalog=$row['catalog'];
                    $Carquantity=$row['quantity'];
                    if($BuyCarcatalog=='日常用品'){
                        $_SESSION['Car_run_motor_PD_D']='PD_D';
                        $_SESSION['Car_run_PD_D']=$Carquantity;
                    }
                    if($BuyCarcatalog=='餅乾'){
                        $_SESSION['Car_run_motor_PD_F']='PD_F';
                        $_SESSION['Car_run_PD_F']=$Carquantity;

                    }
                    if($BuyCarcatalog=='飲料'){
                        $_SESSION['Car_run_motor_PD_J']='PD_J';
                        $_SESSION['Car_run_PD_J']=$Carquantity;

                    }
 
                }


                //$stmt = $pdo->prepare('DELETE FROM buycar WHERE mid = ?');
                //$stmt->execute([$mid]);

                $showModal = true;
                $_SESSION['showModal'] = true;
                ?>
                <script>
                    var FetchmyForm = $('#FetchmyForm').serialize();

                  $.ajax({
                      type: "POST",
                      url: "./run_motor_buycar.php",
                      data: FetchmyForm,
                      success: function(response) {
                        console.log('送出成功');
                        // 处理成功响应
                        console.log('結果：' + response); // 这里处理服务器响应
                    },
                    error: function(xhr, status, error) {
                        console.log('送出失败');
                        // 处理错误
                    }
                  });
                </script>
                <?php
                unset($_SESSION['PayCardid']);   
                unset($_SESSION['viewmoney']);  

            }
            if($viewmoney!=""){
                $memberbuycar = $pdo->prepare("SELECT * FROM buycar");
                $memberbuycar->execute();
                while ($row = $memberbuycar->fetch(PDO::FETCH_ASSOC)) {
                    $FETR = $pdo->prepare('INSERT INTO transaction(tno,pno,transmid,pname,catalog,quantity,price,moneypay,cardid,tran_code,state) value (?,?,?,?,?,?,?,?,?,?,?)');
                    $FETR->execute([$add,$row['pno'],$row['mid'],$row['pname'],$row['catalog'],$row['quantity'],$row['price']*$row['quantity'] ,'Y','NAN' ,$row['state'],'交易完成']);
                   
                    $subtotal = $row['quantity'] * $row['price'];
                    $totalPrice += $subtotal;  // 累加至總金額

                    $upproductq = $pdo->prepare("UPDATE product SET quantity=? WHERE pno=?");
                    $upproductq->execute([$PD_quantity-$row['quantity'],$row['pno']]);
                }

                $upmoney = $pdo->prepare("UPDATE intermoney SET money=money-$totalPrice WHERE mid=?");
                $upmoney->execute([$mid]);
                

                $stmt = $pdo->prepare('DELETE FROM buycar WHERE mid = ?');
                $stmt->execute([$mid]);
                
                $showModal = true;
                $_SESSION['showModal'] = true;
                unset($_SESSION['viewmoney']);  

            }

        
        }
    
    }
}
if ($showModal) {
    ?>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var myModal = new bootstrap.Modal(document.getElementById('ShowProduct'));
            myModal.show();
        });
    </script>
    <?php
    unset($_SESSION['showModal']);
}



?>   

<script>
function updateProgressBar() {
    var progressBar = document.querySelector('.progress-bar');
    var Receive_Product=document.getElementById('Receive_Product');
    var randomValue = Math.floor(Math.random() * 10) + 1;
    var currentWidth = parseInt(progressBar.style.width);
    var newWidth = parseInt(progressBar.style.width) + randomValue;
    console.log(newWidth);
    if (newWidth >= 100) {
        newWidth = 100;
        Receive_Product.classList.remove('d-none');
        Receive_Product.classList.add('d-block');
    }
    progressBar.style.width = newWidth + '%';
    progressBar.setAttribute('aria-valuenow', newWidth);
    progressBar.innerText = newWidth + '%';
    if (newWidth < 100) {
        setTimeout(updateProgressBar, 100);
    }
}
updateProgressBar();


</script>




</body>
</html>

