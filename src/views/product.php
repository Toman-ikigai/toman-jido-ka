<?php
define("IMG_ICO", "src/img/toman.ico");
require "src/store/products.php";

$path = $_SERVER['REQUEST_URI'];
$product_id = basename($path);

$product = new Products();
$productData = $product->getProduct($product_id);

if (!$productData) {
    header("Location: /$lang/order");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="<?= IMG_ICO ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo htmlspecialchars($productData['name']); ?>" />
    <link rel="stylesheet" href="/dist/styles.css" />
    <link rel="stylesheet" href="/css/style.css" />
    <title><?php echo htmlspecialchars($productData['name']); ?> - Toman Jido-ka Ikigai</title>
</head>

<body class="bg-[#2c2c2c]">
    <?php include BASE_PATH . 'components/cart.php'; ?>
    <main class="bg-neutral-900 py-8">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto bg-[#1E1E1E] rounded-lg overflow-hidden shadow-lg">
                <div class="md:flex">
                    <div class="md:w-1/2">
                        <img src="<?php echo htmlspecialchars($productData['image']); ?>"
                            alt="<?php echo htmlspecialchars($productData['name']); ?>"
                            class="w-full h-96 object-cover">
                    </div>
                    <div class="p-8 md:w-1/2">
                        <h1 class="text-3xl font-bold text-white mb-4">
                            <?php echo htmlspecialchars($productData['name']); ?>
                        </h1>
                        <p class="text-gray-400 text-lg mb-4">
                            SKU: <?php echo htmlspecialchars($productData['sku'] ?? 'N/A'); ?>
                        </p>
                        <p class="text-primaryC-yellow text-2xl font-bold mb-4">
                            $<?php echo number_format($productData['price'], 2); ?>
                        </p>
                        <p class="text-white mb-6">
                            Stock: <?php echo isset($productData['quantity']) ? $productData['quantity'] : 0; ?>
                        </p>
                        <p class="text-gray-300 mb-8">
                            <?php echo htmlspecialchars($productData['description'] ?? ''); ?>
                        </p>
                        <button
                            type="button"
                            class="w-full bg-primaryC-yellow text-black px-6 py-3 rounded-lg font-semibold hover:bg-[#FFA500] transition-colors duration-300 btn_card">
                            Agregar al Carrito
                        </button>
                        <a href="/<?php echo $lang; ?>/order"
                            class="block text-center mt-4 text-primaryC-yellow hover:text-[#FFA500] transition-colors">
                            Volver a Productos
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include BASE_PATH . "components/section/Footer.php"; ?>

    <script>
        document.querySelector('.btn_card').addEventListener('click', () => {
            const emit = new CustomEvent("addItem", {
                detail: {
                    id: <?php echo json_encode($productData['id']); ?>,
                    sku: <?php echo json_encode($productData['sku']); ?>,
                    name: <?php echo json_encode($productData['name']); ?>,
                    price: <?php echo $productData['price']; ?>,
                    image: <?php echo json_encode($productData['image']); ?>,
                    quantity: 1
                }
            });
            window.dispatchEvent(emit);
        });
    </script>
</body>

</html>