<?php
$content = getContentJsonLang("catalogItems", $langPath);
$items = $content["items"];
?>

<style>
    .container {
        max-width: 1200px;
    }
</style>

<section class="py-16" id="catalago">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-bold text-primaryC-yellow mb-12 text-center">
            Nuestro Catalogo
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php foreach ($items as $item): ?>
                <article class="group relative overflow-hidden rounded-lg shadow-lg transition-transform duration-300 hover:scale-105">
                    <span class="absolute inset-0 bg-gradient-to-b from-transparent to-primaryC-black opacity-70 transition-opacity duration-300 group-hover:opacity-90">
                    </span>
                    <img
                        src="<?= $item["image"] ?>"
                        alt="<?= $item["title"] ?>"
                        class="w-full h-64 object-cover" />
                    <div class="absolute bottom-0 left-0 right-0 p-6 transform translate-y-2 transition-transform duration-300 group-hover:translate-y-0">
                        <h3 class="text-2xl font-semibold text-primaryC-yellow mb-2">
                            <?= $item["title"] ?>
                        </h3>
                        <p class="text-neutralC-white text-sm opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                            <?= $item["description"] ?>
                        </p>
                        <?php if (!empty(trim($item["url_pdf"]))): ?>
                            <a
                                href="/<?= $langPath ?>/render-pdf/<?= $item["url_pdf"] ?>"
                                class="mt-4 inline-block bg-[#4CAF50] text-white text-sm font-bold px-4 py-2 rounded-full transition-transform duration-300 hover:scale-105 hover:bg-[#45a049]">
                                Ver más
                            </a>
                        <?php endif; ?>
                    </div>
                    <span class="absolute top-0 right-0 bg-[#4CAF50] text-white text-xs font-bold px-3 py-1 m-2 rounded-full opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                        <? echo $index + 1; ?>
                    </span>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
    </div>
</section>