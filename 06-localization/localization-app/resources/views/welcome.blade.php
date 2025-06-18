<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
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
            text-align: center;
        }
        h1 {
            margin-bottom: 24px;
            font-size: 2rem;
            color: #007bff;
        }
        .lang-switch {
            margin-bottom: 16px;
        }
        .lang-switch a {
            color: #007bff;
            text-decoration: none;
            margin: 0 8px;
            font-weight: bold;
        }
        .lang-switch a:hover {
            text-decoration: underline;
        }
        .info {
            color: #888;
            font-size: 0.95rem;
            margin-top: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>{{ $welcomeMessage }}</h1>
        <div class="lang-switch">
            <a href="?lang=en">English</a> |
            <a href="?lang=uk">Українська</a>
        </div>
        <div class="info">Current language: <b>{{ $lang }}</b></div>
        <div class="info">This message is cached for 5 minutes.</div>
    </div>
</body>
</html>
