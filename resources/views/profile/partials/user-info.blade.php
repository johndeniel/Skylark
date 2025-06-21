<!-- Profile Hero Section -->
<div class="lg:mt-28 flex items-center justify-center pt-20 pb-8 sm:pt-24 sm:pb-16">
    <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8">
        
        <!-- Main Profile Container -->
        <div class="flex flex-col items-center text-center lg:flex-row lg:items-start lg:text-left lg:space-x-12 xl:space-x-16">
            
            <!-- Left Side - Profile Photo -->
            <div class="flex flex-col items-center lg:items-start flex-shrink-0">
                <div class="relative group mb-8">
                    @if($user->photo_url)
                        <img src="{{ $user->photo_url }}"
                            alt="Profile Photo"
                            class="w-36 h-36 lg:w-56 lg:h-56 object-cover rounded-full shadow-2xl cursor-pointer transition-all duration-500 group-hover:shadow-3xl group-hover:scale-105 border-4 border-white mx-auto lg:mx-0"
                            onclick="openPhotoModal()">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name ?? 'User') }}&size=224&background=f3f4f6&color=374151&font-size=0.4"
                            alt="Profile Avatar"
                            class="w-36 h-36  lg:w-56 lg:h-56 object-cover rounded-full shadow-2xl cursor-pointer transition-all duration-500 group-hover:shadow-3xl group-hover:scale-105 border-4 border-white mx-auto lg:mx-0"
                            onclick="openPhotoModal()">
                    @endif

                    <div class="absolute inset-0 bg-black/40 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center cursor-pointer" onclick="openPhotoModal()">
                        <div class="text-center">
                            <i class="fas fa-camera text-white text-xl mb-1"></i>
                            <p class="text-white text-xs font-medium">Change Photo</p>
                        </div>
                    </div>

                    @if($user->pronoun)
                        <div class="absolute top-full left-1/2 transform translate-x-4 -translate-y-9">
                            <div class="inline-flex items-center px-3 py-1.5 sm:px-4 sm:py-2 rounded-full text-xs sm:text-sm font-medium bg-white text-gray-700 border-2 border-gray-100 shadow-lg backdrop-blur-sm hover:border-gray-200 transition-all duration-300 group-hover:scale-105">
                                <span class="font-semibold tracking-wide">{{ $user->pronoun }}</span>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Action Buttons (Desktop only) -->
                <div class="hidden lg:flex flex-col sm:flex-row gap-4 justify-center lg:justify-start mb-8 lg:mb-0">
                    <button onclick="openEditModal()" class="px-8 py-4 bg-black text-white font-medium hover:bg-gray-800 transition-all duration-300 rounded-full hover:scale-105 transform group tracking-wide">
                        <span class="flex items-center justify-center">
                            Edit Profile
                            <i class="fas fa-edit ml-2 text-sm group-hover:translate-x-1 transition-transform duration-200"></i>
                        </span>
                    </button>
                    <a href="{{ route('dashboard') }}" class="px-8 py-4 border border-gray-200 text-black font-medium hover:border-black hover:bg-gray-50 transition-all duration-300 rounded-full hover:scale-105 transform text-center tracking-wide">
                        Back to Dashboard
                    </a>
                </div>
            </div>

            <!-- Right Side - Profile Information -->
            <div class="w-full">
                <!-- Name and Username -->
                <div class="mb-3 lg:mb-10">
                    <h1 class="font-display text-2xl xl:text-7xl font-extralight lg:mb-2 leading-tight">
                        {{ Str::limit($user->name ?? 'User', 21) }}
                    </h1>
                    
                    @if($user->username)
                        <p class="text-xl sm:text-2xl md:text-3xl lg:text-4xl text-gray-500 font-light">
                           {{ '@' . Str::limit($user->username, 25) }}
                        </p>
                    @endif
                </div>

                <!-- Bio Section -->   
                <div class="mb-4 lg:mb-8">
                    @if($user->bio)
                        <div class="relative">
                            <div class="bg-gray-50/50 border border-gray-100 rounded-lg lg:rounded-2xl p-3 md:p-6 lg:p-8 backdrop-blur-sm">
                                <div class="flex items-center justify-center lg:justify-start mb-2 lg:mb-4">
                                    <div class="flex items-center space-x-1.5 lg:space-x-2 text-gray-400">
                                        <div class="w-3 lg:w-6 h-px bg-gradient-to-r from-transparent to-gray-300"></div>
                                        <i class="fas fa-quote-left text-xs"></i>
                                        <div class="w-3 lg:w-6 h-px bg-gradient-to-l from-transparent to-gray-300"></div>
                                    </div>
                                </div>
                                <p class="text-xs sm:text-sm md:text-lg lg:text-xl text-gray-600 leading-relaxed font-light tracking-wide">
                                    {{ Str::limit($user->bio, 60) }}
                                </p>
                                <div class="flex items-center justify-center lg:justify-start mt-2 lg:mt-4">
                                    <div class="flex items-center space-x-1.5 lg:space-x-2 text-gray-400">
                                        <div class="w-3 lg:w-6 h-px bg-gradient-to-r from-transparent to-gray-300"></div>
                                        <i class="fas fa-quote-right text-xs"></i>
                                        <div class="w-3 lg:w-6 h-px bg-gradient-to-l from-transparent to-gray-300"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="bg-gray-50/50 border border-gray-100 rounded-lg lg:rounded-2xl p-3 md:p-6 lg:p-8 backdrop-blur-sm text-center lg:text-left">
                            <i class="fas fa-pen-fancy text-base lg:text-xl text-gray-300 mb-1.5 lg:mb-3"></i>
                            <p class="text-gray-400 text-xs lg:text-base font-light mb-1.5 lg:mb-3">
                                Add a bio to tell your story
                            </p>
                            <button onclick="openEditModal()" class="text-xs lg:text-sm text-gray-500 hover:text-black transition-colors duration-200 underline underline-offset-2">
                                Add Bio
                            </button>
                        </div>
                    @endif
                </div>

                <!-- Action Buttons (Mobile only) -->
                <div class="flex lg:hidden flex-col gap-2">
                    <button onclick="openEditModal()" class="px-4 py-2 bg-black text-white text-sm font-medium hover:bg-gray-800 transition-all duration-300 rounded-full">
                        <span class="flex items-center justify-center">
                            Edit Profile <i class="fas fa-edit ml-1.5 text-xs"></i>
                        </span>
                    </button>
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 border border-gray-200 text-black text-sm font-medium hover:border-black hover:bg-gray-50 transition-all duration-300 rounded-full text-center">
                        Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
