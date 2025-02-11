<?php
$content = getContentJsonLang("mission", $langPath);
?>

<section class="w-full py-16 px-4 m-auto bg-[#393838]" aria-label="mission-section">
    <div class="max-w-4xl mx-auto">
        <article class="p-8 md:p-12 flex gap-3 flex-col mx-auto rounded-xl shadow-lg border border-gray-700">
            <header>
                <h1 class="text-primaryC-yellow font-bold uppercase text-xs leading-5">
                    <?= $langPath == "es" ? "Nuestra misión" : "Our Purpose"; ?>
                </h1>

                <h2 class="text-white text-4xl font-bold capitalize">
                    <?= $langPath == "es" ? "Nuestra Misión" : "Our Mission"; ?>
                </h2>
            </header>

            <div class="space-y-6 mt-2">
                <p class="content-paragraph text-gray-300" itemprop="description">
                    <?= $content; ?>
                </p>
            </div>
        </article>
    </div>
</section>