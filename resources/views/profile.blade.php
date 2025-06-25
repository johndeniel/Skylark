<!DOCTYPE html>
<html lang="en">

@include('partials.head')

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
