<?php
$id = $_GET['id'];
ob_start()
?>
<!DOCTYPE html>
<html lang="en" id="darkorlight" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>使用者帳戶編輯</title>
    <script src="../js/kit.fontawesome.com_b8ad2c2a06.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/font.css">
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.bundle.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/b8ad2c2a06.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="../js/jquery-3.7.1.min.js"></script>

    <style>
        body{
            background-color: azure;
        }
    </style>
</head>
<body>
<?php
              require_once('../ivm_database.php');
              // ! 會員資料表
              $stmt = $pdo->prepare('select * from member WHERE mid=?');
              $stmt->execute([$id]);

              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $mid=$row['mid'];
                $name=$row['name'];
                $cellnum=$row['cellnum'];
                $email=$row['email'];
                $identity=$row['identity'];
                $member_state=$row['member_state'];
                $datetime=$row['datetime'];
                $terms=$row['terms'];
                $Questionnaire=$row['Questionnaire'];
              }
?>

<div class="container">
    <div class="row">
        <div class="col-12 col-xl-6 mt-4 mx-auto">
            <h2 class="text-center mb-3">會員基本資料管理</h2>
            <form action="./updata_admin_member?id=<?php echo $id; ?>" method="post">
                <div class="card m-2">
                    <div class="card-body">
                        <label class="form-label">使用者名稱</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><box-icon type='solid' name='user'></box-icon></span>
                            <input type="text" class="form-control" name="Usename" id="Usename" value="<?php echo $name;?>" >
                        </div>
                        <label class="form-label">手機號碼</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><box-icon name='phone' type='solid' ></box-icon></span>
                            <input type="text" class="form-control" name="Usecellnum" id="Usecellnum" value="<?php echo $cellnum ;?>" >
                        </div>
                        <label class="form-label">電子信箱</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><box-icon name='envelope' type='solid' ></box-icon></span>
                            <input type="text" class="form-control" name="Useemail" id="Useemail" value="<?php echo $email ;?>" >
                        </div>                 
                        <label class="form-label">註冊日期</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><box-icon name='calendar' type='solid' ></box-icon></span>
                            <input type="text" class="form-control" value="<?php echo $datetime ;?>" disabled>
                        </div>
                        <label class="form-label">問卷填寫狀態<span class="badge rounded-pill text-bg-danger">本欄位非即時更新</span></label>
                        <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupSelect01"><box-icon name='edit'></box-icon></label>
                        <select class="form-select" id="inputGroupSelect01" name="SelectQuest">
                            <?php
                                if($Questionnaire=='已填寫'){
                                    ?>
                                        <option value="已填寫">已填寫</option>
                                        <option value="尚未填寫">尚未填寫</option>
                                    <?php
                                }else{
                                    ?>
                                        <option value="尚未填寫">尚未填寫</option>
                                        <option value="已填寫">已填寫</option>
                                    <?php                                
                                    }
                            ?>
                        </select>
                    </div>
                    <div class="container ">
                            <div class="row mt-3">
                                <button class="col btn btn-primary rounded" type="button" name="close" id="close">取消</button>
                                <button class="col btn btn-success rounded ms-5" type="submit" name="check">確定</button>
                            </div>
                    </div>
                    </div>
                </div>
            </form>
        </div>
    </div> 
</div>
<?php
if(isset($_POST['check'])){
    $Usename=$_POST['Usename'];
    $Usecellnum=$_POST['Usecellnum'];
    $Useemail=$_POST['Useemail'];
    $SelectQuest=$_POST['SelectQuest'];
    $upmember = $pdo->prepare("UPDATE member SET name=?,cellnum=?,email=?,Questionnaire=? WHERE mid=?");
    $upmember->execute([$Usename,$Usecellnum,$Useemail,$SelectQuest,$id]);
    header("Location:./updata_admin_member?id=$id");

}
// 你要開一家店需要哪些報表


?>



<script>
$(document).ready(function(){
    $("#close").on('click',function(){
        // 关闭当前窗口
        window.close();
    });
});
</script>
</body>
</html>

