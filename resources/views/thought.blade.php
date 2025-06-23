<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/favicon.ico" />
    <title>Skylark</title>
    
    @vite('resources/css/app.css')
    
    <!-- External Dependencies -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100;200;300;400;500;600;700;800;900&family=Geist+Mono:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body class="flex flex-col min-h-screen">
    
    <!-- Navigation Header -->
    @include('partials.header-private', ['user' => $user])

    <!-- Main Content Container -->
    <main class="flex-grow mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8 pt-16"> 
        <section class="py-8 sm:py-12">
            <!-- Thoughts List -->
            @include('partials.thought-list', ['thoughts' => $thoughts])
            @include('partials.thought-creation', ['user' => $user])
        </section>
    </main>
    
    <!-- Site Footer -->
    @include('partials.footer')
</body>
</html>
