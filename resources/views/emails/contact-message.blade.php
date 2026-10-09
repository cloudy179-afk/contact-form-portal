<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New contact message</title>
</head>
<body>
    <h1>New contact message</h1>

    <p><strong>Reference:</strong> #{{ $contactMessage->id }}</p>
    <p><strong>Name:</strong> {{ $contactMessage->name }}</p>
    <p><strong>Email:</strong> {{ $contactMessage->email }}</p>
    <p><strong>Subject:</strong> {{ $contactMessage->subject }}</p>

    <h2>Message</h2>

    <div style="white-space: pre-wrap;">{{ $contactMessage->message }}</div>
</body>
</html>
