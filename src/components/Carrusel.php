<?php

$slides = getContentJsonLang("slideData", $langPath);
?>

<div id="home" class="slider-container">
    <?php foreach ($slides["items"] as $index => $slide): ?>
        <div class="slide <?= $index === 0 ? 'active' : '' ?>">
            <img src="<?= $slide['image'] ?>" alt="<?= $slide['title'] ?>" style="width: 100%; height: 100%; object-fit: cover;">
            <div class="overlay">
                <h2 class="text-2xl text-center font-din"><?= $slide['title'] ?></h2>
                <h3 class="flex flex-wrap md:flex-nowrap justify-center md:gap-4 gap-2 overflow-hidden md:text-4xl text-xl font-bold"><?= $slide['subtitle'] ?></h3>
                <p class="lg:w-5/12 md:text-2xl lg:text-xl w-10/12 flex flex-wrap font-bergsland"><?= $slide['description'] ?></p>
                <button class="btn"><?= $slide['buttonText'] ?></button>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<script>
    let currentSlide = 0;
    const slides = document.querySelectorAll(".slide");
    const totalSlides = slides.length;

    function changeSlide() {
        slides[currentSlide].classList.remove("active");
        currentSlide = (currentSlide + 1) % totalSlides;
        slides[currentSlide].classList.add("active");
    }

    setInterval(changeSlide, 5000);
</script>