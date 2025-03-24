<?php
define("IMG_ICO", "src/img/toman.ico");
require "src/store/category.php";
require "src/store/brand.php";

$id = (isset($_GET['id']) ? $_GET['id'] : null);

$category = new Category($connexion);
$categories = $category->getAll();

$brand = new Brand($connexion);
$brands = $brand->getAll();

$idProduct = $product->getById($id);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $idUrl = $_POST["id"];
    $sku = $_POST["sku"];
    $name = $_POST["nombre"];
    $price = $_POST["precio"];
    $image = $_POST["imagen"];
    $quantity = $_POST["stock"];
    $description = $_POST["descripcion"];
    $category = $_POST["categoria"];
    $brand = $_POST["marca"];
    $archivo = $_POST["archivo"];

    $result = false;
    if (isset($idUrl) && !empty($idUrl)) {
        $result = $product->update($idUrl, $name, $price, $image, $description, $quantity, $sku, $category, $brand, $archivo);
    } else {
        $id_product = uniqid();
        $result = $product->create($name, $price, $image, $description, $quantity, $sku, $category, $brand, $id_product, $archivo);
    }

    $message = $result ? "Product created successfully" : "Error creating product";
}
?>

<!DOCTYPE html>
<html lang=$lang>

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="/src/img/toman.ico" />
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
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <title>Create New Product</title>
</head>

<body>
    <?php include BASE_PATH . 'components/Sidebar.php'; ?>
    <main class="relative md:left-64 left-0 w-full md:w-[calc(100%-16rem)] md:ml-0 transition-all duration-300 ease-in-out p-5">

        <?php if (isset($message)) : ?>
            <div
                class="<?php echo $result ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'; ?> p-4 rounded-lg mb-6 w-full flex"
                role="alert">
                <p><?php echo $message; ?></p>
            </div>
        <?php endif; ?>

        <h2 class="text-3xl font-bold text-center mb-10">Create New Product</h2>
        <div class="md:w-1/2 mx-auto bg-white shadow-lg rounded-lg p-6">
            <form method="POST" class="space-y-6" action="/<?php echo $lang; ?>/create-product">
                <input type="hidden" name="id" value="<?php echo isset($idProduct) ? $idProduct['id_product'] : ''; ?>" hidden>
                <div>
                    <label for="category" class="block text-gray-700 font-bold mb-2">Category</label>
                    <select
                        id="category"
                        name="categoria"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
                        required>
                        <option value="">Select Category</option>
                        <?php foreach ($categories as $category) : ?>
                            <option
                                value="<?php echo $category['id']; ?>"
                                <?php echo isset($idProduct) && $idProduct['categoria_id'] == $category['id'] ? 'selected' : ''; ?>>
                                <?php echo $category['nombre']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label for="brand" class="block text-gray-700 font-bold mb-2">Brand</label>
                    <select
                        id="brand"
                        name="marca"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
                        required>
                        <option value="">Select Brand</option>
                        <?php foreach ($brands as $brand) : ?>
                            <option
                                value="<?php echo $brand['id']; ?>"
                                <?php echo isset($idProduct) && $idProduct['marca_id'] == $brand['id'] ? 'selected' : ''; ?>>
                                <?php echo $brand['nombre']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

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
                        name="nombre"
                        value="<?php echo isset($idProduct) ? $idProduct['nombre'] : ''; ?>"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
                        required>
                </div>

                <div class="flex gap-2">
                    <div>
                        <label for="price" class="block text-gray-700 font-bold mb-2">Price</label>
                        <input
                            type="number"
                            id="price"
                            name="precio"
                            step="0.01"
                            value="<?php echo isset($idProduct) ? $idProduct['precio'] : ''; ?>"
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
                            name="stock"
                            step="0.01"
                            value="<?php echo isset($idProduct) ? $idProduct['stock'] : ''; ?>"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
                            required>
                    </div>
                </div>

                <div class="space-y-4">
                    <label for="image" class="block text-gray-700 font-bold mb-2">Product Image</label>
                    
                    <!-- Image Preview -->
                    <div class="flex justify-center p-4 bg-gray-50 rounded-lg">
                        <img src="<?php echo isset($idProduct) ? $idProduct['imagen'] : '/src/img/placeholder.png'; ?>" 
                             alt="Product preview" 
                             class="img_bg w-48 h-48 object-cover rounded-lg shadow-md">
                    </div>

                    <!-- Upload Controls -->
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label class="block text-sm text-gray-600 mb-2">Upload Image</label>
                            <input 
                                type="file" 
                                class="input_file block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-full file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-blue-50 file:text-blue-700
                                    hover:file:bg-blue-100"
                                accept="image/*">
                        </div>
                        
                        <div>
                            <label class="block text-sm text-gray-600 mb-2">Image URL</label>
                            <input
                                type="text"
                                id="image"
                                name="imagen"
                                value="<?php echo isset($idProduct) ? $idProduct['imagen'] : ''; ?>"
                                placeholder="Image URL will appear here after upload"
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500 url bg-gray-50"
                                readonly
                                required>
                        </div>
                    </div>
                </div>
                <div>
                    <label for="archivo" class="block text-gray-700 font-bold mb-2">
                        Archivo
                    </label>
                    <input
                        type="text"
                        id="archivo"
                        name="archivo"
                        value="<?php echo isset($idProduct) ? $idProduct['archivo'] : ''; ?>"
                        placeholder="Enter archivo"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
                </div>

                <div>
                    <label for="description" class="block text-gray-700 font-bold mb-2">Description</label>
                    <textarea
                        id="description"
                        name="descripcion"
                        rows="4"
                        placeholder="Enter product description"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
                        required>
                        <?php echo isset($idProduct) ? htmlspecialchars(trim($idProduct['descripcion'])) : ''; ?>  
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
        
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        const api = "https://api.cloudinary.com/v1_1/dvggwdqnj/image/upload";
        const upload = document.querySelector(".input_file");
        const img = document.querySelector(".img_bg");
        const input_url = document.querySelector(".url");
        const presset = "products";

        upload.addEventListener("change", async (e) => {
            const file = e.target.files[0];
            const formData = new FormData();
            formData.append("file", file);
            formData.append("upload_preset", presset);
            let success = false;

            try {
                const res = await axios.post(api, formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                });
                const {
                    secure_url
                } = res.data;
                img.src = secure_url;
                input_url.value = secure_url;
                success = true;
            } catch (error) {
                console.log(error);
                success = false;
            }
            Toastify({
                text: success ? "Imagen subida correctamente" : "Error al subir la imagen",
                duration: 3000,
                newWindow: true,
                gravity: "top",
                position: "right",
                stopOnFocus: true,
                style: {
                    background: success ?
                        "linear-gradient(to right, #00b09b, #96c93d)" :
                        "linear-gradient(to right, rgb(255, 95, 109), rgb(255, 195, 113))",
                    borderRadius: "10px",
                },
            }).showToast();
        });
    </script>

</body>

</html>