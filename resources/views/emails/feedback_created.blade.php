<!DOCTYPE html>
<html>
<head>
    <title>New Feedback Created</title>
</head>
<body>
<h1>New Feedback Created</h1>
<p><strong>Subject:</strong> {{ $feedback->subject }}</p>
<p><strong>Message:</strong> {{ $feedback->message }}</p>
<p><strong>Client Name:</strong> {{ $feedback->user->name }}</p>
<p><strong>Client Email:</strong> {{ $feedback->user->email }}</p>
<p><strong>Attachment Link:</strong> {{ env("APP_URL") . $feedback->attachment }}</p>
</body>
</html>
