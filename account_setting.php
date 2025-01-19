<?php
session_start();
$member = $_SESSION["email"];
$mid = $_SESSION['mid'];
if($mid==""){
    header("Location: ./nologin");
}
if(isset($_POST['DelteDataBt'])){
    require_once('ivm_database.php'); 

    $DelTrans = $pdo -> prepare('DELETE FROM transaction WHERE transmid=?');
    $DelTrans -> execute([$mid]);
    $DelCard = $pdo -> prepare('DELETE FROM card WHERE mid=?');
    $DelCard -> execute( [$mid] );
    $DelMember = $pdo -> prepare('DELETE FROM member WHERE mid=?');
    $DelMember -> execute( [$mid] );
    header("Location: ./login");
    exit();
}

if(isset($_POST['UpCheckData'])){
    require_once('ivm_database.php'); 
    $value=$_POST['UpCheckData'];
    $value = explode(",", $value);
    $UpUserdata = $pdo->prepare("UPDATE member SET name=?,cellnum=?,email=? WHERE mid=?");
    $UpUserdata->execute([$value[0],$value[1],$value[2],$mid]);
   header("Location: ./account_setting");
}
?>
<?php 
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
    <title>帳戶設定</title>
    <script src="./js/kit.fontawesome.com_b8ad2c2a06.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/font.css">
    <link rel="shortcut icon" href="./img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/bootstrap.bundle.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/b8ad2c2a06.js" crossorigin="anonymous"></script>
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
<?php
require_once('ivm_database.php'); 
$stmt=$pdo->prepare('select * from member');
$stmt->execute();
while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    if($mid==$row['mid']){
        $name=$row['name'];
        $cellnum=$row['cellnum'];
        $email=$row['email'];
        $datetime=$row['datetime'];
        $Questionnaire=$row['Questionnaire'];
    }
  }
?>
<div class="container">
    <div class="row">
        <div class="col-12 col-xl-6 mt-5 mx-auto">
            <div class="card m-2">
                <div class="card-body">
                    <label class="form-label">使用者名稱</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><box-icon type='solid' name='user'></box-icon></span>
                        <input type="text" class="form-control" name="Usename" id="Usename" value="<?php echo $name;?>" disabled>
                    </div>
                    <label class="form-label">手機號碼</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><box-icon name='phone' type='solid' ></box-icon></span>
                        <input type="text" class="form-control" name="Usecellnum" id="Usecellnum" value="<?php echo $cellnum ;?>" disabled>
                    </div>
                    <label class="form-label">電子信箱</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><box-icon name='envelope' type='solid' ></box-icon></span>
                        <input type="text" class="form-control" name="Useemail" id="Useemail" value="<?php echo $email ;?>" disabled>
                    </div>                 
                    <label class="form-label">註冊日期</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><box-icon name='calendar' type='solid' ></box-icon></span>
                        <input type="text" class="form-control" value="<?php echo $datetime ;?>" disabled>
                    </div>
                    <label class="form-label">問卷填寫狀態<span class="badge rounded-pill text-bg-danger">本欄位非即時更新</span></label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><box-icon name='edit'></box-icon></span>
                        <input type="text" class="form-control" value="<?php echo $Questionnaire;?>" disabled>
                        <?php
                        if($Questionnaire=='已填寫'){
                            $btstate='disabled';
                        }else{
                            $btstate='';
                        }
                        ?>
                        <button class="btn border btn-outline-primary" type="button" id="button-addon2" onclick="window.open('https://forms.gle/m8GYhTVVYJoh8cbH8', '_blank')" <?php echo $btstate ; ?>>前往填寫</button>
                    </div>
                    <div class="container">
                        <div class="row">
                            <button type="button" class="btn btn-success btn-block d-block" id="UpData" name="UpData" onclick="UpDataGetValue()">變更資料</button>
                            <button type="button" class="btn btn-success btn-block d-none " id="CheckUpData" name="CheckUpData" data-bs-toggle="modal" data-bs-target="#UpOkData">確認變更</button>
                            <button type="button" class="btn btn-success btn-block mt-3" onclick="location.href='./newpassword'">變更密碼</button>
                            <button type="button" class="btn btn-success btn-block mt-3" onclick="location.href='./choose'">返回主畫面</button>
                            <button type="button" class="btn btn-danger btn-block mt-3" id="DelteBt" data-bs-toggle="modal" data-bs-target="#DelteData">刪除帳號</button>
                        </div>
                    </div>
                </div>
              </div>
        </div>
    </div>
</div>


<!-- 刪除帳號視窗 -->
<form action="./account_setting" method="post">
    <div class="modal"id="DelteData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-body">
                <img class="mx-auto d-block" src="./icon/exclamation.svg" width="50px" height="50px">
                <div class="text-block text-center mt-2 mb-2"><b>帳號經刪除所有資料將一併刪除且無法復原</b></div>
                <div class="modal-footer w-100">
                    <button type="submit" class="btn btn-danger" data-bs-toggle="modal" name="DelteDataBt" id='DelteDataBt'>確定刪除</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                </div>
            </div>
        </div>
      </div>
    </div>
</form>

<!-- 資料修改成功視窗 -->
<form action="./account_setting" method="post">
    <div class="modal" id="UpOkData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-body">
                    <img class="mx-auto d-block" src="./icon/circle-check-solid.svg" width="50px" height="50px">
                    <div class="text-block text-center mt-2 mb-2"><b>資料變更成功</b></div>
                    <div class="modal-footer">
                        <button type="submit" id="UpCheckData" name="UpCheckData" class="btn btn-success" data-bs-toggle="modal" onclick="location.href='./account_setting'">確認</button>
                    </div>
                </div>
            </div>
          </div>
    </div>
</form>
<div id="ViewBackdrop" class="modal-backdrop show d-none"></div>



<script>

var UpData=document.getElementById("UpData");var CheckUpData=document.getElementById("CheckUpData");var Usename=document.getElementById("Usename");var Usecellnum=document.getElementById("Usecellnum");var Useemail=document.getElementById("Useemail");var Usepassword=document.getElementById("password");var UpCheckData=document.getElementById("UpCheckData");var upvalue=[];UpData.addEventListener("click",function(){Usename.disabled=false;Usecellnum.disabled=false;Useemail.disabled=false;UpData.classList.remove("d-block");UpData.classList.add("d-none");CheckUpData.classList.remove("d-none");CheckUpData.classList.add("d-block")});CheckUpData.addEventListener("click",function(){upvalue=[Usename.value,Usecellnum.value,Useemail.value];var a=upvalue.join(",");UpCheckData.value=a;console.log(UpCheckData.value)});




</script>



</body>
</html>

