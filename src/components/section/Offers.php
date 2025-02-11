<?php
define("IMG_PATH", "src/img/logo_jovenes.avif");
$data = getContentJsonLang("programas", $langPath);
$title = $data["title"];
$description = $data["content"];
?>

<section class="w-full py-16 px-4 mx-auto" aria-label="Programas especiales" itemscope itemtype="http://schema.org/Article">
    <div class="max-w-6xl mx-auto bg-[#303030">
        <article class="bg-background-secondary/30 backdrop-blur-md border border-white/10 rounded-2xl shadow-xl p-8 md:p-16">
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div class="space-y-6">
                    <h2 class="text-primaryC-yellow text-3xl md:text-4xl font-bold text-accent leading-tight" itemprop="headline">
                        <?= $title ?>
                    </h2>
                    <div itemprop="articleBody" class="flex gap-3 flex-col">
                        <?php foreach ($description as $item): ?>
                            <p class="text-lg text-gray-300 leading-relaxed">
                                <?= $item ?>
                            </p>
                        <?php endforeach; ?>
                    </div>
                </div>
                <figure class="relative h-[300px] md:h-[400px] rounded-xl overflow-hidden reveal active" itemprop="image">
                    <img class="w-full h-full object-cover transition-transform duration-300 hover:scale-105"
                        src="<?= IMG_PATH ?>"
                        alt="Jóvenes Construyendo el Futuro"
                        loading="lazy"
                        width="800"
                        height="400">
                </figure>
            </div>
        </article>
    </div>
</section>