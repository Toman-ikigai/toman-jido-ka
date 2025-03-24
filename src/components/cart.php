<form id="shopping-cart" class="fixed top-0 right-0 bg-neutral-900 text-white p-4 w-80 h-screen shadow-lg transform translate-x-full transition-transform duration-300 z-50">
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
            Enviar Pedido
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

        const fragment = document.createDocumentFragment();

        cartItems.forEach((item, i) => {
            const figure = document.createElement('figure');
            figure.className = "flex items-center gap-2 border-r border-gray-800 pr-2";

            const img = document.createElement('img');
            img.src = item.image;
            img.alt = item.name;
            img.className = "w-16 h-16 object-cover rounded";

            const detailsDiv = document.createElement('div');
            detailsDiv.className = "flex-1";

            const name = document.createElement('h3');
            name.className = "text-sm font-semibold";
            name.textContent = item.name;

            const price = document.createElement('p');
            price.className = "text-primaryC-yellow";
            price.textContent = `$${item.price.toFixed(2)}`;

            const quantityDiv = document.createElement('div');
            quantityDiv.className = "flex items-center gap-2 mt-1";

            const decreaseBtn = document.createElement('button');
            decreaseBtn.className = "text-gray-400 hover:text-primaryC-yellow decrease";
            decreaseBtn.setAttribute("data-id", item.id);
            decreaseBtn.setAttribute("data-action", "decrease");
            decreaseBtn.type = "button";
            decreaseBtn.innerHTML = `
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
            </svg>
        `;

            const quantitySpan = document.createElement('span');
            quantitySpan.className = "text-sm";
            quantitySpan.textContent = item.quantity || 1;

            const increaseBtn = document.createElement('button');
            increaseBtn.className = "text-gray-400 hover:text-primaryC-yellow increase";
            increaseBtn.setAttribute("data-id", item.id);
            increaseBtn.setAttribute("data-action", "increase");
            increaseBtn.type = "button";
            increaseBtn.innerHTML = `
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
        `;
            const removeBtn = document.createElement('button');
            removeBtn.className = "text-red-500 hover:text-red-700 remove";
            removeBtn.setAttribute("data-id", item.id);
            removeBtn.setAttribute("data-action", "remove");
            removeBtn.type = "button";
            removeBtn.innerHTML = `
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
        `;

            const hiddenInputs = `
            <input type="hidden" name="detalles[${i}][id]" value="${item.id}">
            <input type="hidden" name="detalles[${i}][sku]" value="${item.sku}">
            <input type="hidden" name="detalles[${i}][cantidad]" value="${item.quantity || 1}">
            <input type="hidden" name="detalles[${i}][precio]" value="${item.price}">
            <input type="hidden" name="detalles[${i}][nombre]" value="${item.name}">
            <input type="hidden" name="detalles[${i}][imagen]" value="${item.image}">
        `;

            quantityDiv.appendChild(decreaseBtn);
            quantityDiv.appendChild(quantitySpan);
            quantityDiv.appendChild(increaseBtn);

            detailsDiv.appendChild(name);
            detailsDiv.appendChild(price);
            detailsDiv.appendChild(quantityDiv);

            figure.appendChild(img);
            figure.appendChild(detailsDiv);
            figure.appendChild(removeBtn);

            figure.insertAdjacentHTML('beforeend', hiddenInputs);
            fragment.appendChild(figure);
        });

        cartItemsContainer.appendChild(fragment);

        const total = cartItems.reduce((sum, item) => sum + (item.price * (item.quantity || 1)), 0);
        cartTotal.textContent = `$${total.toFixed(2)}`;
        cartCount.textContent = cartItems.reduce((sum, item) => sum + (item.quantity || 1), 0);
    }

    function updateQuantity(itemId, action) {
        cartItems = cartItems.map(item => {
            if (item.id === itemId) {
                let newQuantity = action === 'increase' ? item.quantity + 1 : Math.max(item.quantity - 1, 1);
                return {
                    ...item,
                    quantity: newQuantity
                };
            }
            return item;
        });
        localStorage.setItem('cartItems', JSON.stringify(cartItems));
        updateCartUI();
    }

    function removeFromCart(itemId) {
        cartItems = cartItems.filter(item => item.id !== itemId);
        localStorage.setItem('cartItems', JSON.stringify(cartItems));
        updateCartUI();
    }

    document.addEventListener("DOMContentLoaded", () => {
        updateCartUI();
    });

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
        localStorage.setItem('cartItems', JSON.stringify(cartItems));
        updateCartUI();
        if (!isCartOpen) toggleCart();
    });

    cartItemsContainer.addEventListener('click', (event) => {
        const button = event.target.closest('button');
        if (!button) return;

        if (button.matches('.increase')) {
            updateQuantity(button.dataset.id, 'increase');
        } else if (button.matches('.decrease')) {
            updateQuantity(button.dataset.id, 'decrease');
        } else if (button.matches('.remove')) {
            removeFromCart(button.dataset.id);
        }
    });


    document.querySelector('#shopping-cart').addEventListener('submit', async (event) => {
        event.preventDefault();
        const formData = new FormData(event.target);
        const email = formData.get('email');

        const detalles = JSON.parse(localStorage.getItem('cartItems')) || [];


        if (!email || !detalles.length) {
            alert('Datos incompletos');
            return;
        }
        try {
            const response = await axios.post('https://api-send-email-eight.vercel.app/api/v1/send-email', {
                email,
                detalles
            });

            const data = response.data

            alert(data.message);
            localStorage.setItem('cartItems', JSON.stringify([]));
            updateCartUI();
            toggleCart();
        } catch (error) {
            alert('Ocurrió un error al enviar el correo');
        }
    });
</script>