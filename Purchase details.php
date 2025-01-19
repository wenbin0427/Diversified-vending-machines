<?php
    session_start();
    //error_reporting(0); 
    $member=$_SESSION["email"];
    $mid = $_SESSION['mid'];
    // ! 導覽列部分
    if($mid==""){
        header("Location: ./nologin");
    }
    if(isset($_POST['logout'])){
        session_destroy();
        header("Location: login.php");
    }

?>
<!DOCTYPE html>
<html lang="en" id="darkorlight" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>購買明細</title>
    <script src="./js/kit.fontawesome.com_b8ad2c2a06.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <script src="./js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./css/font.css">
    <link rel="shortcut icon" href="./img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="./css/anaition.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

</head>

<body>
<form action="./Purchase details" method="POST">
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
    $transaction = $pdo->prepare("SELECT * FROM transaction WHERE transmid=$mid ORDER BY transtime DESC LIMIT 1");
    $transaction->execute();

    $trans_history = $pdo->prepare("SELECT * FROM transaction WHERE transmid=$mid ORDER BY transtime ASC");
    $trans_history->execute();

    $product = $pdo->prepare("SELECT * FROM product");
    $product->execute();

?>

<div class="container">
    <div class="row">
        <div class="col-12 col-xl-6 mt-2 mx-auto">
            <p class="text fs-5">目前正在處理的訂單</p>
            <?php
                while ($row = $transaction->fetch(PDO::FETCH_ASSOC)) {
                    if($mid==$row['transmid'] && $row['state']=="尚未驗證"){
                        $TranImgPno=$row['pno'];
                        $state=$row['state'];
                        $TranTno=$row['tno'];
                        $Tran_time=$row['transtime'];

            ?>
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4"><?php echo $row['pname']; ?></div>
                                    <div class="col-8 text-end"><?php echo $Tran_time; ?></div>
                                    <div class="col-4 col-md-4 mt-1">
                                        <!-- 左邊的圖片 -->
                                        <?php
                                            while ($row = $product->fetch(PDO::FETCH_ASSOC)) {
                                                if($TranImgPno==$row['pno']){

                                        ?>
                                        <img class="mx-auto img-fluid d-block" src="<?php echo $row['img']; ?>" width="100%" height="90%">
                                    </div>
                                    <div class="col-8 col-md-8 mt-4">
                                        <!-- 右邊的文字 -->
                                        <span style="font-size: 18px;">訂單編號：<?php echo $TranTno; ?></span><br>
                                        <span style="font-size: 18px;">數量：1</span><br>
                                        <span style="font-size: 18px;">售價：<?php echo $row['price']; ?></span><br>
                                        <span style="font-size: 18px;">狀態：<span class="text-danger"><?php echo $state;?></span></span>
                                        <br>
                                        <span style="font-size: 18px;"> <a href="./Fetch"><kbd class="bg-success">前往驗證</kbd></a></span>
                                    </div>
                                    <?php
                                            }
                                        }
                                        ?>
                                </div>
                                <div class="position-relative m-4">
                                    <div class="progress" role="progressbar" aria-label="Progress" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="height: 1px;">
                                      <div class="progress-bar" style="width: 50%"></div>
                                      <div class="progress-bar d-none" style="width: 50%"></div>

                                    </div>
                                    <button type="button" class="position-absolute top-0 start-0 translate-middle btn btn-sm btn-primary rounded-pill px-1" style="width: 2.5rem; height:2rem;"><box-icon name='cart-download' type='solid' color='#f1f3f2' ></box-icon></button>
                                    <button type="button" class="position-absolute top-0 start-50 translate-middle btn btn-sm btn-primary rounded-pill px-1" style="width: 2.5rem; height:2rem;"><box-icon name='loader' color='#f1f3f2' ></box-icon></button>
                                    <button type="button" class="position-absolute top-0 start-100 translate-middle btn btn-sm btn-secondary rounded-pill px-1" style="width: 2.5rem; height:2rem;"><box-icon name='x' color='#f1f3f2'></box-icon></button>
                                </div>
                                <div class="row">
                                    <div class="col w-100">下訂單</div>
                                    <div class="col w-100 text-center me-4">等待驗證</div>
                                    <div class="col w-100 text-end px-0">訂單完成</div>
                                </div>
                                
                            </div>
                        </div>
            <?php
                                }else{
                                    echo "<p class=text-body-tertiary>您目前沒有正在處理的訂單</p>";
                                }
                            }
            ?>
            <p class="text fs-5 mt-5">歷史訂單</p>
            <?php
                $product = $pdo->prepare("SELECT * FROM product");
                $product->execute();
                while ($trans_row = $trans_history->fetch(PDO::FETCH_ASSOC)) {
                    if($trans_row['state']=="交易完成" || $trans_row['state'] =="已失效"){
                        $trans_pno=$trans_row['pno'];
                        $trans_tno=$trans_row['tno'];
                        $trans_pname=$trans_row['pname'];
                        $trans_time=$trans_row['transtime'];
                        $trans_price=$trans_row['price'];
                        if($trans_row['state']=='交易完成'){
                            $trans_state="<span class=text-black>$trans_row[state]</span>";
                            $verify="驗證完成";
                            $Order_Status="訂單完成";
                            $Order_color="btn-success";
                            $Order_icon="<box-icon name='check' color='#f1f3f2' ></box-icon>";
                            $Order_progress="d-block";
                        }else{
                            $trans_state="<span class=text-danger>$trans_row[state]</span>";
                            $verify="尚未驗證";
                            $Order_Status="訂單取消";
                            $Order_color="btn-secondary";
                            $Order_icon="<box-icon name='x' color='#f1f3f2'></box-icon>";
                            $Order_progress="d-none";
                        }
                        while ($row = $product->fetch(PDO::FETCH_ASSOC)) {
                            if($trans_pno==$row['pno']){
                                $viewimg=$row['img'];
                            }}
                            $product->execute();
                        ?>

                            <div class="card shadow-sm mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4"><?php echo $trans_pname; ?></div>
                                        <div class="col-6"><?php echo $trans_time; ?></div>
                                        <div class="col-2 downbt"><box-icon type='solid' name='chevron-down'></box-icon></div>
                                        <!-- 這邊viewtran要寫要顯示的詳細資料 -->
                                        <div class="viewtran d-none">
                                            <div class="row">
                                                <div class="col-4 col-md-4">
                                                    <img class="mx-auto img-fluid d-block" src="<?php echo $viewimg ;?>" width="100%" height="90%">
                                                </div>
                                                <div class="col-8 col-md-8 mt-4">
                                                    <!-- 右邊的文字 -->
                                                    <span style="font-size: 18px;">訂單編號：<?php echo $trans_tno; ?></span><br>
                                                    <span style="font-size: 18px;">數量：1</span><br>
                                                    <span style="font-size: 18px;">售價：<?php echo $trans_price; ?></span><br>
                                                    <span style="font-size: 18px;">狀態：<span class=""><?php echo $trans_state;?></span></span>
                                                </div>
                                            </div>
                                            <div class="position-relative m-4">
                                                <div class="progress" role="progressbar" aria-label="Progress" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="height: 1px;">
                                                  <div class="progress-bar" style="width: 50%"></div>
                                                  <div class="progress-bar <?php echo $Order_progress; ?>" style="width: 50%"></div>



                                                </div>
                                                <button type="button" class="position-absolute top-0 start-0 translate-middle btn btn-sm btn-primary rounded-pill px-1" style="width: 2.5rem; height:2rem;"><box-icon name='cart-download' type='solid' color='#f1f3f2' ></box-icon></button>
                                                <button type="button" class="position-absolute top-0 start-50 translate-middle btn btn-sm px-1 <?php echo $Order_color;?> rounded-pill" style="width: 2.5rem; height:2rem;"> <?php echo $Order_icon;?></button>
                                                <button type="button" class="position-absolute top-0 start-100 translate-middle btn btn-sm px-1 <?php echo $Order_color;?> rounded-pill" style="width: 2.5rem; height:2rem;"><?php echo $Order_icon;?></button>
                                            </div>
                                            <div class="row">
                                                <div class="col w-100">下訂單</div>
                                                <div class="col w-100 text-center me-4"><?php echo $verify; ?></div>
                                                <div class="col w-100 text-end px-0"><?php echo $Order_Status; ?></div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
            }
        }
            ?>
        </div>
    </div>
</div>


<script>
document.addEventListener("DOMContentLoaded",function(){var a=document.querySelectorAll(".downbt");a.forEach(function(b){b.addEventListener("click",function(){var c=b.nextElementSibling;c.classList.toggle("d-none")})})});

</script>


</body>
</html>

