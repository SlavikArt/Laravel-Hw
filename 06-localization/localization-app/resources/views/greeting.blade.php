<!DOCTYPE html>
<html>
<head>
    <title>Greeting</title>
</head>
<body>
    <h1>{{ __('messages.greeting') }}</h1>
    
    <div>
        <a href="?lang=en">English</a> | 
        <a href="?lang=uk">Українська</a>
    </div>
    
    <p>Current language: {{ $lang }}</p>
</body>
</html> 