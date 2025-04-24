<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Favorite Fruits</title>
</head>
<body>
<div class="header-row">
    <h1>Favorite Fruits</h1>
</div>
<ul>
    @foreach ($favorites as $favorite)
        <li>{{ $favorite->fruit->name }}</li>
    @endforeach
</ul>

<div>
    <div class="header-row">
        <h1>Nutrition Totals</h1>
    </div>
    <ul>
        <li>Carbohydrates: {{ $nutritionSum['carbohydrates'] }}</li>
        <li>Protein: {{ $nutritionSum['protein'] }}</li>
        <li>Fat: {{ $nutritionSum['fat'] }}</li>
        <li>Calories: {{ $nutritionSum['calories'] }}</li>
        <li>Sugar: {{ $nutritionSum['sugar'] }}</li>
    </ul>
</div>
</body>
</html>
