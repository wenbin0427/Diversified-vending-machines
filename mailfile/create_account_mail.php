<?php
  session_start();
 //Import PHPMailer classes into the global namespace
 //These must be at the top of your script, not inside a function
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
  
 //required files
 require 'phpmailer/src/Exception.php';
 require 'phpmailer/src/PHPMailer.php';
 require 'phpmailer/src/SMTP.php';

 //Create an instance; passing `true` enables exceptions
 if (isset($_POST['Create_email'])) {
    $usermail= $_SESSION['Create_email'];
   $mail = new PHPMailer(true);

     //Server settings
     $mail->isSMTP();                              //Send using SMTP
     $mail->Host       = 'smtp.gmail.com';       //Set the SMTP server to send through
     $mail->SMTPAuth   = true;             //Enable SMTP authentication
     $mail->Username   = 'IVM1110630@gmail.com';   //SMTP write your email
     $mail->Password   = 'gjzc ahyo ntnl ecmc';      //SMTP password
     $mail->SMTPSecure = 'ssl';            //Enable implicit SSL encryption
     $mail->Port       = 465;                                    
     $mail->CharSet = "utf-8"; //郵件編碼
     

     //Recipients
     $mail->setFrom( 'IVM1110630@gmail.com', 'IVM智慧販賣機'); // Sender Email and name
     $mail->addAddress($usermail);     //Add a recipient email  
  


     //Content
     $mail->isHTML(true);               //Set email format to HTML
     $mail->Subject = 'IVM多元化販賣機-註冊通知信';   // email subject headings
     $mail->Body ='
      <div style=font-size:15px;color:black;>
        親愛的用戶您好：<br>
        感謝您註冊IVM多元化販賣機體驗網站的帳號<br>
        您於本網站所留存之資料我們僅用於學術研究<br>
        所有資料將於研究完後7天內刪除<br>
        如您對於資料安全有疑慮也可以<a href=https://iotsvm.ddns.net/RWD_Manager/account_setting>點此</a>自行刪除<br>
        還有其他問題的話請點此<a href = mailto:IVM1110630@gmail.com>與我們聯絡</a><br>
        [IVM多元化販賣機專題小組]
      </div>
     ';
       
     // Success sent message alert
    $mail->send();

 }
 ?>
