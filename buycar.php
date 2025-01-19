<?php
session_start();
error_reporting(0);
$member = $_SESSION["email"];
$PtName = $_SESSION['PtName'];
// ! 測試用參數
//$member='a778899@gmail.com';
$mid = $_SESSION["mid"];
if ($mid == "") {
    header("Location: ./nologin");
}


?>

<!DOCTYPE html>
<html lang="en" id="darkorlight" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>購物袋</title>
    <link rel="shortcut icon" href="./img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="./css/font.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/kit.fontawesome.com_b8ad2c2a06.js" crossorigin="anonymous"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/b8ad2c2a06.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="./js/jquery-3.7.1.min.js"></script>
</head>

<body>
     <form action="./buycar" method="POST">
        <nav class="navbar  navbar-expand-lg shadow p-1 bg-body rounded z-2">
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
    $buycarid = $pdo->prepare("SELECT * FROM buycar WHERE mid=$mid");
    $buycarid->execute();
    $buycount = $buycarid->rowCount();
    $productimg = $pdo->prepare("SELECT * FROM product");
    ?>
    <div class="modal show d-block mt-5 h-75 position-absolute top-50 start-50 translate-middle z-1" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div id="mycartable" class="modal-content">
                <div class="modal-header">
                    <span class="fs-3">
                        <img class="align-text-top" src="./img/shopping-bag.png" width="40" height="40">
                        我的購物袋
                    </span>
                </div>
                <div class="cont modal-body">
                    <?php
                    if ($buycount == 0) {
                    ?>
                    <?php
                        echo '<span style=color:red;>您的購物袋是空的趕快去購買商品吧！</span>';
                    } else {
                    ?>
                        <form action="./buycar" method="post" id="myForm">
                            <table class="table table-borderless" style="height: 100%;width:100%;">
                                <tbody>
                                    <?php
                                    while ($row = $buycarid->fetch(PDO::FETCH_ASSOC)) {
                                        $bcarid = $row['bcarid'];
                                        $pname = $row['pname'];
                                        $quantity = $row['quantity'];
                                        $pno = $row['pno'];
                                        $price = $row['price'];

                                        $subtotal = $quantity * $price;
                                        $totalPrice += $subtotal;  // 累加至總金額
                                        $totalQuantity += $quantity;  // 累加至總數量
                                        $coun=$productimg->execute();
                                        while ($row = $productimg->fetch(PDO::FETCH_ASSOC)) {
                                            if ($row['pno'] == $pno) {
                                                $img = $row['img'];

                                    ?>
                                                <tr class="cartItem">
                                                    <td class="col-2 "><img src="<?php echo $img; ?>" width="100%"></td>
                                                    <td class="col-4 align-middle text-start"><?php echo $pname; ?></td>
                                                    <td class="col-4 align-middle text-center">
                                                        <select class="form-select quantity-select" data-bcarid="<?php echo $bcarid; ?>">
                                                            <?php
                                                            // 設定下拉選單的選項
                                                            $defaultQuantity = isset($quantity) ? $quantity : 1; // 如果 $quantity 未設置，預設為 1

                                                            // 動態生成下拉選單的選項
                                                            for ($i = 1; $i <= 3; $i++) {
                                                                // 判斷是否是預設選項
                                                                $selected = ($i == $defaultQuantity) ? 'selected' : '';
                                                    
                                                                echo '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td id="old_price" class="col-1 align-middle text-center"><?php echo $price; ?></td>
                                                    <td class="col-1 align-middle text-center"><button type="button" name="delcarpd" id="delcarpd" class="btn btn-danger delcarpd" data-bcarid="<?php echo $bcarid; ?>">X</button></td>
                                                </tr>
                                <?php
                                            }
                                        }
                                        
                                    }

                                }

                                ?>
                                </tbody>
                            </table>
                </div>
                <div class="modal-footer">
                    <table class="table table-borderless">
                        <tbody class="">
                            <tr>
                                <td data-value="<?php echo $totalQuantity; ?>" id="text_quantity">共<?php echo $totalQuantity; ?>件物品</td>
                                <td data-value="<?php echo $totalPrice; ?>" id="text_price">總金額：<?php echo $totalPrice; ?></td>

                            </tr>
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-primary w-100" name="BuyCarnext" id="BuyCarnext">結帳</button>
                    
                </div>
            </div>
        </div>
    </div>
    </form>

<!-- TODO:選擇付款方式 -->
<div class="modal fade" id="closepay" style="display: none;" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                 <button type="button" class="btn btn-secondary" id="closepaybt" data-bs-dismiss="modal">取消</button>
                 <button type="button" class="btn btn-success" id="nextbutton" data-bs-toggle="modal">繼續</button>
             </div>
         </div>
     </div>
 </div>
 <div id="Backdrop" class="modal-backdrop show d-none"></div>

 <?php
    $stmt = $pdo->prepare("SELECT * FROM card WHERE mid=$mid");
    $stmt->execute();
    $count = $stmt->rowCount();

    ?>


    <!-- TODO:按下信用卡後出現付款的彈窗 -->
    <form action="./buycar" method="post">
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
    <form action="./buycar" method="post">
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
 <div id="ViewBackdrop" class="modal-backdrop show d-none"></div>
 <div class="modal" id="ChoosePay" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    請先選擇付款方式
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success w-100" data-bs-dismiss="modal" onclick="location.href='./buycar'">確認</button>
                </div>
            </div>
        </div>
    </div>
    <div id="ViewChoosePayBackdrop" class="modal-backdrop show d-none"></div>
<?php
$model = 'manypd';
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

?>

    <script>
         $(document).ready(function() {
             $('#BuyCarnext').on('click',function(){
                 var closepay=$('#closepay');
                 var Backdrop=$('#Backdrop');

                 closepay.css('display','block');
                 closepay.addClass('show')
                 Backdrop.removeClass('d-none');
                 Backdrop.addClass('d-block');

                 $('#closepaybt').on('click',function(){
                     closepay.css('display','none');
                     closepay.removeClass('show')
                     Backdrop.removeClass('d-block');
                     Backdrop.addClass('d-none');

                 })

             })

            $('#nextbutton').on('click', function() {
                var selectedPayment = $('input[name="choosepaypd"]:checked').val();
                var ViewBackdrop=$('#ViewBackdrop');

                if (selectedPayment === 'cardpay') {
                    console.log('信用卡支付');
                    $('#MoneyPay').css('display', 'block');
                    $('#MoneyPay').addClass('show');
                    ViewBackdrop.removeClass('d-none');
                    ViewBackdrop.addClass('d-block');
                    $('#closecard').on('click', function() {
                        $('#MoneyPay').css('display', 'none');
                        $('#MoneyPay').removeClass('show');
                        ViewBackdrop.removeClass('d-block');
                        ViewBackdrop.addClass('d-none');

                    });
                } else if (selectedPayment === 'moneypay') {
                    console.log('電子錢包支付');
                    $('#IntermMoney').css('display', 'block');
                    $('#IntermMoney').addClass('show');
                    ViewBackdrop.removeClass('d-none');
                    ViewBackdrop.addClass('d-block');
                    $('#closemoney').on('click', function() {
                        $('#IntermMoney').css('display', 'none');
                        $('#IntermMoney').removeClass('show');
                        ViewBackdrop.removeClass('d-block');
                        ViewBackdrop.addClass('d-none');

                    });
                }
            });


            // 監聽刪除按鈕的點擊事件
            $('.delcarpd').on('click', function() {
                // 獲取點擊按鈕的 data-bcarid 屬性值
                var bcarid = $(this).data('bcarid');

                var bcarid1 = $(this).closest('.cartItem').data('bcarid');
                var $cartItem = $(this).closest('.cartItem'); // 獲取要刪除的商品項目        console.log(bcarid);
                // 發送 AJAX 請求到 delcar.php
                $.ajax({
                    type: "POST",
                    url: "delcar.php",
                    data: {
                        bcarid: bcarid
                    },
                    success: function(response) {
                        // 處理後端返回的成功回應
                        console.log(response);


                        $cartItem.remove(); // 刪除該商品項目的 DOM 元素

                    },
                    error: function(xhr, status, error) {
                        // 處理 AJAX 請求失敗的情況
                        console.error(error);
                    }
                });
            });


    // 使用 jQuery 監聽下拉選單的變更事件

        $('.quantity-select').change(function() {
            const bcarid = $(this).data('bcarid'); // 獲取購物車項目的ID
            const newQuantity = $(this).val(); // 獲取新的數量值
            
        
            // 使用 AJAX 向後端發送請求，更新資料庫中的數量
            $.ajax({
                type: 'POST',
                url: 'updata_quantity.php',
                data: { bcarid: bcarid, newQuantity: newQuantity },
                success: function(response) {
                    console.log('數量更新成功');
                    location.reload();
                    // 可以在此處執行更新成功後的操作，例如更新畫面或顯示提示訊息
                },
                error: function() {
                    console.log('發生錯誤，無法更新數量');
                    // 可以在此處處理錯誤情況，例如顯示錯誤訊息
                }
            });
        });
    });


    </script>


</body>

</html>