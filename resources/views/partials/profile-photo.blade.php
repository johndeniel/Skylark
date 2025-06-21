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
                <button type="submit"
                        class="flex-1 px-3 py-2 bg-black text-white rounded-full text-sm font-display font-light hover:bg-gray-800 transition">
                    Upload
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Modal Control Functions
    const photoModal = document.getElementById('photoModal');
    
    // Open modal and prevent background scroll
    window.openPhotoModal = () => {
        photoModal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    };

    // Close modal and restore scroll
    window.closePhotoModal = () => {
        photoModal.classList.add('hidden');
        document.body.style.overflow = '';
    };

    // Initialize modal functionality
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('photoUploadForm');
        const input = document.getElementById('photoInput');

        // Handle form submission
        form.addEventListener('submit', e => {
            e.preventDefault();
            
            const file = input.files[0];
            
            // File validation
            if (!file) return alert('Please select a photo to upload');
            if (!file.type.startsWith('image/')) return alert('Please select a valid image file');
            if (file.size > 5 * 1024 * 1024) return alert('Image must be less than 5MB');

            // Prepare form data
            const formData = new FormData(form);
            
            // Add CSRF token
            const token = document.querySelector('meta[name="csrf-token"]')?.content || 
                         document.querySelector('input[name="_token"]')?.value;
            if (token) formData.append('_token', token);

            // TODO: Replace with actual upload API call
            alert('Photo uploaded successfully');
            closePhotoModal();
        });

        // Close modal on ESC key
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') closePhotoModal();
        });
    });
</script>