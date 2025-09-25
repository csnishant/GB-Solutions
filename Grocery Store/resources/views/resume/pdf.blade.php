<!DOCTYPE html>
<html>
<head>
    <title>Resume</title>
    <style>
        body { font-family: sans-serif; }
        h1 { border-bottom: 1px solid #ccc; }
    </style>
</head>
<body>
    <h1>{{ $name }}</h1>
    <p>Email: {{ $email }}</p>
    <p>Phone: {{ $phone }}</p>

    <h2>Education</h2>
    <p>{{ $education }}</p>

    <h2>Experience</h2>
    <p>{{ $experience }}</p>

    <h2>Skills</h2>
    <p>{{ $skills }}</p>
</body>
</html>
