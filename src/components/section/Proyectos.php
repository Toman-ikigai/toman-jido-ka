<?php
include "./src/components/ui/Card.php";

$content = getContentJsonLang("projects", $langPath);
$items = $content["items"];
?>

<div class="p-6 flex flex-col items-center justify-center">
    <h2 class="text-3xl font-bold mb-8 text-center text-[#ffff00]">
        <?php echo $langPath === "es" ? "Proyectos" : "Projects"; ?>
    </h2>

    <div
        class="flex flex-col gap-6 w-full max-w-6xl">
        <?php foreach ($items as $project) card($project); ?>
    </div>
</div>