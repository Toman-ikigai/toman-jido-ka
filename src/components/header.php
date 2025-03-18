<?php
require "src/service/langJson.php";

$toggleLang = $langPath === "es" ? "en" : "es";
$langData = getContentJsonLang("header", $langPath);
$url = str_contains($_SERVER['REQUEST_URI'], "render-pdf");

?>

<header
    id="main-header"
    class="bg-transparent text-white p-4 lg:p-2 fixed w-full z-20 shadow-md transition-colors duration-300">
    <div class="container mx-auto flex justify-between items-center">
        <a href="/<?php echo $langPath; ?>">
            <img
                src="https://res.cloudinary.com/dvggwdqnj/image/upload/v1734466484/logos/ilswi1k9e87ud8eikato.png"
                alt="Company Logo"
                class="w-36 lg:w-40 h-auto object-contain rounded-lg" />
        </a>
        <button
            id="menu-toggle"
            class="lg:hidden text-white focus:outline-none focus:ring-2 focus:ring-secondaryC-orange transition transform hover:scale-110 static right-4 top-4 z-30">
            <svg
                class="w-8 h-8"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>

        <nav
            id="menu"
            class="hidden absolute lg:static bg-black bg-opacity-80 lg:bg-transparent top-16 left-0 w-full lg:w-auto lg:space-x-6 uppercase text-sm lg:flex items-center text-white transition-all duration-300">
            <ul class="flex flex-col lg:flex-row lg:items-center">
                <?php foreach ($langData['items'] as $item): ?>
                    <li class="<?php echo strpos($item['url'], 'electrocontrol') !== false ? 'hidden' : ''; ?>">
                        <a
                            href="<?php echo strpos($item['url'], 'electrocontrol') !== false ?
                                        '/' . $langPath . '/electrocontrol' :
                                        '/' . $langPath . (isset($url) ? '' : '#' . $item['url']); ?>"
                            class="block py-2 px-4 hover:text-secondaryC-orange transition-colors">
                            <?php echo $item['name']; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
                <li>
                    <a
                        href="/<?php echo $toggleLang . (isset($url) ? '/render-pdf' : ''); ?>"
                        class="block py-2 px-4 hover:text-secondaryC-orange transition-colors">
                        <?php echo strtoupper($toggleLang); ?>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</header>

<script>
    const retrieveActivePage = () => {
        const header = document.getElementById("main-header")
        const menuToggle = document.getElementById("menu-toggle")
        const menu = document.getElementById("menu")

        window.addEventListener("scroll", () => {
            if (window.scrollY > window.innerHeight * 0.5) {
                header.classList.remove("bg-transparent");
                header.classList.add("bg-black", "bg-opacity-70", "shadow-lg");
            } else {
                header.classList.remove("bg-black", "bg-opacity-70", "shadow-lg");
                header.classList.add("bg-transparent");
            }
        });

        menuToggle.addEventListener("click", () => {
            menu.classList.toggle("hidden");
        });
    };

    document.addEventListener("DOMContentLoaded", retrieveActivePage);
</script>