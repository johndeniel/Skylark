<!-- Edit Thought Modal -->
<div id="editThoughtModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-2xl p-6 w-full max-w-md mx-4 border border-gray-300">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Edit Thought</h3>
            <button class="close-modal text-gray-600 hover:text-black transition-colors">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <form id="editThoughtForm">
            <textarea id="editThoughtContent" 
                      class="w-full p-4 border border-gray-300 rounded-xl resize-none focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent"
                      rows="4" maxlength="280" placeholder="What's on your mind?"></textarea>
            
            <div class="flex items-center justify-between mt-4">
                <span class="text-sm text-gray-500">
                    <span id="editCharCount">0</span>/280
                </span>
                
                <div class="flex gap-3">
                    <button type="button" class="close-modal px-4 py-2 text-gray-600 hover:text-black transition-colors border border-gray-300 rounded-full">
                        Cancel
                    </button>
                    <button type="submit" id="updateThoughtBtn"
                            class="px-6 py-2 bg-black hover:bg-gray-800 disabled:bg-gray-300 text-white rounded-full text-sm font-medium transition-all duration-200" disabled>
                        Update
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
/**
 * EditThoughtModal - Manages thought editing functionality with dynamic content updates
 * Provides modal controls, form validation, and seamless UI updates
 */
class EditThoughtModal {
    constructor() {
        this.modal = document.getElementById('editThoughtModal');
        this.textarea = document.getElementById('editThoughtContent');
        this.charCount = document.getElementById('editCharCount');
        this.updateBtn = document.getElementById('updateThoughtBtn');
        this.form = document.getElementById('editThoughtForm');
        
        this.init();
    }

    init() {
        this.bindEvents();
    }

    bindEvents() {
        // Modal close handlers
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('close-modal') || e.target.closest('.close-modal')) {
                this.closeModal();
            }
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') this.closeModal();
        });

        // Character counter and validation
        this.textarea?.addEventListener('input', () => {
            const length = this.textarea.value.length;
            this.charCount.textContent = length;
            this.updateBtn.disabled = length === 0 || length > 280;
            this.charCount.classList.toggle('text-red-500', length > 280);
        });

        // Form submission
        this.form?.addEventListener('submit', (e) => {
            e.preventDefault();
            this.handleUpdate();
        });
    }

    closeModal() {
        this.modal?.classList.add('hidden');
    }

    /**
     * Locates thought content element using cascading selector strategy
     * @param {string} thoughtId - The unique thought identifier
     * @returns {Element|null} The content element or null if not found
     */
    findContentElement(thoughtId) {
        const selectors = [
            `[data-thought-id="${thoughtId}"].thought-content`,
            `[data-thought-id="${thoughtId}"] .thought-content`,
            `[data-thought-id="${thoughtId}"] .content`,
            `[data-thought-id="${thoughtId}"] p`
        ];

        for (const selector of selectors) {
            const element = document.querySelector(selector);
            if (element) return element;
        }

        return null;
    }

    async handleUpdate() {
        const thoughtId = this.modal.dataset.thoughtId;
        const content = this.textarea.value.trim();
        
        if (!content || content.length > 280) return;

        this.setLoadingState(true);

        try {
            const response = await fetch(`/thoughts/${thoughtId}`, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ content })
            });

            const data = await response.json();

            if (!response.ok) throw new Error(data.message || 'Update failed');

            this.updateUI(thoughtId, content);
            this.showToast(data.message || 'Thought updated successfully!');
            this.closeModal();

        } catch (error) {
            console.error('Update failed:', error);
            this.showToast('Failed to update thought. Please try again.', 'error');
        } finally {
            this.setLoadingState(false);
        }
    }

    /**
     * Updates the UI elements after successful thought modification
     * @param {string} thoughtId - The thought identifier
     * @param {string} content - The new content
     */
    updateUI(thoughtId, content) {
        const contentElement = this.findContentElement(thoughtId);
        
        if (contentElement) {
            contentElement.textContent = content;
            
            // Update edit button data attribute
            const editBtn = document.querySelector(`[data-thought-id="${thoughtId}"].edit-thought-btn`);
            if (editBtn) editBtn.dataset.thoughtContent = content.replace(/'/g, "\\'");
            
            // Visual feedback animation
            this.animateUpdate(contentElement);
        } else {
            this.showToast('Thought updated! Refreshing...', 'warning');
            setTimeout(() => window.location.reload(), 2000);
        }
    }

    animateUpdate(element) {
        element.style.cssText = 'background-color: #f0f9ff; transition: background-color 0.3s ease;';
        setTimeout(() => {
            element.style.backgroundColor = '';
            setTimeout(() => element.style.transition = '', 300);
        }, 1000);
    }

    setLoadingState(loading) {
        this.updateBtn.disabled = loading;
        this.updateBtn.textContent = loading ? 'Updating...' : 'Update';
    }

    /**
     * Displays toast notification with auto-dismiss
     * @param {string} message - Notification message
     * @param {string} type - Toast type (success, error, warning)
     */
    showToast(message, type = 'success') {
        const colors = {
            success: 'bg-green-500',
            error: 'bg-red-500',
            warning: 'bg-yellow-500'
        };

        const toast = document.createElement('div');
        toast.className = `fixed top-4 right-4 px-6 py-3 rounded-lg text-white font-medium z-50 transform translate-x-full transition-all duration-300 ${colors[type] || colors.success}`;
        toast.textContent = message;

        document.body.appendChild(toast);
        
        // Animate in
        setTimeout(() => toast.style.transform = 'translateX(0)', 10);
        
        // Auto-dismiss
        setTimeout(() => {
            toast.style.transform = 'translateX(100%)';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }
}

// Initialize on DOM ready
document.addEventListener('DOMContentLoaded', () => new EditThoughtModal());
</script>