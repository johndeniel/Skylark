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

<!-- Photo Upload Modal -->
<div id="photoModal" class="fixed inset-0 z-50 hidden">
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" onclick="closePhotoModal()"></div>
    <div class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-2xl sm:rounded-3xl p-4 sm:p-6 md:p-8 w-full max-w-xs sm:max-w-md mx-3 sm:mx-4 shadow-2xl border border-gray-100 max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between mb-4 sm:mb-6">
            <h3 class="font-display text-lg sm:text-xl md:text-2xl font-light pr-2">Update Profile Photo</h3>
            <button onclick="closePhotoModal()" class="p-2 rounded-lg text-gray-500 hover:text-black hover:bg-gray-50 transition-colors duration-200 flex-shrink-0">
                <i class="fas fa-times text-base sm:text-lg"></i>
            </button>
        </div>
        
        <form id="photoUploadForm" enctype="multipart/form-data">
            @csrf
            <div class="mb-4 sm:mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2 sm:mb-3">Choose a new photo</label>
                <input type="file" 
                       id="photoInput" 
                       name="photo" 
                       accept="image/*" 
                       class="block w-full text-xs sm:text-sm text-gray-500 
                              file:mr-2 sm:file:mr-4 
                              file:py-2 sm:file:py-3 
                              file:px-3 sm:file:px-6 
                              file:rounded-full 
                              file:border-0 
                              file:text-xs sm:file:text-sm 
                              file:font-medium 
                              file:bg-gray-50 
                              file:text-gray-700 
                              hover:file:bg-gray-100 
                              transition-colors duration-200 
                              file:cursor-pointer 
                              cursor-pointer">
                <div class="mt-2 text-xs text-gray-500">
                    Maximum file size: 5MB. Supported formats: JPG, PNG, GIF
                </div>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-2 sm:gap-3">
                <button type="button" 
                        onclick="closePhotoModal()" 
                        class="w-full sm:flex-1 px-4 sm:px-6 py-2.5 sm:py-3 border border-gray-200 text-black font-medium hover:border-black hover:bg-gray-50 transition-all duration-200 rounded-full text-sm sm:text-base order-2 sm:order-1">
                    Cancel
                </button>
                <button type="submit" 
                        class="w-full sm:flex-1 px-4 sm:px-6 py-2.5 sm:py-3 bg-black text-white font-medium hover:bg-gray-800 transition-all duration-200 rounded-full text-sm sm:text-base order-1 sm:order-2">
                    Upload
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Profile Modal -->
<div id="editModal" class="fixed inset-0 z-50 hidden">
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" onclick="closeEditModal()"></div>
    <div class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-2xl sm:rounded-3xl p-4 sm:p-6 md:p-8 w-full max-w-xs sm:max-w-md mx-3 sm:mx-4 shadow-2xl border border-gray-100 max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between mb-4 sm:mb-6">
            <h3 class="font-display text-lg sm:text-xl md:text-2xl font-light pr-2">Edit Profile</h3>
            <button onclick="closeEditModal()" class="p-2 rounded-lg text-gray-500 hover:text-black hover:bg-gray-50 transition-colors duration-200 flex-shrink-0">
                <i class="fas fa-times text-base sm:text-lg"></i>
            </button>
        </div>
        
        <!-- Add error/success message display -->
        <div id="messageContainer" class="hidden mb-4">
            <div id="messageText" class="p-3 rounded-lg text-sm"></div>
        </div>
        
        <form method="POST" action="{{ route('update') }}" id="editProfileForm">
            @csrf
            @method('PUT')
            
            <div class="space-y-4 sm:space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                    <input type="text" 
                           name="name" 
                           value="{{ auth()->user()->name ?? '' }}"
                           class="w-full px-3 sm:px-4 py-2.5 sm:py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent text-sm sm:text-base"
                           required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                    <input type="text" 
                           name="username" 
                           value="{{ auth()->user()->username ?? '' }}"
                           class="w-full px-3 sm:px-4 py-2.5 sm:py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent text-sm sm:text-base"
                           required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pronouns</label>
                    <div class="relative">
                        <select name="pronoun" 
                                class="w-full px-3 sm:px-4 py-2.5 sm:py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent text-sm sm:text-base appearance-none bg-white cursor-pointer"
                                required>
                            <option value="He" {{ (auth()->user()->pronoun ?? '') === 'He' ? 'selected' : '' }}>He</option>
                            <option value="She" {{ (auth()->user()->pronoun ?? '') === 'She' ? 'selected' : '' }}>She</option>
                            <option value="Xe" {{ (auth()->user()->pronoun ?? '') === 'Xe' ? 'selected' : '' }}>Xe</option>
                            <option value="Ze" {{ (auth()->user()->pronoun ?? '') === 'Ze' ? 'selected' : '' }}>Ze</option>
                            <option value="They" {{ (auth()->user()->pronoun ?? '') === 'They' ? 'selected' : '' }}>They</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Bio</label>
                    <textarea name="bio" 
                              rows="3" 
                              maxlength="60"
                              placeholder="Tell us about yourself..."
                              class="w-full px-3 sm:px-4 py-2.5 sm:py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent resize-none text-sm sm:text-base">{{ auth()->user()->bio ?? '' }}</textarea>
                    <div id="bioCharCount" class="flex justify-end mt-1 text-xs text-gray-400">
                        <span id="currentCount">{{ strlen(auth()->user()->bio ?? '') }}</span>/60
                    </div>
                </div>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-2 sm:gap-3 mt-6 sm:mt-8">
                <button type="button" 
                        onclick="closeEditModal()" 
                        class="w-full sm:flex-1 px-4 sm:px-6 py-2.5 sm:py-3 border border-gray-200 text-black font-medium hover:border-black hover:bg-gray-50 transition-all duration-200 rounded-full text-sm sm:text-base order-2 sm:order-1">
                    Cancel
                </button>
                <button type="submit" 
                        id="saveButton"
                        class="w-full sm:flex-1 px-4 sm:px-6 py-2.5 sm:py-3 bg-black text-white font-medium hover:bg-gray-800 transition-all duration-200 rounded-full text-sm sm:text-base order-1 sm:order-2">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
