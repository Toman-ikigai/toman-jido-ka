<?php
$content = getContentJsonLang("identity", $langPath);
$title = $content["title"];
$description = $content["descripcion"];
?>

<section id="about" aria-label="About Us" class="w-full py-16 px-4 lg:w-11/12 m-auto">
    <article class="p-8 md:p-12 bg-[#303030] flex gap-3 flex-col w-11/12 mx-auto rounded-xl shadow-lg border border-gray-700">
        <header>
            <h2 class="text-primaryC-yellow font-bold uppercase text-xs leading-5">
                <?php echo $langPath == "es" ? "Nuestra Identidad" : "Our Identity"; ?>
            </h2>

            <h1 class="text-white text-4xl font-bold capitalize">
                <?= $title; ?>
            </h1>
        </header>

        <div class="space-y-6 mt-2">
            <?php foreach($description as $item): ?>
                <article>
                    <h3 class="text-xl font-semibold mb-2 text-primaryC-yellow uppercase">
                        <?= $item["title"]; ?>
                    </h3>
                    <div class="content-paragraph text-gray-300">
                        <?= $item["descripcion"]; ?>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </article>
</section>