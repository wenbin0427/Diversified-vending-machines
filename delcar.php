<?php
session_start();

// 確認是否收到正確的 POST 請求
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['bcarid'])) {
    $bcarid = $_POST['bcarid'];

    echo $bcarid;

    // 載入資料庫連線設定
    require_once('ivm_database.php');

    // 使用 prepared statement 刪除購物車中對應的商品記錄
    $stmt = $pdo->prepare('DELETE FROM buycar WHERE bcarid = ?');

    // 執行 prepared statement，並傳入 bcarid 參數
    $stmt->execute([$bcarid]);

}
?>
