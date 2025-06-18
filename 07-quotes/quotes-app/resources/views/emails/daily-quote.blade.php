<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Daily Quote</title>
</head>
<body>
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; font-family: Arial, sans-serif;">
        <h1 style="color: #333; text-align: center;">Your Daily Motivational Quote</h1>
        
        <div style="background-color: #f8f9fa; padding: 30px; border-radius: 10px; margin: 20px 0; text-align: center;">
            <blockquote style="font-size: 18px; font-style: italic; color: #555; margin: 0 0 20px 0;">
                "{{ $quote }}"
            </blockquote>
            <p style="font-weight: bold; color: #333; margin: 0;">— {{ $author }}</p>
        </div>
        
        <p style="text-align: center; color: #666; font-size: 14px;">
            Have a wonderful day!
        </p>
    </div>
</body>
</html> 