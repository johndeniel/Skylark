<!-- Profile Feed -->
<div class="py-12 lg:py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-2 lg:px-0">
        <div class="lg:mb-12 mb-6">
            <div class="flex flex-col">
                <div>
                    <h2 class="font-display text-3xl sm:text-4xl lg:text-5xl font-light lg:mb-2 leading-tight tracking-tight">
                        Creative Wall
                    </h2>
                    <p class="text-gray-500 text-sm sm:text-xl font-light leading-relaxed">
                        Posts I've shared with the Skylark community
                    </p>
                </div>
            </div>
        </div>

        <!-- Profile Thoughts -->
        <div class="space-y-6 sm:space-y-8">
            @forelse($thoughts as $thought)
                <!-- Individual Thought Card -->
                <article class="group bg-white border border-gray-100 rounded-3xl p-6 sm:p-10 transition-all duration-500 hover:border-gray-200 hover:shadow-2xl hover:-translate-y-1">
                    
                    <!-- Author Information -->
                    <header class="flex items-center gap-4 mb-6">
                        <!-- User Avatar -->
                        <div class="w-12 h-12 rounded-full overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center shadow-inner">
                            @if($thought->user->photo_url)
                                <img src="{{ $thought->user->photo_url }}" 
                                    alt="{{ $thought->user->name }}" 
                                    class="w-full h-full object-cover">
                            @else
                                <!-- Fallback initials -->
                                <span class="text-gray-600 text-sm font-semibold tracking-wide font-mono">
                                    {{ strtoupper(substr($thought->user->name, 0, 2)) }}
                                </span>
                            @endif
                        </div>
                        
                        <!-- User Details -->
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
                    <p class="text-gray-500">Share your first thought with the community!</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Add this JavaScript at the bottom of your profile view -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    // Handle bookmark toggle
    document.addEventListener('click', function(e) {
        if (e.target.closest('.bookmark-btn')) {
            e.preventDefault();
            
            const button = e.target.closest('.bookmark-btn');
            const thoughtId = button.dataset.thoughtId;
            const isBookmarked = button.dataset.bookmarked === 'true';
            
            // Disable button during request
            button.disabled = true;
            button.style.opacity = '0.6';
            
            // Make AJAX request
            fetch(`/bookmarks/toggle/${thoughtId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Update button state
                const icon = button.querySelector('i');
                const countSpan = button.querySelector('.bookmark-count');
                
                if (data.bookmarked) {
                    // Bookmarked state
                    button.classList.remove('text-gray-500', 'hover:text-yellow-500');
                    button.classList.add('text-yellow-500', 'hover:text-yellow-600');
                    icon.classList.remove('far');
                    icon.classList.add('fas');
                    button.setAttribute('aria-label', 'Remove bookmark');
                    
                    // Update count
                    if (countSpan) {
                        const currentCount = parseInt(countSpan.textContent) || 0;
                        countSpan.textContent = currentCount + 1;
                    } else if (data.bookmark_count && data.bookmark_count > 0) {
                        const newSpan = document.createElement('span');
                        newSpan.className = 'bookmark-count';
                        newSpan.textContent = data.bookmark_count;
                        button.appendChild(newSpan);
                    }
                } else {
                    // Unbookmarked state
                    button.classList.remove('text-yellow-500', 'hover:text-yellow-600');
                    button.classList.add('text-gray-500', 'hover:text-yellow-500');
                    icon.classList.remove('fas');
                    icon.classList.add('far');
                    button.setAttribute('aria-label', 'Bookmark this thought');
                    
                    // Update count
                    if (countSpan) {
                        const currentCount = parseInt(countSpan.textContent) || 0;
                        const newCount = Math.max(0, currentCount - 1);
                        if (newCount === 0) {
                            countSpan.remove();
                        } else {
                            countSpan.textContent = newCount;
                        }
                    }
                }
                
                // Update data attribute
                button.dataset.bookmarked = data.bookmarked ? 'true' : 'false';
                
                // Show success message
                if (data.message) {
                    showToast(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('An error occurred. Please try again.', 'error');
            })
            .finally(() => {
                // Re-enable button
                button.disabled = false;
                button.style.opacity = '1';
            });
        }
    });
    
    // Simple toast notification function
    function showToast(message, type = 'success') {
        const toast = document.createElement('div');
        toast.className = `fixed top-4 right-4 px-6 py-3 rounded-lg text-white font-medium z-50 transform transition-all duration-300 ${
            type === 'error' ? 'bg-red-500' : 'bg-green-500'
        }`;
        toast.textContent = message;
        
        document.body.appendChild(toast);
        
        // Animate in
        setTimeout(() => {
            toast.style.transform = 'translateX(0)';
        }, 10);
        
        // Remove after 3 seconds
        setTimeout(() => {
            toast.style.transform = 'translateX(100%)';
            setTimeout(() => {
                document.body.removeChild(toast);
            }, 300);
        }, 3000);
    }
});
</script>