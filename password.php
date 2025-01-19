<?php
session_start();

// 檢查是否通過 POST 方法提交了表單
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    // 檢查是否提交了名為 Create_cellnum 和 Create_email 的表單字段
    if (isset($_POST['Create_cellnum']) && isset($_POST['Create_email'])) {
        // 獲取表單字段的值
        $cellnum = $_POST['Create_cellnum'];
        $email = $_POST['Create_email'];

        require_once('ivm_database.php');

        $stmt = $pdo->prepare('SELECT * FROM member WHERE cellnum = :cellnum AND email = :email');
        $stmt->execute(array(':cellnum' => $cellnum, ':email' => $email));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $message = "資料正確";
        } else {
            $message = "資料錯誤";
        }

    } else {
        // 如果未提交 Create_cellnum 或 Create_email，則顯示錯誤消息
        $message = "錯誤：請填寫完整的表單";
    }
}

// 將結果回傳至 HTML
echo '<script>';
echo 'var message = ' . json_encode($message) . ';';
echo 'document.getElementById("resultContainer").innerHTML = "<p>" + message + "</p>";';
echo '</script>';