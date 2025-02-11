<?php
$content = getContentJsonLang("spot", $langPath);
$title = $content["title"];
$subtitle = $content["subtitle"];
?>

<article class="w-full py-16 px-4 mx-auto bg-[#393838]">
    <div class="max-w-6xl mx-auto text-center" role="region" aria-label="Spot Section">
        <div class="bg-background-secondary/30 backdrop-blur-md border border-white/10 rounded-2xl shadow-xl p-8 md:p-16">
            <h2 class="text-primaryC-yellow text-3xl md:text-5xl font-extrabold mb-8 tracking-wide" id="spot-title">
                <?= $title ?>
            </h2>
    
            <p class="text-xl md:text-2xl text-gray-300 max-w-3xl mx-auto leading-relaxed" aria-labelledby="spot-title">
                <?= $subtitle ?>
            </p>
        </div>
    </div>
</article>