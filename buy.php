<?php
session_start();
error_reporting(0);
$member = $_SESSION["email"];
$PtName = $_SESSION['PtName'];
// ! 測試用參數
//$member='a778899@gmail.com';
$mid = $_SESSION["mid"];
// 下方用完要註解掉
//$PtName='日常用品';
//$mid='3';
if ($mid == "") {
    header("Location: ./nologin");
}

// 
?>


<!DOCTYPE html>
<html lang="en" id="darkorlight" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>選擇商品</title>
    <script src="./js/kit.fontawesome.com_b8ad2c2a06.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/bootstrap.bundle.min.js"></script>
    <link rel="shortcut icon" href="./img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="./css/font.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/b8ad2c2a06.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="./js/jquery-3.7.1.min.js"></script>
</head>

<body>
    <form action="./buy" method="POST">
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


    <div class="container  mt-2">
        <div class="row">
            <?php
            require_once('ivm_database.php');
            $stmt = $pdo->prepare('select * from product');
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($row["catalog"] == $PtName) {
                    if ($row['quantity'] <= 0) {
                        $state = "disabled";
                        $state_img = "<img class=float-end  src=./img/紅燈.png width=10%>";
                    } elseif ($row['quantity'] <= 5 && $row['quantity'] >= 0) {
                        $state = "";
                        $state_img = "<img class=float-end src=./img/橘燈.png width=10%>";
                    } elseif ($row['quantity'] >= 5) {
                        $state = "";
                        $state_img = "<img class=float-end src=./img/綠燈.png width=10%>";
                    }
            ?>
                    <div class="col-6 col-md-4 mt-3">
                        <div id="D1" class="card bg-secondary m-2 bg-opacity-10">
                            <form action="./buy" method="post">
                                <button <?php echo $state; ?> style="outline: none;" name="onlick_name" value="<?php echo $row["pname"] . ',' . $row["img"] . ',' . $row['price'] . ',' . $row['quantity'] . ',' . $row['pno'] . ',' . $row['catalog']; ?>" class="btn w-100 h-100" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <?php echo $state_img; ?>
                                    <div class="card-body">
                                        <img class="button" src="<?php echo $row["img"]; ?>" width="65%" height="100%">
                                        <div class="text" style="font-size:18px;"><?php echo $row["pname"]; ?></div>
                                    </div>
                                </button>
                            </form>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>



    <?php


    $showModal = isset($_SESSION['showModal']) ? $_SESSION['showModal'] : false;
    if (isset($_POST["onlick_name"])) {
        $showModal = true;
        $_SESSION['showModal'] = true;
        $explodedData = explode(',', $_POST["onlick_name"]);
        if (count($explodedData) >= 4) {
            list($pname, $img, $price, $quantity, $pno, $catalog) = $explodedData;
            $_SESSION['onlick_pname'] = $pname;
            $_SESSION['onlick_img'] = $img;
            $_SESSION['onlick_price'] = $price;
            $_SESSION['onlick_quantity'] = $quantity;
            $_SESSION['onlick_pno'] = $pno;
            $_SESSION['onlick_catalog'] = $catalog;
        }
    }

    if ($showModal) {
    ?>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
                myModal.show();
            });
        </script>
    <?php
        unset($_SESSION['showModal']);
    }
    ?>


    <!-- 點下商品後出現的彈窗 -->
    <div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-4 col-md-4">
                                <!-- 左邊的圖片 -->
                                <img class="rounded d-block" src="<?php echo $_SESSION['onlick_img']; ?>" width="100%" height="100%">
                            </div>
                            <div class="col-8 col-md-8 mt-4">
                                <!-- 右邊的文字 -->
                                <p class="" style="font-size: 18px;">商品名稱：<?php echo $_SESSION['onlick_pname']; ?></p>
                                <p style="font-size: 18px;">數量：1</p>
                                <p style="font-size: 18px;">售價：<?php echo $_SESSION['onlick_price']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#closepay">結帳</button>
                    <form action="./buy" method="post">
                        <!-- TODO:! 加入購物車按鈕 -->
                        <button type="submit" class="btn btn-primary" name="AddBuyCar" id="AddBuyCar" data-bs-dismiss="modal">加入購物車</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- TODO:購物車圓標BuyCar -->
    <?php
    require_once('ivm_database.php');
    $buycarid = $pdo->prepare("SELECT * FROM buycar WHERE mid=$mid");
    $buycarid->execute();
    $buycount = $buycarid->rowCount();
    ?>
    <div class="position-fixed bottom-0 end-0 p-1 border border-2 rounded-circle bg-light bg-gradient shadow-lg mb-3 me-3" data-bs-toggle="modal" data-bs-target="#BuyCarModal">
        <div class="position-relative ">
            <img src="./img/shopping-bag.png">
            <span class="position-absolute top-100 start-100 translate-middle badge  bg-danger p-1 rounded-circle" style="font-size: 12px;" id="carcount" value=""></span>
        </div>
    </div>
    <!-- BuyCar Modal -->
    <div class="modal fade align-middle position-absolute top-50 start-50 translate-middle" id="BuyCarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="height: 70%;">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">我的購物袋</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="viewmycar" class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                    <button type="button" id="BuyCarnext" name="BuyCarnext" class="btn btn-primary" onclick="location.href='./buycar'">前往結帳</button>
                </div>
            </div>
        </div>
    </div>

    <!-- TODO:選擇付款方式 -->
    <div class="modal fade" id="closepay" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="text text-center" style="font-size: 20px;">選擇付款方式</div>
                                <table class="table mt-3 ">
                                    <tbody>
                                        <tr>
                                            <td><img src="./img/credit-card-solid-24.png"></td>
                                            <td class="align-middle">信用卡</td>
                                            <td class="align-middle"><input type="radio" class="form-check-input" value="cardpay" name="choosepaypd" id="cardpay"></td>
                                        </tr>
                                        <tr>
                                            <td><img src="./img/wallet-solid-24.png"></td>
                                            <td class="align-middle">電子錢包</td>
                                            <td class="align-middle"><input type="radio" class="form-check-input" value="moneypay" name="choosepaypd" id="moneypay"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-success" id="nextbutton" data-bs-toggle="modal">繼續</button>
                </div>
            </div>
        </div>
    </div>


    <?php
    $stmt = $pdo->prepare("SELECT * FROM card WHERE mid=$mid");
    $stmt->execute();
    $count = $stmt->rowCount();

    ?>


    <!-- TODO:按下信用卡後出現付款的彈窗 -->
    <form action="buy" method="post">
        <div class="modal fade" style="display: none;" id="MoneyPay" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <!-- 右邊的文字 -->
                                    <div class="text text-center" style="font-size: 20px;">選擇信用卡</div>
                                    <table class="table mt-3">
                                        <tbody>
                                            <?php
                                            if ($count == '0') {
                                                echo "<tr>";
                                                echo "<td class=text-center style=color:red>請先至'付款方式'新增信用卡</td>";
                                                echo "</tr>";
                                            } else {
                                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                    //判斷發卡組織
                                                    $visa = substr($row['cardid'], 0, 1);
                                                    $mas = substr($row['cardid'], 0, 2);
                                                    $jcb = substr($row['cardid'], 0, 4);
                                                    $four = substr($row['cardid'], 12, 4);
                                                    if ($visa == "4") {
                                                        $CardOrganize = "<img src=./img/card/visa.png width=50%>";
                                                    } elseif ($mas >= "51" and $mas <= "55") {
                                                        $CardOrganize = "<img src=./img/card/mastercard.png width=50%>";
                                                    } elseif ($jcb >= "3528" and $jcb <= "3589") {
                                                        $CardOrganize = "<img src=./img/card/jcb.png width=50%>";
                                                    }
                                                    echo "<tr>";
                                                    echo "<td>$CardOrganize</td>";
                                                    echo "<td class=fs-5 align-middle>$jcb********$four</td>";
                                                    echo "<td><input type=radio class=form-check-input value=$row[cardid] name=PayCardid></td>";
                                                    echo "</tr>";
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <p id="CheckPayRadio" class="text-danger d-none text-center">請先選擇付款方式</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="closecard" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                        <?php
                        if ($count != '0') {
                        ?><button type='submit' name='PayBut' class='btn btn-success'>繼續</button><?php
                        } else {
                        ?><button type='button' class='btn btn-success' onclick="location.href='./AddPay'">前往</button><?php
                         }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <?php
    require_once('ivm_database.php');
    $intermonry = $pdo->prepare("SELECT * FROM intermoney WHERE mid=$mid");
    $intermonry->execute();
    $midcount = $intermonry->rowCount();

    ?>
    <!-- TODO:按下電子錢包後出現付款的彈窗 -->
    <form action="./buy" method="post">
        <div class="modal" style="display: none;" id="IntermMoney" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="text text-center" style="font-size: 20px;">電子錢包</div>
                                    <?php
                                    if ($midcount == 0) {
                                        echo '<p class=mt-3 style=color:red;>您尚未建立電子錢包</p>';
                                    } else {
                                        while ($row = $intermonry->fetch(PDO::FETCH_ASSOC)) {
                                            $money = $row['money'];
                                    ?>
                                            <div class="card mt-3" style="background-color: pink;">
                                                <div class="card-title mx-2 text-white" style="font-size: 15px;">
                                                    IVM電子錢包
                                                </div>
                                                <div class="card-body">
                                                    <p class="fs-3 mt-5 pb-3 text-white" name="viewmoney" id="viewmoney">NT$ <?php echo $money; ?></p>
                                                </div>
                                                <div class="card-footer text-end border-0 bg-transparent">
                                                    <img class="" src="./img/logo.png" width="10%" height="10%">
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="closemoney" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                        <?php
                        if ($midcount == 0) {
                        ?>
                            <button type='button' class='btn btn-success' onclick="location.href='./InterMoney'">前往</button>
                        <?php
                        } else {
                        ?>
                            <button type="submit" class="btn btn-success" name="moneynext" id="moneynext" value="<?php echo $money; ?>" data-bs-toggle="modal">繼續</button>

                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </form>



    <div class="container mt-5">
        <div class="row">
            <div class="col-6">
                <div class="d-grid gap-2 col-8 col-md-6 mx-auto mb-5 w-75">
                    <button class="btn btn-outline-success" type="button" onclick="location.href='choose'">返回</button>
                </div>
            </div>
            <div class="col-6">
                <div class="d-grid gap-2 col-8 col-md-6 mx-auto mb-5 w-75">
                    <button class="btn btn-outline-success" id="nextbutton" type="button" data-bs-toggle="modal" data-bs-target="#Precautions">注意事項</button>
                </div>
            </div>
        </div>
    </div>

    <!-- class要加上show style要加上block -->
    <div class="modal" tabindex="-1" id="Precautions" style="display: block;">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-secondary bg-opacity-10">
                    <h5 class="modal-title ">注意事項</h5>
                </div>
                <div class="modal-body">
                    <p class="text-danger">本網站僅提供體驗與展示用途，因此並不會獲得任何實體商品。</p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th colspan="2" class="text-center fs-5"><b>燈號說明</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class=""><img src="./img/綠燈.png"></th>
                                <td class="table align-middle">商品存貨大於5</td>
                            </tr>
                            <tr>
                                <th><img src="./img/橘燈.png"></th>
                                <td class="table align-middle">商品存貨小於5</td>
                            </tr>
                            <tr>
                                <th><img src="./img/紅燈.png"></th>
                                <td class="table align-middle">商品暫時缺貨</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" id="ClosePrecautions" class="btn btn-secondary w-100" data-bs-dismiss="modal">關閉</button>
                </div>
            </div>
        </div>
    </div>
    <div id="ViewBackdrop" class="modal-backdrop show d-none"></div>



    <!-- 請先選擇付款方式 -->
    <div class="modal" id="ChoosePay" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    請先選擇付款方式
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success w-100" data-bs-toggle="modal" onclick="location.href='./buy'">確認</button>
                </div>
            </div>
        </div>
    </div>
    <div id="ViewChoosePayBackdrop" class="modal-backdrop show d-none"></div>
    </div>


    <!-- TODO:選擇付款完後後續得操作php -->
    <?php
    $model = 'onepd';
    if (isset($_POST['PayBut'])) {
        if (isset($_POST['PayCardid'])) {
            $_SESSION['tradingmodel'] = $model;
            $_SESSION['PayCardid'] = $_POST['PayCardid'];
            echo "
             <script>
             window.location.href='./SafetyPay';
             </script>
             ";
            exit();
        } else {
    ?>
            <script>
                var ChoosePay = document.getElementById('ChoosePay');
                var ViewChoosePayBackdrop = document.getElementById('ViewChoosePayBackdrop');
                ChoosePay.classList.add('show');
                ChoosePay.style.display = 'block';
                ViewChoosePayBackdrop.classList.remove('d-none');
                ViewChoosePayBackdrop.classList.add('d-block');
            </script>
        <?php
        }
    }
    if (isset($_POST['moneynext'])) {
        $_SESSION['viewmoney'] =  $_POST['moneynext'];
        if ($_SESSION['viewmoney'] >= $_SESSION['onlick_price']) {
            $_SESSION['tradingmodel'] = $model;
            echo "
            <script>
                window.location.href='./SafetyPay';
            </script>
            ";
            exit();
        } else {
        ?>
            <script>
                var ChoosePay = document.getElementById('ChoosePay');
                var ViewChoosePayBackdrop = document.getElementById('ViewChoosePayBackdrop');
                ChoosePay.classList.add('show');
                ChoosePay.style.display = 'block';
                ViewChoosePayBackdrop.classList.remove('d-none');
                ViewChoosePayBackdrop.classList.add('d-block');
            </script>
    <?php
        }
    }
    if (isset($_POST['logout'])) {
        echo "
        <script>
        window.location.href='./login';
        </script>
        ";
        session_destroy();
    }
    ?>

    <script>
        var Precautions = document.getElementById("Precautions");
        var ViewBackdrop = document.getElementById('ViewBackdrop');
        var ClosePrecautions = document.getElementById('ClosePrecautions');
        const ClosePrecautionsCookie = document.cookie.replace(/(?:(?:^|.*;\s*)ClosePrecautions\s*=\s*([^;]*).*$)|^.*$/, "$1");
        Precautions.classList.add('show');
        Precautions.style.display = 'block';
        ViewBackdrop.classList.remove('d-none');
        ViewBackdrop.classList.add('d-block');

        function setCookie(name, value, daysToExpire) {
            const expires = new Date();
            expires.setDate(expires.getDate() + daysToExpire);
            const cookieString = `${encodeURIComponent(name)}=${encodeURIComponent(value)};expires=${expires.toUTCString()};path=/`;
            document.cookie = cookieString;
        }

        ClosePrecautions.addEventListener('click', function() {
            setCookie('ClosePrecautions', 'none', 5);
            Precautions.classList.remove('show');
            Precautions.style.display = 'none';
            ViewBackdrop.classList.remove('d-block');
            ViewBackdrop.classList.add('d-none');
            console.log('All Cookies:', ClosePrecautionsCookie);
        });

        if (ClosePrecautionsCookie == "none") {
            Precautions.classList.remove('show');
            Precautions.style.display = 'none';
            ViewBackdrop.classList.remove('d-block');
            ViewBackdrop.classList.add('d-none');
        }

        function randommath() {
            // 
            const min = 100000;
            const max = 999999;
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }

        //TODO:撈取加入購物車的資料新增至資料庫

        <?php
        $carstmt = $pdo->prepare("SELECT * FROM buycar WHERE mid=$mid");
        $carstmt->execute();
        $buycarcount = $carstmt->rowCount();

        if (isset($_POST['AddBuyCar'])) {
            require_once('ivm_database.php');
            // 從 SESSION 中取得相關資訊
            $mid = $_SESSION['mid'];
            $pno = $_SESSION['onlick_pno'];
            $pname = $_SESSION['onlick_pname'];
            $catalog = $_SESSION['onlick_catalog'];
            $price = $_SESSION['onlick_price'];

            // 檢查購物車中是否已存在相同商品
            $buycarid = $pdo->prepare("SELECT * FROM buycar WHERE mid = :mid AND pname = :pname");
            $buycarid->execute(['mid' => $mid, 'pname' => $pname]);
            $existingItem = $buycarid->fetch(PDO::FETCH_ASSOC);

            if ($existingItem) {
                // 商品已存在，更新數量
                $newQuantity = $existingItem['quantity'] + 1;
                $updateStmt = $pdo->prepare("UPDATE buycar SET quantity = :newQuantity WHERE mid = :mid AND pname = :pname");
                $updateStmt->execute(['newQuantity' => $newQuantity, 'mid' => $mid, 'pname' => $pname]);
            } else {
                // 商品不存在，新增至購物車
                $insertStmt = $pdo->prepare("INSERT INTO buycar (mid, pno, pname, catalog, quantity, price) VALUES (:mid, :pno, :pname, :catalog, 1, :price)");
                $insertStmt->execute(['mid' => $mid, 'pno' => $pno, 'pname' => $pname, 'catalog' => $catalog, 'price' => $price]);
            }


            $buycount = $carstmt->rowCount();

        ?>
            // var  viewcount=$('#carcount');
            // var currentValue = parseInt(viewcount.val(), 10); // 將取得的值轉換為整數
            // viewcount.text(currentValue+1);
            // console.log(currentValue+1);
        <?php
        }
        ?>

        $(document).ready(function() {
            // 在页面加载时绑定事件
            bindDeleteCartItemEvent();
            bindCartEvents();
            // 使用.load()方法加载新内容后，重新绑定事件
            $(function() {
                $("#viewmycar").load('./buycar.php #mycartable > .cont', function() {
                    $(this).find('.cont').addClass('card');
                    // 加载完成后重新绑定删除事件
                    bindDeleteCartItemEvent();
                });
            });
        });

        function bindDeleteCartItemEvent() {
            $('.delcarpd').on('click', function() {
                var bcarid = $(this).data('bcarid');
                var $cartItem = $(this).closest('.cartItem');

                $.ajax({
                    type: "POST",
                    url: "delcar.php",
                    data: {
                        bcarid: bcarid
                    },
                    success: function(response) {
                        //console.log(response);
                        $cartItem.remove();
                        updateCartCount(); // 删除成功后更新购物车数量显示
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        }

        function updateCartCount() {
            $.ajax({
                type: "GET",
                url: "get_cart_count.php", // 根据实际情况填写获取购物车数量的后端接口
                success: function(response) {
                    $('#carcount').text(response); // 更新购物车数量显示
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
        $(document).ready(function() {
            // 初始化购物车数量显示
            updateCartCount();

            // 监听删除按钮的点击事件
            $('.delcarpd').on('click', function() {
                var bcarid = $(this).data('bcarid');
                var $cartItem = $(this).closest('.cartItem');

                $.ajax({
                    type: "POST",
                    url: "delcar.php",
                    data: {
                        bcarid: bcarid
                    },
                    success: function(response) {
                        console.log(response);
                        $cartItem.remove();
                        updateCartCount(); // 删除成功后更新购物车数量显示
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });

        function bindCartEvents() {
            // 監聽購物車畫面中下拉選單的變更事件
            $(document).on('change', '.quantity-select', function() {
                var bcarid = $(this).data('bcarid'); // 獲取購物車項目的 ID
                var newQuantity = $(this).val(); // 獲取新的數量值

                // 使用 AJAX 向後端發送請求，更新資料庫中的數量
                $.ajax({
                    type: 'POST',
                    url: 'updata_quantity.php',
                    data: {
                        bcarid: bcarid,
                        newQuantity: newQuantity
                    },
                    success: function(response) {
                        console.log('數量更新成功');
                        // 可以在此處執行更新成功後的操作，例如更新畫面或顯示提示訊息
                    },
                    error: function() {
                        console.log('發生錯誤，無法更新數量');
                        // 可以在此處處理錯誤情況，例如顯示錯誤訊息
                    }
                });
            });
        }

        $(document).ready(function() {
            $('#nextbutton').on('click', function() {
                var selectedPayment = $('input[name="choosepaypd"]:checked').val();

                if (selectedPayment === 'cardpay') {
                    console.log('信用卡支付');
                    $('#MoneyPay').css('display', 'block');
                    $('#MoneyPay').addClass('show');
                    $('#ViewBackdrop').removeClass('d-none');
                    $('#ViewBackdrop').addClass('d-block')
                    $('#closecard').on('click', function() {
                        $('#MoneyPay').css('display', 'none');
                        $('#MoneyPay').removeClass('show');
                        $('#ViewBackdrop').removeClass('d-block');
                        $('#ViewBackdrop').addClass('d-none')
                    });
                } else if (selectedPayment === 'moneypay') {
                    console.log('電子錢包支付');
                    $('#IntermMoney').css('display', 'block');
                    $('#IntermMoney').addClass('show');
                    $('#ViewBackdrop').removeClass('d-none');
                    $('#ViewBackdrop').addClass('d-block')
                    $('#closemoney').on('click', function() {
                        $('#IntermMoney').css('display', 'none');
                        $('#IntermMoney').removeClass('show');
                        $('#ViewBackdrop').removeClass('d-block');
                        $('#ViewBackdrop').addClass('d-none')
                    });
                }
            });
        });
    </script>
</body>

</html>