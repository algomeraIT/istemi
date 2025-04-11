<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comunicazione via Email</title>
</head>
<body>
<p><strong>Task:</strong> {{ $emailRecord->task }}</p>
<p><strong>Assigned To:</strong> {{ $emailRecord->assigned_to }}</p>
<p>{{ $emailRecord->note }}</p>
</body>
</html>