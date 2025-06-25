<!-- Photo Upload Modal -->
<div id="photoModal" class="fixed inset-0 z-50 hidden flex items-center justify-center">
    <!-- Modal Overlay - Click to close -->
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closePhotoModal()"></div>

    <!-- Modal Content Container -->
    <div class="relative bg-white rounded-2xl p-6 sm:p-8 w-full max-w-sm mx-4 shadow-2xl border border-gray-200 max-h-[90vh] overflow-y-auto z-10">
        
        <!-- Header Section -->
        <div class="flex items-center justify-between mb-6 border-b border-gray-200 pb-4">
            <h3 class="font-display text-xl font-light">Update Profile Photo</h3>
            <button onclick="closePhotoModal()" class="text-gray-500 hover:text-black transition">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>

        <!-- Upload Form -->
        <form id="photoUploadForm" enctype="multipart/form-data">
            @csrf
            
            <!-- File Input Section -->
            <div class="mb-6">
                <input type="file" id="photoInput" name="photo" accept="image/*" required
                       class="block w-full text-sm text-gray-700 
                              file:mr-4 file:py-2 file:px-4 
                              file:rounded-full file:border-0 
                              file:text-sm file:font-medium 
                              file:bg-gray-100 file:text-gray-700 
                              hover:file:bg-gray-200 
                              transition cursor-pointer">
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-3 border-t border-gray-200 pt-4">
                <button type="button" onclick="closePhotoModal()"
                        class="flex-1 px-3 py-2 border border-gray-300 text-black rounded-full text-sm font-display font-light hover:border-black hover:bg-gray-100 transition">
                    Cancel
                </button>
                <button type="submit" id="uploadBtn"
                        class="flex-1 px-3 py-2 bg-black text-white rounded-full text-sm font-display font-light hover:bg-gray-800 transition disabled:opacity-50 disabled:cursor-not-allowed">
                    <span class="upload-text">Upload</span>
                    <span class="upload-loading hidden">
                        <i class="fas fa-spinner fa-spin mr-1"></i>Uploading...
                    </span>
                </button>
            </div>
        </form>

        <!-- Error/Success Messages -->
        <div id="uploadMessage" class="mt-4 hidden">
            <div class="p-3 rounded-lg text-sm"></div>
        </div>
    </div>
</div>

<script>
    // Modal Control Functions
    const photoModal = document.getElementById('photoModal');
    
    // Open modal and prevent background scroll
    window.openPhotoModal = () => {
        photoModal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        // Reset form and messages
        document.getElementById('photoUploadForm').reset();
        hideMessage();
    };

    // Close modal and restore scroll
    window.closePhotoModal = () => {
        photoModal.classList.add('hidden');
        document.body.style.overflow = '';
        resetUploadButton();
    };

    // Show message function
    function showMessage(message, type = 'success') {
        const messageEl = document.getElementById('uploadMessage');
        const messageContent = messageEl.querySelector('div');
        
        messageContent.textContent = message;
        messageContent.className = `p-3 rounded-lg text-sm ${
            type === 'success' 
                ? 'bg-green-100 text-green-800 border border-green-200' 
                : 'bg-red-100 text-red-800 border border-red-200'
        }`;
        
        messageEl.classList.remove('hidden');
    }

    // Hide message function
    function hideMessage() {
        document.getElementById('uploadMessage').classList.add('hidden');
    }

    // Reset upload button
    function resetUploadButton() {
        const uploadBtn = document.getElementById('uploadBtn');
        const uploadText = uploadBtn.querySelector('.upload-text');
        const uploadLoading = uploadBtn.querySelector('.upload-loading');
        
        uploadBtn.disabled = false;
        uploadText.classList.remove('hidden');
        uploadLoading.classList.add('hidden');
    }

    // Set loading state
    function setLoadingState() {
        const uploadBtn = document.getElementById('uploadBtn');
        const uploadText = uploadBtn.querySelector('.upload-text');
        const uploadLoading = uploadBtn.querySelector('.upload-loading');
        
        uploadBtn.disabled = true;
        uploadText.classList.add('hidden');
        uploadLoading.classList.remove('hidden');
    }

    // Initialize modal functionality
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('photoUploadForm');
        const input = document.getElementById('photoInput');

        // Handle form submission
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const file = input.files[0];
            
            // File validation
            if (!file) {
                showMessage('Please select a photo to upload', 'error');
                return;
            }
            
            if (!file.type.startsWith('image/')) {
                showMessage('Please select a valid image file', 'error');
                return;
            }
            
            if (file.size > 5 * 1024 * 1024) {
                showMessage('Image must be less than 5MB', 'error');
                return;
            }

            // Show loading state
            setLoadingState();
            hideMessage();

            try {
                // Prepare form data
                const formData = new FormData(form);
                
                // Make API call
                const response = await fetch('{{ route("profile.upload-photo") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    showMessage(data.message, 'success');
                    
                    // Update profile photo in the UI if it exists
                    const profilePhoto = document.querySelector('.profile-photo, [data-profile-photo]');
                    if (profilePhoto) {
                        if (profilePhoto.tagName === 'IMG') {
                            profilePhoto.src = data.photo_url;
                        } else {
                            profilePhoto.style.backgroundImage = `url('${data.photo_url}')`;
                        }
                    }
                    
                    // Refresh the page after a short delay to reflect changes
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                    
                } else {
                    showMessage(data.message || 'Upload failed', 'error');
                }

            } catch (error) {
                console.error('Upload error:', error);
                showMessage('Network error. Please try again.', 'error');
            } finally {
                resetUploadButton();
            }
        });

        // Close modal on ESC key
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') closePhotoModal();
        });
    });
</script>