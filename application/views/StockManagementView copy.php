<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Stock</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            /* margin: 50px; */
            background-color: #f4f4f4;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        form {
            width: 400px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input[type="text"], input[type="number"], input[type="date"], select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Update Stock</h1>
    <form action="updateStock.php" method="post">
        <label for="update_date">Stock Update Date:</label>
        <input type="date" id="update_date" name="update_date" required>

        <label for="item_code">Item Code:</label>
        <select id="item_code" name="item_code" required>
            <option value="">Select an item...</option>
            <!-- Options will be populated dynamically with item codes -->
            <option value="ITEM001">ITEM001 - Example Item 1</option>
            <option value="ITEM002">ITEM002 - Example Item 2</option>
            <!-- Add more options as needed -->
        </select>

        <label for="balance_stock_quantity">Balance Stock Quantity:</label>
        <input type="number" id="balance_stock_quantity" name="balance_stock_quantity" readonly>

        <label for="current_stock_price">Current Stock Price:</label>
        <input type="text" id="current_stock_price" name="current_stock_price" readonly>

        <label for="new_stock_quantity">New Stock Quantity:</label>
        <input type="number" id="new_stock_quantity" name="new_stock_quantity" min="0" required>

        <label for="new_stock_price">New Stock Price:</label>
        <input type="number" id="new_stock_price" name="new_stock_price" step="0.01" min="0" required>

        <input type="submit" value="Update Stock">
    </form>

    <script>
        // Example of how you might dynamically populate and filter items
        const items = [
            { code: 'ITEM001', name: 'Example Item 1', quantity: 100, price: 50.00 },
            { code: 'ITEM002', name: 'Example Item 2', quantity: 200, price: 30.00 },
            // Add more items here
        ];

        const itemCodeSelect = document.getElementById('item_code');
        const balanceStockQuantityInput = document.getElementById('balance_stock_quantity');
        const currentStockPriceInput = document.getElementById('current_stock_price');

        itemCodeSelect.addEventListener('change', function() {
            const selectedItem = items.find(item => item.code === this.value);

            if (selectedItem) {
                balanceStockQuantityInput.value = selectedItem.quantity;
                currentStockPriceInput.value = selectedItem.price.toFixed(2);
            } else {
                balanceStockQuantityInput.value = '';
                currentStockPriceInput.value = '';
            }
        });
    </script>
</body>
</html>
