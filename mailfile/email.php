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
   
   $mail_email=$_SESSION['mail_email'];
   $mail_random=$_SESSION['mail_random'];

   $mail = new PHPMailer(true);

     //Server settings
     $mail->isSMTP();                              //Send using SMTP
     $mail->Host       = 'smtp.gmail.com';       //Set the SMTP server to send through
     $mail->SMTPAuth   = true;             //Enable SMTP authentication
     $mail->Username   = 'IVM1110630@gmail.com';   //SMTP write your email
     $mail->Password   = 'imwswekjhbmnldwl';      //SMTP password
     $mail->SMTPSecure = 'ssl';            //Enable implicit SSL encryption
     $mail->Port       = 465;                                    
     $mail->CharSet = "utf-8"; //郵件編碼
     

     //Recipients
     $mail->setFrom( 'IVM1110630@gmail.com', 'IVM智慧販賣機'); // Sender Email and name
     $mail->addAddress($mail_email);     //Add a recipient email  
  


     //Content
     $mail->isHTML(true);               //Set email format to HTML
     $mail->Subject = 'IVM多元化販賣機-重設密碼驗證信';   // email subject headings
     $mail->Body ="
      <div style=font-size:15px;>
        親愛的用戶您好：<br>
        我們收到了一個要求重設您帳戶密碼的請求。請使用以下驗證碼完成密碼重設流程：<br>
        驗證碼：[<b>$mail_random</b>]<br>
        如果您沒有提出密碼重設請求，請忽略此郵件。<br>
        祝您有愉快的一天！<br>
        [IVM多元化販賣機專題小組]
      </div>
     ";
       
     // Success sent message alert
    $mail->send();

 }
 ?>
