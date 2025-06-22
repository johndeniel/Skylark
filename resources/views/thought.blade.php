<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/favicon.ico" />
    <title>Skylark</title>
    
    @vite('resources/css/app.css')
    
    <!-- External Dependencies -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100;200;300;400;500;600;700;800;900&family=Geist+Mono:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body class="bg-white text-black antialiased font-sans overflow-x-hidden">
    
    <!-- Header Section -->
    @include('partials.header-private', ['user' => $user])

    <!-- Main Content Container -->
    <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pt-16">
        
        <!-- Thought Feed Section -->
        <section class="py-8 sm:py-12">
            <!-- Thoughts Feed -->
            <div class="space-y-6 sm:space-y-8">
                @foreach($thoughts as $thought)
                    <!-- Individual Thought Card -->
                    <article class="group bg-white border border-gray-100 rounded-3xl p-6 sm:p-10 transition-all duration-500 hover:border-gray-200 hover:shadow-2xl hover:-translate-y-1">
                        
                        <!-- Author Information -->
                        <header class="flex items-center gap-4 mb-6">
                            <!-- User Avatar -->
                            <div class="w-12 h-12 rounded-full overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center shadow-inner">
                                @if($thought->user->photo_url)
                                    <img src="{{ $thought->user->photo_url }}" 
                                        alt="{{ $thought->user->name }}" 
                                        class="w-full h-full object-cover">
                                @else
                                    <!-- Fallback initials -->
                                    <span class="text-gray-600 text-sm font-semibold tracking-wide font-mono">
                                        {{ strtoupper(substr($thought->user->name, 0, 2)) }}
                                    </span>
                                @endif
                            </div>
                            
                            <!-- User Details -->
                            <div>
                                <h2 class="font-semibold text-gray-900 text-base sm:text-lg tracking-tight">{{ $thought->user->name }}</h2>
                                <time class="text-sm text-gray-500">{{ $thought->time_ago }}</time>
                            </div>
                        </header>

                        <!-- Thought Content -->
                        <blockquote class="text-gray-800 text-lg sm:text-xl leading-relaxed mb-6 font-light italic font-[Geist]">
                            {{ $thought->content }}
                        </blockquote>
                        
                        <!-- Interaction Controls -->
                        <footer class="flex items-center gap-6">
                            <!-- Like Button -->
                            <button class="flex items-center gap-2 text-gray-500 hover:text-red-500 transition-colors duration-200 text-sm font-medium" 
                                    aria-label="Like this thought">
                                <i class="far fa-heart"></i>
                                <span>0</span>
                            </button>
                            
                            <!-- Comment Button -->
                            <button class="flex items-center gap-2 text-gray-500 hover:text-blue-500 transition-colors duration-200 text-sm font-medium"
                                    aria-label="Comment on this thought">
                                <i class="far fa-comment"></i>
                                <span>0</span>
                            </button>
                            
                            <!-- Bookmark Button -->
                            <button class="flex items-center gap-2 text-gray-500 hover:text-green-500 transition-colors duration-200 text-sm font-medium"
                                    aria-label="Bookmark this thought">
                                <i class="far fa-bookmark"></i>
                            </button>
                        </footer>
                    </article>
                @endforeach
            </div>
            
        </section>
    </main>
    
    <!-- Footer Section -->
    @include('partials.footer')
    
</body>
</html>