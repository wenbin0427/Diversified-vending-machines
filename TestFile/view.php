<!DOCTYPE html>
<html lang="en" id="darkorlight">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登入</title>
    <script src="./js/kit.fontawesome.com_b8ad2c2a06.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="shortcut icon" href="./img/logo.png" type="image/x-icon" />
    <script src="./js/bootstrap.bundle.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>

<div class="title fs-1 text-center">
    待驗證清單
</div>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div id="content">
                        <!-- 這裡將用JavaScript填充資料 -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
// 發送Ajax請求
function updateContent() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // 處理返回數據
                var responseData = JSON.parse(xhr.responseText);
                // 更新畫面
                updateUI(responseData);
            } else {
                console.error('Ajax request failed');
            }
        }
    };
    xhr.open('GET', 'update.php', true);
    xhr.send();
}

// 更新畫面
function updateUI(data) {
    var contentDiv = document.getElementById('content');
    // 清空原始內容
    contentDiv.innerHTML = '';

    // 將資料添加到畫面上
    data.forEach(function(item) {
        var paragraph = document.createElement('p');
        paragraph.textContent = '姓名：' + item.name + ', 信箱：' + item.email;
        contentDiv.appendChild(paragraph);
    });
}

// 定時更新畫面
setInterval(updateContent, 5000); // 每5秒更新一次
</script>

</body>
</html>

