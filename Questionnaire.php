<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en" id="darkorlight" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>問卷</title>
    <script src="./js/kit.fontawesome.com_b8ad2c2a06.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./css/font.css">
    <link rel="shortcut icon" href="./img/logo.png" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="./js/jquery-3.7.1.min.js"></script>

</head>
<body>

<form action="./AddPay" method="POST" >
    <nav class="navbar  navbar-expand-lg shadow p-1 bg-body rounded">
        <div class="container-fluid">
            <a class="navbar-brand align-middle" href="./choose"><img  src="./img/logo.png" width="48" height="48">IVM多元化販賣機</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a class="nav-link" href="./choose">主選單</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="account_setting">帳戶設定</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="./Purchase details">購買明細</a>
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
                    <a class="nav-link" href="./Fetch">交易驗證</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="./interface">開發歷程</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="./contact.php">聯絡我們</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="./learnmone">隱私權政策</a>
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

<form action="./Questionnaire" method="post" class="needs-validation" novalidate>
<div class="container">
    <div class="row">
        <div class="col">
        <div class="col-12 col-xl-6 mt-5 mx-auto">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div id="one" > <!-- log:第一部分問卷title -->
                        <div class="card-title">
                            <h2 class="text-center">
                                無接觸式販賣機調查表-後測
                            </h2>
                        </div>
                        <div class="card-text mt-4" style="font-size: 17px;">
                            親愛的先生、小姐您好 ：<br>
                            非常感謝您抽空填寫此問卷，本研究調查您對於販賣機的功能、販賣商品及網站操作的調查。<br>
                            本問卷僅作為學術研究用途，將以不記名之方式，不留下您任何資訊，敬請安心填答。<br>
                            再次感謝您的協助並祝您有美好的一天。<br>
                            <br><br>
                            台南應用科技大學　資訊管理系<br>
                            指導老師：黃玉枝老師<br>
                            專題學生：吳思瑩、盧君姵、謝宜臻、梁先宏、董文賓　敬上<br>
                        </div>
                        <div class="text-end">
                            <button id="OneBt" type="button" class="btn btn-primary mt-2">確認</button>
                        </div>
                    </div>                                <!-- log:第一部分問卷title結尾 -->

                    <div id="two" style="display:none;"> <!-- log:第二部分問卷基本資料 -->
                        <div class="card-title">
                            <h2 class="text-center">
                                基本資料
                            </h2>
                        </div>
                        <div class="card-body" style="font-size: 17px;">
                            <p><b>性別</b></p>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="radio" name="sex" id="sex1" value="男">
                                <label class="form-check-label" for="sex1">
                                    男
                                </label>
                            </div>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="radio" name="sex" id="sex2" value="女">
                                <label class="form-check-label" for="sex2">
                                    女
                                </label>
                            </div>
                            <p class="mt-4"><b>年齡</b></p>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="radio" name="age" id="age1" value="15歲（含）以下">
                                <label class="form-check-label" for="age1">
                                    15歲（含）以下
                                </label>
                            </div>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="radio" name="age" id="age2" value="16-20歲">
                                <label class="form-check-label" for="age2">
                                    16-20歲
                                </label>
                            </div>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="radio" name="age" id="age3" value="21-25歲">
                                <label class="form-check-label" for="age3">
                                    21-25歲
                                </label>
                            </div>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="radio" name="age" id="age4" value="26歲（含）以上">
                                <label class="form-check-label" for="age4">
                                    26歲（含）以上
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-start">
                                <button id="TwoResBt" type="button" class="btn btn-primary mt-2">返回</button>
                            </div>

                            <div class="col-6 text-end">
                                <button id="TwoBt" type="button" class="btn btn-primary mt-2">下一頁</button>
                            </div>
                        </div>
                    </div>                                <!-- log:第二部分問卷基本資料結尾 -->

                    <div id="three" style="display:none;"> <!-- log:第三部分問卷販賣機使用頻率調查 -->
                        <div class="card-title">
                            <h2 class="text-center">
                                販賣機使用頻率調查
                            </h2>
                        </div>
                        <div class="card-body" style="font-size: 17px;">
                            <p class="mt-4"><b>您使用販賣機的頻率</b></p>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="radio" name="frequency" id="frequency1" value="沒使用過">
                                <label class="form-check-label" for="frequency1">
                                    沒使用過
                                </label>
                            </div>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="radio" name="frequency" id="frequency2" value="很少使用（有需要才會用）">
                                <label class="form-check-label" for="frequency2">
                                    很少使用（有需要才會用）
                                </label>
                            </div>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="radio" name="frequency" id="frequency3" value="偶爾使用">
                                <label class="form-check-label" for="frequency3">
                                    偶爾使用
                                </label>
                            </div>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="radio" name="frequency" id="frequency4" value="經常使用">
                                <label class="form-check-label" for="frequency4">
                                    經常使用
                                </label>
                            </div>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="radio" name="frequency" id="frequency5" value="每天使用">
                                <label class="form-check-label" for="frequency5">
                                    每天使用
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-start">
                                <button id="ThreeResBt" type="button" class="btn btn-primary mt-2">返回</button>
                            </div>

                            <div class="col-6 text-end">
                                <button id="ThreeoBt" type="button" class="btn btn-primary mt-2">下一頁</button>
                            </div>
                        </div>
                    </div>                                <!-- log:第三部分問卷販賣機使用頻率調查結果 -->

                    <div id="four" style="display:none;"> <!-- log:第四部分問卷什麼原因導致您沒使用過/很少使用販賣機 -->
                        <div class="card-title">
                            <h2 class="text-center">
                                販賣機使用頻率調查
                            </h2>
                        </div>
                        <div class="card-body" style="font-size: 17px;">
                            <p class="mt-4"><b>什麼原因導致您沒使用過/很少使用販賣機</b></p>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="radio" name="Whyfrequency1" id="frequency6" value="附近沒有販賣機">
                                <label class="form-check-label" for="frequency6">
                                    附近沒有販賣機
                                </label>
                            </div>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="radio" name="Whyfrequency1" id="frequency7" value="便利商店比較方便">
                                <label class="form-check-label" for="frequency7">
                                    便利商店比較方便
                                </label>
                            </div>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="radio" name="Whyfrequency1" id="frequency8" value="不習慣使用">
                                <label class="form-check-label" for="frequency8">
                                    不習慣使用
                                </label>
                            </div>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="radio" name="Whyfrequency1" id="frequency9" value="其他">
                                <label class="form-check-label" for="frequency9">
                                    其他
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-start">
                                <button id="FourResBt" type="button" class="btn btn-primary mt-2">返回</button>
                            </div>

                            <div class="col-6 text-end">
                                <button id="FouroBt" type="button" class="btn btn-primary mt-2">下一頁</button>
                            </div>
                        </div>
                    </div>                                <!-- log:第四部分問卷什麼原因導致您沒使用過/很少使用販賣機結尾 -->
                    <div id="five" style="display:none;"> <!-- log:第五部分問卷什麼原因會使您偶爾使用/經常使用(2~4天)/每天使用販賣機 -->
                        <div class="card-title">
                            <h2 class="text-center">
                                販賣機使用頻率調查
                            </h2>
                        </div>
                        <div class="card-body" style="font-size: 17px;">
                            <p class="mt-4"><b>什麼原因會使您偶爾使用/經常使用(2~4天)販賣機/每天使用</b></p>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="radio" name="Whyfrequency1" id="frequency6" value="附近沒有販賣機" required>
                                <label class="form-check-label" for="frequency6">
                                    附近就有販賣機
                                </label>
                            </div>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="radio" name="Whyfrequency1" id="frequency7" value="便利商店比較方便" required>
                                <label class="form-check-label" for="frequency7">
                                    比較方便
                                </label>
                            </div>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="radio" name="Whyfrequency1" id="frequency8" value="不習慣使用" required>
                                <label class="form-check-label" for="frequency8">
                                    習慣使用
                                </label>
                            </div>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="radio" name="Whyfrequency1" id="frequency9" value="其他" required>
                                <label class="form-check-label" for="frequency9">
                                    其他
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-start">
                                <button id="FiveResBt" type="button" class="btn btn-primary mt-2">返回</button>
                            </div>

                            <div class="col-6 text-end">
                                <button id="FiveBt" type="button" class="btn btn-primary mt-2">下一頁</button>
                            </div>
                        </div>
                    </div>                                <!-- log:第五部分問卷什麼原因會使您偶爾使用/經常使用(2~4天)/每天使用販賣機結尾 -->

                    <div id="six" style="display:none;"> <!-- log:第六部分問卷您是否有使用行動支付 -->
                        <div class="card-title">
                            <h2 class="text-center">
                                行動支付調查
                            </h2>
                        </div>
                        <div class="card-body" style="font-size: 17px;">
                            <p class="mt-4"><b>您是否有使用行動支付</b></p>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="radio" name="Pay" id="Pay1" value="是" required>
                                <label class="form-check-label" for="Pay1">
                                    是
                                </label>
                            </div>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="radio" name="Pay" id="Pay2" value="否" required>
                                <label class="form-check-label" for="Pay2">
                                    否
                                </label>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-6 text-start">
                                <button id="sixResBt" type="button" class="btn btn-primary mt-2">返回</button>
                            </div>

                            <div class="col-6 text-end">
                                <button id="sixBt" type="button" class="btn btn-primary mt-2">下一頁</button>
                            </div>
                        </div>
                    </div>                                <!-- log:第五部分問卷什麼原因會使您偶爾使用/經常使用(2~4天)/每天使用販賣機結尾 -->


                </div>
            </div>
        </div>
        </div>
    </div>
</div>
</form>
<button class="btn btn-primary" id="check" type="button">送出</button>
<?php
// <div jsname="o6bZLc">
// name="entry.301849957" value="">
// name="entry.2085011906" value="">
// name="entry.1915161455" value="">
// name="entry.912286954" value="">
// name="entry.891220809" value="">
// name="entry.1081131290" value="">
// name="entry.1373562174" value="">
// name="entry.1603727985" value="">
// name="entry.2084903782" value="">
// name="entry.205516134" value="">
// name="entry.265106250" value="">
// name="entry.318337737" value="">
// name="entry.474723210" value="">
// name="entry.542883034" value="">
// name="entry.270837041" value="">
// name="entry.839891953" value="">
// </div>

?>
    <script src="./js/questionnairejs.js"></script>


</body>
</html>

