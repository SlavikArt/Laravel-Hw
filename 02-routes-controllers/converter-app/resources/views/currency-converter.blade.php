<!DOCTYPE html>
<html>
<head>
    <title>Currency Converter</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .container { max-width: 500px; margin: 0 auto; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        button { background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #0056b3; }
        .result { margin-top: 20px; padding: 15px; background: #f8f9fa; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Currency Converter</h1>
        
        <form id="converterForm">
            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="number" id="amount" name="amount" step="0.01" required>
            </div>
            
            <div class="form-group">
                <label for="from">From Currency:</label>
                <select id="from" name="from" required>
                    <option value="USD">USD</option>
                    <option value="EUR">EUR</option>
                    <option value="GBP">GBP</option>
                    <option value="JPY">JPY</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="to">To Currency:</label>
                <select id="to" name="to" required>
                    <option value="EUR">EUR</option>
                    <option value="USD">USD</option>
                    <option value="GBP">GBP</option>
                    <option value="JPY">JPY</option>
                </select>
            </div>
            
            <button type="submit">Convert</button>
        </form>
        
        <div id="result" class="result" style="display: none;"></div>
    </div>

    <script>
        document.getElementById('converterForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = {
                amount: parseFloat(document.getElementById('amount').value),
                from: document.getElementById('from').value,
                to: document.getElementById('to').value
            };
            
            try {
                const response = await fetch('/api/convert', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(formData)
                });
                
                const data = await response.json();
                
                const resultDiv = document.getElementById('result');
                if (response.ok) {
                    resultDiv.innerHTML = `<strong>Result:</strong> ${formData.amount} ${formData.from} = ${data.converted_amount} ${formData.to}`;
                } else {
                    resultDiv.innerHTML = `<strong>Error:</strong> ${data.error || 'Unknown error occurred'}`;
                }
                resultDiv.style.display = 'block';
            } catch (error) {
                console.error('Error:', error);
                document.getElementById('result').innerHTML = `<strong>Error:</strong> ${error.message}`;
                document.getElementById('result').style.display = 'block';
            }
        });
    </script>
</body>
</html> 