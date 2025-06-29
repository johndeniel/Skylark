<!-- Mobile Menu Overlay -->
<div id="mobileMenu" class="fixed inset-0 z-50 hidden">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" onclick="toggleMobileMenu()"></div>

    <!-- Menu Panel -->
    <div class="fixed top-0 right-0 h-full w-80 max-w-[85vw] bg-white shadow-xl transform translate-x-full transition-transform duration-300" id="mobileMenuPanel">
        <!-- Menu Header -->
        <div class="flex items-center justify-between p-6 border-b border-gray-100">
            <span class="font-display font-medium text-xl">Menu</span>
            <button onclick="toggleMobileMenu()" class="p-2 rounded-lg text-gray-500 hover:text-black hover:bg-gray-50">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>

        <!-- Navigation Links -->
        <nav class="p-6 space-y-6">
            <a href="{{ route('thought') }}" class="block text-lg font-medium {{ request()->routeIs('thought') ? 'text-black' : 'text-gray-700 hover:text-black' }} transition-colors duration-200">
                <i class="fas fa-feather-alt mr-3 text-gray-500"></i>Thought
            </a>
            <a href="{{ route('profile') }}" class="block text-lg font-medium {{ request()->routeIs('profile') ? 'text-black' : 'text-gray-700 hover:text-black' }} transition-colors duration-200">
                <i class="fas fa-user mr-3 text-gray-500"></i>Profile
            </a>
            <a href="{{ route('bookmark') }}" class="block text-lg font-medium {{ request()->routeIs('bookmark') ? 'text-black' : 'text-gray-700 hover:text-black' }} transition-colors duration-200">
                <i class="fas fa-bookmark mr-3 text-gray-500"></i>Bookmark
            </a>

            <!-- Logout Section -->
            <div class="pt-6 border-t border-gray-100">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full px-6 py-3 text-center border border-gray-200 text-black font-medium hover:border-black hover:bg-gray-50 transition-all duration-200 rounded-full">
                        <i class="fas fa-sign-out-alt mr-2"></i>Sign Out
                    </button>
                </form>
            </div>
        </nav>
    </div>
</div>

<!-- Main Header -->
<header class="fixed top-0 left-0 right-0 z-40 bg-white/70 backdrop-blur-xl border-b border-gray-100/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            <!-- Brand Logo -->
            <div class="flex-shrink-0">
                <a href="/" class="text-xl font-medium font-display text-black hover:text-gray-700 transition-colors duration-200 tracking-tight">
                    Skylark
                </a>
            </div>

            <!-- Desktop Navigation Menu -->
            <nav class="hidden lg:flex items-center space-x-8">
                <a href="{{ route('thought') }}" class="text-sm font-medium {{ request()->routeIs('thought') ? 'text-black' : 'text-gray-600 hover:text-black transition-colors duration-200' }} tracking-wide">
                    Thought
                </a>
                <a href="{{ route('profile') }}" class="text-sm font-medium {{ request()->routeIs('profile') ? 'text-black' : 'text-gray-600 hover:text-black transition-colors duration-200' }} tracking-wide">
                    Profile
                </a>
                <a href="{{ route('bookmark') }}" class="text-sm font-medium {{ request()->routeIs('bookmark') ? 'text-black' : 'text-gray-600 hover:text-black transition-colors duration-200' }} tracking-wide">
                    Bookmark
                </a>
            </nav>

            <!-- Desktop User Profile Menu -->
            <div class="hidden md:flex items-center">
                <div class="relative group">
                    <!-- User Profile Button -->
                    <button class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                        <!-- Profile Avatar -->
                        @if(auth()->user()->photo_url)
                            <img class="w-8 h-8 rounded-full object-cover" src="{{ auth()->user()->photo_url }}" alt="Profile">
                        @else
                            <div class="w-8 h-8 rounded-full bg-black flex items-center justify-center">
                                <span class="text-white text-sm font-medium">{{ substr(auth()->user()->name, 0, 1) }}</span>
                            </div>
                        @endif
                        <span class="text-sm font-medium text-gray-700">{{ auth()->user()->name }}</span>
                        <i class="fas fa-chevron-down text-xs text-gray-500"></i>
                    </button>

                    <!-- Dropdown Menu -->
                    <div class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform translate-y-1 group-hover:translate-y-0">
                        <div class="p-2">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center w-full px-3 py-2 text-sm text-red-600 hover:bg-red-50 rounded-lg transition-colors duration-200">
                                    <i class="fas fa-sign-out-alt mr-3"></i>Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu Toggle Button -->
            <button onclick="toggleMobileMenu()" class="md:hidden p-2 rounded-lg text-gray-600 hover:text-black hover:bg-gray-50 transition-colors duration-200">
                <i class="fas fa-bars text-lg"></i>
            </button>
        </div>
    </div>
</header>

<script>
/**
 * Main Navigation and Menu Controller
 * Handles mobile menu toggle, user menu interactions, and click-outside functionality
 */
document.addEventListener('DOMContentLoaded', function () {

    /**
     * Toggle mobile menu visibility with smooth slide animation
     */
    window.toggleMobileMenu = function () {
        const mobileMenu = document.getElementById('mobileMenu');
        const mobileMenuPanel = document.getElementById('mobileMenuPanel');

        if (!mobileMenu || !mobileMenuPanel) return;

        if (mobileMenu.classList.contains('hidden')) {
            // Show menu
            mobileMenu.classList.remove('hidden');
            setTimeout(() => mobileMenuPanel.classList.remove('translate-x-full'), 10);
        } else {
            // Hide menu
            mobileMenuPanel.classList.add('translate-x-full');
            setTimeout(() => mobileMenu.classList.add('hidden'), 300);
        }
    };

    /**
     * Close mobile menu when clicking outside the panel
     */
    document.addEventListener('click', function (event) {
        const mobileMenu = document.getElementById('mobileMenu');
        const mobileMenuPanel = document.getElementById('mobileMenuPanel');

        // Check if mobile menu is open and click is outside
        if (mobileMenu && mobileMenuPanel &&
            !mobileMenu.classList.contains('hidden') &&
            !mobileMenuPanel.contains(event.target) &&
            !event.target.closest('[onclick="toggleMobileMenu()"]')) {
            toggleMobileMenu();
        }
    });

    // Enable smooth scrolling for better UX
    document.documentElement.style.scrollBehavior = 'smooth';
});
</script>
