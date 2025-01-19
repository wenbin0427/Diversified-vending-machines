<?php
    session_start();
    $mid=$_SESSION['mid'];
?>
<!DOCTYPE html>
<html lang="en" id="darkorlight" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>變更密碼</title>
    <script src="./js/kit.fontawesome.com_b8ad2c2a06.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./css/font.css">
    <link rel="shortcut icon" href="./img/logo.png" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

</head>
<body>
<form action="./account_setting" method="POST">
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
        <div class="col-12 col-xl-6 mx-auto mt-5 position-absolute top-50 start-50 translate-middle">
            <div class="card shadow">
                <div class="card-body">
                    <img class="img-fluid rounded mx-auto d-block" src="./img/logo.png" width="15%" height="100%">
                    <form action="./newpassword" method="post" id="myForm">
                        <label class="form-label mt-3">舊密碼</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><box-icon name='lock-alt' type='solid' ></box-icon></span>
                            <input type="password" class="form-control" name="oldpassword" id="oldpassword" value="" >
                            <span type="button" class="input-group-text" id="ViewPassword"><img id="ViewEye" src="./icon/eye-solid.svg" width="20px" height="20px"></img></span>
                        </div> 

                        <label class="form-label mt-3">新密碼</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><box-icon name='lock-alt' type='solid' ></box-icon></span>
                            <input type="password" class="form-control" name="newpassword" id="newpassword" value="">
                            <span type="button" class="input-group-text" id="ViewPassword2"><img id="ViewEye2" src="./icon/eye-solid.svg" width="20px" height="20px"></img></span>
                        </div> 
                        <button class="btn btn-success rounded mx-auto d-block mt-3 w-25" name="check" id="check" type="submit" disabled>確定</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade show" style="display: none;" id="viewmodel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-body">
            <img class="mx-auto d-block" id="viewimg" src="./icon/exclamation.svg" width="50px" height="50px">
            <div class="text-block text-center mt-2 mb-2" id="viewtext"><b></b></div>
        </div>
      <div class="modal-footer">
        <button type="button" id="checkstate" class="btn btn-primary">確定</button>
      </div>
    </div>
</div>
</div>

<div id="ViewChoosePayBackdrop" class="modal-backdrop show d-none"></div>

<script>
    var viewmodel=document.getElementById('viewmodel');
    var ViewChoosePayBackdrop=document.getElementById('ViewChoosePayBackdrop');
    var viewtext=document.getElementById('viewtext');
    var viewimg=document.getElementById('viewimg');
    var checkstate=document.getElementById('checkstate');
    function viewmodelfu(){
        viewmodel.style.display="block";
        ViewChoosePayBackdrop.classList.remove('d-none');
        ViewChoosePayBackdrop.classList.add('d-block');
    }
 
</script>
<?php
if(isset($_POST['logout'])){
    session_destroy();
    header("Location: login");

}

require_once('ivm_database.php'); 
$stmt=$pdo->prepare('select * from member');
$stmt->execute();
while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    if($mid==$row['mid']){
        $oldpas=$row['password'];
    }
  }

if(isset($_POST['check'])){
    $oldpassword=md5($_POST['oldpassword']);
    $newpassword=md5($_POST['newpassword']);

    if($oldpassword!=$oldpas){
        ?>
        <script>
            viewmodelfu();
            viewtext.innerText="舊密碼輸入錯誤請重新輸入";
            viewimg.src="./icon/exclamation.svg";
            checkstate.addEventListener('click',function(){
                viewmodel.style.display="none";
                ViewChoosePayBackdrop.classList.remove('d-block');
                ViewChoosePayBackdrop.classList.add('d-none');           
             });
        </script>
        <?php
    }else{
        $Uppassword = $pdo->prepare("UPDATE member SET password=?WHERE mid=?");
        $Uppassword->execute([$newpassword,$mid]);
    
        ?>
        <script>
            viewmodelfu();
            viewtext.innerText="密碼變更成功!畫面將跳轉至登入畫面";
            viewimg.src="./icon/circle-check-solid.svg";
            checkstate.addEventListener('click',function(){
                window.location.href="./login";
            });
            </script>
        <?php
            session_destroy();
    }

}
?>

<script>
var check=document.getElementById("check");var oldpassword=document.getElementById("oldpassword");var newpassword=document.getElementById("newpassword");const ViewPassword=document.getElementById("ViewPassword");const ViewPassword2=document.getElementById("ViewPassword2");const ViewEye=document.getElementById("ViewEye");const ViewEye2=document.getElementById("ViewEye2");ViewPassword.addEventListener("click",function(){if(oldpassword.type=="password"){oldpassword.type="text";ViewEye.src="./icon/eye-slash-solid.svg"}else{oldpassword.type="password";ViewEye.src="./icon/eye-solid.svg"}});ViewPassword2.addEventListener("click",function(){if(newpassword.type=="password"){newpassword.type="text";ViewEye2.src="./icon/eye-slash-solid.svg"}else{newpassword.type="password";ViewEye2.src="./icon/eye-solid.svg"}});
    [oldpassword,newpassword].forEach(field=>{
             field.addEventListener("input", function() {
         if (oldpassword.value !== "" && newpassword.value !=="" ) {
            check.disabled=false;
         } else {
            check.disabled=true;
         }
     });
    });

</script>
</body>
</html>

