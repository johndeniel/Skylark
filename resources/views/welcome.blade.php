<!DOCTYPE html>
<html lang="en">

@include('partials.head')

<body class="bg-white text-black antialiased font-sans overflow-x-hidden">
    <!-- Fixed Header Navigation -->
    <header class="fixed top-0 left-0 right-0 z-40 bg-white/70 backdrop-blur-xl border-b border-gray-100/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Brand Logo -->
                <div class="flex-shrink-0">
                    <a href="/" class="text-xl font-medium font-display text-black hover:text-gray-700 transition-colors duration-200 tracking-tight">
                        Skylark
                    </a>
                </div>
                
                <!-- Authentication Buttons -->
                <div class="flex items-center space-x-3">
                    <a href="{{ route('index.signin') }}" class="hidden sm:inline-flex text-sm font-medium text-gray-600 hover:text-black transition-colors duration-200 tracking-wide">
                        Sign In
                    </a>
                    <a href="{{ route('index.signup') }}" class="px-4 py-2 bg-black text-white text-sm font-medium hover:bg-gray-800 transition-all duration-200 rounded-full tracking-wide">
                        Start Writing
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content Container -->
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <!-- Hero Section -->
        <section class="min-h-screen flex items-center justify-center pt-20 pb-8 sm:pt-24 sm:pb-16">
            <div class="max-w-6xl mx-auto text-center w-full">
                <!-- Platform Badge -->
                <div class="mb-6 sm:mb-8">
                    <span class="inline-flex items-center px-3 py-1.5 sm:px-4 sm:py-2 rounded-full text-xs font-medium bg-gray-50 text-gray-700 border border-gray-100 tracking-wider">
                        <i class="fas fa-sparkles mr-2 text-gray-500"></i>
                        <span class="hidden xs:inline">CREATIVE WRITING PLATFORM</span>
                        <span class="xs:hidden">CREATIVE PLATFORM</span>
                    </span>
                </div>
                
                <!-- Main Headline -->
                <h1 class="font-display text-3xl xs:text-4xl sm:text-5xl md:text-6xl lg:text-7xl xl:text-8xl font-extralight mb-6 sm:mb-8 leading-tight sm:leading-tight md:leading-tight lg:leading-tight">
                    <span class="block">Open canvas for</span>
                    <span class="block font-light italic text-gray-800 mt-2">
                        creative expression
                    </span>
                </h1>
                
                <!-- Subheading -->
                <p class="text-base xs:text-lg sm:text-xl md:text-2xl text-gray-500 max-w-4xl mx-auto mb-8 sm:mb-12 leading-relaxed font-light px-4 sm:px-0">
                    A sanctuary for quotes, notes, and poems. Where inspiration meets expression, and creativity finds its voice in the digital age.
                </p>
                
                <!-- Call-to-Action Buttons -->
                <div class="flex flex-col xs:flex-row gap-3 xs:gap-4 justify-center items-center max-w-sm xs:max-w-md mx-auto px-4 sm:px-0">
                    <a href="{{ route('index.signup') }}" class="w-full xs:w-auto px-6 xs:px-8 py-3 xs:py-4 bg-black text-white font-medium hover:bg-gray-800 transition-all duration-300 rounded-full hover:scale-105 transform text-center group tracking-wide text-sm xs:text-base">
                        <span class="flex items-center justify-center">
                            Start Writing
                            <i class="fas fa-arrow-right ml-2 text-sm group-hover:translate-x-1 transition-transform duration-200"></i>
                        </span>
                    </a>
                    <a href="{{ route('index.signin') }}" class="w-full xs:w-auto px-6 xs:px-8 py-3 xs:py-4 border border-gray-200 text-black font-medium hover:border-black hover:bg-gray-50 transition-all duration-300 rounded-full hover:scale-105 transform text-center tracking-wide text-sm xs:text-base">
                        Sign In
                    </a>
                </div>
            </div>
        </section>

        <!-- Visual Separator with Icon -->
        <div class="max-w-6xl mx-auto mb-12 sm:mb-20">
            <div class="relative">
                <div class="h-px bg-gradient-to-r from-transparent via-gray-200 to-transparent"></div>
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white px-4 sm:px-6">
                    <i class="fas fa-feather-alt text-gray-300 text-lg sm:text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Inspiration Quotes Gallery -->
        <section class="py-12 sm:py-20">
            <div class="max-w-7xl mx-auto">
                <!-- Section Header -->
                <div class="text-center mb-12 sm:mb-20">
                    <div class="inline-flex items-center px-4 py-2 sm:px-5 sm:py-2.5 rounded-full text-xs sm:text-sm font-semibold bg-gray-50 text-gray-700 mb-6 sm:mb-8 border border-gray-200 tracking-widest shadow-sm">
                        <i class="fas fa-quote-left mr-2 text-gray-500 text-xs sm:text-sm"></i>
                        <span class="hidden sm:inline">INSPIRATION GALLERY</span>
                        <span class="sm:hidden">INSPIRATION</span>
                    </div>
                    <h2 class="font-display text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-light mb-4 sm:mb-6 leading-tight text-black">
                        Find your inspiration
                    </h2>
                    <p class="text-gray-600 text-base sm:text-lg lg:text-xl max-w-3xl mx-auto font-light leading-relaxed">
                        Discover timeless wisdom from great minds that spark creativity and ignite the imagination within every writer's soul.
                    </p>
                </div>

                <!-- Quote Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                    <!-- Quote Card 1 - Plato -->
                    <div class="group bg-white border border-gray-200 p-6 sm:p-8 rounded-2xl sm:rounded-3xl transition-all duration-500 hover:border-gray-300 hover:shadow-2xl hover:-translate-y-2 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-20 h-20 sm:w-24 sm:h-24 bg-gradient-to-br from-gray-50 to-transparent rounded-bl-2xl sm:rounded-bl-3xl"></div>
                        <div class="relative z-10">
                            <div class="mb-4 sm:mb-6">
                                <i class="fas fa-quote-left text-2xl sm:text-3xl text-gray-300 group-hover:text-gray-400 transition-colors duration-300"></i>
                            </div>
                            <blockquote class="text-gray-800 text-base sm:text-lg lg:text-xl leading-relaxed mb-4 sm:mb-6 font-light">
                                "The beginning is the most important part of the work."
                            </blockquote>
                            <cite class="text-gray-500 text-sm font-semibold not-italic tracking-wider uppercase">
                                — Plato
                            </cite>
                        </div>
                    </div>

                    <!-- Quote Card 2 - Einstein -->
                    <div class="group bg-white border border-gray-200 p-6 sm:p-8 rounded-2xl sm:rounded-3xl transition-all duration-500 hover:border-gray-300 hover:shadow-2xl hover:-translate-y-2 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-20 h-20 sm:w-24 sm:h-24 bg-gradient-to-br from-gray-50 to-transparent rounded-bl-2xl sm:rounded-bl-3xl"></div>
                        <div class="relative z-10">
                            <div class="mb-4 sm:mb-6">
                                <i class="fas fa-quote-left text-2xl sm:text-3xl text-gray-300 group-hover:text-gray-400 transition-colors duration-300"></i>
                            </div>
                            <blockquote class="text-gray-800 text-base sm:text-lg lg:text-xl leading-relaxed mb-4 sm:mb-6 font-light">
                                "Imagination is more important than knowledge."
                            </blockquote>
                            <cite class="text-gray-500 text-sm font-semibold not-italic tracking-wider uppercase">
                                — Albert Einstein
                            </cite>
                        </div>
                    </div>

                    <!-- Quote Card 3 - Aristotle -->
                    <div class="group bg-white border border-gray-200 p-6 sm:p-8 rounded-2xl sm:rounded-3xl transition-all duration-500 hover:border-gray-300 hover:shadow-2xl hover:-translate-y-2 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-20 h-20 sm:w-24 sm:h-24 bg-gradient-to-br from-gray-50 to-transparent rounded-bl-2xl sm:rounded-bl-3xl"></div>
                        <div class="relative z-10">
                            <div class="mb-4 sm:mb-6">
                                <i class="fas fa-quote-left text-2xl sm:text-3xl text-gray-300 group-hover:text-gray-400 transition-colors duration-300"></i>
                            </div>
                            <blockquote class="text-gray-800 text-base sm:text-lg lg:text-xl leading-relaxed mb-4 sm:mb-6 font-light">
                                "Well begun is half done."
                            </blockquote>
                            <cite class="text-gray-500 text-sm font-semibold not-italic tracking-wider uppercase">
                                — Aristotle
                            </cite>
                        </div>
                    </div>

                    <!-- Quote Card 4 - Socrates -->
                    <div class="group bg-white border border-gray-200 p-6 sm:p-8 rounded-2xl sm:rounded-3xl transition-all duration-500 hover:border-gray-300 hover:shadow-2xl hover:-translate-y-2 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-20 h-20 sm:w-24 sm:h-24 bg-gradient-to-br from-gray-50 to-transparent rounded-bl-2xl sm:rounded-bl-3xl"></div>
                        <div class="relative z-10">
                            <div class="mb-4 sm:mb-6">
                                <i class="fas fa-quote-left text-2xl sm:text-3xl text-gray-300 group-hover:text-gray-400 transition-colors duration-300"></i>
                            </div>
                            <blockquote class="text-gray-800 text-base sm:text-lg lg:text-xl leading-relaxed mb-4 sm:mb-6 font-light">
                                "The only true wisdom is in knowing you know nothing."
                            </blockquote>
                            <cite class="text-gray-500 text-sm font-semibold not-italic tracking-wider uppercase">
                                — Socrates
                            </cite>
                        </div>
                    </div>

                    <!-- Quote Card 5 - Leonardo da Vinci -->
                    <div class="group bg-white border border-gray-200 p-6 sm:p-8 rounded-2xl sm:rounded-3xl transition-all duration-500 hover:border-gray-300 hover:shadow-2xl hover:-translate-y-2 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-20 h-20 sm:w-24 sm:h-24 bg-gradient-to-br from-gray-50 to-transparent rounded-bl-2xl sm:rounded-bl-3xl"></div>
                        <div class="relative z-10">
                            <div class="mb-4 sm:mb-6">
                                <i class="fas fa-quote-left text-2xl sm:text-3xl text-gray-300 group-hover:text-gray-400 transition-colors duration-300"></i>
                            </div>
                            <blockquote class="text-gray-800 text-base sm:text-lg lg:text-xl leading-relaxed mb-4 sm:mb-6 font-light">
                                "Simplicity is the ultimate sophistication."
                            </blockquote>
                            <cite class="text-gray-500 text-sm font-semibold not-italic tracking-wider uppercase">
                                — Leonardo da Vinci
                            </cite>
                        </div>
                    </div>

                    <!-- Quote Card 6 - Marcus Aurelius -->
                    <div class="group bg-white border border-gray-200 p-6 sm:p-8 rounded-2xl sm:rounded-3xl transition-all duration-500 hover:border-gray-300 hover:shadow-2xl hover:-translate-y-2 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-20 h-20 sm:w-24 sm:h-24 bg-gradient-to-br from-gray-50 to-transparent rounded-bl-2xl sm:rounded-bl-3xl"></div>
                        <div class="relative z-10">
                            <div class="mb-4 sm:mb-6">
                                <i class="fas fa-quote-left text-2xl sm:text-3xl text-gray-300 group-hover:text-gray-400 transition-colors duration-300"></i>
                            </div>
                            <blockquote class="text-gray-800 text-base sm:text-lg lg:text-xl leading-relaxed mb-4 sm:mb-6 font-light">
                                "Very little is needed to make a happy life; it is all within yourself, in your way of thinking."
                            </blockquote>
                            <cite class="text-gray-500 text-sm font-semibold not-italic tracking-wider uppercase">
                                — Marcus Aurelius
                            </cite>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer Section -->
        @include('partials.footer')
    </div>
</body>
</html>