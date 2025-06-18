<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skylark</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen text-gray-900">
    <!-- Navigation Bar -->
    <nav class="bg-white shadow-md py-4">
        <div class="container mx-auto flex justify-between items-center px-4">
            <h1 class="text-2xl font-semibold text-indigo-600">YourApp</h1>
            <div class="flex items-center gap-4">
                @if(auth()->user()->photo_url)
                    <img class="w-9 h-9 rounded-full object-cover" src="{{ auth()->user()->photo_url }}" alt="Profile">
                @else
                    <div class="w-9 h-9 rounded-full bg-indigo-500 flex items-center justify-center">
                        <span class="text-white font-semibold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                    </div>
                @endif
                <span class="text-sm font-medium">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-red-600 hover:underline flex items-center gap-1">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <!-- Welcome Section -->
        <div class="bg-white rounded-2xl shadow p-6 mb-8 flex items-center gap-6">
            @if(auth()->user()->photo_url)
                <img class="h-20 w-20 rounded-full object-cover" src="{{ auth()->user()->photo_url }}" alt="Profile">
            @else
                <div class="h-20 w-20 rounded-full bg-indigo-500 flex items-center justify-center">
                    <span class="text-white text-2xl font-semibold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                </div>
            @endif
            <div>
                <h2 class="text-2xl font-bold">Welcome back, {{ auth()->user()->name }}!</h2>
                <p class="text-gray-500">@{{ auth()->user()->username }} • {{ ucfirst(auth()->user()->sex) }}</p>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-5 rounded-2xl shadow flex items-center gap-4">
                <i class="fas fa-users text-indigo-600 text-2xl"></i>
                <div>
                    <p class="text-sm text-gray-500">Total Users</p>
                    <p class="text-xl font-semibold">1,234</p>
                </div>
            </div>
            <div class="bg-white p-5 rounded-2xl shadow flex items-center gap-4">
                <i class="fas fa-chart-line text-green-600 text-2xl"></i>
                <div>
                    <p class="text-sm text-gray-500">Growth Rate</p>
                    <p class="text-xl font-semibold">+12.5%</p>
                </div>
            </div>
            <div class="bg-white p-5 rounded-2xl shadow flex items-center gap-4">
                <i class="fas fa-clock text-yellow-600 text-2xl"></i>
                <div>
                    <p class="text-sm text-gray-500">Active Sessions</p>
                    <p class="text-xl font-semibold">567</p>
                </div>
            </div>
        </div>

        <!-- Two-Column Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Activity -->
            <div class="bg-white rounded-2xl shadow">
                <div class="px-6 py-4 border-b">
                    <h3 class="text-lg font-semibold">Recent Activity</h3>
                </div>
                <ul class="divide-y">
                    <li class="px-6 py-4 flex gap-4 items-center">
                        <div class="h-10 w-10 bg-blue-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-user-plus text-white text-sm"></i>
                        </div>
                        <div>
                            <p class="font-medium">Account created successfully</p>
                            <p class="text-sm text-gray-500">Just now</p>
                        </div>
                    </li>
                    <li class="px-6 py-4 flex gap-4 items-center">
                        <div class="h-10 w-10 bg-green-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-white text-sm"></i>
                        </div>
                        <div>
                            <p class="font-medium">Profile setup completed</p>
                            <p class="text-sm text-gray-500">2 minutes ago</p>
                        </div>
                    </li>
                    <li class="px-6 py-4 flex gap-4 items-center">
                        <div class="h-10 w-10 bg-yellow-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-bell text-white text-sm"></i>
                        </div>
                        <div>
                            <p class="font-medium">Welcome notification sent</p>
                            <p class="text-sm text-gray-500">5 minutes ago</p>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-2xl shadow">
                <div class="px-6 py-4 border-b">
                    <h3 class="text-lg font-semibold">Quick Actions</h3>
                </div>
                <div class="p-6 grid grid-cols-2 gap-4">
                    <button class="p-4 bg-indigo-50 hover:bg-indigo-100 text-center rounded-xl border border-indigo-200">
                        <i class="fas fa-cog text-indigo-600 text-xl"></i>
                        <p class="text-sm font-medium mt-1">Settings</p>
                    </button>
                    <button class="p-4 bg-green-50 hover:bg-green-100 text-center rounded-xl border border-green-200">
                        <i class="fas fa-plus text-green-600 text-xl"></i>
                        <p class="text-sm font-medium mt-1">Add New</p>
                    </button>
                    <button class="p-4 bg-yellow-50 hover:bg-yellow-100 text-center rounded-xl border border-yellow-200">
                        <i class="fas fa-chart-bar text-yellow-600 text-xl"></i>
                        <p class="text-sm font-medium mt-1">Analytics</p>
                    </button>
                    <button class="p-4 bg-purple-50 hover:bg-purple-100 text-center rounded-xl border border-purple-200">
                        <i class="fas fa-envelope text-purple-600 text-xl"></i>
                        <p class="text-sm font-medium mt-1">Messages</p>
                    </button>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
