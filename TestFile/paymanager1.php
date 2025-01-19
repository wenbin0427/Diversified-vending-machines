<?php
    session_start();
    $mid = $_SESSION["mid"];
?>

<!DOCTYPE html>
<html lang="en" id="darkorlight" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>選擇商品</title>
    <script src="./js/kit.fontawesome.com_b8ad2c2a06.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/bootstrap.bundle.min.js"></script>
    <link rel="shortcut icon" href="./img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="./css/font.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400&display=swap" rel="stylesheet">
</head>
<body>
<script>

</script>
<form action="./choose.php" method="POST">
    <nav class="navbar  navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand align-middle" href="#"><img  src="./img/logo.png" width="48" height="48">IVM多元化販賣機</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a class="nav-link" href="account_setting.php">帳戶設定</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">購買明細</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="./pay.php">付款方式</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">交易驗證</a>
                    </li>
                    <li class="nav-item dropdown">
                    <li class="nav-item ">
                        <button type="submit" class="nav-link" name="logout" onclick="logout()" value="登出">登出</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</form>
<div class="container">
    <div class="row">
        <div class="col-12 col-xl-6 mb-3 mx-auto">
            <div class="card border-0">
                <?php
                require_once('ivm_database.php'); 
                $stmt = $pdo->prepare("SELECT * FROM card WHERE mid=$mid");
                $stmt->execute();
                $count = $stmt->rowCount();
                if($count==0){
                    ?>
                    <div id="carouselExampleIndicators" class="carousel slide mt-5" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img src="./img/card/CardBackground_logo.png" class="d-block w-100">
                      </div>
                      <div class="carousel-item">
                        <img src="./img/card/CardBackground_logo2.png" class="d-block w-100">
                      </div>
                      <div class="carousel-item">
                        <img src="./img/card/CardBackground_logo3.png" class="d-block w-100">
                      </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </div>
                  <p class="text text-center align-middle">查無有效信用卡點選下方  <kbd class="bg-success">前往</kbd>  按鈕去新增吧！</p>
                  <button class="btn btn-success" onclick="location.href='./AddPay.php'">前往</button>
                  <?php
                }else{
                    while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                            $FirslCardid=substr($row['cardid'],0,4);
                            $TwoCardid=substr($row['cardid'],12,16);
                            $visa = substr($row['cardid'], 0, 1);$mas = substr($row['cardid'], 0, 2);$jcb = substr($row['cardid'], 0, 4);$four = substr($row['cardid'], 12, 4);
                            $cardid=$FirslCardid."********".$TwoCardid;
                            if ($visa == "4") {
                                $CardOrganize="./img/card/visa.png";
                            }elseif ($mas >= "51" and $mas <= "55") {
                                $CardOrganize="./img/card/mastercard.png";
                            }elseif ($jcb >= "3528" and $jcb <= "3589") {
                                $CardOrganize="./img/card/jcb.png";
                            }
                            $phpArray = array($row['Cardimg'], $row['cardid']);
                            $jsonString = json_encode($phpArray);
                            ?>
                                <img id="imgbt" src="<?php echo $row['Cardimg']; ?>" class="imgbt card-img mt-4 shadow rounded">
                                <div class="view-card position-relative text-light">
                                    <p class="card-text position-absolute bottom-0 start-0 mb-1 mx-2 fs-5 fw-bolder" style="text-shadow: 2px 3px 5px black;"><?php echo $cardid; ?></p>
                                    <img src="<?php echo $CardOrganize; ?>" class="position-absolute bottom-0 end-0 mb-2 mx-2" st width="15%">
                                </div>
                                <button type="button" name="deleteCard" id="deleteCard" class="deleteCard btn btn-danger d-none mt-2" data-bs-toggle="modal" data-bs-target="#DeleteCardBt" data-cardinfo="<?php echo htmlspecialchars(json_encode([$row['Cardimg'], $cardid,$CardOrganize,$row['cardid']])); ?>">刪除</button>
                            <?php
    
                        }
                }

                ?>
            </div>
        </div>
    </div>
</div>



<form action="./PayManager1.php" method="post">
<div class="modal fade" id="DeleteCardBt" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="display:none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-block text-center mt-2 mb-2"><b>確認要刪除此張卡片嗎?</b></div>
                <img src="" id="DeleteCardimg" class="img-fluid">
                <div class="view-card position-relative text-light">
                    <p id="DeleteCardDid" class="card-text position-absolute bottom-0 start-0 mb-1 mx-2 fs-5 fw-bolder" style="text-shadow: 2px 3px 5px black;"></p>
                    <img id="DeleteCardOrganize" src="" class="position-absolute bottom-0 end-0 mb-2 mx-2"  width="15%">
                </div>                
                <div class="modal-footer w-100">
                    <button type="submit" class="btn btn-danger" data-bs-toggle="modal" name="DelteCardBt" id='DelteCardBt' value="">確定刪除</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                </div>
            </div>
        </div>
    </div>
</div>
</form>

<script>
document.addEventListener('click', function(event) {
    if (event.target.matches('.imgbt')) {
        var siblingElement = event.target.nextElementSibling;
        while (siblingElement) {
            if (siblingElement.matches('.deleteCard')) {
                if (siblingElement.classList.contains('d-block')) {
                    siblingElement.classList.remove("d-block");
                    siblingElement.classList.add('d-none');
                } else {
                    siblingElement.classList.remove("d-none");
                    siblingElement.classList.add('d-block');
                }
                var cardInfoJson = siblingElement.getAttribute('data-cardinfo');

                // 解析 JSON 字符串为 JavaScript 对象
                var cardInfo = JSON.parse(cardInfoJson);

                // 输出 cardInfo 数组的值
                //console.log(cardInfo);
                document.getElementById('DeleteCardimg').src=cardInfo[0];
                document.getElementById('DeleteCardDid').innerText=cardInfo[1];
                document.getElementById('DeleteCardOrganize').src=cardInfo[2];
                document.getElementById('DelteCardBt').value=cardInfo[3];
                break;
            }
            
            siblingElement = siblingElement.nextElementSibling;

        }
        
    }
});


var DelteCardBt=document.getElementById('DelteCardBt');
DelteCardBt.addEventListener('click',function(){
    console.log('asdas');

});


</script>
<?php
if(isset($_POST['DelteCardBt'])){
    $DelRecord = $pdo -> prepare('DELETE FROM card WHERE mid=? AND cardid=?');
    $DelRecord -> execute( [$mid,$_POST['DelteCardBt']] );
    header("Location: ./PayManager1.php");

}
?>
</body>
</html>

