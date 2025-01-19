<?php
session_start(); // 启动会话
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $PDRun_Motor=$_SESSION['run_motor_pd'];
    if($PDRun_Motor=="PD_D"){
        exec("sudo python3 /var/www/html/steppermotor.py");
    }elseif($PDRun_Motor=="PD_F"){
        echo '飲料';
    }elseif($PDRun_Motor=="PD_J"){
        echo '餅乾';

    }
}
// if (isset($_POST['CheckFetch'])) {
//
// }
?>