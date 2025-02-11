<?php

$slider = getContentJsonLang("reviews", $langPath);
$items = $slider["items"];

$half = ceil(count($items) / 2);
$group1 = array_slice($items, 0, $half);
$group2 = array_slice($items, $half);
?>

<section class="relative flex w-11/12 md:w-full mx-auto mt-5 mb-5 flex-col overflow-hidden ">
    <div class="infinite-carousel">
        <div>
            <?php foreach ($group1 as $item): ?>
                <figure class="flex flex-col w-full bg-transparent p-3 rounded-md break-words border border-white text-white gap-2 min-h-[160px]">
                    <picture class=" w-full flex items-center gap-2">
                        <img class="rounded-full w-9 h-9" src="<?= $item['img'] ?>" alt="Image">
                        <dt class=" flex flex-col gap-1">
                            <h3 class="text-sm font-medium text-primaryC-yellow"><?= $item['name'] ?></h3>
                            <p class="text-xs font-medium text-secondaryC-gray/80"><?= $item['username'] ?></p>
                        </dt>
                    </picture>
                    <p class="whitespace-normal break-words overflow-hidden text-ellipsis text-sm text-secondaryC-gray"><?= $item['body'] ?></p>
                </figure>
            <?php endforeach; ?>
        </div>
    </div>


    <div class="infinite-carousel">
        <div>
            <?php foreach ($group2 as $item): ?>
                <figure class="flex flex-col w-full bg-transparent p-3 rounded-md break-words border border-white text-white gap-2 min-h-[160px]">
                    <picture class=" w-full flex items-center gap-2">
                        <img class="rounded-full w-9 h-9" src="<?= $item['img'] ?>" alt="Image">
                        <dt class=" flex flex-col gap-1">
                            <h3 class="text-sm font-medium text-primaryC-yellow"><?= $item['name'] ?></h3>
                            <p class="text-xs font-medium text-secondaryC-gray/80"><?= $item['username'] ?></p>
                        </dt>
                    </picture>
                    <p class="whitespace-normal break-words overflow-hidden text-ellipsis text-sm text-secondaryC-gray"><?= $item['body'] ?></p>
                </figure>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<script>
    const carousels = document.querySelectorAll('.infinite-carousel');

    carousels.forEach(carousel => {
        const container = carousel.querySelector('.infinite-carousel div');
        const carouselContent = Array.from(container.children);

        carouselContent.forEach(item => {
            const duplicateItem = item.cloneNode(true);
            container.appendChild(duplicateItem);
            container.style.animation = 'move 15s linear infinite';
        })
    });
</script>