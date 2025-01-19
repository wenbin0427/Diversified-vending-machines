<?php
    session_start();
    error_reporting(0); 
    $member=$_SESSION["email"];
    $name=$_SESSION['UserName'];
    ob_start(); // 開始緩衝輸出
    if($member==""){
        header("Location: ./nologin");
    }
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
    <title>開發歷程</title>
    <script src="./js/kit.fontawesome.com_b8ad2c2a06.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./css/font.css">
    <link rel="shortcut icon" href="./img/logo.png" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400&display=swap" rel="stylesheet">
    <script src="./js/jquery-3.7.1.min.js"></script>

</head>
<body>
<form action="./interface" method="POST">
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

<div class="container mt-5" id="ViewCard">
    <div class="row">
        <div class="col-sm-4 col-12 mx-auto position-absolute top-50 start-50 translate-middle z-1 text-center">
            <div class="card">
                <div class="card-body">
                    <div class="card-text text-start">
                        親愛的<?php echo $name; ?>您好<br>
                        謝謝您體驗本小組設計的網站<br>
                        此頁面的發想是為了讓您了解本小組的設計經過及製作進度<br>
                        本網站也將採不定時更新及維護<br>
                        如有疑問可<span style="font-size: 18px;"><a class="" href="./contact"><kbd class="bg-success">點此</kbd></a></span>與我們聯絡
                    </div>
                    <button class="btn btn-success mt-5" id="Look">點此觀看</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5" id="ViewContainer" style="display:none;">
    <div class="row">
        <div class="col-sm-4 col-12 position-absolute top-50 start-50 translate-middle mx-auto z-1">
            <div class="card">
                <div class="menubt card-body text-center">
                    <div id="carouselExample" class="carousel slide px-4" data-bs-ride="carousel">
                        <div class="rightcontainer"></div>
                    </div>
                    <hr>
                    <button class="" type="button" id="new_UI" href="./interface_new.html">新版介面</button>
                    <button class="" type="button" id="old_UI" href="./interface_old.html">舊版介面</button>
                    <button class="" type="button" id="dev_UI" href="./devlop.html">開發進度</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
     $('#Look').click(function(){
         $('#ViewCard').hide();
         $('#ViewContainer').show();
     });
    $(function() {
        $(".menubt>button").click(function (e) {
          $(".menubt>button.selected").removeClass();
          $('.menubt>button').addClass('btn btn-primary mx-2');
          $(".rightcontainer").load($(this).addClass("selected").attr("href"));

          e.preventDefault();
      }).first().click();
    });
    var ChickLook = document.getElementById('ChickLook');
    ChickLook.addEventListener('click', function() {
        var navbar = document.getElementById('Dropdown');
        if (navbar.style.display === 'block') {
            navbar.style.display = 'none'; // 如果已经展开，则隐藏
            navbar.classList.remove='navbar-collapse collapse show';
            navbar.classList.add='navbar-collapse collapse';
            ChickLook.setAttribute=('aria-expanded','false');

        } else {
            navbar.style.display = 'block'; // 如果折叠，则显示
            navbar.classList.remove='navbar-collapse collapse';
            navbar.classList.add='navbar-collapse collapse show';
            ChickLook.setAttribute=('aria-expanded','true');
        }
    });


</script>


</body>
</html>

