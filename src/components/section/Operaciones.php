<?php
$content = getContentJsonLang("benefitsData", $langPath);
$benefits = $content["items"];
$benefitsTitle = $content["title"];
$benefitsContent = $content["content"];
?>

<div class="py-8 rounded-lg text-neutralC-white lg:w-10/12 w-11/12 m-auto">
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold mb-4 text-[#ffff00]">
            <?= $benefitsTitle ?>
        </h2>
        <blockquote class="lg:w-9/12 w-10/12 m-auto">
            <p class="text-lg mb-6 text-secondaryC-gray">
                <?= $benefitsContent ?>
            </p>
        </blockquote>
    </div>

    <div class="grid md:grid-cols-2 gap-6">
        <?php foreach ($benefits as $item): ?>
            <div
                class="p-6 rounded-lg shadow-md transition-all hover:shadow-2xl hover:scale-105 border border-neutral-700 relative h-72 lg:h-60 bg-cover bg-center"
                style="background-image: url(<?= $item['image'] ?>); background-size: 120%;">
                <div class="absolute z-10 p-2">
                    <div class="flex items-center mb-4">
                        <?= $item['icon'] ?>
                        <h3 class="ml-4 text-xl font-bold text-white">
                            <?= $item['title'] ?>
                        </h3>
                    </div>
                    <p class="text-md text-white">
                        <?= $item['description'] ?>
                    </p>
                </div>
                <span class="absolute inset-0 bg-black bg-opacity-60 rounded-lg backdrop-blur-[1px]">
                </span>
            </div>
        <?php endforeach; ?>

    </div>
</div>