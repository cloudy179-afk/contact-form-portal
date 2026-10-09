<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Message</title>
</head>
<body style="font-family: Arial, sans-serif; color: #27243c; line-height: 1.6;">
    <h1>New contact message</h1>

    <p>
        <strong>Reference number:</strong>
        {{ $contactMessage->reference_number }}
    </p>

    <p>
        <strong>Name:</strong>
        {{ $contactMessage->name }}
    </p>

    <p>
        <strong>Email:</strong>
        {{ $contactMessage->email }}
    </p>

    <p>
        <strong>Subject:</strong>
        {{ $contactMessage->subject }}
    </p>

    <h2>Message</h2>

    <div style="white-space: pre-wrap; overflow-wrap: anywhere;">{{ $contactMessage->message }}</div>
</body>
</html>