<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fruits Dashboard</title>
    @vite('resources/js/app.js')
</head>
<body>
<div id="app" data-fruits='@json($fruits)'></div>
</body>
</html>
