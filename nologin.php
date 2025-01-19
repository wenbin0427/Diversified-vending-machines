<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en" id="darkorlight" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登入提醒</title>
    <script src="./js/kit.fontawesome.com_b8ad2c2a06.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./css/font.css">
    <link rel="shortcut icon" href="./img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="./css/anaition.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="./js/jquery-3.7.1.min.js"></script>
</head>

<body>
<div class="modal fade show" tabindex="-1" style="display: block;">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">登入提醒</h5>
      </div>
      <div class="modal-body">
        <p>經檢測您尚未登入，請點擊下方登入開始體驗本網站。</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="location.href='./login'">登入</button>
      </div>
    </div>
  </div>
</div>

<div id="ViewChoosePayBackdrop" class="modal-backdrop show d-block"></div>

</body>
</html>

