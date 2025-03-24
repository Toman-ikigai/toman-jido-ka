<?php
define("IMG_ICO", "src/img/toman.ico");
require "src/store/category.php";

$id = (isset($_GET['id']) ? $_GET['id'] : null);

$category = new Category($connexion);
$categoryData = $category->getById($id);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $idUrl = $_POST["id"];
    $name = $_POST["nombre"];
    $description = $_POST["descripcion"];

    $result = false;
    if (isset($idUrl) && !empty($idUrl)) {
        $result = $category->update($idUrl, $name, $description);
    } else {
        $id_category = uniqid();
        $result = $category->create($name, $description, $id_category);
    }

    $message = $result ? "Category created successfully" : "Error creating category";
}
?>

<!DOCTYPE html>
<html lang=<?php echo $lang; ?>>

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="/src/img/toman.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/dist/styles.css" />
    <link rel="stylesheet" href="/css/style.css" />
    <title>Create New Category</title>
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

        <h2 class="text-3xl font-bold text-center mb-10">Create New Category</h2>

        <div class="md:w-1/2 mx-auto bg-white shadow-lg rounded-lg p-6">
            <form method="POST" class="space-y-6" action="/<?php echo $lang; ?>/create-category">
                <input type="hidden" name="id" value="<?php echo isset($categoryData) ? $categoryData['id'] : ''; ?>" hidden>

                <div>
                    <label for="name" class="block text-gray-700 font-bold mb-2">Category Name</label>
                    <input
                        type="text"
                        id="name"
                        name="nombre"
                        value="<?php echo isset($categoryData) ? $categoryData['nombre'] : ''; ?>"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
                        required>
                </div>

                <div>
                    <label for="description" class="block text-gray-700 font-bold mb-2">Description</label>
                    <textarea
                        id="description"
                        name="descripcion"
                        rows="4"
                        placeholder="Enter category description"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
                        required>
                        <?php echo isset($categoryData) ? htmlspecialchars(trim($categoryData['descripcion'])) : ''; ?>
                    </textarea>
                </div>

                <div class="flex justify-end">
                    <button
                        type="submit"
                        class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition-colors">
                        <?php echo isset($categoryData) ? 'Update Category' : 'Create Category'; ?>
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>