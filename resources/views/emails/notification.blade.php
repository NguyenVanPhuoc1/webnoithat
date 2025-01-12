<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shop Noi That</title>
</head>
<body>
    <h1 class="text-center">{{ $data['title_email'] }}</h1>
    <p class="my-2">{{ htmlspecialchars_decode($data['content_email'], ENT_QUOTES) }}</p>
</body>
</html>