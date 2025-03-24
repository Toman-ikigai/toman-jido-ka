<?php
define("IMG_ICO", "src/img/toman.ico");

$products = $product->getAll("es");

?>

<!DOCTYPE html>
<html lang=$lang>

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="/src/img/toman.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Toman Jido-Ka Ikigai Admin Dashboard" />
    <link rel="stylesheet" href="/dist/styles.css" />
    <link rel="stylesheet" href="/css/style.css" />
    <title>Admin Dashboard</title>
</head>

<body class="bg-gray-50">
    <!-- Sidebar -->
    <?php include BASE_PATH . 'components/Sidebar.php'; ?>

    <!-- Main Content - Modified for responsive -->
    <div class="relative md:left-64 left-0 w-full md:w-[calc(100%-16rem)] md:ml-0 transition-all duration-300 ease-in-out">
        <header class="bg-white shadow md:ml-0 p-4 md:p-6">
            <div class="px-4 md:px-6 py-4">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Welcome to Dashboard</h1>
            </div>
        </header>

        <main class="p-4 md:p-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 md:gap-6">
                <!-- Product Statistics Card -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Product Statistics</h3>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600">Total Products</p>
                            <p class="text-2xl font-bold text-gray-800">
                                <?php
                                echo count($products);
                                ?>
                            </p>
                        </div>
                        <svg class="h-12 w-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                </div>

                <!-- Quick Actions Card -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Quick Actions</h3>
                    <div class="space-y-4">
                        <a href="/<?php echo $lang; ?>/create-product"
                            class="block w-full px-4 py-2 bg-blue-500 text-white text-center rounded-lg hover:bg-blue-600 transition-colors">
                            Add New Product
                        </a>
                        <a href="/<?php echo $lang; ?>/view-products"
                            class="block w-full px-4 py-2 bg-gray-100 text-gray-700 text-center rounded-lg hover:bg-gray-200 transition-colors">
                            Manage Products
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>

</html>