<?php
    session_start(); 
    require_once('ivm_database.php'); 
    $logco = $pdo->prepare("SELECT * FROM log");
    $logco->execute();
    while ($row = $logco->fetch(PDO::FETCH_ASSOC)) {
        if($row['name']=='點擊'){
            $count=$row['count'];
        }
       
    }
    $log = $pdo->prepare("UPDATE log SET count=? WHERE name=?");
    $log->execute([$count+1,'點擊']);
?>
<!DOCTYPE html>
<html lang="en" id="darkorlight">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登入</title>
    <script src="./js/kit.fontawesome.com_b8ad2c2a06.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="shortcut icon" href="./img/logo.png" type="image/x-icon" />
    <script src="./js/bootstrap.bundle.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        a{
            text-decoration: none;
        }
    </style>
</head>
<body >

<div class="container">
    <div class="row">
        <div class="col-sm-6 col-xl-6 col-xxl-3 mx-auto position-absolute top-50 start-50 translate-middle">
            <div class="card border border-tertiary">
                <div class="shadow-lg card-body">
                    <div class="position-relative">
                        <img class="img-fluid mx-auto d-block" src="./img/logo.png" width="30%" height="30%">
                    </div>
                    <form method="POST" action="login">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">電子郵件</label>
                            <input type="email" class="form-control" name="email" id="account" aria-describedby="emailHelp">
                        </div>
                        <label for="exampleInputPassword1" class="form-label">密碼</label>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" id="psd" name="password">
                            <span type="button" class="input-group-text" id="ViewPassword"><img id="ViewEye" src="./icon/eye-solid.svg" width="20px" height="20px"></img></span>
                        </div>
                        <p id="error" class="text-center text-danger"><b></b></p>
                        <div class="row mt-3">
                            <div class="col">
                                <button name="loginbt" type="submit" class="btn btn-primary w-100">登入</button>
                            </div>
                            <div class="col">
                                <button name="visitor" type="submit" class="btn btn-success w-100" >訪客模式</button>
                            </div>
                        </div>

                    </form>
                    <div class="text-center">
                        <a href="./createaccount">創建帳號</a>
                        <div class="vr"></div>
                        <a href="./forget_the_password">忘記密碼</a>   
                        <div class="vr"></div>
                        <a href="./contact">聯絡我們</a>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <?php
    if(isset($_POST['loginbt'])){
        $email = "";  $password = "";$mid="";
        // 取得表單欄位值
        if ( isset($_POST["email"]) )
           $email = $_POST["email"];
        if ( isset($_POST["password"]) )
           $password = md5($_POST["password"]);
        // 檢查是否輸入使用者名稱和密碼
        if ($email != "" && $password != "") {
           // 建立MySQL的資料庫連接 
           $link = mysqli_connect("localhost","root",
                                  "1234","ivm_database")
                or die("無法開啟MySQL資料庫連接!<br/>");
           //送出UTF8編碼的MySQL指令
           mysqli_query($link, 'SET NAMES utf8'); 
           // 建立SQL指令字串
           $sql = "SELECT * FROM member WHERE password='";
           $sql.= $password."' AND email='".$email."'";
           // 執行SQL查詢
           $result = mysqli_query($link, $sql);
           $total_records = mysqli_num_rows($result);
           // 是否有查詢到使用者記錄
           if ( $total_records > 0 ) {
              // 成功登入, 指定Session變數
              $_SESSION["email"]=$email; //紀錄輸入的email至SESSION
              $_SESSION["login_session"] = true;
              require_once('ivm_database.php');               //連結資料庫
                $stmt = $pdo->prepare("select * from member");  //查詢資料
                $stmt->execute();
                // ! 登入後判斷身分
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    if($row['email']==$email){
                        if($row['identity']=='一般身分'){
                            // ? 身分是一般身分的話導向商品選擇畫面
                            header("Location: choose");
                        }elseif($row['identity']=='管理員'){
                            // ? 身分是管理員的話導向管理畫面
                            header("Location:./admin/admin");
                        }
                    }
                }
           } else {  // 登入失敗
            ?>
            <script>
                var error=document.getElementById("error").innerText="電子信箱或密碼錯誤";
            </script>
            <?php
            $_SESSION["login_session"] = false;
            }
           mysqli_close($link);  // 關閉資料庫連接  
        }
    }elseif(isset($_POST['visitor'])){
        ?>
        <div class="modal show" tabindex="-1" style="display: block;">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">體驗注意事項</h1>
            </div>
            <div class="modal-body">
                親愛的先生、小姐您好 ：<br>
                非常感謝您使用訪客模式體驗本網站及填寫問卷<br>
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
            <form action="./login" method="post">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="location.href='./login'">不同意</button>
                    <button type="submit" class="btn btn-primary" id="nextvisitor" name="nextvisitor" disabled>繼續體驗</button>
                </div>
            </form>
            </div>
        </div>
        </div>
    <div id="ViewBackdrop" class="modal-backdrop show d-block"></div>
        <?php

        
    }
    ?>
<?php
    if(isset($_POST['nextvisitor'])){
        $randemail=rand(0000000000,9999999999);
        $email='a'.$randemail.'@gmail.com';
        $_SESSION["email"]=$email;
        $cellnum='0'.rand(000000000,999999999);
        $name='訪客';
        $password=md5(rand(000000000,999999999));
        require_once('ivm_database.php'); 
        $createvismember = $pdo->prepare('INSERT INTO member(name,cellnum,email,password,terms) value (?,?,?,?,?)');
        $createvismember->execute([$name,$cellnum,$email,$password,'check']);
        header("Location: choose");

    }
?>

<div id="cookieview" class="fixed-bottom bg-secondary bg-opacity-25 pb-1 pt-2 d-flex justify-content-between align-items-center">
    <div class="col-10 text-center">
        本網站使用 cookies 來確保瀏覽我們網站能獲得最佳體驗。<a href="./learnmone">瞭解更多</a>
    </div>
    <div class="col-2">
        <button id="agreebt" class="btn btn-outline-secondary">同意</button>
    </div>
</div>


<script>
    const PasswordInput = document.getElementById("psd");
    const ViewPassword = document.getElementById("ViewPassword");
    const ViewEye = document.getElementById('ViewEye');

    const GetAgreeCookie = document.cookie.replace(/(?:(?:^|.*;\s*)AgreeCookie\s*=\s*([^;]*).*$)|^.*$/, "$1");
    
    function setCookie(name, value, daysToExpire) {
            const expires = new Date();
            expires.setDate(expires.getDate() + daysToExpire);
            const cookieString = `${encodeURIComponent(name)}=${encodeURIComponent(value)};expires=${expires.toUTCString()};path=/`;
            document.cookie = cookieString;
    }
        
// 在页面加载完成后执行代码
document.addEventListener('DOMContentLoaded', function() {
    // 获取元素
    const checkterms = document.getElementById('checkterms'); // 请确保你的 checkbox 的 id 是 'checkterms'
    const nextvisitor = document.getElementById('nextvisitor'); // 请确保按钮的 id 是 'nextvisitor'

    // 检查元素是否存在
    if (checkterms && nextvisitor) {
        // 添加事件监听器
        checkterms.addEventListener('change', function() {
            if (checkterms.checked) {
                nextvisitor.disabled = false; // 启用按钮
            } else {
                nextvisitor.disabled = true;  // 禁用按钮
            }
        });
    } else {
        console.error("找不到 checkterms 或 nextvisitor 元素");
    }
});


    ViewPassword.addEventListener('click',function(){
        if(PasswordInput.type=="password"){
            PasswordInput.type="text";
            ViewEye.src='./icon/eye-slash-solid.svg';
        }else{
            PasswordInput.type="password";
            ViewEye.src='./icon/eye-solid.svg';
        }
    });
    var cookieview = document.getElementById('cookieview');
    var agreebt = document.getElementById('agreebt');
    agreebt.addEventListener('click',function(){
        cookieview.classList.add('d-none');
        setCookie('AgreeCookie', 'none',30);
    });
    if(GetAgreeCookie=='none'){
        cookieview.classList.add('d-none');
    }else{
        cookieview.classList.add('d-block');

    }
</script>


</body>
</html>

