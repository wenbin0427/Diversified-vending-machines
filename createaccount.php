<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en" id="darkorlight" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>建立帳號</title>
    <script src="./js/kit.fontawesome.com_b8ad2c2a06.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./css/font.css">
    <link rel="shortcut icon" href="./img/logo.png" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="./js/jquery-3.7.1.min.js"></script>

</head>
<body>
<form action="./createaccount" method="POST">
    <nav class="navbar  navbar-expand-lg shadow p-1 bg-body rounded">
        <div class="container-fluid">
            <a class="navbar-brand align-middle" href="./createaccount"><img  src="./img/logo.png" width="48" height="48">IVM多元化販賣機</a>
            </div>
        </div>
    </nav>
</form>

<form action="./createaccount" method="post" id="myForm">
<div class="container">
    <div class="row">
        <div class="col">
        <div class="col-12 col-xl-6 mt-5 mx-auto">
            <div class="card shadow ">
                <div class="card-body ">
                    <img class="img-fluid rounded mx-auto d-block" src="./img/logo.png" width="15%" height="100%">
                        <label class="form-label mt-3">使用者名稱</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><box-icon type='solid' name='user'></box-icon></span>
                            <input type="text" class="form-control" name="Create_Usename" id="Create_Usename" value="">
                        </div>
                        <label class="form-label mt-3">手機號碼</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><box-icon name='phone' type='solid' ></box-icon></span>
                            <input type="text" class="form-control" name="Create_cellnum" id="Create_cellnum" value="">
                        </div>
                        <label class="form-label mt-3">電子信箱</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><box-icon name='envelope' type='solid' ></box-icon></span>
                            <input type="email" class="form-control" name="Create_email" id="Create_email" value="">
                        </div>                 
                        <label class="form-label mt-3">密碼</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><box-icon name='lock-alt' type='solid' ></box-icon></span>
                            <input type="password" class="form-control" name="password" id="password" value="">
                            <span type="button" class="input-group-text" id="ViewPassword"><img id="ViewEye" src="./icon/eye-solid.svg" width="20px" height="20px"></img></span>
                        </div>
                        <div class="text-center mt-3">
                            <a class="text-primary" href="#" id="show_remind">體驗注意事項</a>
                            <div class="vr"></div>
                            <a href="./learnmone">隱私權政策</a>
                        </div>
                        <div class="container ">
                            <div class="row mt-3">
                                <button class="col btn btn-primary rounded" type="button" onclick="location.href='./login'">返回登入</button>
                                <button class="col btn btn-success rounded ms-5" name="Create" id="Create_bt" type="submit" disabled>建立</button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
</form>

<div class="modal fade show" style="display: none;" id="viewmodel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-body">
            <img class="mx-auto d-block" id="viewimg" src="" width="50px" height="50px">
            <div class="text-block text-center mt-2 mb-2" id="viewtext"><b></b></div>
        </div>
      <div class="modal-footer">
        <button type="button" id="close" class="btn btn-secondary d-block" data-bs-dismiss="modal">取消</button>
        <button type="button" id="checklogin" class="btn btn-primary" onclick="location.href='./login'"></button>
      </div>
    </div>
  </div>
</div>
<div id="ViewChoosePayBackdrop" class="modal-backdrop show d-none"></div>


<div class="modal fade show" style="display: block;" id="remindbackmodel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">體驗注意事項</h1>
      </div>
      <div class="modal-body">
        親愛的先生、小姐您好 ：<br>
        非常感謝您註冊體驗本網站及填寫問卷<br>
        請注意及遵守以下條款<br>
        <ol>
            <li>
                本網站及問卷所收集之資料僅作為學術用途。
            </li>
            <li>
                本網站所提供的隨機產生之信用卡卡號、有效期限和安全碼僅供測試和演示使用，不得用於實際交易或任何金融交易。用戶明確了解並同意，這些資訊僅用於模擬情境，不具有任何實際價值，且不得用於任何違法、不當或未經授權的活動。任何用戶違反此規定所造成的法律問題與本網站無關。用戶應自行承擔使用該信息所帶來的風險和後果。
            </li>
            <li>
            您在本網站上提供的資料將僅在研究完成後的30天內保留，之後將予以刪除。我們承諾在此期間內妥善保管您的資料，並在刪除前不會進行任何未經授權的使用或分享。此舉旨在確保您的隱私和資料安全，並遵守相關的隱私保護法規。如有任何疑問或需要進一步了解，請隨時與我們聯繫。
            </li>
        </ol>
        <br>
        <br>
        <br>

        <div class="form-check">
          <input name="checkterms" class="form-check-input" type="checkbox" id="checkterms" >
          <label class="form-check-label" for="checkterms">
            我已詳細閱讀並且同意以上條款
        </label>
        </div>      
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="location.href='./login'">不同意</button>
        <button type="button" class="btn btn-primary" id="next" disabled>下一步</button>
      </div>
    </div>
  </div>
</div>
<div id="remindback" class="modal-backdrop show d-block"></div>


<script>
const PasswordInput = document.getElementById("password");
const ViewPassword = document.getElementById("ViewPassword");
const ViewEye = document.getElementById('ViewEye');
const Create_Usename=document.getElementById('Create_Usename');
const Create_cellnum=document.getElementById('Create_cellnum');
const Create_email=document.getElementById('Create_email');
let Create_bt=document.getElementById('Create_bt');
var viewmodel=document.getElementById('viewmodel');
var ViewChoosePayBackdrop=document.getElementById('ViewChoosePayBackdrop');
var viewtext=document.getElementById('viewtext');
var viewimg=document.getElementById('viewimg');
var checklogin=document.getElementById('checklogin');
var close=document.getElementById('close');
var checkterms=document.getElementById('checkterms');
var next=document.getElementById('next');
var remindbackmodel=document.getElementById('remindbackmodel');
var remindback=document.getElementById('remindback');
var show_remind=document.getElementById('show_remind');
ViewPassword.addEventListener('click',function(){
        if(PasswordInput.type=="password"){
            PasswordInput.type="text";
            ViewEye.src='./icon/eye-slash-solid.svg';
        }else{
            PasswordInput.type="password";
            ViewEye.src='./icon/eye-solid.svg';

        }
    });

[Create_Usename, Create_cellnum, Create_email, PasswordInput].forEach(field => {
    field.addEventListener("input", function() {
        if (Create_Usename.value !== "" && Create_cellnum.value !== "" && Create_email.value !== "" && PasswordInput.value !== "") {
            Create_bt.disabled=false;
        } else {
            Create_bt.disabled=true;
        }
    });
});

function viewmodelfu(){
    viewmodel.style.display="block";
    ViewChoosePayBackdrop.classList.remove('d-none');
    ViewChoosePayBackdrop.classList.add('d-block');
}

checkterms.addEventListener('change', checkCheckbox);
function checkCheckbox() {
    if (checkterms.checked) {
      next.disabled = false;
    } else {
      next.disabled = true;
    }
}

next.addEventListener('click',function(){
    remindbackmodel.style.display='none';
    remindback.classList.remove('d-block');
    remindback.classList.add('d-none');

});
show_remind.addEventListener('click',function(){
    remindbackmodel.style.display='block';
    remindback.classList.add('d-block');
    remindback.classList.remove('d-none');
});
</script>

<?php
//viewimg
//viewtext
//checklogin
//close
if(isset($_POST['Create'])){
    ?>
    <script>
        remindbackmodel.style.display='none';
        remindback.classList.remove('d-block');
        remindback.classList.add('d-none');
    </script>
    <?php
    require_once('ivm_database.php'); 
    $Create_Usename=$_POST['Create_Usename'];
    $Create_cellnum=$_POST['Create_cellnum'];
    $Create_email=$_POST['Create_email'];
    $_SESSION['Create_email']=$_POST['Create_email'];
    $Create_password=$_POST['password'];
    $stmt=$pdo->prepare('select * from member');
    $stmt->execute();
    while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
         $exist_email=$row['email'];
         $exist_cellnum=$row['cellnum'];
    }
    if($Create_email===$exist_email ){
        ?>
        <script>
            viewmodelfu();
            viewtext.innerText='帳號已經存在請重新輸入或返回登入帳號';
            viewimg.src='./icon/exclamation.svg';
            checklogin.innerText="前往登入";
            document.getElementById('close').addEventListener('click',function(){
                viewmodel.style.display="none";
                ViewChoosePayBackdrop.classList.remove('d-block');
                ViewChoosePayBackdrop.classList.add('d-none');
            })
        </script>
        <?php
      }else{
          ?>
          <script>
              viewmodelfu();
              viewtext.innerText='新增成功 畫面將於3秒後自動跳轉';
              viewimg.src='./icon/circle-check-solid.svg';
              checklogin.innerText="前往登入";
              close.classList.remove('d-block');
              close.classList.add('d-none');
              var formData = $("#myForm").serialize(); // 將表單數據序列化為字符串                            
            $.ajax({
                type:"POST",
                url:"./mailfile/create_account_mail.php",
                data: formData,
                });
               setTimeout(function() {
                   window.location.href = "./login"; 
               }, 3000);
          </script>
          <?php
          $SQL_HF024 = $pdo->prepare('INSERT INTO member(name,cellnum,email,password,terms) value (?,?,?,?,?)');
          $SQL_HF024->execute([$Create_Usename,$Create_cellnum,$Create_email,md5($Create_password),'check']);

          $memberlog = $pdo->prepare('INSERT INTO member_log(name,cellnum,email,password,terms) value (?,?,?,?,?)');
          $memberlog->execute([$Create_Usename,$Create_cellnum,$Create_email,md5($Create_password),'check']);
      }

    }
?>
</body>
</html>

