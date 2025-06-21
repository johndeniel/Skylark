<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/favicon.ico" />
    <title>Skylark</title>
    
    @vite('resources/css/app.css')
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100;200;300;400;500;600;700;800;900&family=Geist+Mono:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body class="bg-white text-black antialiased font-sans overflow-x-hidden">
    
    @include('profile.partials.header', ['user' => $user])
    
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        @include('profile.partials.user-info', ['user' => $user])
        
        @include('profile.partials.creative-wall', ['user' => $user])

        @include('profile.partials.upload-photo-modal')
        @include('profile.partials.edit-profile')
        
        @include('profile.partials.footer')
    </div>

    @include('profile.partials.scripts')
</body>
</html>