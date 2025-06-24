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
<body class="flex flex-col min-h-screen">

    <!-- Header -->
    @include('partials.header-private', ['user' => $user])

    <!-- Main Content (flex-grow pushes footer to bottom if content is short) -->
    <main class="flex-grow">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @include('partials.profile-information', ['user' => $user])
    
             <section class="py-8">
               <div class="flex flex-col lg:mb-8 mb-4">
                    <div>
                        <h2 class="font-display text-3xl sm:text-4xl lg:text-5xl font-light lg:mb-2 leading-tight tracking-tight">
                            Creative Wall
                        </h2>
                        <p class="text-gray-500 text-sm sm:text-xl font-light leading-relaxed">
                            Posts I've shared with the Skylark community
                        </p>
                    </div>
                </div>

                <!-- Thoughts List -->
                @include('partials.thought-list', ['thoughts' => $thoughts])
                @include('partials.thought-creation', ['user' => $user])
            </section>
        </div>
    </main>

    <!-- Modals / Editors -->
    @include('partials.profile-photo')
    @include('partials.profile-editor')

    <!-- Footer -->
    @include('partials.footer')

</body>
</html>
