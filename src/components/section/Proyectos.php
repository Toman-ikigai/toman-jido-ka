<?php
include "./src/components/ui/Card.php";

$content = getContentJsonLang("projects", $langPath);
$items = $content["items"];
?>

<section class="py-16 mx-auto bg-[#303030]">
    <div class="p-8 md:p-12 flex gap-3 flex-col mx-auto rounded-xl shadow-lg border border-gray-700 max-w-6xl">
        <div>
            <h3 class=" text-primaryC-yellow font-bold uppercase text-xs leading-5">
                Our Work
            </h3>

            <h2 class=" text-white text-4xl font-bold capitalize mb-10">
                <?php echo $langPath === "es" ? "Proyectos" : "Projects"; ?>
            </h2>

            <div
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-8l">
                <?php foreach ($items as $project) card($project); ?>
            </div>

        </div>
    </div>
</section>