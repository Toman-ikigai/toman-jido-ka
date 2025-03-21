  <!-- Mobile menu button -->
  <button id="mobile-menu-button" class="md:hidden fixed top-4 left-4 z-20 p-2 rounded-md bg-white shadow-lg transition-transform duration-300 ease-in-out">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
      </svg>
  </button>

  <aside id="sidebar" class="flex min-h-screen fixed left-0 w-64 z-20 bg-white shadow-lg transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out flex-col top-0">
      <!-- Sidebar - Modified for responsive -->
      <div class="p-6">
        <a href="/<?php echo $lang; ?>/dashboard" class="flex items-center space-x-2">
            <h2 class="text-2xl font-bold text-gray-800">Admin Panel</h2>

        </a>
      </div>
      <nav class="mt-6">
          <div class="px-4 space-y-2">
              <a href="/<?php echo $lang; ?>/products"
                  class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors">
                  <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                  </svg>
                  View Products
              </a>
              <a href="/<?php echo $lang; ?>/create-product"
                  class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors">
                  <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 4v16m8-8H4" />
                  </svg>
                  Create Product
              </a>
          </div>
      </nav>
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