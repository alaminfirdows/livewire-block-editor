<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="antialiased">
    <div class="border-2 p-6 my-6 max-w-5xl mx-auto">
        @livewire('patterns.posts')
    </div>
</body>

</html>
