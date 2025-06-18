<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skylark</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .fade-in {
            animation: fadeIn 0.8s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .hero-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @media (max-width: 768px) {
            .hero-container {
                min-height: 100vh;
                padding-top: 4rem;
                padding-bottom: 2rem;
            }
        }

        .quote-card {
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            border: 1px solid #f1f3f4;
        }
    </style>
</head>
<body class="bg-white text-black antialiased">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <!-- Hero Section -->
        <div class="hero-container">
            <div class="max-w-4xl mx-auto text-center fade-in w-full">
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-light tracking-tight mb-6 sm:mb-8 leading-tight">
                    Open canvas for<br>
                    <span class="font-medium italic">creative expression</span>
                </h1>
                <p class="text-base sm:text-lg md:text-xl text-gray-600 max-w-2xl mx-auto mb-8 sm:mb-12 leading-relaxed px-4">
                    A sanctuary for quotes, notes, and poems. Where inspiration meets expression, and creativity finds its voice.
                </p>
                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center items-center px-4">
                    <a href="{{ route('register') }}" class="w-full sm:w-auto px-6 sm:px-8 py-3 sm:py-4 bg-black text-white font-medium hover:bg-gray-800 transition-colors duration-200 rounded-lg hover-lift text-center">
                        Start Writing
                    </a>
                    <a href="{{ route('login') }}" class="w-full sm:w-auto px-6 sm:px-8 py-3 sm:py-4 border border-gray-300 text-black font-medium hover:border-black transition-colors duration-200 rounded-lg hover-lift text-center">
                        Sign In
                    </a>
                </div>
            </div>
        </div>

        <!-- Visual Separator -->
        <div class="max-w-4xl mx-auto mb-16 sm:mb-20">
            <div class="h-px bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
        </div>

        <!-- Quotes Section -->
        <div class="py-16 sm:py-20">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-12 sm:mb-16">
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-light tracking-tight mb-4">
                        Find your inspiration
                    </h2>
                    <p class="text-gray-600 text-base sm:text-lg max-w-2xl mx-auto px-4">
                        Discover timeless wisdom and contemporary thoughts that spark creativity.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                    <!-- Quote Card 1 -->
                    <div class="quote-card p-6 sm:p-8 rounded-2xl hover-lift group">
                        <div class="mb-4">
                            <i class="fas fa-quote-left text-2xl text-gray-300 group-hover:text-gray-400 transition-colors duration-200"></i>
                        </div>
                        <blockquote class="text-gray-800 text-base sm:text-lg leading-relaxed mb-4 font-light italic">
                            The scariest moment is always just before you start.
                        </blockquote>
                        <cite class="text-gray-600 text-sm font-medium not-italic">— Stephen King</cite>
                    </div>

                    <!-- Quote Card 2 -->
                    <div class="quote-card p-6 sm:p-8 rounded-2xl hover-lift group">
                        <div class="mb-4">
                            <i class="fas fa-quote-left text-2xl text-gray-300 group-hover:text-gray-400 transition-colors duration-200"></i>
                        </div>
                        <blockquote class="text-gray-800 text-base sm:text-lg leading-relaxed mb-4 font-light italic">
                            Words have no single fixed meaning, and that is why the art of poetry is possible.
                        </blockquote>
                        <cite class="text-gray-600 text-sm font-medium not-italic">— Terry Eagleton</cite>
                    </div>

                    <!-- Quote Card 3 -->
                    <div class="quote-card p-6 sm:p-8 rounded-2xl hover-lift group">
                        <div class="mb-4">
                            <i class="fas fa-quote-left text-2xl text-gray-300 group-hover:text-gray-400 transition-colors duration-200"></i>
                        </div>
                        <blockquote class="text-gray-800 text-base sm:text-lg leading-relaxed mb-4 font-light italic">
                            Fill your paper with the breathings of your heart.
                        </blockquote>
                        <cite class="text-gray-600 text-sm font-medium not-italic">— William Wordsworth</cite>
                    </div>

                    <!-- Quote Card 4 -->
                    <div class="quote-card p-6 sm:p-8 rounded-2xl hover-lift group">
                        <div class="mb-4">
                            <i class="fas fa-quote-left text-2xl text-gray-300 group-hover:text-gray-400 transition-colors duration-200"></i>
                        </div>
                        <blockquote class="text-gray-800 text-base sm:text-lg leading-relaxed mb-4 font-light italic">
                            A writer is someone for whom writing is more difficult than it is for other people.
                        </blockquote>
                        <cite class="text-gray-600 text-sm font-medium not-italic">— Thomas Mann</cite>
                    </div>

                    <!-- Quote Card 5 -->
                    <div class="quote-card p-6 sm:p-8 rounded-2xl hover-lift group">
                        <div class="mb-4">
                            <i class="fas fa-quote-left text-2xl text-gray-300 group-hover:text-gray-400 transition-colors duration-200"></i>
                        </div>
                        <blockquote class="text-gray-800 text-base sm:text-lg leading-relaxed mb-4 font-light italic">
                            Poetry is when an emotion has found its thought and the thought has found words.
                        </blockquote>
                        <cite class="text-gray-600 text-sm font-medium not-italic">— Robert Frost</cite>
                    </div>

                    <!-- Quote Card 6 -->
                    <div class="quote-card p-6 sm:p-8 rounded-2xl hover-lift group">
                        <div class="mb-4">
                            <i class="fas fa-quote-left text-2xl text-gray-300 group-hover:text-gray-400 transition-colors duration-200"></i>
                        </div>
                        <blockquote class="text-gray-800 text-base sm:text-lg leading-relaxed mb-4 font-light italic">
                            The role of a writer is not to say what we can all say, but what we are unable to say.
                        </blockquote>
                        <cite class="text-gray-600 text-sm font-medium not-italic">— Anaïs Nin</cite>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="flex items-center justify-between border-t border-gray-200 bg-white p-4 text-sm text-gray-600 md:p-6 lg:p-8">
            <div class="flex-1">
                Follow me on 
                <a href="https://www.instagram.com/johndeniel_" 
                   target="_blank" 
                   rel="noreferrer" 
                   class="font-medium text-black hover:text-gray-600 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2" 
                   aria-label="Follow johndeniel on Instagram">
                    Instagram
                </a>
            </div>
            
            <div>
                <a href="https://github.com/johndeniel" 
                   target="_blank" 
                   rel="noreferrer" 
                   class="inline-flex items-center justify-center rounded-full p-2 text-gray-500 transition-colors duration-200 ease-in-out hover:bg-gray-100 hover:text-black focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2" 
                   aria-label="Visit John Deniel's GitHub profile">
                    <i class="fab fa-github text-lg"></i>
                </a>
            </div>
        </footer>
    </div>
</body>
</html>