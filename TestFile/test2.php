<?php
    session_start();
    //error_reporting(0); 
    //$member=$_SESSION["email"];
    //$mid = $_SESSION['mid'];
    $mid=1;
    // ! 導覽列部分
    if(isset($_POST['logout'])){
        session_destroy();
        header("Location: login.php");
    }

?>
<!DOCTYPE html>
<html lang="en" id="darkorlight" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>購買明細</title>
    <script src="./js/kit.fontawesome.com_b8ad2c2a06.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <script src="./js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./css/font.css">
    <link rel="shortcut icon" href="./img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="./css/anaition.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

</head>

<body>
<?php
    require_once('ivm_database.php');
    $trans_history = $pdo->prepare("SELECT * FROM transaction ORDER BY transtime ASC");
    $trans_history->execute();
    $product = $pdo->prepare("SELECT * FROM product");
    $product->execute();
?>
            <?php
                while ($trans_row = $trans_history->fetch(PDO::FETCH_ASSOC)) {
                    if($trans_row['state']=="交易完成" || $trans_row['state'] =="已失效"){
                        $trans_pno=$trans_row['pno'];
                        $trans_tno=$trans_row['tno'];
                        $trans_pname=$trans_row['pname'];
                        $trans_time=$trans_row['transtime'];
                        echo $trans_pno."<br>";
                        while ($row = $product->fetch(PDO::FETCH_ASSOC)) {
                            if($trans_pno==$row['pno']){
                                echo $row['img']."<br>";
                            }}
                            $product->execute();


            }
        }
            ?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // 找到所有的downbt按鈕
    var downButtons = document.querySelectorAll(".downbt");

    // 監聽所有downbt按鈕的點擊事件
    downButtons.forEach(function(downButton) {
        downButton.addEventListener("click", function() {
            // 找到與downButton相關的viewtran
            var viewtran = downButton.nextElementSibling;

            // 切換該viewtran的顯示狀態
            viewtran.classList.toggle("d-none");
        });
    });
});

</script>


</body>
</html>

