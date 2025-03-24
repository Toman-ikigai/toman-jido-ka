<?php
define("IMG_ICO", "src/img/toman.ico");

$path = $_SERVER['REQUEST_URI'];
$product_id = basename($path);

$productData = $product->getById($product_id);

if (!$productData) {
    header("Location: /$lang/order");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="/src/img/toman.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo htmlspecialchars($productData['nombre']); ?>" />
    <link rel="stylesheet" href="/dist/styles.css" />
    <link rel="stylesheet" href="/css/style.css" />
    <title><?php echo htmlspecialchars($productData['nombre']); ?> - Toman Jido-ka Ikigai</title>
</head>

<body class="bg-[#2c2c2c]">
    <?php include BASE_PATH . 'components/cart.php'; ?>
    <main class="bg-neutral-900 py-8">
        <div class="container mx-auto px-4">
            <span class="id hidden" hidden>
                <?php echo $productData['id_product'] ?>
            </span>
            <div class="max-w-4xl mx-auto bg-[#1E1E1E] rounded-lg overflow-hidden shadow-lg">
                <div class="md:flex product">
                    <div class="md:w-1/2">
                        <img src="<?php echo htmlspecialchars($productData['imagen']); ?>"
                            alt="<?php echo htmlspecialchars($productData['nombre']); ?>"
                            class="w-full h-96 object-cover product-img" />
                    </div>
                    <div class="p-8 md:w-1/2">
                        <h1 class="text-3xl font-bold text-white mb-4 product-title">
                            <?php echo htmlspecialchars($productData['nombre']); ?>
                        </h1>
                        <p class="text-gray-400 text-lg mb-4 product-sku">
                            SKU: <?php echo htmlspecialchars($productData['sku'] ?? 'N/A'); ?>
                        </p>
                        <p class="text-primaryC-yellow text-2xl font-bold mb-4 product-price">
                            $<?php echo number_format($productData['precio'], 2); ?>
                        </p>
                        <p class="text-white mb-6 product-stock">
                            Stock: <?php echo isset($productData['stock']) ? $productData['stock'] : 0; ?>
                        </p>
                        <p class="text-gray-300 mb-8 product-description">
                            <?php echo htmlspecialchars($productData['descripcion'] ?? ''); ?>
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

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        const product = document.querySelector('.product');
        const id = document.querySelector('.id').innerText;

        product.addEventListener("click", (e) => {
            const btn = e.target.closest('.btn_card');

            if (!btn || !id && id.trim() === '') return;

            const title = document.querySelector('.product-title').innerText;
            const sku = document.querySelector('.product-sku').innerText;
            const price = document.querySelector('.product-price').innerText;
            const image = document.querySelector('.product-img').src;
            const emit = new CustomEvent("addItem", {
                detail: {
                    id: id.trim(),
                    name: title,
                    sku: sku.replace('SKU: ', ''),
                    price: parseInt(price.replace('$', '')),
                    image: image,
                    quantity: 1
                }
            });
            window.dispatchEvent(emit);
        })
    </script>
</body>

</html>