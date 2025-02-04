<?php
define("IMG_ICO", "src/img/toman.ico");
$langPath = $lang;
$urlPdf = "https://res.cloudinary.com/dvggwdqnj/image/upload/v1734647242/catalagos/{$id}.pdf";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="<?= IMG_ICO ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Catalago</title>
    <link rel="stylesheet" href="/dist/styles.css" />
    <style>
        .pdf-container {
            touch-action: none;
            /* Control de zoom solo aquí */
        }

        .pdf-wrapper {
            position: relative;
            scrollbar-width: none;
            touch-action: pan-x pan-y;
            /* Permite scroll vertical y horizontal */
            -webkit-overflow-scrolling: touch;
            /* Mejora el scroll en iOS */
        }

        .pdf-container {
            transform-origin: 0 0;
            transition: transform 0.1s ease-out;
        }

        .transform-origin-top-left {
            transform-origin: top left;
        }
    </style>
</head>

<body class="bg-[#2c2c2c]">
    <!-- Header -->
    <?php include BASE_PATH . 'components/header.php'; ?>


    <section
        class="flex flex-col items-center justify-center min-h-screen p-4 mx-auto content-pdf">
        <input type="hidden" id="urlFile" value="<?= $urlPdf ?>" readonly />
        <div class="pdf-wrapper overflow-auto w-full max-w-4xl">
            <!-- Contenedor wrapper para el zoom -->
            <div
                id="pdfContainer"
                class="pdf-container flex flex-col gap-5 p-4 rounded-lg shadow-lg mt-24 transform-origin-top-left">
            </div>
            <div id="loader" class="flex flex-col items-center gap-2 mt-24">
                <div
                    class="w-12 h-12 border-4 border-blue-500 rounded-full animate-spin border-t-transparent">
                </div>
                <p class="text-gray-600">Loading PDF...</p>
            </div>
        </div>

        <!-- Controles de zoom opcionales -->
        <div class="fixed bottom-4 right-4 flex gap-2">
            <button
                onclick="zoomOut()"
                class="px-4 py-2 bg-blue-500 text-white rounded">-</button>
            <button
                onclick="resetZoom()"
                class="px-4 py-2 bg-blue-500 text-white rounded">Reset</button>
            <button
                onclick="zoomIn()"
                class="px-4 py-2 bg-blue-500 text-white rounded">+</button>
        </div>
    </section>


    <script
        src="https://unpkg.com/pdfjs-dist@4.0.379/build/pdf.min.mjs"
        type="module"></script>
    <script type="module">
        let currentZoom = 1;
        const MIN_ZOOM = 0.5;
        const MAX_ZOOM = 3;
        const ZOOM_STEP = 0.1;

        window.zoomIn = () => {
            if (currentZoom < MAX_ZOOM) {
                currentZoom += ZOOM_STEP;
                updateZoom();
            }
        };

        window.zoomOut = () => {
            if (currentZoom > MIN_ZOOM) {
                currentZoom -= ZOOM_STEP;
                updateZoom();
            }
        };

        window.resetZoom = () => {
            currentZoom = 1;
            updateZoom();
        };

        function updateZoom() {
            const container = document.getElementById("pdfContainer");
            if (container) {
                container.style.transform = `scale(${currentZoom})`;
            }
        }

        async function loadPDF() {
            const {
                pdfjsLib
            } = globalThis;
            const WORKER_PATH =
                "https://unpkg.com/pdfjs-dist@4.0.379/build/pdf.worker.min.mjs";
            pdfjsLib.GlobalWorkerOptions.workerSrc = WORKER_PATH;

            const urlFile = document.getElementById("urlFile").value;
            const loader = document.getElementById("loader");
            const pdfContainer = document.getElementById("pdfContainer");
            const PDF_PATH = urlFile;

            try {
                const pdf = await pdfjsLib.getDocument(PDF_PATH).promise;
                pdfContainer.innerHTML = "";

                for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
                    const page = await pdf.getPage(pageNum);
                    const viewportA = page.getViewport({
                        scale: 1
                    });
                    const width = viewportA.width;
                    const height = viewportA.height;
                    let scale;
                    const isWide = width > height;
                    if (window.innerWidth < 768) {
                        scale = isWide ? 0.2 : 0.55;
                    } else if (window.innerWidth >= 768 && window.innerWidth < 1024) {
                        scale = isWide ? 0.5 : 1;
                    } else {
                        scale = isWide ? 0.8 : 1.5;
                    }
                    const viewport = page.getViewport({
                        scale
                    });

                    const canvas = document.createElement("canvas");
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;

                    const context = canvas.getContext("2d");
                    await page.render({
                        canvasContext: context,
                        viewport
                    }).promise;

                    pdfContainer.appendChild(canvas);
                    if (!pdfContainer.classList.contains("bg-white")) {
                        pdfContainer.classList.add("bg-white");
                    }
                }

                setupTouchZoom();
            } finally {
                loader.classList.add("hidden");
                pdfContainer.classList.remove("hidden");
            }
        }

        function setupTouchZoom() {
            const pdfContainer = document.getElementById("pdfContainer");
            let initialDistance = 0;
            let initialZoom = 1;
            let touchStartX = 0;
            let touchStartY = 0;

            pdfContainer.addEventListener("touchstart", (e) => {
                if (e.touches.length === 2) {
                    e.preventDefault();
                    initialDistance = Math.hypot(
                        e.touches[0].pageX - e.touches[1].pageX,
                        e.touches[0].pageY - e.touches[1].pageY
                    );
                    initialZoom = currentZoom;
                } else if (e.touches.length === 1) {
                    touchStartX = e.touches[0].pageX;
                    touchStartY = e.touches[0].pageY;
                }
            });

            pdfContainer.addEventListener("touchmove", (e) => {
                if (e.touches.length === 2) {
                    e.preventDefault();
                    const distance = Math.hypot(
                        e.touches[0].pageX - e.touches[1].pageX,
                        e.touches[0].pageY - e.touches[1].pageY
                    );

                    const scale = (distance / initialDistance) * initialZoom;
                    currentZoom = Math.min(Math.max(scale, MIN_ZOOM), MAX_ZOOM);
                    updateZoom();
                }
            });

            // Prevenir el zoom del navegador
            document.addEventListener(
                "touchmove",
                (e) => {
                    if (e.touches.length > 1) {
                        e.preventDefault();
                    }
                }, {
                    passive: false
                }
            );
        }

        document.addEventListener("DOMContentLoaded", loadPDF);
    </script>

</body>

</html>