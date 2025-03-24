<?php
$path = "order";

?>
<!DOCTYPE html>
<html lang="en">

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
    <title>Toman Jido-ka Ikigai</title>
</head>

<body class="bg-[#2c2c2c]">
    <!-- Hero Carousel Section -->
    <?php include BASE_PATH . 'components/cart.php'; ?>
    <?php include BASE_PATH . 'components/header.php'; ?>
    <?php include BASE_PATH . 'components/header_order.php'; ?>
    <!-- Search Section -->
    <main class="bg-neutral-900 py-8">
        <div class="container mx-auto px-4">
            <div class="flex justify-center mb-8">
                <div class="relative w-full max-w-xl">
                    <input type="text"
                        id="searchInput"
                        placeholder="Buscar productos..."
                        class="w-full px-4 py-2 rounded-lg bg-neutral-800 text-white border border-primaryC-yellow focus:outline-none focus:ring-2 focus:ring-primaryC-yellow">
                    <button class="absolute right-2 top-1/2 transform -translate-y-1/2">
                        <svg class="w-6 h-6 text-primaryC-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="text-center mx-auto mb-8 max-w-2xl">
                <h2 class="text-4xl font-bold text-primaryC-yellow uppercase">Productos Destacados</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 cards">

            </div>
        </div>
        <div id="loading" class="text-center text-white mt-4 hidden">
            Cargando más productos...
        </div>

    </main>

    <?php include BASE_PATH . "components/section/Footer.php"; ?>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        const carousel = document.querySelector('.carousel > div');
        const slides = document.querySelectorAll('.carousel > div > div');
        let currentSlide = 0;
        let offset = 0;
        let isLoading = false;
        let isMore = true;

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            updateCarousel();
        }

        function updateCarousel() {
            carousel.style.transform = `translateX(-${currentSlide * 100}%)`;
        }

        setInterval(nextSlide, 5000);

        const searchInput = document.getElementById('searchInput');
        const cards = document.querySelectorAll('.card_item');

        searchInput.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();

            cards.forEach(card => {
                const productName = card.querySelector('h3').textContent.toLowerCase();
                const productSkuElement = card.querySelector('.text-gray-400');
                const productSku = productSkuElement ? productSkuElement.textContent.split('SKU: ')[1]?.toLowerCase() : '';

                if (productName.includes(searchTerm) || (productSku && productSku.includes(searchTerm))) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });

        async function loadMoreProducts() {
            if (isLoading || !isMore) return;
            isLoading = true;
            document.getElementById('loading').classList.remove('hidden');
            try {
                const response = await fetch(`https://toman.com.mx/es/products?offset=${offset}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                });

                const {
                    products
                } = await response.json();

                if (products.length === 0) {
                    document.getElementById('loading').classList.add('hidden');
                    isMore = false;
                    return;
                };

                const container = document.querySelector('.cards');

                products.forEach(product => {
                    if (document.querySelector(`.card_item[data-id="${product.id_product}"]`)) return;

                    const productCard = `
                    <div class="bg-[#1E1E1E] rounded-lg overflow-hidden shadow-lg transition-all duration-300 hover:scale-105 card_item" data-id="${product.id_product}">
                        <img src="${product.imagen}" alt="${product.nombre}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-white font-semibold text-lg mb-2">${product.nombre}</h3>
                            <p class="text-gray-400 text-sm mb-2">SKU: ${product.sku || 'N/A'}</p>
                            <div class="flex justify-between items-center mb-2">
                                <p class="text-primaryC-yellow font-bold">$${parseFloat(product.precio).toFixed(2)}</p>
                                <p class="text-white">Stock: ${product.stock || 0}</p>
                            </div>
                            <a href="/<?php echo $lang; ?>/product/${product.id_product}" 
                            class="mt-4 block w-full bg-primaryC-yellow text-black px-4 py-2 rounded font-semibold hover:bg-[#FFA500] transition-colors duration-300 text-center">Ver Detalles</a>
                        </div>
                    </div>
                `;
                    container.insertAdjacentHTML("beforeend", productCard);
                });

                offset++;
            } catch (error) {
                alert('Ocurrió un error al cargar los productos');
            } finally {
                isLoading = false;
                document.getElementById('loading').classList.add('hidden');
            }
        }

        document.addEventListener('DOMContentLoaded', loadMoreProducts);

        window.addEventListener('scroll', () => {
            if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 200) {
                loadMoreProducts();
            }
        });
    </script>
</body>