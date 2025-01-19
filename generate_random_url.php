<?php
// 建立數據庫連接
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "ivm_database";

$conn = new mysqli($servername, $username, $password, $dbname);

// 檢查連接是否成功
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 生成隨機字符串
$random_string = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 10);

// 將隨機網址插入到數據庫
$target_url = "http://iotsvm.ddns.net/RWD_Manager/login.php"; // 替換為您想要用戶訪問的目標網頁
$sql = "INSERT INTO random_urls (random_string, target_url) VALUES ('$random_string', '$target_url')";

if ($conn->query($sql) === TRUE) {
    // 返回隨機網址
    echo "http://iotsvm.ddns.net/$random_string";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
