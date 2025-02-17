<?php
define("IMG_ICO", "src/img/toman.ico");
require_once "src/service/langJson.php";

$content = getContentJsonLang("catalogItems", $langPath);
$items = $content["items"][$id];
$imagens = $items["views"];

$urlImg = "https://res.cloudinary.com/dvggwdqnj/image/upload/v1739651711/catalagos/{$langPath}/";

$clasControls = ($items["position"] == "vertical") ? "md:w-[40%]" : "md:w-[50%]";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="icon" href="<?= IMG_ICO ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Catalago</title>
  <meta
    name="description"
    content="Toman Jido-Ka Ikigai es una empresa de ingeniería que se dedica a la construcción de proyectos de infraestructura y edificación." />
  <meta name="keywords" content="Automatizacion,Servicios,Ingenieria,Proyectos" />
  <meta name="author" content="Toman Jido-Ka Ikigai" />
  <meta name="copyright" content="© 2025 Toman Jido-Ka Ikigai. Todos los derechos reservados." />
  <link rel="stylesheet" href="/dist/styles.css" />
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      background-color: #f0f0f0;
      font-family: 'Arial', sans-serif;
    }

    .book-container {
      position: relative;
      width: 80%;
      max-width: 1200px;
      height: 80vh;
      perspective: 2500px;
      margin-bottom: 20px;
      transition: width 0.5s ease, height 0.5s ease;
    }

    .book-container.horizontal {
      width: 50%;
      height: 70vh;
    }

    .book-container.vertical {
      width: 30%;
      height: 100vh;
    }

    .book {
      position: relative;
      width: 100%;
      height: 100%;
      transform-style: preserve-3d;
      transform: rotateX(10deg);
    }

    .page {
      position: absolute;
      width: 100%;
      height: 100%;
      background-color: white;
      transform-origin: left center;
      transition: transform 1.2s cubic-bezier(0.645, 0.045, 0.355, 1), opacity 0.5s ease;
      transform-style: preserve-3d;
      cursor: pointer;
      border-radius: 5px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
      overflow: hidden;
      opacity: 0;
      visibility: hidden;
    }

    .page.active {
      opacity: 1;
      visibility: visible;
      z-index: 10;
    }

    .page.flipping {
      z-index: 20;
    }

    .page-content {
      position: absolute;
      width: 100%;
      height: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
      border-radius: 5px;
    }

    .page img {
      width: 100%;
      height: 100%;
      object-fit: contain;
      border-radius: 5px;
    }

    /* Efecto de sombra del libro */
    .book::after {
      content: '';
      position: absolute;
      width: 100%;
      height: 20px;
      bottom: -20px;
      background: radial-gradient(ellipse at center, rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0) 80%);
    }

    /* Efecto de doblez en la página */
    .page::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(to left, rgba(0, 0, 0, 0.05) 0%, rgba(0, 0, 0, 0.1) 5%, rgba(0, 0, 0, 0) 15%);
      z-index: 3;
      pointer-events: none;
      border-radius: 5px;
    }

    /* Lomo del libro */
    .book::before {
      content: '';
      position: absolute;
      width: 20px;
      height: 100%;
      background: linear-gradient(to right, #8B4513, #A0522D);
      left: 0;
      transform: translateX(-10px);
      z-index: -1;
      border-radius: 5px 0 0 5px;
      box-shadow: -2px 0 5px rgba(0, 0, 0, 0.2);
    }

    /* Controles */

    button {
      padding: 10px 20px;
      /* background-color: #8B4513; */
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 1rem;
      transition: background-color 0.3s;
    }

    /* button:hover {
      background-color: #A0522D;
    } */

    button:disabled {
      /* background-color: #ccc; */
      cursor: not-allowed;
    }

    /* Numeración de páginas */
    .page-number {
      position: absolute;
      bottom: 10px;
      right: 10px;
      background-color: rgba(255, 255, 255, 0.7);
      padding: 3px 8px;
      border-radius: 10px;
      font-size: 0.8rem;
    }

    @media (max-width: 768px) {
      .book-container {
        width: 95%;
        height: 40vh;
      }

      .book-container.horizontal {
        width: 80%;
        height: 30vh;
      }

      .book-container.vertical {
        width: 90%;
        height: 80vh;
      }
    }
  </style>
</head>

<body class="bg-[#2c2c2c]">
  <!-- Header -->
  <?php include BASE_PATH . 'components/header_view.php'; ?>

  <section class="w-12/12 mt-32 flex justify-center flex-col items-center">
    <div class="book-container">
      <div class="book">

        <?php foreach ($imagens as $index => $item): ?>
          <div class="page" id="page<?= $index ?>">
            <div class="page-content">
              <img
                src="<?= $urlImg ?><?= $item ?>"
                alt="<?= $items["title"] ?>"
                data-orientation="<?= $items["position"] ?>" />
              <span class="absolute z-20 bg-[#2c2c2c] h-screen w-full text-white p-2 rounded-lg flex items-center justify-center loading">
                <div class="flex items-center gap-2">
                  <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                  </svg>
                  <span>Loading page...</span>
                </div>
              </span>
              <div class="page-number"><?= $index + 1 ?></div>
            </div>
          </div>
        <?php endforeach; ?>

      </div>
    </div>


    <div class="controls flex justify-between absolute w-11/12 <?= $clasControls ?>">
      <button id="prevBtn" class="flex items-center gap-2 px-4 py-2 rounded-lg">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
        </svg>
      </button>
      <button id="nextBtn" class="flex items-center gap-2 px-4 py-2 rounded-lg">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
        </svg>
      </button>
    </div>
  </section>



  <script>
    let currentPage = 0;
    const pages = document.querySelectorAll(".page");
    const totalPages = pages.length;
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");
    const bookContainer = document.querySelector(".book-container");

    // Función para detectar la orientación de la imagen
    function detectImageOrientation(img) {
      return new Promise((resolve) => {
        if (img.complete) {
          checkOrientation(img, resolve);
        } else {
          img.onload = () => checkOrientation(img, resolve);
        }
      });
    }

    function checkOrientation(img, resolve) {
      const orientation = img.getAttribute('data-orientation');

      if (orientation === 'detect') {
        if (img.naturalWidth > img.naturalHeight) {
          resolve('horizontal');
        } else {
          resolve('vertical');
        }
      } else {
        resolve(orientation);
      }
    }

    // Aplicar orientación al contenedor
    function applyOrientation(orientation) {
      bookContainer.classList.remove('horizontal', 'vertical');
      bookContainer.classList.add(orientation);
    }

    // Inicializar páginas
    async function initPages() {
      // Detectar orientación de la primera imagen
      const firstImg = pages[0].querySelector('img');
      const loading = pages[0].querySelector('.loading');
      const orientation = await detectImageOrientation(firstImg);
      applyOrientation(orientation);

      // Mostrar el loading durante 5 segundos antes de mostrar la página
      setTimeout(() => {
        pages[0].classList.add("active");
        loading.classList.add("hidden");
      }, 5000); // 5000 ms = 5 segundos

      updateButtons();
    }

    // Función para simular el volteo de página hacia adelante
    async function flipToNext(current, next) {
      const nextImg = next.querySelector('img');
      const loading = next.querySelector('.loading');

      // Mostrar el loading antes de cargar la imagen
      loading.classList.remove("hidden");

      // Función para continuar cuando la imagen esté lista
      function showPage() {
        applyOrientation(nextImg.getAttribute("data-orientation"));
        next.classList.add("active");
        loading.classList.add("hidden");
      }

      // Si la imagen ya cargó, mostrar la página de inmediato
      if (nextImg.complete) {
        showPage();
      } else {
        // Si no, esperar a que cargue
        nextImg.onload = showPage;
      }

      // Animación de la página actual
      current.classList.add("flipping");
      current.style.transformOrigin = "left center";

      setTimeout(() => {
        current.style.transform = "rotateY(-180deg)";
      }, 50);

      setTimeout(() => {
        current.classList.remove("active", "flipping");
        current.style.transform = "";
      }, 1200);
    }

    // Función para simular el volteo de página hacia atrás
    async function flipToPrev(current, prev) {
      // Detectar orientación de la página anterior
      const prevImg = prev.querySelector('img');
      const loading = prev.querySelector('.loading');
      const orientation = await detectImageOrientation(prevImg);
      applyOrientation(orientation);

      // Primero preparamos la página anterior
      prev.classList.add("flipping");
      prev.style.transformOrigin = "left center";
      prev.style.transform = "rotateY(-180deg)";
      prev.classList.add("active");

      // Pequeña pausa antes de iniciar la animación
      setTimeout(() => {
        prev.style.transform = "rotateY(0deg)";
        loading.classList.remove("hidden");
      }, 50);

      // Después de la animación, ocultar la página actual y esperar 5 segundos
      setTimeout(() => {
        current.classList.remove("active");
        prev.classList.remove("flipping");

        // Esperar 5 segundos antes de ocultar el loading
        setTimeout(() => {
          loading.classList.add("hidden");
        }, 5000); // 5000 ms = 5 segundos
      }, 1200);
    }

    // Voltear a la siguiente página
    function nextPage() {
      if (currentPage < totalPages - 1) {
        const current = pages[currentPage];
        currentPage++;
        const next = pages[currentPage];

        flipToNext(current, next);
        updateButtons();
      }
    }

    // Voltear a la página anterior
    function prevPage() {
      if (currentPage > 0) {
        const current = pages[currentPage];
        currentPage--;
        const prev = pages[currentPage];

        flipToPrev(current, prev);
        updateButtons();
      }
    }

    // Actualizar estado de los botones
    function updateButtons() {
      prevBtn.disabled = currentPage === 0;
      nextBtn.disabled = currentPage === totalPages - 1;
    }

    // Event listeners
    nextBtn.addEventListener("click", nextPage);
    prevBtn.addEventListener("click", prevPage);

    // También permite hacer clic en las páginas para avanzar
    pages.forEach((page) => {
      page.addEventListener("click", nextPage);
    });

    // Inicializar
    initPages();
  </script>
</body>

</html>