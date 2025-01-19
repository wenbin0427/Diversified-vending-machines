<?php
// 假设这里包含了数据库连接的代码，例如 $pdo 对象

// 检查是否接收到有效的 POST 数据
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 获取 POST 请求中的参数
    $bcarid = isset($_POST['bcarid']) ? $_POST['bcarid'] : null;
    $newQuantity = isset($_POST['newQuantity']) ? $_POST['newQuantity'] : null;

    // 验证参数是否有效
    if ($bcarid !== null && $newQuantity !== null) {
        // 更新数据库中购物车项目的数量
        require_once('ivm_database.php');
        $updateStmt = $pdo->prepare("UPDATE buycar SET quantity = :quantity WHERE bcarid = :bcarid");
        $updateStmt->execute(['quantity' => $newQuantity, 'bcarid' => $bcarid]);

        // 检查更新是否成功
        if ($updateStmt->rowCount() > 0) {
            // 返回成功响应
            echo json_encode(['success' => true]);
            exit; // 结束脚本执行
        }
    }
}

// 如果未能成功处理请求，返回错误响应
echo json_encode(['success' => false, 'message' => '更新失败']);
