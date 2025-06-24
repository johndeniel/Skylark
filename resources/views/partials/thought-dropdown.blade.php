<!-- Thought Dropdown Menu Partial -->
@if(request()->routeIs('profile') && $thought->userid === auth()->user()->userid)
    <div class="relative">
        <!-- Vertical Dots Button -->
        <button class="thought-dropdown-btn p-2 text-gray-600 hover:text-black transition-colors duration-200 rounded-full hover:bg-gray-100" 
                data-thought-id="{{ $thought->_id }}"
                aria-label="Thought options">
            <i class="fas fa-ellipsis-v"></i>
        </button>
        
        <!-- Dropdown Menu -->
        <div class="thought-dropdown-menu hidden absolute right-0 top-full mt-2 w-40 bg-white border border-gray-300 rounded-xl shadow-lg z-10 py-2">
            <button class="edit-thought-btn w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100 flex items-center gap-2"
                    data-thought-id="{{ $thought->_id }}"
                    data-thought-content="{{ addslashes($thought->content) }}">
                <i class="fas fa-edit text-black"></i>
                Edit
            </button>
            <button class="delete-thought-btn w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100 flex items-center gap-2"
                    data-thought-id="{{ $thought->_id }}">
                <i class="fas fa-trash text-black"></i>
                Delete
            </button>
        </div>
    </div>
@endif

@once
<script>
/**
 * Thought Dropdown Management System
 * Handles dropdown menu interactions using event delegation
 */
document.addEventListener('DOMContentLoaded', function() {
    // Prevent multiple initializations
    if (window.thoughtDropdownInitialized) return;
    window.thoughtDropdownInitialized = true;
    
    // Single event listener for all dropdown interactions
    document.addEventListener('click', function(e) {
        const dropdownBtn = e.target.closest('.thought-dropdown-btn');
        const editBtn = e.target.closest('.edit-thought-btn');
        const deleteBtn = e.target.closest('.delete-thought-btn');
        const dropdown = e.target.closest('.thought-dropdown-menu');
        
        if (dropdownBtn) {
            e.preventDefault();
            toggleDropdown(dropdownBtn);
        } else if (editBtn) {
            e.preventDefault();
            openEditModal(editBtn);
        } else if (deleteBtn) {
            e.preventDefault();
            openDeleteModal(deleteBtn);
        } else if (!dropdown) {
            closeAllDropdowns();
        }
    });
    
    /**
     * Toggles dropdown menu visibility
     */
    function toggleDropdown(button) {
        const dropdown = button.nextElementSibling;
        const isCurrentlyHidden = dropdown.classList.contains('hidden');
        
        // Close all dropdowns first
        closeAllDropdowns();
        
        // If this dropdown was hidden, show it
        if (isCurrentlyHidden) {
            dropdown.classList.remove('hidden');
        }
    }
    
    /**
     * Closes all dropdown menus
     */
    function closeAllDropdowns() {
        document.querySelectorAll('.thought-dropdown-menu').forEach(menu => {
            menu.classList.add('hidden');
        });
    }
    
    /**
     * Opens edit modal with thought content
     */
    function openEditModal(button) {
        const thoughtId = button.dataset.thoughtId;
        const thoughtContent = button.dataset.thoughtContent;
        
        const modal = document.getElementById('editThoughtModal');
        const textarea = document.getElementById('editThoughtContent');
        const charCount = document.getElementById('editCharCount');
        const updateBtn = document.getElementById('updateThoughtBtn');
        
        if (modal && textarea) {
            textarea.value = thoughtContent;
            if (charCount) charCount.textContent = thoughtContent.length;
            if (updateBtn) updateBtn.disabled = !thoughtContent.length || thoughtContent.length > 280;
            
            modal.dataset.thoughtId = thoughtId;
            modal.classList.remove('hidden');
            textarea.focus();
            textarea.setSelectionRange(textarea.value.length, textarea.value.length);
        }
        
        closeAllDropdowns();
    }
    
    /**
     * Opens delete confirmation modal
     */
    function openDeleteModal(button) {
        const thoughtId = button.dataset.thoughtId;
        const modal = document.getElementById('deleteThoughtModal');
        
        if (modal) {
            modal.dataset.thoughtId = thoughtId;
            modal.classList.remove('hidden');
            
            const cancelBtn = modal.querySelector('.close-modal');
            if (cancelBtn) cancelBtn.focus();
        }
        
        closeAllDropdowns();
    }
});
</script>
@endonce