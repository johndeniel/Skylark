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
    <!-- Mobile Menu Overlay -->
    <div id="mobileMenu" class="fixed inset-0 z-50 hidden">
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" onclick="toggleMobileMenu()"></div>
        <div class="fixed top-0 right-0 h-full w-80 max-w-[85vw] bg-white shadow-xl transform translate-x-full transition-transform duration-300" id="mobileMenuPanel">
            <div class="flex items-center justify-between p-6 border-b border-gray-100">
                <span class="font-display font-medium text-xl">Menu</span>
                <button onclick="toggleMobileMenu()" class="p-2 rounded-lg text-gray-500 hover:text-black hover:bg-gray-50">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
            <nav class="p-6 space-y-6">
                <a href="{{ route('dashboard') }}" class="block text-lg font-medium text-gray-700 hover:text-black transition-colors duration-200">
                    <i class="fas fa-home mr-3 text-gray-500"></i>
                    Dashboard
                </a>
                <a href="{{ route('profile') }}" class="block text-lg font-medium text-gray-700 hover:text-black transition-colors duration-200">
                    <i class="fas fa-user mr-3 text-gray-500"></i>
                    Profile
                </a>
                <a href="#" class="block text-lg font-medium text-gray-700 hover:text-black transition-colors duration-200">
                    <i class="fas fa-plus mr-3 text-gray-500"></i>
                    Create
                </a>
                <div class="pt-6 border-t border-gray-100 space-y-4">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full px-6 py-3 text-center border border-gray-200 text-black font-medium hover:border-black hover:bg-gray-50 transition-all duration-200 rounded-full">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            Sign Out
                        </button>
                    </form>
                </div>
            </nav>
        </div>
    </div>

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
                
                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex items-center space-x-8">
                    <a href="{{ route('dashboard') }}" class="text-sm font-medium text-gray-600 hover:text-black transition-colors duration-200 tracking-wide">
                        Dashboard
                    </a>
                    <a href="{{ route('profile') }}" class="text-sm font-medium text-black tracking-wide">
                        Profile
                    </a>
                </nav>
                
                <!-- Desktop User Menu -->
                <div class="hidden md:flex items-center space-x-3">
                    <div class="relative group">
                        <button class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                            @if(auth()->user()->photo)
                                <img class="w-8 h-8 rounded-full object-cover" src="{{ auth()->user()->photo }}" alt="Profile">
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
                                        <i class="fas fa-sign-out-alt mr-3"></i>
                                        Sign Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Mobile menu button -->
                <button onclick="toggleMobileMenu()" class="md:hidden p-2 rounded-lg text-gray-600 hover:text-black hover:bg-gray-50 transition-colors duration-200">
                    <i class="fas fa-bars text-lg"></i>
                </button>
            </div>
        </div>
    </header>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

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
                    <div class="flex-1 max-w-4xl w-full">
                
                        <!-- Name and Username -->
                        <div class="mb-8 lg:mb-10">
                            <h1 class="font-display text-4xl sm:text-5xl md:text-6xl lg:text-7xl xl:text-8xl font-extralight lg:mb-6 leading-tight">
                                {{ Str::limit($user->name ?? 'User', 15) }}
                            </h1>
                            
                            @if($user->username)
                                <p class="text-xl sm:text-2xl md:text-3xl lg:text-4xl text-gray-500 font-light">
                                   {{ '@' . Str::limit($user->username, 25) }}
                                </p>
                            @endif
                        </div>

                        <!-- Bio Section -->   
                        <div class="mb-8">
                            @if($user->bio)
                                <div class="relative">
                                    <div class="bg-gray-50/50 border border-gray-100 rounded-2xl p-5 md:p-6 lg:p-8 backdrop-blur-sm">
                                        <div class="flex items-center justify-center lg:justify-start mb-4">
                                            <div class="flex items-center space-x-2 text-gray-400">
                                                <div class="w-6 h-px bg-gradient-to-r from-transparent to-gray-300"></div>
                                                <i class="fas fa-quote-left text-xs"></i>
                                                <div class="w-6 h-px bg-gradient-to-l from-transparent to-gray-300"></div>
                                            </div>
                                        </div>
                                        <p class="text-base sm:text-lg md:text-xl text-gray-600 leading-relaxed font-light tracking-wide">
                                            {{ Str::limit($user->bio, 60) }}
                                        </p>
                                        <div class="flex items-center justify-center lg:justify-start mt-4">
                                            <div class="flex items-center space-x-2 text-gray-400">
                                                <div class="w-6 h-px bg-gradient-to-r from-transparent to-gray-300"></div>
                                                <i class="fas fa-quote-right text-xs"></i>
                                                <div class="w-6 h-px bg-gradient-to-l from-transparent to-gray-300"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="bg-gray-50/50 border border-gray-100 rounded-2xl p-5 md:p-6 lg:p-8 backdrop-blur-sm text-center lg:text-left">
                                    <i class="fas fa-pen-fancy text-xl text-gray-300 mb-3"></i>
                                    <p class="text-gray-400 text-sm sm:text-base font-light mb-3">
                                        Add a bio to tell your story
                                    </p>
                                    <button onclick="openEditModal()" class="text-sm text-gray-500 hover:text-black transition-colors duration-200 underline underline-offset-2">
                                        Add Bio
                                    </button>
                                </div>
                            @endif
                        </div>

                        <!-- Action Buttons (Mobile only) -->
                        <div class="flex lg:hidden flex-col gap-4">
                            <button onclick="openEditModal()" class="px-6 py-3 bg-black text-white font-medium hover:bg-gray-800 transition-all duration-300 rounded-full">
                                <span class="flex items-center justify-center">
                                    Edit Profile <i class="fas fa-edit ml-2 text-sm"></i>
                                </span>
                            </button>
                            <a href="{{ route('dashboard') }}" class="px-6 py-3 border border-gray-200 text-black font-medium hover:border-black hover:bg-gray-50 transition-all duration-300 rounded-full text-center">
                                Back to Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Profile Feed -->
        <div class="py-8 sm:py-12">
            <div class="max-w-7xl mx-auto">
                <div class="mb-8 sm:mb-12">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <h2 class="font-display text-2xl xs:text-3xl sm:text-4xl font-light mb-2 leading-tight">
                                Creative Wall
                            </h2>
                            <p class="text-gray-500 text-base xs:text-lg font-light">
                                Posts I’ve shared with the Skylark community
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
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="flex items-center justify-between border-t border-gray-200 bg-white p-4 text-sm text-gray-600 md:p-6 lg:p-8">
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

   <script>
       // Mobile menu functionality
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

       // User menu functionality
       function toggleUserMenu() {
           const userMenu = document.getElementById('userMenu');
           userMenu.classList.toggle('hidden');
       }

       // Photo modal functionality
       function openPhotoModal() {
           document.getElementById('photoModal').classList.remove('hidden');
       }

       function closePhotoModal() {
           document.getElementById('photoModal').classList.add('hidden');
       }

       // Edit modal functionality
       function openEditModal() {
           document.getElementById('editModal').classList.remove('hidden');
       }

       function closeEditModal() {
           document.getElementById('editModal').classList.add('hidden');
       }

       // Bio character counter
       document.addEventListener('DOMContentLoaded', function() {
           const bioTextarea = document.querySelector('textarea[name="bio"]');
           const currentCountSpan = document.getElementById('currentCount');
           
           if (bioTextarea && currentCountSpan) {
               bioTextarea.addEventListener('input', function() {
                   const currentLength = this.value.length;
                   currentCountSpan.textContent = currentLength;
                   
                   // Change color based on character count
                   const bioCharCount = document.getElementById('bioCharCount');
                   if (currentLength > 450) {
                       bioCharCount.classList.add('text-orange-500');
                       bioCharCount.classList.remove('text-gray-400');
                   } else if (currentLength > 480) {
                       bioCharCount.classList.add('text-red-500');
                       bioCharCount.classList.remove('text-orange-500', 'text-gray-400');
                   } else {
                       bioCharCount.classList.remove('text-orange-500', 'text-red-500');
                       bioCharCount.classList.add('text-gray-400');
                   }
               });
           }
       });

       // Photo upload functionality
       document.getElementById('photoUploadForm').addEventListener('submit', function(e) {
           e.preventDefault();
           
           const formData = new FormData();
           const photoInput = document.getElementById('photoInput');
           const file = photoInput.files[0];
           
           if (!file) {
               alert('Please select a photo to upload');
               return;
           }
           
           // Validate file type
           if (!file.type.startsWith('image/')) {
               alert('Please select a valid image file');
               return;
           }
           
           // Validate file size (max 5MB)
           if (file.size > 5 * 1024 * 1024) {
               alert('Please select an image smaller than 5MB');
               return;
           }
           
           formData.append('photo', file);
           formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
           
           // Here you would typically send the form data to your backend
           // For now, we'll just show a placeholder message
           alert('Photo upload functionality would be implemented here');
           closePhotoModal();
       });

       // Edit profile form functionality
       document.getElementById('editProfileForm').addEventListener('submit', function(e) {
           e.preventDefault();
           
           const formData = new FormData(this);
           const bio = formData.get('bio');
           
           // Validate bio length
           if (bio && bio.length > 500) {
               alert('Bio must be 500 characters or less');
               return;
           }
           
           // Here you would typically send the form data to your backend
           // For now, we'll just show a placeholder message
           alert('Profile update functionality would be implemented here');
           closeEditModal();
       });

       // Close dropdowns when clicking outside
       document.addEventListener('click', function(event) {
           const userMenu = document.getElementById('userMenu');
           if (!event.target.closest('[onclick="toggleUserMenu()"]') && !userMenu.classList.contains('hidden')) {
               userMenu.classList.add('hidden');
           }
           
           const mobileMenu = document.getElementById('mobileMenu');
           const mobileMenuPanel = document.getElementById('mobileMenuPanel');
           if (!mobileMenu.classList.contains('hidden') && 
               !mobileMenuPanel.contains(event.target) && 
               !event.target.closest('[onclick="toggleMobileMenu()"]')) {
               toggleMobileMenu();
           }
       });

       // Close modals with Escape key
       document.addEventListener('keydown', function(event) {
           if (event.key === 'Escape') {
               closePhotoModal();
               closeEditModal();
           }
       });

       // Add smooth scroll behavior for better UX
       document.documentElement.style.scrollBehavior = 'smooth';
   </script>
</body>
</html>