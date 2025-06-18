<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f7f7;
            color: #222;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .container {
            background: #fff;
            padding: 32px 24px;
            border-radius: 10px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.07);
            min-width: 320px;
            max-width: 400px;
        }
        h1 {
            margin-bottom: 24px;
            font-size: 2rem;
            color: #007bff;
            text-align: center;
        }
        ul {
            list-style: none;
            padding: 0;
            margin: 0 0 16px 0;
        }
        li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #eee;
            font-size: 1.08rem;
        }
        li:last-child {
            border-bottom: none;
        }
        .product-name {
            font-weight: 500;
        }
        .product-price {
            color: #28a745;
            font-weight: bold;
        }
        .info {
            color: #888;
            font-size: 0.95rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Products List</h1>
        <ul>
            @foreach($products as $product)
                <li>
                    <span class="product-name">{{ $product->name }}</span>
                    <span class="product-price">${{ number_format($product->price, 2) }}</span>
                </li>
            @endforeach
        </ul>
        <div class="info">This list is cached for 10 minutes.</div>
    </div>
</body>
</html> 