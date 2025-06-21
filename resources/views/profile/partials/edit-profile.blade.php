<!-- Edit Profile Modal -->
<div id="editModal" class="fixed inset-0 z-50 hidden">
    <!-- Overlay -->
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" onclick="closeEditModal()"></div>
    
    <!-- Modal Container - Properly centered on mobile -->
    <div class="fixed inset-0 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl w-full max-w-md shadow-2xl border border-gray-100 max-h-[90vh] overflow-y-auto">
            
            <!-- Header -->
            <div class="flex items-center justify-between p-6 border-b border-gray-100">
                <h3 class="text-xl font-light">Edit Profile</h3>
                <button onclick="closeEditModal()" class="p-2 rounded-lg text-gray-500 hover:text-black hover:bg-gray-50 transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <!-- Message Container -->
            <div id="messageContainer" class="hidden px-6 pt-4">
                <div id="messageText" class="p-3 rounded-lg text-sm"></div>
            </div>
            
            <!-- Form -->
            <form method="POST" action="{{ route('profile.update') }}" id="editProfileForm" class="p-6">
                @csrf
                @method('PUT')
                
                <div class="space-y-4">
                    <!-- Name Field -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                        <input type="text" name="name" value="{{ auth()->user()->name ?? '' }}" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent" required>
                    </div>
                    
                    <!-- Username Field -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">@</span>
                            <input type="text" name="username" value="{{ auth()->user()->username ?? '' }}" 
                                   class="w-full pl-8 pr-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent" required>
                        </div>
                    </div>
                    
                    <!-- Pronouns Dropdown -->
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
                    
                    <!-- Bio Textarea -->
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
                
                <!-- Action Buttons -->
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
document.addEventListener('DOMContentLoaded', function() {
    // Cache DOM elements
    const editModal = document.getElementById('editModal');
    const editProfileForm = document.getElementById('editProfileForm');
    const bioTextarea = document.querySelector('textarea[name="bio"]');
    const currentCountSpan = document.getElementById('currentCount');
    const bioCharCount = document.getElementById('bioCharCount');
    const messageContainer = document.getElementById('messageContainer');
    const messageText = document.getElementById('messageText');
    const saveButton = document.getElementById('saveButton');
    
    // Modal Controls
    window.openEditModal = () => {
        editModal.classList.remove('hidden');
        document.body.style.overflow = 'hidden'; // Prevent background scroll
        hideMessage();
    };

    window.closeEditModal = () => {
        editModal.classList.add('hidden');
        document.body.style.overflow = ''; // Restore scroll
        hideMessage();
    };

    // Bio Character Counter
    bioTextarea?.addEventListener('input', function() {
        const length = this.value.length;
        currentCountSpan.textContent = length;
        
        // Visual feedback when approaching limit
        bioCharCount.className = length > 55 ? 'text-xs text-gray-600' : 'text-xs text-gray-400';
    });

    // Form Submission Handler
    editProfileForm?.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        // Set loading state
        saveButton.disabled = true;
        saveButton.textContent = 'Saving...';
        
        try {
            const response = await fetch(this.action, {
                method: 'POST',
                body: new FormData(this),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            });
            
            const data = await response.json();
            
            if (data.success) {
                showMessage(data.message, 'success');
                updateProfileDisplay(data.user);
            } else {
                showMessage(data.message || 'Update failed', 'error');
            }
        } catch (error) {
            showMessage('An error occurred', 'error');
        } finally {
            // Reset button state
            saveButton.disabled = false;
            saveButton.textContent = 'Save Changes';
        }
    });

    // Message Display Functions
    function showMessage(message, type) {
        if (!messageContainer || !messageText) return;
        
        messageContainer.classList.remove('hidden');
        messageText.className = `p-3 rounded-lg text-sm ${
            type === 'success' 
                ? 'bg-gray-100 text-black border border-gray-200' 
                : 'bg-gray-900 text-white'
        }`;
        messageText.textContent = message;
    }

    function hideMessage() {
        messageContainer?.classList.add('hidden');
    }

    // Update Profile Display in UI
    function updateProfileDisplay(userData) {
        // Update all elements with user data attributes
        document.querySelectorAll('[data-user-name]').forEach(el => el.textContent = userData.name);
        document.querySelectorAll('[data-user-username]').forEach(el => el.textContent = '@' + userData.username);
        document.querySelectorAll('[data-user-pronoun]').forEach(el => el.textContent = userData.pronoun);
        document.querySelectorAll('[data-user-bio]').forEach(el => el.textContent = userData.bio || 'No bio yet');
    }

    // Keyboard Controls
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeEditModal();
    });
});
</script>