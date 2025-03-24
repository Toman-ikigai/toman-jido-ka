<?php
require "src/store/user.php";

$id = (isset($_GET['id']) ? intval($_GET['id']) : null);

$user = new User($connexion);
$userData = $user->getById($id);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $idUrl = $_POST["id"];
    $name = $_POST["nombre"];
    $email = filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL);
    $password = trim($_POST["password"]);
    $role = $_POST["rol"];
    $active = isset($_POST["activo"]) ? 1 : 0;

    $password_hash = '';
    if (!empty($password)) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
    } else {
        $userData = $user->getById($idUrl);
        $password_hash = $userData['password_hash'];
    }

    $result = false;
    if (isset($idUrl) && !empty($idUrl)) {
        $result = $user->update($idUrl, $name, $email, $password_hash, $role, $active);
    } else {
        $result = $user->create($name, $email, $password_hash, $role, $active);
    }

    $message = $result ? "User created successfully" : "Error creating user";
}
?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="/src/img/toman.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Toman Jido-Ka Ikigai - User Management" />
    <link rel="stylesheet" href="/dist/styles.css" />
    <link rel="stylesheet" href="/css/style.css" />
    <title>Create New User</title>
</head>

<body>
    <?php include BASE_PATH . 'components/Sidebar.php'; ?>
    <main class="relative md:left-64 left-0 w-full md:w-[calc(100%-16rem)] md:ml-0 transition-all duration-300 ease-in-out p-5">

        <?php if (isset($message)) : ?>
            <div class="<?php echo $result ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'; ?> p-4 rounded-lg mb-6 w-full flex" role="alert">
                <p><?php echo $message; ?></p>
            </div>
        <?php endif; ?>

        <h2 class="text-3xl font-bold text-center mb-10">Create New User</h2>
        <div class="md:w-1/2 mx-auto bg-white shadow-lg rounded-lg p-6">
            <form method="POST" class="space-y-6" action="/<?php echo $lang; ?>/create-user">
                <input type="hidden" name="id" value="<?php echo isset($userData) ? $userData['id'] : ''; ?>" hidden>

                <div>
                    <label for="name" class="block text-gray-700 font-bold mb-2">Name</label>
                    <input
                        type="text"
                        id="name"
                        name="nombre"
                        value="<?php echo isset($userData) ? $userData['nombre'] : ''; ?>"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
                        required>
                </div>

                <div>
                    <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="<?php echo isset($userData) ? $userData['email'] : ''; ?>"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
                        required>
                </div>

                <div>
                    <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
                        <?php echo !isset($userData) ? 'required' : ''; ?>>
                    <?php if (isset($userData)) : ?>
                        <p class="text-sm text-gray-500 mt-1">Leave blank to keep current password</p>
                    <?php endif; ?>
                </div>

                <div>
                    <label for="role" class="block text-gray-700 font-bold mb-2">Role</label>
                    <select
                        id="role"
                        name="rol"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
                        required>
                        <option value="user" <?php echo (isset($userData) && $userData['rol'] == 'user') ? 'selected' : ''; ?>>User</option>
                        <option value="admin" <?php echo (isset($userData) && $userData['rol'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                    </select>
                </div>

                <div>
                    <label class="flex items-center">
                        <input
                            type="checkbox"
                            name="activo"
                            class="form-checkbox h-5 w-5 text-blue-500"
                            <?php echo (!isset($userData) || (isset($userData) && $userData['activo'])) ? 'checked' : ''; ?>>
                        <span class="ml-2 text-gray-700">Active Account</span>
                    </label>
                </div>

                <div class="flex justify-end">
                    <button
                        type="submit"
                        class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition-colors">
                        <?php echo isset($userData) ? 'Update User' : 'Create User'; ?>
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>