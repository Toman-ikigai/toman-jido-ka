<?php
include "./src/components/ui/serviceArea.php";
$content = getContentJsonLang("serviceAreas", $langPath);
$items = $content["items"];

?>

<div class="w-full py-16 px-4 lg:w-10/12 m-auto bg-primaryC-black">
    <div class="mx-auto max-w-6xl">
        <h2 class="mb-12 text-center text-3xl font-bold text-primaryC-yellow">
            <?php echo $langPath === "es" ? "Áreas de Especialización" : "Service Areas"; ?>
        </h2>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
            <?php foreach ($items as $service) serviceArea($service); ?>
        </div>
    </div>
</div>