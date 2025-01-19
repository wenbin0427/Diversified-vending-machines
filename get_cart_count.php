<?php
session_start();
require_once('ivm_database.php'); 
if (isset($_SESSION['mid'])) {
    $mid = $_SESSION['mid'];

    $buycarid = $pdo->prepare("SELECT * FROM buycar WHERE mid=$mid");
    $buycarid->execute();
    $buycount = $buycarid->rowCount();

    if ($buycount!=0) {
        //回傳購物車數量
        echo $buycount;
    } else {
        echo '0'; 
    }
} else {
    echo '0'; 
}
?>
