<!DOCTYPE html>
<html lang="en" id="darkorlight" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>首頁</title>
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
    <script src="https://registry.npmmirror.com/echarts/5.5.0/files/dist/echarts.min.js"></script>
</head>
<body>
<?php
              require_once('../ivm_database.php');
            //   $stmt = $pdo->prepare('select * from member WHERE mid=?');
            //   $stmt->execute([$id]);

            //   while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            //     $mid=$row['mid'];
            //     $name=$row['name'];
            //     $cellnum=$row['cellnum'];
            //     $email=$row['email'];
            //     $identity=$row['identity'];
            //     $member_state=$row['member_state'];
            //     $datetime=$row['datetime'];
            //     $terms=$row['terms'];
            //     $Questionnaire=$row['Questionnaire'];
            //   }
?>

<div class="container">
    <div class="row">
        <div class="col-12 col-xl-6 mt-4">
            <div class="card m-2">
                <div class="card-body">
                    <div class="mx-auto" id="chart-container" style="width: 500px;height:400px;"></div>                    
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-6 mt-4">
            <div class="card m-2">
                <div class="card-body">
                <div class="mx-auto" id="chart-container" style="width: 500px;height:400px;"></div>                    

                    
                </div>
            </div>
        </div>
    </div> 
</div>
<script>
var dom = document.getElementById('chart-container');
var myChart = echarts.init(dom, null, {
  renderer: 'canvas',
  useDirtyRect: false
});
var app = {};

var option;

option = {
  title: {
    text: '銷售圖表',
    subtext: 'Fake Data',
    left: 'center'
  },
  tooltip: {
    trigger: 'item'
  },
  legend: {
    orient: 'horizontal',
    x: 'left',
    y: 'bottom'
  },
  series: [
    {
      name: 'Access From',
      type: 'pie',
      radius: '50%',
      data: [
        { value: 1048, name: 'Search Engine' },
        { value: 735, name: 'Direct' },
        { value: 580, name: 'Email' },
        { value: 484, name: 'Union Ads' },
        { value: 300, name: 'Video Ads' }
      ],
      emphasis: {
        itemStyle: {
          shadowBlur: 10,
          shadowOffsetX: 0,
          shadowColor: 'rgba(0, 0, 0, 0.5)'
        }
      }
    }
  ]
};

// Function to update chart data
function updateChart() {
  // Update your data here
  var newData = [
    { value: Math.floor(Math.random() * 1000), name: 'Search Engine' },
    { value: Math.floor(Math.random() * 1000), name: 'Direct' },
    { value: Math.floor(Math.random() * 1000), name: 'Email' },
    { value: Math.floor(Math.random() * 1000), name: 'Union Ads' },
    { value: Math.floor(Math.random() * 1000), name: 'Video Ads' }
  ];
  option.series[0].data = newData;
  myChart.setOption(option);
}

// Update the chart every five seconds
setInterval(updateChart, 1000);

// Resize chart on window resize
window.addEventListener('resize', function () {
  myChart.resize();
});

// Initial render
if (option && typeof option === 'object') {
  myChart.setOption(option);
}
</script>

</body>
</html>

