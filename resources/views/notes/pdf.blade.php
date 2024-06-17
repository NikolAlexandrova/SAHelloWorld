<!DOCTYPE html>
<html lang="">
<head>
    <title>Note</title>
    <style>
        body {
            font-family: 'Arial, sans-serif';
        }
        .note-content {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<h2>Note</h2>
<p>Date: {{ $note->created_at }}</p>
<div class="note-content">
    {{ $note->content }}
</div>
</body>
</html>
