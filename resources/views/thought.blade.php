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
  
    @include('partials.header-private', ['user' => $user])

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pt-20">
        <!-- Content Feed -->
        <div class="py-8 sm:py-12">
            <div class="max-w-7xl mx-auto">
                <div class="mb-8 sm:mb-12">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <h2 class="font-display text-2xl xs:text-3xl sm:text-4xl font-light mb-2 leading-tight">
                                Creative Feed
                            </h2>
                            <p class="text-gray-500 text-base xs:text-lg font-light">
                                Latest inspiration from the Skylark community
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Feed Items -->
                <div class="space-y-6 sm:space-y-8">
                    <!-- Quote Item -->
                    <article class="group bg-white border border-gray-100 rounded-2xl sm:rounded-3xl p-6 sm:p-8 transition-all duration-500 hover:border-gray-200 hover:shadow-xl hover:-translate-y-1">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                    <span class="text-gray-600 text-sm font-medium">JD</span>
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-900">John Doe</h3>
                                    <p class="text-sm text-gray-500">@johndoe • 2 hours ago</p>
                                </div>
                            </div>
                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                <i class="fas fa-quote-left mr-1"></i>
                                Quote
                            </span>
                        </div>
                        
                        <blockquote class="text-gray-800 text-lg sm:text-xl leading-relaxed mb-4 font-light italic">
                            "The best time to plant a tree was 20 years ago. The second best time is now."
                        </blockquote>
                        
                        <div class="flex items-center justify-between pt-4 border-t border-gray-50">
                            <div class="flex items-center space-x-6">
                                <button class="flex items-center space-x-2 text-gray-500 hover:text-red-500 transition-colors duration-200">
                                    <i class="far fa-heart"></i>
                                    <span class="text-sm">24</span>
                                </button>
                                <button class="flex items-center space-x-2 text-gray-500 hover:text-blue-500 transition-colors duration-200">
                                    <i class="far fa-comment"></i>
                                    <span class="text-sm">8</span>
                                </button>
                                <button class="flex items-center space-x-2 text-gray-500 hover:text-green-500 transition-colors duration-200">
                                    <i class="far fa-bookmark"></i>
                                </button>
                            </div>
                        </div>
                    </article>

                    <!-- Note Item -->
                    <article class="group bg-white border border-gray-100 rounded-2xl sm:rounded-3xl p-6 sm:p-8 transition-all duration-500 hover:border-gray-200 hover:shadow-xl hover:-translate-y-1">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-100 to-purple-200 flex items-center justify-center">
                                    <span class="text-purple-600 text-sm font-medium">AS</span>
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-900">Alice Smith</h3>
                                    <p class="text-sm text-gray-500">@alicesmith • 4 hours ago</p>
                                </div>
                            </div>
                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-green-50 text-green-700 border border-green-100">
                                <i class="fas fa-sticky-note mr-1"></i>
                                Note
                            </span>
                        </div>
                        
                        <div class="text-gray-800 text-base sm:text-lg leading-relaxed mb-4 font-light">
                            <h4 class="font-medium mb-2">Thoughts on minimalism</h4>
                            <p>Sometimes the most powerful statements are made in the spaces between words. The pause, the breath, the moment of silence that follows truth.</p>
                        </div>
                        
                        <div class="flex items-center justify-between pt-4 border-t border-gray-50">
                            <div class="flex items-center space-x-6">
                                <button class="flex items-center space-x-2 text-gray-500 hover:text-red-500 transition-colors duration-200">
                                    <i class="fas fa-heart text-red-500"></i>
                                    <span class="text-sm">42</span>
                                </button>
                                <button class="flex items-center space-x-2 text-gray-500 hover:text-blue-500 transition-colors duration-200">
                                    <i class="far fa-comment"></i>
                                    <span class="text-sm">15</span>
                                </button>
                                <button class="flex items-center space-x-2 text-gray-500 hover:text-green-500 transition-colors duration-200">
                                    <i class="far fa-bookmark"></i>
                                </button>
                            </div>
                        </div>
                    </article>

                    <!-- Poem Item -->
                    <article class="group bg-white border border-gray-100 rounded-2xl sm:rounded-3xl p-6 sm:p-8 transition-all duration-500 hover:border-gray-200 hover:shadow-xl hover:-translate-y-1">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-amber-100 to-amber-200 flex items-center justify-center">
                                    <span class="text-amber-600 text-sm font-medium">MB</span>
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-900">Maya Brown</h3>
                                    <p class="text-sm text-gray-500">@mayabrown • 6 hours ago</p>
                                </div>
                            </div>
                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-purple-50 text-purple-700 border border-purple-100">
                                <i class="fas fa-feather-alt mr-1"></i>
                                Poem
                            </span>
                        </div>
                        
                        <div class="text-gray-800 text-base sm:text-lg leading-relaxed mb-4 font-light">
                            <h4 class="font-medium mb-3">Morning Light</h4>
                            <div class="italic space-y-2">
                                <p>Golden rays through window panes,</p>
                                <p>Dance across the morning dew,</p>
                                <p>Whispering secrets of the dawn,</p>
                                <p>As dreams give way to something new.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between pt-4 border-t border-gray-50">
                            <div class="flex items-center space-x-6">
                                <button class="flex items-center space-x-2 text-gray-500 hover:text-red-500 transition-colors duration-200">
                                    <i class="far fa-heart"></i>
                                    <span class="text-sm">67</span>
                                </button>
                                <button class="flex items-center space-x-2 text-gray-500 hover:text-blue-500 transition-colors duration-200">
                                    <i class="far fa-comment"></i>
                                    <span class="text-sm">23</span>
                                </button>
                                <button class="flex items-center space-x-2 text-gray-500 hover:text-green-500 transition-colors duration-200">
                                    <i class="fas fa-bookmark text-green-500"></i>
                                </button>
                            </div>
                        </div>
                    </article>

                    <!-- Load More -->
                    <div class="text-center pt-8">
                        <button class="px-8 py-4 border border-gray-200 text-black font-medium hover:border-black hover:bg-gray-50 transition-all duration-300 rounded-full hover:scale-105 transform tracking-wide">
                            Load More Stories
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="flex items-center justify-between border-t border-gray-200 bg-white p-4 text-sm text-gray-600 md:p-6 lg:p-8 mt-16">
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

        // Filter functionality
        document.querySelectorAll('.flex.items-center.bg-gray-50 button').forEach(button => {
            button.addEventListener('click', function() {
                // Remove active state from all buttons
                document.querySelectorAll('.flex.items-center.bg-gray-50 button').forEach(btn => {
                    btn.classList.remove('bg-white', 'text-black', 'shadow-sm', 'border-gray-200');
                    btn.classList.add('text-gray-600');
                });
                
                // Add active state to clicked button
                this.classList.add('bg-white', 'text-black', 'shadow-sm', 'border-gray-200', 'border');
                this.classList.remove('text-gray-600');
            });
        });
    </script>
</body>
</html>