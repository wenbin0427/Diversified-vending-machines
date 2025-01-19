const express = require('express');
const bodyParser = require('body-parser');

const app = express();
const port = 3001;

// 使用body-parser中间件来解析POST请求中的数据
app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());

// 处理POST请求的路由
app.post('/execute', (req, res) => {
    const inputData = req.body.inputData;
    // 在这里进行数据处理，这里只是简单地将数据返回
    const processedData = '你发送的数据是：' + inputData;
    res.send(processedData);
});

// 启动服务器
app.listen(port, () => {
    console.log(`服务器运行在 http://localhost:${port}`);
});
