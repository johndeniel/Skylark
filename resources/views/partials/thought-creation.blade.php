{{-- partials/thought-creation-modal.blade.php --}}

<div class="fixed bottom-8 lg:right-40 right-8 z-40">
    <button type="button" id="openThoughtModal" class="group relative flex items-center justify-center w-14 h-14 bg-black hover:bg-gray-800 text-white rounded-full shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-gray-300">
        <svg class="w-6 h-6 transition-transform duration-300 group-hover:rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        <span class="absolute right-full mr-3 px-3 py-2 bg-black text-white text-sm rounded-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 whitespace-nowrap pointer-events-none">
            Share a thought
            <span class="absolute left-full top-1/2 -translate-y-1/2 w-2 h-2 bg-black rotate-45"></span>
        </span>
    </button>
</div>

<div id="thoughtModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div id="modalBackdrop" class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm" data-action="close"></div>
    <div id="modalContent" class="relative w-full max-w-lg transform overflow-hidden rounded-2xl bg-white shadow-2xl transition-all duration-300">
        <div class="flex items-center justify-between p-5 border-b border-gray-200">
            <div class="flex items-center gap-3 min-w-0">
                <div class="w-11 h-11 rounded-full overflow-hidden bg-gray-800 flex items-center justify-center shadow-md flex-shrink-0">
                    @if(auth()->user()->photo_url)
                        <img src="{{ auth()->user()->photo_url }}" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-white font-bold">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</span>
                    @endif
                </div>
                <div class="min-w-0 flex-1">
                    <h3 class="text-lg font-semibold text-gray-900 truncate" id="modal-title">Share Your Thoughts</h3>
                    <p class="text-sm text-gray-500 truncate">What's on your mind, {{ auth()->user()->name }}?</p>
                </div>
            </div>
            <button type="button" data-action="close" class="rounded-full p-2 text-gray-500 hover:text-gray-900 hover:bg-gray-100 transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <form id="thoughtForm" action="{{ route('thoughts.store') }}" method="POST">
            @csrf
            <div class="p-5">
                <div class="relative">
                    <textarea name="content" id="thoughtContent" rows="4" maxlength="280" placeholder="Share something inspiring..." 
                        class="w-full h-24 p-4 text-gray-800 bg-gray-100 border border-gray-300 rounded-xl resize-none focus:outline-none focus:ring-2 focus:ring-offset-gray-100 focus:border-gray-200 transition duration-200" required autofocus></textarea>
                    <div class="absolute bottom-3 right-4 text-xs font-semibold text-gray-500">
                        <span id="charCount">0</span> / 280
                    </div>
                </div>
            </div>
            <div class="flex justify-end items-center gap-3 p-4 bg-gray-50 border-t">
                <button type="button" data-action="close" class="px-5 py-2 text-sm font-medium text-gray-700 bg-white hover:bg-gray-100 border border-gray-300 rounded-full transition duration-200 focus:outline-none focus:ring-2 focus:ring-gray-400">Cancel</button>
                <button type="submit" id="postBtn" class="relative px-6 py-2.5 text-sm font-semibold text-white bg-black hover:bg-gray-800 rounded-full transition duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black disabled:bg-gray-400 disabled:cursor-not-allowed flex items-center justify-center min-w-[110px]" disabled>
                    <span class="btn-text">Post</span>
                    <svg class="animate-spin h-5 w-5 text-white hidden btn-spinner absolute" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    'use strict';

    const thoughtModal = {
        MAX_CHARS: 280,
        ANIMATION_DURATION: 300,
        isSubmitting: false,

        elements: {
            modal: document.getElementById('thoughtModal'),
            content: document.getElementById('modalContent'),
            form: document.getElementById('thoughtForm'),
            textarea: document.getElementById('thoughtContent'),
            charCount: document.getElementById('charCount'),
            submitBtn: document.getElementById('postBtn'),
            btnText: document.querySelector('#postBtn .btn-text'),
            btnSpinner: document.querySelector('#postBtn .btn-spinner'),
            closeButtons: document.querySelectorAll('[data-action="close"]'),
        },

        init() {
            this.addEventListeners();
        },

        addEventListeners() {
            document.getElementById('openThoughtModal')?.addEventListener('click', () => this.open());
            this.elements.modal?.addEventListener('click', (e) => {
                const closeButton = e.target.closest('[data-action="close"]');
                if (closeButton && !this.isSubmitting) {
                    this.close();
                }
            });

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && this.isOpen() && !this.isSubmitting) {
                    this.close();
                }
            });
            
            this.elements.textarea?.addEventListener('input', () => this.onTextareaInput());
            this.elements.form?.addEventListener('submit', (e) => this.handleFormSubmit(e));
        },
        
        isOpen() {
            return !this.elements.modal.classList.contains('hidden');
        },

        open() {
            this.elements.modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            this.elements.content.style.opacity = 0;
            this.elements.content.style.transform = 'scale(0.95)';
            requestAnimationFrame(() => {
                this.elements.content.style.opacity = 1;
                this.elements.content.style.transform = 'scale(1)';
            });
            setTimeout(() => this.elements.textarea.focus(), this.ANIMATION_DURATION);
        },

        close() {
            this.elements.content.style.opacity = 0;
            this.elements.content.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.elements.modal.classList.add('hidden');
                document.body.style.overflow = '';
                this.resetForm();
            }, this.ANIMATION_DURATION - 50);
        },
        
        onTextareaInput() {
            const length = this.elements.textarea.value.length;
            const isValid = length > 0 && length <= this.MAX_CHARS;
            this.elements.charCount.textContent = length;
            this.elements.submitBtn.disabled = !isValid;
        },

        async handleFormSubmit(e) {
            e.preventDefault();
            const formData = new FormData(this.elements.form);
            this.setLoading(true);

            try {
                const response = await fetch(this.elements.form.action, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': formData.get('_token'),
                    },
                    body: formData,
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    throw new Error(errorData.message || 'Server error');
                }

                this.showNotification('Thought shared successfully!', 'success');
                setTimeout(() => window.location.reload(), 1500);

            } catch (error) {
                console.error('Submission failed:', error);
                this.showNotification('Failed to share thought. Please try again.', 'error');
                this.setLoading(false);
            }
        },
        
        setLoading(isLoading) {
            this.isSubmitting = isLoading;
            this.elements.submitBtn.disabled = isLoading || this.elements.textarea.value.length === 0;
            this.elements.textarea.disabled = isLoading;
            this.elements.closeButtons.forEach(btn => btn.disabled = isLoading);
            this.elements.btnText.style.opacity = isLoading ? '0' : '1';
            this.elements.btnSpinner.classList.toggle('hidden', !isLoading);
        },
        
        resetForm() {
            this.elements.form.reset();
            this.isSubmitting = false;
            this.onTextareaInput();
            this.setLoading(false);
        },

        showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            const styles = {
                success: 'bg-green-600',
                error: 'bg-red-600',
                info: 'bg-blue-600',
            };
            notification.className = `fixed top-5 right-5 px-4 py-3 text-white rounded-lg shadow-lg z-[60] transform translate-x-full transition-transform duration-300`;
            notification.classList.add(styles[type]);
            notification.textContent = message;
            notification.setAttribute('role', 'alert');
            document.body.appendChild(notification);

            requestAnimationFrame(() => notification.classList.remove('translate-x-full'));
            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }
    };

    thoughtModal.init();
});
</script>