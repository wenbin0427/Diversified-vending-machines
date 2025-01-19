<?php

// 資料庫連接設定
$servername = "localhost";
$username = "root";
$password = "1234";
$database = "ivm_database";

// 建立連線
$conn = new mysqli($servername, $username, $password, $database);

// 檢查連線
if ($conn->connect_error) {
    die("連線失敗: " . $conn->connect_error);
}

// 查詢資料庫取得時間和姓名的資料
$sql = "SELECT * FROM member";
$result = $conn->query($sql);

// 檢查查詢結果是否為空
if ($result->num_rows > 0) {
    // 將查詢結果轉換為 JSON 格式的回應
    $response = array();
    while($row = $result->fetch_assoc()) {
        $response[] = array(
            'name' => $row['name'],
            'email' => $row['email']
        );
    }

    // 設定回應的 Content-Type 為 JSON
    header('Content-Type: application/json');

    // 將 JSON 物件轉換為字串並輸出
    echo json_encode($response);
} else {
    echo "0 筆結果";
}

// 關閉資料庫連線
$conn->close();

?>
