<!DOCTYPE html>
<html lang="en" id="darkorlight" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員管理</title>
    <script src="../js/kit.fontawesome.com_b8ad2c2a06.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.bundle.min.js"></script>
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="../css/font.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400&display=swap" rel="stylesheet">
    <script src="../js/jquery-3.7.1.min.js"></script>

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <h2 class="text-center mb-2">會員管理</h2>
                        <table  class="table">
                            <tr id="content">

                            </tr>
                        </table>
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
                  //處理返回數據
                 var responseData = JSON.parse(xhr.responseText);
                  //更新畫面
                 updateUI(responseData);
             } else {
                 console.error('Ajax request failed');
             }
         }
     };
     xhr.open('GET', 'select.php', true);
     xhr.send();
 }
 // 更新畫面

// 更新畫面
function updateUI(data) {
    var contentDiv = document.getElementById('content');

    // 清空原始內容
    contentDiv.innerHTML = '';

    // 創建表格元素
    var table = document.createElement('table');
    table.classList.add('table','text-center'); // 添加 Bootstrap 表格樣式

    // 創建表頭
    var thead = document.createElement('thead');
    var headerRow = document.createElement('tr');
    var headers = ['編號', '會員名稱', '電子信箱', '手機號碼', '驗證', '條款', '日期', '問卷','操作'];
    headers.forEach(function(headerText) {
        var th = document.createElement('th');
        th.textContent = headerText;
        th.classList.add('text-center'); // 添加 Bootstrap 文本置中
        headerRow.appendChild(th);
    });
    thead.appendChild(headerRow);
    table.appendChild(thead);

    // 創建表格主體
    var tbody = document.createElement('tbody');
    data.forEach(function(item) {
        var row = document.createElement('tr');
        var cells = [item.mid, item.name, item.email, item.cellnum, item.memberstate, item.terms, item.datetime, item.Questionnaire];
        cells.forEach(function(cellText) {
            var cell = document.createElement('td');
            cell.textContent = cellText;
            row.appendChild(cell);
        });
        // 插入按鈕元素
        var buttonCell = document.createElement('td');
        var button = document.createElement('button');
        
        button.textContent = '編輯'; // 按鈕文字
        button.classList.add('btn', 'btn-primary'); // 添加 Bootstrap 按鈕樣式
        button.dataset.value = item.mid; // 設置按鈕的值為會員名稱
        button.addEventListener('click', function() {
            console.log(this.dataset.value); // 點擊按鈕時印出按鈕的值
            openNewPageWithParams('./updata_admin_member', this.dataset.value);
            
        });
        buttonCell.appendChild(button);
        row.appendChild(buttonCell);

        tbody.appendChild(row);
    });
    table.appendChild(tbody);

    // 插入表格到 contentDiv
    contentDiv.appendChild(table);
}

// 在新页面中打开指定的URL，并传递参数
function openNewPageWithParams(url, paramValue) {
  // 构建带参数的URL

  var newUrl = url + '?id='+encodeURIComponent(paramValue);

  // 在新页面中打开URL
  window.open(newUrl, '_blank');
}


// 定時更新畫面
setInterval(updateContent, 1000); // 每5秒更新一次

</script>
</body>
</html>

