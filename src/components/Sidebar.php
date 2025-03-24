<!-- Mobile menu button -->
<button id="mobile-menu-button" class="md:hidden fixed top-4 left-4 z-20 p-2 rounded-md bg-white shadow-lg transition-transform duration-300 ease-in-out">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
    </svg>
</button>

<aside id="sidebar" class="flex min-h-screen fixed left-0 w-64 z-20 bg-white shadow-lg transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out flex-col top-0">
    <!-- Sidebar - Modified for responsive -->
    <div class="p-2 w-full flex items-center justify-between text-center mx-auto">
        <a href="/<?php echo $lang; ?>/dashboard" class="flex items-center w-full text-center text-2xl font-bold text-blue-600 justify-center">
            Admin Panel

        </a>
    </div>
    <nav class="mt-2 overflow-y-auto h-[75vh] flex flex-col scroball">
        <div class="px-4 space-y-2">
            <a href="/<?php echo $lang; ?>/create-user"
                class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors">
                <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4v16m8-8H4" />
                </svg>
                Create User
            </a>

            <a href="/<?php echo $lang; ?>/create-category"
                class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors">
                <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4v16m8-8H4" />
                </svg>
                Create Category
            </a>
            <a href="/<?php echo $lang; ?>/create-brand"
                class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors">
                <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4v16m8-8H4" />
                </svg>
                Create Brand
            </a>
            <a href="/<?php echo $lang; ?>/create-product"
                class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors">
                <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4v16m8-8H4" />
                </svg>
                Create Product
            </a>
            <a href="/<?php echo $lang; ?>/view-users"
                class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors">
                <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                </svg>
                View Users
            </a>
            <a href="/<?php echo $lang; ?>/view-brands"
                class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors">
                <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                </svg>
                View Brands
            </a>
            <a href="/<?php echo $lang; ?>/view-categories"
                class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors">
                <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                </svg>
                View Categories
            </a>
            <a href="/<?php echo $lang; ?>/view-products"
                class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors">
                <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                </svg>
                View Products
            </a>
        </div>
    </nav>
    <div class="border-t border-gray-200 mt-2 mb-2"></div>
    <form method="post" action="/src/views/auth/logout.php">
        <button type="submit" name="logout"
            class="flex items-center px-4 py-3 text-red-600 hover:bg-red-50 hover:text-red-700 rounded-lg transition-colors">
            <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            Logout
        </button>

    </form>
</aside>

<!-- Add JavaScript for mobile menu toggle -->
<script>
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const sidebar = document.getElementById('sidebar');
    const body = document.body;

    mobileMenuButton.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
        mobileMenuButton.classList.toggle("translate-x-64");
    });

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', (e) => {
        if (window.innerWidth < 768) { // md breakpoint
            if (!sidebar.contains(e.target) && !mobileMenuButton.contains(e.target)) {
                sidebar.classList.add('-translate-x-full');
            }
        }
    });
</script>