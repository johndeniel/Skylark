<!-- Delete Confirmation Modal -->
<div id="deleteThoughtModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-2xl p-6 w-full max-w-sm mx-4 border border-gray-300">
        <div class="text-center">
            <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                <i class="fas fa-trash text-black text-xl"></i>
            </div>
            
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Delete Thought</h3>
            <p class="text-gray-600 mb-6">Are you sure you want to delete this thought? This action cannot be undone.</p>
            
            <div class="flex gap-3">
                <button class="close-modal flex-1 px-4 py-2 text-gray-600 hover:text-black border border-gray-300 rounded-full transition-colors">
                    Cancel
                </button>
                <button id="confirmDeleteBtn" class="flex-1 px-4 py-2 bg-black hover:bg-gray-800 text-white rounded-full transition-colors">
                    Delete
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Delete Thought Modal - Handles confirmation dialog and deletion process
class DeleteThoughtModal {
    constructor() {
        this.modal = document.getElementById('deleteThoughtModal');
        this.confirmBtn = document.getElementById('confirmDeleteBtn');
        this.init();
    }

    init() {
        // Event delegation for modal close buttons
        document.addEventListener('click', (e) => {
            if (e.target.matches('.close-modal') || e.target.closest('.close-modal')) {
                this.close();
            }
        });

        // Delete confirmation handler
        this.confirmBtn?.addEventListener('click', () => this.delete());
        
        // ESC key to close modal
        document.addEventListener('keydown', (e) => e.key === 'Escape' && this.close());
    }

    close() {
        this.modal?.classList.add('hidden');
    }

    async delete() {
        const thoughtId = this.modal.dataset.thoughtId;
        
        // Show loading state
        this.confirmBtn.disabled = true;
        this.confirmBtn.textContent = 'Deleting...';
        
        try {
            const response = await fetch(`/thoughts/${thoughtId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            });
            
            const data = await response.json();
            
            if (!response.ok) throw new Error(data.message || 'Network error');
            
            // Animate thought removal
            const thoughtElement = document.querySelector(`article:has([data-thought-id="${thoughtId}"])`);
            if (thoughtElement) {
                thoughtElement.style.cssText = 'transform: translateX(100%); opacity: 0; transition: all 0.3s ease';
                
                setTimeout(() => {
                    thoughtElement.remove();
                    // Reload if no thoughts remain
                    if (!document.querySelector('.space-y-6 article, .space-y-8 article')) {
                        location.reload();
                    }
                }, 300);
            }
            
            this.showToast(data.message || 'Thought deleted successfully!');
            this.close();
            
        } catch (error) {
            console.error('Delete failed:', error);
            this.showToast('Failed to delete thought. Please try again.', 'error');
        } finally {
            // Reset button state
            this.confirmBtn.disabled = false;
            this.confirmBtn.textContent = 'Delete';
        }
    }

    // Display temporary notification toast
    showToast(message, type = 'success') {
        const toast = document.createElement('div');
        const bgColor = type === 'error' ? 'bg-red-500' : 'bg-green-500';
        
        toast.className = `fixed top-4 right-4 px-6 py-3 rounded-lg text-white font-medium z-50 ${bgColor} transform translate-x-full transition-all duration-300`;
        toast.textContent = message;
        
        document.body.appendChild(toast);
        
        // Slide in animation
        setTimeout(() => toast.style.transform = 'translateX(0)', 10);
        
        // Auto-remove after 3 seconds
        setTimeout(() => {
            toast.style.transform = 'translateX(100%)';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }
}

// Initialize on DOM ready
document.addEventListener('DOMContentLoaded', () => new DeleteThoughtModal());
</script>