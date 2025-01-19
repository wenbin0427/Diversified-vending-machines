<?php
    session_start();
    //error_reporting(0); 
    $member=$_SESSION["email"];
    ob_start(); // 開始緩衝輸出
    if($member==""){
        header("Location: ./nologin");
    }
?>
<!DOCTYPE html>
<html lang="en" id="darkorlight" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>主選單</title>
    <script src="./js/kit.fontawesome.com_b8ad2c2a06.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./css/font.css">
    <link rel="shortcut icon" href="./img/logo.png" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400&display=swap" rel="stylesheet">

</head>
<body>
<form action="./choose" method="POST">
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
    
    <div class="container">
        <div class="row">
            <div class="col-12 mt-3">
                <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                      <div class="carousel-item active" data-bs-interval="3000" >
                        <img src="./使用者/輪播圖1_修.png" class="d-block w-100"  >
                      </div>
                      <div class=
                      "carousel-item" ata-bs-interval="3000" >
                        <img src="./使用者/輪播圖2_修.png" class="d-block w-100" >
                      </div>
                      <div class="carousel-item" ata-bs-interval="3000" >
                        <img src="./使用者/輪播圖3_修.png" class="d-block w-100" >
                      </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                </div>
        </div>
    </div>
    <div class="container text-center">
        <div class="row">
            <div class="col-12">
                <div class="d-flex flex-column flex-md-row">
                    <div id="D1" class="card bg-secondary m-2 bg-opacity-10" >
                            <form action="./choose" method="post">
                                <div class="card-body ">
                                    <img class="button" src="./img/日用品圖.png" width="50%" height="70%">
                                    <p class="fs-5">日常用品</p>
                                    <div><button name="ShoppingBuy" class="btn btn-success" value="日常用品">購買</button></div>
                                </div>
                            </form>
                        </div>
                        <div id="D1" class="card bg-secondary m-2 bg-opacity-10" >
                            <form action="./choose" method="post">
                                <div class="card-body">
                                    <img class="button" src="./img/飲料圖.png" width="50%" height="70%">
                                    <p class="fs-5">飲料</p>
                                    <div><button name="ShoppingBuy" class="btn btn-success" value="飲料">購買</button></div>
                                </div>
                            </form>
                        </div>
                        <div id="D1" class="card bg-secondary m-2 bg-opacity-10" >
                            <form action="./choose" method="post">
                                <div class="card-body">
                                    <img class="button" src="./img/餅乾圖.png" width="50%" height="70%">
                                    <p class="fs-5">餅乾</p>
                                    <div><button name="ShoppingBuy" class="btn btn-success" value="餅乾">購買</button></div>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
<br>
<?php
require_once('ivm_database.php'); 
$stmt=$pdo->prepare('select * from member');
$stmt->execute();
while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    if($member==$row['email']){
        $SEI=$row['mid'];   //找到mid存入$SEI
        $UserName=$row['name'];
        $_SESSION["mid"]=$SEI; //把SEI的值放入監聽
        $_SESSION['UserName']=$UserName;
        // $mid=$_SESSION['mid']; 取得監聽用
    }
  }



if(isset($_POST['ShoppingBuy'])){
    $_SESSION['PtName']=$_POST['ShoppingBuy'];
    header("Location: ./buy");

}


// ! 導覽列部分

if(isset($_POST['logout'])){
    session_destroy();
    header("Location: login");

}
ob_end_flush(); // 將輸出送到瀏覽器

?>   


</body>
</html>

