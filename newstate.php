<!DOCTYPE html>
<html lang="en" id="darkorlight">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新驗證</title>
    <link rel="shortcut icon" href="./img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="./css/font.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/kit.fontawesome.com_b8ad2c2a06.js" crossorigin="anonymous"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/b8ad2c2a06.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="./js/jquery-3.7.1.min.js"></script>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden; /* 禁止页面滚动 */
            width: 100%;
        }

    </style>
</head>

<body>

            <?php
                require_once('ivm_database.php');
                $transaction = $pdo->prepare("SELECT * FROM transaction WHERE state='尚未驗證'");
                $transaction->execute();
                $buycarsta = $pdo->prepare("SELECT * FROM buycar WHERE shoppingstate='尚未驗證' AND state !=''");
                $buycarsta->execute();
                $trancount=$transaction->rowCount();
                $buycarcoutn=$buycarsta->rowCount();

                if($trancount==0 && $buycarcoutn==0){
                    ?>
                    <img  src="./img/viewcat.gif" class="w-100 h-100 position-absolute top-50 start-50 translate-middle">
                    <?php
                }else{
            ?>
            <div class="card mt-5 h-100 w-100 position-absolute top-50 start-50 translate-middle">
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr class="text-center  border-bottom table-info">
                            <td>交易編號</td>
                            <td>會員姓名</td>
                            <td>商品名稱</td>
                            <td>商品種類</td>
                            <td>數量</td>
                            <td>價格</td>
                            <td>驗證碼</td>
                            <td>時間</td>
                            <td>狀態</td>
                        </tr>
                        <tr class="text-center">
                        <?php
                            while ($row = $transaction->fetch(PDO::FETCH_ASSOC)) {
                                $member = $pdo->prepare("SELECT * FROM member");
                                $member->execute();
                                if($row['state']=='尚未驗證'){
                                    $transmid=$row['transmid'];
                                    while ($memrow = $member->fetch(PDO::FETCH_ASSOC)) {
                                    if($transmid==$memrow['mid']){
                                        $membername=$memrow['name'];
                                    }
                                    }
                        ?>
                            <td><?php echo $row['tno']; ?></td>
                            <td><?php echo $membername; ?></td>
                            <td><?php echo $row['pname']; ?></td>
                            <td><?php echo $row['catalog']; ?></td>
                            <td><?php echo $row['quantity']; ?></td>
                            <td><?php echo $row['price']; ?></td>
                            <td><?php echo $row['tran_code']; ?></td>
                            <td><?php echo $row['transtime']; ?></td>
                            <td><?php echo $row['state']; ?></td>
    
                        </tr>
    
                <?php
                            }
                        }

                        while ($buycarrow = $buycarsta->fetch(PDO::FETCH_ASSOC)) {
                                $member = $pdo->prepare("SELECT * FROM member");
                                $member->execute();
                            if($buycarrow['shoppingstate']=='尚未驗證'){
                                $buymid=$buycarrow['mid'];
                                while ($memrow = $member->fetch(PDO::FETCH_ASSOC)) {
                                    if($buymid==$memrow['mid']){
                                        $membername=$memrow['name'];
                                    }
                                    }
                                ?>
                                <tr class="text-center">
                                    <td><?php echo $buycarrow['bcarid']; ?></td>
                                    <td><?php echo $membername; ?></td>
                                    <td><?php echo $buycarrow['pname']; ?></td>
                                    <td><?php echo $buycarrow['catalog']; ?></td>
                                    <td><?php echo $buycarrow['quantity']; ?></td>
                                    <td><?php echo $buycarrow['price']; ?></td>
                                    <td><?php echo $buycarrow['state']; ?></td>
                                    <td><?php echo $buycarrow['datatime']; ?></td>
                                    <td><?php echo $buycarrow['shoppingstate']; ?></td>
                                </tr>
                                <?php
                            }
                        }
    
                    }
                ?>
                    </table>

                </div>
            </div>
<script>
</script>
</body>

</html>