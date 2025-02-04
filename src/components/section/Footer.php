<?php
$fecha = new DateTime();
$year = $fecha->format("Y");
?>

<footer
    class="bg-neutralC-black text-primaryC-yellow py-12 border-t border-secondaryC-gray">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <h3 class="text-2xl font-semibold mb-4 text-primaryC-yellow">
                    Toman Jido-Ka Ikigai
                </h3>
                <p class="text-secondaryC-gray mb-4">
                    <?= $langPath === "es" ? "LA INGENIERÍA DEBE SER UN ARTE." : "ENGINEERING SHOULD BE AN ART." ?>
                </p>
                <div class="flex space-x-4">
                    <a
                        href="#"
                        class="text-primaryC-yellow hover:text-secondaryC-orange transition-colors">
                        <!-- SVG Icons -->
                    </a>
                    <!-- Additional Social Links -->
                </div>
            </div>
            <div>
                <h4 class="text-xl font-semibold mb-4 text-primaryC-yellow">
                    <?= $langPath === "es" ? "Contáctanos" : "Contact Us" ?>
                </h4>
                <ul class="space-y-2">
                    <li class="flex items-center text-secondaryC-gray">
                        <!-- SVG Icon -->
                        Agustin Garcia #2069, de la Rosa Av Rivas Guil, Soledad de Graciano,
                        SLP
                    </li>
                    <li class="flex items-center text-secondaryC-gray">
                        <!-- SVG Icon -->
                        +52 444 450 1346
                    </li>
                    <li class="flex items-center text-secondaryC-gray">
                        <!-- SVG Icon -->
                        contacto@toman.com.mx
                    </li>
                </ul>
            </div>
        </div>
        <div
            class="mt-8 pt-8 border-t border-secondaryC-gray text-center text-secondaryC-gray">
            <p>
                &copy; <?= $year; ?> Toman Jido-Ka Ikigai.<?= $langPath === "es" ? "Todos los derechos reservados." : "All rights reserved." ?>
            </p>
        </div>
    </div>
</footer>