<?php
$content = getContentJsonLang("vision", $langPath);
?>

<section class="w-full py-16 px-4 lg:w-10/12 m-auto" aria-label="Vision Section">
    <div class="max-w-4xl mx-auto">
        <article class="p-8 md:p-12 bg-[#303030] flex gap-3 flex-col mx-auto rounded-xl shadow-lg border border-gray-700">
            <header>
                <h3 class="text-primaryC-yellow font-bold uppercase text-xs leading-5" role="doc-subtitle">
                    <?= $langPath == "es" ? "Nuestra Aspiración" : "Our Aspiration"; ?>
                </h3>

                <h2 class="text-white text-4xl font-bold capitalize" role="heading" aria-level="2">
                    <?= $langPath == "es" ? "Nuestra Visión" : "Our Vision"; ?>
                </h2>
            </header>

            <div class="space-y-6 mt-2">
                <p class="content-paragraph text-gray-300" itemprop="text">
                    <?= $content; ?>
                </p>
            </div>
        </article>
    </div>
</section>