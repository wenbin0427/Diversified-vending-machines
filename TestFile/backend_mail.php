<?php
session_start();
if(isset($_POST['Create_email'])){ // 判斷按鈕是否被按下
    // 如果按鈕被按下，處理提交的表單數據
    $mail_email=$_POST['Create_email'];
    $mail_random=$_SESSION['mail_random'];
    // 做一些後續處理或返回一個消息
    echo "你的email$mail_email,隨機碼$mail_random";
} else {
    // 如果按鈕沒有被按下，返回一個錯誤消息
    echo "Error: Button not pressed!";
}
?>
