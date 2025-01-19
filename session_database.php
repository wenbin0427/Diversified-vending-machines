<!doctype html>
<html lang="zh-tw">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>資料庫</title>
    <script src="./js/kit.fontawesome.com_b8ad2c2a06.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./css/font.css">
    <link rel="shortcut icon" href="./img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="./css/anaition.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400&display=swap" rel="stylesheet">
</head>


<body>
  
<div class="container">
  <div class="row">
    <div class="col">
        <div class="admin">
        <h2 class="text-center">操作區</h2>
            <form action="./session_database" method="post">
              <button type="submit" class="btn btn-success" name="Upquantity">補貨</button>
            </form>
            <form action="./mailfile/create_account_mail.php" method="post">
              <button type="submit" class="btn btn-success" id="create_mail" name="create_mail">註冊信</button>
            </form>
            <form action="./session_database.php" method="post">
                <button type="submit" class="btn btn-success" name="del" id="del">刪除</button>
                <button type="submit" class="btn btn-success" name="delmoney">刪除錢包</button>
                </form>
                <button type="submit" class="btn btn-success" disabled>Success</button>
        </div>
        <h2 class="text-center">會員資料表</h2>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">編號</th>
                <th scope="col">會員名稱</th>
                <th scope="col">手機號碼</th>
                <th scope="col">電子信箱</th>
                <th scope="col">密碼</th>
                <th scope="col">身分別</th>
                <th scope="col">驗證</th>
                <th scope="col">日期</th>
                <th scope="col">條款</th>
                <th scope="col">問卷</th>
              </tr>
            </thead>
            <tbody>
            <?php
              require_once('ivm_database.php');
              if(isset($_POST['del'])){
                $DelMember = $pdo -> prepare('DELETE FROM member WHERE name=?');
                $DelMember -> execute( ['學校'] );
              }

              // ! 會員資料表
              $stmt = $pdo->prepare('select * from member');
              $stmt->execute();

              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              ?>
              <tr>
                <th scope="row"><?php echo $row['mid']; ?></th>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['cellnum']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['password']; ?></td>
                <td>
                <?php 
                if($row['identity']=='管理員'){
                  echo "<font color='red'>";
                  echo $row['identity']; 
                }else{
                  echo $row['identity'];
                }
                ?>
              </td>
              <td><?php echo $row['member_state']; ?></td>
              <td><?php echo $row['datetime']; ?></td>
              <td><?php echo $row['terms']; ?></td>
              <td><?php echo $row['Questionnaire']; ?></td>
              </tr>
              <?php
              }
              ?>
            </tbody>
    </table>
    <!-- ---------------------------------------------------------------- -->
    <h2 class="text-center">信用卡資料表</h2>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">編號</th>
                <th scope="col">會員名稱</th>
                <th scope="col">卡號</th>
                <th scope="col">到期日</th>
                <th scope="col">安全碼</th>

              </tr>
            </thead>
            <tbody>
            <?php
            $stmt = $pdo->prepare('select * from card');
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              ?>
              <tr>
                <th scope="row"><?php echo $row['mid']; ?></th>
                <td><?php echo $row['cname']; ?></td>
                <td><?php echo $row['cardid']; ?></td>
                <td><?php echo $row['duedata']; ?></td>
                <td><?php echo $row['cvv']; ?></td>

              </tr>
              <?php
              }
              ?>
            </tbody>
    </table>
        <!-- ---------------------------------------------------------------- -->
        <h2 class="text-center">產品資料表</h2>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">商品編號</th>
                <th scope="col">產品名稱</th>
                <th scope="col">商品種類</th>
                <th scope="col">價格</th>
                <th scope="col">數量</th>
                <th scope="col">進貨日期</th>
                <th scope="col">保存期限</th>

              </tr>
            </thead>
            <tbody>
            <?php
            $stmt = $pdo->prepare('select * from product');
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              ?>
              <tr>
                <th scope="row"><?php echo $row['pno']; ?></th>
                <td><?php echo $row['pname']; ?></td>
                <td><?php echo $row['catalog']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td><?php echo $row['quantity']; ?></td>
                <td><?php echo $row['Purchase_Date']; ?></td>
                <td><?php echo $row['shelf_life']; ?></td>

              </tr>
              <?php
              }
              ?>
            </tbody>
    </table>
    <!-- ---------------------------------------------------------------- -->
    <h2 class="text-center">交易資料表</h2>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">交易編號</th>
                <th scope="col">商品編號</th>
                <th scope="col">會員編號</th>
                <th scope="col">商品名稱</th>
                <th scope="col">商品種類</th>
                <th scope="col">數量</th>
                <th scope="col">價格</th>
                <th scope="col">卡號</th>
                <th scope="col">電子錢包</th>
                <th scope="col">時間</th>
                <th scope="col">驗證碼</th>
                <th scope="col">交易狀態</th>

              </tr>
            </thead>
            <tbody>
            <?php
              $stmt = $pdo->prepare('select * from transaction');
              $stmt->execute();
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              ?>
              <tr>
                <th scope="row"><?php echo $row['tno']; ?></th>
                <td><?php echo $row['pno']; ?></td>
                <td><?php echo $row['transmid']; ?></td>
                <td><?php echo $row['pname']; ?></td>
                <td><?php echo $row['catalog']; ?></td>
                <td><?php echo $row['quantity']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td><?php echo $row['cardid']; ?></td>
                <td><?php echo $row['moneypay']; ?></td>
                <td><?php echo $row['transtime']; ?></td>
                <td><?php echo $row['tran_code']; ?></td>
                <td><?php 
                  if($row['state']=='交易完成'){
                    echo $row['state']; 
                  }else{
                    echo "<font color='red'>";
                    echo $row['state'];
                  }
                  ?>
                </td>

              </tr>
              <?php
              }
              ?>
            </tbody>
    </table>
<!-- ---------------------------------------------------------------- -->
        <h2 class="text-center">郵件資料表</h2>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">郵件編號</th>
                <th scope="col">會員編號</th>
                <th scope="col">會員姓名</th>
                <th scope="col">電子郵件</th>
                <th scope="col">發送時間</th>
                <th scope="col">驗證碼</th>
                <th scope="col">狀態</th>
              </tr>
            </thead>
            <tbody>
            <?php
              $stmt = $pdo->prepare('select * from mail');
              $stmt->execute();
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              ?>
              <tr>
                <th scope="row"><?php echo $row['mailno']; ?></th>
                <td><?php echo $row['mid']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['datatime']; ?></td>
                <td><?php echo $row['code']; ?></td>
                <td><?php echo $row['state']; ?></td>

              </tr>
              <?php
              }
              ?>
            </tbody>
    </table>
    </div>
  </div>
</div>

<?php
  //自動重新整理
  echo '<meta http-equiv="refresh" content="2;">';

  if(isset($_POST['Upquantity'])){
    require_once('ivm_database.php');
    $product = $pdo->prepare("UPDATE product SET quantity = 10 WHERE quantity=?");
    $product->execute([0]);
  }
  
  if(isset($_POST['delmoney'])){
    require_once('ivm_database.php');
    $DelMember = $pdo -> prepare('DELETE FROM intermoney WHERE mid=?');
    $DelMember -> execute( ['2'] );
  }
?>
</body>

</html>