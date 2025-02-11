<?php
$content = getContentJsonLang("about", $langPath);
// { valores, spot, informacion, mision, vision }
$valores = $content["valores"];
$spot = $content["spot"];
$informacion = $content["informacion"];
$mision = $content["mision"];
$vision = $content["vision"];

?>
<div
    id="about"
    class="flex flex-col items-center justify-center bg-[#2c2c2c]">
    <div
        class="text-center w-full lg:w-10/12 m-auto mb-12 p-8 rounded-xl shadow-lg bg-[#ffff00]">
        <h1
            class="md:text-4xl text-xl font-bold mb-4 text-[#2C2C2C]">
            <?= $spot["title"]; ?>
        </h1>
        <p class="md:text-3xl text-lg text-[#4B4B4B]">
            <?= $spot["content"]; ?>
        </p>
    </div>

    <div class="grid md:grid-cols-2 gap-8 max-w-6xl">
        <div
            class="p-8 space-y-6 shadow-lg transition-all duration-300 hover:scale-[1.02] bg-[#2C2C2C] border-[2px] border-[#4B4B4B] rounded-[20px]">
            <h2
                class="text-4xl font-extrabold mb-6 text-center flex items-center justify-center gap-4 text-[#FFFF00]">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="40"
                    height="40"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="16" x2="12" y2="12"></line>
                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                </svg>
                <?= $informacion["title"]; ?>
            </h2>

            <div class="lg:grid lg:grid-cols-2 grid-col-1 gap-6 flex flex-col">
                <div class="md:col-span-2">
                    <p
                        class="text-base leading-relaxed text-[#FFFFFF]">
                        <? $informacion["content"]; ?>
                    </p>
                </div>
                <div
                    class="p-6 rounded-xl space-y-4 transform transition-all duration-300 hover:scale-[1.03] bg-[#393838]">
                    <div class="flex items-center gap-3 mb-2">
                        <h3
                            class="text-2xl font-bold text-[#FFFF00]">
                            <?= $informacion["descripcion"][0]["title"]; ?>
                        </h3>
                    </div>
                    <p
                        class="text-base leading-relaxed text-[#FFFFFF]">
                        <?= $informacion["descripcion"][0]["descripcion"]; ?>
                    </p>
                </div>

                <div
                    class="p-6 rounded-xl space-y-4 transform transition-all duration-300 hover:scale-[1.03] bg-[#393838]">
                    <div class="flex items-center gap-3 mb-2">
                        <h3
                            class="text-2xl font-bold text-[#FFFF00]">
                            <?= $informacion["descripcion"][1]["title"]; ?>
                        </h3>
                    </div>
                    <p class="text-base leading-relaxed text-[#FFFFFF]">
                        <?= $informacion["descripcion"][1]["descripcion"]; ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div
                class="p-6 rounded-xl flex items-start space-x-4 bg-[#4B4B4B]">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    width="72"
                    height="72"
                    stroke-width="2"
                    class="text-primaryC-yellow">
                    <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                    <path d="M12 12m-5 0a5 5 0 1 0 10 0a5 5 0 1 0 -10 0"></path>
                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                </svg>
                <div>
                    <h3
                        class="text-2xl font-bold mb-2 text-[#FFFFFF]">
                        <?= $langPath === "es" ? "Nuestra Misión" : "Our Mission"; ?>
                    </h3>
                    <p class="text-[#FFFFFF]">
                        <?= $mision; ?>
                    </p>
                </div>
            </div>

            <div
                class="p-6 rounded-xl flex items-start space-x-4 bg-[#4B4B4B]">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    width="72"
                    height="72"
                    stroke-width="2"
                    class="text-primaryC-yellow">
                    <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                    <path d="M3.6 9h16.8"></path>
                    <path d="M3.6 15h16.8"></path>
                    <path d="M11.5 3a17 17 0 0 0 0 18"></path>
                    <path d="M12.5 3a17 17 0 0 1 0 18"></path>
                </svg>
                <div>
                    <h3
                        class="text-2xl font-bold mb-2 text-[#FFFFFF]">
                        <?php echo $langPath === "es" ? "Nuestra Visión" : "Our Vision"; ?>
                    </h3>
                    <p class=" text-[#FFFFFF]">
                        <?= $vision; ?>
                    </p>
                </div>
            </div>

            <div
                class="p-6 rounded-xl bg-[#4B4B4B]">
                <h3
                    class="text-2xl font-bold mb-4 text-center text-[#ffffff]">
                    <?= $langPath === "es" ? "Nuestros Valores" : "Our Values"; ?>
                </h3>
                <div class="grid md:grid-cols-2 gap-4">
                    <?php foreach ($valores as $valor) : ?>
                        <div
                            class="flex items-center space-x-2 p-2 rounded bg-[#2C2C2C] text-[#ffff00]">
                            <?= $valor["icon"]; ?>
                            <span><?= $valor["label"]; ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>