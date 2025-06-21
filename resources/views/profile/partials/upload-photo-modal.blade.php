<!-- Photo Upload Modal -->
<div id="photoModal" class="fixed inset-0 z-50 hidden flex items-center justify-center">
    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closePhotoModal()"></div>

    <!-- Modal Container -->
    <div class="relative bg-white rounded-2xl p-6 sm:p-8 w-full max-w-sm mx-4 shadow-2xl border border-gray-200 max-h-[90vh] overflow-y-auto z-10">
        <!-- Modal Header -->
        <div class="flex items-center justify-between mb-6 border-b border-gray-200 pb-4">
            <h3 class="font-display text-xl font-light">Update Profile Photo</h3>
            <button onclick="closePhotoModal()" class="text-gray-500 hover:text-black transition">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>

        <!-- Upload Form -->
        <form id="photoUploadForm" enctype="multipart/form-data">
            @csrf

            <!-- File Input -->
            <div class="mb-6">
                <input type="file" id="photoInput" name="photo" accept="image/*"
                       class="block w-full text-sm text-gray-700 
                              file:mr-4 file:py-2 file:px-4 
                              file:rounded-full file:border-0 
                              file:text-sm file:font-medium 
                              file:bg-gray-100 file:text-gray-700 
                              hover:file:bg-gray-200 
                              transition cursor-pointer">
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-row gap-2 sm:gap-3 border-t border-gray-200 pt-4">
                <button type="button" onclick="closePhotoModal()"
                        class="flex-1 px-3 py-2 border border-gray-300 text-black rounded-full text-xs sm:text-sm font-display font-light hover:border-black hover:bg-gray-100 transition">
                    Cancel
                </button>
                <button type="submit"
                        class="flex-1 px-3 py-2 bg-black text-white rounded-full text-xs sm:text-sm font-display font-light hover:bg-gray-800 transition">
                    Upload
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Script -->
<script>
    // Show modal and lock scroll
    window.openPhotoModal = () => {
        const modal = document.getElementById('photoModal');
        if (modal) {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
    };

    // Hide modal and unlock scroll
    window.closePhotoModal = () => {
        const modal = document.getElementById('photoModal');
        if (modal) {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        }
    };

    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('photoUploadForm');

        if (form) {
            form.addEventListener('submit', e => {
                e.preventDefault();

                const input = document.getElementById('photoInput');
                const file = input?.files[0];

                // Validate file
                if (!file) return alert('Select a photo to upload');
                if (!file.type.startsWith('image/')) return alert('Invalid file type');
                if (file.size > 5 * 1024 * 1024) return alert('Image exceeds 5MB');

                const formData = new FormData();
                formData.append('photo', file);

                const token = document.querySelector('meta[name="csrf-token"]') || document.querySelector('input[name="_token"]');
                if (token) formData.append('_token', token.content || token.value);

                // Replace with actual upload logic
                alert('Photo uploaded successfully');
                closePhotoModal();
            });
        }

        // ESC key closes modal
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') closePhotoModal();
        });
    });
</script>
