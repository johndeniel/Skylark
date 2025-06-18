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

        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-card {
          
            border: 1.7px solid #f1f3f4;
        }
    </style>
</head>
<body class="bg-white text-black antialiased">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <!-- Auth Section -->
        <div class="auth-container">
            <div class="w-full max-w-md fade-in">
                <!-- Header -->
                <div class="text-center mb-8">
                    <h1 class="text-3xl sm:text-4xl font-light tracking-tight mb-4">
                        Welcome back
                    </h1>
                    <p class="text-gray-600 text-base sm:text-lg">
                        Sign in to continue your creative journey
                    </p>
                </div>

                <!-- Form Card -->
                <div class="form-card p-8 rounded-2xl hover-lift">
                    <form class="space-y-6" action="{{ route('login') }}" method="POST">
                        @csrf
                        
                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-700 mb-2">
                                Username
                            </label>
                            <div class="relative">
                                <input id="username" 
                                       name="username" 
                                       type="text" 
                                       required
                                       class="w-full px-4 py-3 border rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all duration-200 @error('username') border-red-300 @enderror"
                                       value="{{ old('username') }}" 
                                       placeholder="Enter your username">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <i class="fas fa-user text-gray-400"></i>
                                </div>
                            </div>
                            @error('username')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                Password
                            </label>
                            <div class="relative">
                                <input id="password" 
                                       name="password" 
                                       type="password" 
                                       required
                                       class="w-full px-4 py-3 border rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all duration-200 @error('password') border-red-300 @enderror"
                                       placeholder="Enter your password">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                            </div>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center">
                            <input id="remember" 
                                   name="remember" 
                                   type="checkbox"
                                   class="h-4 w-4 text-black focus:ring-black border-gray-300 rounded">
                            <label for="remember" class="ml-2 block text-sm text-gray-700">
                                Remember me
                            </label>
                        </div>

                        <div class="pt-2">
                            <button type="submit"
                                    class="w-full px-6 py-3 bg-black text-white font-medium hover:bg-gray-800 transition-colors duration-200 rounded-lg hover-lift focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2">
                                Sign In
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Footer Link -->
                <div class="text-center mt-8">
                    <p class="text-gray-600 text-sm">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="font-medium text-black hover:text-gray-600 transition-colors duration-200">
                            Create one here
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>