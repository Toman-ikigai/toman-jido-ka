<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $detalles = $_POST['detalles'] ?? [];

    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "El correo electrónico no es válido.";
        exit;
    }

    $detalles = $_POST['detalles'] ?? [];
    if (empty($detalles)) {
        echo "No se han enviado los detalles de los productos.";
        exit;
    }

    $fecha_actual = date('Y-m-d H:i:s');
    $productos = [];

    foreach ($detalles as $detalle) {
        $productos[] = [
            'id_pieza' => filter_var($detalle['id'], FILTER_SANITIZE_STRING),
            'sku' => filter_var($detalle['sku'], FILTER_SANITIZE_STRING),
            'nombre_pieza' => filter_var($detalle['nombre'], FILTER_SANITIZE_STRING),
            'cantidad_piezas' => filter_var($detalle['cantidad'], FILTER_SANITIZE_NUMBER_INT),
            'precio_pieza' => filter_var($detalle['precio'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            'imagen_pieza' => filter_var($detalle['imagen'], FILTER_SANITIZE_URL),
            'fecha' => $fecha_actual
        ];
    }

    $mensaje = "Detalles de los productos:\n\n";
    foreach ($productos as $producto) {
        $mensaje .= "ID: " . $producto['id_pieza'] . "\n";
        $mensaje .= "SKU: " . $producto['sku'] . "\n";
        $mensaje .= "Nombre: " . $producto['nombre_pieza'] . "\n";
        $mensaje .= "Cantidad: " . $producto['cantidad_piezas'] . "\n";
        $mensaje .= "Precio: " . number_format($producto['precio_pieza'], 2) . " USD\n";
        $mensaje .= "Imagen: " . $producto['imagen_pieza'] . "\n";
        $mensaje .= "Fecha: " . $producto['fecha'] . "\n\n";
    }

    $destinatario = "$email";
    // Asunto del correo
    $asunto = "Detalles de productos enviados";
    // Encabezados para el correo (en este caso, texto plano)
    $headers = "From: $email" . "\r\n" .
        "Reply-To: " . "\r\n" .
        "X-Mailer: PHP/" . phpversion();

    // Enviar el correo
    $envio = mail($destinatario, $asunto, $mensaje, $headers);

    // Verificar si se ha enviado el correo
    if ($envio) {
        echo "Correo enviado correctamente.";
    } else {
        echo "Hubo un error al enviar el correo.";
    }
}
?>

<form id="shopping-cart" class="fixed top-0 right-0 bg-neutral-900 text-white p-4 w-80 h-screen shadow-lg transform translate-x-full transition-transform duration-300 z-50" method="post" action="/<?php echo $lang; ?>/order">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold text-primaryC-yellow">Carrito de Compras</h2>
        <button type="button" onclick="toggleCart()" class="text-gray-400 hover:text-primaryC-yellow">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    <div id="cart-items" class="space-y-4 max-h-[calc(100vh-200px)] overflow-y-auto">
    </div>
    <div class="space-y-4 mt-4">
        <label for="email" class="block text-sm">Correo Electrónico:</label>
        <input type="email" name="email" placeholder="email" class="w-full px-4 py-2 rounded-lg bg-neutral-800 text-white border border-primaryC-yellow focus:outline-none focus:ring-2 focus:ring-primaryC-yellow">
    </div>
    <div class="absolute bottom-0 left-0 right-0 p-4 bg-neutral-900 border-t border-gray-800">
        <div class="flex justify-between mb-4">
            <span>Total:</span>
            <span id="cart-total" class="text-primaryC-yellow font-bold">$0.00</span>
        </div>
        <button class="w-full bg-primaryC-yellow text-black py-2 rounded font-semibold hover:bg-[#FFA500] transition-colors duration-300">
            Proceder al Pago
        </button>
    </div>
</form>

<button onclick="toggleCart()" class="fixed top-4 right-4 bg-primaryC-yellow text-black p-2 rounded-full shadow-lg z-50">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
    </svg>
    <span id="cart-count" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">0</span>
</button>

<script>
    const cartItemsContainer = document.getElementById('cart-items');
    const cartTotal = document.getElementById('cart-total');
    const cartCount = document.getElementById('cart-count');
    let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
    let isCartOpen = false;


    function toggleCart() {
        const cart = document.getElementById('shopping-cart');
        isCartOpen = !isCartOpen;
        cart.style.transform = isCartOpen ? 'translateX(0)' : 'translateX(100%)';
    }

    function updateCartUI() {
        cartItemsContainer.innerHTML = '';

        const items = cartItems.map((item, i) => {
            return `
            <input type="hidden" name="detalles[${i}][id]" value="${item.id}">
            <input type="hidden" name="detalles[${i}][sku]" value="${item.sku}">
            <input type="hidden" name="detalles[${i}][cantidad]" value="${item.quantity || 1}">
            <input type="hidden" name="detalles[${i}][precio]" value="${item.price}">
            <input type="hidden" name="detalles[${i}][nombre]" value="${item.name}">
            <input type="hidden" name="detalles[${i}][imagen]" value="${item.image}">
            <figure class="flex items-center gap-2 border-r border-gray-800 pr-2"/>
                <img src="${item.image}" alt="${item.name}" class="w-16 h-16 object-cover rounded">
                <div class="flex-1">
                    <h3 class="text-sm font-semibold">${item.name}</h3>
                    <p class="text-primaryC-yellow">$${item.price.toFixed(2)}</p>
                    <div class="flex items-center gap-2 mt-1">
                        <button data-id="${item.id}" data-action="decrease" class="text-gray-400 hover:text-primaryC-yellow">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                            </svg>
                        </button>
                        <span class="text-sm">${item.quantity || 1}</span>
                        <button data-id="${item.id}" data-action="increase" class="text-gray-400 hover:text-primaryC-yellow">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <button data-id="${item.id}" data-action="remove" class="text-red-500 hover:text-red-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </button>
            </figure>
        `;

        });

        cartItemsContainer.insertAdjacentHTML('beforeend', items.join(''));

        const total = cartItems.reduce((sum, item) => sum + (item.price * (item.quantity || 1)), 0);
        cartTotal.textContent = `$${total.toFixed(2)}`;
        cartCount.textContent = cartItems.reduce((sum, item) => sum + (item.quantity || 1), 0);
    }

    function updateQuantity(itemId) {
        cartItems = cartItems.map(item => item.id === itemId ? {
            ...item,
            quantity: item.quantity + 1
        } : item);

        updateCartUI();
    }

    function removeFromCart(itemId) {
        cartItems = cartItems.filter(item => item.id !== itemId);
        updateCartUI();
    }

    window.addEventListener("addItem", (event) => {
        const newItem = event.detail;
        const existingItem = cartItems.find(item => item.id === newItem.id);
        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            cartItems.push({
                ...newItem
            });
        }
        updateCartUI();
        if (!isCartOpen) toggleCart();
    });
</script>