<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/favicon.ico" />
    <title>Create Account - Skylark</title>
    
    @vite('resources/css/app.css')
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100;200;300;400;500;600;700;800;900&family=Geist+Mono:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body class="bg-white text-black antialiased font-sans overflow-x-hidden">
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
                
                <!-- Back to Home Link -->
                <div class="flex items-center">
                    <a href="/" class="text-sm font-medium text-gray-600 hover:text-black transition-colors duration-200 tracking-wide flex items-center">
                        <i class="fas fa-arrow-left mr-2 text-xs"></i>
                        Back to Home
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <!-- Auth Section -->
        <div class="flex items-center justify-center pt-20 pb-8 min-h-screen">
            <div class="w-full max-w-sm">
                <!-- Header Section -->
                <div class="text-center mb-4 sm:mb-6">
                    <p class="text-gray-500 text-sm max-w-xs mx-auto font-light leading-relaxed">
                        Join our sanctuary of words and let your creativity flourish.
                    </p>
                </div>

                <!-- Form Card -->
                <div class="bg-white border border-gray-100 p-5 sm:p-6 rounded-xl transition-all duration-500 hover:border-gray-200 hover:shadow-lg hover:-translate-y-0.5 relative overflow-hidden">
                    <!-- Decorative Element -->
                    <div class="absolute top-0 right-0 w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-br from-gray-50/50 to-transparent rounded-bl-xl"></div>
                    
                    <div class="relative z-10">
                        <form class="space-y-3 sm:space-y-4" action="{{ route('register') }}" method="POST">
                            @csrf
                            
                            <!-- Full Name -->
                            <div>
                                <label for="name" class="block text-xs font-medium text-gray-700 mb-1.5 tracking-wide">
                                    Full Name
                                </label>
                                <div class="relative">
                                    <input id="name" 
                                           name="name" 
                                           type="text" 
                                           required
                                           autofocus
                                           class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all duration-300 font-light @error('name') border-red-300 focus:ring-red-500 @enderror"
                                           value="{{ old('name') }}" 
                                           placeholder="Enter your full name">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                        <i class="fas fa-user text-gray-400 text-xs"></i>
                                    </div>
                                </div>
                                @error('name')
                                    <p class="mt-1 text-xs text-red-600 font-light">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Username -->
                            <div>
                                <label for="username" class="block text-xs font-medium text-gray-700 mb-1.5 tracking-wide">
                                    Username
                                </label>
                                <div class="relative">
                                    <input id="username" 
                                           name="username" 
                                           type="text" 
                                           required
                                           class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all duration-300 font-light @error('username') border-red-300 focus:ring-red-500 @enderror"
                                           value="{{ old('username') }}" 
                                           placeholder="Choose a unique username">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                        <i class="fas fa-at text-gray-400 text-xs"></i>
                                    </div>
                                </div>
                                @error('username')
                                    <p class="mt-1 text-xs text-red-600 font-light">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div>
                                <label for="password" class="block text-xs font-medium text-gray-700 mb-1.5 tracking-wide">
                                    Password
                                </label>
                                <div class="relative">
                                    <input id="password" 
                                           name="password" 
                                           type="password" 
                                           required
                                           class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all duration-300 font-light @error('password') border-red-300 focus:ring-red-500 @enderror"
                                           placeholder="Create a strong password">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                        <button type="button" 
                                                onclick="togglePassword('password', 'passwordIcon')"
                                                class="text-gray-400 hover:text-gray-600 transition-colors duration-200 focus:outline-none">
                                            <i id="passwordIcon" class="fas fa-eye-slash text-xs"></i>
                                        </button>
                                    </div>
                                </div>
                                @error('password')
                                    <p class="mt-1 text-xs text-red-600 font-light">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <label for="password_confirmation" class="block text-xs font-medium text-gray-700 mb-1.5 tracking-wide">
                                    Confirm Password
                                </label>
                                <div class="relative">
                                    <input id="password_confirmation" 
                                           name="password_confirmation" 
                                           type="password" 
                                           required
                                           class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all duration-300 font-light"
                                           placeholder="Confirm your password">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                        <button type="button" 
                                                onclick="togglePassword('password_confirmation', 'confirmPasswordIcon')"
                                                class="text-gray-400 hover:text-gray-600 transition-colors duration-200 focus:outline-none">
                                            <i id="confirmPasswordIcon" class="fas fa-eye-slash text-xs"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Pronoun -->
                            <div>
                                <label for="pronoun" class="block text-xs font-medium text-gray-700 mb-1.5 tracking-wide">
                                    Pronoun
                                </label>
                                <div class="relative">
                                    <select id="pronoun" 
                                            name="pronoun" 
                                            required
                                            class="w-full px-3 py-2.5 text-sm border border-gray-200 rounded-lg appearance-none bg-white focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all duration-300 font-light @error('pronoun') border-red-300 focus:ring-red-500 @enderror">
                                        <option value="He" {{ old('pronoun') == 'He' ? 'selected' : '' }}>He</option>
                                        <option value="She" {{ old('pronoun') == 'She' ? 'selected' : '' }}>She</option>
                                        <option value="Xe" {{ old('pronoun') == 'Xe' ? 'selected' : '' }}>Xe</option>
                                        <option value="Ze" {{ old('pronoun') == 'Ze' ? 'selected' : '' }}>Ze</option>
                                        <option value="They" {{ old('pronoun') == 'They' ? 'selected' : '' }}>They</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                                    </div>
                                </div>
                                @error('pronoun')
                                    <p class="mt-1 text-xs text-red-600 font-light">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Terms Agreement -->
                            <div class="flex items-start space-x-2 pt-1">
                                <input id="terms" 
                                       name="terms" 
                                       type="checkbox"
                                       required
                                       class="mt-0.5 h-3.5 w-3.5 text-black focus:ring-black border-gray-300 rounded transition-colors duration-200">
                                <label for="terms" class="block text-xs text-gray-700 font-light leading-relaxed">
                                    I agree to the 
                                    <a href="#" class="font-medium text-black hover:text-gray-600 transition-colors duration-200">Terms of Service</a> 
                                    and 
                                    <a href="#" class="font-medium text-black hover:text-gray-600 transition-colors duration-200">Privacy Policy</a>
                                </label>
                            </div>

                            <!-- Submit Button -->
                            <div class="pt-2">
                                <button type="submit"
                                        class="w-full px-4 py-2.5 bg-black text-white font-medium hover:bg-gray-800 transition-all duration-300 rounded-lg hover:scale-105 transform focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2 text-sm group">
                                    <span class="flex items-center justify-center">
                                        Start Writing
                                        <i class="fas fa-arrow-right ml-2 text-xs group-hover:translate-x-1 transition-transform duration-200"></i>
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Visual Separator -->
                <div class="my-4 sm:my-6">
                    <div class="relative">
                        <div class="h-px bg-gradient-to-r from-transparent via-gray-200 to-transparent"></div>
                        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white px-3">
                            <i class="fas fa-pen-nib text-gray-300 text-sm sm:text-base"></i>
                        </div>
                    </div>
                </div>

                <!-- Footer Links -->
                <div class="text-center space-y-2">
                    <p class="text-gray-500 text-xs font-light">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="font-medium text-black hover:text-gray-600 transition-colors duration-200">
                            Sign in here
                        </a>
                    </p>
                    
                    <div class="text-xs text-gray-400 font-light">
                        Join thousands of writers sharing their creativity
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="flex items-center justify-between border-t border-gray-200 bg-white p-4 text-sm text-gray-600 md:p-6">
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
        function togglePassword(fieldId, iconId) {
            const passwordField = document.getElementById(fieldId);
            const passwordIcon = document.getElementById(iconId);
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            } else {
                passwordField.type = 'password';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            }
        }

        // Real-time password confirmation validation
        document.getElementById('password_confirmation').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmPassword = this.value;
            
            if (confirmPassword.length > 0) {
                if (password === confirmPassword) {
                    this.classList.remove('border-red-300');
                    this.classList.add('border-green-300');
                } else {
                    this.classList.remove('border-green-300');
                    this.classList.add('border-red-300');
                }
            } else {
                this.classList.remove('border-red-300', 'border-green-300');
            }
        });

        // Username availability check simulation
        let usernameTimeout;
        document.getElementById('username').addEventListener('input', function() {
            clearTimeout(usernameTimeout);
            const username = this.value;
            
            if (username.length >= 3) {
                usernameTimeout = setTimeout(() => {
                    // Simulate API call - you can replace this with actual validation
                    console.log('Checking username availability:', username);
                }, 500);
            }
        });

        // Add smooth fade-in animation
        document.addEventListener('DOMContentLoaded', function() {
            document.body.style.opacity = '0';
            document.body.style.transform = 'translateY(20px)';
            document.body.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            
            setTimeout(() => {
                document.body.style.opacity = '1';
                document.body.style.transform = 'translateY(0)';
            }, 100);
        });

        // Auto-focus name field after page load
        window.addEventListener('load', function() {
            setTimeout(() => {
                document.getElementById('name').focus();
            }, 300);
        });

        // Form validation feedback
        document.querySelector('form').addEventListener('submit', function(e) {
            const requiredFields = this.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('border-red-300');
                    isValid = false;
                } else {
                    field.classList.remove('border-red-300');
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                // Scroll to first invalid field
                const firstInvalid = this.querySelector('.border-red-300');
                if (firstInvalid) {
                    firstInvalid.focus();
                    firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        });
    </script>
</body>
</html>