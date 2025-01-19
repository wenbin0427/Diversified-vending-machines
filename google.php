<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Sheets API Demo</title>
</head>
<body>
    <div id="data"></div>

    <script>
        // 將您的 API 金鑰替換為您從 Google 開發者控制台獲取的金鑰
        const API_KEY = './client_secret_202851890408-d39odpnsl790933tqqfraatgk0c8qrle.apps.googleusercontent.com.json';
        const SPREADSHEET_ID = '1-SsZQwNMEuT8LWKUSWXuQFLIGsMpCXc0k8x-1npT9jQ';
        const SHEET_NAME = 'Sheet1';

        // 使用 Google Sheets API 獲取資料
        function getData() {
            fetch(`https://sheets.googleapis.com/v4/spreadsheets/${SPREADSHEET_ID}/values/${SHEET_NAME}?key=${API_KEY}`)
                .then(response => response.json())
                .then(data => {
                    const values = data.values;
                    const container = document.getElementById('data');
                    container.innerHTML = '<h2>Google Sheets Data</h2>';
                    values.forEach(row => {
                        const rowElement = document.createElement('p');
                        rowElement.textContent = row.join(' | ');
                        container.appendChild(rowElement);
                    });
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        // 呼叫函式來取得資料
        getData();
    </script>
</body>
</html>
