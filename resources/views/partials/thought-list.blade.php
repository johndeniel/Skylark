<!-- Thoughts List -->
<div class="space-y-6 sm:space-y-8">
    @forelse($thoughts as $thought)
        <article class="group bg-white border border-gray-100 rounded-3xl p-6 sm:p-10 transition-all duration-500 hover:border-gray-200 hover:shadow-2xl hover:-translate-y-1">
            
            <!-- Thought Author Info -->
            <header class="flex items-center gap-4 mb-6">
                <div class="w-12 h-12 rounded-full overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center shadow-inner">
                    @if($thought->user->photo_url)
                        <img src="{{ $thought->user->photo_url }}" alt="{{ $thought->user->name }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-gray-600 text-sm font-semibold tracking-wide font-mono">
                            {{ strtoupper(substr($thought->user->name, 0, 2)) }}
                        </span>
                    @endif
                </div>
                
                <div>
                    <h2 class="font-semibold text-gray-900 text-base sm:text-lg tracking-tight">{{ $thought->user->name }}</h2>
                    <time class="text-sm text-gray-500">{{ $thought->time_ago }}</time>
                </div>
            </header>

            <!-- Thought Content -->
            <blockquote class="text-gray-800 text-lg sm:text-xl leading-relaxed mb-6 font-light italic font-[Geist]">
                {{ $thought->content }}
            </blockquote>
            
            <!-- Interaction Controls -->
            <footer class="flex items-center gap-6">
                <!-- Like Action -->
                <button class="flex items-center gap-2 text-gray-500 hover:text-red-500 transition-colors duration-200 text-sm font-medium" 
                        aria-label="Like this thought">
                    <i class="far fa-heart"></i>
                    <span>0</span>
                </button>
                
                <!-- Comment Action -->
                <button class="flex items-center gap-2 text-gray-500 hover:text-blue-500 transition-colors duration-200 text-sm font-medium"
                        aria-label="Comment on this thought">
                    <i class="far fa-comment"></i>
                    <span>0</span>
                </button>
                
                <!-- Bookmark Action -->
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
        <!-- Empty State Display -->
        <div class="text-center py-12">
            <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                <i class="fas fa-lightbulb text-gray-400 text-2xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">No thoughts yet</h3>
            <p class="text-gray-500">Be the first to share your thoughts with the community!</p>
            <button onclick="document.getElementById('thoughtContent').focus()" 
                    class="mt-4 px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white rounded-full text-sm font-medium transition-all duration-200">
                Share Your First Thought
            </button>
        </div>
    @endforelse
</div>

<!-- Bookmark Toggle JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize CSRF token for AJAX requests
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        initializeBookmarkHandlers();
        
        /**
         * Initialize bookmark toggle functionality
         */
        function initializeBookmarkHandlers() {
            document.addEventListener('click', function(e) {
                const bookmarkBtn = e.target.closest('.bookmark-btn');
                if (bookmarkBtn) {
                    e.preventDefault();
                    handleBookmarkToggle(bookmarkBtn);
                }
            });
        }
        
        /**
         * Handle bookmark toggle with optimistic UI updates
         * @param {HTMLElement} button - The bookmark button element
         */
        function handleBookmarkToggle(button) {
            const thoughtId = button.dataset.thoughtId;
            const isBookmarked = button.dataset.bookmarked === 'true';
            
            // Disable button during request
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
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
                updateBookmarkUI(button, data);
                if (data.message) showToast(data.message);
            })
            .catch(error => {
                console.error('Bookmark error:', error);
                showToast('An error occurred. Please try again.', 'error');
            })
            .finally(() => {
                // Re-enable button
                button.disabled = false;
                button.style.opacity = '1';
            });
        }
        
        /**
         * Update bookmark button UI based on server response
         * @param {HTMLElement} button - The bookmark button
         * @param {Object} data - Server response data
         */
        function updateBookmarkUI(button, data) {
            const icon = button.querySelector('i');
            const countSpan = button.querySelector('.bookmark-count');
            
            // Update visual state
            if (data.bookmarked) {
                button.className = button.className.replace('text-gray-500 hover:text-yellow-500', 'text-yellow-500 hover:text-yellow-600');
                icon.className = icon.className.replace('far', 'fas');
                button.setAttribute('aria-label', 'Remove bookmark');
            } else {
                button.className = button.className.replace('text-yellow-500 hover:text-yellow-600', 'text-gray-500 hover:text-yellow-500');
                icon.className = icon.className.replace('fas', 'far');
                button.setAttribute('aria-label', 'Bookmark this thought');
            }
            
            // Update count display
            if (data.bookmark_count > 0) {
                if (countSpan) {
                    countSpan.textContent = data.bookmark_count;
                } else {
                    const newSpan = document.createElement('span');
                    newSpan.className = 'bookmark-count';
                    newSpan.textContent = data.bookmark_count;
                    button.appendChild(newSpan);
                }
            } else if (countSpan) {
                countSpan.remove();
            }
            
            // Update data attribute
            button.dataset.bookmarked = data.bookmarked ? 'true' : 'false';
        }
        
        /**
         * Display toast notification to user
         * @param {string} message - Message to display
         * @param {string} type - Type of toast (success|error)
         */
        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className = `fixed top-4 right-4 px-6 py-3 rounded-lg text-white font-medium z-50 transform translate-x-full transition-all duration-300 ${
                type === 'error' ? 'bg-red-500' : 'bg-green-500'
            }`;
            toast.textContent = message;
            
            document.body.appendChild(toast);
            
            // Animate in
            setTimeout(() => toast.style.transform = 'translateX(0)', 10);
            
            // Auto-remove after 3 seconds
            setTimeout(() => {
                toast.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    if (document.body.contains(toast)) {
                        document.body.removeChild(toast);
                    }
                }, 300);
            }, 3000);
        }
        
        // Make showToast globally available for inline event handlers
        window.showToast = showToast;
    });
</script>