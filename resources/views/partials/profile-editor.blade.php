<!-- Edit Profile Modal -->
<div id="editModal" class="fixed inset-0 z-50 hidden">
    <!-- Modal Overlay -->
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" onclick="closeEditModal()"></div>
    
    <!-- Modal Content -->
    <div class="fixed inset-0 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl w-full max-w-md shadow-2xl border border-gray-100 max-h-[90vh] overflow-y-auto">
            
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-6 border-b border-gray-100">
                <h3 class="text-xl font-light">Edit Profile</h3>
                <button onclick="closeEditModal()" class="p-2 rounded-lg text-gray-500 hover:text-black hover:bg-gray-50 transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <!-- Status Message Container -->
            <div id="messageContainer" class="hidden px-6 pt-4">
                <div id="messageText" class="p-3 rounded-lg text-sm"></div>
            </div>
            
            <!-- Profile Form -->
            <form method="POST" action="{{ route('profile.update') }}" id="editProfileForm" class="p-6">
                @csrf
                @method('PUT')
                
                <div class="space-y-4">
                    <!-- Name Input -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                        <input type="text" name="name" value="{{ auth()->user()->name ?? '' }}" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent" required>
                    </div>
                    
                    <!-- Username Input -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">@</span>
                            <input type="text" name="username" value="{{ auth()->user()->username ?? '' }}" 
                                   class="w-full pl-8 pr-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent" required>
                        </div>
                    </div>
                    
                    <!-- Pronouns Selection -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pronouns</label>
                        <div class="relative">
                            <select name="pronoun" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent appearance-none bg-white cursor-pointer" required>
                                <option value="He" {{ (auth()->user()->pronoun ?? '') === 'He' ? 'selected' : '' }}>He</option>
                                <option value="She" {{ (auth()->user()->pronoun ?? '') === 'She' ? 'selected' : '' }}>She</option>
                                <option value="Xe" {{ (auth()->user()->pronoun ?? '') === 'Xe' ? 'selected' : '' }}>Xe</option>
                                <option value="Ze" {{ (auth()->user()->pronoun ?? '') === 'Ze' ? 'selected' : '' }}>Ze</option>
                                <option value="They" {{ (auth()->user()->pronoun ?? '') === 'They' ? 'selected' : '' }}>They</option>
                            </select>
                            <i class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm pointer-events-none"></i>
                        </div>
                    </div>
                    
                    <!-- Bio Textarea with Character Counter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Bio</label>
                        <textarea name="bio" rows="3" maxlength="60" placeholder="Tell us about yourself..." 
                                  class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent resize-none">{{ auth()->user()->bio ?? '' }}</textarea>
                        <div class="flex justify-end mt-1">
                            <span id="bioCharCount" class="text-xs text-gray-400">
                                <span id="currentCount">{{ strlen(auth()->user()->bio ?? '') }}</span>/60
                            </span>
                        </div>
                    </div>
                </div>
                
                <!-- Form Actions -->
                <div class="flex gap-2 sm:gap-3 mt-6">
                    <button type="button" onclick="closeEditModal()" 
                            class="flex-1 px-4 py-2 sm:px-6 sm:py-3 text-sm sm:text-base border border-gray-200 text-black font-medium hover:border-black hover:bg-gray-50 transition-colors rounded-full">
                        Cancel
                    </button>
                    <button type="submit" id="saveButton"
                            class="flex-1 px-4 py-2 sm:px-6 sm:py-3 text-sm sm:text-base bg-black text-white font-medium hover:bg-gray-800 transition-colors rounded-full">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
class ProfileModal {
    constructor() {
        // Initialize DOM element references
        this.modal = document.getElementById('editModal');
        this.form = document.getElementById('editProfileForm');
        this.bioTextarea = document.querySelector('textarea[name="bio"]');
        this.charCounter = document.getElementById('currentCount');
        this.charCountDisplay = document.getElementById('bioCharCount');
        this.messageContainer = document.getElementById('messageContainer');
        this.messageText = document.getElementById('messageText');
        this.saveButton = document.getElementById('saveButton');
        
        this.init();
    }

    init() {
        this.attachEventListeners();
        this.setupGlobalMethods();
    }

    // Attach all event listeners
    attachEventListeners() {
        // Bio character counter
        this.bioTextarea?.addEventListener('input', () => this.updateCharCounter());
        
        // Form submission handler
        this.form?.addEventListener('submit', (e) => this.handleFormSubmit(e));
        
        // Keyboard shortcuts
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') this.close();
        });
    }

    // Setup global methods for onclick handlers
    setupGlobalMethods() {
        window.openEditModal = () => this.open();
        window.closeEditModal = () => this.close();
    }

    // Modal visibility controls
    open() {
        this.modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        this.hideMessage();
    }

    close() {
        this.modal.classList.add('hidden');
        document.body.style.overflow = '';
        this.hideMessage();
    }

    // Bio character counter functionality
    updateCharCounter() {
        const length = this.bioTextarea.value.length;
        this.charCounter.textContent = length;
        
        // Visual feedback when approaching character limit
        this.charCountDisplay.className = length > 55 
            ? 'text-xs text-gray-600' 
            : 'text-xs text-gray-400';
    }

    // Handle form submission with AJAX
    async handleFormSubmit(e) {
        e.preventDefault();
        
        this.setLoadingState(true);
        
        try {
            const response = await fetch(this.form.action, {
                method: 'POST',
                body: new FormData(this.form),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            });
            
            const data = await response.json();
            
            if (data.success) {
                this.showMessage(data.message, 'success');
                this.updateProfileDisplay(data.user);
            } else {
                this.showMessage(data.message || 'Update failed', 'error');
            }
        } catch (error) {
            this.showMessage('An error occurred', 'error');
        } finally {
            this.setLoadingState(false);
        }
    }

    // Button loading state management
    setLoadingState(isLoading) {
        this.saveButton.disabled = isLoading;
        this.saveButton.textContent = isLoading ? 'Saving...' : 'Save Changes';
    }

    // Message display system
    showMessage(message, type) {
        if (!this.messageContainer || !this.messageText) return;
        
        this.messageContainer.classList.remove('hidden');
        this.messageText.className = `p-3 rounded-lg text-sm ${
            type === 'success' 
                ? 'bg-gray-100 text-black border border-gray-200' 
                : 'bg-gray-900 text-white'
        }`;
        this.messageText.textContent = message;
    }

    hideMessage() {
        this.messageContainer?.classList.add('hidden');
    }

    // Update profile data in UI after successful save
    updateProfileDisplay(userData) {
        const selectors = {
            '[data-user-name]': userData.name,
            '[data-user-username]': '@' + userData.username,
            '[data-user-pronoun]': userData.pronoun,
            '[data-user-bio]': userData.bio || 'No bio yet'
        };

        Object.entries(selectors).forEach(([selector, value]) => {
            document.querySelectorAll(selector).forEach(el => el.textContent = value);
        });
    }
}

// Initialize modal when DOM is ready
document.addEventListener('DOMContentLoaded', () => new ProfileModal());
</script>