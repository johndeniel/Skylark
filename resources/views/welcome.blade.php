<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/favicon.ico" />
    <title>Skylark</title>
    
    @vite('resources/css/app.css')
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100;200;300;400;500;600;700;800;900&family=Geist+Mono:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body class="bg-white text-black antialiased font-sans overflow-x-hidden">
    <!-- Mobile Menu Overlay -->
    <div id="mobileMenu" class="fixed inset-0 z-50 hidden">
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" onclick="toggleMobileMenu()"></div>
        <div class="fixed top-0 right-0 h-full w-80 max-w-[85vw] bg-white shadow-xl transform translate-x-full transition-transform duration-300" id="mobileMenuPanel">
            <div class="flex items-center justify-between p-6 border-b border-gray-100">
                <span class="font-display font-medium text-xl">Menu</span>
                <button onclick="toggleMobileMenu()" class="p-2 rounded-lg text-gray-500 hover:text-black hover:bg-gray-50">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
            <nav class="p-6 space-y-6">
                <a href="#" class="block text-lg font-medium text-gray-700 hover:text-black transition-colors duration-200">
                    Explore
                </a>
                <a href="#" class="block text-lg font-medium text-gray-700 hover:text-black transition-colors duration-200">
                    Writers
                </a>
                <a href="#" class="block text-lg font-medium text-gray-700 hover:text-black transition-colors duration-200">
                    Collections
                </a>
                <div class="pt-6 border-t border-gray-100 space-y-4">
                    <a href="{{ route('login') }}" class="block w-full px-6 py-3 text-center border border-gray-200 text-black font-medium hover:border-black hover:bg-gray-50 transition-all duration-200 rounded-full">
                        Sign In
                    </a>
                    <a href="{{ route('register') }}" class="block w-full px-6 py-3 text-center bg-black text-white font-medium hover:bg-gray-800 transition-all duration-200 rounded-full">
                        Start Writing
                    </a>
                </div>
            </nav>
        </div>
    </div>

    <!-- Header -->
    <header class="fixed top-0 left-0 right-0 z-40 bg-white/70 backdrop-blur-xl border-b border-gray-100/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="/" class="text-xl font-medium font-display text-black hover:text-gray-700 transition-colors duration-200 tracking-tight">
                        Skylark
                    </a>
                </div>
                
                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex items-center space-x-8">
                    <a href="#" class="text-sm font-medium text-gray-600 hover:text-black transition-colors duration-200 tracking-wide">
                        Explore
                    </a>
                    <a href="#" class="text-sm font-medium text-gray-600 hover:text-black transition-colors duration-200 tracking-wide">
                        Writers
                    </a>
                    <a href="#" class="text-sm font-medium text-gray-600 hover:text-black transition-colors duration-200 tracking-wide">
                        Collections
                    </a>
                </nav>
                
                <!-- Desktop CTA Buttons -->
                <div class="hidden md:flex items-center space-x-3">
                    <a href="{{ route('login') }}" class="hidden lg:inline-flex text-sm font-medium text-gray-600 hover:text-black transition-colors duration-200 tracking-wide">
                        Sign In
                    </a>
                    <a href="{{ route('register') }}" class="px-4 py-2 bg-black text-white text-sm font-medium hover:bg-gray-800 transition-all duration-200 rounded-full tracking-wide">
                        Start Writing
                    </a>
                </div>
                
                <!-- Mobile menu button -->
                <button onclick="toggleMobileMenu()" class="md:hidden p-2 rounded-lg text-gray-600 hover:text-black hover:bg-gray-50 transition-colors duration-200">
                    <i class="fas fa-bars text-lg"></i>
                </button>
            </div>
        </div>
    </header>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <!-- Hero Section -->
        <div class="min-h-screen flex items-center justify-center pt-20 pb-8 sm:pt-24 sm:pb-16">
            <div class="max-w-6xl mx-auto text-center w-full">
                <div class="mb-6 sm:mb-8">
                    <span class="inline-flex items-center px-3 py-1.5 sm:px-4 sm:py-2 rounded-full text-xs font-medium bg-gray-50 text-gray-700 border border-gray-100 tracking-wider">
                        <i class="fas fa-sparkles mr-2 text-gray-500"></i>
                        <span class="hidden xs:inline">CREATIVE WRITING PLATFORM</span>
                        <span class="xs:hidden">CREATIVE PLATFORM</span>
                    </span>
                </div>
                
                <h1 class="font-display text-3xl xs:text-4xl sm:text-5xl md:text-6xl lg:text-7xl xl:text-8xl font-extralight mb-6 sm:mb-8 leading-tight sm:leading-tight md:leading-tight lg:leading-tight">
                    <span class="block">Open canvas for</span>
                    <span class="block font-light italic text-gray-800 mt-2">
                        creative expression
                    </span>
                </h1>
                
                <p class="text-base xs:text-lg sm:text-xl md:text-2xl text-gray-500 max-w-4xl mx-auto mb-8 sm:mb-12 leading-relaxed font-light px-4 sm:px-0">
                    A sanctuary for quotes, notes, and poems. Where inspiration meets expression, and creativity finds its voice in the digital age.
                </p>
                
                <div class="flex flex-col xs:flex-row gap-3 xs:gap-4 justify-center items-center max-w-sm xs:max-w-md mx-auto px-4 sm:px-0">
                    <a href="{{ route('register') }}" class="w-full xs:w-auto px-6 xs:px-8 py-3 xs:py-4 bg-black text-white font-medium hover:bg-gray-800 transition-all duration-300 rounded-full hover:scale-105 transform text-center group tracking-wide text-sm xs:text-base">
                        <span class="flex items-center justify-center">
                            Start Writing
                            <i class="fas fa-arrow-right ml-2 text-sm group-hover:translate-x-1 transition-transform duration-200"></i>
                        </span>
                    </a>
                    <a href="{{ route('login') }}" class="w-full xs:w-auto px-6 xs:px-8 py-3 xs:py-4 border border-gray-200 text-black font-medium hover:border-black hover:bg-gray-50 transition-all duration-300 rounded-full hover:scale-105 transform text-center tracking-wide text-sm xs:text-base">
                        Sign In
                    </a>
                </div>
            </div>
        </div>

        <!-- Visual Separator -->
        <div class="max-w-6xl mx-auto mb-12 sm:mb-20">
            <div class="relative">
                <div class="h-px bg-gradient-to-r from-transparent via-gray-200 to-transparent"></div>
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white px-4 sm:px-6">
                    <i class="fas fa-feather-alt text-gray-300 text-lg sm:text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Quotes Section -->
        <div class="py-12 sm:py-20">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-12 sm:mb-20">
                    <div class="inline-flex items-center px-3 py-1.5 sm:px-4 sm:py-2 rounded-full text-xs font-medium bg-gray-50 text-gray-700 mb-6 sm:mb-8 border border-gray-100 tracking-widest">
                        <i class="fas fa-quote-left mr-2 text-gray-500"></i>
                        <span class="hidden xs:inline">INSPIRATION GALLERY</span>
                        <span class="xs:hidden">INSPIRATION</span>
                    </div>
                    <h2 class="font-display text-2xl xs:text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-light mb-4 sm:mb-6 leading-tight px-4 sm:px-0">
                        Find your inspiration
                    </h2>
                    <p class="text-gray-500 text-base xs:text-lg sm:text-xl max-w-3xl mx-auto font-light leading-relaxed px-4 sm:px-0">
                        Discover timeless wisdom and contemporary thoughts that spark creativity and ignite the imagination within every writer's soul.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                    <!-- Quote Card 1 -->
                    <div class="group bg-white border border-gray-100 p-6 sm:p-8 rounded-2xl sm:rounded-3xl transition-all duration-500 hover:border-gray-200 hover:shadow-2xl hover:-translate-y-2 relative overflow-hidden mx-2 sm:mx-0">
                        <div class="absolute top-0 right-0 w-20 h-20 sm:w-24 sm:h-24 bg-gradient-to-br from-gray-50/50 to-transparent rounded-bl-2xl sm:rounded-bl-3xl"></div>
                        <div class="relative z-10">
                            <div class="mb-4 sm:mb-6">
                                <i class="fas fa-quote-left text-2xl sm:text-3xl text-gray-200 group-hover:text-gray-300 transition-colors duration-300"></i>
                            </div>
                            <blockquote class="text-gray-800 text-base sm:text-lg lg:text-xl leading-relaxed mb-4 sm:mb-6 font-light italic">
                                "The scariest moment is always just before you start."
                            </blockquote>
                            <cite class="text-gray-500 text-xs sm:text-sm font-medium not-italic tracking-widest uppercase">
                                — Stephen King
                            </cite>
                        </div>
                    </div>

                    <!-- Quote Card 2 -->
                    <div class="group bg-white border border-gray-100 p-6 sm:p-8 rounded-2xl sm:rounded-3xl transition-all duration-500 hover:border-gray-200 hover:shadow-2xl hover:-translate-y-2 relative overflow-hidden mx-2 sm:mx-0">
                        <div class="absolute top-0 right-0 w-20 h-20 sm:w-24 sm:h-24 bg-gradient-to-br from-gray-50/50 to-transparent rounded-bl-2xl sm:rounded-bl-3xl"></div>
                        <div class="relative z-10">
                            <div class="mb-4 sm:mb-6">
                                <i class="fas fa-quote-left text-2xl sm:text-3xl text-gray-200 group-hover:text-gray-300 transition-colors duration-300"></i>
                            </div>
                            <blockquote class="text-gray-800 text-base sm:text-lg lg:text-xl leading-relaxed mb-4 sm:mb-6 font-light italic">
                                "Words have no single fixed meaning, and that is why the art of poetry is possible."
                            </blockquote>
                            <cite class="text-gray-500 text-xs sm:text-sm font-medium not-italic tracking-widest uppercase">
                                — Terry Eagleton
                            </cite>
                        </div>
                    </div>

                    <!-- Quote Card 3 -->
                    <div class="group bg-white border border-gray-100 p-6 sm:p-8 rounded-2xl sm:rounded-3xl transition-all duration-500 hover:border-gray-200 hover:shadow-2xl hover:-translate-y-2 relative overflow-hidden mx-2 sm:mx-0">
                        <div class="absolute top-0 right-0 w-20 h-20 sm:w-24 sm:h-24 bg-gradient-to-br from-gray-50/50 to-transparent rounded-bl-2xl sm:rounded-bl-3xl"></div>
                        <div class="relative z-10">
                            <div class="mb-4 sm:mb-6">
                                <i class="fas fa-quote-left text-2xl sm:text-3xl text-gray-200 group-hover:text-gray-300 transition-colors duration-300"></i>
                            </div>
                            <blockquote class="text-gray-800 text-base sm:text-lg lg:text-xl leading-relaxed mb-4 sm:mb-6 font-light italic">
                                "Fill your paper with the breathings of your heart."
                            </blockquote>
                            <cite class="text-gray-500 text-xs sm:text-sm font-medium not-italic tracking-widest uppercase">
                                — William Wordsworth
                            </cite>
                        </div>
                    </div>

                    <!-- Quote Card 4 -->
                    <div class="group bg-white border border-gray-100 p-6 sm:p-8 rounded-2xl sm:rounded-3xl transition-all duration-500 hover:border-gray-200 hover:shadow-2xl hover:-translate-y-2 relative overflow-hidden mx-2 sm:mx-0">
                        <div class="absolute top-0 right-0 w-20 h-20 sm:w-24 sm:h-24 bg-gradient-to-br from-gray-50/50 to-transparent rounded-bl-2xl sm:rounded-bl-3xl"></div>
                        <div class="relative z-10">
                            <div class="mb-4 sm:mb-6">
                                <i class="fas fa-quote-left text-2xl sm:text-3xl text-gray-200 group-hover:text-gray-300 transition-colors duration-300"></i>
                            </div>
                            <blockquote class="text-gray-800 text-base sm:text-lg lg:text-xl leading-relaxed mb-4 sm:mb-6 font-light italic">
                                "A writer is someone for whom writing is more difficult than it is for other people."
                            </blockquote>
                            <cite class="text-gray-500 text-xs sm:text-sm font-medium not-italic tracking-widest uppercase">
                                — Thomas Mann
                            </cite>
                        </div>
                    </div>

                    <!-- Quote Card 5 -->
                    <div class="group bg-white border border-gray-100 p-6 sm:p-8 rounded-2xl sm:rounded-3xl transition-all duration-500 hover:border-gray-200 hover:shadow-2xl hover:-translate-y-2 relative overflow-hidden mx-2 sm:mx-0">
                        <div class="absolute top-0 right-0 w-20 h-20 sm:w-24 sm:h-24 bg-gradient-to-br from-gray-50/50 to-transparent rounded-bl-2xl sm:rounded-bl-3xl"></div>
                        <div class="relative z-10">
                            <div class="mb-4 sm:mb-6">
                                <i class="fas fa-quote-left text-2xl sm:text-3xl text-gray-200 group-hover:text-gray-300 transition-colors duration-300"></i>
                            </div>
                            <blockquote class="text-gray-800 text-base sm:text-lg lg:text-xl leading-relaxed mb-4 sm:mb-6 font-light italic">
                                "Poetry is when an emotion has found its thought and the thought has found words."
                            </blockquote>
                            <cite class="text-gray-500 text-xs sm:text-sm font-medium not-italic tracking-widest uppercase">
                                — Robert Frost
                            </cite>
                        </div>
                    </div>

                    <!-- Quote Card 6 -->
                    <div class="group bg-white border border-gray-100 p-6 sm:p-8 rounded-2xl sm:rounded-3xl transition-all duration-500 hover:border-gray-200 hover:shadow-2xl hover:-translate-y-2 relative overflow-hidden mx-2 sm:mx-0">
                        <div class="absolute top-0 right-0 w-20 h-20 sm:w-24 sm:h-24 bg-gradient-to-br from-gray-50/50 to-transparent rounded-bl-2xl sm:rounded-bl-3xl"></div>
                        <div class="relative z-10">
                            <div class="mb-4 sm:mb-6">
                                <i class="fas fa-quote-left text-2xl sm:text-3xl text-gray-200 group-hover:text-gray-300 transition-colors duration-300"></i>
                            </div>
                            <blockquote class="text-gray-800 text-base sm:text-lg lg:text-xl leading-relaxed mb-4 sm:mb-6 font-light italic">
                                "The role of a writer is not to say what we can all say, but what we are unable to say."
                            </blockquote>
                            <cite class="text-gray-500 text-xs sm:text-sm font-medium not-italic tracking-widest uppercase">
                                — Anaïs Nin
                            </cite>
                        </div>
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

    <script>
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobileMenu');
            const mobileMenuPanel = document.getElementById('mobileMenuPanel');
            
            if (mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.remove('hidden');
                setTimeout(() => {
                    mobileMenuPanel.classList.remove('translate-x-full');
                }, 10);
            } else {
                mobileMenuPanel.classList.add('translate-x-full');
                setTimeout(() => {
                    mobileMenu.classList.add('hidden');
                }, 300);
            }
        }

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const mobileMenu = document.getElementById('mobileMenu');
            const mobileMenuPanel = document.getElementById('mobileMenuPanel');
            
            if (!mobileMenu.classList.contains('hidden') && 
                !mobileMenuPanel.contains(event.target) && 
                !event.target.closest('[onclick="toggleMobileMenu()"]')) {
                toggleMobileMenu();
            }
        });
    </script>
</body>
</html>