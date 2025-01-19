<?php
    session_start();
    $mid=$_SESSION['mail_mid'];
?>
<!DOCTYPE html>
<html lang="en" id="darkorlight" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>驗證碼驗證</title>
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
<form action="./createaccount" method="POST">
    <nav class="navbar  navbar-expand-lg shadow p-1 bg-body rounded">
        <div class="container-fluid">
            <a class="navbar-brand align-middle"><img  src="./img/logo.png" width="48" height="48">IVM多元化販賣機</a>
            </div>
        </div>
    </nav>
</form>

<div class="container">
    <div class="row">
        <div class="col-12 col-xl-6 mx-auto position-absolute top-50 start-50 translate-middle">
            <div class="card shadow">
                <div class="card-body">
                    <img class="img-fluid rounded mx-auto d-block" src="./img/logo.png" width="15%" height="100%">
                    <form action="./member_state" method="post" id="myForm">
                        <label class="form-label mt-3">驗證碼</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><box-icon name='check-shield'></box-icon></span>
                            <input type="number" class="form-control" name="code" id="code" value="" >
                        </div>
                        <div id="NewPassword" class="d-none">
                            <label class="form-label mt-3">新密碼</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><box-icon name='lock-alt' type='solid' ></box-icon></span>
                                <input type="password" class="form-control" name="password" id="password" value="" autocomplete="off">
                                <span type="button" class="input-group-text" id="ViewPassword"><img id="ViewEye" src="./icon/eye-solid.svg" width="20px" height="20px"></img></span>
                            </div> 
                        </div>        
                        <button class="btn btn-success rounded mx-auto d-block mt-3 w-25 d-none" name="check" id="check" type="submit" disabled>確定</button>
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

    const ViewPassword = document.getElementById("ViewPassword");
    const ViewEye = document.getElementById('ViewEye');
    const PasswordInput=document.getElementById('password')
    var checkstate=document.getElementById('checkstate');
    var check=document.getElementById('check');
    var code=document.getElementById('code');

    function viewmodelfu(){
        viewmodel.style.display="block";
        ViewChoosePayBackdrop.classList.remove('d-none');
        ViewChoosePayBackdrop.classList.add('d-block');
    }

    ViewPassword.addEventListener('click',function(){
        if(PasswordInput.type=="password"){
            PasswordInput.type="text";
            ViewEye.src='./icon/eye-slash-solid.svg';
        }else{
            PasswordInput.type="password";
            ViewEye.src='./icon/eye-solid.svg';

        }
    });

</script>
<?php
require_once('ivm_database.php');
$mail = $pdo->prepare("SELECT * FROM mail WHERE mid=$mid ORDER BY datatime DESC LIMIT 1");
$mail->execute();
while ($row = $mail->fetch(PDO::FETCH_ASSOC)) {
    if($row['state']=="未驗證"){
        $code=$row['code'];
    }
}

if(isset($_POST['check'])){
    $newpassword=md5($_POST['password']);

    $Uppassword = $pdo->prepare("UPDATE member SET password=?,member_state=? WHERE mid=?");
    $Uppassword->execute([$newpassword,'正常',$mid]);

    $Upmail = $pdo->prepare("UPDATE mail SET state=? WHERE mid=? AND state='未驗證'");
    $Upmail->execute(['驗證完成',$mid]);
    ?>
    <script>
        viewtext.innerText="密碼變更成功!請使用新密碼登入";
        viewimg.src='./icon/circle-check-solid.svg';
        checkstate.addEventListener('click',function(){
            window.location.href="./login";
        });
        viewmodelfu();
    </script>
    <?php
}

?>




<script>
    [PasswordInput].forEach(field=>{
             field.addEventListener("input", function() {
         if (PasswordInput.value !== "") {
            check.disabled=false;
         } else {
            check.disabled=true;
         }
     });
    });
    var NewPassword=document.getElementById('NewPassword');
    document.getElementById('code').addEventListener('input', function() {
        var inputValue = this.value;
        var codeValue = <?php echo json_encode($code); ?>;
        if (inputValue === codeValue) {
            NewPassword.classList.remove('d-none');
            NewPassword.classList.add('d-block');
            check.classList.remove('d-none');
            check.classList.add('d-block');
            code.disabled=true;
        }else{
            if(inputValue.length===6){
                viewtext.innerText="驗證碼輸入錯誤請重新輸入";
                viewimg.src='./icon/exclamation.svg';
                checkstate.addEventListener('click',function(){
                    window.location.href="./member_state";
                });
                viewmodelfu();
            }
        }
    });
</script>
</body>
</html>

