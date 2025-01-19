<?php
session_start();
error_reporting(0);
$member = $_SESSION["email"];
$name = $_SESSION['UserName'];
ob_start(); // 開始緩衝輸出
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login");
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './mailfile/phpmailer/src/Exception.php';
require './mailfile/phpmailer/src/PHPMailer.php';
require './mailfile/phpmailer/src/SMTP.php';
if (isset($_POST['submail'])) {
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $sender_email = $_POST['email'];
    $reply = $_POST['reply'];
    $to_email = 'IVM1110630@gmail.com';
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();                              //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';       //Set the SMTP server to send through
        $mail->SMTPAuth   = true;             //Enable SMTP authentication
        $mail->Username   = 'IVM1110630@gmail.com';   //SMTP write your email
        $mail->Password   = 'imwswekjhbmnldwl';      //SMTP password
        $mail->SMTPSecure = 'ssl';            //Enable implicit SSL encryption
        $mail->Port       = 465;
        $mail->CharSet = "utf-8"; //郵件編碼
        $mail->setFrom($sender_email, '使用者回饋');
        $mail->addAddress($to_email);
        $mail->isHTML(true);               //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = "
             <div style=font-size:15px;>
                 寄件人：$sender_email<br>
                 回覆：$reply<br>
                 主旨：$subject<br>
                 內容：$message
             </div>
         ";
        $mail->send();
        // 
?>
        <div class="modal show" tabindex="-1" style="display: block;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <p class="text-center fs-4">郵件發送成功</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary w-100" onclick="location.href='./choose'">返回選單</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="ViewBackdrop" class="modal-backdrop show d-block"></div>

<?php
    } catch (Exception $e) {
        echo "<p>郵件發送失敗: {$mail->ErrorInfo}</p>";
    }
}

?>
<!DOCTYPE html>
<html lang="en" id="darkorlight" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>開發歷程</title>
    <script src="./js/kit.fontawesome.com_b8ad2c2a06.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./css/font.css">
    <link rel="shortcut icon" href="./img/logo.png" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400&display=swap" rel="stylesheet">
    <script src="./js/jquery-3.7.1.min.js"></script>

</head>

<body>
    <form action="./contact" method="POST">
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
    <form action="./contact" method="post">
        <div class="container mt-5" id="ViewCard">
            <div class="row">
                <div class="col-sm-4 col-12 mx-auto position-absolute top-50 start-50 translate-middle z-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="formGroupExampleInput" class="form-label">您的電子郵件</label>
                                <input name="email" type="text" class="form-control" id="formGroupExampleInput" placeholder="輸入您的電子郵件" value="<?php echo $member; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="formGroupExampleInput2" class="form-label">主旨</label>
                                <input name="subject" type="text" class="form-control" id="formGroupExampleInput2" placeholder="請輸入主旨">
                            </div>
                            <div class="mb-3">
                                <label for="formGroupExampleInput2" class="form-label">內容</label>
                                <textarea name="message" class="form-control" aria-label="With textarea"></textarea>
                            </div>
                            <label for="">是否需要回覆您</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="reply" id="inlineRadio1" value="是">
                                <label class="form-check-label" for="inlineRadio1">是</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="reply" id="inlineRadio2" value="否">
                                <label class="form-check-label" for="inlineRadio2">否</label>
                            </div>
                            <div class="container">
                                <div class="row mt-3">
                                    <div class="col">
                                        <button class="btn btn-primary rounded w-100" type="button" name="submail" onclick="history.back()">返回</button>
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-success rounded w-100" type="submit" name="submail">寄出</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <?php

    ?>
</body>

</html>