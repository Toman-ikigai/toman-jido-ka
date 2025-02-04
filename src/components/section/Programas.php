<?php
define("IMG_PATH", "src/img/logo_jovenes.avif");
$data = getContentJsonLang("programas", $langPath);
?>

<section class="lg:py-10 py-5 text-white">
    <article class="mx-auto lg:w-10/12 w-11/12 px-4">
        <div class="text-center grid lg:grid-cols-2 grid-cols-1">
            <dt class="space-y-4 max-w-xl mx-auto mb-8 lg:col-start-2">
                <h2
                    class="text-4xl relative font-bold mb-6 inline-block text-[#ffff00]">
                    <?= $data["title"] ?>
                    <span
                        class="absolute left-0 -bottom-5 w-full h-1 bg-[#FFA500] rounded"></span>
                </h2>
                <?php foreach ($data["content"] as $item): ?>
                    <p class="text-lg font-medium leading-relaxed text-[#E0E0E0]">
                        <?= $item ?>
                    </p>
                <?php endforeach; ?>
            </dt>

            <figure class="flex justify-center lg:col-start-1 lg:row-start-1 row-start-2 w-11/12">
                <img
                    src="<?= IMG_PATH ?>"
                    alt="Jóvenes Construyendo el Futuro"
                    class="w-full object-cover h-auto rounded-lg shadow-lg border-2 border-[#FFA500]/20" />
            </figure>
        </div>
    </article>
</section>