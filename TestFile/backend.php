<?php
if(isset($_POST['data1']) && isset($_POST['data2'])){ // 判斷按鈕是否被按下
    // 如果按鈕被按下，處理提交的表單數據
    $data1 = $_POST['data1'];
    $data2 = $_POST['data2'];

    // 做一些後續處理或返回一個消息
    echo "Form submitted successfully. Data1: $data1, Data2: $data2";
} else {
    // 如果按鈕沒有被按下，返回一個錯誤消息
    echo "Error: Button not pressed!";
}
?>
