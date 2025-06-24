<!-- Thoughts List Component -->
<div class="space-y-6 sm:space-y-8">
    @forelse($thoughts as $thought)
        <article class="group bg-white border border-gray-200 rounded-3xl p-6 sm:p-10 transition-all duration-500 hover:border-gray-300 hover:shadow-lg hover:-translate-y-1">
            
            <!-- Author Header -->
            <header class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-4">
                    <!-- Avatar -->
                    <div class="w-12 h-12 rounded-full overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center shadow-inner">
                        @if($thought->user->photo_url)
                            <img src="{{ $thought->user->photo_url }}" alt="{{ $thought->user->name }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-gray-600 text-sm font-semibold tracking-wide font-mono">
                                {{ strtoupper(substr($thought->user->name, 0, 2)) }}
                            </span>
                        @endif
                    </div>
                    
                    <!-- User Info -->
                    <div>
                        <h2 class="font-semibold text-gray-900 text-base sm:text-lg tracking-tight">{{ $thought->user->name }}</h2>
                        <time class="text-sm text-gray-500">{{ $thought->time_ago }}</time>
                    </div>
                </div>
                @include('partials.thought-dropdown', ['thought' => $thought])
            </header>

            <!-- Thought Content -->
            <blockquote class="text-gray-800 text-lg sm:text-xl leading-relaxed mb-6 font-light italic font-[Geist]" 
                        data-thought-id="{{ $thought->_id }}">
                {{ $thought->content }}
            </blockquote>
            
            <!-- Action Bar -->
            <footer class="flex items-center gap-6">
                <!-- Like Button -->
                <button class="flex items-center gap-2 text-gray-500 hover:text-red-500 transition-colors duration-200 text-sm font-medium" 
                        aria-label="Like this thought">
                    <i class="far fa-heart"></i>
                    <span>0</span>
                </button>
                
                <!-- Comment Button -->
                <button class="flex items-center gap-2 text-gray-500 hover:text-blue-500 transition-colors duration-200 text-sm font-medium"
                        aria-label="Comment on this thought">
                    <i class="far fa-comment"></i>
                    <span>0</span>
                </button>
                
                <!-- Bookmark Button -->
                <button class="bookmark-btn flex items-center gap-2 transition-colors duration-200 text-sm font-medium {{ $thought->is_bookmarked_by_user ? 'text-yellow-500 hover:text-yellow-600' : 'text-gray-500 hover:text-yellow-500' }}"
                        data-thought-id="{{ $thought->_id }}"
                        data-bookmarked="{{ $thought->is_bookmarked_by_user ? 'true' : 'false' }}"
                        aria-label="{{ $thought->is_bookmarked_by_user ? 'Remove bookmark' : 'Bookmark this thought' }}">
                    <i class="{{ $thought->is_bookmarked_by_user ? 'fas fa-bookmark' : 'far fa-bookmark' }}"></i>        
                    @if($thought->bookmark_count > 0)
                        <span class="bookmark-count">{{ $thought->bookmark_count }}</span>
                    @endif
                </button>
            </footer>
        </article>
    @empty
        <!-- Empty State -->
        <div class="text-center py-12">
            <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                <i class="fas fa-lightbulb text-gray-400 text-2xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">No thoughts yet</h3>
            <p class="text-gray-500">Be the first to share your thoughts with the community!</p>
            <button onclick="document.getElementById('thoughtContent').focus()" 
                    class="mt-4 px-6 py-3 bg-black hover:bg-gray-800 text-white rounded-full text-sm font-medium transition-all duration-200">
                Share Your First Thought
            </button>
        </div>
    @endforelse
</div>

@include('partials.thought-editor')
@include('partials.thought-delete')

<script>
/**
 * Bookmark Management System
 * Handles bookmark toggle functionality with optimistic UI updates and error handling
 */
document.addEventListener('DOMContentLoaded', function() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    // Event delegation for bookmark buttons - handles dynamic content efficiently
    document.addEventListener('click', function(e) {
        const bookmarkBtn = e.target.closest('.bookmark-btn');
        if (bookmarkBtn) {
            e.preventDefault();
            toggleBookmark(bookmarkBtn);
        }
    });
    
    /**
     * Handles bookmark toggle with server communication and UI updates
     * @param {HTMLElement} button - Bookmark button element
     */
    function toggleBookmark(button) {
        const thoughtId = button.dataset.thoughtId;
        
        // Prevent multiple rapid clicks
        button.disabled = true;
        button.style.opacity = '0.6';
        
        fetch(`/bookmarks/toggle/${thoughtId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) throw new Error('Server error');
            return response.json();
        })
        .then(data => {
            updateBookmarkUI(button, data);
            if (data.message) showToast(data.message);
        })
        .catch(error => {
            console.error('Bookmark error:', error);
            showToast('Failed to update bookmark. Please try again.', 'error');
        })
        .finally(() => {
            // Re-enable button
            button.disabled = false;
            button.style.opacity = '1';
        });
    }
    
    /**
     * Updates bookmark button visual state based on server response
     * @param {HTMLElement} button - Button to update
     * @param {Object} data - Server response containing bookmark state
     */
    function updateBookmarkUI(button, data) {
        const icon = button.querySelector('i');
        const countSpan = button.querySelector('.bookmark-count');
        
        // Toggle visual state
        if (data.bookmarked) {
            button.className = button.className.replace('text-gray-500 hover:text-yellow-500', 'text-yellow-500 hover:text-yellow-600');
            icon.className = 'fas fa-bookmark';
            button.setAttribute('aria-label', 'Remove bookmark');
        } else {
            button.className = button.className.replace('text-yellow-500 hover:text-yellow-600', 'text-gray-500 hover:text-yellow-500');
            icon.className = 'far fa-bookmark';
            button.setAttribute('aria-label', 'Bookmark this thought');
        }
        
        // Update count display
        if (data.bookmark_count > 0) {
            if (countSpan) {
                countSpan.textContent = data.bookmark_count;
            } else {
                button.insertAdjacentHTML('beforeend', `<span class="bookmark-count">${data.bookmark_count}</span>`);
            }
        } else if (countSpan) {
            countSpan.remove();
        }
        
        button.dataset.bookmarked = data.bookmarked ? 'true' : 'false';
    }
    
    /**
     * Displays toast notification with auto-dismiss
     * @param {string} message - Notification message
     * @param {string} type - Notification type (success|error)
     */
    function showToast(message, type = 'success') {
        const toast = document.createElement('div');
        const bgColor = type === 'error' ? 'bg-red-500' : 'bg-green-500';
        
        toast.className = `fixed top-4 right-4 px-6 py-3 rounded-lg text-white font-medium z-50 transform translate-x-full transition-transform duration-300 ${bgColor}`;
        toast.textContent = message;
        
        document.body.appendChild(toast);
        
        // Animate in
        setTimeout(() => toast.style.transform = 'translateX(0)', 10);
        
        // Auto-remove after 3 seconds
        setTimeout(() => {
            toast.style.transform = 'translateX(100%)';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }
});
</script>