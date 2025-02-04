<?php
$socialLinks = [
    [
        "icon" => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2">
                      <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9"></path>
                      <path d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1"></path>
                  </svg>',
        "label" => "WhatsApp",
        "link" => "https://wa.me/524444501346",
        "color" => "#25D366",
    ],
    [
        "icon" => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2">
                      <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                      <rect width="4" height="12" x="2" y="9"></rect>
                      <circle cx="4" cy="4" r="2"></circle>
                  </svg>',
        "label" => "LinkedIn",
        "link" => "https://www.linkedin.com/company/toman-jido-ka-ikigai",
        "color" => "#0A66C2",
    ],
    [
        "icon" => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <rect width="20" height="20" x="2" y="2" rx="5" ry="5" />
      <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
      <line x1="17.5" x2="17.51" y1="6.5" y2="6.5" />
    </svg>',
        "label" => "Instagram",
        "link" => "https://www.instagram.com/tomanjidokaikigai",
        "color" => "#E1306C",
    ],
    [
        "icon" => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2">
                      <path d="M12 19h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v8"></path>
                      <path d="M16 19h6"></path>
                      <path d="M3 7l9 6l9 -6"></path>
                  </svg>',
        "label" => "Correo",
        "link" => "mailto:contacto@toman.com.mx",
        "color" => "#FFA500",
    ],
    [
        "icon" => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
         <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
      </svg>',
        "label" => "Facebook",
        "link" => "https://www.facebook.com/TOMANJIDOKAIKIGAI",
        "color" => "#1877F2",
    ]
]

?>


<section class="flex items-center justify-center p-6" id="contacto">
    <div class="w-full max-w-6xl">
        <div class="flex flex-col justify-center">
            <h2
                class="text-3xl font-bold mb-6 text-center text-[#ffff00]">
                <?php echo $langPath === "es" ? "Nuestras Redes" : "Our Networks"; ?>
            </h2>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <?php foreach ($socialLinks as $social): ?>
                    <a
                        href="<?= $social['link']; ?>"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="flex flex-col items-center justify-center p-4 rounded-lg transform transition duration-300 hover:scale-110 hover:shadow-lg bg-secondaryC-gray"
                        style="color:<?= $social['color']; ?>" ;>
                        <?= $social['icon']; ?>
                        <span class="font-medium text-sm mt-2">
                            <?= $social['label']; ?>
                        </span>
                    </a>
                <?php endforeach; ?>
            </div>

            <div
                class="mt-8 p-6 rounded-lg text-center space-y-4 bg-[#4B4B4B]">
                <div class="flex items-center justify-center">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        width="24"
                        height="24"
                        stroke-width="2"
                        class="mr-2"
                        style="color: #ffff00">
                        <path
                            d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2"></path>
                    </svg>
                    <span class="text-neutralC-white">+52 444-450-1346</span>
                </div>
                <div class="flex items-center justify-center">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        width="24"
                        height="24"
                        stroke-width="2"
                        class="mr-2"
                        style="color: #ffff00">
                        <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                        <path
                            d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z"></path>
                    </svg>
                    <span class="text-neutralC-white">
                        <?php echo $langPath === "es" ? "Dirección" : "Address"; ?>: Agustin Garcia #2069, de la Rosa Av Rivas Guil, Soledad de Graciano, SLP
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>