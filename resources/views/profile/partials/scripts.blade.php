<script>
// Main Profile Page Scripts (excluding Photo Upload Modal)
document.addEventListener('DOMContentLoaded', function () {
    // Mobile menu functionality
    window.toggleMobileMenu = function () {
        const mobileMenu = document.getElementById('mobileMenu');
        const mobileMenuPanel = document.getElementById('mobileMenuPanel');

        if (mobileMenu && mobileMenuPanel) {
            if (mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.remove('hidden');
                setTimeout(() => {
                    mobileMenuPanel.classList.remove('translate-x-full');
                }, 10);
            } else {
                mobileMenuPanel.classList.add('translate-x-full');
                setTimeout(() => {
                    mobileMenu.classList.add('hidden');
                }, 300);
            }
        }
    };

    // User menu functionality
    window.toggleUserMenu = function () {
        const userMenu = document.getElementById('userMenu');
        if (userMenu) {
            userMenu.classList.toggle('hidden');
        }
    };

    // Close dropdowns when clicking outside
    document.addEventListener('click', function (event) {
        // Close user menu
        const userMenu = document.getElementById('userMenu');
        if (userMenu && !event.target.closest('[onclick="toggleUserMenu()"]') && !userMenu.classList.contains('hidden')) {
            userMenu.classList.add('hidden');
        }

        // Close mobile menu
        const mobileMenu = document.getElementById('mobileMenu');
        const mobileMenuPanel = document.getElementById('mobileMenuPanel');
        if (mobileMenu && mobileMenuPanel &&
            !mobileMenu.classList.contains('hidden') &&
            !mobileMenuPanel.contains(event.target) &&
            !event.target.closest('[onclick="toggleMobileMenu()"]')) {
            toggleMobileMenu();
        }
    });

    // Add smooth scroll behavior
    document.documentElement.style.scrollBehavior = 'smooth';

    console.log('Main profile page scripts loaded successfully');
});
</script>