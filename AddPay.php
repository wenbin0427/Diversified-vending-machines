<?php
session_start();
$member = $_SESSION["email"];
$mid = $_SESSION['mid'];
$UserName=$_SESSION['UserName'];
if(isset($_POST['logout'])){
    session_destroy();
    header("Location: login");

}
if($member==""){
    header("Location: ./nologin");
}
?>
<!DOCTYPE html>
<html lang="en" id="darkorlight" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新增信用卡</title>
    <script src="./js/kit.fontawesome.com_b8ad2c2a06.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./css/font.css">
    <link rel="shortcut icon" href="./img/logo.png" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/b8ad2c2a06.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</head>
<body>


<form action="./AddPay" method="POST">
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
<form action="./Addpay" method="post">
<div class="container">
    <div class="row">
        <div class="col-12 col-xl-6 mt-5 mx-auto">
            <div class="card">
                <div class="card-body">
                    <img id="viewCarimg" name="viewCarimg" value="./img/card/CardBackground_logo.png" src="./img/card/CardBackground_logo.png" class="img-fluid card-img">
                    <div class="row">
                        <div class="col text-center">
                            <button type="button" id="CarimgBt1" name="Carimg" class="btn px-0 mx-2" style="width: 70px;"><img class="text-start" src="./img/card/CardBackground_logo_Bt.png"></button>
                            <button type="button" id="CarimgBt2" name="Carimg" class="btn px-0 mx-2" style="width: 70px;"><img class="text-start" src="./img/card/CardBackground_logo2_Bt.png"></button>
                            <button type="button" id="CarimgBt3" name="Carimg" class="btn px-0 mx-2" style="width: 70px;"><img class="text-start" src="./img/card/CardBackground_logo3_Bt.png"></button>
                        </div>
                    </div>
                    <label  class="form-label mt-3">卡號</label>
                    <input type="text" id="inputCarID" name="inputCarID" value="" class="form-control" disabled>
                    <div class="row g-2 mt-3">
                        <div class="col-auto w-50">
                            <label  class="form-label ">有效日期</label>
                        </div>
                        <div class="col-auto w-50">
                            <label  class="form-label text-end">安全碼</label>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col-auto w-50">
                            <input type="text" id="data" class="form-control" value="" style="width: 70px;" maxlength="5" disabled>
                        </div>
                        <div class="col-auto w-50">
                            <input type="text" id="cvv" class="form-control" value=""  style="width: 70px;" maxlength="5"  disabled>
                        </div>
                    </div>

                    <button type="button" id="randomCar"class="btn btn-primary mt-5 w-100 d-block">產生一組信用卡</button>
                    <button type="button" name="AddCar" id="AddCar" class="btn btn-primary mt-4 w-100 d-none" data-bs-toggle="modal" data-bs-target="#AddCarModel"  value="">新增</button>
                    <button type="button" class="btn btn-success mt-4 w-100" onclick="location.href='./choose'">返回上一頁</button>

                </div>
            </div>
        </div>
    </div>
</div>
</form>

<!-- 新增成功視窗 -->
<form action="./AddPay" method="post">
    <div class="modal" id="AddCarModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-body">
                    <img class="mx-auto d-block" src="./icon/circle-check-solid.svg" width="50px" height="50px">
                    <div class="text-block text-center mt-2 mb-2"><b>信用卡新增成功</b></div>
                    <div class="modal-footer w-100">
                        <button type="submit" class="btn btn-success" data-bs-toggle="modal" id="AddCardCheck" name="AddCardCheck" onclick="location.href='./Pay'">確認</button>
                    </div>
                </div>
            </div>
          </div>
    </div>
</form>

<?php
    require_once('ivm_database.php'); 
    if(isset($_POST['AddCardCheck'])){
        $inputCarID=$_POST['AddCardCheck'];
        $valuesArray = explode(",", $inputCarID);
        $SQL_HF024 = $pdo->prepare('INSERT INTO card(mid,cname,cardid,duedata,cvv,Cardimg) value (?,?,?,?,?,?)');
        $SQL_HF024->execute([$mid,$UserName,$valuesArray[1],$valuesArray[2],$valuesArray[3],$valuesArray[0]]);
        echo"
        <script>
            window.location.href='./AddPay';
        </script>
        ";

    }
?>

<script>
var inputCarID=document.getElementById("inputCarID");var randomCar=document.getElementById("randomCar");var data=document.getElementById("data");var cvv=document.getElementById("cvv");var AddCardCheck=document.getElementById("AddCardCheck");var AddCar=document.getElementById("AddCar");var CarImgBt1=document.getElementById("CarimgBt1");var CarImgBt2=document.getElementById("CarimgBt2");var CarImgBt3=document.getElementById("CarimgBt3");var viewCarimg=document.getElementById("viewCarimg");var path="./img/card/CardBackground_logo.png";var AddCarValue=[];CarImgBt1.addEventListener("click",function(){path="./img/card/CardBackground_logo.png";viewCarimg.src=path;viewCarimg.value=path;AddCarValue[0]=(path);consoleLog()});CarImgBt2.addEventListener("click",function(){path="./img/card/CardBackground_logo2.png";viewCarimg.src=path;viewCarimg.value=path;AddCarValue[0]=(path);consoleLog()});CarImgBt3.addEventListener("click",function(){path="./img/card/CardBackground_logo3.png";viewCarimg.src=path;viewCarimg.value=path;AddCarValue[0]=(path);consoleLog()});function getRandomInt(b,a){return Math.floor(Math.random()*(a-b))+b}function isValidCreditCardNumber(c){var b=0;var d=false;for(var a=c.length-1;a>=0;a--){var e=parseInt(c[a]);if(d){e*=2;if(e>9){e-=9}}b+=e;d=!d}return b%10===0}function generateCreditCardNumber(){var o=[];var p=[];var e=getRandomInt(3,6).toString();o.push(e);if(e==="4"){for(var f=0;f<15;f++){var h=getRandomInt(0,10).toString();o.push(h)}}else{if(e==="5"){var l=getRandomInt(51,55).toString();o.push(l);for(var f=2;f<15;f++){var h=getRandomInt(0,10).toString();o.push(h)}}else{if(e==="3"){var j=getRandomInt(528,590).toString();o.push(j.charAt(0));o.push(j.charAt(1));o.push(j.charAt(2));for(var f=0;f<12;f++){var h=getRandomInt(0,10).toString();o.push(h)}}}}var n=o.join("");function g(){var c=new Date();var i=c.getFullYear().toString().slice(-2);var t=getRandomInt(1,6);var v=(parseInt(i)+t)%100;var u=(i===t)?c.getMonth()+1:1;var w=(i===t)?12:13;var r=getRandomInt(u,w);var s=(r<10)?"0"+r:r;return s+"/"+v}for(var k=0;k<3;k++){var a=getRandomInt(0,10);p.push(a)}var m=p.join("");if(!isValidCreditCardNumber(n)){generateCreditCardNumber()}else{var q=n.substring(0,4);var b=n.substring(12,16);inputCarID.value=q+"********"+b;var d=g();data.value=d;cvv.value=m;AddCarValue[0]=(path);AddCarValue[1]=(n);AddCarValue[2]=(d);AddCarValue[3]=(m)}}randomCar.addEventListener("click",function(){generateCreditCardNumber();AddCar.classList.remove("d-none");AddCar.classList.add("d-block");consoleLog()});AddCar.addEventListener("click",function(){var a=AddCarValue.join(",");AddCardCheck.value=a;consoleLog()});function consoleLog(){console.log("--------------------------------------------");console.log("inputCarID:",inputCarID.value);console.log("data:",data.value);console.log("cvv:",cvv.value);console.log("viewCarimg:",viewCarimg.value);console.log("AddCarValue:",AddCarValue);console.log("--------------------------------------------")}consoleLog();
</script>

</body>
</html>

