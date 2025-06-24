<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Skylark</title>

    @vite('resources/css/app.css')

    <!-- External Resources: Icons & Typography -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100;200;300;400;500;600;700;800;900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Crimson+Text:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet" />
</head>
<body class="bg-white text-black antialiased font-sans min-h-screen flex flex-col">

    @include('partials.header')

    <main class="flex-1 flex items-center justify-center px-4 sm:px-6 lg:px-8 pt-16 sm:pt-20 pb-8">
        <div class="w-full max-w-xs sm:max-w-sm">
            <div class="text-center mb-8 sm:mb-10">
                <h1
                    class="text-2xl lg:text-4xl font-bold bg-gradient-to-r from-gray-900 via-black to-gray-900 bg-clip-text text-transparent leading-tight tracking-tight lg:tracking-wide lg:whitespace-nowrap lg:overflow-hidden lg:text-ellipsis"
                    style="font-family: 'Playfair Display', serif;"
                >
                    Continue your writing
                </h1>
                <div class="w-16 h-0.5 bg-gradient-to-r from-transparent via-gray-400 to-transparent mx-auto mt-4"></div>
            </div>

            <div
                class="bg-white border border-gray-100 p-5 sm:p-6 rounded-xl transition-all duration-500 hover:border-gray-200 hover:shadow-lg hover:-translate-y-0.5 relative overflow-hidden"
            >
                <div
                    class="absolute top-0 right-0 w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-br from-gray-50/50 to-transparent rounded-bl-xl"
                ></div>

                <form class="space-y-4 relative z-10" action="{{ route('authenticate') }}" method="POST">
                    @csrf

                    <!-- Username Input -->
                    <div class="space-y-1.5">
                        <label for="username" class="block text-xs font-medium text-gray-700 tracking-wide">Username</label>
                        <div class="relative">
                            <input
                                id="username"
                                name="username"
                                type="text"
                                required
                                autofocus
                                class="w-full px-2 py-2 text-xs sm:px-3 sm:py-2.5 sm:text-sm border border-gray-200 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all duration-300 @error('username') border-red-300 focus:ring-red-500 @enderror"
                                value="{{ old('username') }}"
                                placeholder="Enter username"
                            />
                            <i class="fas fa-user absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                        </div>
                        @error('username')<p class="text-xs text-red-600 font-light">{{ $message }}</p>@enderror
                    </div>

                    <!-- Password Input -->
                    <div class="space-y-1.5">
                        <label for="password" class="block text-xs font-medium text-gray-700 tracking-wide">Password</label>
                        <div class="relative">
                            <input
                                id="password"
                                name="password"
                                type="password"
                                required
                                class="w-full px-2 py-2 text-xs sm:px-3 sm:py-2.5 sm:text-sm border border-gray-200 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all duration-300 @error('password') border-red-300 focus:ring-red-500 @enderror"
                                placeholder="Enter password"
                            />
                            <button
                                type="button"
                                onclick="togglePassword()"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors duration-200 focus:outline-none"
                            >
                                <i id="passwordIcon" class="fas fa-eye-slash text-xs"></i>
                            </button>
                        </div>
                        @error('password')<p class="text-xs text-red-600 font-light">{{ $message }}</p>@enderror
                    </div>

                    <!-- Remember & Forgot -->
                    <div class="flex items-center justify-between pt-2">
                        <label class="flex items-center">
                            <input
                                id="remember"
                                name="remember"
                                type="checkbox"
                                class="h-3.5 w-3.5 text-black focus:ring-black border-gray-300 rounded transition-colors duration-200"
                            />
                            <span class="ml-2 text-xs text-gray-700 font-light">Remember me</span>
                        </label>
                        <a href="#" class="text-xs text-gray-600 hover:text-black transition-colors duration-200 font-light"
                            >Forgot password?</a
                        >
                    </div>

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        class="w-full mt-6 px-3 py-2 text-xs sm:px-4 sm:py-2.5 sm:text-sm bg-black text-white font-medium hover:bg-gray-800 transition-all duration-300 rounded-lg hover:scale-105 transform focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2 group"
                    >
                        <span class="flex items-center justify-center">
                            Sign In
                            <i
                                class="fas fa-arrow-right ml-2 text-xs group-hover:translate-x-1 transition-transform duration-200"
                            ></i>
                        </span>
                    </button>
                </form>
            </div>

            <div class="text-center mt-6 space-y-2">
                <p class="text-gray-500 text-xs font-light">
                    Don't have an account?
                    <a href="{{ route('index.signup') }}" class="font-medium text-black hover:text-gray-600 transition-colors duration-200"
                        >Create one here</a
                    >
                </p>
                <p class="text-xs text-gray-400 font-light">Join thousands of writers sharing their creativity</p>
            </div>
        </div>
    </main>

    <script>
        function togglePassword() {
            const field = document.getElementById("password");
            const icon = document.getElementById("passwordIcon");

            if (field.type === "password") {
                field.type = "text";
                icon.classList.replace("fa-eye-slash", "fa-eye");
            } else {
                field.type = "password";
                icon.classList.replace("fa-eye", "fa-eye-slash");
            }
        }

        document.addEventListener("DOMContentLoaded", function () {
            document.body.style.cssText =
                "opacity:0;transform:translateY(20px);transition:opacity 0.6s ease,transform 0.6s ease";
            setTimeout(() => (document.body.style.cssText += "opacity:1;transform:translateY(0)"), 100);

            setTimeout(() => document.getElementById("username").focus(), 300);
        });

        document.querySelector("form").addEventListener("submit", function (e) {
            const requiredFields = this.querySelectorAll("[required]");
            let isValid = true;

            requiredFields.forEach((field) => {
                if (!field.value.trim()) {
                    field.classList.add("border-red-300");
                    isValid = false;
                } else {
                    field.classList.remove("border-red-300");
                }
            });

            if (!isValid) {
                e.preventDefault();
                const firstInvalid = this.querySelector(".border-red-300");
                if (firstInvalid) {
                    firstInvalid.focus();
                    firstInvalid.scrollIntoView({ behavior: "smooth", block: "center" });
                }
            }
        });
    </script>
</body>
</html>
