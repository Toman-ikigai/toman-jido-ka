<?php
$content = getContentJsonLang("benefitsData", $langPath);
$benefits = $content["items"];
$benefitsTitle = $content["title"];
$benefitsContent = $content["content"];
?>

<section class="py-20 px-4 md:w-11/12 mx-auto" aria-labelledby="benefits-title">
    <div class="max-w-6xl mx-auto">
        <article class="p-8 md:p-12 bg-background-secondary/30 backdrop-blur-md border border-white/10 rounded-2xl shadow-xl">
            <header>
                <h2 id="benefits-title" class="text-sm uppercase tracking-wider text-accent font-medium mb-2 text-primaryC-yellow">
                    <?= htmlspecialchars($benefitsTitle) ?>
                </h2>

                <p class="text-xl font-bold mb-6 text-white">
                    <?= htmlspecialchars($benefitsContent) ?>
                </p>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-12">
                <?php foreach ($benefits as $item): ?>
                    <article
                        class="relative group overflow-hidden rounded-xl"
                        itemscope
                        itemtype="http://schema.org/Service">
                        <figure class="absolute inset-0 bg-cover bg-center bg-no-repeat transition-transform duration-300 group-hover:scale-110"
                            style="background-image: url(<?= htmlspecialchars($item['image']) ?>); background-size: 150%;"
                            role="img"
                            aria-label="<?= htmlspecialchars($item['title']) ?> image">
                        </figure>
                        <span class="absolute inset-0 bg-primaryC-black/80 backdrop-blur-sm transition-opacity duration-300 group-hover:bg-primaryC-black/70"></span>

                        <div class="relative z-10 p-8 h-full flex flex-col items-center text-center">
                            <figure class="w-16 h-16 rounded-full bg-accent/10 flex items-center justify-center mb-4" aria-hidden="true">
                                <?= $item['icon'] ?>
                            </figure>
                            <h3 class="text-xl font-semibold mb-3 text-primaryC-yellow" itemprop="name">
                                <?= htmlspecialchars($item['title']) ?>
                            </h3>
                            <p class="text-gray-300 text-sm leading-relaxed" itemprop="description">
                                <?= htmlspecialchars(mb_substr($item['description'], 0, 100)) ?>...
                            </p>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </article>
    </div>
</section>