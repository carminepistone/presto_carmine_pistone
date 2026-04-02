<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('style')
    <title>Presto</title>
</head>



<body style="background-image: url('{{ asset('img/home_bg.jpg') }}'); background-size: cover; background-attachment: fixed; background-position: center 65px ">

        
    <x-navbar />

        <main style="min-height:100vh">{{ $slot }}</main>
    

    <x-footer />


</body>
</html>