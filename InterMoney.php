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
//$mid='2';
if ($mid == "") {
    header("Location: ./nologin");
}
if (isset($_POST['PayBut'])) {
    if (isset($_POST['PayCardid'])) {
        $_SESSION['PayCardid'] = $_POST['PayCardid'];
        header("Location:./SafetyPay");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en" id="darkorlight" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>電子錢包</title>
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
<form action="./choose" method="POST">
        <nav class="navbar  navbar-expand-lg shadow p-1 bg-body rounded z-1">
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
    $intermonry = $pdo->prepare("SELECT * FROM intermoney WHERE mid=$mid");
    $intermonry->execute();
    $midcount = $intermonry->rowCount();
    if($midcount==0){
        //$insertmoney = $pdo->prepare("INSERT INTO intermoney (mid, money) VALUES (?,?)");
        //$insertmoney->execute([$mid,'0']);
?>
        <div id="initial" class="container">
            <div class="row ">
                <div class="col-12 col-sm-6 mt-5 mx-auto">
                    <div class="card shadow">
                        <div class="card-title mx-auto mt-3">
                            <img src="./img/wallet-solid-24.png" alt="" srcset="" width="100" height="100%"><br>
                        </div>
                        <div class="card-body">
                            <div class="row mt-3">
                                <div class="col-6">
                                    <button class="btn btn-secondary w-100" onclick="location.href='./choose'">取消</button>
                                </div>
                                <div class="col-6">
                                    <button type="button" id="CreateMoneyPay" class="btn btn-success w-100" value="<?php echo $mid; ?>">建立我的電子錢包</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    }else

        while ($row = $intermonry->fetch(PDO::FETCH_ASSOC)) {
            $money=$row['money'];
    ?>
    
    <div id="viewMoneyPay" class="container z-2">
        <div class="row">
            <div class="col-12 col-sm-6 mt-5 mx-auto">
                <div class="card shadow" style="background-color: pink;">
                    <div class="card-title mx-2 text-white" style="font-size: 15px;">
                        IVM電子錢包
                    </div>
                    <div class="card-body">
                        <p class="fs-3 mt-5 pb-3 text-white" id="viewmoney" data-value="<?php echo $money;?>"></p>
                    </div>
                    <div class="card-footer text-end border-0 bg-transparent">
                        <img class="" src="./img/logo.png" width="10%" height="10%">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <button class="btn btn-success w-100" onclick="location.href='./choose'">返回</button>
                    </div>
                    <div class="col-6">
                        <button type="button" id="stored" class="btn btn-primary w-100">儲值</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#viewmoney').text("NT$ "+<?php echo $money;?>);
    </script>

    <?php
        }
        // if(isset($_POST['StoredMoney'])){
        //     $inpmoney=$_POST['inpmoney'];
        //     $upintermoney = $pdo->prepare("UPDATE intermoney SET money = ? WHERE mid = ? ");
        //     $upintermoney->execute([$money+$inpmoney,$mid]);
        // }

    ?>
    <div id="myform" class="container d-none">
        <form  action="./InterMoney" method="post" >
        <div class="row">
            <div class="col-12 col-sm-6 mt-5 mx-auto">
                <div class="card">
                    <div class="card-title text-center mt-3 fs-5">
                        儲值
                    </div>
                    <div class="card-body">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">$</span>
                            <input type="number" id="inpmoney" name="inpmoney" class="form-control" placeholder="請輸入欲儲值金額" value="1">
                        </div>
                        <div class="form-check mt-3 mb-2">
                            <input name="checkterms" class="form-check-input" type="checkbox" id="checkterms" >
                            <label class="form-check-label" for="checkterms">
                                確認儲值
                            </label>
                        </div>
                        <button type="button" name="StoredMoney" id="StoredMoney" class="btn btn-primary w-100" value="<?php echo $mid; ?>" disabled>確定</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
<script>

$('#CreateMoneyPay').on('click',function(){
    $('viewMoneyPay').removeClass('d-none');
    $('viewMoneyPay').addClass('d-block');
    $('#initial').addClass('d-none');
    var mid=$('#CreateMoneyPay').val();

    $.ajax({
            type: "POST",
            url: "updata_money.php",
            data:{mid:mid},
            success: function(response) {
                console.log(response);
                window.location.href='./InterMoney.php';

            },
        });

});

$('#stored').on('click',function(){
    console.log('dsasd');
    $('#myform').removeClass('d-none');
    $('#myform').addClass('d-block');

    var checkterms = document.getElementById('checkterms');
    var StoredMoney = document.getElementById('StoredMoney');

    checkterms.addEventListener('change', checkCheckbox);
    function checkCheckbox() {
        if (checkterms.checked) {
            StoredMoney.disabled = false;
        } else {
            StoredMoney.disabled = true;
        }
    }


    $(document).ready(function() {
        $('#StoredMoney').on('click',function(){
        var getvalue=$('#viewmoney').attr('data-value');
        var inpmoney=$('#inpmoney').val();
        var mid=$('#StoredMoney').val();
        $.ajax({
            type: "POST",
            url: "updata_money.php", 
            data:{inpmoney:inpmoney,mid:mid,getvalue:getvalue},
            //data: { bcarid: bcarid, newQuantity: newQuantity },

            success: function(response) {
                console.log(response);
                $('#viewmoney').text('NT$ '+parseInt(response));
                $('#myform').toggle();
                window.location.href='./InterMoney.php';

            },
        });
    });
    });
});

</script>
</body>
</html>

