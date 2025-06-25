<!DOCTYPE html>
<html lang="en">

@include('partials.head')

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
