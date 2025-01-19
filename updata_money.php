<?php
if(isset($_POST['inpmoney'], $_POST['getvalue'])){
    $inpmoney=$_POST['inpmoney'];
    $mid=$_POST['mid'];
    $getvalue=$_POST['getvalue'];
    $value=$getvalue+$inpmoney;
    require_once('ivm_database.php');
    $upintermoney = $pdo->prepare("UPDATE intermoney SET money = ? WHERE mid = ? ");
    $upintermoney->execute([$value,$mid]);
    echo $value;
}

if(isset( $_POST['mid'])){
    $mid=$_POST['mid'];
    require_once('ivm_database.php');
    $insertmoney = $pdo->prepare("INSERT INTO intermoney (mid, money) VALUES (?,?)");
    $insertmoney->execute([$mid,'0']);
    echo '成功';
}
?>