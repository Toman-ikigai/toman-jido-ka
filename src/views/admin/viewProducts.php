<?php
define("IMG_ICO", "src/img/toman.ico");

$products = $product->getAll("es");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];
    $result = $product->remove($id);
    $message = $result ? "Product removed successfully" : "Error removing product";
}

?>

<!DOCTYPE html>
<html lang=$lang>

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="/src/img/toman.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Toman Jido-Ka Ikigai Product Management" />
    <link rel="stylesheet" href="/dist/styles.css" />
    <link rel="stylesheet" href="/css/style.css" />
    <title>View Products</title>
</head>

<body class="bg-gray-50">
    <!-- Sidebar -->
    <?php include BASE_PATH . 'components/Sidebar.php'; ?>

    <main class="relative md:left-64 left-0 w-full md:w-[calc(100%-16rem)] md:ml-0 transition-all duration-300 ease-in-out p-5">

        <?php if (isset($message)) : ?>
            <div
                class="<?php echo $result ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'; ?> p-4 rounded-lg mb-6 w-full flex"
                role="alert">
                <p><?php echo $message; ?></p>
            </div>
        <?php endif; ?>

        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Products List</h2>
            <a href="/<?php echo $lang; ?>/create-product"
                class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition-colors">
                Add New Product
            </a>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full whitespace-nowrap">
                    <thead>
                        <tr class="bg-gray-100 text-left">
                            <th class="px-6 py-3 text-gray-600 font-semibold tracking-wider">Image</th>
                            <th class="px-6 py-3 text-gray-600 font-semibold tracking-wider">Name</th>
                            <th class="px-6 py-3 text-gray-600 font-semibold tracking-wider">SKU</th>
                            <th class="px-6 py-3 text-gray-600 font-semibold tracking-wider">Price</th>
                            <th class="px-6 py-3 text-gray-600 font-semibold tracking-wider">Description</th>
                            <th class="px-6 py-3 text-gray-600 font-semibold tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php if (empty($products)): ?>
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    No products found
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($products as $product): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <img src="<?php echo htmlspecialchars($product['imagen']); ?>"
                                            alt="<?php echo htmlspecialchars($product['nombre']); ?>"
                                            class="h-12 w-12 object-cover rounded">
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            <?php echo htmlspecialchars($product['nombre']); ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">
                                            <?php echo htmlspecialchars($product['sku'] ?? 'N/A'); ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">
                                            $<?php echo number_format($product['precio'], 2); ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-500 truncate max-w-xs">
                                            <?php echo htmlspecialchars($product['descripcion']); ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-3">
                                            <a class="text-blue-500 hover:text-blue-700" title="Edit" href="/<?php echo $lang; ?>/create-product?id=<?php echo $product['id_product']; ?>&action=edit">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <form method="post" action="/<?php echo $lang; ?>/view-products">
                                                <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                                                <button class="text-red-500 hover:text-red-700" title="Delete">
                                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>

                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>

</html>