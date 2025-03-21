<?php
define("IMG_ICO", "src/img/toman.ico");
require "src/store/products.php";

$id = isset($_POST['id']) ? $_POST['id'] : (isset($_GET['id']) ? $_GET['id'] : null);

$basePath = realpath(__DIR__ . '/../../lang/products/') . '/';
$product = new Products();
$idProduct = $product->getProduct($id);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $idUrl = $_POST["id"];
    $sku = $_POST["sku"];
    $name = $_POST["name"];
    $price = $_POST["price"];
    $image = $_POST["image"];
    $quantity = $_POST["quantity"];
    $description = $_POST["description"];

    if (isset($idUrl) && !empty($idUrl)) {
        $product->updateProduct($idUrl, $name, $price, $image, $description, $quantity, $sku);
    } else {
        $newId = uniqid();
        $product->createProducts($newId, $name, $price, $image, $description, $quantity, $sku);
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang=$lang>

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="<?= IMG_ICO ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta
        name="description"
        content="Toman Jido-Ka Ikigai es una empresa de ingeniería que se dedica a la construcción de proyectos de infraestructura y edificación." />
    <meta name="keywords" content="Automatizacion,Servicios,Ingenieria,Proyectos" />
    <meta name="author" content="Toman Jido-Ka Ikigai" />
    <meta name="copyright" content="© 2025 Toman Jido-Ka Ikigai. Todos los derechos reservados." />
    <meta name="google-site-verification" content="o8D_4FXb46-awY_Jw-bM7xhDa3xcxGI0AML1_4C7gE4" />
    <link rel="stylesheet" href="/dist/styles.css" />
    <link rel="stylesheet" href="/css/style.css" />
    <title>Create New Product</title>
</head>

<body>
    <?php include BASE_PATH . 'components/Sidebar.php'; ?>
    <main class="container mx-auto mt-10">
        <h2 class="text-3xl font-bold text-center mb-10">Create New Product</h2>

        <div class="md:w-1/2 mx-auto bg-white shadow-lg rounded-lg p-6">
            <form method="POST" class="space-y-6" action="/<?php echo $lang; ?>/create-product">
                <input type="hidden" name="id" value="<?php echo isset($idProduct) ? $idProduct['id'] : ''; ?>" hidden>
                <div>
                    <label for="sku" class="block text-gray-700 font-bold mb-2">
                        SKU
                    </label>
                    <input
                        type="text"
                        id="sku"
                        name="sku"
                        value="<?php echo isset($idProduct) ? $idProduct['sku'] : ''; ?>"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="name" class="block text-gray-700 font-bold mb-2">Product Name</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="<?php echo isset($idProduct) ? $idProduct['name'] : ''; ?>"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
                        required>
                </div>

                <div>
                    <label for="price" class="block text-gray-700 font-bold mb-2">Price</label>
                    <input
                        type="number"
                        id="price"
                        name="price"
                        step="0.01"
                        value="<?php echo isset($idProduct) ? $idProduct['price'] : ''; ?>"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
                        required>
                </div>

                <div>
                    <label for="quantity" class="block text-gray-700 font-bold mb-2">
                        Stock Quantity
                    </label>
                    <input
                        type="number"
                        id="quantity"
                        name="quantity"
                        step="0.01"
                        value="<?php echo isset($idProduct) ? $idProduct['quantity'] : ''; ?>"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
                        required>
                </div>

                <div>
                    <label for="image" class="block text-gray-700 font-bold mb-2">Image URL</label>
                    <input
                        type="text"
                        id="image"
                        name="image"
                        value="<?php echo isset($idProduct) ? $idProduct['image'] : ''; ?>"
                        placeholder="Enter image URL"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
                        required>
                </div>

                <div>
                    <label for="description" class="block text-gray-700 font-bold mb-2">Description</label>
                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        placeholder="Enter product description"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
                        required>
                        <?php echo isset($idProduct) ? htmlspecialchars(trim($idProduct['description'])) : ''; ?>  
                    </textarea>
                </div>

                <div class="flex justify-end">
                    <button
                        type="submit"
                        class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition-colors">
                        <?php echo isset($idProduct) ? 'Update Product' : 'Create Product'; ?>
                    </button>
                </div>
            </form>
        </div>
    </main>

</body>

</html>