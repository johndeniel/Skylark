<!DOCTYPE html>
<html lang="en">

@include('partials.head')

<body class="flex flex-col min-h-screen">

    <!-- Header Section -->
    @include('partials.header-private', ['user' => $user])

    <!-- Main Content Container -->
    <main class="flex-grow mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8 pt-16">
        <section class="py-8 sm:py-12">
            @include('partials.thought-list', ['thoughts' => $thoughts])
        </section>
    </main>

    <!-- Footer Section -->
    @include('partials.footer')

</body>
</html>
