<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>左側導航欄</title>
    <script src="../js/kit.fontawesome.com_b8ad2c2a06.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.bundle.min.js"></script>
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="../css/font.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400&display=swap" rel="stylesheet">
    <script src="../js/jquery-3.7.1.min.js"></script>
    <script src="https://registry.npmmirror.com/echarts/5.5.0/files/dist/echarts.min.js"></script>

    <style>
      html,body{
        height: 100%;
        width: 100%;
        
      }
      .nav{
        width: 300px;
        height: 100%;
      }
      nav a{
        display: block;
        width: 100%;
        padding-top: 5%;
        padding-left: 5%;
        padding-bottom: 5%;
        text-decoration: none;
        color: white;
      }
      .bodycont{
        display: flex;
        width: 100%;
        height: 100%;

      }
      .rightcontainer{
        flex: 1;
        padding: 20px;
        width: 100%;
        background-color: azure;

      }
      .selected{
        color: white;
        background-color:blue;
      }
    </style>
  </head>
<body>
  <div class="bodycont">
    <div class="nav bg-dark shadow-lg">
      <nav class="menu w-100">
        <h2 class="text-white text-center w-100 pt-2 mx-auto">功能選單</h2>
        <a class="" href="./index.php">首頁</a>
        <a class="" href="./member_admin.php">會員管理</a>
        <a class="" href="#">商品管理</a>
        <a class="" href="#">郵件管理</a>
        <a class="" href="#">銷售清單</a>
        <a class="" href="#">開發中2</a>
      </nav>
    </div>

    <!-- 右側內容 -->
    <div class="rightcontainer" >

    </div>

  </div>

<script>
   $(function () {
   $(".menu>a").click(function (e) {
     $(".menu>a.selected").removeClass();
     $(".rightcontainer").load($(this).addClass("selected").attr("href"));
     e.preventDefault();
   }).first().click();
 });
</script>
</body>
</html>
