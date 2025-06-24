<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skylark</title>
    <link rel="icon" href="/favicon.ico" />

    @vite('resources/css/app.css')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100;200;300;400;500;600;700;800;900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Crimson+Text:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
</head>
<body class="bg-white text-black antialiased font-sans min-h-screen flex flex-col">

    @include('partials.header')

    <main class="flex-1 flex items-center justify-center px-4 sm:px-6 lg:px-8 pt-16 sm:pt-20 pb-8">
        <div class="w-full max-w-xs sm:max-w-sm">
            <div class="text-center mb-8 sm:mb-10">
                <h1 class="mt-8 lg:mt-12 text-2xl lg:text-4xl font-bold bg-gradient-to-r from-gray-900 via-black to-gray-900 bg-clip-text text-transparent leading-tight tracking-tight lg:tracking-wide lg:whitespace-nowrap lg:overflow-hidden lg:text-ellipsis"
                    style="font-family: 'Playfair Display', serif;">
                    Begin your writing
                </h1>
                <div class="w-16 h-0.5 bg-gradient-to-r from-transparent via-gray-400 to-transparent mx-auto mt-4"></div>
            </div>

            <div class="bg-white border border-gray-100 p-4 sm:p-6 rounded-xl transition-all duration-500 hover:border-gray-200 hover:shadow-lg hover:-translate-y-0.5 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-br from-gray-50/50 to-transparent rounded-bl-xl"></div>

                <form class="space-y-4 relative z-10" action="{{ route('signup.store') }}" method="POST">
                    @csrf

                    <!-- Full Name -->
                    <div class="space-y-1.5">
                        <label for="name" class="block text-xs font-medium text-gray-700 tracking-wide">Full Name</label>
                        <div class="relative">
                            <input id="name" name="name" type="text" required autofocus
                                class="w-full px-2 sm:px-3 py-2 sm:py-2.5 text-xs sm:text-sm border border-gray-200 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all duration-300 @error('name') border-red-300 focus:ring-red-500 @enderror"
                                value="{{ old('name') }}" placeholder="Enter your full name">
                            <i class="fas fa-user absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                        </div>
                        @error('name')<p class="text-xs text-red-600 font-light">{{ $message }}</p>@enderror
                    </div>

                    <!-- Username -->
                    <div class="space-y-1.5">
                        <label for="username" class="block text-xs font-medium text-gray-700 tracking-wide">Username</label>
                        <div class="relative">
                            <input id="username" name="username" type="text" required
                                class="w-full px-2 sm:px-3 py-2 sm:py-2.5 text-xs sm:text-sm border border-gray-200 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all duration-300 @error('username') border-red-300 focus:ring-red-500 @enderror"
                                value="{{ old('username') }}" placeholder="Choose a unique username">
                            <i class="fas fa-at absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                        </div>
                        @error('username')<p class="text-xs text-red-600 font-light">{{ $message }}</p>@enderror
                    </div>

                    <!-- Password -->
                    <div class="space-y-1.5">
                        <label for="password" class="block text-xs font-medium text-gray-700 tracking-wide">Password</label>
                        <div class="relative">
                            <input id="password" name="password" type="password" required
                                class="w-full px-2 sm:px-3 py-2 sm:py-2.5 text-xs sm:text-sm border border-gray-200 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all duration-300 @error('password') border-red-300 focus:ring-red-500 @enderror"
                                placeholder="Create a strong password">
                            <button type="button" onclick="togglePassword('password', 'passwordIcon')"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors duration-200 focus:outline-none">
                                <i id="passwordIcon" class="fas fa-eye-slash text-xs"></i>
                            </button>
                        </div>
                        @error('password')<p class="text-xs text-red-600 font-light">{{ $message }}</p>@enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="space-y-1.5">
                        <label for="password_confirmation" class="block text-xs font-medium text-gray-700 tracking-wide">Confirm Password</label>
                        <div class="relative">
                            <input id="password_confirmation" name="password_confirmation" type="password" required
                                class="w-full px-2 sm:px-3 py-2 sm:py-2.5 text-xs sm:text-sm border border-gray-200 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all duration-300"
                                placeholder="Confirm your password">
                            <button type="button" onclick="togglePassword('password_confirmation', 'confirmPasswordIcon')"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors duration-200 focus:outline-none">
                                <i id="confirmPasswordIcon" class="fas fa-eye-slash text-xs"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Pronoun -->
                    <div class="space-y-1.5">
                        <label for="pronoun" class="block text-xs font-medium text-gray-700 tracking-wide">Pronoun</label>
                        <div class="relative">
                            <select id="pronoun" name="pronoun" required
                                class="w-full px-2 sm:px-3 py-2 sm:py-2.5 text-xs sm:text-sm border border-gray-200 rounded-lg appearance-none bg-white focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all duration-300 @error('pronoun') border-red-300 focus:ring-red-500 @enderror">
                                <option value="He" {{ old('pronoun') == 'He' ? 'selected' : '' }}>He</option>
                                <option value="She" {{ old('pronoun') == 'She' ? 'selected' : '' }}>She</option>
                                <option value="Xe" {{ old('pronoun') == 'Xe' ? 'selected' : '' }}>Xe</option>
                                <option value="Ze" {{ old('pronoun') == 'Ze' ? 'selected' : '' }}>Ze</option>
                                <option value="They" {{ old('pronoun') == 'They' ? 'selected' : '' }}>They</option>
                            </select>
                            <i class="fas fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs pointer-events-none"></i>
                        </div>
                        @error('pronoun')<p class="text-xs text-red-600 font-light">{{ $message }}</p>@enderror
                    </div>

                    <!-- Terms Checkbox -->
                    <div class="flex items-center justify-between pt-2">
                        <label class="flex items-center">
                            <input id="terms" name="terms" type="checkbox" required class="h-3.5 w-3.5 text-black focus:ring-black border-gray-300 rounded transition-colors duration-200">
                            <span class="ml-2 text-xs text-gray-700 font-light">I agree to the <a href="#" class="font-medium text-black hover:text-gray-600 transition-colors duration-200">Terms</a> and <a href="#" class="font-medium text-black hover:text-gray-600 transition-colors duration-200">Privacy Policy</a></span>
                        </label>
                    </div>

                    <!-- Start Writing Button -->
                    <button type="submit"
                        class="w-full mt-6 px-3 sm:px-4 py-2 sm:py-2.5 bg-black text-white font-medium hover:bg-gray-800 transition-all duration-300 rounded-lg hover:scale-105 transform focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2 text-xs sm:text-sm group">
                        <span class="flex items-center justify-center">
                            Start Writing
                            <i class="fas fa-arrow-right ml-2 text-xs group-hover:translate-x-1 transition-transform duration-200"></i>
                        </span>
                    </button>
                </form>
            </div>

            <div class="text-center mt-6 space-y-2">
                <p class="text-gray-500 text-xs font-light">
                    Already have an account? 
                    <a href="{{ route('index.signin') }}" class="font-medium text-black hover:text-gray-600 transition-colors duration-200">Sign in here</a>
                </p>
                <p class="text-xs text-gray-400 font-light">Join thousands of writers sharing their creativity</p>
            </div>
        </div>
    </main>

    <script>
        function togglePassword(fieldId, iconId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById(iconId);
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            } else {
                field.type = 'password';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.body.style.cssText = 'opacity:0;transform:translateY(20px);transition:opacity 0.6s ease,transform 0.6s ease';
            setTimeout(() => document.body.style.cssText += 'opacity:1;transform:translateY(0)', 100);
            setTimeout(() => document.getElementById('name').focus(), 300);
        });

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
