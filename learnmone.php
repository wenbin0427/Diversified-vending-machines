<?php
session_start();
error_reporting(0); 
$member=$_SESSION["email"];
if($member==""){
    $navview="d-none";
    $res="            
    <ul class=navbar-nav>
        <li class=nav-item>
        <a class=nav-link href=javascript:history.back()>回上一頁</a>
        </li>
    </ul>
";
}else{
}
?>
<!DOCTYPE html>
<html lang="en" id="darkorlight" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>隱私權政策</title>
    <script src="./js/kit.fontawesome.com_b8ad2c2a06.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/font.css">
    <link rel="shortcut icon" href="./img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/bootstrap.bundle.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/b8ad2c2a06.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</head>
<body>
<form action="./account_setting" method="POST">
    <nav class="navbar  navbar-expand-lg shadow p-1 bg-body rounded">
        <div class="container-fluid">
            <a class="navbar-brand align-middle" ><img  src="./img/logo.png" width="48" height="48">IVM多元化販賣機</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <?php echo $res; ?>
                <ul class="navbar-nav <?php echo $navview;?> ">
                    <li class="nav-item">
                    <a class="nav-link " href="./choose">主選單</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link " href="account_setting">帳戶設定</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link " href="./Purchase details">購買明細</a>
                    </li>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="./Pay" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        付款設定
                      </a>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="./AddPay">新增信用卡</a></li>
                        <li><a class="dropdown-item" href="./PayManager">信用卡管理</a></li>
                      </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./buycar">購物袋</a>
                    </li>
                    <li class="nav-item ">
                    <a class="nav-link " href="./Fetch">交易驗證</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="./interface">開發歷程</a>
                    </li>
                    <li class="nav-item ">
                    <a class="nav-link" href="./contact.php">聯絡我們</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="./learnmone">隱私權政策</a>
                    </li>
                    <li class="nav-item dropdown">
                    <li class="nav-item">
                        <button type="submit" class="nav-link" name="logout" onclick="logout()" value="登出">登出</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</form>

<div class="container mt-5">
    <div class="row">
        <div class="col text-center fs-1 fw-bold">
            隱私權政策
            <hr>
        </div>
    </div>
    <div class="col">
        <ol style="list-style:cjk-ideographic">
            <li>
            隱私權保護政策的適用範圍，隱私權保護政策內容，包括「本服務」如何處理在您使用「本服務」時收集到的個人識別資料。隱私權保護政策不適用於本服務以外的相關連結網站，也不適用於非本網站所委託或參與管理的人員。
            </li>

            <li class="mt-3">個人資料保護法應告知事項</li>
            <ol>
                <li>蒐集機關名稱：IVM多元化販賣機專題小組</li>
                <li>蒐集目的：消費者、客戶管理與服務，網路購物及其他電子商務服務。</li>
                <li>個人資料類別：識別類 ( 姓名、聯絡電話、電子郵件信箱 )、其他(往來電子郵件、網站留言、系統自動記錄之軌跡資訊等)。</li>
                <li>個人資料利用期間：本網站會員有效期間及終止後30天。</li>
                <li>個人資料利用地區：本小組執行業務及伺服器主機所在地，目前為台灣。</li>
                <li>個人資料利用方式：依蒐集目的範圍及本隱私權政策進行利用，除非事先說明、或為完成提供服務或履行合約義務之必要、或依照相關法令規定或有權主管機關之命令或要求，否則本小組不會將足以識別使
                    用者身分的個人資訊提供給第三人、或移作蒐集目的以外使用。
                </li>
                <li>行使個人資料權利方式：依個人資料保護法第 3 條規定，您就您的個人資料享有查詢或請求閱覽、
                    補充、更正、停止蒐集、處理、利用以及刪除之權利。您可以向本小組提出上述申請，本小組將依個
                    人資料保護法及法令遵循或內部控制等相關法令規範，據以決定或受理您的申請。 若您的個人資料
                    已逾法令規定之保存時限且蒐集之特定目的均已消滅，則本小組將主動銷滅或刪除您的個人資料。
                </li>
            </ol>

            <li class="mt-3">個人資料的蒐集、處理及利用方式</li>
            <ol>
                <li>當您使用「本服務」所提供之功能時，我們將視該服務功能性質，請您提供必要的個人資料，並在該特定目的範圍內處理及利用您的個人資料；非經您書面同意，本網站不會將個人資料用於其他用途。</li>
                <li>「本服務」在您使用服務信箱、問卷調查、發送電子報...等互動性功能時，會保留您所提供的姓名、電子郵件地址、聯絡方式及使用時間等。</li>
                <li>於一般瀏覽時，伺服器會自行記錄相關行徑，包括您使用連線設備的IP位址、使用時間、使用的瀏覽器、瀏覽及點選資料記錄等，做為我們增進網站服務的參考依據，此記錄為內部應用，決不對外公佈。</li>
                <li>為提供精確的服務，我們會將收集的問卷調查內容進行統計與分析，分析結果之統計數據或說明文字呈現，除供內部研究外，我們會視需要公佈統計數據及說明文字，但不涉及特定個人之資料。</li>

            </ol>
            <li class="mt-3">資料之保護</li>
            <ol>
                <li>「本服務」主機均設有防火牆、防毒系統等相關的各項資訊安全設備及必要的安全防護措施，加以保護網站及您的個人資料採用嚴格的保護措施，只由經過授權的人員才能接觸您的個人資料，相關處理人員皆簽有保密合約，如有違反保密義務者，將會受到相關的法律處分。</li>
                <li>如因業務需要有必要委託其他單位提供服務時，本服務亦會嚴格要求其遵守保密義務，並且採取必要檢查程序以確定其將確實遵守。</li>
            </ol>

            <li class="mt-3">Cookie 之使用</li>
            <ol>
                <li>為了提供您最佳的服務，「本服務」會在您的電腦中放置並取用我們的Cookie，若您不願接受Cookie的寫入，您可在您使用的瀏覽器功能項中設定隱私權等級為高，即可拒絕Cookie的寫入，但可能會導至網站某些功能無法正常執行。</li>
            </ol>

            <li class="mt-3">隱私權保護政策之修正</li>
            <ol>
                <li>「本服務」隱私權保護政策將因應需求隨時進行修正，修正後的條款將刊登於網站上。</li>
            </ol>
        </ol>
    </div>
    <div class="col text-center mb-3">
        <button class="btn btn-primary w-25"  onclick="history.back()">回上一頁</button>
    </div>
</div>


</body>
</html>

