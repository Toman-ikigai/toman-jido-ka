<?php

function card($item)
{
    echo "
    <div
    class='relative w-full mx-auto transform transition-all duration-300 hover:scale-105 hover:shadow-lg rounded-xl overflow-hidden bg-primaryC-black shadow-md grid grid-cols-1 md:grid-cols-4 card__project'
    >
    <div
        class='relative w-full h-48 overflow-hidden bg-primaryC-yellow col-span-1 md:col-span-3'
    >
        <img
        src='{$item['image']}'
        alt='{$item['title']}'
        class='w-full h-full object-cover transition-transform duration-300 hover:scale-110 hover:brightness-90 img__project group-hover:blur-md'
        />

        <div
        class='absolute inset-0 flex items-center justify-center bg-black transition-opacity duration-300 break-words p-5 div_overlap'
        >
            <p class='text-base md:text-xl line-clamp-3 text-neutralC-white text-center font-semibold text-shadow'>
                {$item['description']}
            </p>
        </div>
    </div>

    <div
        class='p-4 text-neutralC-white bg-primaryC-yellow text-center flex justify-center items-center'
    >
        <h3 class='text-xl md:text-xl lg:text-2xl font-bold mb-2 break-words text-black'>
        {$item['title']}
        </h3>
    </div>
    </div>
    ";
}
