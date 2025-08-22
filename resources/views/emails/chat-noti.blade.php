<!DOCTYPE html>
<html>
<head>
    <title>{{ $details['subject'] ?? 'Chat Notification' }}</title>
</head>
<body>
    <h2>New Chat Message</h2>
    <p><strong>From:</strong> {{ $details['sender'] }}</p>
    <p><strong>Message:</strong> {{ $details['message'] }}</p>

    <hr>
    <p>Sent by <strong>{{ config('app.name') }}</strong></p>
</body>
</html>
