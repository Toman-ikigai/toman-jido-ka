<?php
$content = getContentJsonLang("valores", $langPath);
?>

<section class="w-full py-16 px-4 m-auto bg-[#393838]" aria-label="<?= $langPath == "es" ? "Valores corporativos" : "Corporate values" ?>">
    <div class="max-w-4xl mx-auto">
        <article class="p-8 md:p-12 flex gap-3 flex-col mx-auto rounded-xl shadow-lg border border-gray-700">
            <header>
                <h2 class="text-primaryC-yellow font-bold uppercase text-xs leading-5">
                    <?= $langPath == "es" ? "Nuestros Principios" : "Our Principles" ?>
                </h2>

                <h3 class="text-white text-4xl font-bold capitalize">
                    <?= $langPath == "es" ? "Nuestros Valores" : "Our Values" ?>
                </h3>
            </header>

            <div class="grid md:grid-cols-2 gap-8 mt-2">
                <?php foreach ($content as $value) : ?>
                    <article itemscope itemtype="http://schema.org/Article">
                        <h4 class="text-xl font-semibold mb-2 text-accent text-primaryC-yellow" itemprop="headline">
                            <?= $value["label"] ?>
                        </h4>
                        <p class="text-gray-300" itemprop="description">
                            <?= $value["text"] ?>
                        </p>
                    </article>
                <?php endforeach; ?>
            </div>
        </article>
    </div>
</section>