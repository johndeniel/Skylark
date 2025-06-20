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
                // Reset any previous messages
                const messageContainer = document.getElementById('messageContainer');
                if (messageContainer) {
                    messageContainer.classList.add('hidden');
                }
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
                // Reset form and messages
                const editProfileForm = document.getElementById('editProfileForm');
                const messageContainer = document.getElementById('messageContainer');
                if (editProfileForm) {
                    editProfileForm.reset();
                }
                if (messageContainer) {
                    messageContainer.classList.add('hidden');
                }
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
                    if (currentLength > 58) {
                        bioCharCount.classList.add('text-red-500');
                        bioCharCount.classList.remove('text-gray-400');
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

        // Edit profile form functionality - UPDATED WITH REAL AJAX
        const editProfileForm = document.getElementById('editProfileForm');
        if (editProfileForm) {
            editProfileForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const form = this;
                const formData = new FormData(form);
                const saveButton = document.getElementById('saveButton');
                const messageContainer = document.getElementById('messageContainer');
                const messageText = document.getElementById('messageText');
                
                // Validate bio length before submission
                const bio = formData.get('bio');
                if (bio && bio.length > 60) {
                    showMessage('Bio must be 60 characters or less', 'error');
                    return;
                }
                
                // Disable button and show loading
                if (saveButton) {
                    saveButton.disabled = true;
                    saveButton.textContent = 'Saving...';
                }
                
                // Hide any previous messages
                if (messageContainer) {
                    messageContainer.classList.add('hidden');
                }
                
                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show success message
                        showMessage(data.message, 'success');
                        
                        // Update the displayed user data on the page
                        updateProfileDisplay(data.user);
                        
                        // Close modal after a short delay
                        setTimeout(() => {
                            closeEditModal();
                        }, 1500);
                        
                    } else {
                        // Show error message
                        showMessage(data.message || 'An error occurred while updating your profile.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showMessage('An error occurred while updating your profile.', 'error');
                })
                .finally(() => {
                    // Re-enable button
                    if (saveButton) {
                        saveButton.disabled = false;
                        saveButton.textContent = 'Save Changes';
                    }
                });
            });
        }

        // Helper function to show messages
        function showMessage(message, type) {
            const messageContainer = document.getElementById('messageContainer');
            const messageText = document.getElementById('messageText');
            
            if (messageContainer && messageText) {
                messageContainer.classList.remove('hidden');
                
                // Reset classes
                messageText.className = 'p-3 rounded-lg text-sm';
                
                if (type === 'success') {
                    messageText.classList.add('bg-green-100', 'text-green-800', 'border', 'border-green-200');
                } else if (type === 'error') {
                    messageText.classList.add('bg-red-100', 'text-red-800', 'border', 'border-red-200');
                }
                
                messageText.textContent = message;
            }
        }

        // Helper function to update profile display after successful update
        function updateProfileDisplay(userData) {
            // Update name display
            const nameElements = document.querySelectorAll('[data-user-name]');
            nameElements.forEach(element => {
                element.textContent = userData.name;
            });
            
            // Update username display
            const usernameElements = document.querySelectorAll('[data-user-username]');
            usernameElements.forEach(element => {
                element.textContent = '@' + userData.username;
            });
            
            // Update pronoun display
            const pronounElements = document.querySelectorAll('[data-user-pronoun]');
            pronounElements.forEach(element => {
                element.textContent = userData.pronoun;
            });
            
            // Update bio display
            const bioElements = document.querySelectorAll('[data-user-bio]');
            bioElements.forEach(element => {
                element.textContent = userData.bio || 'No bio yet';
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