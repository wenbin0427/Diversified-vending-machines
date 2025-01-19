<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en" id="darkorlight" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>忘記密碼</title>
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
            <a class="navbar-brand align-middle" href="./forget_the_password"><img  src="./img/logo.png" width="48" height="48">IVM多元化販賣機</a>
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
                    <form action="./forget_the_password" method="post" id="myForm">

                        <label class="form-label mt-3">手機號碼</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><box-icon name='phone' type='solid' ></box-icon></span>
                            <input type="text" class="form-control" name="Create_cellnum" id="Create_cellnum" autocomplete="off">
                        </div>

                        <label class="form-label mt-3">電子信箱</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><box-icon name='envelope' type='solid' ></box-icon></span>
                            <input type="text" class="form-control" name="Create_email" id="Create_email" autocomplete="off">
                        </div>        

                        <div class="container ">
                            <div class="row mt-3">
                                <button class="col btn btn-primary rounded" type="button" onclick="location.href='./login'">返回登入</button>
                                <button class="col btn btn-success rounded ms-5" name="Create_bt" id="Create_bt" type="submit" disabled>確定</button>
                            </div>
                        </div>
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
                <button type="button" id="close" class="btn btn-secondary d-none" data-bs-dismiss="modal">取消</button>
                <button type="button" id="checkstate" name="checkstate" class="btn btn-primary d-none" onclick="location.href='./member_state'">前往認證</button>
            </div>
        </div>
    </div>
</div>
<form>
<div id="ViewChoosePayBackdrop" class="modal-backdrop show d-none"></div>
<script>
    var viewmodel=document.getElementById('viewmodel');
    var ViewChoosePayBackdrop=document.getElementById('ViewChoosePayBackdrop');
    var viewtext=document.getElementById('viewtext');
    var checkstate=document.getElementById('checkstate');
    var Create_bt=document.getElementById('Create_bt');
    var Create_cellnum=document.getElementById('Create_cellnum');
    var Create_email=document.getElementById('Create_email');
    var viewmodel=document.getElementById('viewmodel');
    var ViewChoosePayBackdrop=document.getElementById('ViewChoosePayBackdrop');
    var close=document.getElementById('close');

    function viewmodelfu(){
        viewmodel.style.display="block";
        ViewChoosePayBackdrop.classList.remove('d-none');
        ViewChoosePayBackdrop.classList.add('d-block');
    }
    
</script>

<?php
    require_once('ivm_database.php');

    if(isset($_POST['Create_bt'])){
        $cellnum = $_POST['Create_cellnum'];
        $email= $_POST['Create_email'];
        $stmt = $pdo->prepare('select * from member');
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if($cellnum==$row['cellnum'] && $email==$row['email']){
                $random = rand(100000, 999999);
                $mid=$row['mid'];
                $_SESSION['mail_mid']=$row['mid'];
                $_SESSION['mail_email']=$email;
                $_SESSION['mail_random']=$random;
                $UpUserdata = $pdo->prepare("UPDATE member SET member_state=?,password=? WHERE mid=?");
                $UpUserdata->execute(['待改密碼','',$mid]);

                $Upmailstate = $pdo->prepare("UPDATE mail SET state='已失效' WHERE mid=? AND state='未驗證'");
                $Upmailstate->execute([$mid]);

                $SQL_HF024 = $pdo->prepare('INSERT INTO mail(mid,name,email,code) value (?,?,?,?)');
                $SQL_HF024->execute([$mid,$row['name'],$email,$random]);

                ?>
                    <script> 
                        viewmodelfu();
                        close.classList.remove('d-block');
                        close.classList.add('d-none');
                        checkstate.classList.remove('d-none');
                        checkstate.classList.add('d-block');
                        viewtext.innerText="系統已寄發驗證碼至您所留存的信箱";     
                        var formData = $("#myForm").serialize(); // 將表單數據序列化為字符串                            
                        $.ajax({
                            type:"POST",
                            url:"./mailfile/email.php",
                            data: formData,
                        });
                        //window.location.href = './member_state';

                    </script>
                <?php
                break;
            }else{
            ?>
                <script>
                    viewmodelfu();
                    viewtext.innerText="手機號碼或電子信箱輸入錯誤請重新輸入";          
                    close.classList.add('d-block');
                    close.classList.remove('d-none');
                    document.getElementById('close').addEventListener('click',function(){
                        viewmodel.style.display="none";
                        ViewChoosePayBackdrop.classList.remove('d-block');
                        ViewChoosePayBackdrop.classList.add('d-none');
                    });

                    </script>
            <?php
            }
        }

    }
?>

<script>

    [Create_cellnum,Create_email].forEach(field=>{
             field.addEventListener("input", function() {
         if (Create_cellnum.value !== "" && Create_email.value !=="" ) {
             Create_bt.disabled=false;
         } else {
             Create_bt.disabled=true;
         }
     });
    });

</script>
</body>
</html>

