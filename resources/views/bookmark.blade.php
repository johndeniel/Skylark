<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/favicon.ico" />
    <title>Skylark</title>
    
    @vite('resources/css/app.css')
    
    <!-- External Dependencies -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100;200;300;400;500;600;700;800;900&family=Geist+Mono:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body class="bg-white text-black antialiased font-sans overflow-x-hidden">
    
    <!-- Header Section -->
    @include('partials.header-private', ['user' => $user])

    <!-- Main Content Container -->
    <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pt-16"> 
        <!-- Bookmarked Thoughts Section -->
        <section class="py-8 sm:py-12">
            <!-- Thoughts Feed -->
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
                            
                            <!-- Bookmark Button (Always bookmarked in this view) -->
                            <button class="bookmark-btn flex items-center gap-2 transition-colors duration-200 text-sm font-medium text-yellow-500 hover:text-yellow-600"
                                    data-thought-id="{{ $thought->_id }}"
                                    data-bookmarked="true"
                                    aria-label="Remove bookmark">
                                <i class="fas fa-bookmark"></i>        
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
                            <i class="fas fa-bookmark text-gray-400 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">No bookmarks yet</h3>
                        <p class="text-gray-500 mb-4">Start bookmarking thoughts that inspire you!</p>
                        <a href="{{ route('thoughts.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                            <i class="fas fa-lightbulb"></i>
                            Browse Thoughts
                        </a>
                    </div>
                @endforelse
            </div>
        </section>
    </main>
    
    <!-- Footer Section -->
    @include('partials.footer')
    
    <!-- Bookmark JavaScript (same as original) -->
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
                        if (!data.bookmarked) {
                            // If unbookmarked, remove the card from view with animation
                            const article = button.closest('article');
                            article.style.transform = 'translateX(-100%)';
                            article.style.opacity = '0';
                            
                            setTimeout(() => {
                                article.remove();
                                
                                // Check if no thoughts left
                                const thoughtsContainer = document.querySelector('.space-y-6');
                                if (thoughtsContainer.children.length === 0) {
                                    location.reload(); // Reload to show empty state
                                }
                            }, 300);
                        }
                        
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
    
</body>
</html>