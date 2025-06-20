<script>
    // Wait for DOM to be fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        
        // Mobile menu functionality
        window.toggleMobileMenu = function() {
            const mobileMenu = document.getElementById('mobileMenu');
            const mobileMenuPanel = document.getElementById('mobileMenuPanel');
            
            if (mobileMenu && mobileMenuPanel) {
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
        };

        // User menu functionality
        window.toggleUserMenu = function() {
            const userMenu = document.getElementById('userMenu');
            if (userMenu) {
                userMenu.classList.toggle('hidden');
            }
        };

        // Photo modal functionality
        window.openPhotoModal = function() {
            const photoModal = document.getElementById('photoModal');
            if (photoModal) {
                photoModal.classList.remove('hidden');
                // Add body scroll lock
                document.body.style.overflow = 'hidden';
            } else {
                console.error('Photo modal not found');
            }
        };

        window.closePhotoModal = function() {
            const photoModal = document.getElementById('photoModal');
            if (photoModal) {
                photoModal.classList.add('hidden');
                // Remove body scroll lock
                document.body.style.overflow = '';
            }
        };

        // Edit modal functionality
        window.openEditModal = function() {
            const editModal = document.getElementById('editModal');
            if (editModal) {
                editModal.classList.remove('hidden');
                // Add body scroll lock
                document.body.style.overflow = 'hidden';
            } else {
                console.error('Edit modal not found');
            }
        };

        window.closeEditModal = function() {
            const editModal = document.getElementById('editModal');
            if (editModal) {
                editModal.classList.add('hidden');
                // Remove body scroll lock
                document.body.style.overflow = '';
            }
        };

        // Bio character counter
        const bioTextarea = document.querySelector('textarea[name="bio"]');
        const currentCountSpan = document.getElementById('currentCount');
        
        if (bioTextarea && currentCountSpan) {
            bioTextarea.addEventListener('input', function() {
                const currentLength = this.value.length;
                currentCountSpan.textContent = currentLength;
                
                // Change color based on character count
                const bioCharCount = document.getElementById('bioCharCount');
                if (bioCharCount) {
                    if (currentLength > 45) {
                        bioCharCount.classList.add('text-orange-500');
                        bioCharCount.classList.remove('text-gray-400');
                    } else if (currentLength > 55) {
                        bioCharCount.classList.add('text-red-500');
                        bioCharCount.classList.remove('text-orange-500', 'text-gray-400');
                    } else {
                        bioCharCount.classList.remove('text-orange-500', 'text-red-500');
                        bioCharCount.classList.add('text-gray-400');
                    }
                }
            });
        }

        // Photo upload functionality
        const photoUploadForm = document.getElementById('photoUploadForm');
        if (photoUploadForm) {
            photoUploadForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData();
                const photoInput = document.getElementById('photoInput');
                const file = photoInput ? photoInput.files[0] : null;
                
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
                
                // Get CSRF token
                const csrfToken = document.querySelector('meta[name="csrf-token"]') || 
                                 document.querySelector('input[name="_token"]');
                if (csrfToken) {
                    formData.append('_token', csrfToken.getAttribute('content') || csrfToken.value);
                }
                
                // Here you would typically send the form data to your backend
                // For now, we'll just show a placeholder message
                alert('Photo upload functionality would be implemented here');
                closePhotoModal();
            });
        }

        // Edit profile form functionality
        const editProfileForm = document.getElementById('editProfileForm');
        if (editProfileForm) {
            editProfileForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                const bio = formData.get('bio');
                
                // Validate bio length
                if (bio && bio.length > 60) {
                    alert('Bio must be 60 characters or less');
                    return;
                }
                
                // Here you would typically send the form data to your backend
                // For now, we'll just show a placeholder message
                alert('Profile update functionality would be implemented here');
                closeEditModal();
            });
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            // Close user menu
            const userMenu = document.getElementById('userMenu');
            if (userMenu && !event.target.closest('[onclick="toggleUserMenu()"]') && !userMenu.classList.contains('hidden')) {
                userMenu.classList.add('hidden');
            }
            
            // Close mobile menu
            const mobileMenu = document.getElementById('mobileMenu');
            const mobileMenuPanel = document.getElementById('mobileMenuPanel');
            if (mobileMenu && mobileMenuPanel && !mobileMenu.classList.contains('hidden') && 
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

        console.log('Profile page scripts loaded successfully');
    });
</script>