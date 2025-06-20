<!-- Profile Hero Section -->
<div class="lg:mt-28 flex items-center justify-center pt-20 pb-8 sm:pt-24 sm:pb-16">
    <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8">
        
        <!-- Main Profile Container -->
        <div class="flex flex-col items-center text-center lg:flex-row lg:items-start lg:text-left lg:space-x-12 xl:space-x-16">
            
            <!-- Left Side - Profile Photo -->
            <div class="flex flex-col items-center lg:items-start flex-shrink-0">
                <div class="relative group mb-8">
                    @if($user->photo)
                        <img src="{{ $user->photo }}"
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
    <div class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-3xl p-6 sm:p-8 w-full max-w-md mx-4 shadow-2xl border border-gray-100">
        <div class="flex items-center justify-between mb-6">
            <h3 class="font-display text-xl sm:text-2xl font-light">Update Profile Photo</h3>
            <button onclick="closePhotoModal()" class="p-2 rounded-lg text-gray-500 hover:text-black hover:bg-gray-50 transition-colors duration-200">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>
        
        <form id="photoUploadForm" enctype="multipart/form-data">
            @csrf
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-3">Choose a new photo</label>
                <input type="file" 
                       id="photoInput" 
                       name="photo" 
                       accept="image/*" 
                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-6 file:rounded-full file:border-0 file:text-sm file:font-medium file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100 transition-colors duration-200 file:cursor-pointer cursor-pointer">
            </div>
            
            <div class="flex gap-3">
                <button type="button" 
                        onclick="closePhotoModal()" 
                        class="flex-1 px-6 py-3 border border-gray-200 text-black font-medium hover:border-black hover:bg-gray-50 transition-all duration-200 rounded-full">
                    Cancel
                </button>
                <button type="submit" 
                        class="flex-1 px-6 py-3 bg-black text-white font-medium hover:bg-gray-800 transition-all duration-200 rounded-full">
                    Upload
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Profile Modal -->
<div id="editModal" class="fixed inset-0 z-50 hidden">
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" onclick="closeEditModal()"></div>
    <div class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-3xl p-6 sm:p-8 w-full max-w-lg mx-4 shadow-2xl border border-gray-100 max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between mb-6">
            <h3 class="font-display text-xl sm:text-2xl font-light">Edit Profile</h3>
            <button onclick="closeEditModal()" class="p-2 rounded-lg text-gray-500 hover:text-black hover:bg-gray-50 transition-colors duration-200">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>
        
        <form id="editProfileForm">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">Full Name</label>
                    <input type="text" 
                           name="name" 
                           value="{{ $user->name }}" 
                           class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-black focus:border-transparent transition-colors duration-200"
                           placeholder="Enter your full name">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">Username</label>
                    <input type="text" 
                           name="username" 
                           value="{{ $user->username }}" 
                           class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-black focus:border-transparent transition-colors duration-200"
                           placeholder="@username">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">Pronouns</label>
                    <select name="pronoun" 
                            class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-black focus:border-transparent transition-colors duration-200">
                        <option value="">Select pronouns</option>
                        <option value="he/him" {{ $user->pronoun == 'he/him' ? 'selected' : '' }}>he/him</option>
                        <option value="she/her" {{ $user->pronoun == 'she/her' ? 'selected' : '' }}>she/her</option>
                        <option value="they/them" {{ $user->pronoun == 'they/them' ? 'selected' : '' }}>they/them</option>
                        <option value="other" {{ $user->pronoun == 'other' ? 'selected' : '' }}>other</option>
                    </select>
                </div>
                
                <!-- Enhanced Bio Field -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">
                        Bio
                        <span class="text-xs text-gray-500 font-normal ml-1">(Tell your professional story)</span>
                    </label>
                    <textarea name="bio" 
                              rows="4" 
                              maxlength="60"
                              class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-black focus:border-transparent transition-colors duration-200 resize-none"
                              placeholder="Share your professional background, interests, or what drives your creativity. This helps others understand your unique perspective and expertise.">{{ $user->bio }}</textarea>
                    <div class="flex justify-between items-center mt-2">
                        <p class="text-xs text-gray-500">
                            Make it engaging and professional
                        </p>
                        <p class="text-xs text-gray-400" id="bioCharCount">
                            <span id="currentCount">{{ strlen($user->bio ?? '') }}</span>/60
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="flex gap-3 mt-8">
                <button type="button" 
                        onclick="closeEditModal()" 
                        class="flex-1 px-6 py-3 border border-gray-200 text-black font-medium hover:border-black hover:bg-gray-50 transition-all duration-200 rounded-full">
                    Cancel
                </button>
                <button type="submit" 
                        class="flex-1 px-6 py-3 bg-black text-white font-medium hover:bg-gray-800 transition-all duration-200 rounded-full">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

